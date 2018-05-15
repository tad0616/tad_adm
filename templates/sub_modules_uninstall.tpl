<script type='text/javascript'>
    function module_descript(selector) {
        $(selector).slideToggle();
    }
</script>
<div class="row">
    <{assign var=i value=1}>
    <{foreach from=$all_mods item=mod}>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="well">
                <div style="font-size: 1.1em; font-weight: bold; padding-bottom: 10px;">
                    <span class="label label-primary"><{$i}></span>
                    <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.name}></a>
                </div>
                <div class="row">
                    <{if $mod.logo}> 
                        <div class="col-sm-4">
                            <a  href="#m<{$mod.module_sn}>">         
                                <img src="<{$mod.logo}>" alt="<{$mod.name}>" class="img-responsive">
                            </a>
                        </div>
                    <{/if}>
                    <div class="col-sm-8">         
                        
                        <a href="main.php?op=install_module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-success modulesadmin" data-fancybox-type="iframe">
                        <i class="fa fa-cloud-download" aria-hidden="true"></i>
                        <{$smarty.const._MA_TADADM_MOD_INSTALL_MODULE}> <{$mod.dirname}> <{$mod.new_version}></a>                   
                    </div>
                </div>



                <div id="m<{$mod.module_sn}>" style="display: none;">
                    <h3><{$mod.name}><small> (<{$mod.dirname}> <{$mod.new_version}>) </small></h3>
                    <{$mod.descript}>
                </div>
            </div>
        </div>
        <{assign var=i value=$i+1}>
    <{/foreach}>
</div>