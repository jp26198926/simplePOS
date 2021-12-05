<?php

    $pop = $mysqli->query($sql);
    $total = 0;
    if ($pop){
        $count = $pop->num_rows;
            
        if ($count > 0){                
            
            while($row=$pop->fetch_object()){
            
                $id = $row->id;
                $tran_id = $row->tran_id;
                //$receipt = str_pad($row->tran_id, 10,"0", STR_PAD_LEFT);
                $receipt = $row->receipt;
                
                $dt_sale = $row->dt;
                $product_code = $row->product_code;
                $product_name = $row->product_name;
                $uom = $row->uom;
                $qty = $row->qty;
                $buyer_type = strtoupper(substr($row->buyer_type . '',0,3));
                $price = number_format(floatval($row->price) ,2 ,'.' ,',');
                
                $discount_type = $row->discount_type;
                $discount_type_word = $row->discount_type_word ? $row->discount_type_word : "No Discount";
                $discount_qty = number_format(floatval($row->discount_qty) ,2 ,'.' ,',');           
                $discount_total = number_format(floatval($row->discount_total) ,2 ,'.' ,',');
                
                $total = number_format(floatval($row->total) ,2 ,'.' ,',');
                
                $t_total = floatval($row->total);
                $t_taxbase = $t_total / 1.1;
                $t_gst = $t_taxbase * 0.1;
                
                $taxbase = number_format(($t_taxbase) ,2 ,'.' ,',');
                $gst = number_format(($t_gst) ,2 ,'.' ,',');
                
                
                $status_id = $row->status_id;                
                $status = $row->status;
                
                $tr_id = "tr_" . $id;  
                
                if ($status_id==1){
                    echo "<tr id='{$tr_id}'>";
                }else{
                    echo "<tr id='{$tr_id}' class='danger'>";
                }
                                
                echo "<td>{$dt_sale}</td>";
                echo "<td><a href='#' id='{$tran_id}' class='btn_transaction_details' >{$receipt}</a></td>";
                echo "<td>{$product_code}</td>";
                echo "<td>{$product_name}</td>";
                echo "<td align='center'>{$qty}</td>";
                echo "<td align='center'>{$uom}</td>";
                echo "<td align='center'>{$buyer_type}</td>";
                echo "<td align='right'>{$price}</td>";
                
                /*
                echo "<td align='center'>{$discount_type_word}</td>";
                echo "<td align='center'>{$discount_qty}</td>";
                echo "<td align='right'>{$discount_total}</td>";
                */
                
                echo "<td align='right'>{$total}</td>";
                echo "<td align='right'>{$taxbase}</td>";
                echo "<td align='right'>{$gst}</td>";
                //if ($status_id==2){
                //    echo "<td><a id='{$id}' href='#' class='transaction_cancelled_info' data-toggle='popover'  data-content='Show Info.'>{$status}</a></td>";
                //}else{
                echo "<td>{$status}</td>";
                //}
                
                
                echo "</tr>";
            }           
        }else{
            echo "<tr><td colspan='12' align='center'>No Record To Display</td></tr>";
        } 
        
        //echo ":~|~:" . number_format($total,2,'.',',');
    }else{
        echo "Error: " . $mysqli->error;
    }
?>