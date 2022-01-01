<?php



/**
* @package     Bắc CSM
* @Facebook    https://www.facebook.com/profile.php?id=553416130
* @copyright   Copyright (C) 2018-2022 Bắc CSM
* @version     2.0
*/


define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/'); // login to facebook
include_once('pagination.php'); // function phân trang
include_once('Pusher.php'); // tạo thông báo
require_once(".CSM-config.php");
//include_once('Mobile_Detect.php'); // kiểm tra thiết bị truy cập
include_once('SMTP/class.smtp.php'); // thư viện smtp
include_once('SMTP/PHPMailerAutoload.php'); // thư viện smtp
include_once('SMTP/class.phpmailer.php'); // thư viện smtp
include_once('Cross-site Request Forgery.php'); // thư viện smtp
require_once('Firewall.php');
session_start(); // đăng ký phiên trên server
ob_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
date_default_timezone_set("Asia/Ho_Chi_Minh"); // giờ Việt Nam
header("Content-type: text/html; charset=utf-8"); // set định dạng utf-8
ini_set('session.use_only_cookies', TRUE);
ini_set('session.use_trans_sid', TRUE);
session_name('CSM'); // tên session

// lấy patch
$root = $_SERVER["DOCUMENT_ROOT"];
// lấy Mobile_Detect
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// anti
$Firewall = new Firewall();
$Firewall->SecureUris();

$config = array(
  'host' => $db_host,
  'db' => $db_name,
  'username' => $db_user,
  'password' => $db_pass,
  'options' => array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  )
);

$dsn = "mysql:host={$config['host']};dbname={$config['db']}";
$dbh = new PDO($dsn, $config['username'], $config['password'], $config['options']);

// bỏ dấu
function Bodau($strTitle) {
  $strTitle = strtolower($strTitle);
  $strTitle = trim($strTitle);
  $strTitle = str_replace(' ', '-', $strTitle);
  $strTitle = preg_replace("/(!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~)/", '-', $strTitle);
  $strTitle = preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/", 'o', $strTitle);
  $strTitle = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/", 'o', $strTitle);
  $strTitle = preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/", 'a', $strTitle);
  $strTitle = preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/", 'a', $strTitle);
  $strTitle = preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/", 'e', $strTitle);
  $strTitle = preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ề|Ễ|É|È|Ẻ|Ẽ|Ẹ)/", 'e', $strTitle);
  $strTitle = preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/", 'u', $strTitle);
  $strTitle = preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/", 'u', $strTitle);
  $strTitle = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $strTitle);
  $strTitle = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $strTitle);
  $strTitle = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $strTitle);
  $strTitle = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $strTitle);
  $strTitle = preg_replace('/(đ|Đ)/', 'd', $strTitle);
  $strTitle = preg_replace("/(^\-+|\-+$)/", '', $strTitle);
  $strTitle = html_entity_decode(trim($strTitle), ENT_QUOTES, 'UTF-8');
  $strTitle = str_replace(" ", "-", $strTitle);
  $strTitle = str_replace("@", "-", $strTitle);
  $strTitle = str_replace("/", "-", $strTitle);
  $strTitle = str_replace("{", "", $strTitle);
  $strTitle = str_replace("}", "", $strTitle);
  $strTitle = str_replace("\\", "-", $strTitle);
  $strTitle = str_replace(":", "", $strTitle);
  $strTitle = str_replace("\"", "", $strTitle);
  $strTitle = str_replace("'", "", $strTitle);
  $strTitle = str_replace("<", "", $strTitle);
  $strTitle = str_replace(">", "", $strTitle);
  $strTitle = str_replace(",", "", $strTitle);
  $strTitle = str_replace("?", "", $strTitle);
  $strTitle = str_replace(";", "", $strTitle);
  $strTitle = str_replace(".", "", $strTitle);
  $strTitle = str_replace("[", "", $strTitle);
  $strTitle = str_replace("]", "", $strTitle);
  $strTitle = str_replace("(", "", $strTitle);
  $strTitle = str_replace(")", "", $strTitle);
  $strTitle = str_replace("*", "", $strTitle);
  $strTitle = str_replace("!", "", $strTitle);
  $strTitle = str_replace("$", "-", $strTitle);
  $strTitle = str_replace("&", "-and-", $strTitle);
  $strTitle = str_replace("%", "", $strTitle);
  $strTitle = str_replace("#", "", $strTitle);
  $strTitle = str_replace("^", "", $strTitle);
  $strTitle = str_replace("=", "", $strTitle);
  $strTitle = str_replace("+", "", $strTitle);
  $strTitle = str_replace("~", "", $strTitle);
  $strTitle = str_replace("`", "", $strTitle);
  $strTitle = str_replace("--", "-", $strTitle);
  $strTitle = str_replace("--", "-", $strTitle);
  return $strTitle;
}

