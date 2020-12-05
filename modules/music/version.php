<?php

/**
 * @Project NUKEVIET 4.x
 * @Author ...
 * @Copyright (C) 2020 .... All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 04/12/2020
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$module_version = array(
    'name' => 'Music',
    'modfuncs' => 'main,listen',
    'is_sysmod' => 0,
    'virtual' => 1,
    'version' => '1.0.00',
    'date' => 'Monday, June 22, 2020 16:00:00 GMT+07:00',
    'author' => 'YASUOGOJUNGLE <huynhquocbao0188@gmail.com>',
    'note' => '',
    'uploads_dir' => array(
        $module_upload,
        $module_upload . '/music',
        $module_upload . '/image',
    ),
);
