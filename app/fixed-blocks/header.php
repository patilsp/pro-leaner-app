<?php
    $logged_name = $_SESSION['cms_name'];
    $logged_role = $_SESSION['cms_usertype'];
    $logged_email = $_SESSION['cms_email'];
    $token = $_SESSION['token'];
    $links = array();
    $sql1 = "SELECT * FROM role_permission WHERE roles_id = ?";
    $stmt1 = $db->prepare($sql1);
    $stmt1->execute(array($_SESSION['user_role_id']));
    $rowcount1 = $stmt1->rowcount();
    if($rowcount1) {
      while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $links[] = $row1['permission_id'];
      }
    }
?>

<link rel="stylesheet" href="<?php echo $web_root ?>links/css/main.css">

<!--begin::Header-->
<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}" style="animation-duration: 0.3s; top: 0px;" data-kt-sticky-enabled="true">

    <div class="header-top-container  container-xxl  d-flex flex-grow-1 flex-stack">	
        <div class="d-flex align-items-center me-5">
            <div class="d-lg-none btn btn-icon btn-active-color-300 w-30px h-30px me-2" id="kt_header_menu_toggle">
                <i class="fa fa-chart bx-sm mx-2"></i>           
            </div>
            <a href="<?php echo $web_root ?>/index.php">            
                <img alt="Logo" src="../../links/media/logo.svg" class="d-none d-lg-inline-block h-60px"/>                
                <img alt="Logo" src="../links/media/logo.svg" class="d-lg-none h-25px"/>            
            </a>
        </div>
        <div class="topbar d-flex align-items-stretch flex-shrink-0" id="kt_topbar">           
            <div class="d-flex align-items-center ms-2 ms-lg-3">
                <div id="kt_header_search" class="header-search d-flex align-items-center topbar-search w-lg-225px">
                <div data-kt-search-element="toggle" class="search-toggle-mobile d-flex d-lg-none align-items-center">
                    <div class="btn btn-icon btn-icon-gray-300 w-30px h-30px w-md-40px h-md-40px">
                        <i class="fa fa-search bx-sm mx-2"></i>                         
                    </div>
                </div>
                <form data-kt-search-element="form" class="d-none d-lg-block w-100 position-relative mb-5 mb-lg-0" autocomplete="off">
                    <input type="hidden"/>
                    <input type="text" class="search-input form-control form-control-solid ps-13" name="search" value="" placeholder="Search..." data-kt-search-element="input"/>
            
                    <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                    <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                </span>
                <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
                    <i class="fa fa-search"></i>
                </span>
            </form>
        </div>
     </div>	
    <!--end:Search-->

    <!--begin::Quick links-->
    <div class="d-flex align-items-center ms-2 ms-lg-3">
        <div class="btn btn-icon btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="fa fa-bell"></i>
        </div>        
        <!--begin::Menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
            <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('../../links/media/header-bg.jpg')"> 
                <h3 class="text-white fw-semibold mb-3">
                    Quick Links 
                </h3>
                <span class="badge bg-primary text-inverse-primary py-2 px-3">25 pending tasks</span>
            
            </div>
            <div class="row g-0">
                <div class="col-6">
                    <a href="#" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                    <i class="fa fa-list-ul"></i>
                    <span class="fs-5 fw-semibold text-gray-800 mb-0">Users</span>
                        <span class="fs-7 text-gray-400">Permissions</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="#" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
                        <i class="fa fa-list-ul"></i>
                        <span class="fs-5 fw-semibold text-gray-800 mb-0">Roles</span>
                        <span class="fs-7 text-gray-400">test</span>
                    </a>
                </div>       
            </div>

            <div class="py-2 text-center border-top">
                <a href="/../demo19/pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">
                    View All 
                    <i class="fa fa-arrow-right"></i>       
                </a>			 
            </div>
        </div>
    </div>
    <!--end::Quick links-->

    <!--begin::Activities-->
    <div class="d-flex align-items-center ms-2 ms-lg-3">
        <div class="btn btn-icon btn-custom w-30px h-30px w-md-40px h-md-40px" id="kt_activities_toggle">
            <i class="fa fa-list-ul"></i>
        </div>
    </div>
    <div class="d-flex align-items-center ms-2 ms-lg-3">     
        <div class="btn btn-icon btn-custom w-30px h-30px w-md-40px h-md-40px position-relative" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="fa fa-user"></i>
        </div>
        
        <!--begin::User account menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo" src="../../links/media/avatars/300-1.jpg"/>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">
                            <?php echo $logged_name; ?> <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                        </div>

                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                            <?php echo $logged_email; ?>            
                        </a>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
                <a href="#" class="menu-link px-5">
                    My Profile
                </a>
            </div>
            <div class="menu-item px-5">
                <a href="#" class="menu-link px-5">
                    <span class="menu-text">My Projects</span>
                    <span class="menu-badge">
                        <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
                    </span>
                </a>
            </div>
            <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" data-kt-menu-offset="-15px, 0">
                <a href="#" class="menu-link px-5">
                    <span class="menu-title">My Subscription</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-5">
                            Referrals
                        </a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-5">
                            Billing
                        </a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-5">
                            Payments
                        </a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link d-flex flex-stack px-5">
                            Statements
                            
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="View your statements"></i>
                        </a>
                    </div>
                    <div class="separator my-2"></div>
                    <div class="menu-item px-3">
                        <div class="menu-content px-3">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications"/>
                                <span class="form-check-label text-muted fs-7">
                                    Notifications
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Menu item-->

            <div class="separator my-2"></div>
                    <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">Mode 
                        <i class="fa fa-list-ul"></i>
                            <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                            </span>
                        </span>
                    </a>

                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon"><i class="fa fa-list-ul"></i></span>
                                <span class="menu-title">
                                    Light
                                </span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon"><i class="fa fa-list-ul"></i></span>
                                <span class="menu-title">
                                    Dark
                                </span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon"><i class="fa fa-list-ul"></i></span>
                                <span class="menu-title">
                                    System
                                </span>
                            </a>
                        </div>
                    </div>
            </div>
            <div class="menu-item px-5 my-1">
                <a href="#" class="menu-link px-5">
                    Account Settings
                </a>
            </div>
            <div class="menu-item px-5">
                <a href="<?php echo $web_root; ?>app/login_blocks/logout.php" class="menu-link px-5">
                    Sign Out
                </a>
            </div>
        </div>
    </div>
