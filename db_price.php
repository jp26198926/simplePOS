<?php
    include('validate.php');
    include('connect.php');
        
    $action = $_POST['action'];
    
    switch($action){
        case 1: //reload
            echo reload_price('');
            
           /*
            echo "<thead>";                                 
                                  
            echo "  <tr>";
            echo "    <th>CODE</th>";
            echo "    <th>PRODUCT</th>"; 
                                      
                                    
            $buyer_list = array();
                                      
            $sql = "SELECT id, type FROM pos_buyer WHERE status_id=1 ORDER BY type;";
            $pop = $mysqli->query($sql);
            if ($pop){
                $buyer_count = $pop->num_rows + 2;
                                        
                while($row=$pop->fetch_object()){
                    $buyer_id = $row->id;
                    $buyer_type = strtoupper($row->type . '');                                          
                    echo "<th>{$buyer_type}</th>";
                                          
                    array_push($buyer_list,$buyer_id);
                }
            }                                      
                                                                          
            echo "  </tr>";
                                    
            echo "</thead>";
            echo "<tbody>";
                                    
            $sql = "SELECT
                            p.id as id, p.product_code as code, p.product_name as product
                    FROM pos_product p                                           
                    ORDER BY p.product_name;";
                                    
            $pop = $mysqli->query($sql);
            if ($pop){
                $prod_count = $pop->num_rows;
                if ($prod_count > 0){
                    while($rowp = $pop->fetch_object()){
                        $p_id = $rowp->id;
                        $code = $rowp->code;
                        $product = $rowp->product;
                                                                                    
                        echo "<tr>";
                        echo "<td>{$code}</td>";
                        echo "<td>{$product}</td>";
                                          
                        foreach($buyer_list as  &$value){
                            $buyer_value = $value;
                            $price_sql = "SELECT i.id as price_id, i.price as price
                                          FROM pos_price i
                                           WHERE i.buyer_id={$buyer_value} AND i.product_id={$p_id};";
                                                          
                            $price_pop = $mysqli->query($price_sql);
                                            
                            if ($price_pop){
                                $price_count = $price_pop->num_rows;
                                if ($price_count > 0){
                                    $price_row = $price_pop->fetch_object();
                                                
                                    $price_id = $price_row->price_id;
                                    $price_price = number_format($price_row->price,2,'.',',');
                                                 
                                    echo "<td align='right'><a href='#' id='{$price_id}' class='price_modify'>{$price_price}</a></td>";
                                                
                                }else{
                                    $price_add_id = $buyer_value . ":~|~:" . $p_id;
                                    echo "<td align='center'><a href='#' id='{$price_add_id}' class='price_add'>Set Price</a></td>";
                                }
                            }else{
                                echo "<td align='center'>Error</td>";
                            }
                        }
                                          
                        echo "</tr>";
                    }
                }else{
                    echo "<td colspan='{$buyer_count}'>No Product Found</td>";
                }
            }                                    
                                    
            echo "</tbody>";     
            */
           
            break;
        
        case 2: //search
            $mysearch = $_POST['mysearch'];
            
            echo reload_price($mysearch);
            
            //$_SESSION['price_search'] = $mysearch;
            
            //save to Trail
            //$trail_query = "INSERT INTO pos_trail (dt,module_id,action_id,particular,remarks,user_id)
            //                VALUES ('{$dt}',2,8,'{$mysearch}','',$uid);";
            //$trail_save = $mysqli->query($trail_query);
            //end of Trail
            
            break;
        
        case 3: //get product Info
            $product_id = $_POST['product_id'];
            $buyer_id = $_POST['buyer_id'];
            
            if ($product_id && $buyer_id){
                $sql = "SELECT  p.product_code as product_code, p.product_name as product_name,
                                u.uom as product_uom
                        FROM pos_product p
                        LEFT JOIN pos_uom u ON u.id=p.product_uom
                        WHERE p.id={$product_id};";
                        
                $exec = $mysqli->query($sql);
                        
                if ($exec){
                    
                    $row=$exec->fetch_object();
                            
                    $product_code = $row->product_code;
                    $product_name = $row->product_name;
                    $product_uom = $row->product_uom;
                                                
                    echo $product_code . ":|:" . $product_name . ":|:" . $product_uom;
                    
                    $sql1 = "SELECT type FROM pos_buyer WHERE id={$buyer_id};";
                    $exec1 = $mysqli->query($sql1);
                    if ($exec1){
                        $row1 = $exec1->fetch_object();
                        
                        $buyer = $row1->type;
                        
                        echo ":|:" . $buyer;
                        
                    }else{
                        echo "Error: " . $mysqli->error;
                    }
                    
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }
            
            break;
        
        case 4: //save price
            $product_id = $_POST['product_id'];
            $buyer_id = $_POST['buyer_id'];
            $amount = floatval($_POST['amount']);
            
            if ($product_id && $buyer_id && $amount){
                $sql = "INSERT INTO pos_price (buyer_id,product_id,price,dt_updated,updated_by)
                        VALUES ({$buyer_id},{$product_id},{$amount},'{$dt}',{$uid});";
                
                $exec = $mysqli->query($sql);
                
                if ($exec){
                    //reload price table\
                    
                    $search = '';
                    
                    if (isset($_SESSION['price_search'])){
                        $search = $_SESSION['price_search'];
                    }
                    echo reload_price($search);
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }            
            
            break;
        
        case 5:
            $id = $_POST['id'];

            if ($id){
                $sql = "SELECT p.id as product_id, p.product_code, p.product_name,
                               b.type, r.price,
                               u.uom
                        FROM pos_price r
                        LEFT JOIN pos_buyer b ON b.id = r.buyer_id
                        LEFT JOIN pos_product p ON p.id = r.product_id
                        LEFT JOIN pos_uom u ON u.id = p.product_uom
                        WHERE r.id = {$id}";
                
                $exec = $mysqli->query($sql);
                
                if ($exec){
                    echo json_encode($exec->fetch_object());
                }else{
                    echo "Error: " . $mysqli->error;
                }

            }else{
                echo "Error: Critical Error Encountered!";
            }
            break;

        case 6:
            $id = intval($_POST['id']);            
            $amount = floatval($_POST['amount']);
            $product_id = intval($_POST['product_id']);
            $remarks = trim($_POST['remarks'] . '');
            
            if ($id){
                $sql = "UPDATE pos_price
                        SET
                            price = {$amount},
                            dt_updated = '{$dt}',
                            updated_by = {$uid}
                        WHERE id={$id};
                        INSERT INTO pos_trail_price (product_id,price,created_by,remarks)
                        VALUES ({$product_id},{$amount},{$uid},'{$remarks}');";
                
                $exec = $mysqli->multi_query($sql);
                
                if ($exec){
                    //reload price table\                    
                    $search = '';
                    
                    if (isset($_SESSION['price_search'])){
                        $search = $_SESSION['price_search'];
                    }
                    echo reload_price($search);
                }else{
                    echo "Error: " . $mysqli->error;
                }
            }else{
                echo "Error: Critical Error Encountered!";
            }      
            break;
        default:
            echo "Error: Critical Error Encountered!";
    }
    
    function reload_price($search){
            include('connect.php');
            
            $search = trim($search);
            
            $_SESSION['price_search'] = $search;
            
            $result;
        
            $result =  "<thead>";                                 
                                  
            $result .=  "  <tr>";
            $result .=  "    <th>CODE</th>";
            $result .=  "    <th>PRODUCT</th>"; 
                                      
                                    
            $buyer_list = array();
                                      
            $sql = "SELECT id, type FROM pos_buyer WHERE status_id=1 ORDER BY type;";
            $pop = $mysqli->query($sql);
            if ($pop){
                $buyer_count = $pop->num_rows + 2;
                                        
                while($row=$pop->fetch_object()){
                    $buyer_id = $row->id;
                    $buyer_type = strtoupper($row->type . '');                                          
                    $result .=  "<th>{$buyer_type}</th>";
                                          
                    array_push($buyer_list,$buyer_id);
                }
            }                                      
                                                                          
            $result .=  "  </tr>";
                                    
            $result .=  "</thead>";
            $result .=  "<tbody>";
                                    
            $sql = "SELECT
                            p.id as id, p.product_code as code, p.product_name as product
                    FROM pos_product p ";
           
            if ($search && $search != ""){
                $sql .= " WHERE CONCAT_WS(' ',p.product_code,p.product_name) LIKE '%{$search}%' ";
            }
                    
            $sql .= "ORDER BY p.product_name;";
                                    
            $pop = $mysqli->query($sql);
            if ($pop){
                $prod_count = $pop->num_rows;
                if ($prod_count > 0){
                    while($rowp = $pop->fetch_object()){
                        $p_id = $rowp->id;
                        $code = $rowp->code;
                        $product = $rowp->product;
                                                                                    
                        $result .=  "<tr>";
                        $result .=  "<td>{$code}</td>";
                        $result .=  "<td>{$product}</td>";
                                          
                        foreach($buyer_list as  &$value){
                            $buyer_value = $value;
                            $price_sql = "SELECT i.id as price_id, i.price as price
                                          FROM pos_price i
                                           WHERE i.buyer_id={$buyer_value} AND i.product_id={$p_id};";
                                                          
                            $price_pop = $mysqli->query($price_sql);
                                            
                            if ($price_pop){
                                $price_count = $price_pop->num_rows;
                                if ($price_count > 0){
                                    $price_row = $price_pop->fetch_object();
                                                
                                    $price_id = $price_row->price_id;
                                    $price_price = number_format($price_row->price,2,'.',',');
                                                 
                                    $result .=  "<td align='right'><a href='#' id='{$price_id}' class='price_modify'>{$price_price}</a></td>";
                                                
                                }else{
                                    $price_add_id = $p_id . ":~|~:" . $buyer_value;
                                    $result .=  "<td align='center'><a href='#' id='{$price_add_id}' class='price_add'>Set Price</a></td>";
                                }
                            }else{
                                $result .=  "<td align='center'>Error</td>";
                            }
                        }
                                          
                        $result .=  "</tr>";
                    }
                }else{
                    $result .=  "<td colspan='{$buyer_count}'>No Product Found</td>";
                }
            }                                    
                                    
            $result .=  "</tbody>";
            
            return $result;
        
            $mysqli->close();
    }
    
    $mysqli->close();
?>