<?php
include_once('header.php');
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)


if(isset($_POST['type'])){
    
    //thêm vào data
    $type = $_POST['type'];
    $chietkhau = $_POST['chietkhau'];
    $chietkhau_ctv = $_POST['chietkhau_ctv'];
    $chietkhau_ctv_c1 = $_POST['chietkhau_ctv_c1'];
    $chietkhau_ctv_c2 = $_POST['chietkhau_ctv_c2'];    
   db_insert("list_cuoc", array("type" => $type, "chietkhau" => $chietkhau, "chietkhau_ctv" => $chietkhau_ctv,"chietkhau_ctv_c1" => $chietkhau_ctv_c1, "chietkhau_ctv_c2" => $chietkhau_ctv_c2,"status" => 'yes',"time" => time()));

}if(isset($_POST['duyetdt'])){
    $type = $_POST['type'];
    $chietkhau = $_POST['chietkhau'];
    $chietkhau_ctv = $_POST['chietkhau_ctv'];
    $chietkhau_ctv_c1 = $_POST['chietkhau_ctv_c1'];
    $chietkhau_ctv_c2 = $_POST['chietkhau_ctv_c2']; 
   db_insert("list_bantien", array("type" => $type, "chietkhau" => $chietkhau, "chietkhau_ctv" => $chietkhau_ctv,"chietkhau_ctv_c1" => $chietkhau_ctv_c1, "chietkhau_ctv_c2" => $chietkhau_ctv_c2,"status" => 'yes',"time" => time()));
}


?>

