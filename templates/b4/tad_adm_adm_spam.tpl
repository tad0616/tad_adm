<div class="container-fluid">
    <div class="alert alert-info">
        <ol style="padding:20px;">
            <li style="line-height:180%;list-style: decimal outside none;"><a href="spam.php?op=all"><{$smarty.const._MA_TADADM_AUTO_CHECK}></a><{$_MA_TADADM_AUTO_CHECK_DESC}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC1}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC2}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC3}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC4}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC5}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$_MA_TADADM_WORKTIME}></li>
        </ol>
    </div>

    <{if $op=="spam"}>

        <form action="spam.php" method="post">
            <{$bar}>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>uid</th>
                    <th><{$smarty.const._MA_TADADM_UNAME}></th>
                    <th><{$smarty.const._MA_TADADM_COUNT}></th>
                    <th><{$smarty.const._MA_TADADM_EMAIL}></th>
                    <th><{$smarty.const._MA_TADADM_SPAM}></th>
                    <th><{$smarty.const._MA_TADADM_REGIST}></th>
                    <th><{$smarty.const._MA_TADADM_LASTLOGIN}></th>
                    <th style="width:200px;"><{$smarty.const._MA_TADADM_SIGN}></th>
                </tr>
                <{foreach from=$all_data item=spam}>
                    <tr style="color:<{$spam.color}>;background-color:<{$spam.bgcolor}>;">
                    <td>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input uid" type="checkbox" name="uid[]" id="uid_<{$spam.uid}>" value="<{$spam.uid}>" <{$spam.checked}>
                        <label class="form-check-label" for="uid_<{$spam.uid}>"><{$spam.uid}></label>
                        </div>
                    </td>
                    <td><label for="uid_<{$spam.uid}>"><{$spam.uname}></label><div><label for="uid_<{$spam.uid}>"><{$spam.name}></label></div></td>
                    <td><{$spam.posts}></td>
                    <td><label for="uid_<{$spam.uid}>"><{$spam.email}></label><div><label for="uid_<{$spam.uid}>"><{$spam.url}></label></div></td>
                    <td><{$spam.appears}></td>
                    <td><{$spam.user_regdate}><div><{$spam.last_login}></div></td>
                    <td><label for="uid_<{$spam.uid}>"><{$spam.days_between}></label></td>
                    <td><label for="uid_<{$spam.uid}>"><{$spam.user_sig}></label></td>
                    </tr>
                <{/foreach}>
            </table>
            <{$bar}>

            <{$_MA_TADADM_TOTAL}>
            <input type="hidden" name="g2p" value="<{$g2p}>">
            <input type="hidden" name="op" value="del_user">
            <button type="submit" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL_CONFIRM}></button>
        </form>
    <{else}>

        <script type="text/javascript">
            $().ready(function(){
                $("#clickAll").click(function() {
                    if($("#clickAll").prop("checked")){
                        $("input[name='uid[]']").each(function() {
                            $(this).prop("checked", true);
                        });
                    }else{
                        $("input[name='uid[]']").each(function() {
                            $(this).prop("checked", false);
                        });
                    }
                });
            });
        </script>

        <form action="spam.php" method="get">
            <{$_MA_TADADM_NEVERSTART_DAY}>
            <input type="hidden" name="op" value="byNeverStartDays">
            <button type="submit" class="btn btn-sm btn-primary"><{$smarty.const._TAD_GO}></button>
        </form>
        <form action="spam.php" method="get">
            <{$_MA_TADADM_NEVERLOGIN_DAY}>
            <input type="hidden" name="op" value="byNeverLoginDays">
            <button type="submit" class="btn btn-sm btn-primary"><{$smarty.const._TAD_GO}></button>
        </form>
        <form action="spam.php" method="get">
            <{$_MA_TADADM_BY_EMAIL}>
            <input type="hidden" name="op" value="byEmail">
            <button type="submit" class="btn btn-sm btn-primary"><{$smarty.const._TAD_GO}></button>
        </form>
        <{$bar}>
        <form action="spam.php" method="post">
            <table class="table table-striped table-bordered table-hover">
            <tr><td colspan=10>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="clickAll" value="">
                    <label class="form-check-label" for="clickAll"><{$smarty.const._MA_TADADM_SELECT_ALL}></label>
                </div>
            </td></tr>
            <tr>
            <th>uid</th>
            <th><{$smarty.const._MA_TADADM_UNAME}></th>
            <th><{$smarty.const._MA_TADADM_COUNT}></th>
            <th><{$smarty.const._MA_TADADM_EMAIL}></th>
            <th><{$smarty.const._MA_TADADM_SPAM}></th>
            <th><{$smarty.const._MA_TADADM_REGIST}></th>
            <th><{$smarty.const._MA_TADADM_LASTLOGIN}></th>
            <th style="width:200px;"><{$smarty.const._MA_TADADM_SIGN}></th>
            </tr>
            <{foreach from=$all_data item=spam}>
            <tr style="color:<{$spam.color}>;background-color:<{$spam.bgcolor}>;">
                <td>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input uid" type="checkbox" name="uid[]" id="uid_<{$spam.uid}>" value="<{$spam.uid}>" <{$spam.checked}>
                    <label class="form-check-label" for="uid_<{$spam.uid}>"><{$spam.uid}></label>
                    </div>
                </td>
                <td><label for="uid_<{$spam.uid}>"><{$spam.uname}></label><div><label for="uid_<{$spam.uid}>"><{$spam.name}></label></div></td>
                <td><{$spam.posts}></td>
                <td><label for="uid_<{$spam.uid}>"><{$spam.email}></label><div><label for="uid_<{$spam.uid}>"><{$spam.url}></label></div></td>
                <td><{$spam.appears}></td>
                <td><{$spam.user_regdate}><div><{$spam.last_login}></div></td>
                <td><label for="uid_<{$spam.uid}>"><{$spam.days_between}></label></td>
                <td><label for="uid_<{$spam.uid}>"><{$spam.user_sig}></label></td>
            </tr>
            <{/foreach}>
            </table>
            <{$bar}>
            <{$_MA_TADADM_TOTAL}>
            <input type="hidden" name="g2p" value="<{$g2p}>">
            <input type="hidden" name="op" value="del_user">
            <button type="submit" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL_CONFIRM}></button>
        </form>
    <{/if}>
</div>