<?php
include_once "session_token/checksession.php";
include_once "configration/config.php";
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
    <!-- <link href="../lib//fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/> -->
    <link href="../lib/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
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
    <div class="br-subleft">
      <h6 class="tx-uppercase tx-10 mg-t-40 pd-x-10 bd-b pd-b-10 tx-roboto tx-white-7">My Folder
      </h6>
      <nav class="nav br-nav-mailbox flex-column">
        <a href="#" class="nav-link" id="image_tab">
          <i class="icon ion-ios-folder-outline">
          </i> Images
        </a>
        <a href="#" class="nav-link" id="video_tab">
          <i class="icon ion-ios-folder-outline">
          </i> Videos
        </a>
        <a href="#" class="nav-link">
          <i class="icon ion-ios-folder-outline">
          </i> Audios
        </a>
        <a href="#" class="nav-link">
          <i class="icon ion-ios-folder-outline">
          </i> Templates
        </a>
        <a href="#" class="nav-link">
          <i class="icon ion-ios-folder-outline">
          </i> Layouts
        </a>
        <a href="#" class="nav-link">
          <i class="icon ion-ios-folder-outline">
          </i> Documents
        </a>
      </nav>
    </div>
    <!-- br-subleft -->
    <div class="br-contentpanel">
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
                <h4>Resource Manager
                </h4>
              </div>
            </div>
            <!-- d-flex -->
          </div>
          <div class="card-body" id="data_blk">
            <div class="card card-body bg-teal tx-white bd-0">
              <!-- <p class="card-text tx-center">Click on left sidebar EX-(images/videos...) for upload.
              </p> -->
            </div>
            <!-- card -->
            <div id="accordion2" class="accordion accordion-head-colored accordion-primary" role="tablist" aria-multiselectable="true">
              <div class="card">
                <div class="card-header" role="tab" id="headingOne2">
                  <h6 class="mg-b-0">
                    <a data-toggle="collapse" data-parent="#accordion2" href="#images" aria-expanded="true" aria-controls="images">
                      Upload Images
                    </a>
                  </h6>
                </div><!-- card-header -->

                <div id="images" class="collapse show" role="tabpanel" aria-labelledby="headingOne2">
                  
                  <div class="card-block pd-20">
                    <form id="uploadimage" enctype="multipart/form-data">
                      <input type="hidden" name="folder_type" value="images">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inst_gd">Class:</label>
                            <select class="form-control" name="class_name" id="class_name" required="required">
                              <option value="">- Select Class -</option>
                              <?php
                                foreach ($getClasses as $auto_id => $class_name) {
                              ?>
                                  <option value="<?php echo $auto_id; ?>"><?php echo $class_name; ?></option>
                              <?php
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inst_gd">Topics:</label>
                            <select class="form-control" name="topic" id="topic" required="required">
                              <option value="">-Select Topics-</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inst_gd">Enter Tags:</label>
                            <input type="text" id="tags" name="tags" placeholder="Enter tags here..." data-role="tagsinput"  required="required"/>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="file_img">Attach Files:</label>
                            <input name="img_res[]" id="file_img" type="file" multiple  required="required"/>
                          </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                          <button type="submit" class="btn btn-md btn-info">Upload</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- accordion -->
            <div class="row" id="img_data">
              
            </div>
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
    <!-- <script src="../lib/fileinputs/js/fileinput.js" type="text/javascript"> -->
    </script>
    <script src="../lib/bootstrap-tagsinput/bootstrap-tagsinput.js">
    </script>
    <script src="../lib/ajax_loader/jquery.mloading.js">
    </script>
    <script src="../js/cms.js">
    </script>
    <script src="resources/js/resources.js"></script>
  </body>
</html>
