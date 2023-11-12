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
              <li class="navbar-title"><span class='fa fa-key fa-2x'></span><span class="highlight" style='margin-left: 0.5em;'> LOGIN HISTORY</span></li>
              <li class="navbar-search hidden-sm">
                <input id="txt_trail_login_search" type="text" placeholder="Search..">
                <button id="btn_trail_login_search" class="btn-search"><i class="fa fa-search"></i></button>
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
              <table id="tbl_trail_login_list" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%" style="font: 90% Trebuchet MS; ">
                <thead>
                  <tr>
                    <th>DateTime</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Local IP</th>
                    <th>Public IP</th>
                    <th>Computer Name</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  include('connect.php');

                  include('query_trail_login.php');
                  $sql .= " WHERE DATE(l.dt)=CURDATE()";
                  $sql .= " ORDER BY l.id DESC;";

                  include('pop_trail_login.php');

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

  <?php
      include("layout_script.php");
      include('menu-active.php');
  ?>
  <script>
    /*
    $('[data-toggle="tooltip"]').tooltip({html:true});

    function getQoutes() {
          $.get("db_qoutes.php",function(data){
              if (data.indexOf("Error: ")>-1) {

              }else{
                  data1 = data.split(":~:|:~:")[0];
                  data2 = data.split(":~:|:~:")[1];
                  data3 = data.split(":~:|:~:")[2];

                  qoutes1 = data1.split(":~|~:")[0];
                  author1 = data1.split(":~|~:")[1];
                  qoutes2 = data2.split(":~|~:")[0];
                  author2 = data2.split(":~|~:")[1];
                  qoutes3 = data3.split(":~|~:")[0];
                  author3 = data3.split(":~|~:")[1];

                  $(".qoutes_msg1").text(qoutes1);
                  $(".qoutes_author1").text(author1);
                  $(".qoutes_msg2").text(qoutes2);
                  $(".qoutes_author2").text(author2);
                  $(".qoutes_msg3").text(qoutes3);
                  $(".qoutes_author3").text(author3);
              }
          });
    }
    */

    $(document).ready(function() {
      /*
      $('#quote-carousel').carousel({
          pause: true,
          interval: 4000,
      });

      getQoutes();

      setInterval(function() {
             getQoutes();
      }, 10000); //1 seconds

      */



      $(document).on("keypress", "#txt_trail_login_search", function(e) {
        if (e.which == 13) {
          $("#btn_trail_login_search").trigger("click");
        }
      })

      $(document).on("click", "#btn_trail_login_search", function(e) {
        e.preventDefault();

        var txt_search = $("#txt_trail_login_search").val();

        $("#loading").modal();

        $.post("db_trail.php", {
          action: 1,
          mysearch: txt_search
        }, function(data) {

          $("#loading").modal('hide');

          if (data.indexOf("<!DOCTYPE html>") > -1) {
            showError('Simple POS', "Error: Session Time-Out, You must login again to continue.");
            location.reload(true);
          } else if (data.indexOf("Error: ") > -1) {
            //alert(data);
            showError('Simple POS', data);
            $("#txt_trail_login_search").focus().select();
          } else {
            $("#tbl_trail_login_list tbody").html(data);

            $("#txt_trail_login_search").focus().select();

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
