<?php
    $pop = $mysqli->query($sql);
    if ($pop){
        $count = $pop->num_rows;
        if ($count > 0){
            while($row=$pop->fetch_object()){
                $id = $row->id;
                $dt = $row->dt;
                $code = $row->product_code;
                $p_name = $row->product_name;
                $qty = number_format(floatval($row->qty),2,'.',',');
                $price = number_format(floatval($row->price),2,'.',',');
                $total = number_format(floatval($row->total),2,'.',',');
                $uom = $row->product_uom;
                $supplier = $row->supplier;
                $received_by = strtoupper($row->received_by);
                $status = $row->status;
                $status_id = $row->status_id;                
                                                
                //echo "<tr id='{$tr_id}'>";
                
                echo "   <td class='text-center'>";
                
                if ($status_id==1){
                    echo "    <a id='{$id}' class='btn_receiving_modify btn btn-info btn-xs fa fa-pencil' title='Modify' ></a>";
                    echo "    <a id='{$id}' class='btn_receiving_cancel btn btn-danger btn-xs fa fa-times' title='Cancel' ></a>";
                }else{
                    echo "    <a id='{$id}' class='btn_receiving_confirm btn btn-warning btn-xs fa fa-reply' title='Confirm' ></a>";
                }
                
                echo "   </td>";
                echo "   <td>{$dt}</td>";
                echo "   <td>{$code}</td>";
                echo "   <td>{$p_name}</td>";
                echo "   <td align='center'>{$qty}</td>";
                echo "   <td align='center'>{$uom}</td>";
                echo "   <td align='right'>{$price}</td>";
                echo "   <td align='right'>{$total}</td>";
                echo "   <td>{$supplier}</td>";
                echo "   <td>{$received_by}</td>";
                
                if ($status_id==2){ //cancelled
                    echo "   <td  align='center'><a href='#' id='{$id}' class='receiving_cancelled_info' title='Show cancelled datails'>{$status}</a></td>";
                }else{
                    echo "   <td align='center'>{$status}</td>";
                }
                
                
            }
        }else{
            echo "<tr>";
            echo "   <td colspan='11' align='center'>No Record Found</td>";
            echo "</tr>";
        }
    }else{
        echo "Error: " . $mysqli->error;
    }
?>