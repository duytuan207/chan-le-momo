<?php
include_once('header.php');

defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)
   
    $arrname = array( // giá trị, tên
    '1' => array("MOMO","MOMO"),
    '2' => array("ACB - NH TMCP Á CHÂU","ACB - NH TMCP Á CHÂU"),
    '3' => array("AGRIBANK - NH NN VA PT NT VN","AGRIBANK - NH NN VA PT NT VN"),
    '4' => array("BAN VIET - NH TMCP BAN VIET (VIETCAPITALBANK)","BAN VIET - NH TMCP BAN VIET (VIETCAPITALBANK)"),
    '5' => array("BIDV - NH TMCP DT VA PT VN","BIDV - NH TMCP DT VA PT VN"),
    '6' => array("DONGABANK - NH TMCP DONG A","DONGABANK - NH TMCP DONG A"),
    '7' => array("VIETINBANK - NH TMCP CONG THUONG VIET NAM","VIETINBANK - NH TMCP CONG THUONG VIET NAM"),
    '8' => array("EXIMBANK - NH TMCP XUAT NHAP KHAU VN","EXIMBANK - NH TMCP XUAT NHAP KHAU VN"),
    '9' => array("MBBANK - NH TMCP QUAN DOI","MBBANK - NH TMCP QUAN DOI"),
    '10' => array("SACOMBANK - NH TMCP SAI GON THUONG TIN","SACOMBANK - NH TMCP SAI GON THUONG TIN"),
    '11' => array("TECHCOMBANK - NH TMCP KY THUONG VN","TECHCOMBANK - NH TMCP KY THUONG VN"),
    '12' => array("VIETCOMBANK - NH TMCP NGOAI THUONG","VIETCOMBANK - NH TMCP NGOAI THUONG"),
    '13' => array("VIB - NH QUOC TE","VIB - NH QUOC TE"),
    '14' => array("VPBANK - NH TMCP VN THINH VUONG","VPBANK - NH TMCP VN THINH VUONG"),
    );
      
