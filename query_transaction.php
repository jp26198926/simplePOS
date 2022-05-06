<?php

$sql = "SELECT t.id as id, t.dt as dt, t.subtotal as subtotal, CONCAT(DATE_FORMAT(t.dt, '%y'),LPAD(t.id,8,'0')) as receipt,
                    t.discount_total as discount, t.discount_type as discount_type, t.discount_qty as discount_qty,
                    t.total as amount_due, t.remarks as remarks, t.status_id as status_id,
                    d.discount_type as discount_type_word,
                    CONCAT(u.lname,', ',u.fname,' ',u.mname) as cashier,
                    s.status as status,
                    t.reference, pt.payment_type,
                    t.gst_percent,
                    t.gst_value,
                    t.tax_base
            FROM ((((pos_transaction t
            LEFT JOIN pos_transaction_discount d ON d.id=t.discount_type)
            LEFT JOIN pos_user u ON u.id=t.user_id)
            LEFT JOIN pos_transaction_status s ON s.id=t.status_id) 
            LEFT JOIN pos_payment_type pt on pt.id=t.payment_type_id)";
