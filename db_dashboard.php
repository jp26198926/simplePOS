<?php
    include('validate.php');
    include('connect.php');
    $curr_date = date('Y-m-d');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //total sales
            $sql = "SELECT sum(total) as total FROM pos_transaction WHERE status_id=1 AND (dt LIKE '%{$curr_date}%');";
            $exec = $mysqli->query($sql);
            if ($exec){
                $row=$exec->fetch_object();
                $total = floatval($row->total);
                echo number_format($total,2,'.',',');
            }else{
                //echo "Error: " . $mysqli->error;
                echo "Error";
            }
            break;
        
        case 2: //total transaction
            $sql = "SELECT count(*) as trans FROM pos_transaction WHERE status_id=1 AND (dt LIKE '%{$curr_date}%');";
            $exec = $mysqli->query($sql);
            if ($exec){
                $row=$exec->fetch_object();
                $trans = floatval($row->trans);
                echo $trans;
            }else{               
                echo "Error";
            }
            break;
        
        case 3: //out of stock
            // - (select sum(qty) from pos_sale where product_id=s.product_id AND status_id=1 group by product_id)
            $sql = "SELECT (sum(s.qty) - coalesce((select sum(x.qty) as total from pos_sale x where (x.product_id=s.product_id AND x.status_id=1) group by x.product_id),0)) as product_total,
                            u.uom as uom,
                            p.product_name as product_name
                    FROM (pos_stock s
                    LEFT JOIN (pos_product p left join pos_uom u ON u.id=p.product_uom) ON p.id=s.product_id)
                    WHERE s.status_id=1
                    GROUP BY s.product_id
                    ORDER BY product_total ASC;";
            $exec = $mysqli->query($sql);
            
            if ($exec){
                $count = $exec->num_rows;
                
                if ($count > 0){
                    $row=$exec->fetch_object();
                    $product_total = floatval($row->product_total);
                    $uom = strtolower($row->uom);
                    $product_name = strtoupper($row->product_name);
                    
                    echo $product_total . ':~|~:' . $uom . ':~|~:' . $product_name;
                }
                
            }else{               
                echo "Error" . $mysqli->error;
            }
            break;
        
        case 4: //graph
            
            $hours = array("00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00",
                               "13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00","24:00");
            $hours_value = array();
            
            foreach (array_keys($hours) as $key){
                $hours_value[$key]=0;
            }
            
            $dt_start = date('Y-m-d') . " 00:00:00";
            $dt_end = date('Y-m-d') . " 23:59:59";
                
            $sql = "select (HOUR(s.dt) + 1) as hrs, SUM(total) as total FROM pos_sale s
                    WHERE s.dt >= '{$dt_start}' AND s.dt <= '{$dt_end}' AND s.status_id=1
                    GROUP by HOUR(s.dt);";
                    
            $pop = $mysqli->query($sql);
            if ($pop){
                while($row=$pop->fetch_object()){           
                    $total = floatval($row->total);
                    $hrs = intval($row->hrs);
                    $hours_value[$hrs]=$total;
                }
            }else{
                echo $mysqli->error;
            }
            
            //print_r($hours_value);
            echo json_encode(array_values($hours));
            echo ":~|~:";
            echo json_encode(array_values($hours_value));
            
            break;
        
        case 5: //product monitoring
            include('query_product.php');
            $sql .= ' ORDER BY p.product_name;';
                                    
            include('pop_product_dashboard.php');
            
            break;
        
        default:
            echo "Error";
    }
    
    $mysqli->close();
?>