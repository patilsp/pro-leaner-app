<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";

//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php";
require_once "../functions/common_functions.php";
$user_id = $_SESSION['cms_userid'];
$role_id = $_SESSION['user_role_id'];

?>
<!DOCTYPE html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />

    <title>PMS - Dashboard</title>  
    
    
  <?php  //include("../../componets/style.php"); ?>
  <link href="<?php echo $web_root ?>lib/simplebar/css/simplebar.css" rel="stylesheet" />
<link href="<?php echo $web_root ?>lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
<link href="<?php echo $web_root ?>lib/metismenu/css/metisMenu.min.css" rel="stylesheet" />

<!-- Bootstrap CSS -->
<link href="<?php echo $web_root ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo $web_root ?>assets/css/bootstrap-extended.css" rel="stylesheet" />
<link href="<?php echo $web_root ?>assets/css/style.css?ver=191020211109" rel="stylesheet" />
<link href="<?php echo $web_root ?>assets/css/icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<!-- loader-->
<link href="<?php echo $web_root ?>assets/css/pace.min.css" rel="stylesheet" />


<!--Theme Styles-->
<link href="<?php echo $web_root ?>assets/css/light-theme.css" rel="stylesheet" />
<link href="<?php echo $web_root ?>lib/toast/toast.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="../../lib/datatables/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/assessment/assessment.css">
  <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
  <style type="text/css">
    .bi-x-circle {
      font-size: 30px;
      cursor: pointer;
    }
    .qustCard .input-group-text {
      position: absolute;
      top: 0px;
      right: 0px;
      z-index: 8;
    }
    #qust_paper_form .card {
      border: 1px solid rgba(0,0,0,.125);
    }
    #qust_paper_form .bi-trash-fill::before {
      content: "\f5a8" !important;
    }
    .pEventsNone {
      pointer-events: none;
      opacity: .5;
    }
  </style>
</head>
<?php
  //$_GET['qustPaperId'] = 1;
  $qustPaperId = $_GET['qustPaperId'];
  //get Qust Type
  $query = "SELECT * FROM qp_qustpaper WHERE id=?";
  $stmt = $db->prepare($query);
  $stmt->execute(array($qustPaperId));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);


  //get qustpaperclasssubid
  $qpClassSubId = GetRecord("qp_qustpaperclasssubid", array("qustPaperId"=>$qustPaperId));
  if (!empty($qpClassSubId)) {
    $publishdate = date("d/m/Y",strtotime($qpClassSubId["publish_date"]));
    $publishtime = date("H:i:s",strtotime($qpClassSubId["publish_date"]));
  }
  $forCandi = $forStud = 'd-none';
  $subjects = array();
  // if($row['qpType'] == 1){
  //   $forCandi = '';
  //   $subjects = GetQueryRecords("SELECT id as subId, module as name FROM cpmodules WHERE catId='".$qpClassSubId['catId']."' ");
  // } else if($row['qpType'] == 2){
    $forStud = '';
    $subjects = GetQueryRecords("SELECT id as subId, module as name FROM cpmodules WHERE  parentId='".$qpClassSubId['classId']."' ");
  // }


  /*$qustSec = GetRecords("qustpapersections", array("qustPaperId"=>$qustPaperId));
  foreach ($qustSecs as $qustSec) {

  }*/
?>
<body>
  
