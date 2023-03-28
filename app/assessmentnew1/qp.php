<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";

//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php";
require_once "../functions/common_functions.php";
$user_id = $_SESSION['cms_userid'];
$role_id = $_SESSION['user_role_id'];
 
?>
<!DOCTYPE html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />

    <title>PMS - Dashboard</title>
    
    <link href="<?php echo $web_root ?>lib/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo $web_root ?>lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo $web_root ?>lib/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="<?php echo $web_root ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $web_root ?>assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?php echo $web_root ?>assets/css/style.css?ver=191020211109" rel="stylesheet" />
    <link href="<?php echo $web_root ?>assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
 
    <!-- loader-->
    <link href="<?php echo $web_root ?>assets/css/pace.min.css" rel="stylesheet" />


    <!--Theme Styles-->
    <link href="<?php echo $web_root ?>assets/css/light-theme.css" rel="stylesheet" />
    <link href="<?php echo $web_root ?>lib/toast/toast.css" rel="stylesheet" />
  
  <!-- vendor css -->
  <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
  <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
  <link href="../../lib/highlightjs/github.css" rel="stylesheet">
  <link href="../../lib/datatables/jquery.dataTables.css" rel="stylesheet">
  <link href="../../lib/select2/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/cms.css">


  <link rel="stylesheet" type="text/css" href="../../lib/datatables/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/assessment/assessment.css">
  <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">

  <style type="text/css">
    .bi-x-circle {
      font-size: 30px;
      cursor: pointer;
    }
    .qustCard .input-group-text {
      position: absolute;
      top: 0px;
      right: 0px;
      z-index: 8;
    }
    #cqp .card {
      border: 1px solid rgba(0,0,0,.125);
    }
    #cqp .bi-trash-fill::before, #veqp .bi-trash-fill::before {
      content: "\f5a8" !important;
    }
    #QpListTable td:nth-child(1){
      text-transform: capitalize;
    }
  </style>
</head>

<body class="collapsed-menu">
	
<div class="wrapper">

  <!-- ########## START: LEFT PANEL ########## -->
  <?php include("../fixed-blocks/left_sidebar.php"); ?>
  <!-- ########## END: LEFT PANEL ########## -->

  <!-- ########## START: HEAD PANEL ########## -->
  <?php include("../fixed-blocks/header.php"); ?>
  <!-- ########## END: HEAD PANEL ########## -->
  <div class="br-mainpanel">
    <div class="br-pagebody">
      <!-- start you own content here -->
      <div class="row new-row-bg">
        <div class="col-md-12 landing_page">
          <div class="card h-100 d-flex flex-column justify-content-between mb-4 ">
            <div class="card-header">
              <h6 class="mg-b-0 tx-14 mt-4">Assessment</h6>
              <?php
              if (checkUserAccess($user_id,$role_id,56) == "true") {
                ?>
              <div class="card-option tx-24">
                <button class="btn btn-primary shadow" data-toggle="modal" data-target="#createQuestionPaper" id="add_student_bth">Add New Question Paper </button>
              </div>
              <?php
              }
              ?>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-center gap-2 p-4" style="margin-left:8rem;">
             
                <div class="w-200px">
                  <!-- <label for="selectedClass" class="font-weight-bold required">Class</label> -->
                  <select class="form-control selectclass1" id="selectedClass1" name="selectedClass" required>
                    <option value="" selected>Select Class</option>
                <?php 
                  $classes = GetRecords("cpmodules", array("level" => 1,"deleted"=>0));
                  foreach ($classes as $list) {
                ?>
                <option value="<?php echo $list['id']; ?>"><?php echo $list['module']; ?></option>
                <?php } ?>
                  </select>
                </div>

                <div class="w-200px">
                  <!-- <label for="selectedSubject" class="font-weight-bold">Subject</label> -->
                  <select class="form-control" id="selectedSubject1" name="selectedSubject1">
                    <option value="">-Select Subject-</option>
                  </select>
                </div>

                <div class="w-200px">
                  <!-- <label for="course" class="font-weight-bold">Chapter</label> -->
                  <select class="form-control" id="course1" name="course1">
                    <option value="">-Select Chapter-</option>
                  </select>
                </div>

                <div class="w-200px">
                  <!-- <label for="course" class="font-weight-bold">Topic</label> -->
                  <select class="form-control" id="topic1" name="topic1">
                    <option value="">-Select Topic-</option>
                  </select>
                </div>

                <div class="w-200px">
                  <!-- <label for="course" class="font-weight-bold">Sub Topic</label> -->
                  <select class="form-control" id="subtopic1" name="subtopic1">
                    <option value="">-Select Sub Topic-</option>
                  </select>
                </div>
                <div class="w-200px">
                  <button type="submit" class="btn btn-md btn-blue px-5 shadow" id="filterbutton">Go</button>
                </div>
             </div>
          
              <div class="  py-3">
                <!-- <div class="tab-pane fade " id="cqp" role="tabpanel">
                  
                </div> -->
                <div class="" id="veqp"  >
                  <table id="viewEditQpListTable" class="table dataTable" style="width:100%">
                      <thead>
                          <tr>
                              <th>Title</th>
                              <th>Publish Date</th>
                              <th>Total Marks</th>
                              <th>Enrolled Students</th>
                              <th>Submitted</th>
                              <!-- <th>Evaluate</th> -->
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                </div>
               
              </div>
            </div>
        </div>

         
      
  </div>
  <div class="review_page" id="review" style="display:none  ">
                  <?php include "reviewAssessment.php"; ?>
                </div>
