<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //search
            $mysearch = $_POST['mysearch'];
            
            include('query_user.php');
            
            $sql .= " WHERE concat_ws(' ',u.username,u.fname,u.lname,u.mname,d.dept_name,a.access_details,s.status) LIKE '%{$mysearch}%' ORDER BY u.username;";
            
            include('pop_user.php');
            
            break;
        
        case 2: //add new
            $username = $mysqli->real_escape_string(trim($_POST['username'] . ''));
            $access = $_POST['access'];
            $password = $mysqli->real_escape_string(trim($_POST['pass']));
            $repassword = $mysqli->real_escape_string(trim($_POST['repass']));
            $fname = $mysqli->real_escape_string(trim($_POST['fname']));
            $lname = $mysqli->real_escape_string(trim($_POST['lname']));
            $mname = $mysqli->real_escape_string(trim($_POST['mname']));
            $email = $mysqli->real_escape_string(trim($_POST['email']));
            $dept = $_POST['dept'];
            
            if ($username && $access && $password && $repassword && $fname && $lname && $dept){
                if (strcmp($password,$repassword)==0){
                    $options = ['cost' => 12];
                    $hash_pass =  password_hash($password, PASSWORD_BCRYPT, $options);
                                        
                    $sql = "INSERT INTO pos_user (username,password,lname,fname,mname,dept_id,email,access_id,status_id,added_by,date_added)
                            VALUES ('{$username}','{$hash_pass}','{$lname}','{$fname}','{$mname}',{$dept},'{$email}',{$access},1,{$uid},'{$dt}');";
                            
                    $exec = $mysqli->query($sql);
                    
                    if ($exec){
                        include("query_user.php");
                        
                        $sql .= " ORDER BY u.username;";
                                                                                                 
                        include ('pop_user.php'); 
                        
                    }else{
                        echo "Error: " . $mysqli->error;
                    }
                    
                }else{
                    echo "Error: Password does not match!";
                }
            }else{
                echo  "Error: Fields with red asterisk are required!";    
            }
                
            break;
        
        case 3: //modify
            $id = $_POST['id'];
            $username = $mysqli->real_escape_string(trim($_POST['username'] . ''));
            $fname = $mysqli->real_escape_string(trim($_POST['fname']).'');
            $lname = $mysqli->real_escape_string(trim($_POST['lname']));
            $mname = $mysqli->real_escape_string(trim($_POST['mname']));
            $dept_id = $_POST['dept'];
            $email = $mysqli->real_escape_string(trim($_POST['email']));
            $access_id = $_POST['access'];
                    
            $sql = "UPDATE pos_user SET  username='{$username}',fname='{$fname}',
                                        lname='{$lname}',mname='{$mname}',dept_id={$dept_id},
                                        email='{$email}',access_id={$access_id}
                    WHERE id={$id};";
            $exec = $mysqli->query($sql);
            if ($exec){
                include("query_user.php");
                        
                $sql .= " ORDER BY u.username;";
                                                                                                 
                include ('pop_user.php');                                         
                       
            }else{
                echo "Error: " . $mysqli->error;
            }
            break;
                
        case 4: //get info
            $id = $_POST['id'];
            if ($id){
                $sql = "SELECT username,fname,lname,mname,dept_id,email,access_id FROM pos_user WHERE id={$id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    $row=$exec->fetch_object();
                            
                    $username = $row->username;
                    $fname = $row->fname;
                    $lname = $row->lname;
                    $mname = $row->mname;
                    $dept_id = $row->dept_id;
                    $email = $row->email;
                    $access_id = $row->access_id;
                                                
                    echo $username . ":|:" . $fname . ":|:" . $lname . ":|:" . $mname . ":|:" . $dept_id . ":|:" . $email . ":|:" . $access_id;
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
                    
            break;
        
        case 5: //changepass
            $id = $_POST['id'];
            $password = $_POST['pass'];
            $repassword = $_POST['repass'];
            
            if ($id && $password && $repassword){
                if (strcmp($password,$repassword)==0){
                    $options = ['cost' => 12];
                    $hash_pass =  password_hash($password, PASSWORD_BCRYPT, $options);
                    
                    $sql = "UPDATE pos_user SET password='{$hash_pass}' WHERE id={$id};";
                    
                    $exec = $mysqli->query($sql);
                    
                    if ($exec){
                        include("query_user.php");
                        
                        $sql .= " ORDER BY u.username;";
                                                                                                 
                        include ('pop_user.php'); 
                        
                    }else{
                        echo "Error: " . $mysqli->error;
                    }
                }else{
                    echo "Error: Password does not matched!";
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
            break;
        
        case 6: //update status; 1-active, 2-inactive
            $id =  $_POST['id'];
            $status_id = $_POST['status'];
            
            if ($id){
                $sql = "UPDATE pos_user SET status_id={$status_id} WHERE id={$id};";
                $save = $mysqli->query($sql);
                if ($save){
                    include("query_user.php");
                        
                    $sql .= " ORDER BY u.username;";
                                                                                                 
                    include ('pop_user.php'); 
                    
                }else{
                    echo $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
            break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
?>