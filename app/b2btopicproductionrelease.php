<?php
include_once "session_token/checksession.php";
include_once "configration/config.php";
include_once "configration/config_schools.php";
include "functions/common_functions.php";
include "functions/db_functions.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];

try{
  $getClasses = getClasses();
} catch(Exception $exp) {
  echo "<pre/>";
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
    <title>
    </title>
    <!-- vendor css -->
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../css/cms.css">
    <style type="text/css">
      .br-pagetitle {
        display: flex;
        align-items: center;
        padding-top: 0px;
        padding-left: 0px;
        padding-right: 0px;
      }
      .br-pagetitle .icon {
        font-size: 30px;
      }
      .br-pagetitle h4 {
        margin-bottom: 0px;
        font-size: 1.2rem;
      }
      .accordion .card-header a.collapsed:hover, .accordion .card-header a.collapsed:focus {
        background-image: linear-gradient(to right, #514A9D 0%, #24C6DC 100%);
        background-repeat: repeat-x;
        color: #ffffff
      }
      /*.accordion .card-header{
        background-image: linear-gradient(to right, #514A9D 0%, #24C6DC 100%);
        background-repeat: repeat-x;
      }*/
    </style>
  </head>
  <body class="collapsed-menu with-subleft">
    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->
    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="d-flex align-items-center justify-content-start pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">
        <button id="showSubLeft" class="btn btn-secondary mg-r-10 hidden-lg-up">
          <i class="fa fa-navicon">
          </i>
        </button>
      </div>
      <!-- d-flex -->
      <div class="br-pagebody pd-x-20 pd-sm-x-30">
        <div class="card">
          <div class="card-header">
            <div class="br-pagetitle">
              <i class="icon ion-ios-filing-outline">
              </i>
              <div>
                <h4>B2B Prodution Release for Topics
                </h4>
              </div>
            </div>
            <!-- d-flex -->
          </div>
          <div class="card-body" id="data_blk">
            <div id="accordion2" class="accordion accordion-head-colored accordion-primary" role="tablist" aria-multiselectable="true">
              <div class="card">
                <div class="card-header" role="tab" id="headingOne2">
                  
                </div><!-- card-header -->

                <div id="images" class="collapse show" role="tabpanel" aria-labelledby="headingOne2">
                  
                  <div class="card-block pd-20">
                    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                      <div class="row align-items-center justify-content-center" style="gap: 1rem">
                        <div class="form-group">
                          <label for="inst_gd">B2B School:</label>
                          <select class="form-control" name="b2bSchool" id="b2bSchool" required="required">
                            <option value="">- Select School -</option>
                            <?php
                              $query = "SELECT id, school_name FROM masters_school WHERE dbinstance = 'Production' and master_school_dbname = '$master_db'";
                              $stmt = $dbs->query($query);
                              while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = '';
                                if(isset($_POST['b2bSchool'])) {
                                  if($rows['id']==$_POST['b2bSchool']){
                                    $selected = 'selected="selected"';
                                  }
                                }
                            ?>
                                <option <?php echo $selected; ?> value="<?php echo $rows['id']; ?>"><?php echo $rows['school_name']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                        <div>
                          <button style="margin-top: 0.5rem;" type="submit" class="btn btn-md btn-info">Load Topics</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- accordion -->
            <?php
              if(isset($_POST['b2bSchool'])) {
                $topics = array();
                $queryClass = "SELECT code FROM $master_db.master_schoolwise_class WHERE school_id = ? AND visibility = 1";
                $stmtClass = $db->prepare($queryClass);
                $stmtClass->execute(array($_POST['b2bSchool']));
                $rowcountClass = $stmtClass->rowCount();
                if($rowcountClass > 0){
                  while($fetchClass = $stmtClass->fetch(PDO::FETCH_ASSOC)){
                    $classsearch = "CLASS ".$fetchClass['code'];
                    $query = "SELECT id FROM $master_db.mdl_course_categories WHERE name = ? AND depth = 1 AND visible=1";
                    $stmt = $db->prepare($query);
                    $stmt->execute(array($classsearch));
                    $rowcount = $stmt->rowCount();
                    if($rowcount > 0){
                      while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                        /*AND visible=1*/
                        $query1 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 2 AND visible=1 ORDER BY sortorder";
                        $stmt1 = $db->prepare($query1);
                        $stmt1->execute(array($fetch['id']));
                        $rowcount1 = $stmt1->rowCount();
                        if($rowcount1 > 0){
                          while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
                            /*AND visible=1*/
                            $query2 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 3 AND visible=1 ORDER BY sortorder";
                            $stmt2 = $db->prepare($query2);
                            $stmt2->execute(array($fetch1['id']));
                            $rowcount2 = $stmt2->rowCount();
                            if($rowcount2 > 0){
                              /*AND visible=1*/
                              while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                $query3 = "SELECT id, fullname FROM $master_db.mdl_course WHERE category = ? AND visible=1 ORDER BY sortorder";
                                $stmt3 = $db->prepare($query3);
                                $stmt3->execute(array($fetch2['id']));
                                $rowcount3 = $stmt3->rowCount();
                                if($rowcount3 > 0){
                                  while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
                                    $topic_id_arr = array();
                                    $topic_id_arr['class'] = $fetchClass['code'];
                                    $topic_id_arr['id'] = $fetch3['id'];
                                    $topic_id_arr['description'] = $fetch3['fullname'];

                                    $topic_id_arr['checked'] = false; 
                                    $topic_id_arr['rowId'] = '';
                                    $query4 = "SELECT * FROM b2b_task_production_ready WHERE topic_id = ? AND school_id=?";
                                    $stmt4 = $db->prepare($query4);
                                    $stmt4->execute(array($topic_id_arr['id'], $_POST['b2bSchool']));
                                    $rowcount4 = $stmt4->rowCount();
                                    if($rowcount4 > 0){
                                      $fetch4 = $stmt4->fetch(PDO::FETCH_ASSOC);
                                      $topic_id_arr['checked'] = true;
                                      $topic_id_arr['rowId'] = $fetch4['id'];
                                    }

                                    array_push($topics, $topic_id_arr);
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
            ?>
            <div class="row w-100 mt-4" id="topic_data">
              <div class="col-12">
                <table id="datatable" class="table table-striped table-bordered sourced-data w-100">
                  <thead>
                    <tr>
                      <th>Class</th>
                      <th>Topic</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(isset($topics)){
                        foreach ($topics as $topic) {
                          $checked = '';
                          if($topic['checked']) {
                            $checked = 'checked';
                          }
                    ?>
                        <tr>
                          <td><?php echo $topic['class']; ?></td>
                          <td><?php echo $topic['description']; ?></td>
                          <td>
                            <input type="checkbox" class="form-control topicCheckBox" <?php echo $checked; ?> name="topicId" data-schoolId="<?php echo $_POST['b2bSchool']; ?>" id="topicId_<?php echo $topic['id']; ?>" data-Id="<?php echo $topic['rowId']; ?>" value="<?php echo $topic['id']; ?>">
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
          <?php } ?>
          </div>
        </div>
      </div>
      <!-- br-pagebody -->
    </div>
    <!-- br-contentpanel -->
    <!-- Modal -->
    <div id="dbsuccess" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" style="width: 100%">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Status
            </h4>
          </div>
          <div class="modal-body" id="modal-body">
            <p>Image has been uploaded Successfully.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div id="infosuccess" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Details
            </h4>
          </div>
          <div class="modal-body" id="modal_details">
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../lib/jquery/jquery.js">
    </script>
    <script src="../lib/popper.js/popper.js">
    </script>
    <script src="../lib/bootstrap/js/bootstrap.js">
    </script>
    <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js">
    </script>
    <script src="../lib/moment/moment.js">
    </script>
    <script src="../lib/jquery-ui/jquery-ui.js">
    </script>
    <script src="../lib/jquery-switchbutton/jquery.switchButton.js">
    </script>
    <script src="../lib/peity/jquery.peity.js">
    </script>
    <script src="../lib/datatables/jquery.dataTables.js"></script>
    <script src="../lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../lib/ajax_loader/jquery.mloading.js">
    </script>
    <script src="../js/cms.js">
    </script>
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

        var inputTopicId = '';
        $(document).on('change', '.topicCheckBox', function() {
          var checked = false;
          if(this.checked) {
            checked = true;
          }
          var topic_id = $(this).val();
          var school_id = $(this).attr('data-schoolId');
          var autoIncId = $(this).attr('data-Id');
          inputTopicId = '#topicId_'+topic_id;

          $.ajax({
            type: "POST",
            url: "apis/b2btopicenable.php",
            data: 'checked='+checked+'&topic_id='+topic_id+'&school_id='+school_id+'&autoIncId='+autoIncId,
            success: function(data){
              if(data != 'success') {
                $(inputTopicId).attr('data-Id', data);
              }
            },
            beforeSend: function(){
              $("body").mLoading()
            },
            complete: function(){
              $("body").mLoading('hide')
            }
          });
        });
      });
    </script>
  </body>
</html>
