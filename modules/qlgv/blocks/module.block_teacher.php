<?php

/**
* @Project NUKEVIET 4.x
* @Author DANGDINHTU (dlinhvan@gmail.com)
* @Copyright (C) 2014 Webdep24.com
* @License GNU/GPL version 2 or any later version
* @Createdate 16:58 11/11/2014
*/

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_news_block_teacher' ) ) //kiểm tra xem một block đã được dùng chưa?
{
    function nv_check_theme( $mod_file ) {
        global $global_config;

        // kiểm tra theme chứa block nếu theme đang dùng không có sẽ gọi tới block trong theme mặc định (default) của hệ thống
        if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $mod_file . '/block_teacher.tpl' ) ){
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }
        return $block_theme;
    }

    function nv_news_block_teacher( $block_config ) {
        // gọi các biến sử dụng trong block
        global $site_mods, $global_config, $lang_module, $db, $module_config, $module_info;
        var_dump( $site_mods );
        // xây dựng biến dành cho module từ $site_mods bạn có thể var_dump( $site_mods ) để biết thêm chi tiết
        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];

        $block_theme = nv_check_theme( $site_mods[$module]['module_file'] );

        // gọi thư viện XTemplate
        $xtpl = new XTemplate( 'block_teacher.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/teacher');

        // xuất dữ liệu php ra file tpl
        $xtpl->assign( 'LANG', $lang_module );
        $xtpl->assign( 'TEMPLATE', $block_theme );
        $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );

        /* Truy vấn CSLD module teacher để làm được việc này bạn cần hiểu cấu trúc của csdl module teacher. Bạn có thể đăng nhập
        vào phpmyadmin để xem cấu trúc ở đây mình sẽ truy vấn vào bảng nv4_vi_teacher_blocks
        */

        $sql = 'SELECT bid, title, description, subject, class FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_blocks WHERE bid= 1' . $block_config['numrow'];
        $list = nv_db_cache( $sql, 'bid', $module );

        if( !empty( $list ) ) {
            foreach( $list as $loop ) {
                $loop['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $global_array_cat[$loop['catid']]['alias'] . '/' . $loop['alias'] . '-' . $loop['id'] . $global_config['rewrite_exturl'];
                 //tạo đường dẫn tới chi tiết bài viết

                $xtpl->assign( 'LOOP', $loop );
                $xtpl->parse( 'main.loop' );
            }
        }

        $xtpl->parse( 'main' );
        return $xtpl->text( 'main' );
    }

    function nv_block_config_teacher( $module, $data_block, $lang_block ) {
        global $nv_Cache, $site_mods, $selectthemes, $lang_module;

        $xtpl = new XTemplate( 'block_teacher.tpl', NV_ROOTDIR . '/themes/' . $selectthemes . '/modules/' . $module );
        $xtpl->assign( 'LANG', $lang_block );
        $xtpl->assign( 'CONFIG', $data_block );

        $xtpl->parse( 'config' );
        return $xtpl->text( 'config' );
    }

    function nv_block_config_teacher_submit( $module, $lang_block ) {
        global $nv_Request;

        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );

        return $return;
    }
}

if ( defined( 'NV_SYSTEM' ) ) {
    $content = nv_news_block_teacher( $block_config );
}