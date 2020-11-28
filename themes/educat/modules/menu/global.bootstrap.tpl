<!-- BEGIN: submenu -->
<ul class="{SUBCLASS}">
    <!-- BEGIN: loop -->
    <li>
        <!-- BEGIN: icon --> <img src="{SUBMENU.icon}" />&nbsp; <!-- END: icon -->
        <a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}>{SUBMENU.title_trim}<!-- BEGIN: has_sub --><i class="zmdi zmdi-chevron-right"><!-- END: has_sub --></i></a>
        <!-- BEGIN: item --> {SUB} <!-- END: item -->
    </li>
    <!-- END: loop -->
</ul>
<!-- END: submenu -->

<!-- BEGIN: main -->
<div class="header-logo-menu sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="logo">
                    <a title="{SITE_NAME}" href="{THEME_SITE_HREF}"><img src="{LOGO_SRC}" alt="{SITE_NAME}"></a>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="mainmenu-area pull-right">
                    <div class="mainmenu d-none d-lg-block">
                        <nav>
                            <ul id="nav">
                                <li class="current"><a href="{THEME_SITE_HREF}">{LANG.Home}</a></li>
                                <!-- BEGIN: top_menu_pc -->
                                <li>
                                    <a href="{TOP_MENU.link}" title="{TOP_MENU.note}"{TOP_MENU.target}>
                                        <!-- BEGIN: icon -->
                                            <img src="{TOP_MENU.icon}" />&nbsp;
                                        <!-- END: icon -->
                                        {TOP_MENU.title_trim}
                                        <!-- BEGIN: has_sub -->
                                            <strong class="caret">&nbsp;</strong>
                                        <!-- END: has_sub -->
                                    </a>
                                    <!-- BEGIN: sub --> {SUB} <!-- END: sub -->
                                </li>
                                <!-- END: top_menu_pc -->
                            </ul>
                        </nav>
                    </div>
                    <ul class="header-search">
                        <li class="search-menu">
                            <i id="toggle-search" class="zmdi zmdi-search-for"></i>
                        </li>
                    </ul>
                    <!-- Search Form -->
                    <div class="search">
                        <div class="search-form">
                            <form id="search-form" action="#" onsubmit="event.preventDefault();">
                                <input type="search" maxlength="{NV_MAX_SEARCH_LENGTH}" placeholder="{LANG.search}..." name="search" />
                                <button type="submit" data-url="{THEME_SEARCH_URL}" data-minlength="{NV_MIN_SEARCH_LENGTH}" data-click="y">
                                    <span><i class="fa fa-search"></i></span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- End of Search Form -->
                </div> 
            </div>
        </div>
    </div>
</div>

<div class="mobile-menu-area">
    <div class="container clearfix">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul>
                            <li class="current"><a href="{THEME_SITE_HREF}">{LANG.Home}</a></li>
                            <!-- BEGIN: top_menu_mobile -->
                            <li>
                                <a href="{TOP_MENU.link}" title="{TOP_MENU.note}"{TOP_MENU.target}>
                                    <!-- BEGIN: icon -->
                                        <img src="{TOP_MENU.icon}" />&nbsp;
                                    <!-- END: icon -->
                                    {TOP_MENU.title_trim}
                                </a>
                                <!-- BEGIN: sub --> {SUB} <!-- END: sub -->
                            </li>
                            <!-- END: top_menu_mobile -->
                        </ul>
                    </nav>
                </div>                  
            </div>
        </div>
    </div>
</div>
<!-- END: main -->
