<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="#" class="logo"><span>Admin<span>to</span></span><i class="mdi mdi-layers"></i></a>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">

                <!-- Page title -->
                @include('admins/layouts/page_title')

                <nav class="navbar-custom">

                    <ul class="list-unstyled topbar-right-menu float-right mb-0">

                        <li>
                            <!-- Notification -->
                            <div class="notification-box">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a href="javascript:void(0);" class="right-bar-toggle">
                                            <i class="mdi mdi-bell-outline noti-icon"></i>
                                        </a>
                                        <div class="noti-dot">
                                            <span class="dot"></span>
                                            <span class="pulse"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Notification bar -->
                        </li>

                        <li class="hide-phone">
                            <form class="app-search">
                                <input type="text" placeholder="Search..."
                                       class="form-control">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </li>

                    </ul>
                </nav>
            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!-- User -->
            <div class="user-box">
            
                <div class="user-img">
                    <img src="{{asset('admins/images/users/avatar-1.jpg')}}" alt="user-img" title="<?php if(!empty(Auth::user())){echo Auth::user()->name;}?>" class="rounded-circle img-thumbnail img-responsive">
                    <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                </div>
                <h5><a href="#"><?php if(!empty(Auth::user())){echo Auth::user()->name;}?></a> </h5>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="#" >
                            <i class="mdi mdi-settings"></i>
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a class="text-custom" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-power"></i>
                            </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                  </ul>              
            </div>
            <!-- End User -->

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul>
                    <li class="text-muted menu-title">Navigation</li>

                    <li>
                        <a href="{{action("HomeController@index")}}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>

                    <li>
                        <a href="{{action("UserController@index")}}" class="waves-effect"><i class="mdi mdi-account-box"></i> <span> Users </span> </a>
                    </li>

                    <li>
                        <a href="{{action("CategoryController@index")}}" class="waves-effect"><i class="mdi mdi-vector-polygon"></i> <span> Categoies </span> </a>
                        
                    </li>
                    <li>
                        <a href="{{action("CateChildController@index")}}" class="waves-effect"><i class="dripicons-document"></i> <span> Category child </span> </a>
                        
                    </li>

                    <li>
                    <a href="{{action("ProductController@index")}}" class="waves-effect"><i class=" mdi mdi-ornament"></i><span> Products </span> </a>  
                    </li>            
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->
</div>