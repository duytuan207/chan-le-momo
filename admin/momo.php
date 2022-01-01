<?
include_once('header.php');
if(isset($_POST) && $_POST != null){
    db_insert("client_atm",$_POST);
    header("location: /admin/");
}
print_r($_POST);
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
                    <h5>Thêm Tài Khoản MOMO</h5></div>
          <div class="card-block">
              <form method="POST" action="#">
 <input type="hidden" value="MOMO" name="type" />
    <div class="form-group">
      <label for="pwd">Loại:</label>
                                <select class="form-control" name="status" required>
                                    <option value="1">Chơi</option>
                                    <option value="0">Chuyển</option>
                                    </select>	
     </div> 	

    
    <div class="form-group">
      <label for="pwd">SĐT:</label>
      <input type="text" class="form-control" name="username" value="">
    </div>

    <div class="form-group">
      <label for="pwd">pHash</label>
      <input type="text" class="form-control" name="pHash" value="">
    </div>	
    <div class="form-group">
      <label for="pwd">cmdId:</label>
      <input type="text" class="form-control" name="cmdId" value="">
    </div>
    <div class="form-group">
      <label for="pwd">time:</label>
      <input type="text" class="form-control" name="time" value="">
    </div>
    <div class="form-group">
      <label for="pwd">checkSum:</label>
      <input type="text" class="form-control" name="checkSum" value="">
    </div>
    <div class="form-group">
      <label for="pwd">password:</label>
      <input type="password" class="form-control" name="password" value="">
    </div> 
    
<div class="form-actions">
	<button type="submit" class="btn btn-primary"> Lưu thay đổi</button>
	 <a class="btn btn-info" href="/admin/index.php"> Quay lại
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