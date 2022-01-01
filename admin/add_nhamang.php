<?php
include_once('header.php');
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)


if(isset($_POST['duyet'])){
    
    //thêm vào data
    $type = $_POST['type'];
    $chietkhau = $_POST['chietkhau'];
   db_insert("list_ckcard", array("type" => $type, "chietkhau" => $chietkhau, "status" => 'yes',"time" => time()));

}if(isset($_POST['huy'])){
        //thêm vào data
    $type = $_POST['type1'];
    $chietkhau = $_POST['chietkhau1'];
    $chietkhau_min = $_POST['chietkhau_min'];
   db_insert("type_card", array("type" => $type, "chietkhau" => $chietkhau, "chietkhau_min" => $chietkhau_min, "status" => 'yes',"time" => time()));
}


?>

<script type="text/javascript">
	   function delacc(id) {
	      var result = confirm("Bạn có muốn xóa thẻ này?");
	      if (result) {
	         window.location = "<?php echo setting('domain'); ?>/admin/get/delete_topup.php?type=list_ckcard&id="+id;
	      }
	   }
	   	   function delecard1(id) {
	      var result = confirm("Bạn có muốn xóa thẻ này?");
	      if (result) {
	         window.location = "<?php echo setting('domain'); ?>/admin/get/delete_topup.php?type=type_card&id="+id;
	      }
	   }
</script>
<div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Base Style table start -->
<div class="row">
<div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Thêm Loại Thẻ Và chiết khấu Nạp Topup</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <form class="form-material"  method="post">
                                                            <div class="form-group form-default">
                                                                <input type="text" name="type1" class="form-control">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Loại Thẻ :</label>
                                                            </div>
                                                            
                                                           <div class="form-group form-default">
                                                                <input type="text" name="chietkhau1" class="form-control">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Chiết Khấu :</label>
                                                            </div>              
                                                                <div class="form-group form-default">
                                                                <input type="text" name="chietkhau_min" class="form-control">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Chiết Khấu Min :</label>
                                                            </div>
                    
                                                        <div class="footer">
                                    <hr>
  <center><div class="dt-buttons"><button type="submit" title="huy" name="huy" tabindex="0" aria-controls="class-btn" class="dt-button btn-danger">Thêm </button>
      </div>
  </center>

                                </div>
                                </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        
                                        
  <div class="row">
<div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh Sách Nhà Mạng Nạp</h4>
                            </div>
                            <div class="content"><div class="table-responsive">
                                <table class="table table-striped">
                                        <thead>
                                        <th>ID</th>
                                        <th>Loại Thẻ</th>
                                        <th>Chiết Khấu</th>
                                        <th>Chiết Khấu Min</th>
                                        <th><center>Thao tác</center></th>

                                      </thead>
                                      <tbody>
<?php
// đếm tổng
$result = db_row("SELECT count(id) AS counter FROM type_card");
// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 15; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang
if ($result["counter"] == 0){
?>
<tr><td colspan="5" class="text-center">Chưa cập nhật dữ liệu</td></tr>
<?
}else{
// kết thúc phân trang
$list_client = db_list("SELECT * FROM type_card ORDER BY time DESC LIMIT {$startpoint} , {$per_page}");
foreach ($list_client as $item) {
?>
                                          <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td><?php echo $item["type"]; ?></td>            
                                            <td><?php echo $item["chietkhau"]; ?>%</td>
                                            <td><?php echo $item["chietkhau_min"]; ?>%</td>
                                            <td><center>
                                      <a onclick="delecard1('<?php echo $item['id'] ?>');" title="Xỏa bỏ"
                                    href="#"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>       
                              <a href="/admin/get/edit_type.php?id=<?=$item["id"]?>&type=type_card" title="Chỉnh sửa"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>
     
                                        
                                                        </td>
                                          </tr>
<?php 
}
}
?>
                                      </tbody>
                                  </table></div>
                                    
                                    <div class="footer">
                                    <hr>

                                </div>
                            </div>
                        </div>
                                            </div>
                                        </div>   
                                                                              
                                        
                                        
                                        </div>    </div>    </div>
<?php include_once('fooder.php'); ?>           
