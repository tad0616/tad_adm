<div class="container-fluid">
    <{if $now_op|default:''=="login_form"}>
        <{include file="$xoops_rootpath/modules/tad_adm/templates/sub_ssh_login_form.tpl"}>
    <{elseif $now_op|default:''=="upgrade_handoff"}>
        <div class="alert alert-info"><{$upgrade_handoff_message|escape:'html'}></div>
        <{if $upgrade_handoff_warning|default:''}>
            <div class="alert alert-warning"><{$upgrade_handoff_warning}></div>
        <{/if}>
        <{if $upgrade_handoff_session_error|default:''}>
            <div class="alert alert-danger"><{$upgrade_handoff_session_error|escape:'html'}></div>
        <{/if}>
        <a id="tad-adm-upgrade-handoff" class="btn btn-primary" href="<{$upgrade_handoff_url|escape:'html'}>" target="_top"><{$smarty.const._MA_TADADM_UPGRADE_OPEN}></a>
        <{if $upgrade_handoff_delay|default:0 > 0}>
            <script>
                window.setTimeout(function() {
                    document.getElementById('tad-adm-upgrade-handoff').click();
                }, <{$upgrade_handoff_delay}> * 1000);
            </script>
        <{/if}>
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
        <script src="<{$xoops_url}>/modules/tad_adm/js/xoops_upgrade_progress.js"></script>
        <script>
            $(function() {
                var stopProgress;
                var token;
                document.addEventListener('click', function(event) {
                    var link = event.target.closest('a.modulesadmin[href*="op=upgrade_xoops"]:not(.disabled)');
                    if (!link || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) {
                        return;
                    }
                    token = window.tadAdmUpgradeProgress.token();
                    var url = new URL(link.href, window.location.href);
                    if (token) {
                        url.searchParams.set('upgrade_progress_token', token);
                    } else {
                        url.searchParams.delete('upgrade_progress_token');
                    }
                    link.href = url.toString();
                    $('body').addClass('tad-adm-xoops-upgrade-loading');
                }, true);

                $(document).on('onLoading.tadAdmXoopsUpgrade', function() {
                    if (!$('body').hasClass('tad-adm-xoops-upgrade-loading')) {
                        return;
                    }
                    var status = $('<div class="tad-adm-progress" role="status" aria-live="polite"></div>')
                        .text('<{$smarty.const._MA_TADADM_XOOPS_UPGRADE_WAIT}>')
                        .attr('data-progress-error', '<{$smarty.const._MA_TADADM_PROGRESS_UNAVAILABLE}>');
                    $('#fancybox-loading').append(status);
                    if (token) {
                        stopProgress = window.tadAdmUpgradeProgress.start(status[0], token, 'upgrade_progress.php');
                    }
                });

                $(document).on('afterShow.tadAdmXoopsUpgrade afterClose.tadAdmXoopsUpgrade onCancel.tadAdmXoopsUpgrade', function() {
                    if (stopProgress) {
                        stopProgress();
                        stopProgress = null;
                    }
                    $('body').removeClass('tad-adm-xoops-upgrade-loading');
                });
            });
        </script>
        <style>
            body.tad-adm-xoops-upgrade-loading #fancybox-loading {
                width: auto;
                height: auto;
                margin: 0;
                background: none;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }

            body.tad-adm-xoops-upgrade-loading #fancybox-loading > div:not(.tad-adm-progress) {
                display: none;
            }

            body.tad-adm-xoops-upgrade-loading #fancybox-loading .tad-adm-progress {
                display: block;
                width: auto;
                height: auto;
                padding: 1rem 1.5rem;
                border: 1px solid #ccc;
                border-radius: 0.4rem;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
                color: #333;
                font-size: 1rem;
                min-width: 20rem;
                max-width: 80vw;
                overflow-wrap: anywhere;
            }
        </style>
    <{/if}>
</div>

<script>
    $( function() {
        $( "#admTab1" ).tabs();
    } );
</script>