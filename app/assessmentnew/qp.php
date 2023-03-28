<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php";
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

  <title>Virtual School</title>
  <link rel="icon" type="image/png" href="../../img/favicon.png" />


  <!-- vendor css -->
  <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
  <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
  <link href="../../lib/highlightjs/github.css" rel="stylesheet">
  <link href="../../lib/datatables/jquery.dataTables.css" rel="stylesheet">
  <link href="../../lib/select2/css/select2.min.css" rel="stylesheet">

  <link rel="icon" type="image/png" href="/../img/favicon.png" />
  <link rel="stylesheet" href="../../css/cms.css">
  <link rel="stylesheet" href="../../lib/orgchart/jquery.orgchart.css?ver=231120211126">
  <link rel="stylesheet" href="<?php echo $web_root ?>assets/lib/bootstrap-4.5.0-dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<link rel="stylesheet" href="../../css/assignment.css">
    
  <!-- CMS CSS -->
  <link rel="stylesheet" href="../../css/cms.css">

</head>

<style type="text/css">




</style>

<body class="collapsed-menu">

  <!-- ########## START: LEFT PANEL ########## -->
  <?php include("../fixed-blocks/left_sidebar.php"); ?>
  <!-- ########## END: LEFT PANEL ########## -->

  <!-- ########## START: HEAD PANEL ########## -->
  <?php include("../fixed-blocks/header.php"); ?>
  <!-- ########## END: HEAD PANEL ########## -->

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="br-mainpanel">
    <div class="br-pagetitle">

    </div><!-- d-flex -->

    <div class="br-pagebody">
      <!-- start you own content here -->



      <div class="row new-row-bg">
        <div class="col-md-12">

          <div class="card h-100 d-flex flex-column justify-content-between mb-4">
            <div class="card-header">
              <h6 class="mg-b-0 tx-14 mt-4">Assessment</h6>
              <div class="card-option tx-24">
                <!-- <a href="userCreation.php" class="btn btn-md btn-info" >New User</a> -->
                <!-- <button class="btn btn-primary shadow" data-toggle="modal" data-target="#student_modal" id="add_student_bth">Add P</button> -->
              </div><!-- card-option -->
            </div><!-- card-header -->
            <div class="card-body">

              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-tabs nav-primary" role="tablist">
                    <!-- <li class="nav-item" role="presentation">
                      <a class="nav-link" data-bs-toggle="tab" href="#cqp" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                          <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                          </div>
                          <div class="tab-title">Create Question Paper1</div>
                        </div>
                      </a>
                    </li> -->
                    <!-- <li class="nav-item" role="presentation">
                      <a class="nav-link active" data-bs-toggle="tab" href="#veqp" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                          <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                          </div>
                          <div class="tab-title">View/Edit Question Paper</div>
                        </div>
                      </a>
                    </li> -->
                   
                    
                  </ul>
                  <div class="tab-content py-3">
                    
                    <div>
                      <button class="btn btn-primary shadow" data-toggle="modal" data-target="#test_edit_modal" id="add_student_bth">Add Question Paper</button>
                      <table id="viewEditQpListTable" class="table dataTable" style="width:100%">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Total Marks</th>
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
            </div><!-- card-body -->
          </div>
        </div>
      </div>
    </div><!-- br-pagebody -->
  </div><!-- br-mainpanel -->
  <div class="modal fade" id="test_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="text-center font-weight-bold w-100" id="model_title">heading</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <form id="qust_paper_form">
              <input type="hidden" name="questionIds[]" value="" class="questionIds">
              <div class="" id="main-container">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row g-2 mb-3">
                      <div class="col-md">
                        <div class="form-floating">
                          <select class="form-select qpType" id="qpType" name="qpType" aria-label="Floating label select category">
                            <option selected>Select Type</option>
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
                      <!-- for Candidate -->
                      <div class="col-md forCandidate d-none">
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
                      <div class="col-md forStudent d-none">
                        <div class="form-floating">
                          <select class="form-select classSelect" id="classess" name="classId" aria-label="Floating label select category">
                                      <option value="" selected>Select Class</option>
                                      <?php
                                      $classes = GetRecords("cpmodules", array("level" => 1,"visibility" => 1,"type" => "class"));
                                      foreach ($classes as $list) {
                                      ?>
                                        <option value="<?php echo $list['id']; ?>"><?php echo $list['module']; ?></option>
                                      <?php } ?>
                                    </select>
                          <label for="classess">Class</label>
                        </div>
                      </div>
                      <!-- End for Student -->

                      <div class="col-md forCandidateStudent d-none">
                        <div class="form-floating">
                         <select class="form-select" id="selectedSubject" name="classSubjectId" aria-label="Floating label select subject">
                                      <option value="" selected>Select Subject</option>
                                    </select>
                          <label for="subject">Subject</label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <input type="text" name="timeAllow" class="form-control" id="floatingInput" placeholder="Time allowed (in minutes)">
                          <label for="floatingInput">Time allowed (In Minutes)</label>
                        </div>
                      </div>
                      <div class="col-md">
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




  <!-- ########## END: MAIN PANEL ########## -->
  <?php include("../setup/common-blocks/js.php"); ?>
    <script src="../../lib/popper.js/popper.js"></script>
    <script src="../../lib/datatables/jquery.dataTables.js"></script>
    <script src="../../lib/datatables-responsive/dataTables.responsive.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<!--   
  <script src="../../js/cms.js"></script>

 -->
 <script src="../../js/qp/qustPaper.js"></script>

</body>

</html>