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

  <!-- CMS CSS -->
  <link rel="stylesheet" href="../../css/bootstrap-extended.css">

</head>
<body>
<?php
  $qustDetailsId = $_GET['qustId'];
  //get Qust Type
  $query = "SELECT * FROM qp_questiondetails WHERE id=?";
  $stmt = $db->prepare($query);
  $stmt->execute(array($qustDetailsId));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $qustType = 1;//$row['qustType'];

  //Get Question Content
  $query = "SELECT * FROM qp_questions WHERE qustDetailsId=?";
  $stmt = $db->prepare($query);
  $stmt->execute(array($qustDetailsId));
  $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
  $questionContent = $row1['question'];
  $qustId = $row1['id'];
?>
<div class="container-fluid">
  <div class="row">
    <form id="qust_form">
      <input type="hidden" name="question_details_id" value="<?php echo $qustDetailsId; ?>" />
      <input type="hidden" name="question_id" value="<?php echo $qustId; ?>" />
      <input type="hidden" name="type" value="update" />
      <div class="" id="main-container">
        <?php include('editcommon.php'); ?> 
        <div class="card qustCard">
          <div class="card-header">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center">
              <div class="breadcrumb-title pe-3 border-0">Question :</div>
            </div>
          </div>
          <div class="card-body">
            <textarea class="ckeditorQustBlk" id="qustIp" name="qustIp"><?php echo htmlspecialchars($questionContent); ?></textarea>
            <span class="nestedSAMCQ" id="nestedSAMCQ">
              <div class="card mt-4">
                <div class="card-header">
                  <div class="page-breadcrumb d-sm-flex align-items-center">
                    <div class="breadcrumb-title pe-3 border-0"></div>
                    <div class="ms-auto">
                      <div class="d-flex align-items-center">
                        <button class="btn btn-info nestedSA" type="button">Add ShortAnswer</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body" id="nestedSAType">
                  <?php
                    $saQusts = GetRecords("qp_nestedshortanser", array("qId"=>$qustId));
                    $i=0;
                    foreach ($saQusts as $saQust) {
                      $i++;
                  ?>
                    <div class="card-header cloneCardHeader">
                      <div class="page-breadcrumb d-sm-flex align-items-center">
                        <div class="breadcrumb-title pe-3 border-0">Question</div>
                        <div class="ms-auto"> <button type="button" data-editorInstance="<?php echo $i; ?>" class="btn btn-danger delete-editor-updateNSAMCQ float-end"><i class="fa fa-trash m-0"></i></button> </div>
                      </div>
                    </div>
                    <textarea class="editor1" id="editorNSAQust<?php echo $i; ?>" rows="10" cols="80"><?php echo $saQust['question']; ?></textarea>
                  <?php } ?>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header">
                  <div class="page-breadcrumb d-sm-flex align-items-center">
                    <div class="breadcrumb-title pe-3 border-0"></div>
                    <div class="ms-auto">
                      <div class="d-flex align-items-center">
                        <button class="btn btn-info nestedMCQ" type="button">Add MCQ</button>    
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body nestedMCQType" id="nestedMCQType">
                  <?php
                    $mcqQusts = GetRecords("qp_nestedmcqquestions", array("qId"=>$qustId));
                    $i=0;
                    $j=0;
                    foreach ($mcqQusts as $mcqQust) {
                      $i++;
                  ?>
                  <div class="card nestedMCQCard" id="nestedMcqCardBlk<?php echo $i; ?>">
                    <div class="card-header">
                      <div class="page-breadcrumb d-sm-flex align-items-center px-2">
                        <div class="pe-3 border-0">MCQ Question</div>
                        <div class="ms-auto"> <button type="button" data-cardBlk="nestedMcqCardBlk<?php echo $i; ?>" data-editorInstance="<?php echo $i; ?>" class="btn btn-danger delete-nested-mcq-editor-qustOptions-updateNSAMCQ"><i class="fa fa-trash m-0"></i></button> </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <textarea class="ckeditorTxt" id="nestedMcqQustEditor<?php echo $i; ?>"><?php echo $mcqQust['question']; ?></textarea>
                      <div class="card mt-4">
                        <div class="card-header">
                          <div class="page-breadcrumb d-sm-flex align-items-center">
                            <div class="breadcrumb-title pe-3 border-0">Add the options and mark the correct answer:</div>
                            <div class="ms-auto"> <button class="btn btn-info add-nested-options" data-id="nestedMCQOptCardBody<?php echo $i; ?>" type="button" > Add Options </button> </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="row mt-4 options-card-body" id="nestedMCQOptCardBody<?php echo $i; ?>">
                            <?php
                              $mcqOpts = GetRecords("qp_nestedmcqoptions", array("nestedmcqqId"=>$mcqQust['id']));
                              foreach ($mcqOpts as $mcqOpt) {
                                $j++;

                                $right = $wrong = "";
                                if($mcqOpt['correctAns'] == 1) {
                                  $right = "selected='selected'";
                                } else {
                                  $wrong = "selected='selected'";
                                }
                            ?>
                              <div class="col-6 position-relative editor mb-5">
                                <div class="page-breadcrumb d-sm-flex align-items-center shadow-lg px-2 py-3">
                                  <div class="pe-3 border-0">
                                    <div class="form-floating">
                                      <select class="form-select" name="optionStatus[]" id="floatingSelect" aria-label="Floating label select example">
                                        <option value="0" <?php echo $right; ?>>Wrong</option>
                                        <option value="1" <?php echo $right; ?>>Right</option>
                                      </select>
                                      <label for="floatingSelect">Option 1</label>
                                    </div>
                                  </div>
                                  <div class="ms-auto"><button type="button" data-editorInstance="<?php echo $j; ?>" class="btn btn-danger delete-nested-mcq-editor-option-updateNSAMCQ"><i class="fa fa-trash m-0"></i></button></div>
                                </div>
                                <textarea class="ckeditorOptTxt" id="nestedMcqOptEditor<?php echo $j; ?>"><?php echo $mcqOpt['optionContent']; ?></textarea>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </span>
          </div>
          <?php
            if (checkUserAccess($user_id,$role_id,55) == "true") {
            ?>
          <div class="card-footer text-center">
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
          </div>
          <?php
            }
          ?>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- View Question Modal -->
<div class="modal fade" id="viewQuestion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">View Question </h5>
        <?php if(!isset($_GET['updateView'])) { ?>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <?php } ?>
      </div>
      <div class="modal-body" id="bindHTMLView"></div>
    </div>
  </div>
</div>
	
	<?php include("../../componets/js.php"); ?>
  <script src="../../lib/ckeditor/ckeditor.js"></script>
  <script src="../../lib/ckeditor/plugins/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
  <script src="../../js/appConfig.js"></script>
  <script src="../../js/qb/editQust.js"></script>
</body>
</html>
