<?php
    $logged_name = $_SESSION['cms_name'];
    $logged_role = $_SESSION['cms_usertype'];
    $logged_email = $_SESSION['cms_email'];
    $token = $_SESSION['token'];
?>
<div class="br-header bg-br-primary">
  <div class="br-header-left">
    
  </div><!-- br-header-left -->
  <div class="br-header-right">
    <nav class="nav">
      <div class="dropdown">
        <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
          <span class="logged-name hidden-md-down"><?php echo $logged_name; ?></span>
          <img src="<?php echo $web_root; ?>img/avatar/dummy.jpg" class="wd-32 rounded-circle" alt="">
          <span class="square-10 bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-250">
          <div class="tx-center">
            <a href="#"><img src="<?php echo $web_root; ?>img/avatar/dummy.jpg" class="wd-80 rounded-circle" alt=""></a>
            <h6 class="logged-fullname"><?php echo $logged_name; ?></h6>
            <p><?php echo $logged_email; ?></p>
          </div>
          <hr>
          <ul class="list-unstyled user-profile-nav">
            <li><a href="profile.php?xy=<?php echo $token; ?>"><i class="icon ion-ios-person"></i> Edit Profile</a></li>
            <li><a href="<?php echo $web_root; ?>app/login_blocks/logout.php"><i class="icon ion-power"></i> Sign Out</a></li>
          </ul>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </nav>
  </div><!-- br-header-right -->
</div><!-- br-header -->