</div>
<!--end::Toolbar wrapper-->	

</div>
	<!--end::Container-->

	<!--begin::Container-->
	<div class="header-menu-container d-flex align-items-stretch flex-stack w-100" id="kt_header_nav">
		
<!--begin::Menu wrapper-->
<div class="header-menu  container-xxl  flex-column align-items-stretch flex-lg-row"
    data-kt-drawer="true"
	data-kt-drawer-name="header-menu"
	data-kt-drawer-activate="{default: true, lg: false}"
	data-kt-drawer-overlay="true"
	data-kt-drawer-width="{default:'200px', '300px': '250px'}"
	data-kt-drawer-direction="start"
	data-kt-drawer-toggle="#kt_header_menu_toggle"

    data-kt-swapper="true"
    data-kt-swapper-mode="prepend"
    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}"
>   
    <!--begin::Menu-->
    <div class="menu menu-column menu-lg-row menu-rounded menu-active-bg menu-title-gray-800 menu-state-primary menu-arrow-gray-500 fw-semibold my-5 my-lg-0 align-items-stretch flex-grow-1 px-2 px-lg-0" 
        id="kt_header_menu" 
        data-kt-menu="true"
    >        
        <!--begin:Menu item--><div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"  data-kt-menu-placement="bottom-start"  class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-title" >Application</span><span  class="menu-arrow d-lg-none" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px" ><!--begin:Dashboards menu-->
