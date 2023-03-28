<!--start navigation-->
<div class="nav-container">
  <div class="mobile-topbar-header">
    <div>
      <img src="<?php echo $web_root ?>app/assets/images/logo-dark-text.png" class="logo-icon" alt="logo icon">
    </div>
    <!-- <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
    </div> -->
  </div>
  <nav class="topbar-nav">
    <ul class="metismenu" id="menu">
      <li>
        
        <?php if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']==4){
            echo '<a href="'.$web_root.'app/pages/Dashboard/candidateDashboard.php">';
        }else{
          echo '<a href="'.$web_root.'app/home.php">';
        }
        ?>
        
          <div class="parent-icon"><i class="bi bi-house-door"></i>
          </div>
          <div class="menu-title">Home</div>
        </a>
      </li>
      <?php
        $userAccess = explode(',', $_SESSION['assess_useraccess']);
        $query = "SELECT * FROM links WHERE level = 1 AND visible = 1 ORDER BY sequence";
        $stmt = $db->query($query);
        while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $url = 'javascript:;';
          if(in_array($rows['id'], $userAccess)) {
            if($rows['link'] != '#')
              $url = $web_root.''.$rows['link'];
                           
      ?>
      <li>
        <a href="<?php echo $url; ?>" class="has-arrow">
          <!-- <img src="<?php echo $web_root ?>app/assets/images/navbarImages/um.svg" class="menuIcon" alt="Icon"> -->
          <div class="parent-icon"><i class="<?php echo $rows['icon']; ?>"></i></div>
          <div class="menu-title"><?php echo $rows['name']; ?></div>
        </a>
        <ul>
          <?php 
            $query1 = "SELECT * FROM links WHERE level = 2 AND visible = 1 AND parent = '".$rows['id']."' ORDER BY sequence";
            $stmt1 = $db->query($query1);
            while($rows1 = $stmt1->fetch(PDO::FETCH_ASSOC))
            {
              if(in_array($rows1['id'], $userAccess)) {
                $urlL2 = $web_root.''.$rows1['link'];
          ?>
          <li> <a href="<?php echo $urlL2; ?>"><i class="bi bi-arrow-right-short"></i><?php echo $rows1['name']; ?></a>
          </li>
        <?php } } ?>
        </ul>
      </li>
    <?php } } ?>
    </ul>
  </nav>
</div>
<!--end navigation-->