<?php
     $sql = "SELECT t.dt as dt, m.module_name as module, a.action_name as action,
                                   t.particular as particular, t.remarks as remarks,
                                   concat(u.lname, ', ', u.fname, ' ', u.mname) as user
                            FROM pos_trail t
                            LEFT JOIN pos_module m ON m.id=t.module_id
                            LEFT JOIN pos_action a ON a.id=t.action_id
                            LEFT JOIN pos_user u ON u.id=t.user_id ";  
?>