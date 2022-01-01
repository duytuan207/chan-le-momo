<?
include_once('../header.php');
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)
require('check.php');

$id =  (int)GET("id");
$type = $_GET['type'];
if($type =='list_ckcard'){
         $info = info_network($id);

}elseif($type =='type_card'){
          $info = info_type($id);

}elseif($type =='list_cuoc'){
          $info = info_cuoc($id);

}elseif($type =='list_bantien'){
          $info = info_bantien($id);

}else{
 	   load_url(setting('domain')."/admin/add_nhamang.php");

}

if(isset($_POST['id'])){
    
    
 if($type == 'list_cuoc' || $type == 'list_bantien'){
       	 	db_update("$type",array("type" => $_POST['type'],"chietkhau" => $_POST['chietkhau'],"chietkhau_ctv" => $_POST['chietkhau_ctv'],"chietkhau_ctv_c1" => $_POST['chietkhau_ctv_c1'], "chietkhau_ctv_c2" => $_POST['chietkhau_ctv_c2'],"status" => $_POST['status']),"id = '$id'");
  
 }else{
        $chietkhau_min = $_POST['chietkhau_min'];
    	 db_update("$type",array("type" => $_POST['type'],"chietkhau" => $_POST['chietkhau'], "chietkhau_min" => $chietkhau_min,"status" => $_POST['status']),"id = '$id'");
    	  	
 }	  	
 	   load_url(setting('domain')."/admin/add_nhamang.php");
    	  	
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
                    <h5>Chỉnh Sửa Thẻ <?=$info['type']?></h5>

                                                    </div>
          <div class="card-block">
              <form id="second" action="#" method="POST" novalidate="">
                              <input type="hidden" name="id" value="<?php echo $id ?>" />

        <div class="form-group">
          <label for="text">Loại Thẻ:</label>
          <input type="type" class="form-control" value="<?php echo $info['type'] ?>" name="type">
        </div>
    	
        <div class="form-group">
          <label for="chietkhau">Chiếu Khấu:</label>
          <input type="number" class="form-control" name="chietkhau" value="<?php echo $info['chietkhau'] ?>">
        </div>
        <div class="form-group">
          <label for="chietkhau">Chiếu Khấu Min:</label>
          <input type="number" class="form-control" name="chietkhau_min" value="<?php echo $info['chietkhau_min'] ?>">
        </div>

            <div class="form-group">
                      <label for="pwd">Trạng Thái</label>
    
                   <select name="status" class="form-control form-control-warning fill">
                                              <option value="yes" <? if($formData['status'] == 'yes'){ echo 'selected';}?>>Hoạt Động</option>
                                              <option value="no" <? if($formData['status'] == 'no'){ echo 'selected';}?>>Khóa</option>
                                                                       
                                                                    </select>
    	      </div>       
    <div class="form-actions">
    							  <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    							  <a class="btn btn-info" href="/admin/add_nhamang.php"> Quay lại
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
<?
include_once('../fooder.php');

?>
