<!doctype html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>لوحة التحكم | @yield('title')</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.png') }}"/>
        <!-- Main css -->
        <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        @yield('head')
        <!-- App css -->
        <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- print -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
        <!-- print -->
    </head>
    <body class="small-navigation2 rtl">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Loading...</span>
    </div>
    <!-- ./ Preloader -->
    <!-- Sidebar group -->
    <div class="sidebar-group">
        <!-- BEGIN: Settings -->
        @include('admin.partials.sidebar')
        <!-- END: Settings -->
    </div>
    <!-- ./ Sidebar group -->
        <!-- Layout wrapper -->
        <div class="layout-wrapper">
            <!-- Header -->
            <div class="header d-print-none">
                @include('admin.partials.header')
            </div>
            <!-- ./ Header -->
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- begin::navigation -->
                <div class="navigation">
                    <div class="navigation-header">
                        <span>Navigation</span>
                        <a href="#">
                            <i class="ti-close"></i>
                        </a>
                    </div>
                    <div class="navigation-menu-body">
                        @include('admin.partials.menu')
                        
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                    </div>
                </div>
                <!-- end::navigation -->

                <!-- Content body -->
                <div class="content-body">
                    <!-- Content -->
                    <div class="content @yield('parentClassName')">
                        @yield('content')
                    </div>
                    <!-- ./ Content -->

                    <!-- Footer -->
                    <footer class="content-footer">
                        <div>© {{ date('Y') }} Gogi - <a href="http://laborasyon.com" target="_blank">Laborasyon</a></div>
                        <div>
                            <nav class="nav">
                                <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                                <a href="#" class="nav-link">Change Log</a>
                                <a href="#" class="nav-link">Get Help</a>
                            </nav>
                        </div>
                    </footer>
                    <!-- ./ Footer -->
                </div>
                <!-- ./ Content body -->
            </div>
            <!-- ./ Content wrapper -->
        </div>
        <!-- ./ Layout wrapper -->

        <!-- Main scripts -->
        <script src="{{ url('vendors/bundle.js') }}"></script>

        @yield('script')

        <!-- App scripts -->
        <script src="{{ url('assets/js/app.min.js') }}"></script>
    </body>
</html>
