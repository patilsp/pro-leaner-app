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
  // $getCPClasses = getCPClasses();
  // $activeClasses = getClassNames("1");
  // $inactiveClasses = getClassNames("0");
  /*echo "<pre/>";
  print_r($getCPClasses);die;*/
  $activeClasses = getClassNames("1");
  $subjectList = getSubjectList();
  $subjectCategories = getCategoryList();

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

    <title></title>

    <!-- vendor css -->
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
    <link rel="stylesheet" href="../../css/subject.css">
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
      .p-35{
        padding: 35px
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
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">

      <section id="subject">
        <div class="row new-row-bg">      
          
          <div class="col-12">
          <header class="w-100 d-flex flex-column justify-content-between mb-4">
              <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark-1">
                <h6 class="mg-b-0 tx-14 tx-white">Subjects</h6>
                <div class="card-option tx-24">
                  <button class="btn btn-md btn-blue font-weight-medium mr-4" data-toggle="modal" data-target="#parent_subject_modal">Add Subjects</button>
                </div>
              </div>
          </header>
            <div class="row" id="parent_subject_modules">
              <div class="position-relative d-flex align-items-center px-5 col-12" id="main_card_header">
                <label class="txt-grey col-1 text-center d-flex align-items-center justify-content-start">S.No.</label>
                <label class="txt-grey col-2 d-flex align-items-center justify-content-start ml-3">Subject</label>
                <label class="txt-grey col-7 d-flex align-items-center justify-content-end">Category</label>
                <label class="txt-grey col-2 d-flex align-items-center justify-content-center">Action</label>
              </div>

              <div class="accordion w-100 accordionClass" id="accordionClass">
                <?php foreach($subjectList as $key=>$thisSubject) { ?>
                <div class="card mb-3 border-0 classAccordon" id="card<?php echo $thisSubject['id']; ?>">
                  <div class="card-header d-flex align-items-center bg-white" id="card<?php echo $thisSubject['id']; ?>">
                    <h5 class="col-1 mb-0 font-weight-medium"><?php echo $key+1; ?></h5>
                    <h5 class="mb-0 col-2">
                      <input type="text" class="mb-0 flex-grow-1 border-0 ip_classes font-weight-medium inputClass" name="subject_name" data-classid="<?php echo $thisSubject['id']; ?>" id="subject<?php echo $thisSubject['id']; ?>" value="<?php echo $thisSubject['module']; ?>">
                    </h5>
                    <div class="d-flex align-items-center justify-content-end col-9">
                      <h5 class="mr-5 font-weight-medium mb-0 txt-grey"><?php echo $thisSubject['class']; ?></h5>
                      <h5 class="mr-5 font-weight-medium mb-0 txt-grey"><?php echo $thisSubject['category_name']; ?></h5>
                      
                        <!-- <button class="text-black btn btn-md subj_sub_btn mr-3 font-weight-medium addSubSubject1" data-toggle="modal" data-target="#child_subject_modal">Add Sub-level</button> -->
                     
                      <button type="button" class="btn btn-yellow h6 mb-0 border-0 mr-3 d-flex align-items-center tooltip_options subjectL1<?php echo $thisSubject['id']; ?>" data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>
                         
                        <li class='media align-items-center mb-3 editDetails' role='button' id='ed@<?php echo $thisSubject['id']; ?>'>
                          <i class='fa fa-pencil-square txt-blue mr-3' aria-hidden='true'></i>
                          <div class='media-body'>
                            <p class='mb-0 txt-light-black text-left'>Edit Details</p>
                          </div>
                        </li>
                        <li class='media align-items-center mb-3 renameSubjectL1' role='button' id='rs1@<?php echo $thisSubject['id']; ?>'>
                          <i class='fa fa-pencil txt-blue mr-3' aria-hidden='true'></i>
                          <div class='media-body'>
                            <p class='mb-0 txt-light-black text-left'>Rename</p>
                          </div>
                        </li>
                        
                       
                        <li class='media align-items-center mb-3 move_subjectL1_option move_option' aria-subjectcardid='card<?php echo $thisSubject['id']; ?>' role='button' >
                          <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                          <div class='media-body'>
                            <p class='mb-0 txt-light-black text-left'>Move</p>
                          </div>
                        </li>
                     
                         
                        <li class='media align-items-center deleteSubjectL1' role='button' id='deleteSubject<?php echo $thisSubject['id']; ?>' aria-deletename='<?php echo $thisSubject['module']; ?>'>
                          <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
                          <div class='media-body'>
                            <p class='mb-0 txt-light-black text-left'>Delete</p>
                          </div>
                        </li>
                       
                      </ul>" data-placement="bottom">Options<img src="../../assets/images/common/icon_more_option.png" class="ml-3"></button>
                      <!-- <div class="d-flex align-items-center " data-toggle="collapse" data-target="#collapse<?php echo $thisSubject['id']; ?>" aria-expanded="false" aria-controls="collapse1" role="button">
                        <p class="mb-0 mr-2">Sub-Subjects</p>
                        <i class="fa fa-chevron-down"></i>
                        
                      </div> -->
                    </div>
                  </div>


                  <div id="collapse<?php echo $thisSubject['id']; ?>" class="collapse <?php if(isset($_SESSION['open_subject']) && $_SESSION['open_subject'] == $thisSubject['id']) { echo "show"; unset($_SESSION['open_subject']); } ?>" aria-labelledby="class1" data-parent="#accordionClass">
                    <div class="card-body my-5">
                      <div class="dragChildSubject" >
                        <ul class="sublevel1">
                        <?php foreach($thisSubject['child'] as $key=>$valuechild) { ?>
                            <li class="child_subject_li  mb-2" id="cardsub<?php echo $valuechild['id']; ?>">
                            <div class=" btn-group " role="group" >
                                <input type="text" class="mb-0 ip_section pl-2 txt-black font-weight-medium subjectL2" name="child_subject" data-classid="" id='subjectdrop<?php echo $valuechild['id']; ?>' value="<?php echo $valuechild['module']?>">
                                
                                <div class="btn-group tooltip_optionschildsubject " role="group"  data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>                               
                                    
                                   
                                    <li class='media align-items-center mb-3 renameSub1' role='button' id='rc@<?php echo $valuechild['id']; ?>'>
                                        <i class='fa fa-pencil txt-blue mr-3' aria-hidden='true'></i>
                                        <div class='media-body'>
                                        <p class='mb-0 txt-light-black text-left ' >Rename</p>
                                        </div>
                                    </li>
                                     
                                    <li class='media align-items-center mb-3 move_subjectL2_option' role='button' aria-subjectl2id='cardsub<?php echo $valuechild['id']; ?>'>
                                        <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                                        <div class='media-body'>
                                        <p class='mb-0 txt-light-black text-left'>Move</p>
                                        </div>
                                    </li>
                                
                                    <li class='media align-items-center deletechild' role='button' id='deleteChild<?php echo $valuechild['id']; ?>' aria-deletename='<?php echo $valuechild['module']; ?>'>
                                        <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
                                        <div class='media-body'>
                                        <p class='mb-0 txt-light-black text-left'>Delete</p>
                                        </div>
                                    </li>
                                    
                                    </ul>" data-placement="bottom">
                                    <button type="button" class="btn btn-secondary bg-transparent txt-black pr-2">
                                        <img src="../../assets/images/common/icon_more_option.png">
                                    </button>
                                    </div>
                                </div>
                                <?php
                                
                                if(isset($valuechild['sub_child'])){ ?>
                                    <ul class="sub_child_subject_ul pl-2" id="sub_child_subject_ul<?php echo  $valuechild['id']; ?>">
                                        <?php foreach($valuechild['sub_child'] as $key=>$valuesubchild) { ?>

                                            <li class="sub-child mt-2"  id="cardsub<?php echo $valuesubchild['id']; ?>">
                                                <div class="btn-group" role="group">
                                                    <input type="text" class="mb-0 ip_section pl-2 txt-black font-weight-medium subjectL3" name="section" data-classid="" id='sub_lvl<?php echo $valuesubchild['id']; ?>' value="<?php echo $valuesubchild['module']?>">
                                                    <div class="btn-group tooltip_optionschildsubject" role="group"  data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>
                                                             
                                                            <li class='media align-items-center mb-3 renameSub2' id='rc@<?php echo $valuesubchild['id']; ?>' role='button'>
                                                                <i class='fa fa-pencil txt-blue mr-3' aria-hidden='true'></i>
                                                                <div class='media-body'>
                                                                <p class='mb-0 txt-light-black text-left'>Rename</p>
                                                                </div>
                                                            </li>
                                                            
                                                            <li class='media align-items-center mb-3 move_subjectL3_option' aria-subjectl3id='cardsub<?php echo $valuesubchild['id']; ?>' aria-parentsubid='<?php echo  $valuechild['id']; ?>' role='button'>
                                                                <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                                                                <div class='media-body'>
                                                                <p class='mb-0 txt-light-black text-left'>Move</p>
                                                                </div>
                                                            </li>
                                                         
                                                            <li class='media align-items-center deleteSubChild' role='button'id='deleteSubChild<?php echo $valuesubchild['id']; ?>' aria-deletename='<?php echo $valuesubchild['module']; ?>'>
                                                                <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
                                                                <div class='media-body'>
                                                                <p class='mb-0 txt-light-black text-left'>Delete</p>
                                                                </div>
                                                            </li>
                                                         
                                                            </ul>" data-placement="bottom">
                                                        <button type="button" class="btn btn-secondary bg-transparent txt-black pr-2">
                                                            <img src="../../assets/images/common/icon_more_option.png">
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php   } ?>
                                    </ul>
                                <?php } ?>


                            </li>

                        <?php }?>
                        </ul>    
                      </div>
                    </div>
                  </div>


                  
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </section>
        <!-- start you own content here -->
     
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- Sub Child Subject Modal -->
    <div class="modal fade" id="sub_child_subject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header border-0 pb-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="text-center mb-4 font-weight-bold"><span id="sub_child_subject_name" ></span> - Sub level </h5>
            <form id="add_sub_child_subject_form" class="add_sub_child_subject_form" method="post">
              <!-- <div class="form-group row px-150">
                <label for="child_subject" class="col-sm-2 col-form-label text-right">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter here" id="sub_child_subject" name="sub_child_subject" value="">
                </div>
              </div> -->
              <div class="form-group px-150 mb-0 row">
                <label for="child_subject">Name</label>
              </div>
              <div class="form-group row px-150 sublevel_field">
                <div class="form-group sublevel_blk_field d-flex align-items-center w-100">
                  <input type="text" class="form-control" placeholder="Enter here" id="sub_child_subject" name="sub_child_subject[]" value="">
                  <button type="button" class="sublevel_remove d-none ml-3 border-danger"><i class="fa fa-times"></i></button>
                </div>
              </div>

              <div class="position-relative sublevel_wrap" id="sublevel_wrap"></div>
              <button class="sublevel_add mx-150" data-id="sublevel_add" type="button"><i class="fa fa-plus"></i>&nbsp;Add</button>
              
              <div class="position-relative text-center w-100 mb-3">
                <input type="hidden" id="sub_child_subject_parent_id" name="sub_child_subject_parent_id" value="">
                <input type="hidden" name="type" value="addSubChildLevel">
                <button type="submit"  class="btn btn-md btn-blue shadow px-5">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

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
    <!-- Parent Subject Update/Edit Modal -->
    <div class="modal fade" id="parent_subject_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header border-0 pb-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="text-center mb-4 font-weight-bold">Science - Edit Details </h5>
            <form id="update_parent_subject_form" name="update_parent_subject_form" method="post">
              <div class="row px-5">
                <div class="form-group col-12 col-sm-6 col-md-6">
                  <label for="par_sub_edit_category">Category</label>
                  <select id="par_sub_edit_category" name="par_sub_edit_category" class="form-control">
                    <option>-Choose Category-</option>
                    <?php foreach($subjectCategories as $thisCat) { ?>
                      <option value="<?php echo $thisCat['id']; ?>"><?php echo $thisCat['name']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group col-12 col-sm-6 col-md-6">
                  <label for="par_sub_edit_classes">For Classes</label>
                  <select id="par_sub_edit_classes" name="par_sub_edit_classes[]" class="form-control classlist" style="width: 100%" multiple="multiple" disabled>
                    <?php foreach($activeClasses as $thisClass) { ?>
                      <option value="<?php echo $thisClass['id']; ?>"><?php echo $thisClass['id']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="position-relative text-center w-100 mb-3">
                <input type="hidden" name="subject_id" id="subject_id" value="" />
                <input type="hidden" name="type" value="updateSubjectDetailsL1" />
                <button type="submit" class="btn btn-md btn-blue shadow px-5">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Parent Subject Modal -->
    <div class="modal fade" id="parent_subject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header border-0 pb-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="text-center mb-4 font-weight-bold">List down the subjects in your school</h5>
            <form id="add_parent_subject_form" name="add_parent_subject_form" method="post">
              <div class="row justify-content-center text-center py-5 mb-4" id="parent_subject_modal_content">
                <div class="col-12 d-flex align-items-center text-left" id="par_sub_head">
                  <label class="col-4 font-weight-medium">Name of Subject</label>
                  <label class="col-4 font-weight-medium">Category</label>
                  <label class="col-4 font-weight-medium">For Classes</label>
                </div>

                <div class="col-12 qust" id="par_sub_body">
                  <div class="d-flex align-items-center position-relative cmt mb-3 subjectRow">
                    <div class="sub_ip col-4">
                      <input type="text" placeholder="Type here" name="name[]" class="form-control">
                    </div>

                    <div class="cat_opt_vla col-4">
                      <select class="form-control" name="category[]">
                        <option value="">-Category-</option>
                        <?php foreach($subjectCategories as $thisCat) { ?>
                        <option value="<?php echo $thisCat['id']; ?>"><?php echo $thisCat['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="class_opt_vla col-4">
                      <select class="form-control classlist" style="width: 100%" name="classes[][]" multiple="multiple">
                        <option value="">-Classes-</option>
                        <?php foreach($activeClasses as $thisClass) { ?>
                        <option value="<?php echo $thisClass['id']; ?>"><?php echo $thisClass['module']; ?></option>
                        <?php } ?>
                      </select>
                      <input type="hidden" name="class_string[]" value="" class="classstring">
                    </div>
                    <button type="button" class="remove d-none"><i class="fa fa-times"></i></button>
                  </div>
                  <div class="position-relative wrapper" id="qust1_wrap"></div>
                  <!-- <button class="add" data-id="qust1_add" type="button"><i class="fa fa-plus"></i>&nbsp;Add</button> -->
                </div>
              </div>
              
              <div class="position-relative text-center w-100 mb-3">
                <input type="hidden" name="type" value="addParentSubject">
                <button type="submit" class="btn btn-md btn-blue shadow px-5">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="section_count_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header border-0 pb-0">
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
              
              <div class="position-relative text-center w-100 mb-3">
                <input type="hidden" class="form-control text-center" name="type" value="createSectionBasedOnCount">
                <button type="submit" class="btn btn-md btn-blue shadow px-5" id="update_section_count_form_save">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="class_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header border-0">
            <button type="button" class="close" <?php if(count($activeClasses) == 0) { ?>  onclick="document.location='../create.php';" <?php } else { ?> data-dismiss="modal" <?php } ?> aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="text-center mb-4">Select the classes that are in your school</h5>
            <form id="Add_class_form" method="post" name="Add_class_form">
              <?php if(count($activeClasses) > 0) { ?>
              <div class="row text-center bg-grey py-5 mb-4" id="activated_classes">
                <?php foreach($activeClasses as $thisClass) { ?>
                <div class="form-check-inline px-3 py-2 mb-3">
                  <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="class-<?php echo $thisClass['module']; ?>" role="pointer">
                    <?php echo $thisClass['module']; ?><input type="checkbox" class="form-check-input ml-4" id="class-<?php echo $thisClass['module']; ?>" value="<?php echo $thisClass['module']; ?>" checked>
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
                <div class="text-center mb-4" id="sellectall_blk">
                  <div class="form-check-inline px-3 py-2 ml-4">
                    <label class="form-check-label d-flex align-items-center w-100" for="selectall" role="pointer">
                      <input type="checkbox" class="form-check-input mr-2" id="selectall">Select All
                    </label>
                  </div>
                </div>
                <input type="hidden" class="form-control text-center" name="type" value="createClasses">
                <button type="submit" class="btn btn-md btn-blue shadow px-5 class_save_active" id="class_save_submit">Save</button>
              </div>
              <?php } ?>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Snackbar  -->
    <div id="snackbar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0" id="sb_heading">Notice!</h6>
        <button type="button" class="close close_snackbar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <!-- <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body">You added <span class="font-weight-bold m-0">4 sections under Class 2</span> successfully</p> -->
      </div>
    </div>
    <!-- Child Subject Modal -->
    <div class="modal fade" id="child_subject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header border-0 pb-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- <h5 class="text-center mb-4 font-weight-bold"><span id="parent_subject_name"></span> - Sub level </h5> -->
            <form id="add_child_subject_form" class="add_child_subject_form" method="post" name="add_child_subject_form">
              <div class="form-group px-150 mb-0 row">
                <label for="child_subject_name">Name</label>
              </div>
              <div class="form-group row px-150 level2_field">
                <div class="form-group sublevel_blk_field d-flex align-items-center w-100">
                  <input type="text" class="form-control" placeholder="Enter here" id="child_subject_name" name="child_subject_name[]" value="" required>
                  <button type="button" class="level2_remove d-none ml-3 border-danger"><i class="fa fa-times"></i></button>
                </div>
              </div>

              <div class="position-relative level2_wrap" id="level2_wrap"></div>
              <button class="level2_add mx-150" data-id="level2_add" type="button"><i class="fa fa-plus"></i>&nbsp;Add</button>
              
              <div class="position-relative text-center w-100 mb-3">
                <input type="hidden" id="child_subject_parent_id" name="child_subject_parent_id" value="">
                <input type="hidden" name="type" value="addSubLevel">
                <button type="submit" class="btn btn-md btn-blue shadow px-5">Save</button>
              </div>
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
    <script src="../../js/cms.js"></script>
    <script src="../../js/subject.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
      var openedCard = '';
      var openedCardArray = [];
      $('#moduleSetupAccordion1').on('show.bs.collapse', function (event) {
        var id = event.target.id;
        var classId = id.split('_');
        classId = classId[1];
        openedCard='orgChart'+classId;
        $('#classId').val(classId);
        $('#openedCard').val(openedCard);
        getSectionData(classId);
      })
      function getSectionData(classId) {
          $.ajax({
            url:"apis/getSectionsData.php",
            method:'POST',
            data:"id="+classId,        
            async:true,
            dataType:"json",
            success:function(data)
            {
              var html = "";
              // console.log(data.result);
              $.each(data.result, function (key, val) {
                  $.each(val, function (k, v) {
                      html += `<div class="btn-group sectionDiv mb-3" id="sectionDiv`+v.id+`" role="group">
                          <input type="text" style="text-transform: capitalize;" class="mb-0 ip_section pl-2 txt-black font-weight-medium class_section" name="section" data-classid="`+v.id+`" id="section`+v.id+`" value="`+v.Section+`">
                          
                          <div class="tooltip_optionssection btn-group section`+v.id+`" role="group"  data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>
                             <li class='media align-items-center mb-3 renameSection' role='button' id='rs@`+v.id+`'>
                              <i class='fa fa-pencil txt-blue mr-3' aria-hidden='true'></i>
                              <div class='media-body'>
                                <p class='mb-0 txt-light-black text-left'>Rename</p>
                              </div>
                            </li>
                            <li class='media align-items-center mb-3 move_section_option' aria-sectioncardid='sectionDiv`+v.id+`' role='button'>
                              <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                              <div class='media-body'>
                                <p class='mb-0 txt-light-black text-left'>Move</p>
                              </div>
                            </li>
                            <li class='media align-items-center deleteSection' role='button' id='`+v.id+`' aria-deletename='`+v.Section+`'>
                              <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
                              <div class='media-body'>
                                <p class='mb-0 txt-light-black text-left'>Delete</p>
                              </div>
                            </li>
                          </ul>" data-placement="bottom">
                            <button type="button" class="tooltip_options btn btn-secondary bg-transparent txt-black pr-2">
                              <img src="../../assets/images/common/icon_more_option.png">
                            </button>
                          </div>
                        </div>`;
                  });
              });
              $("#orgChartContainer_"+classId).empty();
              $("#orgChartContainer_"+classId).html(html);
            }
          });
      }
  // $(document).on('submit', '#add_parent_subject_form', function(event){
  //       event.preventDefault();
  //       $.ajax({
  //         url:"apis/subject_ajaxcalls.php",
  //         method:'POST',
  //         data:new FormData(this),
  //         contentType:false,
  //         processData:false,
  //         success:function(data)
  //         {
  //             var json = $.parseJSON(data);
  //             if(json.status) {
  //                 $("#autoid").val("0");
  //                 $("#sb_heading").html("Successfully Created!");
  //                 $("#parent_subject_modal").modal("hide");
  //                 location.reload();
  //             } else {
  //                 $("#sb_heading").html("Notice!");
  //                 var x = document.getElementById("snackbar");
  //             x.className = "show";
  //             $("#sb_body").html(json.message);
  //             setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
  //             }
  //         }
  //       });
  //   });
  
  $(document).on('click', '.add', function() {
        console.log($(this).data("id"));
        // $('.classlist').select2("destroy");
        //if($(this).closest('.qust').find('.form-control').val() != ""){
            var clone_data = $(this).closest('.qust').find('.cmt').first().clone(true);
            clone_data.find("input").val("");
            //clone_data.find("select").val("");
            $(this).parent().find('.wrapper').append(clone_data).fadeIn(600);
            //Paste this code after your codes.
        //     $('.classlist').select2({ //apply select2 to my element
        //     placeholder: "Search your Class",
        //     closeOnSelect: false
        // });
            
        /*} else{
            alert("should not be empty");
        }*/
    });
  $(document).on('click', '.level2_add', function() {
        console.log($(this).data("id"));
        var clone_data = $(this).closest('.add_child_subject_form').find('.level2_field').first().clone(true);
        clone_data.find("input").val("");
        //clone_data.find("select").val("");
        $(this).parent().find('.level2_wrap').append(clone_data).fadeIn(600);
    });

    $(document).on('click', '.level2_remove', function() {
        $(this).closest('.level2_field').fadeOut(600, function() {
            $(this).remove();
        });
    });
  $(document).on('click', '.addSubSubject1', function(e)
  {
    var sub_id = $(this).attr("data-id");
    $("#child_subject_parent_id").val(sub_id);
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
                    $("#sb_heading").html("Successfully Created!");
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
  $(document).on("change", ".classlist", function() {
    var arr = $(this).val();
    var string = arr.join(",");
    $(this).closest('.subjectRow').find('.classstring').val(string);
  })
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
                    $("#sb_heading").html("Successfully Created!");
                  } else {
                    $("#sb_heading").html("Notice!");
                  }
                  var x = document.getElementById("snackbar");
                  x.className = "show";
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);*/
                  $("#section_count_modal").modal("hide");
                  // location.reload();
              },
              beforeSend: function(){
                  //$("body").mLoading()
              },
              complete: function(){
                  //$("body").mLoading('hide')
              }
          });
      });

      // $('#moduleSetupAccordion1').on('show.bs.collapse', function (event) {
      //   var id = event.target.id;
      //   var classId = id.split('_');
      //   classId = classId[1];
      //   openedCard='orgChart'+classId;
      //   $('#classId').val(classId);
      //   $('#openedCard').val(openedCard);
      //   getTreeData(classId, openedCard);
      // })

      // function getTreeData(classId, openedCard) {
      //   $.ajax({
      //     url:"apis/getCPClassSubjectChapterTopics.php",
      //     method:'POST',
      //     data:"id="+classId+"&type=getAllDataForTheClass",        
      //     async:true,
      //     success:function(data)
      //     {
      //       var json = $.parseJSON(data);
           
      //       if(json.status) {
      //         var treeData = json.result;
              
      //         updateTree(openedCard, treeData);
      //       }
      //     },
      //     beforeSend: function(){
      //       $("body").mLoading('show');
      //     },
      //     complete: function(){
      //       $("body").mLoading('hide');
      //     }
      //   });
      // }

      function updateTree(openedCard, treeData){
        org_chart = $('#'+openedCard).orgChart({
          data: treeData,
          showControls: true,
          allowEdit: true,
          onAddNode: function(node){
              saveCategory(node.data.id, 'add'); 
              org_chart.newNode(node.data.id);
          },
          onDeleteNode: function(node){
              saveCategory(node.data.id, 'delete');
              org_chart.deleteNode(node.data.id); 
          },
          onClickNode: function(node){
              // console.log('Clicked node '+node.data.id);
          }
        });
      }

      function saveCategory(id, type, value="", category="") {
        // alert('cpModuleSetup---'+id);
        var classId = $('#classId').val();
        var openedCard = $('#openedCard').val();

        $data = "id="+id+"&type="+type;
        if(type === 'update') {
          $data = "id="+id+"&type="+type+"&value="+value+"&category="+category;
        }
        $.ajax({
          url:"apis/modules.php",
          method:'POST',
          data:$data,        
          async:true,
          success:function(data)
          {
            var json = $.parseJSON(data);
          
            if(json.status) {
              getTreeData(classId, openedCard);
            }
          },
          beforeSend: function(){
            $("body").mLoading('show');
          },
          complete: function(){
            $("body").mLoading('hide');
          }
        });
      }
      <?php if(isset($_SESSION['sb_heading'])) { ?>
        $("#sb_heading").html("<?php echo $_SESSION['sb_heading']; ?>");
        $("#sb_body").html('<?php echo $_SESSION['sb_message']; ?>');
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, <?php echo $_SESSION['sb_time']; ?>);
      <?php unset($_SESSION['sb_heading']); } ?>
    </script>
  </body>
</html>
