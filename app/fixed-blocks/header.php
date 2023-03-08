<?php
    $logged_name = $_SESSION['cms_name'];
    $logged_role = $_SESSION['cms_usertype'];
    $logged_email = $_SESSION['cms_email'];
    $token = $_SESSION['token'];
    $links = array();
    $sql1 = "SELECT * FROM role_permission WHERE roles_id = ?";
    $stmt1 = $db->prepare($sql1);
    $stmt1->execute(array($_SESSION['user_role_id']));
    $rowcount1 = $stmt1->rowcount();
    if($rowcount1) {
      while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $links[] = $row1['permission_id'];
      }
    }
?>

<link rel="stylesheet" href="<?php echo $web_root ?>/css/navbarstyle.css">
<link rel="stylesheet" href="<?php echo $web_root ?>/css/newstyle.css">


<div class="br-header bg-gardian-1">
  <div class="br-header-left">
  <a href="<?php echo $web_root; ?>app/home.php" class="">
    <img src="<?php echo $web_root ?>img/logo/logo.png" class="nav_logo">
  </a>
  

    <!-- <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div> -->
  </div><!-- br-header-left -->
  <div class="br-header-right">
    
    <nav class="nav">
      <div class="dropdown">
        <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
          <span class="logged-name hidden-md-down"><?php echo $logged_name; ?></span>
          <img src="<?php echo $web_root ?>img/avatar.png" class="wd-32" alt="">
          <span class="square-10 bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-250">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Logo" src="<?php echo $web_root ?>img/avatar.png">
            </div>
            <!--end::Avatar-->

            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">
                  <?php echo $logged_name; ?>           
                    
                </div>

                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                    <?php echo $logged_email; ?>            
                  </a>
            </div>
            <!--end::Username-->
        </div>
          <!-- <div class="tx-center">
            <a href="#"><img src="<?php echo $web_root ?>img/avatar.png" class="wd-80" alt=""></a>
            <h6 class="logged-fullname"><?php echo $logged_name; ?></h6>
            <p><?php echo $logged_email; ?></p>
          </div> -->
          <hr>
          <ul class="list-unstyled user-profile-nav">
            <!-- <li><a href="profile.php?xy=<?php echo $token; ?>"><i class="icon ion-ios-person"></i> Edit Profile</a></li> -->
            <li><a href="<?php echo $web_root; ?>app/login_blocks/logout.php"><i class="icon ion-power"></i> Sign Out</a></li>
          </ul>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </nav>
  </div><!-- br-header-right -->
</div><!-- br-header -->


 <!-- Navigation -->
 <nav class="navbar navbar-expand-lg bg-menu-theme">
  
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">
      <img src="https://placeholder.pics/svg/150x50/888888/EEE/Logo" alt="..." height="36">
    </a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <?php
        $query = "SELECT * FROM permission WHERE level = 1 AND visible = 1 ORDER BY sequence";
        $stmt = $db->query($query);
        $rowcount = $stmt->rowcount();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $query1 = "SELECT * FROM permission WHERE level = 2 AND parent = '".$row["id"]."' AND visible = 1 ORDER BY sequence";
            $stmt1 = $db->query($query1);
            $rowcount1 = $stmt1->rowcount();
            ?>
        
            
           <?php
            if($rowcount1 > 0)
            {
              if(in_array($row['id'], $links)) 
              {
              ?>
            <li class="nav-item dropdown">
                <a class="nav-link nav_link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $row["name"]?>
                </a>
            <ul class="dropdown-menu dropdown-menu-end menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown" aria-labelledby="navbarDropdown">
            <?php
            while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
              if(in_array($row1['id'], $links)) 
              {
            ?>
            <li><a class="dropdown-item menu-link" href="<?php echo $web_root.$row1["link"]; ?>"><?php echo $row1["name"]?></a></li>        
                
            <?php
            }
            }
            ?>
            </ul>
            </li>
            <?php
            }
            ?>
            <!-- <li class="nav-item">
                  <a class="nav-link nav_link" href="<?php echo $web_root ?>app/Assignment/assignment.php">Assignment</a>
              </li> -->
            <?php
            } else {
              if(in_array($row['id'], $links)) 
              {
            ?>
            <li class="nav-item">
                <a class="nav-link nav_link" href="<?php echo $web_root.$row["link"]; ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $row["name"]?>
                </a>
            </li>
            <?php
            }
            }
            ?>
             
        <?php
        }
        ?>
        
        
        <!-- <li class="nav-item">
            <a class="nav-link nav_link" href="#">Task</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav_link" href="#">Resources</a>
        </li>

        <li class="nav-item">
            <a class="nav-link nav_link" href="#">Dictonary</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav_link" href="#">Slide Types</a>
        </li>

        <li class="nav-item">
            <a class="nav-link nav_link" href="#">Quiz Zone</a>
        </li> -->

        
      </ul>
    </div>
  </div>
</nav>

