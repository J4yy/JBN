<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<div class="container">
    <div class="row">
        [HEADER]
    </div>
</div>
<div class="main-section">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-2">
                    [LEFT]
                </div>
                <div class="col-7">
                    [TOP]
                    {MODULE_CONTENT}
                    [BOTTOM]
                </div>
                <div class="col-3">
                    [RIGHT]
                </div>
            </div>
            <div class="row">
                [FOOTER]
            </div>
        </div>
    </section>
</div>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->