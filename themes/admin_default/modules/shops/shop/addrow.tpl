<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css">

<div class="row">
	<div class="col-md-24">
		<div class="well" style="text-align: center; font-weight: bold; font-size: 24px;">{SHOP.name}</div>
	</div>
</div>
<!-- BEGIN: alert -->
<div class="alert {ALERT.type}">
	{ALERT.message}
</div>
<!-- END: alert -->

<div class="row">
	<div class="col-md-12">
		<form class="form-inline" id="rows-form" method="post">
			<input type="hidden" name="list_id_add" value="">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover rows-tbl">
					<caption>{LANG.current_product}</caption>
					<thead>
						<tr>
							<th class="text-center"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" /></th>
							<th style="width:40px">&nbsp;</th>
							<th>{LANG.name}</th>
						</tr>
					</thead>
					<tbody>
						<!-- BEGIN: row_loop -->
						<tr>
							<td class="text-center"><input type="checkbox" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);" value="{ROW.id}" name="idcheck[]"></td>
							<td>
								<img src="{ROW.thumb}" alt="{ROW.title}" width="40"/>
							</td>
							<td>
								<p><a target="_blank" href="{ROW.link}">{ROW.title}</a></p>
								<div class="product-info">
									{LANG.order_update}: <span class="other">{ROW.edittime}</span> |
									{LANG.content_admin}: <span class="other">{ROW.admin_id}</span>
								</div>
							</td>
						</tr>
						<!-- END: row_loop -->
					</tbody>
					<tfoot>
						<tr align="right">
							<td colspan="3">
								<input type="button" class="btn btn-primary" onclick="pushTable(event, this.form, 'idcheck[]','{LANG.msgnocheck}')" value=">>"></input>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</form>
	</div>
	<div class="col-md-12">
		<form id="shops-rows-form" class="form-inline" method="post">
			<input type="hidden" name="list_id_remove" value="">
			<div class="table-responsive">
				<table class="table table-bordered rows-tbl">
					<caption>{LANG.product_in_shop}</caption>
					<thead>
						<tr>
							<th class="text-center"><input name="check_all2[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck2[]', 'check_all2[]',this.checked);" /></th>
							<th style="width:40px">&nbsp;</th>
							<th>{LANG.name}</th>
						</tr>
					</thead>
					<tbody>
						<!-- BEGIN: shoprow_loop -->
						<tr>
							<td class="text-center"><input type="checkbox" onclick="nv_UncheckAll(this.form, 'idcheck2[]', 'check_all2[]', this.checked);" value="{ROW.id}" name="idcheck2[]"></td>
							<td>
								<img src="{ROW.thumb}" alt="{ROW.title}" width="40"/>
							</td>
							<td>
								<p><a target="_blank" href="{ROW.link}">{ROW.title}</a></p>
							</td>
						</tr>
						<!-- END: shoprow_loop -->
					</tbody>
					<tfoot>
						<tr align="left">
							<td colspan="3"><input type="button" class="btn btn-warning" onclick="pushTable(event, this.form, 'idcheck2[]','{LANG.msgnocheck}')" value="<<"></input></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</form>
	</div>
</div>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type='text/javascript'>
	$('.alert').fadeOut(3e3);

	function pushTable(e, oForm, name, msgnocheck) {
		var fa = oForm[name];
		var listid = '';
		if (fa.length) {
			for (var i = 0; i < fa.length; i++) {
				if (fa[i].checked) {
					listid = listid + fa[i].value + ',';
				}
			}
		} else {
			if (fa.checked) {
				listid = listid + fa.value + ',';
			}
		}
		if (listid != '') {
			if (e.target.value === '>>') {
				$('[name=list_id_add]').val(listid);
				$('#rows-form').submit();
			} else {
				$('[name=list_id_remove]').val(listid);
				$('#shops-rows-form').submit();
			}
		} else alert(msgnocheck);
	}

	$(function() {
		$('table.rows-tbl').dataTable({
			columnDefs: [
				{bSortable: false, targets: [0,1]} 
			],
		});
	});

	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!-- END: main -->