<div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible" data-kt-menu-dismiss="true">
    <!--begin:Row-->
    <div class="row">
        <!--begin:Col-->
        <div class="col-lg-8 mb-3 mb-lg-0  py-3 px-3 py-lg-6 px-lg-6">
            <!--begin:Row-->
            <div class="row">
                                                        <!--begin:Col-->
                    <div class="col-lg-6 mb-3">
                        <!--begin:Menu item-->
                        <div class="menu-item p-0 m-0">
                            <!--begin:Menu link-->
                            <a href="#" class="menu-link ">
                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
<span class="svg-icon svg-icon-primary svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"/>
<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"/>
<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"/>
<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </span>

                                <span class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-800">Default</span>
                                    <span class="fs-7 fw-semibold text-muted">Reports & statistics</span>
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Col-->
                                                        <!--begin:Col-->
                    <div class="col-lg-6 mb-3">
                        <!--begin:Menu item-->
                        <div class="menu-item p-0 m-0">
                            <!--begin:Menu link-->
                            <a href="/../demo19/dashboards/ecommerce.html" class="menu-link ">
                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
<span class="svg-icon svg-icon-danger svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor"/>
<path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor"/>
<path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </span>

                                <span class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-800">eCommerce</span>
                                    <span class="fs-7 fw-semibold text-muted">Sales reports</span>
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Col-->
                                                        <!--begin:Col-->
                    <div class="col-lg-6 mb-3">
                        <!--begin:Menu item-->
                        <div class="menu-item p-0 m-0">
                            <!--begin:Menu link-->
                            <a href="/../demo19/dashboards/projects.html" class="menu-link ">
                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs045.svg-->
<span class="svg-icon svg-icon-info svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2 11.7127L10 14.1127L22 11.7127L14 9.31274L2 11.7127Z" fill="currentColor"/>
<path opacity="0.3" d="M20.9 7.91274L2 11.7127V6.81275C2 6.11275 2.50001 5.61274 3.10001 5.51274L20.6 2.01274C21.3 1.91274 22 2.41273 22 3.11273V6.61273C22 7.21273 21.5 7.81274 20.9 7.91274ZM22 16.6127V11.7127L3.10001 15.5127C2.50001 15.6127 2 16.2127 2 16.8127V20.3127C2 21.0127 2.69999 21.6128 3.39999 21.4128L20.9 17.9128C21.5 17.8128 22 17.2127 22 16.6127Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </span>

                                <span class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-800">Projects</span>
                                    <span class="fs-7 fw-semibold text-muted">Tasts, graphs & charts</span>
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Col-->
                                                        <!--begin:Col-->
                    <div class="col-lg-6 mb-3">
                        <!--begin:Menu item-->
                        <div class="menu-item p-0 m-0">
                            <!--begin:Menu link-->
                            <a href="/../demo19/dashboards/online-courses.html" class="menu-link active">
                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
<span class="svg-icon svg-icon-success svg-icon-1"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z" fill="currentColor"/>
<path d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </span>

                                <span class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-800">Online Courses</span>
                                    <span class="fs-7 fw-semibold text-muted">Student progress</span>
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Col-->
                                                        <!--begin:Col-->
                    <div class="col-lg-6 mb-3">
                        <!--begin:Menu item-->
                        <div class="menu-item p-0 m-0">
                            <!--begin:Menu link-->
                            <a href="/../demo19/dashboards/marketing.html" class="menu-link ">
                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
<span class="svg-icon svg-icon-dark svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z" fill="currentColor"/>
<path d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </span>

                                <span class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-800">Marketing</span>
                                    <span class="fs-7 fw-semibold text-muted">Campaings & conversions</span>
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Col-->
                                                        <!--begin:Col-->
                    <div class="col-lg-6 mb-3">
                        <!--begin:Menu item-->
                        <div class="menu-item p-0 m-0">
                            <!--begin:Menu link-->
                            <a href="/../demo19/dashboards/bidding.html" class="menu-link ">
                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
