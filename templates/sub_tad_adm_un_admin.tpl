<table class="footable">
    <thead>
        <tr>
        <th nowrap><{$smarty.const._MA_TADADM_KIND}></th>
        <th data-class="expand"><{$smarty.const._MA_TADADM_MOD_NAME}></th>
        <th nowrap><{$smarty.const._TAD_FUNCTION}></th>
        <th nowrap data-hide="phone"><{$smarty.const._MA_TADADM_MOD_UPDATE_DESC}></th>
        <th nowrap data-hide="phone"><{$smarty.const._MA_TADADM_MOD_DIRNAME}></th>
        <th nowrap data-hide="phone"><{$smarty.const._MA_TADADM_MOD_FUNCTION}></th>
        <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_MOD_VERSION}></th>
        <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_MOD_LAST_UPDATE}></th>
        <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_MOD_NEW_VERSION}></th>
        <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_MOD_NEW_LAST_UPDATE}></th>
        <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_OWNER}></th>
        <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_PERMS}></th>
        </tr>
    </thead>
    <tbody>
        <{foreach from=$all_un_admin item=mod}>
            <tr>
                <td nowrap>
                <{if $mod.kind=="module"}>
                    <span class="label label-info"><{$smarty.const._MA_TADADM_MODULE}></span>
                <{elseif $mod.kind=="adm_tpl"}>
                    <span class="label label-success"><{$smarty.const._MA_TADADM_ADMTPL}></span>
                <{elseif $mod.kind=="theme"}>
                    <span class="label label-danger"><{$smarty.const._MA_TADADM_THEME}></span>
                <{elseif $mod.kind=="fix"}>
                    <span class="label label-warning"><{$smarty.const._MA_TADADM_FIX}></span>
                <{/if}>
                </td>
                <td><a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.name}></a></td>
                <td nowrap style="text-align:center;">
                <{if $mod.isactive=='0'}>
                    <a href="<{$xoops_url}>/modules/<{$mod.dirname}>" class="btn btn-xs btn-danger" target="_blank" alt="<{$smarty.const._MA_GUIDE_TO_MODULE}>" title="<{$smarty.const._MA_GUIDE_TO_MODULE}>"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                    <a href="main.php?op=update_module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="modulesadmin"  data-fancybox-type="iframe" style="color: #934949;"><{$smarty.const._MA_TADADM_MOD_CLOSED}></a>
                <{elseif $mod.function=='install'}>
                    <a href="main.php?op=install&kind=module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-primary modulesadmin" data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_INSTALL_MODULE}></a>
                <{elseif $mod.function=='update'}>
                    <a href="main.php?op=update&kind=module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-danger modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_UPDATE_MODULE}> <{$mod.new_version}></a>

                <{elseif $mod.function=='update_adm_tpl'}>
                    <a href="main.php?op=update&kind=adm_tpl&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-danger modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_UPDATE_ADMTPL}> <{$mod.new_version}></a>
                <{elseif $mod.function=='install_adm_tpl'}>
                    <a href="main.php?op=install&kind=adm_tpl&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-primary modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_INSTALL_ADMTPL}></a>

                <{elseif $mod.function=='update_theme'}>
                    <a href="main.php?op=update&kind=theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-danger modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_UPDATE_THEME}> <{$mod.new_version}></a>
                <{elseif $mod.function=='install_theme'}>
                    <a href="main.php?op=install&kind=theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-primary modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_INSTALL_THEME}></a>

                <{elseif $mod.function=='last_mod'}>
                    <a href="main.php?op=update&kind=module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_LATEST}></a>
                <{elseif $mod.function=='last_adm_tpl'}>
                    <a href="main.php?op=update&kind=adm_tpl&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" ><{$smarty.const._MA_TADADM_ADM_TPL_LATEST}></a>
                <{elseif $mod.function=='last_theme'}>
                    <a href="main.php?op=update&kind=theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" ><{$smarty.const._MA_TADADM_MOD_LATEST}></a>
                <{elseif $mod.new_last_update}>
                    <{$smarty.const._MA_TADADM_MOD_LATEST}>
                <{/if}>
                </td>
                <td nowrap style="text-align:center;">
                <{if $mod.descript}>
                    <a id="view_well<{$mod.module_sn}>" class="btn btn-xs btn-success" href="javascript:alert('<{$mod.descript}>')"><{if $mod.version}><{$smarty.const._MA_TADADM_MOD_UPDATE_DESC}><{else}><{$smarty.const._MA_TADADM_MOD_ABOUT_MOD}><{/if}></a>
                <{/if}>
                </td>

                <td nowrap>
                <{if $mod.version}>
                    <a href="<{$xoops_url}>/modules/<{$mod.dirname}>/admin/index.php" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>" target="_blank"><{$mod.dirname}></a>
                <{else}>
                    <{$mod.dirname}>
                <{/if}>
                </td>
                <td nowrap>
                <{if $mod.version}>
                    <a href="<{$xoops_url}>/modules/system/admin.php?fct=blocksadmin&op=list&filter=1&selgen=<{$mod.mid}>&selmod=-2&selgrp=-1&selvis=-1" target="_blank"><{$smarty.const._MA_TADADM_MOD_BLOCK}></a>
                <{/if}>
                </td>
                <td nowrap><{$mod.version}></td>
                <td nowrap><{$mod.last_update}></td>
                <td nowrap><{$mod.new_version}></td>
                <td nowrap><{$mod.new_last_update}></td>
                <td nowrap style="text-align: center;"><{$mod.fileowner.name}>:<{$mod.filegroup.name}></td>
                <td nowrap><{$mod.fileperms}></td>

            </tr>
        <{/foreach}>
    </tbody>
</table>