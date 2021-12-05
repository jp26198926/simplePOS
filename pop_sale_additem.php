<?php
$pop = $mysqli->query($sql);
                            if ($pop){
                                $count = $pop->num_rows;
                                $all_total = 0.00;
                                $total = 0.00;
                                
                                if ($count > 0){
                                    
                                    while($rows=$pop->fetch_object()){
                                        $id = $rows->id;
                                        $p_code = $rows->p_code;
                                        $p_name = $rows->p_name;
                                        $buyer_type = strtoupper(substr($rows->buyer_type . '',0,1));
                                        $qty = $rows->qty;
                                        $current_price = $rows->current_price;
                                        $discount_type_id = $rows->discount_type_id;
                                        
                                        $discount_type = "None";
                                        $discount_qty = number_format(floatval("0.00"),2,'.',',');
                                        $discount_total = number_format(floatval("0.00"),2,'.',',');
                                        
                                        if ($discount_type_id > 0) {
                                            $discount_type = $rows->discount_type;
                                            $discount_qty = $rows->discount_qty;
                                            $discount_total = $rows->discount_total;
                                        }                                       
                                        
                                        
                                        $total = floatval($rows->total);
                                        
                                        $item_total = number_format($total,2,'.',',');
                                        
                                        $all_total += $total;
                                        
                                        $tr_id = "tr_" . $id;                
                
                                        echo "<tr id='{$tr_id}'>";
                                        echo "  <td><a href='#' id='{$id}' class='btn_sale_removeItem text-danger fa fa-remove fa-fw' title='Remove this Item' data-toggle='tooltip' style='padding:0px'></a></td>";
                                        echo "  <td>";                                        
                                        echo "      {$p_code} - {$p_name}";
                                        echo "  </td>";
                                        echo "  <td align='center'><a href='#' id='{$id}' class='btn_sale_itemqty' title='Click to update the value' data-toggle='tooltip'>{$qty}</a></td>";
                                        echo "  <td align='center'>{$buyer_type}</td>";
                                        echo "  <td align='right'>{$current_price}</td>";
                                        echo "  <td align='right'><a href='#' id='{$id}' class='btn_sale_itemdiscount' title='TYPE: {$discount_type} <br />VALUE: {$discount_qty} <br />TOTAL: {$discount_total} <br /><br />Click to update the value.' data-toggle='tooltip'>{$discount_total}</a></td>";
                                        echo "  <td align='right'>{$item_total}</td>";
                                        echo "</tr>";                                        
                                    }
                                    
                                    echo ":~|~:" . number_format($all_total,2,'.',',');
                                    echo ":~|~:" . $all_total; //without comman seperated
                                    echo ":~|~:" . $total;
                                    
                                }else{
                                    echo "<tr><td colspan='7' align='center'>No Product to Purchase Yet</td></tr>";
                                    
                                    echo ":~|~:" . number_format($all_total,2,'.',',');
                                    echo ":~|~:" . $all_total; //without comman seperated
                                    echo ":~|~:" . $total;
                                }
                            }else{
                                echo "Error: " . $mysqli->error;
                            }
?>