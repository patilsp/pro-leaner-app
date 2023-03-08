<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
include "../../functions/common_functions.php";
include "../../functions/db_functions.php";
//include_once "../session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
try{
  $getClasses = getClasses();
  $getStatus = getStatus();
  $getUsers = getUsers("",$logged_user_id);

  //getTaskType
  $getTaskType = getTaskType();
} catch(Exception $exp){
  print_r($exp);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- vendor css -->
    <link href="../../../lib/bootstrap/glyphicons.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- <link href="../../../lib/fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/> -->
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    
  </head>
  <style type="text/css">
    .br-pagebody {
      margin-top: 0px;
    }
    .br-section-wrapper {
      padding: 14px;
    }
    /*Sticky button register*/
    .center{
      position: fixed;
      top: 35%;
      right: -10px;
      width: 110px;
      height: 0px;
      text-align: right;
      z-index: 9999;
      margin-top: -15px;
    }

    .center a{
      transform: rotate(-90deg);
      -webkit-transform: rotate(-90deg); 
      -moz-transform: rotate(-90deg); 
      -o-transform: rotate(-90deg); 
      filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
      display: block; 
      background: #e96f35; 
     text-align:center;
      height: 48px; 
      width: 165px;
      padding: 10px 16px;
      color: #fff; 
      font-family: Arial, sans-serif; 
      font-size: 15px; 
      font-weight: bold; 
      text-decoration: none; 
      border-bottom: solid 1px #333; /*border-left: solid 1px #333; border-right: solid 1px #fff;*/
    }
    
    .ps{
      overflow-y: visible !important;
    }
    .br-mainpanel {
      margin-left: 0px;
    }
    #new_slide_btn .btn{
      padding: 4.65rem 0.75rem;
    }
  </style>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/AWNS_SlideSlidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/reviewSlideHeader.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Assign Work For New Slides</h6>
          <?php include("../../fixed-blocks/getWork_AWNS.php"); ?>
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    <div id="modaldemo3" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog modal-lg" role="document" style="right: 0;transition: opacity 0.3s linear, right 0.3s ease-out;position: fixed;margin: auto;max-width: 1000px !important;width: 1000px;height: 100%;transform: translate3d(0%, 0, 0);">
        <div class="modal-content tx-size-sm" style="height: 100%;overflow-y: auto;border-radius: 0;border: none;">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">New Slide Topic Level - Instructions</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" id="new_task_form" name="new_task_form" enctype="multipart/form-data">
            <div class="modal-body pd-20">
              <input type="hidden" name="prev_slide_id" id="prev_slide_id" value=""/>
              <input type="hidden" name="template_id" id="template_id" value=""/>
              <input type="hidden" name="layout_id" id="layout_id" value=""/>
              <input type="hidden" name="slide_classid" id="slide_classid" value=""/>
              <input type="hidden" name="slide_topicid" id="slide_topicid" value=""/>
              <input type="hidden" name="lesson_id" id="lesson_id" value=""/>
              <input type="hidden" name="assign_to[]" id="assign_to" value="" />
              <input type="hidden" name="main_status" id="main_status" value="15" />
              <div class="row">
                <div class="col-md-12" id="role_block">
                  <div class="row">
                    <div class="col-md-12">
                      <section>
                        <div class="row ass_to" id="ass_to">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="role_type">Assign To:</label>
                              <select class="form-control" name="role_type" id="role_type" required>
                                <option value="">- Select Role -</option>
                                <option value="CW">Content Writer</option>
                                <!-- <option value="GD">Graphic Desginer</option>
                                <option value="TT">Tech Team</option> -->
                              </select>
                            </div>
                          </div>
                        </div><!-- Common Form -->
                        <div class="card cw_block" id="cw_block">
                          <div class="card-header tx-medium bd-0 tx-white bg-info">
                            Content Writer
                          </div><!-- card-header -->
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <select class="form-control" id="work_type_cw" name="work_type[]" required>
                                    <?php foreach($getTaskType['2'] as $id=>$value) { ?>
                                    <option value="<?php echo $id; ?>" selected="selected"><?php echo $value; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="user_cw">Assign To:</label>
                                  <select class="form-control" name="user_cw" id="user_cw" required>
                                    <option value="">-Select User-</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label for="inst_cw">Instructions:</label>
                                  <textarea class="form-control" rows="5" name="inst_cw" id="inst_cw" required></textarea>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="file_cw">Reference Files:</label>
                                  <div class="file-loading">
                                    <input id="file-1" type="file" name="cw_files[]" multiple class="file" data-overwrite-initial="false">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><!-- card-body -->
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info submit" />
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>
    <div class="center inst_btn hidden-xs-block hidden-sm-block visible-md-block visible-lg-block" data-toggle="modal" data-target="#modaldemo3" id="inst_btn">
        <a href="#">Instruction</a>
    </div>
    
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <!-- <script src="../../../lib/fileinputs/js/fileinput.js" type="text/javascript"></script> -->
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>
    
    <script src="../../../js/cms.js"></script>
    <script src="js/slideAssign.js"></script>
  </body>
</html>
