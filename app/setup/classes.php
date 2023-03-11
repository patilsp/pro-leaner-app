<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
include "../functions/db_functions.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$role_id = $_SESSION['user_role_id'];
try {
  include "functions/common_function.php";
  $getCPClasses = getCPClasses();
  $activeClasses = getClassNames("1");
  $inactiveClasses = getClassNames("0");
  $sections = getSectionsData();
  /*echo "<pre/>";
  print_r($getCPClasses);die;*/

  $disableEditAddActionStatusClass = '';
  // if($role_id == 8){
  //   $disableEditAddActionStatusClass = 'disableEditAddAction';
  // }
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

    <title>Virtual School</title>
    <link rel="icon" type="image/png" href="../../img/favicon.png" />


    <!-- vendor css -->
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
    <link rel="stylesheet" href="../../css/class.css">
    <!-- orgchart CSS -->
    <link rel="stylesheet" href="../../lib/orgchart/jquery.orgchart.css?ver=231120211126">
    <link rel="stylesheet" href="<?php echo $web_root ?>assets/lib/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <style type="text/css">
      .orgChartDiv{
          width: auto;
          height: auto;
      }

      .orgChartContainer{
          overflow: auto;
          background: #eeeeee;
      }
      .disableEditAddAction{
        pointer-events: none;
      }
    </style>
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->

    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->
      <div class="br-pagebody">
        
  		<section id="csection">
  			<div class="row new-row-bg">
					<!-- <header class="w-100 mx-auto mb-5 mx-3 d-flex align-items-center">
						<h5 class="flex-grow-1">Classes</h5>
 
						<button class="btn btn-md btn-blue font-weight-medium mr-4 header_button" data-toggle="modal" data-target="#section_count_modal"><i class="fa fa-plus-circle mr-2 text-white"></i>Add Sections</button>
             
            <?php 
            
              if(count($inactiveClasses) > 0) { ?>
              <button class="btn btn-md btn-blue font-weight-medium header_button class_modal_btn" data-toggle="modal" data-target="#class_modal">Add Classes</button>
              <?php } else  if(count($inactiveClasses) == 0) { ?>
              <button class="btn btn-md btn-blue font-weight-medium header_button" data-toggle="modal" data-target="#class_max_modal">Add Classes</button>
              <?php } 
            
            ?>
					</header> -->

					<div class="col-md-12">
            <div class="card">
              <header class="w-100 d-flex flex-column justify-content-between mb-4">
                <div class="card-header">
                  <h6 class="mg-b-0 tx-14 mt-4">Classes</h6>
                  <div class="card-option tx-24">
                    <button class="btn btn-primary mr-4 header_button" data-toggle="modal" data-target="#section_count_modal"><i class="fa fa-plus-circle mr-2 text-white"></i>Add Sections</button>
                  
                  <?php 
                  
                    if(count($inactiveClasses) > 0) { ?>
                    <button class="btn btn-primary header_button class_modal_btn" data-toggle="modal" data-target="#class_modal">Add Classes</button>
                    <?php } else  if(count($inactiveClasses) == 0) { ?>
                    <button class="btn btn-primary header_button" data-toggle="modal" data-target="#class_max_modal">Add Classes</button>
                    <?php } 
                  
                  ?>
                  </div>
                </div>
              </header>
              <div class="row" id="class_modules">
                <div class="accordion w-100 px-6 accordionClass" id="accordionClass">
                  <input type="hidden" name="user_ans" class="sortable1" id="user_ans" />
                  <?php
                  foreach($activeClasses as $thisClass) { ?>

                  <div class="card mb-3 classAccordon" id="card<?php echo $thisClass['id']; ?>">
                    <div class="card-header d-flex bg-white" id="classcch<?php echo $thisClass['id']; ?>">
                      <h4 class="mb-0 flex-grow-1">
                        <input type="text" class="mb-0 flex-grow-1 border-0 ip_classes inputClass" name="class" data-classid="<?php echo $thisClass['id']; ?>" id="class<?php echo $thisClass['id']; ?>" value="<?php echo $thisClass['module']; ?>">
                      </h4>

                      <button type="button" class="btn btn-sm btn-icon btn-light btn-warning mr-2 renameClass" title="Edit Class" role='button' id='rc@<?php echo $thisClass['id']; ?>'>
                        <i class='fa fa-pencil' aria-hidden='true'></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-light btn-success mr-2 move_class_option move_option" title="Move Class" role='button' id='<?php echo $thisClass['id']; ?>' aria-classcardid='card<?php echo $thisClass['id']; ?>'>
                        <i class='fa fa-arrows' aria-hidden='true'></i>
                      </button>

                      <button type="button" class="btn btn-sm btn-icon btn-light btn-danger mr-2 deleteClass" title="Delete Class" id='<?php echo $thisClass['id']; ?>' aria-deletename='<?php echo $thisClass['module']; ?>'>
                        <i class='fa fa-trash' aria-hidden='true'></i>
                      </button>

                      <!-- <button type="button" class="tooltip_options btn btn-yellow h6 mb-0 border-0 mr-5 d-flex align-items-center class<?php echo $thisClass['id']; ?> example" data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>
                    
                        <li class='media align-items-center mb-3 renameClass' role='button' id='rc@<?php echo $thisClass['id']; ?>'>
                          <i class='fa fa-pencil txt-blue mr-3' aria-hidden='true'></i>
                          <div class='media-body'>
                            <p class='mb-0 txt-light-black text-left'>Rename</p>
                          </div>
                        </li>
                      
                        <li class='media align-items-center mb-3 move_class_option move_option' aria-classcardid='card<?php echo $thisClass['id']; ?>' role='button'>
                          <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                          <div class='media-body'>
                            <p class='mb-0 txt-light-black text-left'>Move</p>
                          </div>
                        </li>
                    
                        <li class='media align-items-center deleteClass' role='button'  id='<?php echo $thisClass['id']; ?>' aria-deletename='<?php echo $thisClass['module']; ?>'>
                          <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
                          <div class='media-body'>
                            <p class='mb-0 txt-light-black text-left'>Delete</p>
                          </div>
                        </li>
                        
                      </ul>" data-placement="bottom">Options<img src="../../assets/images/common/icon_more_option.png" class="ml-3"></button>
                     -->
                    
                      <div class="d-flex align-items-center btn btn-sm btn-icon btn-light btn-default" data-toggle="collapse" data-target="#collapse<?php echo $thisClass['id']; ?>" aria-expanded="false" aria-controls="collapse1" role="button">
                        <p class="mb-0 "></p>
                        <i class="fa fa-chevron-down"></i>
                      </div>
                      
                    </div>

                    <div id="collapse<?php echo $thisClass['id']; ?>" class="collapse <?php if(isset($_SESSION['open_class']) && $_SESSION['open_class'] == $thisClass['id']) { echo "show"; unset($_SESSION['open_class']); } ?>" aria-labelledby="classcch<?php echo $thisClass['id']; ?>" data-parent="#accordionClass">
                      <?php if(!isset($sections[$thisClass['id']]) || count($sections[$thisClass['id']]) == 0 ) { ?>
                      <h5 class="text-center txt-grey py-5">There are currently no sections. Add a section to display here....</h5>
                      <?php } else { ?>
                      <div class="card-body my-5">
                        <div class="d-flex flex-wrap dragSection">
                          <?php foreach($sections[$thisClass['id']] as $sectionInfo) { ?>
                          <div class="btn-group sectionDiv mb-3" id="sectionDiv<?php echo $sectionInfo['id']; ?>" role="group">
                            <input type="text" style="text-transform: capitalize;" class="mb-0 ip_section pl-2 txt-black font-weight-medium class_section" name="section" data-classid="<?php echo $sectionInfo['id']; ?>" id="section<?php echo $sectionInfo['id']; ?>" value="<?php echo $sectionInfo['Section']; ?>">
                            
                            <div class="tooltip_optionssection_new btn-group section<?php echo $sectionInfo['id']; ?>" role="group"  data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>
                            
                              <li class='media align-items-center mb-3 renameSection' role='button' id='rs@<?php echo $sectionInfo['id']; ?>'>
                                <i class='fa fa-pencil text-warning mr-3' aria-hidden='true'></i>
                                <div class='media-body'>
                                  <p class='mb-0 txt-light-black text-left'>Rename</p>
                                </div>
                              </li>
                            
                              <li class='media align-items-center mb-3 move_section_option' aria-sectioncardid='sectionDiv<?php echo $sectionInfo['id']; ?>' role='button'>
                                <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                                <div class='media-body'>
                                  <p class='mb-0 txt-light-black text-left'>Move</p>
                                </div>
                              </li>
                          
                              <li class='media align-items-center deleteSection' role='button' id='<?php echo $sectionInfo['id']; ?>' aria-deletename='<?php echo $sectionInfo['Section']; ?>'>
                                <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
                                <div class='media-body'>
                                  <p class='mb-0 txt-light-black text-left'>Delete</p>
                                </div>
                              </li>
                              
                            </ul>" data-placement="bottom">
                            <!-- 
                              <li class='media align-items-center' role='button'>
                                <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                                <div class='media-body'>
                                  <p class='mb-0 txt-light-black text-left'>Move</p>
                                </div>
                              </li> -->
                              <button type="button" class="tooltip_options_new btn btn-secondary bg-transparent txt-black pr-2">
                                <img src="../../assets/images/common/icon_more_option.png">
                              </button>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
					</div>
  			</div>
  		</section>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="class_delete_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center px-5 py-5">
            <img src="../../img/alert.png" class="mb-2">
            <h4 class="font-weight-bold mb-3">Alert</h4>
            <p class="m-0 font-weight-bold">Are you sure you want to delete <span class="action_name"></span>? </p>

            <div class="position-relative d-flex justify-content-center mt-5">
              <button class="btn btn-md btn-blue font-weight-medium yes_bth mr-4" id="delete_class_yes">Yes</button>
              <button class="btn btn-md btn-blue font-weight-medium no_btn" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="section_count_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal_xxxl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="text-center font-weight-bold w-100 mb-0 mt-3">Add Sections</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="text-center mb-4">Select the number of sections in each class</h5>
            <form id="update_section_count_form" method="post" name="update_section_count_form">
              <div class="row justify-content-center text-center bg-grey py-5 mb-4" id="section_count_table">
                <table>
                  <thead>
                    <th class="pr-5 txt-light-black font-weight-medium pb-3">Class</th>
                    <th class="txt-light-black font-weight-medium pb-3">No. of Sections</th>
                  </thead>
                  <tbody>
                    <?php foreach($getCPClasses['classes'] as $class) { 
                      $classId = $class['id'];
                      $classCode = explode(" ", $class['module']);
                      $classCode = $classCode[1];
                      ?>
                    <tr>
                      <td class="pr-5 txt-black font-weight-bold pb-3">Class <?php echo $classCode; ?></td>
                      <td class="pb-3">
                        <input type="number" max="26" min="0" class="form-control text-center" name="section_count_class[<?php echo $classId; ?>]" value="">
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              
              <div class="position-relative text-center w-100 pt-4">
                <input type="hidden" class="form-control text-center" name="type" value="createSectionBasedOnCount">
                <button type="submit" class="btn btn-primary shadow px-5" id="update_section_count_form_save">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="class_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="text-center w-100 ">Select the classes that are in your school</h4>
            <button type="button" class="close" <?php if(count($activeClasses) == 0) { ?>  onclick="document.location='../create.php';" <?php } else { ?> data-dismiss="modal" <?php } ?> aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">            
            <form id="Add_class_form" method="post" name="Add_class_form">
              <?php if(count($activeClasses) > 0) { ?>
              <div class="row text-center  py-5 mb-4" id="activated_classes">
                <?php foreach($activeClasses as $thisClass) { ?>
                <div class="form-check-inline px-3 py-2 mb-3">
                  <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="class-<?php echo $thisClass['module']; ?>" role="pointer">
                    <?php echo $thisClass['module']; ?><input type="checkbox" class="form-check-input ml-4" id="class-<?php echo $thisClass['module']; ?>" value="<?php echo $thisClass['module']; ?>" checked disabled>
                  </label>
                </div>
                <?php } ?>
              </div>
              <?php } ?>
              <?php if(count($inactiveClasses) > 0) { ?>
              <div class="row mb-1 mx-5" id="pending_to_activate_classes">
                <?php foreach($inactiveClasses as $thisClass) { ?>
                <div class="form-check-inline px-3 py-2 mb-3">
                  <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="<?php echo $thisClass['id']; ?>" role="pointer">
                    <?php echo $thisClass['module']; ?><input type="checkbox" class="form-check-input ml-4 selectall" id="<?php echo $thisClass['id']; ?>" name="class[]" value="<?php echo $thisClass['id']; ?>">
                  </label>
                </div>
                <?php } ?>
              </div>
              <div class="position-relative text-center w-100 mb-5">
                <div class="text-center mb-2" id="sellectall_blk">
                  <div class="form-check-inline px-3 py-2 ml-4">
                    <label class="form-check-label d-flex align-items-center w-100" for="selectall" role="pointer">
                      <input type="checkbox" class="form-check-input mr-2" id="selectall">Select All
                    </label>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" class="form-control text-center" name="type" value="createClasses">
                  <button type="submit" class="btn btn-md btn-blue shadow px-5 class_save_active mt-4" id="class_save_submit">Save</button>

                </div>

              </div>
              <?php } ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include("../setup/common-blocks/js.php"); ?>
    <!-- ########## END: MAIN PANEL ########## -->
    <!-- <script src="../../lib/jquery/jquery.js"></script> -->
    <script src="../../lib/popper.js/popper.js"></script>

    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../lib/orgchart/jquery.orgchart.js"></script>
    <script src="../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../js/cms.js"></script>
    <script src="../../js/class.js"></script>
    <script src="../../js/csection.js"></script>
    <script type="text/javascript">
      var openedCard = '';
      var openedCardArray = [];
      var moveactive = "";
      var moveactivesection = "";
    $(document).ready(function(){
    $(document).on("click", ".deleteClass", function() {
      var id = $(this).attr("id");
        $(".action_name").text($(this).attr("aria-deletename"));
        $('#class_delete_modal').modal({ backdrop: 'static', keyboard: false })
        .one('click', '#delete_class_yes', function (e) {
          $.ajax({
                url:"apis/classSectionsUpdate.php",
                method:'POST',
                data: "id="+id+"&type=deleteClass",
                success:function(data)
                {
                  $("#class_delete_modal").modal("hide");
                    var json = $.parseJSON(data);
                    $("#sb_body").html(json.message);
                    
                    if(! json.status) {
                      $("#sb_heading").html("Notice!");
                      var x = document.getElementById("snackbar");
                      x.className = "show";
                      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
                    }
                    if(json.status) {
                      location.reload();
                    }
                },
                beforeSend: function(){
                    //$("body").mLoading()
                },
                complete: function(){
                    //$("body").mLoading('hide')
                }
          });
        });
      });
    $(document).on("click", ".deleteSection", function() {
        var id = $(this).attr("id");
        $(".action_name").text("Section "+$(this).attr("aria-deletename"));
        $('#class_delete_modal').modal({ backdrop: 'static', keyboard: false })
        .one('click', '#delete_class_yes', function (e) {
          $.ajax({
                url:"apis/classSectionsUpdate.php",
                method:'POST',
                data: "id="+id+"&type=deleteSection",
                success:function(data)
                {
                    $("#class_delete_modal").modal("hide");
                    var json = $.parseJSON(data);
                    $("#sb_body").html(json.message);
                    /*
                      $("#sb_heading").html("Success!");
                    } else {
                      
                    }*/
                    if(!json.status) {
                      $("#sb_heading").html("Notice!");
                      var x = document.getElementById("snackbar");
                      x.className = "show";
                      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    }
                    
                    if(json.status) {
                      location.reload();
                    }
                },
                beforeSend: function(){
                    //$("body").mLoading()
                },
                complete: function(){
                    //$("body").mLoading('hide')
                }
          });
        });
      });
    $(document).on("click", ".renameClass", function() {
        var id = $(this).attr("id");
        var temp = id.split("@");
        var catid = temp[1];
        $("#class"+catid).removeClass("ip_classes");
        $("#class"+catid).focus();
      });
    $(document).on('click', '#selectall', function(event){
        if($('#selectall').is(":checked")) {
          $(".selectall"). prop("checked", true);
        } else {
          $(".selectall"). prop("checked", false);
        }
  });
  $(document).on('submit', '#Add_class_form', function(event){
        event.preventDefault();
        $.ajax({
              url:"apis/classSectionsUpdate.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  $("#sb_body").html(json.message);
                  /*if(json.status) {
                    $("#sb_heading").html("Success!");
                  } else {
                    $("#sb_heading").html("Notice!");
                  }
                  var x = document.getElementById("snackbar");
                  x.className = "show";
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);*/
                  $("#class_modal").modal("hide");
                  location.reload();
              },
              beforeSend: function(){
                  //$("body").mLoading()
              },
              complete: function(){
                  //$("body").mLoading('hide')
              }
          });
      });
  $(document).on("focusout", ".class_section", function() {
        var sectionname = $(this).val();
        var secid = $(this).attr('id').replace("section", "");
        $.ajax({
              url:"apis/classSectionsUpdate.php",
              method:'POST',
              data: "sectionname="+sectionname + "&secid=" + secid +"&type=renameSection",
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  $("#sb_body").html(json.message);
                  if(json.status) {
                    $("#sb_heading").html("Success!");
                    $("#section"+secid).addClass("ip_section");
                  } else {
                    $("#sb_heading").html("Notice!");
                    $("#section"+secid).val(json.oldSection);
                    $("#section"+secid).addClass("ip_section");
                  }
                  if(json.oldSection != sectionname) {
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
                    $("#section_count_modal").modal("hide");
                  }
              },
              beforeSend: function(){
                  //$("body").mLoading()
              },
              complete: function(){
                  //$("body").mLoading('hide')
              }
        });
      });
  $(document).on("focusout", ".inputClass", function() {
        var classname = $(this).val();
        var catid = $(this).attr('id').replace("class", "");
        $.ajax({
              url:"apis/classSectionsUpdate.php",
              method:'POST',
              data: "classname="+classname + "&catid=" + catid +"&type=renameClass",
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  $("#sb_body").html(json.message);
                  if(json.status) {
                    $("#sb_heading").html("Success!");
                    $("#class"+catid).addClass("ip_classes");
                  } else {
                    $("#sb_heading").html("Notice!");
                  }
                  if(json.oldClass != classname) {
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
                  }
              },
              beforeSend: function(){
                  //$("body").mLoading()
              },
              complete: function(){
                  //$("body").mLoading('hide')
              }
        });
      });
       $(document).on("click", ".renameSection", function() {
        var id = $(this).attr("id");
        var temp = id.split("@");
        var catid = temp[1];
        $("#section"+catid).removeClass("ip_section");
        $("#section"+catid).focus();
      });
       $(document).on('submit', '#update_section_count_form', function(event){
        event.preventDefault();
        $.ajax({
              url:"apis/classSectionsUpdate.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  $("#sb_body").html(json.message);
                  /*if(json.status) {
                    $("#sb_heading").html("Success!");
                  } else {
                    $("#sb_heading").html("Notice!");
                  }
                  var x = document.getElementById("snackbar");
                  x.className = "show";
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);*/
                  $("#section_count_modal").modal("hide");
                  location.reload();
              },
              beforeSend: function(){
                  //$("body").mLoading()
              },
              complete: function(){
                  //$("body").mLoading('hide')
              }
          });
      });
  })
    </script>
    
  </body>
</html>
