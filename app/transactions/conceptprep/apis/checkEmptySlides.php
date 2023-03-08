<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include "../functions/common_function.php";
  include $_SESSION['dir_root']."app/functions/common_functions.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";

  try {
  	/*echo "<pre/>";
  	print_r($_POST);die;*/
    $logged_user_id=$_SESSION['cms_userid'];
    $task_assi_id = getSanitizedData($_POST['task_assi_id']);
    $class = getSanitizedData($_POST['class']);
    $subject_id = getSanitizedData($_POST['subject_id']);
    
    $cpadd_slide_list_tb = GetRecords("cpadd_slide_list", array("task_assign_id"=>$task_assi_id, "class"=>$class, "subject_id"=>$subject_id), array("sequence"));
    $slideContentContains = "";
    $slides = array();
    $message = "";
    $status = false;
    if(count($cpadd_slide_list_tb) > 0) {
        //echo "<pre/>";
        //print_r($cpadd_slide_list_tb);
        foreach($cpadd_slide_list_tb as $slide)
        {
            //checking any slides contains empty json data except Activites and DictionaryWords layout and slide_json column contains null values
            $ignoreLayouts_ids = array(0, 5263);
            $slideJSON = json_decode($slide['slide_json']);
            $objectToArray = (array)$slideJSON;
            $layout_id = $slide['layout_id'];
            if(!in_array($layout_id, $ignoreLayouts_ids)) {
                if(!empty($objectToArray)) {
                    foreach ($objectToArray as $key => $value)
                    {
                        if(isset($objectToArray[$key]) && !is_array($objectToArray[$key])){
                            //this means key exists and the value is not a array
                            if(trim($objectToArray[$key]) != '') {
                                //value is null or empty string or whitespace only
                                $slideContentContains = "";
                                break;
                            } else {
                                $slideContentContains = 'slide Empty - ';
                            }
                        } elseif (is_array($objectToArray[$key])) {
                            foreach ($value as $key1 => $value1)
                            {
                                if(trim($value[$key1]) != '') {
                                    //value is null or empty string or whitespace only
                                    $slideContentContains = "";
                                    break;
                                } else {
                                    $slideContentContains = 'slide Empty - ';
                                }
                            }
                        } else {
                            $slideContentContains = 'slide Empty - ';
                        }
                    }
                } else {
                    $slideContentContains = 'slide Empty - ';
                }

                if($slideContentContains != "") {
                    array_push($slides, $slide['slide_title']);
                }
            }
        }

        if(sizeof($slides)) {
            $status = true;
            $message = 'The list of slides are empty. please enter content (or) delete';
        }
    } else {
        $status = true;
        $message = 'No Slides are availlable to Publish.';
    }

    
    $response = array("status"=>$status, "slides"=>$slides, "message"=>$message);
    echo json_encode($response);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>