<tr id="<{$mod.dirname}>" style="background: <{$mod.background}>;">
    <td>
        <div style="margin:4px 0px; font-size: 1.67rem; font-weight: bolder;">
            <{$mod.xoops_sn}>
        </div>
        <div style="margin:4px 0px; font-size: 1rem; font-weight: bolder;">
            <{$mod.xoops_type}>
        </div>
    </td>
    <td>
        <a href="<{$source}>/modules/tad_modules/xoops.php?xoops_sn=<{$mod.xoops_sn}>" title="<{$mod.xoops_title}>" target="_blank" style="font-weight: bold; font-size: 1rem;"><{$mod.xoops_title}></a>


        <div style="margin:4px 0px; font-size: 0.6875rem; font-weight: normal;">
            <{$mod.xoops_date}>
        </div>

        <div style="margin:4px 0px; font-size: 0.75rem; font-weight: normal;">
            <{if $mod.xoops_type=="module" and $mod.function!="install"}>

            <{elseif $mod.xoops_type=="theme"}>

            <{/if}>
        </div>
    </td>
    <td>
        <!-- <div><{$mod.status}>-<{$mod.function}></div> -->
        <{if $mod.function=='unable'}>
            <{if $mod.status== $smarty.const._MA_TADADM_PATCH_INSTALLED}>
                <a href="xoops.php?op=<{$mod.xoops_type}>_xoops&file_link=<{$mod.file_link}>&xoops_sn=<{$mod.xoops_sn}>&tad_adm_tpl=clean" class="modulesadmin latest_btn"  data-fancybox-type="iframe">
                    <{$smarty.const._MA_TADADM_PATCH_INSTALLED}>
                </a>
            <{else}>
                <div style="font-size: 0.92rem;line-height: 1.5;">
                    <span style="color:rgb(156, 13, 13)"><{$mod.status}></span>
                </div>
            <{/if}>
        <{elseif $mod.function=='upgrade' or $mod.function=='latest'}>
            <a href="xoops.php?op=<{$mod.xoops_type}>_xoops&file_link=<{$mod.file_link}>&xoops_sn=<{$mod.xoops_sn}>&tad_adm_tpl=clean" class="modulesadmin <{if $mod.function=='latest'}>latest_btn<{else}>install_btn<{/if}>"  data-fancybox-type="iframe" >
                <{if $mod.function=='latest'}>
                    <{$smarty.const._MA_TADADM_MOD_LATEST}>
                <{else}>
                    <{$smarty.const._MA_TADADM_UPGRADE_XOOPS}> <{$mod.xoops_title}>
                <{/if}>
            </a>
        <{/if}>

        <div style="margin:4px 0px; font-size: 0.6875rem; font-weight: normal;">
            <{$mod.new_version}> <{$mod.new_xoops_date}>
        </div>
    </td>
    <td>
        <div style="height:100px; width: 400px; overflow: auto; background: white; padding:6px;line-height: 1.5; border-radius: 5px; border: 1px solid gray"><{$mod.xoops_install}></div>
    </td>
    <td>
        <div style="height:100px; width: 400px; overflow: auto; background: white; padding:6px;line-height: 1.5; border-radius: 5px; border: 1px solid gray"><{$mod.xoops_update}></div>
    </td>
</tr>