<?php
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
include_once($_SERVER['DOCUMENT_ROOT'] . '/CSM/function.php');// function gọi là chức năng nhé =))
require('check.php');

if($_GET['id']){
$id = $_GET['id'];
}else{
$id = $_POST['id'];   
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$khoa = trim($_POST['khoa']);

if ($_POST['xoa'] == 'xoa') {

    if ($id >= 1) {
        $dbh->prepare("DELETE FROM `my_viettel` WHERE `id` = ?")->execute(array($id));
        $_SESSION['admin_message'] = 'Xóa thành công!';
        $_SESSION['success'] = 'ok';
    } else {
        $_SESSION['admin_message'] = 'Xóa thất bại!';
    }

    header('location: /admin/myviettel.php');
    exit;
}else{

if (isset($_POST['id'])) {

    $dbh->prepare("
             UPDATE `my_viettel`
                       SET `username` = ?, `password` = ?, `khoa` = ?
              WHERE `id` = ?
             ")->execute(array($username, $password, $khoa, $_POST['id']));
            $_SESSION['admin_message'] = 'Cập nhật thành công! ';
            $_SESSION['success'] = 'ok';
            header('Location: /admin/myviettel.php');
            exit;
} else {

    $check_error = $dbh->query("SELECT * FROM my_viettel where username = '{$username}'")->fetchAll();
    if ($check_error == true) {
        $_SESSION['admin_message'] = 'Tài khoản này đã tồn tại';
        header('Location: /admin/myviettel.php');
        exit;
    }

    $dbh->prepare("INSERT INTO my_viettel (username, password, khoa) VALUES (?,?,?)")
        ->execute(array($username, $password, $khoa));
        $_SESSION['admin_message'] = 'Thêm myviettel mới thành công';
        $_SESSION['success'] = 'ok';
        header('Location: /admin/myviettel.php');
        exit;

}

}