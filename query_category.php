<?php

$sql = "SELECT
                b.id as id, b.category, b.status_id as status_id,
                s.status as status
            FROM pos_category b
            LEFT JOIN pos_category_status s ON s.id=b.status_id
            ";
