<?php
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
include_once($_SERVER['DOCUMENT_ROOT'] . '/CSM/function.php');// function gọi là chức năng nhé =))
unset($_SESSION['CSM_ADMIN']);
header("Location: /index.html");  
?>
