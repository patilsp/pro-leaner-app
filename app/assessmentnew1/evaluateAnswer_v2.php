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
  <link rel="stylesheet" type="text/css" href="../../css/candidateDashboard/candidateLearner.css">
  <style type="text/css">
    .right_ans {
      border-radius: 10px;
      box-shadow: 0 2px 8px 0 rgb(0 0 0 / 20%);
      border: solid 4px #26e552;
      background-color: #ebfdef;
      padding: 5px;
    }
    .right_ans p {
      margin-bottom: 0px;
    }
    .mr-1 {
      margin-right: 1rem;
    }
    label p {
      margin-bottom: 0px;
    }
    input.marks{
      width: 100px;
      text-align: center;
      font-weight: bold;
    }
    .DDMatchStyles ul li{
      background: #7e8e9e;
    }
    .DDMatchStyles ul li.qust_li span.qust_span{
      height: 100%;
    }
    .DDMatchStyles .drag_option_list li span.ans_span {
      height: 100%;
      padding: 0px 10px 0px 50px;
    }
    #userInfoHeader{
      position: fixed;
      z-index: 10;
      left: 0px;
      background: #e2e3e4;
      width: 100%;
      top: 0px;
      margin: 0px;
      padding: 1rem;
    }
    .card-header {
      height: auto;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>

<body>
	
<?php



  // echo "<pre/>";
  // print_r($_GET);
  $qpId = $_GET["assessment_id"];
  $candidate_id = $_GET["user_id"];

  $qustSectionsData = GetRecords("qp_qustpapersections", array("qustPaperId"=>$qpId));

  $qp = GetRecord("qp_qustpaper", array("id"=>$qpId));
 
  /*echo '<pre/>';
  print_r($qustSectionsData);*/

  $candidateAssRes = GetRecords("qp_candidate_assess_response", array("assessId"=>$qpId, "userId"=>$candidate_id));
  $query = "SELECT u.*, car.userResJson FROM users u, qp_candidate_assess_response car WHERE car.assessId=? AND car.userId=? AND u.id=car.userid";
  $stmt = $db->prepare($query);
  $stmt->execute(array($qpId, $candidate_id));
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

  /*echo "<pre/>";
  print_r($row);die;*/

  $candiAssResArr = object_to_array(json_decode($row[0]['userResJson']));
  /*echo '<pre/>';
  print_r($candiAssResArr); */

  function object_to_array($data)
  {
    if (is_array($data) || is_object($data))
    {
      $result = [];
      foreach ($data as $key => $value)
      {
          $result[$key] = (is_array($data) || is_object($data)) ? object_to_array($value) : $value;
      }
      return $result;
    }
    return $data;
  }   
?>

<div class="container-fluid">
  <div class="row align-items-center justify-content-center" id="evaluate_answer_paper">
    <form id="formEA" method="post" name="formEA">
      <div class="col-12 p-0 h-100">
        <div class="new-custom-card">
          <div class="row d-flex align-items-center" id="userInfoHeader">
            <div class="d-flex align-items-center position-relative mb-1 ml-0">
              <p class="assmnt_label_name mb-0" style="width:80px; margin-left: 5px">Name </p>
              <p class="mb-0 assmnt_label_value text-left" style="width: 300px"><span id="student_name"><?php echo $row[0]['fName'].' '.$row[0]['lName']; ?></span></p>
            </div>
            <div class="d-flex align-items-center position-relative col-sm-11 mt-2 mb-2 w-100">
              <div class="d-flex align-items-center div_border w-100 mr-4 ml-4">
                <p class="mb-0 assmnt_label_name w-100 ">Marks Obtained</p>
                <?php $marksObtain = 0; ?>
                <input type="hidden" id="mark_obtain">
                <p class="mb-0 assmnt_label_value text-right"><span id="marks_earned"><?php echo $marksObtain; ?></span></p>
              </div>
            </div>
            <div class="d-flex align-items-center position-relative col-sm-11 mt-2 mb-2 w-100">
              <div class="d-flex align-items-center div_border w-100 mr-4 ml-4">
                <p class="mb-0 assmnt_label_name w-100">Total Marks</p>
                <p class="mb-0 assmnt_label_value text-right"><span id="max_marks"><?php echo $qp['totMarks']; ?></span></p>
              </div>
            </div>
          </div>


          <div class="position-relative bg-transparent mx-3" id="evaluate_answer_paper" style="margin-top: 13rem;">
            <?php
              foreach ($qustSectionsData as $key => $qpSec) {
            ?>
              <span class="questionSection">
                <div class="d-flex w-100 p-15 mb-1">
                  <div class="flex-grow-1">
                    <h5 class="font-weight-bold"><u><?php echo $qpSec['secHeading']; ?></u></h5>
                  </div>
                  <div class="p-2 flex-shrink-1">
                    <h6 class="font-weight-bold"><?php //echo $qpSec['secMarks']; ?></h6>
                  </div>
                </div>
              </span>

              <?php
                $i = 0;
                foreach ($candiAssResArr[$key] as $secQusts) {
                  foreach ($secQusts as $secQust) {
                    foreach ($secQust as $Qusts) {
                      foreach ($Qusts as $Qust) {
                        $i++;
                        /*echo "<pre/>";
                        print_r($Qust);*/
                        $qustpapersectionquestions = GetRecord("qp_qustpapersectionquestions", array("qustPaperSectionId"=>$qpSec['id'], "questionsId"=>$Qust['qId']));

                        //echo $qustpapersectionquestions['questionsId'].'-----'.$qustpapersectionquestions['qustMark']; echo "</br/>";

                        // mcq and mcqem type
                        if($Qust['qTypeId'] == 1 || $Qust['qTypeId'] == 2){
                          $qustQuery = GetRecord("qp_questions", array("id"=>$Qust['qId']));
                          $optQuery = GetRecords("qp_mcqoptions", array("qId"=>$Qust['qId']));
                          /*echo '<pre/>';
                          print_r($qustpapersectionquestions);*/
                          /*echo "<pre/>";
                          print_r($optQuery);die;*/
                          $htmData = '';
                          $qustMark = 0;
                          foreach ($optQuery as $key => $opt) {
                            $optionStatus = '<i></i>';
                            if(isset($Qust['aId']) && in_array($opt['id'], $Qust['aId'])){
                              if($opt['correctAns']) {
                                $optionStatus = '<i class="bi bi-check-circle-fill"></i>';
                                $qustMark = $qustpapersectionquestions['qustMark'];
                              } else {
                                $optionStatus = '<i class="bi bi-x-circle-fill"></i>';
                              }
                            }
                            $right_ans_class = '';
                            if($opt['correctAns']){
                              $right_ans_class = 'right_ans';
                            }
                            $htmData .= '
                            <div class="col-12 pl-4">
                              <div class="form-check d-flex align-items-center">
                                <div class="optionInfo">
                                  '.$optionStatus.'
                                </div>
                                <label class="form-check-label '.$right_ans_class.'" for="flexRadioDefault-10">
                                  '.$opt['optionContent'].'
                                </label>
                              </div>
                            </div>
                            ';
                          }
                          $marksObtain += $qustMark;
                          echo '
                          <div class="row justify-content-center mb-3 candidate_quest multichoice" id="candidateFAQ">
                            <div class="d-flex w-100 p-15 mb-1">
                              <div class="text-left mr-10">
                                <!-- <h5 class="font-weight-bold">'.$i.'</h5> -->
                              </div>
                              <div class="flex-grow-1">
                                <h5 class="font-weight-bold">
                                  '.$qustQuery['question'].'
                                </h5>
                              </div>
                              <div class="p-2 flex-shrink-1">
                                <div class="input-group">
                                  <input type="number" data-qustId="'.$Qust['qId'].'" placeholder="'.$qustpapersectionquestions['qustMark'].'" min="0" max="'.$qustpapersectionquestions['qustMark'].'" name="marks" value="'.$qustMark.'" class="form-control marks" onkeyup="enforceMinMax(this)"/>
                                  <span class="input-group-text">Max Marks: '.$qustpapersectionquestions['qustMark'].'</span>
                                </div>
                              </div>
                            </div>
                            '.$htmData.'
                          </div>
                          ';
                        }// end mcq and mcqem type if condition

                        // nested question with SA and MCQ type
                        if($Qust['qTypeId'] == 7){
                          $totNoOfQustsForTheNestedQust = 0;
                          $noOfNestedSA = 0;
                          $noOfNestedMCQ = 0;
                          $qustMark = 0;
                          $mainQustId = $Qust['qId'];
                          $qustQuery = GetRecord("questions", array("qustDetailsId"=>$mainQustId));
                          echo '
                          <div class="row justify-content-center mb-3 candidate_quest nested" id="candidateFAQ">
                            <div class="d-flex w-100 p-15 mb-1">
                              <div class="text-left mr-10">
                                <!-- <h5 class="font-weight-bold">'.$i.'</h5> -->
                              </div>
                              <div class="flex-grow-1">
                                <h5 class="font-weight-bold">
                                  '.$qustQuery['question'].'
                                </h5>
                              </div>
                              
                            </div>
                            <div class="col-9 pl-4">';

                            if(isset($Qust['sa'])) {
                              /*echo "<pre/>";
                              print_r($Qust['sa']);*/
                              //$htmlNestedSA = '';
                              echo '<div class="row SAMCQ">';
                              foreach ($Qust['sa'] as $key => $value) {
                                $noOfNestedSA++;
                                $qust_Ans = explode('::', $value);
                                $qustId = $qust_Ans[0];
                                $ansTxt = $qust_Ans[1];
                                //echo $mainQustId;die; 
                                $qustSAQuery = GetRecord("qp_nestedshortanser", array("id"=>$qustId, "qId"=>$mainQustId));

                                echo '
                                  <div class="col-12 col-sm-12 col-md-12 saCol">
                                    <div class="card">
                                      <div class="card-header">
                                        '.$qustSAQuery['question'].'
                                      </div>
                                      <div class="card-body">
                                        <div class="col-sm-12">
                                          <textarea class="form-control descriptive_marks question_table_textarea ckeditorTxt" rows="5" data-attr="1">'.$ansTxt.'</textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                ';
                              }
                              echo '</div>';
                            }

                            $noOfNestedMCQQustRightAns = 0;
                            if(isset($Qust['mcq'])) {
                              /*echo "<pre/>";
                              print_r($Qust['mcq']);die;*/
                              //$htmlNestedSA = '';
                              echo '<div class="row SAMCQ">';
                              foreach ($Qust['mcq'] as $key => $value) {
                                $noOfNestedMCQ++;
                                $qust_Ans = explode('-', $value);
                                $qustId = $qust_Ans[0];
                                $ansId = $qust_Ans[1];
                                //echo $mainQustId;die; 
                                $qustMcqQuery = GetRecord("qp_nestedmcqquestions", array("id"=>$qustId, "qId"=>$mainQustId));
                                $mcqOptQuery = GetRecords("nestedmcqoptions", array("nestedmcqqId"=>$qustId));
                                echo '
                                  <div class="col-12 mcqCol">';
                                    echo $qustMcqQuery['question'];
                                    foreach ($mcqOptQuery as $key => $opt) {
                                      $optionStatus = '<i></i>';
                                      if($ansId == $opt['id']){
                                        /*echo "<pre/>";
                                        print_r($opt);*/
                                        //echo $opt['correctAns'];echo "<br/>";
                                        if($opt['correctAns']) {
                                          $optionStatus = '<i class="bi bi-check-circle-fill"></i>';
                                          $noOfNestedMCQQustRightAns++;
                                        } else {
                                          $optionStatus = '<i class="bi bi-x-circle-fill"></i>';
                                        }
                                      }
                                      $right_ans_class = '';
                                      if($opt['correctAns']){
                                        $right_ans_class = 'right_ans';
                                      }
                                      echo '
                                      <div class="col-12 pl-4">
                                        <div class="form-check d-flex align-items-center">
                                          <div class="optionInfo">
                                            '.$optionStatus.'
                                          </div>
                                          <label class="form-check-label '.$right_ans_class.'" for="flexRadioDefault-10">
                                            '.$opt['optionContent'].'
                                          </label>
                                        </div>
                                      </div>
                                      ';
                                    }
                                echo '</div>
                                ';
                              }
                              echo '</div>';
                            }

                            $totNoOfQustsForTheNestedQust = $noOfNestedSA + $noOfNestedMCQ;
                            $eachQustMarkForTheNestedQust = $qustpapersectionquestions['qustMark'] / $totNoOfQustsForTheNestedQust;
                            $totRightNestedMCQQust = $noOfNestedMCQQustRightAns * $eachQustMarkForTheNestedQust;
                            $marksObtain += $totRightNestedMCQQust;
                            $totNoOfQustsForTheNestedQust = $noOfNestedSA = $noOfNestedMCQ = 0;
                          echo '
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                  <input type="number" data-qustId="'.$Qust['qId'].'" placeholder="'.$qustpapersectionquestions['qustMark'].'" min="0" max="'.$qustpapersectionquestions['qustMark'].'" name="marks" value="'.$totRightNestedMCQQust.'" class="form-control marks" onkeyup="enforceMinMax(this)"/>
                                  <span class="input-group-text">Max Marks: '.$qustpapersectionquestions['qustMark'].'</span>
                                </div>
                              </div>
                          </div>
                          ';
                        }// end mcq and mcqem type if condition

                        // DD Match
                        if($Qust['qTypeId'] == 5){
                          /*echo '<pre/>';
                          print_r($Qust);*/
                          $qustQuery = GetRecord("qp_questions", array("id"=>$Qust['qId']));
                          $ddmatchqust = GetRecords("qp_ddmatchqust", array("qId"=>$Qust['qId']));
                          $htmlDDMatchData = '
                            <h4 class="text-center col-12 mb-4">Drag and move the correct response against the question.</h4>
                            <div class="col-6 qust_table_col">
                              <table class="table table-borderless">
                                <tbody>
                                <tr class="d-flex align-items-center">
                                  <td class="col-12 text-center"><h4 class="m-0">Question</h4></td>
                                </tr>
                          ';
                                $qustMark = 0;
                                $noOfDDMatchQustsRows = 0;
                                $noOfDDMatchRowsRight = 0;
                                $wrong = false;
                                foreach ($ddmatchqust as $key => $value) {
                                  $noOfDDMatchQustsRows++;
                                  $getDDAns = GetRecord("qp_ddmatchans", array("ddMatchQustId"=>$value['id']));

                                  $optionDDStatus = '<td><div class="optionInfo"><i class="bi bi-x-circle-fill"></i></div></td>';
                                  if(isset($Qust['aId'][$key])){
                                    if($Qust['aId'][$key] == $getDDAns['id']) {
                                      $optionDDStatus = '<td><div class="optionInfo"><i class="bi bi-check-circle-fill"></i></div></td>';
                                      $noOfDDMatchRowsRight++;
                                    } else {
                                      $optionDDStatus = '<td><div class="optionInfo"><i class="bi bi-x-circle-fill"></i></div></td>';
                                      $wrong = true;
                                    }
                                  }

                                  $htmlDDMatchData .= '
                                  <tr class="d-flex align-items-center">
                                    '.$optionDDStatus.'
                                    <td class="col-12 qust_td">
                                      <ul>
                                        <li class="qust_li">
                                          <span class="d-flex align-items-center qust_span">
                                            <p>'.$value['qustCol'].'</p>
                                          </span>
                                        </li>
                                      </ul>
                                    </td>
                                  </tr>
                                  ';
                                }
                                $eachDDMatchRowMark = $qustpapersectionquestions['qustMark'] / $noOfDDMatchQustsRows;
                                $qustMark = $eachDDMatchRowMark * $noOfDDMatchRowsRight;
                          $htmlDDMatchData .= '
                                </tbody>
                              </table>
                            </div>
                          ';

                          $htmlDDMatchAns = '
                            <div class="col-6 ans_table_col">
                              <table class="table table-borderless">
                                <tbody class="connectedSortable sortable ui-sortable">
                                <tr class="d-flex align-items-center">
                                  <td class="col-12 text-center"><h4 class="m-0 w-100">Response</h4></td>
                                </tr>
                            ';
                                foreach ($Qust['aId'] as $key => $value) {
                                  $getDDAns = GetRecord("qp_ddmatchans", array("id"=>$value));

                                  $htmlDDMatchAns .= '
                                  <tr class="d-flex align-items-center ui-sortable-handle" id="item0">
                                    <td class="col-12" id="last_td1">
                                      <ul class="drag_option_list">
                                        <li class="active options_li" data-dragliid="4-6-6">
                                          <span class="d-flex align-items-center ans_span">
                                            <p>'.$getDDAns['ansCol'].'</p>
                                          </span>
                                        </li>
                                      </ul>
                                    </td>
                                  </tr>
                                  ';
                                }
                          $htmlDDMatchAns .= '
                                </tbody>
                              </table>
                            </div>
                          ';

                          echo '
                          <div class="row justify-content-center mb-3 candidate_quest ddmatch" id="candidateFAQ">
                            <div class="d-flex w-100 p-15 mb-1">
                              <div class="text-left mr-10">
                                <!-- <h5 class="font-weight-bold">'.$i.'</h5> -->
                              </div>
                              <div class="flex-grow-1">
                                <h5 class="font-weight-bold">
                                  <p>Question ddmatc</p>
                                </h5>
                              </div>
                              <div class="p-2 flex-shrink-1">
                                <div class="input-group">
                                  <input type="number" data-qustId="'.$Qust['qId'].'" placeholder="'.$qustpapersectionquestions['qustMark'].'" min="0" max="'.$qustpapersectionquestions['qustMark'].'" name="marks" value="'.$qustMark.'" class="form-control marks" onkeyup="enforceMinMax(this)"/>
                                  <span class="input-group-text">Max Marks: '.$qustpapersectionquestions['qustMark'].'</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 pl-4">
                              <div class="row DDMatchStyles">
                                '.$htmlDDMatchData.'
                                '.$htmlDDMatchAns.'
                              </div>
                            </div>
                          </div>
                          ';
                        }// end DD Match type if condition

                        // Fill IN the Blank
                        if($Qust['qTypeId'] == 6){
                          /*echo '<pre/>';
                          print_r($Qust);*/
                          $qustQuery = GetRecord("qp_questions", array("id"=>$Qust['qId']));


                          echo '
                            <div class="row justify-content-center mb-3 candidate_quest Fillintheblanks" id="candidateFAQ">
                              <div class="d-flex w-100 p-15 mb-1">
                                <div class="text-left mr-10">
                                  <!-- <h5 class="font-weight-bold">'.$i.'</h5> -->
                                </div>
                                <div class="flex-grow-1">
                                  <h5 class="font-weight-bold">
                                    '.$qustQuery['question'].'
                                  </h5>
                                </div>
                                <div class="p-2 flex-shrink-1">
                                  <div class="input-group">
                                    <input type="number" data-qustId="'.$Qust['qId'].'" placeholder="'.$qustpapersectionquestions['qustMark'].'" min="0" max="'.$qustpapersectionquestions['qustMark'].'" name="marks" class="form-control marks" onkeyup="enforceMinMax(this)" value="0"/>
                                    <span class="input-group-text">Max Marks: '.$qustpapersectionquestions['qustMark'].'</span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 pl-4">
                                <div class="row">
                                  <div class="col-12">
                                    <ol class="p-0">';
                                      $fillintheblank = GetRecords("qp_fillintheblank", array("qId"=>$Qust['qId']));
                                      foreach ($fillintheblank as $key => $value) {
                                        $ip = '<input type="text" class="form-control inputBox" style="width: 100%;margin: 0px 1rem;max-width: 200px;" disabled value="'.$Qust['aText'][$key]['fillVal'].'">';
                                        $qustFB = str_replace('[blank]', $ip, $value['qustFill']);
                                        echo '<li class="d-flex align-items-center m-2">'.$qustFB.'</li>';
                                      } 
                                    echo '
                                    </ol>
                                  </div>
                                </div>
                              </div>
                            </div>
                          ';
                          
                        }// end Fill IN the Blank type if condition

                        // SA
                        if($Qust['qTypeId'] == 3){
                          /*echo '<pre/>';
                          print_r($Qust);*/
                          $qustQuery = GetRecord("qp_questions", array("id"=>$Qust['qId']));
                           
                          echo '
                          <div class="row justify-content-center mb-3 candidate_quest shortanswer" id="candidateFAQ">
                            <div class="d-flex w-100 p-15 mb-1">
                              <div class="text-left mr-10">
                                <!-- <h5 class="font-weight-bold">'.$i.'</h5> -->
                              </div>
                              <div class="flex-grow-1">
                                <h5 class="font-weight-bold">
                                  '.$qustQuery['question'].'
                                </h5>
                              </div>
                              <div class="p-2 flex-shrink-1">
                                <div class="input-group">
                                  <input type="number" data-qustId="'.$Qust['qId'].'" placeholder="'.$qustpapersectionquestions['qustMark'].'" min="0" max="'.$qustpapersectionquestions['qustMark'].'" name="marks" class="form-control marks" onkeyup="enforceMinMax(this)" value="0"/>
                                  <span class="input-group-text">Max Marks: '.$qustpapersectionquestions['qustMark'].'</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 pl-4">
                              <div class="col-sm-12">
                                <textarea class="form-control descriptive_marks question_textarea textareaEditor ckeditorTxt" rows="5" data-attr="2">'.$Qust['aText'].'</textarea>
                              </div>
                            </div>
                          </div>';
                        }// end SA type if condition

                        // SA Table
                        if($Qust['qTypeId'] == 4){
                          /*echo '<pre/>';
                          print_r($Qust);*/
                          $qustQuery = GetRecord("qp_questions", array("id"=>$Qust['qId']));

                          echo '
                            <div class="row justify-content-center mb-3 candidate_quest shortanswertable" id="candidateFAQ">
                              <div class="d-flex w-100 p-15 mb-1">
                                <div class="text-left mr-10">
                                  <!-- <h5 class="font-weight-bold">'.$i.'</h5> -->
                                </div>
                                <div class="flex-grow-1">
                                  <h5 class="font-weight-bold">
                                    '.$qustQuery['question'].'
                                  </h5>
                                </div>
                                <div class="p-2 flex-shrink-1">
                                  <div class="input-group">
                                    <input type="number" data-qustId="'.$Qust['qId'].'" placeholder="'.$qustpapersectionquestions['qustMark'].'" min="0" max="'.$qustpapersectionquestions['qustMark'].'" name="marks" class="form-control marks" onkeyup="enforceMinMax(this)" value="0"/>
                                    <span class="input-group-text">Max Marks: '.$qustpapersectionquestions['qustMark'].'</span>
                                  </div>
                                </div>
                              </div>
                              ';
                              //echo $Qust['qId'];die;
                              echo '
                              <div class="col-12 pl-4">
                                <div class="row">';
                              $saTbQust2 = GetRecords("qp_shortansertable", array("qId"=>$Qust['qId']));
                              foreach ($saTbQust2 as $key => $value) {
                                echo '
                                    <div class="col-12 col-sm-12 col-md-12">
                                      <div class="card">
                                        <div class="card-header">
                                          '.$value['qustTd'].'
                                        </div>
                                        <div class="card-body">
                                          <div class="col-sm-12">
                                            <textarea class="form-control readonly descriptive_marks question_table_textarea ckeditorTxt" readonly rows="5" data-attr="3">'.$Qust['aText'][$key].'</textarea>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                ';
                              }
                          echo '
                                </div>
                              </div>
                            </div>
                          ';
                        }// end SA Table type if condition
                      }
                    }  
                  }
                }
              ?>
            <?php 
              }
            ?>             
          </div>
            <div class="d-flex text-left mt-2 mb-2">
              <label class="form-label select-label m-15">Status</label>
                <select id="resultStatus" class="form-select select w-250" >
                  <option value="">Select Status</option>
                  <option value="Pass">Pass</option>
                  <option value="Fail">Fail</option>
              
                </select>
             
            </div>


          <div class="form-group mx-3">
            <label for="overall_remarks">Remarks</label>
            <textarea class="form-control" rows="4" id="overall_remarks" rows="3"></textarea>
          </div>
        </div>
      </div>
      <input type="hidden" id="type" name="type" value="saveEvaluation">
      <input type="hidden" id="assessment_id" name="assessment_id" value="<?php echo $qpId; ?>">
      <input type="hidden" id="user_id" name="user_id" value="<?php echo $row[0]['id']; ?>">
      <input type="hidden" id="marksObtainedPHP" value="<?php echo $marksObtain; ?>">

      <div class="card">
        <div class="card-footer text-center">
          <button type="button" id="save_assessment" class="btn btn-sueccss">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
	
	<?php include("../componets/js.php"); ?>
  <script src="../../lib/ckeditor/ckeditor.js"></script>
  <script src="../../lib/ckeditor/plugins/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
  <script src="../../js/appConfig.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $(".ckeditorTxt").each(function(_, ckeditor) {
        CKEDITOR.replace(ckeditor, {
          allowedContent: true,
          toolbarGroups: [],
          height: ['300px'],
          readOnly: true
        });
      });

      //Marks
      $('#marks_earned').text($('#marksObtainedPHP').val());
      var max_marks = parseInt($('#max_marks').text());
      
      $(document).on("click", "#save_assessment", function() {
          var QuestionWiseMarksObtained = [];
          $('.marks').each(function(index, value) {
            var qustIdMarks = Number($(this).attr('data-qustId'))+'-'+Number($(this).val());
            QuestionWiseMarksObtained.push(qustIdMarks);
          });

          var mark_obtain = parseInt($("#marks_earned").text());
          var resultStatus = $("#resultStatus").val();
          var remarks = $("#overall_remarks").val();
          var assessId = $("#assessment_id").val();
          var user_id = $('#user_id').val();
          if (resultStatus == '') {
              alert("Please fill the Status");
              return false;
          }
          /*var descriptive = [];
          $(".marks").each(function(index, value) {
              var decriptive = $(this).attr("id");
              var qId = decriptive.split("_");
              descriptive.push({
                  qId: qId[2],
                  mark: $(this).val()
              });
          });*/
          if (resultStatus != '') {
            //alert("came");
              $.ajax({
                  url: "../../app/assessmentnew1/apis/evaluateAssessment.php",
                  type: "post",
                  data: {
                      type: 'evaluateAssessment',
                      marksObtained: mark_obtain,
                      resultStatus: resultStatus,
                      remarks: remarks,
                      assessId: assessId,
                      userId: user_id,
                      QuestionWiseMarksObtained: QuestionWiseMarksObtained
                  },
                  jsonType: "json",
                  success: function(data) {
                      $("body").html('<div class="alert alert-success text-center" role="alert">Evaluation Completed.</div>');
                      $('body, html').scrollTop(0);
                  }
              });
          }
      });
    });

    setTimeout(function () {
      var marksobtained = 0;
      $('.marks').each(function(index, value) {
        //console.log(value,"--");
        var val = Number($(this).val());
        //marksobtained += round(val, 0);
        marksobtained += val;
      });
      //console.log(marksobtained);
      if(!isNaN(marksobtained)) {
        $('#marks_earned').text(marksobtained);
      }
    }, 1000)

    function enforceMinMax(el){
      if(el.value != ""){
        if(parseInt(el.value) < parseInt(el.min)){
          el.value = el.min;
        }
        if(parseInt(el.value) > parseInt(el.max)){
          el.value = el.max;
        }

        var marksobtained = 0;
        $('.marks').each(function(index, value) {
          //console.log(value,"--");
          var val = Number($(this).val());
          //marksobtained += round(val, 0);
          marksobtained += val;
        });
        //console.log(marksobtained);
        if(!isNaN(marksobtained)) {
          $('#marks_earned').text(marksobtained);
        }
      }
    }

    /**
     * https://stackoverflow.com/questions/1726630/formatting-a-number-with-exactly-two-decimals-in-javascript
     * Round half up ('round half towards positive infinity')
     * Uses exponential notation to avoid floating-point issues.
     * Negative numbers round differently than positive numbers.
     */
    function round(num, decimalPlaces) {
        num = Math.round(num + "e" + decimalPlaces);
        return Number(num + "e" + -decimalPlaces);
    }
  </script>
</body>
</html>