function xss_clean($str, $charset = 'UTF-8') {
  /*
    * Remove Null Characters
    *
    * This prevents sandwiching null characters
    * between ascii characters, like Java\0script.
    *
    */
  $str = preg_replace('/\0+/', '', $str);
  $str = preg_replace('/(\\\\0)+/', '', $str);

  /*
    * Validate standard character entities
    *
    * Add a semicolon if missing.  We do this to enable
    * the conversion of entities to ASCII later.
    *
    */
  $str = preg_replace('#(&\#*\w+)[\x00-\x20]+;#u', "\\1;", $str);

  /*
    * Validate UTF16 two byte encoding (x00)
    *
    * Just as above, adds a semicolon if missing.
    *
    */
  $str = preg_replace('#(&\#x*)([0-9A-F]+);*#iu', "\\1\\2;", $str);

  /*
    * URL Decode
    *
    * Just in case stuff like this is submitted:
    *
    * <a href="http://%77%77%77%2E%67%6F%6F%67%6C%65%2E%63%6F%6D">Google</a>
    *
    * Note: Normally urldecode() would be easier but it removes plus signs
    *
    */
  $str = preg_replace("/%u0([a-z0-9]{3})/i", "\\1;", $str);
  $str = preg_replace("/%([a-z0-9]{2})/i", "\\1;", $str);

  /*
    * Convert character entities to ASCII
    *
    * This permits our tests below to work reliably.
    * We only convert entities that are within tags since
    * these are the ones that will pose security problems.
    *
    */
  if (preg_match_all("/<(.+?)>/si", $str, $matches)) {
    for ($i = 0; $i < count($matches['0']); $i++) {
      $str = str_replace($matches['1'][$i],
        $this->_html_entity_decode($matches['1'][$i], $charset),
        $str);
    }
  }

  /*
    * Not Allowed Under Any Conditions
    */
  $bad = array(
    'document.cookie' => '[removed]',
    'document.write' => '[removed]',
    'window.location' => '[removed]',
    "javascript\s*:" => '[removed]',
    "Redirect\s+302" => '[removed]',
    '<!--' => '<!--',
    '-->' => '-->'
  );

  foreach ($bad as $key => $val) {
    $str = preg_replace("#" . $key . "#i", $val, $str);
  }

  /*
    * Convert all tabs to spaces
    *
    * This prevents strings like this: ja    vascript
    * Note: we deal with spaces between characters later.
    *
    */
  $str = preg_replace("#\t+#", " ", $str);

  /*
    * Makes PHP tags safe
    *
    *  Note: XML tags are inadvertently replaced too:
    *
    *    *
    * But it doesn't seem to pose a problem.
    *
    */
  $str = str_replace(array(''), array(''), $str);

  /*
    * Compact any exploded words
    *
    * This corrects words like:  j a v a s c r i p t
    * These words are compacted back to their correct state.
    *
    */
  $words = array('javascript', 'vbscript', 'script', 'applet', 'alert', 'document', 'write', 'cookie', 'window');
  foreach ($words as $word) {
    $temp = '';
    for ($i = 0; $i < strlen($word); $i++) {
      $temp .= substr($word, $i, 1) . "\s*";
    }

    $temp = substr($temp, 0, -3);
    $str = preg_replace('#' . $temp . '#s', $word, $str);
    $str = preg_replace('#' . ucfirst($temp) . '#s', ucfirst($word), $str);
  }

  /*
    * Remove disallowed Javascript in links or img tags
    */
  $str = preg_replace("#<a.+?href=.*?(alert\(|alert&\#40;|javascript\:|window\.|document\.|\.cookie|<script|<xss).*?\>.*?</a>#si", "", $str);
  $str = preg_replace("#<img.+?src=.*?(alert\(|alert&\#40;|javascript\:|window\.|document\.|\.cookie|<script|<xss).*?\>#si", "", $str);
  $str = preg_replace("#<(script|xss).*?\>#si", "", $str);

  /*
    * Remove JavaScript Event Handlers
    *
    * Note: This code is a little blunt.  It removes
    * the event handler and anything up to the closing >,
    * but it's unlikely to be a problem.
    *
    */
  $str = preg_replace('#(<[^>]+.*?)(onblur|onchange|onclick|onfocus|onload|onmouseover|onmouseup|onmousedown|onselect|onsubmit|onunload|onkeypress|onkeydown|onkeyup|onresize)[^>]*>#iU', "\\1>", $str);

  /*
    * Sanitize naughty HTML elements
    *
    * If a tag containing any of the words in the list
    * below is found, the tag gets converted to entities.
    *
    * So this: <blink>
        * Becomes: <blink>
        *
        */
  $str = preg_replace('#<(/*\s*)(alert|applet|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|layer|link|meta|object|plaintext|style|script|textarea|title|xml|xss)([^>]*)>#is', "<\\1\\2\\3>", $str);

  /*
     * Sanitize naughty scripting elements
     *
     * Similar to above, only instead of looking for
     * tags it looks for PHP and JavaScript commands
     * that are disallowed.  Rather than removing the
     * code, it simply converts the parenthesis to entities
     * rendering the code un-executable.
     *
     * For example:    eval('some code')
     * Becomes:        eval('some code')
     *
     */
  $str = preg_replace('#(alert|cmd|passthru|eval|exec|system|fopen|fsockopen|file|file_get_contents|readfile|unlink)(\s*)\((.*?)\)#si', "\\1\\2(\\3)", $str);

  /*
     * Final clean up
     *
     * This adds a bit of extra precaution in case
     * something got through the above filters
     *
     */
  $bad = array
  (
    'document.cookie' => '[removed]',
    'document.write' => '[removed]',
    'window.location' => '[removed]',
    "javascript\s*:" => '[removed]',
    "Redirect\s+302" => '[removed]',
    '<!--' => '<!--',
    '-->' => '-->'
  );

  foreach ($bad as $key => $val) {
    $str = preg_replace("#" . $key . "#i", $val, $str);
  }

  return $str;
}

