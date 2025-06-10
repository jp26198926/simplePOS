<?php
include('validate.php');
include('config.php');
$mnu = 'menu_admin';
?>

<!DOCTYPE html>
<html>

<head>
  <title><?= $app_name; ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
    include("layout_style.php");
  ?>

</head>

<body>

  <?php
  include('win_user_new.php');
  include('win_user_modify.php');
  include('win_user_changepass.php');
  include('loading.php');
  ?>

  <div class="app app-default">

    <?php include('sidebar.php'); ?>

    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
      <div class="dropdown-background">
        <div class="bg"></div>
      </div>
      <div class="dropdown-container">
        {{list}}
      </div>
    </script>

    <div class="app-container">

      <nav class="navbar navbar-default" id="navbar">
        <div class="container-fluid">
          <div class="navbar-collapse collapse in">
            <ul class="nav navbar-nav navbar-mobile">
              <li>
                <button type="button" class="sidebar-toggle">
                  <i class="fa fa-bars"></i>
                </button>
              </li>
              <li class="logo">
                <a class="navbar-brand" href="#"><span class="highlight">Simple</span> POS</a>
              </li>
              <li>
                <button type="button" class="navbar-toggle">
                  <img class="profile-img" src="./assets/images/profile.png">
                </button>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-left">
              <li class="navbar-title">
                <span class='fa fa-gear fa-2x'></span>
                <span class="highlight" style='margin-left: 0.5em;'> SETTINGS </span>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

              <?php include('profile.php'); ?>

            </ul>

            <?php //include('profile.php');
            ?>

          </div>
        </div>
      </nav>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 text-right">Station No.</div>
                <div class="col-md-1">
                  <input type="number" id="station_id" class="form-control" value="0" />
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-3 text-right">Allow GST Free </div>
                <div class="col-md-9">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="allow_gst_free">
                    <label class="form-check-label" for="allow_gst_free"></label>
                  </div>
                  <small id="allowFreeGstHelp" class="form-text text-muted">When checked, products marked as "GST Free" will have no GST applied.</small>
                
                </div>
              </div>

            </div>
            <hr />
            <div class="card-footer" style="padding-bottom: 1em;">
              <div class="text-center">
                <button id="btn_settings_save" class="btn btn-success">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        include('footer.php');
        include('modal_alert.php');
      ?>

    </div>

  </div>

  <?php
      include("layout_script.php");
      include('menu-active.php');
  ?>

  <script>

    async function loadSettings() {
        try {
            const response = await fetch('db_settings.php?action=1', { // Added action=1 to GET request
                method: 'GET', // Assuming GET request for fetching data
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                let errorText = `HTTP error! status: ${response.status}`;
                try {
                    const errorData = await response.json();
                    if (errorData && errorData.message) {
                        errorText = errorData.message;
                    }
                } catch (e) {
                     errorText = `HTTP error! status: ${response.status} - ${response.statusText}`;
                }
                throw new Error(`Failed to load settings: ${errorText}`);
            }

            const result = await response.json();

            if (result && result.status === 'success' && result.data) {
                // Assuming result.data is an object and contains allow_gst_free
                const allowGstFreeValue = result.data.allow_gst_free;
                if (allowGstFreeValue === '1' || allowGstFreeValue === 1) {
                    $("#allow_gst_free").prop('checked', true);
                } else {
                    $("#allow_gst_free").prop('checked', false);
                }
                // You can also load and set station_id here if it's part of result.data
                // For example: if(result.data.station_id) $("#station_id").val(result.data.station_id);
            } else {
                let message = "Could not parse settings data.";
                if(result && result.message){
                    message = result.message;
                }
                console.error('Error loading settings:', message);
                // Optionally show an alert to the user
                // $("#modal_alert_message").text("Error loading initial settings: " + message);
                // $("#modal_alert").modal("show");
            }

        } catch (error) {
            console.error('Failed to fetch initial settings:', error);
            // Optionally show an alert to the user
            // $("#modal_alert_message").text("Failed to load initial settings: " + error.message);
            // $("#modal_alert").modal("show");
        }
    }

    $(document).ready(function() {
        loadSettings(); // Load settings when the document is ready

        // Load station_id from local storage if it exists (existing functionality)
        const storedStationId = getFromLocalStorage('station_id');
        if (storedStationId) {
            $("#station_id").val(storedStationId);
            $(".station_id").text(storedStationId);
        }
    });

    $(document).on("click","#btn_settings_save", async function(){ // Made the function async
        let station_id = $("#station_id").val();
        let allow_gst_free_checked = $("#allow_gst_free").is(":checked");
        let allow_gst_free_value = allow_gst_free_checked ? 1 : 0;

        //call function from assets/js/function.js
        saveToLocalStorage('station_id', station_id);
        $(".station_id").text(station_id); // Assuming this updates some UI element

        const formData = new URLSearchParams();
        formData.append('action', '2'); // Action for updating settings
        formData.append('allow_gst_free', allow_gst_free_value); // Value from the checkbox
        // If you want to save station_id to the database as well, add it here:
        // formData.append('station_id', station_id); 
        // And ensure your db_settings.php (case 2) handles it.

        try {
            const response = await fetch('db_settings.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData
            });

            if (!response.ok) {
                // Attempt to get a more specific error message from server if possible
                let errorText = `HTTP error! status: ${response.status}`;
                try {
                    const errorData = await response.json();
                    if (errorData && errorData.message) {
                        errorText = errorData.message;
                    }
                } catch (e) {
                    // If response is not JSON or another error occurs during error parsing, stick with statusText or default
                    errorText = `HTTP error! status: ${response.status} - ${response.statusText}`;
                }
                throw new Error(errorText);
            }

            const data = await response.json(); // Parse the JSON response from the server

            let message = "An unexpected response occurred."; // Default message, changed from var to let
            if (data) {
                if (data.message) {
                    message = data.message;
                } else if (data.status === 'success') {
                    message = "Settings saved successfully!";
                } else if (data.status === 'error') {
                    message = "Error saving settings: " + (data.message || "Unknown server error");
                }
            }
            
            // Assuming your modal_alert.php has an element with id="modal_alert_message"
            $("#modal_alert_message").text(message);
            $("#modal_alert").modal("show");

        } catch (error) {
            console.error('Save Settings Error:', error);
            // Display error message in the modal
            $("#modal_alert_message").text("Failed to save settings: " + error.message);
            $("#modal_alert").modal("show");
        }
    });
  </script>

</body>

</html>
