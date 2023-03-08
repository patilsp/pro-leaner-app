<?php
  require_once "../session_token/checksession.php";
  include "../configration/config.php";
  require_once "../functions/db_functions.php";
  require_once "../functions/common_functions.php";
  require_once "../functions/classes.php";
  /*if(checkPageAccess(25, 5) !== true) {
    die;
  }*/
  $back_page = $web_root."app/create.php";
  $Classes = getClasses();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ILP - PMS</title>

    <!-- Common Styles -->
    <?php include("../common-blocks/style.php"); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/QuestionBank/QuestionBank.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/QuestionPaper.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/CancelConfirmPopup.css">
  </head>
  <body>
    <!-- navbar -->
    <?php include("../common-blocks/navbar.php"); ?>

    <div class="container mb-5 mb-lg-0">
      <!-- breadcrumb -->
      <?php include("../common-blocks/breadcrumb.php"); ?>

      <hr class="mt-0">

      <section id="questionbank" class="mt-5">
        <div class="row flex-column flex-md-row">
          <header class="w-100 mb-4 mx-3 d-flex align-items-center">
            <h5 class="flex-grow-1">Question Bank</h5>

            <button type="button" class="btn btn-md bg-grey px-5 border-0 font-weight-medium header_cancel_btn mr-4" id="QBCancel" >Reset</button>
            <button type="button" class="btn btn-md bg-grey px-5 border-0 font-weight-medium" id="QBSave">Save</button>
          </header>
          

          <div class="col-4" id="left_grid">
            <div id="tab_sidebar">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-addupload-tab" href="QuestionBank.php#v-pills-addupload" role="tab" aria-controls="v-pills-addupload" aria-selected="true">1. Add/Upload Questions</a>
                <a class="nav-link" id="v-pills-viewedit-tab" href="ViewQuestions.php" role="tab" aria-controls="v-pills-viewedit" aria-selected="false">2. View/Edit Questions</a>
                <a class="nav-link active" id="v-pills-cqp-tab" data-toggle="pill" href="#v-pills-cqp" role="tab" aria-controls="v-pills-cqp" aria-selected="false">3. Create Question Paper</a>
                <a class="nav-link" id="v-pills-veqp-tab" href="ViewQuestionPaper.php#v-pills-veqp" role="tab" aria-controls="v-pills-veqp" aria-selected="false">4. View/Edit Question Paper</a>
                <a class="nav-link" id="v-pills-pp-tab" href="PublishQuestionPaper.php#v-pills-pp" role="tab" aria-controls="v-pills-pp" aria-selected="false">5. Preview and Publish</a>
              </div>
            </div>
          </div>
          <div class="col-8" id="right_grid">
            <div class="tab-content h-100" id="v-pills-tabContent">
              <div class="tab-pane fade show active h-100" id="v-pills-cqp" role="tabpanel" aria-labelledby="v-pills-cqp-tab">
                <div class="row align-items-center justify-content-center h-100 py-4">
                  <?php include("sections/QuestionPaper/s1CreateQustFilters.php"); ?>

                  <?php include("sections/QuestionPaper/s1AddSection.php"); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- Add Qusestion Paper Modal -->
    <?php include("sections/QuestionPaper/s1AddQustPaperPopup.php"); ?>

    <!-- View Question Modal -->
    <?php include("sections/QuestionPaper/s1ViewQustPopup.php"); ?>

    <!-- Error Modal -->
    <?php include("sections/QuestionPaper/s1ErrorPopup.php"); ?>

    <!-- Cancel Confirmation Modal -->
    <?php include("sections/CancelConfirmPopup.php"); ?>

    <!-- Reset Modal -->
    <?php include("sections/QuestionPaper/s1ResetPopup.php"); ?>

    <!-- Snackbar  -->
    <div id="snackbar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0" id="sb_heading">Notice!</h6>
        <button type="button" class="close close_snackbar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body">You added <span class="font-weight-bold m-0">4 sections under Class 2</span> successfully</p>
      </div>
    </div>
    <!-- common scripts -->
    <?php include("../common-blocks/js.php"); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../../assets/js/QuestionPaper.js"></script>
    <script src="../../assets/js/ViewQuestions.js"></script>
    <script src="../../assets/js/QuestionPaperAddEditCommon.js"></script>
    <script type="text/javascript">
    <?php if(isset($_SESSION['sb_heading']))  { ?>
        $("#sb_heading").html("<?php echo $_SESSION['sb_heading']; ?>");
        $("#sb_body").html('<?php echo $_SESSION['sb_message']; ?>');
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, <?php echo $_SESSION['sb_time']; ?>);
      <?php unset($_SESSION['sb_heading']); } ?>
    </script>
  </body>
</html>