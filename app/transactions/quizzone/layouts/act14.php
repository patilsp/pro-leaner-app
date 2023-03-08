<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include $_SESSION['dir_root']."app/configration/config_schools.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";
  include $_SESSION['dir_root']."app/transactions/conceptprep/functions/common_function.php";
  try{
    /*echo "<pre/>";
    print_r($_REQUEST);die;*/
    //get_destination_graphics_folder_name
    $qust_id = $_REQUEST['current_container_slideid'];
    $qzone_slide_path = $_REQUEST['qzone_slide_path'];
    $action_type = $_REQUEST['action_type'];
    $current_container_slideid = $qust_id;

    $slidedataarray = array();
    if(isset($_REQUEST['current_container_slideid']))
      unset($_REQUEST['current_container_slideid']);
    if(isset($_REQUEST['action_type']))
      unset($_REQUEST['action_type']);
    $slidedataarray = $_REQUEST;


    //echo dirname(__FILE__);
    
    $img1 = str_replace($web_root."app/contents/", "", $_REQUEST['img1']);

    $jsondata = json_encode($slidedataarray);
    /*echo "<pre/>";
    print_r($jsondata);die;*/
    //Update slide json data and slide path in add_slide_list table using below function
    $updateSlideJson = updateSlideJson($qust_id, $jsondata, $qzone_slide_path);
    echo $qzone_slide_path.'?api_end_point=getactivitydata.php&qust_id='.$qust_id;
  } catch(Exception $exp) {
    echo "<pre/>";
    print_r($exp);
  }

?>