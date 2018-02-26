<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="alert <{if $mod.function=='update'}>alert-danger<{else}>alert-success<{/if}>">
        <div class="row">
            <div class="col-xs-6 col-sm-5 col-md-4">
                <div>
                    <img src="<{$mod.logo}>" alt="<{$mod.name}>" style="width: 100%;" id="<{$mod.dirname}>_tip">
                </div>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8">
                <div style="font-size: 1.1em;">
                    <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=
                        <{$mod.module_sn}>" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>" target="_blank" style="font-weight: bold;">
                    <{$mod.name}></a>
                    <a href="<{$xoops_url}>/modules/<{$mod.dirname}>" target="_blank"><{$mod.dirname}></a>
                </div>
                
                <a href="main.php?op=active&mid=<{$mod.mid}>" class="btn btn-sm btn-primary"  data-fancybox-type="iframe" title="<{$mod.dirname}> <{$mod.version}> (<{$mod.last_update}>) to <{$mod.new_version}> (<{$mod.new_last_update}>)">啟用模組</a>

                <{if $mod.function=='update'}>
                    <{$mod.version}> <{$smarty.const._MA_TADADM_CAN_UPDATE_TO}> <{$mod.new_version}>                    
                <{else}>
                    <{$smarty.const._MA_TADADM_MOD_LATEST}> <{$mod.new_version}>
                <{/if}>
            </div>
        </div>
    </div>
</div>