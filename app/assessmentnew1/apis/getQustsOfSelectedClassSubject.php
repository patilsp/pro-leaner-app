<?php 
session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  // include "../functions/common_function.php";

/*echo "<pre/>";
print_r($_POST);die;*/
$questionDifficulty = '';
$qpqtype = '';
$questionType = '';
$qpTypeVal = $_POST['qpTypeVal'];
$qpCatVal = $_POST['qpCatVal'];
$qpClassVal = $_POST['qpClassVal'];
$qpSubVal = $_POST['qpSubVal'];
$qpChapsVal = $_POST['qpChapsVal'];
$qpTopicVal = $_POST['qpTopicVal'];
$qpSubTopVal = $_POST['qpSubTopVal'];
// $questionType = $_POST['questionType'];
$questionPaperType = $_POST['questionPaperType'];
if (isset($_POST["questionDifficulty"])) {
  $questionDifficulty = $_POST["questionDifficulty"];
}
if (isset($_POST["qpqtype"])) {
  $qpqtype = $_POST["qpqtype"];
  $questionType = $_POST["qpqtype"];
}

// $qpCatVal =0;
// $qpClassVal = 1;
// $qpSubVal = $_POST['qpSubVal'];
// $qpSubVal = 0 ;

$qustDiff = GetQueryRecords("SELECT * FROM masters_questions_difficulty");
$htmData = '<select class="form-select qpfilter" id="qpdifficulty">';
$htmData .= '<option value="">Select</option>';
foreach ($qustDiff as $key => $value) {
    if ($questionDifficulty == $value["id"]) {
      $htmData .= "<option value='".$value["id"]."'' selected>".$value["code"]."</option>";
    } else {
      $htmData .= "<option value='".$value["id"]."''>".$value["code"]."</option>";
    }
}
$htmData .= '</select>';
$qpqTypes = GetRecords("qp_master_questiontypes", array("deleted"=>0));
$htmData .= '<select class="form-select qpfilter" id="qpqtype">';
$htmData .= '<option value="">Select</option>';
foreach ($qpqTypes as $key => $value) {
    if ($qpqtype == $value["id"]) {
      $htmData .= "<option value='".$value["id"]."'' selected>".$value["name"]."</option>";
    } else {
      $htmData .= "<option value='".$value["id"]."''>".$value["name"]."</option>";
    }
}
$htmData .= '</select>';
// if($qpTypeVal == 1) {
//   $qustDets = GetRecords("qp_questiondetails", array("deleted"=>0, "catId"=>$qpCatVal, "subId"=>$qpSubVal));
//   foreach ($qustDets as $qustDet) {
//     $qust = GetRecord("qp_questions", array("qustDetailsId"=>$qustDet['id']));
//     $htmData .='
//     <div class="col-12 mb-3">
//       <div class="card">
//         <div class="card-body">
//           '.$qust['question'].'
//         </div>
//         <div class="card-footer d-flex align-items-center justify-content-center">
//           <div class="menuItem parent d-flex align-items-center justify-content-between form-check form-switch p-0">
//             <input class="form-check-input" name="questionDetailsId[]" value="'.$qustDet['qustType'].'-'.$qustDet['id'].'" type="checkbox">
//           </div>
//           <i class="bi bi-eye-fill viewQuestionBtn" data-id="'.$qustDet['id'].'" data-qustType="'.$qustDet['qustType'].'" style="margin-left: 2rem; cursor:pointer"></i>
//         </div>
//       </div>
//     </div>';
//   }
// } elseif ($qpTypeVal == 2) {
$condition = '';
$condition = ' deleted = 0';
if ($qpClassVal != '') {
  $condition .= " AND classId = '".$qpClassVal."'";
}
if ($qpSubVal != '') {
  $condition .= " AND subId = '".$qpSubVal."'";
}
if ($qpChapsVal != '') {
  $condition .= " AND chapId = '".$qpChapsVal."'";
}
if ($qpTopicVal != '') {
  $condition .= " AND topicId = '".$qpTopicVal."'";
}
if ($qpSubTopVal != '') {
  $condition .= " AND subTopicId = '".$qpSubTopVal."'";
}
if ($questionType != '') {
  $condition .= " AND qustType = '".$questionType."'";
}
if ($questionPaperType != '') {
  $condition .= " AND FIND_IN_SET($questionPaperType,assesType)";
}
if ($questionDifficulty != '') {
  $condition .= " AND difficultyId = '".$questionDifficulty."'";

}
$qustDets = GetQueryRecords("SELECT * FROM qp_questiondetails WHERE $condition");
  foreach ($qustDets as $qustDet) {
    $qust = GetRecord("qp_questions", array("qustDetailsId"=>$qustDet['id']));
    $htmData .='
    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-body">
          '.$qust['question'].'
        </div>
        <div class="card-footer d-flex align-items-center justify-content-center">
          <div class="menuItem parent d-flex align-items-center justify-content-between form-check form-switch p-0">
            <input class="form-check-input" name="questionDetailsId[]" value="'.$qustDet['qustType'].'-'.$qustDet['id'].'" type="checkbox">
          </div>
          <i class="bi bi-eye-fill viewQuestionBtn" data-id="'.$qustDet['id'].'" data-qustType="'.$qustDet['qustType'].'" style="margin-left: 2rem; cursor:pointer"></i>
        </div>
      </div>
    </div>';
  // }
}

echo $htmData;
?>