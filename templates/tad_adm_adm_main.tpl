<div class="container-fluid">
  <{if $now_op=="login_form"}>
    <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_login_form.tpl"}>
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
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_install_modules.tpl"}>
          </div>
        <{/if}>
        <{if $all_mods}>          
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_uninstall_modules.tpl"}>
          </div>
        <{/if}>
        <{if $all_admin}>
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_admin.tpl"}>
          </div>
        <{/if}>
        <{if $all_un_admin}>
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_un_admin.tpl"}>
          </div>
        <{/if}>
        <{if $all_theme}>          
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_themes.tpl"}>
          </div>
        <{/if}>
        <{if $all_un_theme}>
          <div>
            <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_un_themes.tpl"}>
          </div>
        <{/if}>
      </div>
    </div>

  <{/if}>
</div>

