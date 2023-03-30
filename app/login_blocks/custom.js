/* Custom JavaScript */
$(document).ready(function($) {

    $('.eye').click(function(){
           
        if($(this).hasClass('eye-slash')){
           
          $(this).removeClass('eye-slash');
          
          $(this).addClass('eye');
          $(this).attr('src','links/media/show_password.svg');
          $('#password').attr('type','text');
          }else{
         
          $(this).removeClass('eye');
          
          $(this).addClass('eye-slash');  
          $(this).attr('src','links/media/hide_password.svg');
          
          $('#password').attr('type','password');
        }
    });
    // enter keyd
    $(document).bind('keypress', function(e) {
        if(e.keyCode==13){
             $('#login_btn').trigger('click');
             $('#reset_password').trigger('click');
         }
    });
    $(".user-login-form").validate({
        rules: {
            username: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },
        },

        //specify the validation error messages
        messages:{
            username: {
                required: "Please enter your EmailId",
                email: "Invalid Email Id"
            },
            password: { 
                required: "Please enter your Password",
                minlength: "Your password must be at least 5 characters long",
            },
        }
    });
    $("#login_btn").click(function()
    {
        //alert($('input[name=remember]:checked', '.user-login-form').val());
        
        var username = $("#username").val();
        var password = $("#password").val();
        var dataString = "email="+ username + "&password="+ password + "&parameter= + login_section";
        if($(".user-login-form").valid()){
            $.ajax
            ({
                type: "POST",
                url: "app/login_blocks/validate_login.php",
                data: dataString,
                cache: false,
                success: function(html){
                    //console.log("came" + html + "came");
                    var trimmedResponse = $.trim(html);
                    
                    if(trimmedResponse == "username_not_exists"){
                      $(".link, .validate").show();
                      $('.validation_signin_error').html("<div class='alert alert-danger'>User was not found.<a href='#' class='close' data-dismiss='alert'>×</a></div>");
                      $('.validate, .link').fadeIn();
                      setTimeout(function(){
                        $('.validate, .link').fadeOut()
                      },5000);
                      
                      $("#password").val("");
                      return false;
                    }
                    else if(trimmedResponse == "username_exists"){
                      console.log(html);
                      window.location.href="app/home.php";
                      
                      return false;
                    }
                    else if(trimmedResponse == -1){
                      $(".link, .validate").show();
                      $('.validate').html('Some Technical Error: ' + html);
                      setTimeout(function(){
                        $('.validate, .link').fadeOut()
                      },5000);
                      
                      $("#password").val("");
                      return false;
                    }
                },
                beforeSend: function(){
                    $("body").mLoading()
                },
                complete: function(){
                    $("body").mLoading('hide')
                }
            });
        }
    });
    

    //reset_password
    $("#reset_form").validate({
        rules: {
            reg_email: {
                required: true,
                email: true
            },
        },

        //specify the validation error messages
        messages:{
            reg_email: {
                required: "Please enter your EmailId",
                email: "Invalid Email Id"
            },
        },
    });

    $("#reset_password").click(function()
    {
        
        var username = $("#reg_email").val();
        var dataString = "email="+ username + "&parameter= + forgot_password_section";
        if($("#reset_form").valid()) 
        {
            $.ajax
            ({
                type: "POST",
                url : "forgot_process.php",
                data : dataString,
                cache : false,
                beforeSend: function() {
                    $(".loading").show();
                    $(".loading").html("Loading..Please Wait...");
                    $(".loading").css("color", "#F39C12");
                  },
                success : function(html)
                {
                  if(html == 1){
                    $("#success").show();
                    $('.form_success').css({'color':'green'});
                        $('.form_success').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>  <i class="icon fa fa-check"></i>  Your password has been sent to your PREPMYSKILLS mail.</h4></div>');
                        $('.form_success').fadeIn();
                        setTimeout(function(){
                          $(".form_success").fadeOut()
                        },9000);
                        $(".loading").hide();
                        $("#uemail").val('');
                  }
                  else
                  {
                    $("#success").show();
                    $('.errform').css({'color':'red'});
                    $('.errform').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>  <i class="icon fa fa-close"></i>  Please enter your registered email id!</h4></div>');
                    $('.errform').fadeIn();
                    setTimeout(function(){
                      $(".errform").fadeOut()
                    },15000);
                    $(".loading").hide();
                    $("#uemail").val('');
                  }
                },
                beforeSend: function(){
                    $("body").mLoading()
                },
                complete: function(){
                    $("body").mLoading('hide')
                }
            });
        }
    });	
});

