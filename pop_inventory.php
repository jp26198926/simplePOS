<?php
    $pop = $mysqli->query($sql);
    if ($pop){
        $count = $pop->num_rows;
        if ($count > 0){
            while($row=$pop->fetch_object()){
                $id = $row->id;
                $code = $row->product_code;
                $name = $row->product_name;
               
                $stock = floatval($row->stock);
                $sale = floatval($row->sale);

                $uom = $row->product_uom;               
                $status_id = $row->status_id;
                $status = $row->status;
                
                $current_balance = $stock - $sale;
                
                $tr_id = "tr_" . $id;                
                
                echo "<tr id='{$tr_id}'>";               
                echo "   <td>{$code}</td>";
                echo "   <td>{$name}</td>";
                echo "   <td align='center'>{$uom}</td>";
                echo "   <td align='center'>{$current_balance}</td>";
                              
                echo "</tr>";
            }
        }else{
            echo "<tr>";
            echo "   <td colspan='6' align='center'>No Record Found</td>";
            echo "</tr>";
        }
    }else{
        echo "Error: " . $mysqli->error;
    }
?>