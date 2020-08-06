<div class="container-fluid">
    <{if $now_op=="login_form"}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_ssh_login_form.tpl"}>
    <{else}>
        <div id="xoopsTab">
            <ul class="resp-tabs-list vert">
                <{if $all_patch.patch}><li><{$smarty.const._MA_TADADM_PATCH_XOOPS_ITEMS}></li><{/if}>
                <{if $all_patch.upgrade}><li><{$smarty.const._MA_TADADM_UPGRADE_XOOPS_ITEMS}></li><{/if}>
            </ul>
            <div class="resp-tabs-container vert">
                <{if $all_patch.patch}>
                    <div>
                        <{foreach from=$all_patch.patch key=fun item=items}>
                                <h2 class="mod_head"><{$fun}></h2>
                                <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_patch_thead.tpl"}>
                                <{foreach from=$items item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_patch_list.tpl"}>
                                <{/foreach}>
                                </table>
                        <{/foreach}>
                    </div>
                <{/if}>

                <{if $all_patch.upgrade}>
                    <div>
                        <{foreach from=$all_patch.upgrade key=fun item=items}>
                                <h2 class="mod_head"><{$fun}></h2>
                                <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_patch_thead.tpl"}>
                                <{foreach from=$items item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_patch_list.tpl"}>
                                <{/foreach}>
                                </table>
                        <{/foreach}>
                    </div>
                <{/if}>
            </div>
        </div>
    <{/if}>
</div>

<script>
    $( function() {
        $( "#admTab1" ).tabs();
    } );
</script>