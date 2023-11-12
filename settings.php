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

    $(document).ready(function() {

      $(document).on("click","#btn_settings_save", function(){
        let station_id = $("#station_id").val();

        //call function from assets/js/function.js
        saveToLocalStorage('station_id', station_id);
        $(".station_id").text(station_id);

        $("#modal_alert").modal("show");

      });

      // $(document).on('keypress', '.txtuserupdate', function(e) {
      //   if (e.which == 13) {
      //     $("#btn_user_update").trigger('click');
      //   }
      // });

      // $(document).on("click", "#btn_user_update", function(e) {
      //   e.preventDefault();

      //   var id = $(".user_hidden_id").val();
      //   var username = $("#txt_user_username_update").val();
      //   var access = $("#txt_user_access_update").val();

      //   var lname = $("#txt_user_lname_update").val();
      //   var fname = $("#txt_user_fname_update").val();
      //   var mname = $("#txt_user_mname_update").val();

      //   var email = $("#txt_user_email_update").val();
      //   var dept = $("#txt_user_dept_update").val();

      //   if (username && access && lname && fname && dept) {

      //     $(".buttons_show, .error_show, .modal-body").css("display", "none");
      //     $(".progress_show").css("display", "block");

      //     $.post("db_user.php", {
      //       action: 3,
      //       id: id,
      //       username: username,
      //       access: access,
      //       lname: lname,
      //       fname: fname,
      //       mname: mname,
      //       email: email,
      //       dept: dept
      //     }, function(data) {

      //       $(".buttons_show, .modal-body").css("display", "block");
      //       $(".progress_show, .error_show").css("display", "none");

      //       if (data.indexOf("<!DOCTYPE html>") > -1) {
      //         //alert("Error: Session Time-Out, You must login again to continue.");
      //         showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
      //         location.reload(true);
      //       } else if (data.indexOf("Error: ") > -1) {
      //         $(".error_show").css("display", "block");
      //         $(".error_msg").text(data);
      //         $("#txt_user_username_update").select().focus();
      //       } else {
      //         $("#tbl_user_list tbody").html(data);

      //         $("#win_user_modify").modal('hide');

      //         $('[data-toggle="tooltip"]').tooltip({
      //           html: true
      //         });
      //       }

      //     });

      //   } else {
      //     $(".error_show").css("display", "block");
      //     $(".error_msg").text("Error: Required fields are important!");
      //     $("#txt_user_username_update").select().focus();
      //   }
      // });

      // $(document).on('click', '.btn_user_modify', function(e) {
      //   e.preventDefault();
      //   var id = $(this).attr('id');
      //   if (id) {
      //     $("#loading").modal();

      //     $.post("db_user.php", {
      //       action: 4,
      //       id: id
      //     }, function(data) {
      //       $("#loading").modal('hide');

      //       if (data.indexOf("<!DOCTYPE html>") > -1) {
      //         //alert("Error: Session Time-Out, You must login again to continue.");
      //         showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
      //         location.reload(true);
      //       } else if (data.indexOf("Error: ") > -1) {
      //         //alert(data);
      //         showError('Simple POS', data);
      //       } else {
      //         var username = data.split(":|:")[0];
      //         var fname = data.split(":|:")[1];
      //         var lname = data.split(":|:")[2];
      //         var mname = data.split(":|:")[3];
      //         var dept_id = data.split(":|:")[4];
      //         var email = data.split(":|:")[5];
      //         var access = data.split(":|:")[6];

      //         $(".user_hidden_id").val(id);
      //         $("#txt_user_username_update").val(username);
      //         $("#txt_user_access_update").val(access);
      //         $("#txt_user_lname_update").val(lname);
      //         $("#txt_user_fname_update").val(fname);
      //         $("#txt_user_mname_update").val(mname);
      //         $("#txt_user_email_update").val(email);
      //         $("#txt_user_dept_update").val(dept_id);

      //         $("#win_user_modify").modal();
      //       }
      //     })
      //     //$("#win_user_modify").modal();
      //   } else {
      //     showError('Simple POS', "Error: Critical Error Encountered!");
      //   }
      // });

      // $('#win_user_modify').on('shown.bs.modal', function() {
      //   $('#txt_user_username_update').focus().select();
      // })

      // $(document).on("click", ".btn_user_deactivate", function(e) {
      //   e.preventDefault();
      //   var id = $(this).attr('id');
      //   if (id) {
      //     if (confirm("Are you sure you want to DE-ACTIVATE this user?")) {
      //       $("#loading").modal();

      //       $.post("db_user.php", {
      //         action: 6,
      //         status: 2,
      //         id: id
      //       }, function(data) {
      //         $("#loading").modal('hide');

      //         if (data.indexOf("<!DOCTYPE html>") > -1) {
      //           //alert("Error: Session Time-Out, You must login again to continue.");
      //           showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
      //           location.reload(true);
      //         } else if (data.indexOf("Error: ") > -1) {
      //           //alert(data);
      //           showError('Simple POS', data);
      //         } else {
      //           $("#tbl_user_list tbody").html(data);

      //           $('[data-toggle="tooltip"]').tooltip({
      //             html: true
      //           });
      //         }
      //       });
      //     }
      //   } else {
      //     //alert("Error: Critical Error Encountered!");
      //     showError('Simple POS', "Error: Critical Error Encountered!");
      //   }
      // });

      // $(document).on("click", ".btn_user_activate", function(e) {
      //   e.preventDefault();
      //   var id = $(this).attr('id');
      //   if (id) {
      //     if (confirm("Are you sure you want to ACTIVATE this user?")) {
      //       $("#loading").modal();

      //       $.post("db_user.php", {
      //         action: 6,
      //         status: 1,
      //         id: id
      //       }, function(data) {
      //         $("#loading").modal('hide');

      //         if (data.indexOf("<!DOCTYPE html>") > -1) {
      //           showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
      //           location.reload(true);
      //         } else if (data.indexOf("Error: ") > -1) {
      //           showError('Simple POS', data);
      //         } else {
      //           $("#tbl_user_list tbody").html(data);

      //           $('[data-toggle="tooltip"]').tooltip({
      //             html: true
      //           });
      //         }
      //       });
      //     }
      //   } else {
      //     //alert("Error: Critical Error Encountered!");
      //     showError('Simple POS', "Error: Critical Error Encountered!");
      //   }
      // });

      // $(document).on('keypress', '.txtuser', function(e) {
      //   if (e.which == 13) {
      //     $("#btn_user_save").trigger('click');
      //   }
      // });

      // $(document).on("click", "#btn_user_save", function(e) {
      //   e.preventDefault();

      //   var username = $("#txt_user_username").val();
      //   var pass = $("#txt_user_password").val();
      //   var repass = $("#txt_user_repassword").val();
      //   var access = $("#txt_user_access").val();

      //   var lname = $("#txt_user_lname").val();
      //   var fname = $("#txt_user_fname").val();
      //   var mname = $("#txt_user_mname").val();

      //   var email = $("#txt_user_email").val();
      //   var dept = $("#txt_user_dept").val();

      //   if (username && pass && repass && access && lname && fname && dept) {
      //     if (pass === repass) {
      //       $(".buttons_show, .error_show, .modal-body").css("display", "none");
      //       $(".progress_show").css("display", "block");

      //       $.post("db_user.php", {
      //         action: 2,
      //         username: username,
      //         pass: pass,
      //         repass: repass,
      //         access: access,
      //         lname: lname,
      //         fname: fname,
      //         mname: mname,
      //         email: email,
      //         dept: dept
      //       }, function(data) {

      //         $(".buttons_show, .modal-body").css("display", "block");
      //         $(".progress_show, .error_show").css("display", "none");

      //         if (data.indexOf("<!DOCTYPE html>") > -1) {
      //           showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
      //           location.reload(true);
      //         } else if (data.indexOf("Error: ") > -1) {
      //           $(".error_show").css("display", "block");
      //           $(".error_msg").text(data);
      //           $("#txt_user_username").select().focus();
      //         } else {
      //           $("#tbl_user_list tbody").html(data);

      //           $("#win_user_new").modal('hide');

      //           $('[data-toggle="tooltip"]').tooltip({
      //             html: true
      //           });
      //         }

      //       });

      //     } else {
      //       $(".error_show").css("display", "block");
      //       $(".error_msg").text("Error: Password does not match!");
      //       $("#txt_user_username").select().focus();
      //     }
      //   } else {
      //     $(".error_show").css("display", "block");
      //     $(".error_msg").text("Error: Required fields are important!");
      //     $("#txt_user_username").select().focus();
      //   }
      // });

      // $(document).on("click", "#btn_add_user", function(e) {
      //   e.preventDefault();
      //   $("#win_user_new").modal();
      //   $(".error_show, .progress_show").css("display", "none");
      //   $(".buttons_show").css("display", "block");
      // });

      // $('#win_user_new').on('shown.bs.modal', function() {
      //   $('#txt_user_username').focus();
      // })

      // $(document).on("keypress", "#txt_user_search", function(e) {
      //   if (e.which == 13) {
      //     $("#btn_user_search").trigger("click");
      //   }
      // })

      // $(document).on("click", "#btn_user_search", function(e) {
      //   e.preventDefault();

      //   var txt_search = $("#txt_user_search").val();

      //   $("#loading").modal();

      //   $.post("db_user.php", {
      //     action: 1,
      //     mysearch: txt_search
      //   }, function(data) {

      //     $("#loading").modal('hide');

      //     if (data.indexOf("<!DOCTYPE html>") > -1) {
      //       showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
      //       location.reload(true);
      //     } else if (data.indexOf("Error: ") > -1) {
      //       //alert(data);
      //       showError('Simple POS', data);
      //       $("#txt_user_search").focus().select();
      //     } else {
      //       $("#tbl_user_list tbody").html(data);

      //       $("#txt_user_search").focus().select();

      //       $('[data-toggle="tooltip"]').tooltip({
      //         html: true
      //       });
      //     }
      //   });

      // })
    });
  </script>

</body>

</html>
