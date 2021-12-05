<?php
include('validate.php');
$mnu = 'menu_admin';
?>

<!DOCTYPE html>
<html>

<head>
  <title>Simple POS</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="./assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/red.css">

  <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap-dialog.css">

  <!-- Quotes -->
  <link rel="stylesheet" type="text/css" href="./assets/css/qoutes.css">


</head>

<body>

  <?php
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
              <li class="navbar-title"><span class='fa fa-key fa-2x'></span><span class="highlight" style='margin-left: 0.5em;'> TRANSACTION HISTORY</span></li>
              <li class="navbar-search hidden-sm">
                <input id="txt_trail_transaction_search" type="text" placeholder="Search..">
                <button id="btn_trail_transaction_search" class="btn-search"><i class="fa fa-search"></i></button>
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
        <div class="col-xs-12">
          <div class="card">

            <div class="card-body no-padding">
              <table id="tbl_trail_transaction_list" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%" style="font: 90% Trebuchet MS; ">
                <thead>
                  <tr>
                    <th>DateTime</th>
                    <th>Module</th>
                    <th>Action</th>
                    <th>Particular</th>
                    <th>Remarks</th>
                    <th>Performed By</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  include('connect.php');

                  include('query_trail_transaction.php');

                  $sql .= " WHERE DATE(t.dt)=CURDATE()";
                  $sql .= " ORDER BY t.id DESC;";

                  include('pop_trail_transaction.php');

                  $mysqli->close();

                  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php'); ?>

    </div>

  </div>

  <script type="text/javascript" src="./assets/js/vendor.js"></script>
  <script type="text/javascript" src="./assets/js/app.js"></script>

  <script type="text/javascript" src="./assets/js/bootstrap-dialog.js"></script>
  <script type="text/javascript" src="./assets/js/functions.js"></script>

  <script>
    $(document).ready(function() {

      $(document).on("keypress", "#txt_trail_transaction_search", function(e) {
        if (e.which == 13) {
          $("#btn_trail_transaction_search").trigger("click");
        }
      })

      $(document).on("click", "#btn_trail_transaction_search", function(e) {
        e.preventDefault();

        var txt_search = $("#txt_trail_transaction_search").val();

        $("#loading").modal();

        $.post("db_trail.php", {
          action: 2,
          mysearch: txt_search
        }, function(data) {

          $("#loading").modal('hide');

          if (data.indexOf("<!DOCTYPE html>") > -1) {
            showError('Simple POS', "Error: Session Time-Out, You must transaction again to continue.");
            location.reload(true);
          } else if (data.indexOf("Error: ") > -1) {
            //alert(data);
            showError('Simple POS', data);
            $("#txt_trail_transaction_search").focus().select();
          } else {
            $("#tbl_trail_transaction_list tbody").html(data);

            $("#txt_trail_transaction_search").focus().select();

            $('[data-toggle="tooltip"]').tooltip({
              html: true
            });
          }
        });

      })
    });
  </script>

  <script type="text/javascript" src="./assets/js/changepass.js"></script>

  <?php
  include('menu-active.php');
  ?>



</body>

</html>