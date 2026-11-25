<div class="container-fluid">
    <{if $now_op|default:''=="login_form"}>
        <{include file="$xoops_rootpath/modules/tad_adm/templates/sub_ssh_login_form.tpl"}>
    <{elseif $now_op|default:''=="upgrade_handoff"}>
      <div id="tad-adm-upgrade-handoff-content">
        <div class="alert alert-info"><{$upgrade_handoff_message|default:''|escape:'html'}></div>
        <{if $upgrade_handoff_warning|default:''}>
            <div class="alert alert-warning"><{$upgrade_handoff_warning}></div>
        <{/if}>
        <{if $upgrade_handoff_session_error|default:''}>
            <div class="alert alert-danger"><{$upgrade_handoff_session_error|escape:'html'}></div>
        <{/if}>
        <a id="tad-adm-upgrade-handoff" class="btn btn-primary" href="<{$upgrade_handoff_url|default:''|escape:'html'}>" target="_top"><{$smarty.const._MA_TADADM_UPGRADE_OPEN}></a>
        <{if $upgrade_handoff_delay|default:0 > 0}>
            <script>
                window.setTimeout(function() {
                    document.getElementById('tad-adm-upgrade-handoff').click();
                }, <{$upgrade_handoff_delay|default:0}> * 1000);
            </script>
        <{/if}>
      </div>
    <{else}>
        <div id="xoopsTab">
            <ul class="resp-tabs-list vert">
                <{if $all_patch.patch|default:false}><li><{$smarty.const._MA_TADADM_PATCH_XOOPS_ITEMS}></li><{/if}>
                <{if $all_patch.upgrade|default:false}><li><{$smarty.const._MA_TADADM_UPGRADE_XOOPS_ITEMS}></li><{/if}>
            </ul>
            <div class="resp-tabs-container vert">
                <{if $all_patch.patch|default:false}>
                    <div>
                        <{foreach from=$all_patch.patch key=fun item=items}>
                                <table class="footable">
                                <{include file="$xoops_rootpath/modules/tad_adm/templates/sub_patch_thead.tpl"}>
                                <{foreach from=$items item=mod}>
                                    <{include file="$xoops_rootpath/modules/tad_adm/templates/sub_patch_list.tpl"}>
                                <{/foreach}>
                                </table>
                        <{/foreach}>
                    </div>
                <{/if}>

                <{if $all_patch.upgrade|default:false}>
                    <div>
                        <{foreach from=$all_patch.upgrade key=fun item=items}>
                                <table class="footable">
                                <{include file="$xoops_rootpath/modules/tad_adm/templates/sub_patch_thead.tpl"}>
                                <{foreach from=$items item=mod}>
                                    <{include file="$xoops_rootpath/modules/tad_adm/templates/sub_patch_list.tpl"}>
                                <{/foreach}>
                                </table>
                        <{/foreach}>
                    </div>
                <{/if}>
            </div>
        </div>
        <script src="<{$xoops_url}>/modules/tad_adm/js/xoops_upgrade_progress.js?v=2026112501"></script>
        <script>
            $(function() {
                var stopProgress = null;
                var progressOverlay = null;
                var modalObserver = null;

                function cleanupProgress() {
                    if (stopProgress) {
                        stopProgress();
                        stopProgress = null;
                    }
                    if (modalObserver) {
                        modalObserver.disconnect();
                        modalObserver = null;
                    }
                    if (progressOverlay) {
                        progressOverlay.remove();
                        progressOverlay = null;
                    }
                    $('body').removeClass('tad-adm-xoops-upgrade-loading');
                }

                function showProgress(token) {
                    cleanupProgress();
                    $('body').addClass('tad-adm-xoops-upgrade-loading');
                    progressOverlay = $('<div id="tad-adm-xoops-progress-overlay"></div>');
                    var status = $('<div class="tad-adm-progress" role="status" aria-live="polite"></div>')
                        .text('<{$smarty.const._MA_TADADM_XOOPS_UPGRADE_WAIT|escape:"javascript"}>')
                        .attr({
                            'data-progress-error': '<{$smarty.const._MA_TADADM_PROGRESS_UNAVAILABLE|escape:"javascript"}>',
                            'data-progress-steps': '<{$smarty.const._MA_TADADM_PROGRESS_STEPS|escape:"javascript"}>',
                            'data-progress-position': '<{$smarty.const._MA_TADADM_PROGRESS_POSITION|escape:"javascript"}>',
                            'data-progress-elapsed': '<{$smarty.const._MA_TADADM_PROGRESS_ELAPSED|escape:"javascript"}>',
                            'data-progress-limit': '<{$smarty.const._MA_TADADM_PROGRESS_PHP_LIMIT|escape:"javascript"}>',
                            'data-progress-unlimited': '<{$smarty.const._MA_TADADM_PROGRESS_PHP_UNLIMITED|escape:"javascript"}>',
                            'data-progress-limit-unavailable': '<{$smarty.const._MA_TADADM_PROGRESS_PHP_LIMIT_UNAVAILABLE|escape:"javascript"}>'
                        });
                    progressOverlay.append(status);
                    $('body').append(progressOverlay);
                    if (token && window.tadAdmUpgradeProgress) {
                        stopProgress = window.tadAdmUpgradeProgress.start(status[0], token, 'upgrade_progress.php');
                    }

                    if (typeof window.MutationObserver === 'function') {
                        var modalSeen = false;
                        modalObserver = new window.MutationObserver(function() {
                            var modal = document.getElementById('glightbox-body');
                            if (modal) {
                                modalSeen = true;
                                var frame = modal.querySelector('iframe');
                                if (frame && frame.dataset.tadAdmProgressBound !== '1') {
                                    frame.dataset.tadAdmProgressBound = '1';
                                    frame.addEventListener('load', function() {
                                        cleanupProgress();
                                    });
                                }
                            } else if (modalSeen) {
                                cleanupProgress();
                            }
                        });
                        modalObserver.observe(document.body, { childList: true, subtree: true });
                    }
                }

                document.addEventListener('click', function(event) {
                    var link = event.target.closest('a.modulesadmin[href*="op=upgrade_xoops"]:not(.disabled)');
                    if (!link || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) {
                        return;
                    }
                    var token = window.tadAdmUpgradeProgress ? window.tadAdmUpgradeProgress.token() : '';
                    var url = new URL(link.href, window.location.href);
                    if (token) {
                        url.searchParams.set('upgrade_progress_token', token);
                    } else {
                        url.searchParams.delete('upgrade_progress_token');
                    }
                    link.href = url.toString();
                    showProgress(token);
                }, true);
            });
        </script>
        <style>
            #tad-adm-xoops-progress-overlay {
                position: fixed;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                z-index: 1000000;
                max-height: calc(100vh - 2rem);
                overflow-y: auto;
                background: #fff;
                border-radius: 0.4rem;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
            }

            #tad-adm-xoops-progress-overlay .tad-adm-progress-steps,
            #tad-adm-xoops-progress-overlay .tad-adm-progress-steps div {
                width: auto;
                height: auto;
                background: #fff;
            }

            #tad-adm-xoops-progress-overlay .tad-adm-progress {
                display: block;
                width: auto;
                height: auto;
                padding: 1rem 1.5rem;
                border: 1px solid #ccc;
                border-radius: 0.4rem;
                background: #fff;
                color: #333;
                font-size: 1rem;
                min-width: min(20rem, 80vw);
                max-width: 80vw;
                overflow-wrap: anywhere;
            }

            #tad-adm-xoops-progress-overlay .tad-adm-progress-timer {
                display: block;
                width: auto;
                height: auto;
                margin: 0;
                padding: 0.5rem 1.5rem;
                color: #555;
                font-size: 0.875rem;
                min-width: min(20rem, 80vw);
                max-width: 80vw;
            }
        </style>
    <{/if}>
</div>