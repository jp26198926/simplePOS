<?php
        $sql = "SELECT t.id as id, t.qty as qty, p.product_code as p_code, p.product_name as p_name,
                        t.current_price as current_price, t.total as total,
                        t.discount_type as discount_type_id, t.discount_qty as discount_qty, t.discount_total as discount_total,
                        t.gst_type_id, t.gst_code, t.gst_type, t.gst_percent, t.tax_base, t.gst_value, t.tax_base,
                        d.discount_type as discount_type,
                        b.type as buyer_type
                FROM ((pos_sale_temp t
                LEFT JOIN pos_product p ON p.id=t.product_id)
                LEFT JOIN pos_product_discount d ON d.id=t.discount_type)
                LEFT JOIN pos_buyer b ON b.id=t.buyer_id ";
?>
