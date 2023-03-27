<?php
include_once "session_token/checksession.php";
include_once "configration/config.php";
//include_once "session_token/checktoken.php";
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
        <link rel="shortcut icon" href="<?php echo $web_root ?>assets/assets/media/logos/favicon.ico"/>
        <link href="<?php echo $web_root ?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>  
        <link href="<?php echo $web_root ?>assets/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $web_root ?>assets/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css"/>
    
        <link href="<?php echo $web_root ?>assets/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $web_root ?>assets/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
      
</head>

<body  id="kt_body"  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled" >

	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-column flex-column-fluid">		

            <!-- Header Start -->
                <?php include("/fixed-blocks/new-header.php"); ?>
            <!-- Header End -->

			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid  container-xxl " id="kt_wrapper">
									
<!--begin::Toolbar-->
<div class="toolbar d-flex flex-stack flex-wrap py-4 gap-2" id="kt_toolbar">
    
 

<!--begin::Page title-->
<div  class="page-title d-flex flex-column">
    
    <!--begin::Title-->
    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-3 m-0">
        Online Courses
                    <!--begin::Description-->
            <span class="page-desc text-muted fs-7 fw-semibold">
                            </span>
            <!--end::Description-->
            </h1>
    <!--end::Title-->
</div>
<!--end::Page title-->
    
    <!--begin::Wrapper-->
    <div class="d-flex flex-align-items flex-wrap gap-3 gap-xl-0">
        <!--begin::Users group-->
        <div class="symbol-group symbol-hover flex-nowrap me-5">
            
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                    <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
            </div>
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Cody Fishers">
                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg" />
            </div>
                     
        </div>
        <!--end::Users group-->

        <!--begin::Actions-->
        <div class="d-flex align-items-center flex-shrink-0">
            <a href="#" class="btn btn-sm btn-flex btn-secondary px-3"  data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                Invite 
            </a>   

            <a href="/<?php echo $web_root ?>demo19/account/overview.html" class="btn btn-sm btn-flex btn-primary ms-5">
                Edit You Profile
            </a> 
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Toolbar-->
								
				<!--begin::Main-->
				<div class="d-flex flex-row flex-column-fluid align-items-stretch">
					
					<!--begin::Content-->
					<div class="content flex-row-fluid" id="kt_content">
						<!--begin::Row-->
<div class="row g-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-4 mb-xl-10">       
        
<!--begin::Lists Widget 19-->
<div class="card card-flush h-xl-100" >   
    <!--begin::Heading-->
    <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" 
    style="background-image:url('<?php echo $web_root ?>assets/assets/media/top-green.png" data-bs-theme="light">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column text-white pt-15">
            <span class="fw-bold fs-2x mb-3">My Tasks</span>
            
            <div class="fs-4 text-white">
                <span class="opacity-75">You have</span>

                <span class="position-relative d-inline-block">
                    <a href="/<?php echo $web_root ?>demo19/pages/user-profile/projects.html" class="link-white opacity-75-hover fw-bold d-block mb-1">4 tasks</a>

                    <!--begin::Separator-->
                    <span class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
                    <!--end::Separator--> 
                </span>    

                <span class="opacity-75">to comlete</span>
            </div>    
        </h3>
        <!--end::Title-->

        <!--begin::Toolbar-->
        <div class="card-toolbar pt-5">            
            <!--begin::Menu-->
            <button class="btn btn-sm btn-icon btn-active-color-primary btn-color-white bg-white bg-opacity-25 bg-hover-opacity-100 bg-hover-white bg-active-opacity-25 w-20px h-20px" 
                data-kt-menu-trigger="click" 
                data-kt-menu-placement="bottom-end" 
                data-kt-menu-overflow="true">   
                    
                <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="10" y="10" width="4" height="4" rx="2" fill="currentColor"/>
<rect x="17" y="10" width="4" height="4" rx="2" fill="currentColor"/>
<rect x="3" y="10" width="4" height="4" rx="2" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                             
            </button>

            
<!--begin::Menu 2-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator mb-3 opacity-75"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3">
            New Ticket
        </a>
    </div>
    <!--end::Menu item-->
    
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3">
            New Customer
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
        <!--begin::Menu item-->
        <a href="#" class="menu-link px-3">
            <span class="menu-title">New Group</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu item-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-dropdown w-175px py-4">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">
                    Admin Group
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">
                    Staff Group
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->            
            <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">
                    Member Group
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3">
            New Contact
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator mt-3 opacity-75"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content px-3 py-3">
            <a class="btn btn-primary  btn-sm px-4" href="#">
                Generate Reports
            </a>
        </div>
    </div>
    <!--end::Menu item-->
</div>
<!--end::Menu 2-->
 
            <!--end::Menu-->               
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Heading-->              

    <!--begin::Body-->
    <div class="card-body mt-n20">
        <!--begin::Stats-->
        <div class="mt-n20 position-relative">
            <!--begin::Row-->
            <div class="row g-3 g-lg-6">
                                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5 mb-8">
                                <span class="symbol-label">  
                                    <!--begin::Svg Icon | path: icons/duotune/medicine/med005.svg-->
<span class="svg-icon svg-icon-1 svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M17.9061 13H11.2061C11.2061 12.4 10.8061 12 10.2061 12C9.60605 12 9.20605 12.4 9.20605 13H6.50606L9.20605 8.40002V4C8.60605 4 8.20605 3.6 8.20605 3C8.20605 2.4 8.60605 2 9.20605 2H15.2061C15.8061 2 16.2061 2.4 16.2061 3C16.2061 3.6 15.8061 4 15.2061 4V8.40002L17.9061 13ZM13.2061 9C12.6061 9 12.2061 9.4 12.2061 10C12.2061 10.6 12.6061 11 13.2061 11C13.8061 11 14.2061 10.6 14.2061 10C14.2061 9.4 13.8061 9 13.2061 9Z" fill="currentColor"/>
<path d="M18.9061 22H5.40605C3.60605 22 2.40606 20 3.30606 18.4L6.40605 13H9.10605C9.10605 13.6 9.50605 14 10.106 14C10.706 14 11.106 13.6 11.106 13H17.8061L20.9061 18.4C21.9061 20 20.8061 22 18.9061 22ZM14.2061 15C13.1061 15 12.2061 15.9 12.2061 17C12.2061 18.1 13.1061 19 14.2061 19C15.3061 19 16.2061 18.1 16.2061 17C16.2061 15.9 15.3061 15 14.2061 15Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                             
                                </span>                
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Stats-->
                            <div class="m-0">
                                <!--begin::Number-->
                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">37</span>
                                <!--end::Number-->

                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-6">Courses</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Stats-->
                        </div>    
                        <!--end::Items-->
                    </div>    
                    <!--end::Col-->
                                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5 mb-8">
                                <span class="symbol-label">  
                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
<span class="svg-icon svg-icon-1 svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z" fill="currentColor"/>
<path opacity="0.3" d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                             
                                </span>                
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Stats-->
                            <div class="m-0">
                                <!--begin::Number-->
                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">6</span>
                                <!--end::Number-->

                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-6">Certificates</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Stats-->
                        </div>    
                        <!--end::Items-->
                    </div>    
                    <!--end::Col-->
                                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5 mb-8">
                                <span class="symbol-label">  
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen020.svg-->
<span class="svg-icon svg-icon-1 svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14 18V16H10V18L9 20H15L14 18Z" fill="currentColor"/>
<path opacity="0.3" d="M20 4H17V3C17 2.4 16.6 2 16 2H8C7.4 2 7 2.4 7 3V4H4C3.4 4 3 4.4 3 5V9C3 11.2 4.8 13 7 13C8.2 14.2 8.8 14.8 10 16H14C15.2 14.8 15.8 14.2 17 13C19.2 13 21 11.2 21 9V5C21 4.4 20.6 4 20 4ZM5 9V6H7V11C5.9 11 5 10.1 5 9ZM19 9C19 10.1 18.1 11 17 11V6H19V9ZM17 21V22H7V21C7 20.4 7.4 20 8 20H16C16.6 20 17 20.4 17 21ZM10 9C9.4 9 9 8.6 9 8V5C9 4.4 9.4 4 10 4C10.6 4 11 4.4 11 5V8C11 8.6 10.6 9 10 9ZM10 13C9.4 13 9 12.6 9 12V11C9 10.4 9.4 10 10 10C10.6 10 11 10.4 11 11V12C11 12.6 10.6 13 10 13Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                             
                                </span>                
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Stats-->
                            <div class="m-0">
                                <!--begin::Number-->
                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">4,7</span>
                                <!--end::Number-->

                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-6">Avg. Score</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Stats-->
                        </div>    
                        <!--end::Items-->
                    </div>    
                    <!--end::Col-->
                                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5 mb-8">
                                <span class="symbol-label">  
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
<span class="svg-icon svg-icon-1 svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="currentColor"/>
<path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                             
                                </span>                
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Stats-->
                            <div class="m-0">
                                <!--begin::Number-->
                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">822</span>
                                <!--end::Number-->

                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-6">Hours Learned</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Stats-->
                        </div>    
                        <!--end::Items-->
                    </div>    
                    <!--end::Col-->
                         
            </div>
            <!--end::Row-->
        </div> 
        <!--end::Stats-->
    </div>    
    <!--end::Body-->        
</div>
<!--end::Lists Widget 19-->
    </div>
    <!--end::Col-->     

    <!--begin::Col-->
    <div class="col-xl-8 mb-5 mb-xl-10">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-6 mb-xl-10">       
                  

<!--begin::Slider Widget 1-->
<div id="kt_sliders_widget_1_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5000">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <h4 class="card-title d-flex align-items-start flex-column">            
            <span class="card-label fw-bold text-gray-800">Today’s Course</span>
            <span class="text-gray-400 mt-1 fw-bold fs-7">4 lessons, 3 hours 45 minutes</span>
        </h4>
        <!--end::Title-->

        <!--begin::Toolbar-->
        <div class="card-toolbar">            
            <!--begin::Carousel Indicators-->
            <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                                    <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="0" class="active ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="1" class=" ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="2" class=" ms-1"></li>
                 
            </ol>
            <!--end::Carousel Indicators-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header--> 

    <!--begin::Body-->
    <div class="card-body py-6">  
        <!--begin::Carousel-->
        <div class="carousel-inner mt-n5">
                                            <!--begin::Item-->
                <div class="carousel-item active show">     
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center mb-5">                                 
                        <!--begin::Chart-->
                        <div class="w-80px flex-shrink-0 me-2">
                            <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_1"></div>
                        </div>
                        <!--end::Chart-->                                  

                        <!--begin::Info-->
                        <div class="m-0">
                            <!--begin::Subtitle-->
                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                            <!--end::Subtitle-->

                            <!--begin::Items-->
                            <div class="d-flex d-grid gap-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 3 Topics
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 1 Speakers
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item--> 
                                
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 50 Min
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 72 students
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->  
                            </div>
                            <!--end::Items-->   
                        </div>
                        <!--end::Info-->                                  
                    </div>
                    <!--end::Wrapper-->  
                    
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Skip This</a>

                        <a href="#" class="btn btn-sm btn-primary mb-2"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
                    </div>
                    <!--end::Action-->  
                </div>
                <!--end::Item-->  
                                            <!--begin::Item-->
                <div class="carousel-item ">     
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center mb-5">                                 
                        <!--begin::Chart-->
                        <div class="w-80px flex-shrink-0 me-2">
                            <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_2"></div>
                        </div>
                        <!--end::Chart-->                                  

                        <!--begin::Info-->
                        <div class="m-0">
                            <!--begin::Subtitle-->
                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                            <!--end::Subtitle-->

                            <!--begin::Items-->
                            <div class="d-flex d-grid gap-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 3 Topics
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 1 Speakers
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item--> 
                                
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 50 Min
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 72 students
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->  
                            </div>
                            <!--end::Items-->   
                        </div>
                        <!--end::Info-->                                  
                    </div>
                    <!--end::Wrapper-->  
                    
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Skip This</a>

                        <a href="#" class="btn btn-sm btn-primary mb-2"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
                    </div>
                    <!--end::Action-->  
                </div>
                <!--end::Item-->  
                                            <!--begin::Item-->
                <div class="carousel-item ">     
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center mb-5">                                 
                        <!--begin::Chart-->
                        <div class="w-80px flex-shrink-0 me-2">
                            <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_3" ></div>
                        </div>
                        <!--end::Chart-->                                  

                        <!--begin::Info-->
                        <div class="m-0">
                            <!--begin::Subtitle-->
                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                            <!--end::Subtitle-->

                            <!--begin::Items-->
                            <div class="d-flex d-grid gap-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 3 Topics
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 1 Speakers
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item--> 
                                
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 50 Min
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 72 students
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->  
                            </div>
                            <!--end::Items-->   
                        </div>
                        <!--end::Info-->                                  
                    </div>
                    <!--end::Wrapper-->  
                    
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Skip This</a>

                        <a href="#" class="btn btn-sm btn-primary mb-2"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
                    </div>
                    <!--end::Action-->  
                </div>
                <!--end::Item-->  
                          
        </div>
        <!--end::Carousel-->		     
    </div>
    <!--end::Body-->     
</div>
<!--end::Slider Widget 1-->

 
             </div>
            <!--end::Col--> 
            
            <!--begin::Col-->
            <div class="col-xl-6 mb-5 mb-xl-10">       
                  

<!--begin::Slider Widget 2-->
<div id="kt_sliders_widget_2_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5500">
    <!--begin::Header--> 
    <div class="card-header pt-5">
        <!--begin::Title-->
        <h4 class="card-title d-flex align-items-start flex-column">            
            <span class="card-label fw-bold text-gray-800">Today’s Events</span>
            <span class="text-gray-400 mt-1 fw-bold fs-7">24 events on all activities</span>
        </h4>
        <!--end::Title-->

        <!--begin::Toolbar-->
        <div class="card-toolbar">            
            <!--begin::Carousel Indicators-->
            <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-success">
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="0" class="active ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="1" class=" ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="2" class=" ms-1"></li>
                 
            </ol>
            <!--end::Carousel Indicators-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header--> 
    
    <!--begin::Body-->
    <div class="card-body py-6">
        <!--begin::Carousel-->
        <div class="carousel-inner">
                                            <!--begin::Item-->
                <div class="carousel-item active show">     
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center mb-9">                                 
                        <!--begin::Symbol-->
                        <div class="symbol symbol-70px symbol-circle me-5">
                            <span class="symbol-label bg-light-success">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
<span class="svg-icon svg-icon-3x svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.925 3.90078V8.00077L12.025 10.8008V5.10078L15.525 3.10078C16.125 2.80078 16.925 3.20078 16.925 3.90078ZM2.525 13.5008L6.025 15.5008L10.925 12.7008L6.025 9.90078L2.525 11.9008C1.825 12.3008 1.825 13.2008 2.525 13.5008ZM18.025 19.7008V15.6008L13.125 12.8008V18.5008L16.625 20.5008C17.225 20.8008 18.025 20.4008 18.025 19.7008Z" fill="currentColor"/>
<path opacity="0.3" d="M8.52499 3.10078L12.025 5.10078V10.8008L7.125 8.00077V3.90078C7.125 3.20078 7.92499 2.80078 8.52499 3.10078ZM7.42499 20.5008L10.925 18.5008V12.8008L6.02499 15.6008V19.7008C6.02499 20.4008 6.82499 20.8008 7.42499 20.5008ZM21.525 11.9008L18.025 9.90078L13.125 12.7008L18.025 15.5008L21.525 13.5008C22.225 13.2008 22.225 12.3008 21.525 11.9008Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                               
                            </span>                
                        </div>
                        <!--end::Symbol-->                                    

                        <!--begin::Info-->
                        <div class="m-0">
                            <!--begin::Subtitle-->
                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                            <!--end::Subtitle-->

                            <!--begin::Items-->
                            <div class="d-flex d-grid gap-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 5 Topics
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 1 Speakers
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item--> 
                                
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 60 Min
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 137 students
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->  
                            </div>
                            <!--end::Items-->   
                        </div>
                        <!--end::Info-->                                
                    </div>
                    <!--end::Wrapper-->  
                    
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>

                        <a href="#" class="btn btn-sm btn-success mb-2"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
                    </div>
                    <!--end::Action-->  
                </div>
                <!--end::Item-->  
                                            <!--begin::Item-->
                <div class="carousel-item ">     
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center mb-9">                                 
                        <!--begin::Symbol-->
                        <div class="symbol symbol-70px symbol-circle me-5">
                            <span class="symbol-label bg-light-danger">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs026.svg-->
<span class="svg-icon svg-icon-3x svg-icon-danger"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"/>
<path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                               
                            </span>                
                        </div>
                        <!--end::Symbol-->                                    

                        <!--begin::Info-->
                        <div class="m-0">
                            <!--begin::Subtitle-->
                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                            <!--end::Subtitle-->

                            <!--begin::Items-->
                            <div class="d-flex d-grid gap-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 12 Topics
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 1 Speakers
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item--> 
                                
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 50 Min
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 72 students
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->  
                            </div>
                            <!--end::Items-->   
                        </div>
                        <!--end::Info-->                                
                    </div>
                    <!--end::Wrapper-->  
                    
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>

                        <a href="#" class="btn btn-sm btn-success mb-2"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
                    </div>
                    <!--end::Action-->  
                </div>
                <!--end::Item-->  
                                            <!--begin::Item-->
                <div class="carousel-item ">     
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center mb-9">                                 
                        <!--begin::Symbol-->
                        <div class="symbol symbol-70px symbol-circle me-5">
                            <span class="symbol-label bg-light-primary">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs038.svg-->
<span class="svg-icon svg-icon-3x svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.0444 17.9444V12.1444L17.0444 15.0444C18.6444 15.9444 19.1445 18.0444 18.2445 19.6444C17.3445 21.2444 15.2445 21.7444 13.6445 20.8444C12.6445 20.2444 12.0444 19.1444 12.0444 17.9444ZM7.04445 15.0444L12.0444 12.1444L7.04445 9.24445C5.44445 8.34445 3.44444 8.84445 2.44444 10.4444C1.54444 12.0444 2.04445 14.0444 3.64445 15.0444C4.74445 15.6444 6.04445 15.6444 7.04445 15.0444ZM12.0444 6.34444V12.1444L17.0444 9.24445C18.6444 8.34445 19.1445 6.24444 18.2445 4.64444C17.3445 3.04444 15.2445 2.54445 13.6445 3.44445C12.6445 4.04445 12.0444 5.14444 12.0444 6.34444Z" fill="currentColor"/>
<path opacity="0.3" d="M7.04443 9.24445C6.04443 8.64445 5.34442 7.54444 5.34442 6.34444C5.34442 4.54444 6.84444 3.04443 8.64444 3.04443C10.4444 3.04443 11.9444 4.54444 11.9444 6.34444V12.1444L7.04443 9.24445ZM17.0444 15.0444C18.0444 15.6444 19.3444 15.6444 20.3444 15.0444C21.9444 14.1444 22.4444 12.0444 21.5444 10.4444C20.6444 8.84444 18.5444 8.34445 16.9444 9.24445L11.9444 12.1444L17.0444 15.0444ZM7.04443 15.0444C6.04443 15.6444 5.34442 16.7444 5.34442 17.9444C5.34442 19.7444 6.84444 21.2444 8.64444 21.2444C10.4444 21.2444 11.9444 19.7444 11.9444 17.9444V12.1444L7.04443 15.0444Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                               
                            </span>                
                        </div>
                        <!--end::Symbol-->                                    

                        <!--begin::Info-->
                        <div class="m-0">
                            <!--begin::Subtitle-->
                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                            <!--end::Subtitle-->

                            <!--begin::Items-->
                            <div class="d-flex d-grid gap-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 3 Topics
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 1 Speakers
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item--> 
                                
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-shrink-0">
                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 50 Min
                                    </span>
                                    <!--end::Section-->

                                    <!--begin::Section-->
                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
<span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 72 students
                                    </span>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->  
                            </div>
                            <!--end::Items-->   
                        </div>
                        <!--end::Info-->                                
                    </div>
                    <!--end::Wrapper-->  
                    
                    <!--begin::Action-->
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>

                        <a href="#" class="btn btn-sm btn-success mb-2"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
                    </div>
                    <!--end::Action-->  
                </div>
                <!--end::Item-->  
                          
        </div>
        <!--end::Carousel-->            
    </div>
    <!--end::Body-->     
</div>
<!--end::Slider Widget 2-->             </div>
            <!--end::Col-->   
        </div>
        <!--end::Row-->

        <!--begin::Engage widget 4-->
<div class="card border-transparent " data-bs-theme="light" style="background-color: #1C325E;">
    <!--begin::Body-->
    <div class="card-body d-flex ps-xl-15">          
        <!--begin::Wrapper--> 
        <div class="m-0">
            <!--begin::Title-->      
            <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
                <span class="me-2">
                    You have got
                    <span class="position-relative d-inline-block text-danger">
                        <a href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html" class="text-danger opacity-75-hover">2300 bonus</a>  

                        <!--begin::Separator-->
                        <span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                        <!--end::Separator-->                        
                    </span>                     
                </span>                 
                points.<br/>
                Feel free to use them in your lessons                              
            </div>
            <!--end::Title--> 

            <!--begin::Action--> 
            <div class="mb-3">
                <a href='#' class="btn btn-danger fw-semibold me-2"  data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">
                    Get Reward
                </a> 

                <a href="/<?php echo $web_root ?>demo19/apps/support-center/overview.html" class="btn btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold">
                    How to
                </a> 
            </div>
            <!--begin::Action--> 
        </div>
        <!--begin::Wrapper-->                 

        <!--begin::Illustration-->
        <img src="<?php echo $web_root ?>assets/assets/media/illustrations/sigma-1/17-dark.png" class="position-absolute me-3 bottom-0 end-0 h-200px" alt=""/> 
        <!--end::Illustration-->
    </div>
    <!--end::Body-->
</div>
<!--end::Engage widget 4-->

           
    </div>
    <!--end::Col-->    
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row g-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-4 mb-xl-10">       
        
<!--begin::List widget 20-->
<div class="card h-xl-100">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-dark">Recommended for you</span>

			<span class="text-muted mt-1 fw-semibold fs-7">8k social visitors</span>
		</h3>

        <!--begin::Toolbar-->
        <div class="card-toolbar">   
            <a href="#" class="btn btn-sm btn-light">All Courses</a>             
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-6">
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">  
                <!--begin::Symbol-->
                <div class="symbol symbol-40px me-4">
                    <div class="symbol-label fs-2 fw-semibold bg-danger text-inverse-danger">M</div>
                </div>
                <!--end::Symbol-->

                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                    <!--begin:Author-->                    
                    <div class="flex-grow-1 me-2">
                        <a href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">UI/UX Design</a>
                        
                        <span class="text-muted fw-semibold d-block fs-7">40+ Courses</span>
                    </div>
                    <!--end:Author-->                      
                    
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    </a>
                    <!--begin::Actions-->    
                </div>
                <!--end::Section-->
            </div>
            <!--end::Item-->

                            <!--begin::Separator-->
                <div class="separator separator-dashed my-4"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">  
                <!--begin::Symbol-->
                <div class="symbol symbol-40px me-4">
                    <div class="symbol-label fs-2 fw-semibold bg-success text-inverse-success">Q</div>
                </div>
                <!--end::Symbol-->

                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                    <!--begin:Author-->                    
                    <div class="flex-grow-1 me-2">
                        <a href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">QA Analysis</a>
                        
                        <span class="text-muted fw-semibold d-block fs-7">18 Courses</span>
                    </div>
                    <!--end:Author-->                      
                    
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    </a>
                    <!--begin::Actions-->    
                </div>
                <!--end::Section-->
            </div>
            <!--end::Item-->

                            <!--begin::Separator-->
                <div class="separator separator-dashed my-4"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">  
                <!--begin::Symbol-->
                <div class="symbol symbol-40px me-4">
                    <div class="symbol-label fs-2 fw-semibold bg-info text-inverse-info">W</div>
                </div>
                <!--end::Symbol-->

                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                    <!--begin:Author-->                    
                    <div class="flex-grow-1 me-2">
                        <a href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">Web Development</a>
                        
                        <span class="text-muted fw-semibold d-block fs-7">120+ Courses</span>
                    </div>
                    <!--end:Author-->                      
                    
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    </a>
                    <!--begin::Actions-->    
                </div>
                <!--end::Section-->
            </div>
            <!--end::Item-->

                            <!--begin::Separator-->
                <div class="separator separator-dashed my-4"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">  
                <!--begin::Symbol-->
                <div class="symbol symbol-40px me-4">
                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">M</div>
                </div>
                <!--end::Symbol-->

                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                    <!--begin:Author-->                    
                    <div class="flex-grow-1 me-2">
                        <a href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">Marketing</a>
                        
                        <span class="text-muted fw-semibold d-block fs-7">50+ Courses.</span>
                    </div>
                    <!--end:Author-->                      
                    
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    </a>
                    <!--begin::Actions-->    
                </div>
                <!--end::Section-->
            </div>
            <!--end::Item-->

                            <!--begin::Separator-->
                <div class="separator separator-dashed my-4"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">  
                <!--begin::Symbol-->
                <div class="symbol symbol-40px me-4">
                    <div class="symbol-label fs-2 fw-semibold bg-warning text-inverse-warning">P</div>
                </div>
                <!--end::Symbol-->

                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                    <!--begin:Author-->                    
                    <div class="flex-grow-1 me-2">
                        <a href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">Philosophy</a>
                        
                        <span class="text-muted fw-semibold d-block fs-7">24+ Courses</span>
                    </div>
                    <!--end:Author-->                      
                    
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    </a>
                    <!--begin::Actions-->    
                </div>
                <!--end::Section-->
            </div>
            <!--end::Item-->

                            <!--begin::Separator-->
                <div class="separator separator-dashed my-4"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">  
                <!--begin::Symbol-->
                <div class="symbol symbol-40px me-4">
                    <div class="symbol-label fs-2 fw-semibold bg-dark text-inverse-dark">M</div>
                </div>
                <!--end::Symbol-->

                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                    <!--begin:Author-->                    
                    <div class="flex-grow-1 me-2">
                        <a href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">Mathematics</a>
                        
                        <span class="text-muted fw-semibold d-block fs-7">24+ Courses</span>
                    </div>
                    <!--end:Author-->                      
                    
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    </a>
                    <!--begin::Actions-->    
                </div>
                <!--end::Section-->
            </div>
            <!--end::Item-->

             
           
    </div>
    <!--end::Body-->
