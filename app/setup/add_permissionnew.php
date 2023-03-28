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
    <link href="../links/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="../links/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="../links/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>

    <!-- CMS CSS -->
    <!-- <link rel="stylesheet" href="../../css/cms.css"> -->
   
  </head>
  <body  id="kt_body"  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <?php include("../fixed-blocks/header.php"); ?>

    <div class="row">
        <div class="col-md-12">     
          <!-- start you own content here -->
          <div class="card h-100 d-flex flex-column justify-content-between">
            <h4 class="card-header  pt-6">Add Permission</h4>
            <form class="user_form form-horizontal" action="adduseraccess.php" name="form" method="POST">
              <input type="hidden" name="role" id="role" value="<?php echo $role;?>">
              <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
              <div class="card-body bd rounded-bottom">
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group mult">
                          
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
            
              <div class="card-footer bd bd-t-0 d-flex justify-content-center">
                <a href="../home.php" class="btn btn-md btn-danger me-2">Cancel</a>
                <button type="submit" class="btn btn-md btn-info" name="submit">Submit</button>
              </div><!-- card-footer -->
            </form>   
          </div>
      </div>
    </div>
     
    <!-- ########## END: MAIN PANEL ########## -->
    <?php include("../fixed-blocks/footer.php"); ?>
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

    
    <script src="../../links/plugins/global/plugins.bundle.js"></script>
    <script src="../../links/js/scripts.bundle.js"></script>
    <script src="../../links/plugins/custom/datatables/datatables.bundle.js"></script>


    <script>
        $(document).ready(function(){

            /*console.log("came");*/
            var role = "<?php echo  $role;?>";
            var user_id = "<?php echo  $user_id;?>";
            
            
            var dataString = 'user_id='+ user_id +"&role="+role+"&type=get_user_permission";

            $.ajax
            ({
                type: "POST",
                url : "apis/ajaxPermissions.php",
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
        
        });

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
        



    </script>
  </body>
</html>
