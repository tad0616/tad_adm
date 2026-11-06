#!/bin/sh
set -eu
: "${PHP_BIN:=php}"
: "${CORE_MANIFEST:?Set CORE_MANIFEST to the XOOPS upgrade.json path}"
: "${RUN_MODE:=ssh}"
export RUN_MODE
module=$(CDPATH= cd -- "$(dirname -- "$0")/.." && pwd)
manifest_class="$module/class/UpgradeManifest.php"
base=$(mktemp -d)
trap 'rm -rf -- "$base"' EXIT HUP INT TERM
root="$base/site"
work="$root/uploads/tad_adm/upgrade"
var="$base/data"
lib="$base/lib"
if [ "${VAR_IN_UPLOADS:-0}" = 1 ]; then
    var="$root/uploads/data"
fi
mkdir -p "$work/htdocs/upgrade" "$work/xoops_data" "$work/xoops_lib" "$root/uploads/existing" "$var" "$lib"
printf 'original' > "$root/uploads/existing/file"
printf 'web' > "$work/htdocs/upgrade/index.php"
printf 'data' > "$work/xoops_data/data.txt"
printf 'lib' > "$work/xoops_lib/lib.txt"
printf 'package' > "$root/uploads/package.zip"
printf 'config' > "$root/mainfile.php"
real_chmod=$(command -v chmod)
export real_chmod TEST_CHMOD_LOG="$base/chmod.log"
mkdir "$base/bin"
cat > "$base/bin/chmod" <<'EOF'
#!/bin/sh
printf '%s\n' "$*" >> "$TEST_CHMOD_LOG"
exec "$real_chmod" "$@"
EOF
"$real_chmod" 755 "$base/bin/chmod"
PATH="$base/bin:$PATH"
export PATH
if command -v cygpath >/dev/null 2>&1; then
    manifest_class=$(cygpath -w "$manifest_class")
    CORE_MANIFEST=$(cygpath -w "$CORE_MANIFEST")
    root_arg=$(cygpath -w "$root")
    var_arg=$(cygpath -w "$var")
    lib_arg=$(cygpath -w "$lib")
    work_arg=$(cygpath -w "$work")
    zip_arg=$(cygpath -w "$root/uploads/package.zip")
    export MSYS2_ARG_CONV_EXCL='*'
else
    root_arg=$root var_arg=$var lib_arg=$lib work_arg=$work zip_arg="$root/uploads/package.zip"
fi

"$PHP_BIN" -r '
    require $argv[1];
    $steps = \XoopsModules\Tad_adm\UpgradeManifest::load($argv[2], [
        "ROOT" => $argv[3], "VAR" => $argv[4], "LIB" => $argv[5],
        "WORK" => $argv[6], "NEW_FILE" => $argv[7], "SN" => 9
    ]);
    if (getenv("RUN_MODE") === "php") {
        $check = \XoopsModules\Tad_adm\UpgradeManifest::preflight($steps, $argv[3]);
        if ($check["count"]) {
            throw new \RuntimeException(json_encode($check));
        }
        $report = \XoopsModules\Tad_adm\UpgradeManifest::run_php($steps);
        if ($report["errors"] || $report["warnings"]) {
            throw new \RuntimeException(json_encode($report));
        }
    } elseif (getenv("RUN_MODE") === "ssh") {
        echo \XoopsModules\Tad_adm\UpgradeManifest::to_shell($steps, true);
    } else {
        throw new \RuntimeException("Unknown test mode");
    }
' "$manifest_class" "$CORE_MANIFEST" "$root_arg" "$var_arg" "$lib_arg" "$work_arg" "$zip_arg" > "$base/run.sh"
if [ "$RUN_MODE" = ssh ]; then
    sh "$base/run.sh" > "$base/output"
    if grep -q 'TAD_ADM_FAIL\|TAD_ADM_WARN' "$base/output"; then
        cat "$base/output" >&2
        exit 1
    fi
    if [ -f "$TEST_CHMOD_LOG" ] && grep -Fq '/uploads' "$TEST_CHMOD_LOG"; then
        echo "SSH chmod touched uploads" >&2
        exit 1
    fi
fi
[ "$(cat "$root/upgrade/index.php")" = web ]
[ "$(cat "$var/data.txt")" = data ]
[ "$(cat "$lib/lib.txt")" = lib ]
[ "$(cat "$root/uploads/existing/file")" = original ]
[ -f "$root/uploads/xoops_sn_9.txt" ]
[ ! -e "$work" ]
[ ! -e "$root/uploads/package.zip" ]
echo "Real XOOPS manifest $RUN_MODE copy, cleanup and completion passed (VAR_IN_UPLOADS=${VAR_IN_UPLOADS:-0})."