function escapeSC($string) {
  return preg_replace('/[^a-z0-9_@\.]+/i', '', $string);
}

function hasSC($array) {
  foreach ($array as $string) {
    if (strcmp($string, escapeSC($string)) != 0) {
      return true;
    }
  }
  return false;
}


/*
 * Check if a string is started with another string
 *
 * @param (string) ($needle) The string being searched for.
 * @param (string) ($haystack) The string being searched
 * @return (boolean) true if $haystack is started with $needle
 */
function start_with($needle, $haystack) {
  $length = strlen($needle);
  return (substr($haystack, 0, $length) === $needle);
}
/*
 * Detect carrier name by phone number
 *
 * @param (string) ($number) The input phone number
 * @return (mixed) Name of the carrier, false if not found
 */
function detect_number ($number) {
  $number = str_replace(array('-', '.', ' '), '', $number);
  $carriers_number = array(
    '096' => 'Viettel',
    '097' => 'Viettel',
    '098' => 'Viettel',
    '032' => 'Viettel',
    '033' => 'Viettel',
    '034' => 'Viettel',
    '035' => 'Viettel',
    '036' => 'Viettel',
    '037' => 'Viettel',
    '038' => 'Viettel',
    '039' => 'Viettel',
    '086' => 'Viettel',
    '0163' => 'Viettel',
    '0164' => 'Viettel',
    '0165' => 'Viettel',
    '0166' => 'Viettel',
    '0167' => 'Viettel',
    '0168' => 'Viettel',
    '0169' => 'Viettel',

    '090' => 'Mobifone',
    '093' => 'Mobifone',
    '070' => 'Mobifone',
    '079' => 'Mobifone',
    '077' => 'Mobifone',
    '076' => 'Mobifone',
    '078' => 'Mobifone',
    '089' => 'Mobifone',
    '0120' => 'Mobifone',
    '0121' => 'Mobifone',
    '0122' => 'Mobifone',
    '0126' => 'Mobifone',
    '0128' => 'Mobifone',

    '091' => 'Vinaphone',
    '094' => 'Vinaphone',
    '083' => 'Vinaphone',
    '084' => 'Vinaphone',
    '085' => 'Vinaphone',
    '081' => 'Vinaphone',
    '083' => 'Vinaphone',
    '089' => 'Vinaphone',
    '0123' => 'Vinaphone',
    '0124' => 'Vinaphone',
    '0125' => 'Vinaphone',
    '0127' => 'Vinaphone',
    '0129' => 'Vinaphone'
  );
  // $number is not a phone number
  if (!preg_match('/^(09|03|07|08|05|01)[0-9]{8}$/', $number)) return false;

  // Store all start number in an array to search
  $start_numbers = array_keys($carriers_number);

  foreach ($start_numbers as $start_number) {
    // if $start number found in $number then return value of $carriers_number array as carrier name
    if (start_with($start_number, $number)) {
      return $carriers_number[$start_number];
    }
  }

  // if not found, return false
  return false;
}


/* draws a calendar */
function draw_calendar($month, $year) {

  /* draw table */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

  /* table headings */
  $headings = array('Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật');
  $calendar .= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">', $headings).'</td></tr>';

  /* days and weeks vars now ... */
  $running_day = date('w', mktime(0, 0, 0, $month, 1, $year))-1;
  $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  /* row for week one */
  $calendar .= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for ($x = 0; $x < $running_day; $x++):
  $calendar .= '<td class="calendar-day-np"> </td>';
  $days_in_this_week++;
  endfor;

  /* keep going with days.... */
  for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
  $calendar .= '<td class="calendar-day">';
  /* add in the day number */
  $calendar .= '<div class="day-number">'.$list_day.'</div>';

  /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
  $calendar .= str_repeat('<p> </p>', 2);

  $calendar .= '</td>';
  if ($running_day == 6):
  $calendar .= '</tr>';
  if (($day_counter+1) != $days_in_month):
  $calendar .= '<tr class="calendar-row">';
  endif;
  $running_day = -1;
  $days_in_this_week = 0;
  endif;
  $days_in_this_week++; $running_day++; $day_counter++;
  endfor;

  /* finish the rest of the days in the week */
  if ($days_in_this_week < 8):
  for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
  $calendar .= '<td class="calendar-day-np"> </td>';
  endfor;
  endif;

  /* final row */
  $calendar .= '</tr>';

  /* end the table */
  $calendar .= '</table>';

  /* all done, return result */
  return $calendar;
}
function text($string, $separator = ', ') {
  $vals = explode($separator, $string);
  foreach ($vals as $key => $val) {
    $vals[$key] = strtolower(trim($val));
  }
  return array_diff($vals, array(""));
}

