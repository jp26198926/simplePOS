<?php
    
    $sql = "SELECT  s.id as id, s.dt as dt, s.qty as qty, 
                    s.price, s.total,
                    s.status_id,
                    p.product_code product_code, p.product_name product_name,               
                    u.uom as product_uom,
                    su.supplier as supplier,
                    concat(r.lname,', ',r.fname,' ',r.mname) as received_by,
                    st.status as status 
            FROM ((((pos_stock s
            LEFT JOIN (pos_product p  LEFT JOIN pos_uom u ON u.id=p.product_uom) ON p.id=s.product_id)
            LEFT JOIN pos_supplier su ON su.id=s.supplier_id)
            LEFT JOIN pos_user r ON r.id=s.received_by)
            LEFT JOIN pos_stock_status st ON st.id=s.status_id)";

?>