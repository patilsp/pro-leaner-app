      
      
      
      <div class="card mb-3">
          <div class="card-body">
            <div class="row g-2 mb-3">
              <div class="col-sm-3">
                <div class="form-floating">
                  <select class="form-select classSelect" id="classess" name="classId" aria-label="Floating label select category">
                    <option selected>Select Class</option>
                    <?php 
                      $classes = GetRecords("cpmodules", array("level"=>1));
                      foreach ($classes as $list) {
                        $selected = "";
                        if($row['classId'] == $list['id']) {
                          $selected = "selected='selected'";
                        }
                    ?>
                    <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['module']; ?></option>
                    <?php } ?>
                  </select>
                  <label for="classess">Class <span class="required_icon" style="color:red;">*</span></label>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-floating">
                   <select class="form-select" id="subject" name="classSubjectId" aria-label="Floating label select subject">
                    <option selected>Select Subject</option>
                    <?php
                      $sublevels = GetQueryRecords("SELECT id , module as name FROM cpmodules  WHERE parentId='".$row['classId']."' and parentId>0 ");
      
                      foreach ($sublevels as $sublevel) {
                        $selected = "";
                        if($sublevel['id'] == $row['subId']) {
                          $selected = "selected='selected'";
                        }
                    ?>
                          <option value="<?php echo $sublevel['id']; ?>" <?php echo $selected; ?>><?php echo $sublevel['name']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <label for="subject">Subject <span class="required_icon" style="color:red;">*</span></label>
                </div>
              </div>

              <div class="col-sm-3">
                        <div class="form-floating">
                           
                          <select class="form-select" id="course" name="course" aria-label="Floating label select Chapter">
                            <option value="" selected>Select Chapter</option>
                            <?php
                              $sublevels = GetQueryRecords("SELECT id , module as name FROM cpmodules  WHERE parentId='".$row['subId']."' and parentId>0 ");
              
                              foreach ($sublevels as $sublevel) {
                                $selected = "";
                                if($sublevel['id'] == $row['chapId']) {
                                  $selected = "selected='selected'";
                                }
                            ?>
                                  <option value="<?php echo $sublevel['id']; ?>" <?php echo $selected; ?>><?php echo $sublevel['name']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                          <label for="course">Chapter <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating">
                          <select class="form-select" id="topic" name="topic" aria-label="Floating label select Topic select Chapter">
                            <option value="" selected>Select Topic</option>
                              <?php
                                $sublevels = GetQueryRecords("SELECT id , module as name FROM cpmodules  WHERE parentId='".$row['chapId']."' and parentId>0 ");
                
                                foreach ($sublevels as $sublevel) {
                                  $selected = "";
                                  if($sublevel['id'] == $row['topicId']) {
                                    $selected = "selected='selected'";
                                  }
                              ?>
                                    <option value="<?php echo $sublevel['id']; ?>" <?php echo $selected; ?>><?php echo $sublevel['name']; ?></option>
                              <?php
                                }
                              ?>
                          </select>
                          <label for="topic">Topic <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating">
                          <select class="form-select" id="subtopic" name="subtopic" aria-label="Floating label select Sub_Topic">
                            <option value="" selected>Select Sub Topic</option>
                             <?php
                                $sublevels = GetQueryRecords("SELECT id , module as name FROM cpmodules  WHERE parentId='".$row['topicId']."' and parentId>0 ");
                
                                foreach ($sublevels as $sublevel) {
                                  $selected = "";
                                  if($sublevel['id'] == $row['subTopicId']) {
                                    $selected = "selected='selected'";
                                  }
                              ?>
                                    <option value="<?php echo $sublevel['id']; ?>" <?php echo $selected; ?>><?php echo $sublevel['name']; ?></option>
                              <?php
                                }
                              ?>
                          </select>
                          <label for="subtopic">Sub Topic <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating">
                           
                          <select class="form-select " id="difficultyType" name="difficultyType" aria-label="Floating label select difficulty">
                            <option  >Select Type</option>
                            <?php 
                              $qpTypes = GetRecords("qp_master_difficulty", array("deleted"=>0));
                              
                              foreach ($qpTypes as $list) {

                                $selected = "";
                                if($list['id'] == $row['difficultyId']) {
                                  $selected = "selected='selected'";
                                }
                            ?>
                            <option value="<?php echo $list['id']; ?>"  <?php echo $selected ?> ><?php echo $list['name'];  ?></option>
                            <?php } ?>
                           
                          </select>
                          <label for="difficultyType">Difficulty Type <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating mb-3">
                          <input type="text" name="quesMarks" class="form-control" id="quesMarks" placeholder="Total Marks" value="<?php echo $row['quesMarks']; ?>">
                          <label for="quesMarks">Total Marks <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                   

                      <div class="col-sm-3">
                        <div class="form-floating mb-3">
                          <input type="text" name="noTimes" class="form-control" id="noTimes" placeholder="No of Times" value="<?php echo $row['noTimes']; ?>">
                          <label for="noTimes"> No of Times <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                     

                      <div class="col-sm-6">
                        <div class="form-floating">
                          <select class="form-select qType multiselect" id="assesType" name="assesType[]" aria-label="Floating label select category">
                            <option>Select Type</option>
                            <?php 
                              $qpTypes = GetRecords("qp_master_qp_types", array("deleted"=>0));
                              foreach ($qpTypes as $list) {
                                $selected = "";
                                $asses_type = explode(",", $row['assesType']);
                                // if($list['id'] == $row['assesType']) {
                                if (in_array($list['id'], $asses_type)) {
                                  $selected = "selected='selected'";
                                }
                                
                                
                            ?>
                            <option value="<?php echo $list['id']; ?>" <?php echo $selected ?> ><?php echo $list['name']; ?></option>
                            <?php } ?>                      
                          </select>
                          <label for="assesType">Type of Assessment <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>

              <div class="col-sm-6">
                <div class="form-floating">
                  <select class="form-select" id="TypeofQuestion" name="qustType" aria-label="Floating label select Type of Question" required="required">
                    <option value="">-Select type-</option>
                    <?php
                      $query = "SELECT * FROM qp_master_questiontypes WHERE deleted=?";
                      $stmt = $db->prepare($query);
                      $stmt->execute(array(0));
                      while($rowmaster = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = "";
                        if($rowmaster['id'] == $row['qustType']) {
                          $selected = "selected='selected'";
                        }
                    ?>
                      <option value="<?php echo $rowmaster['id']; ?>" <?php echo $selected; ?>><?php echo $rowmaster['name']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <label for="TypeofQuestion">Type of Question <span class="required_icon" style="color:red;">*</span></label>
                </div>
              </div>
            </div>
          </div>
        </div>
