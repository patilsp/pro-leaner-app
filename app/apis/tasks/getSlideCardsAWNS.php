<?php
	//include_once "../session_token/checksession.php";
  include "../../configration/config.php";
  include "../../functions/common_functions.php";
  include "../../functions/db_functions.php";
  
  $logged_user_id=getSanitizedData('logged_user_id');
  $no_slides = getSanitizedData($_POST['no_slides']);
  $getSlideCardsAWNS = getSlideCardsAWNS($logged_user_id, $no_slides);
  echo $getSlideCardsAWNS;
?>