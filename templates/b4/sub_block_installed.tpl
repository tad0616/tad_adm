<h2><{$smarty.const._MA_TADADM_INSTALLED_BLOCK}></h2>
<div class="row">
    <{foreach from=$all_block.1 item=mod}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_block_item.tpl"}>
    <{/foreach}>
</div>

<h2><{$smarty.const._MA_TADADM_UNABLE_BLOCKS}></h2>
<div class="row">
    <{foreach from=$all_block.0 item=mod}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_block_item.tpl"}>
    <{/foreach}>
</div>


