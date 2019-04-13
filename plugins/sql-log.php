<?php

/** Log all queries to SQL file (manual queries through SQL command are not logged)
 * @link https://www.adminer.org/plugins/#use
 * @author Jakub Vrana, https://www.vrana.cz/
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */
class AdminerSqlLog
{
    /** @access protected */
    public $filename;

    /**
     * @param string defaults to "$database.sql"
     * @param mixed $filename
     */
    public function __construct($filename = '')
    {
        $this->filename = $filename;
    }

    public function messageQuery($query, $time, $failed = false)
    {
        $this->_log($query);
    }

    public function sqlCommandQuery($query)
    {
        $this->_log($query);
    }

    public function _log($query)
    {
        if ('' == $this->filename) {
            $adminer = adminer();
            $this->filename = $adminer->database() . '.sql'; // no database goes to ".sql" to avoid collisions
        }
        $fp = fopen($this->filename, 'ab');
        flock($fp, LOCK_EX);
        fwrite($fp, $query);
        fwrite($fp, "\n\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}
