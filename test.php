<?php
    include('connect.php');
    
    $sql = "select product_id, sum(qty + 1) as total from pos_sale where (status_id=1) group by product_id";
    
    $pop = $mysqli->query($sql);
    
    while($row=$pop->fetch_object()){
        $p_id = $row->product_id;
        $total = $row->total;
        
        echo $p_id . " " . $total . " <br />";
    }
    
    $mysqli->close();
?>