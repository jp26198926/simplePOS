            
               <li class="dropdown profile">
                 <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
                   <img class="profile-img" src="./assets/images/profile.png">
                   <div class="title">Profile</div>
                 </a>
                 <div class="dropdown-menu">
                   <div class="profile-info">
                     <h4 class="username">
                        <?php echo $ufullname; ?>
                     </h4>
                   </div>
                   <ul class="action">
                     <li>
                       <a href="#" class='changepass' id='<?php echo $uid; ?>'>
                         <i class='fa fa-refresh fa-fw text-success'></i> Change Password
                       </a>
                     </li>                    
                     <li>
                       <a href="logout.php">
                         <i class='fa fa-sign-out fa-fw text-success'></i> Logout
                       </a>
                     </li>
                   </ul>
                 </div>
               </li>
            