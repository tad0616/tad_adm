<h2><{$smarty.const._MA_TADADM_INSTALLED_MODS}></h2>
<div class="row">
    <{foreach from=$all_active_modules.update item=mod}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_active.tpl"}>
    <{/foreach}>
</div>
<div class="row">
    <{foreach from=$all_active_modules.last_mod item=mod}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_active.tpl"}>
    <{/foreach}>
</div>

<{if $all_un_active_modules}>
    <h2><{$smarty.const._MA_TADADM_INSTALLED_UNABLE_MODS}></h2>
    <div class="row">
        <{foreach from=$all_un_active_modules.update item=mod}>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_un_active.tpl"}>
        <{/foreach}>

        <{foreach from=$all_un_active_modules.last_mod item=mod}>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_un_active.tpl"}>
        <{/foreach}>
    </div>
<{/if}>
