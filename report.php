<?php
include('validate.php');
include('config.php');
$mnu = 'menu_report';
?>

<!DOCTYPE html>
<html>

<head>
    <title><?= $app_name; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./assets/css/jquery-ui.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="./assets/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/flat-admin.css">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue-sky.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/red.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/yellow.css">

    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap-dialog.css">

    <!-- Quotes -->
    <link rel="stylesheet" type="text/css" href="./assets/css/qoutes.css">

    <style>
    #tbl_receiving_list * {
        font-size: small !important;
    }
    </style>

</head>

<body>

    <?php
  //uom
  include('win_transaction_cancel.php');
  include('win_transaction_details.php');
  include('win_transaction_asearch.php');
  include('win_sales_asearch.php');
  include('win_summary_asearch.php');
  include('win_inventory_asearch.php');

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
                            <li class="navbar-title"><span class='fa fa-bar-chart fa-2x'></span><span class="highlight"
                                    style='margin-left: 0.5em;'> REPORT</span></li>

                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="navbar-search hidden-sm">
                                <input id="txt_report_search" type="text" placeholder="Search..">
                                <button id="btn_report_search" class="btn-search"><i class="fa fa-search"></i></button>
                            </li>

                            <li class="dropdown notification warning">
                                <a class="btn_report_asearch dropdown-toggle" data-toggle="dropdown">
                                    <div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <div class="title">Advance Search</div>
                                    <div class="count">+</div>
                                </a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="btn_report_asearch dropdown-empty">Advance Search</li>
                                    </ul>
                                </div>
                            </li>

                            <li class="dropdown notification danger">
                                <a class="btn_report_print dropdown-toggle" data-toggle="dropdown">
                                    <div class="icon"><i class="fa fa-print" aria-hidden="true"></i></div>
                                    <div class="title">Print</div>
                                    <div class="count">P</div>
                                </a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="btn_report_print dropdown-empty">Print</li>
                                    </ul>
                                </div>
                            </li>

                            <li class="dropdown notification danger">
                                <a class="btn_report_excel dropdown-toggle" data-toggle="dropdown">
                                    <div class="icon"><i class="fa fa-file-excel-o" aria-hidden="true"></i></div>
                                    <div class="title">Export to Excel</div>
                                    <div class="count">E</div>
                                </a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="btn_report_excel dropdown-empty">Export to Excel</li>
                                    </ul>
                                </div>
                            </li>

                            <?php include('profile.php'); ?>
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="section">

                                <div class="section-body">

                                    <div role="tabpanel">

                                        <!-- Nav tabs -->
                                        <ul class='nav nav-tabs' role='tablist'>
                                            <?php
                                              if ($uaccess == 1 || $uaccess == 2 || $uaccess == 3 || $uaccess == 4 || $uaccess == 5) {
                                                echo "<li id='1' role='presentation' class='tab_report active'>
                                                      <a href='#transaction' aria-controls='transaction' role='tab' data-toggle='tab'>
                                                        <i class='fa fa-briefcase fa-fw'></i>
                                                        Transaction <span class='badge' style='display:none'>0</span>
                                                      </a>
                                                    </li>";
                                              }
                                            ?>

                                            <?php
                                              if ($uaccess == 1 || $uaccess == 2 || $uaccess == 3 || $uaccess == 4 || $uaccess == 5) {
                                                echo "<li id='2' role='presentation' class='tab_report'>
                                                      <a href='#sale' aria-controls='sale' role='tab' data-toggle='tab'>
                                                        <i class='fa fa-shopping-cart fa-fw'></i>Sale
                                                      </a>
                                                    </li>";
                                              }
                                            ?>

                                            <?php
                                              if ($uaccess == 1 || $uaccess == 3 || $uaccess == 4 || $uaccess == 5) {
                                                echo "<li id='3' role='presentation' class='tab_report'>
                                                        <a href='#summary' aria-controls='summary' role='tab' data-toggle='tab'>
                                                          <i class='fa fa-th-list fa-fw'></i>Summary
                                                        </a>
                                                      </li>";
                                              }
                                            ?>

                                            <?php
                                              if ($uaccess == 1 || $uaccess == 2 || $uaccess == 3 || $uaccess == 4) {
                                                echo "<li id='4' role='presentation' class='tab_report'>
                                                      <a href='#inventory' aria-controls='inventory' role='tab' data-toggle='tab'>
                                                        <i class='fa fa-cubes fa-fw'></i>Inventory
                                                      </a>
                                                    </li>";
                                              }
                                            ?>

                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="transaction">
                                                <div class="card">

                                                    <div class="card-body no-padding" style="overflow-x: scroll;">
                                                        <table id="tbl_transaction_list"
                                                            class="tbl_transaction_list table table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Option</th>
                                                                    <th>Receipt No.</th>
                                                                    <th>DateTime</th>
                                                                    <!--
                                                                      <th>Sub-Total</th>                                    
                                                                      <th>Discount</th>
                                                                    -->
                                                                    <th>Payment Type</th>
                                                                    <th>Amount Due</th>
                                                                    <th>Tax Base</th>
                                                                    <th>GST</th>
                                                                    <th>Cashier</th>
                                                                    <th>Remarks</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                  //$curr_date = date('Y-m-d');

                                                                  include('connect.php');

                                                                  include('query_transaction.php');
                                                                  //$sql .= " WHERE t.dt LIKE '{$curr_date}%'; ";
                                                                  $sql .= " WHERE DATE(t.dt) = CURDATE(); ";

                                                                  $_SESSION['transaction_sql'] = $sql;

                                                                  include('pop_transaction.php');

                                                                  $mysqli->close();
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="sale">
                                                <div class="card">
                                                    <div class="card-body no-padding" style='overflow: scroll;'>
                                                        <table id="tbl_sales_list"
                                                            class="table table-sm table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Receipt #</th>
                                                                    <th>Product Code</th>
                                                                    <th>Product Name</th>
                                                                    <th>QTY</th>
                                                                    <th>UOM</th>
                                                                    <th>Category</th>
                                                                    <th>Buyer Type</th>
                                                                    <th>Price</th>
                                                                    <!--
                                                                    <th>Discount Type</th>
                                                                    <th>Discount Value</th>
                                                                    <th>Discount Total</th>
                                                                    -->
                                                                    <th>Total</th>
                                                                    <th>Tax Base</th>
                                                                    <th>GST</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!--
                                                                <tr><td colspan='9' align='center'>Please use the search <span class='fa fa-search'></span> field to display record</td></tr>
                                                                -->
                                                                <?php
                                                                  include('connect.php');

                                                                  include('query_sales.php');

                                                                  $sql .= " WHERE DATE(s.dt) = CURDATE(); ";

                                                                  $_SESSION['sales_sql'] = $sql;

                                                                  include('pop_sales.php');

                                                                  $mysqli->close();
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="summary">
                                                <div class='row'>
                                                    <div class="col-md-6">
                                                        Search Product: <i id='summary_search_product'>All</i>
                                                    </div>
                                                    <div class="col-md-6" style='margin-bottom:0.5em;'>
                                                        Date Range: <i
                                                            id='summary_search_dtfrom'><?php echo date('Y-m-d'); ?></i>
                                                        &nbsp; to &nbsp; <i
                                                            id='summary_search_dtto'><?php echo date('Y-m-d');  ?></i>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-body no-padding" style='overflow: scroll;'>
                                                        <table id="tbl_sales_summary_list"
                                                            class="table table-sm table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS; ">

                                                            <thead>
                                                                <tr>
                                                                    <th rowspan='2'>Product Code</th>
                                                                    <th rowspan='2'>Product Name</th>
                                                                    <th rowspan='2'>UOM</th>
                                                                    <th rowspan='2'>Category</th>
                                                                    <th colspan='2'>Insider</th>
                                                                    <th colspan='2'>Outsider</th>
                                                                    <th colspan='2'>Kitchen</th>
                                                                    <th colspan='2'>Sale</th>
                                                                    <th colspan='2' class='warning'>OVERALL TOTAL</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>QTY</th>
                                                                    <th>Total</th>

                                                                    <th>QTY</th>
                                                                    <th>Total</th>

                                                                    <th>QTY</th>
                                                                    <th>Total</th>

                                                                    <th>QTY</th>
                                                                    <th>Total</th>

                                                                    <th class='warning'>QTY</th>
                                                                    <th class='danger'>Total</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!--
                                                                <tr><td colspan='9' align='center'>Please use the search <span class='fa fa-search'></span> field to display record</td></tr>
                                                                -->
                                                                <?php
                                                                  include('connect.php');

                                                                  include('query_sales_summary.php');

                                                                  $sql .= " WHERE s.status_id=1 AND DATE(s.dt) = CURDATE()";

                                                                  $sql .= " GROUP BY s.product_id ";
                                                                  $sql .= " ORDER BY p.product_name; ";

                                                                  $_SESSION['sales_sql_summary'] = $sql;
                                                                  $_SESSION['sales_product_summary'] = 'All';
                                                                  $_SESSION['sales_dtfrom_summary'] = date('Y-m-d');
                                                                  $_SESSION['sales_dtto_summary'] = date('Y-m-d');

                                                                  include('pop_sales_summary.php');

                                                                  $mysqli->close();
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="inventory">
                                                <div class="card">
                                                    <div class="card-body no-padding" style='overflow: scroll;'>
                                                        <div class="col-sm-4">
                                                            <label>Product Search</label>
                                                            <input type='text' id="txt_inventory_search"
                                                                class="form-control text-center" readonly />
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Ending Date</label>
                                                            <input type='text' id="txt_inventory_ending"
                                                                class="form-control text-center" readonly />
                                                        </div>

                                                        <table id="tbl_inventory_list"
                                                            class="table table-sm table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS; ">

                                                            <?php
                                                                include('connect.php');
                                                                $buyer_list = array();

                                                                $sql = "SELECT id, type FROM pos_buyer WHERE status_id=1 ORDER BY type;";
                                                                $pop = $mysqli->query($sql);
                                                                if ($pop) {
                                                                    //$buyer_count = $pop->num_rows + 2;

                                                                    while ($row = $pop->fetch_object()) {
                                                                        //$buyer_id = $row->id;
                                                                        $buyer_type = strtoupper($row->type . '');
                                                                        //echo "<th>{$buyer_type}</th>";

                                                                        array_push($buyer_list, $buyer_type);
                                                                    }
                                                                }

                                                                $mysqli->close();
                                                            ?>


                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2">CODE</th>
                                                                    <th rowspan="2">PRODUCT</th>
                                                                    <th rowspan="2">UOM</th>
                                                                    <th rowspan="2">CATEGORY</th>
                                                                    <th rowspan="2">CURRENT BALANCE</th>
                                                                    <th rowspan="2">SUPPLIER PRICE</th>
                                                                    <th aling="center"
                                                                        colspan="<?= count($buyer_list); ?>">
                                                                        SELLING PRICE
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                        foreach ($buyer_list as $buyer){
                                                                            echo "<th align='center'>" . $buyer . "</th>";
                                                                        }
                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="<?= 6 + count($buyer_list); ?>"
                                                                        align="center">Use Advance Search
                                                                    </td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
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
    <div style='display: none;'>
        <div id="print" style='font-size: 9pt; font-family: fonta11, arial; margin: 0;'>
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
                        <td align='right' id='sale_receipt_dt'></td>
                    </tr>
                    <tr>
                        <td>Cashier:</td>
                        <td align='right' id='sale_receipt_cashier'></td>
                    </tr>
                    <tr>
                        <td>Re-Printed:</td>
                        <td align='right'><?php echo date('Y-m-d H:m:i'); ?></td>
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

    <script src="./assets/js/jquery-ui.min.js"></script>

    <script type="text/javascript" src="./assets/js/bootstrap-dialog.js"></script>
    <script type="text/javascript" src="./assets/js/functions.js"></script>

    <script type="text/javascript" src="./assets/js/printThis.js"></script>

    <?php
  include('menu-active.php');
  ?>

    <script>
    $(function() {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
        });
        $(".datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
    });

    function str_pad(str, max, string_pad) {
        str = str.toString();
        return str.length < max ? str_pad(string_pad + str, max, string_pad) : str;
    }

    //showError('Simple POS',"Error: Critical Error Encountered!");
    var tab_report = 1; //default tab

    $(document).on("click", ".tab_report", function(e) {
        tab_report = $(this).attr('id');
    });

    $(document).ready(function() {
        $('[data-toggle="popover"]').popover({
            trigger: "hover",
            html: true
        });
    });

    //EXPORT TO EXCEL
    $(document).on("click", ".btn_report_excel", function(e) {
        e.preventDefault();

        switch (parseInt(tab_report)) {
            case 1:
                window.location.assign("excel_report_tran.php");
                break;

            case 2:
                window.location.assign("excel_report_sales.php");
                break;

            case 3:
                window.location.assign("excel_report_summary.php");
                break;

            case 4:
                var product_searched = $("#txt_inventory_search").val();
                var date_ending = $("#txt_inventory_ending").val();
                window.location.assign("excel_report_inventory.php?product=" + product_searched + "&ending=" +
                    date_ending);
                break;

            default:
                showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });


    //PRINT

    $(document).on("click", ".btn_report_print", function(e) {
        e.preventDefault();

        switch (parseInt(tab_report)) {
            case 1: //print transaction
                window.location.assign("print_report_tran.php");
                break;

            case 2: //print sales
                window.location.assign("print_report_sales.php");
                break;

            case 3: //print sale summary
                window.location.assign("print_report_summary.php");
                break;

            case 4: //print inventory
                var product_searched = $("#txt_inventory_search").val();
                var date_ending = $("#txt_inventory_ending").val();
                window.location.assign("print_report_inventory.php?product=" + product_searched + "&ending=" +
                    date_ending);
                break;

            default:
                showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });




    //advance search
    $(document).on('keypress', '.txt-transaction-asearch', function(e) {
        if (e.which == 13) {
            $("#btn_transaction_asearch").trigger('click');
        }
    });

    $(document).on('keypress', '.txt-sales-asearch', function(e) {
        if (e.which == 13) {
            $("#btn_sales_asearch").trigger('click');
        }
    });

    $(document).on('keypress', '.txt-summary-asearch', function(e) {
        if (e.which == 13) {
            $("#btn_summary_asearch").trigger('click');
        }
    });

    $(document).on('keypress', '.txt-inventory-asearch', function(e) {
        if (e.which == 13) {
            $("#btn_inventory_asearch").trigger('click');
        }
    });

    $(document).on("click", "#btn_transaction_asearch", function(e) {
        e.preventDefault();
        var receipt = $("#txt_transaction_asearch_receipt").val();
        var cashier = $("#txt_transaction_asearch_cashier").val();
        var dtFrom = $("#txt_transaction_asearch_dtfrom").val();
        var dtTo = $("#txt_transaction_asearch_dtto").val();
        var status = $("#txt_transaction_asearch_status").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_transaction.php", {
            action: 6,
            receipt: receipt,
            cashier: cashier,
            dtFrom: dtFrom,
            dtTo: dtTo,
            status: status
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_transaction_asearch_receipt").select().focus();
            } else {
                $("#tbl_transaction_list tbody").html(data);

                $("#win_transaction_asearch").modal('hide');

                $('[data-toggle="popover"]').popover({
                    trigger: "hover",
                    html: true
                });
            }
        });

    });

    $(document).on("click", "#btn_sales_asearch", function(e) {
        e.preventDefault();
        var receipt = $("#txt_sales_asearch_receipt").val();
        var product = $("#txt_sales_asearch_product").val();
        var dtFrom = $("#txt_sales_asearch_dtfrom").val();
        var dtTo = $("#txt_sales_asearch_dtto").val();
        var status = $("#txt_sales_asearch_status").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_sales.php", {
            action: 2,
            receipt: receipt,
            product: product,
            dtFrom: dtFrom,
            dtTo: dtTo,
            status: status
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_sales_asearch_receipt").select().focus();
            } else {
                $("#tbl_sales_list tbody").html(data);

                $("#win_sales_asearch").modal('hide');

                $('[data-toggle="popover"]').popover({
                    trigger: "hover",
                    html: true
                });
            }
        });

    });

    $(document).on("click", "#btn_summary_asearch", function(e) {
        e.preventDefault();
        var product = $("#txt_summary_asearch_product").val();
        var dtFrom = $("#txt_summary_asearch_dtfrom").val();
        var dtTo = $("#txt_summary_asearch_dtto").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_sales_summary.php", {
            action: 2,
            product: product,
            dtFrom: dtFrom,
            dtTo: dtTo
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_summary_asearch_product").select().focus();
            } else {
                var search_product = data.split(":~|~:")[0];
                var search_dtfrom = data.split(":~|~:")[1];
                var search_dtto = data.split(":~|~:")[2];
                var list = data.split(":~|~:")[3];

                $('#summary_search_product').text(search_product);
                $('#summary_search_dtfrom').text(search_dtfrom);
                $('#summary_search_dtto').text(search_dtto);

                $("#tbl_sales_summary_list tbody").html(list);

                $("#win_summary_asearch").modal('hide');

                $('[data-toggle="popover"]').popover({
                    trigger: "hover",
                    html: true
                });
            }
        });

    });

    $(document).on("click", "#btn_inventory_asearch", function(e) {
        e.preventDefault();
        var product = $("#txt_inventory_asearch_product").val();
        var dtEnding = $("#txt_inventory_asearch_dtending").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_inventory.php", {
            action: 1,
            product: product,
            dtEnding: dtEnding
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_inventory_asearch_product").select().focus();
            } else {
                $("#txt_inventory_search").val(product);
                $("#txt_inventory_ending").val(dtEnding);

                $("#tbl_inventory_list tbody").html(data);

                $("#win_inventory_asearch").modal('hide');

                $('[data-toggle="popover"]').popover({
                    trigger: "hover",
                    html: true
                });
            }
        });

    });



    $(document).on("click", ".btn_report_asearch", function(e) {
        e.preventDefault();

        $(".progress_show, .error_show").css("display", "none");

        switch (parseInt(tab_report)) {
            case 1:
                $(".txt-transaction-asearch").val("");
                $("#win_transaction_asearch").modal();

                $('#win_transaction_asearch').on('shown.bs.modal', function() {
                    $('#txt_transaction_asearch_receipt').focus().select();
                    $("#txt_transaction_asearch_status option[value='0']").prop('selected', true);
                })

                break;

            case 2: //sales
                $(".txt-sales-asearch").val("");
                $("#win_sales_asearch").modal();

                $('#win_sales_asearch').on('shown.bs.modal', function() {
                    $('#txt_sales_asearch_receipt').focus().select();
                    $("#txt_sales_asearch_status option[value='0']").prop('selected', true);
                })
                break

            case 3: //summary
                $(".txt-summary-asearch").val("");
                $("#win_summary_asearch").modal();

                $('#win_summary_asearch').on('shown.bs.modal', function() {
                    $('#txt_summary_asearch_product').focus().select();
                })
                break;

            case 4: //inventory
                $(".txt-inventory-asearch").val("");
                $("#win_inventory_asearch").modal();

                $('#win_inventory_asearch').on('shown.bs.modal', function() {
                    $('#txt_inventory_asearch_product').focus().select();
                })
                break;

            default:
                showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });


    //search field
    $(document).on("keypress", "#txt_report_search", function(e) {
        if (e.which == 13) {
            $("#btn_report_search").trigger('click');
        }
    });

    $(document).on("click", "#btn_report_search", function(e) {
        e.preventDefault();

        var mysearch = $("#txt_report_search").val();

        switch (parseInt(tab_report)) {
            case 1:
                $("#loading").modal();

                $.post("db_transaction.php", {
                    action: 1,
                    mysearch: mysearch
                }, function(data) {
                    $("#loading").modal('hide');

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        showError('Simple POS', data);
                    } else {
                        $("#tbl_transaction_list tbody").html(data);

                        $('[data-toggle="popover"]').popover({
                            trigger: "hover",
                            html: true
                        });
                    }

                });
                break;

            case 2:
                $("#loading").modal();

                $.post("db_sales.php", {
                    action: 1,
                    mysearch: mysearch
                }, function(data) {
                    $("#loading").modal('hide');

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        showError('Simple POS', data);
                    } else {
                        $("#tbl_sales_list tbody").html(data);

                        $('[data-toggle="popover"]').popover({
                            trigger: "hover",
                            html: true
                        });
                    }

                });
                break;

            case 3: //summary
                $("#loading").modal();

                $.post("db_sales_summary.php", {
                    action: 1,
                    mysearch: mysearch
                }, function(data) {
                    $("#loading").modal('hide');

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        showError('Simple POS', data);
                    } else {
                        $("#tbl_sales_summary_list tbody").html(data);

                        $('[data-toggle="popover"]').popover({
                            trigger: "hover",
                            html: true
                        });
                    }

                });
                break;

            case 4: //inventory
                showError('Simple POS', "Error: You should use Advance Search instead!");
                break;

            default:
                showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });


    $(document).on('click', '.btn_transaction_reprint', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        if (id) {
            $("#loading").modal();
            $.post("db_transaction.php", {
                action: 5,
                id: id
            }, function(data) {
                $("#loading").modal('hide');

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    alert("Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    showError("Simple POS", data);
                } else {
                    $('#sale_receipt_no').text(data.split(':~|~:')[0]);
                    $('#sale_receipt_cashier').text(data.split(':~|~:')[1]);
                    $('#sale_receipt_dt').text(data.split(':~|~:')[2]);
                    $('#print_content').html(data.split(':~|~:')[3]);
                    $('#print_total').html(data.split(':~|~:')[4]);
                    $('#print').printThis();
                }
            });
        } else {
            showError('Simple POS', 'Error: Critical Error Encountered!');
        }

    });

    $(document).on('click', '.btn_transaction_details', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            //$("#loading").modal();
            $("#win_transaction_details").modal();

            $(".buttons_show, .modal-body, .error_show").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_transaction.php", {
                action: 4,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');
                $(".buttons_show, .modal-body ").css("display", "block");
                $(".progress_show, .error_show").css("display", "none");

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    alert("Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    //showError("Simple POS", data);
                    $(".modal-body").css('display', 'none');
                    $(".error_show").css('display', 'block');
                    $(".error_msg").text(data);
                } else {

                    var tran = data.split(':~:|:~:')[0];
                    var item = data.split(':~:|:~:')[1];

                    var dt = tran.split(':~|~:')[0];
                    var receipt = tran.split(':~|~:')[1];
                    var cashier = tran.split(':~|~:')[2];
                    var status = tran.split(':~|~:')[3];
                    var remarks = tran.split(':~|~:')[4];

                    var subtotal = tran.split(':~|~:')[5];
                    var discount = tran.split(':~|~:')[6];
                    var discount_type = tran.split(':~|~:')[7] ? tran.split(':~|~:')[7] : "None";
                    var discount_qty = tran.split(':~|~:')[8];
                    var amount_due = tran.split(':~|~:')[9];
                    var cash = tran.split(':~|~:')[10];
                    var change = tran.split(':~|~:')[11];

                    $("#tran_details_dt").text(dt);
                    $("#tran_details_receipt").text(receipt);
                    $("#tran_details_cashier").text(cashier);
                    $("#tran_details_status").text(status);
                    $("#tran_details_remarks").text(remarks);

                    $("#tran_details_subtotal").text(subtotal);
                    $("#tran_details_discount").text(discount);
                    $("#tran_details_discounttype").text(discount_type);
                    $("#tran_details_discountqty").text(discount_qty);
                    $("#tran_details_amountdue").text(amount_due);
                    $("#tran_details_cash").text(cash);
                    $("#tran_details_change").text(change);

                    $("#transaction_details_list tbody").html(item);


                }
            });
            //
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $(document).on('click', '.transaction_cancelled_info', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            $("#loading").modal();
            $.post("db_transaction.php", {
                action: 3,
                id: id
            }, function(data) {
                $("#loading").modal('hide');

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    showError('Simple POS', data);
                } else {

                    var dt = data.split(":~|~:")[0];
                    var reason = data.split(":~|~:")[1];
                    var cancelled_by = data.split(":~|~:")[2];
                    var items = data.split(":~|~:")[3];

                    var txt = "<div class='alert alert-warning'>";
                    txt += "<p><b>Date Cancelled: </b>" + dt + "</p>";
                    txt += "<p><b>Cancelled By: </b>" + cancelled_by + "</p>";
                    txt += "<p><b>Reason: </b>" + reason + "</p>";
                    txt += "</div>";

                    txt += "<br />";

                    txt += "<div style='max-height:30em; overflow-y:scroll;'>";
                    txt +=
                        "<table id='transaction_cancelled_item' class='table-striped table-bordered table-hover' style='font-size:1em; width:100%'>"
                    txt += "<label>Items</label>";
                    txt +=
                        "<thead><tr><th>#</th> <th align='center'>QTY</th> <th align='center'>Item</th> <th align='center'>Price</th> <th align='center'>Discount</th> <th align='center'>Total</th> </tr></thead>";
                    txt += "<tbody>" + items + "</tbody>";
                    txt += "</table>"
                    txt += "</div>";

                    BootstrapDialog.show({
                        title: "<b style='color:grey;'>Simple POS </b>",
                        message: txt,
                        type: BootstrapDialog
                            .TYPE_PRIMARY, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                        closable: true, // <-- Default value is false
                        buttons: [{
                            cssClass: 'btn-success',
                            label: 'Close',
                            action: function(dialogItself) {
                                dialogItself.close();
                            }
                        }]

                    });

                }

            })
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });


    $(document).on('click', '.btn_transaction_recomplete', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var tr_id = "#tr_" + id;

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to MARK AS COMPLETED this transaction?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
                message: txt,
                type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                closable: true, // <-- Default value is false                
                btnOKLabel: 'Proceed', // <-- Default value is 'OK',
                btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog type will be used,
                btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
                autospin: true,
                callback: function(result) {
                    // result will be true if button was click, while it will be false if users close the dialog directly.
                    if (result) {
                        $.post("db_transaction.php", {
                            action: 2,
                            id: id,
                            status_id: 1
                        }, function(data) {

                            if (data.indexOf("<!DOCTYPE html>") > -1) {
                                showError('Simple POS',
                                    "Error: Session Time-Out, You must login again to continue."
                                );
                                location.reload(true);
                            } else if (data.indexOf("Error: ") > -1) {
                                showError('Simple POS', data);
                            } else {
                                $("#tbl_transaction_list tbody " + tr_id).html(data)
                                    .removeClass('danger');

                                $('[data-toggle="popover"]').popover({
                                    trigger: "hover",
                                    html: true
                                });
                            }
                        });
                    }
                }
            });


        } else {
            showError('Simple POS', 'Error: Critical Error Encountered!');
        }

    });

    $(document).on('click', '#btn_transaction_cancel', function(e) {
        e.preventDefault();
        var id = $('.hidden_tran_id').val();
        var reason = $('#tran_cancel_reason').val().trim();
        var tr_id = "#tr_" + id;

        if (id) {
            if (reason) {
                $(".buttons_show, .modal-body, .error_show").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_transaction.php", {
                    action: 2,
                    id: id,
                    reason: reason,
                    status_id: 2
                }, function(data) {
                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show").css("display", "none");

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        $(".error_show").css("display", "block");
                        $(".error_msg").text(data);
                        $("#tran_cancel_reason").select().focus();
                    } else {
                        $("#tbl_transaction_list tbody " + tr_id).html(data).addClass('danger');

                        $("#win_transaction_cancel").modal('hide');

                        $('[data-toggle="popover"]').popover({
                            trigger: "hover",
                            html: true
                        });
                    }
                });
            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: Please specify the reason!");
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
        }

    });

    $('#win_transaction_cancel').on('shown.bs.modal', function() {
        $('#tran_cancel_reason').focus().select();
    });

    $(document).on('click', '.btn_transaction_cancel', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var receipt = str_pad(id, 10, "0");

        $(".hidden_tran_id").val(id);
        $(".tran_receipt").text(receipt);
        $("#tran_cancel_reason").val("");

        $(".buttons_show, .modal-body").css("display", "block");
        $(".progress_show, .error_show").css("display", "none");

        $("#win_transaction_cancel").modal();
    });


    //===================================================================


    //advance search receiving
    $(document).on('keypress', '.txt-receiving-asearch', function(e) {
        if (e.which == 13) {
            $("#btn_receiving_asearch").trigger('click');
        }
    });

    $(document).on('click', '#btn_receiving_asearch', function(e) {
        e.preventDefault();
        var product_code = $("#txt_receiving_asearch_code").val();
        var product_name = $("#txt_receiving_asearch_name").val();
        var dt_from = $("#txt_receiving_asearch_dtfrom").val();
        var dt_to = $("#txt_receiving_asearch_dtto").val();
        var supplier = $("#txt_receiving_asearch_supplier").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_receiving.php", {
            action: 6,
            product_code: product_code,
            product_name: product_name,
            dt_from: dt_from,
            dt_to: dt_to,
            supplier: supplier
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_receiving_asearch_code").select().focus();
            } else {
                $("#tbl_receiving_list tbody").html(data);

                $("#win_receiving_asearch").modal('hide');

                $('[data-toggle="tooltip"]').tooltip({
                    html: true
                });
            }
        });

    });


    //advance search product
    $(document).on("click", "#btn_product_asearch", function(e) {
        e.preventDefault();
        var search_code = $("#txt_product_code_asearch").val();
        var search_name = $("#txt_product_name_asearch").val();
        var search_uom = $("#txt_product_uom_asearch").val();
        var search_price = $("#txt_product_price_asearch").val();
        var search_status = $("#txt_product_status_asearch").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_product.php", {
            action: 6,
            product_code: search_code,
            product_name: search_name,
            product_uom: search_uom,
            product_price: search_price,
            product_status: search_status
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_product_code_asearch").select().focus();
            } else {
                $("#tbl_product_list tbody").html(data);

                $("#win_product_asearch").modal('hide');

                $('[data-toggle="tooltip"]').tooltip({
                    html: true
                });
            }
        });
    });


    //advance search supplier
    $(document).on("keypress", ".txt-supplier-asearch", function(e) {
        if (e.which == 13) {
            $("#btn_supplier_asearch").trigger('click');
        }
    });

    $(document).on("click", "#btn_supplier_asearch", function(e) {
        e.preventDefault();
        var search_supplier = $("#txt_supplier_name_asearch").val();
        var search_des = $("#txt_supplier_description_asearch").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_supplier.php", {
            action: 6,
            supplier: search_supplier,
            description: search_des
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_supplier_name_asearch").select().focus();
            } else {
                $("#tbl_supplier_list tbody").html(data);

                $("#win_supplier_asearch").modal('hide');

                $('[data-toggle="tooltip"]').tooltip({
                    html: true
                });
            }
        });
    });

    //advance search uom
    $(document).on("keypress", ".txt-uom-asearch", function(e) {
        if (e.which == 13) {
            $("#btn_uom_asearch").trigger('click');
        }
    });

    $(document).on("click", "#btn_uom_asearch", function(e) {
        e.preventDefault();
        var search_uom = $("#txt_uom_abbrevation_asearch").val();
        var search_des = $("#txt_uom_description_asearch").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_uom.php", {
            action: 6,
            abbrevation: search_uom,
            description: search_des
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_uom_abbrevation_asearch").select().focus();
            } else {
                $("#tbl_uom_list tbody").html(data);

                $("#win_uom_asearch").modal('hide');

                $('[data-toggle="tooltip"]').tooltip({
                    html: true
                });
            }
        });
    });

    $(document).on("click", ".btn_product_asearch", function(e) {
        e.preventDefault();

        $(".progress_show, .error_show").css("display", "none");

        switch (parseInt(tab_product)) {
            case 1:
                $(".txt-product-asearch").val("");
                $("#win_product_asearch").modal();

                $('#win_product_asearch').on('shown.bs.modal', function() {
                    $('#txt_product_code_asearch').focus().select();
                })
                break;

            case 2:
                $(".txt-receiving-asearch").val("");
                $("#win_receiving_asearch").modal();

                $('#win_receiving_asearch').on('shown.bs.modal', function() {
                    $('#txt_receiving_asearch_code').focus();
                })
                break;

            case 3:
                $(".txt-uom-asearch").val("");
                $("#win_uom_asearch").modal();

                $('#win_uom_asearch').on('shown.bs.modal', function() {
                    $('#txt_uom_abbrevation_asearch').focus().select();
                })
                break;

            case 4:
                $(".txt-supplier-asearch").val("");
                $("#win_supplier_asearch").modal();

                $('#win_supplier_asearch').on('shown.bs.modal', function() {
                    $('#txt_supplier_name_asearch').focus().select();
                })
                break;

            default:
                showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    //search field
    $(document).on("keypress", "#txt_product_search", function(e) {
        if (e.which == 13) {
            $("#btn_product_search").trigger('click');
        }
    });

    $(document).on("click", "#btn_product_search", function(e) {
        e.preventDefault();

        var mysearch = $("#txt_product_search").val();

        switch (parseInt(tab_product)) {
            case 1:
                $("#loading").modal();

                $.post("db_product.php", {
                    action: 1,
                    mysearch: mysearch
                }, function(data) {
                    $("#loading").modal('hide');

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        showError('Simple POS', data);
                    } else {
                        $("#tbl_product_list tbody").html(data);

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }

                });
                break;

            case 2:
                $("#loading").modal();

                $.post("db_receiving.php", {
                    action: 9,
                    mysearch: mysearch
                }, function(data) {
                    $("#loading").modal('hide');

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        showError('Simple POS', data);
                    } else {
                        $("#tbl_receiving_list tbody").html(data);

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }

                });
                break;

            case 3:
                $("#loading").modal();

                $.post("db_uom.php", {
                    action: 1,
                    mysearch: mysearch
                }, function(data) {
                    $("#loading").modal('hide');

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        showError('Simple POS', data);
                    } else {
                        $("#tbl_uom_list tbody").html(data);

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }

                });
                break;

            case 4:
                $("#loading").modal();

                $.post("db_supplier.php", {
                    action: 1,
                    mysearch: mysearch
                }, function(data) {
                    $("#loading").modal('hide');

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        showError('Simple POS', data);
                    } else {
                        $("#tbl_supplier_list tbody").html(data);

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }

                });
                break;

            default:
                showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    //add new button
    $(document).on("click", ".btn_product_new", function(e) {
        e.preventDefault();

        $(".progress_show, .error_show, .success_show").css("display", "none");

        switch (parseInt(tab_product)) {
            case 1:
                $(".txt-product").val("");
                $("#win_product_new").modal();

                $('#win_product_new').on('shown.bs.modal', function() {
                    $('#txt_product_code').focus().select();
                })
                break;

            case 2:
                $(".txt-receiving").val("");
                $("#txt_receiving_dt").val("<?php echo date('Y-m-d'); ?>");
                $("#win_receiving_new").modal();

                $("#win_receiving_new").on("shown.bs.modal", function() {
                    $("#txt_receiving_code").focus().select();
                })
                break;

            case 3:
                $(".txt-uom").val("");
                $("#win_uom_new").modal();

                $('#win_uom_new').on('shown.bs.modal', function() {
                    $('#txt_uom_abbrevation').focus().select();
                })
                break;

            case 4:
                $(".txt-supplier").val("");
                $("#win_supplier_new").modal();

                $('#win_supplier_new').on('shown.bs.modal', function() {
                    $('#txt_supplier_name').focus().select();
                })
                break;

            default:
                showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    //receiving
    $(document).on('click', '.receiving_cancelled_info', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            $("#loading").modal();
            $.post("db_receiving.php", {
                action: 8,
                id: id
            }, function(data) {
                $("#loading").modal('hide');

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    showError('Simple POS', data);
                } else {

                    var dt = data.split(":~|~:")[0];
                    var reason = data.split(":~|~:")[1];
                    var cancelled_by = data.split(":~|~:")[2];

                    var txt = "<div class='alert alert-warning'>";
                    txt += "<p><b>Date Cancelled: </b>" + dt + "</p>";
                    txt += "<p><b>Cancelled By: </b>" + cancelled_by + "</p>";
                    txt += "<p><b>Reason: </b>" + reason + "</p>";
                    txt += "</div>";

                    BootstrapDialog.show({
                        title: "<b style='color:grey;'>Simple POS </b>",
                        message: txt,
                        type: BootstrapDialog
                            .TYPE_PRIMARY, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                        closable: true, // <-- Default value is false
                        buttons: [{
                            cssClass: 'btn-success',
                            label: 'Close',
                            action: function(dialogItself) {
                                dialogItself.close();
                            }
                        }]

                    });

                }

            })
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $(document).on('click', '.btn_receiving_modify', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            //$("#loading").modal();
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_receiving_modify").modal();

            $.post("db_receiving.php", {
                action: 3,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_receiving_modify").modal('hide');

                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_receiving_modify").modal('hide');

                    showError('Simple POS', data);
                } else {

                    var dt = data.split(":~|~:")[0];
                    var product_code = data.split(":~|~:")[1];
                    var product_name = data.split(":~|~:")[2];
                    var uom = data.split(":~|~:")[3];
                    var qty = data.split(":~|~:")[4];
                    var supplier = data.split(":~|~:")[5];

                    $(".hidden_receiving_id").val(id);
                    $("#txt_receiving_dt_update").val(dt);

                    $("#txt_receiving_code_update").val(product_code);
                    $("#txt_receiving_name_update").val(product_name);
                    $("#txt_receiving_uom_update").text(uom);
                    $("#txt_receiving_qty_update").val(qty);
                    $("#txt_receiving_supplier_update").val(supplier);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_product_modify").modal();
                }
            });
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $('#win_receiving_modify').on('shown.bs.modal', function() {
        $('#txt_receiving_qty_update').focus().select();
    });



    $(document).on('click', '#btn_receiving_save', function(e) {
        e.preventDefault();
        var id = $(".hidden_product_id").val();
        var product_name = $("#txt_receiving_name").val();
        var qty = parseFloat($("#txt_receiving_qty").val());
        var uom = $("#txt_receiving_uom").text();
        var supplier = $("#txt_receiving_supplier").val();

        if (id) {
            if (product_name && supplier) {
                if (qty > 0) {
                    $(".buttons_show, .error_show, .modal-body").css("display", "none");
                    $(".progress_show").css("display", "block");

                    $.post("db_receiving.php", {
                        action: 2,
                        id: id,
                        qty: qty,
                        supplier: supplier
                    }, function(data) {
                        $(".buttons_show, .modal-body").css("display", "block");
                        $(".progress_show, .error_show").css("display", "none");

                        if (data.indexOf("<!DOCTYPE html>") > -1) {
                            showError('Simple POS',
                                "Error: Session Time-Out, You must login again to continue.");
                            location.reload(true);
                        } else if (data.indexOf("Error: ") > -1) {
                            $(".success_show").css('display', 'none');
                            $(".error_show").css("display", "block");
                            $(".error_msg").text(data);
                            $("#txt_receiving_code").select().focus();
                        } else {
                            $("#tbl_receiving_list tbody").html(data);

                            $(".success_msg").text("Successfully Saved! " + qty + " " + uom + " " +
                                product_name);
                            $(".success_show").css('display', 'block');

                            $(".txt-receiving").val("");
                            $("#txt_receiving_code").select().focus();

                            $('[data-toggle="tooltip"]').tooltip({
                                html: true
                            });
                        }
                    });

                } else {
                    $(".success_show").css('display', 'none');
                    $(".error_msg").text("Error: Quantity must be greater than 0.");
                    $(".error_show").css('display', 'block');
                    $("#txt_receiving_code").select().focus();
                }
            } else {
                $(".success_show").css('display', 'none');
                $(".error_msg").text("Error: Fields with red asterisk are required!");
                $(".error_show").css('display', 'block');
                $("#txt_receiving_code").select().focus();
            }
        } else {
            $(".error_msg").text("Error: Critical Error Encountered!");
            $(".error_show").css('display', 'block');
            $("#txt_receiving_code").select().focus();
        }
    });

    $(document).on('keypress', '#txt_receiving_code', function(e) { //get product info by code
        if (e.which == 13) {
            var code = $('#txt_receiving_code').val();

            if (code) {
                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_receiving.php", {
                    action: 1,
                    code: code
                }, function(data) {
                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        $(".error_show").css("display", "block");
                        $(".error_msg").text(data);
                        $("#txt_receiving_code").select().focus();
                    } else {
                        var id = data.split(":~|~:")[0];
                        var product_name = data.split(":~|~:")[1];
                        var product_uom = data.split(":~|~:")[2];

                        $(".hidden_product_id").val(id);
                        $("#txt_receiving_name").val(product_name);
                        $("#txt_receiving_uom").text(product_uom);

                        $("#txt_receiving_qty").focus().select();
                    }
                });
            } else {
                $(".error_msg").text("Error: Product code is required!");
                $(".error_show").css('display', 'block');
                $("#txt_receiving_code").select().focus();

            }
            //$(".buttons_show, .error_show, .modal-body").css("display","none");

        }
    });

    $(document).on('click', '.btn_receiving_confirm', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to RE-CONFIRM this transaction?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
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
                    if (result) {

                        $.post("db_receiving.php", {
                            action: 7,
                            id: id,
                            status: 1
                        }, function(data) {
                            if (data.indexOf("<!DOCTYPE html>") > -1) {
                                showError('Simple POS',
                                    "Error: Session Time-Out, You must login again to continue."
                                );
                                location.reload(true);
                            } else if (data.indexOf("Error: ") > -1) {
                                showError('Simple POS', data);
                            } else {
                                var tr_id = "tr_" + id;

                                $("#tbl_receiving_list tbody #" + tr_id).html(data);
                                $("#tbl_receiving_list tbody #" + tr_id).removeClass(
                                    'danger');

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });
                            }
                        });
                    }
                }
            });
        } else {
            showError('Simple POS', 'Error: Critical Error Encountered!');
        }
    });

    $(document).on('click', '#btn_receiving_save_cancel', function(e) {
        var id = $(".hidden_receiving_id").val();
        var reason = $("#txt_receiving_cancel_reason").val();

        if (id) {
            if (reason) {
                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_receiving.php", {
                    action: 7,
                    id: id,
                    reason: reason,
                    status: 2
                }, function(data) {
                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        $(".error_show").css("display", "block");
                        $(".error_msg").text(data);
                        $("#txt_receiving_cancel_reason").select().focus();
                    } else {
                        var tr_id = "tr_" + id;
                        $("#tbl_receiving_list tbody #" + tr_id).html(data);
                        $("#tbl_receiving_list tbody #" + tr_id).addClass('danger');

                        $("#win_receiving_cancel_reason").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });

                    }
                });
            } else {
                $(".error_msg").text("Error: Please specify the reason for cancellation!");
                $(".error_show").css('display', 'block');
                $("#txt_receiving_cancel_reason").select().focus();
            }
        } else {
            $(".error_msg").text("Error: Critical Error Encountered!");
            $(".error_show").css('display', 'block');
            $("#txt_receiving_cancel_reason").select().focus();
        }
    });

    $(document).on('click', '.btn_receiving_cancel', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_receiving_cancel_reason").modal();

            $.post("db_receiving.php", {
                action: 3,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_receiving_cancel_reason").modal('hide');
                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_receiving_cancel_reason").modal('hide');
                    showError('Simple POS', data);
                } else {

                    var product_code = data.split(":~|~:")[1];
                    var product_name = data.split(":~|~:")[2];
                    var uom = data.split(":~|~:")[3];
                    var qty = data.split(":~|~:")[4];

                    var product = qty + " " + uom + " <b>" + product_code + " - " + product_name +
                        "</b>";

                    $(".hidden_receiving_id").val(id);
                    $("#txt_product_info").html(product);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_product_modify").modal();
                }
            });

        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $('#win_receiving_cancel_reason').on('shown.bs.modal', function() {
        $('#txt_receiving_cancel_reason').focus().select();
    });

    $(document).on('click', '#btn_receiving_save_update', function(e) {
        e.preventDefault();
        var id = $('.hidden_receiving_id').val();
        var dt = $("#txt_receiving_dt_update").val();
        var qty = parseFloat($("#txt_receiving_qty_update").val());
        var supplier = $("#txt_receiving_supplier_update").val();

        if (id) {
            if (supplier && (qty > 0)) {

                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_receiving.php", {
                    action: 4,
                    id: id,
                    dt: dt,
                    qty: qty,
                    supplier: supplier
                }, function(data) {
                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        $(".error_show").css("display", "block");
                        $(".error_msg").text(data);
                        $("#txt_receiving_qty_update").select().focus();
                    } else {
                        var tr_id = "tr_" + id;
                        $("#tbl_receiving_list tbody #" + tr_id).html(data);

                        $("#win_receiving_modify").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }
                })

            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: All fields are important!");
                $("#txt_product_name_update").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_product_name_update").select().focus();
        }
    });

    //product
    $(document).on('keypress', '.txt-product-price', function(e) {
        if (e.which == 13) {
            $('#btn_product_price_save').trigger('click');
        }
    });

    $(document).on('click', '#btn_product_price_save', function(e) {
        e.preventDefault();
        var id = $('.hidden_product_id').val();
        var price = $("#txt_product_price_price").val();

        if (id) {
            if (price && $.isNumeric(price)) {

                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_product.php", {
                    action: 9,
                    id: id,
                    price: price
                }, function(data) {
                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        $(".error_show").css("display", "block");
                        $(".error_msg").text(data);
                        $("#txt_product_price_price").select().focus();
                    } else {
                        var tr_id = "tr_" + id;
                        $("#tbl_product_list tbody #" + tr_id).html(data);

                        $("#win_product_price").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }
                })

            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: Critical Error Encountered!");
                $("#txt_product_price_price").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_product_price_price").select().focus();
        }
    });

    $(document).on('click', '.btn_product_price', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_product_price").modal();

            $.post("db_product.php", {
                action: 8,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_product_price").modal('hide');

                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_product_price").modal('hide');

                    showError('Simple POS', data);
                } else {
                    var product_code = data.split(":|:")[0];
                    var product_name = data.split(":|:")[1];
                    var price = data.split(":|:")[2];
                    var uom = data.split(":|:")[3];

                    $(".hidden_product_id").val(id);
                    $("#txt_product_code_price").val(product_code);
                    $("#txt_product_name_price").val(product_name);
                    $("#txt_product_price_price").val(price);
                    $("#txt_product_uom_price").text(uom);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_product_modify").modal();
                }
            });
        } else {
            showError('Simple POS', 'Error: Critical Error Encountered!');
        }
    });

    $('#win_product_price').on('shown.bs.modal', function() {
        $('#txt_product_price_price').focus().select();
    });

    $(document).on('click', '.btn_product_activate', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to ACTIVATE this product?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
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
                    if (result) {

                        $.post("db_product.php", {
                            action: 7,
                            id: id,
                            status_id: 1
                        }, function(data) {
                            if (data.indexOf("<!DOCTYPE html>") > -1) {
                                showError('Simple POS',
                                    "Error: Session Time-Out, You must login again to continue."
                                );
                                location.reload(true);
                            } else if (data.indexOf("Error: ") > -1) {
                                showError('Simple POS', data);
                            } else {
                                var tr_id = "tr_" + id;

                                $("#tbl_product_list tbody #" + tr_id).html(data);

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });
                            }
                        });
                    }
                }
            });
        } else {
            showError('Simple POS', 'Error: Critical Error Encountered!');
        }
    });

    $(document).on('click', '.btn_product_delete', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to REMOVE this product?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
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
                    if (result) {

                        $.post("db_product.php", {
                            action: 7,
                            id: id,
                            status_id: 2
                        }, function(data) {
                            if (data.indexOf("<!DOCTYPE html>") > -1) {
                                showError('Simple POS',
                                    "Error: Session Time-Out, You must login again to continue."
                                );
                                location.reload(true);
                            } else if (data.indexOf("Error: ") > -1) {
                                showError('Simple POS', data);
                            } else {
                                var tr_id = "tr_" + id;

                                $("#tbl_product_list tbody #" + tr_id).html(data);

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });
                            }
                        });
                    }
                }
            });
        } else {
            showError('Simple POS', 'Error: Critical Error Encountered!');
        }
    });

    $(document).on('click', '#btn_product_update', function(e) {
        e.preventDefault();
        var id = $('.hidden_product_id').val();
        var product_code = $("#txt_product_code_update").val();
        var product_name = $("#txt_product_name_update").val();
        var product_uom = $("#txt_product_uom_update").val();

        if (id) {
            if (product_code && product_name && product_uom) {

                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_product.php", {
                    action: 3,
                    id: id,
                    product_code: product_code,
                    product_name: product_name,
                    product_uom: product_uom
                }, function(data) {
                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        $(".error_show").css("display", "block");
                        $(".error_msg").text(data);
                        $("#txt_product_name_update").select().focus();
                    } else {
                        var tr_id = "tr_" + id;
                        $("#tbl_product_list tbody #" + tr_id).html(data);

                        $("#win_product_modify").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }
                })

            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: All fields are important!");
                $("#txt_product_name_update").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_product_name_update").select().focus();
        }
    });

    $(document).on('click', '.btn_product_modify', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            //$("#loading").modal();
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_product_modify").modal();

            $.post("db_product.php", {
                action: 4,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_product_modify").modal('hide');

                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_product_modify").modal('hide');

                    showError('Simple POS', data);
                } else {
                    var product_code = data.split(":|:")[0];
                    var product_name = data.split(":|:")[1];
                    var product_uom = data.split(":|:")[2];

                    $(".hidden_product_id").val(id);
                    $("#txt_product_code_update").val(product_code);
                    $("#txt_product_name_update").val(product_name);
                    $("#txt_product_uom_update").val(product_uom);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_product_modify").modal();
                }
            });
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $('#win_product_modify').on('shown.bs.modal', function() {
        $('#txt_product_name_update').focus().select();
    });

    $(document).on('click', '#btn_product_save', function(e) {
        e.preventDefault();
        var product_code = $("#txt_product_code").val();
        var product_name = $("#txt_product_name").val();
        var product_uom = $("#txt_product_uom").val();

        if (product_code && product_name && product_uom) {

            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_product.php", {
                action: 2,
                product_code: product_code,
                product_name: product_name,
                product_uom: product_uom
            }, function(data) {
                $(".buttons_show, .modal-body").css("display", "block");
                $(".progress_show, .error_show").css("display", "none");

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $(".error_show").css("display", "block");
                    $(".error_msg").text(data);
                    $("#txt_product_name").select().focus();
                } else {
                    $("#tbl_product_list tbody").html(data);

                    $("#win_product_new").modal('hide');

                    $('[data-toggle="tooltip"]').tooltip({
                        html: true
                    });
                }
            })

        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: All fields are important!");
            $("#txt_product_name").select().focus();
        }
    });


    //supplier
    $(document).on('keypress', '.txt-supplier-update', function(e) {
        if (e.which == 13) {
            $("#btn_supplier_update").trigger('click');
        }
    });

    $(document).on('click', '#btn_supplier_update', function(e) {
        e.preventDefault();
        var id = $('.hidden_supplier_id').val();
        var supplier = $("#txt_supplier_name_update").val();
        var description = $("#txt_supplier_description_update").val();

        if (id) {
            if (supplier && description) {

                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_supplier.php", {
                    action: 3,
                    id: id,
                    supplier: supplier,
                    description: description
                }, function(data) {
                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        $(".error_show").css("display", "block");
                        $(".error_msg").text(data);
                        $("#txt_supplier_name_update").select().focus();
                    } else {
                        $("#tbl_supplier_list tbody").html(data);

                        $("#win_supplier_modify").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }
                })

            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: All fields are important!");
                $("#txt_supplier_name_update").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_supplier_name_update").select().focus();
        }
    });

    $(document).on('click', '.btn_supplier_modify', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            //$("#loading").modal();
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_supplier_modify").modal();

            $.post("db_supplier.php", {
                action: 4,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_supplier_modify").modal('hide');

                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_supplier_modify").modal('hide');

                    showError('Simple POS', data);
                } else {
                    var supplier = data.split(":|:")[0];
                    var description = data.split(":|:")[1];

                    $(".hidden_supplier_id").val(id);
                    $("#txt_supplier_name_update").val(supplier);
                    $("#txt_supplier_description_update").val(description);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_supplier_modify").modal();
                }
            });
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $('#win_supplier_modify').on('shown.bs.modal', function() {
        $('#txt_supplier_name_update').focus().select();
    });

    $(document).on('keypress', '.txt-supplier', function(e) {
        if (e.which == 13) {
            $("#btn_supplier_save").trigger('click');
        }
    });

    $(document).on('click', '#btn_supplier_save', function(e) {
        e.preventDefault();
        var supplier = $("#txt_supplier_name").val();
        var description = $("#txt_supplier_description").val();

        if (supplier && description) {

            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_supplier.php", {
                action: 2,
                supplier: supplier,
                description: description
            }, function(data) {
                $(".buttons_show, .modal-body").css("display", "block");
                $(".progress_show, .error_show").css("display", "none");

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $(".error_show").css("display", "block");
                    $(".error_msg").text(data);
                    $("#txt_supplier_name").select().focus();
                } else {
                    $("#tbl_supplier_list tbody").html(data);

                    $("#win_supplier_new").modal('hide');

                    $('[data-toggle="tooltip"]').tooltip({
                        html: true
                    });
                }
            })

        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: All fields are important!");
            $("#txt_supplier_name").select().focus();
        }
    });



    //uom
    $(document).on('keypress', '.txt-uom-update', function(e) {
        if (e.which == 13) {
            $("#btn_uom_save_update").trigger('click');
        }
    });

    $(document).on('click', '#btn_uom_save_update', function(e) {
        e.preventDefault();
        var id = $('.hidden_uom_id').val();
        var abbrevation = $("#txt_uom_abbrevation_update").val();
        var description = $("#txt_uom_description_update").val();

        if (id) {
            if (abbrevation && description) {
                if (abbrevation.length <= 3) {
                    $(".buttons_show, .error_show, .modal-body").css("display", "none");
                    $(".progress_show").css("display", "block");

                    $.post("db_uom.php", {
                        action: 3,
                        id: id,
                        abbrevation: abbrevation,
                        description: description
                    }, function(data) {
                        $(".buttons_show, .modal-body").css("display", "block");
                        $(".progress_show, .error_show").css("display", "none");

                        if (data.indexOf("<!DOCTYPE html>") > -1) {
                            showError('Simple POS',
                                "Error: Session Time-Out, You must login again to continue.");
                            location.reload(true);
                        } else if (data.indexOf("Error: ") > -1) {
                            $(".error_show").css("display", "block");
                            $(".error_msg").text(data);
                            $("#txt_uom_abbrevation_update").select().focus();
                        } else {
                            $("#tbl_uom_list tbody").html(data);

                            $("#win_uom_modify").modal('hide');

                            $('[data-toggle="tooltip"]').tooltip({
                                html: true
                            });
                        }
                    })
                } else {
                    $(".error_show").css("display", "block");
                    $(".error_msg").text("Error: uom abbrevation should 3 chars maximum only!");
                    $("#txt_uom_abbrevation_update").select().focus();
                }
            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: All fields are important!");
                $("#txt_uom_abbrevation_update").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_uom_abbrevation_update").select().focus();
        }
    });

    $(document).on('click', '.btn_uom_modify', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            //$("#loading").modal();
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_uom_modify").modal();

            $.post("db_uom.php", {
                action: 4,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_uom_modify").modal('hide');

                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_uom_modify").modal('hide');

                    showError('Simple POS', data);
                } else {
                    var uom = data.split(":|:")[0];
                    var description = data.split(":|:")[1];

                    $(".hidden_uom_id").val(id);
                    $("#txt_uom_abbrevation_update").val(uom);
                    $("#txt_uom_description_update").val(description);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_uom_modify").modal();
                }
            });
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $('#win_uom_modify').on('shown.bs.modal', function() {
        $('#txt_uom_abbrevation_update').focus().select();
    });

    $(document).on('keypress', '.txt-uom', function(e) {
        if (e.which == 13) {
            $("#btn_uom_save").trigger('click');
        }

        if ($(this).val().length >= 3) {
            return false;
        }

    });

    $(document).on('click', '#btn_uom_save', function(e) {
        e.preventDefault();
        var abbrevation = $("#txt_uom_abbrevation").val();
        var description = $("#txt_uom_description").val();

        if (abbrevation && description) {
            if (abbrevation.length <= 3) {
                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_uom.php", {
                    action: 2,
                    abbrevation: abbrevation,
                    description: description
                }, function(data) {
                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");

                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                        showError('Simple POS',
                            "Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);
                    } else if (data.indexOf("Error: ") > -1) {
                        $(".error_show").css("display", "block");
                        $(".error_msg").text(data);
                        $("#txt_uom_abbrevation").select().focus();
                    } else {
                        $("#tbl_uom_list tbody").html(data);

                        $("#win_uom_new").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }
                })
            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: uom abbrevation should 3 chars maximum only!");
                $("#txt_uom_abbrevation").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: All fields are important!");
            $("#txt_uom_abbrevation").select().focus();
        }
    });
    </script>
</body>

</html>