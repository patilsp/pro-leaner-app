<?php
  include_once "../session_token/checksession.php";
  include_once "../configration/config.php";
  //include_once "session_token/checktoken.php";
  require_once "../functions/db_functions.php";
  require_once "functions/common_function.php";
  // if(checkPageAccess(3, 0) !== true) {
  //   die;
  // }
  $back_page = $web_root."app/home.php";
  $login_userid = $_SESSION['cms_userid'];
  $role = $_SESSION['user_role_id'];
  $all_classes = getClasses();
  
  if($role == "9") {
    $classes = getClassFromteacher_subject_mapping($login_userid);
    foreach($all_classes as $key=>$thisClass) {
      if(! in_array($thisClass['id'], $classes)) {
        unset($all_classes[$key]);
      }
    }
  }
 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ILP - PMS</title>

    <!-- Common Styles -->
    <?php //include("../common-blocks/style.php"); ?>
    <!-- vendor css -->
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
    <!-- <link rel="stylesheet" href="../../css/subject.css"> -->
    <!-- orgchart CSS -->
    <link rel="stylesheet" href="../../lib/orgchart/jquery.orgchart.css?ver=231120211126">
    <link rel="stylesheet" href="<?php echo $web_root ?>assets/lib/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/launch.css">

    <style type="text/css">
      .orgChartDiv{
          width: auto;
          height: auto;
      }

      .orgChartContainer{
          overflow: auto;
          background: #eeeeee;
      }
      .disableEditAddAction{
        pointer-events: none;
      }
    </style>
  </head>
  <body class="collapsed-menu">
    <!-- navbar -->
    <?php include("../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../fixed-blocks/header.php"); ?>

   
      <!-- breadcrumb -->
      <?php //include("../common-blocks/breadcrumb.php"); ?>

      <div class="br-pagebody">
        <div class="new-row-bg mt-4">
          <section id="launch" class="">
            <div class="card">
            <form method="post" id="form1" name="form1">
                <div class="card-header d-flex align-items-center justify-content-between pd-y-5 ">
                  <h5 class="flex-grow-1">Enable/Disable Content</h5>
                  <input type="hidden" name="type" value="ChapterEnableDisable">
                  <button type="submit" class="btn btn-md btn-blue px-5 font-weight-medium header_button class_modal_btn">Save</button>
                </div>
                <div class="row justify-content-center w-100">
                  <div class="col-4 bg-white mr-3 p-5 rounded-lg">
                    <div class="form-group">
                      <label>Class</label>
                      <select class="form-control classes" name="class" required="required">
                        <option value="">-Select Class-</option>
                        <?php
                          foreach ($all_classes as $key => $value) {
                        ?>
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['module']; ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Section</label>
                      <select class="form-control sections" name="section" required="required">
                        <option value="">-Select Section-</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Subject:</label>
                      <select class="form-control subjects" name="subject" required="required">
                        <option value="">-Select Subject-</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Chapter:</label>
                      <select class="form-control topics" name="topic" required="required">
                        <option value="">-Select Chapter-</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-7 rounded-lg">
                    <span class="tabel_blk" id="tabel">
                      <div class="w-100 h-100 text-center d-flex align-items-center justify-content-center" id="empty_content">
                      <h3 class="m-0 txt-grey">Select a class, section, subject and chapter to launch content</h3> 
                      </div>
                    </span>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
   
    <!-- Snackbar  -->
    <div id="snackbar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0" id="sb_heading"></h6>
        <button type="button" class="close close_snackbar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        
      </div>
    </div>
    <!-- common scripts -->
    <?php include("../setup/common-blocks/js.php"); ?>
    <!-- ########## END: MAIN PANEL ########## -->
    <!-- <script src="../../lib/jquery/jquery.js"></script> -->
    <script src="../../lib/popper.js/popper.js"></script>

    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../lib/orgchart/jquery.orgchart.js"></script>
    <script src="../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../js/cms.js"></script>
    <!-- <script src="../../js/subject.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../js/launch.js"></script>
  </body>
</html>