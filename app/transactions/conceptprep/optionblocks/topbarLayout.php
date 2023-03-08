<!-- Topbar  -->
<style type="text/css">
  .nav-tabs .nav-link{
    font-size: 20px;
    padding: 5px 2rem;
    color: #ffffff;
  }
</style>
<nav id="topbar">
  <div id="dismiss">
    <i class="fas icon ion-close"></i>
  </div>
  <div class="sidebar-header">
    <h3>Choose Layouts</h3>
  </div>
  <ul class="list-unstyled components">
    <div class="row" style="margin: 0px;">
      <div class="col-md-12">
        <nav>
          <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-concept-tab" data-toggle="tab" href="#nav-concept" role="tab" aria-controls="nav-concept" aria-selected="true">Templates</a>

            <a class="nav-item nav-link " id="nav-pdf-tab" data-toggle="tab" href="#nav-pdf" role="tab" aria-controls="nav-pdf" aria-selected="false">Upload</a>
            <!-- <a class="nav-item nav-link " id="nav-ppt-tab" data-toggle="tab" href="#nav-ppt" role="tab" aria-controls="nav-ppt" aria-selected="false">PowerPoint</a> -->
            <a class="nav-item nav-link" id="nav-pratice-tab" data-toggle="tab" href="#nav-pratice" role="tab" aria-controls="nav-pratice" aria-selected="false">Activity</a> 
            <!-- <a class="nav-item nav-link" id="nav-questions-tab" data-toggle="tab" href="#nav-questions" role="tab" aria-controls="nav-questions" aria-selected="false">Questions</a> -->
            <!-- <a class="nav-item nav-link" id="nav-assignment-tab" data-toggle="tab" href="#nav-assignment" role="tab" aria-selected="false">Assignment</a>
            <a class="nav-item nav-link" id="nav-questions-tab"  href="../../../app/QuestionBank/QuestionBank.php" target="_new" aria-selected="false">Assessment</a> -->
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-concept" role="tabpanel" aria-labelledby="nav-concept-tab">
            <div class="row mt-2">
              <?php
                $class_id = $_GET['class'];
                $subject_id = $_GET['subject'];
                //2019 model
                // topics_id we have to consider has "subjectId" for the conceptprep        
                $query = "SELECT id, name, filename, class_id, topics_id, filepath, layoutfilepath_html FROM resources WHERE class_id IN ('0','".$class_id."') AND topics_id IN ('0','".$subject_id."') AND resource_type_id = 5 and id not in (27824, 5157)";
                $stmt = $db->query($query);
                while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $layout_id = $fetch['id'];
                  $layout_path_img = $fetch['filepath'];
                  $layout_path = str_replace('contents', 'cpcontents', $fetch['layoutfilepath_html']);
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
                //2019 model
                }
              ?>
            </div>
          </div>

          <div class="tab-pane fade show" id="nav-pdf" role="tabpanel" aria-labelledby="nav-pdf-tab">
            <div class="row mt-2">
              <?php
                $class_id = $_GET['class'];
                $subject_id = $_GET['subject'];
                //2019 model
                // topics_id we have to consider has "subjectId" for the conceptprep        
                $query = "SELECT id, name, filename, class_id, topics_id, filepath, layoutfilepath_html FROM resources WHERE class_id IN ('0','".$class_id."') AND topics_id IN ('0','".$subject_id."') AND id = 27824";
                $stmt = $db->query($query);
                while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $layout_id = $fetch['id'];
                  $layout_path_img = $fetch['filepath'];
                  $layout_path = str_replace('contents', 'cpcontents', $fetch['layoutfilepath_html']);
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
                //2019 model
                }
              ?>
            </div>

            <div class="row mt-2">
              <?php
                $class_id = $_GET['class'];
                $subject_id = $_GET['subject'];
                //2019 model
                // topics_id we have to consider has "subjectId" for the conceptprep        
                $query = "SELECT id, name, filename, class_id, topics_id, filepath, layoutfilepath_html FROM resources WHERE class_id IN ('0','".$class_id."') AND topics_id IN ('0','".$subject_id."') AND id = 5157";
                $stmt = $db->query($query);
                while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $layout_id = $fetch['id'];
                  $layout_path_img = $fetch['filepath'];
                  $layout_path = str_replace('contents', 'cpcontents', $fetch['layoutfilepath_html']);
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
                //2019 model
                }
              ?>
            </div>
          </div>

          <div class="tab-pane fade show" id="nav-ppt" role="tabpanel" aria-labelledby="nav-ppt-tab">
            <!-- <div class="row mt-2">
              <?php
                $class_id = $_GET['class'];
                $subject_id = $_GET['subject'];
                //2019 model
                // topics_id we have to consider has "subjectId" for the conceptprep        
                $query = "SELECT id, name, filename, class_id, topics_id, filepath, layoutfilepath_html FROM resources WHERE class_id IN ('0','".$class_id."') AND topics_id IN ('0','".$subject_id."') AND id = 5157";
                $stmt = $db->query($query);
                while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $layout_id = $fetch['id'];
                  $layout_path_img = $fetch['filepath'];
                  $layout_path = str_replace('contents', 'cpcontents', $fetch['layoutfilepath_html']);
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
                //2019 model
                }
              ?>
            </div> -->
          </div>
          <div class="tab-pane fade" id="nav-pratice" role="tabpanel" aria-labelledby="nav-pratice-tab">
            <div class="row mt-2">
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
                //2019 model
                }
              ?>
            </div>
          </div>



          <div class="tab-pane fade" id="nav-questions" role="tabpanel" aria-labelledby="nav-questions-tab">
            <div class="row mt-2">
                <?php
                  $class_id = $_GET['class'];
                  $subject_id = $_GET['subject'];
                  
                
                  $query = "SELECT id, name, filename, class_id, topics_id, filepath, layoutfilepath_html, qzone_slide_path FROM resources WHERE resource_type_id = 8";
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
                
                  }
                ?>
            </div>
          </div>

          
          
          <div class="tab-pane fade" id="nav-assignment" role="tabpanel" aria-labelledby="nav-assignment-tab">
            <div class="row mt-2">
              <?php
                $class_id = $_GET['class'];
                $subject_id = $_GET['subject'];
                
                //2019 model
                $query = "SELECT id, name, filename, class_id, topics_id, filepath, layoutfilepath_html, qzone_slide_path FROM resources WHERE resource_type_id = 9";
             
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
                //2019 model
                }
              ?>
            </div>
          </div>


        </div>
      </div>
    </div>
  </ul>
</nav>