function clean_up($text) {
  return htmlentities(strip_tags($text), ENT_QUOTES, 'UTF-8');
}

function updateOderCardGame($order_pin, $token, $status, $amount, $new_name) {
  $sql = "SELECT * FROM tbl_transaction WHERE order_code = '$order_pin' AND token = '$token' AND status = '0' ";
  $entry = db_list($sql);
  if (!empty($entry) && count($entry) > 0) {
    db_update("tbl_transaction", array("status" => $status, "total" => $amount, "bank_code" => $new_name), "id = ".$entry[0]['id']." ");

    $user_id = $entry['0']['user_id'];
    $name = $entry['0']['bank_code'];

    $data = db_list("SELECT * FROM tbl_card WHERE name = '$name' ");
    $percent = 0.34;
    if (count($data) > 0) {
      $data = $data[0];
      $percent = $data['profit'];
    }
    $sql2 = "SELECT * FROM tbl_user WHERE id = '$user_id' ";
    $user_info = db_list($sql2);
    if (!empty($user_info) && count($user_info) > 0 && $status == 1) {
      $account_balance = $user_info[0]['account_balance'] +  $amount;
      db_update("tbl_user", array("account_balance" => $account_balance), "id =$user_id");
      return true;
    }
    return true;

  }
}
function updateOderCard($order_pin, $token, $status) {
  $sql = "SELECT * FROM tbl_transaction WHERE order_code = '$order_pin' AND token = '$token' AND status = '0' ";
  $entry = db_list($sql);
  if (!empty($entry) && count($entry) > 0) {
    db_update("tbl_transaction", array("status" => $status), "id = ".$entry[0]['id']." ");

    // update balance user
    $user_id = $entry['0']['user_id'];
    $total = $entry['0']['total'];
    $name = $entry['0']['bank_code'];
    $amount = $entry['0']['total'];
    $data = db_list("SELECT * FROM tbl_card WHERE name = '$name' ");
    $percent = 0.34;
    if (count($data) > 0) {
      $data = $data[0];
      $percent = $data['profit'];
    }
    $sql2 = "SELECT * FROM tbl_user WHERE id = '$user_id' ";
    $user_info = db_list($sql2);
    if (!empty($user_info) && count($user_info) > 0 && $status == 1) {
      $account_balance = $user_info[0]['account_balance'] +  $amount;
      db_update("tbl_user", array("account_balance" => $account_balance), "id =$user_id");
      return true;
    }
    return true;

  }
}
function get_ip() {
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
  else if (getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if (getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
  else if (getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if (getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
  else if (getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

// đếm thời gian
function time_ago($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
    'y' => 'Năm',
    'm' => 'Tháng',
    'w' => 'Tuần',
    'd' => 'ngày',
    'h' => 'Giờ',
    'i' => 'Phút',
    's' => 'Giây',
  );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' Trước' : 'Đang Online';
}

function sendCSM($mail_nhan, $ten_nhan, $chu_de, $noi_dung, $bcc) {
  // PHPMailer Modify
  $mail = new PHPMailer();
  $mail->SMTPDebug = 0;
  $mail ->Debugoutput = "html";
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'gachthenhanhh@gmail.com';
  $mail->Password = 'bejpvpewpjiicxty';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->setFrom('nguthichet2407@gmail.com', $bcc);
  $mail->addAddress($mail_nhan, $ten_nhan);
  $mail->addReplyTo('nguthichet2407@gmail.com', $bcc);
  $mail->isHTML(true);
  $mail->Subject = $chu_de;
  $mail->Body = $noi_dung;
  $mail->CharSet = 'UTF-8';
  $send = $mail->send();
  return $send;
}
// random pic
function random_pic($dir) {
  $files = glob($dir . '/*.*');
  $file = array_rand($files);
  return $files[$file];
}
//định dạng tiền
function format_cash($price) {
  return str_replace(",", ",", number_format($price));
}

// $_GET
function GET($key) {
  return isset($_GET[$key]) ? $_GET[$key] : false;
}
// $_POST
function POST($key) {
  return isset($_POST[$key]) ? $_POST[$key] : false;
}
// url
function load_url($url = "") {
  header("Location: ".$url);
  exit();
}
// Phần db
function db_connect() {
  if (!defined("BAC_CSM")) {
    define("BAC_CSM", true);
  }
  global $conn,
  $db_host,
  $db_user,
  $db_pass,
  $db_name;
  if (!$conn) {
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Database Connection  Failed!");
    mysqli_set_charset($conn, "utf8");
  }
}

function db_close() {
  global $conn;
  if ($conn) {
    mysqli_close($conn);
  }
}
function db_escape($string) {
  db_connect();
  global $conn;
  $escape = mysqli_real_escape_string($conn, $string);
  return $escape;
}

function db_list($sql) {
  db_connect();
  global $conn;
  $data = array();
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_free_result($result);
  return $data;
}
function db_row($sql) {
  db_connect();
  global $conn;
  $result = mysqli_query($conn, $sql);
  $row = array();
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  }
  mysqli_free_result($result);
  return $row;
}
function db_insert($table, $data = array()) {
  db_connect();
  global $conn;
  $field_list = '';
  $value_list = '';
  foreach ($data as $key => $value) {
    $field_list .= ",$key";
    $value_list .= ",'".mysqli_escape_string($conn, $value)."'";
  }
  $field_list = trim($field_list, ',');
  $value_list = trim($value_list, ',');
  return mysqli_query($conn, "INSERT INTO $table ($field_list) VALUES ($value_list)");
}


function db_update($table, $data, $where) {
  db_connect();
  global $conn;
  $sql = '';
  foreach ($data as $field => $value) {
    $sql .= "$field='".mysqli_escape_string($conn, $value)."',";
  }
  $sql = trim($sql, ',');
  $sql = "UPDATE $table SET $sql WHERE $where";
  return mysqli_query($conn, $sql);
}
function db_query($sql) {
  db_connect();
  global $conn;
  return mysqli_query($conn, $sql);
}
function db_insert_id() {
  db_connect();
  global $conn;
  return mysqli_insert_id($conn);
}
// lấy dữ liệu cài đặt
function setting($key) {
  $row = db_row("SELECT * FROM setting WHERE `key` = '$key'");
  return $row["value"];
}
// lấy widget
function widget($widget) {
  require_once($_SERVER["DOCUMENT_ROOT"]."/widget/".$widget.".php");
}
// lấy dữ liệu người dùng theo id
function client($fid = "") {
  if (!$fid) {
    $fid = $_SESSION["fid"];
  }
  $sql = "SELECT * FROM tbl_user WHERE fid = '{$fid}' LIMIT 1";
  return db_row($sql);
}
// lấy dữ liệu người dùng theo username
function client_user($user) {
  $sql = "SELECT * FROM tbl_user WHERE username = '{$user}' LIMIT 1";
  return db_row($sql);
}
// Chống xss
class Anti_xss {
  public function clean_up($text) {
    return htmlentities(strip_tags($text), ENT_QUOTES, 'UTF-8');
  }
}

// lấy dữ liệu admin
function csm_admin($admin = "") {
  if (!$admin) {
    $admin = $_SESSION["CSM_ADMIN"];
  }
  $sql = "SELECT * FROM csm_admin WHERE username = '{$admin}' LIMIT 1";
  return db_row($sql);
}
// lấy dữ liệu người dùng theo id

function menber($id) {
  return db_row("SELECT * FROM tbl_user WHERE id = '$id'");
}
//lấy dữ liệu của sản phẩm
function info_product($id) {
  return db_row("SELECT * FROM product WHERE id = '$id'");
}
//lấy dữ liệu của bài đăng
function info_news($id) {
  return db_row("SELECT * FROM news WHERE id = '$id'");
}
//lấy dữ liệu của sản phẩm
function info_card($id) {
  return db_row("SELECT * FROM list_card WHERE id = '$id'");
}
function info_type($id) {
  return db_row("SELECT * FROM type_card WHERE id = '$id'");
}
function info_network($id) {
  return db_row("SELECT * FROM list_ckcard WHERE id = '$id'");
}
function info_menber($id) {
  return db_row("SELECT * FROM tbl_user WHERE id = '$id'");
}
function info_menber_user($id) {
  return db_row("SELECT * FROM tbl_user WHERE phone = '$id'");
}
function info_cuoc($id) {
  return db_row("SELECT * FROM list_cuoc WHERE id = '$id'");
}
function info_bantien($id) {
  return db_row("SELECT * FROM list_bantien WHERE id = '$id'");
}
function info_my_viettel($id) {
  return db_row("SELECT * FROM my_viettel WHERE id = '$id'");
}
function info_atm($id) {
  return db_row("SELECT * FROM admin_atm WHERE id = '$id'");
}
function info_sms($id) {
  return db_row("SELECT * FROM list_sms WHERE id = '$id'");
}

function history_bank($id) {
  return db_row("SELECT * FROM tbl_history_bank WHERE entries_id = '$id'");
}
function info_bankatm() {
  return db_row("SELECT * FROM acc_trumthe WHERE id = '1'");
}
function history_bank_i($type) {
  return db_list("SELECT * FROM tbl_history_bank WHERE money_end = '$type' AND status = '0'");
}

function get_option_custom() {
  $result = db_list(" SELECT * FROM tbl_option_custom ");
  return $result;
}
function get_all() {
  $result = db_list("SELECT * FROM tbl_card ");
  return $result;
}
function get_all_tranferpercent() {
  $result = db_list("SELECT * FROM tbl_tranfer_percent ");
  return $result;
}
function getAllItem() {
  $configApp = require('configApp.php');
  $token = $configApp['token'];
  $url = "https://www.5etop.com/api/user/bag/570/list.do";
  $header = ["Cookie:$token"];
  $result = [];
  $data = HTTPGET($url, $header);
  if (!empty($data)) {
    $result[] = json_decode($data, true);
    if (isset($result[0]['datas'], $result[0]['datas']['pager'], $result[0]['datas']['pager']['pages']) && intval($result[0]['datas']['pager']['pages']) > 1) {
      $pages = $result[0]['datas']['pager']['pages'];
      $current = 2;
      while ($current <= $pages) {
        $_url = $url."?page=$current";
        $data = HTTPGET($_url, $header);
        if (!empty($data)) {
          $result[] = json_decode($data, true);
        }
        $current++;
      }
    }
    unset($data);
  }
  return $result;
}
function get_item($list_item, $id) {
  if (count($list_item) > 0) {
    foreach ($list_item as $item) {
      if ($item['id'] == $id) {
        return $item;
      }
    }
  }
  return [];
}
function validate_cb($api_key, $amount, $desc, $source) {
  $configApp = require('configApp.php');
  if (empty($amount) || empty($desc) ||!in_array($source, ['momo', 'vietcombank', 'techcombank', 'vnqrpay']))  return false;

  //$arr_keys = $configApp['CB_KEY'];

  // $keys = array_values($arr_keys);
  // if ( !in_array($api_key,$keys) ) return $configApp;

  $regex = '/([a-zA-Z0-9]+) vip/mi';
  $result = preg_match_all($regex, $desc, $matches, PREG_SET_ORDER, 0);
  if ($result && $matches) {
    return $matches[0][1];
  } else {
    return false;
  }
}


function send_gift($steam_id, $ids, $game) {
  $newids = implode(',', $ids);
  $configApp = require('configApp.php');
  $qrCode = $configApp["qr_code"];
  $token = $configApp["token"];
  $url = "https://www.5etop.com/gift/$game/give.do";
  $payload = array(
    'fsId' => $steam_id,
    'ids' => $newids,
    'qruuid' => $qrCode
  );
  $header = ["Cookie:$token"];
  $data_builder = http_build_query($payload, 'flags_');
  // send first request
  $data = HTTPPOST($url, $header, $data_builder);
  if (!empty($data)) {
    $s = json_decode($data, true);
    if ($s['statusCode'] == 200) {
      $url = "https://www.5etop.com/api/user/gifts.do?category=give";
      // send second request
      $data = HTTPGET($url, $header);
      if (!empty($data)) {
        $s = json_decode($data, true);
        if ($s['statusCode'] == 200) {
          $id = $s['datas']['list'][0]['id'];
          // send third request to lock
          $url = "https://www.5etop.com/gift/lock.do?id=$id";
          $data = HTTPPOST($url, $header, "{}");
          if (!empty($data)) {
            $s = json_decode($data, true);
            if ($s['statusCode'] == 200) {
              // send fourth request to unlock
              $url = "https://www.5etop.com/gift/unlock.do?id=$id";
              $data = HTTPPOST($url, $header, "{}");
              if (!empty($data)) {
                $s = json_decode($data, true);
                if ($s['statusCode'] == 200) {
                  return ['status' => true,
                    'msg' => $s['message']];
                }
              }
            }
          }
        }
      }
    }
    return ['status' => false,
      'msg' => $s['message']];
  } else {
    return ['status' => false,
      'msg' => "#1 - Lỗi kết nối tới máy chủ ."];
  }
}



function createBill($data) {
  $info_items = $data['info_items'];
  unset($data['info_items']);
  db_insert('tbl_bill', $data);
  $id = db_insert_id();
  if ($id === null) return false;
  $list_price = db_list("SELECT * FROM tbl_price_settings");
  foreach ($info_items as $key => $value) {
    $info_items[$key]['bill_id'] = $id;
    if (!empty($list_price)) {
      foreach ($list_price as $key1 => $value1) {
        $milestone = explode('-', $value1['name']);
        if ($value['item_price'] >= $milestone[0] && $value['item_price'] <= $milestone[1]) {
          $info_items[$key]['id_price_setting'] = $value1['id'];
          $info_items[$key]['price_rate'] = round($value['item_price'] * $value1['interest_rate'], 2);
          $info_items[$key]['date'] = date('Y-m-d');
          break;
        }
      }
    }
  }

  foreach ($info_items as $key => $val) {
    db_insert('tbl_item_today', $val);
  }

  foreach ($info_items as $key2 => $value2) {
    unset($info_items[$key2]['id_price_setting']);
    unset($info_items[$key2]['price_rate']);
    unset($info_items[$key2]['date']);
  }
  foreach ($info_items as $key => $val) {
    $a = db_insert('tbl_bill_detail', $val);
  }
  return  $a;
}


function calPice($price_settings, $item) {
  try {
    $price_item = isset($item['value']) ? floatval($item['value']) : -1;
    foreach ($price_settings as $price_setting) {
      $arr = explode('-', $price_setting['name']);
      if (count($arr) == 2 && $price_item >= floatval($arr[0]) && $price_item <= floatval($arr[1])) {
        $value = floatval($price_setting['price']);
        $price = $price_item*$value;
        return  $price;
      }
    }
    return false;
  }catch(Exception $e) {
    return false;
  }
}



function get_sub_item($data) {
  $list_item = [];
  foreach ($data as $key => $value) {
    $temp = $value['datas']['list'];
    if (isset($value['datas'], $value['datas']['list'])) {
      $temp = $value['datas']['list'];
      foreach ($temp as $key => $item) {
        $list_item[] = $item;
      }
    }
  }
  return $list_item;
}


function getAllItemCsgo() {
  $configApp = require('configApp.php');
  $token = $configApp['token'];
  $url = "https://www.5etop.com/api/user/bag/730/list.do";
  $header = ["Cookie:$token"];
  $result = [];
  $data = HTTPGET($url, $header);
  if (!empty($data)) {
    $result[] = json_decode($data, true);
    if (isset($result[0]['datas'], $result[0]['datas']['pager'], $result[0]['datas']['pager']['pages']) && intval($result[0]['datas']['pager']['pages']) > 1) {
      $pages = $result[0]['datas']['pager']['pages'];
      $current = 2;
      while ($current <= $pages) {
        $_url = $url."?page=$current";
        $data = HTTPGET($_url, $header);
        if (!empty($data)) {
          $result[] = json_decode($data, true);
        }
        $current++;
      }
    }
    unset($data);
  }
  return $result;
}
function HTTPPOST($url, $header, $data) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_VERBOSE, true);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

function HTTPGET($url, $header) {

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_TIMEOUT, 15);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
function get_all_730() {
  $result = db_list("SELECT * FROM tbl_price_730_settings ");
  return $result;
}

function get_all_settings_order() {
  $result = db_list("SELECT * FROM tbl_price_settings_order ");
  return $result;
}


// xác nhận người dùng
function is_client() {
  $fid = isset($_SESSION["fid"]) ? $_SESSION["fid"] : false;
  if ($fid) {
    return true;
  }
  return false;
}
// xác nhận admin
function is_admin() {
  if (is_client()) {
    $id_admin = "470160012214662659199364104478"; // id này lấy trong csdl cột fid bảng client
    $id_admin2 = "493467324036891239548328671770"; // id này lấy trong csdl cột fid bảng client
    if ($_SESSION["fid"] == $id_admin || $_SESSION["fid"] == $id_admin2) {
      return true;
    }
    return false;
  }
  return false;
}
// lấy dữ liệu CTV
function csm_ctv($ctv = "") {

  if (!$ctv) {
    $ctv = $_SESSION["CSM_CTV"];
  }
  $sql = "SELECT * FROM tbl_user WHERE username = '{$ctv}' AND type_meber ='Đại Lý' LIMIT 1 ";
  return db_row($sql);
}
// định dạng ngày tháng
function time_to_str($var) {
  $jun = date("H:i:s - d/m/Y", $var);
  return $jun;
}
function active () {}
//cập nhật trạng thái trực tuyến
if (is_client()) {
  if ($_SESSION["token_"] != client()['token']) {
    // chỉ cho đăng nhập trên 1 thiết bị
    session_destroy();
    $_SESSION["msg_user"] = 'Phiên đăng nhập đã hết hạn vui lòng đăng nhập lại!';
  }
  db_update("tbl_user", array("last_time" => time()), "fid = '{$_SESSION["fid"]}'");
}
// id
function generateRandomString($length = 30) {
  $characters = '0123456789';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
//random APIkey
function APIkey($length = 10) {
  $characters = '0123456789';
  $charactersLength = strlen($characters);
  $randomAPIkey = '';
  for ($i = 0; $i < $length; $i++) {
    $randomAPIkey .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomAPIkey;
}
// random APIsecret
function APIsecret($length = 25) {
  $characters = '0123456789QWERTYUIOASDFGHJKLZXCVBNM';
  $charactersLength = strlen($characters);
  $randomAPIsecret = '';
  for ($i = 0; $i < $length; $i++) {
    $randomAPIsecret .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomAPIsecret;
}
// random KEY_ID
function key_id($length = 10) {
  $characters = '0123456789QWERTYUIOASDFGHJKLZXCVBNM0123456789QWERTYUIOASDFGHJKLZXCVBNM';
  $charactersLength = strlen($characters);
  $randomAPIsecret = 'CSM_';
  for ($i = 0; $i < $length; $i++) {

    $randomAPIsecret .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomAPIsecret;
}
// random mật khẩu
function password($length = 10) {
  $characters = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOASDFGHJKLZXCVBNM';
  $charactersLength = strlen($characters);
  $password = '';
  for ($i = 0; $i < $length; $i++) {
    $password .= $characters[rand(0, $charactersLength - 1)];
  }
  return $password;
}
// random mật khẩu cấp 2
function pass2($length = 6) {
  $characters = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOASDFGHJKLZXCVBNM';
  $charactersLength = strlen($characters);
  $pass2 = '';
  for ($i = 0; $i < $length; $i++) {
    $pass2 .= $characters[rand(0, $charactersLength - 1)];
  }
  return $pass2;
}
// random code
function code($length = 10) {
  $characters = '012345678912131654777987lzxcvbnmQWERTYUIOASDFGHJKLZXCVBNM';
  $charactersLength = strlen($characters);
  $code = '';
  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, $charactersLength - 1)];
  }
  return $code;
}

// random code
function csrf_($length = 30) {
  $characters = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOASDFGHJKLZXCVBNM';
  $charactersLength = strlen($characters);
  $code = '';
  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, $charactersLength - 1)];
  }
  $_SESSION['csrf'] = sha1(md5($code));
  return $_SESSION['csrf'];

}



// random code
function token_($length = 250) {
  $characters = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOASDFGHJKLZXCVBNM';
  $charactersLength = strlen($characters);
  $code = 'EAAAAAY';
  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, $charactersLength - 1)];
  }
  return $code;
}
function curl_reg($url, $username, $password, $type_acc) {
  $dataPost = 'username='.$username.'&password='.$password.'&type_acc='.$type_acc.'';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url.'/Reg.php?username='.$username.'&password='.$password.'&type_acc='.$type_acc.'');
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
  $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  curl_setopt($ch, CURLOPT_REFERER, $actual_link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;

}
// inbox facebook
set_time_limit(0);
function curl_post($url, $method, $postinfo, $cookie_file_path) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_NOBODY, false);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_COOKIE, $cookie_file_path);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
  curl_setopt($ch, CURLOPT_USERAGENT,
    "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
  if ($method == 'POST') {
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
  }
  $html = curl_exec($ch);
  curl_close($ch);
  return $html;
}
function convertTokenToCookie($token) {
  $html = json_decode(file_get_contents("https://api.facebook.com/method/auth.getSessionforApp?access_token=$token&format=json&new_app_id=6628568379&generate_session_cookies=1"), true);
  $cookie = $html['session_cookies'][0]['name']."=".$html['session_cookies'][0]['value'].";".$html['session_cookies'][1]['name']."=".$html['session_cookies'][1]['value'].";".$html['session_cookies'][2]['name']."=".$html['session_cookies'][2]['value'].";".$html['session_cookies'][3]['name']."=".$html['session_cookies'][3]['value'];
  return $cookie;
}
function send_active($dataPost) {
  $url = 'https://api-demo.ga/SERVER';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url.'/check_status.php?'.$dataPost);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);
  return $output;
}
function senInboxCSM($cookie, $noiDungTinNhan, $idAnh, $idNguoiNhan) {

  //lấy id người gửi
  preg_match("/c_user=([0-9]+);/", $cookie, $idNguoiGui);
  $idNguoiGui = $idNguoiGui[1];

  //lấy dtsg
  $html = curl_post('https://m.facebook.com', 'GET', "", $cookie);
  $re = "/<input type=\"hidden\" name=\"fb_dtsg\" value=\"(.*?)\" autocomplete=\"off\" \\/>/";
  preg_match($re, $html, $dtsg);
  $dtsg = $dtsg[1];


  //tách chuỗi thành vòng lặp, lấy từng người nhận ra
  $ex = explode("|", $idNguoiNhan);
  foreach ($ex as $idNguoiNhan) {
    // echo ".$idNguoiNhan.";


    //lấy tids
    $html1 = curl_post("https://m.facebook.com/messages/read/?fbid=$idNguoiNhan&_rdr", 'GET', '', $cookie);
    $re = "/tids=(.*?)\&/";
    preg_match($re, $html1, $tid);
    if (isset($tid[1])) {
      $tid = urldecode($tid[1]); //encode mã tids lại
      $data = array("fb_dtsg" => "$dtsg",
        "body" => "$noiDungTinNhan",
        "send" => "Gá»­i",
        "photo_ids[$idanh]" => "$idAnh",
        "tids" => "$tid",
        "referrer" => "",
        "ctype" => "",
        "cver" => "legacy");
    } else {
      $data = array("fb_dtsg" => "$dtsg",
        "body" => "$noiDungTinNhan",
        "Send" => "Gá»­i",
        "ids[0]" => "$idNguoiNhan",
        "photo" => "",
        "waterfall_source" => "message");
    }

    //Gửi tin nhắn
    $html = curl_post('https://m.facebook.com/messages/send/?icm=1&refid=12', 'POST', http_build_query($data), $cookie);
    $re = preg_match("/send_success/", $html, $rep); //bắt kết quả trả về
    if (isset($rep[0])) {
      return true;
      ob_flush();
      flush();
    } else {
      return false;
      ob_flush();
      flush();
    }
  }
}