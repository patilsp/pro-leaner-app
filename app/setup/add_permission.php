<?php 
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php";

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
      /* .br-pagebody {
        margin-top: 0px;
      } */
      .card-body{
        height: 65vh;
        overflow-y: auto;
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
    <div class="container-fluid mb-5 mb-lg-0 mt-4">      
      <div class="br-pagebody">
        <div class="row new-row-bg">
            <div class="col-md-12">     
              <!-- start you own content here -->
              <div class="card h-100 d-flex flex-column justify-content-between ">
                <h4 class="card-header tx-medium bd-0 tx-white bg-dark">
                  Add Permission
                </h4><!-- card-header -->
                <form class="user_form form-horizontal" action="addroleaccess.php" name="form" method="POST">
                  <div class="card-body bd rounded-bottom">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group mult">
                              <label class="col-md-12">Role<span class="required_icon" style="color:red;">*</span></label>
                              <select class="form-control" name="role" id="role" required>
                                  <option value="" selected="selected">Select</option>

                                    <?php
                                        $query = "SELECT * FROM roles";
                                        $stmt = $db->query($query);
                                        while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?>
                                            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>
                                        <?php
                                            }
                                        ?>
                                
                              </select>
                          </div>
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-md-12">
                          <div class="school_table">

                          </div>
                      </div>
                    </div>

                  </div><!-- card-body -->
                
                  <div class="card-footer bd bd-t-0 d-flex justify-content-between">
                    <a href="../home.php" class="btn btn-md btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-md btn-info" name="submit">Submit</button>
                  </div><!-- card-footer -->
                </form>   
              </div>
          </div>
        </div>
      </div>
    </div>

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


       function selectAll(source)
        {
          var clasname = source.className;
          checkboxes = document.getElementsByClassName(clasname);
          for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
          }
        }  


        function verifyParentChecked(source, parent)
        {
            var clasname = source.className;
            checkboxes = document.getElementsByClassName("child"+parent);
            var atleast1checked = false;
            for(var i=0, n=checkboxes.length;i<n;i++) {
                if(checkboxes[i].checked)
                    atleast1checked = true;
            }
            var parentClassName = "module"+parent;
            if(atleast1checked)
             document.getElementById(parentClassName).checked = true;
            else
             document.getElementById(parentClassName).checked = false;
        }  

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



      //school
        $('#role').change(function(){
            /*console.log("came");*/
            var role = $("#role").val();
            
            var dataString = 'role='+ role +"&type=get_class_section_table";

            $.ajax
            ({
                type: "POST",
                url : "ajaxMasterPermission.php",
                data : dataString,
                cache : false,
                success : function(data)
                {   
                    if(data != "error"){
                      $(".school_table").html(data);
                      /*$(".school_table").find('.data_table').DataTable({
                        scrollY:        '50vh',
                        scrollCollapse: true,
                        paging:         false,
                        sort:     false,
                        info:           false,
                        "bDestroy": true,
                        searching: false
                      });*/
                    }
                    else{
                      alert("something went wrong, please contact to prpmyskills technical team.");
                    }
                },
                
            });
        })



    </script>
  </body>
</html>