<script type="text/javascript">
	   function delacc(id) {
	      var result = confirm("Bạn có muốn xóa thẻ này?");
	      if (result) {
	         window.location = "<?php echo setting('domain'); ?>/admin/get/delete_topup.php?type=list_cuoc&id="+id;
	      }
	   }
	   	   function delecard1(id) {
	      var result = confirm("Bạn có muốn xóa thẻ này?");
	      if (result) {
	         window.location = "<?php echo setting('domain'); ?>/admin/get/delete_topup.php?type=list_bantien&id="+id;
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
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                <h4 class="title">Thêm Nhà Mạng Và Quản Lý Chiết Khấu (Nạp Cước)</h4>
                                                    </div>
                                                    <div class="card-block">
                                                        <form class="form-material"  method="post">
                                                            <input id="status" name="status" type="hidden" value="yes">

                                                            <div class="form-group form-default">
                                                                <input type="text" name="type" class="form-control">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Loại Thẻ :</label>
                                                            </div>
                                                            
                                                                                   <div class="form-group form-default">
                                                                <input type="text" name="chietkhau" class="form-control">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Chiết Khấu :</label>
                                                            </div>              
                  
                                                            <div class="row">
                                         <div class="col-sm-12">
                                          <div class="form-group">
                                            <label for="chietkhau">Chiết Khấu CTV & Đại Lý:</label>
                                            <input type="number" class="form-control border-input" name="chietkhau_ctv" placeholder="Chiết Khấu">
                                          </div>
                                         </div>
                                        </div>
                                        <div class="row">
                                         <div class="col-sm-12">
                                          <div class="form-group">
                                            <label for="chietkhau">Chiết Khấu CTV & Đại Lý Cấp 1:</label>
                                            <input type="number" class="form-control border-input" name="chietkhau_ctv_c1" placeholder="Chiết Khấu">
                                          </div>
                                         </div>
                                        </div>
                                        <div class="row">
                                         <div class="col-sm-12">
                                          <div class="form-group">
                                            <label for="chietkhau">Chiết Khấu CTV & Đại Lý Cấp 2:</label>
                                            <input type="number" class="form-control border-input" name="chietkhau_ctv_c2" placeholder="Chiết Khấu">
                                          </div>
                                         </div>
                                        </div>
                                                        <div class="footer">
                                    <hr>
  <center><div class="dt-buttons"><button type="submit" title="duyet" name="duyet" tabindex="0" aria-controls="class-btn" class="dt-button btn-danger">Thêm </button>
      </div>
  </center>

                                </div>
                                </form>
                                                    </div>
                                                </div>
                                            </div>
<div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                <h4 class="title">Thêm Nhà Mạng Và Quản Lý Chiết Khấu (BẮN TIỀN)</h4>
                                                    </div>
                                                    <div class="card-block">
                                                        <form class="form-material"  method="post">
                                                            <input id="status" name="status" type="hidden" value="yes">

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
                  <div class="row">
 <div class="col-sm-12">
  <div class="form-group">
    <label for="chietkhau">Chiết Khấu CTV & Đại Lý:</label>
    <input type="number" class="form-control border-input" name="chietkhau_ctv" placeholder="Chiết Khấu">
  </div>
 </div>
</div>
<div class="row">
 <div class="col-sm-12">
  <div class="form-group">
    <label for="chietkhau">Chiết Khấu CTV & Đại Lý Cấp 1:</label>
    <input type="number" class="form-control border-input" name="chietkhau_ctv_c1" placeholder="Chiết Khấu">
  </div>
 </div>
</div>
<div class="row">
 <div class="col-sm-12">
  <div class="form-group">
    <label for="chietkhau">Chiết Khấu CTV & Đại Lý Cấp 2:</label>
    <input type="number" class="form-control border-input" name="chietkhau_ctv_c2" placeholder="Chiết Khấu">
  </div>
 </div>
</div>
                    
                                                        <div class="footer">
                                    <hr>
  <center><div class="dt-buttons"><button type="submit" title="duyetdt" name="duyetdt" tabindex="0" aria-controls="class-btn" class="dt-button btn-danger">Thêm </button>
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
                                <h4 class="title">Danh Sách Nhà Mạng (Nạp Cước)</h4>
                            </div>
                            <div class="content"><div class="table-responsive">
                                <table class="table table-striped">
                                        <thead>
                                        <tr><th>ID</th>
                                        <th>Nhà Mạng</th>
                                        <th>Chiết Khấu</th>
                                        <th>Chiết Khấu Đại Lý </th>
                                        <th>Chiết Khấu Đại Lý Cấp 1</th>
                                        <th>Chiết Khấu Đại Lý Cấp 2</th>
                                        <th><center>Thao tác</center></th>

                                      </tr></thead>
                                      <tbody>
    <?php
// đếm tổng
$result = db_row("SELECT count(id) AS counter FROM list_cuoc");
// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 15; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang
if ($result["counter"] == 0){
?>
<tr><td colspan="10" class="text-center">Chưa cập nhật dữ liệu</td></tr>
<?
}else{
// kết thúc phân trang
$list_client = db_list("SELECT * FROM list_cuoc  ORDER BY id DESC LIMIT {$startpoint} , {$per_page}");
foreach ($list_client as $item) {
?>
                                          <tr>
                                            <td><?=$item['id']?></td>
                                            <td><?=$item['type']?></td>            
                                            <td><?=$item['chietkhau']?>%</td>
                                            <td><?=$item['chietkhau_ctv']?>%</td>
                                                    <td><?=$item['chietkhau_ctv_c1']?>%</td>
                                                       <td><?=$item['chietkhau_ctv_c2']?>%</td>
                                            <td><center>
                                      <a onclick="delacc('<?php echo $item['id'] ?>');" title="Xỏa bỏ"
                                    href="#"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>       
                              <a href="/admin/get/edit_type.php?id=<?=$item["id"]?>&type=list_cuoc" title="Chỉnh sửa"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a></td>
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
                    
                        <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh Sách Nhà Mạng (BẮN TIỀN)</h4>
                            </div>
                            <div class="content"><div class="table-responsive">
                                <table class="table table-striped">
                                        <thead>
                                        <tr><th>ID</th>
                                        <th>Nhà Mạng</th>
                                        <th>Chiết Khấu</th>
                                        <th>Chiết Khấu Đại Lý </th>
                                        <th>Chiết Khấu Đại Lý Cấp 1</th>
                                        <th>Chiết Khấu Đại Lý Cấp 2</th>
                                        <th><center>Thao tác</center></th>

                                      </tr></thead>
                                      <tbody>
    <?php
// đếm tổng
$result = db_row("SELECT count(id) AS counter FROM list_bantien");
// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 15; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang
if ($result["counter"] == 0){
?>
<tr><td colspan="10" class="text-center">Chưa cập nhật dữ liệu</td></tr>
<?
}else{
// kết thúc phân trang
$list_client = db_list("SELECT * FROM list_bantien  ORDER BY id DESC LIMIT {$startpoint} , {$per_page}");
foreach ($list_client as $item) {
?>
                                          <tr>
                                            <td><?=$item['id']?></td>
                                            <td><?=$item['type']?></td>            
                                            <td><?=$item['chietkhau']?>%</td>
                                            <td><?=$item['chietkhau_ctv']?>%</td>
                                                    <td><?=$item['chietkhau_ctv_c1']?>%</td>
                                                       <td><?=$item['chietkhau_ctv_c2']?>%</td>
                                            <td><center>
                                      <a onclick="delecard1('<?php echo $item['id'] ?>');" title="Xỏa bỏ"
                                    href="#"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>       
                              <a href="/admin/get/edit_type.php?id=<?=$item["id"]?>&type=list_bantien" title="Chỉnh sửa"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>
     
                                        
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
 </div>
                                                                              
                                        
                                        
                                        </div>    </div>    </div>
<?php include_once('fooder.php'); ?>           