<span class="svg-icon svg-icon-warning svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"/>
<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </span>

                                <span class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-800">Bidding</span>
                                    <span class="fs-7 fw-semibold text-muted">Campaings & conversions</span>
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Col-->
                                                        <!--begin:Col-->
                    <div class="col-lg-6 mb-3">
                        <!--begin:Menu item-->
                        <div class="menu-item p-0 m-0">
                            <!--begin:Menu link-->
                            <a href="/../demo19/dashboards/pos.html" class="menu-link ">
                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs043.svg-->
<span class="svg-icon svg-icon-danger svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M22 8H8L12 4H19C19.6 4 20.2 4.39999 20.5 4.89999L22 8ZM3.5 19.1C3.8 19.7 4.4 20 5 20H12L16 16H2L3.5 19.1ZM19.1 20.5C19.7 20.2 20 19.6 20 19V12L16 8V22L19.1 20.5ZM4.9 3.5C4.3 3.8 4 4.4 4 5V12L8 16V2L4.9 3.5Z" fill="currentColor"/>
<path d="M22 8L20 12L16 8H22ZM8 16L4 12L2 16H8ZM16 16L12 20L16 22V16ZM8 8L12 4L8 2V8Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </span>

                                <span class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-800">POS System</span>
                                    <span class="fs-7 fw-semibold text-muted">Campaings & conversions</span>
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Col-->
                                                        <!--begin:Col-->
                    <div class="col-lg-6 mb-3">
                        <!--begin:Menu item-->
                        <div class="menu-item p-0 m-0">
                            <!--begin:Menu link-->
                            <a href="/../demo19/dashboards/call-center.html" class="menu-link ">
                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com004.svg-->
<span class="svg-icon svg-icon-primary svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M14 3V20H2V3C2 2.4 2.4 2 3 2H13C13.6 2 14 2.4 14 3ZM11 13V11C11 9.7 10.2 8.59995 9 8.19995V7C9 6.4 8.6 6 8 6C7.4 6 7 6.4 7 7V8.19995C5.8 8.59995 5 9.7 5 11V13C5 13.6 4.6 14 4 14V15C4 15.6 4.4 16 5 16H11C11.6 16 12 15.6 12 15V14C11.4 14 11 13.6 11 13Z" fill="currentColor"/>
<path d="M2 20H14V21C14 21.6 13.6 22 13 22H3C2.4 22 2 21.6 2 21V20ZM9 3V2H7V3C7 3.6 7.4 4 8 4C8.6 4 9 3.6 9 3ZM6.5 16C6.5 16.8 7.2 17.5 8 17.5C8.8 17.5 9.5 16.8 9.5 16H6.5ZM21.7 12C21.7 11.4 21.3 11 20.7 11H17.6C17 11 16.6 11.4 16.6 12C16.6 12.6 17 13 17.6 13H20.7C21.2 13 21.7 12.6 21.7 12ZM17 8C16.6 8 16.2 7.80002 16.1 7.40002C15.9 6.90002 16.1 6.29998 16.6 6.09998L19.1 5C19.6 4.8 20.2 5 20.4 5.5C20.6 6 20.4 6.60005 19.9 6.80005L17.4 7.90002C17.3 8.00002 17.1 8 17 8ZM19.5 19.1C19.4 19.1 19.2 19.1 19.1 19L16.6 17.9C16.1 17.7 15.9 17.1 16.1 16.6C16.3 16.1 16.9 15.9 17.4 16.1L19.9 17.2C20.4 17.4 20.6 18 20.4 18.5C20.2 18.9 19.9 19.1 19.5 19.1Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon-->                                </span>

                                <span class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-800">Call Center</span>
                                    <span class="fs-7 fw-semibold text-muted">Campaings & conversions</span>
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Col-->
                                                                                                                                                                                                                                    </div>
            <!--end:Row-->

            <div class="separator separator-dashed mx-5 my-5"></div>

            <!--begin:Landing-->
            <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-2 mx-5">
                <div class="d-flex flex-column me-5">
                    <div class="fs-6 fw-bold text-gray-800">
                        Landing Page Template
                    </div>
                    <div class="fs-7 fw-semibold text-muted">
                        Onpe page landing template with pricing & others    
                    </div>
                </div>

                <a href="/../demo19/landing.html" class="btn btn-sm btn-primary fw-bold">
                    Explore
                </a>
            </div>
            <!--end:Landing-->
        </div>
       
      
    </div>
    <!--end:Row-->
