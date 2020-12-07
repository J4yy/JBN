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

$page_title = $lang_module['student_title'];

//Nhận thông tin khối để sửa và thêm
if ($nv_Request->isset_request('getinfo', 'post')) {
    $bid = $nv_Request->get_int('bid', 'post', '0');

    $array = array();

    if ($bid) {
        $sth = $db->prepare('SELECT name, faculty, course, class FROM ' . NV_PREFIXLANG . '_' . $module_data . '_students WHERE bid=:bid');
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
        $sth = $db->prepare('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_students WHERE bid=:bid');
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
    $data['name'] = nv_substr($nv_Request->get_title('name', 'post', ''), 0, 255);
    $data['faculty'] = $nv_Request->get_title('faculty', 'post', '');
    $data['course'] = nv_substr($nv_Request->get_title('course', 'post', ''), 0, 255);
    $data['class'] = nv_substr($nv_Request->get_title('class', 'post', ''), 0, 255);

    if (empty($data['name']) || empty($data['faculty']) || empty($data['course'])) { //kiem tra du lieu title neu chua den bao loi
        if (empty($data['name'])) {
            $error[] = array(
                'name' => 'name',
                'value' => $lang_module['block_name_error']
            );
        }
        if (empty($data['faculty'])) {
            $error[] = array(
                'name' => 'faculty',
                'value' => $lang_module['block_faculty_error']
            );
        }
        if (empty($data['course'])) {
            $error[] = array(
                'name' => 'course',
                'value' => $lang_module['block_course_error']
            );
        }
    } else {
        if ($data['bid']) {
            $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_students SET name = :name, faculty = :faculty, course = :course, class = :class WHERE bid = ' . $data['bid'];
        } else {
            $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_students (name, faculty, course, class) VALUES (:name, :faculty, :course, :class)';
        }

        try {
            $sth = $db->prepare($sql);
            $sth->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $sth->bindParam(':faculty', $data['faculty'], PDO::PARAM_STR);
            $sth->bindParam(':course', $data['course'], PDO::PARAM_STR);
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
$xtpl = new XTemplate('student.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_students ORDER BY bid DESC';
$array = $db->query($sql)->fetchAll();

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