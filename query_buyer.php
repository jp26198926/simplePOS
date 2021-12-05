<?php
    
    $sql = "SELECT
                b.id as id, b.type as type, b.status_id as status_id,
                s.status as status
            FROM pos_buyer b
            LEFT JOIN pos_buyer_status s ON s.id=b.status_id
            ";

?>