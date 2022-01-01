<?php
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
require_once("../../CSM/function.php"); // function gọi là chức năng nhé =))
require('check.php');

$id = $_GET['id'];
$username = trim($_POST['username']);
$khoa = trim($_POST['khoa']);
$email = trim($_POST['email']);
$sdt = trim($_POST['phone']);
$name = trim($_POST['name']);
$tien = trim($_POST['tien']);
$quyen = trim($_POST['type']);


    if ($_GET['type'] == 'xoa') {
         if ($id >= 1) {
       db_update("client", array("status" => 1), "id = '{$id}'");          
        $_SESSION['admin_message'] = 'Block thành công!';
		$_SESSION['success'] = 'ok';
    }else{
          $_SESSION['admin_message'] = 'thất bại!';

    }
    header('location: /admin/menber.php');
    exit;
    
 }
 
try {
    if ($_POST['id']) {
		   db_insert("log", array('email' => $email, 'type' => 'Cộng Tiền','mota' => 'Admin cộng tiền giao dịch','status' => 'Thành Công','amount' => $tien , 'time' => time())); // log
	 
        db_update("client", array( "phone" => $sdt,"status" => $khoa,"email" => $email,"name" => $name,"type_menber" => $quyen ,"cash" => $tien ), "id = '".$_POST['id']."'"); // cập nhật trạng thái   
        $_SESSION['admin_message'] = 'Cập nhật thành công!';
        $_SESSION['success'] = 'ok';
		header('Location: /admin/menber.php');
        exit;
    }
} catch (Exception $e) {
    $_SESSION['admin_message'] = 'Cập nhật thất bại: ' . $e->getMessage();
    header('Location: /admin/menber.php');
}
?>
