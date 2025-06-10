<?php
    include('validate.php');
    include('connect.php');
        
    // Determine action from GET or POST
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } elseif (isset($_POST['action'])) {
        $action = $_POST['action'];
    } else {
        // No action provided, return an error response and exit
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Action not specified.'
        ]);
        exit; // Stop further script execution
    }
    
    switch($action){
        case 1: //get data
            header('Content-Type: application/json');
            // Assuming pos_settings table always has one row.
            // SELECT * will fetch all columns from that single row.
            $sql = "SELECT * FROM pos_settings LIMIT 1"; 

            $response = array();
            $result = $mysqli->query($sql);
            
            if ($result) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_object(); // Fetch the single row as an object
                    
                    $response['status'] = 'success';
                    $response['data'] = $row; // The data is the single row object
                } else {
                    // This case would mean the table is empty,
                    // contradicting the "always has 1 row" assumption.
                    // You might want to handle this as an error or a specific "not found" state.
                    $response['status'] = 'error'; 
                    $response['message'] = 'Settings record not found in pos_settings.';
                    $response['data'] = null; 
                }
                $result->free(); // Free the result set
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Database Query Error: ' . $mysqli->error;
                $response['data'] = null;
            }
            echo json_encode($response);
            break;
        
        
        case 2: //update
            header('Content-Type: application/json');
            $response = array();

            // Check if the value is received from the client
            if (isset($_POST['allow_gst_free'])) {
                $new_value_from_client = $_POST['allow_gst_free'];

                // Basic validation: ensure it's 0 or 1
                // You might want to add more robust validation depending on your needs
                if ($new_value_from_client === '0' || $new_value_from_client === '1') {
                    $new_value = (int)$new_value_from_client;

                    // Update the value in the database
                    // Assuming there's only one row in pos_settings, or you want to update all rows.
                    // If you have a specific row ID (e.g., id=1 for the settings row), add a WHERE clause:
                    // $sql_update = "UPDATE pos_settings SET allow_gst_free = ? WHERE id = 1";
                    $sql_update = "UPDATE pos_settings SET allow_gst_free = ?";
                    
                    $stmt = $mysqli->prepare($sql_update);
                    if ($stmt) {
                        $stmt->bind_param("i", $new_value);
                        if ($stmt->execute()) {
                            if ($stmt->affected_rows > 0) {
                                $response['status'] = 'success';
                                $response['message'] = 'allow_gst_free updated successfully.';
                                $response['updated_value'] = $new_value;
                            } else {
                                // This could mean the value was already set to the new value,
                                // or no row was updated (e.g., if a WHERE clause didn't match, though not used here).
                                $response['status'] = 'success'; // Or 'notice'
                                $response['message'] = 'allow_gst_free was already set to this value or no row updated.';
                                $response['updated_value'] = $new_value;
                            }
                        } else {
                            $response['status'] = 'error';
                            $response['message'] = 'Execute failed: ' . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Prepare failed: ' . $mysqli->error;
                    }
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Invalid value received for allow_gst_free. Must be 0 or 1.';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Required parameter "allow_gst_free_value" not provided.';
            }
            echo json_encode($response);
            break;                          
        
        
        default:
            echo "Error: Critical Error Encountered!";
    }
?>