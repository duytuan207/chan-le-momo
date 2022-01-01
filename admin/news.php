<?php
include_once('header.php');
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)
    if(isset($_POST['edit'])){
        if(isset($_POST['done'])){   
            $info = info_news($_POST['done']);
            if($info){   
            //   db_update("news", array("title" => $_POST['title'], "img" => $_POST['img'], "note" => $_POST['note'], "noidung" => $_POST['noidung']), "id = '".$_POST['duyet']."'"); // cập nhật trạng thái   
               
                $now = getdate(); 
                //thêm vào data
                db_update("news", array("title" => $_POST['title'] ,"img" =>$_POST['img'] ,"note" => $_POST['note'],"noidung" => $_POST['noidung'],"day" => $now['mday'],"month" =>$now['mon'],"year"=>$now['year'],"time"> time() ), "id = '{$_POST['done']}'"); 
                $_SESSION['admin_message'] = 'Chỉnh sửa thành công';
                $_SESSION['success'] = 'ok';
                load_url(setting('domain')."/admin/news.php");
              }
         }
       $info = info_news($_POST['edit']);

?>

          
                                <div class="card">

                                          <div class="card-block">                                      

      
                    
                     <div class="col-md-12">    
                   <div class="card">
                       
                              <div class="header">
                                <h4 class="title">Sửa Bài: <?php echo $info['title']; ?> (<?php echo $info['id']; ?>)</h4>
                            </div>                     
                       
                 <div class="content">           
                       
                               <form action="" method="post">
                                            <div class="row">
                                              <div class="col-sm-12">
                                <label for="title">Title Bài Viết:</label>
                                <input type="text" class="form-control border-input" name="title" value="<?php echo $info["title"]; ?>">
                              </div></div>    
                              <div class="row">
                             <div class="col-sm-12">
                                <label for="img">Link Ảnh:</label>
                                <input type="text" class="form-control border-input" name="img" value="<?php echo $info["img"]; ?>">
                              </div></div>                     
                              

                                                 
                 <div class="row">  
                 <div class="col-sm-12">                            
                <label for="">Note :</label>
                <textarea id="note"class="form-control border-input" id="note" name="note" rows="5" cols="2000" name="noidung" placeholder="Nhập Nội dung ..."><?php echo $info["note"]; ?></textarea>
              </div>                                   
                    </div>                                        

                     
                                            
                     <div class="row">  
                     <div class="col-sm-12">                            
                    <label for="">Nội dung Bài Viết:</label>
                    <textarea id="tintuc"class="form-control border-input" id="noidung" name="noidung" rows="25" cols="5000" name="noidung" placeholder="Nhập Nội dung ..."><?php echo $info["noidung"]; ?></textarea>
                	<small id="fileHelp" class="form-text text-muted">Nội dung Thông báo.</small>
                        </div>                                        
                         </div>                                      
         
         
                     <div class="footer">
                               <hr>
                            <button type="submit" class="btn btn-primary btn-xs" title="Sửa Tin" name="done" value="<?php echo $_POST["edit"]; ?>">Sửa Tin</button>
                              </div>   
         
                                            
           </form>
                       
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



<?
}elseif(isset($_POST['xoa'])){

   $info =  db_row("SELECT * FROM news WHERE id = '".(int)$_POST['xoa']."' LIMIT 1");  
   
       db_query("DELETE FROM news WHERE id = '".$info['id']."'");

          load_url(setting('domain')."/admin/news.php");
 

}else{?>
<div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- wysiwyg-editor card start -->
                <div class="col-md-12"><div class="card"><div class="content">
                <a href="<?php echo setting('domain'); ?>/admin/add_news.php"><button type="button" class="btn btn-success btn-block">Đăng Bài</button></a>
                </div></div></div>


                    <div class="col-md-12">
                        <div class="card">
                                           <div class="card-header">
                                                        <h5>Danh sách bài viết</h5>
                                                    </div>
                                <div class="table-responsive"> <table class="table table-striped">
                                        <thead>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Ngày đăng</th>
                                        <th>Thao tác</th>
                                      </thead>
                                      <tbody>
<?php
// đếm tổng
$result = db_row("SELECT count(id) AS counter FROM news where id !='0' ");
// Phân trang ở đây
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 7; // Số phần tử hiển thị
$startpoint = ($page * $per_page) - $per_page;
// kết thúc phân trang
if ($result["counter"] == 0){
?>
<tr><td colspan="9" class="text-center">không có bài nào trong dữ liệu</td></tr>
<?
}else{
// kết thúc phân trang
$list_buy = db_list("SELECT * FROM news where id !='0' ORDER BY time DESC LIMIT {$startpoint} , {$per_page}");
foreach ($list_buy as $item) {
?>
                                          <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td><?php echo $item["title"]; ?></td>
                                            <td><?php echo time_to_str($item["time"]); ?></td>
                                            <td>
                                            <form action="" method="post">
                                            <button type="submit" class="btn btn-primary btn-xs" title="Duyệt" style="padding: 6px 12px;" name="edit" value="<?php echo $item["id"]; ?>"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i> Chỉnh Sửa</button>
                                                <button type="submit" class="btn btn-warning btn-xs" title="Hủy" style="padding: 6px 12px;" name="xoa" value ="<?php echo $item["id"]; ?>"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i> Xóa </button>
                                            </form>

                                          </tr>  

<?php 
}
}
?>                                         
                                      </tbody>
                                  </div></table>
                                    
                                    <div class="footer">
                                    <hr>
                                    <div class="stats">
                                    <?php
                                    echo pagination_html($result['counter'],$per_page,$page,$url='/admin/news.php?page=');
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
              



                                                <!-- wysiwyg-editor card end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                        </div>
                        
 <? }?>  
  <?php include_once('fooder.php'); ?>           