<div class="wrapper">
  <!--start content-->
  <div class="card">
      <div class="card-body">
        <form id="qust_paper_form">
          <input type="hidden" name="qpID" value="<?php echo $row['id']; ?>">
          <input type="hidden" name="questionIds[]" value="" class="questionIds">
          <div class="" id="main-container">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row g-2 mb-3">
                  
                  <!-- for Candidate -->
                  <div class="col-md forCandidate notChangeable <?php echo $forCandi; ?>">
                    <div class="form-floating">
                      <select class="form-select catSelect pEventsNone" id="cat" name="catId" aria-label="Floating label select category">
                        <option value="" selected>Select Category</option>
                        <?php 
                          $cat = GetRecords("qp_master_category", array("deleted"=>0));
                          foreach ($cat as $list) {
                            $selected = "";
                            if($list['id'] == $qpClassSubId['catId']) {
                              $selected = "selected='selected'";
                            }
                        ?>
                        <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['name']; ?></option>
                        <?php } ?>
                      </select>
                      <label for="class">Category</label>
                    </div>
                  </div>
                  <!-- End for Candidate -->

                  <!-- for Student -->
                  <div class="col-md-2 forStudent notChangeable <?php echo $forStud; ?>">
                    <div class="form-floating">
                      <select class="form-select classSelect pEventsNone" id="classess" name="classId" aria-label="Floating label select category" disabled>
                        <option value="" selected>Select Class</option>
                        <?php 
                          $classes = GetRecords("cpmodules", array("level"=>1,"visibility" => 1));
                          foreach ($classes as $list) {
                            $selected = "";
                            if($list['id'] == $qpClassSubId['classId']) {
                              $selected = "selected='selected'";
                            }
                        ?>
                        <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['module']; ?></option>
                        <?php } ?>
                      </select>
                      <label for="classess">Class</label>
                    </div>
                  </div>
                  <!-- End for Student -->
                  <div class="col-md-2 forStudent notChangeable <?php echo $forStud; ?>">
                    <div class="form-floating">
                      <select class="form-select classSelect pEventsNone" id="section" name="sectionId" aria-label="Floating label select category" disabled>
                        <option value="<?php echo $qpClassSubId['sectionId']; ?>" <?php echo $selected; ?>><?php echo $qpClassSubId['sectionId']; ?></option>
                      </select>
                      <label for="classess">Section</label>
                    </div>
                  </div>

                  <div class="col-md-2 forCandidateStudent notChangeable">
                    <div class="form-floating">
                      <select class="form-select pEventsNone" id="subject" name="classSubjectId" aria-label="Floating label select subject" disabled>
                        <option value="" selected>Select Subject</option>
                        <?php
                          foreach ($subjects as $list) {
                            $selected = "";
                            if($list['subId'] == $qpClassSubId['subId']) {
                              $selected = "selected='selected'";
                            } 
                        ?>
                            <option value="<?php echo $list['subId']; ?>" <?php echo $selected; ?>><?php echo $list['name']; ?></option>
                        <?php } ?>
                      </select>
                      <label for="subject">Subject</label>
                    </div>
                  </div>
                  <div class="col-md-2 forStudent notChangeable <?php echo $forStud; ?>">
                    <div class="form-floating">
                      <select class="form-select chapterSelect pEventsNone" id="chapter" name="chapterId" aria-label="Floating label select category" disabled>
                        <option value="" selected>Select Chapter</option>
                        <?php 
                          $classes = GetRecords("cpmodules", array("level"=>3,"type" => 'chapter',"deleted" => 0));
                          foreach ($classes as $list) {
                            $selected = "";
                            if($list['id'] == $qpClassSubId['chapId']) {
                              $selected = "selected='selected'";
                            }
                        ?>
                        <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['module']; ?></option>
                        <?php } ?>
                      </select>
                      <label for="classess">Chapter</label>
                    </div>
                  </div>
                  <div class="col-md-2 forStudent notChangeable <?php echo $forStud; ?>">
                    <div class="form-floating">
                      <select class="form-select chapterSelect pEventsNone" id="topic" name="topicId" aria-label="Floating label select category" disabled>
                        <option value="" selected>Select Topic</option>
                        <?php 
                          $classes = GetRecords("cpmodules", array("level"=>4,"type" => 'topic',"deleted" => 0));
                          foreach ($classes as $list) {
                            $selected = "";
                            if($list['id'] == $qpClassSubId['topicId']) {
                              $selected = "selected='selected'";
                            }
                        ?>
                        <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['module']; ?></option>
                        <?php } ?>
                      </select>
                      <label for="classess">Topic</label>
                    </div>
                  </div>
                  <div class="col-md-2 forStudent notChangeable <?php echo $forStud; ?>">
                    <div class="form-floating">
                      <select class="form-select chapterSelect pEventsNone" id="subtopic" name="subtopicId" aria-label="Floating label select category" disabled>
                        <option value="" selected>Select Sub Topic</option>
                        <?php 
                          $classes = GetRecords("cpmodules", array("level"=>5,"type" => 'subTopic',"deleted" => 0));
                          foreach ($classes as $list) {
                            $selected = "";
                            if($list['id'] == $qpClassSubId['subtopicId']) {
                              $selected = "selected='selected'";
                            }
                        ?>
                        <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['module']; ?></option>
                        <?php } ?>
                      </select>
                      <label for="classess">Topic</label>
                    </div>
                  </div>
                  <div class="col-md-2 notChangeable">
                    <div class="form-floating">
                      <select class="form-select qpType pEventsNone" id="qpType" name="qpType" aria-label="Floating label select category">
                        <option selected>Select Type</option>
                        <?php 
                          $qpTypes = GetRecords("qp_master_qp_types", array("deleted"=>0));
                          foreach ($qpTypes as $list) {
                            $selected = "";
                            if($list['id'] == $row['qpType']) {
                              $selected = "selected='selected'";
                            }
                        ?>
                        <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['name']; ?></option>
                        <?php } ?>
                      </select>
                      <label for="qpType">Question Paper Type</label>
                    </div>
                  </div>
                  <!-- <div class="col-md-2 forStudent <?php echo $forStud; ?>">
                    <div class="form-floating">
                      <select class="form-select qType" id="qType" name="qType" aria-label="Floating label select category">
                            <option selected>Select Type</option>
                            <?php 
                              $qpqTypes = GetRecords("qp_master_questiontypes", array("deleted"=>0));
                              foreach ($qpqTypes as $list) {
                                $selected = "";
                                if($list['id'] == $qpClassSubId['qType']) {
                                  $selected = "selected='selected'";
                                }
                            ?>
                            <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['name']; ?></option>
                            <?php } ?>
                          </select>
                      <label for="classess">Question Type</label>
                    </div>
                  </div> -->
                  <div class="col-md-2 forStudent <?php echo $forStud; ?>">
                    <div class="form-floating">
                      <select class="form-select qEvaluation" id="qEvaluation" name="qEvaluation" aria-label="Floating label select category">
                            <option selected>Select Type</option>
                            <?php 
                              $qpqTypes = GetRecords("qp_evaluation", array("deleted"=>0));
                              foreach ($qpqTypes as $list) {
                                $selected = "";
                                if($list['id'] == $qpClassSubId['qEvaluation']) {
                                  $selected = "selected='selected'";
                                }
                            ?>
                            <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['name']; ?></option>
                            <?php } ?>
                          </select>
                      <label for="classess">Evaluation</label>
                    </div>
                  </div>
                  <div class="col-md-2 forStudent <?php echo $forStud; ?>">
                    <div class="form-floating">
                      <select class="form-select qPaperType" id="qPaperType" name="qPaperType" aria-label="Floating label select category">
                            <option selected>Select Type</option>
                            <?php 
                              $qpqTypes = GetRecords("qp_paper_display", array("deleted"=>0));
                              foreach ($qpqTypes as $list) {
                                $selected = "";
                                if($list['id'] == $qpClassSubId['qPaperType']) {
                                  $selected = "selected='selected'";
                                }
                            ?>
                            <option value="<?php echo $list['id']; ?>" <?php echo $selected; ?>><?php echo $list['name']; ?></option>
                            <?php } ?>
                          </select>
                      <label for="classess">Question Paper Display</label>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-floating mb-3">
                      <input type="text" name="timeAllow" value="<?php echo $row['time_allowed']; ?>" class="form-control" id="floatingInput" placeholder="Time allowed (in minutes)">
                      <label for="floatingInput">Time allowed (In Minutes)</label>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-floating mb-3">
                      <input type="text" name="publishdate" value="<?php echo $publishdate; ?>" class="form-control" id="publishdate" placeholder="Publish Date">
                      <label for="floatingInput">Publish Date</label>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-floating mb-3">
                      <input type="text" name="dueby" value="<?php echo $publishtime; ?>" class="form-control" id="dueby" placeholder="Due By">
                      <label for="floatingInput">Publish By</label>
                    </div>
                  </div>
                 
                  <div class="col-md-2">
                    <div class="form-floating mb-3">
                      <input type="text" name="totMarks" value="<?php echo $row['totMarks']; ?>" class="form-control" id="floatingInput" placeholder="Total Marks" disabled readonly>
                      <label for="floatingInput">Total Marks</label>
                    </div>
                  </div>
                </div>
                <div class="row g-2 mb-3">
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" name="title" value="<?php echo $row['title']; ?>" required="required" class="form-control" id="floatingInput" placeholder="Title">
                      <label for="floatingInput">Title</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <button class="btn btn-info float-end addSection" type="button"><i class="bi bi-plus"></i> Add Section</button>
              </div>
            </div>

            <!-- Section start Append Here... -->
            <span class="qpSections">
              <?php
                $qustSecs = GetRecords("qp_qustpapersections", array("qustPaperId"=>$qustPaperId));
                foreach ($qustSecs as $qustSec) {
                  $qustSecId = $qustSec['id'];
                  $secHeading = $qustSec['secHeading'];
                  $secTitle = $qustSec['secTitle'];
                  $secMarks = $qustSec['secMarks'];
              ?>
              <div class="card qustCard mainIndex subindex mainMarks subMarks">
                <div class="card-header py-0 border-0">
                  <div class="page-breadcrumb d-sm-flex align-items-center">
                    <div class="breadcrumb-title pe-3 border-0"></div>
                    <div class="ms-auto"> <i class="bi bi-x-circle deleteSection"></i> </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row g-2 mb-3">
                    <div class="page-breadcrumb d-sm-flex align-items-center">
                      <div class="breadcrumb-title pe-3 border-0 w-100">
                        <div class="row">
                          <div class="col-md">
                            <div class="form-floating mb-3"> <textarea class="form-control" required="required" name="sh[]" class="form-control" id="sh" placeholder="Section Heading"><?php echo $secHeading; ?></textarea> <label for="sh">Section Heading</label> </div>
                          </div>
                          <div class="col-md">
                            <div class="form-floating mb-3"> <textarea class="form-control" name="st[]" class="form-control" id="st" placeholder="Section Ttitle"><?php echo $secTitle; ?></textarea> <label for="st">Section Title</label> </div>
                          </div>
                        </div>
                      </div>
                      <div class="ms-auto">
                        <div class="form-floating mb-3"> <input type="text" name="sm[]" value="<?php echo $secMarks; ?>" class="form-control" placeholder="Marks"> <label for="sec0">Marks</label> </div>
                      </div>
                    </div>
                    <span class="secQuestions">
                      <?php 
                        $data = '';
                        $qustPaperSecQusts = GetRecords("qp_qustpapersectionquestions", array("qustPaperSectionId"=>$qustSecId));
                        foreach ($qustPaperSecQusts as $sec) {
                          $qustId = $sec['questionsId'];
                          $qpsqMarks = $sec['qustMark'];
                          $queryQPSQ = "SELECT * FROM qp_questions WHERE id=?";
                          $stmtQPSQ = $db->prepare($queryQPSQ);
                          $stmtQPSQ->execute(array($qustId));
                          $rowQPSQ = $stmtQPSQ->fetch(PDO::FETCH_ASSOC);
                          $questionContent = $rowQPSQ['question'];
                          
                          $queryQD = "SELECT * FROM qp_questiondetails WHERE id=?";
                          $stmtQD = $db->prepare($queryQD);
                          $stmtQD->execute(array($rowQPSQ['qustDetailsId']));
                          $rowQD = $stmtQD->fetch(PDO::FETCH_ASSOC);
                          $type = $rowQD['qustType'];
                          $qDetId = $rowQD['id'];

                          if($type == 1 || $type == 2) {
                            $data .= '
                            <div class="w-100 '.$qDetId.'">
                              <input type="hidden" class="subindex" name="qustDetIds[]" value="'.$qDetId.'"/>
                              <div class="d-sm-flex">
                                <div class="pe-3 border-0 w-100">
                                  <div class="row">
                                    <div class="col-md">
                                      <ul>
                                        <li>
                                          '.$questionContent.'
                                          <ol type="a">';
                                          $query1 = "SELECT * FROM qp_mcqoptions WHERE qId=?";
                                      $stmt1 = $db->prepare($query1);
                                      $stmt1->execute(array($qustId));
                                      while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                        $right_ans = '';
                                        if($row1['correctAns']) {
                                          $right_ans = 'active';
                                        }
                                            $data .= '<li class="'.$right_ans.'">'.$row1['optionContent'].'</li>';
                                        }
                                          $data .= '</ol>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control subMarks" name="qustMark[]" required="required" value="'.$qpsqMarks.'" aria-describedby="qustMark">
                                    <span class="input-group-text deleteQust" data-qustId="'.$qDetId.'"><i class="bi bi-trash-fill"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>';
                          } elseif($type == 3) {
                            $data .= '
                            <div class="w-100 '.$qDetId.'">
                              <input type="hidden" class="subindex" name="qustDetIds[]" value="'.$qDetId.'"/>
                              <div class="d-sm-flex">
                                <div class="pe-3 border-0 w-100">
                                  <div class="row">
                                    <div class="col-md">
                                      <ul>
                                        <li>
                                          '.$questionContent.'
                                          <div class="row">
                                            <div class="mb-3">
                                          <textarea class="form-control" rows="3" disabled></textarea>
                                        </div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control subMarks" name="qustMark[]" required="required" value="'.$qpsqMarks.'" aria-describedby="qustMark">
                                    <span class="input-group-text deleteQust" data-qustId="'.$qDetId.'"><i class="bi bi-trash-fill"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>';
                          } elseif($type == 4) {
                            $data .= '
                            <div class="w-100 '.$qDetId.'">
                              <input type="hidden" class="subindex" name="qustDetIds[]" value="'.$qDetId.'"/>
                              <div class="d-sm-flex">
                                <div class="pe-3 border-0 w-100">
                                  <div class="row">
                                    <div class="col-md">
                                      <ul>
                                        <li>
                                          '.$questionContent.'
                                          <div class="row">
                                            <table class="table table-bordered">
                                              <tbody>
                                                <tr>';
                                                  $qustAnsTds = GetRecords("qp_shortansertable", array("qId"=>$qustId));
                                                    foreach ($qustAnsTds as $qustAnsTd) {
                                                  $data .= '<td>
                                                    <div class="card">
                                                      <div class="card-header">
                                                        '.$qustAnsTd['qustTd'].'
                                                      </div>
                                                      <div class="card-body">
                                                          <div class="mb-3">
                                                    <textarea class="form-control" rows="3" disabled></textarea>
                                                </div>
                                                      </div>
                                                    </div>
                                                  </td>';
                                                  }
                                                $data .= '</tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control subMarks" name="qustMark[]" required="required" value="'.$qpsqMarks.'" aria-describedby="qustMark">
                                    <span class="input-group-text deleteQust" data-qustId="'.$qDetId.'"><i class="bi bi-trash-fill"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>';
                          } elseif($type == 5) {
                            $data .= '
                            <div class="w-100 '.$qDetId.'">
                              <input type="hidden" class="subindex" name="qustDetIds[]" value="'.$qDetId.'"/>
                              <div class="d-sm-flex">
                                <div class="pe-3 border-0 w-100">
                                  <div class="row">
                                    <div class="col-md">
                                      <ul>
                                        <li>';
                                          $questionContent;
                                          
                                            $ddmatchqusts = GetRecords("qp_ddmatchqust", array("qId"=>$qustId));
                                          foreach ($ddmatchqusts as $ddmatchqust) {
                                            $ddmatchan = GetRecord("qp_ddmatchans", array("ddMatchQustId"=>$ddmatchqust['id']));
                                              $leftcol = $ddmatchqust['qustCol'];
                                              $rightcol = $ddmatchan['ansCol'];
                                              $data .= '
                                                <div class="row d-flex align-items-center mb-3">
                                                <div class="col-4 p-2 m-3" style="border: 1px solid #000000">'.$leftcol.'</div>
                                                <div class="col-4 p-2 m-3" style="border: 1px solid #000000">'.$rightcol.'</div>
                                              </div>  
                                              ';
                                            }
                                          $data .= '
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control subMarks" name="qustMark[]" required="required" value="'.$qpsqMarks.'" aria-describedby="qustMark">
                                    <span class="input-group-text deleteQust" data-qustId="'.$qDetId.'"><i class="bi bi-trash-fill"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>';
                          } elseif($type == 6) {
                            $data .= '
                            <div class="w-100 '.$qDetId.'">
                              <input type="hidden" class="subindex" name="qustDetIds[]" value="'.$qDetId.'"/>
                              <div class="d-sm-flex">
                                <div class="pe-3 border-0 w-100">
                                  <div class="row">
                                    <div class="col-md">
                                      <ul class="p-0">
                                        <li>';
                                          $data .= $questionContent;
                                          
                                            $qustFillInTheBlanks = GetRecords("qp_fillintheblank", array("qId"=>$qustId));
                                            foreach ($qustFillInTheBlanks as $qustFillInTheBlank) {
                                              $qustParts = explode(' ', $qustFillInTheBlank['qustFill']);

                                              $data .='
                                                <li class="d-flex align-items-center m-2">
                                              ';
                                              foreach ($qustParts as $qustPart) {
                                                  if($qustPart == '[blank]') {
                                                    $qustPart = '<input type="text" class="form-control inputBox" style="width: 100%;margin: 0px 1rem;max-width: 200px;" disabled readonly>';
                                                    }
                                                    $data .=' '.$qustPart;
                                                }
                                                $data .='
                                                    </li>
                                                ';
                                              }
                                          $data .= '
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control subMarks" name="qustMark[]" required="required" value="1" aria-describedby="qustMark">
                                    <span class="input-group-text deleteQust" data-qustId="'.$qDetId.'"><i class="bi bi-trash-fill"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>';
                          } elseif($type == 7) {
                            $data .= '
                            <div class="w-100 '.$qDetId.'">
                              <input type="hidden" class="subindex" name="qustDetIds[]" value="'.$qDetId.'"/>
                              <div class="d-sm-flex">
                                <div class="pe-3 border-0 w-100">
                                  <div class="row">
                                    <div class="col-md">
                                      <ul>
                                        <li>
                                          '.$questionContent.'
                                          <ul>';
                                          
                                          $saQusts = GetRecords("qp_nestedshortanser", array("qId"=>$qustId));
                                          foreach ($saQusts as $saQust) {
                                        $data .= '
                                        <li>
                                            <div class="card">
                                              <div class="card-header">
                                                '.$saQust['question'].'
                                              </div>
                                              <div class="card-body">
                                                <textarea class="form-control w-100 disabled"></textarea>
                                              </div>
                                            </div>
                                          </li>';
                                        }
                                        $data .= '
                                        </ul>
                                        </li>
                                      </ul>';
                                      
                                      $mcqQusts = GetRecords("qp_nestedmcqquestions", array("qId"=>$qustId));
                                      foreach ($mcqQusts as $mcqQust) {
                                      $data .= '
                                        <div class="row">
                                          <div class="col-12 p-2">
                                            '.$mcqQust['question'].'
                                          </div>
                                          <div class="col-12 p-2 mt-3 options">
                                            <ol type="a">';
                                              
                                              $query = "SELECT * FROM qp_nestedmcqoptions WHERE nestedmcqqId=?";
                                              $stmt = $db->prepare($query);
                                              $stmt->execute(array($mcqQust['id']));
                                              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                              
                                              $data .= '<li class="p-3">'.$row['optionContent'].'</li>';
                                              }
                                            $data .= '
                                            </ol>
                                          </div>
                                        </div>';
                                      }
                                      $data .= '
                                    </div>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control subMarks" name="qustMark[]" required="required" value="1" aria-describedby="qustMark">
                                    <span class="input-group-text deleteQust" data-qustId="'.$qDetId.'"><i class="bi bi-trash-fill"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>';
                          }
                        }

                        echo $data;
                      ?>
                    </span> 
                    <hr/>
                    <div class="col-12 d-flex justify-content-end"> <button class="btn btn-info addNewQustForSec" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-plus"></i> Add Question</button> </div>
                  </div>
                </div>
              </div>
              <?php
                }//end of question section loop
              ?>
            </span>
            <!-- Section End -->
          </div>
          <?php
              if (checkUserAccess($user_id,$role_id,57) == "true") {
                ?>
          <div class="card-footer text-center" id="qpSubmitFooter">
            <button type="submit" name="submit" class="btn btn-info">Update</button>
          </div>
          <?php
              }
              ?>
        </form>
      </div>
    </div>
  <!--end page main-->

  <!--start switcher-->
  <div class="switcher-body">
    <form id="getQuestionsHtml">
      <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Add Questions for the Section</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
          <div class="row g-2 mb-3" id="qustSelectedClassSubject"></div>
        </div>
        <div class="offcanvas-footer border-top text-center">
          <button type="submit" class="btn btn-primary" id="addNewQust">Save</button>
        </div>
      </div>
    </form>
  </div>
  <!--end switcher-->
