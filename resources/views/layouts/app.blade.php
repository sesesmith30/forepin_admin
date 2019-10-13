<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>ForePin </title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Themesbrand" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App Icons -->
    <link rel="shortcut icon" href="/assets02/images/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="https://themesbrand.com/foxia/plugins/morris/morris.css">
    <!-- Basic Css files -->
    <link href="/assets02/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assets02/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="/assets02/css/icons.css" rel="stylesheet" type="text/css">
    <link href="/assets02/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/assets02/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/assets02/css/responsive.bootstrap4.min.css">
    <script src="/assets02/js/jquery.min.js"></script>
    
    @yield("styles")
</head>

<body class="fixed-left enlarged">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{ url('/') }}" class="logo"><img src="/assets02/images/logo-sm.png" alt="" height="20" class="logo-large"> <img src="/assets02/images/logo-sm.png" alt="" height="22" class="logo-sm"></a>
            </div>
            <nav class="navbar-custom">
                <!-- Search input -->
                <div class="search-wrap" id="search-wrap">
                    <div class="search-bar">
                        <input class="search-input" type="search" placeholder="Search"> <a href="#" class="close-search toggle-search" data-target="#search-wrap"><i class="mdi mdi-close-circle"></i></a></div>
                </div>
                <ul class="navbar-right d-flex list-inline float-right mb-0">
                   
                    <li class="list-inline-item dropdown notification-list flags-dropdown d-none d-sm-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img src="/assets02/images/flags/us_flag.jpg" alt="" class="flag-img"> English <i class="mdi mdi-chevron-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-animated">
                            <a href="#" class="dropdown-item"><img src="/assets02/images/flags/french_flag.jpg" alt="" class="flag-img"> French</a>
                            <a href="#" class="dropdown-item"><img src="/assets02/images/flags/spain_flag.jpg" alt="" class="flag-img"> Spain</a>
                        </div>
                    </li>
                    <li class="list-inline-item dropdown notification-list"><a class="nav-link waves-effect toggle-search" href="#" data-target="#search-wrap"><i class="mdi mdi-magnify noti-icon"></i></a></li>
                    <li class="list-inline-item dropdown notification-list"><a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="mdi mdi-bell-outline noti-icon"></i> <span class="badge badge-info badge-pill noti-icon-badge">0</span></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-arrow dropdown-menu-lg">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5>Notification (0)</h5></div>
                            <div class="slimscroll-noti">
                                <!-- item-->
                               
                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                    <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>
                                </a> -->
                                
                            </div>
                            <!-- All--><a href="javascript:void(0);" class="dropdown-item notify-all">View All</a></div>
                    </li>
                    <!-- User-->



                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img src="https://forum.appzillon.com/styles/comboot/theme/images/default_avatar.jpg" alt="user" class="rounded-circle"> <span class="d-none d-md-inline-block ml-1">{{ Auth::user()->name }}<i class="mdi mdi-chevron-down"></i></span></a>


                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">



                         <a class="dropdown-item" href="#"><span class="badge badge-success float-right m-t-5">5</span><i class="dripicons-gear text-muted"></i> Preference</a> 
                            <div class="dropdown-divider"></div><a class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="dripicons-exit text-muted"></i> Logout</a></div>


                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                </ul>



                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect"><i class="mdi mdi-menu"></i></button>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Top Bar End -->
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Main</li>

                        <li><a href="{{ url('/admin/home') }}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span class="badge badge-info badge-pill float-right"></span> <span>Dashboard</span></a></li>
                        

                        <!-- <li><a href="{{ url('/admin/maps') }}" class="waves-effect"><i class="mdi mdi-map"></i><span> Maps</span></a></li> -->

                        <li><a href="#" class="waves-effect"><i class="mdi mdi-account-multiple"></i><span> Users <span class="badge badge-pill badge-danger float-right"></span></span></a>
                            <ul class="submenu">
                                @admin('promoter')
                                <li><a href="{{ url('/admin/promoters') }}">Promoters</a></li>
                                @endadmin

                                @admin('super')
                                <li><a href="{{ url('/admin/cash_vans') }}">Cash Vans</a></li>
                                <li><a href="#">Merchandizers</a></li>
                                @endadmin
                                
                            </ul>
                        </li>



                        <li><a href="{{ url('/admin/prices') }}" class="waves-effect"><i class="fa fa-money"></i><span>Prices</span></a></li>


                        <li><a href="#" class="waves-effect"><i class="mdi mdi-google-nearby"></i><span> Activities <span class="badge badge-pill badge-danger float-right"></span></span></a>
                            <ul class="submenu">
                                <li><a href="{{ url('/admin/orders') }}">Orders</a></li>
                                {{-- <li><a href="{{ url('/admin/orders/consignment') }}">Consignement Orders</a></li> --}}
                                <li><a href="{{ url('/admin/collections') }}">Collections</a></li>
                                <li><a href="{{ url('/admin/returns') }}">Returns</a></li>
                                
                            </ul>
                        </li>


                         <li><a href="{{ url('/admin/appointments') }}" class="waves-effect"><i class="dripicons-location"></i><span>Appointments</span></a></li>


                        <!-- <li><a href="{{ url('/admin/items') }}" class="waves-effect"><i class="dripicons-user"></i><span> Items</span></a></li> -->

                        @admin('super')
                        <li><a href="{{ url('/admin/outlets') }}" class="waves-effect"><i class="mdi mdi-clipboard-outline"></i><span> Outlets <span class="badge badge-pill badge-danger float-right"></span></span></a>
                            <ul class="submenu">
                                <li><a href="{{ url('/admin/outlets') }}">Outlets</a></li>
                                <li><a href="{{ url('/admin/outlets/new') }}">New Outlets</a></li>
                                <li><a href="{{ url('/admin/outlet/add') }}">Add Outlet</a></li>
                                <li><a href="{{ url('/admin/outlet/csv') }}">Upload CSV</a></li>
                            </ul>
                        </li>
                        @endadmin


                        <!-- <li><a href="{{ url('/admin/messages') }}" class="waves-effect"><i class="ion-chatbubbles"></i><span> Targets </span></a></li> -->



                        <li><a href="{{ url('/admin/messages') }}" class="waves-effect"><i class="ion-chatbubbles"></i><span> Chat <span class="badge badge-pill badge-success float-right"></span></span></a></li>



                        <li class="menu-title">Application</li>

                        <!-- <li><a href="{{ url('/admin/preference') }}" class="waves-effect"><i class="mdi mdi-settings-box"></i><span> Preference</span></a></li> -->

                        <li><a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="waves-effect"><i class="mdi mdi-power-settings"></i><span> Logout</span></a></li>

                       
                       
                    </ul>
                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            @yield("map")
            <div class="content">
                <div class="container-fluid">
                    
                    <div class="row" id="app">
                        
                        @yield("content")

                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- content -->
            <footer class="footer">© 2019 Yawboys <span class="d-none d-sm-inline-block">Made with <i class="mdi mdi-heart text-danger"></i> in kaneshie</span></footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    <!-- jQuery  -->
    <script src="/assets02/js/jquery.min.js"></script>
    <script src="/assets02/js/bootstrap.bundle.min.js"></script>
    <script src="/assets02/js/modernizr.min.js"></script>
    <script src="/assets02/js/metisMenu.min.js"></script>
    <script src="/assets02/js/jquery.slimscroll.js"></script>
    <script src="/assets02/js/waves.js"></script>
    <script src="https://themesbrand.com/foxia/plugins/peity-chart/jquery.peity.min.js"></script>
    <script src="/assets02/pages/dashboard.js"></script>
    <!-- App js -->
    <script src="/assets02/js/app.js"></script>
     <script type="text/javascript" src="/assets02/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/assets02/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/assets02/js/dataTables.responsive.min.js"></script>

    @yield("scripts")

</body>

</html>