</div>
<!--end::List widget 20-->
    </div>
    <!--end::Col-->     

    <!--begin::Col-->
    <div class="col-xl-8 mb-5 mb-xl-10">
        <!--begin::Timeline Widget 1-->
        <div class="card h-xl-100">
            <!--begin::Header-->
            <div class="card-header position-relative py-0 border-bottom-2">
                <!--begin::Nav-->             
                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3" role="tablist">
                                                    <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0 me-8" role="presentation">
                            <!--begin::Nav link-->
                            <a class="nav-link btn btn-color-muted px-0 " data-bs-toggle="tab" href="#kt_table_widget_7_tab_content_1" aria-selected="false" tabindex="-1" role="tab">
                                <!--begin::Title-->
                                <span class="nav-text fw-semibold fs-4 mb-3">
                                    Monday                        </span> 
                                <!--end::Title--> 
                                
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                <!--end::Bullet-->                         
                            </a>             
                            <!--end::Nav link-->       
                        </li>
                        <!--end::Nav item-->
                                                    <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0 me-8" role="presentation">
                            <!--begin::Nav link-->
                            <a class="nav-link btn btn-color-muted px-0 " data-bs-toggle="tab" href="#kt_table_widget_7_tab_content_2" aria-selected="false" tabindex="-1" role="tab">
                                <!--begin::Title-->
                                <span class="nav-text fw-semibold fs-4 mb-3">
                                    Tuesday                        </span> 
                                <!--end::Title--> 
                                
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                <!--end::Bullet-->                         
                            </a>             
                            <!--end::Nav link-->       
                        </li>
                        <!--end::Nav item-->
                                                    <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0 me-8" role="presentation">
                            <!--begin::Nav link-->
                            <a class="nav-link btn btn-color-muted px-0 show active" data-bs-toggle="tab" href="#kt_table_widget_7_tab_content_3" aria-selected="true" role="tab">
                                <!--begin::Title-->
                                <span class="nav-text fw-semibold fs-4 mb-3">
                                    Wednesday                        </span> 
                                <!--end::Title--> 
                                
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                <!--end::Bullet-->                         
                            </a>             
                            <!--end::Nav link-->       
                        </li>
                        <!--end::Nav item-->
                                                    <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0 me-8" role="presentation">
                            <!--begin::Nav link-->
                            <a class="nav-link btn btn-color-muted px-0 " data-bs-toggle="tab" href="#kt_table_widget_7_tab_content_4" aria-selected="false" tabindex="-1" role="tab">
                                <!--begin::Title-->
                                <span class="nav-text fw-semibold fs-4 mb-3">
                                    Thursday                        </span> 
                                <!--end::Title--> 
                                
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                <!--end::Bullet-->                         
                            </a>             
                            <!--end::Nav link-->       
                        </li>
                        <!--end::Nav item-->
                                                    <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0 me-8" role="presentation">
                            <!--begin::Nav link-->
                            <a class="nav-link btn btn-color-muted px-0 " data-bs-toggle="tab" href="#kt_table_widget_7_tab_content_5" aria-selected="false" tabindex="-1" role="tab">
                                <!--begin::Title-->
                                <span class="nav-text fw-semibold fs-4 mb-3">
                                    Friday                        </span> 
                                <!--end::Title--> 
                                
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                <!--end::Bullet-->                         
                            </a>             
                            <!--end::Nav link-->       
                        </li>
                        <!--end::Nav item-->
                                       
                </ul>             
                <!--end::Nav-->
        
                <!--begin::Toolbar-->
                <div class="card-toolbar">   
                    <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4" data-kt-initialized="1">           
                        <!--begin::Display range-->
                        <div class="text-gray-600 fw-bold">12 Feb 2023 - 13 Mar 2023</div>
                        <!--end::Display range-->
        
                        <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
        <span class="svg-icon svg-icon-1 ms-2 me-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"></path>
        <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"></path>
        <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"></path>
        </svg>
        </span>
        <!--end::Svg Icon-->          
                    </div>  
                    <!--end::Daterangepicker-->           
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
        
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Tab Content (ishlamayabdi)-->
                <div class="tab-content mb-2">
                                                                <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_table_widget_7_tab_content_1" role="tabpanel">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr>                                    
                                            <th class="min-w-150px p-0"></th>
                                            <th class="min-w-200px p-0"></th>
                                            <th class="min-w-100px p-0"></th>
                                            <th class="min-w-80px p-0"></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
        
                                    <!--begin::Table body-->
                                    <tbody>
                                             
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        11:43-09:43am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 1:
                                                        <span class="text-gray-800">French class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">5</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 205min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        09:40-11:20am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 2:
                                                        <span class="text-gray-800">Physics class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">13</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 25min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        10:35-43:09am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 3:
                                                        <span class="text-gray-800">Chemistry class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Court:
                                                            <span class="text-gray-800">Main</span>                                            
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 15min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        15:30-12:23pm                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 4:
                                                        <span class="text-gray-800">Biology class</span>
        
                                                                                                            <!--begin::Icon-->  
                                                            <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Held by Dr. Ana" data-bs-original-title="Held by Dr. Ana" data-kt-initialized="1">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-1 svg-icon-warning"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
        </svg>
        </span>
        <!--end::Svg Icon--> 
                                                            </span>                                                                                                                                                                 
                                                            <!--end::Icon-->            
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">23</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                                        </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->    
                                                    <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_table_widget_7_tab_content_2" role="tabpanel">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr>                                    
                                            <th class="min-w-150px p-0"></th>
                                            <th class="min-w-200px p-0"></th>
                                            <th class="min-w-100px p-0"></th>
                                            <th class="min-w-80px p-0"></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
        
                                    <!--begin::Table body-->
                                    <tbody>
                                             
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        09:15-12:23am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 1:
                                                        <span class="text-gray-800">Geography class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">45</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 20min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        08:30-09:30am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 2:
                                                        <span class="text-gray-800">English class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">9</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 20min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        11:15-12:13am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 3:
                                                        <span class="text-gray-800">Sports class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Court:
                                                            <span class="text-gray-800">Main</span>                                            
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 25min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        14:10-15:35pm                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 4:
                                                        <span class="text-gray-800">Picture class</span>
        
                                                                                                            <!--begin::Icon-->  
                                                            <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Held by Dr. Lebron" data-bs-original-title="Held by Dr. Lebron" data-kt-initialized="1">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-1 svg-icon-warning"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
        </svg>
        </span>
        <!--end::Svg Icon--> 
                                                            </span>                                                                                                                                                                 
                                                            <!--end::Icon-->            
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">12</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                                        </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->    
                                                    <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_table_widget_7_tab_content_3" role="tabpanel">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr>                                    
                                            <th class="min-w-150px p-0"></th>
                                            <th class="min-w-200px p-0"></th>
                                            <th class="min-w-100px p-0"></th>
                                            <th class="min-w-80px p-0"></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
        
                                    <!--begin::Table body-->
                                    <tbody>
                                             
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        08:30-09:12am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 1:
                                                        <span class="text-gray-800">Math class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">45</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 15min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        09:30-10:50am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 2:
                                                        <span class="text-gray-800">History class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">12</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 20min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        10:35-11:20am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 3:
                                                        <span class="text-gray-800">Sports class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Court:
                                                            <span class="text-gray-800">Main</span>                                            
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 15min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        12:40-13:25pm                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 4:
                                                        <span class="text-gray-800">Chemistry class</span>
        
                                                                                                            <!--begin::Icon-->  
                                                            <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Held by Dr. Natali" data-bs-original-title="Held by Dr. Natali" data-kt-initialized="1">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-1 svg-icon-warning"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
        </svg>
        </span>
        <!--end::Svg Icon--> 
                                                            </span>                                                                                                                                                                 
                                                            <!--end::Icon-->            
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">19</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                                        </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->    
                                                    <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_table_widget_7_tab_content_4" role="tabpanel">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr>                                    
                                            <th class="min-w-150px p-0"></th>
                                            <th class="min-w-200px p-0"></th>
                                            <th class="min-w-100px p-0"></th>
                                            <th class="min-w-80px p-0"></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
        
                                    <!--begin::Table body-->
                                    <tbody>
                                             
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        11:25-14:13am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 1:
                                                        <span class="text-gray-800">Geography class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">15</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 25min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        08:30-09:30am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 2:
                                                        <span class="text-gray-800">English class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">9</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 20min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        11:15-12:13am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 3:
                                                        <span class="text-gray-800">Sports class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Court:
                                                            <span class="text-gray-800">Main</span>                                            
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 25min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        14:10-15:35pm                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 4:
                                                        <span class="text-gray-800">Picture class</span>
        
                                                                                                            <!--begin::Icon-->  
                                                            <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Held by Dr. Kevin" data-bs-original-title="Held by Dr. Kevin" data-kt-initialized="1">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-1 svg-icon-warning"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
        </svg>
        </span>
        <!--end::Svg Icon--> 
                                                            </span>                                                                                                                                                                 
                                                            <!--end::Icon-->            
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">12</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                                        </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->    
                                                    <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_table_widget_7_tab_content_5" role="tabpanel">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr>                                    
                                            <th class="min-w-150px p-0"></th>
                                            <th class="min-w-200px p-0"></th>
                                            <th class="min-w-100px p-0"></th>
                                            <th class="min-w-80px p-0"></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
        
                                    <!--begin::Table body-->
                                    <tbody>
                                             
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        11:43-09:43am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 1:
                                                        <span class="text-gray-800">French class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">5</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 205min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        09:40-11:20am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 2:
                                                        <span class="text-gray-800">Physics class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">13</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 25min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        10:35-43:09am                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 3:
                                                        <span class="text-gray-800">Chemistry class</span>
        
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Court:
                                                            <span class="text-gray-800">Main</span>                                            
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="bg-light rounded text-gray-600 fs-8 fw-bold px-3 py-2" colspan="4">
                                                        Break 15min                                            </td>
                                                </tr>
                                                                                 
                                                                                    <tr>
                                                    <td class="fs-6 fw-bold text-gray-800">
                                                        15:30-12:23pm                                            </td>
                                                    <td class="fs-6 fw-bold text-gray-400">                                         
                                                        lesson 4:
                                                        <span class="text-gray-800">Biology class</span>
        
                                                                                                            <!--begin::Icon-->  
                                                            <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Held by Dr. Emma" data-bs-original-title="Held by Dr. Emma" data-kt-initialized="1">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-1 svg-icon-warning"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
        </svg>
        </span>
        <!--end::Svg Icon--> 
                                                            </span>                                                                                                                                                                 
                                                            <!--end::Icon-->            
                                                         
                                                    </td>
                                                    <td class="fs-6 fw-bold text-gray-400">
                                                                                                            Cabinet:
                                                            <span class="text-gray-800">23</span>  
                                                                                                               
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <button class="btn btn-sm btn-light">
                                                            Skip
                                                        </button>
                                                    </td>
                                                </tr>
                                                                                                        </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->    
                      
                </div>
                <!--end::Tab Content-->   
                
                <!--begin::Action-->
                <div class="float-end">
                    <a href="#" class="btn btn-sm btn-light me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">Add Lesson</a>
        
                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Call Sick for Today</a>
                </div>
                <!--end::Action-->  
            </div>
            <!--end: Card Body-->
        </div>
<!--end::Timeline Widget 1-->    </div>
    <!--end::Col-->    
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row g-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-4">       
        
<!--begin::List widget 21-->
<div class="card card-flush h-xl-100">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-dark">Active Lessons</span>

			<span class="text-muted mt-1 fw-semibold fs-7">Avg. 72% completed lessons</span>
		</h3>

        <!--begin::Toolbar-->
        <div class="card-toolbar">   
            <a href="#" class="btn btn-sm btn-light">All Lessons</a>             
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-5">                 
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">                 
                <!--begin::Wrapper-->                                  
                <div class="d-flex align-items-center me-3">
                    <!--begin::Logo-->                         
                    <img src="<?php echo $web_root ?>assets/assets/media/svg/brand-logos/laravel-2.svg" class="me-4 w-30px" alt=""/>                  
                    <!--end::Logo-->

                    <!--begin::Section-->                                  
                    <div class="flex-grow-1">
                        <!--begin::Text-->
                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Laravel</a>
                        <!--end::Text-->
                        
                        <!--begin::Description-->
                        <span class="text-gray-400 fw-semibold d-block fs-6">PHP Framework</span>
                        <!--end::Description--->
                    </div>                   
                    <!--end::Section-->
                </div>                   
                <!--end::Wrapper-->
                
                <!--begin::Statistics-->
                <div class="d-flex align-items-center w-100 mw-125px">  
                    <!--begin::Progress-->                  
                    <div class="progress h-6px w-100 me-2 bg-light-success">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!--end::Progress-->

                    <!--begin::Value-->
                    <span class="text-gray-400 fw-semibold">
                        65%
                    </span>
                    <!--end::Value-->
                </div>
                <!--end::Statistics-->
            </div>
            <!--end::Item-->
            
                            <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">                 
                <!--begin::Wrapper-->                                  
                <div class="d-flex align-items-center me-3">
                    <!--begin::Logo-->                         
                    <img src="<?php echo $web_root ?>assets/assets/media/svg/brand-logos/vue-9.svg" class="me-4 w-30px" alt=""/>                  
                    <!--end::Logo-->

                    <!--begin::Section-->                                  
                    <div class="flex-grow-1">
                        <!--begin::Text-->
                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Vue 3</a>
                        <!--end::Text-->
                        
                        <!--begin::Description-->
                        <span class="text-gray-400 fw-semibold d-block fs-6">JS Framework</span>
                        <!--end::Description--->
                    </div>                   
                    <!--end::Section-->
                </div>                   
                <!--end::Wrapper-->
                
                <!--begin::Statistics-->
                <div class="d-flex align-items-center w-100 mw-125px">  
                    <!--begin::Progress-->                  
                    <div class="progress h-6px w-100 me-2 bg-light-warning">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!--end::Progress-->

                    <!--begin::Value-->
                    <span class="text-gray-400 fw-semibold">
                        87%
                    </span>
                    <!--end::Value-->
                </div>
                <!--end::Statistics-->
            </div>
            <!--end::Item-->
            
                            <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">                 
                <!--begin::Wrapper-->                                  
                <div class="d-flex align-items-center me-3">
                    <!--begin::Logo-->                         
                    <img src="<?php echo $web_root ?>assets/assets/media/svg/brand-logos/bootstrap5.svg" class="me-4 w-30px" alt=""/>                  
                    <!--end::Logo-->

                    <!--begin::Section-->                                  
                    <div class="flex-grow-1">
                        <!--begin::Text-->
                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Bootstrap 5</a>
                        <!--end::Text-->
                        
                        <!--begin::Description-->
                        <span class="text-gray-400 fw-semibold d-block fs-6">CSS Framework</span>
                        <!--end::Description--->
                    </div>                   
                    <!--end::Section-->
                </div>                   
                <!--end::Wrapper-->
                
                <!--begin::Statistics-->
                <div class="d-flex align-items-center w-100 mw-125px">  
                    <!--begin::Progress-->                  
                    <div class="progress h-6px w-100 me-2 bg-light-primary">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 44%" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!--end::Progress-->

                    <!--begin::Value-->
                    <span class="text-gray-400 fw-semibold">
                        44%
                    </span>
                    <!--end::Value-->
                </div>
                <!--end::Statistics-->
            </div>
            <!--end::Item-->
            
                            <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">                 
                <!--begin::Wrapper-->                                  
                <div class="d-flex align-items-center me-3">
                    <!--begin::Logo-->                         
                    <img src="<?php echo $web_root ?>assets/assets/media/svg/brand-logos/angular-icon.svg" class="me-4 w-30px" alt=""/>                  
                    <!--end::Logo-->

                    <!--begin::Section-->                                  
                    <div class="flex-grow-1">
                        <!--begin::Text-->
                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Angular 13</a>
                        <!--end::Text-->
                        
                        <!--begin::Description-->
                        <span class="text-gray-400 fw-semibold d-block fs-6">JS Framework</span>
                        <!--end::Description--->
                    </div>                   
                    <!--end::Section-->
                </div>                   
                <!--end::Wrapper-->
                
                <!--begin::Statistics-->
                <div class="d-flex align-items-center w-100 mw-125px">  
                    <!--begin::Progress-->                  
                    <div class="progress h-6px w-100 me-2 bg-light-info">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!--end::Progress-->

                    <!--begin::Value-->
                    <span class="text-gray-400 fw-semibold">
                        70%
                    </span>
                    <!--end::Value-->
                </div>
                <!--end::Statistics-->
            </div>
            <!--end::Item-->
            
                            <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">                 
                <!--begin::Wrapper-->                                  
                <div class="d-flex align-items-center me-3">
                    <!--begin::Logo-->                         
                    <img src="<?php echo $web_root ?>assets/assets/media/svg/brand-logos/spring-3.svg" class="me-4 w-30px" alt=""/>                  
                    <!--end::Logo-->

                    <!--begin::Section-->                                  
                    <div class="flex-grow-1">
                        <!--begin::Text-->
                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Spring</a>
                        <!--end::Text-->
                        
                        <!--begin::Description-->
                        <span class="text-gray-400 fw-semibold d-block fs-6">Java Framework</span>
                        <!--end::Description--->
                    </div>                   
                    <!--end::Section-->
                </div>                   
                <!--end::Wrapper-->
                
                <!--begin::Statistics-->
                <div class="d-flex align-items-center w-100 mw-125px">  
                    <!--begin::Progress-->                  
                    <div class="progress h-6px w-100 me-2 bg-light-danger">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!--end::Progress-->

                    <!--begin::Value-->
                    <span class="text-gray-400 fw-semibold">
                        56%
                    </span>
                    <!--end::Value-->
                </div>
                <!--end::Statistics-->
            </div>
            <!--end::Item-->
            
                            <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
             
                    
            <!--begin::Item-->
            <div class="d-flex flex-stack">                 
                <!--begin::Wrapper-->                                  
                <div class="d-flex align-items-center me-3">
                    <!--begin::Logo-->                         
                    <img src="<?php echo $web_root ?>assets/assets/media/svg/brand-logos/typescript-1.svg" class="me-4 w-30px" alt=""/>                  
                    <!--end::Logo-->

                    <!--begin::Section-->                                  
                    <div class="flex-grow-1">
                        <!--begin::Text-->
                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">TypeScript</a>
                        <!--end::Text-->
                        
                        <!--begin::Description-->
                        <span class="text-gray-400 fw-semibold d-block fs-6">Better Tooling</span>
                        <!--end::Description--->
                    </div>                   
                    <!--end::Section-->
                </div>                   
                <!--end::Wrapper-->
                
                <!--begin::Statistics-->
                <div class="d-flex align-items-center w-100 mw-125px">  
                    <!--begin::Progress-->                  
                    <div class="progress h-6px w-100 me-2 bg-light-success">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!--end::Progress-->

                    <!--begin::Value-->
                    <span class="text-gray-400 fw-semibold">
                        82%
                    </span>
                    <!--end::Value-->
                </div>
                <!--end::Statistics-->
            </div>
            <!--end::Item-->
            
             
           
    </div>
    <!--end::Body-->
</div>
<!--end::List widget 21--> 
    </div>
    <!--end::Col-->     

    <!--begin::Col-->
    <div class="col-xl-8">
        <!--begin::Chart widget 18-->
<div class="card card-flush h-xl-100">
    <!--begin::Header-->
    <div class="card-header pt-7">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Learn Activity</span>
			<span class="text-gray-400 mt-1 fw-semibold fs-6">Hours per course</span>
		</h3>
        <!--end::Title-->

        <!--begin::Toolbar-->
        <div class="card-toolbar">           
            <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
            <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4">           
                <!--begin::Display range-->
                <div class="text-gray-600 fw-bold">
                    Loading date range...
                </div>
                <!--end::Display range-->

                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
<span class="svg-icon svg-icon-1 ms-2 me-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"/>
<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"/>
<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->          
            </div>  
            <!--end::Daterangepicker-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body d-flex align-items-end px-0 pt-3 pb-5"> 
        <!--begin::Chart-->
        <div id="kt_charts_widget_18_chart" class="h-325px w-100 min-h-auto ps-4 pe-6"></div>
        <!--end::Chart-->                  
    </div>
    <!--end: Card Body-->
</div>
<!--end::Chart widget 18-->

     </div>
    <!--end::Col-->    
</div>
<!--end::Row-->		


<br/>
<div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xxl-6">
        
            
            

    <!--begin::Table widget 1-->
<div class="col-xxl-8">
        
    <!--begin::Timeline widget 2-->
    <div class="card h-xl-100" id="kt_timeline_widget_2_card">
        <!--begin::Header-->
        <div class="card-header position-relative py-0 border-bottom-2">
            <!--begin::Nav-->             
            <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3" role="tablist">
                <!--begin::Item--> 
                <li class="nav-item p-0 ms-0 me-8" role="presentation">
                    <!--begin::Link--> 
                    <a class="nav-link btn btn-color-muted px-0 active" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_1" aria-selected="true" role="tab">                   
                        <!--begin::Subtitle-->
                        <span class="nav-text fw-semibold fs-4 mb-3">
                            Today Homeworks
                        </span> 
                        <!--end::Subtitle-->
                        
                        <!--begin::Bullet-->
                        <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                        <!--end::Bullet-->  
                    </a>
                    <!--end::Link-->                
                </li>
                <!--end::Item-->
    
                <!--begin::Item--> 
                <li class="nav-item p-0 ms-0 me-8" role="presentation">
                    <!--begin::Link--> 
                    <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_2" aria-selected="false" role="tab" tabindex="-1">                   
                        <!--begin::Subtitle-->
                        <span class="nav-text fw-semibold fs-4 mb-3">
                            Recent
                        </span> 
                        <!--end::Subtitle-->
                        
                        <!--begin::Bullet-->
                        <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                        <!--end::Bullet-->  
                    </a>
                    <!--end::Link-->                
                </li>
                <!--end::Item-->    
    
                
                <!--begin::Item--> 
                <li class="nav-item p-0 ms-0" role="presentation">
                    <!--begin::Link--> 
                    <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#kt_timeline_widget_2_tab_3" aria-selected="false" role="tab" tabindex="-1">                   
                        <!--begin::Subtitle-->
                        <span class="nav-text fw-semibold fs-4 mb-3">
                            Future
                        </span> 
                        <!--end::Subtitle-->
                        
                        <!--begin::Bullet-->
                        <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                        <!--end::Bullet-->  
                    </a>
                    <!--end::Link-->                
                </li>
                <!--end::Item-->    
            </ul>             
            <!--end::Nav-->        
        </div>
        <!--end::Header-->
    
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Tab Content-->
            <div class="tab-content">
                                
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade active show" id="kt_timeline_widget_2_tab_1" role="tabpanel">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr>                                    
                                    <th class="p-0 w-10px"></th>
                                    <th class="p-0 w-25px"></th>
                                    <th class="p-0 min-w-400px"></th>
                                    <th class="p-0 min-w-100px"></th>                                     
                                    <th class="p-0 min-w-125px"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
    
                                <!--begin::Table body-->
                                <tbody>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-success"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" checked="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Book p. 77-85, read &amp; complete tasks 1-6 on p. 85</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">Physics</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-success">Done</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom  form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Workbook p. 17, tasks 1-6</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">Mathematics</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-primary">In Process</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-success"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" checked="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Learn paragraph p. 99, Exercise 1,2,3Scoping &amp; Estimations</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">Chemistry</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-success">Done</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom  form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Write essay 1000 words “WW2 results”</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">History</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-primary">In Process</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom  form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Internal conflicts in Philip Larkin poems, read p 380-515</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">English Language</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-primary">In Process</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Tap pane-->
                                
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_2" role="tabpanel">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr>                                    
                                    <th class="p-0 w-10px"></th>
                                    <th class="p-0 w-25px"></th>
                                    <th class="p-0 min-w-400px"></th>
                                    <th class="p-0 min-w-100px"></th>                                     
                                    <th class="p-0 min-w-125px"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
    
                                <!--begin::Table body-->
                                <tbody>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-success"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" checked="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Book p. 77-85, read &amp; complete tasks 1-6 on p. 85</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">Physics</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-success">Done</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom  form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Workbook p. 17, tasks 1-6</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">Mathematics</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-primary">In Process</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-success"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" checked="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Learn paragraph p. 99, Exercise 1,2,3Scoping &amp; Estimations</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">Chemistry</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-success">Done</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom  form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Write essay 1000 words “WW2 results”</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">History</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-primary">In Process</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Tap pane-->
                                
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_3" role="tabpanel">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr>                                    
                                    <th class="p-0 w-10px"></th>
                                    <th class="p-0 w-25px"></th>
                                    <th class="p-0 min-w-400px"></th>
                                    <th class="p-0 min-w-100px"></th>                                     
                                    <th class="p-0 min-w-125px"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
    
                                <!--begin::Table body-->
                                <tbody>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom  form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Workbook p. 17, tasks 1-6</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">Mathematics</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-primary">In Process</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-success"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" checked="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Learn paragraph p. 99, Exercise 1,2,3Scoping &amp; Estimations</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">Chemistry</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-success">Done</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom  form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Write essay 1000 words “WW2 results”</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">History</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-primary">In Process</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                        <tr>
                                            <td>
                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                            </td>
    
                                            <td class="ps-0">
                                                <div class="form-check form-check-custom  form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" data-kt-element="checkbox">
                                                </div>
                                            </td> 
    
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Internal conflicts in Philip Larkin poems, read p 380-515</a>
                                                
                                                <span class="text-gray-400 fw-bold fs-7 d-block">English Language</span>
                                            </td>
    
                                            <td class="text-end">
                                                <span data-kt-element="status" class="badge badge-light-primary">In Process</span>
                                            </td>
                                            
                                            <td class="text-end">
                                                <!--begin::Icon-->                
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <!--begin::Print-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-printer fs-3"></i>
                                                    </a>
                                                    <!--end::Print-->
    
                                                    <!--begin::Chat-->            
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3">
                                                        <i class="fonticon-chat fs-3"></i>
                                                    </a>
                                                    <!--end::Chat-->
    
                                                    <!--begin::Attach-->
                                                    <a href="#" class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="fonticon-paperclip fs-3"></i>
                                                    </a>
                                                    <!--end::Attach-->
                                                </div>
                                                <!--end::Icon-->    
                                            </td>
                                        </tr>
                                                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Tap pane-->
                        </div>
            <!--end::Tab Content--> 
        </div>
        <!--end::Body-->
    </div>
    <!--end::Tables Widget 2--> 
                            
        </div>
