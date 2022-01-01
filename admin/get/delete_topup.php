<?
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
include_once($_SERVER['DOCUMENT_ROOT'] . '/CSM/function.php');// function gọi là chức năng nhé =))
require('check.php');

$id = (int)GET("id");
$type = $_GET['type'];

if($type == 'list_ckcard'){
    if (!$id) {
    load_url(setting('domain')."/admin/add_nhamang.php");
    }
 $info = info_network($id);
    if ($info) {
        db_query("DELETE FROM list_ckcard WHERE id = '$id'");
        load_url(setting('domain')."/admin/add_nhamang.php");
    }else{
        load_url(setting('domain')."/admin/add_nhamang.php");
    }   
}elseif($type == 'type_card'){
    
if (!$id) {
        load_url(setting('domain')."/admin/add_nhamang.php");
}
$info = info_type($id);
if ($info) {
    db_query("DELETE FROM type_card WHERE id = '$id'");
        load_url(setting('domain')."/admin/add_nhamang.php");
}else{
        load_url(setting('domain')."/admin/add_nhamang.php");
}
    
}elseif($type == 'list_cuoc'){
    
if (!$id) {
        load_url(setting('domain')."/admin/add_nhamang.php");
}
$info = info_cuoc($id);
if ($info) {
    db_query("DELETE FROM list_cuoc WHERE id = '$id'");
        load_url(setting('domain')."/admin/add_nhamang.php");
}else{
        load_url(setting('domain')."/admin/add_nhamang.php");
}
    
}elseif($type == 'list_bantien'){
    
if (!$id) {
        load_url(setting('domain')."/admin/add_nhamang.php");
}
$info = info_bantien($id);
if ($info) {
    db_query("DELETE FROM list_bantien WHERE id = '$id'");
        load_url(setting('domain')."/admin/add_nhamang.php");
}else{
        load_url(setting('domain')."/admin/add_nhamang.php");
}
    
}


