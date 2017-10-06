<?php $this->view('template/includes/head'); ?>
<body class="theme-red" ng-app="MyApp" ng-controller="MyController">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="../../index.html">AajfxCOIN</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <?php 
        $controller_name = $this->uri->segment(1);
        $function_name = $this->uri->segment(2);
        $username = $session_data['logged_in']['username']; 
        $role_id = $session_data['logged_in']['role_id'];
        $user_info = getUserInfo(0,$username);
        $name = $user_info['firstname']." ".$user_info['lastname'];
        $email = $user_info['email'];
        $profile_image = $user_info['profile_image'] != '' ? $user_info['profile_image'] : 'person.png';
        ?>
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?= imagePath($profile_image,'profile',48,48); ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $name; ?></div>
                    <div class="email"><?= $email;?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <!--<li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li role="seperator" class="divider"></li>-->
                            <li><a href="<?= site_url(); ?>logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li <?php if(isset($controller_name) && $controller_name == 'dashboard'){ echo 'class="active"'; } ?>>
                        <a href="<?php echo site_url(); ?>dashboard">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li <?php if(isset($controller_name) && $controller_name == 'profile'){ echo 'class="active"'; } ?>>
                        <a href="<?php echo site_url(); ?>profile">
                            <i class="material-icons">face</i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li <?php if(isset($controller_name) && $controller_name == 'coins'){ echo 'class="active"'; } ?>>
                        <a href="<?php echo site_url(); ?>coins">
                            <i class="material-icons">attach_money</i>
                            <span>Coins</span>
                        </a>
                    </li>
                    <li <?php if(isset($controller_name) && $controller_name == 'incentives'){ echo 'class="active"'; } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">stars</i>
                            <span>Incentives</span>
                        </a>
                        <ul class="ml-menu">
                            <?php /*?><li <?php if(isset($controller_name) && $controller_name == 'incentives' && $function_name == ''){ echo 'class="active"'; } ?>>
                                <a href="<?php echo site_url(); ?>incentives">
                                    <span>Incentives dashboard</span>
                                </a>
                            </li><?php */?>
                            <li <?php if(isset($controller_name) && $controller_name == 'incentives' && $function_name == 'referral_income'){ echo 'class="active"'; } ?>>
                                <a href="<?php echo site_url(); ?>incentives/referral_income">
                                    <span>Referral Income</span>
                                </a>
                            </li>
                        </ul>
                    </li>                    
                    <li <?php if(isset($controller_name) && $controller_name == 'myteam'){ echo 'class="active"'; } ?>>
                        <a href="<?php echo site_url(); ?>myteam">
                            <i class="material-icons">group_work</i>
                            <span>My Team</span>
                        </a>
                    </li>
                    <?php if($role_id == 1){ ?>
                    <li <?php if(isset($controller_name) && in_array($controller_name,array('admin_coin','admin_users','admin_notifications','admin_news','admin_payout','admin_user_coins'))){ echo 'class="active"'; } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">folder</i>
                            <span>Admin</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if(isset($controller_name) && in_array($controller_name,array('admin_coin','admin_users','admin_notifications','admin_news'))){ echo 'class="active"'; } ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Masters</span>
                                </a>
                            <ul class="ml-menu">
                                <li <?php if(isset($controller_name) && $controller_name == 'admin_users'){ echo 'class="active"'; } ?>>
                                    <a href="<?php echo site_url(); ?>admin_users">
                                        <span>User Master</span>
                                    </a>
                                </li>
                                <li <?php if(isset($controller_name) && $controller_name == 'admin_coin' && $function_name == ''){ echo 'class="active"'; } ?>>
                                    <a href="<?php echo site_url(); ?>admin_coin">
                                        <span>Coins Master</span>
                                    </a>
                                </li>
                                <li <?php if(isset($controller_name) && $controller_name == 'admin_coin' && $function_name == 'coin_price'){ echo 'class="active"'; } ?>>
                                    <a href="<?php echo site_url(); ?>admin_coin/coin_price">
                                        <span>Coin Price Master</span>
                                    </a>
                                </li>
                                <li <?php if(isset($controller_name) && $controller_name == 'admin_notifications'){ echo 'class="active"'; } ?>>
                                    <a href="<?php echo site_url(); ?>admin_notifications">
                                        <span>Notification Master</span>
                                    </a>
                                </li>
                                <li <?php if(isset($controller_name) && $controller_name == 'admin_news'){ echo 'class="active"'; } ?>>
                                    <a href="<?php echo site_url(); ?>admin_news">
                                        <span>News Master</span>
                                    </a>
                                </li>
                            </ul>
                            </li>
                            <li <?php if(isset($controller_name) && in_array($controller_name,array('admin_user_coins'))){ echo 'class="active"'; } ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Requests</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php if(isset($controller_name) && $controller_name == 'admin_user_coins'  && $function_name == ''){ echo 'class="active"'; } ?>>
                                        <a href="<?php echo site_url(); ?>admin_user_coins">
                                            <span>User Coins Buy Request</span>
                                        </a>
                                    </li>
                                    <li <?php if(isset($controller_name) && $controller_name == 'admin_user_coins' && $function_name == 'view_user_coins_list'){ echo 'class="active"'; } ?>>
                                        <a href="<?php echo site_url(); ?>admin_user_coins/view_user_coins_list">
                                            <span>User Coins Bought Requests</span>
                                        </a>
                                    </li>
                                    <li <?php if(isset($controller_name) && $controller_name == 'admin_user_coins' && $function_name == 'roi_purchased_sell_requests'){ echo 'class="active"'; } ?>>
                                        <a href="<?php echo site_url(); ?>admin_user_coins/roi_purchased_sell_requests">
                                            <span>ROI & Purchased Coins Sell Requests</span>
                                        </a>
                                    </li>
                                    <li <?php if(isset($controller_name) && $controller_name == 'admin_user_coins' && $function_name == 'roi_purchased_accepted_sell_requests'){ echo 'class="active"'; } ?>>
                                        <a href="<?php echo site_url(); ?>admin_user_coins/roi_purchased_accepted_sell_requests">
                                            <span>ROI & Purchased Coins Accepted Sell Requests</span>
                                        </a>
                                    </li>
                                    <li <?php if(isset($controller_name) && $controller_name == 'admin_user_coins' && $function_name == 'referral_sell_requests'){ echo 'class="active"'; } ?>>
                                        <a href="<?php echo site_url(); ?>admin_user_coins/referral_sell_requests">
                                            <span>Referral Coins Sell Requests</span>
                                        </a>
                                    </li>
                                    <li <?php if(isset($controller_name) && $controller_name == 'admin_user_coins' && $function_name == 'referral_accpepted_sell_requests'){ echo 'class="active"'; } ?>>
                                        <a href="<?php echo site_url(); ?>admin_user_coins/referral_accpepted_sell_requests">
                                            <span>Referral Coins Accepted Sell Requests</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Payment Details</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="<?php echo site_url(); ?>admin_payout">
                                            <span>Payout</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url(); ?>admin_user_payment_details">
                                            <span>Payment dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url(); ?>admin_user_payment_details/roi">
                                            <span>Return of interest payouts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url(); ?>admin_user_payment_details/loyality_income">
                                            <span>Loyality income payouts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url(); ?>admin_user_payment_details/referral_income">
                                            <span>Referral income payouts</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                    
                    <!--<li>
                        <a href="../changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Changelogs</span>
                        </a>
                    </li>-->
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>