<?php
    $sql = "SELECT l.dt as dt, l.local_ip as local_ip, l.public_ip as public_ip, l.computer_name as computer_name,
                                    u.username as username, CONCAT(u.lname,', ',u.fname,' ',u.mname) as user
                            FROM pos_trail_login l
                            LEFT JOIN  pos_user u ON u.id=l.user_id
                            ";
?>