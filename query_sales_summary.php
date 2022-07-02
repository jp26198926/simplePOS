<?php

$sql = "SELECT SUM(s.qty) as qty,
                    SUM(IF(s.buyer_id=1,s.qty,0)) as qty_insider,
                    SUM(IF(s.buyer_id=2,s.qty,0)) as qty_outsider,
                    SUM(IF(s.buyer_id=3,s.qty,0)) as qty_kitchen,
                    SUM(IF(s.buyer_id=4,s.qty,0)) as qty_sale,
                    
                    SUM(s.discount_total) as discount_total,
                    SUM(IF(s.buyer_id=1,s.discount_total,0)) as discount_insider,
                    SUM(IF(s.buyer_id=2,s.discount_total,0)) as discount_outsider,
                    SUM(IF(s.buyer_id=3,s.discount_total,0)) as discount_kitchen,
                    SUM(IF(s.buyer_id=4,s.discount_total,0)) as discount_sale,
                                        
                    SUM(s.total) as total,
                    SUM(IF(s.buyer_id=1,s.total,0)) as total_insider,
                    SUM(IF(s.buyer_id=2,s.total,0)) as total_outsider,
                    SUM(IF(s.buyer_id=3,s.total,0)) as total_kitchen,
                    SUM(IF(s.buyer_id=4,s.total,0)) as total_sale,
                    
                    u.uom as uom,
                    c.category,
                    p.product_code as product_code, p.product_name as product_name 
            FROM (pos_sale s
            LEFT JOIN (pos_product p 
                        LEFT JOIN pos_uom u ON u.id=p.product_uom
                        LEFT JOIN pos_category c ON c.id=p.category_id
                      ) ON p.id=s.product_id) ";