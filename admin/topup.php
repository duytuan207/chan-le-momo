<?
include_once('header.php');
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)

$arrcard = array( // ck, tên
    '1' => array("80","Viettel"),
    '2' => array("80","Vinaphone"),
    '3' => array("80","Mobifone"),
    '4' => array("80","Vietnamobile"),
    '5' => array("80","Oncash"),
    '6' => array("80","VTC"),
    '7' => array("80","Megacard"),
    '8' => array("80","Gate"),
    '9' => array("80","Zing"),
    '10' => array("80","BIT")
    );
    
$arrcash = array( // giá trị, tên
    '1' => array("50000","50.000đ"),
    '2' => array("100000","100.000đ"),
    '3' => array("200000","200.000đ"),
    '4' => array("500000","500.000đ"),
    '5' => array("1000000","1.000.000đ")
    );
    
if(isset($_POST['duyet'])){
   if(isset($_POST['xacnhanduyet'])){
    $info =  db_row("SELECT * FROM topup WHERE id = '".(int)$_POST['duyet']."' AND status ='0' LIMIT 1"); 
    if($info){
    // dòng này thêm lịch sử chính
        $now = getdate();

        db_update("client", array("cash" => (client($info['fid'])["cash"] + (int)$_POST['cash_real'])), "email = '".$info['email']."'");
        
        $text ='Nạp tiền từ thẻ cào :'.$info['type'].' - Mã Thẻ : '.$info['code'].' - Serial :  '.$info['seri'].'';
        db_insert("log", array('email' => $info['email'], 'type' => 'Đổi thẻ cào','mota' => $text,'status' => 'Thành Công','amount' => $_POST['cash_real'] , 'time' => time())); // log
        db_update("topup", array("text" => $_POST['lydo'], "cash_real" => $_POST['cash_real'], "cash" => $_POST['cash'], "status" => 2), "id = '".$_POST['duyet']."'"); // cập nhật trạng thái   
        if($info['type_add'] == 'Nạp API'){
            $data = 'status=2&desc='.$_POST['lydo'].'&serial='.$info['seri'].'&pin='.$info['code'].'&card_type='.$info['type'].'&amount='.$_POST['cash'].'&real_amount='.$_POST['cash_real'].'&transaction_id='.$info['key_id'].'&api_key='.client($info['fid'])["APIkey"].'&api_secret='.client($info['fid'])["APIsecret"].'';
                $url = $info['url_callback'];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
                curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);          
        	$result = curl_exec($ch);
                curl_close($ch);  	         	
        }  

    }    
        load_url(setting('domain')."/admin/topup.php");
    // end
    
    }
    $info =  db_row("SELECT * FROM topup WHERE id = '".$_POST['duyet']."' LIMIT 1"); 

?>
                                <div class="card">

                                                                <div class="card-block">
                                                      <form action="" method="post">
                                                                    <h4 class="sub-title">Duyệt thẻ nạp</h4>
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
                                        <input style="max-width: 100%;" type="text" class="form-control border-input" name="cash_real" placeholder="Số tiền" value="<?php echo htmlentities($info["cash_real"], ENT_QUOTES, "UTF-8"); ?>">
                                                                                    </div>
                                                                                </div>
                                                                  
                                                                            <div class="form-group has-danger row">
                                                                                <div class="col-sm-2">
                                                                                    <label class="col-form-label" for="inputDanger1">Mệnh giá thẻ:</label>
                                                                                    </div>
                                                                                    <div class="col-sm-10">
                                        <input style="max-width: 100%;" type="text" class="form-control border-input" name="cash" placeholder="Số tiền" value="<?php echo htmlentities($info["cash"], ENT_QUOTES, "UTF-8"); ?>">
                                                                     
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                              <input type="hidden" name="duyet" value="<?php echo $_POST["duyet"]; ?>"/>    
                                    <button type="submit" class="btn btn-primary btn-xs" title="Xác nhận duyệt" name="xacnhanduyet" value="<?php echo $_POST["duyet"]; ?>">Xác nhận duyệt</button>
                                    </form>
                                                                            </div>
                                                                        </div>

