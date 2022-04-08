<?php
$pop = $mysqli->query($sql);
if ($pop) {
    $count = $pop->num_rows;
    if ($count > 0) {
        while ($row = $pop->fetch_object()) {
            $id = $row->id;
            $code = $row->product_code;
            $name = $row->product_name;
            $stock = floatval($row->stock);
            $sale = floatval($row->sale);
            $uom = $row->product_uom;
            $category = $row->category;
            //$price = $row->price;
            $status_id = $row->status_id;
            $status = $row->status;

            $current_stock = $stock - $sale;

            $tr_id = "tr_" . $id;

            echo "<tr id='{$tr_id}'>";
            echo "   <td class='text-center'>";
            //echo "    <a id='{$id}' class='btn_product_price btn btn-success btn-xs fa fa-plus' title='Add / Update Price' ></a>";
            echo "    <a id='{$id}' class='btn_product_modify btn btn-info btn-xs fa fa-pencil' title='Modify Product' ></a>";
            echo "    <a id='{$id}' class='btn_product_delete btn btn-danger btn-xs fa fa-times' title='Delete Product' ></a>";
            echo "    <a id='{$id}' class='btn_product_activate btn btn-warning btn-xs fa fa-reply' title='Activate Product' ></a>";
            echo "   </td>";
            echo "   <td>{$code}</td>";
            echo "   <td>{$name}</td>";
            echo "   <td align='center'>{$current_stock}</td>";
            echo "   <td align='center'>{$uom}</td>";
            echo "   <td align='center'>{$category}</td>";
            //echo "   <td align='right'>{$price}</td>";
            echo "   <td align='center'>{$status}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "   <td colspan='7' align='center'>No Record Found</td>";
        echo "</tr>";
    }
} else {
    echo "Error: " . $mysqli->error;
}
