<?php

/**
 * @Project SHOPS 4.3.10
 * @Author Bin (JBN)
 * @Copyright (C) 2020 BinPC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 11/18/2020 2:47 PM
 */

if (! defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

$table = $db_config['prefix'] . '_' . $module_data . '_shops';

// tạo session csrf for security submit form multiple time
if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = time();
}

// load template
$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . "/themes/{$global_config['module_theme']}/modules/{$module_file}/shop");

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE;
$xtpl->assign('GET_INFOSHOP', "{$base_url}=shopinfo");
$xtpl->assign('MODULE_UPLOAD', $module_upload);

// tạo folder shop để upload data nếu chưa có
$currentpath = NV_UPLOADS_DIR . '/' . $module_upload . '/shops';
if (!file_exists($currentpath)) {
    nv_mkdir(NV_UPLOADS_REAL_DIR . '/' . $module_upload, 'shops', true);
}

// chống submit nhiều lần
if (isset($_SESSION['csrf']) && $_SESSION['csrf'] == $nv_Request->get_string('csrf', 'post', '')) {
    $_SESSION['csrf'] = time();
    $id_shop = $nv_Request->get_string('id_shop', 'post', 0);

    if ($nv_Request->get_string('act', 'post') == 'save') {
        $name = $nv_Request->get_string('name', 'post');
        $address = $nv_Request->get_string('address', 'post');
        $phone = $nv_Request->get_string('phone', 'post');
        $description = $nv_Request->get_string('description', 'post');
        $status = $nv_Request->get_int('status', 'post', 0);
        $img = $nv_Request->get_string('image', 'post', 0);
        $weight = 0;

        function alert($record) {
            global $id_shop, $name, $address, $phone, $description, $img, $weight, $status, $lang_module;

            if ($id_shop) {
                $record->bindParam(':id', $id_shop, PDO::PARAM_INT);
            }
            $record->bindParam(':name', $name, PDO::PARAM_STR);
            $record->bindParam(':address', $address, PDO::PARAM_STR);
            $record->bindParam(':phone', $phone, PDO::PARAM_STR);
            $record->bindParam(':description', $description, PDO::PARAM_STR);
            $record->bindParam(':image', $img, PDO::PARAM_STR);
            $record->bindParam(':status', $status, PDO::PARAM_INT);
            $record->bindParam(':weight', $weight, PDO::PARAM_INT);
            $record->execute();

            $alert = ['type' => '', 'message' => ''];

            if ($record->rowCount()) {
                $alert['type'] = 'alert-success';
                $alert['message'] = $lang_module['success_msg'];
            } else {
                $alert['type'] = 'alert-danger';
                $alert['message'] = $lang_module['errorsave'];
            }

            return $alert;
        }
        
        if ($id_shop) {
            $sql = "UPDATE {$table} SET name=:name, address=:address, phone=:phone, image=:image, weight=:weight, description=:description, status=:status WHERE id=:id";
        } else {
            $sql = "INSERT INTO {$table}(name, address, phone, image, weight, description, status) VALUES (:name, :address, :phone, :image, :weight, :description, :status)";
        }
        $xtpl->assign('ALERT', alert($db->prepare($sql)));
    } elseif ($nv_Request->get_string('act', 'post') == 'delete') {
        // xóa shop
        $q = $db->prepare("DELETE FROM {$table} WHERE id=:id");
        $q->bindParam(':id', $id_shop);
        $q->execute();
        $msg = $q->rowCount() ? $lang_module['success_delete'] : $lang_module['error_delete'];
        $xtpl->assign('ALERT', ['type' => 'alert-success', 'message' => $msg]);
    }
    $xtpl->parse('main.message');
}

$xtpl->assign('LANG', $lang_module);
$xtpl->assign('CSRF', $_SESSION['csrf']);

$stores = $db->query("SELECT * FROM {$table}")->fetchAll();
foreach ($stores as $k => $store) {
    if (empty($store['image'])) {
        $store['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/{$module_file}/default_shop.jpg";
    }
    $xtpl->assign('STORE', $store);
    $xtpl->assign('ADDROWTOSHOP', "{$base_url}=addrowtoshop&shop_id={$store['id']}");
    $xtpl->parse('main.each_row.each_store');

    // mỗi 4 ô store sẽ parse row
    if (($k+1) % 4 == 0) {
        $xtpl->parse('main.each_row');
    }
}
// nếu dư sản phẩm thì parse row lần cuối
if (count($stores) % 4 > 0) {
    $xtpl->parse('main.each_row');
}

// load template main for the end
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