<?
}elseif(isset($_POST['huy'])){
if(isset($_POST['xacnhanhuy'])){ 
        $info =  db_row("SELECT * FROM topup WHERE id = '".$_POST['huy']."' and status ='0' LIMIT 1"); 
        if($info){
        $text ='Hủy thẻ: '.$info['type'].' - '.$info['cash'].' - Serial: '.$info['seri'].' - Pin: '.$info['code'].' - Thực nhận: '.$info['cash_real'].'	 ';
        db_insert("log", array('email' => $info['email'], 'type' => 'Đổi thẻ cào', 'mota' => $text,'status' => 'Thất Bại','amount' => 0,'time' => time())); // log
        db_update("topup", array("text" => $_POST['lydo'], "status" => 1), "id = '".$_POST['huy']."'"); // cập nhật trạng thái
                if($info['type_add'] == 'Nạp API'){
                $dataPost = 'status=1&desc='.$_POST['lydo'].'&serial='.$info['seri'].'&pin='.$info['code'].'&card_type='.$info['type'].'&amount=0&real_amount=0&transaction_id='.$info['key_id'].'&api_key='.client($info['fid'])["APIkey"].'&api_secret='.client($info['fid'])["APIsecret"].' ';
                $url  = $info['url_callback'];
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        		$result = curl_exec($ch);
	         	curl_close($ch);
                }	
            }
      
        load_url(setting('domain')."/admin/topup.php");
}

?>
                                <div class="card">

                                                                <div class="card-block">
                                                      <form action="" method="post">
                                                                    <h4 class="sub-title">Hủy Thẻ Nạp</h4>
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
                                <h4 class="title">Danh sách nạp thẻ</h4>
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
  <input name="findcode" type="text" class="form-control border-input" id="findcode" value="<?php echo htmlspecialchars($_POST['findcode']); ?>" placeholder="Mã thẻ">
</div>
<div class="col-sm-12 col-xl-3 m-b-30">
  <input name="findseri" type="text" class="form-control border-input" id="findseri" value="<?php echo htmlspecialchars($_POST['findseri']); ?>" placeholder="Serial">
</div>
<div class="col-sm-12 col-xl-3 m-b-30">
  <input name="phone" type="text" class="form-control border-input" id="phone" value="<?php echo htmlspecialchars($_POST['phone']); ?>" placeholder="Số điện thoại nhận">
</div>
<div class="col-sm-12 col-xl-3 m-b-30">    
		<select class="form-control form-control-default fill" name="findtype" id="findtype">
		<option value="">Loại Thẻ</option>
		<?php foreach($arrcard as $key => $_card){ ?>
		<option value="<?php echo $key; ?>" <?php if($_POST['findtype'] == $key): echo'selected'; endif; ?>><?php echo $_card[1]; ?></option>
		<?php } ?>
		</select>
</div>
<div class="col-sm-12 col-xl-3 m-b-30">    
		<select class="form-control form-control-default fill" name="findstatus">
		<option value="">Trạng thái</option>
		<option value="1" <?php if($_POST['findstatus'] == '1'): echo'selected'; endif; ?>>Bị hủy</option>
		<option value="0" <?php if($_POST['findstatus'] == '0'): echo'selected'; endif; ?>>Đang chờ</option>
		<option value="3" <?php if($_POST['findstatus'] == '3'): echo'selected'; endif; ?>>Sai MG</option>
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
	   <th>Loại Thẻ</th>
	   <th>Mã Thẻ</th>
	   <th>Serial</th>	   
	   <th>Thực nhận</th>
	   <th>Mệnh Giá</th>
	   <th>Nạp Vào</th>
	   <th>Trạng thái</th>
	   <th>Thông tin</th>
	   <th>Thời gian</th>
	   <th></th>
   </tr>
                                      </thead>
                                                        <tbody>   

<?php
$id = (int)(!isset($_POST["findid"]) ? 0 : $_POST["findid"]);
$seri = (!isset($_POST["findseri"]) ? "" : db_escape(addslashes($_POST["findseri"])));
$code = (!isset($_POST["findcode"]) ? "" : db_escape(addslashes($_POST["findcode"])));
$status = (!isset($_POST["findstatus"]) ? "" : db_escape(addslashes($_POST["findstatus"])));
$type = (!isset($_POST["findtype"]) ? "" : db_escape(addslashes($_POST["findtype"])));
$phone = (!isset($_POST["phone"]) ? "" : db_escape(addslashes($_POST["phone"])));
$where = " email != '' ";

if($type && array_key_exists($type, $arrcard)){
    $where .= " AND type = '".$arrcard[$type][1]."' ";
}
if ($id) {
    $where .= " AND id = '$id' ";
} 
if ($status >= '0' && $status <= '3') {
    $where .= " AND status = '$status' ";
} 

if ($seri) { 
    $where .= " AND seri LIKE '%$seri%' ";
}
if ($phone) { 
    $where .= " AND phone_add LIKE '%$phone%' ";
}
if ($code) {
    $where .= " AND code LIKE '%$code%' ";
}

$arrstatus = array("Chờ duyệt","Bị hủy","Thành công","Sai MG");

if(!$_POST){
$result = db_row("SELECT count(id) AS counter FROM topup WHERE status = '0'");
}else{
$result = db_row("SELECT count(id) AS counter FROM topup WHERE $where");
}
// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 10; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang

if ($result["counter"] == 0){
?>
<tr><td colspan="11" class="text-center">Không có giao dịch nào được tìm thấy</td></tr>
<?
}else{
// kết thúc phân trang

if(!$_POST){
$list_client = db_list("SELECT * FROM topup WHERE status = '0' ORDER BY time ASC LIMIT {$startpoint} , {$per_page}");
}else{
$list_client = db_list("SELECT * FROM topup where $where ORDER BY status ASC, time DESC LIMIT 40");
}
foreach ($list_client as $item) {
?>            
                                          <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td><?php echo client($item["fid"])['name']; ?></td>
                                           
                                            <td><?php echo htmlentities($item["type"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["code"], ENT_QUOTES, "UTF-8"); ?></td>
                                            <td><?php echo htmlentities($item["seri"], ENT_QUOTES, "UTF-8"); ?></td>
                                             <td><?php echo format_cash($item["cash_real"]); ?>đ</td>
                                            
                                            <td><?php echo format_cash($item["cash"]); ?>đ</td>
                                            
                                            <td><?php echo ($item["phone_add"]); ?></td>                                    
                                            <td><span class="label <?php if($item['status'] ==0) {echo 'label-warning';}elseif($item['status'] == 1) {echo 'label-danger';}elseif($item['status'] == 2) {echo 'label-success';}else{echo 'label-danger';  } ?>"><?php echo $arrstatus[$item['status']]; ?></span></td>
                                            
                                            <td><?php echo $item["text"]; ?></td>
                                            
                                            <td><?php echo time_to_str($item["time"]); ?></td>
                                         
                                            <td>
                                                <?php if($item["status"]==0): ?>
                                                <form action="" method="post">
                                                <button type="submit" class="btn btn-primary btn-xs" title="Duyệt" style="padding: 6px 12px;" name="duyet" value="<?php echo $item["id"]; ?>">Duyệt</button>
                                                <button type="submit" class="btn btn-danger btn-xs" title="Hủy" style="padding: 6px 12px;" name="huy" value ="<?php echo $item["id"]; ?>">Hủy</button>
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
                                    echo pagination_get($result['counter'],$per_page,$page,$url='/admin/topup.php?page=');
                                            }
                                    ?>

													</div>
                                                </div>
                                            </div>
                                        </div>

 <?php
    $delay = db_row("SELECT SUM(cash_real) AS total FROM topup WHERE status = '0'");
?>
                          <div class="card-header">
                                <h4 class="title">Thống kê chi tiết</h4>
                                                                <p>Tổng giá trị đơn hàng: <b class="text-danger"><?php echo format_cash($delay['total']); ?><sup>đ</sup></b></p>

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


 <?php include_once('fooder.php'); ?>           



