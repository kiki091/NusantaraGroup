<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">

            <div class="toggle__sidebar">
                <div class="bar">
                    <a id="menu_toggle">
                    <span class="bar-1"></span>
                    <span class="bar-2"></span>
                    <span class="bar-3"></span>
                    </a>
                </div>
            </div>
            <div class="header__selector__dropdown">
                <div class="dropdown__select__list" id="selector-dropdown">
                    <span class="display__name">CMS</span>
                </div>
            </div>

            <!-- <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div> -->

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{ $user['email'] }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-sign-out pull-right"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>

                
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->