<!--end::Table widget 1-->
    </div>
    <!--end::Col-->   

    <!--begin::Col-->
    <div class="col-xxl-6 mb-5 mb-xl-10">
        <!--begin::Chart widget 8-->
        <div class="card h-xl-100">
            <!--begin::Header-->
            <div class="card-header position-relative py-0 border-bottom-2">
                <!--begin::Nav-->             
                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3" role="tablist">
                    <!--begin::Item--> 
                    <li class="nav-item p-0 ms-0 me-8" role="presentation">
                        <!--begin::Link--> 
                        <a class="nav-link btn btn-color-muted active px-0" data-bs-toggle="tab" id="kt_chart_widgets_22_tab_1" href="#kt_chart_widgets_22_tab_content_1" aria-selected="true" role="tab">                   
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">
                                Overview
                            </span> 
                            <!--end::Subtitle-->
                            
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->    
                        </a>
                        <!--end::Link-->                
                    </li>
                    <!--end::Item--> 
        
                    <!--begin::Item--> 
                    <li class="nav-item p-0 ms-0" role="presentation">
                        <!--begin::Link--> 
                        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" id="kt_chart_widgets_22_tab_2" href="#kt_chart_widgets_22_tab_content_2" aria-selected="false" tabindex="-1" role="tab">                   
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-semibold fs-4 mb-3">
                                Performance
                            </span> 
                            <!--end::Subtitle-->
                            
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->    
                        </a>
                        <!--end::Link-->                
                    </li>
                    <!--end::Item-->               
                </ul>             
                <!--end::Nav-->
        
                <!--begin::Toolbar-->
                <div class="card-toolbar">   
                    <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4" data-kt-initialized="1">           
                        <!--begin::Display range-->
                        <div class="text-gray-600 fw-bold">12 Feb 2023 - 13 Mar 2023</div>
                        <!--end::Display range-->
        
                        <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
        <span class="svg-icon svg-icon-1 ms-2 me-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"></path>
        <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"></path>
        <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"></path>
        </svg>
        </span>
        <!--end::Svg Icon-->          
                    </div>  
                    <!--end::Daterangepicker-->           
                </div>
                <!--end::Toolbar-->       
            </div>
            <!--end::Header-->
        
            <!--begin::Body-->
            <div class="card-body pb-3">  
                <!--begin::Tab Content-->
                <div class="tab-content">
                                                    <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_chart_widgets_22_tab_content_1" role="tabpanel" aria-labelledby="#kt_chart_widgets_22_tab_1">
                            <!--begin::Wrapper-->                         
                            <div class="d-flex flex-wrap flex-md-nowrap">
                                <!--begin::Items-->                         
                                <div class="me-md-5 w-100">
                                                                       
                                        <!--begin::Item-->                                               
                                        <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                            <!--begin::Block-->                                                                                   
                                            <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
        <span class="svg-icon svg-icon-2qx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="currentColor"></path>
        <path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="currentColor"></path>
        </svg>
        </span>
        <!--end::Svg Icon-->                        
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
        
                                                <!--begin::Section-->                                                    
                                                <div class="me-2">
                                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Attendance</a>
                                                    
                                                    <span class="text-gray-400 fw-bold d-block fs-7">Great, you always attending class. keep it up</span>
                                                </div>                                         
                                                <!--end::Section-->  
                                            </div>                                         
                                            <!--end::Block-->  
                                            
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">                    
                                                <span class="text-dark fw-bolder fs-2x">73</span> 
        
                                                <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                                    
                                                <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">76</span>                                                           
        
                                                <span class="badge badge-lg badge-light-success align-self-center px-2">95%</span>                                       
                                            </div>                                  
                                            <!--end::Info-->                                                      
                                        </div>
                                        <!--end::Item-->                         
                                                                       
                                        <!--begin::Item-->                                               
                                        <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                            <!--begin::Block-->                                                                                   
                                            <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
        <span class="svg-icon svg-icon-2qx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
        </svg>
        </span>
        <!--end::Svg Icon-->                        
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
        
                                                <!--begin::Section-->                                                    
                                                <div class="me-2">
                                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Homeworks</a>
                                                    
                                                    <span class="text-gray-400 fw-bold d-block fs-7">Don’t forget to turn in your task</span>
                                                </div>                                         
                                                <!--end::Section-->  
                                            </div>                                         
                                            <!--end::Block-->  
                                            
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">                    
                                                <span class="text-dark fw-bolder fs-2x">207</span> 
        
                                                <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                                    
                                                <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">214</span>                                                           
        
                                                <span class="badge badge-lg badge-light-success align-self-center px-2">92%</span>                                       
                                            </div>                                  
                                            <!--end::Info-->                                                      
                                        </div>
                                        <!--end::Item-->                         
                                                                       
                                        <!--begin::Item-->                                               
                                        <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                            <!--begin::Block-->                                                                                   
                                            <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
        <span class="svg-icon svg-icon-2qx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.925 3.90078V8.00077L12.025 10.8008V5.10078L15.525 3.10078C16.125 2.80078 16.925 3.20078 16.925 3.90078ZM2.525 13.5008L6.025 15.5008L10.925 12.7008L6.025 9.90078L2.525 11.9008C1.825 12.3008 1.825 13.2008 2.525 13.5008ZM18.025 19.7008V15.6008L13.125 12.8008V18.5008L16.625 20.5008C17.225 20.8008 18.025 20.4008 18.025 19.7008Z" fill="currentColor"></path>
        <path opacity="0.3" d="M8.52499 3.10078L12.025 5.10078V10.8008L7.125 8.00077V3.90078C7.125 3.20078 7.92499 2.80078 8.52499 3.10078ZM7.42499 20.5008L10.925 18.5008V12.8008L6.02499 15.6008V19.7008C6.02499 20.4008 6.82499 20.8008 7.42499 20.5008ZM21.525 11.9008L18.025 9.90078L13.125 12.7008L18.025 15.5008L21.525 13.5008C22.225 13.2008 22.225 12.3008 21.525 11.9008Z" fill="currentColor"></path>
        </svg>
        </span>
        <!--end::Svg Icon-->                        
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
        
                                                <!--begin::Section-->                                                    
                                                <div class="me-2">
                                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Tests</a>
                                                    
                                                    <span class="text-gray-400 fw-bold d-block fs-7">You take 12 subjects at this semester</span>
                                                </div>                                         
                                                <!--end::Section-->  
                                            </div>                                         
                                            <!--end::Block-->  
                                            
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">                    
                                                <span class="text-dark fw-bolder fs-2x">27</span> 
        
                                                <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                                    
                                                <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">38</span>                                                           
        
                                                <span class="badge badge-lg badge-light-warning align-self-center px-2">80%</span>                                       
                                            </div>                                  
                                            <!--end::Info-->                                                      
                                        </div>
                                        <!--end::Item-->                         
                                                            </div>
                                <!--end::Items--> 
                                
                                <!--begin::Container-->
                                <div class="d-flex justify-content-between flex-column w-225px w-md-600px mx-auto mx-md-0 pt-3 pb-10">
                                    <!--begin::Title-->
                                    <div class="fs-4 fw-bold text-gray-900 text-center mb-5">
                                        Session Attendance <br>
                                        for Current Academic Year    
                                    </div>
                                    <!--end::Title--> 
        
                                    <!--begin::Chart-->
                                    <div id="kt_chart_widgets_22_chart_1" class="mx-auto mb-4" style="min-height: 191.133px;"><div id="apexcharts0tv0kzi6" class="apexcharts-canvas apexcharts0tv0kzi6 apexcharts-theme-light" style="width: 250px; height: 191.133px;"><svg id="SvgjsSvg1271" width="250" height="191.13333333333335" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1273" class="apexcharts-inner apexcharts-graphical" transform="translate(33.83333333333333, 0)"><defs id="SvgjsDefs1272"><clipPath id="gridRectMask0tv0kzi6"><rect id="SvgjsRect1275" width="188.33333333333334" height="206.33333333333334" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask0tv0kzi6"></clipPath><clipPath id="nonForecastMask0tv0kzi6"></clipPath><clipPath id="gridRectMarkerMask0tv0kzi6"><rect id="SvgjsRect1276" width="188.33333333333334" height="210.33333333333334" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><filter id="SvgjsFilter1285" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1286" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1286Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1287" in="SvgjsFeFlood1286Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1287Out"></feComposite><feOffset id="SvgjsFeOffset1288" dx="1" dy="1" result="SvgjsFeOffset1288Out" in="SvgjsFeComposite1287Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1289" stdDeviation="1 " result="SvgjsFeGaussianBlur1289Out" in="SvgjsFeOffset1288Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1290" result="SvgjsFeMerge1290Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1291" in="SvgjsFeGaussianBlur1289Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1292" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1293" in="SourceGraphic" in2="SvgjsFeMerge1290Out" mode="normal" result="SvgjsFeBlend1293Out"></feBlend></filter><filter id="SvgjsFilter1298" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1299" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1299Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1300" in="SvgjsFeFlood1299Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1300Out"></feComposite><feOffset id="SvgjsFeOffset1301" dx="1" dy="1" result="SvgjsFeOffset1301Out" in="SvgjsFeComposite1300Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1302" stdDeviation="1 " result="SvgjsFeGaussianBlur1302Out" in="SvgjsFeOffset1301Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1303" result="SvgjsFeMerge1303Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1304" in="SvgjsFeGaussianBlur1302Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1305" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1306" in="SourceGraphic" in2="SvgjsFeMerge1303Out" mode="normal" result="SvgjsFeBlend1306Out"></feBlend></filter><filter id="SvgjsFilter1311" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1312" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1312Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1313" in="SvgjsFeFlood1312Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1313Out"></feComposite><feOffset id="SvgjsFeOffset1314" dx="1" dy="1" result="SvgjsFeOffset1314Out" in="SvgjsFeComposite1313Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1315" stdDeviation="1 " result="SvgjsFeGaussianBlur1315Out" in="SvgjsFeOffset1314Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1316" result="SvgjsFeMerge1316Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1317" in="SvgjsFeGaussianBlur1315Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1318" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1319" in="SourceGraphic" in2="SvgjsFeMerge1316Out" mode="normal" result="SvgjsFeBlend1319Out"></feBlend></filter><filter id="SvgjsFilter1324" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1325" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1325Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1326" in="SvgjsFeFlood1325Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1326Out"></feComposite><feOffset id="SvgjsFeOffset1327" dx="1" dy="1" result="SvgjsFeOffset1327Out" in="SvgjsFeComposite1326Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1328" stdDeviation="1 " result="SvgjsFeGaussianBlur1328Out" in="SvgjsFeOffset1327Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1329" result="SvgjsFeMerge1329Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1330" in="SvgjsFeGaussianBlur1328Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1331" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1332" in="SourceGraphic" in2="SvgjsFeMerge1329Out" mode="normal" result="SvgjsFeBlend1332Out"></feBlend></filter></defs><g id="SvgjsG1277" class="apexcharts-pie"><g id="SvgjsG1278" transform="translate(0, 0) scale(1)"><circle id="SvgjsCircle1279" r="42.95934959349594" cx="92.16666666666667" cy="92.16666666666667" fill="transparent"></circle><g id="SvgjsG1280" class="apexcharts-slices"><g id="SvgjsG1281" class="apexcharts-series apexcharts-pie-series" seriesName="Sales" rel="1" data:realIndex="0"><path id="SvgjsPath1282" d="M 92.16666666666667 6.247967479674784 A 85.91869918699189 85.91869918699189 0 0 1 152.92036149251575 31.412971840817605 L 122.5435140795912 61.78981925374214 A 42.95934959349594 42.95934959349594 0 0 0 92.16666666666667 49.20731707317073 L 92.16666666666667 6.247967479674784 z" fill="rgba(114,57,234,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="45" data:startAngle="0" data:strokeWidth="0" data:value="20" data:pathOrig="M 92.16666666666667 6.247967479674784 A 85.91869918699189 85.91869918699189 0 0 1 152.92036149251575 31.412971840817605 L 122.5435140795912 61.78981925374214 A 42.95934959349594 42.95934959349594 0 0 0 92.16666666666667 49.20731707317073 L 92.16666666666667 6.247967479674784 z"></path></g><g id="SvgjsG1294" class="apexcharts-series apexcharts-pie-series" seriesName="Sales" rel="2" data:realIndex="1"><path id="SvgjsPath1295" d="M 152.92036149251575 31.412971840817605 A 85.91869918699189 85.91869918699189 0 1 1 6.247967479674784 92.16666666666669 L 49.20731707317073 92.16666666666667 A 42.95934959349594 42.95934959349594 0 1 0 122.5435140795912 61.78981925374214 L 152.92036149251575 31.412971840817605 z" fill="rgba(4,200,200,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="225" data:startAngle="45" data:strokeWidth="0" data:value="100" data:pathOrig="M 152.92036149251575 31.412971840817605 A 85.91869918699189 85.91869918699189 0 1 1 6.247967479674784 92.16666666666669 L 49.20731707317073 92.16666666666667 A 42.95934959349594 42.95934959349594 0 1 0 122.5435140795912 61.78981925374214 L 152.92036149251575 31.412971840817605 z"></path></g><g id="SvgjsG1307" class="apexcharts-series apexcharts-pie-series" seriesName="Sales" rel="3" data:realIndex="2"><path id="SvgjsPath1308" d="M 6.247967479674784 92.16666666666669 A 85.91869918699189 85.91869918699189 0 0 1 20.727879164119514 44.432794938608474 L 56.44727291539309 68.29973080263757 A 42.95934959349594 42.95934959349594 0 0 0 49.20731707317073 92.16666666666667 L 6.247967479674784 92.16666666666669 z" fill="rgba(0,158,247,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="33.75" data:startAngle="270" data:strokeWidth="0" data:value="15" data:pathOrig="M 6.247967479674784 92.16666666666669 A 85.91869918699189 85.91869918699189 0 0 1 20.727879164119514 44.432794938608474 L 56.44727291539309 68.29973080263757 A 42.95934959349594 42.95934959349594 0 0 0 49.20731707317073 92.16666666666667 L 6.247967479674784 92.16666666666669 z"></path></g><g id="SvgjsG1320" class="apexcharts-series apexcharts-pie-series" seriesName="Sales" rel="4" data:realIndex="3"><path id="SvgjsPath1321" d="M 20.727879164119514 44.432794938608474 A 85.91869918699189 85.91869918699189 0 0 1 92.15167102484435 6.247968788291402 L 92.15916884575552 49.20731772747904 A 42.95934959349594 42.95934959349594 0 0 0 56.44727291539309 68.29973080263757 L 20.727879164119514 44.432794938608474 z" fill="rgba(241,65,108,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="56.25" data:startAngle="303.75" data:strokeWidth="0" data:value="25" data:pathOrig="M 20.727879164119514 44.432794938608474 A 85.91869918699189 85.91869918699189 0 0 1 92.15167102484435 6.247968788291402 L 92.15916884575552 49.20731772747904 A 42.95934959349594 42.95934959349594 0 0 0 56.44727291539309 68.29973080263757 L 20.727879164119514 44.432794938608474 z"></path></g><g id="SvgjsG1283" class="apexcharts-datalabels"><text id="SvgjsText1284" font-family="inherit" x="116.82641369858295" y="32.63277093752472" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1285)" style="font-family: inherit;">12.5%</text></g><g id="SvgjsG1296" class="apexcharts-datalabels"><text id="SvgjsText1297" font-family="inherit" x="116.82641369858295" y="151.70056239580862" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1298)" style="font-family: inherit;">62.5%</text></g><g id="SvgjsG1309" class="apexcharts-datalabels"><text id="SvgjsText1310" font-family="inherit" x="30.50236503241066" y="73.4610052689523" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1311)" style="font-family: inherit;">9.4%</text></g><g id="SvgjsG1322" class="apexcharts-datalabels"><text id="SvgjsText1323" font-family="inherit" x="61.790320844854804" y="35.33652080304827" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1324)" style="font-family: inherit;">15.6%</text></g></g></g></g><line id="SvgjsLine1333" x1="0" y1="0" x2="184.33333333333334" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1334" x1="0" y1="0" x2="184.33333333333334" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1274" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(114, 57, 234);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(4, 200, 200);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 158, 247);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 4;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(241, 65, 108);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                    <!--end::Chart-->
        
                                    <!--begin::Labels-->
                                    <div class="mx-auto">
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-success me-2"></div>
                                            <!--end::Bullet-->
        
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">Precent(133)</div>
                                            <!--end::Label-->                                 
                                        </div>
                                        <!--end::Label-->   
                                        
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-primary me-2"></div>
                                            <!--end::Bullet-->
        
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">Illness(9)</div>
                                            <!--end::Label-->                                 
                                        </div>
                                        <!--end::Label-->   
        
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-info me-2"></div>
                                            <!--end::Bullet-->
        
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">Late(2)</div>
                                            <!--end::Label-->                                 
                                        </div>
                                        <!--end::Label-->   
        
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-danger me-2"></div>
                                            <!--end::Bullet-->
        
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">Absent(3)</div>
                                            <!--end::Label-->                                 
                                        </div>
                                        <!--end::Label-->   
                                    </div>
                                    <!--end::Labels-->                                
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Wrapper-->                    
                        </div>
                        <!--end::Tap pane-->                               
                                                    <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_chart_widgets_22_tab_content_2" role="tabpanel" aria-labelledby="#kt_chart_widgets_22_tab_2">
                            <!--begin::Wrapper-->                         
                            <div class="d-flex flex-wrap flex-md-nowrap">
                                <!--begin::Items-->                         
                                <div class="me-md-5 w-100">
                                                                       
                                        <!--begin::Item-->                                               
                                        <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                            <!--begin::Block-->                                                                                   
                                            <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
        <span class="svg-icon svg-icon-2qx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
        </svg>
        </span>
        <!--end::Svg Icon-->                        
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
        
                                                <!--begin::Section-->                                                    
                                                <div class="me-2">
                                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Homeworks</a>
                                                    
                                                    <span class="text-gray-400 fw-bold d-block fs-7">Don’t forget to turn in your task</span>
                                                </div>                                         
                                                <!--end::Section-->  
                                            </div>                                         
                                            <!--end::Block-->  
                                            
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">                    
                                                <span class="text-dark fw-bolder fs-2x">423</span> 
        
                                                <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                                    
                                                <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">154</span>                                                           
        
                                                <span class="badge badge-lg badge-light-danger align-self-center px-2">74%</span>                                       
                                            </div>                                  
                                            <!--end::Info-->                                                      
                                        </div>
                                        <!--end::Item-->                         
                                                                       
                                        <!--begin::Item-->                                               
                                        <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                            <!--begin::Block-->                                                                                   
                                            <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
        <span class="svg-icon svg-icon-2qx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.925 3.90078V8.00077L12.025 10.8008V5.10078L15.525 3.10078C16.125 2.80078 16.925 3.20078 16.925 3.90078ZM2.525 13.5008L6.025 15.5008L10.925 12.7008L6.025 9.90078L2.525 11.9008C1.825 12.3008 1.825 13.2008 2.525 13.5008ZM18.025 19.7008V15.6008L13.125 12.8008V18.5008L16.625 20.5008C17.225 20.8008 18.025 20.4008 18.025 19.7008Z" fill="currentColor"></path>
        <path opacity="0.3" d="M8.52499 3.10078L12.025 5.10078V10.8008L7.125 8.00077V3.90078C7.125 3.20078 7.92499 2.80078 8.52499 3.10078ZM7.42499 20.5008L10.925 18.5008V12.8008L6.02499 15.6008V19.7008C6.02499 20.4008 6.82499 20.8008 7.42499 20.5008ZM21.525 11.9008L18.025 9.90078L13.125 12.7008L18.025 15.5008L21.525 13.5008C22.225 13.2008 22.225 12.3008 21.525 11.9008Z" fill="currentColor"></path>
        </svg>
        </span>
        <!--end::Svg Icon-->                        
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
        
                                                <!--begin::Section-->                                                    
                                                <div class="me-2">
                                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Tests</a>
                                                    
                                                    <span class="text-gray-400 fw-bold d-block fs-7">You take 12 subjects at this semester</span>
                                                </div>                                         
                                                <!--end::Section-->  
                                            </div>                                         
                                            <!--end::Block-->  
                                            
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">                    
                                                <span class="text-dark fw-bolder fs-2x">43</span> 
        
                                                <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                                    
                                                <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">53</span>                                                           
        
                                                <span class="badge badge-lg badge-light-info align-self-center px-2">65%</span>                                       
                                            </div>                                  
                                            <!--end::Info-->                                                      
                                        </div>
                                        <!--end::Item-->                         
                                                                       
                                        <!--begin::Item-->                                               
                                        <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                            <!--begin::Block-->                                                                                   
                                            <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
        <span class="svg-icon svg-icon-2qx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="currentColor"></path>
        <path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="currentColor"></path>
        </svg>
        </span>
        <!--end::Svg Icon-->                        
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
        
                                                <!--begin::Section-->                                                    
                                                <div class="me-2">
                                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Attendance</a>
                                                    
                                                    <span class="text-gray-400 fw-bold d-block fs-7">Great, you always attending class. keep it up</span>
                                                </div>                                         
                                                <!--end::Section-->  
                                            </div>                                         
                                            <!--end::Block-->  
                                            
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">                    
                                                <span class="text-dark fw-bolder fs-2x">53</span> 
        
                                                <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                                    
                                                <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">94</span>                                                           
        
                                                <span class="badge badge-lg badge-light-primary align-self-center px-2">87%</span>                                       
                                            </div>                                  
                                            <!--end::Info-->                                                      
                                        </div>
                                        <!--end::Item-->                         
                                                            </div>
                                <!--end::Items--> 
                                
                                <!--begin::Container-->
                                <div class="d-flex justify-content-between flex-column w-225px w-md-600px mx-auto mx-md-0 pt-3 pb-10">
                                    <!--begin::Title-->
                                    <div class="fs-4 fw-bold text-gray-900 text-center mb-5">
                                        Session Attendance <br>
                                        for Current Academic Year    
                                    </div>
                                    <!--end::Title--> 
        
                                    <!--begin::Chart-->
                                    <div id="kt_chart_widgets_22_chart_2" class="mx-auto mb-4"></div>
                                    <!--end::Chart-->
        
                                    <!--begin::Labels-->
                                    <div class="mx-auto">
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-success me-2"></div>
                                            <!--end::Bullet-->
        
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">Precent(133)</div>
                                            <!--end::Label-->                                 
                                        </div>
                                        <!--end::Label-->   
                                        
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-primary me-2"></div>
                                            <!--end::Bullet-->
        
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">Illness(9)</div>
                                            <!--end::Label-->                                 
                                        </div>
                                        <!--end::Label-->   
        
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-info me-2"></div>
                                            <!--end::Bullet-->
        
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">Late(2)</div>
                                            <!--end::Label-->                                 
                                        </div>
                                        <!--end::Label-->   
        
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-danger me-2"></div>
                                            <!--end::Bullet-->
        
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">Absent(3)</div>
                                            <!--end::Label-->                                 
                                        </div>
                                        <!--end::Label-->   
                                    </div>
                                    <!--end::Labels-->                                
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Wrapper-->                    
                        </div>
                        <!--end::Tap pane-->                               
                                 
                </div>
                <!--end::Tab Content-->        
            </div>
            <!--end: Card Body-->
        </div>
<!--end::Chart widget 8-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->



<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-4">       
        
<!--begin::Engage widget 1-->
<div class="card h-xl-100" dir="ltr"> 
    <!--begin::Body-->
    <div class="card-body d-flex flex-column flex-center">  
        <!--begin::Heading-->
        <div class="mb-2">
            <!--begin::Title-->
            <h1 class="fw-semibold text-gray-800 text-center lh-lg">           
                Have you tried <br> new
                <span class="fw-bolder"> Mobile Application ?</span>
            </h1>
            <!--end::Title--> 
            
            <!--begin::Illustration-->
            <div class="py-10 text-center">
                                    <img src="<?php echo $web_root ?>assets/assets/media/svg/illustrations/easy/1.svg" class="theme-light-show w-200px" alt="">
                    <img src="<?php echo $web_root ?>assets/assets/media/svg/illustrations/easy/1-dark.svg" class="theme-dark-show w-200px" alt="">
                            </div>
            <!--end::Illustration-->
        </div>
        <!--end::Heading-->

        <!--begin::Links-->
        <div class="text-center mb-1"> 
            <!--begin::Link-->
            <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_new_card" data-bs-toggle="modal">
                Try now            </a>
            <!--end::Link-->

            <!--begin::Link-->
            <a class="btn btn-sm btn-light" href="/<?php echo $web_root ?>demo19/pages/user-profile/followers.html">
                Learn more            </a>
            <!--end::Link-->
        </div>
        <!--end::Links-->
    </div>
    <!--end::Body-->
</div>
<!--end::Engage widget 1-->

     </div>
    <!--end::Col-->     

    <!--begin::Col-->
    <div class="col-xl-8">
        <!--begin::Timeline Widget 1-->
<div class="card card-flush h-xl-100">
    <!--begin::Card header-->
    <div class="card-header pt-5">
        <!--begin::Card title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Team Schedule</span>

            <span class="text-gray-400 pt-2 fw-semibold fs-6">49 Acual Tasks</span>
        </h3>
        <!--end::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Tabs-->
            <ul class="nav" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active" data-kt-timeline-widget-1="tab" data-bs-toggle="tab" href="#kt_timeline_widget_1_tab_day" aria-selected="true" role="tab">Day</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1" data-kt-timeline-widget-1="tab" data-bs-toggle="tab" href="#kt_timeline_widget_1_tab_week" aria-selected="false" tabindex="-1" role="tab">Week</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1" data-kt-timeline-widget-1="tab" data-bs-toggle="tab" href="#kt_timeline_widget_1_tab_month" aria-selected="false" tabindex="-1" role="tab">Month</a>
                </li>
            </ul>
            <!--end::Tabs-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pb-0">
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane active blockui" id="kt_timeline_widget_1_tab_day" role="tabpanel" aria-labelledby="day-tab" data-kt-timeline-widget-1-blockui="true" style="">
                <div class="table-responsive pb-10">
                    <!--begin::Timeline-->
                    <div id="kt_timeline_widget_1_1" class="vis-timeline-custom h-350px min-w-700px" data-kt-timeline-widget-1-image-root="<?php echo $web_root ?>assets/assets/media/" style="position: relative;"><div class="vis-timeline vis-bottom vis-ltr" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); visibility: visible; height: 354px;"><div class="vis-panel vis-background" style="height: 354px; width: 750px; left: 0px; top: 0px;"></div><div class="vis-panel vis-background vis-vertical" style="height: 354px; width: 624px; left: 128px; top: 0px;"><div class="vis-axis" style="top: 304px; left: 0px;"><div class="vis-group"></div><div class="vis-group"></div><div class="vis-group"></div><div class="vis-group"></div></div><div class="vis-time-axis vis-background"><div class="vis-grid vis-vertical vis-minor vis-h15  vis-today  vis-odd" style="width: 201.333px; height: 330px; transform: translate(-40.8964px, -1px);"></div><div class="vis-grid vis-vertical vis-minor vis-h16  vis-today  vis-even" style="width: 201.333px; height: 330px; transform: translate(160.437px, -1px);"></div><div class="vis-grid vis-vertical vis-minor vis-h17  vis-today  vis-odd" style="width: 201.333px; height: 330px; transform: translate(361.77px, -1px);"></div><div class="vis-grid vis-vertical vis-minor vis-h18  vis-today  vis-even" style="width: 201.333px; height: 330px; transform: translate(563.104px, -1px);"></div></div></div><div class="vis-panel vis-background vis-horizontal" style="height: 305px; width: 750px; left: 0px; top: -1px;"></div><div class="vis-panel vis-center" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); height: 305px; width: 624px; left: 127px; top: -1px;"><div class="vis-content" style="left: 0px; transform: translateY(0px);"><div class="vis-itemset" style="height: 303px;"><div class="vis-background"><div class="vis-group" style="height: 0px;"><div style="visibility: hidden; position: absolute;"></div></div><div class="vis-group" style="height: 75px;"><div style="visibility: hidden; position: absolute;"></div></div><div class="vis-group" style="height: 75px;"><div style="visibility: hidden; position: absolute;"></div></div><div class="vis-group" style="height: 75px;"><div style="visibility: hidden; position: absolute;"></div></div><div class="vis-group" style="height: 78px;"><div style="visibility: hidden; position: absolute;"></div></div></div><div class="vis-foreground"><div class="vis-group" style="height: 75px;"><div class="vis-item vis-range vis-readonly" style="transform: translateX(10px); width: 302px; top: 17.5px;"><div class="vis-item-overflow"><div class="vis-item-content" style="transform: translateX(0px);"><div class="rounded-pill bg-light-primary d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
                    <div class="position-absolute rounded-pill d-block bg-primary start-0 top-0 h-100 z-index-1" style="width:60%;"></div>
        
                    <div class="d-flex align-items-center position-relative z-index-2">
                        <div class="symbol-group symbol-hover flex-nowrap me-3">
                            <div class="symbol symbol-circle symbol-25px"><img alt="" src="<?php echo $web_root ?>assets/assets/media/avatars/300-6.jpg"></div><div class="symbol symbol-circle symbol-25px"><img alt="" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg"></div>
                        </div>
        
                        <a href="#" class="fw-bold text-white text-hover-dark">Meeting</a>
                    </div>
        
                    <div class="d-flex flex-center bg-body rounded-pill fs-7 fw-bolder ms-auto h-100 px-3 position-relative z-index-2">
                        60%
                    </div>
                </div>        
                </div></div><div class="vis-item-visible-frame"></div></div></div><div class="vis-group" style="height: 75px;"><div class="vis-item vis-range vis-readonly" style="transform: translateX(211.333px); width: 201.333px; top: 17.5px;"><div class="vis-item-overflow"><div class="vis-item-content" style="transform: translateX(0px);"><div class="rounded-pill bg-light-success d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
                    <div class="position-absolute rounded-pill d-block bg-success start-0 top-0 h-100 z-index-1" style="width:47%;"></div>
        
                    <div class="d-flex align-items-center position-relative z-index-2">
                        <div class="symbol-group symbol-hover flex-nowrap me-3">
                            <div class="symbol symbol-circle symbol-25px"><img alt="" src="<?php echo $web_root ?>assets/assets/media/avatars/300-2.jpg"></div>
                        </div>
        
                        <a href="#" class="fw-bold text-white text-hover-dark">Testing</a>
                    </div>
        
                    <div class="d-flex flex-center bg-body rounded-pill fs-7 fw-bolder ms-auto h-100 px-3 position-relative z-index-2">
                        47%
                    </div>
                </div>        
                </div></div><div class="vis-item-visible-frame"></div></div></div><div class="vis-group" style="height: 75px;"><div class="vis-item vis-range vis-readonly" style="transform: translateX(110.667px); width: 402.667px; top: 17.5px;"><div class="vis-item-overflow"><div class="vis-item-content" style="transform: translateX(0px);"><div class="rounded-pill bg-light-danger d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
                    <div class="position-absolute rounded-pill d-block bg-danger start-0 top-0 h-100 z-index-1" style="width:55%;"></div>
        
                    <div class="d-flex align-items-center position-relative z-index-2">
                        <div class="symbol-group symbol-hover flex-nowrap me-3">
                            <div class="symbol symbol-circle symbol-25px"><img alt="" src="<?php echo $web_root ?>assets/assets/media/avatars/300-5.jpg"></div><div class="symbol symbol-circle symbol-25px"><img alt="" src="<?php echo $web_root ?>assets/assets/media/avatars/300-20.jpg"></div>
                        </div>
        
                        <a href="#" class="fw-bold text-white text-hover-dark">Landing page</a>
                    </div>
        
                    <div class="d-flex flex-center bg-body rounded-pill fs-7 fw-bolder ms-auto h-100 px-3 position-relative z-index-2">
                        55%
                    </div>
                </div>        
                </div></div><div class="vis-item-visible-frame"></div></div></div><div class="vis-group" style="height: 78px;"><div class="vis-item vis-range vis-readonly" style="transform: translateX(312px); width: 302px; top: 18px;"><div class="vis-item-overflow"><div class="vis-item-content" style="transform: translateX(0px);"><div class="rounded-pill bg-light-info d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
                    <div class="position-absolute rounded-pill d-block bg-info start-0 top-0 h-100 z-index-1" style="width:75%;"></div>
        
                    <div class="d-flex align-items-center position-relative z-index-2">
                        <div class="symbol-group symbol-hover flex-nowrap me-3">
                            <div class="symbol symbol-circle symbol-25px"><img alt="" src="<?php echo $web_root ?>assets/assets/media/avatars/300-23.jpg"></div><div class="symbol symbol-circle symbol-25px"><img alt="" src="<?php echo $web_root ?>assets/assets/media/avatars/300-12.jpg"></div><div class="symbol symbol-circle symbol-25px"><img alt="" src="<?php echo $web_root ?>assets/assets/media/avatars/300-9.jpg"></div>
                        </div>
        
                        <a href="#" class="fw-bold text-white text-hover-dark">Products module</a>
                    </div>
        
                    <div class="d-flex flex-center bg-body rounded-pill fs-7 fw-bolder ms-auto h-100 px-3 position-relative z-index-2">
                        75%
                    </div>
                </div>        
                </div></div><div class="vis-item-visible-frame"></div></div></div></div></div></div><div class="vis-shadow vis-top" style="visibility: hidden;"></div><div class="vis-shadow vis-bottom" style="visibility: hidden;"></div></div><div class="vis-panel vis-left" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); height: 305px; left: 0px; top: -1px;"><div class="vis-content" style="left: 0px; top: 0px;"><div class="vis-labelset"><div class="vis-label vis-group-level-0" title="" style="height: 75px;"><div class="vis-inner">Research</div></div><div class="vis-label vis-group-level-0" title="" style="height: 75px;"><div class="vis-inner">Phase 2.6 QA</div></div><div class="vis-label vis-group-level-0" title="" style="height: 75px;"><div class="vis-inner">UI Design</div></div><div class="vis-label vis-group-level-0" title="" style="height: 78px;"><div class="vis-inner">Development</div></div></div></div><div class="vis-shadow vis-top" style="visibility: hidden;"></div><div class="vis-shadow vis-bottom" style="visibility: hidden;"></div></div><div class="vis-panel vis-right" style="height: 305px; left: 751px; top: -1px;"><div class="vis-content" style="left: 0px; top: 0px;"></div><div class="vis-shadow vis-top" style="visibility: hidden;"></div><div class="vis-shadow vis-bottom" style="visibility: hidden;"></div></div><div class="vis-panel vis-top" style="width: 624px; left: 127px; top: 0px;"></div><div class="vis-panel vis-bottom" style="width: 624px; left: 127px; top: 304px;"><div class="vis-time-axis vis-foreground" style="height: 50px;"><div class="vis-text vis-minor vis-measure" style="position: absolute;">0</div><div class="vis-text vis-major vis-measure" style="position: absolute;">0</div><div class="vis-text vis-minor vis-h15  vis-today  vis-odd" style="transform: translate(-40.3964px, 0px); width: 201.333px;">15:00</div><div class="vis-text vis-minor vis-h16  vis-today  vis-even" style="transform: translate(160.937px, 0px); width: 201.333px;">16:00</div><div class="vis-text vis-minor vis-h17  vis-today  vis-odd" style="transform: translate(362.27px, 0px); width: 201.333px;">17:00</div><div class="vis-text vis-minor vis-h18  vis-today  vis-even" style="transform: translate(563.604px, 0px); width: 201.333px;">18:00</div><div class="vis-text vis-major vis-h18  vis-today  vis-even" style="transform: translate(0px, 25px);"><div>Sat 11 March</div></div></div></div><div class="vis-rolling-mode-btn" style="visibility: hidden;"></div></div></div>
                    <!--end::Timeline-->
                </div>
            </div>
            <!--end::Tab pane-->

            <!--begin::Tab pane-->
            <div class="tab-pane blockui" id="kt_timeline_widget_1_tab_week" role="tabpanel" aria-labelledby="week-tab" data-kt-timeline-widget-1-blockui="true" style="overflow: hidden;">
                <div class="table-responsive pb-10">
                    <!--begin::Timeline-->
                    <div id="kt_timeline_widget_1_2" class="vis-timeline-custom h-350px min-w-700px" data-kt-timeline-widget-1-image-root="<?php echo $web_root ?>assets/assets/media/"></div>
                    <!--end::Timeline-->
                </div>
            <div class="blockui-overlay bg-body" style="z-index: 1;"><span class="spinner-border text-primary"></span></div></div>
            <!--end::Tab pane-->

            <!--begin::Tab pane-->
            <div class="tab-pane blockui" id="kt_timeline_widget_1_tab_month" role="tabpanel" aria-labelledby="month-tab" data-kt-timeline-widget-1-blockui="true" style="overflow: hidden;">
                <div class="table-responsive pb-10">
                    <!--begin::Timeline-->
                    <div id="kt_timeline_widget_1_3" class="vis-timeline-custom h-350px min-w-700px" data-kt-timeline-widget-1-image-root="<?php echo $web_root ?>assets/assets/media/"></div>
                    <!--end::Timeline-->
                </div>
            <div class="blockui-overlay bg-body" style="z-index: 1;"><span class="spinner-border text-primary"></span></div></div>
            <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Timeline Widget 1-->    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
 
 
					</div>
                    














					<!--end::Content-->	
				</div>
				<!--end::Main-->

				<!--begin::Footer-->
