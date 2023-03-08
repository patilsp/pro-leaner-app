<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
include "../../functions/db_functions.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$role_id = $_SESSION['user_role_id'];
try {
  include "../../functions/common_functions.php";
  if($role_id == 1) {
    $getYetToAssignTaskList = getCPYetToAssignTaskList($role_id, $logged_user_id);
  }
  /*echo "<pre/>";
  print_r($getYetToAssignTaskList);die;*/

  $getTaskList = getCPTaskListAdd($role_id, $logged_user_id);
  
  // echo "<pre/>";
  // print_r($getTaskList);die;
  } catch(Exception $exp){
  print_r($exp);
}
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

    <title></title>

    <!-- vendor css -->
    <link href="../../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../../lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../../../lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">

    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    <style type="text/css">
      .cards tbody tr {
         float: left;
         width: 30%;
         margin: 0.5rem;
         border: 0.0625rem solid rgba(0, 0, 0, .125);
         border-radius: .25rem;
         box-shadow: 0.25rem 0.25rem 0.5rem rgba(0, 0, 0, 0.25);
      }

      .cards tbody td {
         display: block;
      }

      .cards thead {
         display: none;
      }

      .cards td:before {
         content: attr(data-label);
         position: relative;
         float: left;
         color: #808080;
         /* min-width: 4rem; */
         margin-left: 0;
         margin-right: 1rem;
         text-align: left;   
      }

      tr.selected td:before {
         color: #CCC;
      }

      .table .avatar {
         width: 50px;
      }

      .cards .avatar {
         width: 150px;
         margin: 15px;
      }
      /* tbody {
        display: flex !important;
        justify-content: center;
        flex-wrap: wrap;
      } */
      .breadcrumb-item + .breadcrumb-item::before {
        color: #dc3545;
        font-weight: bold;
      }
      a.btn-block{
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
      }
      .breadcrumb{
        background-color: #eee;
      }
      #datatableYetToAssign tbody{
        margin-bottom:10px
      }
      #datatableYetToAssign tbody tr {
        width: auto;
      }
      #datatableYetToAssign tbody tr{
        /* margin: 5px; */
        max-width: 315px;
        min-width: 300px;
        padding: 5px;
        border-radius:1rem;

      }
      #datatableYetToAssign .table th, .table td{
        border-top:none;
      }
      #datatableYetToAssign tbody tr {
        box-shadow: 0px 0px 20px 0px rgba(76, 87, 125, 0.02);
        
        
      }
      #datatableYetToAssign tbody tr td{
        border-bottom: 0px;
      }
      #datatableYetToAssign tbody {
        justify-content: left;
      }
      <?php
        if(count($getYetToAssignTaskList) == 0) {
      ?>
          #datatableYetToAssign tbody tr {
            width: 100%;
          }
      <?php
        }
      ?>
    </style>
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel "style="padding:30px 40px" >
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody new-row-bg">
        <!-- start you own content here -->
        <div class="col-md-12">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-assignedTask-tab" data-toggle="tab" href="#nav-assignedTask" role="tab" aria-controls="nav-assignedTask" aria-selected="true">Assigned Tasks</a>
              <?php if($role_id == 1) { ?>
              <!-- <a class="nav-item nav-link" id="nav-yetToAssignTask-tab" data-toggle="tab" href="#nav-yetToAssignTask" role="tab" aria-controls="nav-yetToAssignTask" aria-selected="false">Yet To Assign Tasks</a> -->
              <?php } ?>
            </div>
          </nav>
          <div class="tab-content " id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-assignedTask" role="tabpanel" aria-labelledby="nav-assignedTask-tab">
              <div class="card">
                <div class="card-body ">
                  <div class="table-responsive1">
                  <div class="row"> 
                    
                    <table id="datatable" class="table table-striped table-bordered w-100">
                      <thead>
                        <tr>
                          <th>S No</th>
                          <th>Class Name</th>
                          <th>Subject Name</th>
                          <th>Assigned To</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $published_task_ids = array();
                          $query = "SELECT * FROM cptask_production_ready";
                          $stmt = $db->query($query);
                          $rowcount = $stmt->rowCount();
                          if($rowcount > 0){
                            while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                              $published_task_ids[] = $fetch['task_id'];
                            }
                          }

                          $i = 1;
                          foreach ($getTaskList as $key=>$task) {
                            if($task['subjectName'] != '') {
                              if(in_array($task['task_id'], $published_task_ids))
                                continue;
                              
                              //to highlight layout6 slides contains topics tr
                              $layout6Count = $task['layout6'];
                              $tr_bg_color = '';
                              if($layout6Count > 0) {
                                $tr_bg_color = 'background-color: #ffeb3b;';
                              }
                        ?>
                      
                      <tr>
                          <td><span class="fw-semibold"><?php echo $key+1; ?></span></td>
                          <td><span class="card-label fw-semibold  fs-3 mb-1"><?php echo $task['className']; ?></span></td>
                          <td><span class="fw-semibold  mt-1"><?php echo $task['subjectName']; ?></span></td>
                          <td><span class="fw-semibold text-gray-800"><?php echo $task['AssignedTo']; ?></span></td>
                          <td><span class="badge badge-light-warning fs-7 fw-bold"><?php echo $task['status']; ?></span></td>
                          <td class="d-flex align-items-center justify-content-center">

                          <?php
                              $btndisplayClass = 'd-block';
                              if($task['status'] == "Review" || $task['status'] == "Publish") {
                                $btn_lable = "Review";
                                if($role_id != 1) {
                                  if($role_id == 8){
                                    $btndisplayClass = 'd-block';
                                  } else{
                                    $btndisplayClass = 'd-none';
                                  }
                                }
                              } elseif ($task['status'] == "QC") { 
                                $btn_lable = "Final QC";
                              } else {
                                $btn_lable = "WIP";
                              }
                            ?>

                          <a href="<?php echo $web_root; ?>app/transactions/conceptprep/slideCreate.php?class=<?php echo $task['class_id'] ?>&subject=<?php echo $task['subject_id'] ?>&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>&task_userid=<?php echo $task['task_userid']; ?>" class="btn btn-primary <?php echo $btndisplayClass; ?>" style="width:100px;"><?php echo $btn_lable; ?> </a>
      
                          </td>
                          
                        </tr>

                        
                        <?php
                            }
                          }
                        ?>


                    
                      </tbody>
                    </table>
                    </div>  
                    </div>  
                </div>  
              </div>
            </div>
            <?php if($role_id == 1) { ?>
            <div class="tab-pane fade" id="nav-yetToAssignTask" role="tabpanel" aria-labelledby="nav-yetToAssignTask-tab">
              <div class="card">
                <div class="card-body">
                  <table id="datatableYetToAssign" class="table border-0 sourced-data cards w-100">
                    <thead>
                      <tr>
                        <th>Class &amp; Subject</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($getYetToAssignTaskList as $YTtasks) {
                      ?>
                      <tr id="<?php echo "tr".$YTtasks['classId'].'-'.$YTtasks['subId']; ?>">
                        <td class="p-0" data-toggle="modal" data-target="#assignModal" style="border:none">
                          <!-- <div class="input-group mb-0 d-flex align-items-center">
                            <div class="input-group-prepend">
                              <div class="input-group-text px-2">
                                <input type="radio" class="classSubRadio" name="classSubId" value="<?php echo $YTtasks['classId'].'-'.$YTtasks['subId']; ?>" data-info="<?php echo $YTtasks['className'].' / '.$YTtasks['subName']; ?>" id="<?php echo "check".$YTtasks['classId'].'-'.$YTtasks['subId']; ?>">
                              </div>
                            </div>
                            <label class="w-100 mb-0" for="<?php echo "check".$YTtasks['classId'].'-'.$YTtasks['subId']; ?>">
                              <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0 pl-2">
                                  <li class="breadcrumb-item my-2"><?php echo $YTtasks['className']; ?></li>
                                  <li class="breadcrumb-item my-2"><?php echo $YTtasks['subName']; ?></li>
                                </ol>
                              </nav>
                            </label>
                          </div> -->

                          <div class="card card-xl-stretch">
                            
                              <div class="card-body d-flex justify-content-between pt-3 pb-0 mb-2">
                                <div class="d-flex align-items-center ">
                                
                                  <div class="form-check form-check-custom form-check-solid mx-5">
                                    <div class="input-group-text px-2">
                                      <input type="radio" class="classSubRadio" name="classSubId" value="<?php echo $YTtasks['classId'].'-'.$YTtasks['subId']; ?>" data-info="<?php echo $YTtasks['className'].' / '.$YTtasks['subName']; ?>" id="<?php echo "check".$YTtasks['classId'].'-'.$YTtasks['subId']; ?>">
                                    </div>
                                  </div>
                                  <!--end::Checkbox-->

                                  <!--begin::Description-->
                                  <div class="flex-grow-1">
                                      <a href="#" class="fw-bold text-primary fs-3 mb-1"><?php echo $YTtasks['className']; ?></a>

                                      <span class="text-warning fw-semibold d-block"><?php echo $YTtasks['subName']; ?></span>
                                  </div>
                                  
                              </div>
                                
                                  <img src="<?php echo $web_root ?>img/avatar/boy.svg" alt="" class="align-self-end h-50px">
                              </div>
                              <!--end::Body-->
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>  
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <div id="assignModal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog modal-lg" role="document" style="right: 0;transition: opacity 0.3s linear, right 0.3s ease-out;position: fixed;margin: auto;max-width: 750px !important;width: 1000px;height: 100%;transform: translate3d(0%, 0, 0);">
        <div class="modal-content tx-size-sm" style="height: 100%;overflow-y: auto;border-radius: 0;border: none;">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="assignModalHeader">New Slide Topic Level - Instructions</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <form method="post" id="new_task_form" name="new_task_form" enctype="multipart/form-data">
            <input type="hidden" name="assign_to[]" id="assign_to" value="cw" />
            <input type="hidden" name="main_status" id="main_status" value="15" />
            <input type="hidden" name="classId" id="classId">
            <input type="hidden" name="subId" id="subId">
            <div class="modal-body pd-20">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="user_cw">Assign To:</label>
                    <select class="form-control" name="user_cw" id="user_cw" required>
                      <option value="">-Select User-</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inst_cw">Instructions:</label>
                    <textarea class="form-control h-100px" rows="5" col="5" name="inst_cw" id="inst_cw" required></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="file_cw">Reference Files:</label>
                    <div class="file-loading">
                      <input id="file-1" type="file" name="cw_files[]" multiple class="file" data-overwrite-initial="false">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info submit" />
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>


    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../../lib/datatables/jquery.dataTables.js"></script>
    <script src="../../../lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../../../lib/select2/js/select2.min.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>

    <script src="../../../js/cms.js"></script>
    <script src="js/cptasks.js?ver=210620211312"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatableYetToAssign').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });
        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
  </body>
</html>
