<?php

  require_once "../functions/common_functions.php";
  include_once "../session_token/checksession.php";
  include_once "../configration/config.php";
  include "../functions/db_functions.php";
  require_once "../functions/assignments.php";

  include "../functions/questions.php";  // include $_SESSION['dir_root']."app/transactions/conceptprep/functions/common_function.php";
  $back_page = $web_root."app/Assignment/assignment_apis.php";
  $back_page = $web_root."app/Assignment/assignment_function.php";
  // $Classes = getCPClasses();
  include "functions/common_function.php";
  $assignments = GetAssignmentsList();

  $classList = getCPClasses();
  $subjectList = getCPSubjects();
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Virtual School</title>
    <link rel="icon" type="image/png" href="/../img/favicon.png" />

    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
    <link rel="stylesheet" href="../../lib/orgchart/jquery.orgchart.css?ver=231120211126">
    <link rel="stylesheet" href="<?php echo $web_root ?>assets/lib/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <link href="../../lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/assignment.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
 

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
      .input-group span{
        background-color: #F5F8FA !important;
      }
      .fa-black{
        color: #A1A5B7 !important;
      }

        
    .table_responsive{
      max-height: 525px !important;
      overflow: auto;
    }
    .p-16{
      padding: 16px 10px !important;
    }

    </style>
  </head>
  <body class="collapsed-menu">
  	<!-- navbar -->

    <?php include("../fixed-blocks/header.php"); ?>

    <div class="container-fluid mb-5 mb-lg-0 mt-4">
      <div class="br-pagebody">
        <div class="row new-row-bg">
          <div class="col-md-12">              
              <section id="questionbank">
                <div class="card">
                  <div class="card-header w-100 mb-4 mx-3 d-flex align-items-center">
                    <h5 class="flex-grow-1">Assignment</h5>
                      <button type="button" class="btn btn-primary px-3 border-0 font-weight-medium cancel_btn mr-4" id="CreateAssnmt" data-toggle="modal" data-target="#create_assignment_modal">Create Assignment</button>  
                      
                  </div>
                  <div class ="sec_head"> 
                  </div>

                  <div class="col-12 bg-transparent" id="right_grid">
                    <div class="tab-content h-100" id="v-pills-tabContent">
                      <div class="tab-pane fade show active h-100" id="v-pills-cqp" role="tabpanel" aria-labelledby="v-pills-cqp-tab">
                        <div class="row align-items-center justify-content-center h-100 py-4">
                          <div class="col-12">
                            <div class="col-12 table-responsive">
                              <table id="filter_table" class="table" style="width:100%">
                                <thead>
                                  <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Attachement</th>
                                    <!-- <th>Link</th> -->
                                    <th>Due by</th>
                                    <th>Publish by</th>
                                    <th>Options</th>
                                  </tr>
                                </thead>
                                <tbody>
                          <?php 
                          if (!empty($assignments)) {
                          foreach($assignments as $key=>$assignment) { ?>
                          <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td style="text-align: left"><?php echo $assignment['title']; ?></td>
                            <td style="text-align: left">
                              <?php
                              foreach ($assignment["files_text"] as $k => $val) {
                              ?>
                              <a href="<?php echo '../../'.$val?>" target="_blank"><?php echo $k; ?></a><br>
                              <?php
                              }
                              ?>
                            </td>
                            <!-- <td style="text-align: left"><?php echo $assignment['link']; ?></td> -->
                            <td><?php echo $assignment['duedate']; ?></td>
                            <td><?php echo $assignment['publish_date_time']; ?></td>
                            <td>
                            <input type="hidden" name="type" value="editmodals">
                            
                              <button class="btn btn-sm btn-info editdetails p-16" title="Edit" role="button" data-id="<?php echo $assignment['id'] ?>"><i class="fa fa-edit txt-white p-3" aria-hidden="true"></i></button>

                              
                            <!-- <button class="text-white btn btn-md btn-danger deletemodaldetails" id="deletemodaldetails" title="Delete" role="button" data-id="<?php echo $assignment['title'] ?>"><i class="fa fa-trash txt-white" aria-hidden="true"></i></button> -->

                              <!-- <i class="fa fa-trash txt-black deletemodaldetails" name = "deletemodaldetails" id = "deletemodaldetails" data-id="<?php echo $assignment['title'] ?>"></i> -->
                            </td>
                          </tr>
                          <?php }
                          } ?>
                        </tbody>
                              </table>
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
      </div>
    </div>
   
     
   
      <div class="modal fade" id="create_assignment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 900px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="text-center font-weight-bold  w-100" id="model_title">Create Assignment</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="create_assignment_form" name="create_assignment_form" method="post">
                <input type="hidden" name="type" value="addAssignment">
                <input type="hidden" name="cat_id" value="">
                <div class="justify-content-center text-center" id="content_modal_content">     
                  <div class="col-md-12 qust" id="par_sub_body">
                    <div class="row d-flex align-items-center position-relative cmt mb-3 subjectRow">

                    <div class="row g-4 mb-4 d-flex align-items-center text-left">
                        <div class="col-md-4 fv-row mb-4 hideclass">
                          <label class="">Class</label>
                          <select class="form-control selectclass" id="selectedClass" name="selectedClass" >
                          <option value="">-Select Class-</option>
                          <?php foreach ($classList["classes"] as $key=>$classValue){ ?>
                            <option value="<?php echo $classValue['id']; ?>"><?php echo $classValue['module'];?></option>
                            <?php } ?>
                              </select>                            
                         </div>
                         <div class="col-md-4 fv-row mb-4 hidesubject">
                          <label class="">Subject</label>
                            <select class="form-control selectsubject" id="selectedSubject" name="selectedSubject">
                              <option value="">-Select Subject-</option>
                            </select>
                                                  
                         </div>


                         <div class="col-md-4 fv-row mb-4 hidechapter">
                          <label class="">Chapter</label>
                            <select class="form-control" id="course" name="course">
                              <option value="">-Select Chapter-</option>
                            </select>
                                                  
                         </div>
                         <div class="col-md-4 fv-row mb-4 hidetopic">
                          <label class="">Topic</label>
                              <select class="form-control" id="topic" name="topic">
                                <option value="">-Select Topic-</option>
                              </select>
                                                  
                         </div>

                         <div class="col-md-4 fv-row mb-4 hidesubtopic">
                          <label class="">Sub Topic</label>
                              <select class="form-control" id="subtopic" name="subtopic">
                                <option value="">-Select Topic-</option>
                              </select>
                                                  
                         </div>
                         <div class="col-md-4 fv-row mb-4">
                          <label class="">Marks</label>
                          <input type="text" class="form-control" name="grade" id="grade" placeholder="Type here">
                         </div>


                         <div class="col-md-12 fv-row mb-4">
                            <label class="form-label" for="Title">Title</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Type here" required="required">
                          </div>
                          <div class="col-12">
                            <label class="form-label" for="Instructions">Instructions</label>
                            <textarea class="form-control" id="intro" name="intro" rows="2" required="required"></textarea>   
                          </div>
          
                         <div class="col-md-3 fv-row mb-4">
                            <label class="">Due By <span class="required_icon" style="color:red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" class="form-control from_to_date" placeholder="Select Date" id="att_to_date" name="att_date" value="<?php echo isset($todate) ? $todate : "" ; ?>">
                                <div class="input-group-append att_to_date">
                                  <span class="input-group-text"><i class="fa fa-calendar fa-black"></i></span>
                                </div>                                                    
                            </div>
                         </div>
                         <div class="col-md-3 fv-row mb-4">
                          <div class="input-group  date" style="margin-top: 2.25rem !important;">
                          <input type='text' id='due_by' placeholder="Select Time" name='due_by' class="form-control" />
                            <label class="input-group-append due_by mb-0" for="due_by">
                              <span class="input-group-text"><i class="fa fa-clock-o fa-black"></i></span>
                            </label>    
                          </div>
                         </div>


                         <div class="col-md-3 fv-row mb-4">
                            <label class="">Publish By<span class="required_icon" style="color:red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" class="form-control from_to_date" placeholder="Select Date" id="publish_date" name="publish_date" value="<?php echo isset($publish_date) ? $publish_date : "" ; ?>">
                                <div class="input-group-append publish_date">
                                  <span class="input-group-text"><i class="fa fa-calendar fa-black"></i></span>
                                </div>                                                    
                            </div>
                         </div>
                         <div class="col-md-3 fv-row mb-4">
                          <div class="input-group  date" style="margin-top: 2.25rem !important;">
                          <input type='text' id='publish_time' placeholder="Select Time" name='publish_time' class="form-control" />
                            <label class="input-group-append publish_by mb-0" for="publish_by">
                              <span class="input-group-text"><i class="fa fa-clock-o fa-black"></i></span>
                            </label>    
                          </div>
                         </div>

                         
                         <div class="col-md-12 fv-row mb-4">
                         <label class="">Attachment</label>
                          <div class="card h-100 flex-center bg-light-primary border-primary border border-dashed p-2">
                            
                              <div class="col-sm-12">
                                <div class = "input_div">                       
                                  <div class="row">
                                    <div class="col-12">
                                      <div class="nav flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link anchor_cstm active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">File</a>
                                        <a class="nav-link anchor_cstm" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Link</a>
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active my-2" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <form id="document_upload" method="post" enctype="multipart/form-data">
                                          <!-- <div id="upload_documents_js" class="row d-flex justify-content-center align-items-center w-100 mx-auto"></div> -->
                                              <div class=" d-flex justify-content-center align-items-center w-100 ml-4 mt-4 mx-auto" id="upload_blk">                             
                                                <div class="d-flex justify-content-center align-items-center browse_block appenduploadfile">
                                                    <div class="w-100">
                                                    <img src="../../img/file-uplaod.png" class="mb-1" alt="file-uplaod">
                                                      <!-- <p class="text-center txt-grey w-100 mb-1" id="no_file_selected">No file selected</p> -->
                                                      <!-- <div class="fs-7 fw-semibold text-gray-400">
                                                          Drag and drop files here
                                                      </div> -->
                                                      <label class="txt-blue border-bottom border-primary  align-items-center" for="upload_documents">Upload File</label>						
                                                      <input type="file" name="upload_documents[]" class="upload_documents" id="upload_documents" onclick='myFunction(this)' placeholder="" multiple>
                                                    </div>
                                                </div>                                                          
                                              </div>  
                                              
                                      </form>
                                        </div>
                                        <div class="tab-pane fade custm_margin mb-2 p-2" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <p class="m-0  txt-grey" id="file-upload-filename">
                                        Insert Link Below
                                        </p>                                
                                        <input type="text" class="form-control my-2 text-center" name="url_link" id = "link" placeholder="Type here">
                                        </div>                                
                                      </div>
                                    </div>                            
                                  
                                </div>
                              </div>
                          </div>                            
                        </div>                           
                     
                    </div>
                    
                </div>
               
              </form>
           
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-md btn-primary shadow px-5">Save</button>
            </div>
          </div>
        </div>
      </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="class_delete_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center px-5 py-5">
            <img src="../../assets/images/common/delete.svg" class="mb-2">
            <h4 class=" mb-3">Alert</h4>
            <p class="m-0 ">Are you sure you want to delete <span class="action_name"></span>? </p>

            <div class="position-relative d-flex justify-content-center mt-5">
              <button class="btn btn-md btn-blue font-weight-medium yes_bth mr-4" id="delete_class_yes">Yes</button>
              <button class="btn btn-md btn-blue font-weight-medium no_btn" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Snackbar  -->
    <!-- <div id="snackbar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0" id="sb_heading">Notice!</h6>
        <button type="button" class="close close_snackbar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body">You added <span class=" m-0">4 sections under Class 2</span> successfully</p>
      </div>
    </div> -->
    
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script src="../../js/assignment.js"></script>
    <script src="../../assets/js/attachement_doc.js"></script>

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