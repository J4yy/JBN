function nv_chang_sources(sourceid, mod) {
    var nv_timer = nv_settimeout_disable('id_' + mod + '_' + sourceid, 5000);
    var new_vid = $('#id_' + mod + '_' + sourceid).val();
    $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_source&nocache=' + new Date().getTime(), 'sourceid=' + sourceid + '&mod=' + mod + '&new_vid=' + new_vid, function(res) {
        var r_split = res.split('_');
        if (r_split[0] != 'OK') {
            alert(nv_is_change_act_confirm[2]);
        }
        clearTimeout(nv_timer);
        nv_show_list_source();
    });
    return;
}