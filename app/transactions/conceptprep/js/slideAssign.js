$(function(){ 'use strict';

  $("#inst_btn").hide();
  $("#inst_btn").click(function(){
    //console.log($('#modaldemo3.in').length > 0);
    $(".inst_btn").hide();
  });
  $(".close").click(function(){
    $(".inst_btn").show();
  });

  $("#class_name").change(function(){
    var class_id = $(this).val();
    if(class_id != ""){
      $.ajax({
        type: "POST",
        url: "../../apis/tasks/getTopics.php",
        data: 'classes='+class_id,
        success: function(data){
          var data = $.parseJSON(data);
          var options = '<option value="">-Select Topics-</option>';
          if(data != null) {
            for (var i = 0; i < data.length; i++) {
              {
                options += '<option value="' + data[i].id + '">' + data[i].description + '</option>';
              }
            }
          } else {
            options += '<option value="" disabled>No Topics Availlable</option>';
          }
          $("#topic").html(options);
        },
        beforeSend: function(){
          $("body").mLoading()
        },
        complete: function(){
          $("body").mLoading('hide')
        }
      });
    } else {
      var options = '<option value="">-Select Topics-</option>';
      $("#topic").html(options);
    }
  });

  $("#topic").change(function(){
    var class_id = $("#class_name").val();
    var topic_id = $(this).val();
    $("#slide_classid").val($("#class_name").val());
    $("#slide_topicid").val($("#topic").val());
    $('#div1').html("");
    $.ajax({
      type: "POST",
      url: "apis/getCourseCategorySlides.php",
      data: 'class_id='+class_id+'&topic_id='+topic_id,
      success: function(data){
        var data = $.parseJSON(data);
        var slides = '';
        if(data.html.length > 0) {
          for (var i = 0; i < data.html.length; i++) {
            {
              slides += data.html[i];
            }
          }
          if(!data.slide_count){
            $(".inst_btn").show();
          }
        } else {
          slides += '<div class="col-md-12 mg-t-20 mg-md-t-0"><div class="card bd-0"><img class="card-img-top img-fluid" src="../id/images/notImage.png" alt="Image"><div class="card-body rounded-bottom"><button class="d-block mx-auto btn btn-md btn-warning templates" data-id="">Choose Class and Topic</button></div></div></div>';
        }
        $("#review_div").html(slides).show(1000);
      },
      beforeSend: function(){
        $("body").mLoading()
      },
      complete: function(){
        $("body").mLoading('hide')
      }
    });
  });

  //function for response slide count greaterthan zero
  var SlideIDArray=[]; 
  $(document).on('click', '.slideid', function(e) {
    var arr=SlideIDArray;
    var checkedId=$(this).val();
    if($(this).prop('checked')){
      SlideIDArray.push(checkedId);
      arr=SlideIDArray;
    }
    else
    {
      jQuery.each(SlideIDArray,function(i,item){
        if(arr[i] == checkedId) {
          arr.splice(i, 1);
        }
      });
      SlideIDArray =arr;
    }
    var ids="";
    jQuery.each(SlideIDArray,function(i,item){
      if(ids=="")
      {
        ids= SlideIDArray[i];
      }
      else
      {
        ids= ids+ ","+   SlideIDArray[i];
      }
    });
    $("#prev_slide_id").val(ids);
    //showing and hideing instruction button 
    if(SlideIDArray.length>0){
      $(".inst_btn").show();
    }else{
      $(".inst_btn").hide();
    }
  });
  
  $("#role_type").change(function(){
    var role_type = $(this).val();
    if(role_type != ""){
      if(role_type == "CW"){
        $("#cw_block").removeClass("cw_block");
        $("#tt_block").addClass("tt_block");
        $("#gd_block").addClass("gd_block");
        $("#assign_to").val("CW");
        $.ajax({
          type: "POST",
          url: "../id/apis/getUsers.php",
          data: 'checkeddept=CW',
          success: function(data){
            var data = $.parseJSON(data);
            console.log(data);
            var options = '<option value="">-Select User-</option>';
            if(data != null) {
              for (var i = 0; i < data.length; i++) {
                {
                  options += '<option value="' + data[i].id + '">' + data[i].username + '</option>';
                }
              }
            } else {
              options += '<option value="" disabled>No Users Availlable of this Role</option>';
            }
            $("#user_cw").html(options);
          },
          beforeSend: function(){
            $("body").mLoading()
          },
          complete: function(){
            $("body").mLoading('hide')
          }
        });
      }
    }
  });

  $('#new_task_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"../id/assignWorkNewSlideProcess.php",
      method:'POST',
      data:new FormData(document.new_task_form),
      contentType:false,
      processData:false,
      success:function(data)
      {
        var json = $.parseJSON(data);
        if(json.status){
          document.getElementById("new_task_form").reset();
          $(".close").trigger('click');
          $("#inst_btn").hide();
          $.toaster({ message : 'Successfully Assigned.', title : '', priority : 'success' });
          if(json.slide == "ok") {
            $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-checkmark-circled'></i>");
          }
          else {
            $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-backspace'></i>");
          }
          //console.log("success");
        } else {
          $.toaster({ message : json.message, title : 'Oh No!', priority : 'danger' });
          console.log("fail");
        }
      },
      beforeSend: function(){
        $("body").mLoading()
      },
      complete: function(){
        $("body").mLoading('hide')
      }
    });
  });
});