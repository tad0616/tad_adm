<div class="container-fluid">
    <div class="alert alert-info">
        <ol style="padding:20px;">
            <li style="line-height:180%;list-style: decimal outside none;"><a href="spam.php?op=all"><{$smarty.const._MA_TADADM_AUTO_CHECK}></a><{$_MA_TADADM_AUTO_CHECK_DESC|default:''}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC1}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC2}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC3}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC4}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$smarty.const._MA_TADADM_AUTO_CHECK_DESC5}></li>
            <li style="line-height:180%;list-style: decimal outside none;"><{$_MA_TADADM_WORKTIME|default:''}></li>
        </ol>
    </div>

    <{if $op|default:''=="spam"}>

        <form action="spam.php" method="post">
            <{$bar|default:''}>
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
                <{foreach from=$all_data|default:[] item=spam}>
                    <tr style="color:<{$spam.color|default:''|escape:'html'}>;background-color:<{$spam.bgcolor|default:''|escape:'html'}>;">
                    <td>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input uid" type="checkbox" name="uid[]" id="uid_<{$spam.uid|escape:'html'}>" value="<{$spam.uid|escape:'html'}>" <{$spam.checked|default:''}>>
                        <label class="form-check-label" for="uid_<{$spam.uid|escape:'html'}>"><{$spam.uid|escape:'html'}></label>
                        </div>
                    </td>
                    <td><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.uname|default:''|escape:'html'}></label><div><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.name|default:''|escape:'html'}></label></div></td>
                    <td><{$spam.posts|default:0|escape:'html'}></td>
                    <td><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.email|default:''|escape:'html'}></label><div><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.url|default:''|escape:'html'}></label></div></td>
                    <td><{$spam.appears|default:0|escape:'html'}></td>
                    <td><{$spam.user_regdate|default:''|escape:'html'}><div><{$spam.last_login|default:''|escape:'html'}></div></td>
                    <td><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.days_between|default:0|escape:'html'}></label></td>
                    <td><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.user_sig|default:''|escape:'html'}></label></td>
                    </tr>
                <{/foreach}>
            </table>
            <{$bar|default:''}>

            <{$_MA_TADADM_TOTAL|default:''}>
            <{$token_html|default:''}>
            <input type="hidden" name="g2p" value="<{$g2p|default:''|escape:'html'}>">
            <input type="hidden" name="op" value="del_user">
            <button type="submit" class="btn btn-sm btn-xs btn-danger"><{$smarty.const._TAD_DEL_CONFIRM}></button>
        </form>
    <{else}>

        <script>
            $(function() {
                $("#clickAll").on("change", function() {
                    $("input[name='uid[]']").prop("checked", $(this).prop("checked"));
                });
            });
        </script>

        <form action="spam.php" method="get">
            <{$_MA_TADADM_NEVERSTART_DAY|default:''}>
            <input type="hidden" name="op" value="byNeverStartDays">
            <button type="submit" class="btn btn-sm btn-xs btn-primary"><{$smarty.const._TAD_GO}></button>
        </form>
        <form action="spam.php" method="get">
            <{$_MA_TADADM_NEVERLOGIN_DAY|default:''}>
            <input type="hidden" name="op" value="byNeverLoginDays">
            <button type="submit" class="btn btn-sm btn-xs btn-primary"><{$smarty.const._TAD_GO}></button>
        </form>
        <form action="spam.php" method="get">
            <{$_MA_TADADM_BY_EMAIL|default:''}>
            <input type="hidden" name="op" value="byEmail">
            <button type="submit" class="btn btn-sm btn-xs btn-primary"><{$smarty.const._TAD_GO}></button>
        </form>
        <{$bar|default:''}>
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
            <{foreach from=$all_data|default:[] item=spam}>
            <tr style="color:<{$spam.color|default:''|escape:'html'}>;background-color:<{$spam.bgcolor|default:''|escape:'html'}>;">
                <td>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input uid" type="checkbox" name="uid[]" id="uid_<{$spam.uid|escape:'html'}>" value="<{$spam.uid|escape:'html'}>" <{$spam.checked|default:''}>>
                    <label class="form-check-label" for="uid_<{$spam.uid|escape:'html'}>"><{$spam.uid|escape:'html'}></label>
                    </div>
                </td>
                <td><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.uname|default:''|escape:'html'}></label><div><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.name|default:''|escape:'html'}></label></div></td>
                <td><{$spam.posts|default:0|escape:'html'}></td>
                <td><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.email|default:''|escape:'html'}></label><div><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.url|default:''|escape:'html'}></label></div></td>
                <td><{$spam.appears|default:0|escape:'html'}></td>
                <td><{$spam.user_regdate|default:''|escape:'html'}><div><{$spam.last_login|default:''|escape:'html'}></div></td>
                <td><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.days_between|default:0|escape:'html'}></label></td>
                <td><label for="uid_<{$spam.uid|escape:'html'}>"><{$spam.user_sig|default:''|escape:'html'}></label></td>
            </tr>
            <{/foreach}>
            </table>
            <{$bar|default:''}>
            <{$_MA_TADADM_TOTAL|default:''}>
            <{$token_html|default:''}>
            <input type="hidden" name="g2p" value="<{$g2p|default:''|escape:'html'}>">
            <input type="hidden" name="op" value="del_user">
            <button type="submit" class="btn btn-sm btn-xs btn-danger"><{$smarty.const._TAD_DEL_CONFIRM}></button>
        </form>
    <{/if}>
</div>