</div>
<!--end:Dashboards menu--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item-->












<div  data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"  class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2" >
    <span class="menu-link py-3" >
        <span  class="menu-title" >Menu</span>
        <span  class="menu-arrow d-lg-none" ></span>
    </span>
    <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px" >
        <div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" >
        <span class="menu-link py-3" ><span  class="menu-icon" >
            <i class="fa fa-user"></i>
        </span>


        <span  class="menu-title" >User Management</span><span  class="menu-arrow" ></span></span>
        <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" >
            <!--begin:Menu item-->
            <div  class="menu-item" >
                <!--begin:Menu link-->
                <a class="menu-link py-3"  href="<?php echo $web_root ?>/app/setup/users.php">
                    <span  class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span  class="menu-title" >Users</span>
                </a>
                <a class="menu-link py-3"  href="<?php echo $web_root ?>/app/setup/roles.php">
                    <span  class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span  class="menu-title" >Roles</span>
                </a>
                <a class="menu-link py-3"  href="<?php echo $web_root ?>/app/setup/permissions.php">
                    <span  class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span  class="menu-title" >Permissions</span>
                </a>
            </div>
    
    <!--end:Menu item--><!--begin:Menu item-->
    <div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/projects/project.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >View Project</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/projects/targets.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Targets</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/projects/budget.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Budget</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/projects/users.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Users</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/projects/files.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Files</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/projects/activity.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Activity</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/projects/settings.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Settings</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm001.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="currentColor"/>
<path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="currentColor"/>
<path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="currentColor"/>
<path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span>
<span  class="menu-title" >Support Center</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/support-center/overview.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Overview</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Tickets</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/support-center/tickets/list.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Ticket List</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/support-center/tickets/view.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Ticket View</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Tutorials</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/support-center/tutorials/list.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Tutorials List</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/support-center/tutorials/post.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Tutorials Post</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/support-center/faq.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >FAQ</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/support-center/licenses.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Licenses</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/support-center/contact.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Contact Us</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"/>
<path d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span>


<span  class="menu-title" >User Management</span><span  class="menu-arrow" ></span></span>

<!--begin:Menu sub-->
<div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item-->
<div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" >
    <!--begin:Menu link-->
    <span class="menu-link py-3" >
       
            <a class="menu-link py-3"  href="#" >
                <span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span>
                <span  class="menu-title" >Users</span>
            </a>
            <a class="menu-link py-3"  href="/../demo19/apps/user-management/permissions.html" >
                <span  class="menu-bullet" >
                <span class="bullet bullet-dot"></span></span>
                <span  class="menu-title" >Roles</span>
            </a>
            <a class="menu-link py-3"  href="/../demo19/apps/user-management/permissions.html" >
                <span  class="menu-bullet">
                <span class="bullet bullet-dot"></span></span>
                <span  class="menu-title" >Permissions</span>
            </a>
        <!--end:Menu link--><!--begin:Menu sub-->
        <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item-->
        <div  class="menu-item">
            <!--begin:Menu link-->
           
                <!--end:Menu link-->
            </div>
                <!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/user-management/users/view.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >View User</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Roles</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/user-management/roles/list.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Roles List</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/user-management/roles/view.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >View Roles</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link-->
                
                <a class="menu-link py-3"  href="/../demo19/apps/user-management/permissions.html" >
                    <span  class="menu-bullet" >
                        <span class="bullet bullet-dot"></span></span>
                        <span  class="menu-title" >Permissions</span>
                    </a>
                    <!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/electronics/elc002.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6 21C6 21.6 6.4 22 7 22H17C17.6 22 18 21.6 18 21V20H6V21Z" fill="currentColor"/>
