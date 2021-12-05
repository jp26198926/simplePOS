<?php
    include('validate.php');
    include('connect.php');    
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //login trail
            $mysearch = $_POST['mysearch'];
            
            include('query_trail_login.php');
            $sql .= " WHERE CONCAT_WS(' ', l.dt, l.local_ip, l.public_ip, l.computer_name, u.username, u.lname, u.fname, u.mname) LIKE '%{$mysearch}%';";
            
            include('pop_trail_login.php');
            
            break;        
        
        case 2: //transaction trail
            $mysearch = $_POST['mysearch'];
            
            include('query_trail_transaction.php');
            $sql .= " WHERE CONCAT_WS(' ', t.dt, m.module_name, a.action_name, t.particular, t.remarks, u.lname, u.fname, u.mname) LIKE '%{$mysearch}%';";
            
            include('pop_trail_transaction.php');
            
            break;
        
        default:
            echo "Error";
    }
    
    $mysqli->close();
?>