<?php
include('validate.php');
include('connect.php');

$action = $_POST['action'];

switch ($action) {
    case 1: //search code
        $qty = floatval(trim($_POST['qty'] . ''));
        $code = $mysqli->real_escape_string(trim($_POST['item_code'] . ''));
        $buyer_type = intval($_POST['buyer_type']);

        if ($qty && $code) {
            $sql = "SELECT p.id as product_id, COALESCE(r.price,'0.00') as price
                        FROM pos_product p
                        LEFT JOIN pos_price r ON r.product_id=p.id AND r.buyer_id={$buyer_type}
                        WHERE p.product_code='{$code}';";

            $exec = $mysqli->query($sql);
            if ($exec) {
                $product_count = $exec->num_rows;
                if ($product_count > 0) {
                    $row = $exec->fetch_object();

                    $product_id = $row->product_id;
                    $price = floatval($row->price);

                    $total = $qty * $price;

                    //save to temp
                    $sql = "INSERT INTO pos_sale_temp (product_id,qty,buyer_id,current_price,total)
                                VALUES ({$product_id},{$qty},{$buyer_type},{$price},{$total});";

                    $save = $mysqli->query($sql);
                    if ($save) {
                        //populate
                        include('query_sale_additem.php');

                        $sql .= " ORDER BY t.id DESC;";

                        include('pop_sale_additem.php');
                    } else {
                        echo "Error: " . $mysqli->error;
                    }
                } else {
                    echo "Error: Invalid Product Code!";
                }
            } else {
                echo "Error: " . $mysqli->error;
            }
        } else {
            echo "Error: Invalid QTY or Item Code!";
        }

        break;

    case 2: //pos temp
        $sql = "SELECT count(*) as count FROM pos_sale_temp;";
        $exec = $mysqli->query($sql);
        if ($exec) {
            $row = $exec->fetch_object();
            $count = $row->count;

            echo $count;
        } else {
            echo "Error: Critical Error Encountered!";
        }
        break;

    case 3: //pop temp record
        include('query_sale_additem.php');

        $sql .= " ORDER BY t.id DESC;";

        include('pop_sale_additem.php');

        break;

    case 4: //delete all data fromt temp db
        $sql = "DELETE FROM pos_sale_temp;";
        $exec = $mysqli->query($sql);
        if ($exec) {
            include('query_sale_additem.php');

            $sql .= " ORDER BY t.id DESC;";

            include('pop_sale_additem.php');
        } else {
            echo "Error: " . $mysqli->error;
        }

        break;

    case 5: //delete single item
        $id = $_POST['id'];

        $sql = "DELETE FROM pos_sale_temp WHERE id={$id};";
        $exec = $mysqli->query($sql);
        if ($exec) {
            include('query_sale_additem.php');

            $sql .= " ORDER BY t.id DESC;";

            include('pop_sale_additem.php');
        } else {
            echo "Error: " . $mysqli->error;
        }

        break;

    case 6: // get item qty
        $id = $_POST['id'];

        $sql = "SELECT s.qty as qty, u.uom as uom, s.current_price as price, s.total as total,
                            s.discount_type as discount_type, s.discount_qty as discount_qty, s.discount_total as discount_total
                    FROM (pos_sale_temp s
                    LEFT JOIN (pos_product p LEFT JOIN pos_uom u ON u.id=p.product_uom) ON p.id=s.product_id)
                    WHERE s.id={$id};";
        $exec = $mysqli->query($sql);
        if ($exec) {
            $row = $exec->fetch_object();
            $qty = $row->qty;
            $uom = $row->uom;

            $price = $row->price;
            $total = $row->total;
            $discount_type = $row->discount_type;
            $discount_qty = $row->discount_qty;
            $discount_total = $row->discount_total;

            echo $qty . ":~|~:" . $uom;

            echo ":~|~:" . $price . ":~|~:" . $total . ":~|~:" . $discount_type . ":~|~:" . $discount_qty . ":~|~:" . $discount_total;
        } else {
            echo "Error: " . $mysqli->error;
        }

        break;

    case 7: //update item qty
        $id = $_POST['id'];
        $qty = floatval(trim($_POST['qty'] . ''));

        if ($id) {
            if ($qty > 0) {
                //compute discount first
                $sql = "SELECT current_price,discount_type,discount_qty FROM pos_sale_temp WHERE id={$id};";
                $exec = $mysqli->query($sql);
                if ($exec) {
                    $rows = $exec->fetch_object();
                    $current_price = floatval($rows->current_price);
                    $discount_type = intval($rows->discount_type);
                    $discount_qty = floatval($rows->discount_qty);
                    $discount_total = 0;

                    switch ($discount_type) {
                        case 0:
                            $discount_total = 0;
                            break;
                        case 1: //percentage
                            $discount_total = ($discount_qty / 100) * ($current_price * $qty);
                            break;
                        case 2: //unit price
                            $discount_total = $discount_qty * $qty;
                            break;
                        case 3: //total price
                            $discount_total = $discount_qty;
                            break;
                    }

                    //start updating
                    $sql = "UPDATE pos_sale_temp s SET
                                        s.qty={$qty}, s.discount_total={$discount_total},
                                        s.total=(({$qty}*(s.current_price))-{$discount_total})
                                WHERE s.id={$id};";

                    $exec = $mysqli->query($sql);
                    if ($exec) {
                        include('query_sale_additem.php');

                        $sql .= " ORDER BY t.id DESC;";

                        include('pop_sale_additem.php');
                    } else {
                        echo "Error: " . $mysqli->error;
                    }
                } else {
                    echo "Error: " . $mysqli->error;
                }
            } else {
                echo "Error: Minimum QTY is 1.0";
            }
        } else {
            echo "Error: Critical Error Encountered!";
        }
        break;

    case 8: //update item discount
        $id = $_POST['id'];
        $type =  intval($_POST['type']);
        $value = floatval($_POST['value']);
        $total = floatval($_POST['total']);

        if ($id) {

            $sql = "UPDATE pos_sale_temp s SET
                                    s.discount_type={$type}, s.discount_qty={$value}, s.discount_total={$total},
                                    s.total=((s.qty * s.current_price) - {$total})
                            WHERE s.id={$id};";

            $exec = $mysqli->query($sql);
            if ($exec) {
                include('query_sale_additem.php');

                $sql .= " ORDER BY t.id DESC;";

                include('pop_sale_additem.php');
            } else {
                echo "Error: " . $mysqli->error;
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
        $remarks = $mysqli->real_escape_string(trim($_POST['remarks']));
        $change = $cash - $amount_due;
        $payment_type_id = intval($_POST['payment_type_id']);
        $payment_type_label = $mysqli->real_escape_string(trim($_POST['payment_type_label']));
        $reference = $mysqli->real_escape_string(trim($_POST['reference']));

        $receipt_prefix = date('y');
        $receipt_no = $receipt_prefix . '00000000';

        if ($amount_due > 0.001 && $cash >= $amount_due) {
            //save tran
            $sql = "INSERT INTO pos_transaction (dt,subtotal,discount_total,discount_type,discount_qty,total,tran_cash,tran_change, payment_type_id, `reference`, user_id,remarks)
                        VALUES ('{$dt}',{$subtotal},{$discount},{$discount_type},{$discount_qty},{$amount_due},{$cash},{$change},{$payment_type_id}, '{$reference}',{$uid},'{$remarks}');";

            $exec = $mysqli->query($sql);
            if ($exec) {
                $tran_id = $mysqli->insert_id;
                //$receipt_no = str_pad($tran_id,10,"0",STR_PAD_LEFT);
                $receipt_no = $receipt_prefix . str_pad($tran_id, 8, "0", STR_PAD_LEFT);

                //save to Transaction Trail
                $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                    VALUES ('{$dt}',1,1,'{$receipt_no}','',$uid);";
                $trail_save = $mysqli->query($trail_query);
                //end of Transaction Trail

                $sql = "INSERT INTO pos_sale (dt,tran_id,product_id,buyer_id,qty,current_price,discount_type,discount_qty,discount_total,total)
                            SELECT '{$dt}',{$tran_id},product_id,buyer_id,qty,current_price,discount_type,discount_qty,discount_total,total
                            FROM pos_sale_temp;";

                $exec = $mysqli->query($sql);
                if ($exec) {

                    //save to sold item trail
                    $item_query = "SELECT p.product_code as item_code, p.product_name as item_name
                                       FROM pos_sale s
                                       LEFT JOIN pos_product p ON p.id=s.product_id
                                       WHERE s.tran_id={$tran_id};";;
                    $item_pop = $mysqli->query($item_query);
                    if ($item_pop) {
                        while ($item_row = $item_pop->fetch_object()) {
                            $item_product = $item_row->item_code . ' - ' . $item_row->item_name;

                            $trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                                                VALUES ('{$dt}',6,1,'{$item_product}','',$uid);";
                            $trail_save = $mysqli->query($trail_query);
                        }
                    }
                    //end of sold item trail                        

                    echo $receipt_no . ":~|~:";

                    //to be printed on receipt
                    $sql = "SELECT i.qty as qty, i.current_price as price, i.discount_total as discount, i.total as total,
                                        p.product_name as product,
                                        b.type as buyer_type
                                FROM pos_sale_temp i
                                LEFT JOIN pos_product p ON p.id=i.product_id
                                LEFT JOIN pos_buyer b ON b.id=i.buyer_id;";

                    $pop = $mysqli->query($sql);

                    while ($item = $pop->fetch_object()) {
                        $i_product = $item->product;
                        $i_buyer = strtoupper(substr($item->buyer_type . '', 0, 1));
                        $i_qty = $item->qty;
                        $i_price = $item->price;;
                        $i_discount = $item->discount;
                        $i_total = $item->total;

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
                    echo "   <td align='right'>" . number_format($subtotal, 2, '.', ',') . "</td>";
                    echo "</tr>";
                    /*
                        echo "<tr>";
                        echo "   <td align='right'>DISCOUNT</td>";
                        echo "   <td align='right'>" . number_format($discount,2,'.',',') . "</td>";                       
                        echo "</tr>";
                        */
                    echo "<tr>";
                    echo "   <td align='right'><b>AMOUNT DUE</b></td>";
                    echo "   <td align='right'><b>" . number_format($amount_due, 2, '.', ',') . "</b></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "   <td align='right'>TENDER</td>";
                    echo "   <td align='right'>" . number_format($cash, 2, '.', ',') . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "   <td align='right'>CHANGE</td>";
                    echo "   <td align='right'>" . number_format($change, 2, '.', ',') . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "   <td align='right'>PMT TYPE</td>";
                    echo "   <td align='right'>" . $payment_type_label . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "   <td align='right'>PMT REF</td>";
                    echo "   <td align='right'>" . $reference . "</td>";
                    echo "</tr>";

                    //empty temp table
                    $sql = "TRUNCATE pos_sale_temp;";
                    $exec = $mysqli->query($sql);

                    echo ":~|~:";

                    if ($exec) {
                        include('query_sale_additem.php');

                        $sql .= " ORDER BY t.id DESC;";

                        include('pop_sale_additem.php');
                    } else {
                        echo "Error: " . $mysqli->error;
                    }
                } else {
                    echo "Error: " . $mysqli->error;
                }
            } else {
                echo "Error: " . $mysqli->error;
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
        $action_id = $_POST['action_id'];

        $sql = "INSERT INTO pos_sale_lock (dt,user_id,action_id) VALUES (NOW(),{$uid},{$action_id});";
        $save = $mysqli->query($sql);
        if ($save) {
        } else {
            echo "Error: " . $mysqli->error;
        }

        break;

    default:
        echo "Error: Critical Error Encountered!";
}

$mysqli->close();
