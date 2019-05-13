<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
    <div class="alert alert-success">
        <div class="row">
            <div class="col-sm-6 col-md-5">
                <{if $mod.logo}>
                    <a href="<{$mod.logo}>"><img src="<{$mod.logo_thumb}>" alt="<{$mod.name}>"  id="<{$mod.dirname}>_tip"></a>
                <{else}>
                    <img src="<{$xoops_url}>/modules/tad_adm/images/special_theme.png" alt="<{$mod.name}>" id="<{$mod.dirname}>_tip">
                <{/if}>
            </div>
            <div class="col-sm-6 col-md-7">
                <div style="font-size: 1.1em;">
                    <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=
                        <{$mod.module_sn}>" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>" target="_blank" style="font-weight: bold;">
                    <{$mod.dirname}> <{$mod.version}></a>
                </div>
                <div style="height:1.5em;overflow:hidden;">
                    <{$mod.name}>
                </div>

                    <a href="main.php?op=install_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean"  title="<{$mod.dirname}> <{$mod.version}> (<{$mod.last_update}>) to <{$mod.new_version}> (<{$mod.new_last_update}>)" class="btn btn-sm btn-success">

                        <{$smarty.const._MA_TADADM_MOD_INSTALL_MODULE}></a>


                <div>
                    <{if isset($mod.fileowner.name)}>
                        <{$mod.fileowner.name}>:<{$mod.filegroup.name}>
                    <{/if}>
                    <{if $mod.fileperms=='0777'}>
                        <{$smarty.const._MA_TADADM_WRITABLE}>
                    <{else}>
                        <{$mod.fileperms}>
                    <{/if}>
                </div>


            </div>
        </div>
    </div>
</div>
