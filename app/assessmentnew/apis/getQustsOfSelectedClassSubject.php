<?php 
session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  // include "../functions/common_function.php";

/*echo "<pre/>";
print_r($_POST);die;*/

$qpTypeVal = $_POST['qpTypeVal'];
$qpCatVal = $_POST['qpCatVal'];
$qpClassVal = $_POST['qpClassVal'];
$qpSubVal = $_POST['qpSubVal'];

$htmData = '';
if($qpTypeVal == 1) {
  $qustDets = GetRecords("qp_questiondetails", array("deleted"=>0, "catId"=>$qpCatVal, "subId"=>$qpSubVal));
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
  }
} elseif ($qpTypeVal == 2) {
  $qustDets = GetRecords("qp_questiondetails", array("deleted"=>0, "classId"=>$qpClassVal, "subId"=>$qpSubVal));
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
  }
}

echo $htmData;
?>