<?php include_once('header.php'); ?>           

<?php
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)
    
if(isset($_POST['duyet'])){
    $info =  db_row("SELECT * FROM client_apis WHERE id = '".(int)$_POST['duyet']."' AND status ='0' LIMIT 1"); 
    if($info){
    // dòng này thêm lịch sử chính
        db_update("client_apis", array("status" => 2), "id = '".(int)$_POST['duyet']."'"); // cập nhật trạng thái
    }    
        load_url(setting('domain')."/admin/api.php");
    // end
    
    
    $info =  db_row("SELECT * FROM client_apis WHERE id = '".$_POST['duyet']."' LIMIT 1"); 

}if(isset($_POST['huy'])){ 
        $info =  db_row("SELECT * FROM client_apis WHERE id = '".$_POST['huy']."' and status ='0' or status ='2' LIMIT 1"); 
        if($info){        
        db_update("client_apis", array("status" => 1), "id = '".$_POST['huy']."'"); // cập nhật trạng thái
        }
        load_url(setting('domain')."/admin/api.php");


}else{
?>        
        

<div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Base Style table start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Quản Lý API Tích Hợp</h5>
                                            </div>
                                            <div class="card-block">
                                                <div class="dt-responsive table-responsive">
                                                    <div id="base-style_wrapper" class="dataTables_wrapper dt-bootstrap4">
													<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-7">
													<div id="base-style_filter" class="dataTables_filter">

<form action="" method="post">

  <div class="card-block">
                                                              <div class="row">

<div class="col-sm-12 col-xl-3 m-b-30">
  <input name="findname" type="text" class="form-control border-input" id="findname" value="<?php echo $_POST["findname"]; ?>" placeholder="Thành Viên">
</div>

<div class="col-sm-12 col-xl-3 m-b-30">
  <input name="findid" type="number" class="form-control border-input" id="findid" value="<?php echo htmlspecialchars($_POST['findid']); ?>" placeholder="Mã số">
</div>

<div class="col-sm-12 col-xl-3 m-b-30">    
		<select class="form-control form-control-default fill" name="findstatus">
		<option value="">Trạng thái</option>
		<option value="1" <?php if($_POST['findstatus'] == '1'): echo'selected'; endif; ?>>Bị hủy</option>
		<option value="0" <?php if($_POST['findstatus'] == '0'): echo'selected'; endif; ?>>Đang chờ</option>
		<option value="2" <?php if($_POST['findstatus'] == '2'): echo'selected'; endif; ?>>Đã Duyệt</option>
		</select>
</div>
<div class="col-sm-12 col-xl-3 m-b-302">
<div class="form-group">
<button type="submit" name="timkiem" class="btn btn-warning" style="padding: 6px 12px;"><i class="fa fa-search"></i> Tìm kiếm</button>
</div>
</div>
</div>
</form>

</div>
													</div></div></div><div class="row"><div class="col-xs-12 col-sm-12">
													<table id="base-style" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="base-style_info">
                                                                                              <thead>
   <tr>
	   <th>#</th>
	   <th>Thành viên</th>
	   <th>Website</th>
	   <th>Url CallBack</th>
	   <th>Api Key</th>
	   <th>Api Select</th>  	 
	   <th>Thời gian</th>
	   <th>Doanh Thu</th>
	   <th>Thực Nhận</th>
	   <th>Trạng thái</th>
	   <th></th>
   </tr>
                                      </thead>
                                                        <tbody>   

<?php
$id = (int)(!isset($_POST["findid"]) ? 0 : $_POST["findid"]);
$status = (!isset($_POST["findstatus"]) ? "" : db_escape(addslashes($_POST["findstatus"])));
$type = (!isset($_POST["findtype"]) ? "" : db_escape(addslashes($_POST["findtype"])));

$where = " email != '' ";

if ($id) {
    $where .= " AND id = '$id' ";
} 
if ($status >= '0' && $status <= '3') {
    $where .= " AND status = '$status' ";
} 

$arrstatus = array("Chờ duyệt","Bị hủy"," Đã Duyệt");

if(!$_POST){
$result = db_row("SELECT count(id) AS counter FROM client_apis WHERE status = '0' or status ='2' ");
}else{
$result = db_row("SELECT count(id) AS counter FROM client_apis WHERE $where");
}
// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 20; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang

if ($result["counter"] == 0){
?>
<tr><td colspan="11" class="text-center">Chưa có thành viên nào đăng ký tích hợp</td></tr>
<?
}else{
// kết thúc phân trang

if(!$_POST){
$list_client = db_list("SELECT * FROM client_apis WHERE status = '0' or status ='2' ORDER BY time ASC LIMIT {$startpoint} , {$per_page}");
}else{
$list_client = db_list("SELECT * FROM client_apis where $where ORDER BY status ASC, time DESC LIMIT 40");
}
foreach ($list_client as $item) {
?>
                   
                                          <tr>
                                            <td><?php echo ($item["id"]); ?></td>

                                            <td><?php echo client($item["fid"])['name']; ?></td>
                                          
                                            <td><?php echo htmlentities($item["website"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["url_callback"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["APIkey"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo ($item["APIsecret"]); ?></td>
                                            <td><?php echo time_to_str($item["time"]); ?></td>
                                            <td><?php $delay = db_row("SELECT SUM(cash) AS total FROM topup WHERE status = '2' AND  type_add = 'Nạp API' AND email ='{$item['email']}' AND domain_add = '{$item['website']}' ");
                                            echo format_cash($delay['total']); ?> VNĐ</td>
                                            <td><?php $delay = db_row("SELECT SUM(cash_real) AS total FROM topup WHERE status = '2' AND  type_add = 'Nạp API' AND email ='{$item['email']}' AND domain_add = '{$item['website']}' ");
                                            echo format_cash($delay['total']); ?> VNĐ</td>
                                           <td><span class="label <?php if($item['status'] ==0) {echo 'label-warning';}elseif($item['status'] == 1) {echo 'label-danger';}elseif($item['status'] == 2) {echo 'label-success';} ?>"><?php echo $arrstatus[$item['status']]; ?></span></td>
                                        
                                            
                                     
                                            <td>

											 <?php if($item["status"]==0 ): ?>
											                                                 <form action="" method="post">
                                      <input type="hidden" name="duyet" value="<?php echo $item["id"]; ?>"/>    
                                    <button type="submit" class="btn-primary label-dange" title="Duyệt" name="xacnhanduyet" value="<?php echo $item["id"]; ?>">Duyệt</button>
                                    </form>
                                                                                  

												 <?php endif; ?>
												   <form action="" method="post">
                                    <input type="hidden" name="huy" value="<?php echo $item["id"]; ?>"/>    
                                    <button type="submit" class="btn-danger label-dange" title="Xóa" name="huy" value="<?php echo $item["id"]; ?>">Xóa</button>
                                                </form>
												</td>
                                          </tr>

<?php 
}
}
?>                                         

										  </tbody>
                                                    </table></div></div>
										<div class="footer">
                                    <hr>      <?php
                                                                                if(!$_POST){

                                    echo pagination_get($result['counter'],$per_page,$page,$url='/admin/api.php?page=');
                                                                                }
                                    ?>

													</div>
                                                </div>
                                            </div>
                                        </div>
                                            </div>    </div>    </div>    </div>
                                                            <script>
                </script>
                
<?php
}
?>    
     <?php include_once('fooder.php'); ?>           
