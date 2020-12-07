<!-- BEGIN: config -->
<div class="form-group">
	<label for="" class="col-md-6">numrow</label>
	<div class="col-md-6">
		{LANG.numrow}
	</div>
</div>
<div class="form-group">
	<label for="" class="col-md-6">numrow2</label>
	<div class="col-md-6">
		<input type="text" name="config_numrow" value="{DATA.numrow}" class="w500 form-control">
	</div>
</div>
<!-- END: config -->

<!-- BEGIN: main -->
<style type="text/css">
.tenbandat ul li {
display: block;
margin: 0;
padding: 5px 0;
border-bottom: 1px #ccc solid;
}
</style>

<div class="tenbandat">
<ul>
<!-- BEGIN: loop -->
<li><a href="{LOOP.link}" title="{LOOP.title}">{LOOP.title}</a></li>
<!-- END: loop -->
</ul>
</div>
<!-- END: main -->