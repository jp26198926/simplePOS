<?php

$sql = "SELECT  p.id as id, p.product_code product_code, p.product_name product_name,
                    p.status_id as status_id, p.product_uom as p_uom,
                    u.uom as product_uom, u.description as uom_description,
                    c.category,
                    s.status as status,
                    (
                    	select sum(qty) 
                    	from pos_stock 
                    	where (product_id=p.id AND status_id=1) AND (dt <= '{$dt_ending}')
                    	group by product_id
                    ) as stock,
                    (
                    	select sum(qty) 
                    	from pos_sale 
                    	where (product_id=p.id AND status_id=1) AND (dt <= '{$dt_ending}')
                    	group by product_id
                    ) as sale

            FROM (pos_product p
            LEFT JOIN pos_product_status s ON s.id=p.status_id
            LEFT JOIN pos_category c ON c.id=p.category_id)
            LEFT JOIN pos_uom u ON u.id=p.product_uom ";
