<?php
include('validate.php');
include('config.php');
$mnu = 'menu_product';
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
  include('win_uom_new.php');
  include('win_uom_modify.php');
  include('win_uom_asearch.php');

  include('win_supplier_new.php');
  include('win_supplier_modify.php');
  include('win_supplier_asearch.php');

  include('win_product_new.php');
  include('win_product_modify.php');
  include('win_product_asearch.php');
  include('win_product_price.php');

  include('win_receiving_new.php');
  include('win_receiving_modify.php');
  include('win_receiving_cancel_reason.php');
  include('win_receiving_asearch.php');

  include('win_buyer_asearch.php');
  include('win_buyer_new.php');
  include('win_buyer_modify.php');

  include('win_price_add.php');
  include('win_price_modify.php');

  include('win_category_asearch.php');
  include('win_category_new.php');
  include('win_category_modify.php');

  include('win_payment_type_asearch.php');
  include('win_payment_type_new.php');
  include('win_payment_type_modify.php');

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
                            <li class="navbar-title"><span class='fa fa-cubes fa-2x'></span><span class="highlight"
                                    style='margin-left: 0.5em;'> DATA MANAGEMENT</span></li>

                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="navbar-search hidden-sm">
                                <input id="txt_product_search" type="text" placeholder="Search..">
                                <button id="btn_product_search" class="btn-search"><i class="fa fa-search"></i></button>
                            </li>

                            <li class="dropdown notification warning">
                                <a class="btn_product_asearch dropdown-toggle" data-toggle="dropdown">
                                    <div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <div class="title">Advance Search</div>
                                    <div class="count">+</div>
                                </a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="btn_product_asearch dropdown-empty">Advance Search</li>
                                    </ul>
                                </div>
                            </li>

                            <li class="dropdown notification danger">
                                <a class="btn_product_new dropdown-toggle" data-toggle="dropdown">
                                    <div class="icon"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                    <div class="title">New Entry</div>
                                    <div class="count">n</div>
                                </a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="btn_product_new dropdown-empty">New Entry</li>
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
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li id="1" role="presentation" class="tab_product active"><a href="#product"
                                                    aria-controls="product" role="tab" data-toggle="tab"><i
                                                        class='fa fa-cube fa-fw'></i>Product</a></li>
                                            <li id="2" role="presentation" class="tab_product"><a href="#receiving"
                                                    aria-controls="receiving" role="tab" data-toggle="tab"><i
                                                        class='fa fa-download fa-fw'></i>Receiving</a></li>
                                            <li id="3" role="presentation" class="tab_product"><a href="#uom"
                                                    aria-controls="uom" role="tab" data-toggle="tab"><i
                                                        class='fa fa-random fa-fw'></i>UOM</a></li>
                                            <li id="4" role="presentation" class="tab_product"><a href="#supplier"
                                                    aria-controls="supplier" role="tab" data-toggle="tab"><i
                                                        class='fa fa-truck fa-fw'></i>Supplier</a></li>
                                            <li id="5" role="presentation" class="tab_product"><a href="#buyer"
                                                    aria-controls="buyer" role="tab" data-toggle="tab"><i
                                                        class='fa fa-group fa-fw'></i>Buyer</a></li>
                                            <li id="6" role="presentation" class="tab_product"><a href="#price"
                                                    aria-controls="price" role="tab" data-toggle="tab"><i
                                                        class='fa fa-tags fa-fw'></i>Pricing</a></li>
                                            <li id="7" role="presentation" class="tab_product"><a href="#category"
                                                    aria-controls="category" role="tab" data-toggle="tab"><i
                                                        class='fa fa-list fa-fw'></i>Category</a></li>
                                            <li id="8" role="presentation" class="tab_product"><a href="#payment_type"
                                                    aria-controls="payment_type" role="tab" data-toggle="tab"><i
                                                        class='fa fa-thumbs-up fa-fw'></i>Payment</a></li>

                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="product">
                                                <div class="card">

                                                    <div class="card-body no-padding">
                                                        <table id="tbl_product_list"
                                                            class="tbl_product_list table table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Option</th>
                                                                    <th>Product Code</th>
                                                                    <th>Product Name</th>
                                                                    <th>Stock</th>
                                                                    <th>UOM</th>
                                                                    <th>CATEGORY</th>
                                                                    <!--
                                                                    <th>Selling Price</th>
                                                                    -->
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                  include('connect.php');

                                                                  include('query_product.php');
                                                                  $sql .= ' ORDER BY p.product_name;';

                                                                  include('pop_product.php');

                                                                  $mysqli->close();
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="receiving">
                                                <div class="card">
                                                    <div class="card-body no-padding">
                                                        <table id="tbl_receiving_list"
                                                            class="table table-sm table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>OPTION</th>
                                                                    <th>DATE</th>
                                                                    <th>CODE</th>
                                                                    <th>PRODUCT</th>
                                                                    <th>QTY</th>
                                                                    <th>UOM</th>
                                                                    <th>PRICE</th>
                                                                    <th>TOTAL</th>
                                                                    <th>SUPPLIER</th>
                                                                    <th>RECEIVED</th>
                                                                    <th>STATUS</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!--
                                                                <tr><td colspan='9' align='center'>Please use the search <span class='fa fa-search'></span> field to display record</td></tr>
                                                                -->
                                                                <?php
                                                                  include('connect.php');

                                                                  include("query_receiving.php");

                                                                  $sql .= " WHERE s.dt = CURDATE() ";
                                                                  $sql .= " ORDER BY p.product_name;";

                                                                  include('pop_receiving.php');

                                                                  $mysqli->close();
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="uom">
                                                <div class="card">
                                                    <div class="card-body no-padding">
                                                        <table id="tbl_uom_list"
                                                            class="table table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Option</th>
                                                                    <th>Abbrevation</th>
                                                                    <th>Description</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan='3'>Use Search Field Above to Show List
                                                                    </td>
                                                                </tr>
                                                                <?php
                                /*
                                    include('connect.php');
                                    
                                    include('query_uom.php');
                                    $sql .= ' ORDER BY uom;';
                                    
                                    include('pop_uom.php');
                                    
                                    $mysqli->close();
                                    */
                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="supplier">
                                                <div class="card">
                                                    <div class="card-body no-padding">
                                                        <table id="tbl_supplier_list"
                                                            class="table table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS !important; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Option</th>
                                                                    <th>Supplier Name</th>
                                                                    <th>Description</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan='3'>Use Search Field Above to Show List
                                                                    </td>
                                                                </tr>
                                                                <?php
                                /*
                                    include('connect.php');
                                    
                                    include('query_supplier.php');
                                    $sql .= ' ORDER BY supplier;';
                                    
                                    include('pop_supplier.php');
                                    
                                    $mysqli->close();
                                    */
                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="buyer">
                                                <div class="card">
                                                    <div class="card-body no-padding">
                                                        <table id="tbl_buyer_list"
                                                            class="table table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS !important; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Option</th>
                                                                    <th>Buyer Type</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan='3'>Use Search Field Above to Show List
                                                                    </td>
                                                                </tr>
                                                                <?php
                                /*
                                    include('connect.php');
                                    
                                    include('query_buyer.php');
                                    $sql .= ' ORDER BY buyer;';
                                    
                                    include('pop_buyer.php');
                                    
                                    $mysqli->close();
                                    */
                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="price">
                                                <div class="card">
                                                    <div class="card-body no-padding">
                                                        <table id="tbl_price_list"
                                                            class="table table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS !important; ">
                                                            <?php
                              echo "<thead>";

                              echo "  <tr>";
                              echo "    <th>CODE</th>";
                              echo "    <th>PRODUCT</th>";

                              include('connect.php');
                              $buyer_list = array();

                              $sql = "SELECT id, type FROM pos_buyer WHERE status_id=1 ORDER BY type;";
                              $pop = $mysqli->query($sql);
                              if ($pop) {
                                $buyer_count = $pop->num_rows + 2;

                                while ($row = $pop->fetch_object()) {
                                  $buyer_id = $row->id;
                                  $buyer_type = strtoupper($row->type . '');
                                  echo "<th>{$buyer_type}</th>";

                                  array_push($buyer_list, $buyer_id);
                                }
                              }

                              echo "  </tr>";

                              echo "</thead>";
                              echo "<tbody>";

                              echo "  <td colspan='{$buyer_count}'>Use Search Field Above to Show List</td>";

                              /*
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
                                                $price_add_id = $p_id  . ":~|~:" . $buyer_value;
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
                                    */

                              $mysqli->close();

                              echo "</tbody>";

                              ?>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="category">
                                                <div class="card">
                                                    <div class="card-body no-padding">
                                                        <table id="tbl_category_list"
                                                            class="table table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS !important; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Option</th>
                                                                    <th>Category</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan='3'>Use Search Field Above to Show List
                                                                    </td>
                                                                </tr>
                                                                <?php
                                /*
                                    include('connect.php');
                                    
                                    include('query_category.php');
                                    $sql .= ' ORDER BY category;';
                                    
                                    include('pop_category.php');
                                    
                                    $mysqli->close();
                                    */
                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="payment_type">
                                                <div class="card">
                                                    <div class="card-body no-padding">
                                                        <table id="tbl_payment_type_list"
                                                            class="table table-bordered table-hover table-striped"
                                                            cellspacing="0" width="100%"
                                                            style="font: 90% Trebuchet MS !important; ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Option</th>
                                                                    <th>Payment Type</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan='3'>Use Search Field Above to Show List
                                                                    </td>
                                                                </tr>
                                                                <?php
                                /*
                                    include('connect.php');
                                    
                                    include('query_payment_type.php');
                                    $sql .= ' ORDER BY payment_type;';
                                    
                                    include('pop_payment_type.php');
                                    
                                    $mysqli->close();
                                    */
                                ?>
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

    <script type="text/javascript" src="./assets/js/vendor.js"></script>
    <script type="text/javascript" src="./assets/js/app.js"></script>
    <script type="text/javascript" src="./assets/js/changepass.js"></script>

    <script src="./assets/js/jquery-ui.min.js"></script>

    <script type="text/javascript" src="./assets/js/bootstrap-dialog.js"></script>
    <script type="text/javascript" src="./assets/js/functions.js"></script>
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

    //showError('Simple POS',"Error: Critical Error Encountered!");
    var tab_product = 1; //default tab

    $(document).on("click", ".tab_product", function(e) {
        tab_product = $(this).attr('id');
    });

    //btn_payment_type_asearch
    //advance search payment_type
    $(document).on('keypress', '.txt-payment_type-asearch', function(e) {
        if (e.which == 13) {
            $("#btn_payment_type_asearch").trigger('click');
        }
    });

    $(document).on('click', '#btn_payment_type_asearch', function(e) {
        e.preventDefault();
        var payment_type = $("#txt_payment_type_asearch").val();
        var status_id = $("#txt_payment_type_status_asearch").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_payment_type.php", {
            action: 6,
            payment_type: payment_type,
            status_id: status_id
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_payment_type_asearch").select().focus();
            } else {
                $("#tbl_payment_type_list tbody").html(data);

                $("#win_payment_type_asearch").modal('hide');

                $('[data-toggle="tooltip"]').tooltip({
                    html: true
                });
            }
        });

    });

    //btn_category_asearch
    //advance search category
    $(document).on('keypress', '.txt-category-asearch', function(e) {
        if (e.which == 13) {
            $("#btn_category_asearch").trigger('click');
        }
    });

    $(document).on('click', '#btn_category_asearch', function(e) {
        e.preventDefault();
        var category = $("#txt_category_asearch").val();
        var status_id = $("#txt_category_status_asearch").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_category.php", {
            action: 6,
            category: category,
            status_id: status_id
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_category_asearch").select().focus();
            } else {
                $("#tbl_category_list tbody").html(data);

                $("#win_category_asearch").modal('hide');

                $('[data-toggle="tooltip"]').tooltip({
                    html: true
                });
            }
        });

    });

    //btn_buyer_asearch
    //advance search buyer
    $(document).on('keypress', '.txt-buyer-asearch', function(e) {
        if (e.which == 13) {
            $("#btn_buyer_asearch").trigger('click');
        }
    });

    $(document).on('click', '#btn_buyer_asearch', function(e) {
        e.preventDefault();
        var buyer = $("#txt_buyer_name_asearch").val();
        var status_id = $("#txt_buyer_status_asearch").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_buyer.php", {
            action: 6,
            buyer: buyer,
            status_id: status_id
        }, function(data) {
            $(".buttons_show, .modal-body").css("display", "block");
            $(".progress_show, .error_show").css("display", "none");

            if (data.indexOf("<!DOCTYPE html>") > -1) {
                showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
                location.reload(true);
            } else if (data.indexOf("Error: ") > -1) {
                $(".error_show").css("display", "block");
                $(".error_msg").text(data);
                $("#txt_buyer_name_asearch").select().focus();
            } else {
                $("#tbl_buyer_list tbody").html(data);

                $("#win_buyer_asearch").modal('hide');

                $('[data-toggle="tooltip"]').tooltip({
                    html: true
                });
            }
        });

    });


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
        var search_category = $("#txt_product_category_asearch").val();
        var search_price = $("#txt_product_price_asearch").val();
        var search_status = $("#txt_product_status_asearch").val();

        $(".buttons_show, .error_show, .modal-body").css("display", "none");
        $(".progress_show").css("display", "block");

        $.post("db_product.php", {
            action: 6,
            product_code: search_code,
            product_name: search_name,
            product_uom: search_uom,
            product_category: search_category,
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

            case 5: //BUYER
                $(".txt-buyer-asearch").val("");
                $("#win_buyer_asearch").modal();

                $('#win_buyer_asearch').on('shown.bs.modal', function() {
                    $('#txt_buyer_name_asearch').focus().select();
                })
                break;

            case 7: //CATEGORY
                $(".txt-category-asearch").val("");
                $("#win_category_asearch").modal();

                $('#win_category_asearch').on('shown.bs.modal', function() {
                    $('#txt_category_asearch').focus().select();
                })
                break;

            case 8: //PAYMENT_TYPE
                $(".txt-payment_type-asearch").val("");
                $("#win_payment_type_asearch").modal();

                $('#win_payment_type_asearch').on('shown.bs.modal', function() {
                    $('#txt_payment_type_asearch').focus().select();
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

            case 5: //buyer search
                $("#loading").modal();

                $.post("db_buyer.php", {
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
                        $("#tbl_buyer_list tbody").html(data);

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }

                });
                break;

            case 6: //pricing search
                $("#loading").modal();

                $.post("db_price.php", {
                    action: 2,
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
                        $("#tbl_price_list").html(data);

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }

                });
                break;

            case 7: //category search
                $("#loading").modal();

                $.post("db_category.php", {
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
                        $("#tbl_category_list tbody").html(data);

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });
                    }

                });
                break;

            case 8: //payment_type search
                $("#loading").modal();

                $.post("db_payment_type.php", {
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
                        $("#tbl_payment_type_list tbody").html(data);

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

            case 5: //buyer type
                $(".txt-buyer").val("");
                $("#win_buyer_new").modal();

                $('#win_buyer_new').on('shown.bs.modal', function() {
                    $('#txt_buyer_type').focus().select();
                })
                break;

            case 7: //category type
                $(".txt-category").val("");
                $("#win_category_new").modal();

                $('#win_category_new').on('shown.bs.modal', function() {
                    $('#txt_category').focus().select();
                })
                break;

            case 8: //payment_type type          
                $(".txt-payment_type").val("");
                $("#win_payment_type_new").modal();

                $('#win_payment_type_new').on('shown.bs.modal', function() {
                    $('#txt_payment_type').focus().select();
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
                    var price = data.split(":~|~:")[6];
                    var total = data.split(":~|~:")[7];

                    $(".hidden_receiving_id").val(id);
                    $("#txt_receiving_dt_update").val(dt);

                    $("#txt_receiving_code_update").val(product_code);
                    $("#txt_receiving_name_update").val(product_name);
                    $("#txt_receiving_uom_update").text(uom);
                    $("#txt_receiving_qty_update").val(qty);
                    $("#txt_receiving_price_update").val(price);
                    $("#txt_receiving_total_update").val(total);
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

    $(document).on('change', '#txt_receiving_qty, #txt_receiving_price', function() {
        var qty = Number($("#txt_receiving_qty").val()) ? Number($("#txt_receiving_qty").val()) : 0;
        var price = Number($("#txt_receiving_price").val()) ? Number($("#txt_receiving_price").val()) : 0;
        var total = qty * price;

        $("#txt_receiving_total").val(total.toFixed(2));
    });

    $(document).on('keyup', '#txt_receiving_qty, #txt_receiving_price', function() {
        $(this).trigger('change');
    });

    $(document).on('change', '#txt_receiving_qty_update, #txt_receiving_price_update', function() {
        var qty = Number($("#txt_receiving_qty_update").val()) ? Number($("#txt_receiving_qty_update").val()) :
            0;
        var price = Number($("#txt_receiving_price_update").val()) ? Number($("#txt_receiving_price_update")
            .val()) : 0;
        var total = qty * price;

        $("#txt_receiving_total_update").val(total.toFixed(2));
    });

    $(document).on('keyup', '#txt_receiving_qty_update, #txt_receiving_price_update', function() {
        $(this).trigger('change');
    });

    $(document).on('click', '#btn_receiving_save', function(e) {
        e.preventDefault();
        var id = $(".hidden_product_id").val();
        var product_name = $("#txt_receiving_name").val();
        var qty = parseFloat($("#txt_receiving_qty").val());
        var price = parseFloat($("#txt_receiving_price").val());
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
                        price: price,
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
                type: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
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
        var price = parseFloat($("#txt_receiving_price_update").val());
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
                    price: price,
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
                type: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
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
                type: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
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
        var product_category = $("#txt_product_category_update").val();

        if (id) {
            if (product_code && product_name && product_uom && product_category) {

                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_product.php", {
                    action: 3,
                    id: id,
                    product_code: product_code,
                    product_name: product_name,
                    product_uom: product_uom,
                    product_category: product_category
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
                    var product_category = data.split(":|:")[3];

                    $(".hidden_product_id").val(id);
                    $("#txt_product_code_update").val(product_code);
                    $("#txt_product_name_update").val(product_name);
                    $("#txt_product_uom_update").val(product_uom);
                    $("#txt_product_category_update").val(product_category);

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
        var product_category = $("#txt_product_category").val();

        if (product_code && product_name && product_uom && product_category) {

            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_product.php", {
                action: 2,
                product_code: product_code,
                product_name: product_name,
                product_uom: product_uom,
                product_category: product_category
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

    //BUYER
    //BUYER MODIFY
    $(document).on('keypress', '.txt-buyer-update', function(e) {
        if (e.which == 13) {
            $("#btn_buyer_update").trigger('click');
        }
    });

    //buyer save update
    $(document).on('click', '#btn_buyer_update', function(e) {
        e.preventDefault();
        var id = $('.hidden_buyer_id').val();
        var buyer = $("#txt_buyer_type_update").val();
        var tr_id = "#tr_" + id;

        if (id) {
            if (buyer) {

                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_buyer.php", {
                    action: 3,
                    id: id,
                    buyer: buyer
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
                        $("#txt_buyer_type_update").select().focus();
                    } else {
                        $("#tbl_buyer_list tbody " + tr_id).html(data);

                        $("#win_buyer_modify").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });

                        //reload pricing table
                        $.post("db_price.php", {
                            action: 1
                        }, function(data) {
                            if (data.indexOf("<!DOCTYPE html>") > -1) {
                                showError('Simple POS',
                                    "Error: Session Time-Out, You must login again to continue."
                                );
                                location.reload(true);
                            } else if (data.indexOf("Error: ") > -1) {
                                $(".error_show").css("display", "block");
                                $(".error_msg").text(data);
                                location.reload();
                            } else {
                                $("#tbl_price_list").html(data);
                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                            }
                        });

                    }
                })

            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: All fields are important!");
                $("#txt_buyer_type_update").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_buyer_type_update").select().focus();
        }
    });

    //buyer show modify window
    $(document).on('click', '.btn_buyer_modify', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            //$("#loading").modal();
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_buyer_modify").modal();

            $.post("db_buyer.php", {
                action: 4,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_buyer_modify").modal('hide');

                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_buyer_modify").modal('hide');

                    showError('Simple POS', data);
                } else {
                    var buyer = data;


                    $(".hidden_buyer_id").val(id);
                    $("#txt_buyer_type_update").val(buyer);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_buyer_modify").modal();
                }
            });
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $('#win_buyer_modify').on('shown.bs.modal', function() {
        $('#txt_buyer_type_update').focus().select();
    });



    //BUYER SAVE
    $(document).on('keypress', '.txt-buyer', function(e) {
        if (e.which == 13) {
            $("#btn_buyer_save").trigger('click');
        }

    });

    $(document).on('click', '#btn_buyer_save', function(e) {
        e.preventDefault();
        var type = $("#txt_buyer_type").val();

        if (type) {

            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_buyer.php", {
                action: 2,
                type: type
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
                    $("#txt_buyer_type").select().focus();
                } else {
                    $("#tbl_buyer_list tbody").html(data);

                    $("#win_buyer_new").modal('hide');

                    $('[data-toggle="tooltip"]').tooltip({
                        html: true
                    });

                    //reload pricing table
                    $.post("db_price.php", {
                        action: 1
                    }, function(data) {
                        if (data.indexOf("<!DOCTYPE html>") > -1) {
                            showError('Simple POS',
                                "Error: Session Time-Out, You must login again to continue."
                            );
                            location.reload(true);
                        } else if (data.indexOf("Error: ") > -1) {
                            $(".error_show").css("display", "block");
                            $(".error_msg").text(data);
                            location.reload();
                        } else {
                            $("#tbl_price_list").html(data);
                            $('[data-toggle="tooltip"]').tooltip({
                                html: true
                            });

                        }
                    });

                }
            })
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: All fields are important!");
            $("#txt_buyer_abbrevation").select().focus();
        }
    });

    //buyer activate
    $(document).on('click', '.btn_buyer_activate', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to ACTIVATE this buyer?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
                message: txt,
                type: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
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

                        $.post("db_buyer.php", {
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

                                $("#tbl_buyer_list tbody #" + tr_id).html(data)
                                    .removeClass(
                                        'danger');

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                                //reload pricing table
                                $.post("db_price.php", {
                                    action: 1
                                }, function(data) {
                                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                                        showError('Simple POS',
                                            "Error: Session Time-Out, You must login again to continue."
                                        );
                                        location.reload(true);
                                    } else if (data.indexOf("Error: ") > -1) {
                                        $(".error_show").css("display",
                                            "block");
                                        $(".error_msg").text(data);
                                        location.reload();
                                    } else {
                                        $("#tbl_price_list").html(data);
                                        $('[data-toggle="tooltip"]').tooltip({
                                            html: true
                                        });

                                    }
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

    //buyer delete
    $(document).on('click', '.btn_buyer_delete', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to MARK as Inactive this buyer type?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
                message: txt,
                type: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
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

                        $.post("db_buyer.php", {
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

                                $("#tbl_buyer_list tbody #" + tr_id).html(data)
                                    .addClass(
                                        'danger');

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                                //reload pricing table
                                $.post("db_price.php", {
                                    action: 1
                                }, function(data) {
                                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                                        showError('Simple POS',
                                            "Error: Session Time-Out, You must login again to continue."
                                        );
                                        location.reload(true);
                                    } else if (data.indexOf("Error: ") > -1) {
                                        $(".error_show").css("display",
                                            "block");
                                        $(".error_msg").text(data);
                                        location.reload();
                                    } else {
                                        $("#tbl_price_list").html(data);
                                        $('[data-toggle="tooltip"]').tooltip({
                                            html: true
                                        });

                                    }
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

    //PRICE save price
    $(document).on('click', '#btn_price_save', function(e) {
        e.preventDefault();

        var product_id = $(".hidden_product_id").val();
        var buyer_id = $(".hidden_buyer_id").val();
        var amount = $("#txt_price_amount").val();

        if (product_id && buyer_id && $.isNumeric(amount)) {
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_price.php", {
                action: 4,
                product_id: product_id,
                buyer_id: buyer_id,
                amount: amount
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
                    $("#txt_price_amount").select().focus();
                } else {
                    $("#tbl_price_list").html(data);

                    $('#win_price_add').modal('hide');

                    $('[data-toggle="tooltip"]').tooltip({
                        html: true
                    });
                }
            });
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_price_amount").select().focus();
        }

    });

    //PRICE show set window
    $(document).on('click', '.price_add', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var product_id = id.split(":~|~:")[0];
        var buyer_id = id.split(":~|~:")[1];


        if (product_id && buyer_id) {
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_price.php", {
                action: 3,
                product_id: product_id,
                buyer_id: buyer_id
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
                    $("#txt_price_amount").select().focus();
                } else {
                    var product_code = data.split(":|:")[0];
                    var product_name = data.split(":|:")[1];
                    var product_uom = data.split(":|:")[2];
                    var buyer = data.split(":|:")[3];

                    $(".hidden_product_id").val(product_id);
                    $(".hidden_buyer_id").val(buyer_id);

                    $("#txt_price_productcode").val(product_code);
                    $("#txt_price_productname").val(product_name);
                    $("#txt_price_uom").text(product_uom);
                    $("#txt_price_buyer").val(buyer);

                    $('#win_price_add').modal();

                    $('#win_price_add').on('shown.bs.modal', function() {
                        $('#txt_price_amount').focus().select();
                    });

                }
            });
        } else {
            showError('Simple POS', 'Error: Critical Error Encountered!');
        }
    });

    //PRICE show modify window
    $(document).on('click', '.price_modify', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        if (id) {
            $("#loading").show();
            $.post("db_price.php", {
                action: 5,
                id: id
            }, function(data) {
                $("#loading").hide();

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    showError('Simple POS', data);
                } else {
                    if (data) {
                        data = JSON.parse(data);
                        var product_id = data.product_id;
                        var product_code = data.product_code;
                        var product_name = data.product_name;
                        var product_uom = data.uom;
                        var buyer_type = data.type;
                        var price = data.price;

                        $(".hidden_price_id").val(id);
                        $(".hidden_product_id").val(product_id);

                        $("#txt_price_productcode_update").val(product_code);
                        $("#txt_price_productname_update").val(product_name);
                        $("#txt_price_uom_update").text(product_uom);
                        $("#txt_price_buyer_update").val(buyer_type);
                        $("#txt_price_amount_update").val(price);
                        $("#txt_price_remarks_update").val("");

                        $('#win_price_modify').modal();

                        $('#win_price_modify').on('shown.bs.modal', function() {
                            $('#txt_price_amount_update').focus().select();
                        });

                    } else {
                        showError('Simple POS', "Error: Critical Error Encountered!");
                    }

                }
            });
        } else {
            showError('Simple POS', 'Error: Critical Error Encountered!');
        }
    });

    //PRICE update price
    $(document).on('click', '#btn_price_update', function(e) {
        e.preventDefault();

        var id = parseInt($(".hidden_price_id").val());
        var amount = parseFloat($("#txt_price_amount_update").val());
        var product_id = $(".hidden_product_id").val();
        var remarks = $("#txt_price_remarks_update").val();

        if (id && $.isNumeric(amount)) {
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_price.php", {
                action: 6,
                id: id,
                amount: amount,
                product_id: product_id,
                remarks: remarks
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
                    $("#txt_price_amount").select().focus();
                } else {
                    $("#tbl_price_list").html(data);

                    $('#win_price_modify').modal('hide');

                    $('[data-toggle="tooltip"]').tooltip({
                        html: true
                    });
                }
            });
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_price_amount").select().focus();
        }

    });






    //CATEGORY
    //CATEGORY MODIFY
    $(document).on('keypress', '.txt-category-update', function(e) {
        if (e.which == 13) {
            $("#btn_category_update").trigger('click');
        }
    });

    //category save update
    $(document).on('click', '#btn_category_update', function(e) {
        e.preventDefault();
        var id = $('.hidden_category_id').val();
        var category = $("#txt_category_update").val();
        var tr_id = "#tr_" + id;

        if (id) {
            if (category) {

                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_category.php", {
                    action: 3,
                    id: id,
                    category: category
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
                        $("#txt_category_update").select().focus();
                    } else {
                        $("#tbl_category_list tbody " + tr_id).html(data);

                        $("#win_category_modify").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });

                        //reload pricing table
                        $.post("db_price.php", {
                            action: 1
                        }, function(data) {
                            if (data.indexOf("<!DOCTYPE html>") > -1) {
                                showError('Simple POS',
                                    "Error: Session Time-Out, You must login again to continue."
                                );
                                location.reload(true);
                            } else if (data.indexOf("Error: ") > -1) {
                                $(".error_show").css("display", "block");
                                $(".error_msg").text(data);
                                location.reload();
                            } else {
                                $("#tbl_price_list").html(data);
                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                            }
                        });

                    }
                })

            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: All fields are important!");
                $("#txt_category_update").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_category_update").select().focus();
        }
    });

    //category show modify window
    $(document).on('click', '.btn_category_modify', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            //$("#loading").modal();
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_category_modify").modal();

            $.post("db_category.php", {
                action: 4,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_category_modify").modal('hide');

                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_category_modify").modal('hide');

                    showError('Simple POS', data);
                } else {
                    var category = data;


                    $(".hidden_category_id").val(id);
                    $("#txt_category_update").val(category);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_category_modify").modal();
                }
            });
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $('#win_category_modify').on('shown.bs.modal', function() {
        $('#txt_category_update').focus().select();
    });

    //CATEGORY SAVE
    $(document).on('keypress', '.txt-category', function(e) {
        if (e.which == 13) {
            $("#btn_category_save").trigger('click');
        }

    });

    $(document).on('click', '#btn_category_save', function(e) {
        e.preventDefault();
        var category = $("#txt_category").val();

        if (category) {

            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_category.php", {
                action: 2,
                category: category
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
                    $("#txt_category").select().focus();
                } else {
                    $("#tbl_category_list tbody").html(data);

                    $("#win_category_new").modal('hide');

                    $('[data-toggle="tooltip"]').tooltip({
                        html: true
                    });

                    //reload pricing table
                    $.post("db_price.php", {
                        action: 1
                    }, function(data) {
                        if (data.indexOf("<!DOCTYPE html>") > -1) {
                            showError('Simple POS',
                                "Error: Session Time-Out, You must login again to continue."
                            );
                            location.reload(true);
                        } else if (data.indexOf("Error: ") > -1) {
                            $(".error_show").css("display", "block");
                            $(".error_msg").text(data);
                            location.reload();
                        } else {
                            $("#tbl_price_list").html(data);
                            $('[data-toggle="tooltip"]').tooltip({
                                html: true
                            });

                        }
                    });

                }
            })
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: All fields are important!");
            $("#txt_category").select().focus();
        }
    });

    //category activate
    $(document).on('click', '.btn_category_activate', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to ACTIVATE this category?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
                message: txt,
                category: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                closable: true, // <-- Default value is false
                //draggable: true, // <-- Default value is false
                //btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
                btnOKLabel: 'Proceed', // <-- Default value is 'OK',
                btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog category will be used,
                btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog category will be used,
                autospin: true,
                callback: function(result) {
                    // result will be true if button was click, while it will be false if users close the dialog directly.
                    if (result) {

                        $.post("db_category.php", {
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

                                $("#tbl_category_list tbody #" + tr_id).html(data)
                                    .removeClass('danger');

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                                //reload pricing table
                                $.post("db_price.php", {
                                    action: 1
                                }, function(data) {
                                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                                        showError('Simple POS',
                                            "Error: Session Time-Out, You must login again to continue."
                                        );
                                        location.reload(true);
                                    } else if (data.indexOf("Error: ") > -1) {
                                        $(".error_show").css("display",
                                            "block");
                                        $(".error_msg").text(data);
                                        location.reload();
                                    } else {
                                        $("#tbl_price_list").html(data);
                                        $('[data-toggle="tooltip"]').tooltip({
                                            html: true
                                        });

                                    }
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

    //category delete
    $(document).on('click', '.btn_category_delete', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to MARK as Inactive this category category?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
                message: txt,
                category: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                closable: true, // <-- Default value is false
                //draggable: true, // <-- Default value is false
                //btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
                btnOKLabel: 'Proceed', // <-- Default value is 'OK',
                btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog category will be used,
                btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog category will be used,
                autospin: true,
                callback: function(result) {
                    // result will be true if button was click, while it will be false if users close the dialog directly.
                    if (result) {

                        $.post("db_category.php", {
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

                                $("#tbl_category_list tbody #" + tr_id).html(data)
                                    .addClass(
                                        'danger');

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                                //reload pricing table
                                $.post("db_price.php", {
                                    action: 1
                                }, function(data) {
                                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                                        showError('Simple POS',
                                            "Error: Session Time-Out, You must login again to continue."
                                        );
                                        location.reload(true);
                                    } else if (data.indexOf("Error: ") > -1) {
                                        $(".error_show").css("display",
                                            "block");
                                        $(".error_msg").text(data);
                                        location.reload();
                                    } else {
                                        $("#tbl_price_list").html(data);
                                        $('[data-toggle="tooltip"]').tooltip({
                                            html: true
                                        });

                                    }
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



    //PAYMENT_TYPE
    //PAYMENT_TYPE MODIFY
    $(document).on('keypress', '.txt-payment_type-update', function(e) {
        if (e.which == 13) {
            $("#btn_payment_type_update").trigger('click');
        }
    });

    //payment_type save update
    $(document).on('click', '#btn_payment_type_update', function(e) {
        e.preventDefault();
        var id = $('.hidden_payment_type_id').val();
        var payment_type = $("#txt_payment_type_update").val();
        var tr_id = "#tr_" + id;

        if (id) {
            if (payment_type) {

                $(".buttons_show, .error_show, .modal-body").css("display", "none");
                $(".progress_show").css("display", "block");

                $.post("db_payment_type.php", {
                    action: 3,
                    id: id,
                    payment_type: payment_type
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
                        $("#txt_payment_type_update").select().focus();
                    } else {
                        $("#tbl_payment_type_list tbody " + tr_id).html(data);

                        $("#win_payment_type_modify").modal('hide');

                        $('[data-toggle="tooltip"]').tooltip({
                            html: true
                        });

                        //reload pricing table
                        $.post("db_price.php", {
                            action: 1
                        }, function(data) {
                            if (data.indexOf("<!DOCTYPE html>") > -1) {
                                showError('Simple POS',
                                    "Error: Session Time-Out, You must login again to continue."
                                );
                                location.reload(true);
                            } else if (data.indexOf("Error: ") > -1) {
                                $(".error_show").css("display", "block");
                                $(".error_msg").text(data);
                                location.reload();
                            } else {
                                $("#tbl_price_list").html(data);
                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                            }
                        });

                    }
                })

            } else {
                $(".error_show").css("display", "block");
                $(".error_msg").text("Error: All fields are important!");
                $("#txt_payment_type_update").select().focus();
            }
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: Critical Error Encountered!");
            $("#txt_payment_type_update").select().focus();
        }
    });

    //payment_type show modify window
    $(document).on('click', '.btn_payment_type_modify', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        if (id) {
            //$("#loading").modal();
            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $("#win_payment_type_modify").modal();

            $.post("db_payment_type.php", {
                action: 4,
                id: id
            }, function(data) {
                //$("#loading").modal('hide');         

                if (data.indexOf("<!DOCTYPE html>") > -1) {
                    $("#win_payment_type_modify").modal('hide');

                    showError('Simple POS',
                        "Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);
                } else if (data.indexOf("Error: ") > -1) {
                    $("#win_payment_type_modify").modal('hide');

                    showError('Simple POS', data);
                } else {
                    var payment_type = data;


                    $(".hidden_payment_type_id").val(id);
                    $("#txt_payment_type_update").val(payment_type);

                    $(".buttons_show, .modal-body").css("display", "block");
                    $(".progress_show, .error_show").css("display", "none");
                    //$("#win_payment_type_modify").modal();
                }
            });
        } else {
            showError('Simple POS', "Error: Critical Error Encountered!");
        }
    });

    $('#win_payment_type_modify').on('shown.bs.modal', function() {
        $('#txt_payment_type_update').focus().select();
    });

    //PAYMENT_TYPE SAVE
    $(document).on('keypress', '.txt-payment_type', function(e) {
        if (e.which == 13) {
            $("#btn_payment_type_save").trigger('click');
        }

    });

    $(document).on('click', '#btn_payment_type_save', function(e) {
        e.preventDefault();
        var payment_type = $("#txt_payment_type").val();

        if (payment_type) {

            $(".buttons_show, .error_show, .modal-body").css("display", "none");
            $(".progress_show").css("display", "block");

            $.post("db_payment_type.php", {
                action: 2,
                payment_type: payment_type
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
                    $("#txt_payment_type").select().focus();
                } else {
                    $("#tbl_payment_type_list tbody").html(data);

                    $("#win_payment_type_new").modal('hide');

                    $('[data-toggle="tooltip"]').tooltip({
                        html: true
                    });

                    //reload pricing table
                    $.post("db_price.php", {
                        action: 1
                    }, function(data) {
                        if (data.indexOf("<!DOCTYPE html>") > -1) {
                            showError('Simple POS',
                                "Error: Session Time-Out, You must login again to continue."
                            );
                            location.reload(true);
                        } else if (data.indexOf("Error: ") > -1) {
                            $(".error_show").css("display", "block");
                            $(".error_msg").text(data);
                            location.reload();
                        } else {
                            $("#tbl_price_list").html(data);
                            $('[data-toggle="tooltip"]').tooltip({
                                html: true
                            });

                        }
                    });

                }
            })
        } else {
            $(".error_show").css("display", "block");
            $(".error_msg").text("Error: All fields are important!");
            $("#txt_payment_type").select().focus();
        }
    });

    //payment_type activate
    $(document).on('click', '.btn_payment_type_activate', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to ACTIVATE this payment_type?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
                message: txt,
                payment_type: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                closable: true, // <-- Default value is false
                //draggable: true, // <-- Default value is false
                //btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
                btnOKLabel: 'Proceed', // <-- Default value is 'OK',
                btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog payment_type will be used,
                btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog payment_type will be used,
                autospin: true,
                callback: function(result) {
                    // result will be true if button was click, while it will be false if users close the dialog directly.
                    if (result) {

                        $.post("db_payment_type.php", {
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

                                $("#tbl_payment_type_list tbody #" + tr_id).html(data)
                                    .removeClass('danger');

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                                //reload pricing table
                                $.post("db_price.php", {
                                    action: 1
                                }, function(data) {
                                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                                        showError('Simple POS',
                                            "Error: Session Time-Out, You must login again to continue."
                                        );
                                        location.reload(true);
                                    } else if (data.indexOf("Error: ") > -1) {
                                        $(".error_show").css("display",
                                            "block");
                                        $(".error_msg").text(data);
                                        location.reload();
                                    } else {
                                        $("#tbl_price_list").html(data);
                                        $('[data-toggle="tooltip"]').tooltip({
                                            html: true
                                        });

                                    }
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

    //payment_type delete
    $(document).on('click', '.btn_payment_type_delete', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        var txt = "<div class='alert alert-warning role='alert'>";
        txt +=
            "  <strong><i class='fa fa-exclamation-triangle fa-2x'></i></strong> Are you sure you want to MARK as Inactive this payment_type payment_type?";
        txt += "</div>";

        if (id) {
            BootstrapDialog.confirm({
                title: "<b style='color:grey;'>Simple POS </b>",
                message: txt,
                payment_type: BootstrapDialog
                    .TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                closable: true, // <-- Default value is false
                //draggable: true, // <-- Default value is false
                //btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
                btnOKLabel: 'Proceed', // <-- Default value is 'OK',
                btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog payment_type will be used,
                btnCancelClass: 'btn-warning', // <-- If you didn't specify it, dialog payment_type will be used,
                autospin: true,
                callback: function(result) {
                    // result will be true if button was click, while it will be false if users close the dialog directly.
                    if (result) {

                        $.post("db_payment_type.php", {
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

                                $("#tbl_payment_type_list tbody #" + tr_id).html(data)
                                    .addClass('danger');

                                $('[data-toggle="tooltip"]').tooltip({
                                    html: true
                                });

                                //reload pricing table
                                $.post("db_price.php", {
                                    action: 1
                                }, function(data) {
                                    if (data.indexOf("<!DOCTYPE html>") > -1) {
                                        showError('Simple POS',
                                            "Error: Session Time-Out, You must login again to continue."
                                        );
                                        location.reload(true);
                                    } else if (data.indexOf("Error: ") > -1) {
                                        $(".error_show").css("display",
                                            "block");
                                        $(".error_msg").text(data);
                                        location.reload();
                                    } else {
                                        $("#tbl_price_list").html(data);
                                        $('[data-toggle="tooltip"]').tooltip({
                                            html: true
                                        });

                                    }
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
    </script>
</body>

</html>