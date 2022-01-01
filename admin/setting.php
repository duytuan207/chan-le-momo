<?php
include_once('header.php');

defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)

if ($_POST) {
   foreach ($_POST as $key => $value) {
      db_update("setting", array("value" => $value), "`key` = '$key'");
   }
?>

<script type="text/javascript">
        $(document).ready(function(){
            $.notify({
              message: "Cập nhật thành công!"

            },{
                type: 'success',
                timer: 4000
            });

      });
</script>
<?php
   //load_url(setting('domain')."/admin/setting");
}
?>
<div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Basic Inputs Validation start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Thiết lập trang web</h5>
                                                    </div>
                                                    <div class="card-block">
                                                <form enctype="multipart/form-data" method="post"> 
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Tiêu đề trang web:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('title'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                                    <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Mô tả trang web:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="description" id="description" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('description'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                                                                                <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Từ khóa tìm kiếm:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="keywords" id="keywords" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('keywords'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                                                                                    <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">ên miền mặc định:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="domain" id="domain" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('domain'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                              <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Tên Miền Rút Gọn: (VD: BACCSM.VN)</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="domain2" id="domain2" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('domain2'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                             <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Ảnh mô tả</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="image" id="image" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('image'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                             <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Hotline liên hệ:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="hotline" id="hotline" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('hotline'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                             <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Email:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('email'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                             <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Địa Chỉ :</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="diachi" id="diachi" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('diachi'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                   <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Facebook quản lý:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('facebook'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div> <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">FanPage :</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="page" id="page" placeholder="Tiêu đề mặc định cho trang web" value="<?php echo setting('page'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                            
                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Chiết khấu các mệnh giá 10,20,30k :</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" class="form-control" name="chietkhau" id="chietkhau" placeholder="" value="<?php echo setting('chietkhau'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>                                
                             <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Chiết khấu các mệnh giá 500,1tr :</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" class="form-control" name="chietkhau2" id="chietkhau2" placeholder="" value="<?php echo setting('chietkhau2'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div> 
                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Bội cho phép nạp auto (VD : 10000):</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" class="form-control" name="boi" id="boi" placeholder="" value="<?php echo setting('boi'); ?>">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>                              
                                                            
                                                            
                                                            
                                                                                       <div class="row">  
                            <div class="col-sm-12">
                            <div class="form-group border-input">
                                    <label for="news">Thông báo:</label>
									<textarea placeholder="Có thể dùng thẻ HTML" class="form-control border-input" id="news" name="news" rows="4" cols="50"><?php echo setting('news'); ?></textarea>
                                </div>
                            </div>
                              
                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2"></label>
                                                                <div class="col-sm-10">
                                                                    <button type="submit" class="btn btn-primary m-b-0">Lưu Lại</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            <!-- Form components Validation card end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Page body end -->
                            </div>
                        </div>
                    </div>
<?php include_once('fooder.php'); ?>                       