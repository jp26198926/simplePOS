<?php
    
     $sql = "SELECT s.id as id, DATE(s.dt) as dt, s.tran_id as tran_id, CONCAT(DATE_FORMAT(s.dt, '%y'),LPAD(s.tran_id,8,'0')) as receipt, s.qty as qty, s.current_price as price,
                    s.discount_type as discount_type, s.discount_qty as discount_qty, s.discount_total as discount_total,
                    s.total as total, s.status_id as status_id,
                    p.product_code as product_code, p.product_name as product_name,
                    u.uom as uom,
                    d.discount_type as discount_type_word,
                    st.status as status,
                    b.type as buyer_type
            FROM (((pos_sale s
            LEFT JOIN (pos_product p LEFT JOIN pos_uom u ON u.id=p.product_uom) ON p.id=s.product_id)
            LEFT JOIN pos_product_discount d ON d.id=s.discount_type)
            LEFT JOIN pos_sale_status st ON st.id=s.status_id)
            LEFT JOIN pos_buyer b ON b.id=s.buyer_id ";
    
    

?>