<div class="footer py-4 d-flex flex-column flex-md-row align-items-center justify-content-between " id="kt_footer">
	<!--begin::Copyright-->
	<div class="order-2 order-md-1">
		<span class="text-white opacity-75 fw-semibold me-1">2023&copy;</span>
		<a href="#" target="_blank" class="text-white text-hover-primary opacity-75">Santosh Patil</a>
	</div>
	<!--end::Copyright-->

	<!--begin::Menu-->
	<ul class="menu menu-white menu-hover-primary fw-semibold order-1 opacity-75">
		<li class="menu-item"><a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a></li>

		<li class="menu-item"><a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a></li>

		<li class="menu-item"><a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a></li>
	</ul>
	<!--end::Menu-->
</div>
<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Root-->

	<!--begin::Drawers-->
<!--begin::Activities drawer-->
<div 
	id="kt_activities" 
	class="bg-body" 

	data-kt-drawer="true" 
	data-kt-drawer-name="activities" 
	data-kt-drawer-activate="true" 
	data-kt-drawer-overlay="true" 
	data-kt-drawer-width="{default:'300px', 'lg': '900px'}" 
	data-kt-drawer-direction="end" 
	data-kt-drawer-toggle="#kt_activities_toggle" 
	data-kt-drawer-close="#kt_activities_close">

	<div class="card shadow-none border-0 rounded-0">
		<!--begin::Header-->
		<div class="card-header" id="kt_activities_header">
			<h3 class="card-title fw-bold text-dark">Activity Logs</h3>

			<div class="card-toolbar">
				<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->				</button>
			</div>
		</div>
		<!--end::Header-->

		<!--begin::Body-->
		<div class="card-body position-relative" id="kt_activities_body">
			<!--begin::Content-->
			<div id="kt_activities_scroll" 
				class="position-relative scroll-y me-n5 pe-5" 
				
				data-kt-scroll="true" 
				data-kt-scroll-height="auto" 
				data-kt-scroll-wrappers="#kt_activities_body" 
				data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" 
				data-kt-scroll-offset="5px">

				<!--begin::Timeline items-->
				<div class="timeline">				
					<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
        <div class="symbol-label bg-light">
            <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
<span class="svg-icon svg-icon-2 svg-icon-gray-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"/>
<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        </div>
    </div>
    <!--end::Timeline icon-->

    <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n1">
        <!--begin::Timeline heading-->
        <div class="pe-3 mb-5">
            <!--begin::Title-->
            <div class="fs-5 fw-semibold mb-2">There are 2 new tasks for you in “AirPlus Mobile App” project:</div>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="d-flex align-items-center mt-1 fs-6">
                <!--begin::Info-->
                <div class="text-muted me-2 fs-7">Added at 4:23 PM by</div>
                <!--end::Info-->

                <!--begin::User-->
                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
                    <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-14.jpg" alt="img"/>
                </div>  
                <!--end::User--> 
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->

        <!--begin::Timeline details-->
        <div class="overflow-auto pb-5">
            <!--begin::Record-->
            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">  
                <!--begin::Title-->                                   
                <a href="/<?php echo $web_root ?>demo19/apps/projects/project.html" class="fs-5 text-dark text-hover-primary fw-semibold w-375px min-w-200px">Meeting with customer</a>                                  
                <!--end::Title-->

                <!--begin::Label-->
                <div class="min-w-175px pe-2">
                    <span class="badge badge-light text-muted">Application Design</span>
                </div>
                <!--end::Label-->
                
                <!--begin::Users-->
                <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2">
                    <!--begin::User-->
                    <div class="symbol symbol-circle symbol-25px">
                        <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-2.jpg" alt="img"/>
                    </div>
                    <!--end::User-->

                    <!--begin::User-->
                    <div class="symbol symbol-circle symbol-25px">
                        <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-14.jpg" alt="img"/>
                    </div>  
                    <!--end::User-->                                  

                    <!--begin::User-->
                    <div class="symbol symbol-circle symbol-25px">
                        <div class="symbol-label fs-8 fw-semibold bg-primary text-inverse-primary">A</div>
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Users-->                                     

                <!--begin::Progress-->
                <div class="min-w-125px pe-2">
                    <span class="badge badge-light-primary">In Progress</span>
                </div>
                <!--end::Progress-->
                                    
                <!--begin::Action-->
                <a href="/<?php echo $web_root ?>demo19/apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">View</a>    
                <!--end::Action-->                                
            </div>
            <!--end::Record-->

            <!--begin::Record-->
            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-0">  
                <!--begin::Title-->                                   
                <a href="/<?php echo $web_root ?>demo19/apps/projects/project.html" class="fs-5 text-dark text-hover-primary fw-semibold w-375px min-w-200px">Project Delivery Preparation</a>                                  
                <!--end::Title-->

                <!--begin::Label-->
                <div class="min-w-175px">
                    <span class="badge badge-light text-muted">CRM System Development</span>
                </div>
                <!--end::Label-->
                
                <!--begin::Users-->
                <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px">
                    <!--begin::User-->
                    <div class="symbol symbol-circle symbol-25px">
                        <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-20.jpg" alt="img"/>
                    </div>
                    <!--end::User-->                               

                    <!--begin::User-->
                    <div class="symbol symbol-circle symbol-25px">
                        <div class="symbol-label fs-8 fw-semibold bg-success text-inverse-primary">B</div>
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Users-->                                     

                <!--begin::Progress-->
                <div class="min-w-125px">
                    <span class="badge badge-light-success">Completed</span>
                </div>
                <!--end::Progress-->
                                    
                <!--begin::Action-->
                <a href="/<?php echo $web_root ?>demo19/apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">View</a>    
                <!--end::Action-->                                
            </div>
            <!--end::Record-->
        </div>
        <!--end::Timeline details-->
    </div>
    <!--end::Timeline content-->    
</div>
<!--end::Timeline item-->
					<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
        <div class="symbol-label bg-light">
            <!--begin::Svg Icon | path: icons/duotune/communication/com009.svg-->
<span class="svg-icon svg-icon-2 svg-icon-gray-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M5.78001 21.115L3.28001 21.949C3.10897 22.0059 2.92548 22.0141 2.75004 21.9727C2.57461 21.9312 2.41416 21.8418 2.28669 21.7144C2.15923 21.5869 2.06975 21.4264 2.0283 21.251C1.98685 21.0755 1.99507 20.892 2.05201 20.7209L2.886 18.2209L7.22801 13.879L10.128 16.774L5.78001 21.115Z" fill="currentColor"/>
<path d="M21.7 8.08899L15.911 2.30005C15.8161 2.2049 15.7033 2.12939 15.5792 2.07788C15.455 2.02637 15.3219 1.99988 15.1875 1.99988C15.0531 1.99988 14.92 2.02637 14.7958 2.07788C14.6717 2.12939 14.5589 2.2049 14.464 2.30005L13.74 3.02295C13.548 3.21498 13.4402 3.4754 13.4402 3.74695C13.4402 4.01849 13.548 4.27892 13.74 4.47095L14.464 5.19397L11.303 8.35498C10.1615 7.80702 8.87825 7.62639 7.62985 7.83789C6.38145 8.04939 5.2293 8.64265 4.332 9.53601C4.14026 9.72817 4.03256 9.98855 4.03256 10.26C4.03256 10.5315 4.14026 10.7918 4.332 10.984L13.016 19.667C13.208 19.859 13.4684 19.9668 13.74 19.9668C14.0115 19.9668 14.272 19.859 14.464 19.667C15.3575 18.77 15.9509 17.618 16.1624 16.3698C16.374 15.1215 16.1932 13.8383 15.645 12.697L18.806 9.53601L19.529 10.26C19.721 10.452 19.9814 10.5598 20.253 10.5598C20.5245 10.5598 20.785 10.452 20.977 10.26L21.7 9.53601C21.7952 9.44108 21.8706 9.32825 21.9221 9.2041C21.9737 9.07995 22.0002 8.94691 22.0002 8.8125C22.0002 8.67809 21.9737 8.54505 21.9221 8.4209C21.8706 8.29675 21.7952 8.18392 21.7 8.08899Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        </div>
    </div>
    <!--end::Timeline icon-->       

    <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n2">
        <!--begin::Timeline heading-->
        <div class="overflow-auto pe-3">
            <!--begin::Title-->
            <div class="fs-5 fw-semibold mb-2">Invitation for crafting engaging designs that speak human workshop</div>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="d-flex align-items-center mt-1 fs-6">
                <!--begin::Info-->
                <div class="text-muted me-2 fs-7">Sent at 4:23 PM by</div>
                <!--end::Info-->

                <!--begin::User-->
                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Alan Nilson">
                    <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg" alt="img"/>
                </div>  
                <!--end::User--> 
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->
    </div>
    <!--end::Timeline content--> 
</div>
<!--end::Timeline item-->
					<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
        <div class="symbol-label bg-light">
            <!--begin::Svg Icon | path: icons/duotune/coding/cod008.svg-->
<span class="svg-icon svg-icon-2 svg-icon-gray-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.2166 8.50002L10.5166 7.80007C10.1166 7.40007 10.1166 6.80005 10.5166 6.40005L13.4166 3.50002C15.5166 1.40002 18.9166 1.50005 20.8166 3.90005C22.5166 5.90005 22.2166 8.90007 20.3166 10.8001L17.5166 13.6C17.1166 14 16.5166 14 16.1166 13.6L15.4166 12.9C15.0166 12.5 15.0166 11.9 15.4166 11.5L18.3166 8.6C19.2166 7.7 19.1166 6.30002 18.0166 5.50002C17.2166 4.90002 16.0166 5.10007 15.3166 5.80007L12.4166 8.69997C12.2166 8.89997 11.6166 8.90002 11.2166 8.50002ZM11.2166 15.6L8.51659 18.3001C7.81659 19.0001 6.71658 19.2 5.81658 18.6C4.81658 17.9 4.71659 16.4 5.51659 15.5L8.31658 12.7C8.71658 12.3 8.71658 11.7001 8.31658 11.3001L7.6166 10.6C7.2166 10.2 6.6166 10.2 6.2166 10.6L3.6166 13.2C1.7166 15.1 1.4166 18.1 3.1166 20.1C5.0166 22.4 8.51659 22.5 10.5166 20.5L13.3166 17.7C13.7166 17.3 13.7166 16.7001 13.3166 16.3001L12.6166 15.6C12.3166 15.2 11.6166 15.2 11.2166 15.6Z" fill="currentColor"/>
<path opacity="0.3" d="M5.0166 9L2.81659 8.40002C2.31659 8.30002 2.0166 7.79995 2.1166 7.19995L2.31659 5.90002C2.41659 5.20002 3.21659 4.89995 3.81659 5.19995L6.0166 6.40002C6.4166 6.60002 6.6166 7.09998 6.5166 7.59998L6.31659 8.30005C6.11659 8.80005 5.5166 9.1 5.0166 9ZM8.41659 5.69995H8.6166C9.1166 5.69995 9.5166 5.30005 9.5166 4.80005L9.6166 3.09998C9.6166 2.49998 9.2166 2 8.5166 2H7.81659C7.21659 2 6.71659 2.59995 6.91659 3.19995L7.31659 4.90002C7.41659 5.40002 7.91659 5.69995 8.41659 5.69995ZM14.6166 18.2L15.1166 21.3C15.2166 21.8 15.7166 22.2 16.2166 22L17.6166 21.6C18.1166 21.4 18.4166 20.8 18.1166 20.3L16.7166 17.5C16.5166 17.1 16.1166 16.9 15.7166 17L15.2166 17.1C14.8166 17.3 14.5166 17.7 14.6166 18.2ZM18.4166 16.3L19.8166 17.2C20.2166 17.5 20.8166 17.3 21.0166 16.8L21.3166 15.9C21.5166 15.4 21.1166 14.8 20.5166 14.8H18.8166C18.0166 14.8 17.7166 15.9 18.4166 16.3Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        </div>
    </div>
    <!--end::Timeline icon-->

    <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n1">
        <!--begin::Timeline heading-->
        <div class="mb-5 pe-3">
            <!--begin::Title-->
            <a href="#" class="fs-5 fw-semibold text-gray-800 text-hover-primary mb-2">3 New Incoming Project Files:</a>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="d-flex align-items-center mt-1 fs-6">
                <!--begin::Info-->
                <div class="text-muted me-2 fs-7">Sent at 10:30 PM by</div>
                <!--end::Info-->

                <!--begin::User-->
                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Jan Hummer">
                    <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-23.jpg" alt="img"/>
                </div>  
                <!--end::User--> 
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->

        <!--begin::Timeline details-->
        <div class="overflow-auto pb-5">
            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
                <!--begin::Item-->
                <div class="d-flex flex-aligns-center pe-10 pe-lg-20">  
                    <!--begin::Icon-->                                  
                    <img alt="" class="w-30px me-3" src="<?php echo $web_root ?>assets/assets/media/svg/files/pdf.svg"/>
                    <!--end::Icon--> 

                    <!--begin::Info--> 
                    <div class="ms-1 fw-semibold">
                        <!--begin::Desc--> 
                        <a href="/<?php echo $web_root ?>demo19/apps/projects/project.html" class="fs-6 text-hover-primary fw-bold">Finance KPI App Guidelines</a>
                        <!--end::Desc--> 

                        <!--begin::Number--> 
                        <div class="text-gray-400">1.9mb</div>
                        <!--end::Number--> 
                    </div>
                    <!--begin::Info--> 
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="d-flex flex-aligns-center pe-10 pe-lg-20">   
                    <!--begin::Icon-->                                  
                    <img alt="/<?php echo $web_root ?>demo19/apps/projects/project.html" class="w-30px me-3" src="<?php echo $web_root ?>assets/assets/media/svg/files/doc.svg"/>
                    <!--end::Icon--> 

                    <!--begin::Info--> 
                    <div class="ms-1 fw-semibold">
                        <!--begin::Desc--> 
                        <a href="#" class="fs-6 text-hover-primary fw-bold">Client UAT Testing Results</a>
                        <!--end::Desc--> 

                        <!--begin::Number--> 
                        <div class="text-gray-400">18kb</div>
                        <!--end::Number--> 
                    </div>
                    <!--end::Info--> 
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="d-flex flex-aligns-center">   
                    <!--begin::Icon-->                                  
                    <img alt="/<?php echo $web_root ?>demo19/apps/projects/project.html" class="w-30px me-3" src="<?php echo $web_root ?>assets/assets/media/svg/files/css.svg"/>
                    <!--end::Icon--> 

                    <!--begin::Info--> 
                    <div class="ms-1 fw-semibold">
                        <!--begin::Desc--> 
                        <a href="#" class="fs-6 text-hover-primary fw-bold">Finance Reports</a>
                        <!--end::Desc--> 

                        <!--begin::Number--> 
                        <div class="text-gray-400">20mb</div>
                        <!--end::Number--> 
                    </div>
                    <!--end::Icon--> 
                </div>
                <!--end::Item-->
            </div>
        </div>
        <!--end::Timeline details-->
    </div>
    <!--end::Timeline content-->    
</div>
<!--end::Timeline item-->
					<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
        <div class="symbol-label bg-light">
            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
<span class="svg-icon svg-icon-2 svg-icon-gray-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"/>
<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        </div>
    </div>
    <!--end::Timeline icon-->

        <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n1">
        <!--begin::Timeline heading-->
        <div class="pe-3 mb-5">
            <!--begin::Title-->
            <div class="fs-5 fw-semibold mb-2">
                Task <a href="#" class="text-primary fw-bold me-1">#45890</a>  
                merged with <a href="#" class="text-primary fw-bold me-1">#45890</a>  in “Ads Pro Admin Dashboard project:
            </div>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="d-flex align-items-center mt-1 fs-6">
                <!--begin::Info-->
                <div class="text-muted me-2 fs-7">Initiated at 4:23 PM by</div>
                <!--end::Info-->

                <!--begin::User-->
                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
                    <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-14.jpg" alt="img"/>
                </div>  
                <!--end::User--> 
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->
    </div>
    <!--end::Timeline content-->    
</div>
<!--end::Timeline item-->
					<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
        <div class="symbol-label bg-light">
            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
<span class="svg-icon svg-icon-2 svg-icon-gray-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/>
<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        </div>
    </div>
    <!--end::Timeline icon-->

    <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n1">
        <!--begin::Timeline heading-->
        <div class="pe-3 mb-5">
            <!--begin::Title-->
            <div class="fs-5 fw-semibold mb-2">3 new application design concepts added:</div>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="d-flex align-items-center mt-1 fs-6">
                <!--begin::Info-->
                <div class="text-muted me-2 fs-7">Created at 4:23 PM by</div>
                <!--end::Info-->

                <!--begin::User-->
                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Marcus Dotson">
                    <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-2.jpg" alt="img"/>
                </div>  
                <!--end::User--> 
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->

        <!--begin::Timeline details-->
        <div class="overflow-auto pb-5">
            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-7">
                <!--begin::Item-->
                <div class="overlay me-10">  
                    <!--begin::Image-->                                      
                    <div class="overlay-wrapper">
                        <img alt="img" class="rounded w-150px" src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-29.jpg"/>  
                    </div>
                    <!--end::Image-->

                    <!--begin::Link-->
                    <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                        <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>                                         
                    </div>   
                    <!--end::Link-->                                     
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="overlay me-10">   
                    <!--begin::Image-->                                     
                    <div class="overlay-wrapper">
                        <img alt="img" class="rounded w-150px" src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-31.jpg"/> 
                    </div>
                    <!--end::Image-->

                    <!--begin::Link-->
                    <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                        <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>                                         
                    </div>        
                    <!--end::Link-->                                
                </div>
                <!--end::Item-->                        
                
                <!--begin::Item-->
                <div class="overlay">   
                    <!--begin::Image-->                                     
                    <div class="overlay-wrapper">
                        <img alt="img" class="rounded w-150px" src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-40.jpg"/>
                    </div>
                    <!--end::Image-->

                    <!--begin::Link-->
                    <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                        <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>                                         
                    </div>   
                    <!--end::Link-->                                     
                </div>
                <!--end::Item-->
            </div>
        </div>
        <!--end::Timeline details-->
    </div>
    <!--end::Timeline content-->  
</div>
<!--end::Timeline item-->					
					<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
        <div class="symbol-label bg-light">
            <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
<span class="svg-icon svg-icon-2 svg-icon-gray-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="currentColor"/>
<path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        </div>
    </div>
    <!--end::Timeline icon-->

    <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n1">
        <!--begin::Timeline heading-->
        <div class="pe-3 mb-5">
            <!--begin::Title-->
            <div class="fs-5 fw-semibold mb-2">
                New case <a href="#" class="text-primary fw-bold me-1">#67890</a> 
                is assigned to you in Multi-platform Database Design project
            </div>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="overflow-auto pb-5">
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center mt-1 fs-6">
                    <!--begin::Info-->
                    <div class="text-muted me-2 fs-7">Added at 4:23 PM by</div>
                    <!--end::Info-->

                    <!--begin::User-->
                    <a href="#" class="text-primary fw-bold me-1">Alice Tan</a>
                    <!--end::User--> 
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->
    </div>
    <!--end::Timeline content-->           
</div>
<!--end::Timeline item-->
					<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
        <div class="symbol-label bg-light">
            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
<span class="svg-icon svg-icon-2 svg-icon-gray-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/>
<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        </div>
    </div>
    <!--end::Timeline icon-->

    <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n1">
        <!--begin::Timeline heading-->
        <div class="pe-3 mb-5">
            <!--begin::Title-->
            <div class="fs-5 fw-semibold mb-2">You have received a new order:</div>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="d-flex align-items-center mt-1 fs-6">
                <!--begin::Info-->
                <div class="text-muted me-2 fs-7">Placed at 5:05 AM by</div>
                <!--end::Info-->

                <!--begin::User-->
                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Robert Rich">
                    <img src="<?php echo $web_root ?>assets/assets/media/avatars/300-4.jpg" alt="img"/>
                </div>  
                <!--end::User--> 
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->

        <!--begin::Timeline details-->
        <div class="overflow-auto pb-5">
            
<!--begin::Notice-->
<div class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">
            <!--begin::Icon-->
        <!--begin::Svg Icon | path: icons/duotune/coding/cod004.svg-->
<span class="svg-icon svg-icon-2tx svg-icon-primary me-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M19.0687 17.9688H11.0687C10.4687 17.9688 10.0687 18.3687 10.0687 18.9688V19.9688C10.0687 20.5687 10.4687 20.9688 11.0687 20.9688H19.0687C19.6687 20.9688 20.0687 20.5687 20.0687 19.9688V18.9688C20.0687 18.3687 19.6687 17.9688 19.0687 17.9688Z" fill="currentColor"/>
<path d="M4.06875 17.9688C3.86875 17.9688 3.66874 17.8688 3.46874 17.7688C2.96874 17.4688 2.86875 16.8688 3.16875 16.3688L6.76874 10.9688L3.16875 5.56876C2.86875 5.06876 2.96874 4.46873 3.46874 4.16873C3.96874 3.86873 4.56875 3.96878 4.86875 4.46878L8.86875 10.4688C9.06875 10.7688 9.06875 11.2688 8.86875 11.5688L4.86875 17.5688C4.66875 17.7688 4.36875 17.9688 4.06875 17.9688Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        <!--end::Icon-->
    
    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                    <!--begin::Content-->
            <div class="mb-3 mb-md-0 fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">Database Backup Process Completed!</h4>
                
                                    <div class="fs-6 text-gray-700 pe-7">Login into Admin Dashboard to make sure the data integrity is OK</div>
                            </div>
            <!--end::Content-->
        
                    <!--begin::Action-->
            <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap"  > 
                Proceed            </a>
            <!--end::Action-->
            </div>
    <!--end::Wrapper-->  
</div>
<!--end::Notice-->
                
        </div>
        <!--end::Timeline details-->
    </div>
    <!--end::Timeline content-->   
</div>
<!--end::Timeline item-->
					<!--begin::Timeline item-->
<div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px"></div>
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
        <div class="symbol-label bg-light">
            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
<span class="svg-icon svg-icon-2 svg-icon-gray-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor"/>
<path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor"/>
<path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->        </div>
    </div>
    <!--end::Timeline icon-->

    <!--begin::Timeline content-->
    <div class="timeline-content mt-n1">
        <!--begin::Timeline heading-->
        <div class="pe-3 mb-5">
            <!--begin::Title-->
            <div class="fs-5 fw-semibold mb-2">
                New order <a href="#" class="text-primary fw-bold me-1">#67890</a> 
                is placed for Workshow Planning & Budget Estimation
            </div>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="d-flex align-items-center mt-1 fs-6">
                <!--begin::Info-->
                <div class="text-muted me-2 fs-7">Placed at 4:23 PM by</div>
                <!--end::Info-->

                <!--begin::User-->
                <a href="#" class="text-primary fw-bold me-1">Jimmy Bold</a>
                <!--end::User--> 
            </div>
            <!--end::Description-->
        </div>
        <!--end::Timeline heading-->
    </div>
    <!--end::Timeline content--> 
</div>
<!--end::Timeline item--> 				</div>
				<!--end::Timeline items-->				 
			</div>
			<!--end::Content-->
		</div>
		<!--end::Body-->

		<!--begin::Footer-->
		<div class="card-footer py-5 text-center" id="kt_activities_footer">
			<a href="/<?php echo $web_root ?>demo19/pages/user-profile/activity.html" class="btn btn-bg-body text-primary">
				View All Activities <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-3 svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->			</a>
		</div>
		<!--end::Footer-->
	</div>
</div>
<!--end::Activities drawer-->		

<!--begin::Chat drawer-->
<div 
    id="kt_drawer_chat"

    class="bg-body"
    data-kt-drawer="true" 
	data-kt-drawer-name="chat" 
	data-kt-drawer-activate="true" 
	data-kt-drawer-overlay="true" 
	data-kt-drawer-width="{default:'300px', 'md': '500px'}" 
	data-kt-drawer-direction="end" 
	data-kt-drawer-toggle="#kt_drawer_chat_toggle" 
	data-kt-drawer-close="#kt_drawer_chat_close">

    <!--begin::Messenger-->
    <div class="card w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">
        <!--begin::Card header-->
        <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
            <!--begin::Title-->
            <div class="card-title">
                <!--begin::User-->
                <div class="d-flex justify-content-center flex-column me-3">
                    <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Brian Cox</a>

                    <!--begin::Info-->
                    <div class="mb-0 lh-1">
                        <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                        <span class="fs-7 fw-semibold text-muted">Active</span>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->
            </div>
            <!--end::Title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Menu-->
                <div class="me-2">
                    <button class="btn btn-sm btn-icon btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="bi bi-three-dots fs-3"></i>
                    </button>
                    
