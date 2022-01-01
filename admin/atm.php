 <?php
include_once('header.php');
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)

if($_POST){ 
if($_POST['xoa']){
      $id = $_POST['xoa']; 
      $info = info_atm($id);
        if ($info) {
            db_query("DELETE FROM admin_atm WHERE id = '$id'");
            load_url(setting('domain')."/admin/atm.php");
        }else{
            load_url(setting('domain')."/admin/atm.php");
        }  
}else {
    // thành công
        //thêm vào data
      $_POST['time'] = time();    
       db_insert("admin_atm", $_POST);
       $id_insert = db_insert_id();
       load_url(setting('domain')."/admin/atm.php");
}
}
?>
 
 
      <div class="card">
          
                                                                <div class="card-block">    

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Quản Lý Ngân Hàng</h4>
                            </div>
                            <div class="content">
<form enctype="multipart/form-data" method="post" action="#"> 
<div class="row">
 <div class="col-sm-12">
  <div class="form-group">
    <label for="stk">Số Tài Khoản:</label>
    <input type="number" class="form-control border-input" name="STK" placeholder="Số Tài Khoản" >
  </div>
 </div>
</div>
<div class="row">
 <div class="col-sm-12">
  <div class="form-group">
    <label for="tenchutk">Tên Chủ Tài Khoản:</label>
    <input type="text" class="form-control border-input" name="name_CTK" placeholder="Chủ Tài Khoản">
  </div>
 </div>
</div>
<div class="row">
 <div class="col-sm-12">
  <div class="form-group">
    <label for="nh">Ngân Hàng:</label>
    <input type="text" class="form-control border-input" name="name_nh" placeholder="Ngân Hàng" >
  </div>
 </div>
</div>
                                    <div class="footer">
                                    <hr>
  <button type="submit"  class="btn btn-default">Thêm Ngân Hàng</button>

                                </div>
</from>                                </div>
                            </div>
                        </div>
          
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh Sách Ngân Hàng</h4>
                            </div>
                            <div class="content"><div class="table-responsive">
                                <table class="table table-striped">
                                        <thead>
                                        <th>Số Tài Khoản</th>
                                        <th>Tên Chủ Tài Khoản</th>
                                        <th>Ngân Hàng</th>
                                        <th><center>Thao tác</center></th>

                                      </thead>
                                      <tbody>
<?php
// đếm tổng
$result = db_row("SELECT count(id) AS counter FROM admin_atm");
// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 15; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang
if ($result["counter"] == 0){
?>
<tr><td colspan="4" class="text-center">Chưa cập nhật dữ liệu</td></tr>
<?
}else{
// kết thúc phân trang
$list_client = db_list("SELECT * FROM admin_atm ORDER BY id DESC LIMIT {$startpoint} , {$per_page}");
foreach ($list_client as $item) {
?>
                                          <tr>
                                            <td><?php echo $item["STK"]; ?></td>
                                            <td><?php echo $item["name_CTK"]; ?></td>            
                                            <td><?php echo $item["name_nh"]; ?></td>
                                            <td><center>
                                                 <form action="#" method="post">
                                             <button type="submit" class="btn btn-danger btn-xs" title="Xóa" style="padding: 6px 12px;" name="xoa" value ="<?php echo $item["id"]; ?>">Xóa</button>
                                                      </form>
                                                                      </center>                                          </td>
                                          </tr>
<?php 
}
}
?>
                                      </tbody>
                                  </table></div>
                                    
                                    <div class="footer">
                                    <hr>
                                    <div class="stats">
                                    <?php
                                    echo pagination_html($result['counter'],$per_page,$page,$url='/admin/atm.php?page=');
                                    ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
 </div>
                 </div>
 </div>
 <?php include_once('fooder.php'); ?>           
