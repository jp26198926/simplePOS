<?php
                $pop = $mysqli->query($sql);
                    if ($pop){
                      $count = $pop->num_rows;
                      if ($count > 0){
                        while($row=$pop->fetch_object()){
                          $log_dt = $row->dt;
                          $module = $row->module;
                          $action = $row->action;
                          $particular = $row->particular;
                          $remarks = $row->remarks;
                          $user = strtoupper($row->user);                          
                          
                          echo "<tr>";
                          echo "  <td>{$log_dt}</td>";
                          echo "  <td>{$module}</td>";
                          echo "  <td>{$action}</td>";
                          echo "  <td>{$particular}</td>";
                          echo "  <td>{$remarks}</td>";
                          echo "  <td>{$user}</td>";
                          echo "</tr>";
                        }
                      }else{
                        echo "<tr><td colspan='6'>No Record to Display</td></tr>";
                      }
                    }else{
                      echo "<tr><td colspan='6'>" . $mysqli->error . "</td></tr>";
                    }
?>