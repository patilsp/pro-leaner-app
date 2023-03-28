<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";

//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php";
?>
<!DOCTYPE html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />

    <title>PMS - Dashboard</title>
    
  <?php include("../componets/style.php"); ?>
  <link rel="stylesheet" type="text/css" href="../../css/assessment/assessment.css">
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
          <div class="" id="main-container">
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
              <div class="row g-2 mb-3">
                <div class="page-breadcrumb d-sm-flex align-items-center">
                  <div class="breadcrumb-title pe-3 border-0 w-100">
                    <div class="row">
                      <div class="col-md">
                        <h5><b>Heading:</b> <?php echo $secHeading; ?></h5>
                        <h5><b>Title:</b> <?php echo $secTitle; ?></h5>
                      </div>
                    </div>
                  </div>
                  <div class="ms-auto w-100 text-right">
                    <h5><b>Marks:</b> <?php echo $secMarks; ?></h5>
                  </div>
                </div>
              </div>
              <div class="card qustCard mainIndex subindex mainMarks subMarks">
                <div class="card-body">
                  <div class="row g-2 mb-3">
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
                                <div class="ms-auto w-100 text-right">
                                  <h5><b>'.$qpsqMarks.'</b></h5>
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
                                <div class="ms-auto w-100 text-right">
                                  <h5><b>'.$qpsqMarks.'</b></h5>
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
                                          Multiple Short Answer - '.$questionContent.'
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
                                <div class="ms-auto w-100 text-right">
                                  <h5><b>'.$qpsqMarks.'</b></h5>
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
                                <div class="ms-auto w-100 text-right">
                                  <h5><b>'.$qpsqMarks.'</b></h5>
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

                                                $convFitb = str_replace('[blank]', '<input type="text" data-attr="'.$qustFillInTheBlank['id'].'" class="form-control inputBox" style="width: 100%;margin: 0px 1rem;max-width: 200px;">', $qustFillInTheBlank['qustFill']);
                                                $data .= $convFitb;
                                                
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
                                  <div class="ms-auto w-100 text-right">
                                    <h5><b>'.$qpsqMarks.'</b></h5>
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
                                <div class="ms-auto w-100 text-right">
                                  <h5><b>'.$qpsqMarks.'</b></h5>
                                </div>
                              </div>
                            </div>';
                          }
                        }

                        echo $data;
                      ?>
                    </span>
                  </div>
                </div>
              </div>
              <?php
                }//end of question section loop
              ?>
            </span>
            <!-- Section End -->
          </div>
        </form>
      </div>
    </div>
  <!--end page main-->
</div>
<!-- ./wrapper -->
  
  <?php include("../componets/js.php"); ?>
  <script src="../../lib/ckeditor/ckeditor.js"></script>
  <script src="../../lib/ckeditor/plugins/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
  <script src="../../js/appConfig.js"></script>
</body>
</html>
