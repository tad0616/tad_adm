<tr id="<{$mod.dirname|default:''|escape:'html'}>" style="background: <{$mod.background|default:''|escape:'html'}>;">
    <td>
        <div style="margin:4px 0px; font-size: 1.67rem; font-weight: bolder;">
            <{$mod.xoops_sn|default:''|escape:'html'}>
        </div>
        <div style="margin:4px 0px; font-size: 1rem; font-weight: bolder;">
            <{$mod.xoops_type|default:''|escape:'html'}>
        </div>
    </td>
    <td>
        <a href="<{$source|default:''|escape:'html'}>/modules/tad_modules/xoops.php?xoops_sn=<{$mod.xoops_sn|default:''|escape:'url'}>" title="<{$mod.xoops_title|default:''|escape:'html'}>" target="_blank" style="font-weight: bold; font-size: 1rem;"><{$mod.xoops_title|default:''|escape:'html'}></a>


        <div style="margin:4px 0px; font-size: 0.6875rem; font-weight: normal;">
            <{$mod.xoops_date|default:''|escape:'html'}>
        </div>

        <div style="margin:4px 0px; font-size: 0.75rem; font-weight: normal;">
            <{if $mod.xoops_type|default:''=="module" and $mod.function|default:''!="install"}>

            <{elseif $mod.xoops_type|default:''=="theme"}>

            <{/if}>
        </div>
    </td>
    <td>
        <!-- <div><{$mod.status|default:''|escape:'html'}>-<{$mod.function|default:''|escape:'html'}></div> -->
        <{if $mod.function|default:''=='unable'}>
            <{if $mod.status|default:''== $smarty.const._MA_TADADM_PATCH_INSTALLED}>
                <a href="xoops.php?op=<{$mod.xoops_type|default:''|escape:'url'}>_xoops&amp;file_link=<{$mod.file_link|default:''|escape:'url'}>&amp;xoops_sn=<{$mod.xoops_sn|default:''|escape:'url'}>&amp;tad_adm_tpl=clean" class="modulesadmin latest_btn"  data-type="external">
                    <{$smarty.const._MA_TADADM_PATCH_INSTALLED}>
                </a>
            <{else}>
                <div style="font-size: 0.92rem;line-height: 1.5;">
                    <span style="color:rgb(156, 13, 13)"><{$mod.status|default:''|escape:'html'}></span>
                </div>
            <{/if}>
        <{elseif $mod.function|default:''=='upgrade' or $mod.function|default:''=='latest'}>
            <a href="xoops.php?op=<{$mod.xoops_type|default:''|escape:'url'}>_xoops&amp;file_link=<{$mod.file_link|default:''|escape:'url'}>&amp;xoops_sn=<{$mod.xoops_sn|default:''|escape:'url'}>&amp;tad_adm_tpl=clean" class="modulesadmin <{if $mod.function=='latest'}>latest_btn<{else}>install_btn<{/if}>"  data-type="external" >
                <{if $mod.function=='latest'}>
                    <{$smarty.const._MA_TADADM_MOD_LATEST}>
                <{else}>
                    <{$smarty.const._MA_TADADM_UPGRADE_XOOPS}> <{$mod.xoops_title|default:''|escape:'html'}>
                <{/if}>
            </a>
        <{/if}>

        <div style="margin:4px 0px; font-size: 0.6875rem; font-weight: normal;">
            <{$mod.new_version|default:''|escape:'html'}> <{$mod.new_xoops_date|default:''|escape:'html'}>
        </div>
    </td>
    <td>
        <div style="height:100px; width: 400px; overflow: auto; background: white; padding:6px;line-height: 1.5; border-radius: 5px; border: 1px solid gray"><{$mod.xoops_install|default:''}></div>
    </td>
    <td>
        <div style="height:100px; width: 400px; overflow: auto; background: white; padding:6px;line-height: 1.5; border-radius: 5px; border: 1px solid gray"><{$mod.xoops_update|default:''}></div>
    </td>
</tr>