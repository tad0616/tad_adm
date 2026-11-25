<tr id="<{$mod.dirname|default:''|escape:'html'}>" style="background: <{$mod.background|default:''|escape:'html'}>;">
    <td>
        <div style="margin:4px 0px; font-size: 1.67rem; font-weight: bolder;">
            <{$mod.module_sn|default:''|escape:'html'}>
        </div>
        <div style="margin:4px 0px; font-size: 1rem; font-weight: bolder;">
            <{$mod.kind|default:''|escape:'html'}>
        </div>
    </td>
    <td>
        <img src="<{$mod.logo_thumb|default:''|escape:'html'}>" alt="<{$mod.name|default:''|escape:'html'}>" id="<{$mod.dirname|default:''|escape:'html'}>_tip" style="width: 92px;">
    </td>
    <td>
        <a href="<{$source|default:''|escape:'html'}>/modules/tad_modules/index.php?module_sn=<{$mod.module_sn|default:''|escape:'url'}>" title="<{$mod.dirname|default:''|escape:'html'}><{$smarty.const._MA_TADADM_MOD_ADMIN|escape:'html'}>" target="_blank" style="font-weight: bold; font-size: 1rem;"><{$mod.name|default:''|escape:'html'}></a>

        <div style="margin:4px 0px; font-size: 0.75rem; font-weight: normal;">
            <a href="<{$xoops_url|escape:'html'}>/modules/<{$mod.dirname|default:''|escape:'url'}>" target="_blank"><{$mod.dirname|default:''|escape:'html'}> <{$mod.now_version|default:''|escape:'html'}></a> <{$mod.last_update|default:''|escape:'html'}>
        </div>

        <div style="margin:4px 0px; font-size: 0.75rem; font-weight: normal;">
            <{if $mod.kind|default:''=="module" and $mod.function|default:''!="install"}>
                <a href="<{$xoops_url|escape:'html'}>/modules/<{$mod.dirname|default:''|escape:'url'}>/admin/index.php" target="_blank" title="<{$mod.dirname|default:''|escape:'html'}><{$smarty.const._MA_TADADM_MOD_ADMIN|escape:'html'}>"><i class="fa fa-wrench"></i>
                    <{$smarty.const._MA_TADADM_ADM_TPL}></a>

                <a href="<{$xoops_url|escape:'html'}>/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=<{$mod.mid|default:''|escape:'url'}>" title="<{$mod.dirname|default:''|escape:'html'}><{$smarty.const._MA_TADADM_MOD_PREF|escape:'html'}>"><i class="fa fa-edit"></i>
                    <{$smarty.const._MA_TADADM_CONFIG}></a>

                <a href="<{$xoops_url|escape:'html'}>/modules/system/admin.php?fct=modulesadmin&amp;op=update&amp;module=<{$mod.dirname|default:''|escape:'url'}>&amp;tad_adm_tpl=clean" title="<{$smarty.const._MA_TADADM_MODULES_UPDATING|escape:'html'}><{$mod.dirname|default:''|escape:'html'}>" class="modulesadmin" data-fancybox-type="iframe"><i class="fa fa-refresh" ></i>
                    <{$smarty.const._MA_TADADM_UPDATE}></a>

                <a href="<{$xoops_url|escape:'html'}>/modules/<{$mod.dirname|default:''|escape:'url'}>/admin/index.php" title="<{$mod.dirname|default:''|escape:'html'}><{$smarty.const._MA_TADADM_MOD_BLOCK|escape:'html'}>" target="_blank"><i class="fa fa-th" ></i>
                    <{$smarty.const._MA_TADADM_BLOCK}></a>

            <{elseif $mod.kind|default:''=="theme"}>
                <{if $theme_set|default:''==$mod.dirname|default:''}>
                    <a href="#" class="btn btn-xs btn-primary"><{$smarty.const._MA_TADADM_DEFAULT_THEME}></a>
                <{elseif !$mod.is_link|default:false and $mod.function|default:''!="install" and !$inSchoolWeb|default:false}>
                    <a href="main.php?op=delete_theme&amp;dirname=<{$mod.dirname|default:''|escape:'url'}>&amp;tad_adm_tpl=clean"
                       title="<{$smarty.const._MA_TADADM_REMOVE|escape:'html'}> <{$mod.dirname|default:''|escape:'html'}>"
                       data-dirname="<{$mod.dirname|default:''|escape:'html'}>"
                       data-token="<{$token|default:''|escape:'html'}>"
                       data-confirm-title="<{$smarty.const._TAD_DEL_CONFIRM_TITLE|escape:'html'}>"
                       data-confirm-text="<{$smarty.const._TAD_DEL_CONFIRM_TEXT|escape:'html'}>"
                       data-confirm-button="<{$smarty.const._TAD_DEL_CONFIRM_BTN|escape:'html'}>"
                       class="btn btn-xs btn-danger delete-theme">
                        <i class="fa fa-times"></i> <{$smarty.const._MA_TADADM_REMOVE}>
                    </a>
                <{/if}>
            <{/if}>
        </div>
    </td>
    <td>
        <!-- <div><{$mod.status|default:''|escape:'html'}>-<{$mod.function|default:''|escape:'html'}></div> -->
        <{if $mod.function|default:''=='unable'}>
            <div style="font-size: 0.92rem;line-height: 1.5;">
                <span style="color:rgb(156, 13, 13)"><{$mod.status|default:''|escape:'html'}></span>
                <a href="<{$source|default:''|escape:'html'}>/modules/tad_modules/index.php?module_sn=<{$mod.module_sn|default:''|escape:'url'}>" title="<{$mod.dirname|default:''|escape:'html'}>">
                    <{$mod.name|default:''|escape:'html'}>
                </a>
            </div>
        <{elseif $mod.function|default:''=='upgrade' or $mod.function|default:''=='latest'}>
            <a href="main.php?op=upgrade_<{$mod.kind|default:''|escape:'url'}>&amp;dirname=<{$mod.dirname|default:''|escape:'url'}>&amp;file_link=<{$mod.file_link|default:''|escape:'url'}>&amp;update_sn=<{$mod.update_sn|default:''|escape:'url'}>&amp;module_sn=<{$mod.module_sn|default:''|escape:'url'}>&amp;tad_adm_tpl=clean" class="modulesadmin <{if $mod.function=='latest'}>latest_btn<{else}>update_btn<{/if}>"  data-fancybox-type="iframe" title="<{$mod.dirname|default:''|escape:'html'}> <{$mod.now_version|default:''|escape:'html'}> (<{$mod.last_update|default:''|escape:'html'}>) to <{$mod.new_version|default:''|escape:'html'}> (<{$mod.new_last_update|default:''|escape:'html'}>) <{$mod.function|default:''|escape:'html'}>" style="">
                <{if $mod.function=='latest'}>
                    <{$mod.dirname|default:''|escape:'html'}> <{$mod.now_version|default:''|escape:'html'}> <{$smarty.const._MA_TADADM_MOD_LATEST}>
                <{else}>
                    <{$mod.dirname|default:''|escape:'html'}> <{$mod.now_version|default:''|escape:'html'}> <{$smarty.const._MA_TADADM_CAN_UPDATE_TO}> <{$mod.new_version|default:''|escape:'html'}>
                <{/if}>
            </a>

        <{elseif $mod.function|default:''=='install'}>
            <a href="main.php?op=install_<{$mod.kind|default:''|escape:'url'}>&amp;dirname=<{$mod.dirname|default:''|escape:'url'}>&amp;file_link=<{$mod.file_link|default:''|escape:'url'}>&amp;update_sn=<{$mod.update_sn|default:''|escape:'url'}>&amp;module_sn=<{$mod.module_sn|default:''|escape:'url'}>&amp;tad_adm_tpl=clean" class="modulesadmin install_btn" title="<{$mod.dirname|default:''|escape:'html'}> <{$mod.now_version|default:''|escape:'html'}> (<{$mod.last_update|default:''|escape:'html'}>) to <{$mod.new_version|default:''|escape:'html'}> (<{$mod.new_last_update|default:''|escape:'html'}>)" data-fancybox-type="iframe">
                <{$smarty.const._MA_TADADM_MOD_INSTALL_MODULE}> <{$mod.name|default:''|escape:'html'}>
            </a>
        <{/if}>

        <div style="margin:4px 0px; font-size: 0.6875rem; font-weight: normal;">
            <{$mod.dirname|default:''|escape:'html'}> <{$mod.new_version|default:''|escape:'html'}> <{$mod.new_last_update|default:''|escape:'html'}>
        </div>
    </td>
    <td>
        <div style="height:100px; width: 100%; max-width:400px; overflow: auto; background: white; padding:6px;line-height: 1.5; border-radius: 5px; border: 1px solid gray"><{$mod.descript|default:''}></div>
    </td>
    <td nowrap>
        <{if $mod.fileowner|default:''}>
            <{$mod.fileowner|escape:'html'}><{if $mod.filegroup|default:''}>:<{$mod.filegroup|escape:'html'}><{/if}>
        <{/if}>
    </td>
    <td nowrap>
        <{if $mod.fileperms|default:''=='0777'}>
            <{$smarty.const._MA_TADADM_WRITABLE}>
        <{else}>
            <{$mod.fileperms|default:''|escape:'html'}>
        <{/if}>
    </td>
</tr>