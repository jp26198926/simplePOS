<?php
    include('validate.php');
    include('connect.php');
	include('config.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //search
            $mysearch = $_POST['mysearch'];
            
            include('query_transaction.php');
           
            $sql .= " WHERE CONCAT_WS(' ',t.id,t.dt,t.discount_total,t.discount_qty,t.total,t.remarks,d.discount_type,u.lname,CONCAT(u.lname,', ',u.fname,' ',u.mname),s.status,LPAD(t.id,8,'0'), CONCAT(DATE_FORMAT(t.dt, '%y'),LPAD(t.id,8,'0'))) LIKE '%{$mysearch}%' ;";
            
            $_SESSION['transaction_sql'] = $sql;
            
            include('pop_transaction.php');
            
            break;
        
        case 2: //change status
            $id = $_POST['id'];           
            $status_id = $_POST['status_id'];
            $sql = "";
            
            if ($id){
                if ($status_id==1){
                    $sql = "UPDATE pos_transaction SET status_id={$status_id} WHERE id={$id};";
                }else{
                    $reason = $mysqli->real_escape_string(trim($_POST['reason'] . ''));                    
                    $sql = "UPDATE pos_transaction SET status_id={$status_id}, dt_cancelled='{$dt}', cancelled_by={$uid}, cancelled_reason='{$reason}' WHERE id={$id};";
                }
                
                $saveTran = $mysqli->query($sql);
                if ($saveTran){
                    $sql = "UPDATE pos_sale SET status_id={$status_id} WHERE tran_id={$id};";
                    
                    $saveSale = $mysqli->query($sql);
                    if ($saveSale){
                        include("query_transaction.php");
                        $sql .= " WHERE t.id={$id};";
                        
                        include("pop_transaction_row.php");
                    }else{
                        echo "Error: Transaction has been updated but some item sell items was not, Please inform MIG.";
                    }
                }else{
                    echo "Error: " . $mysqli->error;
                }
                
            }else{
                echo "Error: Critical Error Encountered!";
            }
            
            break;
                
        case 3: //get cancelled info
            $id = $_POST['id'];
            if ($id){
                $sql = "SELECT t.dt_cancelled as dt_cancelled, t.cancelled_reason as reason,
                                concat(u.lname,', ', u.fname,' ',u.mname) as cancelled_by
                        FROM pos_transaction t
                        LEFT JOIN pos_user u ON u.id=t.cancelled_by
                        WHERE t.id={$id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    $row=$exec->fetch_object();
                            
                    $dt_cancelled = $row->dt_cancelled;
                    $reason = $row->reason;
                    $cancelled_by = strtoupper(trim($row->cancelled_by . ''));
                                                
                    echo $dt_cancelled . ":~|~:" . $reason . ":~|~:" . $cancelled_by . ":~|~:";
                    
                    $sql = "SELECT s.qty as qty, s.current_price as price, s.discount_total as discount, s.total as total,
                                    CONCAT(p.product_code,' - ', p.product_name) as product
                            FROM pos_sale s
                            LEFT JOIN pos_product p ON p.id=s.product_id
                            WHERE s.tran_id={$id};";
                    $pop = $mysqli->query($sql);
                    $i = 0;
                    if ($pop){
                        $count = $pop->num_rows;
                        if ($count > 0){                            
                            while($rows=$pop->fetch_object()){
                                $i++;
                                $qty = $rows->qty;
                                $product = $rows->product;
                                $price = $rows->price;
                                $discount = $rows->discount;
                                $total = $rows->total;
                                
                                echo "<tr>";
                                echo "  <td>{$i}</td>";
                                echo "  <td align='center'>{$qty}</td>";
                                echo "  <td>{$product}</td>";
                                echo "  <td align='right'>{$price}</td>";
                                echo "  <td align='right'>{$discount}</td>";
                                echo "  <td align='right'>{$total}</td>";
                                echo "</tr>";
                            }
                        }else{
                            echo "<tr><td colspan='6' align='center'>No Item</td></tr>";
                        }
                    }else{
                        echo "<tr><td colspan='6' align='center'>" . $mysqli->error . "</td></tr>";
                    }
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
            break;
        
        case 4: //transaction details
            $tran_id = $_POST['id'];            
            
            if ($tran_id){
                //get transaction data
               
                $sql = "SELECT  t.dt as dt, CONCAT(DATE_FORMAT(t.dt, '%y'),LPAD(t.id,8,'0')) as receipt, t.subtotal as subtotal, t.discount_type as discount_type, t.discount_total as discount, t.discount_qty as discount_qty,
                                t.total as amount_due, t.tran_cash as cash, t.tran_change as tran_change, t.remarks as remarks,
                                t.gst_percent,
                                t.gst_value,
                                t.tax_base,
                                d.discount_type as discount_type_name,
                                CONCAT(u.lname,', ',u.fname,' ',u.mname) as cashier,
                                s.status as status
                        FROM ((pos_transaction t
                        LEFT JOIN pos_transaction_discount d ON d.id=t.discount_type)
                        LEFT JOIN pos_user u ON u.id=t.user_id)
                        LEFT JOIN pos_transaction_status s ON s.id=t.status_id
                        WHERE t.id={$tran_id};";                               
                        
                $exec = $mysqli->query($sql);
                
                if ($exec){
                        
                    $count = $exec->num_rows;
                    
                    if ($count > 0){
                        
                        $row = $exec->fetch_object();
                        
                        $tran_dt = $row->dt;                        
                        //$receipt_no = str_pad($tran_id,10,"0",STR_PAD_LEFT);
                        $receipt_no = $row->receipt;
                        $cashier = strtoupper($row->cashier);
                        $status = $row->status;
                        $remarks = $row->remarks;                        
                        
                        $subtotal = $row->subtotal;
                        $discount = $row->discount;
                        $discount_type = $row->discount_type_name;
                        $discount_qty = $row->discount_qty;
                        $amount_due = $row->amount_due;
                        $cash = $row->cash;
                        $change = $row->tran_change;
                        
                        echo $tran_dt . ":~|~:" . $receipt_no . ":~|~:" . $cashier . ":~|~:" . $status . ":~|~:" . $remarks . ":~|~:";
                        echo $subtotal . ":~|~:" . $discount . ":~|~:" . $discount_type . ":~|~:" . $discount_qty . ":~|~:";
                        echo $amount_due . ":~|~:" . $cash . ":~|~:" . $change;
                        
                        echo ":~:|:~:";
                        
                        //to be printed on receipt
                        $sql = "SELECT i.qty as qty, i.current_price as price, i.discount_total as discount, i.total as total,
                                        p.product_name as product,
                                        b.type as buyer_type
                                FROM (pos_sale i
                                LEFT JOIN pos_product p ON p.id=i.product_id)
                                LEFT JOIN pos_buyer b ON b.id=i.buyer_id
                                WHERE i.tran_id={$tran_id};";
                        
                        $pop = $mysqli->query($sql);
                        $i = 0;
                        
                        while($item=$pop->fetch_object()){
                            $i++;
                            $i_product=$item->product;
                            $i_qty=$item->qty;
                            //$i_buyer=strtoupper(substr($item->buyer_type . '',0,3));
                            $i_buyer=$item->buyer_type;
                            $i_price=$item->price;;
                            $i_discount=$item->discount;
                            $i_total=$item->total;
                                
                            echo "<tr>";
                            echo "  <td>{$i}</td>";
                            echo "  <td align='center'>{$i_qty}</td>";
                            echo "  <td>{$i_product}</td>";
                            echo "  <td align='center'>{$i_buyer}</td>";
                            echo "  <td align='right'>{$i_price}</td>";
                            echo "  <td align='right'>{$i_discount}</td>";
                            echo "  <td align='right'>{$i_total}</td>";
                            echo "</tr>";
                        }
                        
                                        
                        
                    }else{
                        echo "Error: Critical Error Encountered!";
                    }
                       
                }else{
                    echo "Error: " . $mysqli->error;
                }
                    
                
            }else{
                echo "Error: Critical Error Encountered";
            }
            
            break;
        
        case 5: //reprint receipt           
            $tran_id = $_POST['id'];
            //$receipt_no = str_pad($tran_id,10,"0",STR_PAD_LEFT);
            
            if ($tran_id){
                //get transaction data
               
                $sql = "SELECT t.dt as dt, CONCAT(DATE_FORMAT(t.dt, '%y'),LPAD(t.id,8,'0')) as receipt, t.subtotal as subtotal, t.discount_total as discount, t.total as amount_due, t.tran_cash as cash,
                                t.tran_change as tran_change,
                                CONCAT(c.fname, ' ', SUBSTR(c.lname,1,1)) as cashier,
								t.reference,
								pt.payment_type,
                                gst_percent,
                                gst_value,
                                tax_base
                        FROM pos_transaction t
                        LEFT JOIN pos_user c ON c.id=t.user_id
						LEFT JOIN pos_payment_type pt ON pt.id=t.payment_type_id
                        WHERE t.id={$tran_id};";                               
                        
                $exec = $mysqli->query($sql);
                
                if ($exec){
                        
                    $count = $exec->num_rows;
                    
                    if ($count > 0){
                        
                        $row = $exec->fetch_object();
                        $tran_dt = $row->dt;
                        $subtotal = $row->subtotal;
                        $discount = $row->discount;
                        $amount_due = $row->amount_due;
                        $cash = $row->cash;
                        $change = $row->tran_change;
                        $receipt_no = $row->receipt;
                        $cashier = strtoupper($row->cashier);
						$payment_type_label = $row->payment_type;
						$reference = $row->reference;
                        $gst_percent = $row->gst_percent;
                        $gst_value = $row->gst_value;
                        $tax_base = $row->tax_base;
						
                        // $gst = floatval($gst_percent/100);
                        // $divisor = 1 + $gst;
                        // $tax_base = floatval($amount_due) / $divisor; //ex: 75total / 1.10 <--this is 110% because we added 10% gst to 100%base price
                        // $gst_value = $tax_base * $gst;

						//$gst_value = (floatval($amount_due) * floatval($gst_percent/100));
                        
                        echo $receipt_no . ":~|~:" . $cashier . ":~|~:" . $tran_dt . ":~|~:"  ;
                        
                        //to be printed on receipt
                        $sql = "SELECT i.qty as qty, i.current_price as price, i.discount_total as discount, i.total as total,
                                        p.product_name as product,
                                        b.type as buyer_type
                                FROM (pos_sale i
                                LEFT JOIN pos_product p ON p.id=i.product_id)
                                LEFT JOIN pos_buyer b ON b.id=i.buyer_id
                                WHERE i.tran_id={$tran_id};";
                        
                        $pop = $mysqli->query($sql);
                        
                        while($item=$pop->fetch_object()){
                            $i_product=$item->product;
                            $i_qty=$item->qty;
                            $i_price=$item->price;;
                            $i_discount=$item->discount;
                            $i_total=$item->total;
                            
                            $i_buyer= strtoupper(substr($item->buyer_type . '',0,1));
                                
                            echo "<tr>";
                            echo "  <td align='left' colspan='4'>{$i_product} ({$i_buyer})</td>";
                            echo "  <td align='right'>{$i_total}</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "  <td align='right'>{$i_qty}</td>";
                            echo "  <td align='center'>@</td>";
                            echo "  <td align='left'>{$i_price}</td>";
                            //echo "  <td align='left'>Discount : {$i_discount}</td>";
                            echo "  <td></td>";
                            echo "</tr>";
                        }
                        
                        //subtotal
                        echo ":~|~:";
                        echo "<tr>";
                        echo "   <td align='right'>SUBTOTAL</td>";
                        echo "   <td align='right'>" . number_format($subtotal,2,'.',',') . "</td>";
                        echo "</tr>";
                        /*
                        echo "<tr>";
                        echo "   <td align='right'>DISCOUNT</td>";
                        echo "   <td align='right'>" . number_format($discount,2,'.',',') . "</td>";
                        echo "</tr>";
                        */
                        echo "<tr>";
                        echo "   <td align='right'><b>AMOUNT DUE</b></td>";
                        echo "   <td align='right'><b>" . number_format($amount_due,2,'.',',') . "</b></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "   <td align='right'>TENDER</td>";
                        echo "   <td align='right'>" . number_format($cash,2,'.',',') . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "   <td align='right'>CHANGE</td>";
                        echo "   <td align='right'>" . number_format($change,2,'.',',') . "</td>";
                        echo "</tr>";  

                        if ($show_gst){
                            echo "<tr>";
                            echo "  <td></td>";
                            echo "  <td><hr/></td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "   <td align='right'>TAX BASE</td>";
                            echo "   <td align='right'>" . number_format($tax_base, 2, '.', ',') . "</td>";
                            echo "</tr>";
                            echo "</tr>";
                            echo "   <td align='right'>GST ({$gst_percent} %)</td>";
                            echo "   <td align='right'>" . number_format($gst_value, 2, '.', ',') . "</td>";
                            echo "</tr>";
                        }

						echo "<tr>";
						echo "   <td align='right'>PMT TYPE</td>";
						echo "   <td align='right'>" . $payment_type_label . "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "   <td align='right'>PMT REF</td>";
						echo "   <td align='right'>" . $reference . "</td>";
						echo "</tr>";
                        
                    }else{
                        echo "Error: Critical Error Encountered!";
                    }
                       
                }else{
                    echo "Error: " . $mysqli->error;
                }
                    
                
            }else{
                echo "Error: Critical Error Encountered";
            }
            
            break;
        
        case 6: //advance search
            $receipt = $mysqli->real_escape_string(trim($_POST['receipt'] . ''));
            $cashier = $mysqli->real_escape_string(trim($_POST['cashier'] . ''));
            $dtFrom = $_POST['dtFrom'];
            $dtTo = $_POST['dtTo'];
            $status_id = $_POST['status'];
            
            include('query_transaction.php');
            
            $sql .= "WHERE CONCAT_WS(' ', t.id, LPAD(t.id,8,'0'), CONCAT(DATE_FORMAT(t.dt, '%y'),LPAD(t.id,8,'0'))) LIKE '%{$receipt}%' ";
            $sql .= "AND CONCAT(u.lname,', ',u.fname,' ',u.mname) LIKE '%{$cashier}%' ";
            
            if ($dtFrom){
                $sql .= "AND DATE(t.dt) >= '{$dtFrom}' ";
            }
            
            if ($dtTo){
                $sql .= "AND DATE(t.dt) <= '{$dtTo}' ";
            }
            
            if ($status_id){
                $sql .= "AND t.status_id = {$status_id} ";
            }
            
            $_SESSION['transaction_sql'] = $sql;
                        
            include('pop_transaction.php');
            
            break;
        
        default:
            echo "Error: Critical Error Encountered!";
    }
    
    $mysqli->close();
?>