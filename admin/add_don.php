<?
include_once('header.php');
   $arrtype = array( // giá trị, tên
    '1' => array("Mu AWAKEN","Mu AWAKEN","mua","mua-billing","com.vng.mrd.mua.item8","10000000"),
    '2' => array("Mu Strongest","Mu Strongest","mum","mum-billing","com.vng.mrd.mu.item8","5000000"),
    '4' => array("Tân Thiên long","Tân Thiên long","ttl3dm","ttl3dm-billing","com.cy.ttl3dmb.item10000","10000000"),
    '5' => array("Phong Thần","Phong Thần",'fs','fs-billing','1000','15000000'),
    '6' => array("Võ lâm CTC","Võ lâm CTC",'CTC','ctc','volamfree','volamctc'),
    '7' => array("Perfect World","Perfect World",'tghm','tghm-billing','com.vng.pwm.40000w','10000000'),
    '8' => array("Kiếm Thế PC",'Kiếm Thế PC','wjx','wjx-billing','kiemthe','kiemthe')
    );  
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
              <form id="second"  novalidate="">

    <div class="form-group">
      <label for="pwd">Loại Game:</label>
                                <select class="form-control" id="topup_type" required>
                                    <option value="">Loại Game Cần Nạp</option>
<?php foreach($arrtype as $key => $type){ ?>
		<option  value="<?php echo $type[2].'|'.$type[3].'|'. $type[4].'|'.$type[5];?>"><? echo $type[1]; ?></option>
		<?php } ?></select>	
     </div> 	
	
	<div class="form-group" id="server" style="display:none">
      <label for="pwd">server:</label>
    <select class="form-control" id="sv" required>
        
     </select>	  <input type="hidden" id="token" value=""> <input type="hidden" id="cookie" value="">     <input type="hidden" id="user_id" value="">    
    </div>
	
    
    
    
    <div class="form-group">
      <label for="pwd">UserName:</label>
      <input type="text" class="form-control" id="username" value="">
    </div>

    <div class="form-group">
      <label for="pwd">Password</label>
      <input type="text" class="form-control" id="password" value="">
    </div>	
    <div class="form-group">
      <label for="pwd">Số Tiền nạp:</label>
      <input type="number" class="form-control" id="amount" value="">
    </div>
        <div class="form-group">
      <label for="pwd">Bội:</label>
      <input type="number" class="form-control" id="boi" value="">
    </div>
<div class="form-actions">
	<button type="button" class="btn btn-primary" id="submithihi" style="display:none"> Lưu thay đổi</button>
	<button type="button" class="btn btn-primary" id="submithihi1"  style="display:none" >Lưu thay đổi</button>
	 <div id="loading" style="display: none;"><img src="https://thuthe.com/img/loading.gif" />  Xin chờ...</div>
	 <a class="btn btn-info" href="/admin/debtcharges.php"> Quay lại
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

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery.js"></script>							
<script>
$("#submithihi").hide();    
$("#submithihi1").hide();  
$("#topup_type" && "#username" && "#password").change(function () {
    
    var type =  $("#topup_type").val();   
    var list = type.split("|");
if(list[0] == 'mua' || list[0] == 'mum' || list[0] == 'ttl3dm' || list[0] == 'fs' || list[0] == 'tghm'){
    
    
    var username = $("#username").val();  
    var password = $("#password").val();  
    
    $("#loading").show();
      $.ajax({
         url : "login_game.php?username="+username+"&password="+password+"&appID="+list[0]+"&mapID="+list[1]+"", 
         type : 'GET',
         dataType : 'json',
         success : function(n) {
          $("#sv").html("");    
        var list =   n.list;  
        if(n.msg == 'OKE'){
        $("#token").val(n.token);  
        $("#cookie").val(n.cookie);
        $("#user_id").val(n.id);
        for(var i=0;i< list.length ;i++){   
         $("#sv").append("<option value='"+list[i].serverID+"|"+list[i].roleID+"|"+list[i].roleName+"'>" + list[i].serverID + "|" + list[i].roleName +"</option>");   
        }   
        $("#submithihi").show(); 
        $("#server").show();
        $("#uid").show();
         }   else {
            alert(n.msg);
        }     
        $("#loading").hide();    
            
         }
          
          
      })
      
      
}        else {
    
    $("#submithihi1").show(); 
    
}
});


$("#submithihi").click(function () {
    
    
    var type =  $("#topup_type").val();   
    var username = $("#username").val();  
    var password = $("#password").val(); 
    var amount   = $("#amount").val();
    var cookie   = $("#cookie").val();
    var user_id  = $("#user_id").val();
    sv = $("#sv").val();
    var acc      = sv.split("|");

    
    
    var list = type.split("|");
    var token = $("#token").val();
    $("#loading").show(); 
    
    
      $.ajax({
         url : "login_game.php?username="+username+"&password="+password+"&amount="+amount+"&user_id="+user_id+"&appID="+list[0]+"&mapID="+list[1]+"&server="+acc[0]+"&name="+acc[2]+"&roleID="+acc[1]+"&token="+token+"&item="+list[2]+"&am="+list[3]+"&cookie="+cookie+"&type=add", 
         type : 'GET',
         dataType : 'json',
         success : function(n) {
             
           alert(n.msg);  
          $("#loading").hide();   
             
         } 
         
      })
    
    
})
$("#submithihi1").click(function () {
    
    
    var type =  $("#topup_type").val();   
    var username = $("#username").val();  
    var password = $("#password").val(); 
    var amount   = $("#amount").val();
    var cookie   = $("#cookie").val();
    
    var list = type.split("|");
    var token = $("#token").val();
    $("#loading").show(); 
    
    
      $.ajax({
         url : "login_game.php?username="+username+"&password="+password+"&amount="+amount+"&appID="+list[0]+"&mapID=&server=&name=&roleID=&token="+token+"&item="+list[2]+"&am="+list[3]+"&cookie="+cookie+"&type=add", 
         type : 'GET',
         dataType : 'json',
         success : function(n) {
             
           alert(n.msg);  
          $("#loading").hide();   
             
         } 
         
      })
    
    
})
</script>  
<?php include_once('fooder.php'); ?>           