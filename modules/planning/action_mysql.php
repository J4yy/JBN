<?php
 
/**
 * @Project Module Nukeviet 4.x
 * @Author Webvang.vn (hoang.nguyen@webvang.vn)
 * @copyright 2014 J&A.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @createdate 08/10/2014 09:47
 */
if (!defined('NV_IS_FILE_MODULES'))
    die('Stop!!!');
 
$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_plans";
 
$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_plans (
	id MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	user_id MEDIUMINT( 8 ) NOT NULL ,
	title VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	time int(11) unsigned NOT NULL ,
	level int(3) NOT NULL DEFAULT '0' COMMENT '0: low, 1: medium, 2: high' ,
	status BOOLEAN NOT NULL DEFAULT '0' ,
	UNIQUE KEY user_title_time (user_id, title, time)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8";
