<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
include "../../functions/common_functions.php";
include "../../functions/db_functions.php";
//include_once "../session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
try{
  $slide_path = $_GET['htmlPath'];
  $source_path = str_replace($web_root, $dir_root, $slide_path);
  $data = file_get_contents($source_path);
  $origCSSSrc = array();
  // read all image tags into an array
  preg_match_all('/<link[^>]+>/i',$data, $srcTags);
  if(isset($srcTags[0]))
  {
	  for ($i = 0; $i < count($srcTags[0]); $i++) {
		// get the source string
		preg_match('/href="([^"]+)/i',$srcTags[0][$i], $script);
		// remove opening 'src=' tag, can`t get the regex right
		$link = str_ireplace( 'href="', '',  $script[0]);
		if(strpos($link, "bootstrap.css") === false)
		  $origCSSSrc[] = $link;
	  }
  }

  //Get Scripts
  $origJSSrc = array();
  preg_match_all('/<script[^>]+>/i',$data, $srcTags);
  if(isset($srcTags[0]))
  {
	  for ($i = 0; $i < count($srcTags[0]); $i++) {
		// get the source string
		preg_match('/src="([^"]+)/i',$srcTags[0][$i], $script);
		// remove opening 'src=' tag, can`t get the regex right
		$link = str_ireplace( 'src="', '',  $script[0]);
		if(strpos($link, "bootstrap") === false && strpos($link, "jquery") === false)
		  $origJSSrc[] = $link;
	  }
  }
} catch(Exception $exp){
  echo "<pre/>";
  print_r($exp);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- vendor css -->
    <link href="../../../lib/bootstrap/glyphicons.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../../lib/fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    
  </head>
  <style type="text/css">
    .br-mainpanel {
      margin-left: 0px;
    }
    .br-pagebody {
      margin-top: 0px;
    }
    .br-section-wrapper {
      padding: 14px;
    }
  </style>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo bg-br-primary"><a href="<?php echo $web_root; ?>app/home.php"><span>[</span><i class="menu-item-icon ion-ios-undo-outline tx-16">Return to Home</i><span>]</span></a></div>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="row">
          <div class="col-md-12">
            <div id="accordion" class="accordion accordion-head-colored accordion-info mg-t-20" role="tablist" aria-multiselectable="true">
              <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                  <h6 class="mg-b-0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#HtmlView" aria-expanded="true" aria-controls="HtmlView" class="tx-gray-800 transition">
                    HTML View
                    </a>
                    <a href="<?php echo $slide_path; ?>" class="tx-gray-800 transition" target="_blank">
					Slide Path - <?php echo $slide_path; ?>
                    </a>
                  </h6>
                </div><!-- card-header -->

                <div id="HtmlView" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                  <div class="card-block pd-20">
                    <object width="100%" height="670px" data="<?php echo $slide_path; ?>"></object>
                  </div>
                </div>
              </div>

              <!-- css Editor -->
              <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                  <h6 class="mg-b-0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#CSSEditor" aria-expanded="true" aria-controls="CSSEditor" class="tx-gray-800 transition">
                    CSS Editor
                    </a>
                  </h6>
                </div><!-- card-header -->

                <div id="CSSEditor" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="card-block pd-20">
                    <form id="cssEditorForm" name="cssEditorForm">
                      <?php
                        foreach($origCSSSrc as $path)
                        {
                          $temp = explode("/", $slide_path);
                          unset($temp[count($temp)-1]);
                          $temp1 = implode("/",$temp);
                          $csspath = $temp1."/".$path;
                          $full_csspath = str_replace($web_root, $dir_root, $csspath);
                          $temp2 = explode("/",$path);
                          $only_filename = end($temp2);
                      ?>
                      <input type="hidden" name="path[]" value="<?php echo $full_csspath; ?>" />
                      <textarea class="form-control" name="FileContent[]" rows="25"><?php echo file_get_contents($full_csspath); ?></textarea>
                      <?php
                        }
                      ?>
                      <center>
                        <button type="submit" class="btn btn-md btn-success">Update</button>
                      </center>
                    </form>
                  </div>
                </div>
              </div>

              <!-- HTML Editor -->
              <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                  <h6 class="mg-b-0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#HTMLEditor" aria-expanded="true" aria-controls="HTMLEditor" class="tx-gray-800 transition">
                    HTML Editor
                    </a>
                  </h6>
                </div><!-- card-header -->

                <div id="HTMLEditor" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="card-block pd-20">
                    <form id="htmlEditorForm" name="htmlEditorForm">
                      <input type="hidden" name="path[]" value="<?php echo str_replace($web_root, $dir_root, $slide_path); ?>" />
                      <textarea class="form-control" name="FileContent[]" rows="25"><?php echo $data; ?></textarea>
                      <center>
                        <button type="submit" class="btn btn-md btn-success">Update</button>
                      </center>
                    </form>
                  </div>
                </div>
              </div>

              <!-- JS Editor -->
              <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                  <h6 class="mg-b-0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#JSEditor" aria-expanded="true" aria-controls="JSEditor" class="tx-gray-800 transition">
                    JS Editor
                    </a>
                  </h6>
                </div><!-- card-header -->

                <div id="JSEditor" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="card-block pd-20">
                    <form id="jsEditorForm" name="jsEditorForm">
                      <?php
                        foreach($origJSSrc as $path)
                        {
                          $temp = explode("/", $slide_path);
                          unset($temp[count($temp)-1]);
                          $temp1 = implode("/",$temp);
                          $jspath = $temp1."/".$path;
                          $full_jspath = str_replace($web_root, $dir_root, $jspath);
                          $temp2 = explode("/",$path);
                          $only_filename = end($temp2);
                      ?>
                      <input type="hidden" name="path[]" value="<?php echo $full_jspath; ?>" />
                      <textarea class="form-control" name="FileContent[]" rows="25"><?php echo file_get_contents($full_jspath); ?></textarea><br /><br />
                      <?php
                        }
                      ?>
                      <center>
                        <button type="submit" class="btn btn-md btn-success">Update</button>
                      </center>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- accordion -->
          </div>
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>
    <script src="../../../js/cms.js"></script>
    <script src="js/cssUpdate.js"></script>
  </body>
</html>