<!--begin::Menu 3-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
    <!--begin::Heading-->
    <div class="menu-item px-3">
        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
            Contacts
        </div>
    </div>
    <!--end::Heading-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3"  data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">
            Add Contact
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link flex-stack px-3"  data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
            Invite Contacts

            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a contact email to send an invitation"></i>
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
        <a href="#" class="menu-link px-3">
            <span class="menu-title">Groups</span>
            <span class="menu-arrow"></span>
        </a>

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-dropdown w-175px py-4">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">
                    Create Group
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">
                    Invite Members
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->            
            <div class="menu-item px-3">
                <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">
                    Settings
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3 my-1">
        <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">
            Settings
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::Menu 3-->
                </div>
                <!--end::Menu-->

                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body" id="kt_drawer_chat_messenger_body">
            <!--begin::Messages-->
            <div 
                class="scroll-y me-n5 pe-5"

                data-kt-element="messages"

                data-kt-scroll="true"     
                data-kt-scroll-activate="true"
                data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer"
                data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body"       
                data-kt-scroll-offset="0px">

                
    
    <!--begin::Message(in)-->
    <div class="d-flex justify-content-start mb-10 " >
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-start">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg"/></div><!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="ms-3">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                        <span class="text-muted fs-7 mb-1">2 mins</span>
                    </div>
                    <!--end::Details-->
                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                How likely are you to recommend our company to your friends and family ?            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(in)-->
    
    <!--begin::Message(out)-->
    <div class="d-flex justify-content-end mb-10 " >
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-end">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                    <div class="me-3">
                        <span class="text-muted fs-7 mb-1">5 mins</span>
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>  
                    </div>
                    <!--end::Details-->

                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg"/></div><!--end::Avatar-->                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">
                Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(out)-->
    
    <!--begin::Message(in)-->
    <div class="d-flex justify-content-start mb-10 " >
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-start">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg"/></div><!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="ms-3">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                        <span class="text-muted fs-7 mb-1">1 Hour</span>
                    </div>
                    <!--end::Details-->
                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                Ok, Understood!            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(in)-->
    
    <!--begin::Message(out)-->
    <div class="d-flex justify-content-end mb-10 " >
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-end">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                    <div class="me-3">
                        <span class="text-muted fs-7 mb-1">2 Hours</span>
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>  
                    </div>
                    <!--end::Details-->

                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg"/></div><!--end::Avatar-->                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">
                You’ll receive notifications for all issues, pull requests!            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(out)-->
    
    <!--begin::Message(in)-->
    <div class="d-flex justify-content-start mb-10 " >
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-start">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg"/></div><!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="ms-3">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                        <span class="text-muted fs-7 mb-1">3 Hours</span>
                    </div>
                    <!--end::Details-->
                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                You can unwatch this repository immediately by clicking here: <a href="https://keenthemes.com">Keenthemes.com</a>            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(in)-->
    
    <!--begin::Message(out)-->
    <div class="d-flex justify-content-end mb-10 " >
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-end">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                    <div class="me-3">
                        <span class="text-muted fs-7 mb-1">4 Hours</span>
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>  
                    </div>
                    <!--end::Details-->

                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg"/></div><!--end::Avatar-->                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">
                Most purchased Business courses during this sale!            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(out)-->
    
    <!--begin::Message(in)-->
    <div class="d-flex justify-content-start mb-10 " >
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-start">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg"/></div><!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="ms-3">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                        <span class="text-muted fs-7 mb-1">5 Hours</span>
                    </div>
                    <!--end::Details-->
                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                Company BBQ to celebrate the last quater achievements and goals. Food and drinks provided            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(in)-->
    
    <!--begin::Message(template for out)-->
    <div class="d-flex justify-content-end mb-10 d-none" data-kt-element="template-out">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-end">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                    <div class="me-3">
                        <span class="text-muted fs-7 mb-1">Just now</span>
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>  
                    </div>
                    <!--end::Details-->

                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg"/></div><!--end::Avatar-->                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">
                            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(template for out)-->
    
    <!--begin::Message(template for in)-->
    <div class="d-flex justify-content-start mb-10 d-none" data-kt-element="template-in">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-start">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar--><div class="symbol  symbol-35px symbol-circle "><img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg"/></div><!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="ms-3">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                        <span class="text-muted fs-7 mb-1">Just now</span>
                    </div>
                    <!--end::Details-->
                 
            </div>
            <!--end::User-->

            <!--begin::Text-->
            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                Right before vacation season we have the next Big Deal for you.            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Message(template for in)-->
            </div>
            <!--end::Messages-->
        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
            <!--begin::Input-->
            <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message">
                
            </textarea>
            <!--end::Input-->

            <!--begin:Toolbar-->
            <div class="d-flex flex-stack">
                <!--begin::Actions-->
                <div class="d-flex align-items-center me-2">
                    <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon"><i class="bi bi-paperclip fs-3"></i></button>
                    <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon"><i class="bi bi-upload fs-3"></i></button>
                </div>
                <!--end::Actions-->

                <!--begin::Send-->
                <button class="btn btn-primary" type="button" data-kt-element="send">Send</button>
                <!--end::Send-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card footer-->
    </div>
    <!--end::Messenger-->
</div>
<!--end::Chat drawer--> 

<!--begin::Chat drawer-->
<div 
    id="kt_shopping_cart"

    class="bg-body"
    data-kt-drawer="true" 
	data-kt-drawer-name="cart" 
	data-kt-drawer-activate="true" 
	data-kt-drawer-overlay="true" 
	data-kt-drawer-width="{default:'300px', 'md': '500px'}" 
	data-kt-drawer-direction="end" 
	data-kt-drawer-toggle="#kt_drawer_shopping_cart_toggle" 
	data-kt-drawer-close="#kt_drawer_shopping_cart_close">

    <!--begin::Messenger-->
    <div class="card card-flush w-100 rounded-0">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Title-->
            <h3 class="card-title text-gray-900 fw-bold">Shopping Cart</h3>
            <!--end::Title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_shopping_cart_close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body hover-scroll-overlay-y h-400px pt-5">
                            
                <!--begin::Item-->
                <div class="d-flex flex-stack">                 
                    <!--begin::Wrapper-->                                  
                    <div class="d-flex flex-column me-3">
                        <!--begin::Section-->                                  
                        <div class="mb-3">
                            <a href="/<?php echo $web_root ?>demo19/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">Iblender</a>
                            
                            <span class="text-gray-400 fw-semibold d-block">The best kitchen gadget in 2022</span>
                        </div>                   
                        <!--end::Section-->                    
                             
                        <!--begin::Section-->      
                        <div class="d-flex align-items-center">
                            <span class="fw-bold text-gray-800 fs-5">$ 350</span>
                            <span class="text-muted mx-2">for</span>
                            <span class="fw-bold text-gray-800 fs-5 me-3">5</span>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr090.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>
                        </div>                          
                        <!--end::Wrapper--> 
                    </div>                   
                    <!--end::Wrapper-->                    

                    <!--begin::Pic--> 
                    <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                        <img src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-1.jpg" alt=""/>   
                    </div>                                       
                    <!--end::Pic-->            
                </div>
                <!--end::Item-->

                                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                 
                            
                <!--begin::Item-->
                <div class="d-flex flex-stack">                 
                    <!--begin::Wrapper-->                                  
                    <div class="d-flex flex-column me-3">
                        <!--begin::Section-->                                  
                        <div class="mb-3">
                            <a href="/<?php echo $web_root ?>demo19/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">SmartCleaner</a>
                            
                            <span class="text-gray-400 fw-semibold d-block">Smart tool for cooking</span>
                        </div>                   
                        <!--end::Section-->                    
                             
                        <!--begin::Section-->      
                        <div class="d-flex align-items-center">
                            <span class="fw-bold text-gray-800 fs-5">$ 650</span>
                            <span class="text-muted mx-2">for</span>
                            <span class="fw-bold text-gray-800 fs-5 me-3">4</span>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr090.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>
                        </div>                          
                        <!--end::Wrapper--> 
                    </div>                   
                    <!--end::Wrapper-->                    

                    <!--begin::Pic--> 
                    <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                        <img src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-3.jpg" alt=""/>   
                    </div>                                       
                    <!--end::Pic-->            
                </div>
                <!--end::Item-->

                                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                 
                            
                <!--begin::Item-->
                <div class="d-flex flex-stack">                 
                    <!--begin::Wrapper-->                                  
                    <div class="d-flex flex-column me-3">
                        <!--begin::Section-->                                  
                        <div class="mb-3">
                            <a href="/<?php echo $web_root ?>demo19/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">CameraMaxr</a>
                            
                            <span class="text-gray-400 fw-semibold d-block">Professional camera for edge</span>
                        </div>                   
                        <!--end::Section-->                    
                             
                        <!--begin::Section-->      
                        <div class="d-flex align-items-center">
                            <span class="fw-bold text-gray-800 fs-5">$ 150</span>
                            <span class="text-muted mx-2">for</span>
                            <span class="fw-bold text-gray-800 fs-5 me-3">3</span>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr090.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>
                        </div>                          
                        <!--end::Wrapper--> 
                    </div>                   
                    <!--end::Wrapper-->                    

                    <!--begin::Pic--> 
                    <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                        <img src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-8.jpg" alt=""/>   
                    </div>                                       
                    <!--end::Pic-->            
                </div>
                <!--end::Item-->

                                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                 
                            
                <!--begin::Item-->
                <div class="d-flex flex-stack">                 
                    <!--begin::Wrapper-->                                  
                    <div class="d-flex flex-column me-3">
                        <!--begin::Section-->                                  
                        <div class="mb-3">
                            <a href="/<?php echo $web_root ?>demo19/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">$D Printer</a>
                            
                            <span class="text-gray-400 fw-semibold d-block">Manfactoring unique objekts</span>
                        </div>                   
                        <!--end::Section-->                    
                             
                        <!--begin::Section-->      
                        <div class="d-flex align-items-center">
                            <span class="fw-bold text-gray-800 fs-5">$ 1450</span>
                            <span class="text-muted mx-2">for</span>
                            <span class="fw-bold text-gray-800 fs-5 me-3">7</span>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr090.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>
                        </div>                          
                        <!--end::Wrapper--> 
                    </div>                   
                    <!--end::Wrapper-->                    

                    <!--begin::Pic--> 
                    <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                        <img src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-26.jpg" alt=""/>   
                    </div>                                       
                    <!--end::Pic-->            
                </div>
                <!--end::Item-->

                                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                 
                            
                <!--begin::Item-->
                <div class="d-flex flex-stack">                 
                    <!--begin::Wrapper-->                                  
                    <div class="d-flex flex-column me-3">
                        <!--begin::Section-->                                  
                        <div class="mb-3">
                            <a href="/<?php echo $web_root ?>demo19/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">MotionWire</a>
                            
                            <span class="text-gray-400 fw-semibold d-block">Perfect animation tool</span>
                        </div>                   
                        <!--end::Section-->                    
                             
                        <!--begin::Section-->      
                        <div class="d-flex align-items-center">
                            <span class="fw-bold text-gray-800 fs-5">$ 650</span>
                            <span class="text-muted mx-2">for</span>
                            <span class="fw-bold text-gray-800 fs-5 me-3">7</span>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr090.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>
                        </div>                          
                        <!--end::Wrapper--> 
                    </div>                   
                    <!--end::Wrapper-->                    

                    <!--begin::Pic--> 
                    <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                        <img src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-21.jpg" alt=""/>   
                    </div>                                       
                    <!--end::Pic-->            
                </div>
                <!--end::Item-->

                                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                 
                            
                <!--begin::Item-->
                <div class="d-flex flex-stack">                 
                    <!--begin::Wrapper-->                                  
                    <div class="d-flex flex-column me-3">
                        <!--begin::Section-->                                  
                        <div class="mb-3">
                            <a href="/<?php echo $web_root ?>demo19/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">Samsung</a>
                            
                            <span class="text-gray-400 fw-semibold d-block">Profile info,Timeline etc</span>
                        </div>                   
                        <!--end::Section-->                    
                             
                        <!--begin::Section-->      
                        <div class="d-flex align-items-center">
                            <span class="fw-bold text-gray-800 fs-5">$ 720</span>
                            <span class="text-muted mx-2">for</span>
                            <span class="fw-bold text-gray-800 fs-5 me-3">6</span>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr090.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>
                        </div>                          
                        <!--end::Wrapper--> 
                    </div>                   
                    <!--end::Wrapper-->                    

                    <!--begin::Pic--> 
                    <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                        <img src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-34.jpg" alt=""/>   
                    </div>                                       
                    <!--end::Pic-->            
                </div>
                <!--end::Item-->

                                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                 
                            
                <!--begin::Item-->
                <div class="d-flex flex-stack">                 
                    <!--begin::Wrapper-->                                  
                    <div class="d-flex flex-column me-3">
                        <!--begin::Section-->                                  
                        <div class="mb-3">
                            <a href="/<?php echo $web_root ?>demo19/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">$D Printer</a>
                            
                            <span class="text-gray-400 fw-semibold d-block">Manfactoring unique objekts</span>
                        </div>                   
                        <!--end::Section-->                    
                             
                        <!--begin::Section-->      
                        <div class="d-flex align-items-center">
                            <span class="fw-bold text-gray-800 fs-5">$ 430</span>
                            <span class="text-muted mx-2">for</span>
                            <span class="fw-bold text-gray-800 fs-5 me-3">8</span>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr090.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>

                            <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
<span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->                            </a>
                        </div>                          
                        <!--end::Wrapper--> 
                    </div>                   
                    <!--end::Wrapper-->                    

                    <!--begin::Pic--> 
                    <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                        <img src="<?php echo $web_root ?>assets/assets/media/stock/600x400/img-27.jpg" alt=""/>   
                    </div>                                       
                    <!--end::Pic-->            
                </div>
                <!--end::Item-->

                 
              
        </div>
        <!--end::Card body--> 

        <!--begin::Card footer-->
        <div class="card-footer">
            <!--begin::Item-->      
            <div class="d-flex flex-stack">
                <span class="fw-bold text-gray-600">Total</span>
                <span class="text-gray-800 fw-bolder fs-5">$ 1840.00</span>                
            </div>                          
            <!--end::Item--> 

            <!--begin::Item-->      
            <div class="d-flex flex-stack">
                <span class="fw-bold text-gray-600">Sub total</span>
                <span class="text-primary fw-bolder fs-5">$ 246.35</span>                
            </div>                          
            <!--end::Item--> 

            <!--end::Action-->
            <div class="d-flex justify-content-end mt-9">
                <a href="#" class="btn btn-primary d-flex justify-content-end">Pleace Order</a>
            </div>
            <!--end::Action-->
        </div>
        <!--end::Card footer--> 
    </div>
    <!--end::Messenger-->
</div>
<!--end::Chat drawer--> 
<!--end::Drawers--><!--end::Main-->

	

		<!--begin::Engage modals-->
					<!--begin::Modal - Sitemap-->
<div class="modal fade bg-dark bg-opacity-75" id="kt_app_engage_prebuilts_modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-fullscreen p-5 p-lg-10" id="kt_engage_prebuilts_modal_dialog">
        <!--begin::Modal content-->
        <div class="modal-content rounded-4">
            <!--begin::Modal header-->
            <div class="modal-header flex-stack border-0 px-10 pt-5 pb-0" id="kt_engage_prebuilts_header">
                <!--begin::View menu-->
<div id="kt_app_engage_prebuilts_view_menu" class="position-relative z-index-1">
	<!--begin::Toggle-->
	<button type="button" data-kt-element="selected" class="btn btn-flex px-0 rotate-" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, -1px">
		<!--begin::Title-->
		<span class="fs-6 fw-bold text-gray-600 me-2" data-kt-element="title">
			Image View
		</span>
		<!--end::Title-->

		<!--begin::Arrow-->
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
<span class="svg-icon svg-icon-4 svg-icon-gray-600 rotate-180-"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->		<!--end::Arrow-->
	</button>
	<!--end::Toggle-->

	<!--begin::Menu-->
	<div class="menu menu-sub menu-sub-dropdown menu-column menu-active-bg menu-state-primary menu-gray-600 menu-rounded w-150px py-3 px-3" data-kt-menu="true">
		<!--begin::Menu item-->
		<div class="menu-item">
			<!--begin::Menu link-->
			<a href="#" class="menu-link px-4 py-2 active" data-kt-mode="image">
				Image View
			</a>
			<!--end::Menu link-->
		</div>
		<!--end::Menu item-->

		<!--begin::Menu item-->
		<div class="menu-item">
			<!--begin::Menu link-->
			<a href="#" class="menu-link px-4 py-2" data-kt-mode="text">
				Text View
			</a>
			<!--end::Menu link-->
		</div>
		<!--end::Menu item-->
	</div>
	<!--end::Menu-->
</div>
<!--end::View menu-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary me-n2 position-relative z-index-1" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen034.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body pt-0 pb-5 px-15 mt-n5" id="kt_app_engage_prebuilts_body">
                <div class="container-fluid">
                    
<style>
	.app-prebuilts-thumbnail {
		border: 1px solid var(--kt-body-bg);
		filter: drop-shadow(0px 0px 50px rgba(49, 52, 122, 0.12));
	}
</style>

<!--begin::Image view-->
<div class="d-block" id="kt_app_engage_prebuilts_view_image">
	<!--begin::Tabs wrapper-->
	<div class="d-flex flex-center" id="kt_app_engage_prebuilts_view_image_tabs">
		<!--begin::Tabs-->
		<ul class="nav nav-tabs border-0 mb-5">
							<!--begin::Tab item-->
				<li class="nav-item px-2">
					<!--begin::Tab link-->
					<a 
						class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-gray-800 fs-5 fw-bold 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_demos">
						
						Layouts					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item px-2">
					<!--begin::Tab link-->
					<a 
						class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-gray-800 fs-5 fw-bold 
						active" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_dashboards">
						
						Dashboards					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item px-2">
					<!--begin::Tab link-->
					<a 
						class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-gray-800 fs-5 fw-bold 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages">
						
						Pages					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item px-2">
					<!--begin::Tab link-->
					<a 
						class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-gray-800 fs-5 fw-bold 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_apps">
						
						Apps					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
					</ul>
		<!--end::Tabs-->
	</div>
	<!--end::Tabs wrapper-->

	<!--begin::Tab content-->
	<div class="tab-content">
								<div class="pt-5 tab-pane fade " id="kt_app_engage_prebuilts_tab_demos" role="tabpanel">
				<!--begin::Scroll wrapper-->
				<div 
					class="hover-scroll-y pe-12 me-n12" 
					data-kt-scroll="true" 
					data-kt-scroll-height="auto" 
					data-kt-scroll-wrappers="#kt_app_engage_prebuilts_modal, #kt_app_engage_prebuilts_modal_dialog, #kt_app_engage_prebuilts_body" 
					data-kt-scroll-dependencies="#kt_app_engage_prebuilts_header, #kt_app_engage_prebuilts_view_image_tabs" 
					data-kt-scroll-offset="215px">

					<!--begin::Row-->
					<div class="row gy-10"> 
													
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo1/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Metronic Original	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo1.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo2/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		SaaS App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo2.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo30/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Sales Tracking App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo30.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo39/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Billing SaaS	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo39.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo31/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Marketing Automation	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo31.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo27/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Databox Dashboard	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo27.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo6/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Time Reporting	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo6.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo3/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		New Trend	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo3.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo23/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Member Dashboard	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo23.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo38/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Email Marketing	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo38.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo36/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Digital Marketing	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo36.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo10/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Project Grid	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo10.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo35/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Traffic Analytics	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo35.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo8/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Analytics App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo8.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo25/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		User Guiding App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo25.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo20/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		CRM Software	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo20.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo7/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		CRM Dashboard	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo7.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo43/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Healthcare Dashboard	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo43.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo32/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Delivery Management	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo32.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo42/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Calendar Workspace	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo42.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo44/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Recruit Automation	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo44.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo33/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Social Campaings	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo33.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo37/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Cloud Suite	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo37.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo11/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Finance Planner	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo11.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo16/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Podcast App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo16.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo26/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Planable App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo26.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo22/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Media Publisher	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo22.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Reports Panel	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo19.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo40/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		HR App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo40.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo29/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Project Workspace	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo29.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo24/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Helpdesk App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo24.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo4/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Jobs Site	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo4.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo41/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Business Intelligence	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo41.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo18/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Goal Tracking	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo18.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo21/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Monochrome App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo21.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo34/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Finance Analytics	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo34.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo15/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Crypto Planner	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo15.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo14/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Project Workplace	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo14.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo9/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Sales Manager	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo9.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo5/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Support Forum	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo5.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo13/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Classic Dashboard	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo13.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo12/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Data Analyzer	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo12.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo48/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Cloud ERP	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo48.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo28/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		eCommerce App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo28.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo17/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Events Scheduler	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo17.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
		
<!--begin::Preview-->
<a 
	href="https://preview.keenthemes.com/metronic8/demo49/index.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		KPI Tracking	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/demos/demo49.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
					
						  					
					</div>
					<!--end::Row-->
				</div>
				<!--end::Scroll wrapper-->
			</div>
								<div class="pt-5 tab-pane fade show active" id="kt_app_engage_prebuilts_tab_dashboards" role="tabpanel">
				<!--begin::Scroll wrapper-->
				<div 
					class="hover-scroll-y pe-12 me-n12" 
					data-kt-scroll="true" 
					data-kt-scroll-height="auto" 
					data-kt-scroll-wrappers="#kt_app_engage_prebuilts_modal, #kt_app_engage_prebuilts_modal_dialog, #kt_app_engage_prebuilts_body" 
					data-kt-scroll-dependencies="#kt_app_engage_prebuilts_header, #kt_app_engage_prebuilts_view_image_tabs" 
					data-kt-scroll-offset="215px">

					<!--begin::Row-->
					<div class="row gy-10"> 
						  
							
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="#" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Multipurpose	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/multipurpose-demo19.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/marketing.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Marketing	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/marketing.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/social.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Social	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/social.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/ecommerce.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Ecommerce	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/ecommerce.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/store-analytics.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Store-analytics	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/store-analytics.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/logistics.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Logistics	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/logistics.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/delivery.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Delivery	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/delivery.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/online-courses.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Online-courses	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/online-courses.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/school.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		School	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/school.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/crypto.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Crypto	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/crypto.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/finance-performance.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Finance-performance	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/finance-performance.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/website-analytics.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Website-analytics	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/website-analytics.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/bidding.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Bidding	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/bidding.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/podcast.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Podcast	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/podcast.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/projects.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Projects	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/projects.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/call-center.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Call-center	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/call-center.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-md-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/dashboards/pos.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		POS	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/dashboards/pos.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
						  					
					</div>
					<!--end::Row-->
				</div>
				<!--end::Scroll wrapper-->
			</div>
											<div class="pt-5 tab-pane fade " id="kt_app_engage_prebuilts_tab_apps" role="tabpanel">
				<!--begin::Scroll wrapper-->
				<div 
					class="hover-scroll-y pe-12 me-n12" 
					data-kt-scroll="true" 
					data-kt-scroll-height="auto" 
					data-kt-scroll-wrappers="#kt_app_engage_prebuilts_modal, #kt_app_engage_prebuilts_modal_dialog, #kt_app_engage_prebuilts_body" 
					data-kt-scroll-dependencies="#kt_app_engage_prebuilts_header, #kt_app_engage_prebuilts_view_image_tabs" 
					data-kt-scroll-offset="215px">

					<!--begin::Row-->
					<div class="row gy-10"> 
						  
								
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/projects/list/list.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Projects	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/projects.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/ecommerce/catalog/products/products.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Ecommerce	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/ecommerce.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/customers/list/list.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Customers	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/customers.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/subscriptions/list/list.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Subscriptions	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/subscriptions.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/user-management/users/list/list.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		User Management	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/user-management.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/invoices/create/main.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Invoices	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/invoices.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/support-center/overview/main.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Support Center	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/support-center.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/chat/private.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Chat	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/chat.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/calendar/calendar.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Calendar	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/calendar.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/file-manager/list/folders.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		File Manager	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/file-manager.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/inbox/listing/listing.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Inbox	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/inbox.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
	
	<!--begin::Col-->
	<div class="col-lg-4">
		
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/apps/contacts/getting-started.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Contacts	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/apps/contacts.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->	</div>
	<!--end::Col-->
						  					
					</div>
					<!--end::Row-->
				</div>
				<!--end::Scroll wrapper-->
			</div>
		
		<div class="tab-pane fade" id="kt_app_engage_prebuilts_tab_pages">
			
<!--begin::Tabs wrapper-->
<div class="d-flex flex-center mb-5">
	<div class="border-bottom">
		<!--begin::Tabs-->
		<ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-6 fw-bold m-0 p-0 gap-4">
							<!--begin::Tab item-->
				<li class="nav-item p-0 m-0">
					<!--begin::Tab link-->
					<a 
						class="nav-link text-muted text-active-primary pt-0 pb-4 
						active" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages_authentication">
						
						Authentication					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item p-0 m-0">
					<!--begin::Tab link-->
					<a 
						class="nav-link text-muted text-active-primary pt-0 pb-4 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages_general">
						
						General					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item p-0 m-0">
					<!--begin::Tab link-->
					<a 
						class="nav-link text-muted text-active-primary pt-0 pb-4 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages_account">
						
						Account					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item p-0 m-0">
					<!--begin::Tab link-->
					<a 
						class="nav-link text-muted text-active-primary pt-0 pb-4 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages_modals">
						
						Modals					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item p-0 m-0">
					<!--begin::Tab link-->
					<a 
						class="nav-link text-muted text-active-primary pt-0 pb-4 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages_wizards">
						
						Wizards					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item p-0 m-0">
					<!--begin::Tab link-->
					<a 
						class="nav-link text-muted text-active-primary pt-0 pb-4 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages_search">
						
						Search					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item p-0 m-0">
					<!--begin::Tab link-->
					<a 
						class="nav-link text-muted text-active-primary pt-0 pb-4 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages_widgets">
						
						Widgets					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
							<!--begin::Tab item-->
				<li class="nav-item p-0 m-0">
					<!--begin::Tab link-->
					<a 
						class="nav-link text-muted text-active-primary pt-0 pb-4 
						" 
						data-bs-toggle="tab" 
						href="#kt_app_engage_prebuilts_tab_pages_email-templates">
						
						Email Templates					</a>
					<!--end::Tab link-->
				</li>
				<!--end::Tab item-->
					</ul>
		<!--end::Tabs-->
	</div>
</div>
<!--end::Tabs wrapper-->

<!--begin::Scroll wrapper-->
<div 
	class="hover-scroll-y pe-12 me-n12" 
	data-kt-scroll="true" 
	data-kt-scroll-height="auto" 
	data-kt-scroll-wrappers="#kt_app_engage_prebuilts_modal, #kt_app_engage_prebuilts_modal_dialog, #kt_app_engage_prebuilts_body, #kt_app_engage_prebuilts_view_image" 
	data-kt-scroll-dependencies="#kt_app_engage_prebuilts_header, #kt_app_engage_prebuilts_view_text_heading" 
	data-kt-scroll-offset="250px">

	<!--begin::Tab content-->
	<div class="tab-content">
					<div class="tab-pane fade show active" id="kt_app_engage_prebuilts_tab_pages_authentication" role="tabpanel">

				
					<!--begin::Row-->
<div class="row g-10"> 
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/layouts/corporate/sign-in.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Corporate	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-corporate.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/layouts/creative/sign-in.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Creative	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-creative.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/layouts/fancy/sign-in.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Fancy	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-fancy.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/layouts/overlay/sign-in.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Overlay	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-overlay.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/extended/multi-steps-sign-up.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Multi-step	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-multistep.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/extended/two-factor-auth.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		2 Factor Auth	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-2factor.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/general/password-confirmation.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Password Changed	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-passwordchanged.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/general/verify-email.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Verify Email	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-verifyemail.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/general/welcome.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Welcome	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-welcome.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/general/coming-soon.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Coming Soon	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-comingsoon.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/general/account-deactivated.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Account Deactivated	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-accountdeactivated.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/general/error-404.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		404 Page	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-404.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/general/error-500.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		505 Page	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/auth-500.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
	</div>
<!--end::Row-->					
				
			</div>
					<div class="tab-pane fade " id="kt_app_engage_prebuilts_tab_pages_general" role="tabpanel">

				
											<div class="mb-5">
							<!--begin::Collapse toggle-->
<a 
	class="btn btn-flex btn-color-dark flex-stack p-0 mb-5 toggle collapsible active" 
	data-bs-toggle="collapse" 
	href="#kt_app_engage_prebuilts_tab_pages_general_user-profile">
	
	<span class="fw-bolder fs-2">
		User Profile	</span>

	<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
<span class="svg-icon toggle-off text-primary svg-icon-2 ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 
	<!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
<span class="svg-icon toggle-on text-primary svg-icon-2 ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                        
</a>
<!--end::Collapse toggle-->

<!--begin::Collapse content-->
<div class="show" id="kt_app_engage_prebuilts_tab_pages_general_user-profile">
	<!--begin::Row-->
	<div class="row g-10 pt-2 pb-5">
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Profile Overview	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/profile-overview.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/user-profile/projects.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		User Projects	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/profile-overview.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/user-profile/campaigns.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		User Campaigns	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/profile-campaigns.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/user-profile/documents.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		User Documents	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/profile-documents.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/user-profile/followers.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		User Followers	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/profile-followers.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/user-profile/activity.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		User Activity	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/profile-activity.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
			</div>
	<!--end::Row-->
</div>
<!--end::Collapse content-->						</div>
											<div class="mb-5">
							<!--begin::Collapse toggle-->
<a 
	class="btn btn-flex btn-color-dark flex-stack p-0 mb-5 toggle collapsible collapsed" 
	data-bs-toggle="collapse" 
	href="#kt_app_engage_prebuilts_tab_pages_general_corporate">
	
	<span class="fw-bolder fs-2">
		Corporate	</span>

	<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
<span class="svg-icon toggle-off text-primary svg-icon-2 ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 
	<!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
<span class="svg-icon toggle-on text-primary svg-icon-2 ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                        
</a>
<!--end::Collapse toggle-->

<!--begin::Collapse content-->
<div class="collapse" id="kt_app_engage_prebuilts_tab_pages_general_corporate">
	<!--begin::Row-->
	<div class="row g-10 pt-2 pb-5">
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/about.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		About Us	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/corporate-aboutus.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/contact.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Contact Us	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/corporate-contactus.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/licenses.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		License	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/corporate-license.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/team.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Our Team	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/corporate-ourteam.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/sitemap.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Sitemap	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/corporate-sitemap.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
			</div>
	<!--end::Row-->
</div>
<!--end::Collapse content-->						</div>
											<div class="mb-5">
							<!--begin::Collapse toggle-->
<a 
	class="btn btn-flex btn-color-dark flex-stack p-0 mb-5 toggle collapsible collapsed" 
	data-bs-toggle="collapse" 
	href="#kt_app_engage_prebuilts_tab_pages_general_social">
	
	<span class="fw-bolder fs-2">
		Social	</span>

	<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
