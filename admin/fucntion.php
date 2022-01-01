<?
function login_game($username,$password,$app,$map){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://login.pp.m.zing.vn/login/zing');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "u=$username&p=$password&mapID=$map&appID=$app");
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Origin: https://pay.zing.vn';
    $headers[] = 'Referer: https://pay.zing.vn/wplogin/mobile/mua';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    return json_decode($result);
}
function auth($clientKey,$session,$userID,$userName,$ts,$sig,$type){
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://billing.mto.zing.vn/fe/api/auth/login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "clientKey=$clientKey&lang=VI&success=0&gameID=$type&session=$session&userID=$userID&userName=$userName&loginType=11&ts=$ts&sig=$sig&appID=$type");
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Origin: https://pay.zing.vn';
    $headers[] = 'Referer: https://pay.zing.vn/product/'.$type.'/callback?success=0&gameID='.$type.'&session='.$session.'&userID='.$userID.'&userName='.$userName.'&loginType=11&ts='.$ts.'&sig='.$sig.'&appID='.$type.'';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    
    return json_decode($result);
}



function getServers ($uid,$token){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://billing.mto.zing.vn/fe/api/store/getServers');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "userID=$uid&loginType=11&jtoken=$token&lang=VI");
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Origin: https://pay.zing.vn';
    $headers[] = 'Referer: https://pay.zing.vn/product/mua/identification';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    return json_decode($result);
}


function get_info ($type){
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://pay.mto.zing.vn/lp/shopfront/getInfo');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "shopfrontID=$type");
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Origin: https://pay.zing.vn';
    $headers[] = 'Referer: https://pay.zing.vn/product/'.$type.'/identification';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    return json_decode($result);
}



function getRoles($token,$server_id,$u_id,$type){
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://billing.mto.zing.vn/fe/api/store/getRoles');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "userID=$u_id&roleID=&serverID=$server_id&roleName=&loginType=11&jtoken=$token&lang=VI");
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Origin: https://pay.zing.vn';
    $headers[] = 'Referer: https://pay.zing.vn/product/'.$type.'/identification';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    return $result;
}


function pay($token,$roleID,$server_id,$serial,$code,$u_id,$roleName,$type,$amount){
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://billing.mto.zing.vn/fe/api/pmt/payCard');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "jtoken=$token&roleID=$roleID&serverID=$server_id&productID=$type&pmcID=1&paymentGatewayID=1&paymentGroupID=card&paymentPartnerID=1&providerID=1&country=VN&currency=VND&amount=$amount&lang=VI&cardSerial=$serial&cardPassword=$code&userID=$u_id&roleName=$roleName");
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Origin: https://pay.zing.vn';
    $headers[] = 'Referer: https://pay.zing.vn/product/mua/confirmation';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    return json_decode($result);
    
    
}


function getResult ($orderNumber,$clientKey){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://billing.mto.zing.vn/fe/api/order/getResult');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "country=VN&orderNumber=$orderNumber&clientKey=$clientKey&lang=VI");
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Origin: https://pay.zing.vn';
    $headers[] = 'Referer: https://pay.zing.vn/product/mua/result/'.$orderNumber.'';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch); 
    return json_decode($result);   
 
}
