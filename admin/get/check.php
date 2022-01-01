<?php
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
require_once("../../CSM/function.php"); // function gọi là chức năng nhé =))
if (is_admin()) {
        if($_SESSION['CSM_ADMIN']){
            
        }else{
             load_url(setting('domain').'/admin/login.php');
             exit();
        }
    
}else{
        load_url(setting('domain').'/404');
        exit();

}