<span class="svg-icon toggle-off text-primary svg-icon-2 ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 
	<!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
<span class="svg-icon toggle-on text-primary svg-icon-2 ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                        
</a>
<!--end::Collapse toggle-->

<!--begin::Collapse content-->
<div class="collapse" id="kt_app_engage_prebuilts_tab_pages_general_social">
	<!--begin::Row-->
	<div class="row g-10 pt-2 pb-5">
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/social/feeds.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Activity	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/social-activity.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/social/activity.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Feeds	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/social-feeds.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/social/followers.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Followers	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/social-followers.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/social/settings.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Settings	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/social-settings.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
			</div>
	<!--end::Row-->
</div>
<!--end::Collapse content-->						</div>
											<div class="mb-5">
							<!--begin::Collapse toggle-->
<a 
	class="btn btn-flex btn-color-dark flex-stack p-0 mb-5 toggle collapsible collapsed" 
	data-bs-toggle="collapse" 
	href="#kt_app_engage_prebuilts_tab_pages_general_others">
	
	<span class="fw-bolder fs-2">
		Others	</span>

	<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
<span class="svg-icon toggle-off text-primary svg-icon-2 ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--> 
	<!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
<span class="svg-icon toggle-on text-primary svg-icon-2 ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                        
</a>
<!--end::Collapse toggle-->

<!--begin::Collapse content-->
<div class="collapse" id="kt_app_engage_prebuilts_tab_pages_general_others">
	<!--begin::Row-->
	<div class="row g-10 pt-2 pb-5">
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/faq/classic.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		FAQ Classic	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/faq-classic.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/faq/extended.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		FAQ Extended	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/faq-extended.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/blog/home.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Blog Home	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/blog-home.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
					
			<!--begin::Col-->
			<div class="col-lg-4">
				
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/pages/blog/post.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Blog Post	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/blog-post.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->			</div>
			<!--end::Col-->
			</div>
	<!--end::Row-->
</div>
<!--end::Collapse content-->						</div>
					
				
			</div>
					<div class="tab-pane fade " id="kt_app_engage_prebuilts_tab_pages_account" role="tabpanel">

				
					<!--begin::Row-->
<div class="row g-10"> 
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/overview.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Overview	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-overview.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/settings.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Settings	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-settings.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/billing.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Billing	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-billing.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/security.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Security	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-security.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/referrals.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Referrals	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-referrals.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/logs.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Logs	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-logs.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/api-keys.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		API Keys	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-apikeys.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/statements.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Statements	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-statements.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/account/billing.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Billing	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/account-billing.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
	</div>
<!--end::Row-->					
				
			</div>
					<div class="tab-pane fade " id="kt_app_engage_prebuilts_tab_pages_modals" role="tabpanel">

				
					<!--begin::Row-->
<div class="row g-10"> 
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/general/view-users.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		View Friends	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-viewfriends.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/general/upgrade-plan.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Upgrade Plan	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-upgradeplan.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/top-up-wallet.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Topup Wallet	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-topupwallet.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/general/share-earn.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Share & Earn	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-shareandearn.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/general/select-users.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Select User	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-selectuser.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/forms/bidding.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Place Bid	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-placeyourbid.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/offer-a-deal.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Offer Deal	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-offeradeal.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/forms/new-target.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		New Target	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-newtarget.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/forms/new-card.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		New Card	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-newcard.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/forms/new-address.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		New Address	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-newaddress.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/general/invite-friends.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Invite Friend	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-invitefriend.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/create-project.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Create Project	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-createproject.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/create-campaign.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Create Campaign	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-createcampaign.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/create-account.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Create Business Account	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-createbusinessacc.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/create-app.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Create App	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-createapp.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/forms/create-api-key.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Create Api Key	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-createapikey.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/two-factor-authentication.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		2 Factor Auth	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/modal-2factorauth.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
	</div>
<!--end::Row-->					
				
			</div>
					<div class="tab-pane fade " id="kt_app_engage_prebuilts_tab_pages_wizards" role="tabpanel">

				
					<!--begin::Row-->
<div class="row g-10"> 
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/wizards/horizontal.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		2 Factor Auth	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/wizard-2factorauth.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/wizards/horizontal.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Horizontal	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/wizard-horizontal.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/wizards/vertical.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Vertical	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/wizard-vertical.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
	</div>
<!--end::Row-->					
				
			</div>
					<div class="tab-pane fade " id="kt_app_engage_prebuilts_tab_pages_search" role="tabpanel">

				
					<!--begin::Row-->
<div class="row g-10"> 
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/search/users.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Search Users	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/search-users.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/search/horizontal.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Search Horizontal	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/search-horizontal.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/search/vertical.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Search Vertical	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/search-vertical.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/utilities/search/select-location.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Search Location	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/search-location.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
	</div>
<!--end::Row-->					
				
			</div>
					<div class="tab-pane fade " id="kt_app_engage_prebuilts_tab_pages_widgets" role="tabpanel">

				
					<!--begin::Row-->
<div class="row g-10"> 
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/widgets/charts.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Charts	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/widgets-charts.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/widgets/feeds.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Feeds	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/widgets-feeds.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/widgets/lists.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Lists	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/widgets-lists.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/widgets/mixed.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Mixed	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/widgets-mixed.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/widgets/statistics.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Statistics	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/widgets-stats.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/widgets/tables.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Tables	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/widgets-tables.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
	</div>
<!--end::Row-->					
				
			</div>
					<div class="tab-pane fade " id="kt_app_engage_prebuilts_tab_pages_email-templates" role="tabpanel">

				
					<!--begin::Row-->
<div class="row g-10"> 
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/email/welcome-message.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Welcome	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/email-welcome.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/email/subscription-confirmed.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Subscription Confirmed	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/email-subscriptionconfirmed.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/email/reset-password.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Reset Password	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/email-resetpassword.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/email/card-declined.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Card Declined	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/email-creditcarddeclined.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/email/promo-1.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Promotion 1	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/email-promo1.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/email/promo-2.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Promotion 2	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/email-promo2.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
			
		<!--begin::Col-->
		<div class="col-lg-4">
			
<!--begin::Preview-->
<a 
	href="/<?php echo $web_root ?>demo19/authentication/email/promo-3.html" 
	data-kt-href="true" 
	class="preview-thumbnail bg-light border d-flex flex-column rounded-3 hover-elevate-up overflow-hidden" 
>
	<!--begin::Title-->
	<h3 class="ps-12 pt-9 mb-7 text-gray-900 fw-bold letter-spacing fs-4">
		Promotion 3	</h3>
	<!--end::Title-->

	<!--begin::Thumbnail-->
	<span class="app-prebuilts-thumbnail rounded ms-12 mb-n6 mb-lg-n15 me-n6 mh-350px overflow-hidden">
		<img src="<?php echo $web_root ?>assets/assets/media/preview/demos/placeholder.jpg" data-src="<?php echo $web_root ?>assets/assets/media/preview/prebuilts/pages/email-promo3.png" class="lozad w-100 rounded"/>
	</span>
	<!--end::Thumbnail-->
</a>
<!--end::Preview-->		</div>
		<!--end::Col-->	
	</div>
<!--end::Row-->					
				
			</div>
			</div>
	<!--end::Tab content-->	
</div>
<!--end::Scroll wrapper-->		</div>
	</div>
	<!--end::Tab content-->
</div>
<!--end::Image view-->                    
<!--begin::Text view-->
<div class="pt-2 d-none" id="kt_app_engage_prebuilts_view_text">
	<!--begin::Heading-->
	<h1 class="fs-2x text-dark fw-bolder text-center mb-4" id="kt_app_engage_prebuilts_view_text_heading">
		Sitemap
	</h1>
	<!--end::Heading-->

	<!--begin::Wrapper-->
	<div 
		id="kt_app_engage_prebuilts_view_text_heading" 
		class="hover-scroll-y pe-12 me-n12" 
		data-kt-scroll="true" 
		data-kt-scroll-height="auto" 
		data-kt-scroll-wrappers="#kt_app_engage_prebuilts_modal, #kt_app_engage_prebuilts_modal_dialog, #kt_app_engage_prebuilts_body, #kt_app_engage_prebuilts_view_text" 
		data-kt-scroll-dependencies="#kt_app_engage_prebuilts_header, #kt_app_engage_prebuilts_view_text_heading" 
		data-kt-scroll-offset="190px" 
	>
								<!--begin::Section-->
			<div class="mb-10 mb-lg-17">
									
<!--begin::Title-->
<h3 class="text-dark fw-bolder mb-7">
	Layouts
</h3>
<!--end::Title-->

<!--begin::Row-->
<div class="row">
			
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo1/index.html">
				Metronic Original			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo2/index.html">
				SaaS App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo30/index.html">
				Sales Tracking App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo39/index.html">
				Billing SaaS			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo31/index.html">
				Marketing Automation			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo27/index.html">
				Databox Dashboard			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo6/index.html">
				Time Reporting			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo3/index.html">
				New Trend			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo23/index.html">
				Member Dashboard			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo38/index.html">
				Email Marketing			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo36/index.html">
				Digital Marketing			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo10/index.html">
				Project Grid			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
					
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo35/index.html">
				Traffic Analytics			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo8/index.html">
				Analytics App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo25/index.html">
				User Guiding App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo20/index.html">
				CRM Software			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo7/index.html">
				CRM Dashboard			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo43/index.html">
				Healthcare Dashboard			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo32/index.html">
				Delivery Management			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo42/index.html">
				Calendar Workspace			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo44/index.html">
				Recruit Automation			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo33/index.html">
				Social Campaings			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo37/index.html">
				Cloud Suite			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo11/index.html">
				Finance Planner			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
					
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo16/index.html">
				Podcast App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo26/index.html">
				Planable App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo22/index.html">
				Media Publisher			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/index.html">
				Reports Panel			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo40/index.html">
				HR App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo29/index.html">
				Project Workspace			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo24/index.html">
				Helpdesk App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo4/index.html">
				Jobs Site			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo41/index.html">
				Business Intelligence			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo18/index.html">
				Goal Tracking			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo21/index.html">
				Monochrome App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo34/index.html">
				Finance Analytics			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
					
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo15/index.html">
				Crypto Planner			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo14/index.html">
				Project Workplace			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo9/index.html">
				Sales Manager			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo5/index.html">
				Support Forum			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo13/index.html">
				Classic Dashboard			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo12/index.html">
				Data Analyzer			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo48/index.html">
				Cloud ERP			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo28/index.html">
				eCommerce App			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo17/index.html">
				Events Scheduler			</a>

					
		
			
			<a class="fw-6 fw-semibold" href="https://preview.keenthemes.com/metronic8/demo49/index.html">
				KPI Tracking			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
			</div>
<!--end::Row-->			
								
			</div>
			<!--end::Section-->

			 

								<!--begin::Section-->
			<div class="mb-10 mb-lg-17">
									
<!--begin::Title-->
<h3 class="text-dark fw-bolder mb-7">
	Dashboards
</h3>
<!--end::Title-->

<!--begin::Row-->
<div class="row">
			
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			<a class="fw-6 fw-semibold" href="#">
							</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/marketing.html">
				Marketing Dashboard			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/social.html">
				Social Dashboard			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/ecommerce.html">
				eCommerce Dashboard			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/store-analytics.html">
				Store Analytics			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
		
			
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/logistics.html">
				Logistics			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/delivery.html">
				Delivery			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/online-courses.html">
				Online Courses			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/school.html">
				Hello Tyler			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/crypto.html">
				My Balance: 37,045$			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
		
			
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/finance-performance.html">
				Finance Performance			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/website-analytics.html">
				Website Analytics			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/bidding.html">
				Bidding Dashboard			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/podcast.html">
				Podcast Dashboard			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/projects.html">
				Projects Dashboard			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
		
			
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/call-center.html">
				Call Center			</a>

		
			
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/dashboards/pos.html">
				POS System			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
		
	</div>
<!--end::Row-->		
								
			</div>
			<!--end::Section-->

			 

								<!--begin::Section-->
			<div class="mb-10 mb-lg-17">
								
			</div>
			<!--end::Section-->

							
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - Authentication		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/layouts/corporate/sign-in.html">
						Corporate					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/layouts/creative/sign-in.html">
						Creative					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/layouts/fancy/sign-in.html">
						Fancy					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/layouts/overlay/sign-in.html">
						Overlay					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/extended/multi-steps-sign-up.html">
						Multi-step					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/extended/two-factor-auth.html">
						2 Factor Auth					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/general/password-confirmation.html">
						Password Changed					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/general/verify-email.html">
						Verify Email					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/general/welcome.html">
						Welcome					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/general/coming-soon.html">
						Coming Soon					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/general/account-deactivated.html">
						Account Deactivated					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/general/error-404.html">
						404 Page					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/general/error-500.html">
						505 Page					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - Account		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/overview.html">
						Overview					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/settings.html">
						Settings					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/billing.html">
						Billing					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/security.html">
						Security					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/referrals.html">
						Referrals					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/logs.html">
						Logs					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/api-keys.html">
						API Keys					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/statements.html">
						Statements					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/account/billing.html">
						Billing					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - Modals		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/general/view-users.html">
						View Friends					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/general/upgrade-plan.html">
						Upgrade Plan					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/top-up-wallet.html">
						Topup Wallet					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/general/share-earn.html">
						Share & Earn					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/general/select-users.html">
						Select User					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/forms/bidding.html">
						Place Bid					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/offer-a-deal.html">
						Offer Deal					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/forms/new-target.html">
						New Target					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/forms/new-card.html">
						New Card					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/forms/new-address.html">
						New Address					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/general/invite-friends.html">
						Invite Friend					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/create-project.html">
						Create Project					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/create-campaign.html">
						Create Campaign					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/create-account.html">
						Create Business Account					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/create-app.html">
						Create App					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/forms/create-api-key.html">
						Create Api Key					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/modals/wizards/two-factor-authentication.html">
						2 Factor Auth					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - Wizards		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/wizards/horizontal.html">
						2 Factor Auth					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/wizards/horizontal.html">
						Horizontal					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/wizards/vertical.html">
						Vertical					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - Search		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/search/users.html">
						Search Users					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/search/horizontal.html">
						Search Horizontal					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/search/vertical.html">
						Search Vertical					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/utilities/search/select-location.html">
						Search Location					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - Widgets		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/widgets/charts.html">
						Charts					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/widgets/feeds.html">
						Feeds					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/widgets/lists.html">
						Lists					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/widgets/mixed.html">
						Mixed					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/widgets/statistics.html">
						Statistics					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/widgets/tables.html">
						Tables					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - Email Templates		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/email/welcome-message.html">
						Welcome					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/email/subscription-confirmed.html">
						Subscription Confirmed					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/email/reset-password.html">
						Reset Password					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/email/card-declined.html">
						Card Declined					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/email/promo-1.html">
						Promotion 1					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/email/promo-2.html">
						Promotion 2					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/authentication/email/promo-3.html">
						Promotion 3					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - General - User Profile		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/user-profile/overview.html">
						Profile Overview					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/user-profile/projects.html">
						User Projects					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/user-profile/campaigns.html">
						User Campaigns					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/user-profile/documents.html">
						User Documents					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/user-profile/followers.html">
						User Followers					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/user-profile/activity.html">
						User Activity					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - General - Corporate		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/about.html">
						About Us					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/contact.html">
						Contact Us					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/licenses.html">
						License					</a>

											
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/team.html">
						Our Team					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/sitemap.html">
						Sitemap					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - General - Social		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/social/feeds.html">
						Activity					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/social/activity.html">
						Feeds					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/social/followers.html">
						Followers					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/social/settings.html">
						Settings					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
	<!--begin::Section-->
	<div class="mb-10 mb-lg-17">
		<!--begin::Title-->
		<h3 class="text-dark fw-bolder mb-7">
			Pages - General - Others		</h3>
		<!--end::Title-->

		<!--begin::Row-->
		<div class="row">
										
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/faq/classic.html">
						FAQ Classic					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/faq/extended.html">
						FAQ Extended					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/blog/home.html">
						Blog Home					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
											
									<!--begin::Col-->
					<div class="col-lg-3">
						<!--begin::List-->
						<div class="d-flex flex-column gap-3 gap-lg-5">
				
					<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/pages/blog/post.html">
						Blog Post					</a>

																</div>
						<!--end::List-->
					</div>
					<!--end::Col-->
									</div>
		<!--end::Row-->
	</div>
	<!--end::Section-->
			
			 

								<!--begin::Section-->
			<div class="">
									
<!--begin::Title-->
<h3 class="text-dark fw-bolder mb-7">
	Apps
</h3>
<!--end::Title-->

<!--begin::Row-->
<div class="row">
			
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/projects/list/list.html">
				Projects			</a>

					
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/ecommerce/catalog/products/products.html">
				Ecommerce			</a>

					
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/customers/list/list.html">
				Customers			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
					
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/subscriptions/list/list.html">
				Subscriptions			</a>

					
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/user-management/users/list/list.html">
				User Management			</a>

					
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/invoices/create/main.html">
				Invoices			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
					
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/support-center/overview/main.html">
				Support Center			</a>

					
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/chat/private.html">
				Chat			</a>

					
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/calendar/calendar.html">
				Calendar			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
					
					<!--begin::Col-->
			<div class="col-lg-3">
				<!--begin::List-->
				<div class="d-flex flex-column gap-3 gap-lg-5">
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/file-manager/list/folders.html">
				File Manager			</a>

					
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/inbox/listing/listing.html">
				Inbox			</a>

					
		
			<a class="fw-6 fw-semibold" href="/<?php echo $web_root ?>demo19/apps/contacts/getting-started.html">
				Contacts			</a>

										</div>
				<!--end::List-->
			</div>
			<!--end::Col-->
			</div>
<!--end::Row-->	
								
			</div>
			<!--end::Section-->

			 

			</div>
	<!--end::Wrapper-->
</div>
<!--end::Text view--->                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Sitemap-->				<!--end::Engage modals-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
	<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
<span class="svg-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"/>
<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></div>
<!--end::Scrolltop-->

                    <!--begin::Modals-->
            
<!--begin::Modal - Upgrade plan-->
<div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-xl">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header justify-content-end border-0 pb-0">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <h1 class="mb-3">Upgrade a Plan</h1>

                    <div class="text-muted fw-semibold fs-5">
                        If you need more info, please check <a href="#" class="link-primary fw-bold">Pricing Guidelines</a>.
                    </div>
                </div>
                <!--end::Heading-->

                <!--begin::Plans-->
                <div class="d-flex flex-column">
                    <!--begin::Nav group-->
                    <div class="nav-group nav-group-outline mx-auto" data-kt-buttons="true">
                        <button class="btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3 me-2 active" data-kt-plan="month">
                            Monthly
                        </button>
                        <button class="btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3" data-kt-plan="annual">
                            Annual
                        </button>
                    </div>
                    <!--end::Nav group-->

                    <!--begin::Row-->                             
                    <div class="row mt-10">
                        <!--begin::Col-->
                        <div class="col-lg-6 mb-10 mb-lg-0">
                            <!--begin::Tabs-->
                            <div class="nav flex-column">
                                                                    <!--begin::Tab link-->
                                                                        <label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 active mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_startup">
                                                                            
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
                                                <input class="form-check-input" type="radio" name="plan" checked="checked" value="startup"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                                    Startup
                                                                                                        </div>
                                                <div class="fw-semibold opacity-75">
                                                    Best for startups                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->

                                        <!--begin::Price-->
                                        <div class="ms-5">
                                                                                            <span class="mb-2">$</span>

                                                <span class="fs-3x fw-bold" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">
                                                    39                                                </span>
                                                
                                                <span class="fs-7 opacity-50">/ 
                                                    <span data-kt-element="period">Mon</span>
                                                </span>
                                                                                    </div>
                                        <!--end::Price-->
                                    </label>
                                    <!--end::Tab link-->
                                                                    <!--begin::Tab link-->
                                                                        <label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6  mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">
                                                                            
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
                                                <input class="form-check-input" type="radio" name="plan"  value="advanced"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                                    Advanced
                                                                                                        </div>
                                                <div class="fw-semibold opacity-75">
                                                    Best for 100+ team size                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->

                                        <!--begin::Price-->
                                        <div class="ms-5">
                                                                                            <span class="mb-2">$</span>

                                                <span class="fs-3x fw-bold" data-kt-plan-price-month="339" data-kt-plan-price-annual="3399">
                                                    339                                                </span>
                                                
                                                <span class="fs-7 opacity-50">/ 
                                                    <span data-kt-element="period">Mon</span>
                                                </span>
                                                                                    </div>
                                        <!--end::Price-->
                                    </label>
                                    <!--end::Tab link-->
                                                                    <!--begin::Tab link-->
                                                                        <label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6  mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_enterprise">
                                                                            
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
                                                <input class="form-check-input" type="radio" name="plan"  value="enterprise"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                                    Enterprise
                                                                                                            <span class="badge badge-light-success ms-2 py-2 px-3 fs-7">Popular</span>
                                                                                                        </div>
                                                <div class="fw-semibold opacity-75">
                                                    Best value for 1000+ team                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->

                                        <!--begin::Price-->
                                        <div class="ms-5">
                                                                                            <span class="mb-2">$</span>

                                                <span class="fs-3x fw-bold" data-kt-plan-price-month="999" data-kt-plan-price-annual="9999">
                                                    999                                                </span>
                                                
                                                <span class="fs-7 opacity-50">/ 
                                                    <span data-kt-element="period">Mon</span>
                                                </span>
                                                                                    </div>
                                        <!--end::Price-->
                                    </label>
                                    <!--end::Tab link-->
                                                                    <!--begin::Tab link-->
                                                                        <label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_custom">
                                                                            
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
                                                <input class="form-check-input" type="radio" name="plan"  value="custom"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                                    Custom
                                                                                                        </div>
                                                <div class="fw-semibold opacity-75">
                                                    Requet a custom license                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->

                                        <!--begin::Price-->
                                        <div class="ms-5">
                                                                                            <a href="#" class="btn btn-sm btn-success">Contact Us</a>
                                                                                    </div>
                                        <!--end::Price-->
                                    </label>
                                    <!--end::Tab link-->
                                                            </div>
                            <!--end::Tabs-->      
                        </div>
                        <!--end::Col-->   
                        
                        <!--begin::Col-->
                        <div class="col-lg-6">
                            <!--begin::Tab content-->
                            <div class="tab-content rounded h-100 bg-light p-10">
                                                                    <!--begin::Tab Pane-->
                                    <div class="tab-pane fade show active" id="kt_upgrade_plan_startup">
                                        <!--begin::Heading-->
                                        <div class="pb-5">
                                            <h2 class="fw-bold text-dark">What’s in Startup Plan?</h2>

                                            <div class="text-muted fw-semibold">
                                                Optimal for 10+ team size and new startup                                                 
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Body-->
                                        <div class="pt-1">  
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Up to 10 Active Users                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Up to 30 Project Integrations                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Analytics Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-muted flex-grow-1">
                                                            Finance Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-muted flex-grow-1">
                                                            Accounting Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-muted flex-grow-1">
                                                            Network Platform                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center ">             
                                                                                                            <span class="fw-semibold fs-5 text-muted flex-grow-1">
                                                            Unlimited Cloud Space                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                    </div>
                                        <!--end::Body-->  
                                    </div> 
                                    <!--end::Tab Pane-->   
                                                                    <!--begin::Tab Pane-->
                                    <div class="tab-pane fade " id="kt_upgrade_plan_advanced">
                                        <!--begin::Heading-->
                                        <div class="pb-5">
                                            <h2 class="fw-bold text-dark">What’s in Startup Plan?</h2>

                                            <div class="text-muted fw-semibold">
                                                Optimal for 100+ team size and grown company                                                 
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Body-->
                                        <div class="pt-1">  
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Up to 10 Active Users                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Up to 30 Project Integrations                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Analytics Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Finance Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Accounting Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-muted flex-grow-1">
                                                            Network Platform                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center ">             
                                                                                                            <span class="fw-semibold fs-5 text-muted flex-grow-1">
                                                            Unlimited Cloud Space                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                    </div>
                                        <!--end::Body-->  
                                    </div> 
                                    <!--end::Tab Pane-->   
                                                                    <!--begin::Tab Pane-->
                                    <div class="tab-pane fade " id="kt_upgrade_plan_enterprise">
                                        <!--begin::Heading-->
                                        <div class="pb-5">
                                            <h2 class="fw-bold text-dark">What’s in Startup Plan?</h2>

                                            <div class="text-muted fw-semibold">
                                                Optimal for 1000+ team and enterpise                                                 
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Body-->
                                        <div class="pt-1">  
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Up to 10 Active Users                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Up to 30 Project Integrations                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Analytics Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Finance Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Accounting Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Network Platform                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center ">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Unlimited Cloud Space                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                    </div>
                                        <!--end::Body-->  
                                    </div> 
                                    <!--end::Tab Pane-->   
                                                                    <!--begin::Tab Pane-->
                                    <div class="tab-pane fade " id="kt_upgrade_plan_custom">
                                        <!--begin::Heading-->
                                        <div class="pb-5">
                                            <h2 class="fw-bold text-dark">What’s in Startup Plan?</h2>

                                            <div class="text-muted fw-semibold">
                                                Optimal for corporations                                                 
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Body-->
                                        <div class="pt-1">  
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Unlimited Users                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Unlimited Project Integrations                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Analytics Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Finance Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Accounting Module                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center mb-7">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Network Platform                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                            <!--begin::Item-->                                               
                                                <div class="d-flex align-items-center ">             
                                                                                                            <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">
                                                            Unlimited Cloud Space                                                        </span> 
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                                                                                                                                              
                                                </div>
                                                <!--end::Item--> 
                                                                                    </div>
                                        <!--end::Body-->  
                                    </div> 
                                    <!--end::Tab Pane-->   
                                                            </div>  
                            <!--end::Tab content-->
                        </div> 
                        <!--end::Col-->   
                    </div> 
                    <!--end::Row-->
                </div>   
                <!--end::Plans-->                 

                <!--begin::Actions-->
                <div class="d-flex flex-center flex-row-fluid pt-12">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                        
<!--begin::Indicator label-->
<span class="indicator-label">
    Upgrade Plan</span>
<!--end::Indicator label-->

<!--begin::Indicator progress-->
<span class="indicator-progress">
    Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
</span>
<!--end::Indicator progress-->                         
                    </button>
                </div>
                <!--end::Actions-->      
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Upgrade plan-->
<!--begin::Modal - Invite Friends-->
<div class="modal fade" id="kt_modal_invite_friends" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Invite a Friend</h1>
                    <!--end::Title-->

                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-5">
                        If you need more info, please check out
                        <a href="#" class="link-primary fw-bold">FAQ Page</a>.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->

                <!--begin::Google Contacts Invite-->
                <div class="btn btn-light-primary fw-bold w-100 mb-8">
                    <img alt="Logo" src="<?php echo $web_root ?>assets/assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3"/>
                    Invite Gmail Contacts
                </div>
                <!--end::Google Contacts Invite-->

                <!--begin::Separator-->
                <div class="separator d-flex flex-center mb-8">
                    <span class="text-uppercase bg-body fs-7 fw-semibold text-muted px-3">or</span>
                </div>
                <!--end::Separator-->

                <!--begin::Textarea-->
                <textarea class="form-control form-control-solid mb-8" rows="3" placeholder="Type or paste emails here">
                </textarea>
                <!--end::Textarea-->

                <!--begin::Users-->
                <div class="mb-10">
                    <!--begin::Heading-->
                    <div class="fs-6 fw-semibold mb-2">Your Invitations</div>
                    <!--end::Heading-->

                    <!--begin::List-->
                    <div class="mh-300px scroll-y me-n7 pe-7">
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-6.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Smith</a>

                                        <div class="fw-semibold text-muted">smith@kpmg.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" selected>Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                                M                                            </span>
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>

                                        <div class="fw-semibold text-muted">melody@altbox.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" selected>Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max Smith</a>

                                        <div class="fw-semibold text-muted">max@kt.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" selected>Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-5.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Sean Bean</a>

                                        <div class="fw-semibold text-muted">sean@dellito.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" selected>Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Brian Cox</a>

                                        <div class="fw-semibold text-muted">brian@exchange.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" selected>Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <span class="symbol-label bg-light-warning text-warning fw-semibold">
                                                C                                            </span>
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>

                                        <div class="fw-semibold text-muted">mik@pex.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" selected>Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-9.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>

                                        <div class="fw-semibold text-muted">f.mit@kpmg.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" selected>Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                                O                                            </span>
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Olivia Wild</a>

                                        <div class="fw-semibold text-muted">olivia@corpmail.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" selected>Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <span class="symbol-label bg-light-primary text-primary fw-semibold">
                                                N                                            </span>
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Neil Owen</a>

                                        <div class="fw-semibold text-muted">owen.neil@gmail.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" selected>Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-23.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Dan Wilson</a>

                                        <div class="fw-semibold text-muted">dam@consilting.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" selected>Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                                E                                            </span>
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Bold</a>

                                        <div class="fw-semibold text-muted">emma@intenso.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" selected>Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-12.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ana Crown</a>

                                        <div class="fw-semibold text-muted">ana.cf@limtel.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" selected>Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <span class="symbol-label bg-light-info text-info fw-semibold">
                                                A                                            </span>
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert Doe</a>

                                        <div class="fw-semibold text-muted">robert@benko.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" selected>Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-13.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John Miller</a>

                                        <div class="fw-semibold text-muted">miller@mapple.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" selected>Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <span class="symbol-label bg-light-success text-success fw-semibold">
                                                L                                            </span>
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>

                                        <div class="fw-semibold text-muted">lucy.m@fentech.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" selected>Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-21.jpg" />
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>

                                        <div class="fw-semibold text-muted">ethan@loop.com.au</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" selected>Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" >Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                                                                <!--begin::User-->
                            <div class="d-flex flex-stack py-4 ">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                                                                    <span class="symbol-label bg-light-info text-info fw-semibold">
                                                A                                            </span>
                                                                            </div>
                                    <!--end::Avatar-->

                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert Doe</a>

                                        <div class="fw-semibold text-muted">robert@benko.com</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->

                                <!--begin::Access menu-->
                                <div class="ms-2 w-100px">
                                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_invite_friends" data-hide-search="true">
                                        <option value="1" >Guest</option>
                                        <option value="2" >Owner</option>
                                        <option value="3" selected>Can Edit</option>
                                    </select>
                                </div>
                                <!--end::Access menu-->
                            </div>
                            <!--end::User-->
                                            </div>
                    <!--end::List-->
                </div>
                <!--end::Users-->

                <!--begin::Notice-->
                <div class="d-flex flex-stack">
                    <!--begin::Label-->                        
                    <div class="me-5 fw-semibold">
                        <label class="fs-6">Adding Users by Team Members</label>
                        <div class="fs-7 text-muted">If you need more info, please check budget planning</div>
                    </div>
                    <!--end::Label-->     

                    <!--begin::Switch-->
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" checked="checked"/>
                        
                        <span class="form-check-label fw-semibold text-muted">
                            Allowed
                        </span>
                    </label>
                    <!--end::Switch-->
                </div>
                <!--end::Notice-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Invite Friend--><!--begin::Modal - Create App-->
