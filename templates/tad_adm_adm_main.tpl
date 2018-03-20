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
        <{if $all_active_modules}><li>已安裝模組</li><{/if}>
        <{if $all_mods}><li>可安裝模組</li><{/if}>
        <{if $all_admin}><li>已安裝後台</li><{/if}>
        <{if $all_un_admin}><li>可安裝後台</li><{/if}>
        <{if $all_theme}><li>已安裝佈景</li><{/if}>
        <{if $all_un_theme}><li>可安裝佈景</li><{/if}>
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
      </div>
    </div>

  <{/if}>
</div>