if(isset($_POST['duyet'])){
    if(isset($_POST['xacnhanduyet'])){
    $info =  db_row("SELECT * FROM history_bank_client WHERE id = '".(int)$_POST['duyet']."' AND status ='0' LIMIT 1"); 
    if($info){
    // dòng này thêm lịch sử chính

        $text ='Nạp tiền từ ATM thành công';
        db_insert("log", array('email' => $info['email'], 'type' => 'Nạp Tiền','mota' => $text,'status' => 'Thành Công','amount' => $_POST['thucnhan'] , 'time' => time())); // log
 
       db_update("client", array("cash" => (client($info['fid'])["cash"] + (int)$info['amount'])), "email = '".$info['email']."'");

        db_update("history_bank_client", array("status" => 2), "id = '".(int)$_POST['duyet']."'"); // cập nhật trạng thái
    }    
        load_url(setting('domain')."/admin/nap_atm.php");
    // end
    
    }
    $info =  db_row("SELECT * FROM history_bank_client WHERE id = '".$_POST['duyet']."' LIMIT 1"); 
?>
                                <div class="card">

                                                                <div class="card-block">
                                                      <form action="" method="post">
                                                                    <h4 class="sub-title">Duyệt Lệnh Nạp</h4>
                                                                    <div class="form-group has-success row">


                                                                        <div class="col-sm-2">
                                                                            <label class="col-form-label" for="inputSuccess1">Note:</label>
                                                                            </div>
                                                                            <div class="col-sm-10">
                                        <input style="max-width: 100%;" type="text" class="form-control border-input" name="lydo" placeholder="Có thể để trống">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group has-warning row">
                                                                            <div class="col-sm-2">
                                                                                <label class="col-form-label" for="inputWarning1">Số tiền nhận được:</label>
                                                                                </div>
                                                                                <div class="col-sm-10">
                                        <input style="max-width: 100%;" type="text" class="form-control border-input" name="cash_real" placeholder="Số tiền" value="<?php echo htmlentities($info["thucnhan"], ENT_QUOTES, "UTF-8"); ?>">
                                                                                    </div>
                                                                                </div>
                                                                  
                                                                            <div class="form-group has-danger row">
                                                                                <div class="col-sm-2">
                                                                                    <label class="col-form-label" for="inputDanger1">Số Tiền:</label>
                                                                                    </div>
                                                                                    <div class="col-sm-10">
                                        <input style="max-width: 100%;" type="text" class="form-control border-input" name="cash" placeholder="Số tiền" value="<?php echo htmlentities($info["amount"], ENT_QUOTES, "UTF-8"); ?>">
                                                                     
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                              <input type="hidden" name="duyet" value="<?php echo $_POST["duyet"]; ?>"/>    
                                    <button type="submit" class="btn btn-primary btn-xs" title="Xác nhận duyệt" name="xacnhanduyet" value="<?php echo $_POST["duyet"]; ?>">Xác nhận duyệt</button>
                                    </form>
                                                                            </div>
                                                                        </div>

<?php
}elseif(isset($_POST['huy'])){
    if(isset($_POST['xacnhanhuy'])){ 
        $info =  db_row("SELECT * FROM history_bank_client WHERE id = '".$_POST['huy']."' and status ='0' LIMIT 1"); 
        if($info){
        $text ='Nạp Tiền Vào Tài Khoản Thất Bại';
        db_insert("log", array('email' => $info['email'], 'type' => 'Nạp Tiền','mota' => $text,'status' => 'Thất Bại','amount' => (int)$info['amount'] , 'time' => time())); // log
        
        db_update("history_bank_client", array("status" => 1), "id = '".$_POST['huy']."'"); // cập nhật trạng thái
        }
        load_url(setting('domain')."/admin/nap_atm.php");
    }
?>

                                <div class="card">

                                                                <div class="card-block">
                                                      <form action="" method="post">
                                                                    <h4 class="sub-title">Hủy Lệnh Nạp</h4>
                                                                    <div class="form-group has-success row">


                                                                        <div class="col-sm-2">
                                                                            <label class="col-form-label" for="inputSuccess1">Note:</label>
                                                                            </div>
                                                                            <div class="col-sm-10">
                                        <input style="max-width: 100%;" type="text" class="form-control border-input" name="lydo" placeholder="Có thể để trống">
                                                                            </div>
                                                                        </div>


                                                                                
                                                                                
                                              <input type="hidden" name="huy" value="<?php echo $_POST["huy"]; ?>"/>    
                                    <button type="submit" class="btn btn-primary btn-xs" title="Xác Nhận Hủy" name="xacnhanhuy" value="<?php echo $_POST["huy"]; ?>">Xác nhận Hủy</button>
                                    </form>
                                                                            </div>
                                                                        </div>

<?
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
                                                <h5>Danh Sách Nạp Tiền</h5>
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
		<select class="form-control form-control-default fill" name="findtype">
		<option value="">Ngân Hàng</option>
		<?php foreach($arrname as $key => $_card){ ?>
		<option value="<?php echo $key; ?>" <?php if($_POST['findtype'] == $key): echo'selected'; endif; ?>><?php echo $_card[1]; ?></option>
		<?php } ?>
		</select>
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
	   <th>Ngân Hàng Nhận</th>
	   <th>Tên Người Gửi</th>
	   <th>Số Tài Khoản</th>
	   <th>Số Tiền</th>  
	   <th>Thực nhận</th>
	   <th>Trạng thái</th>
	   <th>Thời gian</th>
	   <th>Note</th>
	   <th></th>
   </tr>                         </thead>
                                                        <tbody>   

<?php
$id = (int)(!isset($_POST["findid"]) ? 0 : $_POST["findid"]);
$status = (!isset($_POST["findstatus"]) ? "" : db_escape(addslashes($_POST["findstatus"])));
$type = (!isset($_POST["findtype"]) ? "" : db_escape(addslashes($_POST["findtype"])));

$where = " email != '' ";

if($type && array_key_exists($type, $arrname)){
    $where .= " AND type = '".$arrname[$type][1]."' ";
}
if ($id) {
    $where .= " AND id = '$id' ";
} 
if ($status >= '0' && $status <= '3') {
    $where .= " AND status = '$status' ";
} 

$arrstatus = array("Chờ duyệt","Bị hủy","Thành công");

if(!$_POST){
$result = db_row("SELECT count(id) AS counter FROM history_bank_client WHERE status = '0'");
}else{
$result = db_row("SELECT count(id) AS counter FROM history_bank_client WHERE $where");
}
// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 20; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang

if ($result["counter"] == 0){
?>
<tr><td colspan="11" class="text-center">Không có giao dịch nào được tìm thấy</td></tr>
<?
}else{
// kết thúc phân trang

if(!$_POST){
$list_client = db_list("SELECT * FROM history_bank_client WHERE status = '0' ORDER BY time ASC LIMIT {$startpoint} , {$per_page}");
}else{
$list_client = db_list("SELECT * FROM history_bank_client where $where ORDER BY status ASC, time DESC LIMIT 40");
}
foreach ($list_client as $item) {
?>
                   
                                                               <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td><?php echo client($item["fid"])['name']; ?></td>
                                           
                                            <td><?php echo htmlentities($item["type"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["name_CTK"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["STK"], ENT_QUOTES, "UTF-8"); ?></td>

                                            <td><?php echo format_cash($item["amount"]); ?>đ</td>
                                             <td><?php echo format_cash($item["thucnhan"]); ?>đ</td>
                                             
                                            <td><span class="label <?php if($item['status'] ==0) {echo 'label-warning';}elseif($item['status'] == 1) {echo 'label-danger';}elseif($item['status'] == 2) {echo 'label-success';} ?>"><?php echo $arrstatus[$item['status']]; ?></span></td>
                                        
                                            
                                            <td><?php echo ($item["timechuyen"]); ?></td>
                                                        <td><?php echo ($item["note"]); ?></td>
                                            <td>
                                                <?php if($item["status"]==0): ?>
                                                <form action="" method="post">
                                                <button type="submit" class="btn btn-primary btn-xs" title="Duyệt" name="duyet" value="<?php echo $item["id"]; ?>">Duyệt</button>
                                                <button type="submit" class="btn btn-danger btn-xs" title="Hủy" name="huy" value ="<?php echo $item["id"]; ?>">Hủy</button>
                                                </form>
                                                <?php endif; ?>
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

                                    echo pagination_html($result['counter'],$per_page,$page,$url='/admin/nap_atm.php?page=');
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
