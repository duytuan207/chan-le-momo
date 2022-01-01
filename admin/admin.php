<?
include_once('header.php');

?>
<div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Base Style table start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Quản Lý ADMIN</h5>
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
                <a class="btn btn-danger waves-effect btn-round waves-effect waves-light" href="/admin/admin"> Hủy bỏ
                </a>
                  <a href="/admin/add_admin.php" class="btn btn-success btn-round waves-effect waves-light">Thêm tài khoản</a>
    </div>
</form>
													</div></div></div><div class="row"><div class="col-xs-12 col-sm-12">
													<table id="base-style" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="base-style_info">
                                                        <thead>
						<tr>
                        <th>ID</th>
                        <th>Tên đăng nhập</th>
                         <th>Trạng Thái</th>
                        <th>Thao tác</th>	
                    </tr>
                                                        </thead>
                                                        <tbody>   

 <?php
 $arrstatus = array("Không","Có");
// đếm tổng
$selete = $_POST['search'];

if(!$_POST){
$result = db_row("SELECT count(id) AS counter FROM csm_admin ");
}else{
$result = db_row("SELECT count(id) AS counter FROM csm_admin WHERE username = '$selete' OR name LIKE '%$selete%'");
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
$list_client = db_list("SELECT * FROM csm_admin  ORDER BY id DESC LIMIT {$startpoint} , {$per_page}");

	
}else{
$list_client = db_list("SELECT * FROM csm_admin where username = '$selete' OR name LIKE '%$selete%' ORDER BY id DESC LIMIT {$startpoint} , {$per_page}");

}
foreach ($list_client as $item) {
?>            							<tr>
							 <td class="itemId"><?php echo $item['id'] ?></td>
                            <td><?php echo $item['username'] ?></td>
                            
                                                                     <td><span class="label <?php if($item['status'] ==0) {echo 'label-success';}elseif($item['status'] == 1) {echo 'label-danger';}else{
                                              echo 'label-success';  
                                            } ?>"><?php echo $arrstatus[$item['status']]; ?></span>
                                            </td>   

								<td class="center">
              <form action="/admin/add_admin.php" method="POST" novalidate="">
              <input type="hidden" name="id" value="<?php echo $item['id']; ?>" /><button type="submit" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"  title="Chỉnh Sửa"></button>
        	            </form>	                                        
                             <? if($item['status'] == '1'){}else{?>                            
			  <form action="/admin/get/add_admin.php" method="POST" novalidate="">
              <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
              <input type="hidden" name="xoa" value="Block" />
              <button type="submit" class="feather icon-trash-2 f-w-600 f-16 text-c-red"  title="Block"></button>
        	            </form>	    			       
							       
							     <?}?>         
							       
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
                                    echo pagination_get($result['counter'],$per_page,$page,$url='/admin/admin.php?page=');
                                    ?>

													</div>
                                                </div>
                                            </div>
                                        </div>
                                            </div>    </div>    </div>    </div>
              <script>
               
		 function xoa(id) {
            if (confirm('Bạn chắc chắn muốn xóa admin này?')) {
                location.href = '/admin/get/add_admin.php?xoa=xoa&id=' + id;
            }
            return false;
        }	
                </script>
<?php include_once('fooder.php'); ?>           
                