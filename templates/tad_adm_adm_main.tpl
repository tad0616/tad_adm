<div class="container-fluid">
    <{if $now_op=="login_form"}>
        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_ssh_login_form.tpl"}>
    <{else}>
        <div id="modTab">
            <ul class="resp-tabs-list vert">
                <{if $all_install.upgrade or $all_install.unable}>
                    <li><{$smarty.const._MA_TADADM_NEED_UPGRADE}></li>
                <{/if}>
                <li><{$smarty.const._MA_TADADM_INSTALLED_ITEM}></li>
                <{if $all_uninstall.module}><li><{$smarty.const._MA_TADADM_ENABLE_MODS}></li><{/if}>
                <{if $all_uninstall.adm_tpl}><li>><{$smarty.const._MA_TADADM_ENABLE_ADM}></li><{/if}>
                <{if $all_uninstall.theme}><li><{$smarty.const._MA_TADADM_ENABLE_THEME}></li><{/if}>
                <{if $all_uninstall.block}><li><{$smarty.const._MA_TADADM_ENABLE_BLOCK}></li><{/if}>
                <{if $all_uninstall.other}><li><{$smarty.const._MA_TADADM_ENABLE_OTHER}></li><{/if}>
            </ul>

            <div class="resp-tabs-container vert">
                <{if $all_install.upgrade or $all_install.unable}>
                    <div>
                        <!-- 需升級 -->
                        <{if $all_install.upgrade}>
                            <{foreach from=$all_install.upgrade key=kind item=items}>
                                <!-- 使用中 -->
                                <{if $items.1}>
                                    <h2 class="mod_head"><{$kind}></h2>
                                    <table class="footable">
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                    <{foreach from=$items.1 key=dirname item=mod}>
                                        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                    <{/foreach}>
                                    </table>
                                <{/if}>

                                <!-- 關閉中 -->
                                <{if $items.0}>
                                    <h2 class="mod_head"><{$kind}><{$smarty.const._MA_TADADM_CLOSED}></h2>
                                    <table class="footable">
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                    <{foreach from=$items.0 key=dirname item=mod}>
                                        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                    <{/foreach}>
                                    </table>
                                <{/if}>
                            <{/foreach}>
                        <{/if}>

                        <!-- 無法升級 -->
                        <{if $all_install.unable}>
                            <{foreach from=$all_install.unable key=kind item=items}>
                                <!-- 使用中 -->
                                <{if $items.1}>
                                    <h2 class="mod_head"><{$kind}></h2>
                                    <table class="footable">
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                    <{foreach from=$items.1 item=mod}>
                                        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                    <{/foreach}>
                                    </table>
                                <{/if}>

                                <!-- 關閉中 -->
                                <{if $items.0}>
                                    <h2 class="mod_head"><{$kind}><{$smarty.const._MA_TADADM_CLOSED}></h2>
                                    <table class="footable">
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                    <{foreach from=$items.0 item=mod}>
                                        <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                    <{/foreach}>
                                    </table>
                                <{/if}>
                            <{/foreach}>
                        <{/if}>
                    </div>
                <{/if}>

                <div>
                    <{foreach from=$all_install.latest key=kind item=items}>
                        <!-- 使用中 -->
                        <{if $items.1}>
                            <h2 class="mod_head"><{$kind}></h2>
                            <table class="footable">
                            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                            <{foreach from=$items.1 item=mod}>
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                            <{/foreach}>
                            </table>
                        <{/if}>

                        <!-- 關閉中 -->
                        <{if $items.0}>
                            <h2 class="mod_head"><{$kind}><{$smarty.const._MA_TADADM_CLOSED}></h2>
                            <table class="footable">
                            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                            <{foreach from=$items.0 item=mod}>
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                            <{/foreach}>
                            </table>
                        <{/if}>
                    <{/foreach}>
                </div>

                <!-- 可安裝模組 -->
                <{if $all_uninstall.module}>
                    <div>
                        <{if $all_uninstall.module.install}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_MODS}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.module.install item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>

                        <{if $all_uninstall.module.unable}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_MODS}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.module.unable item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>
                    </div>
                <{/if}>

                <!-- 可安裝後台 -->
                <{if $all_uninstall.adm_tpl}>
                    <div>
                        <{if $all_uninstall.adm_tpl.install}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_ADM}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.adm_tpl.install item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>

                        <{if $all_uninstall.adm_tpl.unable}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_ADM}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.adm_tpl.unable item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>
                    </div>
                <{/if}>

                <{if $all_uninstall.theme}>
                    <div>
                        <{if $all_uninstall.theme.install}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_THEME}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.theme.install item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>

                        <{if $all_uninstall.theme.unable}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_THEME}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.theme.unable item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>
                    </div>
                <{/if}>

                <{if $all_uninstall.block}>
                    <div>
                        <{if $all_uninstall.block.install}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_BLOCK}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.block.install item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>

                        <{if $all_uninstall.block.unable}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_BLOCK}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.block.unable item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>
                    </div>
                <{/if}>

                <{if $all_uninstall.other}>
                    <div>
                        <{if $all_uninstall.other.install}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_OTHER}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.other.install item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>

                        <{if $all_uninstall.other.unable}>
                            <h2 class="mod_head"><{$smarty.const._MA_TADADM_ENABLE_OTHER}></h2>
                            <table class="footable">
                                <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_thead.tpl"}>
                                <{foreach from=$all_uninstall.other.unable item=mod}>
                                    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_list.tpl"}>
                                <{/foreach}>
                            </table>
                        <{/if}>
                    </div>
                <{/if}>
            </div>
        </div>
    <{/if}>
</div>