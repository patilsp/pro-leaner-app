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
            <div class="card mt-4" id="DDAnsTable">
              <div class="card-header">
                <div class="page-breadcrumb d-sm-flex align-items-center">
                  <div class="breadcrumb-title pe-3 border-0"></div>
                  <div class="ms-auto">
                    <button
                      class="btn btn-info DDAnsTable"
                      type="button"
                    >
                      Add Rows
                    </button> 
                  </div>
                </div>
              </div>
              <div class="card-body" id="ddType">
                <?php
                  $query = "SELECT * FROM qp_ddmatchqust WHERE qId=?";
                  $stmt = $db->prepare($query);
                  $stmt->execute(array($qustId));
                  $i=0;
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $i++;

                    $query1 = "SELECT * FROM qp_ddmatchans WHERE ddMatchQustId=?";
                    $stmt1 = $db->prepare($query1);
                    $stmt1->execute(array($row['id']));
                    while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="card-header cloneCardHeader">
                  <div class="page-breadcrumb d-sm-flex align-items-center">
                    <div class="breadcrumb-title pe-3 border-0">Row <?php echo $i; ?></div>
                    <div class="ms-auto"> <button type="button" data-editorInstance="<?php echo $i; ?>" class="btn btn-danger delete-editor-updateDDMatch float-end"><i class="fa fa-trash m-0"></i></button> </div>
                  </div>
                </div>
                <textarea name="editorDDTbQust[<?php echo $i; ?>]" class="editor1" id="editorDDTbQust<?php echo $i; ?>" rows="10" cols="80"><?php echo htmlspecialchars($row['qustCol']); ?></textarea>
                <textarea class="editor1" name="editorDDAns[<?php echo $i; ?>]" id="editorDDAns<?php echo $i; ?>" rows="10" cols="80"><?php echo htmlspecialchars($row1['ansCol']); ?></textarea>
              <?php } } ?>
              </div>
            </div>
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
  <script src="../../lib/select2/js/select2.min.js"></script>

  <script src="../../js/cms.js"></script>

  <script src="../../lib/ckeditor/ckeditor.js"></script>
  <script src="../../lib/ckeditor/plugins/ckeditor_wiris/plugin.js"></script>
  <script src="../../js/qb/editQust.js"></script>
  <script>

  </script>
</body>

</html>
