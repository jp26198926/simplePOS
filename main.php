<?php
include('validate.php');
include('config.php');
$mnu = "menu_main";
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
                    <a href="main.php">
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

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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


          <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <a class="card card-banner card-yellow-light">
              <div class="card-body">
                <i class="icon fa fa-cubes fa-4x"></i>
                <div class="content">
                  <div class="title">Running-out Stock</div>
                  <div class="value"><span id='dash_stock' data-toggle='tooltip'>0.0</span><span id='dash_uom' class='sign'></span></div>
                </div>
              </div>
            </a>
          </div> -->

        </div>

        <!-- <div class="row">
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
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> -->

      <?php
      }
      ?>

      <?php include('footer.php'); ?>

    </div>

  </div>

  <?php
    include("layout_script.php");
    include('menu-active.php');
  ?>

  <script>
    let isRunning = false;

    function postData(endpoint, payload={}) {
      return new Promise((resolve, reject) => {
        $.post(endpoint, payload, function(data) {
          resolve(data);
        }).fail(function(error) {
          reject(error);
        });
      });
    }

    async function updateSales() {
      try {
        const data = await postData("db_dashboard.php",{ action: 1 });
        $('#dash_sales').text(data);
      } catch (error) {
        console.error('Error updating sales:', error);
      }
    }

    async function updateTransaction() {
      try {
        const data = await postData("db_dashboard.php", {action: 2});
        $('#dash_transaction').text(data);
      } catch (error) {
        console.error('Error updating transaction:', error);
      }
    }

    async function updateOutStock() {
      try {
        const data = await postData("db_dashboard.php", { action: 3});
        $('#dash_stock').text(data.split(':~|~:')[0]);
        $('#dash_uom').text(data.split(':~|~:')[1]);
        $("#dash_stock").attr("data-original-title", data.split(':~|~:')[2]);
        $('[data-toggle="tooltip"]').tooltip({ html: true });
      } catch (error) {
        console.error('Error updating out of stock:', error);
      }
    }

    async function updateCurrentProduct() {
      try {
        const data = await postData("db_dashboard.php", {action: 5});
        if (data.indexOf("<!DOCTYPE html>") > -1) {
          throw new Error('Session Time-Out. You must log in again to continue.');
        } else if (data.indexOf("Error: ") > -1) {
          throw new Error(data);
        } else {
          $("#tbl_product_list_mon tbody").html(data);
          $('[data-toggle="tooltip"]').tooltip({ html: true });
        }
      } catch (error) {
        console.error('Error updating current product:', error);
      }
    }

    async function updateSaleGraph() {
      try {
        const data = await postData("db_dashboard.php", {action: 4});
        const label = $.parseJSON(data.split(':~|~:')[0]);
        const total = $.parseJSON(data.split(':~|~:')[1]);
        sale_chart(label, total);
      } catch (error) {
        console.error('Error updating sale graph:', error);
      }
    }


    // function sales() {
    //   $.post("db_dashboard.php", {
    //     action: 1
    //   }, function(data) {
    //     $('#dash_sales').text(data);
    //   });
    // }

    // function transaction() {
    //   $.post("db_dashboard.php", {
    //     action: 2
    //   }, function(data) {
    //     $('#dash_transaction').text(data);
    //   });
    // }

    // function out_stock() {
    //   $.post("db_dashboard.php", {
    //     action: 3
    //   }, function(data) {
    //     $('#dash_stock').text(data.split(':~|~:')[0]);
    //     $('#dash_uom').text(data.split(':~|~:')[1]);

    //     $("#dash_stock").attr("data-original-title", data.split(':~|~:')[2]);

    //     $('[data-toggle="tooltip"]').tooltip({
    //       html: true
    //     });

    //   });
    // }

    // function current_product() {
    //   $.post("db_dashboard.php", {
    //     action: 5
    //   }, function(data) {

    //     if (data.indexOf("<!DOCTYPE html>") > -1) {
    //       //showError('Simple POS',"Error: Session Time-Out, You must login again to continue.");
    //       //location.reload(true);
    //     } else if (data.indexOf("Error: ") > -1) {
    //       //showError('Simple POS', data);
    //     } else {
    //       $("#tbl_product_list_mon tbody").html(data);

    //       $('[data-toggle="tooltip"]').tooltip({
    //         html: true
    //       });
    //     }

    //   });
    // }

    function sale_chart_old(label_array, total_array) {

      if ($('.ct-chart-sale').length) {
        new Chartist.Line('.ct-chart-sale', {
          // labels: ["00:00","01:00","02:00","03:00","04:00","05:00","06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00                                            "],
          // series: [
          //   [0, 60, 42, 80, 19, 35, 80, 79, 88, 67, 70, 55, 66, 505, 13, 15, 16, 17, 18, 19, 20, 21, 22, 23]
          // ],
          labels: label_array,
          series: [total_array]
        }, {
          axisX: {
            position: 'center'
          },
          axisY: {
            offset: 0,
            showLabel: true,
            labelInterpolationFnc: function labelInterpolationFnc(value) {
              return value; // / 1000 + 'k';
            }
          },
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 50
          },
          height: 500,
          high: 3000,
          showArea: true,
          stackBars: true,
          fullWidth: true,
          lineSmooth: true,
          plugins: [Chartist.plugins.ctPointLabels({
            textAnchor: 'center',
            labelInterpolationFnc: function labelInterpolationFnc(value) {
              return 'K ' + Number(value); // / 1000) + 'k';
            }
          })]
        }, [
          ['screen and (max-width: 768px)', {
            axisX: {
              offset: 0,
              showLabel: true
            },
            height: 180
          }]
        ]);
      }
    }

    function sale_chart(label_array, total_array) {
  // Check if the chart element exists
  if ($('.ct-chart-sale').length) {
    // Create a new Chartist Line chart
    new Chartist.Line('.ct-chart-sale', {
      labels: label_array,
      series: [total_array]
    }, {
      // Customize axis settings
      axisX: {
        // Consider removing 'position: 'center'' if not necessary
        position: 'center'
        //offset: 0
      },
      axisY: {
        //position: 'right',
        // offset: 0,
        showLabel: true,
        labelInterpolationFnc: function (value) {
          return value; // You can modify this function as needed
        }
      },
      chartPadding: {
        top: 50,
        right: 50,
        bottom: 0,
        left: 50
      },
      height: 350,
      high: 8000, // Adjust this based on your data range
      showArea: true,
      stackBars: false,
      fullWidth: false,
      lineSmooth: true,
      showPoint: true,
      // Add point labels plugin
      // plugins: [Chartist.plugins.ctPointLabels({
      //   // textAnchor: 'center',
      //   labelInterpolationFnc: function (value) {
      //     return 'K ' + Number(value);
      //   }
      // })]
    }, [
      // Responsive design settings
      ['screen and (max-width: 768px)', {
        axisX: {
          offset: 0,
          showLabel: true
        },
        height: 180
      }]
    ]);
  }
}

    // function sale_graph() {
    //   $.post("db_dashboard.php", {
    //     action: 4
    //   }, function(data) {
    //     var label = $.parseJSON(data.split(':~|~:')[0]);
    //     var total = $.parseJSON(data.split(':~|~:')[1]);

    //     sale_chart(label, total);
    //     //$('.ct-chart-sale').update();
    //   });
    // }

    // $(document).ready(function() {

    //   setInterval(function() {
    //     sales();
    //     transaction();
    //     out_stock();
    //     sale_graph();
    //     //current_product();
    //   }, 10000);

    // })

    $(document).ready(function() {
      setInterval(async function() {
        console.log("isRunning: " + isRunning);
        if (!isRunning){

          isRunning = true;

          const functionsToUpdate = [
            updateSales,
            updateTransaction,
            // updateOutStock,
            // updateCurrentProduct,
            updateSaleGraph
          ];

          try {

            await Promise.all(functionsToUpdate.map(async func => await func()));
            isRunning = false;
            console.log('All functions completed successfully.');
          } catch (error) {
            console.error('Error in one or more functions:', error);
          }
        }
      }, 10000);
    });

  </script>

</body>

</html>
