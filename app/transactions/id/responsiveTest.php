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
      padding: 0px;
    }
    body{
      overflow: hidden;
    }
    .main-card-body{
      height: 500px;
      overflow-y: scroll;
    }
    .laptopHiDpi{transition: all 1s ease; width: 1440px;margin: 0px auto;}
    .laptopMDpi{transition: all 1s ease; width: 1280px;margin: 0px auto;}
    .ipadL{transition: all 1s ease; width: 1024px;margin: 0px auto;}
    .ipadP{transition: all 1s ease; width: 768px;margin: 0px auto;}
    .st{transition: all 1s ease; width: 480px;margin: 0px auto;}
    .sam{transition: all 1s ease; width: 360px;margin: 0px auto;}
    .iphone{transition: all 1s ease; width: 320px;margin: 0px auto;}
    .card_view, .noissues_btn, .submit_btn {
      display: none !important;
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
        <div class="row" id="info_block">
          <div class="col-md-12 mg-t-20 mg-md-t-0">
            <div class="card bd-0">
              <img class="center-block card-img-top img-fluid" src="images/notImage.png" alt="Image" style="width: 300px; margin:0px auto">
              <div class="card-body rounded-bottom">
                <button class="d-block mx-auto btn btn-md btn-warning templates" data-id="">Choose Class and Topic from Top Side</button>
              </div>
            </div>
          </div>
        </div>
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between card_view">
            <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
              <h6 class="mg-b-0 tx-14 tx-white">Responsive Test</h6>
              <div>
                <select class="form-control" name="device" id="device">
                  <option value="">-Select Device-</option>
                  <?php
                    $query = "SELECT * FROM device WHERE deleted=0";
                    $stmt = $db->query($query);
                    while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                  ?>
                    <option value="<?php echo $fetch['width']; ?>"><?php echo $fetch['device_name']; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
              <div class="card-option tx-24">
                <button type="button" class="btn btn-md btn-success submit_btn" id="submit">Submit</button>
                <button type="button" class="btn btn-md btn-success" id="noissues_btn">Click here if no issues found.</button>
              </div>
            </div><!-- card-header -->
            <div class="card-body main-card-body">
              <form id="layout_form">
                <input type="hidden" name="classid" id="classid"/>
                <input type="hidden" name="topicid" id="topicid" />
                <input type="hidden" name="selected_device" id="selected_device" />
                <div id="review_div"></div>
              </form>
            </div><!-- card-body -->
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- SMALL MODAL -->
    <div id="modal_success" class="modal fade">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Status</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-20">
            <p class="mg-b-5 status_msg"></p>
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
          $("#review_div").attr('class', '');
          $("#device").val("");
          var class_id = $("#class_name").val();
          var topic_id = $(this).val();
          $("#classid").val(class_id);
          $("#topicid").val(topic_id);
          var topic_name = $("#topic option:selected").text();
          //getSlides(class_id,topic_id,topic_name);
          $(".card").removeClass("card_view");
          $("#noissues_btn").addClass("noissues_btn");
          $("#info_block").hide();
          $("#review_div").html("");
        });
        $("#device").change(function(){
          $("#selected_device").val($(this).val());

          var class_id = $("#class_name").val();
          var topic_id = $("#topic").val();
          var topic_name = $("#topic option:selected").text();

          getSlides(class_id,topic_id,topic_name);
        });

        function getSlides(class_id,topic_id,topic_name) {
          if(topic_id != ""){
            $('#div1').html("");
            $.ajax({
              type: "POST",
              url: "../../apis/tasks/getresponsiveslidetest.php",
              data: 'class_id='+class_id+'&topic_id='+topic_id+'&topic_name='+topic_name,
              success: function(data){
                var data = $.parseJSON(data);
                var slides = '';
                $("#noissues_btn").removeClass("noissues_btn");
                $("#info_block").hide();
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
                setTimeout(function(){
                  $('.slideid').prop("disabled", false);
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
        }

        
        $(document).on('click', '.slideid', function() {  
          var slideids = new Array();
          $(".slideid:checked").each(function() {
            slideids.push($(this).val());
          });
          console.log(slideids);
          if(slideids.length>0){
            $("#submit").removeClass("submit_btn");
            $("#noissues_btn").addClass("noissues_btn");
          }else{
            $("#submit").addClass("submit_btn");
            $("#noissues_btn").removeClass("noissues_btn");
          }
        });
        
        $("#noissues_btn").click(function(){
          var selected_device = $("#device").val();
          if(selected_device != null && selected_device != undefined && selected_device != "") {
            formSubmit();
          } else {
            alert("Please choose device");
          }
        });

        $("#submit").click(function(){
          var selected_device = $("#device").val();
          var slideids = new Array();
          $(".slideid:checked").each(function() {
            slideids.push($(this).val());
          });
          if(selected_device != null && selected_device != undefined && selected_device != "") {
            if(slideids.length != 0){
              formSubmit();
            } else {
              alert("Atleast choose one slide, before click on submit");
            }
          } else {
            alert("Please choose device");
          }
        });

        function formSubmit(){
          $.ajax({
            url:"apis/responsiveTestProcess.php",
            method:'POST',
            data:new FormData(document.getElementById("layout_form")),
            contentType:false,
            async:true,
            processData:false,
            success:function(data)
            {
              var data = $.parseJSON(data);
              $("html, body, .main-card-body").animate({ scrollTop: 0 }, "slow");
              $("#info_block").show();
              $("#info_block").hide();
              if(data.status){
                $(".status_msg").html(data.message);
                $("#modal_success").modal("show");
                $('input:checkbox').removeAttr('checked');
                $("#submit").addClass("submit_btn");
                $("#noissues_btn").addClass("noissues_btn");
                $("#device").val("");
                $("#review_div").html("");
              } else {
                $(".status_msg").html("Fail to update, Contact tech team");
                $("#modal_success").modal("show");
              }
            },
            beforeSend: function(){
              $("body").mLoading()
            },
            complete: function(){
              $("body").mLoading('hide')
            }
          });
        }

        //get choosed device
        $('#device').change(function(){
          var device = $(this).val();
          if(device != null && device != undefined && device != ""){
            $('.slideid').prop("disabled", false);
          }
          console.log(device);
          if(device == "1440"){
            $("#review_div").addClass("laptopHiDpi");
            $("#review_div").removeClass("laptopMDpi");
            $("#review_div").removeClass("ipadL");
            $("#review_div").removeClass("ipadP");
            $("#review_div").removeClass("st");
            $("#review_div").removeClass("sam");
            $("#review_div").removeClass("iphone");
          } else if(device == "1280") {
            $("#review_div").addClass("laptopMDpi");
            $("#review_div").removeClass("laptopHiDpi");
            $("#review_div").removeClass("ipadL");
            $("#review_div").removeClass("ipadP");
            $("#review_div").removeClass("st");
            $("#review_div").removeClass("sam");
            $("#review_div").removeClass("iphone");
          } else if(device == "1024") {
            $("#review_div").addClass("ipadL");
            $("#review_div").removeClass("laptopMDpi");
            $("#review_div").removeClass("laptopHiDpi");
            $("#review_div").removeClass("ipadP");
            $("#review_div").removeClass("st");
            $("#review_div").removeClass("sam");
            $("#review_div").removeClass("iphone");
          } else if(device == "768") {
            $("#review_div").addClass("ipadP");
            $("#review_div").removeClass("laptopMDpi");
            $("#review_div").removeClass("ipadL");
            $("#review_div").removeClass("laptopHiDpi");
            $("#review_div").removeClass("st");
            $("#review_div").removeClass("sam");
            $("#review_div").removeClass("iphone");
          } else if(device == "480") {
            $("#review_div").addClass("st");
            $("#review_div").removeClass("laptopMDpi");
            $("#review_div").removeClass("ipadL");
            $("#review_div").removeClass("ipadP");
            $("#review_div").removeClass("laptopHiDpi");
            $("#review_div").removeClass("sam");
            $("#review_div").removeClass("iphone");
          } else if(device == "360") {
            $("#review_div").addClass("sam");
            $("#review_div").removeClass("laptopMDpi");
            $("#review_div").removeClass("ipadL");
            $("#review_div").removeClass("ipadP");
            $("#review_div").removeClass("st");
            $("#review_div").removeClass("laptopHiDpi");
            $("#review_div").removeClass("iphone");
          } else if(device == "320") {
            $("#review_div").addClass("iphone");
            $("#review_div").removeClass("laptopMDpi");
            $("#review_div").removeClass("ipadL");
            $("#review_div").removeClass("ipadP");
            $("#review_div").removeClass("st");
            $("#review_div").removeClass("sam");
            $("#review_div").removeClass("laptopHiDpi");
          }
        });
      });
    </script>
  </body>
</html>