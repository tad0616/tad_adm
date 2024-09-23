<script type='text/javascript'>
    function module_descript(selector) {
        $(selector).slideToggle();
    }
</script>
<div class="row">
    <{assign var="i" value=1}>
    <{foreach from=$xoops_upgrade item=xoops}>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="well">
                <div style="font-size: 1.1rem; font-weight: bold; padding-bottom: 10px;">
                    <span class="label label-primary"><{$i|default:''}></span>
                    <a href="<{$source|default:''}>/modules/tad_modules/xoops.php?xoops_sn=<{$xoops.xoops_sn}>" target="_blank"><{$xoops.xoops_title}></a>
                </div>

                <{if $xoops.status!="OK"}>
                    <a href="xoops.php?op=upgrade_xoops&file_link=<{$xoops.file_link}>&xoops_sn=<{$xoops.xoops_sn}>&tad_adm_tpl=clean" class="btn btn-danger modulesadmin disabled" data-fancybox-type="iframe">
                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                    <{$xoops.status}></a>
                <{else}>
                    <a href="xoops.php?op=upgrade_xoops&file_link=<{$xoops.file_link}>&xoops_sn=<{$xoops.xoops_sn}>&tad_adm_tpl=clean" class="btn btn-success modulesadmin " data-fancybox-type="iframe">
                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                    <{$smarty.const._MA_TADADM_UPGRADE_XOOPS}> <{$xoops.xoops_title}></a>
                <{/if}>


            </div>
        </div>
        <{assign var="i" value=$i+1}>
    <{/foreach}>
</div>