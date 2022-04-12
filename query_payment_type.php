<?php

$sql = "SELECT
                b.id as id, b.payment_type, b.status_id as status_id,
                s.status as status
            FROM pos_payment_type b
            LEFT JOIN pos_payment_type_status s ON s.id=b.status_id
            ";
