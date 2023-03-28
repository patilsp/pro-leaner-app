<?php
  session_start();
  if(isset($_SESSION['cms_name']))
   header("Location:app/home.php");
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
    <title>Tech E-Learning School</title>
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- Bracket CSS -->
    <link href="links/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="links/css/style.bundle.css" rel="stylesheet" type="text/css"/>
  </head>
  <body  id="kt_body"  class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bg-black" >
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-600px mb-10 mb-lg-20" src="img/create-account.png" alt=""/>    
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <form class="user-login-form form w-100" >
                                <div class="text-center mb-11">
                                    <h1 class="text-dark fw-bolder mb-3">
                                        Sign In
                                    </h1>
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Your Social Campaigns
                                    </div>
                                </div>
                                <div class="row g-3 mb-9">
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                           <i class="fa fa-google"></i>   
                                            Sign in with Google
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <i class="fa fa-apple"></i>      
                                            Sign in with Apple
                                        </a>
                                    </div>
                                </div>
                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" class="form-control" placeholder="Enter your username" name="username" id="username">
                    
                                </div>
                                <div class="fv-row mb-3">   
                                    <input type="password" class="form-control" placeholder="Enter your password" name="password" id="password">
                                    <!--end::Password-->
                                </div>
                                <span id="html_invalid"></span>
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">                      
                                    <a href="/metronic8/demo19/../demo19/authentication/layouts/overlay/reset-password.html" class="link-primary">
                                        Forgot Password ?
                                    </a>
                                </div>
                                <div class="d-grid mb-10">
                                <button type="submit"  id="login_btn" class="btn btn-primary p-4 login-btn shadow">
                                    Sign In
                                </button>
                                </div>
                                <!--end::Submit button-->

                                <!--begin::Sign up-->
                                <div class="text-gray-500 text-center fw-semibold fs-6">
                                    Not a Member yet?

                                    <a href="/metronic8/demo19/../demo19/authentication/layouts/overlay/sign-up.html" class="link-primary">
                                        Sign up
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- links -->
    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <!-- ajax loader -->
    <script src="lib/ajax_loader/jquery.mloading.js"></script>
    <script src="lib/jquery_validate/jquery.validate.min.js"></script>
    <script src="lib/jquery_validate/additional-methods.min.js"></script>
    <script src="app/login_blocks/custom.js"></script>
  </body>
</html>
