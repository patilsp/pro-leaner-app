<?php 
  include_once "../../session_token/checksession.php";
  include_once "../../configration/config.php";
  //include_once "session_token/checktoken.php";
  require_once "../../functions/db_functions.php";
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
    <link href="../../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../../lib//fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    <style type="text/css">
      .br-pagebody {
        margin-top: 0px;
      }
      /*.card-body{
        height: 65vh;
        overflow-y: auto;
      }*/
	  input[type="checkbox"]:checked + span {
	  	background-color:#18a4b2;
		color:#ffffff;
		padding:2px;
	  }
	  #toast {
        visibility: hidden;
        max-width: 50px;
        height: 50px;
        /*margin-left: -125px;*/
        margin: auto;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;

        position: fixed;
        z-index: 1;
        left: 0;right:0;
        bottom: 30px;
        font-size: 17px;
        white-space: nowrap;
    }
    #toast #img{
      width: 50px;
      height: 50px;
        
        float: left;
        
        padding-top: 16px;
        padding-bottom: 16px;
        
        box-sizing: border-box;

        
        background-color: #111;
        color: #fff;
    }
    #toast #desc{

        
        color: #fff;
       
        padding: 16px;
        
        overflow: hidden;
      white-space: nowrap;
    }

    #toast.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 2s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 4s, fadeout 0.5s 4.5s;
    }
    #editor img{
      width: 300px;
    }
    </style>
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header tx-medium bd-0 tx-white bg-dark">
            POPUP'S
          </div><!-- card-header -->
          <form class="user_form form-horizontal" action="create_user.php" name="user_form" method="POST">
            <div class="card-body bd bd-t-0 rounded-bottom">
              <div class="row" id="editor">
                <textarea name="area1" style="width: 100%"></textarea>
              </div>
            </div><!-- card-body -->
           
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="<?php echo $web_root ?>app/home.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="button" class="btn btn-md btn-info pull-right" id="submit" name="submit">Submit</button>
            </div><!-- card-footer -->
          </form>   
        </div>
        <div id="toast"><div id="img">Status</div><div id="desc"></div></div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- ########## END: MAIN PANEL ########## -->

    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/bootstrap/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/fileinputs/js/fileinput.js" type="text/javascript"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>
    <script type="text/javascript" src="../../../lib/nicEdit.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>
      function launch_toast() {
  		  var x = document.getElementById("toast")
  		  x.className = "show";
  		  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
      }

      bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    </script>
  </body>
</html>
