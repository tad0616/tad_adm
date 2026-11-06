<div class="container-fluid">
    <{if $now_op|default:''=="login_form"}>
        <{include file="$xoops_rootpath/modules/tad_adm/templates/sub_ssh_login_form.tpl"}>
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
        <script>
            $(function() {
                $('a.modulesadmin[href*="op=upgrade_xoops"]:not(.disabled)').on('click', function() {
                    $('body').addClass('tad-adm-xoops-upgrade-loading');
                });

                $(document).on('afterShow.tadAdmXoopsUpgrade afterClose.tadAdmXoopsUpgrade', function() {
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

            body.tad-adm-xoops-upgrade-loading #fancybox-loading div {
                display: none;
            }

            body.tad-adm-xoops-upgrade-loading #fancybox-loading::after {
                content: "<{$smarty.const._MA_TADADM_XOOPS_UPGRADE_WAIT}>";
                display: block;
                padding: 1rem 1.5rem;
                border: 1px solid #ccc;
                border-radius: 0.4rem;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
                color: #333;
                font-size: 1rem;
                white-space: nowrap;
            }
        </style>
    <{/if}>
</div>

<script>
    $( function() {
        $( "#admTab1" ).tabs();
    } );
</script>