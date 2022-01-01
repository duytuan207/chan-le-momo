<?php


/**
 * @package     Bắc CSM
 * @Facebook    https://www.facebook.com/profile.php?id=553416130
 * @copyright   Copyright (C) 2018-2022 Bắc CSM
 * @version     2.0
 */
 

// dùng html bình thường
function pagination_html($total,$per_page=10,$page=1,$url='/'){   
    $adjacents = "2"; 
    $prevlabel = "&lsaquo; Trước";
    $nextlabel = "Tiếp &rsaquo;";
	$lastlabel = "Cuối &rsaquo;&rsaquo;";
     
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
     
    $lastpage = ceil($total/$per_page);
     
    $lpm1 = $lastpage - 1; // //last page minus 1
     
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "<ul class='pagination pagination-ajax'>";
        //$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
             
            if ($page > 1) $pagination.= "<li><a href='{$url}page/{$prev}'>{$prevlabel}</a></li>";
             
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li class='active'><a>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}page/{$counter}'>{$counter}</a></li>";                    
            }
         
        } elseif($lastpage > 5 + ($adjacents * 2)){
             
            if($page < 1 + ($adjacents * 2)) {
                 
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li class='active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page/{$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                $pagination.= "<li><a href='{$url}page/{$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page/{$lastpage}'>{$lastpage}</a></li>";  
                     
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                 
                $pagination.= "<li><a href='{$url}page/1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page/2'>2</a></li>";
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class='active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page/{$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                $pagination.= "<li><a href='{$url}page/{$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page/{$lastpage}'>{$lastpage}</a></li>";      
                 
            } else {
                $pagination.= "<li><a href='{$url}page/1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page/2'>2</a></li>";
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class='active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page/{$counter}'>{$counter}</a></li>";                    
                }
            }
        }
         
            if ($page < $counter - 1) {
				$pagination.= "<li><a href='{$url}page/{$next}'>{$nextlabel}</a></li>";
				$pagination.= "<li><a href='{$url}page/$lastpage'>{$lastlabel}</a></li>";
			}
         
        $pagination.= "</ul>";        
    }
     
    return $pagination;
}
// dùng cho ajax, jquery
function pagination_ajax($total,$per_page=10,$page=1,$url='?'){   
    $adjacents = "2"; 
    $prevlabel = "←";
    $nextlabel = "→";
	$lastlabel = "Cuối &rsaquo;&rsaquo;";
     
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
     
    $lastpage = ceil($total/$per_page);
     
    $lpm1 = $lastpage - 1; // //last page minus 1
     
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= '<div class="row"><div class="col-md-12 body-pagging"><div class="pagination-container"><ul class="pagination pagination-ajax">';             
            if ($page > 1) $pagination.= "<li onclick='page={$prev}'><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
             
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li class='item active'><a>{$counter}</a></li>";
                else
                    $pagination.= "<li onclick='page={$counter}'><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
            }
         
        } elseif($lastpage > 5 + ($adjacents * 2)){
             
            if($page < 1 + ($adjacents * 2)) {
                 
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li class='item active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li onclick='page={$counter}'><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                     
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                 
                $pagination.= "<li onclick='page=1'><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li onclick='page=2'><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class='item active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li onclick='page={$counter}'><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                $pagination.= "<li onclick='page={$lpm1}'><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                 
            } else {
                 
                $pagination.= "<li onclick='page=1'><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li onclick='page=2'><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class='item active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li onclick='page={$counter}'><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
            }
        }
         
            if ($page < $counter - 1) {
				$pagination.= "<li onclick='page={$next}'><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
			}
         
        $pagination.= "</ul></div></div></div>";        
    }
     
    return $pagination;
}

// dùng cho ajax, jquery
function pagination_get($total,$per_page=10,$page=1,$url='?'){   
    $adjacents = "2"; 
    $prevlabel = "←";
    $nextlabel = "→";
    $lastlabel = "Cuối &rsaquo;&rsaquo;";
     
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
     
    $lastpage = ceil($total/$per_page);
     
    $lpm1 = $lastpage - 1; // //last page minus 1
     
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= '<div class="row"><div class="col-md-12 body-pagging"><div class="pagination-container"><ul class="pagination paginator">';             
            if ($page > 1) $pagination.= "<li><a href='{$url}{$prev}'>{$prevlabel}</a></li>";
             
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li class='item active'><a>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}{$counter}'>{$counter}</a></li>";                    
            }
         
        } elseif($lastpage > 5 + ($adjacents * 2)){
             
            if($page < 1 + ($adjacents * 2)) {
                 
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li class='item active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}{$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                $pagination.= "<li><a href='{$url}{$lpm1}'>{$lpm1}</a></li>";
                     
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                 
                $pagination.= "<li><a href='{$url}1'>1</a></li>";
                $pagination.= "<li><a href='{$url}2'>2</a></li>";
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class='item active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}{$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                $pagination.= "<li><a href='{$url}{$lpm1}'>{$lpm1}</a></li>";
                 
            } else {
                 
                $pagination.= "<li><a href='{$url}1'>1</a></li>";
                $pagination.= "<li><a href='{$url}2'>2</a></li>";
                $pagination.= "<li class='paginate_button disabled' aria-controls='list_topup_table' tabindex='0' id='list_topup_table_ellipsis'><a href='#'>...</a></li> ";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class='item active'><a>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}{$counter}'>{$counter}</a></li>";                    
                }
            }
        }
         
            if ($page < $counter - 1) {
		$pagination.= "<li><a href='{$url}{$next}'>{$nextlabel}</a></li>";
			}
         
        $pagination.= "</ul></div></div></div>";        
    }
     
    return $pagination;
}