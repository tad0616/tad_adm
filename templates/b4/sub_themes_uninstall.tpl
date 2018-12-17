<h2><{$smarty.const._MA_TADADM_ALLOWED_ENABLE_THEMES}></h2>
<div class="row">
    <{foreach from=$all_un_theme item=mod}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_themes_enable.tpl" }>
    <{/foreach}>
</div>
