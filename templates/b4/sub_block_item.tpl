<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="alert <{if $mod.function=='update_block'}>alert-danger<{elseif $mod.function=='install_block'}>alert-info<{else}>alert-success<{/if}>">
        <div class="row">
            <div class="col-xs-6 col-sm-5">
                <{if $mod.logo}>
                    <a href="<{$mod.logo}>" class="fancybox" rel="group">
                        <img src="<{$mod.logo}>" alt="<{$mod.title}>" style="height:52px; object-fit: scale-down;" id="<{$mod.dirname}>_tip" title="<{$mod.title}>" class="img-fluid">
                    </a>
                <{else}>
                    <img src="../images/nopic.png" alt="<{$mod.dirname}>"  style="width: 100%; object-fit: cover;">
                <{/if}>
            </div>
            <div class="col-xs-6 col-sm-7">
                <div style="font-size: 1.1em;">
                    <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=
                        <{$mod.module_sn}>" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>" target="_blank" style="font-weight: bold;"><{$mod.name}></a>
                </div>

                <{if $mod.function=='update_block'}>
                    <a href="main.php?op=update_block&dirname=<{$mod.dirname}>&update_sn=<{$mod.update_sn}>&tad_block=clean" class="btn btn-sm btn-danger">
                        <{$smarty.const._MA_TADADM_MOD_UPDATE_BLOCK}>
                    </a>
                <{elseif $mod.function=='install_block'}>
                    <a href="main.php?op=install_block&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-success" >
                        <i class="fa fa-cloud-download" aria-hidden="true"></i>
                        <{$smarty.const._MA_TADADM_MOD_INSTALL_MODULE}> <{$mod.title}></a>
                <{else}>
                    <a href="main.php?op=update_block&dirname=<{$mod.dirname}>&update_sn=<{$mod.update_sn}>&tad_block=clean" style="font-size:1.2em;">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <{$smarty.const._MA_TADADM_MOD_LATEST}>
                    </a>
                <{/if}>
            </div>
        </div>
    </div>
</div>