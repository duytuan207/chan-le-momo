<?php



/**
 * @package     Bắc CSM
 * @Facebook    https://www.facebook.com/profile.php?id=553416130
 * @copyright   Copyright (C) 2018-2022 Bắc CSM
 * @version     2.0
 */
 


define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi

require_once("CSM/function.php"); // function gọi là chức năng nhé =))
$xss = new Anti_xss; 

$widget = $xss->clean_up(GET("widget")); 
$patch = $xss->clean_up(GET("patch")); 

if (!$widget) { // nếu không có get truyền vào thì widget là home
	$widget = "home";
	$link = '/';
	$active = 'home';
	
}
widget("header"); // đầu trang
if (file_exists("widget/".$widget.".php")) {
    widget($widget);
    
} else { // nếu không có widget để hiện thì trả về 404
	widget("404");
}
widget("footer"); // cuối trang

