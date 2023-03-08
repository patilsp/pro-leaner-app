<?php

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

<div class="br-logo"><a href="#"></a></div>
<div class="br-sideleft overflow-y-auto mt-4">
  <label class="sidebar-label pd-x-10 mg-t-10 op-3"></label>
  <ul class="br-sideleft-menu">
    <li class="br-menu-item">
      <a href="<?php echo $web_root; ?>app/home.php" class="br-menu-link active">
        <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
        <span class="menu-item-label">Dashboard</span>
      </a>
    </li>
    <?php
      $query = "SELECT * FROM permission WHERE level = 1 AND visible = 1 ORDER BY sequence";
      $stmt = $db->query($query);
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $query1 = "SELECT * FROM permission WHERE level = 2 AND visible = 1 AND parent = ? ORDER BY sequence";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute(array($row['id']));
        $rowcount1 = $stmt1->rowcount();
        if(in_array($row['id'], $links)) 
        {
    ?>
          <li class="br-menu-item">
            <a href="<?php echo $web_root.$row['link']; ?>" class="br-menu-link <?php if($rowcount1 > 0){ ?>with-sub<?php } ?>">
              <i class="menu-item-icon icon <?php echo $row['icon']; ?> tx-20"></i>
              <span class="menu-item-label op-lg-0-force d-lg-none"><?php echo $row['name']; ?></span>
            </a><!-- br-menu-link -->
            <?php 
              if($rowcount1 > 0)
              {
            ?>
              <ul class="br-menu-sub" style="display: none;">
                <?php
                  while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    if(in_array($row1['id'], $links)) 
                    {
                ?>
                    <li class="sub-item"><a href="<?php echo $web_root.$row1['link']; ?>" class="sub-link"><?php echo $row1['name']; ?></a></li>
                <?php
                    }
                  }
                ?>
              </ul>
            <?php
              }
            ?>
          </li>
    <?php
        }
      }
    ?>
  </ul>

  <br>
</div>