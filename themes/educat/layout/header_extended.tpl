    <noscript>
        <div class="alert alert-danger">{LANG.nojs}</div>
    </noscript>
    <!--Header Area Start-->
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-5 d-none d-lg-block d-md-block">
                        <span>Have any question? {SITE_PHONE}</span>
                    </div>
                    <div class="col-lg-5 col-md-7 col-12">
                        <div class="header-top-right">
                            <div class="content"><a href="#"><i class="zmdi zmdi-account"></i> My Account</a>
                                <ul class="account-dropdown">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Log In</a></li>
                                    <li><a href="#">Register</a></li>
                                    <li><a href="#">4rum</a></li>
                                </ul>
                            </div>
                            <div class="content"><a href="#"><i class="zmdi zmdi-favorite"></i> Wishlist</a></div>
                            <div class="content"><a href="#"><i class="zmdi zmdi-shopping-basket"></i> Checkout</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        [MENU_SITE]
    </header>
    <!--End of Header Area-->

    <div class="shortcode-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <!-- BEGIN: breadcrumbs -->
                    <div class="padding">
                        <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{THEME_SITE_HREF}" itemprop="item" title="{LANG.Home}"><span itemprop="name">{LANG.Home}</span></a>
                            </li>
                            <!-- BEGIN: loop -->
                            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="{BREADCRUMBS.link}" itemprop="item" title="{BREADCRUMBS.title}"><span class="txt" itemprop="name">{BREADCRUMBS.title}</span></a></li>
                            <!-- END: loop -->
                        </ol>
                    </div>
                    <!-- END: breadcrumbs -->
                    <!-- BEGIN: currenttime -->
                    <div class="card">
                        <div class="card-header"><span class="current-time">{NV_CURRENTTIME}</span></div>
                    </div>
                    <!-- END: currenttime -->
                    
                    [THEME_ERROR_INFO]
                </div>
            </div>
        </div>
    </div>
