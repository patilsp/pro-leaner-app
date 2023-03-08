<?php
  require_once "../session_token/checksession.php";
  include "../configration/config.php";
  require_once "../functions/db_functions.php";
  // require_once "../functions/common_functions.php";
  require_once "../functions/questions.php";
  require_once "functions/common_function.php";
  /*if(checkPageAccess(25, 5) !== true) {
    die;
  }*/
  $Classes = getCPClasses();
  $qid = $_GET['id'];
  $questionDetails = GetQuestionDetail($qid);
  if(! isset($questionDetails['QuestionID'])) {
    header("location: ../home.php");
  }
  $back_page = $web_root."app/QuestionBank/ViewQuestions.php";
  // $Classes = getClasses();
  $mcategory = $questionDetails['QuestionMoodleCategory'];
  $info = GetRecord("question_categories", array("id"=>$mcategory));
  $course_id = $info['course_id'];
  $pms_qcategory_id = $info['pms_qcategory_id'];
  $pms_difficulty_id = $info['pms_difficulty_id'];
  if(!($questionDetails['qtype'] == "shortanswer")) {
    header("location: ../home.php");  
  }
  // $info = getHierarchy($course_id);
  $class = $info['class'];
  $subject_id = $info['subject'];
  $topic = $info['topic'];
  $subtopic = $info['subtopic'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>

    <!-- Common Styles -->
    <?php //include("../common-blocks/style.php"); ?>
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
    <link href="../../lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../assets/lib/DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="../../assets/css/QuestionBank/QuestionBank.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/qust_upload.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/add_qust_blk.css">
    <!-- <link rel="stylesheet" href="../../assets/css/QuestionBank/editqustmcqsa.css"> -->
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
      .form-control{
        height: auto !important;
      }
      .card .card-header{
        display: flex;
        justify-content: center !important;
      }
    </style>
  </head>
  <body class="collapsed-menu">
    <!-- navbar -->
    <?php //include("../common-blocks/navbar.php"); ?>
    <?php include("../fixed-blocks/left_sidebar.php"); ?>
    <?php include("../fixed-blocks/header.php"); ?>

    <div class="container-fluid mb-5 mb-lg-0 mt-5">
      <!-- breadcrumb -->
      <?php //include("../common-blocks/breadcrumb.php"); ?>

      <hr class="mt-0">
      <div class="br-pagebody">
      <section id="questionbank" class="mt-5">
        <div class="card">
          <div class="card-header w-100 mb-4 mx-3 d-flex align-items-center">
            <h5 class="flex-grow-1">Question Bank</h5>

            <a href="ViewQuestions.php" class="btn btn-md bg-grey px-5 border-0 font-weight-medium header_cancel_btn mr-4" id="QBCancel">Cancel</a>
            <button type="button" class="btn btn-md bg-grey px-5 border-0 font-weight-medium" id="QBSave">Save</button>
          </div>
          

          <!-- <div class="col-4" id="left_grid">
            <div id="tab_sidebar">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-addupload-tab" href="QuestionBank.php#v-pills-addupload" role="tab" aria-controls="v-pills-addupload" aria-selected="true">1. Add/Upload Questions</a>
                <a class="nav-link active" id="v-pills-viewedit-tab" data-toggle="pill" href="#v-pills-viewedit" role="tab" aria-controls="v-pills-viewedit" aria-selected="false">2. View/Edit Questions</a>
                <a class="nav-link" id="v-pills-cqp-tab" href="QuestionPaper.php#v-pills-cqp" role="tab" aria-controls="v-pills-cqp" aria-selected="false">3. Create Question Paper</a>
                <a class="nav-link" id="v-pills-veqp-tab" href="EditQuestionPaper#v-pills-veqp" role="tab" aria-controls="v-pills-veqp" aria-selected="false">4. View/Edit Question Paper</a>
                <a class="nav-link" id="v-pills-pp-tab" href="PublishQuestionPaper.php#v-pills-pp" role="tab" aria-controls="v-pills-pp" aria-selected="false">5. Preview and Publish</a>
              </div>
            </div>
          </div> -->
          <div class="col-12" id="right_grid">
            <div class="tab-content h-100" id="v-pills-tabContent">
              <div class="tab-pane fade show active h-100" id="v-pills-viewedit" role="tabpanel" aria-labelledby="v-pills-viewedit-tab">
                <div class="row align-items-center justify-content-center h-100" id="add_qust_blk">
                  <div class="col-12 p-0 h-100">
                    <div class="card">
                      <div class="card-header bg-white border-0">
                        <h5 class="font-weight-bold m-0">Edit Question</h5>
                      </div>
                      
                      <div class="card-body">
                        <input type="hidden" name="qid" id="qid" value="<?php echo $qid; ?>" class="qid" >
                        <div class="row">
                          <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
                            <label for="selectedClass" class="font-weight-bold required">Class</label>
                            <input type="hidden" name="buttonType" value="edit">
                            <select class="form-control selectclass" id="selectedClass" name="selectedClass" required>
                              <option value="">-Select Class-</option>
                              <?php
                                foreach($Classes["classes"] as $thisClass) {
                              ?>
                                <option value="<?php echo $thisClass['id'] ?>" <?php if($thisClass['id'] == $class) { ?> selected="selected" <?php } ?>><?php echo $thisClass['id'] ?></option>
                              <?php
                                }
                              ?>
                            </select>
                          </div>

                          <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
                            <label for="selectedSubject" class="font-weight-bold">Subject</label>
                            <select class="form-control" id="selectedSubject" name="selectedSubject">
                              <option value="">-Select Subject-</option>
                            </select>
                          </div>

                          <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
                            <label for="course" class="font-weight-bold">Chapter</label>
                            <select class="form-control" id="course" name="course">
                              <option value="">-Select Chapter-</option>
                            </select>
                          </div>
                          <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
                              <label for="course" class="font-weight-bold">Topic</label>
                              <select class="form-control" id="topic" name="topic">
                                <option value="">-Select Topic-</option>
                              </select>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
                              <label for="course" class="font-weight-bold">Sub Topic</label>
                              <select class="form-control" id="subtopic" name="subtopic">
                                <option value="">-Select Sub Topic-</option>
                              </select>
                            </div>
                          <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
                            <label for="category" class="font-weight-bold">Question Category</label>
                            <select class="form-control" id="category" name="category">
                              <option value="">-Select Category-</option>
                            </select>
                          </div>

                          <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
                            <label for="difficulty" class="font-weight-bold">Difficulty of Question</label>
                            <select class="form-control" id="difficulty" name="difficulty">
                              <option value="">-Select difficulty-</option>
                            </select>
                          </div>
                        </div>
                        <hr/>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group mt-3" style="max-width: 400px">
                              <label for="qtype_opt" class="font-weight-bold">Type of Question</label>
                              <select class="form-control qtype" id="qtype" name="qtype">
                                <option value="shortanswer">Descriptive</option>
                              </select>
                            </div>
                          </div>

                          <!-- ***************** Start Descriptive ******************-->
                          <div class="col-12 shortanswer questionDetail" id="descriptive_section">
                            <div class="form-group">
                              <label for="qust_txt" class="font-weight-bold">Question</label>
                              <div class="position-relative form-control p-2 QustEditer_blk">
                                <form id="descriptive-qust-img-upload-form" contenteditable="false">
                                  <input id="descriptive-qust-img-upload" name="file" type="file" accept="image/*"/>
                                </form>

                                <label class="btn btn-md border-0 bg-grey mt-3 ml-2 mb-2" contenteditable="false" for="descriptive-qust-img-upload"> Upload Image</label>
                                <hr/>
                                <label > Question:</label>
                                <textarea class="form-control textarea_custom" id="shortanswer_qustediter" name="questiontext" rows="4" cols="50" required="required"><?php echo $questionDetails['QuestionText']; ?></textarea>                      
                                <hr/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="qust_txt" class="font-weight-bold my-2">Answer Key</label>
                              <div class="position-relative p-2 answer_key">
                                <input type="hidden" name="oid[]" value="<?php echo $questionDetails['Answer']['OptionID']; ?>" class="option_id" >
                                <textarea class="form-control" placeholder="Please type the correct answer" id="shortanswer_answer" name="shortanswer_answer" rows="3"><?php echo $questionDetails['Answer']['OptionText']; ?></textarea>

                                <label class="font-weight-bold mt-4 mb-4">Keywords</label>
                                <div class="d-flex flex-wrap" id="id_keyword">
                                  <?php
                                  foreach($questionDetails['Options'] as $key=>$option) { ?>
                                  <div class="mr-3 mb-4 position-relative keyword_ip">
                                    <input type="hidden" name="oid[]" value="<?php echo $option['OptionID']; ?>" class="option_id" >
                                    <input type="text" size='10' name="sa_keyword[]" placeholder="Type here" value="<?php echo $option['OptionText']; ?>" class="form-control Keyword_input_box">
                                    <?php if($key > 0) { ?><span class='close_ip'></span> <?php } ?>
                                  </div>
                                  <?php } ?>
                                </div>
                                <div class="d-flex">
                                  <button type="button" class="btn btn-md btn-green px-3 border-0 font-weight-medium mr-4" id="add_keyword">Add</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- ***************** End Descriptive ******************-->
                        </div>
                      </div>
                      
                    </div>
                  </div>  
                </div>
              </div>
            </div>
          </div>
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
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body"> <span class="font-weight-bold m-0"></span> </p>
      </div>
    </div>
    <!-- common scripts -->
    <?php //include("../common-blocks/js.php"); ?>
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
    <script type="text/javascript" src="../../assets/lib/DataTables/datatables.min.js"></script>
    <script src="../../js/editqustmcqdescp.js"></script>
    <script type="text/javascript">
      var subject_id = "<?php echo $subject_id; ?>";
      var pms_difficulty_id = "<?php echo $pms_difficulty_id; ?>";
      var pms_qcategory_id = "<?php echo $pms_qcategory_id; ?>";
      var course_id = "<?php echo $course_id; ?>";
      var classes = "<?php echo $class; ?>";
      var topic = "<?php echo $topic; ?>";
      var subtopic = "<?php echo $subtopic; ?>";
    </script>
  </body>
</html>