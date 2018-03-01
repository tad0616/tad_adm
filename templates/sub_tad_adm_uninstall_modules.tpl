<script type='text/javascript'>
    function module_descript(selector) {
        $(selector).slideToggle();
    }
</script>
<div class="row">
    <{foreach from=$all_mods item=mod}>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="well">
                <div style="font-size: 1.5em; font-weight: bold; padding-bottom: 10px;">
                    <span class="label label-primary"><{$mod.module_sn}></span>
                    <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.name}></a>
                </div>

                <div>                
                    <a class="btn btn-default modulesadmin" href="#m<{$mod.module_sn}>">
                        <{$smarty.const._MA_TADADM_MOD_ABOUT_MOD}>
                    </a>
                    <a href="main.php?op=install&kind=module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-primary modulesadmin" data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_INSTALL_MODULE}> <{$mod.dirname}> <{$mod.new_version}></a>
                </div>


                <div id="m<{$mod.module_sn}>" style="display: none;">
                    <h3><{$mod.name}><small> (<{$mod.dirname}> <{$mod.new_version}>) </small></h3>
                    <{$mod.descript}>
                </div>
            </div>
        </div>
    <{/foreach}>
</div>