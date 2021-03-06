<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>{{ $title ?? 'Dashboard' }} - {{ env('APP_NAME') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @yield('before-css')
        <!-- App favicon -->
        <link href="{{ asset('admin_assets') }}/images/favicon.png" rel="shortcut icon" />
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,900&display=swap" rel="stylesheet">

        <!-- Plugins css -->
        <link href="{{ asset('admin_assets') }}/css/bundled.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin_assets') }}/css/dianujStyles.css" rel="stylesheet" type="text/css" />
        <!--Pagination CSS-->
        <link rel="stylesheet" href="{{ asset('admin_assets') }}/css/pagination.css" rel="stylesheet" type="text/css">
        <style>
            .select2-container .select2-selection--single .select2-selection__rendered {
                line-height: 1.9;
            }
            .bootstrap-select .inner{
                overflow-y: auto !important;
            }
        </style>
        <script>
            var __site_url__ = '{{route("home")}}';
        </script>
    </head>

    <body class="left-side-menu-dark">

        <div id="preloader" class="preloader">
            <div id="status">
                <div class="spinner">Loading...</div>
            </div>
        </div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ check_file(auth()->user()->image, 'user') }}" alt="{{ auth()->user()->full_name }}" class="rounded-circle fit-image">
                            <span class="pro-user-name ml-1" style="color: rgba(255, 255, 255, .85)">
                                {{ auth()->user()->username }} <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome {{ auth()->user()->username }}!</h6>
                            </div>
                            
                            <!-- item-->
                            <a href="{{ route('update_profile') }}" class="dropdown-item notify-item">
                                <i class="fe-star"></i>
                                <span>Update Profile</span>
                            </a>


                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <a href="{{ route('logout') }}" onclick="logout(event)" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>
                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="{{ route('home') }}" class="logo text-center">
                        <span class="logo-lg">
                            <h1 class="text-white"> GEMNET </h1>
                        </span>
                        <span class="logo-sm">
                            <h3 class="text-white"> GEMNET </h3>
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        @php
                            $admin = auth('admin')->user();
                        @endphp
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Navigation</li>
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="fe-airplay"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.show') }}">
                                    <i class="fe-list"></i>
                                    <span> View Users </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('acl.users.show') }}">
                                    <i class="fe-list"></i>
                                    <span> Add Acl </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{route('ippool.show')}}">
                                    <i class="fe-users"></i>
                                    <span> Add IPPool </span>
                                </a>
                            </li> 

                             <li>
                                <a href="{{route('dbs.show')}}">
                                    <i class="fe-users"></i>
                                    <span> Add Database </span>
                                </a>
                            </li> 
                            
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                {{ date('Y') }} &copy; All rights reserved by <strong>{{ str_replace('-', ' ', env('APP_NAME')) }}</strong>. Design &amp; Developed By <a href="https://gexton.com" target="_blank">GEXTON INC</a>.
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <script src="{{ asset('admin_assets') }}/js/bundled.min.js"></script>
        <script>
            function pageloader(status) {
                if (status == 'hide') {
                    $('.preloader').hide();
                    $('#status').hide();
                    return;
                }
                $('.preloader').show();
                $('#status').show();
                return;
            }
        </script>

        <script src="{{ asset('admin_assets') }}/js/flatpickr.js"></script>
        <script src="{{ asset('admin_assets') }}/js/app.min.js"></script>
        <script src="{{ asset('admin_assets') }}/js/custom.js"></script>

       
        @yield('page-scripts')
    </body>

</html>