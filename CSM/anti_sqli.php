<?php  

function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}




$sql_inject_1 = array(";","'","%",'"'); #Whoth need replace  
$sql_inject_2 = array("", "","","&quot;"); #To wont replace  
$GET_KEY = array_keys($_GET); #array keys from $_GET  
$POST_KEY = array_keys($_POST); #array keys from $_POST  
$COOKIE_KEY = array_keys($_COOKIE); #array keys from $_COOKIE  
/*begin clear $_GET */  
for($i=0;$i<count($GET_KEY);$i++)  
{  
$real_get[$i] = $_GET[$GET_KEY[$i]];  
$_GET[$GET_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_GET[$GET_KEY[$i]]));  
if($real_get[$i] != $_GET[$GET_KEY[$i]])  
{  
foreach ($_GET as $param_name => $param_val) {
    $value .= "-Param: $param_name = $param_val\n";
}

fwrite ($fp, "IP: $ip\r\n");  
fwrite ($fp, "Method: GET\r\n");  
fwrite ($fp, "Value: $real_get[$i]\r\n"); 
fwrite ($fp, "TEXT: \n $value\r\n"); 
fwrite ($fp, "Script: $script\r\n");  
fwrite ($fp, "Time: $time\r\n");  
fwrite ($fp, "==================================\r\n");  
}  
}  
/*end clear $_GET */  
/*begin clear $_POST */  
for($i=0;$i<count($POST_KEY);$i++)  
{  
$real_post[$i] = $_POST[$POST_KEY[$i]];  
$_POST[$POST_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_POST[$POST_KEY[$i]]));  
if($real_post[$i] != $_POST[$POST_KEY[$i]])  
{  

foreach ($_POST as $param_name => $param_val) {
    $value .= "-Param: $param_name = $param_val\n";
}   
fwrite ($fp, "IP: $ip\r\n");  
fwrite ($fp, "Method: POST\r\n");  
fwrite ($fp, "Value: $real_post[$i]\r\n"); 
fwrite ($fp, "TEXT: \n $value\r\n"); 
fwrite ($fp, "Script: $script\r\n");  
fwrite ($fp, "Time: $time\r\n");  
fwrite ($fp, "==================================\r\n");  
}  
}  
/*end clear $_POST */  
/*begin clear $_COOKIE */  
for($i=0;$i<count($COOKIE_KEY);$i++)  
{  
$real_cookie[$i] = $_COOKIE[$COOKIE_KEY[$i]];  
$_COOKIE[$COOKIE_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_COOKIE[$COOKIE_KEY[$i]]));  
if($real_cookie[$i] != $_COOKIE[$COOKIE_KEY[$i]])  
{  

foreach ($_COOKIE as $param_name => $param_val) {
    $value .= "-Param: $param_name = $param_val\n";
}   
    
fwrite ($fp, "IP: $ip\r\n");  
fwrite ($fp, "Method: COOKIE\r\n");  
fwrite ($fp, "Value: $real_cookie[$i]\r\n"); 
fwrite ($fp, "TEXT: \n $value\r\n"); 
fwrite ($fp, "Script: $script\r\n");  
fwrite ($fp, "Time: $time\r\n");  
fwrite ($fp, "==================================\r\n");  
}  
}  

/*end clear $_COOKIE */  
?>