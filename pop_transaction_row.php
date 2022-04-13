<?php

$pop = $mysqli->query($sql);
$total = 0;
if ($pop) {
    $count = $pop->num_rows;

    if ($count > 0) {

        $row = $pop->fetch_object();

        $id = $row->id;
        $dt_receipt = $row->dt;

        $receipt_prefix = date('y', strtotime($dt_receipt));
        $receipt = $receipt_prefix . str_pad($row->id, 8, "0", STR_PAD_LEFT);

        $subtotal = number_format(floatval($row->subtotal), 2, '.', ',');
        $discount = number_format(floatval($row->discount), 2, '.', ',');
        $discount_type = $row->discount_type;
        $discount_type_word = $row->discount_type_word ? $row->discount_type_word : "No Discount";
        $discount_qty = number_format(floatval($row->discount_qty), 2, '.', ',');
        $amount_due = number_format(floatval($row->amount_due), 2, '.', ',');
        $remarks = $row->remarks;
        $status_id = $row->status_id;
        $cashier = strtoupper($row->cashier);
        $status = $row->status;

        $payment_type = $row->payment_type;
        $reference = $row->reference;

        $total = floatval($row->amount_due);
        $t_taxbase = $total / 1.1;
        $t_gst = $t_taxbase * 0.1;

        $taxbase = number_format($t_taxbase, 2, '.', ',');
        $gst = number_format($t_gst, 2, '.', ',');



        /*
                $tr_id = "tr_" . $id;  
                
                if ($status_id==1){
                    echo "<tr id='{$tr_id}'>";
                }else{
                    echo "<tr id='{$tr_id}' class='danger'>";
                }
                */

        echo "<td>";
        echo "    <a id='{$id}' class='btn_transaction_details btn btn-info btn-xs fa fa-search' data-toggle='popover'  data-content='View Complete Details'></a>";

        if ($status_id == 1) {
            echo "    <a id='{$id}' class='btn_transaction_reprint btn btn-success btn-xs fa fa-print' data-toggle='popover'  data-content='Reprint Receipt' ></a>";
            //echo "    <a id='{$id}' class='btn_transaction_cancel btn btn-danger btn-xs fa fa-times' data-toggle='popover'  data-content='Cancel Transaction' ></a>";
            if ($uaccess == 1 || $uaccess == 3) { //only admin or account can cancel
                echo "    <a id='{$id}' class='btn_transaction_cancel btn btn-danger btn-xs fa fa-times' data-toggle='popover'  data-content='Cancel Transaction' ></a>";
            }
        } else {
            echo "    <a id='{$id}' class='btn_transaction_recomplete btn btn-warning btn-xs fa fa-check' data-toggle='popover'  data-content='Mark as Completed' ></a>";
        }

        echo "</td>";

        echo "<td>{$receipt}</td>";
        echo "<td>{$dt_receipt}</td>";

        /*
                echo "<td align='right'>{$subtotal}</td>";
                echo "<td align='right'>
                        <span title='TYPE: {$discount_type_word} ; VALUE: {$discount_qty}'>{$discount}</span>
                     </td>";
                */
        echo "<td>{$payment_type}</td>";
        echo "<td align='right'>{$amount_due}</td>";
        echo "<td align='right'>{$taxbase}</td>";
        echo "<td align='right'>{$gst}</td>";
        echo "<td>{$cashier}</td>";
        echo "<td>{$remarks}</td>";

        if ($status_id == 2) {
            echo "<td><a id='{$id}' href='#' class='transaction_cancelled_info'>{$status}</a></td>";
        } else {
            echo "<td>{$status}</td>";
        }

        //echo "</tr>";

    } else {
        echo "<tr><td colspan='8' align='center'>No Record To Display</td></tr>";
    }

    //echo ":~|~:" . number_format($total,2,'.',',');
} else {
    echo "Error: " . $mysqli->error;
}
