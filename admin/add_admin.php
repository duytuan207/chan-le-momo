<?
include_once('header.php');

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
                    <h5>Thêm Tài Khoản ADMIN</h5>

                                                    </div>
          <div class="card-block">
              <form id="second" action="/admin/get/add_admin.php" method="POST" novalidate="">
                <?php       
         $id = $_POST['id'];
        $formData = array();
        if ($_POST['id']) {

            $formData = db_row("SELECT * FROM `csm_admin` WHERE `id` = '{$id}'");
        }
        ?>
        <?php if ($formData !== false && $id): ?>
            <input type="hidden" name="id" value="<?php echo $id ?>" />
        <?php else: ?>
            <?php $formData = array() ?>
        <?php endif; ?>
		
		
    <div class="form-group">
      <label for="text">Tên đăng nhập:</label>
      <input type="text" class="form-control" value="<?php echo $formData['username'] ?>" name="username">
    </div>
	
    <div class="form-group">
      <label for="pwd">Mật khẩu:</label>
      <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
      <label for="pwd">Nhập lại mật khẩu:</label>
      <input type="password" class="form-control" name="cpassword">
    </div>
        <div class="form-group">
                  <label for="pwd">Trạng Thái</label>

               <select name="select" class="form-control form-control-warning fill">
                                          <option value="0" <? if($formData['status'] == '0'){ echo 'selected';}?>>Hoạt Động</option>
                                          <option value="1" <? if($formData['status'] == '1'){ echo 'selected';}?>>Block</option>
                                                                   
                                                                </select>
	      </div>       
<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
							  <a class="btn btn-info" href="/admin/admin.php"> Quay lại
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

