<?php 
include_once "../../../session_token/checksessionajax.php";
include "../../../configration/config.php";
include "../../../functions/db_functions.php";

$output= array();

$allQusts = GetRecords("questiondetails", array('deleted'=>0));
$total_all_rows = count($allQusts);

$position_filter = '';
if(isset($_POST['search']['value']))
{
  $search_value = $_POST['search']['value'];
  if($search_value != ''){
    $position_filter = "and master_questiontypes.name LIKE '%".$search_value."%' OR questions.question like '%".$search_value."%'";
  }
}

$sql = "SELECT  `questiondetails`.*,`questions`.`id`AS qid ,`master_questiontypes`.`name` AS questiontype,`questions`.`question` AS question FROM `questiondetails` INNER JOIN `questions` ON `questiondetails`.`id` = `questions`.`qustDetailsId` LEFT JOIN `master_questiontypes` ON `questiondetails`.`qustType` = `master_questiontypes`.`id`  WHERE `questiondetails`.`deleted` = 0 ".$position_filter."";
if($_POST['length'] != -1)
{
  $start = $_POST['start'];
  $length = $_POST['length'];
  $sql .= " LIMIT  ".$start.", ".$length;
}

$stmt = $db->query($sql);
$count_rows = $stmt->rowCount();
$data = array();

if($position_filter != ''){
  $total_all_rows = $count_rows;
}
$data = array();
$selectDropDown = '';
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  /*echo "<pre/>";
  print_r($row);die;*/
	$sub_array = array();
	$qusts = GetRecord("questions", array("qustDetailsId"=>$row['id']));

	$selectDropDown .= '
	<div class="form-floating" style="margin-bottom: 2rem">
      <select class="form-select mapClassSelect" id="classess" name="classId" aria-label="Floating label select category">
        <option selected>Select Class</option>';
         
          $classes = GetRecords("setup_classes", array("deleted"=>0));
          foreach ($classes as $list) {
            $selected = "";
            if($row['classId'] == $list['id']) {
              $selected = "selected='selected'";
            }
        $selectDropDown .='
        <option value="'.$list['id'].'" '.$selected.'>'.$list['name'].'</option>
        ';
        }
    	$selectDropDown .='
      </select>
      <label for="classess">Class</label>
    </div>
	';

	$selectDropDown .='
  <input type="hidden" class="mapQuestDetId" value="'.$row['id'].'" />
	<div class="form-floating">
      <select class="form-select mapSubject" id="mapSubject" name="classSubjectId" aria-label="Floating label select subject">
        <option selected>Select Subject</option>';

          $subjects = GetQueryRecords("SELECT smsc.subId, ss.name FROM setup_map_subject_classes smsc, setup_subjects ss WHERE classId='".$row['classId']."' AND smsc.subId=ss.id");
    	
          foreach ($subjects as $subject) {
            $selected = "";
              if($subject['subId'] == $row['subId']) {
                $selected = "selected='selected'";
              }
            $selectDropDown .='
              <option value="'.$subject['subId'].'" '.$selected.'>'.$subject['name'].'</option>
            ';
          }
      $selectDropDown .='
      </select>
      <label for="mapSubject">Subject</label>
    </div>
	';
	
	$sub_array[] = $row['question'];
	$sub_array[] = $selectDropDown;
	$data[] = $sub_array;
  $selectDropDown = '';
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
