<?php
 
/**
 * @Project NUKEVIET 4.x
 * @Author Bin (JBN)
 * @Copyright (C) 2020 BinPC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 15 Nov 2020
 */
 
if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nv_callme_blocks')) {
    function nv_callme_blocks($block_config) {
        global $db, $module_name;
        
        $blgroup = $db->query('SELECT link FROM ' . NV_BLOCKS_TABLE . '_groups WHERE module="callme"')->fetch();
        $xtpl = new XTemplate('global.block_callme.tpl', NV_ROOTDIR . '/modules/' . $block_config['module'] . '/blocks');
        $xtpl->assign('LINK', $blgroup['link']);
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_callme_blocks($block_config);
}
