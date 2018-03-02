<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="<{if $mod.function=='update_theme'}>alert alert-danger<{else}>well<{/if}>">

        <div style="font-size: 1.1em;">
            <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=
                <{$mod.module_sn}>" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>" target="_blank" style="font-weight: bold;">
            <{$mod.name}> <{$mod.version}></a>
        </div>

        <{if $mod.function=='update_theme'}>
            <a href="main.php?op=update_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-danger modulesadmin"  data-fancybox-type="iframe" title="<{$mod.dirname}> <{$mod.version}> (<{$mod.last_update}>) to <{$mod.new_version}> (<{$mod.new_last_update}>)"><{$smarty.const._MA_TADADM_CAN_UPDATE_TO}> <{$mod.new_version}></a>
        <{else}>
            <a href="main.php?op=update_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>"  title="<{$mod.dirname}> <{$mod.version}> (<{$mod.last_update}>) to <{$mod.new_version}> (<{$mod.new_last_update}>)">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <{$smarty.const._MA_TADADM_MOD_LATEST}> </a>
        <{/if}>

        <div style="padding:6px;">
            <{if $theme_set==$mod.dirname}>
                特殊佈景，不可為預設佈景
            <{elseif $mod.dirname|in_array:$theme_set_allowed}>
                特殊佈景，不應該可被使用者選用
            <{/if}>
        </div>

        <div>
            <{if $mod.fileowner.name}>
                <{$mod.fileowner.name}>:<{$mod.filegroup.name}>
            <{/if}>
            <{if $mod.fileperms=='0777'}>
                可寫入
            <{else}>
                <{$mod.fileperms}>
            <{/if}>
        </div>

    </div>
</div>