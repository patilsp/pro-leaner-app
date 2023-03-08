<div class="br-logo bg-br-primary bg-gardian-1 "><a href="<?php echo $web_root; ?>app/taskList.php"><span>[</span><i class="menu-item-icon ion-ios-undo-outline tx-16">Return to Transaction</i><span>]</span></a></div>
<div class="br-sideleft overflow-y-auto ">
  <label class="sidebar-label pd-x-5 mg-t-10 op-3"></label>
  <div class="row">
    <?php
    $records = GetRecords("static_lessons_table", array("classid"=>$class_id, "topicid"=>$topic_id));
    foreach($records as $record)
    {
    ?>
    <div class="col-md-12 mg-t-20 mg-md-t-0 templates_div">
      <div class="card bd-0">
        <object width="100%" height="100%" data="<?php echo $web_root."app/".$record['path']; ?>"></object>
        <div class="card-body rounded-bottom">
          <button class="d-block mx-auto btn btn-md btn-warning templates" data-id="<?php echo $record['path']; ?>">Choose Slide</button>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  

  <br>
</div><!-- br-sideleft -->