<?php
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
include_once($_SERVER['DOCUMENT_ROOT'] . '/CSM/function.php');// function gọi là chức năng nhé =))
require('check.php');
if($_GET['id'] && $_GET['xoa']){
          db_update("csm_admin", array("status" => 1 ), "id = '{$_GET['id']}'"); 
   $_SESSION['admin_message'] = 'Block Thành công ADMIN';

 header('location: /admin/admin.php');
    exit;
 }
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['cpassword'])) {
    $_SESSION['admin_message'] = 'Vui lòng nhập đầy đủ các trường bắt buộc';
    header('location: /admin/admin.php');
    exit;
}

if ($_POST['password'] != $_POST['cpassword']) {
    $_SESSION['admin_message'] = 'Mật khẩu không khớp, vui lòng lưu ý khi nhập lại mật khẩu!';
    header('location: /admin/admin.php');
    exit;
}

$username = trim($_POST['username']);
$hashPassword = md5(md5($_POST['password']));


    if ($_POST['id']) {
        db_update("csm_admin", array("username" => $username ,"password" =>$hashPassword,"status" => $_POST['select']), "id = '{$_POST['id']}'"); 

        $_SESSION['admin_message'] = 'Thay đổi thông tin quản trị viên thành công!';
        
     } else {
    
            	    $show = db_row("SELECT * FROM csm_admin WHERE username = '{$username}'"); 

        if ($show == false) {
            $_SESSION['admin_message'] = 'Thêm quản trị viên mới thành công!';
         $_SESSION['success'] = 'ok';

              db_insert("csm_admin", array('username' => $username, 'password' => $hashPassword,"status" => $_POST['select'],'ip' => '123.156.691','last_time' => '452878575', 'time' => time())); // log

        } else {
            $_SESSION['admin_message'] = 'Tài khoản đã tồn tại!';
            header('Location: /admin/admin.php');
            exit;
        }
    }
    header('Location: /admin/admin.php');
    exit;
?>



