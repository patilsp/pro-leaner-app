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

    <title>Virtual School</title>
    <link rel="icon" type="image/png" href="img/favicon.png" />

    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="css/cms.css">
    <link rel="stylesheet" href="css/newstyle.css">
  </head>

  <body>

  <div class="wrapper" id="login-row">
      <div class="row">
        <div class="col-md-7">
          <header>
            <!-- <img src="img/logo.png" class="nav_logo"> -->
          </header>
        
          <div class="d-flex col-md-10 align-items-center p-4">
            <div class="w-100 d-flex justify-content-center text-center">
              <img src="img/login.png" alt="Login image" width="300" >
            </div>
          </div>
          <footer class="w-100 d-flex align-items-center pt-4 mt-4">
            <br/>
              <p class="m-0 font-weight-medium">Powered By</p>
            <br/>
                  
            <div class="diff mx-2"></div>
            <img src="./img/logo/logo.png" width="150">
          </footer>
        </div>
        <div class="col-md-5  text-center " id="login_form_div">
          <br/>
            <h1 class="txt-blue display-6">Virtual School</h1>
          <br/>
          <!-- <h6 class="mb-2"></h6> -->
          <form class="user-login-form">
            <div class="row">
              <!-- <form> -->
                <div class="col-12" id="form_blk">
                  <div class="p-3">
                    <br/>
                    <br/>
                    <h3 class="mb-4">Login</h3>
                     <br/>
                    
                    <div class="form-group mt-2 text-left">
                      <h6>Username</h6>
                      <input type="text" class="form-control" placeholder="Enter your username" name="username" id="username">
                    </div>

                    <div class="form-group mt-2 text-left">
                      <h6>Password</h6>
                      <div class="form-group mb-0 text-left">
                      <input type="password" class="form-control" placeholder="Enter your password" name="password" id="password">
                      
                      </div>
                    </div>
                  </div>
                
                  <span id="html_invalid"></span>
                  <div class="d-flex justify-content-md-between align-items-center pl-2 pr-3 pt-2 mb-2">
                    <div class="form-group form-check">
                      <input type="checkbox" name="remember" class="form-check-input" id="rememberme">
                      <label class="form-check-label font-weight-medium pt-1" role="button" for="rememberme">Remember me</label>
                    </div>
                    <h6 class="pt-3 forget_pass" role="button" data-toggle="modal" data-target="#forgot_password_modal">Forgot Password?</h6>
                  </div>
                  <br/>
                  <div class="col-12"> 
                  <div class="d-grid mb-5">
                    <button type="submit"  id="login_btn" class="btn btn-primary p-4 login-btn shadow">
            
                    <!--begin::Indicator label-->
                    <span class="indicator-label">
                        Sign In</span>
                      </button>
                    </div>          
                 
                  </div>

                </div>
              <!-- </form> -->

            </div>
          </form>
          <p class="font-weight-medium mb-0 mt-5">Help and Support - support@prepmyskills.com</p>
        </div>
      </div>
    </div>

    <!-- <div class="d-flex align-items-center justify-content-center ht-100v">
      <img src="img/login_bg.png" class="wd-100p ht-100p object-fit-cover" alt="">
      <div class="overlay-body bg-black-6 d-flex align-items-center justify-content-center">
        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 rounded bd bd-white-2 bg-black-7">
          <div class="signin-logo tx-center tx-26 tx-bold tx-white"><span class="tx-normal">[</span> PREPMYSKILLS <span class="tx-info">CMS</span> <span class="tx-normal">]</span></div>
          <div class="tx-white-5 tx-center mg-b-20"> Add Authoring Tool</div>
          <div class="validation_signin_error"></div>
          <form class="user-login-form">
            <div class="form-group">
              <input type="text" class="form-control fc-outline-dark" placeholder="Enter your username" name="username" id="username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control fc-outline-dark" placeholder="Enter your password" name="password" id="password">
              <a href="#" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div>
            <button type="button" class="btn btn-info btn-block" id="login_btn">Sign In</button>
          </form>
        </div>
      </div>
    </div> -->

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
