<?php

$pop = $mysqli->query($sql);
$total = 0;
if ($pop) {
    $count = $pop->num_rows;

    if ($count > 0) {

        while ($row = $pop->fetch_object()) {

            $product_code = $row->product_code;
            $product_name = $row->product_name;
            $uom = $row->uom;
            $category = $row->category;

            $qty = floatval($row->qty) > 0.01 ? number_format(floatval($row->qty), 2, '.', ',') : "";
            $qty_insider = floatval($row->qty_insider) > 0.01 ? number_format(floatval($row->qty_insider), 2, '.', ',') : "";
            $qty_outsider = floatval($row->qty_outsider) > 0.01 ? number_format(floatval($row->qty_outsider), 2, '.', ',') : "";
            $qty_kitchen = floatval($row->qty_kitchen) > 0.01 ? number_format(floatval($row->qty_kitchen), 2, '.', ',') : "";
            $qty_sale = floatval($row->qty_sale) > 0.01 ? number_format(floatval($row->qty_sale), 2, '.', ',') : "";

            /*
                $discount_qty = number_format(floatval($row->discount_qty) ,2 ,'.' ,',');           
                */

            $discount_total = number_format(floatval($row->discount_total), 2, '.', ',');

            $total = floatval($row->total) > 0.01 ? number_format(floatval($row->total), 2, '.', ',') : "";
            $total_insider = floatval($row->total_insider) > 0.01 ? number_format(floatval($row->total_insider), 2, '.', ',') : "";
            $total_outsider = floatval($row->total_outsider) > 0.01 ? number_format(floatval($row->total_outsider), 2, '.', ',') : "";
            $total_kitchen = floatval($row->total_kitchen) > 0.01 ? number_format(floatval($row->total_kitchen), 2, '.', ',') : "";
            $total_sale = floatval($row->total_sale) > 0.01 ? number_format(floatval($row->total_sale), 2, '.', ',') : "";

            /*
                $t_total = floatval($row->total);
                $t_taxbase = $t_total / 1.1;
                $t_gst = $t_taxbase * 0.1;
                
                $taxbase = number_format(($t_taxbase) ,2 ,'.' ,',');
                $gst = number_format(($t_gst) ,2 ,'.' ,',');
                */

            echo "<tr>";
            echo "<td>{$product_code}</td>";
            echo "<td>{$product_name}</td>";
            echo "<td align='center'>{$uom}</td>";
            echo "<td align='center'>{$category}</td>";

            echo "<td align='right'>{$qty_insider}</td>";
            echo "<td align='right'>{$total_insider}</td>";

            echo "<td align='right'>{$qty_outsider}</td>";
            echo "<td align='right'>{$total_outsider}</td>";

            echo "<td align='right'>{$qty_kitchen}</td>";
            echo "<td align='right'>{$total_kitchen}</td>";

            echo "<td align='right'>{$qty_sale}</td>";
            echo "<td align='right'>{$total_sale}</td>";

            echo "<td align='right' class='warning'>{$qty}</td>";
            echo "<td align='right' class='danger'>{$total}</td>";


            /*
                echo "<td align='right'>{$discount_total}</td>";
                */

            /*
                echo "<td align='right'>{$taxbase}</td>";
                echo "<td align='right'>{$gst}</td>";
                */

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='14' align='center'>No Record To Display</td></tr>";
    }

    //echo ":~|~:" . number_format($total,2,'.',',');
} else {
    echo "Error: " . $mysqli->error;
}
