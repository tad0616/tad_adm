<h2><{$smarty.const._MA_TADADM_SSH_ID}></h2>
<div class="card card-body bg-light m-1 d-flex align-items-stretch">
    <form action="<{$action}>" method="post" role="form">
        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">
            <{$smarty.const._MA_TADADM_SSH_ID}><{$smarty.const._TAD_FOR}>
            </label>
            <div class="col-md-10">
            <input type="text" name="ssh_id" placeholder="<{$smarty.const._MA_TADADM_SSH_ID}>" class="form-control" value="<{$tad_adm_ssh_id}>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">
            <{$smarty.const._MA_TADADM_SSH_PASS}><{$smarty.const._TAD_FOR}>
            </label>
            <div class="col-md-10">
            <input type="password" name="ssh_passwd" placeholder="<{$smarty.const._MA_TADADM_SSH_PASS}>" class="form-control" value="<{$tad_adm_ssh_passwd}>">
            </div>
        </div>


        <div class="text-center">
            <input type="hidden" name="ssh_host" value="127.0.0.1" >
            <input type="hidden" name="file_link" value="<{$file_link}>">
            <input type="hidden" name="dirname" value="<{$dirname}>">
            <input type="hidden" name="act" value="<{$act}>">
            <input type="hidden" name="update_sn" value="<{$update_sn}>">
            <input type="hidden" name="xoops_sn" value="<{$xoops_sn}>">
            <input type="hidden" name="tad_adm_tpl" value="clean">
            <input type="hidden" name="op" value="ssh_login">
            <button type="submit" class="btn btn-primary"><{$smarty.const._MA_TADADM_LOGIN}>SSH</button>
        </div>
    </form>
</div>