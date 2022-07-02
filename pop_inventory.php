<?php
$pop = $mysqli->query($sql);
if ($pop) {
    $count = $pop->num_rows;
    if ($count > 0) {
        while ($row = $pop->fetch_object()) {
            $id = $row->id;
            $code = $row->product_code;
            $name = $row->product_name;

            $stock = floatval($row->stock);
            $sale = floatval($row->sale);

            $uom = $row->product_uom;
            $category = $row->category;
            $status_id = $row->status_id;
            $status = $row->status;

            $current_balance = $stock - $sale;

            $supplier_price = $row->supplier_price;

            $tr_id = "tr_" . $id;

            echo "<tr id='{$tr_id}'>";
            echo "   <td>{$code}</td>";
            echo "   <td>{$name}</td>";
            echo "   <td align='center'>{$uom}</td>";
            echo "   <td align='center'>{$category}</td>";
            echo "   <td align='center'>{$current_balance}</td>";
            echo "   <td align='right'>{$supplier_price}</td>";

            //get all prices from active buyer type
            $price_sql = "SELECT pp.price as price
                          FROM pos_price pp
                          LEFT JOIN pos_buyer pb ON pb.id = pp.buyer_id AND pb.status_id = 1
                          WHERE pp.product_id={$id} AND pb.status_id=1
                          ORDER BY pb.type;";
                                                          
            $price_pop = $mysqli->query($price_sql);
            
            if ($price_pop){
                $price_count = $price_pop->num_rows;
                
                if ($price_count > 0){
                    while($price_row = $price_pop->fetch_object()){  
                        $price_price = number_format($price_row->price,2,'.',',');
                                                    
                        echo "<td align='right'>{$price_price}</td>";
                    }                            
                }else{                    
                    echo "<td align='center'>No Price Yet</td>";
                }
            }else{
                echo  "<td align='center'>Error</td>";
            }


            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "   <td colspan='6' align='center'>No Record Found</td>";
        echo "</tr>";
    }
} else {
    echo "Error: " . $mysqli->error;
}