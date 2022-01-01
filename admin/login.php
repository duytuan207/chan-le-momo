<?
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
include_once($_SERVER['DOCUMENT_ROOT'] . '/CSM/function.php');// function gọi là chức năng nhé =))
        if(!$_SESSION['CSM_ADMIN']){
            
        }else{
             load_url(setting('domain').'/admin/');
             exit();
        }
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản Trị Hệ Thống</title>
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="Phoenixcoded" />
      <!-- Favicon icon -->

      <link rel="icon" href="/files/assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->     
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="/admin/files/bower_components/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="/admin/files/assets/pages/waves/css/waves.min.css" type="text/css" media="all"><!-- feather icon --> <link rel="stylesheet" type="text/css" href="/admin/files/assets/icon/feather/css/feather.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="/admin/files/assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="/admin/files/assets/icon/icofont/css/icofont.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="/admin/files/assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="/admin/files/assets/css/style.css"><link rel="stylesheet" type="text/css" href="/admin/files/assets/css/pages.css">
  </head>

  <body themebg-pattern="theme1">
  <!-- Pre-loader start -->
  <div class="theme-loader">
      <div class="loader-track">
          <div class="preloader-wrapper">
              <div class="spinner-layer spinner-blue">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
              <div class="spinner-layer spinner-red">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-yellow">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-green">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
      <?
	if(isset($_POST['login'])) {

    $username = db_escape(addslashes(htmlentities(POST('username', ENT_QUOTES, "UTF-8"))));
    $pwd = db_escape(addslashes(htmlentities(POST('password', ENT_QUOTES, "UTF-8"))));
	    
	 $check = db_row("SELECT count(id) AS counter FROM csm_admin WHERE username = '{$username}' AND password = '".md5(md5($pwd))."'");
    if ($_SESSION['CSM_ADMIN']) {
        	echo '<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Oops!</strong> Bạn Đã Đăng Nhập Rồi!
	</div> ';
	}elseif(empty($username) ||empty($pwd)){
	echo '<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Oops!</strong> Bạn chưa nhập tài khoản hoặc mật khẩu. vui lòng thử lại!
	</div>';
	}elseif($check["counter"] < 1){
        	echo '<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Oops!</strong> Tài khoản hoặc mật khẩu không chính xác. vui lòng thử lại!
	</div> ';
    }else{
        
    
    $user =  db_row("SELECT * FROM csm_admin WHERE username = '{$username}' AND password = '".md5(md5($pwd))."' LIMIT 1");
    if($user['status'] == '1' ){
                	echo '<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Oops!</strong> Tài khoản đã bị khóa
	</div> ';
    }else{    
    $_SESSION['CSM_ADMIN'] = $user['username'];
     if (!empty($_SERVER['HTTP_CLIENT_IP']))     
		  {  
			$ip = $_SERVER['HTTP_CLIENT_IP'];  
		  }  
		//Kiểm tra xem IP có phải là từ Proxy  
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    
		  {  
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
		  }  
		//Kiểm tra xem IP có phải là từ Remote Address  
		else  
		  {  
			$ip = $_SERVER['REMOTE_ADDR'];  
		  }
		db_update("csm_admin", array("ip" => $ip), "username = '".$_SESSION["CSM_ADMIN"]."'");
    
    header("location: /admin/");
    
    }

    }
	    
	    
	}
?>
                     
                        <form class="md-float-material form-material" method="POST" action="#">
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Đăng Nhập</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="username" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Tài khoản hoặc email</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right float-right">
                                                <a href="#" class="text-right f-w-600"> Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                                                <?php echo (isset($err)) ? ' <div class="callout callout-info">'.$err.'</div>' : ''; ?>

                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" name="login" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20 ">Đăng Nhập</button>
                                        </div>
                                    </div>
                                    <hr/>

                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="/admin/files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="/admin/files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/admin/files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="/admin/files/bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- waves js -->
<script src="/admin/files/assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="/admin/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="/admin/files/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="/admin/files/bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="/admin/files/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="/admin/files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="/admin/files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="/admin/files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="/admin/files/assets/js/common-pages.js"></script>
</body>

</html>
