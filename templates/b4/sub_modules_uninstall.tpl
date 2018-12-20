<script type='text/javascript'>
    function module_descript(selector) {
        $(selector).slideToggle();
    }
</script>
<div class="row">
    <{assign var=i value=1}>
    <{foreach from=$all_mods item=mod}>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <div class="card card-body bg-light m-1 d-flex align-items-stretch">
                <div style="font-size: 1.1em; font-weight: bold; padding-bottom: 10px;">
                    <span class="badge badge-primary"><{$i}></span>
                    <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.name}></a>
                </div>
                <div class="row">
                    <{if $mod.logo}>
                        <div class="col-md-4">
                            <a  href="#m<{$mod.module_sn}>">
                                <img src="<{$mod.logo}>" alt="<{$mod.name}>" class="img-fluid">
                            </a>
                        </div>
                    <{/if}>
                    <div class="col-md-8">

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