</div>
     </div>
  <!--end page main-->


	<!--start overlay-->
	<div class="overlay nav-toggle-icon"></div>
	<!--end overlay-->

	<!--Start Back To Top Button-->
	<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
	<!--End Back To Top Button-->

  <!--start switcher-->
  <div class="switcher-body" >
    <form id="getQuestionsHtml" >
      <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" style="z-index:9999">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Add Questions for the Section</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
          <div class="row g-2 mb-3" id="qustSelectedClassSubject">
            
          </div>
        </div>
        <div class="offcanvas-footer border-top text-center">
          <button type="submit" class="btn btn-primary" id="addNewQust">Save</button>
        </div>
      </div>
    </form>
  </div>
  <!--end switcher-->
</div>
<!-- ./wrapper -->

<div id="toast"><div id="img"><i class="bi bi-info-circle-fill"></i></div><div id="desc">Question Paper Created Successfully.</div></div>

<!-- Modal -->
<div class="modal fade" id="editQuestionPaper" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center qpTitle">Edit Question Paper</h5>
        <button type="button" class="btn-close edit_question_paper_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bindHTMLEdit"></div>
    </div>
  </div>
</div>

<!-- Preview Question Paper Modal -->
<div class="modal fade" id="previewQuestionPaper" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center qpTitle">View Question Paper</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bindHTMLPreview"></div>
    </div>
  </div>
</div>

<!-- Preview Question Modal -->
<div class="modal fade" id="previewQuestion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center qpTitle">View Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bindHTMLPreviewQuestion"></div>
    </div>
  </div>
</div>

<!-- Evaluate ANswer -->
<!-- Modal -->
<div class="modal fade" id="evaluate_answer_paper_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div id="toast"><div id="img"><i class="bi bi-info-circle-fill"></i></div><div id="desc">A notification message..</div></div>
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
    <div class="modal-header text-center">
        <h5 class="modal-title w-100">Evaluate Answer</h5>
        <button type="button" class="btn-close evaluate_answer_paper_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body vh-100" id="evaluate_answer_iframe">
        
      </div>
    </div>
  </div>
