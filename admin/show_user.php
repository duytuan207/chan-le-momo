<?
include_once('header.php');
       $id = $_GET['id'];
		if(empty($id)){
           $_SESSION['admin_message'] = "Username không tòn tại";
           header('location: /admin/menber.php');
           exit;				
		}
?>
<div class="pcoded-inner-content">
           <div class="main-body">
               <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                        <div class="row">
                                            <!-- site Analytics card start -->
                                            <div class="col-lg-12 col-md-12">
         <div class="card">
                 <div class="card-header">
                    <h5>Chi tiết tài khoản</h5>

                                                    </div>
          <div class="card-block">
              <form id="second" action="/admin/get/add_user.php" method="POST" novalidate="">
            <?php       
        $formData = array();
        if ($_GET['id']) {
            $formData = $dbh->query("SELECT * FROM `client` WHERE `id` = '{$id}'")->fetch(PDO::FETCH_ASSOC);
        }
        ?>
        <?php if ($formData !== false && $id): ?>
            <input type="hidden" name="id" value="<?php echo $id ?>" />
        <?php else: ?>
            <?php $formData = array() ?>
        <?php endif; ?>
		
		
    <div class="form-group">
      <label for="text">Số điện thoại:</label>
      <input type="text" class="form-control" value="<?php echo $formData['phone'] ?>" name="phone">
    </div>
	
     <div class="form-group">
      <label for="text">Tên tài khoản:</label>
      <input type="text" class="form-control" value="<?php echo $formData['username'] ?>" name="username" readonly>
    </div>
	
    <div class="form-group">
      <label for="pwd">Khóa tài khoản (0 là có 1 là không, 2 là cho phép sử dụng tiện ích):</label>
      <input type="number" class="form-control" name="khoa" value="<?php echo $formData['status'] ?>">
    </div>

    <div class="form-group">
      <label for="pwd">Email:</label>
      <input type="text" class="form-control" name="email" value="<?php echo $formData['email'] ?>">
    </div>

    <div class="form-group">
      <label for="pwd">Họ và tên:</label>
      <input type="text" class="form-control" name="name" value="<?php echo $formData['name'] ?>">
    </div>
       <div class="form-group">
                                                <label>Quyền</label>
<select class="form-control border-input" name="type">
				<option value="Đại Lý" <?php if($formData['type_menber'] == 'Đại L&yacute;'): echo'selected'; endif; ?>>Đại Lý</option>
	            <option value="Đại Lý C1" <?php if($formData['type_menber'] == 'Đại L&yacute; C1'): echo'selected'; endif; ?>>Đại Lý Cấp 1</option>
	           <option value="Đại Lý C2" <?php if($formData['type_menber'] == 'Đại L&yacute; C2'): echo'selected'; endif; ?>>Đại Lý Cấp 2</option>          
				<option value="menber" <?php if($formData['type_menber'] == 'menber'): echo'selected'; endif; ?>>MenBer</option>
				</select>
                                            </div>
    <div class="form-group">
      <label for="pwd">Tiền hiện có:</label>
      <input type="number" class="form-control" value="<?php echo $formData['cash'] ?>" readonly>
    </div>	
    <div class="form-group">
      <label for="pwd">Thêm tiền:</label>
      <input type="number" class="form-control" name="tien" value="<?php echo $formData['cash'] ?>">
    </div>	
   
<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
							  <a class="btn btn-info" href="/admin/menber.php"> Quay lại
									</a>
							</div>
                                                        </form>
                                                    </div>
                                                </div>                    
			
			</div><!--/row-->
				</div><!--/span-->
			
			</div><!--/row-->
					</div><!--/row-->
							</div><!--/row-->
							</div><!--/row-->
<?php include_once('fooder.php'); ?>           
