<?php
    $sql = "SELECT u.id as id, u.username as username, concat(u.lname,', ',u.fname,' ',u.mname) as fullname,
                                   u.status_id as status_id, u.access_id as access_id,
                                    d.dept_name as dept, a.access_details as access, s.status as status
                            FROM ((pos_user u
                            LEFT JOIN pos_dept d ON d.id=u.dept_id)
                            LEFT JOIN pos_access a ON a.id=u.access_id)
                            LEFT JOIN pos_user_status s ON s.id=u.status_id
                             ";
?>