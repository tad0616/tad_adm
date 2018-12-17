<div class="row">
    <{foreach from=$all_admin item=mod}>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="alert <{if $mod.function=='update_adm_tpl'}>alert-danger<{else}>alert-success<{/if}>">
        <div class="row">
            <div class="col-xs-6 col-sm-5 col-md-4">
                <img src="../images/tad_adm_tpl.png" alt="<{$mod.name}>" style="width: 100%;" id="<{$mod.dirname}>_tip" title="<{$smarty.const._MA_TADADM_ADMTPL}>">
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8">
                <div style="font-size: 1.1em;">
                    <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=
                        <{$mod.module_sn}>" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>" target="_blank" style="font-weight: bold;"><{$mod.name}></a>
                </div>

                <{if $mod.function=='update_adm_tpl'}>
                    <a href="main.php?op=update_adm_tpl&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-danger modulesadmin" data-fancybox-type="iframe">
                        <{$smarty.const._MA_TADADM_MOD_UPDATE_ADMTPL}>
                            <{$mod.new_version}>
                    </a>
                <{else}>
                    <a href="main.php?op=update_adm_tpl&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="modulesadmin"  data-fancybox-type="iframe" style="font-size:1.2em;">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <{$smarty.const._MA_TADADM_MOD_LATEST}> <{$mod.new_version}>
                    </a>
                <{/if}>

                <div>
                    <{if isset($mod.fileowner.name)}>
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
    </div>
</div>

    <{/foreach}>
</div>

