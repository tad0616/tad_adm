<div class="container-fluid">
  <{if $now_op=="login_form"}>
    <div class="row">
      <div class="col-sm-12">
        <h2><{$smarty.const._MA_TADADM_SSH_ID}></h2>
        <div class="well">
          <form action="main.php" method="post" class="form-horizontal" role="form">
            <div class="form-group">
              <label class="col-sm-2 control-label">
                <{$smarty.const._MA_TADADM_SSH_ID}><{$smarty.const._TAD_FOR}>
              </label>
              <div class="col-sm-10">
                <input type="text" name="ssh_id" placeholder="<{$smarty.const._MA_TADADM_SSH_ID}>" class="form-control" value="<{$tad_adm_ssh_id}>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                <{$smarty.const._MA_TADADM_SSH_PASS}><{$smarty.const._TAD_FOR}>
              </label>
              <div class="col-sm-10">
                <input type="password" name="ssh_passwd" placeholder="<{$smarty.const._MA_TADADM_SSH_PASS}>" class="form-control" value="<{$tad_adm_ssh_passwd}>">
              </div>
            </div>


            <div class="text-center">
              <input type="hidden" name="ssh_host" value="127.0.0.1" >
              <input type="hidden" name="file_link" value="<{$file_link}>">
              <input type="hidden" name="dirname" value="<{$dirname}>">
              <input type="hidden" name="act" value="<{$act}>">
              <input type="hidden" name="kind" value="<{$kind}>">
              <input type="hidden" name="update_sn" value="<{$update_sn}>">
              <input type="hidden" name="tad_adm_tpl" value="clean">
              <input type="hidden" name="op" value="ssh_login">
              <button type="submit" class="btn btn-primary"><{$smarty.const._MA_TADADM_LOGIN}>SSH</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <{elseif $all_data}>
    <style type="text/css" media="screen">
      .footable th{
        color: #000;
      }
    </style>

  <div id="admTab">
    <ul class="resp-tabs-list vert">
      <{if $all_data}><li>已安裝模組</li><{/if}>
      <{if $all_admin}><li>已安裝後台</li><{/if}>
      <{if $all_theme}><li>已安裝佈景</li><{/if}>
      <{if $all_mods}><li>可安裝模組</li><{/if}>
      <{if $all_un_admin}><li>可安裝後台</li><{/if}>
      <{if $all_un_theme}><li>可安裝佈景</li><{/if}>
    </ul>
    
    <div class="resp-tabs-container vert">
      
      <{if $all_data}>
        <div>
          <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_install_modules.tpl"}>
        </div>
      <{/if}>
      <{if $all_admin}>
        <div>
          <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_admin.tpl"}>
        </div>
      <{/if}>
      <{if $all_theme}>          
        <div>
          <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_themes.tpl"}>
        </div>
      <{/if}>
      <{if $all_mods}>          
        <div>
          <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_uninstall_modules.tpl"}>
        </div>
      <{/if}>
      <{if $all_un_admin}>
        <div>
          <{includeq file="$xoops_rootpath/modules/tad_adm/templates/sub_tad_adm_un_admin.tpl"}>
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