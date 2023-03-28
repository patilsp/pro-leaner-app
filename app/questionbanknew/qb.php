<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php";
require_once "../setup/functions/common_function.php";
require_once "../functions/common_functions.php";
$Classes = getCPClasses();

$user_id = $_SESSION['cms_userid'];
$role_id = $_SESSION['user_role_id'];
$access = checkUserAccess($user_id,$role_id,48);
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
  <!-- <link href="../../lib/select2/css/select2.min.css" rel="stylesheet"> -->
  <!-- CMS CSS -->
  <link rel="stylesheet" href="../../css/cms.css">

</head>

<style type="text/css">
  .view-icon {
    background-color: #e8fadf !important;
    color: #71dd37 !important;
    padding: 8px;
    height: 38px;
    width: 38px;
    border-radius: 50%;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice{
    margin-top:20px !important
  }
  .select2-selection--multiple {
    outline: 0;
    padding-top: 0.525rem;
    border: 1px solid #E4E6EF !important;
}

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
              <h6 class="mg-b-0 tx-14 mt-4">Question Bank</h6>
              <?php
              if (checkUserAccess($user_id,$role_id,56) == "true") {
                ?>
              <div class="card-option tx-24">
                <!-- <a href="userCreation.php" class="btn btn-md btn-info" >New User</a> -->
                <button class="btn btn-primary shadow" data-toggle="modal" data-target="#createQuestion" id="add_student_bth">Add New Question </button>
              </div><!-- card-option -->
              <?php
              }
              ?>
            </div><!-- card-header -->
            <div class="card-body">

              <div class="card">
                <div class="card-header align-items-center justify-content-center border-0">

                
                    <div class="card-toolbar justify-content-center gap-2 ">
                      <div class="w-200px ">
                        <select class="form-control selectclass" id="selectedClass_filter" name="selectedClass_filter">
                          <option value="" selected>-Select Class-</option>
                          <?php
                          foreach ($Classes["classes"] as $thisClass) {
                          ?>
                            <option value="<?php echo $thisClass['id'] ?>"><?php echo $thisClass['module'] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>

                      <div class="w-200px">
                        <select class="form-control" id="selectedSubject_filter" name="selectedSubject_filter" >
                          <option value="">-Select Subject-</option>
                        </select>
                      </div>
                      <div class="w-200px">
                        <select class="form-control" id="course_filter" name="course_filter">
                          <option value="">-Select Chapter-</option>
                        </select>
                      </div>
                      <div class="w-200px">
                        <select class="form-control" id="topic_filter" name="topic_filter">
                          <option value="">-Select Topic-</option>
                        </select>
                      </div>
                      <div class="w-200px">
                        <select class="form-control" id="subtopic_filter" name="subtopic_filter">
                          <option value="">-Select Sub Topic-</option>
                        </select>
                      </div>

                      <button type="submit" class="btn btn-md btn-blue px-5 shadow questionfilters">Go</button>

                    </div>
                  
                </div>
              </div>

              <div class="card">
                <div class="card-body">
                  <div id="qustionbank">
                    <div class="row">
                      <table id="QuestionListTable" id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Question</th>
                            <th>Type</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div><!--end row-->
                  </div>

                </div>
              </div>
            </div><!-- card-body -->
          </div>
        </div>
      </div>
    </div><!-- br-pagebody -->
  </div><!-- br-mainpanel -->



  <!-- Snackbar  -->
  <div id="snackbar">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h6 class="m-0" id="sb_heading"></h6>
      <button type="button" class="close close_snackbar">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="d-flex justify-content-between align-items-center">
      <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body"><span class="font-weight-bold m-0">Successfully Deleted</p>
    </div>
  </div>

  <!-- Preview Question Modal -->
  <div class="modal fade" id="previewQuestion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">View Question </h5>
          <button type="button" class="btn-close addNewQust" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="bindHTML"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary addNewQust" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary addNewQust" id="addNewQust">Add New Question</button>
        </div>
      </div>
    </div>
  </div>

  <!-- View Question Modal -->
  <div class="modal fade" id="viewQuestion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">View Question </h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="bindHTMLView"></div>
      </div>
    </div>
  </div>

  <!-- Edit Question Modal -->
  <div class="modal fade" id="editQuestion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">Edit Question </h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="bindHTMLEdit"></div>
      </div>
    </div>
  </div>


  <!-- Create Question Modal -->
  <div class="modal fade" id="createQuestion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">Create Question </h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="bindHTMLCreate">

          <form id="qust_form">
            <div class="" id="main-container">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row g-3 mb-3">
                    <div class="col-sm-3">
                      <div class="form-floating">
                        <select class="form-select classSelect" id="classess" name="classId" aria-label="Floating label select category">
                          <option selected>Select Class</option>
                          <?php
                          $classes = GetRecords("cpmodules", array("level" => 1));
                          foreach ($classes as $list) {
                          ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['module']; ?></option>
                          <?php } ?>
                        </select>
                        <label for="classess">Class <span class="required_icon" style="color:red;">*</span></label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-floating">
                        <select class="form-select" id="subject" name="classSubjectId" aria-label="Floating label select subject">
                          <option selected>Select Subject</option>
                        </select>
                        <label for="subject">Subject <span class="required_icon" style="color:red;">*</span></label>
                      </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-floating">
                          <select class="form-select" id="course" name="course" aria-label="Floating label select Chapter">
                            <option value="" selected>Select Chapter</option>
                          </select>
                          <label for="subject">Chapter <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating">
                          <select class="form-select" id="topic" name="topic" aria-label="Floating label select Chapter">
                            <option value="" selected>Select Topic</option>
                          </select>
                          <label for="subject">Topic <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating">
                          <select class="form-select" id="subtopic" name="subtopic" aria-label="Floating label select Chapter">
                            <option value="" selected>Select Sub Topic</option>
                          </select>
                          <label for="subject">Sub Topic <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating">
                   
                          <select class="form-select" id="difficultyType" name="difficultyType" aria-label="Floating label select difficultyType">
                            <option  selected>Select Type</option>
                             
                            <?php 
                              $qpTypes = GetRecords("qp_master_difficulty", array("deleted"=>0));
                              
                              foreach ($qpTypes as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                            <?php } ?>
                           
                          </select>
                          <label for="difficultyType">Difficulty <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>

                     
                      <div class="col-sm-3">
                        <div class="form-floating mb-3">
                          <input type="text" name="quesMarks" value="0" class="form-control" id="quesMarks" placeholder="Total Marks">
                          <label for="quesMarks">Total Marks <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" name="noTimes" id="noTimes" placeholder="No of Times">
                          <label for="noTimes"> No of Times <span class="required_icon" style="color:red;">*</span></label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-floating">
                       
                          <select class="form-select multiselect" id="assesType" name="assesType[]" aria-label="Floating label select Type"  style="width: 100%" multiple="multiple">
                          
                            <option value="" selected>-Select Type-</option>
                            <?php 
                              $qpTypes = GetRecords("qp_master_qp_types", array("deleted"=>0));
                              foreach ($qpTypes as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                            <?php } ?>
        

                          </select>
                          <label for="assesType">Type of Assessment <span class="required_icon" style="color:red;">*</span></label>

                        </div>
                      </div>
                     
                      <div class="col-sm-6">
                      <div class="form-floating">
                        <select class="form-select" id="TypeofQuestion" name="qustType" aria-label="Floating label select Type of Question">
                          <option value="">-Select type-</option>
                          <?php
                          $query = "SELECT * FROM qp_master_questiontypes WHERE deleted=?";
                          $stmt = $db->prepare($query);
                          $stmt->execute(array(0));
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                        <label for="TypeofQuestion" class="mandatory">Type of Question <span class="required_icon" style="color:red;">*</span></label>
                      </div>
                    </div>
                    </div>




                   
                  </div>
                </div>
              </div>
              <div class="card qustCard">
                <div class="card-header">
                  <div class="page-breadcrumb d-none d-sm-flex align-items-center">
                    <div class="breadcrumb-title pe-3 border-0 mandatory">Question :</div>
                  </div>
                </div>
                <div class="card-body">
                  <textarea class="ckeditorQustBlk" id="qustIp" name="qustIp"></textarea>
                  <?php include("componets/mcq.php"); ?>
                  <?php include("componets/shortAnsTable.php"); ?>
                  <?php include("componets/ddMatch.php"); ?>
                  <?php include("componets/shortAns.php"); ?>
                  <?php include("componets/fillInTheBlank.php"); ?>
                  <?php include("componets/shortAnsAndMcq.php"); ?>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Save &amp; Preview</button>
                  <button type="button" class="btn btn-secondary addNewQust" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- ########## END: MAIN PANEL ########## -->
  <script src="../../lib/jquery/jquery.js"></script>
  <script src="../../lib/popper.js/popper.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.js"></script>
  <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
  <script src="../../lib/moment/moment.js"></script>
  <script src="../../lib/jquery-ui/jquery-ui.js"></script>
  <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
  <script src="../../lib/peity/jquery.peity.js"></script>
  <script src="../../lib/highlightjs/highlight.pack.js"></script>
  <script src="../../lib/datatables/jquery.dataTables.js"></script>
  <script src="../../lib/datatables-responsive/dataTables.responsive.js"></script>
  <!-- <script src="../../lib/select2/js/select2.min.js"></script> -->
  <script src="../../lib/ajax_loader/jquery.mloading.js"></script>
  <script src="../../js/cms.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

  <script src="../../lib/ckeditor/ckeditor.js"></script>
  <script src="../../lib/ckeditor/plugins/ckeditor_wiris/plugin.js"></script>
  <script src="../../js/qb/addQust.js?ver=133204102021"></script>
  <script src="../../js/qb/questionbank.js"></script>
  
  <script>

  </script>
</body>

</html>