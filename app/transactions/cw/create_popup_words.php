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

    <title></title>

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
    .table tr:first-child, .table th:first-child, .table td:first-child {
          padding-left: 10px !important;
      }
      #dictonary{
        margin-top:120px !important
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
     
      <div class="br-pagebody">
        <!-- start you own content here -->
        <section id="dictonary" class="mt-4">
        <div class="row new-row-bg">
          <div class="col-md-12">
            <div class="card h-100 d-flex flex-column justify-content-between">
              <div class="card-header tx-medium bd-0 tx-white bg-dark">
                
                <h6 class="mg-b-0 mt-2 mb-2">Add Dictonary</h6>
              </div><!-- card-header -->
              <form class="user_form form-horizontal" action="create_user.php" name="user_form" id="user_form" method="POST">
                <div class="card-body bd bd-t-0 rounded-bottom">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Class:<span class="required_icon" style="color:red;">*</span></label>
                        <select class="form-control" name="classes" id="classes" required>
                            <option value="">-Select Class-</option>
                            <?php
                            for($i=1; $i<=12; $i++)
                            {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Topic:<span class="required_icon" style="color:red;">*</span></label>
                        <select class="form-control" name="topic_id" id="topic_id" required>
                            <option value="">-Select Topic-</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Slide:<span class="required_icon" style="color:red;">*</span></label>
                        <select class="form-control" name="slide_id" id="slide_id" required>
                            <option value="">-Select Slide-</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  
                  <div class="row">
                    <table id="tb" class="table table-responsive">
                    <thead>
                      <tr>
                        <th>Word</th>
                        <th>Meaning</th>
                        <th><a style="font-size:8px;" id="addMore" title="Add More Rows" class="btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i></a></th>
                      </tr>
                    </thead> 
                    <tbody id="tbodyData">
                      <tr>
                        <td><input type="text" class="form-control word" name="word[]" value="" id="word"></td>
                        <td><input type="text" class="form-control meaning" name="meaning[]" id="meaning" value=""></td>
                        <td><a style="font-size:8px;" class='remove btn btn-danger'><i class="fa fa-window-close" aria-hidden="true"></i></a></td>
                      </tr>
                    </tbody>
                    </table>
                  </div>
                  
                  
                </div><!-- card-body -->
              
                <div class="card-footer bd bd-t-0 d-flex justify-content-between">
                  <a href="<?php echo $web_root ?>app/home.php" class="btn btn-md btn-danger">Cancel</a>
                  <button type="button" class="btn btn-md btn-info pull-right" id="submit" name="submit">Submit</button>
                </div><!-- card-footer -->
              </form>   
            </div>
          </div>
        </div>
        <div id="toast"><div id="img">Status</div><div id="desc"></div></div>
        
        </section>
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

        $('#addMore').on('click', function() {
          var last_row = $('#tb > tbody  > tr').last();
              if(hasValues(last_row)) 
          {
            var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
            //$(".hasDatepicker").removeClass("hasDatepicker").removeAttr("id");
            data.find("input").val('');
            data.find("select").val('');
          }
            });
        
        function hasValues(row){
          var optVal = row.find('.word').prop('value');
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
        
        $("#classes").change(function(event){
            event.preventDefault();
            $.ajax({
              url:"<?php echo $web_root; ?>app/apis/tasks/getTopics.php",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                var data = $.parseJSON(data);
                var options = '<option value="">-Select Topic-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].description + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Topics Availlable</option>';
                }
                $("#topic_id").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            }); 
        });
		
		    $("#topic_id").change(function(event){
            event.preventDefault();
            $.ajax({
              url:"<?php echo $web_root; ?>app/apis/tasks/getSlideNames.php",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $("#slide_id").html(data);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            }); 
        });

        $("#slide_id").change(function(event){
            event.preventDefault();
            $.ajax({
              url:"<?php echo $web_root; ?>app/apis/tasks/getPOPUpWords.php",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                data = jQuery.parseJSON(data);
                var result = data.result;
                $("#tbodyData").find("tr:gt(0)").remove();
                if(result.length >= 1) {
                  $(".word").val(result[0]['word']);
                  $(".meaning").val(result[0]['meaning']);
                } else {
                  $(".word").val("");
                  $(".meaning").val("");
                }
                for(var i = 1; i<result.length; i++) {
                  var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                  data.find("#word").val(result[i]['word']);
                  data.find("#meaning").val(result[i]['meaning']);
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
		
		
		
		$("#submit").click(function(event){
            $.ajax({
              url:"<?php echo $web_root; ?>app/apis/tasks/savepopupwords.php",
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
        					$("#tbodyData").find("tr:gt(0)").remove();
                  $("#user_form").trigger("reset");
        				}
        				else
        				{
        					$.toaster({ message : res.Message, title :'Error', priority : 'danger' });
        				}
              },
              beforeSend: function(){
                //$("body").mLoading()
              },
              complete: function(){
                //$("body").mLoading('hide')
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
