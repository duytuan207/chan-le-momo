<?
include_once('header.php');
defined("BAC_CSM") or die ("Code này của Bắc viết nha :v"); // không xóa hoặc sửa dòng này :)
require_once("../CSM/PHPExcel.php"); 
if(isset($_POST['upload'])){
        $file = $_FILES['file']['tmp_name'];
	    $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
        $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
            
              if ($duoi === 'xlsx' || $duoi === 'xls' ) {  

	    
        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        $objReader->setLoadSheetsOnly('data');  

    
        $objExcel = $objReader->load($file);
    	$sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
        $all = $highestRow - 1;
        $err =  "Tổng Số Đơn: $all <br/>";
     for($row = 2; $row<=$highestRow; $row++){	
         sleep(2);
        $type_phone = $sheetData[$row]['A'];        
        $phone = $sheetData[$row]['B'];        
		$amount = $sheetData[$row]['C'];
		$type = $sheetData[$row]['D'];
		$pass = $sheetData[$row]['E'];
        $array_type = array( // giá trị, tên
                '1' => array("Trả Trước","Trả Trước"),
                '2' => array("Trả Sau","Trả Sau"),
                '3' => array("FTTH","FTTH")
        );
		
		
		if ($array_type[$type_phone][0] != '') {		
		            $row1 = db_row("SELECT * FROM list_cuoc WHERE type = '{$type}' LIMIT 1");   

	   if(empty($type_phone) ||empty($phone)||empty($amount) ||empty($type))
		{
          $err =  "Vui lòng điền đầy đủ thông tin";

		}else if ($amount < 50000) {
        $err =  "Số Tiền Nạp Phải Lớn Hơn 50.000 VNĐ ($phone)<br/> ";
        }elseif(($amount%1000 != 0)){
                $err =   "Mệnh giá không đúng ($phone) <br/>";
        }elseif ($row1 == null) {
             $err =  "Nhà Mạng không tồn tại ($phone) <br/>";
        }else{
             
           if($pass == null || $pass == '' || $pass == 'null'){
              $hi = 'KO'; 
           }else{
              $hi = $pass; 
           }  
		if(client()['type_menber'] =='Đại L&yacute;')  {
		    	  $ck = $row1['chietkhau_ctv'];
		}elseif(client()['type_menber'] =='Đại L&yacute; C1'){
		    $ck = $row1['chietkhau_ctv_c1'];
		}elseif(client()['type_menber'] =='Đại L&yacute; C2'){
		    $ck = $row1['chietkhau_ctv_c2'];
		}else{
		    $ck = $row1['chietkhau'];
		}
		  

    	  $now = getdate();
          $chietkhau = ($amount/ 100) * $ck ; // $ck =  chiết khấu 
          $thucthu = $amount - $chietkhau;	

            $data = array("fid" =>client()['fid'] ,"key_id" =>key_id() ,'email' => client()['email'], 'name' => client()['name'],'cash' => $amount,'cash_real' => $thucthu, 'type' => $row1['type'] ,'type_phone' => $array_type[$type_phone][0] , 'phone' => $phone ,"pass" => $hi,'status' => 0,'day' => $now['mday'], 'month' => $now['mon'], 'year' => $now['year'], 'time' => time(),'ip' => get_ip());
          db_insert("debtcharges",$data); 
				  $err =  "Thành công<br/> "; 


		}		
		    
        }else{
            $err = 'Type phone sai';
        }

        }      

              }else{
                  		$err =  "Định dạng Files không phù hợp! <br/> ";

              } 

}

?>
<div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Base Style table start -->
                                        <div class="card">
                                                                                   <div class="card-header">Thêm đơn cước</h4>
                                            </div>     
                               <div class="card-block">
                                   
                                   
                                          <div class="row">
                    	<div class="col-md-12 col-sm-12">
            <form method="POST" action="#" enctype="multipart/form-data">
            <h2 class="form-signin-heading"><a href="/sodienthoai.xls">File Mẫu</a></h2>
            <div class="form-group">
            <label for="InputFile">File </label>
            <input type="file" id="file" name="file" id="sortpic">
            </div>
        <button class="btn btn-lg btn-primary btn-block" name="upload" type="submit">Thêm</button>
       <? if(isset($err)){
       ?> <div class="alert alert-success cms" style="display: block;" role="alert"><? echo $err;?></div> <? 
       }?> 

 </form>        	                         
     
     </br>        		          
		     
    </div> 
</div>  
                                   
                                   
                                                   
                </div>            
                                            
                        </div>
                                  </div>
                                           </div>
                                                    </div>
                                                             </div>
                                                             
                                                             
                                                             
<?
include_once('fooder.php');

?>