</div>

 <!-- Create Question Modal -->
 <div class="modal fade" id="createQuestionPaper" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">Create Question </h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="bindHTMLCreate">

        <form id="qust_paper_form">
              <input type="hidden" name="questionIds[]" value="" class="questionIds">
              <div class="" id="main-container">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row g-2 mb-3">
                     
                      <!-- for Candidate -->
                      <div class="col-sm-2 forCandidate d-none">
                        <div class="form-floating">
                          <select class="form-select catSelect" id="cat" name="catId" aria-label="Floating label select category">
                            <option value="" selected>Select Category</option>
                            <?php 
                              $cat = GetRecords("qp_master_category", array("deleted"=>0));
                              foreach ($cat as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                            <?php } ?>
                          </select>
                          <label for="class">Category</label>
                        </div>
                      </div>
                      <!-- End for Candidate -->

                      <!-- for Student -->
                      <div class=" col-sm-2 forStudent">
                        <div class="form-floating">
                          <select class="form-select classSelect" id="classess" name="classId" aria-label="Floating label select category">
                            <option value="" selected>Select Class</option>
                            <?php 
                              $classes = GetRecords("cpmodules", array("level" => 1,"deleted"=>0));
                              foreach ($classes as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['module']; ?></option>
                            <?php } ?>
                          </select>
                          <label for="classess">Class</label>
                        </div>
                      </div>
                      <!-- End for Student -->
                      <div class="col-sm-2 forCandidateStudent">
                        <div class="form-floating">
                          <select class="form-select" id="selectedSection" name="selectedSection" aria-label="Floating label select subject">
                            <option value="" selected>Select Section</option>
                          </select>
                          <label for="subject">Section</label>
                        </div>
                      </div>
                      <div class="col-sm-2 forCandidateStudent">
                        <div class="form-floating">
                          <select class="form-select" id="selectedSubject" name="classSubjectId" aria-label="Floating label select subject">
                            <option value="" selected>Select Subject</option>
                          </select>
                          <label for="subject">Subject</label>
                        </div>
                      </div>
                      <div class="col-sm-2 forCandidateStudent">
                        <div class="form-floating">
                          <select class="form-select" id="course" name="course" aria-label="Floating label select Chapter">
                            <option value="" selected>Select Chapter</option>
                          </select>
                          <label for="subject">Chapter</label>
                        </div>
                      </div>
                      <div class="col-sm-2 forCandidateStudent">
                        <div class="form-floating">
                          <select class="form-select" id="topic" name="topic" aria-label="Floating label select Chapter">
                            <option value="" selected>Select Topic</option>
                          </select>
                          <label for="subject">Topic</label>
                        </div>
                      </div>
                      <div class="col-sm-2 forCandidateStudent">
                        <div class="form-floating">
                          <select class="form-select" id="subtopic" name="subtopic" aria-label="Floating label select Chapter">
                            <option value="" selected>Select Sub Topic</option>
                          </select>
                          <label for="subject">Sub Topic</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-floating">
                          <select class="form-select qpTypeNew" id="qpTypeNew" name="qpType" aria-label="Floating label select category">
                            <option selected value="">Select Type</option>
                            <?php 
                              $qpTypes = GetRecords("qp_master_qp_types", array("deleted"=>0));
                              foreach ($qpTypes as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                            <?php } ?>
                          </select>
                          <label for="qpType">Question Paper Type</label>
                        </div>
                      </div> 
                      <input type="hidden" name="qpTypeStu" id="qpType" value="2">
                      <!-- <div class="col-sm-2">
                        <div class="form-floating">
                          <select class="form-select qType" id="qType" name="qType" aria-label="Floating label select category">
                            <option selected value="">Select Type</option>
                            <?php 
                              $qpqTypes = GetRecords("qp_master_questiontypes", array("deleted"=>0));
                              foreach ($qpqTypes as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                            <?php } ?>
                          </select>
                          <label for="qpType">Question Type</label>
                        </div>
                      </div> -->
                      <div class="col-sm-2">
                        <div class="form-floating">
                          <select class="form-select qEvaluation" id="qEvaluation" name="qEvaluation" aria-label="Floating label select category">
                            <option selected value="">Select Type</option>
                            <?php 
                              $qpqTypes = GetRecords("qp_evaluation", array("deleted"=>0));
                              foreach ($qpqTypes as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                            <?php } ?>
                          </select>
                          <label for="qpType">Evaluation</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-floating">
                          <select class="form-select qPaperType" id="qPaperType" name="qPaperType" aria-label="Floating label select category">
                            <option selected value="">Select Type</option>
                            <?php 
                              $qpqTypes = GetRecords("qp_paper_display", array("deleted"=>0));
                              foreach ($qpqTypes as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                            <?php } ?>
                          </select>
                          <label for="qpType">Question Paper Display</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-floating mb-3 date">
                          <input type="text" name="publishdate" class="form-control publishdate from_to_date" id="publishdate" placeholder="Publish Date">
                          <label for="floatingInput">Publish Date</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-floating mb-3">
                          <input type="text" name="dueby" class="form-control dueby" id="dueby" placeholder="Due By">
                          <label for="floatingInput">Publish Time</label>
                        </div>
                      </div>
                     
                      <div class="col-sm-2">
                        <div class="form-floating mb-3">
                          <input type="text" name="timeAllow" class="form-control" id="floatingInput" placeholder="Time allowed (in minutes)">
                          <label for="floatingInput">Time allowed (In Minutes)</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-floating mb-3">
                          <input type="text" name="totMarks" value="0" class="form-control" id="totMarks" placeholder="Total Marks" disabled readonly>
                          <label for="totMarks">Total Marks</label>
                        </div>
                      </div>
                    </div>
                    <div class="row g-2 mb-3">
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="text" name="title" required="required" class="form-control" id="title" placeholder="Title">
                          <label for="title">Title</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-12">
                    <button class="btn btn-info float-end addSection" type="button"><i class="bi bi-plus"></i> Add Section</button>
                  </div>
                </div>

                <!-- Section start Append Here... -->
                <span class="qpSections"></span>
                <!-- Section End -->
              </div>
              <div class="card-footer text-center d-none" id="qpSubmitFooter">
                <button type="submit" name="submit" class="btn btn-info">Save &amp; Preview</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

