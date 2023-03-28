<!-- start top header-->
<header class="top-header">        
  <nav class="navbar navbar-expand">
    <div class="topbar-logo-header d-none d-xl-flex">
      <div>
        <img src="<?php echo $web_root ?>app/assets/images/amnaik.png" class="logo-icon"  alt="logo icon" style="width: 50px;" >
      </div>
    </div>
    <div class="mobile-toggle-icon d-xl-none">
        <i class="bi bi-list"></i>
      </div>
      <div class="d-xl-flex ms-auto top-navbar-right ms-3">
        <ul class="navbar-nav align-items-center">
          
        <li class="nav-item dropdown dropdown-large">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="user-setting d-flex align-items-center gap-1">
            <?php
            $profile_image = "app/assets/images/avatars/avatar-1.png";
              if($_SESSION['profile_image']!=''){
                $img = str_replace("../",'',$_SESSION['profile_image']);
                $profile_image = "app/".$img;
              }
            ?>
              <img src="<?php echo $web_root.$profile_image ?>" alt="" class="user-img">
              <div class="user-name d-none d-sm-block"><?php echo $_SESSION['assess_name']; ?></div>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
               <a class="dropdown-item" href="#">
                 <div class="d-flex align-items-center">
                    <img src="<?php echo $web_root.$profile_image ?>" alt="" class="rounded-circle" width="60" height="60">
                    <div class="ms-3">
                      <h6 class="mb-0 dropdown-user-name"><?php echo $_SESSION['assess_name']; ?></h6>
                      <small class="mb-0 dropdown-user-designation text-secondary"><?php echo $_SESSION['assess_role']; ?></small>
                    </div>
                 </div>
               </a>
             </li>
             <li><hr class="dropdown-divider"></li>
             <li>
              <?php
                if($_SESSION['user_role_id'] == 4) {
                  if($_SESSION['assess_userid'] > 301){
              ?>
                <!-- <a class="dropdown-item" href="#." data-bs-toggle="modal" data-bs-target="#candidateprofile">
                   <div class="d-flex align-items-center">
                     <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                     <div class="setting-text ms-3"><span>Profile</span></div>
                   </div>
                 </a> -->
             <?php } } else { ?>
              <a class="dropdown-item" href="<?php echo $web_root ?>app/pages/settings/profile.php">
                 <div class="d-flex align-items-center">
                   <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                   <div class="setting-text ms-3"><span>Profile</span></div>
                 </div>
               </a>
            <?php } ?>
              </li>
              <li>
              <?php
                if($_SESSION['user_role_id'] != 4) {
                 
              ?>
              <li><hr class="dropdown-divider"></li>
              <?php } ?>
              <li>
                <a class="dropdown-item" href="<?php echo $web_root ?>app/authentication/logout.php">
                   <div class="d-flex align-items-center">
                     <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                     <div class="setting-text ms-3"><span>Logout</span></div>
                   </div>
                 </a>
              </li>
          </ul>
        </li>
        </ul>
        </div>
  </nav>
</header>
 <!--end top header -->

<!-- Session Expired Modal -->
<div class="modal fade" id="sessionExp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Info</h5>
      </div>
      <div class="modal-body">
        <h5 class="font-weight-bold">Your session has expired due to inactivity. Click on "OK" and Login Again.</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closeSessPopup">Ok</button>
      </div>
    </div>
  </div>
</div>