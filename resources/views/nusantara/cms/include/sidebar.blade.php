<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <!-- <a href="#" class="site_title text-center">
                <img src="{{ asset('images/db/main_page/logo/nusantara-group-2.png') }}" height="54px">
            </a> -->
            <img src="{{ asset('themes/cms/svg/webpack.svg') }}" class="image-header">
        </div>

        <div class="clearfix"></div>
        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a>
                          <i class="fa">
                              @include('nusantara.cms.svg-logo.sidebar.ico-email')
                          </i>Messages <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="#booking-services" onclick="menuBookingServices()">Booking Services</a>
                            </li>   
                        </ul>
                    </li> 
                    
                    <li>
                        <a>
                          <i class="fa">
                              @include('nusantara.cms.svg-logo.sidebar.ico-pages')
                          </i>Pages <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="#awards" onclick="menuAwards()">Awards</a>
                            </li> 
                            <li>
                                <a href="#branch-office" onclick="menuBranchOffice()">Branch Office</a>
                            </li>
                            <li>
                                <a href="#main-banner" onclick="menuMainBanner()">Main Banner</a>
                            </li>
                            <li>
                                <a href="#promotions" onclick="menuPromotions()">Promotions</a>
                            </li>
                            <li>
                                <a href="#static-page" onclick="menuStaticPage()">Static Page</a>
                            </li>   
                        </ul>
                    </li> 
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>