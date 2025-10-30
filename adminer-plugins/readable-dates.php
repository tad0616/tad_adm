<?php

/** This plugin replaces UNIX timestamps with human-readable dates in your local format.
 * Mouse click on the date field reveals timestamp back.
 *
 * @link https://www.adminer.org/plugins/#use
 * @author Anonymous
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */
class AdminerReadableDates
{
    /** @access protected */
    public $prepend;

    public function __construct()
    {
        $this->prepend = <<<EOT

document.addEventListener('DOMContentLoaded', function(event) {
	var date = new Date();
	var tds = document.querySelectorAll('td[id^="val"]');

	// UNIX timestamp 的合理範圍 (1970-2038年)
	var minTimestamp = 0;          // 1970-01-01
	var maxTimestamp = 2147483647; // 2038-01-19 (32位系統最大值)

	for (var i = 0; i < tds.length; i++) {
		var text = tds[i].innerHTML.trim();

		// 檢查是否為10位數字
		if (text.match(/^\d{10}$/)) {
			var timestamp = parseInt(text);

			// 檢查是否在合理的時間戳範圍內
			// 排除以09開頭的數字（台灣手機號碼常見格式）
			if (timestamp >= minTimestamp &&
			    timestamp <= maxTimestamp &&
			    !text.match(/^09/)) {

				date.setTime(timestamp * 1000);
				tds[i].oldDate = text;

				// tds[i].newDate = date.toUTCString().substr(5); // UTC format
				tds[i].newDate = date.toLocaleString();	// Local format
				// tds[i].newDate = date.toLocaleFormat('%e %b %Y %H:%M:%S'); // Custom format - works in Firefox only

				tds[i].newDate = '<span style="font-size:11px;color: #009900" title="' + tds[i].oldDate + '">' + tds[i].newDate + '</span>';
				tds[i].innerHTML = tds[i].newDate;
				tds[i].dateIsNew = true;

				tds[i].addEventListener('click', function(event) {
					this.innerHTML = (this.dateIsNew ? this.oldDate : this.newDate);
					this.dateIsNew = !this.dateIsNew;
				});
			}
		}
	}
});

EOT;
    }

    public function head()
    {
        echo Adminer\script($this->prepend);
    }
}
