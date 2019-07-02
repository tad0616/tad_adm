<tr style="background: <{$mod.background}>;">
    <td>
        <div style="margin:4px 0px; font-size: 20pt; font-weight: bolder;">
            <{$mod.module_sn}>
        </div>
        <div style="margin:4px 0px; font-size: 12pt; font-weight: bolder;">
            <{$mod.kind}>
        </div>
    </td>
    <td>
        <img src="<{$mod.logo_thumb}>" alt="<{$mod.name}>" id="<{$mod.dirname}>_tip" style="width: 92px";>
    </td>
    <td>
        <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>" target="_blank" style="font-weight: bold; font-size: 12pt;"><{$mod.name}></a>

        <div style="margin:4px 0px; font-size: 12px; font-weight: normal;">
            <a href="<{$xoops_url}>/modules/<{$mod.dirname}>" target="_blank"><{$mod.dirname}> <{$mod.now_version}></a> <{$mod.last_update}>
        </div>

        <div style="margin:4px 0px; font-size: 12px; font-weight: normal;">
            <{if $mod.kind=="module" and $mod.function!="install"}>
                <a href="<{$xoops_url}>/modules/<{$mod.dirname}>/admin/index.php" target="_blank" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>"><i class="fa fa-wrench"></i>
                    <{$smarty.const._MA_TADADM_ADM_TPL}></a>

                <a href="<{$xoops_url}>/modules/system/admin.php?fct=preferences&op=showmod&mod=<{$mod.mid}>" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_PREF}>"><i class="fa fa-edit"></i>
                    <{$smarty.const._MA_TADADM_CONFIG}></a>

                <a href="<{$xoops_url}>/modules/system/admin.php?fct=modulesadmin&op=update&module=<{$mod.dirname}>&tad_adm_tpl=clean" title="<{$smarty.const._MA_TADADM_MODULES_UPDATING}><{$mod.dirname}>" class="modulesadmin" data-fancybox-type="iframe"><i class="fa fa-refresh" ></i>
                    <{$smarty.const._MA_TADADM_UPDATE}></a>

                <a href="<{$xoops_url}>/modules/<{$mod.dirname}>/admin/index.php" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_BLOCK}>" target="_blank"><i class="fa fa-th" ></i>
                    <{$smarty.const._MA_TADADM_BLOCK}></a>

            <{elseif $mod.kind=="theme"}>
                <{if $theme_set==$mod.dirname}>
                    <a href="#" class="btn btn-xs btn-primary"><{$smarty.const._MA_TADADM_DEFAULT_THEME}></a>
                <{elseif !$mod.is_link and $mod.function!="install" and !$inSchoolWeb}>
                    <a href="javascript:delete_theme('<{$mod.dirname}>')" title="<{$smarty.const._MA_TADADM_REMOVE}> <{$mod.dirname}>" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i> <{$smarty.const._MA_TADADM_REMOVE}>
                    </a>
                <{/if}>
            <{/if}>
        </div>
    </td>
    <td>
        <!-- <div><{$mod.status}>-<{$mod.function}></div> -->
        <{if $mod.function=='unable'}>
            <div style="font-size:11pt;line-height: 1.5;">
                <span style="color:rgb(156, 13, 13)"><{$mod.status}></span>
                <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" title="<{$mod.dirname}>">
                    <{$mod.name}>
                </a>
            </div>
        <{elseif $mod.function=='upgrade' or $mod.function=='latest'}>
            <a href="main.php?op=upgrade_<{$mod.kind}>&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="modulesadmin <{if $mod.function=='latest'}>latest_btn<{else}>update_btn<{/if}>"  data-fancybox-type="iframe" title="<{$mod.dirname}> <{$mod.now_version}> (<{$mod.last_update}>) to <{$mod.new_version}> (<{$mod.new_last_update}>)" style="">
                <{if $mod.function=='latest'}>
                    <{$mod.dirname}> <{$mod.now_version}> <{$smarty.const._MA_TADADM_MOD_LATEST}>
                <{else}>
                    <{$mod.dirname}> <{$mod.now_version}> <{$smarty.const._MA_TADADM_CAN_UPDATE_TO}> <{$mod.new_version}>
                <{/if}>
            </a>

        <{elseif $mod.function=='install'}>
            <a href="main.php?op=install_<{$mod.kind}>&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="modulesadmin install_btn" title="<{$mod.dirname}> <{$mod.now_version}> (<{$mod.last_update}>) to <{$mod.new_version}> (<{$mod.new_last_update}>)" data-fancybox-type="iframe">
                <{$smarty.const._MA_TADADM_MOD_INSTALL_MODULE}> <{$mod.name}>
            </a>
        <{/if}>

        <div style="margin:4px 0px; font-size: 11px; font-weight: normal;">
            <{$mod.dirname}> <{$mod.new_version}> <{$mod.new_last_update}>
        </div>
    </td>
    <td>
        <div style="height:100px; width: 100%; max-width:400px; overflow: auto; background: white; padding:6px;line-height: 1.5; border-radius: 5px; border: 1px solid gray"><{$mod.descript}></div>
    </td>
    <td nowrap>
        <{if isset($mod.fileowner.name)}>
            <{$mod.fileowner.name}>:<{$mod.filegroup.name}>
        <{/if}>
    </td>
    <td nowrap>
        <{if $mod.fileperms=='0777'}>
            <{$smarty.const._MA_TADADM_WRITABLE}>
        <{else}>
            <{$mod.fileperms}>
        <{/if}>
    </td>
</tr>