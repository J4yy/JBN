<!-- BEGIN: main -->
<span style="display: none;" itemprop="image">{SITE_LOGO}</span>

<!-- BEGIN: company_name -->
<span itemprop="name">{DATA.company_name}
    <!-- BEGIN: company_sortname -->
    (<span itemprop="alternateName">{DATA.company_sortname}</span>)
    <!-- END: company_sortname -->
</span>
<!-- END: company_name -->

<!-- BEGIN: company_address -->
<a<!-- BEGIN: company_map_triger --> class="pointer" data-toggle="modal" data-target="#company-map-modal-{DATA.bid}"<!-- END: company_map_triger -->>
    <i class="fa fa-map-marker"></i>
    <span>{LANG.company_address}:
        <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <span itemprop="addressLocality" class="company-address">{DATA.company_address}</span>
        </span>
    </span>
</a>
<!-- END: company_address -->

<!-- BEGIN: company_regcode -->
<span><i class="fa fa-file-text"></i><span>{LICENSE}</span></span>
<!-- END: company_regcode -->

<!-- BEGIN: company_phone -->
<a href="tel:{PHONE.href}"><i class="fa fa-phone"></i>
    <span itemprop="telephone">{PHONE.number}</span>
</a>
<!-- END: company_phone -->

<!-- BEGIN: company_fax -->
<span><i class="fa fa-fax"></i><span>{LANG.company_fax}: <span itemprop="faxNumber">{DATA.company_fax}</span></span></span>
<!-- END: company_fax -->

<!-- BEGIN: company_email -->
<a href="mailto:{EMAIL}"><i class="fa fa-envelope"></i>
    <!-- BEGIN: item -->
    <span itemprop="email">{LANG.company_email}: {EMAIL}</span>
    <!-- END: item -->
</a>
<!-- END: company_email -->

<!-- BEGIN: company_website -->
<a href="{WEBSITE}" target="_blank"><i class="fa fa-globe"></i>
    <!-- BEGIN: item -->
    <span itemprop="url">{LANG.company_website}: {WEBSITE}</span>
    <!-- END: item -->
</a>
<!-- END: company_website -->

<!-- BEGIN: company_map_modal -->
<!-- START FORFOOTER -->
<div class="modal fade company-map-modal" id="company-map-modal-{DATA.bid}" data-trigger="false" data-apikey="{DATA.company_mapapikey}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <iframe frameborder="0" style="border: 0;" allowfullscreen class="company-map" id="company-map-{DATA.bid}" data-src="{DATA.company_mapurl}" src="" data-loaded="false"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- END FORFOOTER -->
<!-- END: company_map_modal -->
<!-- END: main -->

<!-- BEGIN: mainx -->
<ul class="company_info" >
    
    
    <!-- BEGIN: company_responsibility --><li><em class="fa fa-flag"></em><span>{LANG.company_responsibility}: <span itemprop="founder" itemscope itemtype="http://schema.org/Person"><span itemprop="name">{DATA.company_responsibility}</span></span></span></li><!-- END: company_responsibility -->
    
    
    
    
</ul>

<!-- END: mainx -->
