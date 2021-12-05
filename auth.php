<?php
    //date_default_timezone_set("Asia/Manila");
    date_default_timezone_set("Pacific/Port_Moresby");
    
    include ('connect.php');
    
    $uname = $mysqli->real_escape_string($_POST['uname']);
    $upass = $mysqli->real_escape_string($_POST['upass']);
    $local_ip = $_POST['local_ip'];
    $dt = date('Y-m-d H:i:s');
    
    $sql = "SELECT * FROM pos_user WHERE username='{$uname}';";
    
    $auth = $mysqli->query($sql);
    
    if ($auth){
        $num_result = $auth->num_rows;
        if ($num_result){
            $row = $auth->fetch_object();
            $dbpass=$row->password;
            $dbuname=$row->username;
            
            if (!strcmp($dbuname,$uname)){                
            
                if (password_verify($upass,$dbpass)){
                    $uid=$row->id;
                    $ufullname=ucwords($row->fname) . ' ' . ucwords($row->lname);
                    $ufname=ucwords($row->fname);
                    $ulname=ucwords($row->lname);
                    $udept=$row->dept_id;
                    $uaccess=$row->access_id;
                    
                    session_start();
                    $_SESSION['uid']=$uid;
                    $_SESSION['ufullname']=$ufullname;
                    $_SESSION['ufname']=$ufname;
                    $_SESSION['ulname']=$ulname;
                    $_SESSION['udept']=$udept;
                    $_SESSION['uaccess']=$uaccess;
                    
                    echo "{$udept}:|:{$uaccess}";
                    
                    $log_sql = "INSERT INTO pos_trail_login (dt,user_id,local_ip)
                                VALUES ('{$dt}',{$uid},'{$local_ip}')";
                    $save_log = $mysqli->query($log_sql);                    
                    
                }else{
                    echo "error:|";
                }
            }else{
                echo "error:| " . strcmp($dbuname,$uname). $dbuname . $uname;
            }
            
        }else{
            echo "error:|";
        }
    }else{
        echo "error:| " . $mysqli->error;
    }
    
    $mysqli->close();
    
    //$options = [
    //    'cost' => 12,
    //];
    
    //$pass =  password_hash($upass, PASSWORD_BCRYPT, $options);
    //echo $pass;
    /*if (password_verify($upass,$pass)){
        echo "valid";
    }else{
        echo "failed";
    }*/
    
?>