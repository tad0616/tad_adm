<?php

/**
 * Show the history of the latest selected tables. Cookies based.
 * Set the js variable history_length to define the history length.
 * Works only with current browsers.
 * @link http://www.adminer.org/plugins/#use
 * @author Ale Rimoldi, http://www.ideale.ch/
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */
class AdminerTablesHistory
{

    public function tablesPrint($tables)
    {
        ?>
<script type="text/javascript"<?php echo Adminer\nonce(); ?>>

	history_length = 5;

    function setCookie(c_name, value, exdays) {
      var exdate = new Date();
      exdate.setDate(exdate.getDate() + exdays);
      var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
      document.cookie = c_name + "=" + c_value;
    }

    function getCookie(c_name) {
      var i, x, y, ARRcookies = document.cookie.split(";");
      for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
          return unescape(y);
        }
      }
	  return "";
    }

	function addToHistory(table) {
		console.log(table);

		var history_array = [];
		var history_cookie = getCookie('adminer_tables_history');
		if (history_cookie != '') {
			history_array = JSON && JSON.parse(history_cookie)
		}
		if (history_array.indexOf(table) == -1) {
			if (history_array.length >= history_length) {
				history_array.splice(0, 1);
			}
			history_array.push(table)
			setCookie('adminer_tables_history', JSON.stringify(history_array), 10)
		}
	}

	document.addEventListener('DOMContentLoaded', function() {
    var tables = document.getElementById('tables').getElementsByTagName('a');
    for (var i = 0; i < tables.length; i += 2) {
        (function(text) {
            if (tables[i]) {
                tables[i].addEventListener('click', function() {
                    addToHistory(text);
                });
            }
            if (tables[i + 1]) {
                tables[i + 1].addEventListener('click', function() {
                    addToHistory(text);
                });
            }
        })((tables[i + 1].innerText || tables[i + 1].textContent));
    }
});
</script>
<?php if (array_key_exists('adminer_tables_history', $_COOKIE)): ?>
<div class="history">
    <span class="title"><?php echo Adminer\lang('Table') . Adminer\lang('History'); ?></span>
</div>
<ul id="history">
<?php
foreach (array_reverse(json_decode($_COOKIE['adminer_tables_history'])) as $table) {
            echo '<li>
        <a href="' . Adminer\h(Adminer\ME) . 'select=' . urlencode($table) . '" class="select"></a>
        <a href="' . Adminer\h(Adminer\ME) . 'table=' . urlencode($table) . '" class="structure">' . Adminer\h($table) . '</a>
        </li>';
        }
        ?>
</ul>
<?php endif; ?>
<?php
return null;
    }

}
