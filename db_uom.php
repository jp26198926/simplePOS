<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //search
            $mysearch = $_POST['mysearch'];
            
            include('query_uom.php');
            
            $sql .= " WHERE concat_ws(' ',uom,description) LIKE '%{$mysearch}%' ORDER BY uom;";
            
            include('pop_uom.php');
            
            //save to  Trail
            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                            VALUES ('{$dt}',4,8,'{$mysearch}','',$uid);";
            $trail_save = $mysqli->query($trail_query);
            //end of Trail
            
            break;
        
        case 2: //add new
            $uom = $mysqli->real_escape_string(trim($_POST['abbrevation'] . ''));
            $description = $mysqli->real_escape_string(trim($_POST['description']).'');
            
            if ($uom && $description){
                                                        
                $sql = "INSERT INTO pos_uom (uom, description)
                        VALUES ('{$uom}','{$description}');";
                            
                $exec = $mysqli->query($sql);
                    
                if ($exec){
                    //save to Trail
                    $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                    VALUES ('{$dt}',4,10,'{$uom} - {$description}','',$uid);";
                    $trail_save = $mysqli->query($trail_query);
                    //end of  Trail
                    
                    include("query_uom.php");
                        
                    $sql .= " ORDER BY uom;";
                                                                                                 
                    include ('pop_uom.php'); 
                        
                }else{
                    echo "Error: " . $mysqli->error;
                }                    
            
            }else{
                echo  "Error: Fields with red asterisk are required!";    
            }
                
            break;
        
        case 3: //modify
            $id = $_POST['id'];
            $uom = $mysqli->real_escape_string(trim($_POST['abbrevation'] . ''));
            $description = $mysqli->real_escape_string(trim($_POST['description']).'');            
                    
            $sql = "UPDATE pos_uom SET  uom='{$uom}', description='{$description}' WHERE id={$id};";
            
            $exec = $mysqli->query($sql);
            if ($exec){
                //save to Trail
                $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                    VALUES ('{$dt}',4,12,'{$uom} - {$description}','',$uid);";
                $trail_save = $mysqli->query($trail_query);
                //end of  Trail
                
                include("query_uom.php");
                        
                $sql .= " ORDER BY uom;";
                                                                                                 
                include ('pop_uom.php');                                         
                       
            }else{
                echo "Error: " . $mysqli->error;
            }
            break;
                
        case 4: //get info
            $id = $_POST['id'];
            if ($id){
                $sql = "SELECT uom,description FROM pos_uom WHERE id={$id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    $row=$exec->fetch_object();
                            
                    $uom = $row->uom;
                    $description = $row->description;                    
                                                
                    echo $uom . ":|:" . $description;
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
                    
            break;
        
        case 6: //advance search
            $uom = $mysqli->real_escape_string(trim($_POST['abbrevation'] . ''));
            $description = $mysqli->real_escape_string(trim($_POST['description']).'');
            
            //save to Trail
            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                            VALUES ('{$dt}',4,9,'UOM: {$uom} \n Description: {$description}','',$uid);";
            $trail_save = $mysqli->query($trail_query);
            //end of  Trail
            
            include('query_uom.php');
            
            $sql .= " WHERE uom LIKE '%{$uom}%' AND description LIKE '%{$description}%' ORDER BY uom;";
            
            include('pop_uom.php');
            
            
            
            break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
?>