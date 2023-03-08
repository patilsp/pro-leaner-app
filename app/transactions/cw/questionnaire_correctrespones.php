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
    .checkbox-inline{
      display: flex;
      align-items: center;
    }
    .checkbox-inline select {
      width: 80px;
      margin-right: 1rem;
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
            Scenario - Correct Responses
          </div><!-- card-header -->
          <form class="user_form form-horizontal" action="create_user.php" name="user_form" method="POST" enctype="multipart/form-data" id="user_form">
            <div class="card-body bd bd-t-0 rounded-bottom">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Class:<span class="required_icon" style="color:red;">*</span></label>
                    <select class="form-control" name="class1" id="class1" required>
                        <option value="">-Select Class-</option>
                        <?php
                        for($i=5; $i<=12; $i++)
                        {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
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
                    <label for="title">Scenario:<span class="required_icon" style="color:red;">*</span></label>
                    <select class="form-control" name="questionnaire" id="questionnaire" required>
                        <option value="">-Select Scenario-</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title">Situation:<span class="required_icon" style="color:red;">*</span></label>
                    <select class="form-control" name="questionno" id="questionno" required>
                        <option value="">-Select Question No-</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12" id="question_audio">
                </div>
              </div>
              
              <div class="row">
              	<div class="col-md-12" id="question_text">
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

              <div class="row">
                <div class="col-md-12" id="feedbackImage">
                  
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
        
        $("#class1").change(function(event){
            event.preventDefault();
            $.ajax({
              url:"<?php echo $web_root; ?>app/apis/tasks/updateQuestionnaire.php?type=getTopics",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $("#topic").html(data);
				$("#questionnaire").val("");
				$("#questionno").val("");
				$("#question_text").html("");
        $("#question_audio").html("");
        $("#feedbackImage").html("");
				$("#question_options").html("");
				$("#feedback").html("");
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
            event.preventDefault();
            $.ajax({
              url:"<?php echo $web_root; ?>app/apis/tasks/updateQuestionnaire.php?type=getQuestionnaire",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $("#questionnaire").html(data);
				$("#questionno").val("");
				$("#question_text").html("");
        $("#question_audio").html("");
        $("#feedbackImage").html("");
				$("#question_options").html("");
				$("#feedback").html("");
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            }); 
        });
		
		$("#questionnaire").change(function(event){
            event.preventDefault();
            $.ajax({
              url:"<?php echo $web_root; ?>app/apis/tasks/updateQuestionnaire.php?type=getQuestionRef",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $("#questionno").html(data);
				$("#question_text").html("");
        $("#question_audio").html("");
        $("#feedbackImage").html("");
				$("#question_options").html("");
				$("#feedback").html("");
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            }); 
        });
		
		$("#questionno").change(function(event){
            event.preventDefault();
            $.ajax({
              url:"<?php echo $web_root; ?>app/apis/tasks/updateQuestionnaire.php?type=getSituationInfo",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                var res = $.parseJSON(data);
				$("#question_text").html(res.QuestionText);
        $("#question_audio").html(res.QuestionAudio);
        $("#feedbackImage").html(res.feedbackImg);
				$("#question_options").html(res.Display);
				$("#feedback").html(res.FeedbackDisplay);
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
              url:"<?php echo $web_root; ?>app/apis/tasks/updateQuestionnaire.php?type=saveCorrectResponses",
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
					$("#questionno").val("");
					$("#question_text").html("");
          $("#question_audio").html("");
          $("#feedbackImage").html("");
					$("#question_options").html("");
					$("#feedback").html("");
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

      $(document).ready(function(){
        var inputId = '';
        var feedbackId = '';
        var grade = '';
        var qustId = '';
        $(document).on('change','.feedAudioFile',function(){
          inputId = $(this).attr('id');
          grade = $(this).attr('data-grade');
          var property = document.getElementById(inputId).files[0];
          var image_name = property.name;
          var image_extension = image_name.split('.').pop().toLowerCase();

          if(jQuery.inArray(image_extension,['mp3','']) == -1){
            alert("Invalid audio file. upload only mp3 format");
            return false;
          }

          var classId = $('#class1 :selected').text();
          var topicName = $('#topic :selected').text();
          topicName = topicName.replace(/\s+/g, '');
          var folderName = 'scenarioC'+classId+topicName;
          feedbackId = $(this).attr('data-id');

          var form_data = new FormData();
          form_data.append("file",property);
          $.ajax({
            url:"<?php echo $web_root; ?>app/apis/tasks/updateQuestionnaireAudio.php?type=saveFeedbackAudio&feedbackId="+feedbackId+"&folderName="+folderName,
            method:'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
              //$('#msg').html('Loading......');
            },
            success:function(data){
              var child3 = $('#'+inputId).parent().find('audio');
              if(child3.length > 0) {
                console.log('true', '#audio'+grade);

                $(document).find('#audio'+grade).remove();
                $('#'+inputId).parent().append('<audio controls id="audio'+grade+'"><source src="'+data+'" type="audio/mpeg">Your browser does not support the audio element.</audio>');
              } else {
                $('#'+inputId).parent().append('<audio controls id="audio'+grade+'"><source src="'+data+'" type="audio/mpeg">Your browser does not support the audio element.</audio>');
              }
            }
          });
        });

        //audio upload for question
        $(document).on('change','.qustAudioFile',function(){
          inputId = $(this).attr('id');
          var property = document.getElementById(inputId).files[0];
          var image_name = property.name;
          var image_extension = image_name.split('.').pop().toLowerCase();

          if(jQuery.inArray(image_extension,['mp3','']) == -1){
            alert("Invalid audio file. upload only mp3 format");
            return false;
          }

          var classId = $('#class1 :selected').text();
          var topicName = $('#topic :selected').text();
          topicName = topicName.replace(/\s+/g, '');
          var folderName = 'scenarioC'+classId+topicName;
          qustId = $(this).attr('data-id');

          var form_data = new FormData();
          form_data.append("file",property);
          $.ajax({
            url:"<?php echo $web_root; ?>app/apis/tasks/updateQuestionnaireAudio.php?type=saveQuestionAudio&qustId="+qustId+"&folderName="+folderName,
            method:'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
              //$('#msg').html('Loading......');
            },
            success:function(data){
              var child3 = $('#'+inputId).parent().find('audio');
              if(child3.length > 0) {
                console.log('true', '#audio'+qustId);

                $(document).find('#qustaudio'+qustId).remove();
                $('#'+inputId).parent().append('<audio controls id="qustaudio'+qustId+'"><source src="'+data+'" type="audio/mpeg">Your browser does not support the audio element.</audio>');
              } else {
                $('#'+inputId).parent().append('<audio controls id="qustaudio'+qustId+'"><source src="'+data+'" type="audio/mpeg">Your browser does not support the audio element.</audio>');
              }
            }
          });
        });

        //image upload for question feedback
        $(document).on('change','.feedbackImageFile',function(){
          inputId = $(this).attr('id');
          var property = document.getElementById(inputId).files[0];
          var image_name = property.name;
          var image_extension = image_name.split('.').pop().toLowerCase();

          if(jQuery.inArray(image_extension,['jpeg', 'jpg', 'png', 'gif', 'svg', '']) == -1){
            alert("Invalid Image file. upload only 'jpeg/jpg/png/gif/svg' format");
            return false;
          }

          var classId = $('#class1 :selected').text();
          var topicName = $('#topic :selected').text();
          topicName = topicName.replace(/\s+/g, '');
          var folderName = 'scenarioC'+classId+topicName;
          qustId = $(this).attr('data-id');

          var form_data = new FormData();
          form_data.append("file",property);
          $.ajax({
            url:"<?php echo $web_root; ?>app/apis/tasks/updateQuestionnaireAudio.php?type=saveQuestionFeedbackImage&qustId="+qustId+"&folderName="+folderName,
            method:'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
              //$('#msg').html('Loading......');
            },
            success:function(data){
              console.log('#feedbackImage'+qustId);
              $(document).find('#feedbackImage'+qustId).html('');
              $(document).find('#feedbackImage'+qustId).html('<img src="'+data+'" class="w-100" style="max-width: 200px;">');
            }
          });
        });
      });
    </script>
  </body>
</html>