<path opacity="0.3" d="M17 2H7C6.4 2 6 2.4 6 3V20H18V3C18 2.4 17.6 2 17 2Z" fill="currentColor"/>
<path d="M12 4C11.4 4 11 3.6 11 3V2H13V3C13 3.6 12.6 4 12 4Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Contacts</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/contacts/getting-started.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Getting Started</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/contacts/add-contact.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Add Contact</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/contacts/edit-contact.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Edit Contact</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/contacts/view-contact.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >View Contact</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor"/>
<path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor"/>
<path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Subscriptions</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/subscriptions/getting-started.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Getting Started</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/subscriptions/list.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Subscription List</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/subscriptions/add.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Add Subscription</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/subscriptions/view.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >View Subscription</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor"/>
<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Customers</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/customers/getting-started.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Getting Started</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/customers/list.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Customer Listing</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/customers/view.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Customer Details</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M22 7H2V11H22V7Z" fill="currentColor"/>
<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Invoice Management</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Profile</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/invoices/view/invoice-1.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Invoice 1</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/invoices/view/invoice-2.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Invoice 2</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/invoices/view/invoice-3.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Invoice 3</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/invoices/create.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create Invoice</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="currentColor"/>
<path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="currentColor"/>
<path d="M10.3629 14.0084L8.92108 12.6429C8.57518 12.3153 8.03352 12.3153 7.68761 12.6429C7.31405 12.9967 7.31405 13.5915 7.68761 13.9453L10.2254 16.3488C10.6111 16.714 11.215 16.714 11.6007 16.3488L16.3124 11.8865C16.6859 11.5327 16.6859 10.9379 16.3124 10.5841C15.9665 10.2565 15.4248 10.2565 15.0789 10.5841L11.4631 14.0084C11.1546 14.3006 10.6715 14.3006 10.3629 14.0084Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >File Manager</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/file-manager/folders.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Folders</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/file-manager/files.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Files</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/file-manager/blank.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Blank Directory</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/file-manager/settings.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Settings</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"/>
<path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Inbox</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/inbox/listing.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Messages</span><span  class="menu-badge" ><span class="badge badge-light-success">3</span></span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/inbox/compose.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Compose</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/inbox/reply.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >View & Reply</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item--><!--begin:Menu item--><div  data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"  class="menu-item menu-lg-down-accordion" ><!--begin:Menu link--><span class="menu-link py-3" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"/>
<rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"/>
<rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Chat</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub--><div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px" ><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/chat/private.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Private Chat</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/chat/group.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Group Chat</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/apps/chat/drawer.html" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Drawer Chat</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div>

            <div  class="menu-item">    
                <a class="menu-link py-3"  href="#" >
                    <span  class="menu-icon"><i class="fa fa-calendar"></i></span>
                    <span  class="menu-title" >Calendar</span>
                </a>
            </div>
        </div>
    </<div>
</div>

<div  data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"  class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2" >
    <span class="menu-link py-3" >
        <span  class="menu-title" >Content</span>
        <span  class="menu-arrow d-lg-none" ></span>
    </span>
    <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
        <div  class="menu-item">
            <a class="menu-link py-3"  href="#" target="_blank" title="Content" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" >
                <span  class="menu-icon"><span class="bullet bullet-dot"></span></span>
                <span  class="menu-title" >Content</span>
            </a>
        </div>
        <div  class="menu-item">
            <a class="menu-link py-3"  href="#" target="_blank" title="Review" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" >
                <span  class="menu-icon"><span class="bullet bullet-dot"></span></span>
                <span  class="menu-title" >Review</span>
            </a>
        </div>
        <div  class="menu-item">
            <a class="menu-link py-3"  href="#" target="_blank" title="Publish" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" >
                <span  class="menu-icon"><span class="bullet bullet-dot"></span></span>
                <span  class="menu-title" >Publish</span>
            </a>
        </div>
        
        
        
        <div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="https://preview.keenthemes.com/html/metronic/docs" target="_blank" title="Check out the complete documentation" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"/>
