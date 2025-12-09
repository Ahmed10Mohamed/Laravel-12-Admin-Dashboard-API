<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('Admin-Dashboard') }}" class="app-brand-link">
                        <img src="{{ asset('logo.png') }}" class="logo" width="100" heigh="80">
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
                        <i class="ti tabler-x d-block d-xl-none ti-md align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <li class="menu-header small">
                        <span class="menu-header-text" data-i18n="{{ translate('dashboard') }}">{{ translate('dashboard') }}</span>
                    </li>
                    <!-- Dashboard -->

                    <li class="menu-item @if (checkRoute('Admin-Dashboard')) active @endif">
                        <a href="{{ route('Admin-Dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti tabler-smart-home"></i>
                            <div data-i18n="{{ translate('dashboard') }}">{{ translate('dashboard') }}</div>

                        </a>
                    </li>


                    <!-- profile -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text"> {{ translate('about us') }}</span>
                    </li>
                    <!--End Users -->
                    <li class="menu-item @if (Request::is('Dashboard-Admin/About-*')) open @endif">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti tabler-settings "></i>
                            <div data-i18n="{{ translate('about system') }}">{{ translate('about system') }}</div>
                        </a>
                        <ul class="menu-sub">

                            <li class="menu-item @if (Request::is('Dashboard-Admin/About-aboutUs')) active @endif">
                                <a href="{{ url('Dashboard-Admin/About-aboutUs') }}" class="menu-link">
                                    <div data-i18n="عن النادي">عن النادي</div>
                                </a>
                            </li>

                            <li class="menu-item @if (Request::is('Dashboard-Admin/About-Policy')) active @endif">
                                <a href="{{ url('Dashboard-Admin/About-Policy') }}" class="menu-link">
                                    <div data-i18n="سياسة الخصوصية">سياسة الخصوصية</div>
                                </a>
                            </li>


                            <li class="menu-item @if (Request::is('Dashboard-Admin/About-TermsUse')) active @endif">
                                <a href="{{ url('Dashboard-Admin/About-TermsUse') }}" class="menu-link">
                                    <div data-i18n="شروط الاستخدام">شروط الاستخدام</div>
                                </a>
                            </li>

                            <li class="menu-item @if (Request::is('Dashboard-Admin/About-vision')) active @endif">
                                <a href="{{ url('Dashboard-Admin/About-vision') }}" class="menu-link">
                                    <div data-i18n="رؤيتنا">رؤيتنا</div>
                                </a>
                            </li>

                            <li class="menu-item @if (Request::is('Dashboard-Admin/About-mission')) active @endif">
                                <a href="{{ url('Dashboard-Admin/About-mission') }}" class="menu-link">
                                    <div data-i18n="مهمتنا">مهمتنا</div>
                                </a>
                            </li>
                            <li class="menu-item @if (Request::is('Dashboard-Admin/About-Footer')) active @endif">
                                <a href="{{ url('Dashboard-Admin/About-Footer') }}" class="menu-link">
                                    <div data-i18n="Footer">Footer</div>
                                </a>
                            </li>



                            <li class="menu-item @if (Request::is('Dashboard-Admin/About-contactUs')) active @endif">
                                <a href="{{ url('Dashboard-Admin/About-contactUs') }}" class="menu-link">
                                    <div data-i18n="اتصل بنا">اتصل بنا</div>
                                </a>
                            </li>

                        </ul>
                    </li>




                    <li class="menu-header small">
                        <span class="menu-header-text" data-i18n="الإعدادات">الإعدادات</span>
                    </li>
                    <li class="menu-item @if (checkRoute('Profile') || checkRoute('Profile.Password')) active open @endif ">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti tabler-settings"></i>
                            <div data-i18n="البيانات الشخصية">البيانات الشخصية</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item @if (checkRoute('Profile')) active @endif">
                                <a href="{{ route('Profile') }}" class="menu-link">
                                    <div data-i18n="الملف الشخصي">الملف الشخصي</div>
                                </a>
                            </li>
                            <li class="menu-item @if (checkRoute('Profile.Password')) active @endif">
                                <a href="{{ route('Profile.Password') }}" class="menu-link">
                                    <div data-i18n="كلمة المرور">كلمة المرور</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </aside>
            <!-- / Menu -->

            <div class="menu-mobile-toggler d-xl-none rounded-1">
                <a href="javascript:void(0);"
                    class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                    <i class="ti tabler-menu icon-base"></i>
                    <i class="ti tabler-chevron-right icon-base"></i>
                </a>
            </div>
            <!-- / Menu -->
