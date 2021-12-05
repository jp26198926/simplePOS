<?php
                $pop = $mysqli->query($sql);
                    if ($pop){
                      $count = $pop->num_rows;
                      if ($count > 0){
                        while($row=$pop->fetch_object()){
                          $log_dt = $row->dt;
                          $username = $row->username;
                          $user = strtoupper($row->user);
                          $local_ip = $row->local_ip;
                          $public_ip = $row->public_ip;
                          $computer_name = $row->computer_name;
                          
                          echo "<tr>";
                          echo "  <td>{$log_dt}</td>";
                          echo "  <td>{$username}</td>";
                          echo "  <td>{$user}</td>";
                          echo "  <td>{$local_ip}</td>";
                          echo "  <td>{$public_ip}</td>";
                          echo "  <td>{$computer_name}</td>";
                          echo "</tr>";
                        }
                      }else{
                        echo "<tr><td colspan='6'>No Record to Display</td></tr>";
                      }
                    }else{
                      echo "<tr><td colspan='6'>" . $mysqli->error . "</td></tr>";
                    }
?>