<?php
// ----------------------------------------------------------------------
// Copyright (C) 2007 by Abdul-Aziz Al-Oraij.
// http://aziz.oraij.com/
// ----------------------------------------------------------------------
// LICENSE

// This program is open source product; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Class Name: FTP Folder Copy/Delete
// Filename:   ftp.class.php
// Original    Author(s): Abdul-Aziz Al-Oraij <aziz.oraij.com>
// Purpose:    Copy to/Delete from FTP folders recursively.
// ----------------------------------------------------------------------
// Bismillah..
class ftp
{
    public $conn_id;
    public $natij=array();
    public $orgDir;

    public function ftp($ftp_server="localhost")
    {
        $this->conn_id = ftp_connect($ftp_server);
    }
    public function connect($user, $pass, $path = "/")
    {
        if (@ftp_login($this->conn_id, $user, $pass)) {
            return ftp_nlist($this->conn_id, $path);
        } else {
            return false;
        }
    }
    public function quit($conn_id = null)
    {
        $conn_id = $conn_id ==null ? $this->conn_id : $conn_id ;
        ftp_quit($conn_id);
    }
    public function rmAll($dst_dir, $debug = 0)
    {
        if (!$dst_dir) {
            return false;
            exit;
        }
        $dst_dir = preg_replace("/\\/\$/", "", $dst_dir); // remove trailing slash
        $ar_files = ftp_nlist($this->conn_id, $dst_dir);
        if (is_array($ar_files)) { // makes sure there are files
            if (count($ar_files)==1) { // if its only a file
                return ftp_delete($this->conn_id, $ar_files[0]);
            } else {
                foreach ($ar_files as $st_file) { // for each file
                    if ($st_file == "." || $st_file == "..") {
                        continue 1;
                    }
                    $fl_file = "$dst_dir/$st_file";
                    $ftp_size = ftp_size($this->conn_id, $fl_file);
                    if ($ftp_size == -1) { // check if it is a directory
                        $this->rmAll($fl_file); // if so, use recursion
                    } else {
                        if ($debug) {
                            echo "File: $fl_file | $ftp_size\n";
                        } else {
                            ftp_delete($this->conn_id, $fl_file);
                        } // if not, delete the file
                    }
                }
            }
        }
        if ($debug) {
            echo "Dir: $dst_dir \n";
        } elseif (count($ar_files)!=1) {
            echo @ftp_rmdir($this->conn_id, $dst_dir) ? "$dst_dir deleted!\n":"Can't remove $dst_dir: No such file or directory";
        } // delete empty directories
    }
    public function log($result)
    {
        if ($result == "print") {
            foreach ($this->natij as $key => $value) {
                if ($key == "site" || $key == "put" || $key == "mkdir") {
                    echo "<font color=green>$value ".($key=="put"?"Files uploaded":($key=="mkdir"?"Folders created":"Permissions changed"))." successfully.</font>\n";
                } else {
                    echo "<font color=red>Failed to: $value </font>\n";
                }
            }
        } else {
            $result == "site" || $result == "put" || $result == "mkdir" ? $this->natij[$result]++ : $this->natij[] = $result;
        }
    }
    public function get_mod($dir)
    {
        $stat =  stat($dir);
        $mode = substr(decoct($stat[mode]), -3);
        if ($mode=="777") {
            $this->log("$dir mode is 777!!");
        }
        return $mode;
    }
    public function copy($local, $remote)
    {
        if (!$this->orgDir) {
            $this->orgDir = realpath($local);
            if (!is_dir($local)) {
                $this->file_copy($local, $remote);
                return true;
            } else {
                $local = realpath($local)."/";
                if (!@ftp_chdir($this->conn_id, $remote)) {
                    $this->mkdir($local, $remote);
                }
            }
        }
        if ($open = opendir($local)) {
            while (false !== ($file = readdir($open))) {
                if ($file != "." && $file != "..") {
                    $remote_file = $remote.substr(realpath($local.$file), strlen($this->orgDir));
                    $local_file = $local.$file;
                    if (!is_dir($local_file)) {
                        $this->file_copy($local_file, $remote_file);
                    } else {
                        $this->mkdir($local_file, $remote_file);
                        $this->copy($local . $file . "/", $remote);
                    }
                }
            }
            closedir($open);
        }
    }
    public function mkdir($local, $remote)
    {
        $site = "CHMOD ".$this->get_mod($local)." $remote";
        @ftp_mkdir($this->conn_id, $remote)?$this->log("mkdir"):$this->log("mkdir $remote");
        ftp_site($this->conn_id, $site) ? $this->log("site") : $this->log($site);
    }
    public function file_copy($local, $remote)
    {
        $site = "CHMOD ".$this->get_mod($local)." $remote";
        ftp_put($this->conn_id, $remote, $local, FTP_BINARY)?$this->log("put"):$this->log("put $local in $remote");
        ftp_site($this->conn_id, $site)?$this->log("site"):$this->log($site);
    }
};
