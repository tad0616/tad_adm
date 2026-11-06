<h2><{$smarty.const._MA_TADADM_SSH_ID}></h2>
<div class="well card card-body bg-light m-1 d-flex align-items-stretch">
    <form action="<{$action|default:''}>" method="post" class="form-horizontal" role="form">
        <div class="form-group row mb-3">
            <label class="col-md-2 col-form-label text-md-right text-md-end control-label">
            <{$smarty.const._MA_TADADM_SSH_ID}><{$smarty.const._TAD_FOR}>
            </label>
            <div class="col-md-10">
            <input type="text" name="ssh_id" placeholder="<{$smarty.const._MA_TADADM_SSH_ID}>" class="form-control" value="<{$tad_adm_ssh_id|default:''}>">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-2 col-form-label text-md-right text-md-end control-label">
            <{$smarty.const._MA_TADADM_SSH_PASS}><{$smarty.const._TAD_FOR}>
            </label>
            <div class="col-md-10">
            <input type="password" name="ssh_passwd" placeholder="<{$smarty.const._MA_TADADM_SSH_PASS}>" class="form-control" value="<{$tad_adm_ssh_passwd|default:''}>">
            </div>
        </div>


        <div class="text-center">
            <input type="hidden" name="ssh_host" value="127.0.0.1" >
            <input type="hidden" name="file_link" value="<{$file_link|default:''}>">
            <input type="hidden" name="dirname" value="<{$dirname|default:''}>">
            <input type="hidden" name="act" value="<{$act|default:''}>">
            <input type="hidden" name="update_sn" value="<{$update_sn|default:''}>">
            <input type="hidden" name="module_sn" value="<{$module_sn|default:''}>">
            <input type="hidden" name="xoops_sn" value="<{$xoops_sn|default:''}>">
            <{if $action|default:'' == 'xoops.php' && $act|default:'' == 'upgrade'}>
                <input type="hidden" name="upgrade_progress_token" value="<{$upgrade_progress_token|default:''|escape:'html'}>">
            <{/if}>
            <input type="hidden" name="tad_adm_tpl" value="clean">
            <input type="hidden" name="op" value="ssh_login">
            <button type="submit" class="btn btn-primary"><{$smarty.const._MA_TADADM_LOGIN}>SSH</button>
        </div>
    </form>
</div>
<{if $ssh_preflight_message|default:''}>
    <div class="alert alert-warning"><{$ssh_preflight_message}></div>
<{/if}>
<{if $action|default:'' == 'xoops.php' && $act|default:'' == 'upgrade'}>
    <div id="ssh-upgrade-progress" class="alert alert-info" role="status" aria-live="polite" hidden
         data-progress-error="<{$smarty.const._MA_TADADM_PROGRESS_UNAVAILABLE|escape:'html'}>"></div>
    <script src="<{$xoops_url}>/modules/tad_adm/js/xoops_upgrade_progress.js"></script>
    <script>
        $(function() {
            $('form input[name="upgrade_progress_token"]').closest('form').on('submit', function() {
                var tokenInput = this.elements.upgrade_progress_token;
                if (!tokenInput.value) {
                    tokenInput.value = window.tadAdmUpgradeProgress.token();
                }
                var status = document.getElementById('ssh-upgrade-progress');
                status.hidden = false;
                status.textContent = '<{$smarty.const._MA_TADADM_XOOPS_UPGRADE_WAIT}>';
                if (tokenInput.value) {
                    window.tadAdmUpgradeProgress.start(status, tokenInput.value, 'upgrade_progress.php');
                }
            });
        });
    </script>
<{/if}>