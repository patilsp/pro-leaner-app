<?php
/*echo "<pre/>";
echo $url = $protocol."://".$_SERVER['SERVER_NAME'] ."/assessment/app/assets/plugins/ckeditor/assets/uploads/";
print_r($_GET);die;*/
// Parameters
$type = $_GET['type'];
$CKEditor = $_GET['CKEditor'];
$funcNum = $_GET['CKEditorFuncNum'];
$strtotime = strtotime("now");

// Image upload
if($type == 'image'){

    $allowed_extension = array(
      "png","jpg","jpeg"
    );

    // Get image file extension
    $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);

    if(in_array(strtolower($file_extension),$allowed_extension)){
       
       if(move_uploaded_file($_FILES['upload']['tmp_name'], "assets/uploads/".$strtotime.'_'.$_FILES['upload']['name'])){
          // File path
          if(isset($_SERVER['HTTPS'])){
             $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
          }
          else{
             $protocol = 'http';
          }
          $url = $protocol."://".$_SERVER['SERVER_NAME'] ."/student_assessment/app/assets/plugins/ckeditor/assets/uploads/".$strtotime.'_'.$_FILES['upload']['name'];
       
          echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
       }

    }

    exit;
}

// File upload
if($type == 'file'){

    $allowed_extension = array(
       "doc","pdf","docx","mp3","mp4","csv","xlsx","xls","pptx","ppt","png","jpg","jpeg","gif","svg"
    );

    // Get file extension
    echo $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);

    if(in_array(strtolower($file_extension),$allowed_extension)){

       if(move_uploaded_file($_FILES['upload']['tmp_name'], "assets/uploads/".$strtotime.'_'.$_FILES['upload']['name'])){
          // File path
          if(isset($_SERVER['HTTPS'])){
              $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
          }
          else{
              $protocol = 'http';
          }

          $url = $protocol."://".$_SERVER['SERVER_NAME'] ."/student_assessment/app/assets/plugins/ckeditor/assets/uploads/".$strtotime.'_'.$_FILES['upload']['name'];
         
          echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
       }

    } else {
      echo "Files upload to allow only Excel, Word, PowerPoint, CSV, Audio and Video";
    }

    exit;
}