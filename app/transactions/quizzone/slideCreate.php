<?php
require_once "../../session_token/checksession.php";
require_once "../../configration/config.php";
require_once "../../configration/config_schools.php";
include "../../functions/common_functions.php";
//require_once $dir_root."app/functions/db_functions.php";
include "functions/common_function.php";
include "../cw/apis/getTaskStatus.php";

$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];

try{
  
}catch(Exception $exp){
  print_r($exp);
  return "false";
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
    <link href="../../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../../lib/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    <link href="../../../lib/summernote/summernote-bs4.css" rel="stylesheet">
    <style type="text/css">
      .br-section-wrapper {
        padding: 10px;
      }
      .modal-full {
          min-width: 100%;
          margin: 0;
      }

      .modal-full .modal-content {
          min-height: 100vh;
      }
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

      .br-pagebody {
        margin-top: 70px;
      }
      .br-header-right .btn {
        margin: 0px 10px;
      }
      .sidebar-label {
        text-align: center;
        margin: 5px 0px;
        padding: 5px;
        background: #9E9E9E;
        color: #ffffff;
        box-shadow: 0 4px 10px 0px #9E9E9E;
        font-size: 14px;
        font-weight: bold;
        white-space: normal;
      }
      .br-sideleft {
        padding: 0px;
      }
      .shadow-base {
        margin: 0px 5px;
      }

      /* ---------------------------------------------------
        SIDEBAR STYLE
      ----------------------------------------------------- */

      #topbar {
        width: 100%;
        position: fixed;
        top: -80vh;
        left: 0;
        height: 80vh;
        z-index: 999;
        background: #607D8B;
        color: #fff;
        transition: all 0.3s;
        overflow-y: scroll;
        box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
      }

      #topbar.active {
        top: 0;
        z-index: 2000;
      }
      #topbar_notepad {
        width: 100%;
        position: fixed;
        top: -60vh;
        left: 0;
        height: 60vh;
        z-index: 999;
        background: #607D8B;
        color: #fff;
        transition: all 0.3s;
        overflow-y: scroll;
        box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
      }

      #topbar_notepad.active {
        top: 0;
        z-index: 2000;
      }

      #dismiss {
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        background: #F44336;
        position: fixed;
        top: 0px;
        right: 17px;
        z-index: 1;
        cursor: pointer;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
      }

      #dismiss:hover {
        background: #fff;
        color: #7386D5;
      }

      .overlay {
        display: none;
        position: fixed;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.7);
        z-index: 998;
        opacity: 0;
        transition: all 0.5s ease-in-out;
      }
      .overlay.active {
        display: block;
        opacity: 1;
      }

      #dismiss_notepad {
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        background: #F44336;
        position: absolute;
        top: 0px;
        right: 0px;
        cursor: pointer;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
      }

      #dismiss_notepad:hover {
        background: #fff;
        color: #7386D5;
      }

      .overlay_notepad {
        display: none;
        position: fixed;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.7);
        z-index: 998;
        opacity: 0;
        transition: all 0.5s ease-in-out;
      }
      .overlay_notepad.active {
        display: block;
        opacity: 1;
      }

      #topbar .sidebar-header {
        padding: 20px;
        background: #607D8B;
      }
      #topbar_notepad .sidebar-header {
        padding: 20px;
        background: #607D8B;
      }
      #content {
        width: 100%;
        min-height: 100vh;
        transition: all 0.3s;
        position: absolute;
        top: 0;
        right: 0;
      }
      #topbar .components img{
        height: 170px;
      }
      .item:hover .item-overlay.top {
        top: 0;
      }
      .item:hover .item-overlay.right {
        right: 0;
        left: 0;
      }
      .item:hover .item-overlay.bottom {
        bottom: 0;
      }
      .item:hover .item-overlay.left {
        left: 0;
      }

      /* 
      by default, overlay is visible… 
      */
      .item-overlay {
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        
        background: rgba(0,0,0,0.5);
        color: #fff;
        overflow: hidden;
        text-align: center;
        /* fix text transition issue for .left and .right but need to overwrite left and right properties in .right */
        width: 100%; 
        
        -moz-transition: top 0.3s, right 0.3s, bottom 0.3s, left 0.3s;
        -webkit-transition: top 0.3s, right 0.3s, bottom 0.3s, left 0.3s;
        transition: top 0.3s, right 0.3s, bottom 0.3s, left 0.3s;
      }
      /*
      …but this hide it
      */
      .item-overlay.top {
        top: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      #slideTitleModal .modal-footer {
        justify-content: center;
      }
      #textEditor .modal-footer {
        justify-content: center;
      }
      .savedSlides {
        margin-bottom: 5px
      }
      #preview .devices-menu {
        width: 100%;
        height: auto;
      }
      #preview ul li{
        list-style: none !important;
        float: left !important;
      }
      #preview .submenu-list {
        width: 100%;
        height: 65px;
      }
      #privew .desktop-icon {
        width: 100%;
        height: 55px;
        background: url(../../../img/responsive_icon/desktop.svg) no-repeat center 80%;
        padding: 20px 50px;
      }
      #privew .tablet-icon {
        width: 100%;
        height: 55px;
        background: url(../../../img/responsive_icon/tablet.svg) no-repeat center 80%;
        padding: 20px 50px;
      }
      #privew .phone-icon {
        width: 100%;
        height: 55px;
        background: url(../../../img/responsive_icon/phone.svg) no-repeat center 80%;
        padding: 20px 50px;
      }
      #topbar .item{
        padding-bottom: 10px;
      }
      .delete_slide{
        cursor: pointer;
        position: absolute;
        top: 0px;
        right: 0px;
        border-radius: 0px;
        border-bottom-left-radius: 55px;
        padding: 15px;
      }
      .delete_slide span{
        position: absolute;
        top: -12px;
        right: 0px;
        font-size: 34px;
      }
      .move_slide{
        cursor: pointer;
        position: absolute;
        bottom: 0px;
        right: 0px;
        border-radius: 0px;
        padding: 0px;
        width: 100%;
        height: 24px;
      }
      .layoutChoosed{
        width: 80%;
        white-space: normal;
      }
      .users_list{
        display: none;
      }
    </style>
  </head>

  <body>
    <!-- LayoutBlock -->
    <?php include("optionblocks/topbarLayout.php"); ?>
    <!-- Page Content  -->
    <div id="content">
      <!-- ########## START: LEFT PANEL ########## -->
      <?php include("optionblocks/add_slide_sidebar.php"); ?>
      <!-- ########## END: LEFT PANEL ########## -->

      <!-- ########## START: HEAD PANEL ########## -->
      <?php include("optionblocks/add_slide_header.php"); ?>
      <!-- ########## END: HEAD PANEL ########## -->

      <!-- ########## START: MAIN PANEL ########## -->
      <div class="br-mainpanel">
        <div class="br-pagebody">
          <input type="hidden" name="class" value="" class="pagebody_class" />
          <input type="hidden" name="topic_id" value="" class="pagebody_topic_id" />
          <input type="hidden" name="respath" id="respath" value="" />
          <input type="hidden" name="current_container_slideid" id="current_container_slideid" value="" />
          <!-- start you own content here -->
          <div class="br-section-wrapper">
            <h6 class="br-section-label" style="text-transform: none"><?php echo "Date : ".$_GET['date']; ?> - <?php echo "Class ".$_GET['class']; ?> - <?php echo($_GET['subject'] == 1 ? "English" : ($_GET['subject'] == 2 ? "Math" : ($_GET['subject'] == 3 ? "Value Based" : "Value Based"))); ?>&nbsp; &nbsp;<span id="clicked_slidepath"></span></h6>
            <iframe id='iframe_id' name="myframe" frameborder="0" width='100%' height='675px' src="" style="border: 2px solid;"></iframe>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="privew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Preview</h5>
                  <div class="devices-menu">
                    <ul>
                      <li class="submenu-list list-desktop" style="list-style: none;float: left;">
                        <a class="desktop-icon hvr-pop" href="javascript:void(0)"></a>
                      </li>
                      <li class="submenu-list list-tablet" style="list-style: none;float: left;"><a class="tablet-icon hvr-pop" href="javascript:void(0)"></a></li>
                      <li class="submenu-list list-phone" style="list-style: none;float: left;"><a class="phone-icon hvr-pop" href="javascript:void(0)"></a></li>
                    </ul>
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="iframe_wrapper" id="display" style="transition: all 1s ease; margin: 0px auto">
                    <iframe id="pre_iframe" width="100%" height="670px" id="data" src=""></iframe>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <!-- MODAL ALERT MESSAGE -->
          <div id="modalsuccess" class="modal fade">
            <div class="modal-dialog" role="document">
              <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                  <p class="mg-b-20 mg-x-20" id="success_msg"> Slide Sent for Review.</p>
                  <a href="<?php echo $web_root; ?>app/taskList.php" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20 close_save" data-dismiss="modal">
                    Close</a>
                </div><!-- modal-body -->
              </div><!-- modal-content -->
            </div><!-- modal-dialog -->
          </div><!-- modal -->
        </div><!-- br-pagebody -->
      </div><!-- br-mainpanel -->
    </div>
    
    <div id="modaldemo3" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog modal-lg" role="document" style="right: 0;transition: opacity 0.3s linear, right 0.3s ease-out;position: fixed;margin: auto;width: 620px;height: 100%;transform: translate3d(0%, 0, 0);">
        <div class="modal-content tx-size-sm" style="height: 100%;overflow-y: auto;border-radius: 0;border: none;">
          <div class="modal-header pd-x-20" style="padding-left:20px;padding-right:20px;display:flex;align-items:center;justify-content:space-between;padding:15px;border-bottom:1px solid #e9ecef;">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Instruction</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:0;background:transparent;border:0;-webkit-appearance:none;float:right;font-size:1.3125rem;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;opacity:.5;">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" id="task_reply" enctype="multipart/form-data">
            <div class="modal-body pd-20">
              <div class="row">
                <div class="col-xl-12" id="success_slide">
                  <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                      <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                      <span><strong>Well done!</strong> Successful Updated.</span>
                    </div><!-- d-flex -->
                  </div><!-- alert -->
                </div>
                <div class="col-xl-6" id="fail_slide">
                  <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                      <i class="icon ion-ios-close alert-icon tx-32"></i>
                      <span><strong>Oh No!</strong> Are you getting error, Please contact tech team.</span>
                    </div><!-- d-flex -->
                  </div>
                </div>
              </div>
              <input type="hidden" name="task_assi_id" id="task_assi_id" value="<?php echo $task_assi_id; ?>"/>
              <input type="hidden" name="slide_path" id="slide_path_get" value=""/>
              <input type="hidden" name="data1" id="final_data" value=""/>
              <div class="row">
                <div class="col-md-12">
                  <?php
                  if(isset($getTaskStatus['AssignedDepartments'])){
                    foreach ($getTaskStatus['AssignedDepartments'] as  $role) {
                ?>
                  <?php //if($role['user_id'] != $logged_user_id){ 
                      $attachments = json_decode($role['attachments']);
                  ?>
                  <div class="card">
                    <div class="card-header tx-medium">
                      <?php echo $role['user_name'] ?> - status(<?php echo $role['status_name']; ?>)
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="inst_cw">Instructions:</label>
                            <textarea readonly class="form-control" rows="2" name="inst_cw" id="inst_cw"><?php echo $role['instructions']; ?></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-header">Files</div>
                            <div class="card-body">
                              <div class="row">
                                <?php
                                if(is_array($attachments))
                                  foreach ($attachments as $attachment) {
                                    $file_type = explode(".", $attachment);
                                    $file_type = $file_type[1];

                                    $attachment = str_replace($dir_root.'app/transactions/id/', "", $attachment);
                                ?>
                                <div class="col-md-3">
                                  <?php if($file_type == "jpg" || $file_type == "jpeg" || $file_type == "png" || $file_type == "gif" || $file_type == "PNG") { ?>
                                  <img src="<?php echo "../id/".$attachment; ?>" class="card-img-top img-responsive">
                                  <?php } else { ?>
                                  <a href="<?php echo "../id/".$attachment; ?>" download> Download </a>
                                  <?php } ?>
                                </div>
                                <?php
                                  }
                                ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div>
                  <?php //}
                      }
                    }//end of if isset condition
                  ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card" id="cw_reply_style">
                    <div class="card-header tx-medium bd-0 tx-white bg-info">
                      <?php
                        if($user_type == "Content Writer")
                          $panel_title = 'CW Reply';
                        else
                          $panel_title = 'GD Reply';
                      ?>
                      <?php echo $panel_title; ?>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="topicStatus">Status:</label>
                            <select class="form-control" id="topicStatus" required="required">
                              <option value="">Select Status</option>
                              <?php
                                foreach ($getStatus as $auto_id => $status_name) {
                                  if(($auto_id == 17 || $auto_id == 20) && $user_type == "Content Writer"){
                              ?>
                                  <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                              <?php
                                  }else if(($auto_id == 5 || $auto_id == 21) && $user_type == "Graphic Designer"){
                              ?>
                                  <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                              <?php
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <?php
                          if($user_type == "Content Writer"){
                        ?>
                        <div class="col-md-12 users_list" id="users_list">
                          <div class="form-group">
                            <label for="topicStatus">Users:</label>
                            <select class="form-control" id="gd_users" required="required">
                              <option value="">Select User</option>
                              <?php
                                $query = "SELECT id, first_name, last_name, roles_id FROM users WHERE roles_id=3";
                                $stmt = $db->query($query);
                                while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                                  if($get_task_assgin_gd != "0")
                                  {
                                    if($get_task_assgin_gd == $fetch['id']) {
                                ?>
                                    <option value="<?php echo $fetch['id']; ?>" selected="selected"><?php echo $fetch['first_name']." ".$fetch['last_name']; ?></option>
                                <?php
                                    }//end of if loop
                                  } else {
                                    ?>
                                    <option value="<?php echo $fetch['id']; ?>"><?php echo $fetch['first_name']." ".$fetch['last_name']; ?></option>
                                    <?php
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <?php
                          }
                        ?>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="cw_remarks">Remarks:</label>
                            <textarea class="form-control" rows="2" name="cw_remarks" id="cw_remarks"></textarea>
                          </div>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer" style="display:flex;align-items:center;justify-content:flex-end;padding:15px;border-top:1px solid #e9ecef;">
              <button type="button" id="save" class="btn btn-md btn-info">Save &amp; Submit</button>
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>

    <!-- Slide Review Modal -->
    <div id="add_topic_level_modal_review" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog modal-lg" role="document" style="right: 0;transition: opacity 0.3s linear, right 0.3s ease-out;position: fixed;margin: auto;width: 620px;height: 100%;transform: translate3d(0%, 0, 0);">
        <div class="modal-content tx-size-sm" style="height: 100%;overflow-y: auto;border-radius: 0;border: none;">
          <div class="modal-header pd-x-20" style="padding-left:20px;padding-right:20px;display:flex;align-items:center;justify-content:space-between;padding:15px;border-bottom:1px solid #e9ecef;">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Instruction</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:0;background:transparent;border:0;-webkit-appearance:none;float:right;font-size:1.3125rem;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;opacity:.5;">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" id="task_reply_ID" enctype="multipart/form-data">
            <div class="modal-body pd-20">
              <?php
                $task_userid = $_GET['task_userid'];
                if(isset($getTaskStatus['AssignedDepartments'])){
                  foreach ($getTaskStatus['AssignedDepartments'] as  $role) {
              ?>
                <?php if($role['user_id'] == $logged_user_id){ 
                    $attachments = json_decode($role['attachments']);
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card bd-0 card_input">
                      <div class="card-header tx-medium bd-0 tx-white bg-info">
                        ID Task Input - status(<?php echo $role['status_name']; ?>)
                      </div><!-- card-header -->
                      <div class="card-body bd bd-t-0 rounded-bottom">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="inst_cw">Instructions:</label>
                              <textarea class="form-control" readonly rows="2" name="inst_cw" id="inst_cw"><?php echo $role['instructions']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header">Files</div>
                              <div class="card-body">
                                <div class="row">
                                  <?php
                                  if(is_array($attachments))
                                    foreach ($attachments as $attachment) {
                                      $file_type = explode(".", $attachment);
                                      $file_type = $file_type[1];
                                  ?>
                                  <div class="col-md-3">
                                    <?php if($file_type == "jpg" || $file_type == "jpeg" || $file_type == "png" || $file_type == "gif" || $file_type == "PNG") { ?>
                                    <img src="<?php echo "../id/".$attachment; ?>" class="card-img-top img-responsive">
                                    <?php } else { ?>
                                    <a href="<?php echo "../id/".$attachment; ?>" download> Download </a>
                                    <?php } ?>
                                  </div>
                                  <?php
                                    }
                                  ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- card-body -->
                    </div>
                  </div>
                </div>
                <?php } else { 
                    $attachments = json_decode($role['attachments']);
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card bd-0 card_output">
                      <div class="card-header tx-medium bd-0 tx-white bg-warning">
                        Content Writer Task Output - Status(<?php echo $role['status_name']; ?>)
                      </div><!-- card-header -->
                      <div class="card-body bd bd-t-0 rounded-bottom">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="inst_cw">Remarks:</label>
                              <textarea class="form-control" readonly rows="2" name="inst_cw" id="inst_cw"><?php echo $role['instructions']; ?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <?php
                            if(is_array($attachments))
                              foreach ($attachments as $attachment) {
                                $file_type = explode(".", $attachment);
                                $file_type = $file_type[1];
                            ?>
                            <div class="col-md-2">
                              <div class="card">
                                <div class="card-header">Files</div>
                                <div class="card-body">
                                  <?php if($file_type == "jpg" || $file_type == "jpeg" || $file_type == "png" || $file_type == "gif"){ ?>
                                  <img src="<?php echo $attachment; ?>" class="card-img-top img-responsive">
                                  <?php } else { ?>
                                  <a href="#">
                                    <img src="images/notImage.png" class="card-img-top img-responsive">
                                  </a>
                                  <?php } ?>
                                </div> 
                              </div>
                            </div>
                            <?php
                              }
                            ?>
                          </div>
                        </div>
                      </div><!-- card-body -->
                    </div>
                  </div>
                </div>
                <?php } ?>
              <?php
                  }
                }//end of if isset condition
              ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white bg-info">
                      ID Status Update
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">
                      <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                      <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                      <input type="hidden" name="task_assi_id" value="<?php echo $task_assi_id; ?>">
                      <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                      <input type="hidden" name="task_userid" value="<?php echo $task_userid; ?>">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="status_cw">Status:</label>
                            <select class="form-control" name="up_status_cw" id="status_cw" required>
                              <option value="">- Select Status -</option>
                              <?php
                                echo "<pre/>";
                                print_r($getStatus);
                                foreach ($getStatus as $auto_id => $status_name) {
                                  if($auto_id == 5 || $auto_id == 13 || $auto_id == 18 || $auto_id == 23){
                              ?>
                                  <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                              <?php
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12 inst_attch">
                          <div class="form-group">
                            <label for="inst_cw">Instructions:</label>
                            <textarea class="form-control" rows="2" name="up_inst_cw" id="inst_cw"></textarea>
                          </div>
                        </div>
                        <div class="col-md-12 inst_attch">
                          <div class="form-group">
                            <label for="file_cw">Attach Files:</label>
                            <div class="file-loading">
                              <input id="file-1" type="file" name="up_cw_files[]" multiple class="file" data-overwrite-initial="false">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer" style="display:flex;align-items:center;justify-content:flex-end;padding:15px;border-top:1px solid #e9ecef;">
              <a href="#" class="btn btn-md btn-danger" data-dismiss="modal" aria-label="Close">Cancel</a>
              <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info" />
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>

    <!-- SlideName Modal -->
    <div class="modal fade" id="slideTitleModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" id="slideTitleModalForm" enctype="multipart/form-data">
            <input type="hidden" name="task_assign_id" value="<?php echo $_GET['task_assi_id']; ?>" class="task_assign_id" />
            <input type="hidden" name="class" value="" class="class" />
            <input type="hidden" name="topic_id" value="" class="topic_id" />
            <input type="hidden" name="lesson_id" value="" class="lesson_id" />
            <input type="hidden" name="layout_id" value="" class="layout_id" />
            <input type="hidden" name="date" value="" class="date" />
            <input type="hidden" name="qzone_slide_path" value="" class="qzone_slide_path" />
            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inst_cw">Slide Title:</label>
                    <input type="text" class="form-control" name="slide_title" id="slide_title" required/>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-md btn-success" id="slideTitleBth">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Upload Iframe images -->
    <!-- LARGE MODAL -->
    <div id="resources" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Images</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-20">
            <div class="row">
              <div class="col-md-12" id="img_table">
                
              </div>
            </div>
          </div><!-- modal-body -->
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- delete info modal -->
    <div id="delete_slide_modal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="delete_slide_modal_title">Info</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-20">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" id="class_id" value="<?php echo $_GET['class']; ?>"/>
                <input type="hidden" id="topic_id" value="<?php echo $_GET['topic']; ?>"/>
                <input type="hidden" id="for_delete_slide_id" />
                <h6 class="text-center">you cannot retrive the slide, once deleted. <br/> Are you sure, you want to delete...</h6>
              </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button class="btn btn-md btn-danger" id="delete_slide_yes">Yes</button>
            <button class="btn btn-md btn-success" data-dismiss="modal">No</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- delete info modal -->
    <div id="move_slide_modal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="move_slide_modal_title">Info</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-20">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" id="move_class_id" value="<?php echo $_GET['class']; ?>"/>
                <input type="hidden" id="move_topic_id" value="<?php echo $_GET['topic']; ?>"/>
                <input type="hidden" id="for_move_slide_id" />
                <h6 class="text-center btn-success" id="move_confirm_msg"></h6>
                Select
                <select class="form-control" name="move_to_slide_ref" required="required" id="move_to_slide_ref">
                  
                </select>
              </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button class="btn btn-md btn-danger" id="move_slide_yes">Move</button>
            <button class="btn btn-md btn-success" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- overlay for topbar layout modal -->
    <div class="overlay"></div>
    <div class="overlay_notepad"></div>
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/summernote/summernote-bs4.min.js"></script>
    <script src="../../../lib/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="js/addSlide.js?ver=04072019"></script>
  </body>
</html>