<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Documentation</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="/../demo19/layout-builder.html" title="Build your layout and export HTML for server side integration" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"/>
<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Layout Builder</span></a><!--end:Menu link--></div><!--end:Menu item--><!--begin:Menu item--><div  class="menu-item" ><!--begin:Menu link--><a class="menu-link py-3"  href="https://preview.keenthemes.com/html/metronic/docs/getting-started/changelog" target="_blank" ><span  class="menu-icon" ><!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z" fill="currentColor"/>
<path opacity="0.3" d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z" fill="currentColor"/>
</svg>
</span>
<!--end::Svg Icon--></span><span  class="menu-title" >Changelog v8.1.7</span></a><!--end:Menu link--></div><!--end:Menu item--></div><!--end:Menu sub--></div><!--end:Menu item-->    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
	
	</div>
	<!--end::Container-->
</div>
<!--end::Header-->
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
                    <img src="../../links/media/avatars/300-1.jpg" alt="img"/>
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
                <a href="/../demo19/apps/projects/project.html" class="fs-5 text-dark text-hover-primary fw-semibold w-375px min-w-200px">Meeting with customer</a>                                  
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
                        <img src="../../links/media/avatars/300-1.jpg" alt="img"/>
                    </div>
                    <!--end::User-->

                    <!--begin::User-->
                    <div class="symbol symbol-circle symbol-25px">
                        <img src="../../links/media/avatars/300-1.jpg" alt="img"/>
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
                <a href="/../demo19/apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">View</a>    
                <!--end::Action-->                                
            </div>
            <!--end::Record-->

            <!--begin::Record-->
            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-0">  
                <!--begin::Title-->                                   
                <a href="/../demo19/apps/projects/project.html" class="fs-5 text-dark text-hover-primary fw-semibold w-375px min-w-200px">Project Delivery Preparation</a>                                  
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
                        <img src="../../links/media/avatars/300-1.jpg" alt="img"/>
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
                <a href="/../demo19/apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">View</a>    
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
                    <img src="../../links/media/avatars/300-1.jpg" alt="img"/>
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
                    <img src="../../links/media/avatars/300-1.jpg" alt="img"/>
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
                    <img alt="" class="w-30px me-3" src="../../links/media/svg/files/pdf.svg"/>
                    <!--end::Icon--> 

                    <!--begin::Info--> 
                    <div class="ms-1 fw-semibold">
                        <!--begin::Desc--> 
                        <a href="/../demo19/apps/projects/project.html" class="fs-6 text-hover-primary fw-bold">Finance KPI App Guidelines</a>
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
                    <img alt="/../demo19/apps/projects/project.html" class="w-30px me-3" src="../../links/media/svg/files/doc.svg"/>
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
                    <img alt="/../demo19/apps/projects/project.html" class="w-30px me-3" src="../../links/media/svg/files/css.svg"/>
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
                    <img src="../../links/media/avatars/300-1.jpg" alt="img"/>
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
                    <img src="../../links/media/avatars/300-2.jpg" alt="img"/>
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
                        <!-- <img alt="img" class="rounded w-150px" src="../../links/media/stock/600x400/img-29.jpg"/>   -->
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
                        <img alt="img" class="rounded w-150px" src="#"/> 
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
                        <img alt="img" class="rounded w-150px" src="#"/>
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
                    <img src="../../links/media/avatars/300-1.jpg" alt="img"/>
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
			<a href="/../demo19/pages/user-profile/activity.html" class="btn btn-bg-body text-primary">
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


<div class="wrapper d-flex flex-column flex-row-fluid  container-xxl " id="kt_wrapper">
    <div class="toolbar d-flex flex-stack flex-wrap py-4 gap-2" id="kt_toolbar">
    <div  class="page-title d-flex flex-column">
        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-3 m-0">
            Online E-Learning Course
        </h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
        
        <!--begin::Wrapper-->
        <div class="d-flex flex-align-items flex-wrap gap-3 gap-xl-0">
            
            <!--begin::Actions-->
            <div class="d-flex align-items-center flex-shrink-0">
                
                <a href="<?php echo $web_root ?>/index.php" class="btn btn-sm btn-white shadow ms-5">
                    <i class="	fa fa-arrow-left"></i> Back
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