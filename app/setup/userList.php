<?php 
  include_once "../session_token/checksession.php";
  include_once "../configration/config.php";
  require_once "../functions/db_functions.php";
  include "functions/common_function.php";
  $classList = getCPClasses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Virtual School</title>
    <link rel="icon" type="image/png" href="../../img/favicon.png" />
    <!-- vendor css -->
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <!-- <link href="../../lib/datatables/jquery.dataTables.css" rel="stylesheet"> -->
    <link href="../../lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="links/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="links/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="../links/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>

    <!-- CMS CSS -->
    <!-- <link rel="stylesheet" href="../../css/cms.css"> -->
   
  </head>
  <body  id="kt_body"  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <?php include("../fixed-blocks/header.php"); ?>
        <!-- start you own content here -->
        <div class="row">
          <div class="col-md-12">
            <div class="card h-100 d-flex flex-column justify-content-between">
              <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
                <h6 class="mg-b-0 tx-14 tx-white">Users</h6>
                <div class="card-option tx-24">
                  <a href="user_creation.php" class="btn btn-md btn-info">New User</a>
                </div><!-- card-option -->
              </div><!-- card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered">
                  <thead>

                     
                    <tr>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php 
                        $i=1; 
                        $query="SELECT * FROM users";
                        $result=$db->query($query);
                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                        { 
                            
                        ?>
                    <tr>

                      <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><button type="button" class="btn btn-info" onclick="location.href='update_user.php?id=<?php echo $row['id']; ?>';">Edit</button></td>
                      
                    </tr>


                    <?php
                  }
                  ?>
                  </tbody>
                  
                </table>
              </div><!-- card-body -->
            </div>
          </div>
        </div>
     

    <?php include("../fixed-blocks/footer.php"); ?>
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../lib/jquery/jquery.js"></script>
    <script src="../../lib/popper.js/popper.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../lib/datatables/jquery.dataTables.js"></script>
    <script src="../../lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../../lib/select2/js/select2.min.js"></script>

    <script src="../../links/plugins/global/plugins.bundle.js"></script>
    <script src="../../links/js/scripts.bundle.js"></script>
    <script src="../../links/plugins/custom/datatables/datatables.bundle.js"></script>

    <script src="../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable').DataTable({
          responsive: false
        });
        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
  </body>
</html>
