<?php
require_once "../../session_token/checksession.php";
require_once "../../configration/config.php";
//require_once $dir_root."app/session_token/checktoken.php";
require_once $dir_root."app/functions/db_functions.php";

$file_path = $_POST['file_path'];
$actual_path = str_replace($web_root."app/", "", $file_path);
$info = pathinfo($actual_path);
$dir_path = $info['dirname'];

$data = file_get_contents($file_path);
if (strpos($data, 'href="css/') !== false) {
  if(strpos($web_root,$data) === false)
  {
    //Replace Global CSS & JS Path
    $data = str_replace('../../../../', $web_root.'app/contents/', $data);

    //Internal CSS
    $data = str_replace('href="css/', 'href="'.$web_root.'app/'.$dir_path.'/css/', $data);

    //Internal JS
    //$data = str_replace('src="js/', 'src="'.$web_root.'app/'.$dir_path.'/js/', $data);

    $origScriptSrc = array();
    // read all image tags into an array
    preg_match_all('/<script[^>]+>/i',$data, $srcTags); 

    for ($i = 0; $i < count($srcTags[0]); $i++) {
      // get the source string
      preg_match('/src="([^"]+)/i',$srcTags[0][$i], $script);
      if(isset($script[0]))
        // remove opening 'src=' tag, can`t get the regex right
        $origScriptSrc[] = str_ireplace( 'src="', '',  $script[0]);  
    }
    $origScriptSrc = array_unique($origScriptSrc);
    foreach ($origScriptSrc as $key => $value) {
      $sub_value = strpos($value, "http");
      if($sub_value === false){
        $data = str_replace($value, $web_root.'app/'.$dir_path.'/'.$value, $data);
      }
    }

    $origImageSrc = array();
    // read all image tags into an array
    preg_match_all('/<img[^>]+>/i',$data, $imgTags); 

    for ($i = 0; $i < count($imgTags[0]); $i++) {
      // get the source string
      preg_match('/src="([^"]+)/i',$imgTags[0][$i], $imgage);
      if(count($imgage) > 0){
        // remove opening 'src=' tag, can`t get the regex right
        $origImageSrc[] = str_ireplace( 'src="', '',  $imgage[0]);
      }
      preg_match('/src=\'([^\']+)/i',$imgTags[0][$i], $imgage);
      if(count($imgage) > 0){
        // remove opening 'src=' tag, can`t get the regex right
        $origImageSrc[] = str_ireplace( 'src=\'', '',  $imgage[0]);
      }  
    }
    // will output all your img src's within the html string
    //print_r($origImageSrc);
    $origImageSrc = array_unique($origImageSrc);
    foreach ($origImageSrc as $key => $value) {
      $data = str_replace($value, $web_root.'app/'.$dir_path.'/'.$value, $data);
    }
  }
}
echo $data;
?>