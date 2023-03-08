<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
include "../../functions/common_functions.php";
//include_once "../session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
try{
  $getClasses = getClasses();
  $getStatus = getStatus();
  $getUsers = getUsers("",$logged_user_id);
} catch(Exception $exp){
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

    <title></title>

    <!-- vendor css -->
    <link href="../../../lib/bootstrap/glyphicons.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../../lib/fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    
  </head>
  <style type="text/css">
    .br-mainpanel {
      margin-left: 0px;
    }
    .br-pagebody {
      margin-top: 0px;
    }
    .br-section-wrapper {
      padding: 14px;
    }
    /*Sticky button register*/
    .center{
      position: fixed;
      top: 35%;
      right: -10px;
      width: 110px;
      height: 0px;
      text-align: right;
      z-index: 9999;
      margin-top: -15px;
    }

    .center a{
      transform: rotate(-90deg);
      -webkit-transform: rotate(-90deg); 
      -moz-transform: rotate(-90deg); 
      -o-transform: rotate(-90deg); 
      filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
      display: block; 
      background: #e96f35; 
     text-align:center;
      height: 48px; 
      width: 165px;
      padding: 10px 16px;
      color: #fff; 
      font-family: Arial, sans-serif; 
      font-size: 15px; 
      font-weight: bold; 
      text-decoration: none; 
      border-bottom: solid 1px #333; /*border-left: solid 1px #333; border-right: solid 1px #fff;*/
    }
    .cw_blk,.vd_blk,.gd_blk,.tt_blk,.ass_to{
      display: none;
    }
    .btn-secondary.active{
      background-color: #DC3545;
      background-image: none;
      border-color: #DC3545;
    }
    .ps{
      overflow-y: visible !important;
    }
    label.checked_btn{
      white-space: normal;
    }
    .container_card .card .main_header{
      -webkit-box-shadow: 3px 3px 5px 6px #ccc;
      -moz-box-shadow: 3px 3px 5px 6px #ccc;
      box-shadow: 0px 0px 5px 6px #ccc;
    }
    #review_div .templates_div{
      margin-bottom: 5px;
    }
  </style>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo bg-br-primary"><a href="<?php echo $web_root; ?>app/home.php"><span>[</span><i class="menu-item-icon ion-ios-undo-outline tx-16">Return to Home</i><span>]</span></a></div>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/MHSlideHeader.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="row" id="review_div">
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- SMALL MODAL -->
    <div id="move_here_diabled" class="modal fade">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Notice</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-20">
            <p class="mg-b-5">This feature is disabled, Please Contact Tech Team </p>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/fileinputs/js/fileinput.js" type="text/javascript"></script>
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';
        $("#main_card").hide();

        $("#class_name").change(function(){
          var class_id = $(this).val();
          if(class_id != ""){
            $.ajax({
              type: "POST",
              url: "../../apis/tasks/getTopicsRMVisible.php",
              data: 'classes='+class_id,
              success: function(data){
                var data = $.parseJSON(data);
                console.log(data);
                var options = '<option value="">-Select Topics-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].description + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Topics Availlable</option>';
                }
                $("#topic").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          } else {
            var options = '<option value="">-Select Topics-</option>';
            $("#topic").html(options);
          }
        });

        $("#topic").change(function(){
          var class_id = $("#class_name").val();
          var topic_id = $(this).val();
          var topic_name = $("#topic option:selected").text();
          if(topic_id != ""){
            $('#div1').html("");
            $.ajax({
              type: "POST",
              url: "../../apis/tasks/getMHLeftSlideTest.php",
              data: 'class_id='+class_id+'&topic_id='+topic_id+'&topic_name='+topic_name,
              success: function(data){
                var data = $.parseJSON(data);
                var slides = '';
                if(data.length > 0) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      slides += data[i];
                    }
                  }

                  $("#main_card").show(1000);
                } else {
                  slides += '<div class="col-md-12 mg-t-20 mg-md-t-0"><div class="card bd-0"><img class="card-img-top img-fluid" src="../id/images/notImage.png" alt="Image"><div class="card-body rounded-bottom"><button class="d-block mx-auto btn btn-md btn-warning templates" data-id="">Choose Class and Topic</button></div></div></div>';
                }
                $("#review_div").html(slides).show(1000);
                $("#container_slides").html("");

                $('.slidepath').change(function(){
                  if($("#diff_class").val() != ""){
                    var topic_id = $("#dest_topic").val();
                    var topic_name = $("#dest_topic option:selected").text();
                    var class_id = $("#diff_class").val();
                    var slide_id = $( 'input[name=slidepath]:checked' ).val();
                    console.log("came11111");
                    if(slide_id != null && class_id != null) {
                      if(topic_id != null && class_id != null){
                        $.ajax({
                          type: "POST",
                          url: "apis/getMHContainerSlide.php",
                          data: 'class_id='+class_id+'&topic_id='+topic_id+'&slide_id='+slide_id+'&topic_name='+topic_name,
                          success: function(data){
                            $("#container_slides").html(data).show(1000);

                            $(".move_here").click(function(){
                              //$("#move_here_diabled").modal("show");
                              var page_id = $( 'input[name=slidepath]:checked' ).val();
                              var desti_course_id = $(this).data("destcourseid");
                              var desti_lesson_id = $(this).data("destlessonid");
                              var desti_destprevid = $(this).data("destprevid");
                              console.log("page_id="+page_id+"&desti_course_id="+desti_course_id+"&desti_lesson_id="+desti_lesson_id+"&desti_destprevid="+desti_destprevid);
                              $.ajax({
                                type: "POST",
                                url: "apis/moveSlide.php",
                                data: "page_id="+page_id+"&desti_course_id="+desti_course_id+"&desti_lesson_id="+desti_lesson_id+"&desti_destprevid="+desti_destprevid,
                                success: function(data){
                                  var data = $.parseJSON(data);
                                  location.reload();
                                  console.log(data);
                                },
                                beforeSend: function(){
                                  $("body").mLoading()
                                },
                                complete: function(){
                                  $("body").mLoading('hide')
                                }
                              });
                            });
                          },
                          beforeSend: function(){
                            $("body").mLoading()
                          },
                          complete: function(){
                            $("body").mLoading('hide')
                          }
                        });
                      }
                    } else {
                      alert("Please Choose Slide...")
                    }
                  }
                });
                
                $(".diff_class").change(function(){
                  var class_id = $("#class_name").val();
                  var topic_id = $("#topic").val();

                });
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          } else {
            $("#main_card").hide(1000);
          }


          //this code for destination of same topic name of different class
          /*if(class_id != ""){
            $.ajax({
              type: "POST",
              url: "../../apis/tasks/getTopicsClassMH.php",
              data: 'class_id='+class_id+'&topic_id='+topic_id,
              success: function(data){
                var data = $.parseJSON(data);
                var options = '<option value="">-Select Class-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].id + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Class Availlable</option>';
                }
                $("#diff_class").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          } else {
            var options = '<option value="">-Select Class-</option>';
            $("#diff_class").html(options);
          }*/
        });
        
        //this code for destination of same topic name of different class
        /*$("#diff_class").change(function(){
          if($("#diff_class").val() != "") {
            var topic_id = $("#topic").val();
            var topic_name = $("#topic option:selected").text();
            var class_id = $("#diff_class").val();
            var slide_id = $( 'input[name=slidepath]:checked' ).val();
            if(slide_id != null && class_id != null) {
              if(topic_id != null && class_id != null){
                $.ajax({
                  type: "POST",
                  url: "apis/getMHContainerSlide.php",
                  data: 'class_id='+class_id+'&topic_id='+topic_id+'&slide_id='+slide_id+'&topic_name='+topic_name,
                  success: function(data){
                    $("#container_slides").html(data).show(1000);

                    $(".move_here").click(function(){
                      //$("#move_here_diabled").modal("show");
                      var page_id = $( 'input[name=slidepath]:checked' ).val();
                      var desti_course_id = $(this).data("destcourseid");
                      var desti_lesson_id = $(this).data("destlessonid");
                      var desti_destprevid = $(this).data("destprevid");
                      console.log("page_id="+page_id+"&desti_course_id="+desti_course_id+"&desti_lesson_id="+desti_lesson_id+"&desti_destprevid="+desti_destprevid);
                      $.ajax({
                        type: "POST",
                        url: "apis/moveSlide.php",
                        data: "page_id="+page_id+"&desti_course_id="+desti_course_id+"&desti_lesson_id="+desti_lesson_id+"&desti_destprevid="+desti_destprevid,
                        success: function(data){
                          var data = $.parseJSON(data);
                          console.log(data);
                          location.reload();
                        },
                        beforeSend: function(){
                          $("body").mLoading()
                        },
                        complete: function(){
                          $("body").mLoading('hide')
                        }
                      });
                    });
                  },
                  beforeSend: function(){
                    $("body").mLoading()
                  },
                  complete: function(){
                    $("body").mLoading('hide')
                  }
                });
              }
            } else {
              alert("Please Choose Slide...")
            }
          }
        });*/


        $("#diff_class").change(function(){
          var class_id = $(this).val();
          if(class_id != ""){
            $.ajax({
              type: "POST",
              url: "../../apis/tasks/getTopics.php",
              data: 'classes='+class_id,
              success: function(data){
                var data = $.parseJSON(data);
                console.log(data);
                var options = '<option value="">-Select Topics-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].description + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Topics Availlable</option>';
                }
                $("#dest_topic").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          } else {
            var options = '<option value="">-Select Topics-</option>';
            $("#dest_topic").html(options);
          }
        });

        $("#dest_topic").change(function(){
          if($("#diff_class").val() != "") {
            var topic_id = $("#dest_topic").val();
            var topic_name = $("#dest_topic option:selected").text();
            var class_id = $("#diff_class").val();
            var slide_id = $( 'input[name=slidepath]:checked' ).val();
            if(slide_id != null && class_id != null) {
              if(topic_id != null && class_id != null){
                $.ajax({
                  type: "POST",
                  url: "apis/getMHContainerSlide.php",
                  data: 'class_id='+class_id+'&topic_id='+topic_id+'&slide_id='+slide_id+'&topic_name='+topic_name,
                  success: function(data){
                    $("#container_slides").html(data).show(1000);

                    $(".move_here").click(function(){
                      //$("#move_here_diabled").modal("show");
                      var page_id = $( 'input[name=slidepath]:checked' ).val();
                      var desti_course_id = $(this).data("destcourseid");
                      var desti_lesson_id = $(this).data("destlessonid");
                      var desti_destprevid = $(this).data("destprevid");
                      console.log("page_id="+page_id+"&desti_course_id="+desti_course_id+"&desti_lesson_id="+desti_lesson_id+"&desti_destprevid="+desti_destprevid);
                      $.ajax({
                        type: "POST",
                        url: "apis/moveSlide.php",
                        data: "page_id="+page_id+"&desti_course_id="+desti_course_id+"&desti_lesson_id="+desti_lesson_id+"&desti_destprevid="+desti_destprevid,
                        success: function(data){
                          var data = $.parseJSON(data);
                          console.log(data);
                          location.reload();
                        },
                        beforeSend: function(){
                          $("body").mLoading()
                        },
                        complete: function(){
                          $("body").mLoading('hide')
                        }
                      });
                    });
                  },
                  beforeSend: function(){
                    $("body").mLoading()
                  },
                  complete: function(){
                    $("body").mLoading('hide')
                  }
                });
              }
            } else {
              alert("Please Choose Slide...")
            }
          }
        });
      });
    </script>
  </body>
</html>