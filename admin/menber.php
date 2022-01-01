<? include_once('header.php');?>
<div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Base Style table start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Danh Sách Thành Viên</h5>
                                            </div>
                                            <div class="card-block">
                                                <div class="dt-responsive table-responsive">
                                                    <div id="base-style_wrapper" class="dataTables_wrapper dt-bootstrap4">
													<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-7">
													<div id="base-style_filter" class="dataTables_filter">
<form role="search" method="POST">
  <div class="input-group">
      <input type="text" name="search" class="btn form-control waves-effect border-input" placeholder="Nhập tên hoặc email" id="text-search">
      
                      <button type="submit" class="btn btn-success btn-round waves-effect waves-light">Tìm kiếm</button>
                <a class="btn btn-danger waves-effect btn-round waves-effect waves-light" href="/Panel-Admin/menber"> Hủy bỏ
                </a>
    </div>
</form>
													</div></div></div><div class="row"><div class="col-xs-12 col-sm-12">
													<table id="base-style" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="base-style_info">
                                                        <thead>
                                                            <tr role="row">
															<th class="sorting" tabindex="0" aria-controls="base-style" rowspan="1" colspan="1" aria-label="Tên hiển thị: activate to sort column ascending" style="width: 196px;">Tên hiển thị</th>
															<th class="sorting" tabindex="0" aria-controls="base-style" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 196px;">Email</th>
															<th class="sorting" tabindex="0" aria-controls="base-style" rowspan="1" colspan="1" aria-label="Số Dư: activate to sort column ascending" style="width: 95px;">Số Dư</th>
															<th class="sorting" tabindex="0" aria-controls="base-style" rowspan="1" colspan="1" aria-label="Trực tuyến: activate to sort column ascending" style="width: 185px;">Trực tuyến</th>
																														<th class="sorting" tabindex="0" aria-controls="base-style" rowspan="1" colspan="1" aria-label="Trực tuyến: activate to sort column ascending" style="width: 185px;">Block</th>
															<th class="sorting" tabindex="0" aria-controls="base-style" rowspan="1" colspan="1" aria-label="Quyền: activate to sort column ascending" style="width: 157px;">Quyền</th>
															<th class="sorting" tabindex="0" aria-controls="base-style" rowspan="1" colspan="1" aria-label="Ngày tham gia: activate to sort column ascending" style="width: 157px;">Ngày tham gia</th>
															<th class="sorting" tabindex="0" aria-controls="base-style" rowspan="1" colspan="1" aria-label="Thao Tác: activate to sort column ascending" style="width: 157px;">Thao Tác</th>
															</tr>
                                                        </thead>
                                                        <tbody>   

 <?php
 $arrstatus = array("Không","Có","Không");
// đếm tổng
$selete = $_POST['search'];

if(!$_POST){
$result = db_row("SELECT count(id) AS counter FROM client ");
}else{
$result = db_row("SELECT count(id) AS counter FROM client WHERE email = '$selete' OR name LIKE '%$selete%'");
}

// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 15; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang
if ($result["counter"] == 0){
?>
<tr><td colspan="8" class="text-center">Không có thành viên nào trong dữ liệu</td></tr>
<?
}else{
// kết thúc phân trang

if (!$_POST) {
$list_client = db_list("SELECT * FROM client  ORDER BY create_time DESC LIMIT {$startpoint} , {$per_page}");

	
}else{
$list_client = db_list("SELECT * FROM client where email = '$selete' OR name LIKE '%$selete%' ORDER BY create_time DESC LIMIT {$startpoint} , {$per_page}");

}
foreach ($list_client as $item) {
    
?>                   <tr>
                                            <td class="center"><?php if (empty($item["email"])) { echo $item["name"]; } else { echo $item["name"]; } ?></td>
                                            <td><?php echo $item["email"]; ?></td>
                                            <td>
                                 <?php echo format_cash($item["cash"]); ?>
                                            <sup>VNĐ</sup></td>
                                            <td><?php echo time_ago('@'.$item["last_time"]); ?></td>
                                              <td><span class="label <?php if($item['status'] ==0) {echo 'label-success';}elseif($item['status'] == 1) {echo 'label-danger';}else{
                                              echo 'label-success';  
                                            } ?>"><?php echo $arrstatus[$item['status']]; ?></span></td>     
                                                             <td><?php echo $item["type_menber"]; ?></td>
                                            <td><?php echo time_to_str($item["create_time"]);?></td>
                                                                                                                            
                                            <td class="center">
                                                
                                                <a href="/admin/show_user.php?id=<?=$item["id"]?>" title="Chi Tiết"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>
                                                
                    <? if($item['status'] == '1'){}else{?>                            
                            <a onclick="xoa('<?php echo $item['id'] ?>');" title="Xỏa bỏ"
                                    href="#"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                            </td>
                     <?}?>                       
                                            
                                          </tr> 
										  <?php 
}
}
?>

										  </tbody>
                                                    </table></div></div>
										<div class="footer">
                                    <hr>      <?php
                                    echo pagination_get($result['counter'],$per_page,$page,$url='/admin/menber.php?page=');
                                    ?>

													</div>
                                                </div>
                                            </div>
                                        </div>
                                            </div>    </div>    </div>    </div>
                                                            <script>
                function xoa(id) {
                    if (confirm('Bạn có chắc chắn muốn block user này?')) {
                        location.href = '/admin/get/add_user.php?type=xoa&id=' + id;
                    }
                    return false;
                }
                </script>
                
     <?php include_once('fooder.php'); ?>           
            