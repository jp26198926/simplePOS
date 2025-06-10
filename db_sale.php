<?php
include('validate.php');
include('connect.php');
include('config.php');

$action = $_POST['action'];
$station_id = isset($_POST['station_id']) ? intval($_POST['station_id']) : 0; // Ensure station_id is an integer

switch ($action) {
    case 1: //search code
        $qty = floatval(trim($_POST['qty'] . ''));
        $code = trim($_POST['item_code'] . ''); // No mysqli_real_escape_string needed with prepared statements
        $buyer_type = intval($_POST['buyer_type']);

        if ($qty && $code) {
            $sql_select_product = "SELECT p.id as product_id, COALESCE(r.price,'0.00') as price,
                        p.gst_type_id, g.gst_code, g.gst_type
                        FROM pos_product p
                        LEFT JOIN pos_price r ON r.product_id=p.id AND r.buyer_id=?
                        LEFT JOIN pos_gst_type g ON g.id=p.gst_type_id
                        WHERE p.product_code=?;";
            
            $stmt_select_product = $mysqli->prepare($sql_select_product);
            if (!$stmt_select_product) {
                echo "Error preparing statement (select product): " . $mysqli->error;
                break;
            }
            $stmt_select_product->bind_param("is", $buyer_type, $code);
            
            if ($stmt_select_product->execute()) {
                $result = $stmt_select_product->get_result();
                $product_count = $result->num_rows;
                if ($product_count > 0) {
                    $row = $result->fetch_object();

                    $product_id = $row->product_id;                
                    $price = floatval($row->price);
                    $gst_type_id = $row->gst_type_id;
                    $gst_code = $row->gst_code;
                    $gst_type = $row->gst_type;

                    //gst computation 2025-06-01
                    $gst = floatval($gst_percent/100);
                    $tax_base = 0;
                    $gst_value = 0;
                    $total = 0;

                    $initial_total = $qty * $price;

                    switch(intval($gst_type_id)){
                        case 1: //inclusive (I)                            
                            $divisor = 1 + $gst;
                            $tax_base = floatval($initial_total) / $divisor;
                            $gst_value = $tax_base * $gst;
                            $total = $initial_total;
                            break;
                        
                        case 2: //exclusive (E)
                            $tax_base = $initial_total;
                            $gst_value = $tax_base * $gst;
                            $total = $initial_total + $gst_value;
                            break;
                        
                        case 3: //Exempt (X)
                            $total = $initial_total;
                    }

                    //save to temp
                    $sql_insert_temp = "INSERT INTO pos_sale_temp (
                                    product_id,qty,buyer_id,current_price,total,station_id, 
                                    gst_type_id, gst_code, gst_type, gst_percent, tax_base, gst_value
                                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
                    
                    $stmt_insert_temp = $mysqli->prepare($sql_insert_temp);
                    if (!$stmt_insert_temp) {
                        echo "Error preparing statement (insert temp): " . $mysqli->error;
                    } else {
                        $stmt_insert_temp->bind_param("ididdiisdsdd", $product_id, $qty, $buyer_type, $price, $total, $station_id, $gst_type_id, $gst_code, $gst_type, $gst_percent, $tax_base, $gst_value);
                        if ($stmt_insert_temp->execute()) {
                            //populate
                            // Note: The following includes build SQL dynamically.
                            // $station_id is confirmed as an integer.
                            include('query_sale_additem.php');
                            $sql .= " WHERE t.station_id=" . $station_id . " ORDER BY t.id DESC;";
                            include('pop_sale_additem.php');
                        } else {
                            echo "Error: " . $stmt_insert_temp->error;
                        }
                        $stmt_insert_temp->close();
                    }
                } else {
                    echo "Error: Invalid Product Code!";
                }
                $result->free();
            } else {
                echo "Error: " . $stmt_select_product->error;
            }
            $stmt_select_product->close();
        } else {
            echo "Error: Invalid QTY or Item Code!";
        }
        break;

    case 2: //pos temp
        $sql_count_temp = "SELECT count(*) as count FROM pos_sale_temp WHERE station_id=?;";
        $stmt_count_temp = $mysqli->prepare($sql_count_temp);
        if (!$stmt_count_temp) {
            echo "Error preparing statement (count temp): " . $mysqli->error;
            break;
        }
        $stmt_count_temp->bind_param("i", $station_id);
        if ($stmt_count_temp->execute()) {
            $result = $stmt_count_temp->get_result();
            $row = $result->fetch_object();
            $count = $row->count;
            echo $count;
            $result->free();
        } else {
            echo "Error: Critical Error Encountered! " . $stmt_count_temp->error;
        }
        $stmt_count_temp->close();
        break;

    case 3: //pop temp record
        // Note: The following includes build SQL dynamically.
        // $station_id is confirmed as an integer.
        include('query_sale_additem.php');
        $sql .= " WHERE t.station_id=" . $station_id . " ORDER BY t.id DESC;";
        include('pop_sale_additem.php');
        break;

    case 4: //delete all data from temp db
        $sql_delete_all = "DELETE FROM pos_sale_temp WHERE station_id = ?;";
        $stmt_delete_all = $mysqli->prepare($sql_delete_all);
        if (!$stmt_delete_all) {
            echo "Error preparing statement (delete all temp): " . $mysqli->error;
            break;
        }
        $stmt_delete_all->bind_param("i", $station_id);
        if ($stmt_delete_all->execute()) {
            // Note: The following includes build SQL dynamically.
            // $station_id is confirmed as an integer.
            include('query_sale_additem.php');
            $sql .= " WHERE t.station_id=" . $station_id . " ORDER BY t.id DESC;";
            include('pop_sale_additem.php');
        } else {
            echo "Error: " . $stmt_delete_all->error;
        }
        $stmt_delete_all->close();
        break;

    case 5: //delete single item
        $id = intval($_POST['id']);

        $sql_delete_single = "DELETE FROM pos_sale_temp WHERE id=?;";
        $stmt_delete_single = $mysqli->prepare($sql_delete_single);
        if (!$stmt_delete_single) {
            echo "Error preparing statement (delete single temp): " . $mysqli->error;
            break;
        }
        $stmt_delete_single->bind_param("i", $id);
        if ($stmt_delete_single->execute()) {
            // Note: The following includes build SQL dynamically.
            // $station_id is confirmed as an integer.
            include('query_sale_additem.php');
            $sql .= " WHERE t.station_id=" . $station_id . " ORDER BY t.id DESC;";
            include('pop_sale_additem.php');
        } else {
            echo "Error: " . $stmt_delete_single->error;
        }
        $stmt_delete_single->close();
        break;

    case 6: // get item qty
        $id = intval($_POST['id']);

        $sql_get_item = "SELECT s.qty as qty, u.uom as uom, s.current_price as price, s.total as total,
                            s.discount_type as discount_type, s.discount_qty as discount_qty, s.discount_total as discount_total,
                            s.gst_type_id
                    FROM (pos_sale_temp s
                    LEFT JOIN (pos_product p LEFT JOIN pos_uom u ON u.id=p.product_uom) ON p.id=s.product_id)
                    WHERE s.id=?;";
        $stmt_get_item = $mysqli->prepare($sql_get_item);
        if (!$stmt_get_item) {
            echo "Error preparing statement (get item qty): " . $mysqli->error;
            break;
        }
        $stmt_get_item->bind_param("i", $id);
        if ($stmt_get_item->execute()) {
            $result = $stmt_get_item->get_result();
            $row = $result->fetch_object();
            echo json_encode($row);
            $result->free();
        } else {
            echo "Error: " . $stmt_get_item->error;
        }
        $stmt_get_item->close();
        break;

    case 7: //update item qty
        $id = intval($_POST['id']);
        $qty = floatval(trim($_POST['qty'] . ''));

        if ($id) {
            if ($qty > 0) {
                $sql_select_item_for_update = "SELECT current_price, discount_type, discount_qty, gst_type_id FROM pos_sale_temp WHERE id=?;";
                $stmt_select_item = $mysqli->prepare($sql_select_item_for_update);
                if (!$stmt_select_item) {
                    echo "Error preparing statement (select for update qty): " . $mysqli->error;
                    break;
                }
                $stmt_select_item->bind_param("i", $id);

                if ($stmt_select_item->execute()) {
                    $result_select = $stmt_select_item->get_result();
                    $rows = $result_select->fetch_object();
                    $result_select->free();
                    // $stmt_select_item->close(); // Close after use or before next prepare if variable name is reused

                    if ($rows) {
                        $gst_type_id = intval($rows->gst_type_id);
                        $current_price = floatval($rows->current_price);
                        $discount_type = intval($rows->discount_type);
                        $discount_qty_val = floatval($rows->discount_qty); // Renamed to avoid conflict with POSTed $discount_qty
                        $discount_total = 0;

                        switch ($discount_type) {
                            case 0: $discount_total = 0; break;
                            case 1: $discount_total = ($discount_qty_val / 100) * ($current_price * $qty); break;
                            case 2: $discount_total = $discount_qty_val * $qty; break;
                            case 3: $discount_total = $discount_qty_val; break;
                        }

                        $gst = floatval($gst_percent/100);
                        $tax_base = 0;
                        $gst_value = 0;
                        $total = 0;
                        $initial_total = ($qty * $current_price) - $discount_total;

                        switch(intval($gst_type_id)){
                            case 1:                             
                                $divisor = 1 + $gst;
                                $tax_base = floatval($initial_total) / $divisor;
                                $gst_value = $tax_base * $gst;
                                $total = $initial_total;
                                break;
                            case 2: 
                                $tax_base = $initial_total;
                                $gst_value = $tax_base * $gst;
                                $total = $initial_total + $gst_value;
                                break;
                            case 3: 
                                $total = $initial_total;
                        }
                        
                        $sql_update_qty = "UPDATE pos_sale_temp s SET
                                            s.qty=?, s.discount_total=?,
                                            s.total=?, s.tax_base=?, s.gst_value=?
                                    WHERE s.id=?;";
                        $stmt_update_qty = $mysqli->prepare($sql_update_qty);
                        if (!$stmt_update_qty) {
                            echo "Error preparing statement (update qty): " . $mysqli->error;
                        } else {
                            $stmt_update_qty->bind_param("dddddi", $qty, $discount_total, $total, $tax_base, $gst_value, $id);
                            if ($stmt_update_qty->execute()) {
                                // Note: The following includes build SQL dynamically.
                                // $station_id is confirmed as an integer.
                                include('query_sale_additem.php');
                                $sql .= " WHERE t.station_id=" . $station_id . " ORDER BY t.id DESC;";
                                include('pop_sale_additem.php');
                            } else {
                                echo "Error: " . $stmt_update_qty->error;
                            }
                            $stmt_update_qty->close();
                        }
                    } else {
                        echo "Error: Item not found for update.";
                    }
                } else {
                    echo "Error: " . $stmt_select_item->error;
                }
                $stmt_select_item->close(); // Ensure it's closed
            } else {
                echo "Error: Minimum QTY is 1.0";
            }
        } else {
            echo "Error: Critical Error Encountered!";
        }
        break;

    case 8: //update item discount
        $id = intval($_POST['id']);
        $discount_type =  intval($_POST['type']);
        $discount_qty = floatval($_POST['value']);
        // $discount_total = floatval($_POST['total']); // This is recalculated
        $gst_type_id = intval($_POST['gst_type_id']);
        $qty = floatval($_POST['qty']);
        $current_price = floatval($_POST['price']);
        $discount_total_calculated = 0; // Use a new variable for calculated discount total


        if ($id) {  
            switch ($discount_type) {
                case 0: $discount_total_calculated = 0; break;
                case 1: $discount_total_calculated = ($discount_qty / 100) * ($current_price * $qty); break;
                case 2: $discount_total_calculated = $discount_qty * $qty; break;
                case 3: $discount_total_calculated = $discount_qty; break;
            }

            $gst = floatval($gst_percent/100);
            $tax_base = 0;
            $gst_value = 0;
            $total = 0;
            $initial_total = ($qty * $current_price) - $discount_total_calculated;

            switch(intval($gst_type_id)){
                case 1:                             
                    $divisor = 1 + $gst;
                    $tax_base = floatval($initial_total) / $divisor;
                    $gst_value = $tax_base * $gst;
                    $total = $initial_total;
                    break;
                case 2: 
                    $tax_base = $initial_total;
                    $gst_value = $tax_base * $gst;
                    $total = $initial_total + $gst_value;
                    break;
                case 3: 
                    $total = $initial_total;
            }

            $sql_update_discount = "UPDATE pos_sale_temp s SET
                                    s.discount_type=?, s.discount_qty=?, s.discount_total=?,
                                    s.total=?, s.tax_base=?, s.gst_value=?
                            WHERE s.id=?;";
            $stmt_update_discount = $mysqli->prepare($sql_update_discount);
            if (!$stmt_update_discount) {
                echo "Error preparing statement (update discount): " . $mysqli->error;
            } else {
                $stmt_update_discount->bind_param("idddddi", $discount_type, $discount_qty, $discount_total_calculated, $total, $tax_base, $gst_value, $id);
                if ($stmt_update_discount->execute()) {
                    // Note: The following includes build SQL dynamically.
                    // $station_id is confirmed as an integer.
                    include('query_sale_additem.php');
                    $sql .= " WHERE t.station_id=" . $station_id . " ORDER BY t.id DESC;";
                    include('pop_sale_additem.php');
                } else {
                    echo "Error: " . $stmt_update_discount->error;
                }
                $stmt_update_discount->close();
            }
        } else {
            echo "Error: Critical Error Encountered!";
        }
        break;

    case 9: //save sale
        $subtotal = floatval($_POST['subtotal']);
        $discount = floatval($_POST['discount']);
        $discount_type = intval($_POST['discount_type']);
        $discount_qty = floatval($_POST['discount_qty']);
        $amount_due = floatval($_POST['amount_due']);
        $cash = floatval($_POST['cash']);
        $remarks = trim($_POST['remarks']); // No escape, will be bound
        $change = $cash - $amount_due;
        $payment_type_id = intval($_POST['payment_type_id']);
        $payment_type_label = trim($_POST['payment_type_label']); // No escape
        $reference = trim($_POST['reference']); // No escape

        $receipt_prefix = date('y');
        // $receipt_no = $receipt_prefix . '00000000'; // Will be set after insert

        $total_tax_base = 0.0;
        $total_gst_value = 0.0;

        if ($amount_due > 0.001 && $cash >= $amount_due) {
            try {
                $mysqli->begin_transaction();

                $total_sql = "SELECT SUM(tax_base) as tax_base, SUM(gst_value) as gst_value
                        FROM pos_sale_temp
                        WHERE station_id=?
                        GROUP BY station_id;";
                $stmt_total_temp = $mysqli->prepare($total_sql);
                if (!$stmt_total_temp) throw new Exception("Prepare failed (sum temp): " . $mysqli->error);
                $stmt_total_temp->bind_param("i", $station_id);
                if (!$stmt_total_temp->execute()) throw new Exception("Execute failed (sum temp): " . $stmt_total_temp->error);
                
                $total_pop_result = $stmt_total_temp->get_result();
                if ($total_pop_result->num_rows > 0) {
                    $total_row = $total_pop_result->fetch_object();
                    $total_tax_base = floatval($total_row->tax_base);
                    $total_gst_value = floatval($total_row->gst_value);
                }
                $total_pop_result->free();
                $stmt_total_temp->close();
                
                $sql_insert_tran = "INSERT INTO pos_transaction (
                                dt,subtotal,discount_total,discount_type,discount_qty,
                                total,tran_cash,tran_change, payment_type_id,
                                `reference`, user_id,remarks, gst_percent, gst_value, tax_base,
                                station_id
                            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
                $stmt_insert_tran = $mysqli->prepare($sql_insert_tran);
                if (!$stmt_insert_tran) throw new Exception("Prepare failed (insert transaction): " . $mysqli->error);
                $stmt_insert_tran->bind_param("sddiddddisisdddi", $dt, $subtotal, $discount, $discount_type, $discount_qty, $amount_due, $cash, $change, $payment_type_id, $reference, $uid, $remarks, $gst_percent, $total_gst_value, $total_tax_base, $station_id);

                if (!$stmt_insert_tran->execute()) {
                    throw new Exception("Execute failed (insert transaction): " . $stmt_insert_tran->error);
                }
                $tran_id = $mysqli->insert_id;
                $stmt_insert_tran->close();
                $receipt_no = $receipt_prefix . str_pad($tran_id, 8, "0", STR_PAD_LEFT);

                $trail_query_1 = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                VALUES (?,1,1,?,?,?);";
                $stmt_trail_1 = $mysqli->prepare($trail_query_1);
                if (!$stmt_trail_1) throw new Exception("Prepare failed (trail 1): " . $mysqli->error);
                $empty_remarks = "";
                $stmt_trail_1->bind_param("sssi", $dt, $receipt_no, $empty_remarks, $uid);
                if (!$stmt_trail_1->execute()) {
                    throw new Exception("Execute failed (trail 1): " . $stmt_trail_1->error);
                }
                $stmt_trail_1->close();

                $sql_insert_sale = "INSERT INTO pos_sale (dt,tran_id,product_id,buyer_id,qty,current_price,discount_type,discount_qty,discount_total,total,gst_percent, gst_value, tax_base, station_id, gst_type_id)
                        SELECT ?,?,product_id,buyer_id,qty,current_price,discount_type,discount_qty,discount_total,total,?, gst_value, tax_base, ?, gst_type_id
                        FROM pos_sale_temp
                        WHERE station_id=?;";
                $stmt_insert_sale = $mysqli->prepare($sql_insert_sale);
                if (!$stmt_insert_sale) throw new Exception("Prepare failed (insert sale): " . $mysqli->error);
                $stmt_insert_sale->bind_param("sidii", $dt, $tran_id, $gst_percent, $station_id, $station_id);
                                    
                if (!$stmt_insert_sale->execute()) {
                    throw new Exception("Execute failed (insert sale): " . $stmt_insert_sale->error);
                }
                $stmt_insert_sale->close();

                $item_query_select = "SELECT p.product_code as item_code, p.product_name as item_name
                                FROM pos_sale s
                                LEFT JOIN pos_product p ON p.id=s.product_id
                                WHERE s.tran_id=?;";
                $stmt_item_select = $mysqli->prepare($item_query_select);
                if (!$stmt_item_select) throw new Exception("Prepare failed (select items for trail): " . $mysqli->error);
                $stmt_item_select->bind_param("i", $tran_id);
                if (!$stmt_item_select->execute()) {
                    throw new Exception("Execute failed (select items for trail): " . $stmt_item_select->error);
                }
                $item_pop_result = $stmt_item_select->get_result();
                    
                $trail_query_2_template = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                    VALUES (?,6,1,?,?,?);";
                $stmt_trail_2 = $mysqli->prepare($trail_query_2_template);
                if (!$stmt_trail_2) throw new Exception("Prepare failed (trail 2 template): " . $mysqli->error);

                while ($item_row = $item_pop_result->fetch_object()) {
                    $item_product = $item_row->item_code . ' - ' . $item_row->item_name;
                    $stmt_trail_2->bind_param("sssi", $dt, $item_product, $empty_remarks, $uid);
                    if (!$stmt_trail_2->execute()) {
                        throw new Exception("Execute failed (trail 2 loop): " . $stmt_trail_2->error);
                    }
                }
                $item_pop_result->free();
                $stmt_item_select->close();
                $stmt_trail_2->close();

                $sql_delete_temp_after_sale = "DELETE FROM pos_sale_temp WHERE station_id = ?;";
                $stmt_delete_temp_after_sale = $mysqli->prepare($sql_delete_temp_after_sale);
                if (!$stmt_delete_temp_after_sale) throw new Exception("Prepare failed (delete temp on save): " . $mysqli->error);
                $stmt_delete_temp_after_sale->bind_param("i", $station_id);
                if (!$stmt_delete_temp_after_sale->execute()) {
                    throw new Exception("Execute failed (delete temp on save): " . $stmt_delete_temp_after_sale->error);
                }
                $stmt_delete_temp_after_sale->close();

                $mysqli->commit();

                echo $receipt_no . ":~|~:";

                $sql_receipt_details = "SELECT i.qty as qty, i.current_price as price, i.discount_total as discount, i.total as total, 
                                i.gst_type_id, i.gst_value, i.tax_base,
                                p.product_name as product,
                                b.type as buyer_type,
                                g.gst_code, g.gst_type
                        FROM pos_sale i
                        LEFT JOIN pos_product p ON p.id=i.product_id
                        LEFT JOIN pos_buyer b ON b.id=i.buyer_id
                        LEFT JOIN pos_gst_type g ON g.id=i.gst_type_id
                        WHERE i.tran_id=?;";
                
                $stmt_receipt_details = $mysqli->prepare($sql_receipt_details);
                if (!$stmt_receipt_details) { 
                    echo "Error preparing receipt statement: " . $mysqli->error;
                } else {
                    $stmt_receipt_details->bind_param("i", $tran_id);
                    if ($stmt_receipt_details->execute()) {
                        $pop_receipt_result = $stmt_receipt_details->get_result();
                        $receipt_items_html = "";
                        while ($item = $pop_receipt_result->fetch_object()) {
                            $i_product = htmlspecialchars($item->product); // Sanitize for HTML output
                            $i_buyer = strtoupper(substr($item->buyer_type . '', 0, 1));
                            $i_qty = $item->qty;
                            $i_price = $item->price; // This is current_price from pos_sale
                            // $i_discount = $item->discount; // Not used in current output structure
                            $i_total = $item->total;
                            $i_gst_value = $item->gst_value;
                            $i_gst_type_id = $item->gst_type_id;
                            $item_display_price = (intval($i_gst_type_id) !== 3) ? $item->tax_base : $i_price;


                            $receipt_items_html .= "<tr>
                                    <td align='left' colspan='4'>{$i_product} ({$i_buyer})</td>
                                    <td align='right'>".number_format($i_total, 2)."</td>
                                </tr>";
                            $receipt_items_html .= "<tr>
                                    <td align='right'>".number_format($i_qty, 2)."</td>
                                    <td align='center'>@</td>
                                    <td align='left'>".number_format($item_display_price, 2)."</td>
                                    <td>GST: ".number_format($i_gst_value, 2)."</td>
                                    <td></td> 
                                </tr>";
                        }
                        echo $receipt_items_html; // Echo all item HTML at once
                        $pop_receipt_result->free();
                    } else {
                        echo "Error executing receipt statement: " . $stmt_receipt_details->error;
                    }
                    $stmt_receipt_details->close();
                }
                
                echo ":~|~:";
                $summary_html = "<tr><td align='right'>SUBTOTAL</td><td align='right'>" . number_format($subtotal, 2, '.', ',') . "</td></tr>";
                $summary_html .= "<tr><td align='right'><b>AMOUNT DUE</b></td><td align='right'><b>" . number_format($amount_due, 2, '.', ',') . "</b></td></tr>";
                $summary_html .= "<tr><td align='right'>TENDER</td><td align='right'>" . number_format($cash, 2, '.', ',') . "</td></tr>";
                $summary_html .= "<tr><td align='right'>CHANGE</td><td align='right'>" . number_format($change, 2, '.', ',') . "</td></tr>";

                if ($show_gst) {
                    $summary_html .= "<tr><td></td><td><hr/></td></tr>";
                    $summary_html .= "<tr><td align='right'>TAX BASE</td><td align='right'>" . number_format($total_tax_base, 2, '.', ',') . "</td></tr>";
                    $summary_html .= "<tr><td align='right'>GST ({$gst_percent} %)</td><td align='right'>" . number_format($total_gst_value, 2, '.', ',') . "</td></tr>";
                }

                $summary_html .= "<tr><td align='right'>PMT TYPE</td><td align='right'>" . htmlspecialchars($payment_type_label) . "</td></tr>";
                $summary_html .= "<tr><td align='right'>PMT REF</td><td align='right'>" . htmlspecialchars($reference) . "</td></tr>";
                echo $summary_html;

                echo ":~|~:";
                // Note: The following includes build SQL dynamically.
                // $station_id is confirmed as an integer. pos_sale_temp should be empty.
                include('query_sale_additem.php');
                $sql .= " WHERE t.station_id=" . $station_id . " ORDER BY t.id DESC;";
                include('pop_sale_additem.php');
                
            } catch (Exception $e) {
                $mysqli->rollback();
                echo "Transaction failed: " . $e->getMessage();
            }
        } else {
            echo "Error: Invalid Amount Due or Cash is less than the amount due!";
        }
        break;

    
    case 10: //Date and Time
        echo date('F d, Y H:i:s');
        break;

    case 11: //Check if Sale module is Lock
        $sql = "SELECT * FROM pos_sale_lock WHERE date(dt)=date(now()) AND action_id=1;";
        $pop = $mysqli->query($sql);
        if ($pop) {
            $lock = $pop->num_rows;
            echo $lock;
        } else {
            echo "0";
        }

        break;

    case 12: //lock sale module
        $action_id_lock = intval($_POST['action_id']);

        $sql_insert_lock = "INSERT INTO pos_sale_lock (dt,user_id,action_id) VALUES (NOW(),?,?);";
        $stmt_insert_lock = $mysqli->prepare($sql_insert_lock);
        if (!$stmt_insert_lock) {
            echo "Error preparing statement (lock sale): " . $mysqli->error;
        } else {
            // $uid is from validate.php, assumed integer and safe.
            $stmt_insert_lock->bind_param("ii", $uid, $action_id_lock);
            if ($stmt_insert_lock->execute()) {
                // Success
            } else {
                echo "Error: " . $stmt_insert_lock->error;
            }
            $stmt_insert_lock->close();
        }
        break;

    default:
        echo "Error: Critical Error Encountered!";
}

$mysqli->close();
