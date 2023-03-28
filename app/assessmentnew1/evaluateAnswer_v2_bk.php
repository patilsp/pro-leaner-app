<?php
	include "../../configration/config.php";
?>
<!DOCTYPE html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />

    <title>PMS - Dashboard</title>
    
  <?php include("../../componets/style.php"); ?>
  <link rel="stylesheet" type="text/css" href="../../assets/css/assessment/assessment.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/candidateDashboard/candidateLearner.css">
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
    .multichoicem label p {
      margin-bottom: 0px;
    }
    input.marks{
      width: 100px;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>

<body>
	
<!-- <div class="container">
  <?php
    // echo "<pre/>";
    // print_r($_GET);
    /*$status=[];
    $question_id = $_GET["assessment_id"];
    $query = "SELECT *,GROUP_CONCAT(mcqoptions.id) as mcqoptionId,GROUP_CONCAT(mcqoptions.optionContent) as optionContents,GROUP_CONCAT(mcqoptions.correctAns) as optionAns FROM qustpapersections LEFT JOIN qustpapersectionquestions ON qustpapersectionquestions.qustPaperSectionId=qustpapersections.id LEFT JOIN questions ON questions.id=qustpapersectionquestions.questionsId LEFT JOIN questiondetails ON questiondetails.id = questions.qustDetailsId LEFT JOIN master_questiontypes ON master_questiontypes.id =questiondetails.qustType LEFT JOIN mcqoptions ON mcqoptions.qId= questions.id  where qustpapersections.qustPaperId=? GROUP BY questions.id";
    $stmt1 = $db->prepare($query);
    $stmt1->execute([$question_id]);
    $row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $section=[];
    foreach($row1 as $row){
      $section[$row['qustPaperSectionId']][] =$row;
    }    */
  ?>
  <p>testing<math xmlns="http://www.w3.org/1998/Math/MathML"><mroot><mn>2</mn><mn>1</mn></mroot></math></p>
</div> -->

<div class="container-fluid">
<div class="row align-items-center justify-content-center" id="evaluate_answer_paper">
        <form id="formEA" method="post" name="formEA">
          <div class="col-12 p-0 h-100">
            <div class="new-custom-card">
             
              <div class="d-flex align-items-center position-relative mb-1 ml-0">
                <p class="assmnt_label_name m-0" style="width:80px">Name </p>
                <p class="m-0 assmnt_label_value text-left" style="width: 300px"><span id="student_name">Dinesh Vemula</span></p>
              </div>
              <div class="d-flex align-items-center position-relative mb-4 ml-0">
                <div class="d-flex align-items-center ml-5">
                  <!-- <p class="mb-0 assmnt_label_name mr-4" style="width: 95px">Admn No.</p>
                  <p class="mb-0 assmnt_label_value text-left" style="width: 300px"><span id="student_admission_no"></span>716846</p> -->
                </div>
              </div>
              <div class="d-flex align-items-center position-relative col-sm-11 mt-2 mb-2 w-100">
                <div class="d-flex align-items-center div_border w-100 mr-4 ml-4">
                  <p class="mb-0 assmnt_label_name w-100 ">Marks Obtain</p>
                  <input type="hidden" id="mark_obtain">
                  <p class="mb-0 assmnt_label_value text-right"><span id="marks_earned">40</span></p>
                </div>
              </div>
              <div class="d-flex align-items-center position-relative col-sm-11 mt-2 mb-2 w-100">
                <div class="d-flex align-items-center div_border w-100 mr-4 ml-4">
                  <p class="mb-0 assmnt_label_name w-100">Total Marks</p>
                  <p class="mb-0 assmnt_label_value text-right"><span id="max_marks">100</span></p>
                </div>
              </div>


              <div class="position-relative bg-transparent mx-3 mt-4" id="evaluate_answer_paper">
                <h5 class="text-center mb-4 w-100"><u>Evaluate Answer</u></h5>
                <span class="questionSection">
                  <div class="d-flex w-100 p-15 mb-1">
                    <div class="flex-grow-1">
                      <h5 class="font-weight-bold"><u>Heading</u></h5>
                    </div>
                    <div class="p-2 flex-shrink-1">
                      <h6 class="font-weight-bold">Marks</h6>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-3 candidate_quest multichoice" id="candidateFAQ">
                    <div class="d-flex w-100 p-15 mb-1 align-items-center">
                      <div class="text-left mr-10">
                        <h5 class="font-weight-bold">1. </h5>
                      </div>
                      <div class="flex-grow-1">
                        <h5 class="font-weight-bold">
                          <p>
                            Question&nbsp;
                            <math xmlns="http://www.w3.org/1998/Math/MathML">
                              <mi>x</mi>
                              <mo>=</mo>
                              <mfrac>
                                <mrow>
                                  <mo>-</mo>
                                  <mi>b</mi>
                                  <mo>±</mo>
                                  <msqrt>
                                    <msup>
                                      <mi>b</mi>
                                      <mn>2</mn>
                                    </msup>
                                    <mo>-</mo>
                                    <mn>4</mn>
                                    <mi>a</mi>
                                    <mi>c</mi>
                                  </msqrt>
                                </mrow>
                                <mrow>
                                  <mn>2</mn>
                                  <mi>a</mi>
                                </mrow>
                              </mfrac>
                            </math>
                          </p>
                        </h5>
                      </div>
                      <div class="p-2 flex-shrink-1">
                        <input type="number" name="marks" value="1" class="form-control marks" />
                      </div>
                    </div>
                    <div class="col-12 pl-4">
                      <div class="form-check d-flex align-items-center">
                        <div class="optionInfo">
                          <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <label class="form-check-label" for="flexRadioDefault-10">
                          <p>
                            <math xmlns="http://www.w3.org/1998/Math/MathML">
                              <mi>o</mi>
                              <mi>p</mi>
                              <mi>t</mi>
                              <mi>i</mi>
                              <mi>o</mi>
                              <mi>n</mi>
                              <mo>&nbsp;</mo>
                              <mn>1</mn>
                              <mo>&nbsp;</mo>
                              <mo>-</mo>
                              <mo>&nbsp;</mo>
                              <mi>x</mi>
                              <mo>=</mo>
                              <mfrac>
                                <mrow>
                                  <mo>-</mo>
                                  <mi>b</mi>
                                  <mo>±</mo>
                                  <msqrt>
                                    <msup>
                                      <mi>b</mi>
                                      <mn>2</mn>
                                    </msup>
                                    <mo>-</mo>
                                    <mn>4</mn>
                                    <mi>a</mi>
                                    <mi>c</mi>
                                  </msqrt>
                                </mrow>
                                <mrow>
                                  <mn>2</mn>
                                  <mi>a</mi>
                                </mrow>
                              </mfrac>
                            </math>
                          </p>
                        </label>
                      </div>
                      <div class="form-check d-flex align-items-center">
                        <div class="optionInfo mr-1">
                          <i></i>
                        </div>
                        <label class="form-check-label" for="flexRadioDefault-11">
                          <p>option 2</p>
                        </label>
                      </div>
                      <div class="form-check d-flex align-items-center">
                        <div class="optionInfo">
                          <i></i>
                        </div>
                        <label class="form-check-label right_ans" for="flexRadioDefault-12">
                          <p>option 3</p>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-3 candidate_quest multichoicem" id="candidateFAQ">
                    <div class="d-flex w-100 p-15 mb-1 align-items-center">
                      <div class="text-left mr-10">
                        <h5 class="font-weight-bold">2. </h5>
                      </div>
                      <div class="flex-grow-1">
                        <h5 class="font-weight-bold">
                          <p>Question Updated</p>
                        </h5>
                      </div>
                      <div class="p-2 flex-shrink-1">
                        <input type="number" name="marks" value="1" class="form-control marks" />
                      </div>
                    </div>
                    <div class="col-12 pl-4">
                      <div class="form-check d-flex align-items-center">
                        <div class="optionInfo">
                          <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <label class="form-check-label" for="flexCheckDefault-13">
                          <p>option 1 update1</p>
                        </label>
                      </div>
                      <div class="form-check d-flex align-items-center">
                        <div class="optionInfo">
                          <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <label class="form-check-label" for="flexCheckDefault-14">
                          <p>option 2 update2</p>
                        </label>
                      </div>
                     <div class="form-check d-flex align-items-center">
                        <div class="optionInfo">
                          <i></i>
                        </div>
                        <label class="form-check-label right_ans" for="flexCheckDefault-15">
                          <p>option 3 update3</p>
                        </label>
                      </div>
                      <div class="form-check d-flex align-items-center">
                        <div class="optionInfo">
                          <i></i>
                        </div>
                        <label class="form-check-label right_ans" for="flexCheckDefault-16">
                          <p>new option</p>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-3 candidate_quest ddmatch" id="candidateFAQ">
                    <div class="d-flex w-100 p-15 mb-1 align-items-center">
                      <div class="text-left mr-10">
                        <h5 class="font-weight-bold">3. </h5>
                      </div>
                      <div class="flex-grow-1">
                        <h5 class="font-weight-bold">
                          <p>Question ddmatc</p>
                        </h5>
                      </div>
                      <div class="p-2 flex-shrink-1">
                        <input type="number" name="marks" value="1" class="form-control marks" />
                      </div>
                    </div>
                    <div class="col-12 pl-4">
                      <div class="row DDMatchStyles">
                        <div class="col-6 qust_table_col">
                          <table class="table table-borderless">
                            <tbody>
                              <tr class="d-flex align-items-center">
                                <td>
                                  <div class="optionInfo">
                                    <i class="bi bi-x-circle-fill"></i>
                                  </div>
                                </td>
                                <td class="col-12 qust_td">
                                  <ul>
                                    <li class="qust_li">
                                      <span class="d-flex align-items-center">
                                        <p>option left update 1</p>
                                      </span>
                                    </li>
                                  </ul>
                                </td>
                              </tr>
                              <tr class="d-flex align-items-center">
                                <td>
                                  <div class="optionInfo">
                                    <i class="bi bi-x-circle-fill"></i>
                                  </div>
                                </td>
                                <td class="col-12 qust_td">
                                  <ul>
                                    <li class="qust_li">
                                      <span class="d-flex align-items-center">
                                        <p>option left 1 update 2</p>
                                      </span>
                                    </li>
                                  </ul>
                                </td>
                              </tr>
                              <tr class="d-flex align-items-center">
                                <td>
                                  <div class="optionInfo">
                                    <i class="bi bi-check-circle-fill"></i>
                                  </div>
                                </td>
                                <td class="col-12 qust_td">
                                  <ul>
                                    <li class="qust_li">
                                      <span class="d-flex align-items-center">
                                        <p>option left 2&nbsp;update 3</p>
                                      </span>
                                    </li>
                                  </ul>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-6 ans_table_col">
                          <table class="table table-borderless">
                            <tbody class="connectedSortable sortable ui-sortable">
                              <tr class="d-flex align-items-center ui-sortable-handle" id="item0">
                                <td class="col-12" id="last_td1">
                                  <ul class="drag_option_list">
                                    <li class="active options_li" data-dragliid="4-6-6">
                                      <span class="d-flex align-items-center">
                                        <p>option right update 1</p>
                                      </span>
                                    </li>
                                  </ul>
                                </td>
                              </tr>
                              <tr class="d-flex align-items-center ui-sortable-handle" id="item1">
                                <td class="col-12" id="last_td1">
                                  <ul class="drag_option_list">
                                    <li class="active options_li" data-dragliid="4-7-7">
                                      <span class="d-flex align-items-center">
                                        <p>option right 1 update 2</p>
                                      </span>
                                    </li>
                                  </ul>
                                </td>
                              </tr>
                              <tr class="d-flex align-items-center ui-sortable-handle" id="item2">
                                <td class="col-12" id="last_td1">
                                  <ul class="drag_option_list">
                                    <li class="active options_li" data-dragliid="4-8-8">
                                      <span class="d-flex align-items-center">
                                        <p>option right 2&nbsp;update 3</p>
                                      </span>
                                    </li>
                                  </ul>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-3 candidate_quest shortanswertable" id="candidateFAQ">
                    <div class="d-flex w-100 p-15 mb-1 align-items-center">
                      <div class="text-left mr-10">
                        <h5 class="font-weight-bold">4. </h5>
                      </div>
                      <div class="flex-grow-1">
                        <h5 class="font-weight-bold">
                          <p>Question SA Table update question</p>
                        </h5>
                      </div>
                      <div class="p-2 flex-shrink-1">
                        <input type="number" name="marks" value="1" class="form-control marks" />
                      </div>
                    </div>
                    <div class="col-12 pl-4">
                      <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                          <div class="card">
                            <div class="card-header">
                              <p>Enter Question...SA TB updated question 1</p>
                            </div>
                            <div class="card-body">
                              <div class="col-sm-12">
                                <textarea class="form-control question_table_textarea textareaEditor" id="textarea4" rows="5" data-attr="3"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                          <div class="card">
                            <div class="card-header">
                              <p>Enter Question...Sa Tb2 updated question 2</p>
                            </div>
                            <div class="card-body">
                              <div class="col-sm-12">
                                <textarea class="form-control question_table_textarea textareaEditor" id="textarea4" rows="5" data-attr="4"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                          <div class="card">
                            <div class="card-header">
                              <p>new Col qust</p>
                            </div>
                            <div class="card-body">
                              <div class="col-sm-12">
                                <textarea class="form-control question_table_textarea textareaEditor" id="textarea4" rows="5" data-attr="5"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-3 candidate_quest shortanswer" id="candidateFAQ">
                    <div class="d-flex w-100 p-15 mb-1 align-items-center">
                      <div class="text-left mr-10">
                        <h5 class="font-weight-bold">5. </h5>
                      </div>
                      <div class="flex-grow-1">
                        <h5 class="font-weight-bold">
                          <p>short answer question updated</p>
                        </h5>
                      </div>
                      <div class="p-2 flex-shrink-1">
                        <input type="number" name="marks" value="1" class="form-control marks" />
                      </div>
                    </div>
                    <div class="col-12 pl-4">
                      <div class="col-sm-12">
                        <textarea class="form-control question_textarea textareaEditor" id="textarea5" rows="5" data-attr="2"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-3 candidate_quest Fillintheblanks" id="candidateFAQ">
                    <div class="d-flex w-100 p-15 mb-1 align-items-center">
                      <div class="text-left mr-10">
                        <h5 class="font-weight-bold">7. </h5>
                      </div>
                      <div class="flex-grow-1">
                        <h5 class="font-weight-bold">
                          <p><span style="font-size:12pt; font-variant:normal; white-space:pre-wrap"><span style="font-family:'Bookman Old Style',serif"><span style="color:#000000"><span style="font-weight:400"><span style="font-style:normal"><span style="text-decoration:none">Fill in the blank with the opposites of the word in bracket Testing 123</span></span></span></span></span></span></p>
                        </h5>
                      </div>
                      <div class="p-2 flex-shrink-1">
                        <input type="number" name="marks" value="1" class="form-control marks" />
                      </div>
                    </div>
                    <div class="col-12 pl-4">
                      <div class="row">
                        <div class="col-12">
                          <ol class="p-0">
                            <li class="d-flex align-items-center m-2">Skywas(Clear)<input type="text" data-attr="7" class="form-control inputBox" style="width: 100%;margin: 0px 1rem;max-width: 200px;">anditwasquitedark.123</li>
                            <li class="d-flex align-items-center m-2">1223<input type="text" data-attr="7" class="form-control inputBox" style="width: 100%;margin: 0px 1rem;max-width: 200px;">45612344567899</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                  </div>
                </span>             
              </div>
                <div class="d-flex text-left mt-2 mb-2">
                  <label class="form-label select-label m-15">Status</label>
                    <select id="resultStatus" class="form-select select w-250" >
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
          <input type="hidden" id="attempt_id" name="attempt_id" value="">
          
        </form>
      </div>

</div>
	
	<?php include("../../componets/js.php"); ?>
  <script src="../../assets/plugins/ckeditor/ckeditor.js"></script>
  <script src="../../assets/plugins/ckeditor/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
  <script src="../../assets/js/appConfig.js"></script>
</body>
</html>
