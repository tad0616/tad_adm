<div class="container-fluid">
    <{if $now_op=="login_form"}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_ssh_login_form.tpl"}>
    <{else}>
        <div id="admTab1">
            <ul>
                <{if $all_patch.patch}><li><a href="#tabs1"><{$smarty.const._MA_TADADM_PATCH_XOOPS_ITEMS}></a></li><{/if}>
                <{if $all_patch.upgrade}><li><a href="#tabs2"><{$smarty.const._MA_TADADM_UPGRADE_XOOPS_ITEMS}></a></li><{/if}>
            </ul>

            <{if $all_patch.patch}>
                <div id="tabs1" >
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
                <div id="tabs2" >
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

    <{/if}>
</div>


<{$FooTableJS}>
<{$fancybox_code}>
<{$jquery}>
<script>
    $( function() {
        $( "#admTab1" ).tabs();
    } );
</script>