<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Create App</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <!--begin::Stepper-->
                <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
                    <!--begin::Aside-->
                    <div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
                        <!--begin::Nav-->
                        <div class="stepper-nav ps-lg-10">
                            <!--begin::Step 1-->
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->  
                                <div class="stepper-wrapper">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">1</span>
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Details
                                        </h3>

                                        <div class="stepper-desc">
                                            Name your App
                                        </div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Wrapper--> 
            
                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->                                 
                            </div>
                            <!--end::Step 1-->

                            <!--begin::Step 2-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->  
                                <div class="stepper-wrapper">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">2</span>
                                    </div>
                                    <!--begin::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Frameworks
                                        </h3>

                                        <div class="stepper-desc">
                                            Define your app framework
                                        </div>
                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Wrapper--> 
            
                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->                               
                            </div>
                            <!--end::Step 2-->

                            <!--begin::Step 3-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->  
                                <div class="stepper-wrapper">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">3</span>
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Database
                                        </h3>

                                        <div class="stepper-desc">
                                            Select the app database type
                                        </div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Wrapper--> 
            
                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->                            
                            </div>
                            <!--end::Step 3-->

                            <!--begin::Step 4-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->  
                                <div class="stepper-wrapper">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">4</span>
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Billing
                                        </h3>

                                        <div class="stepper-desc">
                                            Provide payment details
                                        </div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Wrapper--> 
            
                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->                            
                            </div>
                            <!--end::Step 4-->

                            <!--begin::Step 5-->
                            <div class="stepper-item mark-completed" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->  
                                <div class="stepper-wrapper">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">5</span>
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Completed
                                        </h3>

                                        <div class="stepper-desc">
                                            Review and Submit
                                        </div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Wrapper-->                                     
                            </div>
                            <!--end::Step 5-->
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--begin::Aside-->

                    <!--begin::Content-->
                    <div class="flex-row-fluid py-lg-5 px-lg-15">
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" id="kt_modal_create_app_form">
                            <!--begin::Step 1-->
<div class="current" data-kt-stepper-element="content">
    <div class="w-100">
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                <span class="required">App Name</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify your unique app name"></i>
            </label>
            <!--end::Label-->

            <!--begin::Input-->
            <input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="" value=""/>
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-semibold mb-4">
                <span class="required">Category</span>

                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select your app category"></i>
            </label>
            <!--end::Label-->

            <!--begin:Options-->
            <div class="fv-row">
                <!--begin:Option-->
                <label class="d-flex flex-stack mb-5 cursor-pointer">
                    <!--begin:Label-->
                    <span class="d-flex align-items-center me-2">
                        <!--begin:Icon-->
                        <span class="symbol symbol-50px me-6">
                            <span class="symbol-label bg-light-primary">
                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
<span class="svg-icon svg-icon-1 svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="currentColor"/>
<path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                            </span>
                        </span>
                        <!--end:Icon-->

                        <!--begin:Info-->
                        <span class="d-flex flex-column">
                            <span class="fw-bold fs-6">Quick Online Courses</span>

                            <span class="fs-7 text-muted">Creating a clear text structure is just one SEO</span>
                        </span>
                        <!--end:Info-->
                    </span>
                    <!--end:Label-->

                    <!--begin:Input-->
                    <span class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio"  name="category" value="1"/>
                    </span>
                    <!--end:Input-->
                </label>
                <!--end::Option-->

                <!--begin:Option-->
                <label class="d-flex flex-stack mb-5 cursor-pointer">
                    <!--begin:Label-->
                    <span class="d-flex align-items-center me-2">
                        <!--begin:Icon-->
                        <span class="symbol symbol-50px me-6">
                            <span class="symbol-label bg-light-danger  ">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
<span class="svg-icon svg-icon-1 svg-icon-danger"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"/>
<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"/>
<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"/>
<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                            </span>
                        </span>
                        <!--end:Icon-->

                        <!--begin:Info-->
                        <span class="d-flex flex-column">
                            <span class="fw-bold fs-6">Face to Face Discussions</span>

                            <span class="fs-7 text-muted">Creating a clear text structure is just one aspect</span>
                        </span>
                        <!--end:Info-->
                    </span>
                    <!--end:Label-->

                    <!--begin:Input-->
                    <span class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" name="category" value="2"/>
                    </span>
                    <!--end:Input-->
                </label>
                <!--end::Option-->

                <!--begin:Option-->
                <label class="d-flex flex-stack cursor-pointer">
                    <!--begin:Label-->
                    <span class="d-flex align-items-center me-2">
                        <!--begin:Icon-->
                        <span class="symbol symbol-50px me-6">
                            <span class="symbol-label bg-light-success">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
<span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="currentColor"/>
<path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                            </span>
                        </span>
                        <!--end:Icon-->

                        <!--begin:Info-->
                        <span class="d-flex flex-column">
                            <span class="fw-bold fs-6">Full Intro Training</span>

                            <span class="fs-7 text-muted">Creating a clear text structure copywriting</span>
                        </span>
                        <!--end:Info-->
                    </span>
                    <!--end:Label-->

                    <!--begin:Input-->
                    <span class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" name="category" value="3"/>
                    </span>
                    <!--end:Input-->
                </label>
                <!--end::Option-->
            </div>
            <!--end:Options-->
        </div>
        <!--end::Input group-->
    </div>
</div>
<!--end::Step 1-->
                            <!--begin::Step 2-->
<div data-kt-stepper-element="content">
    <div class="w-100">
        <!--begin::Input group-->
        <div class="fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-semibold mb-4">
                <span class="required">Select Framework</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify your apps framework"></i>
            </label>
            <!--end::Label-->

            <!--begin:Option-->
            <label class="d-flex flex-stack cursor-pointer mb-5">
                <!--begin:Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin:Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-warning">
                            <i class="fab fa-html5 text-warning fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Icon-->

                    <!--begin:Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bold fs-6">HTML5</span>

                        <span class="fs-7 text-muted">Base Web Projec</span>
                    </span>
                    <!--end:Info-->
                </span>
                <!--end:Label-->

                <!--begin:Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" checked name="framework" value="1"/>
                </span>
                <!--end:Input-->
            </label>
            <!--end::Option-->

            <!--begin:Option-->
            <label class="d-flex flex-stack cursor-pointer mb-5">
                <!--begin:Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin:Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-success">
                            <i class="fab fa-react text-success fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Icon-->

                    <!--begin:Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bold fs-6">ReactJS</span>
                        <span class="fs-7 text-muted">Robust and flexible app framework</span>
                    </span>
                    <!--end:Info-->
                </span>
                <!--end:Label-->

                <!--begin:Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="framework" value="2"/>
                </span>
                <!--end:Input-->
            </label>
            <!--end::Option-->

            <!--begin:Option-->
            <label class="d-flex flex-stack cursor-pointer mb-5">
                <!--begin:Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin:Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-danger">
                            <i class="fab fa-angular text-danger fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Icon-->

                    <!--begin:Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bold fs-6">Angular</span>
                        <span class="fs-7 text-muted">Powerful data mangement</span>
                    </span>
                    <!--end:Info-->
                </span>
                <!--end:Label-->

                <!--begin:Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="framework" value="3"/>
                </span>
                <!--end:Input-->
            </label>
            <!--end::Option-->

            <!--begin:Option-->
            <label class="d-flex flex-stack cursor-pointer">
                <!--begin:Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin:Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-primary">
                            <i class="fab fa-vuejs text-primary fs-2x"></i>
                        </span>
                    </span>
                    <!--end:Icon-->

                    <!--begin:Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bold fs-6">Vue</span>
                        <span class="fs-7 text-muted">Lightweight and responsive framework</span>
                    </span>
                    <!--end:Info-->
                </span>
                <!--end:Label-->

                <!--begin:Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="framework" value="4"/>
                </span>
                <!--end:Input-->
            </label>
            <!--end::Option-->
        </div>
        <!--end::Input group-->
    </div>
</div>
<!--end::Step 2-->
                            <!--begin::Step 3-->
<div data-kt-stepper-element="content">
    <div class="w-100">
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="required fs-5 fw-semibold mb-2">
                Database Name
            </label>
            <!--end::Label-->

            <!--begin::Input-->
            <input type="text" class="form-control form-control-lg form-control-solid" name="dbname" placeholder="" value="master_db"/>
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-semibold mb-4">
                <span class="required">Select Database Engine</span>

                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select your app database engine"></i>
            </label>
            <!--end::Label-->

            <!--begin:Option-->
            <label class="d-flex flex-stack cursor-pointer mb-5">
                <!--begin::Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin::Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-success">
                            <i class="fas fa-database text-success fs-2x"></i>
                        </span>
                    </span>
                    <!--end::Icon-->

                    <!--begin::Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bold fs-6">MySQL</span>

                        <span class="fs-7 text-muted">Basic MySQL database</span>
                    </span>
                    <!--end::Info-->
                </span>
                <!--end::Label-->

                <!--begin::Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="dbengine" checked value="1"/>
                </span>
                <!--end::Input-->
            </label>
            <!--end::Option-->

            <!--begin:Option-->
            <label class="d-flex flex-stack cursor-pointer mb-5">
                <!--begin::Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin::Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-danger">
                            <i class="fab fa-google text-danger fs-2x"></i>
                        </span>
                    </span>
                    <!--end::Icon-->

                    <!--begin::Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bold fs-6">Firebase</span>

                        <span class="fs-7 text-muted">Google based app data management</span>
                    </span>
                    <!--end::Info-->
                </span>
                <!--end::Label-->

                <!--begin::Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="dbengine" value="2"/>
                </span>
                <!--end::Input-->
            </label>
            <!--end::Option-->

            <!--begin:Option-->
            <label class="d-flex flex-stack cursor-pointer">
                <!--begin::Label-->
                <span class="d-flex align-items-center me-2">
                    <!--begin::Icon-->
                    <span class="symbol symbol-50px me-6">
                        <span class="symbol-label bg-light-warning">
                            <i class="fab fa-amazon text-warning fs-2x"></i>
                        </span>
                    </span>
                    <!--end::Icon-->

                    <!--begin::Info-->
                    <span class="d-flex flex-column">
                        <span class="fw-bold fs-6">DynamoDB</span>

                        <span class="fs-7 text-muted">Amazon Fast NoSQL Database</span>
                    </span>
                    <!--end::Info-->
                </span>
                <!--end::Label-->

                <!--begin::Input-->
                <span class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="dbengine" value="3"/>
                </span>
                <!--end::Input-->
            </label>
            <!--end::Option-->
        </div>
        <!--end::Input group-->
    </div>
</div>
<!--end::Step 3-->
                            <!--begin::Step 4-->
<div data-kt-stepper-element="content">
    <div class="w-100">
        <!--begin::Input group-->
<div class="d-flex flex-column mb-7 fv-row">
    <!--begin::Label-->
    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
        <span class="required">Name On Card</span>
        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a card holder's name"></i>
    </label>
    <!--end::Label-->

    <input type="text" class="form-control form-control-solid" placeholder="" name="card_name" value="Max Doe"/>
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="d-flex flex-column mb-7 fv-row">
    <!--begin::Label-->
    <label class="required fs-6 fw-semibold form-label mb-2">Card Number</label>
    <!--end::Label-->
    
    <!--begin::Input wrapper-->
    <div class="position-relative">
        <!--begin::Input-->
        <input type="text" class="form-control form-control-solid" placeholder="Enter card number" name="card_number" value="4111 1111 1111 1111"/>
        <!--end::Input-->

        <!--begin::Card logos-->
        <div class="position-absolute translate-middle-y top-50 end-0 me-5">
            <img src="<?php echo $web_root ?>assets/assets/media/svg/card-logos/visa.svg" alt="" class="h-25px"/>
            <img src="<?php echo $web_root ?>assets/assets/media/svg/card-logos/mastercard.svg" alt="" class="h-25px"/>
            <img src="<?php echo $web_root ?>assets/assets/media/svg/card-logos/american-express.svg" alt="" class="h-25px"/>
        </div>
        <!--end::Card logos-->
    </div>
    <!--end::Input wrapper-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="row mb-10">
    <!--begin::Col-->
    <div class="col-md-8 fv-row">
        <!--begin::Label-->
        <label class="required fs-6 fw-semibold form-label mb-2">Expiration Date</label>
        <!--end::Label-->

        <!--begin::Row-->
        <div class="row fv-row">
            <!--begin::Col-->
            <div class="col-6">
                <select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month">
                    <option></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                    </select>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-6">
                <select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year">
                    <option></option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                    </select>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-4 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
            <span class="required">CVV</span>
            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter a card CVV code"></i>
        </label>
        <!--end::Label-->

        <!--begin::Input wrapper-->
        <div class="position-relative">
            <!--begin::Input-->
            <input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" placeholder="CVV" name="card_cvv"/>
            <!--end::Input-->

            <!--begin::CVV icon-->
            <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
<span class="svg-icon svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M22 7H2V11H22V7Z" fill="currentColor"/>
<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->            </div>
            <!--end::CVV icon-->
        </div>
        <!--end::Input wrapper-->
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="d-flex flex-stack">
    <!--begin::Label-->
    <div class="me-5">
        <label class="fs-6 fw-semibold form-label">Save Card for further billing?</label>
        <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
    </div>
    <!--end::Label-->

    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid">
        <input class="form-check-input" type="checkbox" value="1" checked="checked"/>
        <span class="form-check-label fw-semibold text-muted">
            Save Card
        </span>
    </label>
    <!--end::Switch-->
</div>
<!--end::Input group-->

    </div>
</div>
<!--end::Step 4-->
                            <!--begin::Step 5-->
<div data-kt-stepper-element="content">
    <div class="w-100 text-center">
        <!--begin::Heading-->
           <h1 class="fw-bold text-dark mb-3">Release!</h1>
        <!--end::Heading-->

        <!--begin::Description--> 
        <div class="text-muted fw-semibold fs-3">
            Submit your app to kickstart your project.
        </div>
        <!--end::Description--> 

        <!--begin::Illustration-->
        <div class="text-center px-4 py-15">       
            <img src="<?php echo $web_root ?>assets/assets/media/illustrations/sketchy-1/9.png" alt="" class="mw-100 mh-300px"/>
        </div>
        <!--end::Illustration-->
    </div>
</div>
<!--end::Step 5-->

 
                            <!--begin::Actions-->
                            <div class="d-flex flex-stack pt-10">
                                <!--begin::Wrapper-->
                                <div class="me-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
<span class="svg-icon svg-icon-3 me-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"/>
<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                        Back
                                    </button>
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Wrapper-->
                                <div>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
                                        <span class="indicator-label">
                                            Submit
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-3 ms-2 me-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>

                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                        Continue
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-3 ms-1 me-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                    </button>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Create App--><!--begin::Modal - Create Campaign-->
<div class="modal fade" id="kt_modal_create_campaign" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-fullscreen p-9">
        <!--begin::Modal content-->
        <div class="modal-content modal-rounded">
            <!--begin::Modal header-->
            <div class="modal-header py-7 d-flex justify-content-between">
                <!--begin::Modal title-->
                <h2>Create Campaign</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y m-5">
                <!--begin::Stepper-->
                <div class="stepper stepper-links d-flex flex-column" id="kt_modal_create_campaign_stepper">
                    <!--begin::Nav-->
                    <div class="stepper-nav justify-content-center py-2">
                        <!--begin::Step 1-->
                        <div class="stepper-item me-5 me-md-15 current" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">
                                Campaign Details
                            </h3>
                        </div>
                        <!--end::Step 1-->

                        <!--begin::Step 2-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">
                                Creative Uploads
                            </h3>
                        </div>
                        <!--end::Step 2-->

                        <!--begin::Step 3-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">
                                Audiences
                            </h3>
                        </div>
                        <!--end::Step 3-->

                        <!--begin::Step 4-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">
                                Budget Estimates
                            </h3>
                        </div>
                        <!--end::Step 4-->

                        <!--begin::Step 5-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">
                                Completed
                            </h3>
                        </div>
                        <!--end::Step 5-->
                    </div>
                    <!--end::Nav-->

                    <!--begin::Form-->
                    <form class="mx-auto w-100 mw-600px pt-15 pb-10" novalidate="novalidate" id="kt_modal_create_campaign_stepper_form">
                        
<!--begin::Step 1-->
<div class="current" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-15">
            <!--begin::Title-->
            <h2 class="fw-bold d-flex align-items-center text-dark">
                Setup Campaign Details
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campaign name will be used as reference within your campaign reports"></i>
            </h2>
            <!--end::Title-->

            <!--begin::Notice-->
            <div class="text-muted fw-semibold fs-6">
                If you need more info, please check out
                <a href="#" class="link-primary fw-bold">Help Page</a>.
            </div>
            <!--end::Notice-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <!--begin::Label-->
            <label class="required form-label mb-3">Campaign Name</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input type="text" class="form-control form-control-lg form-control-solid" name="campaign_name" placeholder="" value="" />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="d-block fw-semibold fs-6 mb-5">
                <span class="required">Company Logo</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="E.g. Select a logo to represent the company that's running the campaign."></i>
            </label>
            <!--end::Label-->

            <!--begin::Image input placeholder-->
            <style>
                .image-input-placeholder {
                    background-image: url('<?php echo $web_root ?>assets/assets/media/svg/files/blank-image.svg');
                }

                [data-bs-theme="dark"] .image-input-placeholder {
                    background-image: url('<?php echo $web_root ?>assets/assets/media/svg/files/blank-image-dark.svg');
                }                
            </style>
            <!--end::Image input placeholder-->

            <!--begin::Image input-->
            <div class="image-input image-input-empty image-input-outline image-input-placeholder" data-kt-image-input="true">
                <!--begin::Preview existing avatar-->
                <div class="image-input-wrapper w-125px h-125px"></div>
                <!--end::Preview existing avatar-->

                <!--begin::Label-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <i class="bi bi-pencil-fill fs-7"></i>

                    <!--begin::Inputs-->
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    <!--end::Inputs-->
                </label>
                <!--end::Label-->

                <!--begin::Cancel-->
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Cancel-->

                <!--begin::Remove-->
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Remove-->
            </div>
            <!--end::Image input-->

            <!--begin::Hint-->
            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
            <!--end::Hint-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-5">Campaign Goal</label>
            <!--end::Label-->

            <!--begin::Roles-->
                            <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="user_role" type="radio" value="0" id="kt_modal_update_role_option_0" checked='checked' />
                        <!--end::Input-->

                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_0">
                            <div class="fw-bold text-gray-800">Get more visitors</div>
                            <div class="text-gray-600">Increase impression traffic onto the platform</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->

                <div class='separator separator-dashed my-5'></div>                            <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="user_role" type="radio" value="1" id="kt_modal_update_role_option_1"  />
                        <!--end::Input-->

                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                            <div class="fw-bold text-gray-800">Get more messages on chat</div>
                            <div class="text-gray-600">Increase community interaction and communication</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->

                <div class='separator separator-dashed my-5'></div>                            <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="user_role" type="radio" value="2" id="kt_modal_update_role_option_2"  />
                        <!--end::Input-->

                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_2">
                            <div class="fw-bold text-gray-800">Get more calls</div>
                            <div class="text-gray-600">Boost telecommunication feedback to provide precise and accurate information</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->

                <div class='separator separator-dashed my-5'></div>                            <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="user_role" type="radio" value="3" id="kt_modal_update_role_option_3"  />
                        <!--end::Input-->

                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_3">
                            <div class="fw-bold text-gray-800">Get more likes</div>
                            <div class="text-gray-600">Increase positive interactivity on social media platforms</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->

                <div class='separator separator-dashed my-5'></div>                            <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="user_role" type="radio" value="4" id="kt_modal_update_role_option_4"  />
                        <!--end::Input-->

                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_4">
                            <div class="fw-bold text-gray-800">Lead generation</div>
                            <div class="text-gray-600">Collect contact information for potential customers</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->

                                        <!--end::Roles-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Step 1-->
                        
<!--begin::Step 2-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->   
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Upload Files</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check
                <a href="#" class="link-primary">Campaign Guidelines</a>
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">            
            <!--begin::Dropzone-->
            <div class="dropzone" id="kt_modal_create_campaign_files_upload">
                <!--begin::Message-->
                <div class="dz-message needsclick">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
<span class="svg-icon svg-icon-3hx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/>
<path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/>
<path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/>
<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    <!--end::Icon-->

                    <!--begin::Info-->
                    <div class="ms-4">
                        <h3 class="dfs-3 fw-bold text-gray-900 mb-1">Drop campaign files here or click to upload.</h3>
                        <span class="fw-semibold fs-4 text-muted">Upload up to 10 files</span>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Dropzone-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">Uploaded File</label>
            <!--End::Label-->

            <!--begin::Files-->
            <div class="mh-300px scroll-y me-n7 pe-7">
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/pdf.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Product Specifications</a>
                                <div class="fw-semibold text-muted">230kb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/tif.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Campaign Creative Poster</a>
                                <div class="fw-semibold text-muted">2.4mb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/folder-document.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Campaign Landing Page Source</a>
                                <div class="fw-semibold text-muted">1.12mb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/css.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Landing Page Styling</a>
                                <div class="fw-semibold text-muted">85kb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/ai.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Design Source Files</a>
                                <div class="fw-semibold text-muted">48mb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 ">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/doc.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Campaign Plan Document</a>
                                <div class="fw-semibold text-muted">27kb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                            </div>
            <!--end::Files-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Wrapper-->   
</div>
<!--end::Step 2-->
                        <!--begin::Step 3-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Configure Audiences</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check
                <a href="#" class="link-primary">Campaign Guidelines</a>
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">
                Gender
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Show your ads to either men or women, or select 'All' for both"></i>
            </label>
            <!--End::Label-->

            <!--begin::Row-->
            <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                <!--begin::Col-->
                <div class="col">
                    <!--begin::Option-->
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input class="form-check-input" type="radio" name="campaign_gender" value="1" checked="checked" />
                        </span>
                        <!--end::Radio-->

                        <!--begin::Info-->
                        <span class="ms-5">
                            <span class="fs-4 fw-bold text-gray-800 d-block">All</span>
                        </span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col">
                    <!--begin::Option-->
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input class="form-check-input" type="radio" name="campaign_gender" value="2" />
                        </span>
                        <!--end::Radio-->

                        <!--begin::Info-->
                        <span class="ms-5">
                            <span class="fs-4 fw-bold text-gray-800 d-block">Male</span>
                        </span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col">
                    <!--begin::Option-->
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input class="form-check-input" type="radio" name="campaign_gender" value="3" />
                        </span>
                        <!--end::Radio-->

                        <!--begin::Info-->
                        <span class="ms-5">
                            <span class="fs-4 fw-bold text-gray-800 d-block">Female</span>
                        </span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">
                Age
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select the minimum and maximum age of the people who will find your ad relevant."></i>
            </label>
            <!--End::Label-->

            <!--begin::Slider-->
            <div class="d-flex flex-stack">
                <div id="kt_modal_create_campaign_age_min" class="fs-7 fw-semibold text-muted"></div>
                <div id="kt_modal_create_campaign_age_slider" class="noUi-sm w-100 ms-5 me-8"></div>
                <div id="kt_modal_create_campaign_age_max" class="fs-7 fw-semibold text-muted"></div>
            </div>
            <!--end::Slider-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">
                Location
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Enter one or more location points for more specific targeting."></i>
            </label>
            <!--End::Label-->

            <!--begin::Tagify-->
            <input class="form-control d-flex align-items-center" value="" id="kt_modal_create_campaign_location" data-kt-flags-path="<?php echo $web_root ?>assets/assets/media/flags/"/>
            <!--end::Tagify-->
        </div>
        <!--end::Input group-->

    </div>
    <!--end::Wrapper-->
</div>
<!--end::Step 3-->
                        <!--begin::Step 4-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Budget Estimates</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check
                <a href="#" class="link-primary">Campaign Guidelines</a>
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">
                Campaign Duration
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Choose how long you want your ad to run for"></i>
            </label>
            <!--end::Label-->

            <!--begin::Duration option-->
            <div class="d-flex gap-9 mb-7">
                <!--begin::Button-->
                <button type="button" class="btn btn-outline btn-outline-dashed btn-active-light-primary active" id="kt_modal_create_campaign_duration_all">
                    Continuous duration<br />
                    <span class="fs-7">Your ad will run continuously for a daily budget.</span>
                </button>
                <!--end::Button-->

                <!--begin::Button-->
                <button type="button" class="btn btn-outline btn-outline-dashed btn-active-light-primary btn-outline-default" id="kt_modal_create_campaign_duration_fixed">
                    Fixed duration<br />
                    <span class="fs-7">Your ad will run on the specified dates only.</span>
                </button>
                <!--end::Button-->
            </div>
            <!--end::Duration option-->

            <!--begin::Datepicker-->
            <input class="form-control form-control-solid d-none" placeholder="Pick date & time" id="kt_modal_create_campaign_datepicker" />
            <!--end::Datepicker-->
        </div>
        <!--end::Input group-->


        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">
                Daily Budget
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Choose the budget allocated for each day. Higher budget will generate better results"></i>
            </label>
            <!--end::Label-->

            <!--begin::Slider-->
            <div class="d-flex flex-column text-center">
                <div class="d-flex align-items-start justify-content-center mb-7">
                    <span class="fw-bold fs-4 mt-1 me-2">$</span>
                    <span class="fw-bold fs-3x" id="kt_modal_create_campaign_budget_label"></span>
                    <span class="fw-bold fs-3x">.00</span>
                </div>
                <div id="kt_modal_create_campaign_budget_slider" class="noUi-sm"></div>
            </div>
            <!--end::Slider-->

        </div>
        <!--end::Input group-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Step 4-->
                        <!--begin::Step 5-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-12 text-center">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Campaign Created!</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="fw-semibold text-muted fs-4">
                You will receive an email with with the summary of your newly created campaign!
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

         <!--begin::Actions-->
         <div class="d-flex flex-center pb-20">
            <button id="kt_modal_create_campaign_create_new" type="button" class="btn btn-lg btn-light me-3" data-kt-element="complete-start">
                Create New Campaign
            </button>

            <a href="" class="btn btn-lg btn-primary" data-bs-toggle="tooltip" title="Coming Soon">
                View Campaign
            </a>
        </div>
        <!--end::Actions-->

        <!--begin::Illustration-->
        <div class="text-center px-4">
            <img src="<?php echo $web_root ?>assets/assets/media/illustrations/sketchy-1/9.png" alt="" class="mww-100 mh-350px"/>          
        </div>
        <!--end::Illustration-->
    </div>
</div>
<!--end::Step 5-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-10">
                            <!--begin::Wrapper-->
                            <div class="me-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
