<?php
$pop = $mysqli->query($sql);
if ($pop) {
    $count = $pop->num_rows;
    if ($count > 0) {
        while ($row = $pop->fetch_object()) {
            $id = $row->id;
            $payment_type = $row->payment_type;
            $status_id = $row->status_id;
            $status = $row->status;

            $tr_id = "tr_" . $id;

            if ($status_id == 2) { //inactive
                echo "<tr id='{$tr_id}' class='danger'>";
            } else {
                echo "<tr id='{$tr_id}'>";
            }

            echo "   <td class='text-center'>";
            echo "    <a id='{$id}' class='btn_payment_type_modify btn btn-info btn-xs fa fa-pencil' title='Modify Product' ></a>";
            echo "    <a id='{$id}' class='btn_payment_type_delete btn btn-danger btn-xs fa fa-times' title='Delete Product' ></a>";
            echo "    <a id='{$id}' class='btn_payment_type_activate btn btn-warning btn-xs fa fa-reply' title='Activate Product' ></a>";
            echo "   </td>";
            echo "   <td>{$payment_type}</td>";
            echo "   <td>{$status}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "   <td colspan='3' align='center'>No Record Found</td>";
        echo "</tr>";
    }
} else {
    echo "Error: " . $mysqli->error;
}