<?php include 'evaluateAnswer.php' ?>
  
  <?php //include("../../componets/footer.php"); ?>
	<?php //include("../../componets/js.php"); ?>

  <script src="../../lib/jquery/jquery.js"></script>
  <script src="../../lib/popper.js/popper.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.js"></script>
  <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
  <script src="../../lib/moment/moment.js"></script>
  <script src="../../lib/jquery-ui/jquery-ui.js"></script>
  <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
  <script src="../../lib/peity/jquery.peity.js"></script>
  <script src="../../lib/highlightjs/highlight.pack.js"></script>
  <script src="../../lib/select2/js/select2.min.js"></script>
<!-- 
  <script src="../../js/cms.js"></script> -->

    
    <!-- Bootstrap bundle JS -->
  <script src="<?php echo $web_root ?>assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="<?php echo $web_root ?>assets/js/jquery.min.js"></script>
  <script src="<?php echo $web_root ?>lib/simplebar/js/simplebar.min.js"></script>
  <script src="<?php echo $web_root ?>lib/metismenu/js/metisMenu.min.js"></script>
  <script src="<?php echo $web_root ?>lib/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="<?php echo $web_root ?>lib/toast/toast.js"></script>
  <script src="<?php echo $web_root ?>assets/js/pace.min.js"></script>
  <!--app-->
  <script src="<?php echo $web_root ?>assets/js/app.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../lib/datatables/jquery.dataTables.js"></script>
    <script src="../../lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../lib/ckeditor/ckeditor.js"></script>
    <script src="../../lib/ckeditor/plugins/ckeditor_wiris/plugin.js"></script>
    <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
    <script src="../../js/appConfig.js"></script>
    <script src="../../js/qp/qustPaper.js"></script>
    <script src="../../js/assessment/assessment.js"></script>



</body>
</html>
