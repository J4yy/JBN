<?php

/**
 * @Project SHOPS 4.3.10
 * @Author Bin (JBN)
 * @Copyright (C) 2020 BinPC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 11/18/2020 2:47 PM
 */

// this func is ajax
if (! defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

if (!$id = $nv_Request->get_int('id', 'post', 0)) {
	return;
}

$table = $db_config['prefix'] . '_' . $module_data . '_shops';
$q = $db->prepare("SELECT id, name, phone, address, description, status FROM {$table} WHERE id=:id");
$q->bindParam(':id', $id);
if ($q->execute()) {
	echo json_encode($q->fetch());
}
