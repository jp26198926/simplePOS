<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //search
            $mysearch = $_POST['mysearch'];
            
            include('query_sales_summary.php');
           
            $sql .= " WHERE s.status_id=1 AND
                            CONCAT_WS(' ', p.product_code,p.product_name,u.uom) LIKE '%{$mysearch}%' ";
            
            $sql .= " GROUP BY s.product_id ";
            $sql .= " ORDER BY p.product_name; ";            
            
            $_SESSION['sales_sql_summary'] = $sql;
            
            if ($mysearch){
                $_SESSION['sales_product_summary'] = $mysearch;
            }else{
                $_SESSION['sales_product_summary'] = 'All';
            }
            
            $_SESSION['sales_dtfrom_summary'] = 'Start';
            $_SESSION['sales_dtto_summary'] = 'Current Date';
            
            include('pop_sales_summary.php');
            
            break; 
                
        case 2: //advance search summary
            
            $product = $mysqli->real_escape_string(trim($_POST['product'] . ' '));
            $dtFrom = $_POST['dtFrom'];
            $dtTo = $_POST['dtTo'];
            
            include('query_sales_summary.php');
             
            $sql .= " WHERE s.status_id=1 ";
            
            if ($product){
                $_SESSION['sales_product_summary'] = $product;
                echo $product . ":~|~:";
                $sql .= " AND CONCAT(p.product_code,' ',p.product_name) LIKE '%{$product}%' ";
            }else{
                $_SESSION['sales_product_summary'] = 'All';
                echo "All :~|~:";
            }
            
            if ($dtFrom){
                $_SESSION['sales_dtfrom_summary'] = $dtFrom;
                echo $dtFrom . ":~|~:";
                $sql .= " AND DATE(s.dt) >= '{$dtFrom}' ";
            }else{
                $_SESSION['sales_dtfrom_summary'] = 'Start';
                echo "Start :~|~:";
            }
            
            if ($dtTo){
                $_SESSION['sales_dtto_summary'] = $dtTo;
                echo $dtTo . ":~|~:";
                $sql .= " AND DATE(s.dt) <= '{$dtTo}' ";
            }else{
                $_SESSION['sales_dtto_summary'] = 'Current Date';
                echo "Current Date :~|~:";
            }
            
            $sql .= " GROUP BY s.product_id ";
            $sql .= " ORDER BY p.product_name; ";          
            
            $_SESSION['sales_sql_summary'] = $sql;
            
            include('pop_sales_summary.php');
            
            break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
    
    $mysqli->close();
?>