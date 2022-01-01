<?php include_once('header.php');

 $now = getdate();

 ?>
 
  <!-- [ breadcrumb ] end -->
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                        <div class="row">

                                            <!-- site Analytics card start -->
                                            <div class="col-lg-7 col-md-12">
                                                <div class="card">
    
           <table class="table table-striped">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th>TranId</th>
                      <th>Name</th>
                      <th>Amount</th>
                      <th >GAME</th>
                      <th >Amount_real</th>
                      <th>Nội dung</th>
                      <th >Trạng thái</th>
                      <th >Kết Quả</th>
                      <th ></th>
                    </tr>
                  </thead>
                  
                  
                  
                  <tbody id="result">
<?php


    $result = db_row("SELECT count(id) AS counter FROM momo_history_bank WHERE comment != 'Không có nội dung'");
     
    
    
    
    // Phân trang ở đây
    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
    if ($page <= 0) $page = 1;
    $per_page = 10; // Số phần tử hiển thị
    $startpoint = ($page * $per_page) - $per_page;
    // kết thúc phân trang
    


    $row = db_list("SELECT * FROM `momo_history_bank` WHERE comment != 'Không có nội dung' ORDER BY id  DESC LIMIT {$startpoint} , {$per_page}");
    $arrstatus = array("Chờ duyệt","Thành công","Bị hủy");
  $arrstatusx = array("Không XĐ","Xịt","Ăn");
    foreach ($row as $key => $val){
?>    
    
    <tr>
      <td><?=$val['id']?></td>
      <td><?=$val['tranId']?></td>  
      <td><?=$val['partnerName']?></td>  
      <td><?=$val['amount']?></td>  
      <td><?=$val['game']?></td>  
      <td><?=$val['real_amount']?></td>
      <td><?=$val['comment']?></td>  
      <td><span class="label <?php if($val['status'] ==0) {echo 'label-warning';}elseif($val['status'] == 2) {echo 'label-danger';}elseif($val['status'] == 1) {echo 'label-success';}else{echo 'label-danger';  } ?>"><?php echo $arrstatus[$val['status']]; ?></span></td>
       <td><span class="label <?php if($val['kq'] ==0) {echo 'label-warning';}elseif($val['kq'] == 1) {echo 'label-danger';}elseif($val['kq'] == 2) {echo 'label-success';}else{echo 'label-danger';  } ?>"><?php echo $arrstatusx[$val['kq']]; ?></span></td>
      <td><?=time_to_str($val['time'])?></td> 
    </tr>
    
    
<?php
}
?>    
    
                  </tbody>
                  
                  
                  
                </table>

		<div class="footer">
                                    <hr>      <?php
                                            if(!$_POST){
                                    echo pagination_get($result['counter'],$per_page,$page,$url='/?page=');
                                            }
                                    ?>

													</div>
													
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="col-lg-5 col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-yellow">    <?php echo format_cash(db_row("SELECT SUM(amount) AS counter FROM momo_history_bank WHERE  comment !='Không có nội dung' AND day ='".$now['mday']."' AND month ='".$now['mon']."' AND year ='".$now['year']."'")['counter']); ?>
   
                                            
                                 <sup>VNĐ</sup> </h4>
                                                                        <h6 class="text-muted m-b-0">Tổng tiền chơi hôm nay</h6>
                                                                   </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="feather icon-bar-chart-2 f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
 
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-green">+ <?php echo format_cash(db_row("SELECT count(id) AS counter FROM momo_history_bank WHERE comment !='Không có nội dung' AND day ='".$now['mday']."' AND month ='".$now['mon']."' AND year ='".$now['year']."'")['counter']); ?></h4>
                                                                        <h6 class="text-muted m-b-0">Giao Dịch</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="feather icon-user f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-red"><?php echo format_cash(db_row("SELECT SUM(amount_real) AS counter FROM momo_history_bank WHERE comment !='Không có nội dung' AND kq = '2' AND day ='".$now['mday']."' AND month ='".$now['mon']."' AND year ='".$now['year']."'")['counter']); ?>
                                        <sup>VNĐ</sup></h4>
                                                                        <h6 class="text-muted m-b-0">Số tiền thắng</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="feather icon-calendar f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                 <!--                   <div class="col-md-6">-->
                                 <!--                       <div class="card">-->
                                 <!--                           <div class="card-block">-->
                                 <!--                               <div class="row align-items-center">-->
                                 <!--                                   <div class="col-8">-->
                                 <!--                                       <h4 class="text-c-blue">    <?php echo format_cash(db_row("SELECT count(id) AS counter FROM  debtcharges  WHERE (status ='0' OR status = '3') LIMIT 1")['counter']); ?>-->
   
                                            
                                 <!--<sup>Đơn</sup> </h4>-->
                                 <!--                                       <h6 class="text-muted m-b-0">Nạp Game chờ xử lý</h6>-->
                                 <!--                                   </div>-->
                                 <!--                                   <div class="col-4 text-right">-->
                                 <!--                                       <i class="feather icon-thumbs-down f-28"></i>-->
                                 <!--                                   </div>-->
                                 <!--                               </div>-->
                                 <!--                           </div>-->
                                 <!--                       </div>-->

                                 <!--                   </div>-->
                                                                                                   <div class="col-md-6">
                                                    </div>  
                                                    
                                                </div>
                                            </div>
                                          
                                        </div>
                                        

                    <div class="row">
                                                                    <!-- site Analytics card start -->
                                            <div class="col-lg-4 col-md-12">
                                                <div class="card">
                            Danh Sách MOMO
           <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>user</th>
                      <th>status</th>
                      <th>Loại</th>
                      <th>Amount</th> 
                    </tr>
                  </thead>
                  
                  
                  
                  <tbody id="result">
<?php

    $row = db_list("SELECT * FROM `client_atm` WHERE (status = '1' OR status = '0')  ");
    foreach ($row as $key => $val){
?>    
    
    <tr>
      <td><?=$val['id']?></td>
      <td><?=$val['stk']?></td>  
      <td>Hoạt động</td>  
      <td>Chơi</td>  
      <td>0</td> 
    </tr>
    
    
<?php
}
?>    
    
                  </tbody>
                  
                  
                  
                </table>

													
                                                </div>
                                            </div>
                    </div>              
                                  
                                  
                                  
                                        
                                        <!-- [ page content ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>      
            
 <?php include_once('fooder.php'); ?>           