<span class="svg-icon svg-icon-3 me-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"/>
<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                    Back
                                </button>
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div>
                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
                                    <span class="indicator-label">
                                        Submit
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-3 ms-2 me-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>

                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                    Continue
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
<span class="svg-icon svg-icon-3 ms-1 me-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--begin::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal - Create Campaign--><!--begin::Modal - Create Project-->
<div class="modal fade" id="kt_modal_create_project" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-fullscreen p-9">
        <!--begin::Modal content-->
        <div class="modal-content modal-rounded">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Create Project</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y m-5">
                <!--begin::Stepper-->
                <div class="stepper stepper-links d-flex flex-column" id="kt_modal_create_project_stepper">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Nav-->
                        <div class="stepper-nav justify-content-center py-2">
                            <!--begin::Step 1-->
                            <div class="stepper-item me-5 me-md-15 current" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Project Type
                                </h3>
                            </div>
                            <!--end::Step 1-->

                            <!--begin::Step 2-->
                            <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Project Settings
                                </h3>
                            </div>
                            <!--end::Step 2-->

                            <!--begin::Step 3-->
                            <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Budget
                                </h3>
                            </div>
                            <!--end::Step 3-->

                            <!--begin::Step 4-->
                            <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Build A Team
                                </h3>
                            </div>
                            <!--end::Step 4-->

                            <!--begin::Step 5-->
                            <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Set First Target
                                </h3>
                            </div>
                            <!--end::Step 5-->

                            <!--begin::Step 6-->
                            <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Upload Files
                                </h3>
                            </div>
                            <!--end::Step 6-->

                            <!--begin::Step 7-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Completed
                                </h3>
                            </div>
                            <!--end::Step 7-->
                        </div>
                        <!--end::Nav-->

                        <!--begin::Form-->
                        <form class="mx-auto w-100 mw-600px pt-15 pb-10" novalidate="novalidate" id="kt_modal_create_project_form" method="post">
                            <!--begin::Type-->
<div class="current" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-7 pb-lg-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Project Type</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check out
                <a href="#" class="link-primary fw-bold">FAQ Page</a>
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-15" data-kt-buttons="true">
            <!--begin::Option-->
            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 mb-6 active">
                <!--begin::Input-->
                <input class="btn-check" type="radio" checked="checked" name="project_type" value="1"/>
                <!--end::Input-->

                <!--begin::Label-->
                <span class="d-flex">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
<span class="svg-icon svg-icon-3hx"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"/>
<path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"/>
<rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    <!--end::Icon-->

                    <!--begin::Info-->
                    <span class="ms-4">
                        <span class="fs-3 fw-bold text-gray-900 mb-2 d-block">Personal Project</span>

                        <span class="fw-semibold fs-4 text-muted">
                            If you need more info, please check it out
                        </span>
                    </span>
                    <!--end::Info-->
                </span>
                <!--end::Label-->
            </label>
            <!--end::Option-->

            <!--begin::Option-->
            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6">
                <!--begin::Input-->
                <input class="btn-check" type="radio" name="project_type" value="2"/>
                <!--end::Input-->

                <!--begin::Label-->
                <span class="d-flex">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
<span class="svg-icon svg-icon-3hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z" fill="currentColor"/>
<path d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    <!--end::Icon-->

                    <!--begin::Info-->
                    <span class="ms-4">
                        <span class="fs-3 fw-bold text-gray-900 mb-2 d-block">Team Project</span>

                        <span class="fw-semibold fs-4 text-muted">
                            Create corporate account to manage users
                        </span>
                    </span>
                    <!--end::Info-->
                </span>
                <!--end::Label-->
            </label>
            <!--end::Option-->
        </div>
        <!--end::Input group-->
        
        <!--begin::Actions-->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-lg btn-primary" data-kt-element="type-next">
                <span class="indicator-label">
                    Project Settings
                </span>
                <span class="indicator-progress">
                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Type-->
                            <!--begin::Settings-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Project Settings</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check
                <a href="#" class="link-primary">Project Guidelines</a>
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">            
            <!--begin::Dropzone-->
            <div class="dropzone" id="kt_modal_create_project_settings_logo">
                <!--begin::Message-->
                <div class="dz-message needsclick">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
<span class="svg-icon svg-icon-3hx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/>
<path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/>
<path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/>
<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    <!--end::Icon-->

                    <!--begin::Info-->
                    <div class="ms-4">
                        <h3 class="dfs-3 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                        <span class="fw-semibold fs-4 text-muted">Upload up to 10 files</span>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Dropzone-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="required fs-6 fw-semibold mb-2">Customer</label>
            <!--end::Label-->

            <!--begin::Input-->
            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select..." name="settings_customer">
                <option></option>
                <option value="1">Keenthemes</option>
                <option value="2">CRM App</option>
            </select>
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="required">Project Name</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify project name"></i>
            </label>
            <!--end::Label-->
            
            <!--begin::Input-->
            <input type="text" class="form-control form-control-solid" placeholder="Enter Project Name" value="StockPro Mobile App" name="settings_name"/>
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="required fs-6 fw-semibold mb-2">Project Description</label>
            <!--end::Label-->

            <!--begin::Input-->
            <textarea class="form-control form-control-solid" rows="3" placeholder="Enter Project Description" name="settings_description">
            Experience share market at your fingertips with TICK PRO stock investment mobile trading app
            </textarea>
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="required fs-6 fw-semibold mb-2">Release Date</label>
            <!--end::Label-->

            <!--begin::Wrapper-->
            <div class="position-relative d-flex align-items-center">
                <!--begin::Icon-->
                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
<span class="svg-icon svg-icon-2 position-absolute mx-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"/>
<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"/>
<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                <!--end::Icon-->

                <!--begin::Input-->
                <input class="form-control form-control-solid ps-12" placeholder="Pick date range" name="settings_release_date"/>
                <!--end::Input-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-15">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="required fs-6 fw-semibold">Notifications</label>
                    <div class="fs-7 fw-semibold text-muted">Allow Notifications by Phone or Email</div>
                </div>
                <!--end::Label-->
                
                <!--begin::Checkboxes-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-10">
                        <!--begin::Input-->
                        <input class="form-check-input h-20px w-20px" type="checkbox" value="email" name="settings_notifications[]"/>
                        <!--end::Input-->

                        <!--begin::Label-->
                        <span class="form-check-label fw-semibold">
                            Email
                        </span>
                        <!--end::Label-->
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input h-20px w-20px" type="checkbox" value="phone" checked name="settings_notifications[]"/>
                        <!--end::Input-->

                        <!--begin::Label-->
                        <span class="form-check-label fw-semibold">
                            Phone
                        </span>
                        <!--end::Label-->
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Checkboxes-->
            </div>
            <!--begin::Wrapper-->
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-stack">
            <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="settings-previous">
                Project Type
            </button>
            
            <button type="button" class="btn btn-lg btn-primary" data-kt-element="settings-next">
                <span class="indicator-label">
                    Budget
                </span>
                <span class="indicator-progress">
                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Settings-->
                            <!--begin::Budget-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Budget</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check
                <a href="#" class="link-primary">Project Guidelines</a>
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Setup Budget</span>

                <i 
                    class="fas fa-exclamation-circle ms-2 fs-7" 
                    data-bs-toggle="popover" 
                    data-bs-trigger="hover"
                    data-bs-html="true"
                    data-bs-content="
                        <div class='p-4 rounded bg-light'>
                            <div class='d-flex flex-stack text-muted mb-4'>
                                <i class='fas fa-university fs-3 me-3'></i>

                                <div class='fw-bold'>INCBANK **** 1245 STATEMENT</div>
                            </div>

                            <div class='d-flex flex-stack fw-semibold text-gray-600'>
                                <div>Amount</div>
                                <div>Transaction</div>
                            </div>

                            <div class='separator separator-dashed my-2'></div>

                            <div class='d-flex flex-stack text-dark fw-bold mb-2'>
                                <div>USD345.00</div>
                                <div>KEENTHEMES*</div>
                            </div>

                            <div class='d-flex flex-stack text-muted mb-2'>
                                <div>USD75.00</div>
                                <div>Hosting fee</div>
                            </div>

                            <div class='d-flex flex-stack text-muted'>
                                <div>USD3,950.00</div>
                                <div>Payrol</div>
                            </div>
                        </div>
                    ">
                </i>
            </label>
            <!--end::Label-->

            <!--begin::Dialer-->
            <div class="position-relative w-lg-250px"
                id="kt_modal_create_project_budget_setup"
                data-kt-dialer="true"
                data-kt-dialer-min="50"
                data-kt-dialer-max="50000"
                data-kt-dialer-step="100"
                data-kt-dialer-prefix="$"
                data-kt-dialer-decimals="2">

                <!--begin::Decrease control-->
                <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen042.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                </button>
                <!--end::Decrease control-->

                <!--begin::Input control-->
                <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="budget_setup" readonly value="$50"/>
                <!--end::Input control-->

                <!--begin::Increase control-->
                <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen041.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                </button>
                <!--end::Increase control-->
            </div>
            <!--end::Dialer-->  
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">Budget Usage</label>
            <!--end::Label-->

            <!--begin::Row-->
            <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-12 col-xxl-6">
                    <!--begin::Option-->
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input class="form-check-input" type="radio" name="budget_usage" value="1" checked="checked" />
                        </span>
                        <!--end::Radio-->

                        <!--begin::Info-->
                        <span class="ms-5">
                            <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Precise Usage</span>

                            <span class="fw-semibold fs-7 text-gray-600">
                                Withdraw money to your bank account per transaction under $50,000 budget
                            </span>
                        </span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 col-lg-12 col-xxl-6">
                    <!--begin::Option-->
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input class="form-check-input" type="radio" name="budget_usage" value="2" />
                        </span>
                        <!--end::Radio-->

                        <!--begin::Info-->
                        <span class="ms-5">
                            <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Extreme Usage</span>
                            <span class="fw-semibold fs-7 text-gray-600">
                                Withdraw money to your bank account per transaction under $50,000 budget
                            </span>
                        </span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-15">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-semibold">Allow Changes in Budget</label>
                    <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
                </div>
                <!--end::Label-->

                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" name="budget_allow" checked="checked"/>
                    <span class="form-check-label fw-semibold text-muted">
                        Allowed
                    </span>
                </label>
                <!--end::Switch-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-stack">
            <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="budget-previous">
                Project Settings
            </button>
            
            <button type="button" class="btn btn-lg btn-primary" data-kt-element="budget-next">
                <span class="indicator-label">
                    Build Team
                </span>
                <span class="indicator-progress">
                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Budget-->
                            
<!--begin::Team-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Build a Team</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check
                <a href="#" class="link-primary">Project Guidelines</a>
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="mb-8">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">Invite Teammates</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input type="text" class="form-control form-control-solid" placeholder="Add project memnbers by name or email.." name="invite_teammates" />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="mb-8">
            <!--begin::Label-->
            <div class="fs-6 fw-semibold mb-2">Team Members</div>
            <!--end::Label-->

            <!--begin::Users-->
            <div class="mh-300px scroll-y me-n7 pe-7">
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-6.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Smith</a>

                                <div class="fw-semibold text-muted">smith@kpmg.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" selected>Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                        M                                    </span>
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>

                                <div class="fw-semibold text-muted">melody@altbox.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" selected>Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max Smith</a>

                                <div class="fw-semibold text-muted">max@kt.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" selected>Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-5.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Sean Bean</a>

                                <div class="fw-semibold text-muted">sean@dellito.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" selected>Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Brian Cox</a>

                                <div class="fw-semibold text-muted">brian@exchange.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" selected>Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <span class="symbol-label bg-light-warning text-warning fw-semibold">
                                        C                                    </span>
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>

                                <div class="fw-semibold text-muted">mik@pex.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" selected>Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-9.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>

                                <div class="fw-semibold text-muted">f.mit@kpmg.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" selected>Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                        O                                    </span>
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Olivia Wild</a>

                                <div class="fw-semibold text-muted">olivia@corpmail.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" selected>Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <span class="symbol-label bg-light-primary text-primary fw-semibold">
                                        N                                    </span>
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Neil Owen</a>

                                <div class="fw-semibold text-muted">owen.neil@gmail.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" selected>Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-23.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Dan Wilson</a>

                                <div class="fw-semibold text-muted">dam@consilting.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" selected>Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                        E                                    </span>
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Bold</a>

                                <div class="fw-semibold text-muted">emma@intenso.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" selected>Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-12.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ana Crown</a>

                                <div class="fw-semibold text-muted">ana.cf@limtel.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" selected>Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <span class="symbol-label bg-light-info text-info fw-semibold">
                                        A                                    </span>
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert Doe</a>

                                <div class="fw-semibold text-muted">robert@benko.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" selected>Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-13.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John Miller</a>

                                <div class="fw-semibold text-muted">miller@mapple.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" selected>Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <span class="symbol-label bg-light-success text-success fw-semibold">
                                        L                                    </span>
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>

                                <div class="fw-semibold text-muted">lucy.m@fentech.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" selected>Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-21.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>

                                <div class="fw-semibold text-muted">ethan@loop.com.au</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" selected>Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" >Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                                                        <!--begin::User-->
                    <div class="d-flex flex-stack py-4 ">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg" />
                                                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max Smith</a>

                                <div class="fw-semibold text-muted">max@kt.com</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->

                        <!--begin::Access menu-->
                        <div class="ms-2 w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1" >Guest</option>
                                <option value="2" >Owner</option>
                                <option value="3" selected>Can Edit</option>
                            </select>
                        </div>
                        <!--end::Access menu-->
                    </div>
                    <!--end::User-->
                            </div>
            <!--end::Users-->
        </div>
        <!--end::Input group-->

        <!--begin::Notice-->
        <div class="d-flex flex-stack mb-15">
            <!--begin::Label-->                        
            <div class="me-5 fw-semibold">
                <label class="fs-6">Adding Users by Team Members</label>
                <div class="fs-7 text-muted">If you need more info, please check budget planning</div>
            </div>
            <!--end::Label-->     

            <!--begin::Switch-->
            <label class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="" checked="checked"/>
            </label>
            <!--end::Switch-->
        </div>
        <!--end::Notice-->

        <!--begin::Actions-->
        <div class="d-flex flex-stack">
            <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="team-previous">
                Budget
            </button>
            
            <button type="button" class="btn btn-lg btn-primary" data-kt-element="team-next">
                <span class="indicator-label">
                    Set Target
                </span>
                <span class="indicator-progress">
                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>                
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Team-->
                            
<!--begin::Targets-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Set First Target</h1>
            <!--end::Title-->

            <!--begin::Title-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check
                <a href="#" class="link-primary">Project Guidelines</a>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <label class="fs-6 fw-semibold mb-2">Target Title</label>
            <input type="text" class="form-control form-control-solid" placeholder="Enter Target Title" name="target_title" name="Project Launch" />
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Assign</label>
                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a Team Member" name="target_assign">
                    <option></option>
                    <option value="1">Karina Clark</option>
                    <option value="2" selected>Robert Doe</option>
                    <option value="3">Niel Owen</option>
                    <option value="4">Olivia Wild</option>
                    <option value="5">Sean Bean</option>
                </select>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Due Date</label>
                <div class="position-relative d-flex align-items-center">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
<span class="svg-icon svg-icon-2 position-absolute mx-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"/>
<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"/>
<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    <!--end::Icon-->

                    <!--begin::Datepicker-->
                    <input class="form-control form-control-solid ps-12" placeholder="Pick date range" name="target_due_date" />
                    <!--end::Datepicker-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <label class="fs-6 fw-semibold mb-2">Target Details</label>
            <textarea class="form-control form-control-solid" rows="2" name="target_details" placeholder="Type Target Details">
            Experience share market at your fingertips with TICK PRO stock investment mobile trading app
            </textarea>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <label class="required fs-6 fw-semibold mb-2">Tags</label>
            <input class="form-control form-control-solid" value="Important, Urgent" name="target_tags"/>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-semibold">Allow Changes in Budget</label>
                    <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
                </div>
                <!--end::Label-->

                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" name="target_allow" checked="checked"/>
                    <span class="form-check-label fw-semibold text-muted">
                        Allowed
                    </span>
                </label>
                <!--end::Switch-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-15">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-semibold">Notifications</label>
                    <div class="fs-7 fw-semibold text-muted">Allow Notifications by Phone or Email</div>
                </div>
                <!--end::Label-->
                
                <!--begin::Checkboxes-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-10">
                        <!--begin::Input-->
                        <input class="form-check-input h-20px w-20px" type="checkbox" value="email" name="target_notifications[]"/>
                        <!--end::Input-->

                        <!--begin::Label-->
                        <span class="form-check-label fw-semibold">
                            Email
                        </span>
                        <!--end::Label-->
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input h-20px w-20px" type="checkbox" value="phone" checked name="target_notifications[]"/>
                        <!--end::Input-->

                        <!--begin::Label-->
                        <span class="form-check-label fw-semibold">
                            Phone
                        </span>
                        <!--end::Label-->
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Checkboxes-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-stack">
            <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="targets-previous">
                Build a Team
            </button>
                
            <button type="button" class="btn btn-lg btn-primary" data-kt-element="targets-next">
                <span class="indicator-label">
                    Upload Files
                </span>
                <span class="indicator-progress">
                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Targets-->
                            
<!--begin::Files-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->   
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-12">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Upload Files</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check
                <a href="#" class="link-primary">Project Guidelines</a>
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">            
            <!--begin::Dropzone-->
            <div class="dropzone" id="kt_modal_create_project_files_upload">
                <!--begin::Message-->
                <div class="dz-message needsclick">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
<span class="svg-icon svg-icon-3hx svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/>
<path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/>
<path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/>
<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                    <!--end::Icon-->

                    <!--begin::Info-->
                    <div class="ms-4">
                        <h3 class="dfs-3 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                        <span class="fw-semibold fs-4 text-muted">Upload up to 10 files</span>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Dropzone-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="mb-8">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">Uploaded File</label>
            <!--End::Label-->

            <!--begin::Files-->
            <div class="mh-300px scroll-y me-n7 pe-7">
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/pdf.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Avionica Technical Requirements</a>
                                <div class="fw-semibold text-muted">230kb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/doc.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">9 Degree CURD draftplan</a>
                                <div class="fw-semibold text-muted">3.6mb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/css.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">User CRUD Styles</a>
                                <div class="fw-semibold text-muted">85kb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 border border-top-0 border-left-0 border-right-0 border-dashed">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/ai.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Design Initial Logo</a>
                                <div class="fw-semibold text-muted">40kb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                                    <!--begin::File-->
                    <div class="d-flex flex-stack py-4 ">
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px">
                                <img src="<?php echo $web_root ?>assets/assets/media/svg/files/tif.svg" alt="icon" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Details-->
                            <div class="ms-6">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Tower Hill Bilboard</a>
                                <div class="fw-semibold text-muted">27mb</div>
                            </div>
                            <!--end::Details-->
                        </div>

                        <!--begin::Menu-->
                        <div class="min-w-100px">
                            <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Edit">
                                <option></option>
                                <option value="1">Remove</option>
                                <option value="2">Modify</option>
                                <option value="3">Select</option>
                            </select>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::File-->
                            </div>
            <!--end::Files-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-semibold">Allow Changes in Budget</label>
                    <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
                </div>
                <!--end::Label-->

                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" name="target_allow" checked="checked"/>
                    <span class="form-check-label fw-semibold text-muted">
                        Allowed
                    </span>
                </label>
                <!--end::Switch-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-stack">
            <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="files-previous">
                Set First Target
            </button>

            <button type="button" class="btn btn-lg btn-primary" data-kt-element="files-next">
                <span class="indicator-label">
                    Complete
                </span>
                <span class="indicator-progress">
                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>                
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Wrapper-->   
</div>
<!--end::Files-->
                            <!--begin::Complete-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-12 text-center">
            <!--begin::Title-->
            <h1 class="fw-bold text-dark">Project Created!</h1>
            <!--end::Title-->

            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-4">
                If you need more info, please check how to create project
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

         <!--begin::Actions-->
         <div class="d-flex flex-center pb-20">
            <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="complete-start">
                Create New Project
            </button>

            <a href="" class="btn btn-lg btn-primary" data-bs-toggle="tooltip" title="Coming Soon">
                View Project
            </a>
        </div>
        <!--end::Actions-->

        <!--begin::Illustration-->
        <div class="text-center px-4">
            <img src="<?php echo $web_root ?>assets/assets/media/illustrations/sketchy-1/9.png" alt="" class="mww-100 mh-350px"/>          
        </div>
        <!--end::Illustration-->
    </div>
</div>
<!--end::Complete-->                        </form>
                        <!--end::Form-->
                    </div>
                    <!--begin::Container-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Create Project--><!--begin::Modal - Users Search-->
<div class="modal fade" id="kt_modal_users_search" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Content-->
                <div class="text-center mb-13">
                    <h1 class="mb-3">Search Users</h1>

                    <div class="text-muted fw-semibold fs-5">
                        Invite Collaborators To Your Project
                    </div>
                </div>
                <!--end::Content-->

                <!--begin::Search-->
                <div 
                    id="kt_modal_users_search_handler" 
                    
                    data-kt-search-keypress="true"
                    data-kt-search-min-length="2"
                    data-kt-search-enter="enter"     
                    data-kt-search-layout="inline">

                    <!--begin::Form-->
                    <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">	
                        <!--begin::Hidden input(Added to disable form autocomplete)-->
                        <input type="hidden"/>
                        <!--end::Hidden input-->

                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
<span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                        <!--end::Icon-->

                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search by username, full name or email..." data-kt-search-element="input"/>
                        <!--end::Input-->

                        <!--begin::Spinner-->
                        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                        </span>
                        <!--end::Spinner-->

                        <!--begin::Reset-->
                        <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
<span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
</svg>

</span>
<!--end::Svg Icon-->                        </span>
                        <!--end::Reset-->
                    </form>
                    <!--end::Form-->

                    <!--begin::Wrapper-->
                    <div class="py-5">                            
                        <!--begin::Suggestions-->
<div data-kt-search-element="suggestions">
    <!--begin::Heading-->
    <h3 class="fw-semibold mb-5">Recently searched:</h3>
    <!--end::Heading-->

    <!--begin::Users-->
    <div class="mh-375px scroll-y me-n7 pe-7">
                                <!--begin::User-->
            <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle me-5">
                                            <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-6.jpg" />
                                    </div>
                <!--end::Avatar-->

                <!--begin::Info-->
                <div class="fw-semibold">
                    <span class="fs-6 text-gray-800 me-2">Emma Smith</span>
                    <span class="badge badge-light">Art Director</span>
                </div>
                <!--end::Info-->
            </a>
            <!--end::User-->
                                <!--begin::User-->
            <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle me-5">
                                            <span class="symbol-label bg-light-danger text-danger fw-semibold">
                            M                        </span>
                                    </div>
                <!--end::Avatar-->

                <!--begin::Info-->
                <div class="fw-semibold">
                    <span class="fs-6 text-gray-800 me-2">Melody Macy</span>
                    <span class="badge badge-light">Marketing Analytic</span>
                </div>
                <!--end::Info-->
            </a>
            <!--end::User-->
                                <!--begin::User-->
            <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle me-5">
                                            <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg" />
                                    </div>
                <!--end::Avatar-->

                <!--begin::Info-->
                <div class="fw-semibold">
                    <span class="fs-6 text-gray-800 me-2">Max Smith</span>
                    <span class="badge badge-light">Software Enginer</span>
                </div>
                <!--end::Info-->
            </a>
            <!--end::User-->
                                <!--begin::User-->
            <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle me-5">
                                            <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-5.jpg" />
                                    </div>
                <!--end::Avatar-->

                <!--begin::Info-->
                <div class="fw-semibold">
                    <span class="fs-6 text-gray-800 me-2">Sean Bean</span>
                    <span class="badge badge-light">Web Developer</span>
                </div>
                <!--end::Info-->
            </a>
            <!--end::User-->
                                <!--begin::User-->
            <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle me-5">
                                            <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg" />
                                    </div>
                <!--end::Avatar-->

                <!--begin::Info-->
                <div class="fw-semibold">
                    <span class="fs-6 text-gray-800 me-2">Brian Cox</span>
                    <span class="badge badge-light">UI/UX Designer</span>
                </div>
                <!--end::Info-->
            </a>
            <!--end::User-->
            </div>
    <!--end::Users-->
</div>
<!--end::Suggestions-->
                        
<!--begin::Results(add d-none to below element to hide the users list by default)-->
<div data-kt-search-element="results" class="d-none">
    <!--begin::Users-->
    <div class="mh-375px scroll-y me-n7 pe-7">
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='0']" value="0"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-6.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Smith</a>

                        <div class="fw-semibold text-muted">smith@kpmg.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" selected>Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="1">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='1']" value="1"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                M                            </span>
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>

                        <div class="fw-semibold text-muted">melody@altbox.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" selected>Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="2">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='2']" value="2"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max Smith</a>

                        <div class="fw-semibold text-muted">max@kt.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" selected>Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="3">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='3']" value="3"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-5.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Sean Bean</a>

                        <div class="fw-semibold text-muted">sean@dellito.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" selected>Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="4">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='4']" value="4"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-25.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Brian Cox</a>

                        <div class="fw-semibold text-muted">brian@exchange.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" selected>Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="5">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='5']" value="5"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-warning text-warning fw-semibold">
                                C                            </span>
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>

                        <div class="fw-semibold text-muted">mik@pex.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" selected>Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="6">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='6']" value="6"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-9.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>

                        <div class="fw-semibold text-muted">f.mit@kpmg.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" selected>Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="7">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='7']" value="7"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                O                            </span>
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Olivia Wild</a>

                        <div class="fw-semibold text-muted">olivia@corpmail.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" selected>Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="8">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='8']" value="8"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-primary text-primary fw-semibold">
                                N                            </span>
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Neil Owen</a>

                        <div class="fw-semibold text-muted">owen.neil@gmail.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" selected>Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="9">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='9']" value="9"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-23.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Dan Wilson</a>

                        <div class="fw-semibold text-muted">dam@consilting.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" selected>Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="10">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='10']" value="10"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">
                                E                            </span>
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Bold</a>

                        <div class="fw-semibold text-muted">emma@intenso.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" selected>Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="11">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='11']" value="11"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-12.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ana Crown</a>

                        <div class="fw-semibold text-muted">ana.cf@limtel.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" selected>Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="12">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='12']" value="12"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-info text-info fw-semibold">
                                A                            </span>
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert Doe</a>

                        <div class="fw-semibold text-muted">robert@benko.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" selected>Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="13">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='13']" value="13"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-13.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John Miller</a>

                        <div class="fw-semibold text-muted">miller@mapple.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" selected>Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="14">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='14']" value="14"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-success text-success fw-semibold">
                                L                            </span>
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>

                        <div class="fw-semibold text-muted">lucy.m@fentech.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" selected>Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="15">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='15']" value="15"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-21.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>

                        <div class="fw-semibold text-muted">ethan@loop.com.au</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" selected>Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" >Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

                            <!--begin::Separator-->
                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                <!--end::Separator-->
            
                                <!--begin::User-->
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="16">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='16']" value="16"/>
                    </label>
                    <!--end::Checkbox-->

                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?php echo $web_root ?>assets/assets/media/avatars/300-1.jpg" />
                                            </div>
                    <!--end::Avatar-->

                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max Smith</a>

                        <div class="fw-semibold text-muted">max@kt.com</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->

                <!--begin::Access menu-->
                <div class="ms-2 w-100px">
                    <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="1" >Guest</option>
                        <option value="2" >Owner</option>
                        <option value="3" selected>Can Edit</option>
                    </select>
                </div>
                <!--end::Access menu-->
            </div>
            <!--end::User-->

            
            </div>
    <!--end::Users-->

    <!--begin::Actions-->
    <div class="d-flex flex-center mt-15">
        <button type="reset" id="kt_modal_users_search_reset" data-bs-dismiss="modal" class="btn btn-active-light me-3">
            Cancel
        </button>

        <button type="submit" id="kt_modal_users_search_submit" class="btn btn-primary">
            Add Selected Users
        </button>
    </div>
    <!--end::Actions-->
</div>
<!--end::Results-->
                        <!--begin::Empty-->
<div data-kt-search-element="empty" class="text-center d-none">
    <!--begin::Message-->
    <div class="fw-semibold py-10">
        <div class="text-gray-600 fs-3 mb-2">No users found</div>

        <div class="text-muted fs-6">Try to search by username, full name or email...</div>
    </div>
    <!--end::Message-->

    <!--begin::Illustration-->
    <div class="text-center px-5">
        <img src="<?php echo $web_root ?>assets/assets/media/illustrations/sketchy-1/1.png" alt="" class="w-100 h-200px h-sm-325px"/>        
    </div>
    <!--end::Illustration-->
</div>
<!--end::Empty-->                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Search-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Users Search-->            
<!--end::Modals-->
        
                <!--begin::Javascript-->
                <script>
                    var hostUrl = "<?php echo $web_root ?>assets/assets/";        
                </script>

                <script src="<?php echo $web_root ?>assets/assets/plugins/global/plugins.bundle.js"></script>
                <script src="<?php echo $web_root ?>assets/assets/js/scripts.bundle.js"></script>
                <script src="<?php echo $web_root ?>assets/assets/plugins/custom/datatables/datatables.bundle.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
                <script src="<?php echo $web_root ?>assets/assets/js/widgets.bundle.js"></script>
                <script src="<?php echo $web_root ?>assets/assets/js/custom/widgets.js"></script>
                <script src="<?php echo $web_root ?>assets/assets/js/chat.js"></script>
                <script src="<?php echo $web_root ?>assets/assets/js/upgrade-plan.js"></script>
                <script src="<?php echo $web_root ?>assets/assets/js/create-app.js"></script>            
                <script src="<?php echo $web_root ?>assets/assets/js/users-search.js"></script>
            <!--end::Custom Javascript-->
            </body>
    <!--end::Body-->
</html>