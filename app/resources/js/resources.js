$(function() {
  'use strict';
  // show only the icons and hide left menu label by default
  $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
  $(document).on('mouseover', function(e) {
    e.stopPropagation();
    if ($('body').hasClass('collapsed-menu')) {
      var targ = $(e.target).closest('.br-sideleft').length;
      if (targ) {
        $('body').addClass('expand-menu');
        // show current shown sub menu that was hidden from collapsed
        $('.show-sub + .br-menu-sub').slideDown();
        var menuText = $('.menu-item-label,.menu-item-arrow');
        menuText.removeClass('d-lg-none');
        menuText.removeClass('op-lg-0-force');
      } else {
        $('body').removeClass('expand-menu');
        // hide current shown menu
        $('.show-sub + .br-menu-sub').slideUp();
        var menuText = $('.menu-item-label,.menu-item-arrow');
        menuText.addClass('op-lg-0-force');
        menuText.addClass('d-lg-none');
      }
    }
  });

  $("#class_name").change(function(){
    var class_id = $(this).val();
    if(class_id != ""){
      $.ajax({
        type: "POST",
        url: "apis/tasks/getTopics.php",
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
      url: "apis/resources/getResImgBlk.php",
      data: 'class_id='+class_id+'&topic_id='+topic_id,
      success: function(data){
        $("#img_data").html(data);
      },
      beforeSend: function(){
        $("body").mLoading()
      },
      complete: function(){
        $("body").mLoading('hide')
      }
    });
  });

  // for upload image from front end on 28th March
  $('#uploadimage').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url: "apis/resources/image_upload.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      async:true,
      success: function(data) {
        document.getElementById("uploadimage").reset();
        $("#tags").tagsinput('removeAll');
        var json = $.parseJSON(data);
        if (json.status) {
          $("#dbsuccess").modal("show");
          $("#img_data").html(json.data);
          $("#modal-body").html("<ul><li style='color:green;font-weight:bold'>"+json.suc_message+"</li><li style='color:red;font-weight:bold'>"+json.fail_message+"</li>");
        } else {
          
        }
        $("#dbsuccess").modal("show");
      },
      beforeSend: function() {
        $("body").mLoading()
      },
      complete: function() {
        $("body").mLoading('hide')
      }
    });
  });
  // Showing sub left menu
  $('#showSubLeft').on('click', function() {
    if ($('body').hasClass('show-subleft')) {
      $('body').removeClass('show-subleft');
    } else {
      $('body').addClass('show-subleft');
    }
  });
  $("#image_tab").click(function() {
    $("#image_tab").addClass('active');
    
    
  });
});