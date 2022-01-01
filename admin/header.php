<?
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
include_once($_SERVER['DOCUMENT_ROOT'] . '/CSM/function.php');// function gọi là chức năng nhé =))
        if($_SESSION['CSM_ADMIN']){
            
        }else{
             load_url(setting('domain').'/admin/login.php');
             exit();
        }

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Quản Trị Hệ Thống</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/admin/files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="/admin/files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="/admin/files/assets/icon/feather/css/feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/admin/files/assets/css/style.css">
    <script type="text/javascript" src="/admin/files/assets/js/sweetalert.min.js" async></script>
    <link rel="stylesheet" type="text/css" href="/admin/files/assets/css/widget.css">
</head>
			
<body>
		
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <!-- [ Pre-loader ] end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- [ Header ] start -->
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                        <i class="feather icon-toggle-right"></i>
                    </a>
                        <a href="#">
                        <img class="img-fluid" src="/admin/files/assets/images/logo.png" alt="Theme-Logo" />
                    </a>
                        <a class="mobile-options waves-effect waves-light">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close">
										<i class="feather icon-x input-group-text"></i>
									</span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn">
										<i class="feather icon-search input-group-text"></i>
									</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                <i class="full-screen feather icon-maximize"></i>
                            </a>
                            </li>
                        </ul>
                        <ul class="nav-right">


                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="/admin/files/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span>Bắc CSM</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
     
                                        <li>
                                            <a href="/admin/logout.php">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- [ Header ] end -->

            
        
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- [ navigation menu ] start -->
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            
                                                     <div class="">
                                <div class="main-menu-header">
                                    <img class="img-menu-user img-radius" src="/admin/files/assets/images/avatar-4.jpg" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <p id="more-details">ADMIN<i class="feather icon-chevron-down m-l-10"></i></p>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                          
                                
                                            <a href="/admin/logout.php">
                                            <i class="feather icon-log-out"></i>Logout
                                        </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>    
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="<?php echo (isset($active) && $active == "main") ? 'active':'';  ?> ">
                                    <a href="/admin" class="waves-effect waves-dark">
        								<span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Bảng Điểu Khiển</span>
                                    </a>
                                </li>
                                

  
                             <li class="<?php echo (isset($active) && $active == "setting") ? 'active':'';  ?>">
                                    <a href="/admin/momo.php" class="waves-effect waves-dark">
									<span class="pcoded-micon">
										<i class="feather icon-settings"></i>
									</span>
                                    <span class="pcoded-mtext">MOMO</span>
                                </a>
                                </li>   
                              <li>
                                

  
                             <li class="<?php echo (isset($active) && $active == "setting") ? 'active':'';  ?>">
                                    <a href="/admin/setting.php" class="waves-effect waves-dark">
									<span class="pcoded-micon">
										<i class="feather icon-settings"></i>
									</span>
                                    <span class="pcoded-mtext">Cài Đặt WebSite</span>
                                </a>
                                </li>   
                              <li>
                                  
                                  
                                  
                                  
                                           <a href="/admin/logout.php" class="waves-effect waves-dark">
                                                	<span class="pcoded-micon">
                                            <i class="feather icon-log-out"></i>
                                            </span>
                                                <span class="pcoded-mtext">Đăng Xuất</span>
                                </a>
                                        </a>
                                        </li>  
                            </ul>   
                            
                   </div>
                    </nav>
            
                          <!-- [ navigation menu ] end -->
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h4 class="m-b-10">Dashboard</h4>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="#">
                                                    <i class="feather icon-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="#!">Dashboard</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
<style>
.card .footer {
    padding: 0;
    line-height: 30px;
}.card .footer div {
    display: inline-block;
}.card .stats {
    color: #a9a9a9;
    font-weight: 300;
}.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px;
}.pagination>li {
    display: inline;
}.pagination>li:first-child>a, .pagination>li:first-child>span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}.pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}</style>                 