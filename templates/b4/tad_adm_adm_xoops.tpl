<div class="container-fluid">
    <{if $now_op=="login_form"}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_ssh_login_form.tpl"}>
    <{else}>
        <style type="text/css" media="screen">
        .footable th{
            color: #000;
        }
        </style>

        <div id="admTab">
            <ul class="resp-tabs-list vert">
                <{if $xoops_patch}><li><{$smarty.const._MA_TADADM_PATCH_XOOPS_ITEMS}></li><{/if}>
                <{if $xoops_upgrade}><li><{$smarty.const._MA_TADADM_UPGRADE_XOOPS_ITEMS}></li><{/if}>
            </ul>
        
            <div class="resp-tabs-container vert">    
                <{if $xoops_patch}>
                    <div>
                        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_xoops_patch.tpl"}>
                    </div>
                <{/if}>            
                <{if $xoops_upgrade}>
                    <div>
                        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_xoops_upgrade.tpl"}>
                    </div>
                <{/if}>
            </div>
        </div>
    <{/if}>
</div>

