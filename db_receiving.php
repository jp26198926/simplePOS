<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //get product info by code
            $code = $mysqli->real_escape_string(trim($_POST['code'] . ''));
            
            if ($code){
                $sql = "SELECT p.id as id, p.product_name as product_name, p.status_id as status_id, u.uom as uom, s.status as status
                        FROM (pos_product p LEFT JOIN pos_uom u ON u.id=p.product_uom)
                        LEFT JOIN pos_product_status s ON s.id=p.status_id
                        WHERE p.product_code='{$code}';";
                $exec = $mysqli->query($sql);
                if ($exec){
                    $count = $exec->num_rows;
                    if ($count > 0){
                        $row=$exec->fetch_object();
                            
                        $id = $row->id;
                        $product_name = $row->product_name;
                        $status_id = $row->status_id;
                        $status = $row->status;
                        $uom = $row->uom;
                        
                        if ($status_id > 1){ //if product is not active
                            echo "Error: Product is currently {$status}";
                        }else{
                            echo $id . ":~|~:" . $product_name . ":~|~:" . $uom;                            
                        }
                        
                    }else{
                        echo "Error: Product Code not found!";
                    }
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
            
            break;
        
        case 2: //add new
            $product_id = $_POST['id'];
            $qty = floatval(trim($_POST['qty'] . ''));
            $supplier = $_POST['supplier'];
            
            if ($product_id && $supplier){
                if ($qty > 0){
                    $sql = "INSERT INTO pos_stock (dt, product_id, qty, supplier_id, received_by)
                            VALUES ('{$dt}',{$product_id},{$qty},{$supplier},{$uid});";
                                
                    $exec = $mysqli->query($sql);
                        
                    if ($exec){
                        
                        //save to  Trail
                        $trail_product_id = $mysqli->insert_id;
                        $trail_product = "SELECT s.qty, p.product_code, p.product_name
                                          FROM pos_stock s LEFT JOIN pos_product p ON p.id=s.product_id 
                                          WHERE s.id={$trail_product_id};";
                                          
                        $trail_product_pop = $mysqli->query($trail_product);
                        if ($trail_product_pop){
                            $trail_row = $trail_product_pop->fetch_object();
                            $p_code =  $trail_row->product_code;
                            $p_name = $trail_row->product_name;
                            $p_qty = $trail_row->qty;
                            
                            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                            VALUES ('{$dt}',3,10,'{$p_code} - {$p_name}','QTY: {$p_qty}',$uid);";
                            $trail_save = $mysqli->query($trail_query);
                        }
                       
                        //end of  Trail
                        
                        
                        include("query_receiving.php");
                        
                        $sql .= " WHERE s.dt = CURDATE() ";    
                        $sql .= " ORDER BY p.product_name;";
                                                                                                     
                        include ('pop_receiving.php'); 
                            
                    }else{
                        echo "Error: " . $mysqli->error;
                    }                                       
                }else{
                    echo  "Error: Quantity must be greater than 0."; 
                }            
            }else{
                echo  "Error: Fields with red asterisk are required!";    
            }
                
            break;
        
        case 3: //get receiving info
            $id = $_POST['id'];
            if ($id){
                                
                $sql = "SELECT  s.dt as dt, s.qty as qty, s.supplier_id as supplier,
                                p.product_code as product_code, p.product_name as product_name,
                                u.uom as uom
                        FROM (pos_stock s
                        LEFT JOIN (pos_product p LEFT JOIN pos_uom as u ON u.id=p.product_uom) ON p.id=s.product_id)
                        WHERE s.id={$id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    $row=$exec->fetch_object();
                    
                    $dt = $row->dt;
                    $product_code = $row->product_code;
                    $product_name = $row->product_name;
                    $uom = $row->uom;
                    $qty = $row->qty;
                    $supplier = $row->supplier;
                                                
                    echo $dt . ":~|~:" . $product_code . ":~|~:" . $product_name . ":~|~:" . $uom . ":~|~:" . $qty . ":~|~:" . $supplier;
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
                    
            break;
        
        case 4: //modify
            $id = $_POST['id'];
            $dt = $_POST['dt'];
            $qty = floatval(trim($_POST['qty']));
            $supplier = $_POST['supplier'];
            
                    
            $sql = "UPDATE pos_stock SET  dt='{$dt}', qty={$qty}, supplier_id={$supplier} WHERE id={$id};";
            
            $exec = $mysqli->query($sql);
            if ($exec){
                include("query_receiving.php");
                
                $sql .= " WHERE s.id={$id} ";        
                $sql .= " ORDER BY s.dt;";
                                                                                                 
                //include ('pop_product.php');
                include ('pop_receiving_row.php');
                
                //save to  Trail            
                $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                            VALUES ('{$dt}',3,12,'{$code} - {$p_name}','QTY: {$qty}',$uid);";
                $trail_save = $mysqli->query($trail_query);                      
                //end of  Trail
                       
            }else{
                echo "Error: " . $mysqli->error;
            }
            break;
                
        
        
        case 6: //advance search
            $product_code = $mysqli->real_escape_string(trim($_POST['product_code'] . ''));
            $product_name = $mysqli->real_escape_string(trim($_POST['product_name']).'');
            $dt_from = $_POST['dt_from'];
            $dt_to = $_POST['dt_to'];
            $supplier = $mysqli->real_escape_string(trim($_POST['supplier']).'');
            
            include('query_receiving.php');
            
            $sql .= " WHERE p.product_code LIKE '%{$product_code}%' AND p.product_name LIKE '%{$product_name}%' ";
            
            if ($dt_from){
                $sql .= " AND s.dt >= '{$dt_from}' ";
            }
            
            if ($dt_to){
                $sql .= " AND s.dt <= '{$dt_to}' ";
            }
            
            if ($supplier){
                $sql .= " AND su.supplier LIKE '%{$supplier}%' ";
            }            
                                    
            $sql .= " ORDER BY s.dt;";
            
            include('pop_receiving.php');
            
            //save to  Trail            
            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                            VALUES ('{$dt}',3,9,'Code: {$product_code} \n Name: {$p_name} \n From: {$dt_from} \n To: {$dt_to} \n Supplier: {$supplier}','',$uid);";
            $trail_save = $mysqli->query($trail_query);                      
            //end of  Trail
            
            break;
        
        case 7: //update status (1 -confirmed; 2-cancelled)
            $id = $_POST['id'];
            $status = $_POST['status'];
            
            
            if ($id && $status){
                
                    $sql = '';
                    $reason;
                    
                    if ($status==2){ //cancelled
                        $reason = $mysqli->real_escape_string(trim($_POST['reason'] . ''));
                        if ($reason){
                            $sql = "UPDATE pos_stock SET status_id={$status}, dt_cancelled='{$dt}', cancelled_by={$uid}, cancelled_reason='{$reason}'
                                WHERE id={$id};";
                        }else{
                            echo "Error: Please specify the reason for cancellation!";
                            exit();
                        }                        
                        
                    }else{
                        $sql = "UPDATE pos_stock SET status_id={$status} WHERE id={$id};";
                    }
                    
                    $exec = $mysqli->query($sql);
                    if ($exec){
                        include('query_receiving.php');
                        
                        $sql .= " WHERE s.id={$id} ";
                        $sql .= " ORDER BY s.dt;";
                        
                        include('pop_receiving_row.php');
                        
                        //save to  Trail                        
                        if ($status_id == 1){
                            $trail_action = 15;
                            $reason = 'QTY: ' . $qty;
                        }else{
                            $trail_action = 2;
                        }
                        $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                        VALUES ('{$dt}',3,{$trail_action},'{$code} - {$p_name}','{$reason}',{$uid});";
                        $trail_save = $mysqli->query($trail_query);                      
                        //end of  Trail
                        
                    }else{
                        echo "Error: " . $mysqli->error;
                    } 
                
            }else{
                echo "Error: Critical Error Encountered!";
            }
            break;
        
        case 8: //get cancelled info
            $id = $_POST['id'];
            if ($id){
                $sql = "SELECT s.dt_cancelled as dt_cancelled, s.cancelled_reason as reason,
                                concat(u.lname,', ', u.fname,' ',u.mname) as cancelled_by
                        FROM pos_stock s
                        LEFT JOIN pos_user u ON u.id=s.cancelled_by
                        WHERE s.id={$id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    $row=$exec->fetch_object();
                            
                    $dt_cancelled = $row->dt_cancelled;
                    $reason = $row->reason;
                    $cancelled_by = strtoupper(trim($row->cancelled_by . ''));
                                                
                    echo $dt_cancelled . ":~|~:" . $reason . ":~|~:" . $cancelled_by;
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
            break;
        
        case 9: //search
            $mysearch = $mysqli->real_escape_string(trim($_POST['mysearch'] . ''));
                        
            include('query_receiving.php');
            
            $sql .= " WHERE concat_ws(' ',p.product_code,p.product_name,s.dt,s.qty,u.uom,su.supplier,st.status,r.lname,r.fname,r.mname) LIKE '%{$mysearch}%' ";
                    
            $sql .= " ORDER BY s.dt;";
            
            include('pop_receiving.php');
            
            //save to  Trail            
            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                            VALUES ('{$dt}',3,8,'{$mysearch}','',$uid);";
            $trail_save = $mysqli->query($trail_query);                      
            //end of  Trail
            
            break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
    
    $mysqli->close();
?>