<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 24-06-2011 10:35
 */

if (! defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

if (defined('NV_EDITOR')) {
    require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
}

$page_title = $lang_module['block_list'];

//Nhận thông tin khối để sửa và thêm
if ($nv_Request->isset_request('getinfo', 'post')) {
    $bid = $nv_Request->get_int('bid', 'post', '0');

    $array = array();

    if ($bid) {
        $sth = $db->prepare('SELECT title, description, subject, class FROM ' . NV_PREFIXLANG . '_' . $module_data . '_blocks WHERE bid=:bid');
        $sth->bindParam(':bid', $bid, PDO::PARAM_INT);
        $sth->execute();
        $array = $sth->fetch();
    }

    $message = $array ? '' : 'Invalid post data';

    nv_jsonOutput(array(
        'status' => ! empty($array) ? 'success' : 'error',
        'message' => $message,
        'data' => $array
    ));
}


// xóa giáo viên
if ($nv_Request->isset_request('del', 'post')) {
    $bid = $nv_Request->get_int('bid', 'post', '0');
    $message = '';

    if ($bid) {
        $sth = $db->prepare('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_blocks WHERE bid=:bid');
        $sth->bindParam(':bid', $bid, PDO::PARAM_INT);
        $sth->execute();

        // if ($sth->rowCount()) {
        //     $sth = $db->prepare('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE bid=:bid');
        //     $sth->bindParam(':bid', $bid, PDO::PARAM_INT);
        //     $sth->execute();

        //     nv_insert_logs(NV_LANG_DATA, $module_name, 'Del Block', 'ID:' . $bid, $admin_info['userid']);
        //     $nv_Cache->delMod($module_name);
        // } else {
        //     $message = 'Nothing to do!';
        // }
    } else {
        $message = 'Invalid post data';
    }

    nv_jsonOutput(array(
        'status' => ! $message ? 'success' : 'error',
        'message' => $message,
    ));
}

// thêm /sữa
if ($nv_Request->isset_request('submit', 'post')) {
    $data = $error = array();
    $message = '';

    $data['bid'] = $nv_Request->get_int('bid', 'post', 0);
    $data['title'] = nv_substr($nv_Request->get_title('title', 'post', ''), 0, 255);
    $data['description'] = $nv_Request->get_title('description', 'post', '');
    $data['subject'] = nv_substr($nv_Request->get_title('subject', 'post', ''), 0, 255);
    $data['class'] = nv_substr($nv_Request->get_title('class', 'post', ''), 0, 255);

    if (empty($data['title']) || empty($data['description']) || empty($data['subject'])) { //kiem tra du lieu title neu chua den bao loi
        if (empty($data['title'])) {
            $error[] = array(
                'name' => 'title',
                'value' => $lang_module['block_title_error']
            );
        }
        if (empty($data['description'])) {
            $error[] = array(
                'name' => 'description',
                'value' => $lang_module['block_description_error']
            );
        }
        if (empty($data['subject'])) {
            $error[] = array(
                'name' => 'subject',
                'value' => $lang_module['block_subject_error']
            );
        }
    } else {
        if ($data['bid']) {
            $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_blocks SET title = :title, description = :description, subject = :subject, class = :class WHERE bid = ' . $data['bid'];
        } else {
            $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_blocks (title, description, subject, class) VALUES (:title, :description, :subject, :class)';
        }

        try {
            $sth = $db->prepare($sql);
            $sth->bindParam(':title', $data['title'], PDO::PARAM_STR);
            $sth->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $sth->bindParam(':subject', $data['subject'], PDO::PARAM_STR);
            $sth->bindParam(':class', $data['class'], PDO::PARAM_STR);
            $sth->execute();

            if ($sth->rowCount()) {
                if ($data['bid']) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Block', 'ID: ' . $data['bid'], $admin_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Block', $data['title'], $admin_info['userid']);
                }

                $nv_Cache->delMod($module_name);
                $message = $lang_module['save_success'];
            } else {
                $error[] = array(
                    'name' => '',
                    'value' => $lang_module['error_save']
                );
            }
        } catch (PDOException $e) {
            $error[] = array(
                'name' => '',
                'value' => $lang_module['error_save']
            );
        }
    }

    nv_jsonOutput(array(
        'status' => empty($error) ? 'success' : 'error',
        'message' => $message,
        'error' => $error
    ));
}

// Write row
$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_blocks ORDER BY bid DESC';
$array = $db->query($sql)->fetchAll();

$hometext = htmlspecialchars(nv_editor_br2nl(''));
$edits = nv_aleditor('hometext', '100%', '150px', $hometext, 'Basic');
$xtpl->assign('edit_hometext', $edits);

$bodytext = htmlspecialchars(nv_editor_br2nl(''));
$edits = nv_aleditor('bodytext', '100%', '150px', $bodytext, 'Basic');
$xtpl->assign('edit_bodytext', $edits);

if (sizeof($array) < 1) {
    $xtpl->parse('main.empty');
} else {
    foreach ($array as $row) {
        $row['link'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=list&amp;bid=' . $row['bid'];

        $xtpl->assign('ROW', $row);
        $xtpl->parse('main.rows.loop');
    }

    $xtpl->parse('main.rows');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';