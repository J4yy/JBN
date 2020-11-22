<!-- BEGIN: main -->
<div class="row">
    <div class="col-lg-3 pull-right">
        <button class="btn btn-primary" data-toggle="collapse" data-target="#create">Tạo cửa hàng</button>
    </div>
</div>

<br />

<!-- BEGIN: message -->
<div class="alert {ALERT.type}">{ALERT.message}</div>
<!-- END: message -->

<br />

<div class="row">
    <div id="create" class="collapse in">
        <div class="col-md-push-5 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin cửa hàng</div>
                <div class="panel-body">
                    <form id="form-shop" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf" value="{CSRF}">
                        <input type="hidden" name="act" value="save">
                        <input type="hidden" name="id_shop" id="id_shop" value="0">
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="name">Tên:</label>
                            <div class="col-sm-17">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Điền tên cửa hàng" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="address">Địa chỉ:</label>
                            <div class="col-sm-17">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Điền địa chỉ" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="phone">Sđt:</label>
                            <div class="col-sm-17">
                                <input type="number" class="form-control" id="phone" name="phone" min="10" placeholder="Điền số điện thoại (nếu có)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="description">Mô tả:</label>
                            <div class="col-sm-17">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Điền mô tả (nếu có)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="image">Hình ảnh:</label>
                            <div class="col-sm-17">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="image" id="image" value="" placeholder="Có thể để trống" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" id="selectimg">
                                            <em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="status">Trạng thái:</label>
                            <div class="col-sm-17">
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-warning"
                                        onclick="event.preventDefault();
                                                document.getElementById('form-shop').reset();
                                                document.getElementById('id_shop').value = 0;">Reset</button>
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN: each_row -->
<div class="row">
    <!-- BEGIN: each_store -->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Tên cửa hàng: {STORE.name}</div>
            <div class="panel-body">
                <img class="img-responsive img-rounded" src="{STORE.image}" alt="default store image">
                {LANG.address}: {STORE.address}<br />
                {LANG.order_phone}: {STORE.phone}<br />
            </div>
            <div class="panel-footer">
                <div class="btn-group">
                    <a type="button" href="{ADDROWTOSHOP}" class="btn btn-primary">
                        Thêm sản phẩm
                    </a>
                    <button type="button" onclick="editShop({STORE.id})" class="btn btn-info">Sửa</button>
                    <button type="button" class="btn btn-danger"
                            onclick="delShop()">
                        Xóa
                    </button>
                    <form id="delete-shop-{STORE.id}" action="" method="post">
                        <input type="hidden" name="csrf" value="{CSRF}">
                        <input type="hidden" name="act" value="delete">
                        <input type="hidden" name="id_shop" value="{STORE.id}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: each_store -->
</div>
<!-- END: each_row -->

<script>
    $('.alert').fadeOut(3e3);

    $("#selectimg").click(function() {
        var area = "image";
        var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}/shops";
        var currentpath = "{CURRENT}";
        var type = "image";
        nv_open_browse("{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 500, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });

    function editShop(id) {
        $.post(script_name + '?{GET_INFOSHOP}', {id: id}, function(data) {
            data = JSON.parse(data);
            Object.keys(data).forEach(v => {
                $('#' + v).val(data[v]);
            });
            $('#id_shop').val(data['id']);

            // scroll to element
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#create").offset().top
            }, 1e3);
        });
    }

    function delShop() {
        if (confirm('Bạn có chắc muốn xóa shop?')) {
            document.getElementById('delete-shop-{STORE.id}').submit();
        }
    }
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!-- END: main -->