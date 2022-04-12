<?php
include('validate.php');
include('connect.php');

$action = $_POST['action'];

switch ($action) {
    case 1: //search
        $mysearch = $_POST['mysearch'];

        include('query_payment_type.php');

        $sql .= " WHERE concat_ws(' ',b.payment_type,s.status) LIKE '%{$mysearch}%'  ORDER BY b.payment_type;";

        include('pop_payment_type.php');

        //save to Trail
        //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
        //                VALUES ('{$dt}',2,8,'{$mysearch}','',$uid);";
        //$trail_save = $mysqli->query($trail_query);
        //end of Trail

        break;

    case 2: //add new
        $payment_type = $mysqli->real_escape_string(trim($_POST['payment_type'] . ''));

        if ($payment_type) {

            $sql = "INSERT INTO pos_payment_type (payment_type)
                        VALUES ('{$payment_type}');";

            $exec = $mysqli->query($sql);

            if ($exec) {
                $payment_type_id = $mysqli->insert_id;

                //save to Trail
                //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                //                VALUES ('{$dt}',2,10,'{$product_code} - {$product_name}','',$uid);";
                //$trail_save = $mysqli->query($trail_query);
                //end of Trail

                include("query_payment_type.php");

                $sql .= " ORDER BY b.payment_type;";

                include('pop_payment_type.php');
            } else {
                echo "Error: " . $mysqli->error;
            }
        } else {
            echo  "Error: Fields with red asterisk are required!";
        }

        break;

    case 3: //modify
        $id = $_POST['id'];
        $payment_type = $mysqli->real_escape_string(trim($_POST['payment_type'] . ''));

        $sql = "UPDATE pos_payment_type SET  payment_type='{$payment_type}' WHERE id={$id};";

        $exec = $mysqli->query($sql);
        if ($exec) {
            //save to Trail
            //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
            //                VALUES ('{$dt}',2,12,'{$product_code} - {$product_name}','',$uid);";
            //$trail_save = $mysqli->query($trail_query);
            //end of Trail


            include("query_payment_type.php");

            $sql .= " WHERE b.id={$id} ";
            $sql .= " ORDER BY b.payment_type;";

            //include ('pop_product.php');
            include('pop_payment_type_row.php');
        } else {
            echo "Error: " . $mysqli->error;
        }
        break;

    case 4: //get info
        $id = $_POST['id'];
        if ($id) {
            $sql = "SELECT payment_type FROM pos_payment_type WHERE id={$id};";

            $exec = $mysqli->query($sql);

            if ($exec) {
                $row = $exec->fetch_object();

                $payment_type = $row->payment_type;

                echo $payment_type;
            } else {
                echo "Error: " . $mysqli->error;
            }
        } else {
            echo "Error: Critical Error Encountered!";
        }

        break;

    case 6: //advance search
        $payment_type = $mysqli->real_escape_string(trim($_POST['payment_type'] . ''));
        $status_id = intval(trim($_POST['status_id'] . ''));

        include('query_payment_type.php');

        $sql .= " WHERE b.payment_type LIKE '%{$payment_type}%' ";

        if ($status_id) {
            $sql .= " AND b.status_id={$status_id} ";
        }

        $sql .= " ORDER BY b.payment_type;";

        include('pop_payment_type.php');


        //save to Trail
        //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
        //                VALUES ('{$dt}',2,9,'Code: {$product_code} \n Name: {$product_name} \n UOM: {$product_uom} \n Price: {$product_price} \n Status: {$product_status}','',$uid);";
        //$trail_save = $mysqli->query($trail_query);
        //end of Trail

        break;

    case 7: //update status (1 -active; 2-enactive)
        $id = $_POST['id'];
        $status = $_POST['status_id'];



        if ($id) {
            $sql = "UPDATE pos_payment_type SET status_id={$status} WHERE id={$id};";
            $exec = $mysqli->query($sql);
            if ($exec) {

                include('query_payment_type.php');

                $sql .= " WHERE b.id={$id} ";
                $sql .= " ORDER BY b.payment_type;";

                include('pop_payment_type_row.php');

                //save to Trail
                //$trail_action = $status_id == 1 ? 14 : 13;
                //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                //                VALUES ('{$dt}',2,{$trail_action},'{$code} - {$name}','',$uid);";
                //$trail_save = $mysqli->query($trail_query);
                //end of Trail

            } else {
                echo "Error: " . $mysqli->error;
            }
        } else {
            echo "Error: Critical Error Encountered!";
        }
        break;

    default:
        echo "Error: Critical Error Encountered!";
}

$mysqli->close();
