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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- vendor css -->
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">

    <!-- CMS CSS -->
    <link rel="stylesheet" href="../css/cms.css">
    <link rel="stylesheet" href="../css/navbarstyle.css">
  </head>

  <body class="collapsed-menu ">

    <!-- ########## START: LEFT PANEL ########## -->
  
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("fixed-blocks/header.php"); ?>
    

    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
  
      <!-- <div class="br-pagebody">
        <?php if($user_type == "Instructional Designer"){ ?>
        <div class="row">
          <div class="col-lg-4 mg-t-20 mg-lg-t-0">
            <div class="card bd-0 bg-transparent ht-100p">
              <img src="../img/dashboard.jpg" class="img-fit-cover rounded" alt="">
              <div class="overlay-body bg-black-5 rounded"></div>
              <div class="pos-absolute b-0 x-0 tx-center pd-30">
                <h3 class="tx-white tx-light tx-shadow">Create</h3>
                <p class="tx-13 tx-white-8 mg-b-25">Click Here To Create Task For New Slides.</p>
                <a href="taskListAddSlides.php" class="btn btn-info btn-oblong tx-11 pd-y-12 tx-uppercase d-block tx-semibold tx-mont">Create</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mg-t-20 mg-lg-t-0">
            <div class="card bd-0 bg-transparent ht-100p">
              <img src="../img/dashboard.jpg" class="img-fit-cover rounded" alt="">
              <div class="overlay-body bg-black-5 rounded"></div>
              <div class="pos-absolute b-0 x-0 tx-center pd-30">
                <h3 class="tx-white tx-light tx-shadow">Change</h3>
                <p class="tx-13 tx-white-8 mg-b-25">Click Here To Create Task For Existing Slides.</p>
                <a href="taskList.php" class="btn btn-info btn-oblong tx-11 pd-y-12 tx-uppercase d-block tx-semibold tx-mont">Change</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mg-t-20 mg-lg-t-0">
            <div class="card bd-0 bg-transparent ht-100p">
              <img src="../img/dashboard.jpg" class="img-fit-cover rounded" alt="">
              <div class="overlay-body bg-black-5 rounded"></div>
              <div class="pos-absolute b-0 x-0 tx-center pd-30">
                <h3 class="tx-white tx-light tx-shadow">Move Slides</h3>
                <p class="tx-13 tx-white-8 mg-b-25">Click Here To Move Slides From One Location to Another within Class and Topic or Different Class and Same Topic.</p>
                <a href="transactions/id/MHSlide.php" class="btn btn-info btn-oblong tx-11 pd-y-12 tx-uppercase d-block tx-semibold tx-mont">Move</a>
              </div>
            </div>
          </div>
        </div>
        <br/>
        <div class="row">
          <div class="col-lg-4 mg-t-20 mg-lg-t-0">
            <div class="card bd-0 bg-transparent ht-100p">
              <img src="../img/dashboard.jpg" class="img-fit-cover rounded" alt="">
              <div class="overlay-body bg-black-5 rounded"></div>
              <div class="pos-absolute b-0 x-0 tx-center pd-30">
                <h3 class="tx-white tx-light tx-shadow">Reports</h3>
                <p class="tx-13 tx-white-8 mg-b-25">Click Here To Reports Slides Status.</p>
                <a href="#" class="btn btn-info btn-oblong tx-11 pd-y-12 tx-uppercase d-block tx-semibold tx-mont">Reports</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mg-t-20 mg-lg-t-0">
            <div class="card bd-0 bg-transparent ht-100p">
              <img src="../img/dashboard.jpg" class="img-fit-cover rounded" alt="">
              <div class="overlay-body bg-black-5 rounded"></div>
              <div class="pos-absolute b-0 x-0 tx-center pd-30">
                <h3 class="tx-white tx-light tx-shadow">Production Ready</h3>
                <p class="tx-13 tx-white-8 mg-b-25">Click Here To Review Slides.</p>
                <a href="taskListProductionReady.php" class="btn btn-info btn-oblong tx-11 pd-y-12 tx-uppercase d-block tx-semibold tx-mont">Production Ready</a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div> -->

      <div class="br-pagebody ">
        <section id="home" class="mt-2">
            <div class="row new-row-bg">
                <div class="" id="kt_content">
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-4 mb-xl-10">       
                            
                    <!--begin::Lists Widget 19-->
                    <div class="card card-flush h-xl-100">   
                        <!--begin::Heading-->
                        <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('../img/top-green.png" data-bs-theme="light">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column text-white pt-15">
                                <span class="fw-bold fs-2x mb-3">My Tasks</span>
                                
                                <div class="fs-4 text-white">
                                    <span class="opacity-75">You have</span>

                                    <span class="position-relative d-inline-block">
                                        <a href="#" class="link-white opacity-75-hover fw-bold d-block mb-1">4 tasks</a>

                                        <!--begin::Separator-->
                                        <span class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
                                        <!--end::Separator--> 
                                    </span>    

                                    <span class="opacity-75">to complete</span>
                                </div>    
                            </h3>
                            <!--end::Title-->

                            <!--begin::Toolbar-->
                            <div class="card-toolbar pt-5">            
                                <!--begin::Menu-->
                                <button class="btn btn-sm btn-icon btn-active-color-primary btn-color-white bg-white bg-opacity-25 bg-hover-opacity-100 bg-hover-white bg-active-opacity-25 w-20px h-20px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">   
                                        
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                    <span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="10" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>
                    <rect x="17" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>
                    <rect x="3" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>
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
                    <path opacity="0.3" d="M17.9061 13H11.2061C11.2061 12.4 10.8061 12 10.2061 12C9.60605 12 9.20605 12.4 9.20605 13H6.50606L9.20605 8.40002V4C8.60605 4 8.20605 3.6 8.20605 3C8.20605 2.4 8.60605 2 9.20605 2H15.2061C15.8061 2 16.2061 2.4 16.2061 3C16.2061 3.6 15.8061 4 15.2061 4V8.40002L17.9061 13ZM13.2061 9C12.6061 9 12.2061 9.4 12.2061 10C12.2061 10.6 12.6061 11 13.2061 11C13.8061 11 14.2061 10.6 14.2061 10C14.2061 9.4 13.8061 9 13.2061 9Z" fill="currentColor"></path>
                    <path d="M18.9061 22H5.40605C3.60605 22 2.40606 20 3.30606 18.4L6.40605 13H9.10605C9.10605 13.6 9.50605 14 10.106 14C10.706 14 11.106 13.6 11.106 13H17.8061L20.9061 18.4C21.9061 20 20.8061 22 18.9061 22ZM14.2061 15C13.1061 15 12.2061 15.9 12.2061 17C12.2061 18.1 13.1061 19 14.2061 19C15.3061 19 16.2061 18.1 16.2061 17C16.2061 15.9 15.3061 15 14.2061 15Z" fill="currentColor"></path>
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
                    <path d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z" fill="currentColor"></path>
                    <path opacity="0.3" d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z" fill="currentColor"></path>
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
                    <path d="M14 18V16H10V18L9 20H15L14 18Z" fill="currentColor"></path>
                    <path opacity="0.3" d="M20 4H17V3C17 2.4 16.6 2 16 2H8C7.4 2 7 2.4 7 3V4H4C3.4 4 3 4.4 3 5V9C3 11.2 4.8 13 7 13C8.2 14.2 8.8 14.8 10 16H14C15.2 14.8 15.8 14.2 17 13C19.2 13 21 11.2 21 9V5C21 4.4 20.6 4 20 4ZM5 9V6H7V11C5.9 11 5 10.1 5 9ZM19 9C19 10.1 18.1 11 17 11V6H19V9ZM17 21V22H7V21C7 20.4 7.4 20 8 20H16C16.6 20 17 20.4 17 21ZM10 9C9.4 9 9 8.6 9 8V5C9 4.4 9.4 4 10 4C10.6 4 11 4.4 11 5V8C11 8.6 10.6 9 10 9ZM10 13C9.4 13 9 12.6 9 12V11C9 10.4 9.4 10 10 10C10.6 10 11 10.4 11 11V12C11 12.6 10.6 13 10 13Z" fill="currentColor"></path>
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
                    <path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="currentColor"></path>
                    <path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="currentColor"></path>
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
                                                        <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="0" class="ms-1"></li>
                                                        <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="1" class="ms-1"></li>
                                                        <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="2" class="ms-1 active" aria-current="true"></li>
                                    
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
                                    <div class="carousel-item show">     
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mb-5">                                 
                                            <!--begin::Chart-->
                                            <div class="w-80px flex-shrink-0 me-2">
                                                <div class="min-h-auto ms-n3 initialized" id="kt_slider_widget_1_chart_1" style="height: 100px; min-height: 100px;"><div id="apexchartsnub7c2av" class="apexcharts-canvas apexchartsnub7c2av" style="width: 0px; height: 100px;"><svg id="SvgjsSvg1964" width="0" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1967" class="apexcharts-annotations"></g><g id="SvgjsG1966" class="apexcharts-inner apexcharts-graphical"><defs id="SvgjsDefs1965"></defs></g></svg><div class="apexcharts-legend"></div></div></div>
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
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon--> 3 Topics
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon--> 50 Min
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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

                                            <a href="#" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
                                        </div>
                                        <!--end::Action-->  
                                    </div>
                                    <!--end::Item-->  
                                                                <!--begin::Item-->
                                    <div class="carousel-item">     
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mb-5">                                 
                                            <!--begin::Chart-->
                                            <div class="w-80px flex-shrink-0 me-2">
                                                <div class="min-h-auto ms-n3 initialized" id="kt_slider_widget_1_chart_2" style="height: 100px; min-height: 101px;"><div id="apexchartso55s5twj" class="apexcharts-canvas apexchartso55s5twj apexcharts-theme-light" style="width: 90px; height: 101px;"><svg id="SvgjsSvg1946" width="90" height="100.99999999999999" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1948" class="apexcharts-inner apexcharts-graphical" transform="translate(-5, 0)"><defs id="SvgjsDefs1947"><clipPath id="gridRectMasko55s5twj"><rect id="SvgjsRect1950" width="106" height="102" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMasko55s5twj"></clipPath><clipPath id="nonForecastMasko55s5twj"></clipPath><clipPath id="gridRectMarkerMasko55s5twj"><rect id="SvgjsRect1951" width="104" height="104" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1952" class="apexcharts-radialbar"><g id="SvgjsG1953"><g id="SvgjsG1954" class="apexcharts-tracks"><g id="SvgjsG1955" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 50 18.84146341463414 A 31.15853658536586 31.15853658536586 0 1 1 49.994561809492424 18.84146388920579" fill="none" fill-opacity="1" stroke="rgba(241,250,255,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.414634146341463" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 50 18.84146341463414 A 31.15853658536586 31.15853658536586 0 1 1 49.994561809492424 18.84146388920579"></path></g></g><g id="SvgjsG1957"><g id="SvgjsG1960" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0"><path id="SvgjsPath1961" d="M 50 18.84146341463414 A 31.15853658536586 31.15853658536586 0 1 1 40.37148267526841 79.63352925773314" fill="none" fill-opacity="0.85" stroke="rgba(0,158,247,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.414634146341463" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="198" data:value="55" index="0" j="0" data:pathOrig="M 50 18.84146341463414 A 31.15853658536586 31.15853658536586 0 1 1 40.37148267526841 79.63352925773314"></path></g><circle id="SvgjsCircle1958" r="26.951219512195127" cx="50" cy="50" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1959" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"></g></g></g></g><line id="SvgjsLine1962" x1="0" y1="0" x2="100" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1963" x1="0" y1="0" x2="100" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1949" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
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
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon--> 3 Topics
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon--> 50 Min
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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

                                            <a href="#" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
                                        </div>
                                        <!--end::Action-->  
                                    </div>
                                    <!--end::Item-->  
                                                                <!--begin::Item-->
                                    <div class="carousel-item active">     
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mb-5">                                 
                                            <!--begin::Chart-->
                                            <div class="w-80px flex-shrink-0 me-2">
                                                <div class="min-h-auto ms-n3 initialized" id="kt_slider_widget_1_chart_3" style="height: 100px; min-height: 101px;"><div id="apexcharts9y6jpbj6" class="apexcharts-canvas apexcharts9y6jpbj6 apexcharts-theme-light" style="width: 90px; height: 101px;"><svg id="SvgjsSvg1968" width="90" height="100.99999999999999" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1970" class="apexcharts-inner apexcharts-graphical" transform="translate(-5, 0)"><defs id="SvgjsDefs1969"><clipPath id="gridRectMask9y6jpbj6"><rect id="SvgjsRect1972" width="106" height="102" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask9y6jpbj6"></clipPath><clipPath id="nonForecastMask9y6jpbj6"></clipPath><clipPath id="gridRectMarkerMask9y6jpbj6"><rect id="SvgjsRect1973" width="104" height="104" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1974" class="apexcharts-radialbar"><g id="SvgjsG1975"><g id="SvgjsG1976" class="apexcharts-tracks"><g id="SvgjsG1977" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 50 18.84146341463414 A 31.15853658536586 31.15853658536586 0 1 1 49.994561809492424 18.84146388920579" fill="none" fill-opacity="1" stroke="rgba(241,250,255,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.414634146341463" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 50 18.84146341463414 A 31.15853658536586 31.15853658536586 0 1 1 49.994561809492424 18.84146388920579"></path></g></g><g id="SvgjsG1979"><g id="SvgjsG1982" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0"><path id="SvgjsPath1983" d="M 50 18.84146341463414 A 31.15853658536586 31.15853658536586 0 0 1 81.15853658536585 50" fill="none" fill-opacity="0.85" stroke="rgba(0,158,247,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.414634146341463" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="90" data:value="25" index="0" j="0" data:pathOrig="M 50 18.84146341463414 A 31.15853658536586 31.15853658536586 0 0 1 81.15853658536585 50"></path></g><circle id="SvgjsCircle1980" r="26.951219512195127" cx="50" cy="50" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1981" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"></g></g></g></g><line id="SvgjsLine1984" x1="0" y1="0" x2="100" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1985" x1="0" y1="0" x2="100" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1971" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
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
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon--> 3 Topics
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon--> 50 Min
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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

                                            <a href="#" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
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
                                                        <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="0" class="ms-1"></li>
                                                        <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="1" class="ms-1"></li>
                                                        <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="2" class="ms-1 active" aria-current="true"></li>
                                    
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
                                    <div class="carousel-item show">     
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mb-9">                                 
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-70px symbol-circle me-5">
                                                <span class="symbol-label bg-light-success">
                                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-success"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.925 3.90078V8.00077L12.025 10.8008V5.10078L15.525 3.10078C16.125 2.80078 16.925 3.20078 16.925 3.90078ZM2.525 13.5008L6.025 15.5008L10.925 12.7008L6.025 9.90078L2.525 11.9008C1.825 12.3008 1.825 13.2008 2.525 13.5008ZM18.025 19.7008V15.6008L13.125 12.8008V18.5008L16.625 20.5008C17.225 20.8008 18.025 20.4008 18.025 19.7008Z" fill="currentColor"></path>
                    <path opacity="0.3" d="M8.52499 3.10078L12.025 5.10078V10.8008L7.125 8.00077V3.90078C7.125 3.20078 7.92499 2.80078 8.52499 3.10078ZM7.42499 20.5008L10.925 18.5008V12.8008L6.02499 15.6008V19.7008C6.02499 20.4008 6.82499 20.8008 7.42499 20.5008ZM21.525 11.9008L18.025 9.90078L13.125 12.7008L18.025 15.5008L21.525 13.5008C22.225 13.2008 22.225 12.3008 21.525 11.9008Z" fill="currentColor"></path>
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
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon--> 5 Topics
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                    </svg>
                    </span>
                    <!--end::Svg Icon--> 60 Min
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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

                                            <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                        </div>
                                        <!--end::Action-->  
                                    </div>
                                    <!--end::Item-->  
                                                                <!--begin::Item-->
                                    <div class="carousel-item">     
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mb-9">                                 
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-70px symbol-circle me-5">
                                                <span class="symbol-label bg-light-danger">
                                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs026.svg-->
                                                    <span class="svg-icon svg-icon-3x svg-icon-danger"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"></path>
                                                    <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"></path>
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
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                                                                </svg>
                                                                </span>
                                                                <!--end::Svg Icon--> 12 Topics
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                                <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                                                                </svg>
                                                                </span>
                                                                <!--end::Svg Icon--> 50 Min
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                                <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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

                                            <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                        </div>
                                        <!--end::Action-->  
                                    </div>
                                    <!--end::Item-->  
                                                                <!--begin::Item-->
                                    <div class="carousel-item active">     
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mb-9">                                 
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-70px symbol-circle me-5">
                                                <span class="symbol-label bg-light-primary">
                                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs038.svg-->
                                                            <span class="svg-icon svg-icon-3x svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.0444 17.9444V12.1444L17.0444 15.0444C18.6444 15.9444 19.1445 18.0444 18.2445 19.6444C17.3445 21.2444 15.2445 21.7444 13.6445 20.8444C12.6445 20.2444 12.0444 19.1444 12.0444 17.9444ZM7.04445 15.0444L12.0444 12.1444L7.04445 9.24445C5.44445 8.34445 3.44444 8.84445 2.44444 10.4444C1.54444 12.0444 2.04445 14.0444 3.64445 15.0444C4.74445 15.6444 6.04445 15.6444 7.04445 15.0444ZM12.0444 6.34444V12.1444L17.0444 9.24445C18.6444 8.34445 19.1445 6.24444 18.2445 4.64444C17.3445 3.04444 15.2445 2.54445 13.6445 3.44445C12.6445 4.04445 12.0444 5.14444 12.0444 6.34444Z" fill="currentColor"></path>
                                                            <path opacity="0.3" d="M7.04443 9.24445C6.04443 8.64445 5.34442 7.54444 5.34442 6.34444C5.34442 4.54444 6.84444 3.04443 8.64444 3.04443C10.4444 3.04443 11.9444 4.54444 11.9444 6.34444V12.1444L7.04443 9.24445ZM17.0444 15.0444C18.0444 15.6444 19.3444 15.6444 20.3444 15.0444C21.9444 14.1444 22.4444 12.0444 21.5444 10.4444C20.6444 8.84444 18.5444 8.34445 16.9444 9.24445L11.9444 12.1444L17.0444 15.0444ZM7.04443 15.0444C6.04443 15.6444 5.34442 16.7444 5.34442 17.9444C5.34442 19.7444 6.84444 21.2444 8.64444 21.2444C10.4444 21.2444 11.9444 19.7444 11.9444 17.9444V12.1444L7.04443 15.0444Z" fill="currentColor"></path>
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
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                                                                </svg>
                                                                </span>
                                                                <!--end::Svg Icon--> 3 Topics
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                            <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                            <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                            <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
                                                            </svg>
                                                            </span>
                                                            <!--end::Svg Icon--> 50 Min
                                                        </span>
                                                        <!--end::Section-->

                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                    <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"></path>
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

                                            <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
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
                                            <a href="/metronic8/demo19/../demo19/pages/user-profile/overview.html" class="text-danger opacity-75-hover">2300 bonus</a>  

                                            <!--begin::Separator-->
                                            <span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                                            <!--end::Separator-->                        
                                        </span>                     
                                    </span>                 
                                    points.<br>
                                    Feel free to use them in your lessons                              
                                </div>
                                <!--end::Title--> 

                                <!--begin::Action--> 
                                <div class="mb-3">
                                    <a href="#" class="btn btn-danger fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">
                                        Get Reward
                                    </a> 

                                    <a href="/metronic8/demo19/../demo19/apps/support-center/overview.html" class="btn btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold">
                                        How to
                                    </a> 
                                </div>
                                <!--begin::Action--> 
                            </div>
                            <!--begin::Wrapper-->                 

                            <!--begin::Illustration-->
                            <img src="../img/dash2.png" class="position-absolute me-3 bottom-0 end-0 h-200px" alt=""> 
                            <!--end::Illustration-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Engage widget 4-->

                            
                        </div>
                        <!--end::Col-->    
                    </div>

                        <div class="row">
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
                                                <a href="/metronic8/demo19/../demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">UI/UX Design</a>
                                                
                                                <span class="text-muted fw-semibold d-block fs-7">40+ Courses</span>
                                            </div>
                                            <!--end:Author-->                      
                                            
                                            <!--begin::Actions-->
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
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
                                                <a href="/metronic8/demo19/../demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">QA Analysis</a>
                                                
                                                <span class="text-muted fw-semibold d-block fs-7">18 Courses</span>
                                            </div>
                                            <!--end:Author-->                      
                                            
                                            <!--begin::Actions-->
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
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
                                                <a href="/metronic8/demo19/../demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">Web Development</a>
                                                
                                                <span class="text-muted fw-semibold d-block fs-7">120+ Courses</span>
                                            </div>
                                            <!--end:Author-->                      
                                            
                                            <!--begin::Actions-->
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
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
                                                <a href="/metronic8/demo19/../demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">Marketing</a>
                                                
                                                <span class="text-muted fw-semibold d-block fs-7">50+ Courses.</span>
                                            </div>
                                            <!--end:Author-->                      
                                            
                                            <!--begin::Actions-->
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
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
                                                <a href="/metronic8/demo19/../demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">Philosophy</a>
                                                
                                                <span class="text-muted fw-semibold d-block fs-7">24+ Courses</span>
                                            </div>
                                            <!--end:Author-->                      
                                            
                                            <!--begin::Actions-->
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
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
                                            <div class="symbol-label fs-2 fw-semibold bg-info text-inverse-warning">M</div>
                                        </div>
                                        <!--end::Symbol-->

                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                            <!--begin:Author-->                    
                                            <div class="flex-grow-1 me-2">
                                                <a href="/metronic8/demo19/../demo19/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">Mathematics</a>
                                                
                                                <span class="text-muted fw-semibold d-block fs-7">24+ Courses</span>
                                            </div>
                                            <!--end:Author-->                      
                                            
                                            <!--begin::Actions-->
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
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
                            
                            <div class="col-xl-8 mb-5 mb-xl-10">
                            <div class="card border-0 h-md-100" data-bs-theme="light" style="background: linear-gradient(112.14deg, #00D2FF 0%, #3A7BD5 100%)"> 
                            <!--begin::Body-->
                            <div class="card-body"> 
                                <!--begin::Row-->
                                <div class="row align-items-center h-100">
                                    <!--begin::Col-->
                                    <div class="col-7 ps-xl-13">
                                        <!--begin::Title-->               
                                        <div class="text-white mb-6 pt-6">
                                            <span class="fs-4 fw-semibold me-2 d-block lh-1 pb-2 opacity-75">Get best offer</span>

                                            <span class="fs-2qx fw-bold">Upgrade Your Plan</span>
                                        </div>
                                        <!--end::Title-->

                                        <!--begin::Text-->
                                        <span class="fw-semibold text-white fs-6 mb-8 d-block opacity-75">
                                            Flat cartoony and illustrations with vivid unblended purple hair lady
                                        </span>
                                        <!--end::Text-->

                                        <!--begin::Items-->               
                                        <div class="d-flex align-items-center flex-wrap d-grid gap-2 mb-10 mb-xl-20">
                                            <!--begin::Item-->                  
                                            <div class="d-flex align-items-center me-5 me-xl-13">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px symbol-circle me-3">
                                                    <span class="symbol-label" style="background: #35C7FF">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                        <span class="svg-icon svg-icon-5 svg-icon-white"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="currentColor"></path>
                        <path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="currentColor"></path>
                        </svg>
                        </span>
                        <!--end::Svg Icon-->                            </span>                
                                                </div>
                                                <!--end::Symbol-->   
                                                
                                                <!--begin::Info-->
                                                <div class="text-white">                            
                                                    <span class="fw-semibold d-block fs-8 opacity-75">Projects</span>
                                                    <span class="fw-bold fs-7">Up to 500</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>                    
                                            <!--end::Item-->  

                                            <!--begin::Item-->                    
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px symbol-circle me-3">
                                                    <span class="symbol-label" style="background: #35C7FF">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-5 svg-icon-white"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                        <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                        </svg>
                        </span>
                        <!--end::Svg Icon-->                            </span>                
                                                </div>
                                                <!--end::Symbol-->                        
                                                
                                                <!--begin::Info-->
                                                <div class="text-white">                            
                                                    <span class="fw-semibold opacity-75 d-block fs-8">Tasks</span>
                                                    <span class="fw-bold fs-7">Unlimited</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>                      
                                            <!--end::Item-->  
                                        </div>
                                        <!--end::Items-->

                                        <!--begin::Action-->
                                        <div class="d-flex flex-column flex-sm-row d-grid gap-2">
                                            <a href="#" class="btn btn-success flex-shrink-0 me-lg-2" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a>
                                            <a href="#" class="btn btn-primary flex-shrink-0" style="background: rgba(255, 255, 255, 0.2)" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Read Guides</a>
                                        </div>
                                        <!--end::Action--> 
                                    </div>
                                    <!--end::Col--> 

                                    <!--begin::Col-->
                                    <div class="col-5 pt-10">
                                        <!--begin::Illustration-->
                                        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-225px" style="background-image:url('../img/man-with-laptop-light.png">                 
                                        </div>
                                        <!--end::Illustration-->
                                    </div>
                                    <!--end::Col--> 
                                </div>
                                <!--end::Row-->         
                            </div>
                            <!--end::Body-->
                        </div>


                            </div>
                        </div>

                        <div class="row">
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
                                            <img src="../img/brand/laravel-2.svg" class="me-4 w-30px" alt="">                  
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
                                            <img src="../img/brand/vue-9.svg" class="me-4 w-30px" alt="">                  
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
                                            <img src="../img/brand/bootstrap5.svg" class="me-4 w-30px" alt="">                  
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
                                            <img src="../img/brand/angular-icon.svg" class="me-4 w-30px" alt="">                  
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
                                            <img src="../img/brand/spring-3.svg" class="me-4 w-30px" alt="">                  
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
                                            <img src="../img/brand/typescript-1.svg" class="me-4 w-30px" alt="">                  
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
                                    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4" data-kt-initialized="1">           
                                        <!--begin::Display range-->
                                        <div class="text-gray-600 fw-bold">23 Jan 2023 - 21 Feb 2023</div>
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
                            <div class="card-body d-flex align-items-end px-0 pt-3 pb-5"> 
                                <!--begin::Chart-->
                                <div id="kt_charts_widget_18_chart" class="h-325px w-100 min-h-auto ps-4 pe-6" style="min-height: 340px;"><div id="apexchartsqywnwrt3" class="apexcharts-canvas apexchartsqywnwrt3 apexcharts-theme-light" style="width: 776.5px; height: 325px;"><svg id="SvgjsSvg3474" width="776.5" height="325" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG3476" class="apexcharts-inner apexcharts-graphical" transform="translate(58.65625, 30)"><defs id="SvgjsDefs3475"><linearGradient id="SvgjsLinearGradient3480" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop3481" stop-opacity="0" stop-color="rgba(216,227,240,0)" offset="0"></stop><stop id="SvgjsStop3482" stop-opacity="0" stop-color="rgba(190,209,230,0)" offset="1"></stop><stop id="SvgjsStop3483" stop-opacity="0" stop-color="rgba(190,209,230,0)" offset="1"></stop></linearGradient><clipPath id="gridRectMaskqywnwrt3"><rect id="SvgjsRect3485" width="713.84375" height="256.11199999999997" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskqywnwrt3"></clipPath><clipPath id="nonForecastMaskqywnwrt3"></clipPath><clipPath id="gridRectMarkerMaskqywnwrt3"><rect id="SvgjsRect3486" width="711.84375" height="258.11199999999997" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect3484" width="28.31375" height="254.11199999999997" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient3480)" class="apexcharts-xcrosshairs" y2="254.11199999999997" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG3533" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG3534" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText3536" font-family="inherit" x="50.560267857142854" y="283.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3537">QA Analysis</tspan><title>QA Analysis</title></text><text id="SvgjsText3539" font-family="inherit" x="151.68080357142856" y="283.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3540">Marketing</tspan><title>Marketing</title></text><text id="SvgjsText3542" font-family="inherit" x="252.80133928571425" y="283.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3543">Web Dev</tspan><title>Web Dev</title></text><text id="SvgjsText3545" font-family="inherit" x="353.921875" y="283.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3546">Maths</tspan><title>Maths</title></text><text id="SvgjsText3548" font-family="inherit" x="455.0424107142857" y="283.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3549">Front-end Dev</tspan><title>Front-end Dev</title></text><text id="SvgjsText3551" font-family="inherit" x="556.1629464285713" y="283.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3552">Physics</tspan><title>Physics</title></text><text id="SvgjsText3554" font-family="inherit" x="657.283482142857" y="283.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3555">Phylosophy</tspan><title>Phylosophy</title></text></g></g><g id="SvgjsG3573" class="apexcharts-grid"><g id="SvgjsG3574" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine3576" x1="0" y1="0" x2="707.84375" y2="0" stroke="#e1e3ea" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3577" x1="0" y1="63.52799999999999" x2="707.84375" y2="63.52799999999999" stroke="#e1e3ea" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3578" x1="0" y1="127.05599999999998" x2="707.84375" y2="127.05599999999998" stroke="#e1e3ea" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3579" x1="0" y1="190.58399999999997" x2="707.84375" y2="190.58399999999997" stroke="#e1e3ea" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3580" x1="0" y1="254.11199999999997" x2="707.84375" y2="254.11199999999997" stroke="#e1e3ea" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG3575" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine3582" x1="0" y1="254.11199999999997" x2="707.84375" y2="254.11199999999997" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine3581" x1="0" y1="1" x2="0" y2="254.11199999999997" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG3487" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG3488" class="apexcharts-series" rel="1" seriesName="Spentxtime" data:realIndex="0"><path id="SvgjsPath3492" d="M 36.403392857142855 254.11199999999997L 36.403392857142855 144.7616Q 36.403392857142855 139.7616 41.403392857142855 139.7616L 57.717142857142846 139.7616Q 62.717142857142846 139.7616 62.717142857142846 144.7616L 62.717142857142846 144.7616L 62.717142857142846 254.11199999999997L 62.717142857142846 254.11199999999997z" fill="rgba(0,158,247,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskqywnwrt3)" pathTo="M 36.403392857142855 254.11199999999997L 36.403392857142855 144.7616Q 36.403392857142855 139.7616 41.403392857142855 139.7616L 57.717142857142846 139.7616Q 62.717142857142846 139.7616 62.717142857142846 144.7616L 62.717142857142846 144.7616L 62.717142857142846 254.11199999999997L 62.717142857142846 254.11199999999997z" pathFrom="M 36.403392857142855 254.11199999999997L 36.403392857142855 254.11199999999997L 62.717142857142846 254.11199999999997L 62.717142857142846 254.11199999999997L 62.717142857142846 254.11199999999997L 62.717142857142846 254.11199999999997L 62.717142857142846 254.11199999999997L 36.403392857142855 254.11199999999997" cy="139.7616" cx="136.52392857142857" j="0" val="54" barHeight="114.35039999999998" barWidth="28.31375"></path><path id="SvgjsPath3498" d="M 137.52392857142857 254.11199999999997L 137.52392857142857 170.1728Q 137.52392857142857 165.1728 142.52392857142857 165.1728L 158.83767857142857 165.1728Q 163.83767857142857 165.1728 163.83767857142857 170.1728L 163.83767857142857 170.1728L 163.83767857142857 254.11199999999997L 163.83767857142857 254.11199999999997z" fill="rgba(0,158,247,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskqywnwrt3)" pathTo="M 137.52392857142857 254.11199999999997L 137.52392857142857 170.1728Q 137.52392857142857 165.1728 142.52392857142857 165.1728L 158.83767857142857 165.1728Q 163.83767857142857 165.1728 163.83767857142857 170.1728L 163.83767857142857 170.1728L 163.83767857142857 254.11199999999997L 163.83767857142857 254.11199999999997z" pathFrom="M 137.52392857142857 254.11199999999997L 137.52392857142857 254.11199999999997L 163.83767857142857 254.11199999999997L 163.83767857142857 254.11199999999997L 163.83767857142857 254.11199999999997L 163.83767857142857 254.11199999999997L 163.83767857142857 254.11199999999997L 137.52392857142857 254.11199999999997" cy="165.1728" cx="237.64446428571426" j="1" val="42" barHeight="88.93919999999999" barWidth="28.31375"></path><path id="SvgjsPath3504" d="M 238.64446428571426 254.11199999999997L 238.64446428571426 100.29199999999997Q 238.64446428571426 95.29199999999997 243.64446428571426 95.29199999999997L 259.95821428571423 95.29199999999997Q 264.95821428571423 95.29199999999997 264.95821428571423 100.29199999999997L 264.95821428571423 100.29199999999997L 264.95821428571423 254.11199999999997L 264.95821428571423 254.11199999999997z" fill="rgba(0,158,247,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskqywnwrt3)" pathTo="M 238.64446428571426 254.11199999999997L 238.64446428571426 100.29199999999997Q 238.64446428571426 95.29199999999997 243.64446428571426 95.29199999999997L 259.95821428571423 95.29199999999997Q 264.95821428571423 95.29199999999997 264.95821428571423 100.29199999999997L 264.95821428571423 100.29199999999997L 264.95821428571423 254.11199999999997L 264.95821428571423 254.11199999999997z" pathFrom="M 238.64446428571426 254.11199999999997L 238.64446428571426 254.11199999999997L 264.95821428571423 254.11199999999997L 264.95821428571423 254.11199999999997L 264.95821428571423 254.11199999999997L 264.95821428571423 254.11199999999997L 264.95821428571423 254.11199999999997L 238.64446428571426 254.11199999999997" cy="95.29199999999997" cx="338.765" j="2" val="75" barHeight="158.82" barWidth="28.31375"></path><path id="SvgjsPath3510" d="M 339.765 254.11199999999997L 339.765 26.175999999999988Q 339.765 21.175999999999988 344.765 21.175999999999988L 361.07875 21.175999999999988Q 366.07875 21.175999999999988 366.07875 26.175999999999988L 366.07875 26.175999999999988L 366.07875 254.11199999999997L 366.07875 254.11199999999997z" fill="rgba(0,158,247,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskqywnwrt3)" pathTo="M 339.765 254.11199999999997L 339.765 26.175999999999988Q 339.765 21.175999999999988 344.765 21.175999999999988L 361.07875 21.175999999999988Q 366.07875 21.175999999999988 366.07875 26.175999999999988L 366.07875 26.175999999999988L 366.07875 254.11199999999997L 366.07875 254.11199999999997z" pathFrom="M 339.765 254.11199999999997L 339.765 254.11199999999997L 366.07875 254.11199999999997L 366.07875 254.11199999999997L 366.07875 254.11199999999997L 366.07875 254.11199999999997L 366.07875 254.11199999999997L 339.765 254.11199999999997" cy="21.175999999999988" cx="439.8855357142857" j="3" val="110" barHeight="232.93599999999998" barWidth="28.31375"></path><path id="SvgjsPath3516" d="M 440.8855357142857 254.11199999999997L 440.8855357142857 210.4072Q 440.8855357142857 205.4072 445.8855357142857 205.4072L 462.1992857142857 205.4072Q 467.1992857142857 205.4072 467.1992857142857 210.4072L 467.1992857142857 210.4072L 467.1992857142857 254.11199999999997L 467.1992857142857 254.11199999999997z" fill="rgba(0,158,247,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskqywnwrt3)" pathTo="M 440.8855357142857 254.11199999999997L 440.8855357142857 210.4072Q 440.8855357142857 205.4072 445.8855357142857 205.4072L 462.1992857142857 205.4072Q 467.1992857142857 205.4072 467.1992857142857 210.4072L 467.1992857142857 210.4072L 467.1992857142857 254.11199999999997L 467.1992857142857 254.11199999999997z" pathFrom="M 440.8855357142857 254.11199999999997L 440.8855357142857 254.11199999999997L 467.1992857142857 254.11199999999997L 467.1992857142857 254.11199999999997L 467.1992857142857 254.11199999999997L 467.1992857142857 254.11199999999997L 467.1992857142857 254.11199999999997L 440.8855357142857 254.11199999999997" cy="205.4072" cx="541.0060714285714" j="4" val="23" barHeight="48.70479999999999" barWidth="28.31375"></path><path id="SvgjsPath3522" d="M 542.0060714285714 254.11199999999997L 542.0060714285714 74.8808Q 542.0060714285714 69.8808 547.0060714285714 69.8808L 563.3198214285715 69.8808Q 568.3198214285715 69.8808 568.3198214285715 74.8808L 568.3198214285715 74.8808L 568.3198214285715 254.11199999999997L 568.3198214285715 254.11199999999997z" fill="rgba(0,158,247,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskqywnwrt3)" pathTo="M 542.0060714285714 254.11199999999997L 542.0060714285714 74.8808Q 542.0060714285714 69.8808 547.0060714285714 69.8808L 563.3198214285715 69.8808Q 568.3198214285715 69.8808 568.3198214285715 74.8808L 568.3198214285715 74.8808L 568.3198214285715 254.11199999999997L 568.3198214285715 254.11199999999997z" pathFrom="M 542.0060714285714 254.11199999999997L 542.0060714285714 254.11199999999997L 568.3198214285715 254.11199999999997L 568.3198214285715 254.11199999999997L 568.3198214285715 254.11199999999997L 568.3198214285715 254.11199999999997L 568.3198214285715 254.11199999999997L 542.0060714285714 254.11199999999997" cy="69.8808" cx="642.1266071428571" j="5" val="87" barHeight="184.23119999999997" barWidth="28.31375"></path><path id="SvgjsPath3528" d="M 643.1266071428571 254.11199999999997L 643.1266071428571 153.23199999999997Q 643.1266071428571 148.23199999999997 648.1266071428571 148.23199999999997L 664.4403571428571 148.23199999999997Q 669.4403571428571 148.23199999999997 669.4403571428571 153.23199999999997L 669.4403571428571 153.23199999999997L 669.4403571428571 254.11199999999997L 669.4403571428571 254.11199999999997z" fill="rgba(0,158,247,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskqywnwrt3)" pathTo="M 643.1266071428571 254.11199999999997L 643.1266071428571 153.23199999999997Q 643.1266071428571 148.23199999999997 648.1266071428571 148.23199999999997L 664.4403571428571 148.23199999999997Q 669.4403571428571 148.23199999999997 669.4403571428571 153.23199999999997L 669.4403571428571 153.23199999999997L 669.4403571428571 254.11199999999997L 669.4403571428571 254.11199999999997z" pathFrom="M 643.1266071428571 254.11199999999997L 643.1266071428571 254.11199999999997L 669.4403571428571 254.11199999999997L 669.4403571428571 254.11199999999997L 669.4403571428571 254.11199999999997L 669.4403571428571 254.11199999999997L 669.4403571428571 254.11199999999997L 643.1266071428571 254.11199999999997" cy="148.23199999999997" cx="743.2471428571428" j="6" val="50" barHeight="105.87999999999998" barWidth="28.31375"></path><g id="SvgjsG3490" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG3491" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG3497" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG3503" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG3509" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG3515" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG3521" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG3527" className="apexcharts-bar-goals-groups"></g></g></g><g id="SvgjsG3489" class="apexcharts-datalabels" data:realIndex="0"><g id="SvgjsG3494" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText3496" font-family="inherit" x="49.56026785714286" y="127.76159999999999" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="600" fill="#181c32" class="apexcharts-datalabel" cx="49.56026785714286" cy="127.76159999999999" style="font-family: inherit;">54</text></g><g id="SvgjsG3500" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText3502" font-family="inherit" x="150.68080357142856" y="153.1728" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="600" fill="#181c32" class="apexcharts-datalabel" cx="150.68080357142856" cy="153.1728" style="font-family: inherit;">42</text></g><g id="SvgjsG3506" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText3508" font-family="inherit" x="251.80133928571428" y="83.29199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="600" fill="#181c32" class="apexcharts-datalabel" cx="251.80133928571428" cy="83.29199999999997" style="font-family: inherit;">75</text></g><g id="SvgjsG3512" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText3514" font-family="inherit" x="352.921875" y="9.175999999999988" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="600" fill="#181c32" class="apexcharts-datalabel" cx="352.921875" cy="9.175999999999988" style="font-family: inherit;">110</text></g><g id="SvgjsG3518" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText3520" font-family="inherit" x="454.0424107142857" y="193.4072" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="600" fill="#181c32" class="apexcharts-datalabel" cx="454.0424107142857" cy="193.4072" style="font-family: inherit;">23</text></g><g id="SvgjsG3524" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText3526" font-family="inherit" x="555.1629464285714" y="57.880799999999994" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="600" fill="#181c32" class="apexcharts-datalabel" cx="555.1629464285714" cy="57.880799999999994" style="font-family: inherit;">87</text></g><g id="SvgjsG3530" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText3532" font-family="inherit" x="656.2834821428571" y="136.23199999999997" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="600" fill="#181c32" class="apexcharts-datalabel" cx="656.2834821428571" cy="136.23199999999997" style="font-family: inherit;">50</text></g></g></g><line id="SvgjsLine3583" x1="0" y1="0" x2="707.84375" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine3584" x1="0" y1="0" x2="707.84375" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG3585" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG3586" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG3587" class="apexcharts-point-annotations"></g></g><g id="SvgjsG3556" class="apexcharts-yaxis" rel="0" transform="translate(28.65625, 0)"><g id="SvgjsG3557" class="apexcharts-yaxis-texts-g"><text id="SvgjsText3559" font-family="inherit" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3560">120H</tspan><title>120H</title></text><text id="SvgjsText3562" font-family="inherit" x="20" y="94.928" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3563">90H</tspan><title>90H</title></text><text id="SvgjsText3565" font-family="inherit" x="20" y="158.456" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3566">60H</tspan><title>60H</title></text><text id="SvgjsText3568" font-family="inherit" x="20" y="221.98399999999998" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3569">30H</tspan><title>30H</title></text><text id="SvgjsText3571" font-family="inherit" x="20" y="285.51199999999994" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1a5b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan3572">0H</tspan><title>0H</title></text></g></g><g id="SvgjsG3477" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 162.5px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 158, 247);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                <!--end::Chart-->                  
                            </div>
                            <!--end: Card Body-->
                        </div>
                        <!--end::Chart widget 18-->

                            </div>
                            <!--end::Col-->    
                        </div>






            </div>          
        </section>
      </div>   
</div>



    <!-- ########## END: MAIN PANEL ########## -->

    <script src="../lib/jquery/jquery.js"></script>
    <script src="../lib/popper.js/popper.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../lib/moment/moment.js"></script>
    <script src="../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../lib/peity/jquery.peity.js"></script>

    <script src="../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';
        // show only the icons and hide left menu label by default
        $('.menu-item-label').addClass('op-lg-0-force d-lg-none');
      });
    </script>
  </body>
</html>
