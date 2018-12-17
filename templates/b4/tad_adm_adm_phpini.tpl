<div class="container-fluid">
  <h3><{$php_ini_path}><{$smarty.const._MA_TADADM_MODULES_PHP_INI_PATH}></h3>

  <table class="table table-striped table-bordered table-hover table-responsive table-sm'">
  <tr>
    <th><{$smarty.const._MA_TADADM_PHPINI_ITEM}></th>
    <th><{$smarty.const._MA_TADADM_PHPINI_ITEM_VAL}></th>
    <th><{$smarty.const._MA_TADADM_PHPINI_ADV}></th>
    <th><{$smarty.const._MA_TADADM_PHPINI_ITEM_DESC}></th>
  </tr>

  <{foreach from=$main item=php}>
    <tr>
      <td><{$php.k}></td>
      <td style="color:<{$php.color}>">
        <{$php.global_value}>
      </td>
      <td><{$php.adv}></td>
      <td><div style="line-height:150%"><{$php.ini}></div></td>
    </tr>
  <{/foreach}>
  </table>
</div>