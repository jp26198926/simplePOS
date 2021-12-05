<?php
include('validate.php');
$mnu = "menu_main";
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
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/yellow.css">

</head>

<body>

  <?php
  include('win_user_changepass.php');
  include('loading.php');
  ?>

  <div class="app app-default">

    <?php
    include('sidebar.php');
    ?>

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
              <li class="navbar-title"><span class='fa fa-tasks fa-2x'></span><span class="highlight" style='margin-left: 0.5em;'> Dashboard</span></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <?php include('profile.php'); ?>
            </ul>

          </div>
        </div>
      </nav>

      <?php include('help.php');
      ?>

      <?php
      if ($uaccess != 2 && $uaccess != 5) { //not user and not report only
      ?>

        <div class="row">
          <div class="col-xs-12">
            <div class="card card-banner card-chart card-green no-br">
              <div class="card-header">
                <div class="card-title">
                  <div class="title">Top Sale Today</div>
                </div>
                <ul class="card-action">
                  <li>
                    <a href="/">
                      <i class="fa fa-refresh"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="ct-chart-sale"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a class="card card-banner card-green-light">
              <div class="card-body">
                <i class="icon fa fa-shopping-basket fa-4x"></i>
                <div class="content">
                  <div class="title">Sale Today</div>
                  <div class="value"><span class="sign">K</span> <span id='dash_sales'>0.00</span></div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <a class="card card-banner card-blue-light">
              <div class="card-body">
                <i class="icon fa fa-thumbs-o-up fa-4x"></i>
                <div class="content">
                  <div class="title">Transaction</div>
                  <div class="value"><span class='sign'></span><span id='dash_transaction'>0</span></div>
                </div>
              </div>
            </a>
          </div>


          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <a class="card card-banner card-yellow-light">
              <div class="card-body">
                <i class="icon fa fa-cubes fa-4x"></i>
                <div class="content">
                  <div class="title">Running-out Stock</div>
                  <div class="value"><span id='dash_stock' data-toggle='tooltip'>0.0</span><span id='dash_uom' class='sign'></span></div>
                </div>
              </div>
            </a>
          </div>

        </div>

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card card-mini">
              <div class="card-header">
                <div class="card-title">Product Monitoring</div>
                <ul class="card-action">
                  <li>
                    <a href="/">
                      <i class="fa fa-refresh"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body no-padding table-responsive">
                <table id="tbl_product_list_mon" class="tbl_product_list table table-bordered table-hover table-striped" cellspacing="0" width="100%" style="font: 90% Trebuchet MS; ">
                  <thead>
                    <tr>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Stock</th>
                      <th>UOM</th>
                      <!--
                                    <th>Selling Price</th>
                                    -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    /*
                                    include('connect.php');

                                    include('query_product.php');
                                    $sql .= ' ORDER BY p.product_name;';

                                    include('pop_product_dashboard.php');

                                    $mysqli->close();
                                  */
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      <?php
      }
      ?>

      <?php include('footer.php'); ?>

    </div>

  </div>

  <script type="text/javascript" src="./assets/js/vendor.js"></script>
  <script type="text/javascript" src="./assets/js/app.js"></script>
  <script type="text/javascript" src="./assets/js/changepass.js"></script>


  <?php
  include('menu-active.php');
  ?>

  <script>
    function sales() {
      $.post("db_dashboard.php", {
        action: 1
      }, function(data) {
        $('#dash_sales').text(data);
      });
    }

    function transaction() {
      $.post("db_dashboard.php", {
        action: 2
      }, function(data) {
        $('#dash_transaction').text(data);
      });
    }

    function out_stock() {
      $.post("db_dashboard.php", {
        action: 3
      }, function(data) {
        $('#dash_stock').text(data.split(':~|~:')[0]);
        $('#dash_uom').text(data.split(':~|~:')[1]);

        $("#dash_stock").attr("data-original-title", data.split(':~|~:')[2]);

        $('[data-toggle="tooltip"]').tooltip({
          html: true
        });

      });
    }

    function current_product() {
      $.post("db_dashboard.php", {
        action: 5
      }, function(data) {

        if (data.indexOf("<!DOCTYPE html>") > -1) {
          //showError('Simple POS',"Error: Session Time-Out, You must login again to continue.");
          //location.reload(true);                     
        } else if (data.indexOf("Error: ") > -1) {
          //showError('Simple POS', data);                 
        } else {
          $("#tbl_product_list_mon tbody").html(data);

          $('[data-toggle="tooltip"]').tooltip({
            html: true
          });
        }

      });
    }

    function sale_chart(label_array, total_array) {

      if ($('.ct-chart-sale').length) {
        new Chartist.Line('.ct-chart-sale', {
          //labels: ["06:00","07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"],
          //series: [[0, 6000, 4210, 8010, 19158, 35326, 80837, 79477, 88561, 67807, 70837, 55261, 66216, 10516, 13493]],
          labels: label_array,
          series: [total_array]
        }, {
          axisX: {
            position: 'center'
          },
          axisY: {
            offset: 0,
            showLabel: false,
            labelInterpolationFnc: function labelInterpolationFnc(value) {
              return value; // / 1000 + 'k';
            }
          },
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          },
          //height: 250,
          //high: 120000,
          height: 250,
          high: 3000,
          showArea: true,
          stackBars: true,
          fullWidth: true,
          lineSmooth: false,
          plugins: [Chartist.plugins.ctPointLabels({
            textAnchor: 'left',
            labelInterpolationFnc: function labelInterpolationFnc(value) {
              return 'K ' + parseInt(value); // / 1000) + 'k';
            }
          })]
        }, [
          ['screen and (max-width: 768px)', {
            axisX: {
              offset: 0,
              showLabel: false
            },
            height: 180
          }]
        ]);
      }
    }

    function sale_graph() {
      $.post("db_dashboard.php", {
        action: 4
      }, function(data) {
        var label = $.parseJSON(data.split(':~|~:')[0]);
        var total = $.parseJSON(data.split(':~|~:')[1]);

        sale_chart(label, total);
        //$('.ct-chart-sale').update();
      });
    }

    $(document).ready(function() {

      setInterval(function() {
        sales();
        transaction();
        out_stock();
        sale_graph();
        current_product();
      }, 1000);

    })
  </script>

</body>

</html>