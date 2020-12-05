<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2017 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 04/18/2017 09:47
 */

if (! defined('NV_IS_MOD_SEARCH')) {
    die('Stop!!!');
}

// if (file_exists(NV_ROOTDIR . '/modules/' . $m_values['module_file'] . '/language/' . NV_LANG_DATA . '.php')) {
//     require_once NV_ROOTDIR . '/modules/' . $m_values['module_file'] . '/language/' . NV_LANG_DATA . '.php';
// }

// // gioi han tim kiem
// $db->sqlreset()->select('COUNT(*)')
//     ->from($db_config['prefix'] . '_' . $m_values['module_data'] . '_giaoviens')
//     ->where("(" . nv_like_logic(NV_LANG_DATA . '_title', $dbkeywordhtml, $logic) . "
// 		OR " . nv_like_logic(NV_LANG_DATA . '_description', $dbkeywordhtml, $logic) . ")");

// $num_items = $db->query($db->sql())->fetchColumn();

// $db->select('groupid, ' . NV_LANG_DATA . '_title, ' . NV_LANG_DATA . '_alias, ' . NV_LANG_DATA . '_description')
//     ->order('groupid DESC');

// $tmp_re = $db->query($db->sql());

// if ($num_items) {
//     $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=group/';

//     while (list($groupid, $tilterow, $alias, $description) = $tmp_re->fetch(3)) {
//         $content = $description;
//         $url = $link . $alias. $global_config['rewrite_exturl'];

//         $result_array[] = array(
//             'link' => $url,
//             'title' => '[' . $lang_module['group_title'] . '] ' . BoldKeywordInStr($tilterow, $key, $logic),
//             'content' => BoldKeywordInStr($content, $key, $logic)
//         );
//     }
// }