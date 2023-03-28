<?php
include_once "session_token/checksession.php";
include_once "configration/config.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
?>
<!DOCTYPE html>
<html lang="en">    
    <head>
        <title>Tech E-Learning School</title>
        <meta charset="utf-8"/>       
        <meta name="viewport" content="width=device-width, initial-scale=1"/>      
        <link rel="shortcut icon" href="../links/media/logos/favicon.ico"/>
        <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>  
        <link href="../links/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="../links/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="../links/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="../links/css/style.bundle.css" rel="stylesheet" type="text/css"/>
</head>

<body  id="kt_body"  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-column flex-column-fluid">	
            <!-- Header Start -->
                <?php include("/fixed-blocks/new-header.php"); ?>
            <!-- Header End -->
			<div class="wrapper d-flex flex-column flex-row-fluid  container-xxl " id="kt_wrapper">
                <div class="toolbar d-flex flex-stack flex-wrap py-4 gap-2" id="kt_toolbar">
                <div  class="page-title d-flex flex-column">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-3 m-0">
                        Users
                    </h1>
                </div>
                
                    <div class="d-flex flex-align-items flex-wrap gap-3 gap-xl-0">
                        <!--begin::Users group-->
                        <div class="symbol-group symbol-hover flex-nowrap me-5">
                            
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                                    <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
                            </div>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Cody Fishers">
                                    <img alt="Pic" src="../links/media/avatars/300-1.jpg" />
                            </div>
                                    
                        </div>
                        
                        <div class="d-flex align-items-center flex-shrink-0">
                            <a href="#" class="btn btn-sm btn-flex btn-secondary px-3"  data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                            Invite 
                            </a>   

                            <a href="#" class="btn btn-sm btn-flex btn-primary ms-5">
                                Edit You Profile
                            </a> 
                        </div>                        
                    </div>
                </div>
				<div class="d-flex flex-row flex-column-fluid align-items-stretch">
					
					<!--begin::Content-->
					<div class="content flex-row-fluid" id="kt_content">
   
					</div>
					<!--end::Content-->	
                </div>

            <!--begin::Footer-->
                <?php include("/fixed-blocks/footer.php"); ?>
            <!--end::Footer-->
        </div>
    </div>
</div>
<!--begin::Javascript-->
<script>
    var hostUrl = "../links/";        
</script>

<script src="../links/plugins/global/plugins.bundle.js"></script>
<script src="../links/js/scripts.bundle.js"></script>
<script src="../links/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="../links/js/widgets.bundle.js"></script>
<script src="../links/js/custom/widgets.js"></script>
<script src="../links/js/chat.js"></script>
<script src="../links/js/upgrade-plan.js"></script>
<script src="../links/js/create-app.js"></script>            
<script src="../links/js/users-search.js"></script>
<!--end::Custom Javascript-->


</body>
</html>