<?
include_once('header.php');
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)
$today = date("Y-m-d");
   $arrcard = array( // giá trị, tên
    '1' => array("Mu AWAKEN","Mu AWAKEN","mua","mua-billing","com.vng.mrd.mua.item8","10000000"),
    '2' => array("Mu Strongest","Mu Strongest","mum","mum-billing","com.vng.mrd.mu.item8","5000000"),
    '4' => array("Tân Thiên long","Tân Thiên long","ttl3dm","ttl3dm-billing","com.cy.ttl3dmb.item10000","10000000"),
    '5' => array("Phong Thần","Phong Thần",'fs','fs-billing','1000','15000000'),
    '6' => array("Võ lâm CTC","Võ lâm CTC",'CTC','ctc','volamfree','volamctc'),
    '7' => array("Perfect World","Perfect World",'tghm','tghm-billing','com.vng.pwm.40000w','10000000'),
    '8' => array("Kiếm Thế PC",'Kiếm Thế PC','wjx','wjx-billing','kiemthe','kiemthe')
    );  
if(isset($_POST['duyet'])){
    if(isset($_POST['xacnhanduyet'])){
    $info =  db_row("SELECT * FROM debtcharges WHERE id = '".(int)$_POST['duyet']."' AND (status ='0' OR status ='3') LIMIT 1"); 
    if($info){
    // dòng này thêm lịch sử chính
        db_update("debtcharges", array( "status" => 2), "id = '".$_POST['duyet']."'"); // cập nhật trạng thái   

    }    
        load_url(setting('domain')."/admin/debtcharges.php");
    // end
    
    }
?>
                                <div class="card">

                                                                <div class="card-block">
                                                      <form action="" method="post">
                                                                    <h4 class="sub-title">Duyệt Cước nạp</h4>
                  
                                                                                
                                                                                
                                              <input type="hidden" name="duyet" value="<?php echo $_POST["duyet"]; ?>"/>    
                                    <button type="submit" class="btn btn-primary btn-xs" title="Xác nhận duyệt" name="xacnhanduyet" value="<?php echo $_POST["duyet"]; ?>">Xác nhận duyệt</button>
                                    </form>
                                                                            </div>
                                                                        </div>

<?
}elseif(isset($_POST['huy'])){
    if(isset($_POST['xacnhanhuy'])){ 
        $info =  db_row("SELECT * FROM debtcharges WHERE id = '".$_POST['huy']."' and (status ='0' OR status = '3') LIMIT 1"); 
    if($info){
        db_update("debtcharges", array("status" => 1), "id = '".$_POST['huy']."'"); // cập nhật trạng thái
        }else{
        }
        load_url(setting('domain')."/admin/debtcharges.php");
    }

?>
                                <div class="card">

                                                                <div class="card-block">
                                                      <form action="" method="post">
                                                                    <h4 class="sub-title">Hủy cước nạp</h4>
                                                                    <div class="form-group has-success row">
                                                 
                                              <input type="hidden" name="huy" value="<?php echo $_POST["huy"]; ?>"/>    
                                    <button type="submit" class="btn btn-primary btn-xs" title="Xác Nhận Hủy" name="xacnhanhuy" value="<?php echo $_POST["huy"]; ?>">Xác nhận Hủy</button>
                                    </form>
                                                                            </div>
                                                                        </div>

<?
}elseif(isset($_POST['add'])){
      if(isset($_POST['add_amount'])){ 
        $info =  db_row("SELECT * FROM debtcharges WHERE id = '".$_POST['add']."' and (status ='0' OR status = '3') LIMIT 1"); 
        if($info){
        db_update("debtcharges", array("danap" => $info['danap'] + $_POST['cash']), "id = '".$_POST['add']."'"); // cập nhật trạng thái
        $show = db_row("SELECT * FROM debtcharges WHERE id = '".$_POST['add']."' and status ='0' OR status = '3' LIMIT 1"); 
        if($show['danap'] >= $show['cash']){
            db_update("debtcharges", array("status" => 2), "id = '".$show['id']."'"); // cập nhật trạng thái
        }
        
        }
        load_url(setting('domain')."/admin/debtcharges.php");
      }
?>
 
                                 <div class="card">

                                                                <div class="card-block">
                                                      <form action="" method="post">
                                                                    <h4 class="sub-title">Cộng Tiền Đã nạp</h4>
                                                                    
                                                      <div class="form-group has-danger row">
                                                                                <div class="col-sm-2">
                                                                                    <label class="col-form-label" for="inputDanger1">Số Tiền:</label>
                                                                                    </div>
                                                                                    <div class="col-sm-10">
                                        <input style="max-width: 100%;" type="number" class="form-control border-input" name="cash" placeholder="Số tiền" >
                                                                                    </div>
                                                                                </div>            
                                                                    <div class="form-group has-success row">
                                              <input type="hidden" name="add" value="<?php echo $_POST["add"]; ?>"/>    
                                    <button type="submit" class="btn btn-primary btn-xs" title="Xác Nhận " name="add_amount" value="<?php echo $_POST["add"]; ?>">Xác nhận Thêm</button>
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
                                <h4 class="title">Danh sách nạp </h4>
                                            </div>
                                            <div class="card-block">

                                                <div class="dt-responsive table-responsive">
                                                    <div id="base-style_wrapper" class="dataTables_wrapper dt-bootstrap4">
													<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12">
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
  <input name="phone" type="text" class="form-control border-input" id="phone" value="<?php echo htmlspecialchars($_POST['phone']); ?>" placeholder="Tài khoản">
</div>

<div class="col-sm-12 col-xl-3 m-b-30">    
		<select class="form-control form-control-default fill" name="type" id="type">
		<option value="">Game</option>
		<?php foreach($arrcard as $key => $_card){ ?>
		<option value="<?php echo $_card[2]; ?>" <?php if($_POST['type'] == $_card[2]): echo'selected'; endif; ?>><?php echo $_card[1]; ?></option>
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
<a href="/admin/add_don.php"class="btn btn-success" style="padding: 6px 12px;">Thêm Đơn</a>

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
	   <th>Game</th>
	   <th>Username</th>
	   <th>Server</th>
	   <th>TNV</th>
	   <th>Số Tiền Nạp</th>
	   <th>Đã Nạp</th>
	   <th>Trạng thái</th>
	   <th>Thời gian</th>
	   <th></th>
   </tr>
                                      </thead>
                                                        <tbody>   

<?php
$id = (int)(!isset($_POST["findid"]) ? 0 : $_POST["findid"]);
$status = (!isset($_POST["findstatus"]) ? "" : db_escape(addslashes($_POST["findstatus"])));
$type = (!isset($_POST["type"]) ? "" : db_escape(addslashes($_POST["type"])));
$username = (!isset($_POST["phone"]) ? "" : db_escape(addslashes($_POST["phone"])));

$where = " id != '' ";

if ($id) {
    $where .= " AND id = '$id' ";
} 
if ($status >= '0' && $status <= '3') {
    $where .= " AND status = '$status' ";
} 

if ($phone) { 
    $where .= " AND username LIKE '%$phone%' ";
}



$arrstatus = array("Chờ Xử Lý...","Bị hủy","Thành công","Đang Nạp...");

if(!$_POST){
$result = db_row("SELECT count(id) AS counter FROM debtcharges WHERE (status = '0' OR status ='3') ");
}else{
$result = db_row("SELECT count(id) AS counter FROM debtcharges WHERE $where");
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
$list_client = db_list("SELECT * FROM debtcharges WHERE (status = '0' OR status = '3') ORDER BY time ASC LIMIT {$startpoint} , {$per_page}");
}else{
$list_client = db_list("SELECT * FROM debtcharges where $where ORDER BY status ASC, time DESC LIMIT 40");
}
foreach ($list_client as $item) {
?>
                                          <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td><?php echo htmlentities($item["type"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["username"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["server"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["roleName"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo format_cash($item["cash"]); ?>đ</td>
                                          <td><?php echo format_cash($item["danap"]); ?>đ</td>
                                            <td><span class="label <?php if($itezm['status'] ==0) {echo 'label-warning';}elseif($item['status'] == 1) {echo 'label-danger';}elseif($item['status'] == 2) {echo 'label-success';}else{
                                              echo 'label-success';  
                                            } ?>"><?php echo $arrstatus[$item['status']]; ?></span><? if($item['status'] == '1' || $item['status'] == '3' ){ $all = $item['danap']/$item['cash']*100; echo ' ('.format_cash($all).')%' ; }?></td>
                                            

                                            <td><?php echo time_to_str($item["time"]); ?></td>
                                         
                                            <td>
                                                <?php if($item["status"]==0 || $item["status"]==3): ?>
                                                <form action="" method="post">
                                                <button type="submit" class=" btn-primary btn-xss" title="Duyệt" name="duyet" style="padding: 6px 12px;" value="<?php echo $item["id"]; ?>">Nạp Xong</button>
                                                <button type="submit" class=" btn-danger btn-xs" title="Hủy" name="huy"  style="padding: 6px 12px;" value ="<?php echo $item["id"]; ?>">Hủy</button>
                                                <button type="submit" class="btn btn-primary btn-xs" title="Thêm" style="padding: 6px 12px;" name="add" value="<?php echo $item["id"]; ?>">Cộng Đã Nạp</button>
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
                                    echo pagination_get($result['counter'],$per_page,$page,$url='/admin/debtcharges.php?page=');
                                            }
                                    ?>

													</div>
                                                </div>
                                            </div>
                                        </div>

                            <?php
                                $delay = db_row("SELECT SUM(cash) AS total FROM debtcharges WHERE (status = '0' OR status ='3')");
                                $conlai = db_row("SELECT SUM(danap) AS total FROM debtcharges WHERE (status = '0' OR status ='3')");
                            ?>
                          <div class="card-header">
                                <h4 class="title">Thống kê chi tiết</h4>
                                <p>Tổng số tiền nạp: <b class="text-danger"><?php echo format_cash($delay['total']); ?><sup>đ</sup></b></p>
                                <p>Còn Lại: <b class="text-danger"><?php echo format_cash($delay['total']- $conlai['total']); ?><sup>đ</sup></b></p>

                        </div>



                </div>

            </div>
        </div>            
        
        </div>  
        </div>
                                                    </div>    </div>    

<?php
}
?>    









<?
include_once('fooder.php');

?>