</div>
<!-- ./wrapper -->

<!-- Preview Question Modal -->
<div class="modal fade" id="previewQuestion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center qpTitle">View Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bindHTMLPreviewQuestion"></div>
    </div>
  </div>
</div>

<div id="toast"><div id="img"><i class="bi bi-info-circle-fill"></i></div><div id="desc">Question Paper Updated Successfully.</div></div>
  
  <?php //include("../../componets/js.php"); ?>

  <!-- Bootstrap bundle JS -->
<script src="<?php echo $web_root ?>assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="<?php echo $web_root ?>assets/js/jquery.min.js"></script>
<script src="<?php echo $web_root ?>lib/simplebar/js/simplebar.min.js"></script>
<script src="<?php echo $web_root ?>lib/metismenu/js/metisMenu.min.js"></script>
<script src="<?php echo $web_root ?>lib/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="<?php echo $web_root ?>lib/toast/toast.js"></script>
<script src="<?php echo $web_root ?>assets/js/pace.min.js"></script>
<!--app-->
<script src="<?php echo $web_root ?>assets/js/app.js"></script>

  <script src="../../lib/ajax_loader/jquery.mloading.js"></script>
  <script src="../../lib/ckeditor/ckeditor.js"></script>
  <script src="../../lib/ckeditor/plugins/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
  <script src="../../js/appConfig.js"></script>
  <script src="../../js/qp/editQustPaper.js"></script>
</body>
</html>
