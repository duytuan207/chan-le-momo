<?php
include_once('../header.php');
if(!$_POST){
if((int)$_GET['id'] && (int)$_GET['id'] > 0){
$id = $_GET['id'];
}else{
$id = $_POST['username'];  
}
$time = $_POST['time'];
}else{
  $id = $_POST['username'];  
  $time = $_POST['time'];

}
if (isset($id)) {

    $user = db_row("SELECT * FROM `client` WHERE id != '' AND id = '{$id}' OR username = '{$id}' LIMIT 1");
    if ($user == false) {
        $_SESSION['admin_message'] = 'Tài khoản không tồn tại ';
        header('Location: /admin/menber.php');
        exit;
    }

}
  
      $data = db_list("SELECT * FROM `log` where email = '{$user['email']}' ORDER BY `id` DESC LIMIT 50");


      if (isset($id) && empty($time)) {

    $data = db_list("SELECT * FROM `log` where email = '{$user['email']}' ORDER BY `id` DESC LIMIT 50");
	$tongtien = db_row("SELECT sum(amount) as total FROM log where email = '{$user['email']}' ");	
	$tongtiencard = db_row("SELECT SUM(cash_real) AS total FROM topup WHERE email = '{$user['email']}' AND status = '2'");
	$tongtienadmin = db_row("SELECT sum(amount) as total FROM log where email = '{$user['email']}' AND type = 'Cộng Tiền'");	
    $solanruttien = db_row("SELECT sum(amount) as total FROM history_bank where email = '{$user['email']}' AND status = '2' ");
     $nhantien = db_row("SELECT sum(cash) as total FROM transfers where den = '{$user['email']}' OR den ='{$user['username']}'  ");	

        $debtcharges =db_row("SELECT sum(cash_real) as total FROM debtcharges where email = '{$user['email']}' AND  status ='2' ")['total'];
        $history_bank =  db_row("SELECT sum(amount) as total FROM history_bank where email = '{$user['email']}' AND  status ='2' ")['total'];
        $history_card = db_row("SELECT sum(thucthu) as total FROM history_card where email = '{$user['email']}' AND  status ='2' ")['total'];
        $transfers = db_row("SELECT sum(cash) as total FROM transfers where email = '{$user['email']}'")['total'];  
     
    $sudung = $debtcharges +  $history_bank + $history_card + $transfers;
    
    
    $debtcharges1 =db_row("SELECT sum(id) as total FROM debtcharges where email = '{$user['email']}'  ")['total'];
    $history_bank1 =  db_row("SELECT count(id) as total FROM history_bank where email = '{$user['email']}'  ")['total'];
   $history_card1 = db_row("SELECT count(id) as total FROM history_card where email = '{$user['email']}' ")['total'];
   $transfers1 = db_row("SELECT count(id) as total FROM transfers where email = '{$user['email']}'")['total'];  
    $topup = db_row("SELECT count(id) as total FROM topup where email = '{$user['email']}'")['total']; 
    
    $all = $debtcharges1 + $history_bank1 + $history_card1 + $transfers1 + $topup;	
      }else if (isset($id) && isset($time)){
     $timexx  = explode("-",$time);
     
         $data = db_list("SELECT * FROM log where email = '{$user['email']}' AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'  ORDER BY `id` DESC LIMIT 50");
	$tongtien = db_row("SELECT sum(amount) as total FROM log where email = '{$user['email']}' AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'");	
	$tongtiencard = db_row("SELECT SUM(cash_real) AS total FROM topup WHERE email = '{$user['email']}' AND status = '2'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'");
	$tongtienadmin = db_row("SELECT sum(amount) as total FROM log where email = '{$user['email']}' AND type = 'Cộng Tiền'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'");	
    $solanruttien = db_row("SELECT sum(amount) as total FROM history_bank where email = '{$user['email']}' AND status = '2'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."' ");
     $nhantien = db_row("SELECT sum(cash) as total FROM transfers where den = '{$user['email']}' OR den ='{$user['username']}'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."' ");	

        $debtcharges =db_row("SELECT sum(cash_real) as total FROM debtcharges where email = '{$user['email']}' AND  status ='2'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'")['total'];
        $history_bank =  db_row("SELECT sum(amount) as total FROM history_bank where email = '{$user['email']}' AND  status ='2'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'")['total'];
        $history_card = db_row("SELECT sum(thucthu) as total FROM history_card where email = '{$user['email']}' AND  status ='2'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'")['total'];
        $transfers = db_row("SELECT sum(cash) as total FROM transfers where email = '{$user['email']}' AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'")['total'];  
     
    $sudung = $debtcharges +  $history_bank + $history_card + $transfers;
    
    
    $debtcharges1 =db_row("SELECT sum(id) as total FROM debtcharges where email = '{$user['email']}'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."' ")['total'];
    $history_bank1 =  db_row("SELECT count(id) as total FROM history_bank where email = '{$user['email']}'   AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'")['total'];
   $history_card1 = db_row("SELECT count(id) as total FROM history_card where email = '{$user['email']}'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'")['total'];
   $transfers1 = db_row("SELECT count(id) as total FROM transfers where email = '{$user['email']}'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'")['total'];  
    $topup = db_row("SELECT count(id) as total FROM topup where email = '{$user['email']}'  AND day ='".$timexx['2']."' AND month ='".$timexx['1']."' AND year ='".$timexx['0']."'")['total']; 
    
    $all = $debtcharges1 + $history_bank1 + $history_card1 + $transfers1 + $topup;	     
          
}


?>

<div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
       <div class="row">
                                            <div class="col-lg-12">                                                     <div class="card">
                
 <div class="card-header">
         <h2>Tìm Tất Cả Giao Dịch Của Tài Khoản</h2>
                                          
         
                <div class="box-content">

                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="text">Tên tài khoản:</label>
                            <input type="text" class="form-control" value="<?=$user['username']?>" name="username">
                        </div>
                        <div class="form-group">
                            <label for="text">Ngày giao dịch:</label>
                            <input type="date" class="form-control" value="<?=$time?>" name="time">
                        </div>
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        <a href="/admin/menber.php" class="btn btn-info"> Hủy bỏ
                        </a>

                    </form>
                    <?php if (isset($user)) {?>
                    <p class="text-center">Thống kê giao dịch của tài khoản : <strong><?=$user['username']?></strong> <?php if($time != ''){echo 'của ngày '.$time;}?></p>
                    <p class="text-center">Tổng số tiền cộng từ admin: <strong><?=number_format($tongtienadmin['total'])?>đ</strong>
                    || Tổng số tiền nhận từ card: <strong><?=number_format($tongtiencard['total'])?>đ</strong>
                    || Nhận tiền từ user: <strong><?=number_format($nhantien['total'])?>đ</strong> 
                    || Rút tiền: <strong><?=number_format($solanruttien['total'])?>đ</strong> 
                    || Tổng số tiền đã sử dụng: <strong><?=number_format($sudung)?>đ</strong>
                     || Tổng số Tiền Đã Giao Dịch: <strong><?=number_format($tongtien['total'])?>đ</strong>
                    || Tổng giao dịch <strong><?=$all?></strong></p>
                    <? }?>
            </div>
        </div> </div></div>
        
    
                             
        
        
                                                                               </div>                                     </div>                                     </div>      
                                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
       <div class="row">
                                            <div class="col-lg-12">                                                     <div class="card">
                
 <div class="card-header">
         <h2>Truy vấn lịch sử</h2>
                                          
         
            <div class="box-content">
                <table class="display nowrap table table-striped table-bordered">
                    <thead>
                        <tr>
						    <th>Nguồn</th>
							<th>Mô Tả</th>
                            <th>Trạng Thái</th>
                            <th>Ngày</th>
                            <th>Số tiền</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data as $item){ ?>
                        <tr>
                            <td><?php echo $item['type']; ?></td>
							<td><?php echo $item['mota'];?></td>
                            <td><?php echo $item['status']; ?></td>
                            <td><?php echo time_to_str($item['time']); ?></td>
                            <td><?php echo number_format($item['amount']); ?>đ</td>
                        </tr>
                        <?php }?>


                    </tbody>
                </table>
            </div>
        </div> </div></div>
        
    
                             
        
        
                                                                               </div>                                     </div>                                     </div>                                                                   </div> 
<?php include_once('../fooder.php'); ?>           
 