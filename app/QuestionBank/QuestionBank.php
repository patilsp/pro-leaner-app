<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
include "../functions/db_functions.php";
include "functions/common_function.php";
  // require_once "../functions/classes.php";
  /*if(checkPageAccess(25, 5) !== true) {
    die;
  }*/
  $token=$_SESSION['token'];
  $logged_user_id=$_SESSION['cms_userid'];
  $user_type = $_SESSION['cms_usertype'];
  $role_id = $_SESSION['user_role_id'];
  $back_page = $web_root."app/create.php";
  $Classes = [];
  $classList = getCPClasses();

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
    <link rel="stylesheet" href="../../assets/css/QuestionBank/QuestionBank.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/qust_upload.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/add_qust_blk.css">
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


      .card .card-header{
        display: flex;
        justify-content: center !important;
      }
      
    </style>
  </head>
  <body class="collapsed-menu">
    <!-- navbar -->
    <?php include("../fixed-blocks/left_sidebar.php"); ?>
    <?php include("../fixed-blocks/header.php"); ?>

    <div class="container-fluid mb-5 mb-lg-0">
      <!-- breadcrumb -->
      <?php //include("../common-blocks/breadcrumb.php"); ?>

      <hr class="mt-0">
       <div class="br-pagebody">
      <section id="questionbank" class="mt-5">
        <div class="card">
          <div class="card-header w-100 mb-4 d-flex align-items-center">
            <h6 class="flex-grow-1">Question Bank</h6>
            <a class="btn btn-primary mr-2" id="v-pills-viewedit-tab" href="ViewQuestions.php#v-pills-viewedit" role="tab" aria-controls="v-pills-viewedit" aria-selected="false">View Questions</a>

            <button type="button" class="btn btn-md bg-grey px-5 border-0 font-weight-medium header_cancel_btn d-none">Cancel</button>

           
          </div>
          

          <!-- <div class="col-12" id="left_grid">
            <div id="tab_sidebar">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-addupload-tab" data-toggle="pill" href="#v-pills-addupload" role="tab" aria-controls="v-pills-addupload" aria-selected="true">1. Add/Upload Questions</a>
                <a class="nav-link" id="v-pills-viewedit-tab" href="ViewQuestions.php#v-pills-viewedit" role="tab" aria-controls="v-pills-viewedit" aria-selected="false">2. View/Edit Questions</a>
                <a class="nav-link" id="v-pills-cqp-tab" href="QuestionPaper.php#v-pills-cqp" role="tab" aria-controls="v-pills-cqp" aria-selected="false">3. Create Question Paper</a>
                <a class="nav-link" id="v-pills-veqp-tab" href="ViewQuestionPaper.php#v-pills-veqp" role="tab" aria-controls="v-pills-veqp" aria-selected="false">4. View/Edit Question Paper</a>
                <a class="nav-link" id="v-pills-pp-tab" href="PublishQuestionPaper.php#v-pills-pp" role="tab" aria-controls="v-pills-pp" aria-selected="false">5. Preview and Publish</a> 
              </div>
            </div>
          </div> -->
          <div class="col-12" id="right_grid">
            <div class="tab-content h-100" id="v-pills-tabContent">
              <div class="tab-pane fade show active h-100" id="v-pills-addupload" role="tabpanel" aria-labelledby="v-pills-addupload-tab">
                <span class="step1">
                 
                

                <div class="row align-items-center justify-content-center h-100 " id="add_qust_blk">
	
                    <div class="col-12 p-0 h-100">
                      <div class="card">
                        <div class="card-header border-0">
                          <h5 class="font-weight-bold m-0 align-items-center justify-content-center">Add a Question</h5>
                        </div>
                        
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
                              <label for="selectedClass" class="font-weight-bold required">Class</label>
                              <select class="form-control selectclass" id="selectedClass" name="selectedClass" required>
                                <option value="">-Select Class-</option>
                              <?php foreach ($classList["classes"] as $key=>$classValue){ ?>
                                          <option value="<?php echo $classValue['id']; ?>"><?php echo $classValue['module'];?></option>
                                          <?php } ?>
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
                                <option value="">-Select Difficulty-</option>
                              </select>
                            </div>
                          </div>
                          <hr/>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group mt-3" style="max-width: 400px">
                                <label for="qtype_opt" class="font-weight-bold">Type of Question</label>
                                <select class="form-control qtype" id="qtype" name="qtype">
                                  <option value="">-Select type-</option>
                                  <option value="multichoice">MCQ with Single Answer </option>
                                  <option value="multichoicem">MCQ with Multiple Answers</option>
                                  <!-- <option value="3">Fill in the Blanks</option> -->
                                  <option value="shortanswer">Descriptive</option>
                                  <option value="ddmatch">Match the Following</option>
                                </select>
                              </div>
                            </div>

                            <!-- ***************** Start fill_blank_section ******************-->
                            <div class="col-12 d-none fillblank questionDetail" id="fill_blank_section">
                              <div class="form-group">
                                <label for="qust_txt" class="font-weight-bold">Question</label>
                                <div class="container p-0" id="QustEditer_blk">
                                  <h6 class="p-2" contenteditable="true" placeholder="enter text here..." id="QustEditer">qwdwqedwqe
                                  <span style="padding: 0px 50px; border-bottom: 1px solid; position: relative; margin: 0px 1rem"><span class="close_ip"></span></span>
                                  edewdwe</h6>
                                  
                                  <button class="btn btn-md border-0 bg-grey position-absolute ml-2 mb-2" contenteditable="false" id="ins_blank_btn">Insert Blank</button>
                                </div>

                                <div id="caretposition">0</div>
                              </div>
                            </div>
                            <!-- ***************** End fill_blank_section ******************-->

                            <!-- ***************** Start MCQ with Single Answer ******************-->
                            <div class="col-12 d-none multichoice questionDetail" id="mcq_radio_section">
                              <div class="form-group">
                                <label for="qust_txt" class="font-weight-bold">Question</label>
                                <div class="container p-2 QustEditer_blk">
                                  <!-- <div class="QustEditer" id="multichoice_qustediter" name="questiontext" contenteditable="true" placeholder="enter text here...">
                                    <br />
                                    <div class="row mt-4 mx-2 QustImg" id="macqRadioQustImg" contenteditable="false"></div>
                                  </div> -->
                                  
                                  <form id="qust-img-upload-form" contenteditable="false">
                                    <input id="qust-img-upload" name="file" type="file" accept="image/*"/>
                                  </form>

                                  <label class="btn btn-md border-0 bg-grey mt-3 ml-2 mb-2" contenteditable="false" for="qust-img-upload"> Upload Image</label>

                                  <hr/>
                                  <label > Question:</label>
                                  <textarea class="form-control textarea_custom" id="multichoice_qustediter" name="questiontext" rows="4" cols="50" required="required"></textarea>                      
                                  <hr/>

                                  <header class="w-100 mb-4 d-flex align-items-center">
                                    <h5 class="flex-grow-1">Add the choices and mark the correct answer </h5>

                                    <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium mr-4" id="add_macqRadio_text">Add Text Choice</button>
                                    <form id="mcopt-img-upload-form" contenteditable="false">
                                      <input id="mcopt-img-upload" name="file" type="file" accept="image/*"/>
                                    </form>
                                    <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium" id="add_macqRadio_img"><label class="mb-0" for="mcopt-img-upload">Add Image Choice</label></button>
                                  </header>
                                  <div class="row" contenteditable="false" id="mcq_radio_options">
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- ***************** End MCQ with Single Answer ******************-->

                            <!-- ***************** Start MCQ with Multiple Answer ******************-->
                            <div class="col-12 d-none multichoicem questionDetail" id="mcq_Checkbox_section">
                              <div class="form-group">
                                <label for="qust_txt" class="font-weight-bold">Question</label>
                                <div class="container p-2 QustEditer_blk">
                                  <!-- <div class="QustEditer" id="multichoicem_qustediter" contenteditable="true" placeholder="enter text here...">
                                    <br/>
                                    <div class="row mt-4 mx-2 QustImg" id="macqCheckboxQustImg" contenteditable="false"></div>
                                  </div> -->
                                  
                                  <form id="qust-checkbox-img-upload-form" contenteditable="false">
                                    <input id="qust-checkbox-img-upload" name="file" type="file" accept="image/*"/>
                                  </form>

                                  <label class="btn btn-md border-0 bg-grey mt-3 ml-2 mb-2" contenteditable="false" for="qust-checkbox-img-upload"> Upload Image</label>

                                  <hr/>
                                  <label > Question:</label>
                                  <textarea class="form-control textarea_custom" id="multichoicem_qustediter" name="questiontext" rows="4" cols="50" required="required"></textarea>                      
                                  <hr/>

                                  <header class="w-100 mb-4 d-flex align-items-center">
                                    <h5 class="flex-grow-1">Add the choices and mark the correct answer </h5>

                                    <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium mr-4" id="add_macqCheckbox_text">Add Text Choice</button>
                                    <form id="mcmopt-img-upload-form" contenteditable="false">
                                      <input id="mcmopt-img-upload" name="file" type="file" accept="image/*"/>
                                    </form>
                                    <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium" id="add_macqCheckbox_img">Add Image Choice</button>
                                  </header>
                                  <div class="row" contenteditable="false" id="mcq_checkbox_options">
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- ***************** End MCQ with Multiple Answer ******************-->

                            <!-- ***************** Start Descriptive ******************-->
                            <div class="col-12 d-none shortanswer questionDetail" id="descriptive_section">
                              <div class="form-group">
                                <label for="qust_txt" class="font-weight-bold">Question</label>
                                <div class="container p-2 QustEditer_blk">
                                  <!-- <div class="QustEditer" id="shortanswer_qustediter" contenteditable="true" placeholder="enter text here...">
                                    <br/>
                                    <div class="row mt-4 mx-2 QustImg" id="shotQustImg" contenteditable="false"></div>
                                  </div> -->
                                  
                                  <form id="descriptive-qust-img-upload-form" contenteditable="false">
                                    <input id="descriptive-qust-img-upload" name="file" type="file" accept="image/*"/>
                                  </form>

                                  <label class="btn btn-md border-0 bg-grey mt-3 ml-2 mb-2" contenteditable="false" for="descriptive-qust-img-upload"> Upload Image</label>
                                </div>
                              </div>
                              <hr/>
                                  <label > Question:</label>
                                  <textarea class="form-control textarea_custom" id="shortanswer_qustediter" name="questiontext" rows="4" cols="50" required="required"></textarea>                      
                                  <hr/>

                              <div class="form-group">
                                <label for="qust_txt" class="font-weight-bold my-2">Answer Key</label>
                                <div class="position-relative p-2 answer_key">
                                  <textarea class="form-control" placeholder="Please type the correct answer" id="shortanswer_answer" name="shortanswer_answer" rows="3"></textarea>

                                  <label class="font-weight-bold mt-4 mb-4">Keywords</label>
                                  <div class="d-flex flex-wrap" id="id_keyword">
                                    <div class="mr-3 mb-4 position-relative keyword_ip">
                                      <input type="text" size='20' name="sa_keyword[]" placeholder="Type here" value="" class="form-control Keyword_input_box">
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium mr-4" id="add_keyword"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- ***************** End Descriptive ******************-->

                            <!-- ***************** Start Match the Following ******************-->
                            <div class="col-12 d-none ddmatch questionDetail" id="match_section">
                              <div class="form-group">
                                <label class="font-weight-bold">Question Title</label>
                                <textarea class="form-control" id="ddmatch_qustediter" name="ddmatch_qustediter" placeholder="Type here" rows="1"></textarea>
                              </div>

                              <div class="form-group w-100 mx-auto" id="match_qust_ans_section">
                                <ol class="row p-0" id="match_header_blk">
                                  <li class="col-12 d-flex text-center" id="match_heading">
                                    <input type="text" placeholder="Type here" value="Question" class="form-control border-0 text-center col-6" disabled="disabled">
                                    <input type="text" placeholder="Type here" value="Answer" class="form-control border-0 text-center col-6" disabled="disabled">
                                  </li>
                                </ol>

                                <ol class="row" id="ol_qust_ans">
                                  <li class="w-100 mb-3 li_qust_ans">
                                    <div class="d-flex position-relative">
                                      <input type="text" name="subquestiontext[]" placeholder="Type here" value="" class="form-control mr-3 subquestiontext">
                                      <input type="text" name="answertext[]" placeholder="Type here" value="" class="form-control answertext">
                                    </div>
                                  </li>
                                </ol>

                                <div class="row justify-content-center">
                                  <button type="button" id="add_match_qust_ans" class="btn btn-md btn-success px-3 font-weight-medium w-150px">Add Question</button>
                                </div>
                              </div>

                              <div class="form-group">
                              <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
         
                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                                </svg>
                                </span>

                                  <div class="d-flex flex-stack flex-grow-1 "> 
                                    <div class=" fw-semibold">
                                      <h4 class="text-gray-900 fw-bold">Note!</h4>
                                      <div class="fs-6 text-gray-700 ">Please type the corresponding answer to each question. The questions will be automatically jumbled when in a question paper.</div>
                                    </div>
                                  </div>

                                </div>
                                <!-- <label class="font-weight-bold">Note:</label>
                                <p>Please type the corresponding answer to each question. The questions will be automatically jumbled when in a question paper.</p> -->
                              </div>
                            </div>
                            <!-- ***************** End Match the Following ******************-->
                          </div>
                          
                        </div>
                        
                      </div>
                      <hr/>
                       <span id="1CancelSave" class="w-100 mb-4 d-flex align-items-center justify-content-center">
                          <button type="button" class="btn btn-danger border-0 font-weight-medium header_cancel_btn mr-4" id="QBCancel-new">Cancel</button>
                          <button type="button" class="btn btn-primary px-5 border-0 font-weight-medium" id="QBSave">Save</button>
                        </span>
                        
                    </div>	
                  </div>
                
                  </span>
                  <span class="upload_qust_span">
                  <?php //include("sections/AddUploadQust/add_qust_blk.php"); ?>

                  <?php include("sections/AddUploadQust/upload_qust_blk.php"); ?>
                </span>

                <span class="add_qust_span">

                </span>
              </div>
              <div class="tab-pane fade" id="v-pills-viewedit" role="tabpanel" aria-labelledby="v-pills-viewedit-tab">
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
        <p class="text-left" style="max-width: 250px; width: 100%" id="sb_body"><span class="font-weight-bold m-0"></span></p>
      </div>
    </div>
    <!-- common scripts -->
    <?php //include("../common-blocks/js.php"); ?>
    <?php include("../setup/common-blocks/js.php"); ?>
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
    <script src="../../js/QuestionBank.js"></script>
    <script src="../../js/QuestionBankUpload.js"></script>
    <script src="../../js/add_qust_blk.js"></script>
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