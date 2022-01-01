<?
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
include_once($_SERVER['DOCUMENT_ROOT'] . '/CSM/function.php');// function gọi là chức năng nhé 
include_once("fucntion.php"); // lấy function login
$username = db_escape(addslashes(htmlentities($_GET['username'])));
$password = db_escape(addslashes(htmlentities($_GET['password'])));
$mapID    = db_escape(addslashes(htmlentities($_GET['mapID'])));
$appID    = db_escape(addslashes(htmlentities($_GET['appID'])));
$user_id    = db_escape(addslashes(htmlentities($_GET['user_id'])));

$boi    = db_escape(addslashes(htmlentities($_GET['boi'])));


if($_GET['type'] == 'add'){
    $roleID     = $_GET['roleID'];
    $roleName   =  $_GET['name'];
    $server      = $_GET['server'];
if($appID == 'mum' || $appID == 'mua' || $appID == 'ttl3dm' || $appID == 'tghm'){
    
   if($server != ''){
   $data = array("key_id" =>key_id(),'cash' => $_GET['amount'],"danap" => 0, 'type' => $appID , 'username' => $username, 'boi' => $boi,'pass' => $password ,'user_id' => $user_id,'server' => $server,'item' => $_GET['item'],'vng' => $_GET['am'],'cookie' => $_GET['cookie'],'jtoken' => $_GET['token'],'roleID' => $roleID,'roleName' => $roleName,'status' => 0,"note" => '','day' => $now['mday'], 'month' => $now['mon'], 'year' => $now['year'], 'time' => time(),'ip' => get_ip());
   db_insert("debtcharges",$data); 
    echo json_encode(array('status' => 0, 'msg' => "Nạp tiền thành công, chúng tôi sẻ xem xét và xử lý đơn hàng của bạn !"));
   }else{
      echo json_encode(array("msg" => "Vui lòng nhập đủ các trường","status" => 1));   
   }
    
    
    
} else {
   $data = array("key_id" =>key_id(),'cash' => $_GET['amount'],"danap" => 0, 'type' => $appID , 'username' => $username, 'boi' => $boi, 'pass' => $password ,'item' => $_GET['item'],'vng' => $_GET['am'],'cookie' => $_GET['cookie'],'status' => 0,"note" => '','day' => $now['mday'], 'month' => $now['mon'], 'year' => $now['year'], 'time' => time(),'ip' => get_ip());
   db_insert("debtcharges",$data); 
    echo json_encode(array('status' => 0, 'msg' => "Nạp tiền thành công, chúng tôi sẻ xem xét và xử lý đơn hàng của bạn !"));    
    
    
}
}else{

    
    if($appID == 'mum' || $appID == 'mua' || $appID == 'ttl3dm' || $appID == 'tghm'){
    $login = login_game($username,$password,$appID,$mapID);
    if($login->returnCode == 0 && $login->message == 'Thành công'){
        
        if($appID == 'ttl3dm'){
            $h = 'ttlm';
        }
        
        $data       =  $login->data->r;
        $session    = explode('&', explode('session=', $data)[1])[0];    
        $userID     = explode('&', explode('userID=', $data)[1])[0];   
        $sig        = explode('&', explode('sig=', $data)[1])[0]; 
        $ts         = explode('&', explode('ts=', $data)[1])[0];
        if($appID == 'ttl3dm'){
        $client_key = get_info('ttlm')->data->clientKey; 
        }else{
         $client_key = get_info($appID)->data->clientKey;    
        }
        $jtoken     = auth($client_key,$session,$userID,$username,$ts,$sig,$appID); // CÓ THỂ SHOW ALL SERVER ĐANG CHƠI  
        
        $a = $jtoken->data->suggestion->roles;
        if($a != null){
        echo json_encode(array("msg" => "OKE","list" => $a,"token" => $jtoken->data->jtoken,'id' =>$userID));      
        }else{
           echo json_encode(array("msg" => "Không tồn tại tên nv","status" => $jtoken));
        }
        
        
         
        //$get_role   = getRoles($jtoken,'160',$userID,'mum');
       // $roleID     = explode('"', explode('"roleID":"', $get_role)[1])[0]; 
        //$roleName   = explode('"', explode('"roleName":"', $get_role)[1])[0];
        
        
        
        
    }else{
     echo json_encode(array("msg" => "sai tài khoản hoặc mật khẩu","status" => $login)); 
    }        
            
    }elseif($appID == 'fs'){
        $url = "https://sso3.zing.vn/alogin"; // thực hiện đăng nhập
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url);  
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, "apikey=6e731b7ae5ca4146a880d7b956eb3649&pid=12&longtime=1&u=$username&p=$password&u1=https://login.pp.m.zing.vn/login/desktopcallback?appID=fs&mapID=fs-billing&fp=https://pay.zing.vn/wplogin/pc/phongthan"); 
        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_HEADER, 1);
        $result = curl_exec($ch1);
        $cookie = explode(";", explode('Set-Cookie: ', $result)[1])[0]; //Lấy cookie
        
    if(isset($cookie) && $cookie != ''){
        
        
        
        $url = "https://login.pp.m.zing.vn/login/desktopcallback?appID=fs&mapID=fs-billing&mess=succ&u=$username"; 
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url);  
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_HEADER, 1);
        $headers = array();
        $headers[] = 'Cookie: _ga=GA1.2.1149627331.1572696168; __zi=3000.S8lYxye10ezirBUdoGC7YMYOiw3BJWwFRv2weJ4vCm.1; fpsend=146051; otp=LOGIN_SUCCESSFULLY; '.$cookie.'; acn='.$username.';';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/77.0.126 Chrome/71.0.3578.126 Safari/537.36';
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec($ch1);  
        $session    = explode('&', explode('session=', $result)[1])[0];
        $userID     = explode('&', explode('userID=', $result)[1])[0];   
        $sig        = explode('&', explode('sig=', $result)[1])[0]; 
        $ts         = explode('&', explode('ts=', $result)[1])[0];
        $socialID   = explode(' ', explode('socialID=', $result)[1])[0];
        $sID        = explode(",", explode('"sID":', $result)[1])[0]; //Lấy sI
        
        $url = "https://pay.zing.vn/product/phongthan/"; 
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url);  
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_HEADER, 1);
        $headers = array();
        $headers[] = 'Cookie: _ga=GA1.2.1149627331.1572696168; __zi=3000.S8lYxye10ezirBUdoGC7YMYOiw3BJWwFRv2weJ4vCm.1; fpsend=146051; otp=LOGIN_SUCCESSFULLY; '.$cookie.'; acn='.$username.';';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/77.0.126 Chrome/71.0.3578.126 Safari/537.36';
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec($ch1);
        $client_key = 'eyJ'.explode('"', explode('"eyJ', $result)[1])[0];  
        
       $jtoken     = auth($client_key,$session,$userID,$username,$ts,$sig,'fs');   
        $a = $jtoken->data->suggestion->roles;
        if($a != null){
        echo json_encode(array("msg" => "OKE","list" => $a,"token" =>$jtoken,'id' =>$userID));      
        }else{
           echo json_encode(array("msg" => "Không tồn tại tên nv","status" => $jtoken));
        }   
    }    else {
        
         echo json_encode(array("msg" => "Sai tài khoản hoặc mật khẩu","status" => 1));  
        
    }
        
        
        }else{
        $url = "https://sso3.zing.vn/alogin"; // thực hiện đăng nhập
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url);  
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, "apikey=6e731b7ae5ca4146a880d7b956eb3649&pid=12&longtime=1&u=$username&p=$password&u1=https%3A%2F%2Fpay.zing.vn%2Fproduct%2F".$_GET['am']."&fp=https%3A%2F%2Fpay.zing.vn%2Fwplogin%2Fpc%2F".$_GET['am'].""); 
        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_HEADER, 1);
        $result = curl_exec($ch1);  
        
     $cookie = explode(";", explode('Set-Cookie: ', $result)[1])[0]; //Lấy cookie
     if(isset($cookie) && $cookie != ''){
    $url = "https://pay.zing.vn/product/".$_GET['item']."?mess=succ&u=$username"; 
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, $url);  
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    $headers = array();
    $headers[] = 'Cookie: _ga=GA1.2.1149627331.1572696168; __zi=3000.S8lYxye10ezirBUdoGC7YMYOiw3BJWwFRv2weJ4vCm.1; fpsend=146051; otp=LOGIN_SUCCESSFULLY; '.$cookie.'; acn='.$username.';';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/77.0.126 Chrome/71.0.3578.126 Safari/537.36';
    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch1);  
    $sID = explode(",", explode('"sID":', $result)[1])[0]; //Lấy sID   
         
    echo json_encode(array("msg" => "OKE","list" => '',"token" =>'','cookie' =>$cookie ));        
     }else{
          echo json_encode(array("msg" => "Sai tài khoản hoặc mật khẩu","status" => 1));  
     }
        
    }
    
}