<?php

/**
 * @Project SHOPS 4.3.10
 * @Author Bin (JBN)
 * @Copyright (C) 2020 BinPC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 11/18/2020 2:47 PM
 */

if (! defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

// require NV_ROOTDIR . '/modules/' . $module_file . '/ssp.class.php';

// khai báo $constant để sử dụng hằng số trong 1 string với dạng $constant('<hằng số>');
$constant = 'constant';

// khai báo các table cần thiết
$prefix = "{$db_config['prefix']}_{$module_data}";
$rows_table = "{$prefix}_rows";
$shops_table = "{$prefix}_shops";
$shops_rows_table = "{$prefix}_shops_rows";

// check shop tồn tại
$shop_id = $nv_Request->get_string('shop_id', 'get', 0);
$shop = null;
if (!$shop_id) {
	return;
} else {
	$shop = $db->query("SELECT * FROM {$shops_table} WHERE id={$shop_id}")->fetch();
	if (!$shop) {
		return;
	}
}

// load template
$xtpl = new XTemplate('addrow.tpl', NV_ROOTDIR . "/themes/{$global_config['module_theme']}/modules/{$module_file}/shop");
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('SHOP', $shop);

// xử lý submit ở đây
if ($nv_Request->get_string('list_id_add', 'post') || $nv_Request->get_string('list_id_remove', 'post')) {

	if ($nv_Request->get_string('list_id_add', 'post')) {
		$list_id = $nv_Request->get_string('list_id_add', 'post', false);
	} else {
		$list_id = $nv_Request->get_string('list_id_remove', 'post', false);
	}

	// convert string to array list_id
	$str_id = rtrim($list_id, ',');
	$list_id = explode(',', $str_id);
	$values = '';
	foreach ($list_id as $row_id) {
		$values .= "({$shop_id}, {$row_id}),";
	}
	$values = rtrim($values, ',');

	if ($nv_Request->get_string('list_id_add', 'post')) {
		$sql = "INSERT INTO {$shops_rows_table}(shop_id, row_id) VALUES $values";
	} else {
		$sql = "DELETE FROM {$shops_rows_table} WHERE row_id IN ({$str_id})";
	}
	$q = $db->query($sql);
	if ($q->rowCount()) {
		$alert = ['type' => 'alert-success', 'message' => $lang_module['success_msg']];
	} else {
		$alert = ['type' => 'alert-danger', 'message' => $lang_module['error_msg']];
	}
	$xtpl->assign('ALERT', $alert);
	$xtpl->parse('main.alert');
}

// query các row còn lại không có trong table shops_rows vào bảng bên trái
$rows = $db->query("
	SELECT r.id, listcatid, user_id, homeimgfile, homeimgthumb, {$constant('NV_LANG_DATA')}_title, {$constant('NV_LANG_DATA')}_alias, r.status, edittime, username
	FROM {$rows_table} AS r
		LEFT JOIN {$constant('NV_USERS_GLOBALTABLE')} AS u ON r.user_id=u.userid
	WHERE r.id NOT IN (SELECT row_id FROM {$shops_rows_table} WHERE shop_id={$shop_id})
");

// query các rows có trong table đang chọn
$inShop = $db->query("
	SELECT r.id, r.listcatid, r.homeimgfile, r.homeimgthumb, r.{$constant('NV_LANG_DATA')}_title, r.{$constant('NV_LANG_DATA')}_alias, r.status
	FROM `{$shops_rows_table}` AS sr
		LEFT JOIN {$rows_table} AS r ON sr.row_id=r.id
	WHERE shop_id={$shop_id}
");

// loop table row
while (list($id, $listcatid, $admin_id, $homeimgfile, $homeimgthumb, $title, $alias, $status, $edittime, $username) = $rows->fetch(3)) {
	$title = nv_clean60($title);
	$edittime = nv_date('H:i d/m/y', $edittime);

	if ($homeimgthumb == 1) {
		$thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $homeimgfile;
	}

	$xtpl->assign('ROW', array(
	        'id' => $id,
	        'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_array_shops_cat[$listcatid]['alias'] . '/' . $alias . $global_config['rewrite_exturl'],
	        'title' => $title,
	        'edittime' => $edittime,
	        'admin_id' => !empty($username) ? $username : '',
	        'thumb' => $thumb
	    ));
	$xtpl->parse('main.row_loop');
}

// loop table row in shop
while (list($id, $listcatid, $homeimgfile, $homeimgthumb, $title, $alias, $status) = $inShop->fetch(3)) {
	$title = nv_clean60($title);

	if ($homeimgthumb == 1) {
		$thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $homeimgfile;
	}

	$xtpl->assign('ROW', array(
	        'id' => $id,
	        'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_array_shops_cat[$listcatid]['alias'] . '/' . $alias . $global_config['rewrite_exturl'],
	        'title' => $title,
	        'thumb' => $thumb
	    ));
	$xtpl->parse('main.shoprow_loop');
}

// load template main for the end
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
