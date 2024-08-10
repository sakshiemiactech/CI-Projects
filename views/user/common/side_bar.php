<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <img src="<?php echo base_url('assets/images/loader.gif'); ?>" class="hw-100" alt="">
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>
            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <!--<a href="index.html" class="logo">OMS</a>-->
                    <a href="<?php echo base_url('dashboard');?>" class="logo"><img src="<?php echo base_url('assets/images/davsy-logo.png');?>" height="50" alt="logo"></a>
                </div>
            </div>
            <div class="sidebar-inner slimscrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li>
                            <a href="<?php echo base_url('da');?>" class="waves-effect">
                                <i class="ti-announcement m-r-5 text-muted"></i>
                                <span> DA</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->