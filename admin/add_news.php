<?php
include_once('header.php');

defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)

if ($_POST) {
    $now = getdate(); 
    $_POST["time"] = time();
    $_POST["day"] = $now['mday'];
    $_POST["month"] = $now['mon'];
    $_POST["year"] = $now['year'];

    //thêm vào data
   db_insert("news", $_POST);
   $id_insert = db_insert_id();

   load_url(setting('domain')."/admin/news.php");
}
?>
                                <div class="card">

                                                                <div class="card-block">         

                <div class="row">
                    
                     <div class="col-md-12">    
                   <div class="card">
                       
                              <div class="header">
                                <h4 class="title">Tin Tức</h4>
                            </div>                     
                       
                 <div class="content">           
                       
                                        <form id="form_create" action="?" enctype="multipart/form-data" method="post">
                                            <div class="row">
                                              <div class="col-sm-12">
                              <div class="form-group">
                                <label for="title">Title Bài Viết:</label>
                                <input type="text" class="form-control border-input" name="title" >
                              </div></div>    
                               </div> 
                              <div class="row">
                             <div class="col-sm-12">
                              <div class="form-group">
                                <label for="img">Link Ảnh:</label>
                                <input type="text" class="form-control border-input" name="img" >
                              </div></div>                     
                              
                     </div> 
                     
                                                 
     <div class="row">  
     <div class="col-sm-12">                            
     <div class="form-group">
    <label for="">Note :</label>
    <textarea id="note"class="form-control border-input" id="note" name="note" rows="5" cols="2000" name="noidung" placeholder="Nhập Nội dung ..."></textarea>
  </div>                                   
        </div>                                        
         </div>                     
                     
                     
                                            
     <div class="row">  
     <div class="col-sm-12">                            
     <div class="form-group">
    <label for="">Nội dung Bài Viết:</label>
    <textarea id="tintuc"class="form-control border-input" id="noidung" name="noidung" rows="25" cols="5000" name="noidung" placeholder="Nhập Nội dung ..."></textarea>
	<small id="fileHelp" class="form-text text-muted">Nội dung Thông báo.</small>
  </div>                                   
        </div>                                        
         </div>                                      
         
         
                                                                      <div class="footer">
                                                                <hr><center>
                              <button type="submit" class="btn btn-default">Đăng Tin</button></center>

                                                            </div>   
         
                                            
           </form>
                       
                   </div>    
           
                       
                       </div>    
    
      </div>      
    </div>
       </div>
    </div>
       </div>
       
<script type="text/javascript" src="/admin/files/ckeditor/ckeditor.js"></script>
<script>
config = {};
config.entities_latin = false ;
config.language= 'vi';

    CKEDITOR.replace('note');
    CKEDITOR.replace('tintuc');
</script>
  <?php include_once('fooder.php'); ?>           
