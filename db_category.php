<?php
include('validate.php');
include('connect.php');

$action = $_POST['action'];

switch ($action) {
    case 1: //search
        $mysearch = $_POST['mysearch'];

        include('query_category.php');

        $sql .= " WHERE concat_ws(' ',b.category,s.status) LIKE '%{$mysearch}%'  ORDER BY b.category;";

        include('pop_category.php');

        //save to Trail
        //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
        //                VALUES ('{$dt}',2,8,'{$mysearch}','',$uid);";
        //$trail_save = $mysqli->query($trail_query);
        //end of Trail

        break;

    case 2: //add new
        $category = $mysqli->real_escape_string(trim($_POST['category'] . ''));

        if ($category) {

            $sql = "INSERT INTO pos_category (category)
                        VALUES ('{$category}');";

            $exec = $mysqli->query($sql);

            if ($exec) {
                $category_id = $mysqli->insert_id;

                //save to Trail
                //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
                //                VALUES ('{$dt}',2,10,'{$product_code} - {$product_name}','',$uid);";
                //$trail_save = $mysqli->query($trail_query);
                //end of Trail

                include("query_category.php");

                $sql .= " ORDER BY b.category;";

                include('pop_category.php');
            } else {
                echo "Error: " . $mysqli->error;
            }
        } else {
            echo  "Error: Fields with red asterisk are required!";
        }

        break;

    case 3: //modify
        $id = $_POST['id'];
        $category = $mysqli->real_escape_string(trim($_POST['category'] . ''));

        $sql = "UPDATE pos_category SET  category='{$category}' WHERE id={$id};";

        $exec = $mysqli->query($sql);
        if ($exec) {
            //save to Trail
            //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
            //                VALUES ('{$dt}',2,12,'{$product_code} - {$product_name}','',$uid);";
            //$trail_save = $mysqli->query($trail_query);
            //end of Trail


            include("query_category.php");

            $sql .= " WHERE b.id={$id} ";
            $sql .= " ORDER BY b.category;";

            //include ('pop_product.php');
            include('pop_category_row.php');
        } else {
            echo "Error: " . $mysqli->error;
        }
        break;

    case 4: //get info
        $id = $_POST['id'];
        if ($id) {
            $sql = "SELECT category FROM pos_category WHERE id={$id};";

            $exec = $mysqli->query($sql);

            if ($exec) {
                $row = $exec->fetch_object();

                $category = $row->category;

                echo $category;
            } else {
                echo "Error: " . $mysqli->error;
            }
        } else {
            echo "Error: Critical Error Encountered!";
        }

        break;

    case 6: //advance search
        $category = $mysqli->real_escape_string(trim($_POST['category'] . ''));
        $status_id = intval(trim($_POST['status_id'] . ''));

        include('query_category.php');

        $sql .= " WHERE b.category LIKE '%{$category}%' ";

        if ($status_id) {
            $sql .= " AND b.status_id={$status_id} ";
        }

        $sql .= " ORDER BY b.category;";

        include('pop_category.php');


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
            $sql = "UPDATE pos_category SET status_id={$status} WHERE id={$id};";
            $exec = $mysqli->query($sql);
            if ($exec) {

                include('query_category.php');

                $sql .= " WHERE b.id={$id} ";
                $sql .= " ORDER BY b.category;";

                include('pop_category_row.php');

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
