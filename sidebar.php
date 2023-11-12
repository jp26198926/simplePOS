<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a class="sidebar-brand" href="#"><span class="highlight">Simple</span> POS</a>
    <div class="text-center">Station: <span class="station_id">0</div>
    <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
    </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li class="mnu" id="menu_main">
        <a href="./main.php">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Dashboard</div>
        </a>
      </li>

      <?php
      if ($uaccess == 1 || $uaccess == 2 || $uaccess == 3 || $uaccess == 4) {
        echo "<li class='@@menu.sale mnu' id='menu_sale'>
              <a href='./sale.php'>
                <div class='icon'>
                  <i class='fa fa-cart-plus' aria-hidden='true'></i>
                </div>
                <div class='title'>Sale</div>
              </a>
            </li>";
      }
      ?>

      <?php
      if ($uaccess == 1 || $uaccess == 2 || $uaccess == 3 || $uaccess == 4) {
        echo "<li class='@@menu.product mnu' id='menu_product'>
              <a href='./product.php'>
                <div class='icon'>
                  <i class='fa fa-cubes' aria-hidden='true'></i>
                </div>
                <div class='title'>Data</div>
              </a>
            </li>";
      }
      ?>

      <?php
      if ($uaccess == 1 || $uaccess == 2 || $uaccess == 3 || $uaccess == 4 || $uaccess == 5) {
        echo "<li class='@@menu.report mnu' id='menu_report'>
              <a href='./report.php'>
                <div class='icon'>
                  <i class='fa fa-bar-chart' aria-hidden='true'></i>
                </div>
                <div class='title'>Report</div>
              </a>
            </li>";
      }
      ?>

      <?php
      if ($uaccess == 1) {
        echo "<li class='dropdown mnu' id='menu_admin'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                    <div class='icon'>
                      <i class='fa fa-gear' aria-hidden='true'></i>
                    </div>
                    <div class='title'>Administration</div>
                  </a>
                  <div class='dropdown-menu'>
                    <ul>
                      <li class='section'><i class='fa fa-user' aria-hidden='true'></i>Account</li>
                      <li><a href='./user.php'>User </a></li>

                      <!--
                      <li><a href='./dept.php'>Department </a></li>
                      <li><a href='#'>Access Level </a></li>
                      -->

                      <li class='line'></li>

                      <li class='section'><i class='fa fa-check' aria-hidden='true'></i>Application</li>
                      <li><a href='./settings.php'>Settings </a></li>

                      <li class='line'></li>

                      <li class='section'><i class='fa fa-file-text-o' aria-hidden='true'></i> Trail</li>
                      <li><a href='trail_login.php'>Login History</a></li>
                      <li><a href='trail_transaction.php'>Transaction</a></li>

                    </ul>
                  </div>
              </li>";
      }
      ?>
    </ul>
  </div>
  <!--
  <div class="sidebar-footer">
    <ul class="menu">
      <li>
        <a href="/" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-cogs" aria-hidden="true"></i>
        </a>
      </li>
      <li><a href="#"><span class="flag-icon flag-icon-th flag-icon-squared"></span></a></li>
    </ul>
  </div>
  -->

</aside>
