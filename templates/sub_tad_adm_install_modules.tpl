<div class="row">
    <{foreach from=$all_active_modules item=mod}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_active_modules.tpl" }>
    <{/foreach}>
</div>

<h2>已安裝但被關閉的模組</h2>
<div class="row">
    <{foreach from=$all_un_active_modules item=mod}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_un_active_modules.tpl" }>
    <{/foreach}>
</div>
