<?php 
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";
  try {
    /*echo "<pre/>";
    print_r($_POST);die;*/
    $output = array();
    $output['status'] = false;
    $output['message'] = "";
    $status = false;
    $message = "";
    $type = $_POST['type'];
    if($type == "reOrderSlide"){
      if(isset($_POST['sequence'])) {
        $sequence_list = explode(",", $_POST['sequence']);
        $count = 0;
        foreach($sequence_list as $key=>$slideid) {
          if($slideid != "") {
            //$slideid = str_replace("slide_card_", "", $list);

            $query = "UPDATE cpadd_slide_list SET sequence = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute(array($key + 1, $slideid));
          }
        }
        $status = true;
        $message = "Slide sequence updated";
      } else {
        $message = "Invalid Reference sent";
      }
    }

    $output['status'] = $status;
    $output['message'] = $message;
    echo json_encode($output);
  } catch(Exception $exp) {
  	print_r($exp);
  }