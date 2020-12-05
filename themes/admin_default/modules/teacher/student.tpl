<!-- BEGIN: main -->


<!-- BEGIN: rows -->
      
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <col span="2" style="white-space: nowrap;" />
        <col class="w250" />
        <thead>
            <tr>
                <th class="text-center">{LANG.name}</th>
                <th class="text-center">{LANG.faculty}</th>
                <th class="text-center">{LANG.course}</th>
                 <th class="text-center">{LANG.class}</th>
                <th class="text-center">{LANG.tools}</th>
            </tr>
        </thead>
        <tbody id="block-list-container">
            <!-- BEGIN: loop -->
            <tr id="block-row-{ROW.bid}">
                <td class="text-center">{ROW.name}</td>
                <td class="text-center">{ROW.faculty}</td>
                <td class="text-center">{ROW.course}</td>
                <td class="text-center">{ROW.class}</td>
                <td class="text-center">
                    <em class="fa fa-edit fa-lg">&nbsp;</em> 
                    <a href="#" class="block-edit" data-bid="{ROW.bid}">{GLANG.edit}</a>
                     &nbsp;
                    <em class="fa fa-trash-o fa-lg">&nbsp;</em> 
                    <a href="#" class="block-delete" data-bid="{ROW.bid}" data-title="{ROW.title}">{GLANG.delete}</a>
                </td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<!-- END: rows -->
<div class="modal fade" id="block-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">{LANG.block_add_student}</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">{LANG.name}</label>
                        <div class="col-sm-19">
                            <input type="text" class="form-control txt" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="faculty" class="col-sm-5 control-label">{LANG.faculty}</label>
                        <div class="col-sm-19">
                            <input type="text" name="faculty" id="faculty" class="form-control txt" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="course" class="col-sm-5 control-label">{LANG.course}</label>
                        <div class="col-sm-19">
                            <input type="text" class="form-control txt" id="course" name="course">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="class" class="col-sm-5 control-label">{LANG.class}</label>
                        <div class="col-sm-19">
                            <input type="text" class="form-control txt" id="class" name="class">
                        </div>
                    </div>
                    <input type="hidden" name="bid" id="block-bid" value="" class="txt">
                </form>
            </div>
            <div class="modal-footer">
                <span class="per-loading"> <i class="fa fa-circle-o-notch fa-spin"></i> </span>
                <button type="button" class="btn btn-default" data-dismiss="modal">{GLANG.cancel}</button>
                <button type="button" class="btn btn-primary block-submit-trigger">{GLANG.save}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="block-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">{LANG.block_delete}</h3>
            </div>
            <div class="modal-body">
                <p class="text-danger confirm">{LANG.block_delete_confirm}</p>
                <p class="text-center loading">
                    <em class="fa fa-circle-o-notch fa-spin fa-2x"></em>
                </p>
                <p class="text-center message"></p>
                <p class="text-center success text-success">
                    <em class="fa fa-check-circle fa-2x"></em>
                </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="bid" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">{GLANG.cancel}</button>
                <button type="button" class="btn btn-primary block-delete-trigger">{GLANG.delete}</button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="clearfix" style="text-align:center;">
    <button  class="btn btn-primary block-add-trigger pull-center">{LANG.add_student}</button>
</div>
<!-- END: main -->