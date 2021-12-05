<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //search
            $mysearch = $_POST['mysearch'];
            
            include('query_product.php');
            
            $sql .= " WHERE concat_ws(' ',p.product_code,p.product_name,u.uom,u.description,s.status) LIKE '%{$mysearch}%' ORDER BY p.product_name;";
            
            include('pop_product.php');
            
            //save to Trail
            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                            VALUES ('{$dt}',2,8,'{$mysearch}','',$uid);";
            $trail_save = $mysqli->query($trail_query);
            //end of Trail
            
            break;
        
        case 2: //add new
            $product_code = $mysqli->real_escape_string(trim($_POST['product_code'] . ''));
            $product_name = $mysqli->real_escape_string(trim($_POST['product_name']).'');
            $product_uom = $_POST['product_uom'];
            
            if ($product_code && $product_name && $product_uom){
                                                        
                $sql = "INSERT INTO pos_product (product_code, product_name, product_uom)
                        VALUES ('{$product_code}','{$product_name}',$product_uom);";
                            
                $exec = $mysqli->query($sql);
                    
                if ($exec){
                    $product_id = $mysqli->insert_id;
                    
                    //save to Trail
                    $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                    VALUES ('{$dt}',2,10,'{$product_code} - {$product_name}','',$uid);";
                    $trail_save = $mysqli->query($trail_query);
                    //end of Trail
                    
                    include("query_product.php");
                        
                    $sql .= " ORDER BY p.product_name;";
                                                                                                 
                    include ('pop_product.php'); 
                        
                }else{
                    echo "Error: " . $mysqli->error;
                }                    
            
            }else{
                echo  "Error: Fields with red asterisk are required!";    
            }
                
            break;
        
        case 3: //modify
            $id = $_POST['id'];
            $product_code = $mysqli->real_escape_string(trim($_POST['product_code'] . ''));
            $product_name = $mysqli->real_escape_string(trim($_POST['product_name']).'');
            $product_uom = $_POST['product_uom'];
                    
            $sql = "UPDATE pos_product SET  product_code='{$product_code}', product_name='{$product_name}', product_uom={$product_uom} WHERE id={$id};";
            
            $exec = $mysqli->query($sql);
            if ($exec){
                //save to Trail
                $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                VALUES ('{$dt}',2,12,'{$product_code} - {$product_name}','',$uid);";
                $trail_save = $mysqli->query($trail_query);
                //end of Trail
                
                
                include("query_product.php");
                
                $sql .= " WHERE p.id={$id} ";        
                $sql .= " ORDER BY p.product_name;";
                                                                                                 
                //include ('pop_product.php');
                include ('pop_product_row.php');  
                       
            }else{
                echo "Error: " . $mysqli->error;
            }
            break;
                
        case 4: //get info
            $id = $_POST['id'];
            if ($id){
                $sql = "SELECT product_code,product_name,product_uom FROM pos_product WHERE id={$id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    $row=$exec->fetch_object();
                            
                    $product_code = $row->product_code;
                    $product_name = $row->product_name;
                    $product_uom = $row->product_uom;
                                                
                    echo $product_code . ":|:" . $product_name . ":|:" . $product_uom;
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
                    
            break;
        
        case 6: //advance search
            $product_code = $mysqli->real_escape_string(trim($_POST['product_code'] . ''));
            $product_name = $mysqli->real_escape_string(trim($_POST['product_name']).'');
            $product_uom = intval(trim($_POST['product_uom'] . ''));
            $product_price = floatval(trim($_POST['product_price'] . ''));
            $product_status = intval(trim($_POST['product_status'] . ''));            
            
            include('query_product.php');
            
            $sql .= " WHERE p.product_code LIKE '%{$product_code}%' AND p.product_name LIKE '%{$product_name}%' ";
            
            if ($product_uom){
                $sql .= " AND p.product_uom={$product_uom} ";
            }
            /*
            if ($product_price){
                $sql .= " AND p.price={$product_price} ";
            }
            */
            if ($product_status){
                $sql .= " AND p.status_id={$product_status} ";
            }
                        
            $sql .= " ORDER BY p.product_name;";
            
            include('pop_product.php');
            
            
            //save to Trail
            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                            VALUES ('{$dt}',2,9,'Code: {$product_code} \n Name: {$product_name} \n UOM: {$product_uom} \n Price: {$product_price} \n Status: {$product_status}','',$uid);";
            $trail_save = $mysqli->query($trail_query);
            //end of Trail
            
            break;
        
        case 7: //update status (1 -active; 2-enactive)
            $id = $_POST['id'];
            $status = $_POST['status_id'];
            
            
            
            if ($id){
                $sql = "UPDATE pos_product SET status_id={$status} WHERE id={$id};";
                $exec = $mysqli->query($sql);
                if ($exec){
                    
                    include('query_product.php');
                    
                    $sql .= " WHERE p.id={$id} ";
                    $sql .= " ORDER BY p.product_name;";
                    
                    include('pop_product_row.php');
                    
                    //save to Trail
                    $trail_action = $status_id == 1 ? 14 : 13;
                    $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                    VALUES ('{$dt}',2,{$trail_action},'{$code} - {$name}','',$uid);";
                    $trail_save = $mysqli->query($trail_query);
                    //end of Trail
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
            break;
        
        case 8: //get info for price
            $id = $_POST['id'];
            if ($id){
                $sql = "SELECT p.product_code as product_code,p.product_name as product_name,
                                p.price as price, u.uom as uom
                        FROM pos_product p
                        LEFT JOIN pos_uom u ON u.id=p.product_uom
                        WHERE p.id={$id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    $row=$exec->fetch_object();
                            
                    $product_code = $row->product_code;
                    $product_name = $row->product_name;
                    $price = number_format(floatval(trim($row->price).''),2,'.',',');
                    $product_uom = $row->uom;
                                                
                    echo $product_code . ":|:" . $product_name . ":|:" . $price . ":|:" . $product_uom;
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
            break;
        
        case 9://save price
            $id = $_POST['id'];
            $price = floatval(trim($_POST['price'] .''));
            
            if ($price){
                $sql = "UPDATE pos_product SET price={$price} WHERE id={$id};";
                $exec = $mysqli->query($sql);
                if ($exec){
                    $sql = "INSERT INTO pos_trail_price (product_id,price,dt_created,created_by)
                            VALUES({$id},{$price},'{$dt}',{$uid});";
                    $exec = $mysqli->query($sql);
                    if ($exec){
                        include('query_product.php');
                        
                        $sql .= " WHERE p.id={$id} ";
                        $sql .= " ORDER BY p.product_name;";
                        
                        include('pop_product_row.php');
                        
                        //save to Trail                        
                        $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                        VALUES ('{$dt}',2,11,'{$code} - {$name}','{$price}',$uid);";
                        $trail_save = $mysqli->query($trail_query);
                        //end of Trail
                    }else{
                        echo "Warning: Updated but you need to reload the page due to error below \n" . $mysqli->error;
                    }
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!-1";
            }
            break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
    
    $mysqli->close();
?>