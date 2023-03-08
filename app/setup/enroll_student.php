<?php
  require_once "../session_token/checksession.php";
	include "../configration/config.php";  
  require_once "../functions/db_functions.php";
  include "functions/common_function.php";
  
	// require_once "../functions/classes.php";
  //$back_page = $web_root."app/enroll/enroll.php";
  $back_page = "#.";
  $classList = getClassNames("1");  
  //print_r($classList); 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>
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

    <!-- Common Styles -->
    <?php //include("../common-blocks/style.php"); ?>
    <link rel="stylesheet" href="../../assets/css/enroll/enroll_student.css">
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
    <div class="br-pagebody">
     <div class="row new-row-bg mt-4">
     <div>
        <!-- breadcrumb -->
        <?php //include("../common-blocks/breadcrumb.php"); ?>


        <section id="enroll_student">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between mb-2">
                <h5 class="flex-grow-1">Enroll Students</h5>
            </div>
            <br/>
            <h5 class="text-center w-100 mb-4">Assign subjects and Enroll students</h5>
            <div class="w-100 mx-auto" id="card_blk">
              <div class="col-12 qust" id="studentClass">
                <div class="d-flex align-items-center position-relative mb-3">
                  <div class="form-group col-5">
                    <label>Class</label>
                    <select class="form-control class selectclass" id="selectclass" name="class">
            <option value="">-Choose Class-</option>
                    <?php foreach ($classList as $key=>$classValue){?>
                      <option value="<?php echo $classValue['id'].'-'.$classValue['category_id']; ?>"><?php echo $classValue['module'];?></option>
              <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-5">
                    <label>Section</label>
                    <select class="form-control section" id="sectionOptionSection" name="section">
            <option value="">-Choose Section-</option>
                    </select>
                  </div>
                  <button type="button" class="btn btn-primary go mt-4">Go</button>
                </div>
              </div>
              <div class="col-12 mt-0 bg-white border-r" id="assign_sub_blk">
                <h5 class="text-center w-100 mb-4">Assign Subjects</h5>
                <div class="table-responsive1">
                  <table class="tabel w-100 mx-auto">
                      <thead>
                        <tr>
                          <th>Category</th>
                          <th>Subject</th>
                        </tr>
                      </thead>
                      <tbody id="table_body">
                        
                      </tbody>
                    <input type="hidden" value="" id="table_count">
                  </table>
                </div>
                <div class="position-relative text-center mt-4">
                  <button type="submit" class="btn btn-md btn-blue shadow px-5  text-white save" id="sub_assign_active">Save</button>
                </div>
              </div>
            </div>
            <div class="w-100 mt-3">
              <div class="col-12 mt-0 bg-white border-r py-5 px-4" id="enroll_student_sub_blk">
                <h5 class="text-center w-100 mb-5">Enroll Students</h5>
                <div class="table-responsive1">
                  <table class="tabel table-bordered w-100 mx-auto mb-1">
                  <thead id="tableHead"></thead>
                  <tbody id="tableBody"></tbody>
                  </table>
                </div>
                <div class="position-relative text-center mt-4">
                  <button type="submit" class="btn btn-md btn-blue shadow px-5 update text-white" id="sub_assign_active">Save</button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
     </div>
    </div>

    <!-- Save Confirmation Modal -->
    <div class="modal fade" id="alert_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center px-5 py-5">
            <img src="../../img/alert.png" class="mb-2">
            <h4 class="font-weight-bold mb-3">Alert</h4>
            <p class="m-0 font-weight-bold">The subject mapped has not been saved and are you sure you want to go back?</p>

            <div class="position-relative d-flex justify-content-center mt-5">
              <button class="btn btn-md btn-blue font-weight-medium yes_bth mr-4" id="redirect_yes">Yes</button>
              <button class="btn btn-md btn-blue font-weight-medium no_btn" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
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
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body"> <span class="font-weight-bold m-0"></span></p>
      </div>
    </div>

    <!-- common scripts -->
    <?php //include("../common-blocks/js.php"); ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="../../js/enroll_student.js"></script>
	<script type="text/javascript">
        <?php if(isset($_SESSION['sb_heading']))  { ?>
        $("#sb_heading").html("<?php echo $_SESSION['sb_heading']; ?>");
        $("#sb_body").html('<?php echo $_SESSION['sb_message']; ?>');
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, <?php echo $_SESSION['sb_time']; ?>);
      <?php unset($_SESSION['sb_heading']); } ?></script>
  </body>
</html>