<div class="container-fluid">
    <h3><{$php_ini_path|default:''|escape:'html'}><{$smarty.const._MA_TADADM_MODULES_PHP_INI_PATH}></h3>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th><{$smarty.const._MA_TADADM_PHPINI_ITEM}></th>
            <th><{$smarty.const._MA_TADADM_PHPINI_ITEM_VAL}></th>
            <th><{$smarty.const._MA_TADADM_PHPINI_ADV}></th>
            <th><{$smarty.const._MA_TADADM_PHPINI_ITEM_DESC}></th>
        </tr>

        <{foreach from=$main|default:[] item=php}>
            <tr>
            <td><{$php.k|default:''|escape:'html'}></td>
            <td style="color:<{$php.color|default:''|escape:'html'}>">
                <{$php.global_value|default:''|escape:'html'}>
            </td>
            <td><{$php.adv|default:''|escape:'html'}></td>
            <td><div style="line-height:150%"><{$php.ini|default:''}></div></td>
            </tr>
        <{/foreach}>
    </table>
</div>