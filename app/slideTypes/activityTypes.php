<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
include "../functions/common_functions.php";
include "../functions/db_functions.php";
//include_once "../session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
try{
  $getSlideTypes = getSlideTypes();
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
    <link href="../../lib/bootstrap/glyphicons.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../lib/fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
    
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
              <?php
                foreach ($getSlideTypes as $getSlideType) {
              ?>
                <div class="card">
                  <div class="card-header" role="tab" id="headingOne">
                    <h6 class="mg-b-0">
                      <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $getSlideType['id']; ?>" aria-expanded="true" aria-controls="<?php echo $getSlideType['id']; ?>" class="tx-gray-800 transition">
                      <?php echo $getSlideType['name']; ?>
                      </a>
                    </h6>
                  </div><!-- card-header -->

                  <div id="<?php echo $getSlideType['id']; ?>" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-block pd-20">
                      <object width="100%" height="670px" data="<?php echo $web_root."app/".$getSlideType['path']; ?>"></object>
                    </div>
                  </div>
                </div>
              <?php
                }
              ?>
            </div><!-- accordion -->
          </div>
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../lib/jquery/jquery.js"></script>
    <script src="../../lib/popper.js/popper.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../js/cms.js"></script>
  </body>
</html>