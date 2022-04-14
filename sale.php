<?php
include('validate.php');
include('config.php');
$mnu = 'menu_sale';
?>

<!DOCTYPE html>
<html>

<head>
  <title><?= $app_name; ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="./assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/yellow.css">

  <!-- Quotes -->
  <link rel="stylesheet" type="text/css" href="./assets/css/qoutes.css">

</head>

<body>
  <?php
  include('win_user_changepass.php');
  include('loading.php');

  include('win_sale_itemqty.php');
  include('win_sale_itemdiscount.php');
  include('win_sale_discount.php');
  include('win_sale_payment.php');
  ?>

  <input type='hidden' id='hidden_subtotal' value='0.00' />
  <input type='hidden' id='hidden_discount' value='0.00' />
  <input type='hidden' id='hidden_discount_qty' value='0.00' />
  <input type='hidden' id='hidden_discount_type' value='0' />
  <input type='hidden' id='hidden_amountdue' value='0.00' />

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
                <span class='fa fa-cart-plus fa-2x'></span>
                <span class="highlight" style='margin-left:0.5em'> SALE</span>
              </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

              <li>
                <label id="lbl_sale_time" class=" alert alert-success"></label>
              </li>

              <!-- <li class="dropdown notification danger">
                <a class="btn_sale_lock dropdown-toggle" data-toggle="dropdown">
                  <div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                  <div class="title">Prevent the cashier from selling of product</div>
                  <div class="count">L</div>
                </a>
                <div class="dropdown-menu">
                  <ul>
                    <li class="btn_sale_lock dropdown-empty">Prevent the cashier from selling of product</li>
                  </ul>
                </div>
              </li> -->

              <?php include('profile.php'); ?>
            </ul>

          </div>
        </div>
      </nav>

      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">

              <div class="col-sm-10">
                <div class="input-group has-success">
                  <input type='text' id='txt_sale_additem' tabindex='11' class='form-control' placeholder='Enter Product Code' />
                  <span id='btn_sale_additem' class="input-group-addon btn btn-success"><i class='fa fa-plus'></i></span>
                </div>
              </div <div class="col-sm-2 text-right">
              <select class="select2" id='txt_sale_buyer'>
                <?php
                include('connect.php');

                $sql = "SELECT id, type FROM pos_buyer WHERE status_id=1;";
                $pop = $mysqli->query($sql);
                if ($pop) {
                  while ($row = $pop->fetch_object()) {
                    $id = $row->id;
                    $buyer = $row->type;

                    echo "<option value='{$id}'>{$buyer}</option>";
                  }
                } else {
                  echo "<option value='0'>Error</option>";
                }

                $mysqli->close();
                ?>
              </select>
              <!--
                  <div class="checkbox checkbox-inline">
                    <input type="checkbox" id="checkbox3">
                    <label for="checkbox3">
                        Ask QTY
                    </label>
                  </div>
                  -->
            </div>

            <div class="card-body no-padding table-responsive" style="max-height: 38em; overflow-y: scroll;">
              <table id='tbl_sale_itemlist' class="table table-hover  table-striped">
                <thead>
                  <tr class="info">
                    <th class='text-success'></th>
                    <th class='text-success'>Products</th>
                    <th class='text-success text-center'>Qty</th>
                    <th class='text-success text-center'>Type</th>
                    <th class='text-success text-right'>Price</th>
                    <th class='text-success text-center'>Discount</th>
                    <th class='text-success text-right'>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="7" class="text-center">No Product to Purchase Yet</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <a class="card card-banner card-green-light">
            <div class="card-body">
              <i class="icon fa-4x" style='font-style:normal !important;'>
                <span class="sign"><?= trim($app_currency) ? strtoupper($app_currency[0]) : ""; ?></span>
              </i>
              <div class="content">
                <div class="title">Amount Due</div>
                <div class="value">
                  <span class="sign"></span><span id='lbl_amountdue' style='font-size:0.80em !important;'>0.00</span>
                </div>
              </div>
            </div>
          </a>

          <div class="card">
            <div class="card-body">

              <div class="row" style="margin-bottom:0.5em; font-size: large;">
                <div class="col-sm-4 text-right">
                  SubTotal
                </div>
                <div class="col-sm-8 text-right">
                  <span class="sign"><?= trim($app_currency) ? strtoupper($app_currency[0]) : ""; ?> </span>
                  <span id='lbl_subtotal'>0.00</span>
                </div>
              </div>

              <div class="row" style="font-size: large;">
                <div class="col-sm-4 text-right">
                  Discount
                </div>
                <div class="col-sm-8 text-right">
                  <span class="sign"><?= trim($app_currency) ? strtoupper($app_currency[0]) : ""; ?> </span>
                  <a class="value"></a>
                  <a href='#' id='lbl_discount' data-placement="left" data-toggle='tooltip' title="Click to update the value.">0.00</a>
                </div>
              </div>

              <hr />

              <!-- <div class="row">
                <div class="col-sm-4 text-right fa-2x">
                  Cash
                </div>
                <div class="col-sm-8 text-right fa-2x">
                  <input type='text' id='txt_cash' class='numeric form-control text-right' tabindex='12' placeholder="0.00" value="0.00" />
                </div>
              </div>

              <div class="row text-danger">
                <div class="col-sm-4 text-right fa-2x">
                  Change
                </div>
                <div class="col-sm-8 text-right fa-2x">
                  <span class="sign">K </span><span id='lbl_change'>0.00</span>
                </div>
              </div>

              <hr /> -->

              <div class="row">
                <div class="col-sm-6">
                  <button id='btn_sale_pay' class='btn btn-success btn-large' style="width: 100%"><i class='fa fa-check'></i> Pay</button>
                  <!-- <button id='btn_sale_commit' class='btn btn-success btn-large' style="width: 100%"><i class='fa fa-check'></i> Commit</button> -->
                </div>
                <div class="col-sm-6">
                  <button id='btn_sale_cancel' class='btn btn-danger btn-large' style="width: 100%"><i class='fa fa-times'></i> Cancel</button>
                </div>
              </div>

              <hr />

              <div class="row">
                <div class="col-sm-12">
                  <textarea id='txt_sale_remarks' class='form-control' placeholder='Add Remarks Here.' rows='3'></textarea>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

      <?php include('footer.php'); ?>

    </div>

  </div>

  <!-- printing template -->
  <div style='display:none;'>
    <div id="print" style='font-size: 9pt; font-family: saxmono, fonta11, arial; margin: 0;'>
      <div id="print_header" class="table-responsive">
        <table class='table' style='width:100%;'>
          <tr>
            <td colspan='2' align='center'>TAX INVOICE</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan='2'><?= $app_name; ?></td>
          </tr>
          <tr>
            <td colspan='2'><?= $address; ?></td>
          </tr>
          <tr>
            <td align='left'>TIN #:</td>
            <td align='right' id='sale_receipt_tin'><?= $tin_no; ?></td>
          </tr>
          <tr>
            <td align='left'>Receipt #:</td>
            <td align='right' id='sale_receipt_no'>000000</td>
          </tr>
          <tr>
            <td>DateTime:</td>
            <td align='right'><?php echo date('Y-m-d H:m:i'); ?></td>
          </tr>
          <tr>
            <td>Cashier:</td>
            <td align='right' id='sale_receipt_cashier'><?php echo strtoupper($_SESSION['ufname'] . ' ' . substr(($_SESSION['ulname'] . ''), 0, 1)); ?></td>
          </tr>
        </table>
      </div>

      <hr />

      <div>
        <table id="print_content" class='table' style='width:100%;'>

        </table>
      </div>

      <hr />

      <div>
        <table id="print_total" class='table' style='width:100%;'>

        </table>
        <table class='table' style='width:100%;'>
          <tr>
            <td align='center'>Amount above is GST Inclusive</td>
          </tr>
        </table>
      </div>

      <hr />

      <div>
        <table id="print_footer" class='table' style='width:100%;'>
          <tr>
            <td align='center'>*** THANK YOU ***</td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="./assets/js/vendor.js"></script>
  <script type="text/javascript" src="./assets/js/app.js"></script>
  <script type="text/javascript" src="./assets/js/changepass.js"></script>

  <script type="text/javascript" src="./assets/js/bootstrap-dialog.js"></script>
  <script type="text/javascript" src="./assets/js/functions.js"></script>

  <script type="text/javascript" src="./assets/js/jquery.number.js"></script>

  <script type="text/javascript" src="./assets/js/printThis.js"></script>

  <?php
  include('menu-active.php');
  ?>

  <script>
    function number_format(n, currency) {
      return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }

    function computeDiscount(type, value, qty, price, total) {
      var discount_total = 0;
      switch (type) {
        case 0: //no discount
          value = 0;
          discount_total = parseFloat("0.00");
          break;

        case 1: //percentage
          discount_total = (parseFloat(value) / 100) * (parseFloat(price) * parseFloat(qty));
          break;

        case 2: //unit price
          discount_total = (parseFloat(value) * parseFloat(qty));
          break;

        case 3: //total price
          discount_total = parseFloat(value);
          break;
      }
      return discount_total;
    }

    function serverTime() {
      $.post("db_sale.php", {
        action: 10
      }, function(data) {
        if (data.indexOf("<!DOCTYPE html>") > -1) {
          showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
          location.reload(true);
        } else if (data.indexOf("Error: ") > -1) {
          $("#lbl_sale_time").text("Disconnected");
        } else {
          $("#lbl_sale_time").text(data);
        }
      });
    }

    function checkIfLock(callback) {
      $.post("db_sale.php", {
        action: 11
      }, function(data) {
        callback(data);
      });

    }

    var currentLock = 0;

    $(document).ready(function() {
      setInterval(function() {
        serverTime();

        checkIfLock(function(isLock) {
          if (parseInt(isLock)) {
            if (currentLock == 0) {
              showLock('<?= $app_name; ?>', 'This module is currently block by a supervisor!');
            }
            currentLock = 1;
          } else {
            if (currentLock == 1) {
              BootstrapDialog.closeAll();
            }
            currentLock = 0;
          }
        });

      }, 1000);


      $("#loading").modal();

      $.post("db_sale.php", {
        action: 2
      }, function(data) {
        $("#loading").modal('hide');

        if (data.indexOf("<!DOCTYPE html>") > -1) {
          showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
          location.reload(true);
        } else if (data.indexOf("Error: ") > -1) {
          showError('<?= $app_name; ?>', data);
        } else {
          var count = parseInt(data);

          if (count > 0) { //if there is tempp record
            var txt = "<div class='alert alert-warning text-center' role='alert'>";
            txt += "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> There is unsaved transaction from the previous session, <br /><br/> Would you like to RELOAD it?";
            txt += "</div>";


            BootstrapDialog.confirm({
              title: "<b style='color:grey;'><?= $app_name; ?> </b>",
              message: txt,
              type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
              closable: true, // <-- Default value is false
              //draggable: true, // <-- Default value is false
              //btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
              btnOKLabel: 'Proceed', // <-- Default value is 'OK',
              btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog type will be used,
              btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
              autospin: true,
              callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if (result) { //load data from the temp db

                  $.post("db_sale.php", {
                    action: 3
                  }, function(data) {
                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                      showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
                      location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                      showError('<?= $app_name; ?>', data);
                    } else {

                      var lst = data.split(":~|~:")[0];
                      var all_total = data.split(":~|~:")[1];
                      var hidden_subtotal = data.split(":~|~:")[2];
                      var hidden_discount = $("#hidden_discount").val();


                      $("#tbl_sale_itemlist tbody").html(lst);
                      $("#lbl_subtotal").text(all_total);
                      $("#hidden_subtotal").val(hidden_subtotal);

                      var amt_due = hidden_subtotal - hidden_discount;

                      $("#hidden_amountdue").val(amt_due);

                      $("#lbl_amountdue").text(amt_due);
                      $("#lbl_amountdue").number(true, 2)

                      $('[data-toggle="tooltip"]').tooltip({
                        html: true
                      });
                    }
                    $('#txt_sale_additem').val('').focus();
                  });

                } else { //delete all data from the temp db
                  $.post("db_sale.php", {
                    action: 4
                  }, function(data) {
                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                      showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
                      location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                      showError('<?= $app_name; ?>', data);
                    } else {

                      $('#txt_sale_additem').val('').focus();

                      $('[data-toggle="tooltip"]').tooltip({
                        html: true
                      });
                    }
                  });
                }
              }
            });
          }
        }

      });

      $('#txt_sale_additem').val('').focus();


    });

    $(document).on('click', '#btn_sale_pay', function(e) {
      e.preventDefault();

      $('#win_sale_payment').modal();

      //$('#win_sale_payment').on('shown.bs.modal', function() {      
      $("#payment_type_1").trigger("click"); //cash
      //});


    });

    $(document).on('click', '[name=radio_payment_type]', function(e) {
      var payment_type_id = $(this).val();
      var payment_type_label = $("#payment_type_label_" + payment_type_id).text().trim();

      $("#txt_amount_due").val(Number($('#hidden_amountdue').val()).toFixed(2));

      if (payment_type_label.toLocaleLowerCase() === "cash") {
        $("#container_tender, #container_change, #btn_sale_save").show();
        $("#container_reference").hide();
        $("#txt_cash").val("0.00").select().focus();
        $("#lbl_change").text("0.00");
        $("#txt_reference").val("");
      } else {
        $("#container_reference, #btn_sale_save").show();
        $("#container_tender, #container_change").hide();
        $("#txt_reference").val("").select().focus();
        $("#txt_cash").val($("#txt_amount_due").val());
        $("#lbl_change").text("0.00");
      }
    });

    $(document).on('click', '#btn_sale_save', function(e) {
      e.preventDefault();

      var payment_type_id = $("[name=radio_payment_type]:checked").val();
      var payment_type_label = $("#payment_type_label_" + payment_type_id).text().trim();

      var subtotal = parseFloat($('#hidden_subtotal').val());
      var discount = parseFloat($('#hidden_discount').val());
      var discount_qty = parseFloat($('#hidden_discount_qty').val());
      var discount_type = parseInt($('#hidden_discount_type').val());
      var amount_due = parseFloat($('#hidden_amountdue').val());

      var reference = $('#txt_reference').val().trim();
      var cash = parseFloat($('#txt_cash').val());
      var remarks = $('#txt_sale_remarks').val();
      var change = cash - amount_due;

      var proceed = false;

      if (payment_type_label.toLocaleLowerCase() === "cash") {
        if (amount_due > 0.001 && cash >= amount_due) {
          proceed = true;
        }
      } else {
        if (reference) {
          proceed = true;
        }
      }

      if (proceed) {
        $("#win_sale_payment").hide();
        $("#loading").modal();
        $.post("db_sale.php", {
            action: 9,
            subtotal: subtotal,
            discount: discount,
            discount_qty: discount_qty,
            remarks: remarks,
            discount_type: discount_type,
            amount_due: amount_due,
            cash: cash,
            change: change,
            payment_type_id: payment_type_id,
            payment_type_label: payment_type_label,
            reference: reference
          },
          function(data) {

            $("#loading").modal('hide');
            $("#win_sale_payment").show();

            if (data.indexOf("<!DOCTYPE html>") > -1) {
              alert("Error: Session Time-Out, You must login again to continue.");
              location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
              showError("<?= $app_name; ?>", data);
            } else {
              $('#win_sale_payment').modal('hide');
              $('#sale_receipt_no').text(data.split(':~|~:')[0]);
              $('#print_content').html(data.split(':~|~:')[1]);
              $('#print_total').html(data.split(':~|~:')[2]);
              $('#print').printThis();


              var lst = data.split(":~|~:")[3];

              $('#hidden_subtotal').val("0.00");
              $('#lbl_subtotal').text("0.00");

              $('#hidden_discount').val("0.00");
              $('#lbl_discount').text("0.00");

              $('#hidden_discount_qty').val("0.00");
              $('#hidden_discount_type').val("0");

              $('#hidden_amountdue').val("0.00");
              $("#lbl_amountdue").text("0.00");

              $('#txt_cash').val("0.00");
              $('#lbl_change').text("0.00");
              $('#txt_sale_remarks').val("");

              $("#lbl_discount").attr("data-original-title", "");

              $("#tbl_sale_itemlist tbody").html(lst);

              $('[data-toggle="tooltip"]').tooltip({
                html: true
              });


              BootstrapDialog.show({
                title: "<b style='color:grey;'><?= $app_name; ?> </b>",
                message: "<span class='alert alert-success'><i class='fa fa-check fa-2x fa-fw'></i>Transaction Completed, Press ENTER to continue.</span>",
                buttons: [{
                  label: 'Continue',
                  hotkey: 13, // Enter key
                  cssClass: 'btn-success',
                  action: function(dialogRef) {
                    dialogRef.close();
                    $('#txt_sale_additem').val('').focus();
                  }
                }]
              });

              $('#txt_sale_additem').val('').focus();
            }

          });
      } else {
        showError("<?= $app_name; ?>", "Error: Invalid Amount Due, Cash or Reference");
      }

    });

    $(document).on('click', '.btn_sale_lock', function(e) {
      e.preventDefault();

      var txt = "<div class='alert alert-warning text-center' role='alert'>";
      txt += "  <strong><i class='fa fa-question-circle fa-2x'></i></strong> Are you sure you want to lock the Sale Module?";
      txt += "</div>";


      BootstrapDialog.confirm({
        title: "<b style='color:grey;'><?= $app_name; ?> </b>",
        message: txt,
        type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
        closable: true, // <-- Default value is false
        //draggable: true, // <-- Default value is false
        //btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
        btnOKLabel: 'Lock', // <-- Default value is 'OK',
        btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog type will be used,
        btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
        autospin: true,
        callback: function(result) {
          // result will be true if button was click, while it will be false if users close the dialog directly.
          if (result) { //load data from the temp db

            $.post("db_sale.php", {
              action: 12,
              action_id: 1
            }, function(data) {
              if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
              } else if (data.indexOf("Error: ") > -1) {
                showError('<?= $app_name; ?>', data);
              } else {

              }

            });
          }
        }
      });

    });

    $(document).on('keypress', '#txt_cash', function(e) {
      if (e.which == 13) {
        $('#btn_sale_commit').trigger('click');
      }
    });

    // $(document).on('click', '#btn_sale_commit', function(e) {
    //   e.preventDefault();

    //   var subtotal = parseFloat($('#hidden_subtotal').val());
    //   var discount = parseFloat($('#hidden_discount').val());
    //   var discount_qty = parseFloat($('#hidden_discount_qty').val());
    //   var discount_type = parseInt($('#hidden_discount_type').val());
    //   var amount_due = parseFloat($('#hidden_amountdue').val());

    //   var cash = parseFloat($('#txt_cash').val());
    //   var remarks = $('#txt_sale_remarks').val();
    //   var change = cash - amount_due;


    //   if (amount_due > 0.001 && cash >= amount_due) {
    //     $("#loading").modal();
    //     $.post("db_sale.php", {
    //         action: 9,
    //         subtotal: subtotal,
    //         discount: discount,
    //         discount_qty: discount_qty,
    //         remarks: remarks,
    //         discount_type: discount_type,
    //         amount_due: amount_due,
    //         cash: cash,
    //         change: change
    //       },
    //       function(data) {

    //         $("#loading").modal('hide');

    //         if (data.indexOf("<!DOCTYPE html>") > -1) {
    //           alert("Error: Session Time-Out, You must login again to continue.");
    //           location.reload(true);
    //         } else if (data.indexOf("Error: ") > -1) {
    //           showError("<?= $app_name; ?>", data);
    //         } else {
    //           $('#sale_receipt_no').text(data.split(':~|~:')[0]);
    //           $('#print_content').html(data.split(':~|~:')[1]);
    //           $('#print_total').html(data.split(':~|~:')[2]);
    //           $('#print').printThis();


    //           var lst = data.split(":~|~:")[3];

    //           $('#hidden_subtotal').val("0.00");
    //           $('#lbl_subtotal').text("0.00");

    //           $('#hidden_discount').val("0.00");
    //           $('#lbl_discount').text("0.00");

    //           $('#hidden_discount_qty').val("0.00");
    //           $('#hidden_discount_type').val("0");

    //           $('#hidden_amountdue').val("0.00");
    //           $("#lbl_amountdue").text("0.00");

    //           $('#txt_cash').val("0.00");
    //           $('#lbl_change').text("0.00");
    //           $('#txt_sale_remarks').val("");

    //           $("#lbl_discount").attr("data-original-title", "");

    //           $("#tbl_sale_itemlist tbody").html(lst);

    //           $('[data-toggle="tooltip"]').tooltip({
    //             html: true
    //           });


    //           BootstrapDialog.show({
    //             title: "<b style='color:grey;'><?= $app_name; ?> </b>",
    //             message: "<span class='alert alert-success'><i class='fa fa-check fa-2x fa-fw'></i>Transaction Completed, Press ENTER to continue.</span>",
    //             buttons: [{
    //               label: 'Continue',
    //               hotkey: 13, // Enter key
    //               cssClass: 'btn-success',
    //               action: function(dialogRef) {
    //                 dialogRef.close();
    //                 $('#txt_sale_additem').val('').focus();
    //               }
    //             }]
    //           });

    //           $('#txt_sale_additem').val('').focus();
    //         }

    //       });
    //   } else {
    //     showError("<?= $app_name; ?>", "Error: Invalid Amount Due or Cash is less than the amount due!");
    //   }

    // });


    $(document).on('keypress', '#txt_sale_discount_value', function(e) {
      if (e.which == 13) {
        $('#btn_sale_discount_save').trigger('click');
      }
    });

    $(document).on('click', '#btn_sale_discount_save', function(e) {
      e.preventDefault();

      $(".buttons_show, .error_show, .modal-body").css("display", "none");
      $(".progress_show").css("display", "block");

      var type = parseInt($('#txt_sale_discount_type').val());
      var value = $('#txt_sale_discount_value').val();
      var subtotal = parseFloat($("#hidden_subtotal").val());

      var type_text = "NO DISCOUNT";

      //var discount = parseFloat($("#hidden_discount").val());
      //var discount_qty = parseFloat($("#hidden_discount_qty").val());
      //var discount_type = parseInt($("#hidden_discount_type").val());
      //var amountdue = parseFloat($("#hidden_amountdue").val());

      var total_discount;

      if (type == 0) { //if no discount
        $('#txt_sale_discount_value').val("0.00").attr('disabled', 'disabled');
        total_discount = parseFloat("0.00");
      } else {
        $('#txt_sale_discount_value').removeAttr('disabled');

        switch (type) {
          case 1: //percentage
            type_text = "PERCENTAGE";
            total_discount = (parseFloat(value) / 100) * (parseFloat(subtotal));
            break;

          case 2: //total price
            type_text = "AMOUNT"
            total_discount = parseFloat(value);
            break;
        }
      }

      var amount_due = subtotal - total_discount;

      //saving
      $("#hidden_discount_qty").val(value);
      $("#hidden_discount_type").val(type);
      $("#hidden_discount").val(total_discount);
      $("#hidden_amountdue").val(amount_due);

      //display
      $("#lbl_amountdue").text(number_format(amount_due, ""));
      $("#lbl_discount").text(number_format(total_discount, ""));


      $(".progress_show, .error_show").css("display", "none");
      $(".buttons_show, .modal-body").css("display", "block");

      $("#win_sale_discount").modal('hide');

      var discount_tooltip = "TYPE: " + type_text + " <br />VALUE: " + value + " <br />TOTAL: " + number_format(total_discount, "") + " <br /><br />Click to update the value.";

      $("#lbl_discount").attr("data-original-title", discount_tooltip);

      //$('[data-toggle="tooltip"]').tooltip({html:true});

    });




    $(document).on('keyup', '#txt_sale_discount_value', function(e) {
      $('#txt_sale_discount_type').trigger('change');
    });

    $(document).on('change', '#txt_sale_discount_type', function(e) {
      e.preventDefault();
      var type = parseInt($(this).val());
      var value = $('#txt_sale_discount_value').val();
      var subtotal = parseFloat($("#hidden_subtotal").val());


      var total_discount;

      if (type == 0) { //if no discount
        $('#txt_sale_discount_value').val("0.00").attr('disabled', 'disabled');
        total_discount = parseFloat("0.00");
      } else {
        $('#txt_sale_discount_value').removeAttr('disabled');

        switch (type) {
          case 1: //percentage
            total_discount = (parseFloat(value) / 100) * (parseFloat(subtotal));
            break;

          case 2: //total price
            total_discount = parseFloat(value);
            break;
        }
      }

      $("#txt_sale_discount_total").val(number_format(total_discount, ""));

    });


    $(document).on('click', '#lbl_discount', function(e) {
      e.preventDefault();
      var subtotal = parseFloat($("#hidden_subtotal").val());
      var discount = parseFloat($("#hidden_discount").val());
      var discount_qty = parseFloat($("#hidden_discount_qty").val());
      var discount_type = parseInt($("#hidden_discount_type").val());
      var amountdue = parseFloat($("#hidden_amountdue").val());

      $("#txt_sale_discount_type").val(discount_type);
      $("#txt_sale_discount_value").val(discount_qty);
      $("#txt_sale_discount_total").val(discount);

      if (discount_type == 0) {
        $("#txt_sale_discount_value").attr('disabled', 'disabled');
      }

      $(".progress_show, .error_show").css("display", "none");
      $(".buttons_show, .modal-body").css("display", "block");

      $("#win_sale_discount").modal();
    })

    $('#win_sale_discount').on('shown.bs.modal', function() {
      $('#txt_sale_discount_type').focus();
    });



    $(document).on('keypress', '#txt_sale_discount_itemvalue', function(e) {
      if (e.which == 13) {
        $("#btn_sale_discount_itemsave").trigger('click');
      }
    });

    $(document).on('click', '#btn_sale_discount_itemsave', function(e) {
      e.preventDefault();
      var id = $(".hidden_sale_itemid").val();
      var type = $('#txt_sale_discount_itemtype').val();
      var value = $('#txt_sale_discount_itemvalue').val();
      var total = $("#hidden_sale_discount_itemtotal").val();

      if (id) {

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_sale.php", {
          action: 8,
          id: id,
          type: type,
          value: value,
          total: total
        }, function(data) {
          $(".progress_show, .error_show, .modal-body").css("display", "none");
          $(".buttons_show").css("display", "block");

          if (data.indexOf("<!DOCTYPE html>") > -1) {
            alert("Error: Session Time-Out, You must login again to continue.");
            location.reload(true);
          } else if (data.indexOf("Error: ") > -1) {
            $(".error_msg").text(data);
            $(".error_show").css("display", "block");
          } else {
            var lst = data.split(":~|~:")[0];
            var all_total = data.split(":~|~:")[1];
            var hidden_subtotal = parseFloat(data.split(":~|~:")[2]);
            var hidden_discount = parseFloat($("#hidden_discount").val());
            var hidden_discount_qty = parseFloat($("#hidden_discount_qty").val());
            var hidden_discount_type = parseInt($("#hidden_discount_type").val());

            var total_discount = hidden_discount;
            if (hidden_discount_type == 1) { //sale percentage
              total_discount = (hidden_discount_qty / 100) * hidden_subtotal;
              $('#hidden_discount').val(total_discount);
            }

            $("#tbl_sale_itemlist tbody").html(lst);
            $("#lbl_subtotal").text(all_total);
            $("#hidden_subtotal").val(hidden_subtotal);

            var amt_due = hidden_subtotal - total_discount;

            $("#hidden_amountdue").val(amt_due);

            $("#lbl_amountdue").text(number_format(amt_due, ""));
            $("#lbl_discount").text(number_format(total_discount, ""));
            //$("#lbl_amountdue").number(true, 2 )

            $('[data-toggle="tooltip"]').tooltip({
              html: true
            });

            $("#win_sale_itemdiscount").modal('hide');
          }

        });
      } else {
        $(".error_msg").text("Error: Critical Error Encountered!");
        $(".error_show").css("display", "block");
      }

    });

    $(document).on('keyup', '#txt_sale_discount_itemvalue', function(e) {
      $('#txt_sale_discount_itemtype').trigger('change');
    });

    $(document).on('change', '#txt_sale_discount_itemtype', function(e) {
      e.preventDefault();
      var type = parseInt($(this).val());
      var value = $('#txt_sale_discount_itemvalue').val();
      var qty = $("#hidden_sale_itemqty").val();
      var price = $("#hidden_sale_itemprice").val();
      var total = $("#hidden_sale_itemtotal").val();

      var total_discount;

      if ($(this).val() == 0) { //if no discount
        $('#txt_sale_discount_itemvalue').val("0.00").attr('disabled', 'disabled');
        total_discount = parseFloat("0.00");
      } else {
        $('#txt_sale_discount_itemvalue').removeAttr('disabled');
        total_discount = computeDiscount(type, value, qty, price, total);
      }

      $("#txt_sale_discount_itemtotal").val(number_format(total_discount, ""));
      $("#hidden_sale_discount_itemtotal").val(total_discount);
    });



    $('#win_sale_itemdiscount').on('shown.bs.modal', function() {
      $('#txt_sale_discount_itemtype').focus();
    });

    $(document).on('click', '.btn_sale_itemdiscount', function(e) {
      e.preventDefault();
      var id = $(this).attr('id');
      if (id) {

        var tr_id = "tr_" + id;
        $("#tbl_sale_itemlist tbody #" + tr_id).addClass('warning');

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $("#win_sale_itemdiscount").modal();

        $.post("db_sale.php", {
          action: 6,
          id: id
        }, function(data) {

          if (data.indexOf("<!DOCTYPE html>") > -1) {
            $("#win_sale_itemqty").modal('hide');
            showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
            location.reload(true);
          } else if (data.indexOf("Error: ") > -1) {
            $("#win_sale_itemqty").modal('hide');
            showError('<?= $app_name; ?>', data);
          } else {
            var qty = data.split(":~|~:")[0];
            var uom = data.split(":~|~:")[1];
            var price = data.split(":~|~:")[2];
            var total = data.split(":~|~:")[3];
            var discount_type = data.split(":~|~:")[4];
            var discount_qty = data.split(":~|~:")[5];
            var discount_total = data.split(":~|~:")[6];

            $(".hidden_sale_itemid").val(id);
            $("#hidden_sale_itemqty").val(qty);
            $("#hidden_sale_itemprice").val(price);
            $("#hidden_sale_itemtotal").val(total);

            $("#txt_sale_discount_itemtype").val(discount_type);
            $("#txt_sale_discount_itemvalue").val(discount_qty);
            $("#txt_sale_discount_itemtotal").val(discount_total);

            if (parseInt(discount_type) == 0) {
              $("#txt_sale_discount_itemvalue").attr('disabled', 'disabled');
            }

            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            //$("#tbl_sale_itemlist tbody #" + tr_id).removeClass('warning');

          }
        });

      } else {
        showError("<?= $app_name; ?>", "Error: Critical Error Encountered!");
      }
    });

    $(document).on('keypress', '#txt_sale_itemqty', function(e) {
      if (e.which == 13) {
        $("#btn_sale_itemqty_save").trigger('click');
      }
    });

    $(document).on('click', '#btn_sale_itemqty_save', function(e) {
      e.preventDefault();
      var id = $(".hidden_sale_itemid").val();
      var qty = parseFloat($('#txt_sale_itemqty').val());


      if (id) {
        if (qty > 0) {
          $(".buttons_show, .error_show, .modal-body").css("display", "none");
          $(".progress_show").css("display", "block");

          $.post("db_sale.php", {
            action: 7,
            id: id,
            qty: qty
          }, function(data) {
            $(".progress_show, .error_show, .modal-body").css("display", "none");
            $(".buttons_show").css("display", "block");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
              alert("Error: Session Time-Out, You must login again to continue.");
              location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
              $(".error_msg").text(data);
              $(".error_show").css("display", "block");
            } else {
              var lst = data.split(":~|~:")[0];
              var all_total = data.split(":~|~:")[1];

              var hidden_subtotal = parseFloat(data.split(":~|~:")[2]);
              var hidden_discount = parseFloat($("#hidden_discount").val());
              var hidden_discount_qty = parseFloat($("#hidden_discount_qty").val());
              var hidden_discount_type = parseInt($("#hidden_discount_type").val());

              var total_discount = hidden_discount;
              if (hidden_discount_type == 1) { //sale percentage
                total_discount = (hidden_discount_qty / 100) * hidden_subtotal;
                $('#hidden_discount').val(total_discount);
              }

              $("#tbl_sale_itemlist tbody").html(lst);
              $("#lbl_subtotal").text(all_total);
              $("#hidden_subtotal").val(hidden_subtotal);

              var amt_due = hidden_subtotal - total_discount;

              $("#hidden_amountdue").val(amt_due);

              $("#lbl_amountdue").text(amt_due);
              $("#lbl_amountdue").number(true, 2)

              $("#lbl_discount").text(number_format(total_discount, ""));

              $('[data-toggle="tooltip"]').tooltip({
                html: true
              });

              $("#win_sale_itemqty").modal('hide');
            }

          });

        } else {
          $(".error_msg").text("Error: Minimum QTY is 1.0");
          $(".error_show").css("display", "block");
        }
      } else {
        $(".error_msg").text("Error: Critical Error Encountered!");
        $(".error_show").css("display", "block");
      }
    });

    $('#win_sale_itemqty').on('shown.bs.modal', function() {
      $('#txt_sale_itemqty').focus().select();
    });

    $(document).on('click', '.btn_sale_itemqty', function(e) {
      e.preventDefault();
      var id = $(this).attr('id');
      if (id) {
        //$("#win_sale_itemqty").modal();
        var tr_id = "tr_" + id;
        $("#tbl_sale_itemlist tbody #" + tr_id).addClass('warning');

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $("#win_sale_itemqty").modal();

        $.post("db_sale.php", {
          action: 6,
          id: id
        }, function(data) {

          if (data.indexOf("<!DOCTYPE html>") > -1) {
            $("#win_sale_itemqty").modal('hide');
            showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
            location.reload(true);
          } else if (data.indexOf("Error: ") > -1) {
            $("#win_sale_itemqty").modal('hide');
            showError('<?= $app_name; ?>', data);
          } else {
            var qty = data.split(":~|~:")[0];
            var uom = data.split(":~|~:")[1];

            $(".hidden_sale_itemid").val(id);
            $("#txt_sale_itemqty").val(qty).focus().select();
            $("#lbl_sale_itemuom").text(uom);

            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            //$("#tbl_sale_itemlist tbody #" + tr_id).removeClass('warning');

          }
        });

      } else {
        showError("<?= $app_name; ?>", "Error: Critical Error Encountered!");
      }
    });

    $(document).on('keyup', '#txt_cash', function(e) {
      e.preventDefault();
      var cash = parseFloat($('#txt_cash').val());
      var due = parseFloat($('#hidden_amountdue').val());

      var change = cash - due;

      $('#lbl_change').text(change);

    })

    $(document).on('click', '#btn_sale_cancel', function(e) {
      e.preventDefault();
      var txt = "<div class='alert alert-warning text-center' role='alert'>";
      txt += "  <strong><i class='fa fa-exclamation-triangle fa-2x fa-fw'></i></strong> Are you sure you want to CANCEL this TRANSACTION?";
      txt += "</div>";


      BootstrapDialog.confirm({
        title: "<b style='color:grey;'><?= $app_name; ?> </b>",
        message: txt,
        type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
        closable: true, // <-- Default value is false
        //draggable: true, // <-- Default value is false
        //btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
        btnOKLabel: 'Proceed', // <-- Default value is 'OK',
        btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog type will be used,
        btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
        autospin: true,
        callback: function(result) {
          // result will be true if button was click, while it will be false if users close the dialog directly.
          if (result) { //load data from the temp db
            $.post("db_sale.php", {
              action: 4
            }, function(data) {
              if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
              } else if (data.indexOf("Error: ") > -1) {
                showError('<?= $app_name; ?>', data);
              } else {
                var lst = data.split(":~|~:")[0];
                var all_total = data.split(":~|~:")[1];
                var hidden_subtotal = data.split(":~|~:")[2];
                var hidden_discount = $("#hidden_discount").val();


                $("#tbl_sale_itemlist tbody").html(lst);
                $("#lbl_subtotal").text(all_total);
                $("#hidden_subtotal").val(hidden_subtotal);

                var amt_due = hidden_subtotal - hidden_discount;

                $("#hidden_amountdue").val(amt_due);

                $("#lbl_amountdue").text(amt_due);
                $("#lbl_amountdue").number(true, 2)

                $('[data-toggle="tooltip"]').tooltip({
                  html: true
                });

                $('#txt_sale_additem').val('').focus();

              }
            });
          }
        }
      });
    });

    $(document).on('click', '.btn_sale_removeItem', function(e) {
      e.preventDefault();
      var id = $(this).attr('id');
      if (id) {
        var tr_id = "tr_" + id;

        $("#tbl_sale_itemlist tbody #" + tr_id).addClass('warning');

        var txt = "<div class='alert alert-warning text-center' role='alert'>";
        txt += "  <strong><i class='fa fa-exclamation-triangle fa-2x fa-fw'></i></strong> Are you sure you want to REMOVE this item?";
        txt += "</div>";


        BootstrapDialog.confirm({
          title: "<b style='color:grey;'><?= $app_name; ?> </b>",
          message: txt,
          type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
          closable: true, // <-- Default value is false
          //draggable: true, // <-- Default value is false
          //btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
          btnOKLabel: 'Proceed', // <-- Default value is 'OK',
          btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog type will be used,
          btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
          autospin: true,
          callback: function(result) {
            // result will be true if button was click, while it will be false if users close the dialog directly.
            if (result) { //load data from the temp db

              $.post("db_sale.php", {
                action: 5,
                id: id
              }, function(data) {
                if (data.indexOf("<!DOCTYPE html>") > -1) {
                  showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
                  location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                  showError('<?= $app_name; ?>', data);
                } else {

                  var lst = data.split(":~|~:")[0];
                  var all_total = data.split(":~|~:")[1];
                  var hidden_subtotal = data.split(":~|~:")[2];
                  var hidden_discount = $("#hidden_discount").val();


                  $("#tbl_sale_itemlist tbody").html(lst);
                  $("#lbl_subtotal").text(all_total);
                  $("#hidden_subtotal").val(hidden_subtotal);

                  var amt_due = hidden_subtotal - hidden_discount;

                  $("#hidden_amountdue").val(amt_due);

                  $("#lbl_amountdue").text(amt_due);
                  $("#lbl_amountdue").number(true, 2)

                  $('[data-toggle="tooltip"]').tooltip({
                    html: true
                  });

                }
              });

            }

            $("#tbl_sale_itemlist tbody #" + tr_id).removeClass('warning');
          }
        });
      } else {
        showError('<?= $app_name; ?>', 'Error: Critical Error Encountered!');
      }
      $('#txt_sale_additem').val('').focus();
    });

    $(document).on('keypress', '#txt_sale_additem', function(e) {
      var key = e.which;
      var txt = $('#txt_sale_additem').val();

      switch (key) {
        case 13: //enter key
          $('#btn_sale_additem').trigger('click');
          break;

        case 42: //asterisk *
          if ((txt.indexOf("*") > -1) || (!$.isNumeric(txt))) {
            return false;
          }
          break;

        case 46: //dot .
          if (txt.indexOf(".") > -1) {
            return false;
          }
          break;

        default:
          if ((key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122)) {
            //allowed key
          } else {
            return false;
          }
      }

    });

    $(document).on('click', '#btn_sale_additem', function(e) {
      e.preventDefault();
      var txt_item = $('#txt_sale_additem').val();
      var buyer_type = $('#txt_sale_buyer').val();

      var qty = 1;
      var item_code = txt_item;

      if (txt_item.indexOf("*") > -1) {
        qty = txt_item.split("*")[0];
        item_code = txt_item.split("*")[1];
      }

      if (item_code && buyer_type) {
        $("#loading").modal();
        $.post("db_sale.php", {
          action: 1,
          qty: qty,
          item_code: item_code,
          buyer_type: buyer_type
        }, function(data) {
          $("#loading").modal('hide');

          if (data.indexOf("<!DOCTYPE html>") > -1) {
            showError('<?= $app_name; ?>', "Error: Session Time-Out, You must login again to continue.");
            location.reload(true);
          } else if (data.indexOf("Error: ") > -1) {
            showError('<?= $app_name; ?>', data);
            $('#txt_sale_additem').focus().select();
          } else {
            $('#txt_sale_additem').val('').focus();

            var lst = data.split(":~|~:")[0];
            var all_total = data.split(":~|~:")[1];
            var hidden_subtotal = data.split(":~|~:")[2];
            var hidden_discount = $("#hidden_discount").val();


            $("#tbl_sale_itemlist tbody").html(lst);
            $("#lbl_subtotal").text(all_total);
            $("#hidden_subtotal").val(hidden_subtotal);

            var amt_due = hidden_subtotal - hidden_discount;

            $("#lbl_amountdue").text(number_format(amt_due, ""));
            $("#hidden_amountdue").val(amt_due);

            $('[data-toggle="tooltip"]').tooltip({
              html: true
            });
          }
        });
      } else {
        $('#txt_sale_additem').val('').focus();
      }
    });
  </script>
</body>

</html>