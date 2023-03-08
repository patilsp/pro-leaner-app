<!-- Topbar  -->
<nav id="topbar">
  <div id="dismiss">
    <i class="fas icon ion-close"></i>
  </div>
  <div class="sidebar-header">
    <h3>Choose Layouts</h3>
  </div>
  <ul class="list-unstyled components">
    <div class="row" style="margin: 0px;">
      <?php
        $class_id = $_GET['class'];
        $topic_id = $_GET['topic'];
        //2018 model
        /*$templates = GetRecords("resources", array("class_id"=>$class_id, "topics_id"=>$topic_id));
        if(count($templates) > 0) {
          foreach ($templates as $template) {
            $template_path = $template['filepath'];
            $template_id = $template['id'];

            $layouts = GetRecords("resources", array("template_id"=>$template_id));
            if(count($layouts) > 0) {
              foreach ($layouts as $layout) {
                $layout_id = $layout['id'];
                $layout_path_img = $layout['filepath'];
                $layout_path = $layout['layoutfilepath_html'];*/

        //2019 model
        $query = "SELECT id, name, filename, class_id, topics_id, filepath, layoutfilepath_html FROM resources WHERE class_id IN ('0','".$class_id."') AND topics_id IN ('0','".$topic_id."') AND resource_type_id = 5";
        $stmt = $db->query($query);
        while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
          $layout_id = $fetch['id'];
          $layout_path_img = $fetch['filepath'];
          $layout_path = $fetch['layoutfilepath_html'];
          $layout_name = $fetch['name'];
          $filename = $fetch['filename']
        ?>
                <div class="col-md-4">
                  <div class="item">
                    <img src="<?php echo $web_root.$layout_path_img; ?>" class="center-block img-responsive mx-auto d-block" />
                    <div class="item-overlay top">
                      <button type="button" data-resourcesid="<?php echo $layout_id; ?>" data-layoutpath="<?php echo $web_root.$layout_path; ?>" data-layoutname="<?php echo $layout_name; ?>" class="btn btn-md btn-info layoutChoosed"><?php echo $layout_name.' - '. $filename; ?></button>
                    </div>
                  </div>
                </div>
      <?php
        //2018 model
              /*}//end of layout foreach
            }//end of layout if loop
          }//end of template foreach
        }//end if loop*/

        //2019 model
        }
      ?>
        <div class="col-md-4">
          <div class="item">
            <img src="<?php echo $web_root."app/contents/layouts/uploadLayout.PNG"; ?>" class="center-block img-responsive mx-auto d-block" />
            <div class="item-overlay top">
              <button type="button" data-resourcesid="1" data-layoutpath="<?php echo $web_root."app/contents/layouts/uploadLayout.html"; ?>" data-layoutname="<?php echo $layout_name; ?>" class="btn btn-md btn-info layoutChoosed">Choose</button>
            </div>
          </div>
        </div>
      <!-- <div class="col-md-4">
        <div class="item">
          <img src="../../layouts_test/l1.jpg" class="center-block img-responsive" />
          <div class="item-overlay top">
            <button type="button" class="btn btn-md btn-info layoutChoosed">Choose</button>
          </div>
        </div>
      </div> -->
    </div>
  </ul>
</nav>