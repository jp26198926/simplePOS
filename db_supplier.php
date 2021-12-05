<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //search
            $mysearch = $_POST['mysearch'];
            
            include('query_supplier.php');
            
            $sql .= " WHERE concat_ws(' ',supplier,description) LIKE '%{$mysearch}%' ORDER BY supplier;";
            
            include('pop_supplier.php');
            
            //save to  Trail
            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                            VALUES ('{$dt}',5,8,'{$mysearch}','',$uid);";
            $trail_save = $mysqli->query($trail_query);
            //end of Trail
            
            break;
        
        case 2: //add new
            $supplier = $mysqli->real_escape_string(trim($_POST['supplier'] . ''));
            $description = $mysqli->real_escape_string(trim($_POST['description']).'');
            
            if ($supplier && $description){
                                                        
                $sql = "INSERT INTO pos_supplier (supplier, description)
                        VALUES ('{$supplier}','{$description}');";
                            
                $exec = $mysqli->query($sql);
                    
                if ($exec){
                    
                    //save to Trail
                    $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                    VALUES ('{$dt}',4,10,'{$supplier}','',$uid);";
                    $trail_save = $mysqli->query($trail_query);
                    //end of  Trail
                    
                    include("query_supplier.php");
                        
                    $sql .= " ORDER BY supplier;";
                                                                                                 
                    include ('pop_supplier.php'); 
                        
                }else{
                    echo "Error: " . $mysqli->error;
                }                    
            
            }else{
                echo  "Error: Fields with red asterisk are required!";    
            }
                
            break;
        
        case 3: //modify
            $id = $_POST['id'];
            $supplier = $mysqli->real_escape_string(trim($_POST['supplier'] . ''));
            $description = $mysqli->real_escape_string(trim($_POST['description']).'');            
                    
            $sql = "UPDATE pos_supplier SET  supplier='{$supplier}', description='{$description}' WHERE id={$id};";
            
            $exec = $mysqli->query($sql);
            if ($exec){
                //save to Trail
                $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                    VALUES ('{$dt}',4,12,'{$supplier}','',$uid);";
                $trail_save = $mysqli->query($trail_query);
                //end of  Trail
                
                include("query_supplier.php");
                        
                $sql .= " ORDER BY supplier;";
                                                                                                 
                include ('pop_supplier.php');                                         
                       
            }else{
                echo "Error: " . $mysqli->error;
            }
            break;
                
        case 4: //get info
            $id = $_POST['id'];
            if ($id){
                $sql = "SELECT supplier,description FROM pos_supplier WHERE id={$id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    $row=$exec->fetch_object();
                            
                    $supplier = $row->supplier;
                    $description = $row->description;                    
                                                
                    echo $supplier . ":|:" . $description;
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
                    
            break;
        
        case 6: //advance search
            $supplier = $mysqli->real_escape_string(trim($_POST['supplier'] . ''));
            $description = $mysqli->real_escape_string(trim($_POST['description']).'');
            
            //save to Trail
            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                            VALUES ('{$dt}',4,9,'Supplier: {$supplier} \n Description: {$description}','',$uid);";
            $trail_save = $mysqli->query($trail_query);
            //end of  Trail
            
            
            include('query_supplier.php');
            
            $sql .= " WHERE supplier LIKE '%{$supplier}%' AND description LIKE '%{$description}%' ORDER BY supplier;";
            
            include('pop_supplier.php');
            
            
            
            break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
?>