<?php
  // require_once "../session_token/checksession.php";
  // include "../configration/config.php";
  // require_once "../functions/db_functions.php";
  require_once "../functions/common_functions.php";
  require_once "functions/common_function.php";
  // require_once "../functions/classes.php";
  include_once "../session_token/checksession.php";
  include_once "../configration/config.php";
  include "../functions/db_functions.php";
  /*if(checkPageAccess(25, 5) !== true) {
    die;
  }*/
  $back_page = $web_root."app/create.php";
  $Classes = getCPClasses();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Virtual School</title>
    <link rel="icon" type="image/png" href="../../img/favicon.png" />

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
    <link rel="stylesheet" href="../../assets/css/QuestionBank/QuestionBank.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/ViewQuestions.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/s3viewqust.css">
    <link rel="stylesheet" href="../../assets/css/QuestionBank/s5deletequst.css">
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
      table.dataTable.no-footer {
        border-bottom: 1px solid #EFF2F5;
      }
      

    </style>
  </head>
  <body class="collapsed-menu">
    <!-- navbar -->
    <?php include("../fixed-blocks/header.php"); ?>

    <div class="mb-5 mb-lg-0">
  
      <div class="br-pagebody">
      <section id="questionbank" class="mt-4">
        <div class="card">
          <div class="card-header w-100 mb-4  d-flex align-items-center">
            <h6 class="flex-grow-1">Question Bank</h6>
            <a class="btn btn-primary mr-2" id="v-pills-addupload-tab" href="QuestionBank.php#v-pills-addupload" role="tab" aria-controls="v-pills-addupload" aria-selected="true">Add Questions</a>

            <!-- <a class="btn btn-primary active" id="v-pills-viewedit-tab" data-toggle="pill" href="#v-pills-viewedit" role="tab" aria-controls="v-pills-viewedit" aria-selected="false">View Questions</a> -->

            <!-- <button type="button" class="btn btn-md bg-grey px-5 border-0 font-weight-medium header_cancel_btn d-none">Cancel</button> -->
          </div>
          

          <!-- <div class="col-12" id="left_grid">
            <div id="tab_sidebar">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-addupload-tab" href="QuestionBank.php#v-pills-addupload" role="tab" aria-controls="v-pills-addupload" aria-selected="true">1. Add/Upload Questions</a>
                <a class="nav-link active" id="v-pills-viewedit-tab" data-toggle="pill" href="#v-pills-viewedit" role="tab" aria-controls="v-pills-viewedit" aria-selected="false">2. View/Edit Questions</a>
                <a class="nav-link" id="v-pills-cqp-tab" href="QuestionPaper.php#v-pills-cqp" role="tab" aria-controls="v-pills-cqp" aria-selected="false">3. Create Question Paper</a>
                <a class="nav-link" id="v-pills-veqp-tab" href="ViewQuestionPaper.php#v-pills-veqp" role="tab" aria-controls="v-pills-veqp" aria-selected="false">4. View/Edit Question Paper</a>
                <a class="nav-link" id="v-pills-pp-tab" href="PublishQuestionPaper.php#v-pills-pp" role="tab" aria-controls="v-pills-pp" aria-selected="false">5. Preview and Publish</a>
              </div>
            </div>
          </div> -->
          <div class="col-12" id="right_grid">
            <div class="tab-content h-100" id="v-pills-tabContent">
              <div class="tab-pane fade show active h-100" id="v-pills-viewedit" role="tabpanel" aria-labelledby="v-pills-viewedit-tab">
                <?php //include("sections/ViewEditQust/s1filters.php"); ?>
                <div class="row align-items-center justify-content-center h-100" id="viewedit_qust_blk">
              
              
                <div class="card">
                <div class="card-header align-items-center justify-content-center border-0">
                <!-- <h6 class="text-center mb-5 text-secondary">Select the class and subject under which you want to View/Edit Questions</h6> -->

                        <!-- <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">                               
                             title
                            </div>
                        </div> -->
                        <form id="s1filterform" class="col-12">
                          <div class="card-toolbar justify-content-center gap-2 ">
                              <div class="w-200px ">
                              <select class="form-control selectclass" id="selectedClass" name="selectedClass" required>
                                <option value="" selected>-Select Class-</option>
                                <?php
                                  foreach($Classes["classes"] as $thisClass) {
                                ?>
                                  <option value="<?php echo $thisClass['id'] ?>"><?php echo $thisClass['module'] ?></option>
                                <?php
                                  }
                                ?>
                              </select>
                              </div>
                            
                              <div class="w-200px">
                                <select class="form-control" id="selectedSubject" name="selectedSubject">
                                  <option value="">-Select Subject-</option>
                                </select>
                              </div>
                              <div class="w-200px">
                                <select class="form-control" id="course" name="course">
                                  <option value="">-Select Chapter-</option>
                                </select>
                              </div>
                              <div class="w-200px">
                                <select class="form-control" id="topic" name="topic">
                                  <option value="">-Select Topic-</option>
                                </select>
                              </div>
                              <div class="w-200px">
                                <select class="form-control" id="subtopic" name="subtopic">
                                  <option value="">-Select Sub Topic-</option>
                                </select>
                              </div>

                              <button type="submit" class="btn btn-md btn-blue px-5 shadow ">Go</button>

                          </div>
                        </from>
                    </div>
                </div>

              <!-- <form id="s1filterform" class="col-12">
                <div class="form-group row">
                  <label for="s1Class" class="col-sm-2 col-form-label text-right">Class</label>
                  <div class="col-sm-10">
                    <select class="form-control selectclass" id="selectedClass" name="selectedClass" required>
                      <option value="">-Select Class-</option>
                      <?php
                        foreach($Classes["classes"] as $thisClass) {
                      ?>
                        <option value="<?php echo $thisClass['id'] ?>"><?php echo $thisClass['module'] ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="s1Class" class="col-sm-2 col-form-label text-right">Subject</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="selectedSubject" name="selectedSubject">
                      <option value="">-Select Subject-</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="s1Class" class="col-sm-2 col-form-label text-right">Chapter</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="course" name="course">
                      <option value="">-Select Chapter-</option>
                    </select>
                  </div>
                </div>

                <div class="form-group text-center">
                  <button type="submit" class="btn btn-md btn-blue px-5 shadow mt-4">Go</button>
                </div>
              </form>     -->
            </div>

                <!-- <?php include("sections/ViewEditQust/s2qustlist.php"); ?> -->
                <div class="row align-items-center justify-content-center h-100 py-4" id="viewedit_qust_list">
                    <div class="col-12 p-0 h-100">
                      <div class="card">
                        <!-- <div class="card-header justify-content-center">
                          <h4 class="font-weight-bold m-0"><span id="filter_heading"></span></h4>
                        </div>
                         -->
                        <div class="card-body table-responsive">
                          <table id="qust_table" class="table" style="width:100%">
                            <thead>
                              <tr>
                                <th>Sub Topic</th>
                                <th>Question</th>
                                <th>Question Type</th>
                                <!-- <th>Question Category</th>
                                <th>Difficulty</th> -->
                                <th>Options</th>
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
            </div>
          </div>
        </div>
      </section>
    </div>
    </div>
    <!-- View Question Modal -->
    <?php //include("sections/ViewEditQust/s3viewqust.php"); ?>
    <!-- Modal -->
<div class="modal fade" id="viewQustModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content w-500px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mt-4">
        <h4 class="text-center mx-auto">View Question </h4>
        <div class="row justify-content-center" id="displayQuestion">
          <div class="col-12 mt-5 qust_option_max_width">
            <h5 class="text-center mb-3 font-weight-bold">What is the shape shown in the image below?</h5>
            <div class="d-flex flex-wrap justify-content-center qust_img">
              <img src="../../img/responsive_icon/desktop.svg" class="mr-3 mb-3">
              <img src="../../img/responsive_icon/desktop.svg" class="mr-3 mb-3">
            </div>
          </div>
          <div class="col-12 mt-3 options qust_option_max_width" id="mcq_type_options">
            <ol class="font-weight-bold">
              <li class="p-3">Circle</li>
              <li class="right_ans p-3">Triangle</li>
              <li class="p-3">Square</li>
            </ol>
          </div>

          <!-- Shot Descriptive -->
          <div class="col-12 mt-3 px-5" id="view_shot_descp_options">
            <h6 class="font-weight-bold">Answer</h6>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>

            <h6 class="font-weight-bold">Keywords</h6>
            <ol type="a" class="font-weight-bold">
              <li class="p-2">Circle</li>
              <li class="p-2">Triangle</li>
              <li class="p-2">Square</li>
            </ol>
          </div>

          <!-- Match the following -->
          <div class="col-12 mt-3 px-5" id="view_match_the_following">
            <div class="form-group w-100 mx-auto" id="match_qust_ans_section">
              <ol class="row p-0" id="match_header_blk">
                <li class="col-12 d-flex text-center" id="match_heading">
                  <input type="text" name="option" placeholder="Type here" value="Question" class="form-control border-0 text-center col-6 bg-transparent font-weight-bold" disabled="disabled">
                  <input type="text" name="option" placeholder="Type here" value="Answer" class="form-control border-0 text-center col-6 bg-transparent font-weight-bold" disabled="disabled">
                </li>
              </ol>

              <ol class="row">
                <li class="w-100 mb-3">
                  <div class="d-flex">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control mr-3" disabled="disabled">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control" disabled="disabled">
                  </div>
                </li>
                <li class="w-100 mb-3">
                  <div class="d-flex">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control mr-3" disabled="disabled">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control" disabled="disabled">
                  </div>
                </li>
                <li class="w-100 mb-3">
                  <div class="d-flex">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control mr-3" disabled="disabled">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control" disabled="disabled">
                  </div>
                </li>
                <li class="w-100 mb-3">
                  <div class="d-flex">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control mr-3" disabled="disabled">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control" disabled="disabled">
                  </div>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- Delete Question Modal -->
    <?php //include("sections/ViewEditQust/s5deletequst.php"); ?>
    <!-- Delete Confirmation Modal -->
<div class="modal fade" id="delteQustModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center px-5 py-5">
        <img src="../../img/alert.png" class="mb-2">
        <h4 class="font-weight-bold mb-3">Alert</h4>
        <p class="m-0 font-weight-bold">Are you sure you want to delete the question <span class="action_name"></span>? </p>
        <input type="hidden" id="delete_qid" value="">
        <div class="position-relative d-flex justify-content-center mt-5">
          <button class="btn btn-md btn-blue font-weight-medium yes_bth mr-4" id="delete_qust_yes">Yes</button>
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
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body"><span class="font-weight-bold m-0"></span></p>
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
    <script src="../../js/ViewQuestions.js"></script>
    <script src="../../js/s2qustlist.js"></script>
    <script src="../../js/s1filters.js"></script>
    <script src="../../js/s3viewqust.js"></script>
    <script src="../../js/s5deletequst.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        var classes = '';
        var subject = '';
        var courseid = '';
        var topic = '';
        var subtopic = '';
        $.ajax({
          type: "POST",
          url: "apis/questions_apis.php",
          data: "class=" + classes +"&subject=" + subject +"&course_id=" + courseid +"&topic=" + topic+"&subtopic=" + subtopic + "&type=displayQuestions",
          cache: false,
          success: function(data){
            data = JSON.parse(data);
            questionsList = data.Result;
            var table = $('#qust_table').dataTable({
                 "bProcessing": true,
                 "responsive": true,
                 "bDestroy": true,
                 "data": data.Result,
                 "aoColumns": [
                    { mData: 'Subtopic' } ,
                    { mData: 'QuestionPureText' },
                    { mData: 'qtype2' } ,
                    { mData: 'Action' }
                  ],
                  "aoColumnDefs": [
                    { "aTargets" : [3], sClass: '' }
                  ]
            });
            // new $.fn.dataTable.FixedHeader( table );
            $('.action_tooltip').tooltip({ boundary: 'window' });
          },
          beforeSend: function(){
            $("body").mLoading();
          },
          complete: function(){
            $("body").mLoading('hide');
          }
        });
      })
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