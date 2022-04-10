<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1:
            $product = $mysqli->real_escape_string($_POST['product']);            
            $dt_ending = $_POST['dtEnding'];

            if ($dt_ending){
               
                include('query_inventory.php');

                if ($product){
                    $sql .= " WHERE CONCAT_WS(' ',  p.product_code, p.product_name, c.category ) LIKE '%{$product}%' ";
                }

                $sql .= ' ORDER BY p.product_name;';

                $_SESSION['inventory_sql'] = $sql;
                                    
                include('pop_inventory.php');                                    
               
            }else{
                echo "Error: Please select ending date!";
            }

        break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
    
    $mysqli->close();
