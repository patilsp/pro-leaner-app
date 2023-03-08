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
    <link rel="stylesheet" type="text/css" href="../../assets/lib/DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="../../assets/css/QuestionBank/QuestionBank.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/PublishQuestionPaper.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/s3publishqpconfirmation.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/PublishQuestionPreviewPaper.css">

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

            <span class="d-none" id="CancelPublish">
              <button type="button" class="btn btn-md bg-grey px-5 border-0 font-weight-medium header_cancel_btn mr-4" id="QBCancel">Cancel</button>
              <button type="button" class="btn btn-md bg-blue text-white px-5 border-0 font-weight-medium pointer_event" id="QBPublish">Publish</button>
            </span>
          </header>
          

          <div class="col-4" id="left_grid">
            <div id="tab_sidebar">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-addupload-tab" href="QuestionBank.php#v-pills-addupload" role="tab" aria-controls="v-pills-addupload" aria-selected="true">1. Add/Upload Questions</a>
                <a class="nav-link" id="v-pills-viewedit-tab" href="ViewQuestions.php#v-pills-viewedit" role="tab" aria-controls="v-pills-viewedit" aria-selected="false">2. View/Edit Questions</a>
                <a class="nav-link" id="v-pills-cqp-tab" href="QuestionPaper.php#v-pills-cqp" role="tab" aria-controls="v-pills-cqp" aria-selected="false">3. Create Question Paper</a>
                <a class="nav-link" id="v-pills-veqp-tab" href="ViewQuestionPaper.php#v-pills-veqp" role="tab" aria-controls="v-pills-veqp" aria-selected="false">4. View/Edit Question Paper</a>
                <a class="nav-link active" id="v-pills-pp-tab" data-toggle="pill" href="#v-pills-pp" role="tab" aria-controls="v-pills-pp" aria-selected="false">5. Preview and Publish</a>
              </div>
            </div>
          </div>
          <div class="col-8" id="right_grid">
            <div class="tab-content h-100" id="v-pills-tabContent">
              <div class="tab-pane fade show active h-100" id="v-pills-viewedit" role="tabpanel" aria-labelledby="v-pills-viewedit-tab">
                <?php include("sections/PublishQustPaper/s1publishqpfilters.php"); ?>

                <?php include("sections/PublishQustPaper/s2publishqplist.php"); ?>

                <?php include("sections/PublishQustPaper/s3publishqppreview.php"); ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Delete Question Modal -->
    <?php include("sections/PublishQustPaper/s3publishqpconfirmation.php"); ?>

    <!-- Snackbar  -->
    <div id="snackbar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0" id="sb_heading">Notice!</h6>
        <button type="button" class="close close_snackbar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <p class="text-left" style="max-width: 250px; width: 100%; font-size: 18px" id="sb_body">You added <span class="font-weight-bold m-0">4 sections under Class 2</span> successfully</p>
      </div>
    </div>
    <!-- common scripts -->
    <?php include("../common-blocks/js.php"); ?>
    <script type="text/javascript" src="../../assets/lib/DataTables/datatables.min.js"></script>
    <script src="../../assets/js/PublishQuestionPaper.js"></script>
    <script src="../../assets/js/s2publishqplist.js"></script>
    <script src="../../assets/js/s1publishqpfilters.js"></script>
    <script src="../../assets/js/s3publishqpconfirmation.js"></script>
  </body>
</html>