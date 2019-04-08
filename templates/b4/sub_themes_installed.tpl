<h2><{$smarty.const._MA_TADADM_ALLOWED_THEMES}></h2>
<div class="row">
    <{foreach from=$all_theme.web.1 item=mod}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_themes_web.tpl" }>
    <{/foreach}>
</div>

<{if $all_theme.web.0}>
    <h2><{$smarty.const._MA_TADADM_NOT_ALLOWED_THEMES}></h2>
    <div class="row">
        <{foreach from=$all_theme.web.0 item=mod}>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_themes_web.tpl" }>
        <{/foreach}>
    </div>
<{/if}>

<{if $all_theme.spec}>
    <h2><{$smarty.const._MA_TADADM_SPECIAL_THEMES}></h2>
    <div class="row">
        <{foreach from=$all_theme.spec.1 item=mod}>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_themes_spec.tpl" }>
        <{/foreach}>
    </div>

    <div class="row">
        <{foreach from=$all_theme.spec.0 item=mod}>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_themes_spec.tpl" }>
        <{/foreach}>
    </div>
<{/if}>