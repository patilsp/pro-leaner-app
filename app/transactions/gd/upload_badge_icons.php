<?php 
  include_once "../../session_token/checksession.php";
  include_once "../../configration/config.php";
  //include_once "session_token/checktoken.php";
  require_once "../../functions/db_functions.php";
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

    <title>Upload Badge Icons</title>

    <!-- vendor css -->
    <link href="../../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../../lib//fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
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
            Upload Badge Icons
          </div><!-- card-header -->
          <form class="user_form form-horizontal" action="create_user.php" name="user_form" method="POST" id="user_form" enctype="multipart/form-data">
            <div class="card-body bd bd-t-0 rounded-bottom">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Type:<span class="required_icon" style="color:red;">*</span></label>
                    <select class="form-control" name="type" id="type" required>
                        <option value="">-Select Type-</option>
                        <option value="New">New</option>
                        <option value="Update">Update</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Topic:<span class="required_icon" style="color:red;">*</span></label>
                    <select class="form-control" name="topic" id="topic" required>
                        <option value="">-Select Topic-</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Classes:<span class="required_icon" style="color:red;">*</span></label>
                    <select class="form-control" name="classes[]" id="classes" multiple="multiple" required>
                        <option value="">-Select Class-</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="row">
              	<div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Badge Color PNG:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="file" class="form-control" name="badge-color-png" id="badge-color-png" accept="image/x-png" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Badge Color SVG:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="file" class="form-control" name="badge-color-svg" id="badge-color-svg" accept="image/svg+xml" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Badge Black PNG:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="file" class="form-control" name="badge-black-png" id="badge-black-png" accept="image/x-png" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Badge Black SVG:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="file" class="form-control" name="badge-black-svg" id="badge-black-svg" accept="image/svg+xml" required>
                  </div>
                </div>
              </div>
              
              <div class="row">
              	<div class="col-md-12" id="question_options">
                </div>
              </div>
              
              <div class="row">
              	<div class="col-md-12" id="feedback">
                </div>
              </div>


            </div><!-- card-body -->
           
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="<?php echo $web_root ?>app/home.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="button" class="btn btn-md btn-info pull-right" id="submit" name="submit">Submit</button>
            </div><!-- card-footer -->
          </form>   
        </div>
        <div id="toast"><div id="img">Status</div><div id="desc"></div></div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

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
    <script>
	function launch_toast() {
		  var x = document.getElementById("toast")
		  x.className = "show";
		  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
	}
    $(function(){
        'use strict';
        
        $("#type").change(function(event){
            event.preventDefault();
            $.ajax({
              url:"apis/badge_apis.php?type=getUniqueTopics",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $("#topic").html(data);
                $('#classes').empty().append($("<option></option>").attr("value","").text("-Select Class-"));
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            }); 
        });
		
		$("#topic").change(function(event){
      var value = $(this).val();
      var temp = value.split("@");
      if(temp.length > 0) {
        $('#classes').empty();
        $.each( temp, function( key, value2 ) {
          var temp2 = value2.split("|");
          $('#classes').append($("<option></option>").attr("value",value2).text("Class "+temp2[0])); 
        });
      }
    });
		
		$("#submit").click(function(event){
            
            $.ajax({
              url:"apis/badge_apis.php?type=save",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
			  	      event.preventDefault();
                var res = $.parseJSON(data);
        				if(res.status)
        				{
        					$.toaster({ message : res.Message, title :'Great', priority : 'success' });
                  $('#classes').empty().append($("<option></option>").attr("value","").text("-Select Class-"));
        					$("#user_form").trigger("reset");
        				}
        				else
        				{
        					$.toaster({ message : res.Message, title :'Error', priority : 'danger' });
        				}
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              },
			  error: function (xhr, ajaxOptions, thrownError) {
				//alert(xhr.status);
				//alert(thrownError);
				$.toaster({ message : thrownError, title :xhr.status, priority : 'danger' });
			  }
            }); 
        });
        
      });
    </script>
  </body>
</html>
