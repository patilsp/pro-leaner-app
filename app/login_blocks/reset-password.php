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
    <link rel="icon" type="image/png" href="../../img/favicon.png" />
    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Bracket CSS -->
    <link href="../../links/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="../../links/css/main.css" rel="stylesheet" type="text/css"/>
  </head>
  <body  id="kt_body"  class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bg-black" >
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-600px mb-10 mb-lg-20" src="../../links/media/svg/Forgot-Password.svg" alt=""/>    
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                                <div class="w-lg-500px p-10">
                                    <!--begin::Form-->
                                    <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_password_reset_form" data-kt-redirect-url="/metronic8/demo19/../demo19/authentication/layouts/corporate/new-password.html" action="#">
                                     
                                        <div class="text-center mb-10">
                                            <h1 class="text-dark fw-bolder mb-3">
                                                Forgot Password ?
                                            </h1>
                                            <div class="text-gray-500 fw-semibold fs-6">
                                                Enter your email to reset your password.
                                            </div>
                                        </div>
                                        <div class="fv-row mb-8 fv-plugins-icon-container">
                                            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent"> 
                                          
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    
                                        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                            <button type="button" id="kt_password_reset_submit" class="btn btn-primary me-4">Submit</button>
                                    
                                            <a href="#" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- links -->
  </body>
</html>
