<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //search
            $mysearch = $_POST['mysearch'];
            
            include('query_sales.php');
           
            $sql .= " WHERE CONCAT_WS(' ',s.id,LPAD(s.tran_id,8,'0'),CONCAT(DATE_FORMAT(s.dt, '%y'),LPAD(s.tran_id,8,'0')),s.qty,s.current_price,s.dt,
                                        s.discount_total,s.discount_qty,s.total,                                        
                                        p.product_code,p.product_name,u.uom,d.discount_type,
                                        st.status) LIKE '%{$mysearch}%' ;";
            
            $_SESSION['sales_sql'] = $sql;
            
            include('pop_sales.php');
            
            break;        
       
        
        case 2: //advance search
            $receipt = $mysqli->real_escape_string(trim($_POST['receipt'] . ''));
            $product = $mysqli->real_escape_string(trim($_POST['product'] . ''));
            $dtFrom = $_POST['dtFrom'];
            $dtTo = $_POST['dtTo'];
            $status_id = $_POST['status'];
            
            include('query_sales.php');
            
            $sql .= "WHERE CONCAT_WS(' ', s.tran_id, LPAD(s.tran_id,8,'0'), CONCAT(DATE_FORMAT(s.dt, '%y'),LPAD(s.tran_id,8,'0'))) LIKE '%{$receipt}%' ";
            $sql .= "AND CONCAT(p.product_code,' ',p.product_name) LIKE '%{$product}%' ";
            
            if ($dtFrom){
                $sql .= "AND DATE(s.dt) >= '{$dtFrom}' ";
            }
            
            if ($dtTo){
                $sql .= "AND DATE(s.dt) <= '{$dtTo}' ";
            }
            
            if ($status_id){
                $sql .= "AND s.status_id = {$status_id} ";
            }
            
            $_SESSION['sales_sql'] = $sql;
                        
            include('pop_sales.php');
            
            break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
    
    $mysqli->close();
?>