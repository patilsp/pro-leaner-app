<div class="br-logo bg-br-primary"><a href="<?php echo $web_root; ?>app/taskListOTR.php"><span>[</span><i class="menu-item-icon ion-ios-undo-outline tx-16">Return to Transaction</i><span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-5 mg-t-10 op-3"></label>
  <div class="row">
    <?php
    //$records = GetRecords("resources", array("topics_id"=>$topic_id, "resource_type_id"=>4,"status_id"=>!=0));
    $query = "SELECT * FROM resources WHERE topics_id=? AND resource_type_id=4 AND id=? AND status_id!=0";
    $stmt = $db->prepare($query);
    $stmt->execute(array($topics_id, $template_id));
    while($record = $stmt->fetch(PDO::FETCH_ASSOC))
    {
    ?>
    <div class="col-md-12 mg-t-20 mg-md-t-0 templates_div">
      <div class="card bd-0">
        <img class="card-img-top img-fluid" src="<?php echo $web_root.$record['filepath']; ?>" alt="Image">
        <div class="card-body rounded-bottom">
          <button class="d-block mx-auto btn btn-md btn-warning templates" data-id="<?php echo $record['id']; ?>">Choose Template1</button>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Choose Layouts</label> -->
    <div class="col-md-12 mg-t-20 mg-md-t-0 layouts_div">
      <!-- <div class="card bd-0">
        <img class="card-img-top img-fluid" src="contents/layout1.png" alt="Image">
        <div class="card-body rounded-bottom">
          <button class="d-block mx-auto btn btn-md btn-warning lay1">Choose Layout1</button>
        </div>
      </div> -->
    </div>
  </div>
  

  <br>
</div><!-- br-sideleft -->