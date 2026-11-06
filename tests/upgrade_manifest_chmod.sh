#!/bin/sh
set -eu

: "${PHP_BIN:=php}"
module=$(CDPATH= cd -- "$(dirname -- "$0")/.." && pwd)
manifest="$module/class/UpgradeManifest.php"
if command -v cygpath >/dev/null 2>&1; then
    manifest=$(cygpath -w "$manifest")
    export MSYS2_ARG_CONV_EXCL='*'
fi

base=$(mktemp -d)
trap 'rm -rf -- "$base"' EXIT HUP INT TERM
tree="$base/tree with ' quote"
mkdir -p "$tree/sub" "$base/bin"
printf 'data' > "$tree/sub/file with spaces"
printf 'outside' > "$base/outside"
if ln -s "$base/outside" "$tree/symlink" 2>/dev/null && [ -L "$tree/symlink" ]; then
    has_symlink=1
else
    has_symlink=0
fi
real_find=$(command -v find)
real_chmod=$(command -v chmod)
export real_find real_chmod
export TEST_FIND_LOG="$base/find.log" TEST_CHMOD_LOG="$base/chmod.log"
cat > "$base/bin/find" <<'EOF'
#!/bin/sh
printf 'find\n' >> "$TEST_FIND_LOG"
exec "$real_find" "$@"
EOF
cat > "$base/bin/chmod" <<'EOF'
#!/bin/sh
printf '%s\n' "$*" >> "$TEST_CHMOD_LOG"
if [ "${TEST_CHMOD_FAIL:-0}" = 1 ]; then
    exit 1
fi
exec "$real_chmod" "$@"
EOF
"$real_chmod" 755 "$base/bin/find" "$base/bin/chmod"
PATH="$base/bin:$PATH"
export PATH

generate() {
    "$PHP_BIN" -r '
        require $argv[1];
        $mode = $argv[3] === "different" ? 0644 : ($argv[3] === "matching" ? 0644 : 0700);
        $dirMode = $argv[3] === "matching" ? 0644 : 0700;
        echo \XoopsModules\Tad_adm\UpgradeManifest::to_shell([
            ["n" => 1, "op" => "chmod", "optional" => false, "path" => $argv[2], "file" => $mode, "dir" => $dirMode, "recursive" => true],
            ["n" => 2, "op" => "mkdir", "optional" => false, "path" => $argv[2] . "/after"]
        ], true);
    ' "$manifest" "$tree" "$1"
}

generate same > "$base/run.sh"
: > "$TEST_FIND_LOG"
: > "$TEST_CHMOD_LOG"
sh "$base/run.sh" > "$base/output"
[ "$(wc -l < "$TEST_FIND_LOG")" -eq 1 ]
grep -q 'TAD_ADM_PROGRESS 1' "$base/output"
grep -q 'TAD_ADM_PROGRESS 2' "$base/output"
[ -d "$tree/after" ]
if [ "$has_symlink" = 1 ] && grep -Fq 'symlink' "$TEST_CHMOD_LOG"; then
    echo "Symbolic link was unexpectedly chmodded" >&2
    exit 1
fi

generate different > "$base/run.sh"
: > "$TEST_FIND_LOG"
sh "$base/run.sh" > "$base/output"
[ "$(wc -l < "$TEST_FIND_LOG")" -eq 2 ]

if "$real_find" "$tree/sub/file with spaces" -perm 0644 -print | grep -q .; then
    generate matching > "$base/run.sh"
    : > "$TEST_CHMOD_LOG"
    sh "$base/run.sh" > "$base/output"
    if grep -Fq 'file with spaces' "$TEST_CHMOD_LOG"; then
        echo "An already matching file was unnecessarily chmodded" >&2
        exit 1
    fi
fi

"$real_chmod" 755 "$tree"
generate same > "$base/run.sh"
export TEST_CHMOD_FAIL=1
sh "$base/run.sh" > "$base/output"
unset TEST_CHMOD_FAIL
grep -q 'TAD_ADM_WARN step 1 chmod' "$base/output"
grep -q 'TAD_ADM_PROGRESS 2' "$base/output"

original_tree=$tree
tree="$base/missing tree"
generate same > "$base/run-missing.sh"
sh "$base/run-missing.sh" > "$base/output" 2> "$base/errors"
grep -q 'TAD_ADM_WARN step 1 chmod' "$base/output"
grep -q 'TAD_ADM_PROGRESS 2' "$base/output"
tree=$original_tree

"$real_chmod" 700 "$tree"
if [ "$(stat -c %a "$tree")" = 700 ]; then
    "$real_chmod" 700 "$tree/sub" "$tree/after" "$tree/sub/file with spaces"
    : > "$TEST_CHMOD_LOG"
    sh "$base/run.sh" > "$base/output"
    [ ! -s "$TEST_CHMOD_LOG" ]
    "$real_chmod" 644 "$tree/sub/file with spaces"
    sh "$base/run.sh" > "$base/output"
    [ "$(stat -c %a "$tree/sub/file with spaces")" = 700 ]
    "$real_chmod" 600 "$tree/sub"
    "$real_chmod" 644 "$tree/sub/file with spaces"
    sh "$base/run.sh" > "$base/output"
    [ "$(stat -c %a "$tree/sub")" = 700 ]
    [ "$(stat -c %a "$tree/sub/file with spaces")" = 700 ]
else
    echo "Filesystem does not expose POSIX chmod modes; mode assertions skipped."
fi

echo "Recursive SSH chmod traversal, warning, progress and mode tests passed."
