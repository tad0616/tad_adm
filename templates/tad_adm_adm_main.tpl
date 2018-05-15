<div class="container-fluid">
  <{if $now_op=="login_form"}>
    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_ssh_login_form.tpl"}>
  <{elseif $all_active_modules}>
    <style type="text/css" media="screen">
      .footable th{
        color: #000;
      }
    </style>

    <div id="admTab">
      <ul class="resp-tabs-list vert">
        <{if $all_active_modules}><li><{$smarty.const._MA_TADADM_INSTALLED_MODS}></li><{/if}>
        <{if $all_mods}><li><{$smarty.const._MA_TADADM_ENABLE_MODS}></li><{/if}>
        <{if $all_admin}><li><{$smarty.const._MA_TADADM_INSTALLED_ADM}></li><{/if}>
        <{if $all_un_admin}><li><{$smarty.const._MA_TADADM_ENABLE_ADM}></li><{/if}>
        <{if $all_theme}><li><{$smarty.const._MA_TADADM_INSTALLED_THEME}></li><{/if}>
        <{if $all_un_theme}><li><{$smarty.const._MA_TADADM_ENABLE_THEME}></li><{/if}>
        <{if $all_block}><li><{$smarty.const._MA_TADADM_INSTALLED_BLOCK}></li><{/if}>
        <{if $all_un_block}><li><{$smarty.const._MA_TADADM_ENABLE_BLOCK}></li><{/if}>
      </ul>

      
      <div class="resp-tabs-container vert">
        
        <{if $all_active_modules}>
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_installed.tpl"}>
          </div>
        <{/if}>
        <{if $all_mods}>          
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_modules_uninstall.tpl"}>
          </div>
        <{/if}>
        <{if $all_admin}>
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_admin_installed.tpl"}>
          </div>
        <{/if}>
        <{if $all_un_admin}>
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_admin_uninstall.tpl"}>
          </div>
        <{/if}>
        <{if $all_theme}>          
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_themes_installed.tpl"}>
          </div>
        <{/if}>
        <{if $all_un_theme}>
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_themes_uninstall.tpl"}>
          </div>
        <{/if}>
        <{if $all_block}>          
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_block_installed.tpl"}>
          </div>
        <{/if}>
        <{if $all_un_block}>
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_block_uninstall.tpl"}>
          </div>
        <{/if}>
      </div>
    </div>

  <{/if}>
</div>

