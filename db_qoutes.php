<?php
    include('connect.php');
    $sql = "SELECT qoutes,author FROM tbl_qoutes ORDER BY RAND() LIMIT 3;";
    $pop = $mysqli->query($sql);
    if ($pop){
        $data="";
        while($row=$pop->fetch_object()){
            $qoutes = $row->qoutes;
            $author = $row->author;
            
            if ($data){
                $data .= ":~:|:~:" . $qoutes . ":~|~:" . $author;
            }else{
                $data .= $qoutes . ":~|~:" . $author;
            }           
        }
        echo $data;
        
    }else{
        echo "Error: " . $mysqli->error;
    }
    
    $mysqli->close();
?>