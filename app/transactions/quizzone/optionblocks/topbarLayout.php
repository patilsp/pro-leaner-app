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
        $subject_id = $_GET['subject'];
        
        //2019 model
        $query = "SELECT id, name, filename, class_id, topics_id, filepath, layoutfilepath_html, qzone_slide_path FROM resources WHERE resource_type_id = 7";
        $stmt = $db->query($query);
        while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
          $layout_id = $fetch['id'];
          $layout_path_img = $fetch['filepath'];
          $layout_path = $fetch['layoutfilepath_html'];
          $layout_name = $fetch['name'];
          $filename = $fetch['filename'];
          $qzone_slide_path = $fetch['qzone_slide_path'];
        ?>
                <div class="col-md-4">
                  <div class="item">
                    <img src="<?php echo $web_root.$layout_path_img; ?>" class="center-block img-responsive mx-auto d-block" />
                    <div class="item-overlay top">
                      <button type="button" data-resourcesid="<?php echo $layout_id; ?>" data-layoutpath="<?php echo $web_root.$layout_path; ?>" data-qzone_slide_path="<?php echo $web_root.$qzone_slide_path; ?>" class="btn btn-md btn-info layoutChoosed"><?php echo $layout_name.' - '. $filename; ?></button>
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
    </div>
  </ul>
</nav>