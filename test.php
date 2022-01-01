<?php
define("BAC_CSM", true); // dòng này do Bắc viết, mấy dòng sau coppy thôi
require_once("CSM/function.php"); // function gọi là chức năng nhé =))

$value['comment'] = 't';
$number_one = 9643570255;
$number_one = substr($number_one, -1);
$ND = db_row("SELECT * FROM `setting_mini` WHERE note = '{$value['comment']}'"); 
//$number_one = substr(15215656, -$ND['number']);
//var_dump($number_one);

                            if($value['comment'] == 'T' ||$value['comment'] ==  't' || $value['comment'] ==  'x' || $value['comment'] ==  'X'){
                                
                                 if(($value['comment']) == 'X' || ($value['comment']) ==  'x' ){
                                    if($number_one < '5') {
                                        // THỰC HIỆN CHUYỂN TIỀN
                                    $amount = $amount*$ND['chietkhau'];
                                     $bill = array('phone' => $parid,'token' => $token,'name' => $sothamchieu,'note' => 'Thắng '.$ND['type'].'','amount' => $amount,'game' => $ND['type'],'tranId'=>$magiaodich);   
                                    }
                        
                                  }  else if(($value['comment']) == 'T' || ($value['comment']) ==  't' ){
                                      if($number_one >= '5') {
                                        // THỰC HIỆN CHUYỂN TIỀN
                                    $amount = $amount*$ND['chietkhau'];
                                     $bill = array('phone' => $parid,'token' => $token,'name' => $sothamchieu,'note' => 'Thắng '.$ND['type'].'','amount' => $amount,'game' => $ND['type'],'tranId'=>$magiaodich);;         
                                      }   
                                  }
                                    
                                 //print_R($bill);exit;    
                                
                            } else if($value['comment'] == 'C' || $value['comment'] ==  'c' ||$value['comment'] ==  'l' ||$value['comment'] ==  'L'){
                                

                                   if($value['comment'] == 'C' || $value['comment'] == 'c' ){
                                       
                                     if($number_one %2 == 0) { 
                                        // THỰC HIỆN CHUYỂN TIỀN
                                    $amount = $amount*$ND['chietkhau'];
                                     $bill = array('phone' => $parid,'token' => $token,'name' => $sothamchieu,'note' => 'Thắng '.$ND['type'].'2','amount' => $amount,'game' => $ND['type'],'tranId'=>$magiaodich);
                                     }
                                    }
                                    
                              
                                    
                                    if( $value['comment'] == 'l' || $value['comment'] == 'L'){
                                     if($number_one %2 != 0) {    
                                        // THỰC HIỆN CHUYỂN TIỀN
                                    $amount = $amount*$ND['chietkhau'];
                                     $bill = array('phone' => $parid,'token' => $token,'name' => $sothamchieu,'note' => 'Thắng '.$ND['type'].'1','amount' => $amount,'game' => $ND['type'],'tranId'=>$magiaodich);   
                                     }
                                     
                                    }
                                    
                                    
                                
                                
                                
                            } 
                            
                            
                            print_R($bill);exit;  