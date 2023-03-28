<?php
  session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";

  try {
  

  $logged_user_id=$_SESSION['cms_userid'];  
    $type = getSanitizedData($_POST['type']);
    if($type == 'list') {

      $output= array();


      
    $sql = "SELECT 
    qp_candidate_assess_response.assessId as cassessId, 
    qp_qustpaper.id,
    qp_qustpaper.id as qstid,
    qp_qustpaperclasssubid.catId as qstCatId,
    qp_qustpaperclasssubid.subId as qstSubId,
    qp_master_category.name,
    qp_qustpaper.title,
    qp_qustpaper.totMarks, 
    (SELECT count(*) from qp_candidate_assess_response where qp_candidate_assess_response.assessId = cassessId AND  qp_candidate_assess_response.evaluateBy IS NOT NULL) AS evalutation_completed,
    (SELECT count(*) from qp_qustpaper qp LEFT JOIN qp_qustpaperclasssubid qpccs ON qp.id =qpccs.qustPaperId LEFT JOIN qp_usersclasssubject uccs
      ON qpccs.catId = uccs.categoryid AND qpccs.subId = uccs.subject  where qp.id = qstid  AND qpccs.subId = qstSubId AND qpccs.catId=qstCatId GROUP BY qpccs.qustPaperId) AS total_candidate_assess,
    (SELECT count(*) from qp_candidate_assess_response where qp_candidate_assess_response.assessId = cassessId AND  qp_candidate_assess_response.submittedOn IS NOT NULL) AS total_submited
    FROM qp_qustpaper 
    LEFT JOIN qp_qustpaperclasssubid ON qp_qustpaper.id=qp_qustpaperclasssubid.qustPaperId 
    LEFT JOIN qp_master_category ON qp_master_category.id =qp_qustpaperclasssubid.catId 
    LEFT JOIN qp_usersclasssubject ON qp_usersclasssubject.categoryid =qp_qustpaperclasssubid.catId AND qp_usersclasssubject.subject=qp_qustpaperclasssubid.subId  
    LEFT JOIN users ON users.deleted =0 AND users.roles_id=4
    LEFT JOIN qp_candidate_assess_response ON qp_candidate_assess_response.userId=qp_usersclasssubject.userId AND qp_candidate_assess_response.assessId =qp_qustpaper.id 
    WHERE
    qp_usersclasssubject.userId =users.id AND 
    qp_qustpaper.publishStatus='published' AND
    qp_master_category.name != 'profile'
    AND qp_candidate_assess_response.submittedOn >= '2022-10-01 00:00:00'  
     AND qp_candidate_assess_response.assessId != ''";
      if(isset($_POST['search']['value']))
      {
        $search_value = $_POST['search']['value'];
      //  $sql .= " WHERE users.deleted=0";
        $sql .= "AND ( ";
        $sql .= "qp_master_category.name like '%".$search_value."%'";
        $sql .= " OR qp_qustpaper.title like '%".$search_value."%'";
        $sql .= " OR totMarks like '%".$search_value."%'";
        $sql .= " )";
      }
      //$sql .=" GROUP By qustpaper.id";
      
      if(isset($_POST['order']))
      {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        //$sql .= " ORDER BY ".$column_name." ".$order."";
        $sql .= " ORDER BY qp_qustpaper.title ".$order."";
      }
      else
      {
        $sql .= " GROUP BY qp_qustpaper.id ORDER BY qp_qustpaper.id desc";
      }

      $stmt1 = $db->query($sql);
      
      $total_all_rows = $stmt1->rowCount();
      
      if($_POST['length'] != -1)
      {
        $start = $_POST['start'];
        $length = $_POST['length'];
        $sql .= " LIMIT  ".$start.", ".$length;
      }
      
      $stmt = $db->query($sql);
      
      $count_rows = $stmt->rowCount();

      $data = array();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
          $sub_array = array();
          $sub_array[] = $row['name'];
          $sub_array[] = $row['title'];
          $sub_array[] = $row['totMarks'];
          $sub_array[] = ucfirst($row['evalutation_completed']);
          $sub_array[] = $row['total_submited'];
          $sub_array[] = $row['total_candidate_assess'];
          $sub_array[] = '<button data-title="'.$row['title'].'" data-attr="'.$row['id'].'" class="btn btn-info btn_evaluate" type="button">Evaluate Question</button> ';  
          $sub_array[] = $row['id'];
          
          $data[] = $sub_array;
        
      }
      $output = array(
        'draw'=> intval($_POST['draw']),
        'recordsTotal' =>$count_rows ,
        'recordsFiltered'=>   $total_all_rows,
        'data'=>$data,
      );
      echo  json_encode($output);


      return 0;
    }elseif($type=="evalauate_candidate"){
      $id = $_POST['assessment_id'];

        $sql = "SELECT 
      qp_qustpaper.totMarks,
      users.id, 
      CONCAT(users.first_name,' ',users.last_name)as user_name,
      qp_candidate_assess_response.submittedStatus, qp_candidate_assess_response.marksObtained, qp_candidate_assess_response.resultStatus,
      CASE WHEN qp_candidate_assess_response.evaluateBy IS NOT NULL THEN 'Evaluated' ELSE 'Not yet evaluated' END AS evaluate_status
      FROM qp_qustpaper 
      JOIN qp_qustpaperclasssubid ON qp_qustpaper.id =qp_qustpaperclasssubid.qustPaperId 
       JOIN qp_candidate_assess_response  ON qp_candidate_assess_response.assessId=qp_qustpaper.id 
     JOIN users   ON qp_candidate_assess_response.userid=users.id 
      WHERE 
      users.deleted=0 AND 
 
      qp_qustpaper.publishStatus='published' AND 
      qp_qustpaper.id=".$id;
   
      if(isset($_POST['search']['value']))
      {
        $search_value = $_POST['search']['value'];
      //  $sql .= " WHERE users.deleted=0";
        $sql .= " AND ( ";
        $sql .= "users.first_name like '%".$search_value."%'";
        $sql .= " OR users.last_name like '%".$search_value."%'";
        $sql .= " OR qp_candidate_assess_response.submittedStatus like '%".$search_value."%'";
        $sql .= " )";
      }
      $sql .=" GROUP By users.id";
      
      if(isset($_POST['order']))
      {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        //$sql .= " ORDER BY ".$column_name." ".$order."";
        $sql .= " ORDER BY users.first_name ".$order."";
      }
      else
      {
        $sql .= " ORDER BY users.id desc";
      }

      $stmt1 = $db->query($sql);

      $total_all_rows = $stmt1->rowCount();
      
      if($_POST['length'] != -1)
      {
        $start = $_POST['start'];
        $length = $_POST['length'];
        $sql .= " LIMIT  ".$start.", ".$length;
      }
      
      $stmt = $db->query($sql);
      
      $count_rows = $stmt->rowCount();
       /*echo "<pre/>";
        print_r($row1);die;*/
      $data = array();
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $sub_array = array();
      //  $sub_array[] = $row['first_name'].' '.$row['last_name'];
//        $sub_array[] = $role['name'];
      $sub_array[] = $row['user_name'];
      if($row['submittedStatus']==""){
        $sub_array[] = "Not yet submitted";
      }else{
        $sub_array[] = ucfirst($row['submittedStatus']);
      }

      $sub_array[] =  $row['marksObtained'] ;
      
      if($row['submittedStatus']=="submitted"){
        $sub_array[] = ucfirst($row['evaluate_status']);
      }else{
        $sub_array[] ="";
      }
      //$sub_array[] = $row['evalutation_completed'];
      //$sub_array[] = $row['total_response'];
        if($row['evaluate_status']!="Evaluated" && $row['submittedStatus']=="submitted" ){
        $sub_array[] = '
        <button data-totmarks="'.$row['totMarks'].'" data-name="'.$row['user_name'].'" data-attr="'.$row['id'].'" class="btn btn-info evalauate_user_answer" type="button" data-bs-toggle="modal"  data-bs-target="#evaluate_answer_paper_modal">Evaluate Answer</button>';  
        }else{
          $sub_array[]="";
        }
        $sub_array[] = $row['id'];
        
        $data[] = $sub_array;
      }
      $output = array(
        'draw'=> intval($_POST['draw']),
        'recordsTotal' =>$count_rows ,
        'recordsFiltered'=>   $total_all_rows,
        'data'=>$data,
      );
      echo  json_encode($output);

      return 0;      

    }elseif($type=="getQuestion"){
        $status=[];
        $question_id = $_POST["assessment_id"];
        $query = "SELECT *,GROUP_CONCAT(qp_mcqoptions.id) as mcqoptionId,GROUP_CONCAT(qp_mcqoptions.optionContent) as optionContents,GROUP_CONCAT(qp_mcqoptions.correctAns) as optionAns FROM qustpapersections LEFT JOIN qustpapersectionquestions ON qustpapersectionquestions.qustPaperSectionId=qustpapersections.id LEFT JOIN questions ON questions.id=qustpapersectionquestions.questionsId LEFT JOIN questiondetails ON questiondetails.id = questions.qustDetailsId LEFT JOIN master_questiontypes ON master_questiontypes.id =questiondetails.qustType LEFT JOIN mcqoptions ON qp_mcqoptions.qId= questions.id  where qustpapersections.qustPaperId=? GROUP BY questions.id";
        $stmt1 = $db->prepare($query);
        $stmt1->execute([$question_id]);
        $row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $section=[];
        /*echo "<pre/>";
        print_r($row1);die;*/
        foreach($row1 as $row){
          $section[$row['qustPaperSectionId']][] =$row;
        }
        echo json_encode($section);		

    }elseif($type=="getAnswer"){

      $status=[];
      $user_id = $_POST['user_id'];
      $question_id = $_POST["assessment_id"];
      $query = "SELECT * FROM qp_candidate_assess_response WHERE userId=? AND assessId=?";
      $stmt1 = $db->prepare($query);
      $stmt1->execute([$user_id,$question_id]);
      $row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($row1);		

    }elseif($type=="evaluateAssessment"){
      /*echo "<pre/>";
      print_r($_POST);die;*/
      //$evaluateStatus = $_POST['evaluateStatus'];
      $marksObtained = $_POST['marksObtained'];
      $resultStatus = $_POST['resultStatus'];

      $remarks = $_POST['remarks'];
      $assessId = $_POST['assessId'];
      $userId = $_POST['userId'];
      $QuestionWiseMarksObtained = json_encode($_POST['QuestionWiseMarksObtained']);
      /*$res2 =[];
      if(isset($_POST['descriptive']) && count($_POST['descriptive'])!=0){
        $descriptive = $_POST['descriptive'];
        $decIndex =[];
        foreach($_POST['descriptive'] as $des){
          $decIndex[] =$des['qId'];
        }
        $query1 = "SELECT userResJson FROM candidate_assess_response  WHERE assessId = ? AND userId=?";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute([$assessId, $userId]);
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
        
        foreach(json_decode($row1['userResJson']) as $res){
          
          if(in_array($res->qId,$decIndex)){
            $ind = array_search($res->qId,$decIndex,true);
            $res= array('qId'=>$res->qId,'aText'=>$res->aText,'aMark'=>$_POST['descriptive'][$ind]['mark']);
            $res = json_encode($res);
            
          }
          $res2[] =$res;
        }
        
      }
      $updateScore ="";
      if(count($res2)!=0){
      $updateScore = "userResJson='".json_encode($res2)."' , ";
      }*/
      $query = "UPDATE qp_candidate_assess_response SET QuestionWiseMarksObtained=?, evaluateStatus ='Completed', marksObtained=? , resultStatus=?, remarks=?, evaluateBy=?, evaluateOn=now() WHERE assessId = ? AND userId=?";
      $stmt = $db->prepare($query);
      $stmt->execute(array($QuestionWiseMarksObtained, $marksObtained, $resultStatus,$remarks,$logged_user_id, $assessId, $userId));      
      echo json_encode(array("status"=>true));		
    }

    
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>