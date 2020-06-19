<?php

/** Dump to JSON format
 * @link https://www.adminer.org/plugins/#use
 * @author Adrian Andreescu, https://github.com/gremki
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */
class AdminerDumpArray {
	/** @var bool */
	protected $database = false;

	function dumpFormat() {
		return array('array' => 'PHP Array');
	}

	function dumpTable($table, $style, $is_view = false) {
		if ($_POST["format"] == "array") {
			return true;
		}
	}

	function dumpData($table, $style, $query) {

		if ($_POST["format"] == "array") {
			$connection = connection();
			$result = $connection->query($query, 1);
			$table = $table ?: 'data';

			if (!$this->database) {
				$this->database = true;
				echo "<?php\n//" . h(DB) . " database export\n";
			}

			if ($result) {
				echo "/** @var array " . h($table) . " table data */\n";
				echo "$" . addcslashes($table, "\r\n\"\\") . " = [\n";
				while ($row = $result->fetch_assoc()) {
					var_export($row);
					echo ",\n";
				}
				echo "];\n";
			}
			return true;
		}
	}

	function dumpHeaders($identifier, $multi_table = false) {
		if ($_POST["format"] == "array") {
			$identifier = $identifier ?: 'data';
			header("Content-Type: ".($_POST['output'] == 'text' ? 'text/plain' : 'application/x-php')."; charset=utf-8");
			return "php";
		}
	}
}
