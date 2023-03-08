<?php 
  include_once "../../session_token/checksession.php";
  include_once "../../configration/config.php";
  include_once "../../configration/config_schools.php";
  //include_once "session_token/checktoken.php";
  require_once "../../functions/db_functions.php";
function getDirContents($dir, &$results = array()){
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = $dir;
        } else if($value != "." && $value != "..") {
            getDirContents($path, $results);
            //$results[] = $path;
            /*if(count($results) > 100)
              break;*/
        }
    }
    $results = array_unique($results);
    return $results;
}

$dirs = getDirContents('../../contents');
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
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../../lib//fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    <style type="text/css">
      .br-pagebody {
        margin-top: 0px;
      }
      /*.card-body{
        height: 65vh;
        overflow-y: auto;
      }*/
	  input[type="checkbox"]:checked + span {
	  	background-color:#18a4b2;
		color:#ffffff;
		padding:2px;
	  }
	  #toast {
        visibility: hidden;
        max-width: 50px;
        height: 50px;
        /*margin-left: -125px;*/
        margin: auto;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;

        position: fixed;
        z-index: 1;
        left: 0;right:0;
        bottom: 30px;
        font-size: 17px;
        white-space: nowrap;
    }
    #toast #img{
      width: 50px;
      height: 50px;
        
        float: left;
        
        padding-top: 16px;
        padding-bottom: 16px;
        
        box-sizing: border-box;

        
        background-color: #111;
        color: #fff;
    }
    #toast #desc{

        
        color: #fff;
       
        padding: 16px;
        
        overflow: hidden;
      white-space: nowrap;
    }

    #toast.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 2s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 4s, fadeout 0.5s 4.5s;
    }
    th{
      text-align: center;
    }
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
    <div class="br-mainpanel">
      <div class="br-pagetitle">
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header tx-medium bd-0 tx-white bg-dark">
            Upload Activity Files (only for replacing)
          </div><!-- card-header -->
          <form class="user_form form-horizontal" action="save_topic_relase_status.php" name="user_form" id="user_form" method="POST">
            <div class="card-body bd bd-t-0 rounded-bottom">
              <div class="row text-center">
                <table id="tb" class="table table-responsive">
                  <thead>
                    <tr>
                      <th>File Path</th>
                      <th>Browse</th>
                      <th><a style="font-size:8px;" id="addMore" title="Add More Rows" class="btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i></a></th>
                    </tr>
                  </thead>
                  <tbody id="tbodyData">
                      <tr>
                        <td>
                          <select class="form-control folder path" name="path[]" id="path">
                            <option value="">-Select Folder-</option>
                            <?php
                            foreach($dirs as $dir) {                              
                              $displayDir = str_replace($dir_root, "", $dir);
                              ?>
                              <option value="<?php echo $dir; ?>"><?php echo $displayDir; ?></option>
                              <?php
                            }
                            ?>
                          </select>
                        </td>
                        <td>
                          <input type="file" name="files[]" class="form-control">
                        </td>
                        <td><a style="font-size:8px;" class='remove btn btn-danger'><i class="fa fa-window-close" aria-hidden="true"></i></a></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div><!-- card-body -->
           
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="<?php echo $web_root ?>app/home.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="submit" class="btn btn-md btn-info pull-right" id="submit" name="submit">Submit</button>
            </div><!-- card-footer -->
          </form>   
        </div>
        <div id="toast"><div id="img">Status</div><div id="desc"></div></div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <div class="modal fade  bs-example-modal-sm" id="loader_modal"  data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-body">
                <p class="text-bold text-center text-bold">Loading..Please Wait..</p>
              </div>
          </div>
      </div>
    </div>

    <div class="modal fade" id="response_modal" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-body">
                <div class="alert alert-success" id="success">
                  
                </div>
                <br />
                <div class="alert alert-danger" id="failure">
                  
                </div>
              </div>
          </div>
      </div>
    </div>

    <!-- ########## END: MAIN PANEL ########## -->

    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/bootstrap/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/fileinputs/js/fileinput.js" type="text/javascript"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>
    <script src="../../../js/cms.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script>
    	function launch_toast() {
    		  var x = document.getElementById("toast")
    		  x.className = "show";
    		  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
    	}
      $(function () {
        /*$('#path').select2({
          closeOnSelect: true
        });*/
        //$("#response_modal").modal("show");
        $('.user_form').on('submit', function(event) {
          event.preventDefault();

          $.ajax({
            url: 'save_UploadActivityFile.php',
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            async:true,
            success:function(data)
            {
              data = JSON.parse(data);
              $("#failure").html("");
              $("#success").html("");

              for(x of data.failure) {
                $("#failure").append("<br />"+x.path+" :: " + x.message);
              }
              for(x of data.success) {
                $("#success").append("<br />"+x.path+" :: " + x.message);
              }              
              $("#response_modal").modal("show");
              $("#tbodyData").find("tr:gt(0)").remove();
              $("#user_form").trigger("reset");
            },
            beforeSend: function(){
              $("#loader_modal").modal("show");
            },
            complete: function(){
              setTimeout(function(){
                $("#loader_modal").modal("hide");
              }, 2000);
            }
          });
        });
        var i = 1;
        $('#addMore').on('click', function() {
          var last_row = $('#tb > tbody  > tr').last();
              if(hasValues(last_row)) 
          {
            
            var data = $("#tb tr:eq(1)").clone(true);
            i++;
            data.find("input").val('');
            data.find("select").val('');
            $("#tb").append(data);
          }
            });
        
        function hasValues(row){
          var optVal = row.find('.folder').prop('value');
          if(optVal != ""){
              return true;
          } else {
              return false;
          }
        }
          
        $(document).on('click', '.remove', function() {
          var trIndex = $(this).closest("tr").index();
          if(trIndex>0) {
            $(this).closest("tr").remove();
          } else {
            //alert("Sorry!! Can't remove first row!");
            //$("#Rubrics_modal").modal("show");
          }
        });
      });
    </script>
  </body>
</html>
