<div class="container-fluid">
  <{if $now_op=="login_form"}>
    <div class="row">
      <div class="col-sm-6">
        <h2><{$smarty.const._MA_TADADM_SSH_ID}></h2>
        <div class="well">
          <form action="main.php" method="post">
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_TADADM_SSH_HOST}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="text" name="ssh_host" placeholder="<{$smarty.const._MA_TADADM_SSH_HOST}>" value="<{$tad_adm_ssh_host}>" class="col-sm-12">
              </div>
            </div>
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_TADADM_SSH_ID}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="text" name="ssh_id" placeholder="<{$smarty.const._MA_TADADM_SSH_ID}>" class="col-sm-12" value="<{$tad_adm_ssh_id}>">
              </div>
            </div>
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_TADADM_SSH_PASS}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="password" name="ssh_passwd" placeholder="<{$smarty.const._MA_TADADM_SSH_PASS}>" class="col-sm-12" value="<{$tad_adm_ssh_passwd}>">
              </div>
            </div>

            <div class="text-center">
              <input type="hidden" name="file_link" value="<{$file_link}>">
              <input type="hidden" name="dirname" value="<{$dirname}>">
              <input type="hidden" name="act" value="<{$act}>">
              <input type="hidden" name="kind_dir" value="<{$kind_dir}>">
              <input type="hidden" name="update_sn" value="<{$update_sn}>">
              <input type="hidden" name="op" value="ssh_login">
              <button type="submit" class="btn btn-primary"><{$smarty.const._MA_TADADM_LOGIN}>SSH</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-sm-6">
        <h2><{$smarty.const._MA_TADADM_FTP_ID}></h2>
        <div class="well">
          <form action="main.php" method="post">
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_TADADM_FTP_HOST}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="text" name="ftp_host" placeholder="<{$smarty.const._MA_TADADM_FTP_HOST}>" value="<{$tad_adm_ftp_host}>" class="col-sm-12">
              </div>
            </div>
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_TADADM_FTP_ID}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="text" name="ftp_id" placeholder="<{$smarty.const._MA_TADADM_FTP_ID}>" class="col-sm-12" value="<{$tad_adm_ftp_id}>">
              </div>
            </div>
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_TADADM_FTP_PASS}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="password" name="ftp_passwd" placeholder="<{$smarty.const._MA_TADADM_FTP_PASS}>" class="col-sm-12" value="<{$tad_adm_ftp_passwd}>">
                <{$smarty.const._MA_TADADM_FTP_NOTE}>
              </div>
            </div>

            <div class="text-center">
              <input type="hidden" name="file_link" value="<{$file_link}>">
              <input type="hidden" name="dirname" value="<{$dirname}>">
              <input type="hidden" name="act" value="<{$act}>">
              <input type="hidden" name="kind_dir" value="<{$kind_dir}>">
              <input type="hidden" name="update_sn" value="<{$update_sn}>">
              <input type="hidden" name="op" value="ftp_login">
              <button type="submit" class="btn btn-primary"><{$smarty.const._MA_TADADM_LOGIN}>FTP</button>
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
    <table class="footable">
      <thead>
        <tr>
          <th nowrap><{$smarty.const._MA_TADADM_KIND}></th>
          <th data-class="expand"><{$smarty.const._MA_TADADM_MOD_NAME}></th>
          <th nowrap><{$smarty.const._TAD_FUNCTION}></th>
          <th nowrap data-hide="phone"><{$smarty.const._MA_TADADM_MOD_UPDATE_DESC}></th>
          <th nowrap data-hide="phone"><{$smarty.const._MA_TADADM_MOD_DIRNAME}></th>
          <th nowrap data-hide="phone"><{$smarty.const._MA_TADADM_MOD_FUNCTION}></th>
          <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_MOD_VERSION}></th>
          <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_MOD_LAST_UPDATE}></th>
          <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_MOD_NEW_VERSION}></th>
          <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_MOD_NEW_LAST_UPDATE}></th>
          <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_OWNER}></th>
          <th nowrap data-hide="phone,tablet"><{$smarty.const._MA_TADADM_PERMS}></th>
        </tr>
      </thead>
      <tbody>
        <{foreach from=$all_data item=mod}>
          <tr>
            <td nowrap>
              <{if $mod.kind=="module"}>
                <span class="label label-info"><{$smarty.const._MA_TADADM_MODULE}></span>
              <{elseif $mod.kind=="theme"}>
                <span class="label label-danger"><{$smarty.const._MA_TADADM_THEME}></span>
              <{elseif $mod.kind=="fix"}>
                <span class="label label-warning"><{$smarty.const._MA_TADADM_FIX}></span>
              <{/if}>
            </td>
            <td><a href="http://120.115.2.90/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.name}></a></td>
            <td nowrap style="text-align:center;">
              <{if $mod.function=='install'}>
                <a href="main.php?op=install_module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="btn btn-xs btn-primary modulesadmin" data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_INSTALL_MODULE}></a>
              <{elseif $mod.function=='update'}>
                <a href="main.php?op=update_module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="btn btn-xs btn-danger modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_UPDATE_MODULE}> <{$mod.new_version}></a>
              <{elseif $mod.function=='update_theme'}>
                  <a href="main.php?op=update_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="btn btn-xs btn-danger" ><{$smarty.const._MA_TADADM_MOD_UPDATE_THEME}> <{$mod.new_version}></a>
              <{elseif $mod.function=='install_theme'}>
                  <a href="main.php?op=install_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="btn btn-xs btn-primary" ><{$smarty.const._MA_TADADM_MOD_INSTALL_THEME}></a>
              <{elseif $mod.function=='last_mod'}>
                <a href="main.php?op=update_module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_TADADM_MOD_LATEST}></a>
              <{elseif $mod.function=='last_theme'}>
                  <a href="main.php?op=update_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" ><{$smarty.const._MA_TADADM_MOD_LATEST}></a>
              <{elseif $mod.new_last_update}>
                <{$smarty.const._MA_TADADM_MOD_LATEST}>
              <{/if}>
            </td>
            <td nowrap style="text-align:center;">
              <{if $mod.descript}>
                <a id="view_well<{$mod.module_sn}>" class="btn btn-xs btn-success" href="javascript:alert('<{$mod.descript}>')"><{if $mod.version}><{$smarty.const._MA_TADADM_MOD_UPDATE_DESC}><{else}><{$smarty.const._MA_TADADM_MOD_ABOUT_MOD}><{/if}></a>
              <{/if}>
            </td>

            <td nowrap>
              <{if $mod.version}>
                <a href="<{$xoops_url}>/modules/<{$mod.dirname}>/admin/index.php" title="<{$mod.dirname}><{$smarty.const._MA_TADADM_MOD_ADMIN}>" target="_blank"><{$mod.dirname}></a>
              <{else}>
                <{$mod.dirname}>
              <{/if}>
              </td>
            <td nowrap>
              <{if $mod.version}>
                <a href="<{$xoops_url}>/modules/system/admin.php?fct=blocksadmin&op=list&filter=1&selgen=<{$mod.mid}>&selmod=-2&selgrp=-1&selvis=-1" target="_blank"><{$smarty.const._MA_TADADM_MOD_BLOCK}></a>
              <{/if}>
            </td>
            <td nowrap><{$mod.version}></td>
            <td nowrap><{$mod.last_update}></td>
            <td nowrap><{$mod.new_version}></td>
            <td nowrap><{$mod.new_last_update}></td>
            <td nowrap style="text-align: center;"><{$mod.fileowner.name}>:<{$mod.filegroup.name}></td>
            <td nowrap><{$mod.fileperms}></td>

          </tr>
        <{/foreach}>
      </tbody>
    </table>
  <{/if}>
</div>