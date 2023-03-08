<div class="br-logo bg-br-primary bg-gardian-1"><a href="<?php echo $web_root; ?>app/taskListOTR.php"><span>[</span><i class="menu-item-icon ion-ios-undo-outline tx-16">Return to Home</i><span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-5 mg-t-10 op-3"></label>
  <div class="row">
    <?php
    $si = 1;
    $records = GetRecords("$master_db.mdl_lesson_pages", array("id"=>$slide_id));
    if (count($records) != 0) {
      //get topic name
      $lessons_name = GetRecords("$master_db.mdl_course", array("id"=>$topic_id));
      foreach ($lessons_name as $lesson) {
        $topic_name = $lesson['fullname'];

          $words = explode(" ", $topic_name);
        $topic_code = "";

        foreach ($words as $w) {
          $topic_code .= $w[0];
        }
      }

      foreach($records as $record)
      {
        $slide_name = "G".$class_id."_".$topic_code."_S".$si++;
        $slidepath = DecryptContent($record['contents']);
        $time = time();
    ?>
      <div class="col-md-12 mg-t-20 mg-md-t-0 templates_div">
        <div class="card bd-0">
          <object width="100%" height="100%" data="<?php echo $web_root."app/".$slidepath.'?time='.$time ?>"></object>
          <div class="card-body rounded-bottom">
            <button class="d-block mx-auto btn btn-md btn-warning templates" data-id="<?php echo $web_root."app/".$slidepath; ?>"><?php echo $slide_name; ?></button>
          </div>
        </div>
      </div>
    <?php 
      }
    } else {
    ?>
      <div class="col-md-12 mg-t-20 mg-md-t-0 templates_div">
        <div class="card bd-0">
          <img class="card-img-top img-fluid" src="../id/images/notImage.png" alt="Image" class="img-responsive">
          <div class="card-body rounded-bottom">
            <button class="d-block mx-auto btn btn-md btn-warning noSlides" style="word-wrap: break-word;white-space: normal !important;">No Slides Availlable Contact Tech Team</button>
          </div>
        </div>
      </div>
    <?php
    } 
    ?>
  </div>
  
  <br>
</div><!-- br-sideleft -->