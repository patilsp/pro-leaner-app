<?php 
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
include "../functions/db_functions.php";

$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$role_id = $_SESSION['user_role_id'];

  try {
  include "functions/common_function.php";
  $activeClasses = getClassNames("1");
  // $subjectCategories = getCategoryList();
  $subjectList = getSubjectList();
  // echo "<pre>";
  // print_r($subjectList);
  // echo "</pre>";
  // exit;
  $back_page = $web_root."app/create.php";
} catch(Exception $exp){
  print_r($exp);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ILP - PMS</title>

    <!-- Common Styles -->
    <?php //include("../common-blocks/style.php"); ?>
    <link rel="stylesheet" href="<?php echo $web_root ?>assets/css/subject.css">
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
    <!-- orgchart CSS -->
    <link rel="stylesheet" href="../../lib/orgchart/jquery.orgchart.css?ver=231120211126">
  </head>
  <body>
    <!-- navbar -->
    <?php include("../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../fixed-blocks/header.php"); ?>

    <div class="container mb-5 mb-lg-0">
      <!-- breadcrumb -->
      <?php //include("../common-blocks/breadcrumb.php"); ?>

      <hr class="mt-0">

      <section id="subject" class="mt-5">
        <div class="row flex-column flex-md-row">
          <header class="w-100 mx-auto mb-5 d-flex align-items-center">
            <h5 class="flex-grow-1">Subjects</h5>
              <button class="btn btn-md btn-blue font-weight-medium mr-4" data-toggle="modal" data-target="#parent_subject_modal">Add Subjects</button>
          </header>

          <div class="col-12">
            <div class="row" id="parent_subject_modules">
              <!-- <div class="position-relative d-flex align-items-center px-5 col-12" id="main_card_header">
                <label class="txt-grey col-1 text-center">S.No.</label>
                <label class="txt-grey col-2">Subject</label>
                <div class="col-9 d-flex align-items-center justify-content-end">
                  <label class="txt-grey">Category</label>
                </div>
              </div> -->

              <div class="accordion w-100 px-5 accordionClass" id="accordionClass">
                <?php foreach($subjectList as $key=>$thisSubject) { ?>
                <div class="card mb-3 border-0 classAccordon" id="card<?php echo $thisSubject['id']; ?>">
                  <div class="card-header d-flex align-items-center bg-white" id="cardch<?php echo $thisSubject['id']; ?>">
                    <h5 class="col-1 mb-0 font-weight-medium"><?php echo $key+1; ?></h5>
                    <h5 class="mb-0 col-2">
                      <input type="text" class="mb-0 flex-grow-1 border-0 ip_classes font-weight-medium inputClass" name="subject_name" data-classid="<?php echo $thisSubject['id']; ?>" id="subject<?php echo $thisSubject['id']; ?>" value="<?php echo $thisSubject['module']; ?>">
                    </h5>
                    <div class="d-flex align-items-center justify-content-end col-9">
                      <h5 class="mr-5 font-weight-medium mb-0 txt-grey"><?php echo $thisSubject['category_name']; ?></h5>
                        <button class="text-black btn btn-md subj_sub_btn mr-3 font-weight-medium addSubSubject1" data-toggle="modal" data-target="#child_subject_modal">Add Sub-level</button>
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
                      <div class="d-flex align-items-center " data-toggle="collapse" data-target="#collapse<?php echo $thisSubject['id']; ?>" aria-expanded="false" aria-controls="collapse1" role="button">
                        <p class="mb-0 mr-2">Sub-Subjects</p>
                        <i class="fa fa-chevron-down"></i>
                        
                      </div>
                    </div>
                  </div>


                  <div id="collapse<?php echo $thisSubject['id']; ?>" class="collapse <?php if(isset($_SESSION['open_subject']) && $_SESSION['open_subject'] == $thisSubject['id']) { echo "show"; unset($_SESSION['open_subject']); } ?>" aria-labelledby="class1" data-parent="#accordionClass">
                    <div class="card-body my-5">
                      <div class="dragChildSubject" >
                        <ul class="sublevel1">
                        <?php foreach($thisSubject['child'] as $key=>$valuechild) { ?>
                            <li class="child_subject_li  mb-2" id="cardsub<?php echo $valuechild['id']; ?>">
                            <div class=" btn-group " role="group" >
                                <input type="text" class="mb-0 ip_section pl-2 txt-black font-weight-medium subjectL2" name="child_subject" data-classid="" id='subjectdrop<?php echo $valuechild['id']; ?>' value="<?php echo $valuechild['name']?>">
                                
                                <div class="btn-group tooltip_optionschildsubject " role="group"  data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>                               
                                    <?php if(checkModuleActionAccess(9, 1)) { ?>
                                    <li class='media align-items-center mb-3 sub_child_subject_modal_option addChildSublevel' role='button'>
                                        <i class='fa fa-plus-square-o txt-blue mr-3' aria-hidden='true'></i>
                                        <div class='media-body'>
                                        <input type='hidden' class='testclass' value='<?php echo $valuechild['name']?>'>
                                        <p class=' mb-0 txt-light-black text-left addsublevel' id='subjectdrop<?php echo $valuechild['id']; ?>-<?php echo $valuechild['name']?>' value='' role='button' >Add Sub Level</p>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <?php if(checkModuleActionAccess(9, 5)) { ?>
                                    <li class='media align-items-center mb-3 renameSub1' role='button' id='rc@<?php echo $valuechild['id']; ?>'>
                                        <i class='fa fa-pencil txt-blue mr-3' aria-hidden='true'></i>
                                        <div class='media-body'>
                                        <p class='mb-0 txt-light-black text-left ' >Rename</p>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <?php if(checkModuleActionAccess(9, 4)) { ?>
                                    <li class='media align-items-center mb-3 move_subjectL2_option' role='button' aria-subjectl2id='cardsub<?php echo $valuechild['id']; ?>'>
                                        <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                                        <div class='media-body'>
                                        <p class='mb-0 txt-light-black text-left'>Move</p>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <?php if(checkModuleActionAccess(9, 3)) { ?>
                                    <li class='media align-items-center deletechild' role='button' id='deleteChild<?php echo $valuechild['id']; ?>' aria-deletename='<?php echo $valuechild['name']; ?>'>
                                        <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
                                        <div class='media-body'>
                                        <p class='mb-0 txt-light-black text-left'>Delete</p>
                                        </div>
                                    </li>
                                    <?php } ?>
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
                                                    <input type="text" class="mb-0 ip_section pl-2 txt-black font-weight-medium subjectL3" name="section" data-classid="" id='sub_lvl<?php echo $valuesubchild['id']; ?>' value="<?php echo $valuesubchild['name']?>">
                                                    <div class="btn-group tooltip_optionschildsubject" role="group"  data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>
                                                            <?php if(checkModuleActionAccess(9, 5)) { ?>
                                                            <li class='media align-items-center mb-3 renameSub2' id='rc@<?php echo $valuesubchild['id']; ?>' role='button'>
                                                                <i class='fa fa-pencil txt-blue mr-3' aria-hidden='true'></i>
                                                                <div class='media-body'>
                                                                <p class='mb-0 txt-light-black text-left'>Rename</p>
                                                                </div>
                                                            </li>
                                                            <?php } ?>
                                                            <?php if(checkModuleActionAccess(9, 4)) { ?>
                                                            <li class='media align-items-center mb-3 move_subjectL3_option' aria-subjectl3id='cardsub<?php echo $valuesubchild['id']; ?>' aria-parentsubid='<?php echo  $valuechild['id']; ?>' role='button'>
                                                                <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
                                                                <div class='media-body'>
                                                                <p class='mb-0 txt-light-black text-left'>Move</p>
                                                                </div>
                                                            </li>
                                                            <?php } ?>
                                                            <?php if(checkModuleActionAccess(9, 3)) { ?>
                                                            <li class='media align-items-center deleteSubChild' role='button'id='deleteSubChild<?php echo $valuesubchild['id']; ?>' aria-deletename='<?php echo $valuesubchild['name']; ?>'>
                                                                <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
                                                                <div class='media-body'>
                                                                <p class='mb-0 txt-light-black text-left'>Delete</p>
                                                                </div>
                                                            </li>
                                                            <?php } ?>
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
                        <option value="<?php echo $thisClass['code']; ?>"><?php echo $thisClass['code']; ?></option>
                        <?php } ?>
                      </select>
                      <input type="hidden" name="class_string[]" value="" class="classstring">
                    </div>
                    <button type="button" class="remove d-none"><i class="fa fa-times"></i></button>
                  </div>
                  <div class="position-relative wrapper" id="qust1_wrap"></div>
                  <button class="add" data-id="qust1_add" type="button"><i class="fa fa-plus"></i>&nbsp;Add</button>
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
            <h5 class="text-center mb-4 font-weight-bold"><span id="parent_subject_name"></span> - Sub level </h5>
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
                  <select id="par_sub_edit_classes" name="par_sub_edit_classes[]" class="form-control classlist" style="width: 100%" multiple="multiple">
                    <?php foreach($activeClasses as $thisClass) { ?>
                      <option value="<?php echo $thisClass['code']; ?>"><?php echo $thisClass['code']; ?></option>
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

    <!-- Snackbar  -->
    <div id="snackbar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0" id="sb_heading">Notice!</h6>
        <button type="button" class="close close_snackbar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body">You added <span class="font-weight-bold m-0">4 sections under Class 2</span> successfully</p>
      </div>
    </div>

    <!-- common scripts -->
    <?php include("../setup/common-blocks/js.php"); ?>
    <!-- ########## END: MAIN PANEL ########## -->
    <!-- <script src="../../lib/jquery/jquery.js"></script> -->
    <script src="../../lib/popper.js/popper.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../lib/orgchart/jquery.orgchart.js"></script>
    <script src="../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../js/cms.js"></script>
    <script type="text/javascript">
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