CREATE TABLE `tad_adm` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT 0 COMMENT 'uid',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT 'email',
  `result` smallint(5) unsigned NOT NULL DEFAULT 0 COMMENT '檢查結果',
  `chk_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '檢查日',
  PRIMARY KEY (`uid`),
  KEY `idx_result_uid` (`result`, `uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
