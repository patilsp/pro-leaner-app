<?php 
  include_once "../session_token/checksession.php";
  include_once "../configration/config.php";
  //include_once "session_token/checktoken.php";
  require_once "../functions/db_functions.php";

  $roleid=$_GET['id'];

  $sql = "SELECT * FROM roles WHERE id = ?";
  $query=$db->prepare($sql);
  $query->execute(array($roleid)); 
  while($fetch = $query->fetch(PDO::FETCH_ASSOC))
  {

    $user_auto_id = $fetch['id'];
    $role_name = $fetch['name'];
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
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../lib//fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
    <style type="text/css">
      .br-pagebody {
        margin-top: 0px;
      }
    </style>
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header tx-medium bd-0 tx-white bg-dark">
            Role Creation
          </div><!-- card-header -->
          <form class="user_form form-horizontal" action="update_role_validation.php" name="form" method="POST">
            <input type="hidden" class="form-control" name="user_auto_id" value="<?php echo $user_auto_id; ?>">
            <div class="card-body bd bd-t-0 rounded-bottom">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="title">Roles:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="rolename" id="rolename" value="<?php echo $role_name; ?>" required>
                  </div>
                </div>

              </div>


            </div><!-- card-body -->
           
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="task_list.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="submit" class="btn btn-md btn-info" name="update" id="update">Update</button>
            </div><!-- card-footer -->
          </form>   
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- ########## END: MAIN PANEL ########## -->

    <script src="../../lib/jquery/jquery.js"></script>
    <script src="../../lib/popper.js/popper.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/fileinputs/js/fileinput.js" type="text/javascript"></script>
    <script src="../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';
        // show only the icons and hide left menu label by default
        $('.menu-item-label').addClass('op-lg-0-force d-lg-none');

        $("#file-1, #file_vd, #file_gd, #file_tt").fileinput({
          theme: 'fa',
          uploadUrl: '#', // you must set a valid URL here else you will get an error
          showUpload: false, // hide upload button
          allowedFileExtensions: ['jpg', 'png', 'gif'],
          overwriteInitial: false,
          maxFileSize: 1000,
          maxFilesNum: 10,
          //allowedFileTypes: ['image', 'video', 'flash'],
          slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
          }
        });
      });
    </script>
  </body>
</html>
