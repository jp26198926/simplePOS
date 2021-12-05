<?php
    $pop = $mysqli->query($sql);
                    if ($pop){
                      while($row=$pop->fetch_object()){
                        $id = $row->id;
                        $username = $row->username;
                        $fullname = ucwords($row->fullname);
                        $dept = $row->dept;
                        $access = strtoupper($row->access);
                        $status = $row->status;
                        $status_id = $row->status_id;
                        $access_id = $row->access_id;
                        
                        if ($access_id==1){
                          echo "<tr class='info'>";
                        }else{
                          if ($status_id==2){
                            echo "<tr class='danger'>";
                          }else{
                            echo "<tr>";
                          }
                        }                        
                        
                        echo "  <td>";
                        echo "    <a id='{$id}' class='btn_user_modify btn btn-info btn-xs fa fa-pencil' title='Modify User Info' data-toggle='tooltip'></a>";
                        
                        if ($status_id==1){
                            echo "    <a id='{$id}' class='btn_user_deactivate btn btn-danger btn-xs fa fa-times' title='Deactivate User' data-toggle='tooltip'></a>";
                        }else{
                            echo "    <a id='{$id}' class='btn_user_activate btn btn-success btn-xs fa fa-check' title='Activate User' data-toggle='tooltip'></a>";
                        }
                        
                        echo "    <a id='{$id}' class='changepass btn btn-warning btn-xs fa fa-refresh' title='Change Password' data-toggle='tooltip'></a>";
                        echo "  </td>";
                        echo "  <td>{$username}</td>";
                        echo "  <td>{$fullname}</td>";
                        echo "  <td>{$dept}</td>";
                        
                        if ($access_id===1){
                          echo "  <td class='info'>{$access}</td>";
                        }else{
                          echo "  <td>{$access}</td>";
                        }
                        
                        echo "  <td>{$status}</td>";
                        echo "</tr>";
                      }
                    }else{
                      echo "<tr>";
                      echo "<td colspan='6'>" . $mysqli->error . "</td>";
                      echo "</tr>";
                    }
?>