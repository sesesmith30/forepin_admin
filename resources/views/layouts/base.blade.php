<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
      <title>ForePin | Admin</title>
      <meta content="Admin Dashboard" name="description">
      <meta content="Themesbrand" name="author">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- App Icons -->
      <link rel="shortcut icon" href="/assets/images/favicon.ico">

      <!--Morris Chart CSS -->
      @yield("styles")
      
      <!-- App css -->
      <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="/assets/css/icons.css" rel="stylesheet" type="text/css">
      <link href="/assets/css/style.css" rel="stylesheet" type="text/css">

   </head>
   <body>
      <!-- Loader -->
      <div id="preloader">
         <div id="status">
            <div class="spinner"></div>
         </div>
      </div>
      <div class="header-bg">
         <!-- Navigation Bar-->
         <header id="topnav">
            <div class="topbar-main">
               <div class="container-fluid">
                  <!-- Logo-->
                  <div class="d-block d-lg-none mr-5"><a href="index.html" class="logo"><img src="/assets/images/logo-sm.png" alt="" height="28" class="logo-small"></a></div>
                  <!-- End Logo-->
                  <div class="menu-extras topbar-custom navbar p-0">
                     <ul class="list-inline flags-dropdown d-none d-lg-block mb-0">
                        <li class="list-inline-item text-white-50 mr-3"><span class="font-13">Help : +233 5771 9143</span></li>
                       
                     </ul>
                     <!-- Search input -->
                   
                     <ul class="list-inline ml-auto mb-0">
                        <!-- notification-->
                       
                        <li class="list-inline-item dropdown notification-list">
                           <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="mdi mdi-bell-outline noti-icon"></i> <span class="badge badge-info badge-pill noti-icon-badge">0</span></a>
                           <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-arrow dropdown-menu-lg">
                              <!-- item-->
                              <div class="dropdown-item noti-title">
                                 <h5>Notification (3)</h5>
                              </div>
                              <div class="slimscroll-noti">
                                 <!-- item--> 
                                 <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                 </a>
                                 <!-- item--> 
                                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                 </a>
                                 <!-- item--> 
                                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                    <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>
                                 </a>
                                 <!-- item--> 
                                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                 </a>
                                 <!-- item--> 
                                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                 </a>
                              </div>
                              <!-- All--> <a href="javascript:void(0);" class="dropdown-item notify-all">View All</a>
                           </div>
                        </li>
                        <!-- User-->
                        <li class="list-inline-item dropdown notification-list">


                           <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="/admin/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" role="button" aria-haspopup="false" aria-expanded="false">


                            <span class="d-none d-md-inline-block ml-1">Logout<i class="mdi mdi-chevron-right"></i></span></a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                        </li>
                        <li class="menu-item list-inline-item">
                           <!-- Mobile menu toggle--> 
                           <a class="navbar-toggle nav-link">
                              <div class="lines"><span></span> <span></span> <span></span></div>
                           </a>
                           <!-- End mobile menu toggle-->
                        </li>
                     </ul>
                  </div>
                  <!-- end menu-extras -->
                  <div class="clearfix"></div>
               </div>
               <!-- end container -->
            </div>
            <!-- end topbar-main --><!-- MENU Start -->
            <div class="navbar-custom">
               <div class="container-fluid">
                  <!-- Logo-->
                  <div class="d-none d-lg-block">
                     <!-- Text Logo -->
                        <a href="{{ url('/admin/home') }}" class="logo" style="color: #FFFFFF; font-weight: bold; font-size: 18px;">
                            PromoPitch
                        </a>
                        
                         <!-- Image Logo --> 
                   <!--   <a href="index.html" class="logo">
                        <label>  </label>
                        <img src="/assets/images/logo.png" alt="" height="20" class="logo-large">
                     </a> -->
                  </div>
                  <!-- End Logo-->
                  <div id="navigation">
                     <!-- Navigation Menu-->
                     <ul class="navigation-menu">
                        @admin("super")
                        <li class="has-submenu"><a href="{{ url('/admin/home') }}"><i class="dripicons-meter"></i>Dashboard</a></li>

                        <li class="has-submenu"><a href="{{ url('/admin/maps') }}"><i class="dripicons-location"></i>Live Maps</a></li>

                        <li class="has-submenu"><a href="{{ url('/admin/promoters') }}"><i class="dripicons-user"></i>Promoters</a></li>

                        <li class="has-submenu"><a href="{{ url('/admin/messages') }}"><i class="dripicons-briefcase"></i>Messages</a></li>
                        
                        <li class="has-submenu"><a href="{{ url('/admin/outlets') }}"><i class="dripicons-briefcase"></i>Outlets</a>
                           <ul class="submenu">
                              <li><a href="{{ url('/admin/outlets') }}">Outlets</a></li>
                              <li><a href="{{ url('/admin/outlet/add') }}">Add Outlet</a></li>
                              <li><a href="{{ url('/admin/outlet/csv') }}">Upload CSV</a></li>
                           </ul>

                        </li>

                        <li class="has-submenu"><a href="{{ url('/admin/auditors') }}"><i class="dripicons-user"></i>Auditors</a></li>

                        
                        @endadmin

<!-- 
                        @admin("auditor")

                           <li class="has-submenu"><a href="{{ url('/admin/auditor/dashboard') }}"><i class="dripicons-meter"></i>Dashboard</a></li>

                           <li class="has-submenu"><a href="{{ url('/admin/auditor/maps') }}"><i class="dripicons-user"></i>Live Maps</a></li>

                           



                        @endadmin -->
                      

                        
                     </ul>
                     <!-- End navigation menu -->
                  </div>
                  <!-- end #navigation -->
               </div>
               <!-- end container -->
            </div>
            <!-- end navbar-custom -->
         </header>
         <!-- End Navigation Bar-->
         <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
               <div class="col-sm-12">
                  <div class="page-title-box">
                     <div class="row align-items-center">
                        <div class="col-md-8">
                           <h4 class="page-title mb-0">{{ $name }}</h4>
                           <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="#">admin</a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
                           </ol>
                        </div>
                        <div class="col-md-4">
                           <div class="float-right d-none d-md-block">
                              <div class="dropdown">

                                 @yield("action_btn")

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end page title end breadcrumb -->
         </div>
      </div>
      <div class="wrapper" id="app">

         @yield("content")

       
      </div>
      <!-- end wrapper --><!-- Footer -->
      <footer class="footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">© 2018 PromoPitch <span class="d-none d-md-inline-block"><i class="mdi mdi-heart text-danger"></i> Yawboys</span></div>
            </div>
         </div>
      </footer>
      <!-- End Footer --><!-- jQuery  -->
      <script src="/assets/js/jquery.min.js"></script>
      <script src="/assets/js/bootstrap.bundle.min.js"></script>
      <script src="/assets/js/modernizr.min.js"></script>
      <script src="/assets/js/waves.js"></script>
      <script src="/assets/js/jquery.slimscroll.js"></script>
      <script src="https://themesbrand.com/foxia/plugins/peity-chart/jquery.peity.min.js"></script>
      

      <script src="/assets/js/app.js"></script>
      @yield("scripts")
      
      <script src="/js/app.js"></script>

   </body>
</html>