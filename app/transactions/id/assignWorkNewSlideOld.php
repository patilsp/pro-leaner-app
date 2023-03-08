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
    <!-- <link href="../../../lib/fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/> -->
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    
  </head>
  <style type="text/css">
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
    .ps{
      overflow-y: visible !important;
    }
    .br-mainpanel {
      margin-left: 0px;
    }
    #new_slide_btn .btn{
      padding: 4.65rem 0.75rem;
    }
  </style>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/AWNS_SlideSlidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/reviewSlideHeader.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Assign Work For New Slides</h6>
          <?php include("../../fixed-blocks/getWork_AWNS.php"); ?>
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    <div id="modaldemo3" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog modal-lg" role="document" style="right: 0;transition: opacity 0.3s linear, right 0.3s ease-out;position: fixed;margin: auto;width: 620px;height: 100%;transform: translate3d(0%, 0, 0);">
        <div class="modal-content tx-size-sm" style="height: 100%;overflow-y: auto;border-radius: 0;border: none;">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Instruction</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" id="new_task_form" enctype="multipart/form-data">
            <div class="modal-body pd-20">
              <input type="hidden" name="slide_id" id="slide_id" value=""/>
              <input type="hidden" name="slide_classid" id="slide_classid" value=""/>
              <input type="hidden" name="slide_topicid" id="slide_topicid" value=""/>
              <input type="hidden" name="slide_path" id="slide_path" value=""/>
              <input type="hidden" name="slide_btnid" id="slide_btnid" value=""/>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="status_cw">Number Of Slides for Selected button:</label>
                    <select class="form-control" name="no_slides" id="no_slides">
                      <option value="">- Select NO Slides -</option>
                      <?php
                        $slide_length = 10;
                        for ($i=1; $i <= $slide_length; $i++) { 
                      ?>
                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" id="role_block">
                  
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info" />
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>
    <!-- <div class="center inst_btn hidden-xs-block hidden-sm-block visible-md-block visible-lg-block" data-toggle="modal" data-target="#modaldemo3" id="inst_btn">
        <a href="#">Instruction</a>
    </div> -->
    
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <!-- <script src="../../../lib/fileinputs/js/fileinput.js" type="text/javascript"></script> -->
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';
        
        $("#no_slides").change(function(){
          var no_slides = $(this).val();
          var logged_user_id = "<?php echo $logged_user_id ?>";
          if(no_slides != "") {
            $.ajax({
              type: "POST",
              url: "../../apis/tasks/getSlideCardsAWNS.php",
              data: "no_slides="+no_slides+"&logged_user_id="+logged_user_id,
              success: function(data){
                console.log(data);
                $("#role_block").html(data);
                $(".cw_block").hide();
                $(".tt_block").hide();

                $(".slide_type").change(function(){
                  console.log("came");
                  if($(this).val() == "ls"){
                    $(".slide_type").closest('card-body').find('.cw_block').show();
                    $(".slide_type").closest('card-body').find('.tt_block').hide();
                  } else {
                    $(".slide_type").closest('div.cw_block').hide();
                    $(".slide_type").closest('div.tt_block').show();  
                  }
                  
                })
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          }
        });

        $('#new_task_form').on('submit', function(event){
          event.preventDefault();
          var dept = new Array();
          $(".dept_type:checked").each(function() {
            dept.push($(this).val());
          });
          //console.log(dept.length);
          if((dept.length != 0 && $("#main_status").val() == 11) || $("#main_status").val() == 10)
          {
            $.ajax({
              url:"assignWorkProcess.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                //console.log(data);
                var json = $.parseJSON(data);
                console.log(json.status);
                if(json.status){
                  document.getElementById("new_task_form").reset();
                  $(".close").trigger('click');
                  //$("#inst_btn").hide();
                  $("#user_cw").removeAttr("required");
                  $("#user_tt").removeAttr("required");
                  $("#user_gd").removeAttr("required");
                  $("#user_vd").removeAttr("required");
                  $("#ass_to").addClass("ass_to");
                  $("#cw_blk").addClass("cw_blk");
                  $("#vd_blk").addClass("vd_blk");
                  $("#gd_blk").addClass("gd_blk");
                  $("#tt_blk").addClass("tt_blk");
                  $.toaster({ message : 'Successful Updated.', title : 'Well done!', priority : 'success' });
                  if(json.slide == "ok") {
                    $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-checkmark-circled'></i>");
                  }
                  else {
                    $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-backspace'></i>");
                  }
                  console.log("success");
                } else {
                  $.toaster({ message : 'Are you getting error, Please contact tech team.', title : 'Oh No!', priority : 'danger' });
                  console.log("fail");
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
          else
          {
            alert("Atleast select one department");
          }
        });

        $("#class_name").change(function(){
          var class_id = $(this).val();
          if(class_id != ""){
            $.ajax({
              type: "POST",
              url: "../../apis/tasks/getTopics.php",
              data: 'classes='+class_id,
              success: function(data){
                var data = $.parseJSON(data);
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
          $('#div1').html("");
          $.ajax({
            type: "POST",
            url: "../../apis/tasks/getAWNS.php",
            data: 'class_id='+class_id+'&topic_id='+topic_id,
            success: function(data){
              var data = $.parseJSON(data);
              var slides = '';
              if(data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                  {
                    slides += data[i];
                  }
                }
              } else {
                slides += '<div class="col-md-12 mg-t-20 mg-md-t-0"><div class="card bd-0"><img class="card-img-top img-fluid" src="../id/images/notImage.png" alt="Image"><div class="card-body rounded-bottom"><button class="d-block mx-auto btn btn-md btn-warning templates" data-id="">Choose Class and Topic</button></div></div></div>';
              }
              $("#review_div").html(slides).show(1000);

              $(".review_slide_btn").click(function(){
                var slidepath = $(this).attr("data-id");
                var slidepath_id = $(this).attr("data-val");
                var slidepath_classid = $(this).attr("data-val1");
                var slidepath_topicid = $(this).attr("data-val2");
                var slide_btnid = this.id;
                
                $("#slide_id").val(slidepath_id);
                $("#slide_classid").val(slidepath_classid);
                $("#slide_topicid").val(slidepath_topicid);
                $("#slide_path").val(slidepath);
                $("#slide_btnid").val(slide_btnid);
                console.log(slidepath);
                //$("#inst_btn").show();
              });
            },
            beforeSend: function(){
              $("body").mLoading()
            },
            complete: function(){
              $("body").mLoading('hide')
            }
          });
        });
      });
    </script>
  </body>
</html>
