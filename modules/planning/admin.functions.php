<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Bin (JBN)
 * @Copyright (C) 2020 BinPC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 15 Nov 2020
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN')) die('Stop!!!');

define('NV_IS_CALLME_ADMIN', true);

// khai báo những function được phép chạy trong folder admin
$allow_func = array(
    'main'
);

/*
 * @param string $module_theme
 * @param string $module_theme
 * return $xtpl
 */
function nv_admin_viewphone($module_theme, $module_file) {
	$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $module_theme . '/modules/' . $module_file);

	$xtpl->parse('main');
	return $xtpl->text('main');
}
