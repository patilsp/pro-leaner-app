$(function() {
	'use strict';

  $(document).on("click", ".clickExistingSlides", function(){
    var slide_title = $(this).data("slidetitle");
    $("#iframe_id").attr("src", $(this).data("slidepath"));
    $("#boxTitle").text(" - "+slide_title);
    $("button").removeClass("btn_active");
    $(this).addClass("btn_active");
  });

  $("#success_slide, #fail_slide").hide();

  // Summernote editor
  $('#summernote').summernote({
      height: "200px",
      tooltip: true,
      callbacks: {
          onImageUpload: function(files) {
              var task_assign_id = $(".task_assign_id").val();
              var url = 'apis/uploadNotepadImages.php?'+"task_assign_id="+task_assign_id; //path is defined as data attribute for  textarea
              sendFile(files[0], url, $(this));
          }
      }
  });

  function sendFile(file, url, editor) {
      var data = new FormData();
      data.append("file", file);
      var request = new XMLHttpRequest();
      request.open('POST', url, true);
      request.onload = function() {
          if (request.status >= 200 && request.status < 400) {
              // Success!
              var resp = request.responseText;
              editor.summernote('insertImage', resp);
              console.log(resp);
          } else {
              // We reached our target server, but it returned an error
              var resp = request.responseText;
              console.log(resp);
          }
      };
      request.onerror = function(jqXHR, textStatus, errorThrown) {
          // There was a connection error of some sort
          console.log(jqXHR);
      };
      request.send(data);
  }

  $('#notepad_form').on('submit', function(event){
    //prevent the form from submitting by default
    event.preventDefault();
    var task_assign_id = $(".task_assign_id").val();
    $.ajax({
      url: 'apis/uploadNotepadImages.php?'+"task_assign_id="+task_assign_id,
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      async:true,
      success:function(data)
      {
        console.log(data);
      },
      beforeSend: function(){
        $("body").mLoading()
      },
      complete: function(){
          $("body").mLoading('hide')
      }
    });
  });

  $('#dismiss, .overlay').on('click', function () {
    topbarFunction(0);
  });


  $('#dismiss_notepad, .overlay_notepad').on('click', function () {
    topbarNotepadFunction(0);
  });
  $('.topbarNotepadCollapse').on('click', function () {
    topbarNotepadFunction(1);
  });
  function topbarNotepadFunction(para) {
    var userinput = para;
    if(userinput === 0) {
      $('#topbar_notepad').removeClass('active');
      $('.overlay_notepad').removeClass('active');
    } else if(userinput === 1) {
      $('#topbar_notepad').addClass('active');
      $('.overlay_notepad').addClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    }
  }

  //Add new slide button
  $('.topbarCollapse').on('click', function () {
    topbarFunction(1);
    var addslideClassid = $(this).data("classid");
    var addslideTopicid = $(this).data("topicid");
    var addslideLessonid = $(this).data("lessonid");
    var prev_slide_id = $(this).data("prev_slide_id");
    $(".class").val(addslideClassid);
    $(".topic_id").val(addslideTopicid);
    $(".lesson_id").val(addslideLessonid);
    $(".prev_slide_id").val(prev_slide_id);
    $(".pagebody_class").val(addslideClassid);
    $(".pagebody_topic_id").val(addslideTopicid);
  });

  $(".layoutChoosed").click(function(){
    var layoutfilepath = $(this).data("layoutpath");
    var layoutid = $(this).data("resourcesid");
    $(".layout_id").val(layoutid);
    $("iframe").attr("src",layoutfilepath);
    $("#slideTitleModal").modal("show");
    topbarFunction(0);
    layoutPHPFilepath(layoutfilepath, "get_respath", "", "");
  });

  function topbarFunction(para) {
    var userinput = para;
    if(userinput === 0) {
      $('#topbar').removeClass('active');
      $('.overlay').removeClass('active');
    } else if(userinput === 1) {
      $('#topbar').addClass('active');
      $('.overlay').addClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    }
  }
  function topbarCollapse(addslideClassid, addslideTopicid, addslideLessonid, prev_slide_id) {
    topbarFunction(1);
    $(".class").val(addslideClassid);
    $(".topic_id").val(addslideTopicid);
    $(".lesson_id").val(addslideLessonid);
    $(".prev_slide_id").val(prev_slide_id);
  }

  $('#slideTitleModalForm').on('submit', function(event){
    //prevent the form from submitting by default
    event.preventDefault();
    $.ajax({
      url: 'apis/createSlideTitle.php',
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      async:true,
      success:function(data)
      {
        var json = $.parseJSON(data);
        if(json.status){
          $("#slide_title").val("");
          $(".br-sideleft").html(json.slides);
          $("#boxTitle").html(" - "+json.slideTitle);
          $("#current_container_slideid").val(json.slideid);
          $("#slideTitleModal").modal("hide");
          
          //topbar layouts
          $('.topbarCollapse').on('click', function () {
            console.log($(this).data("classid"));
            var addslideClassid = $(this).data("classid");
            var addslideTopicid = $(this).data("topicid");
            var addslideLessonid = $(this).data("lessonid");
            var prev_slide_id = $(this).data("prev_slide_id");
            topbarCollapse(addslideClassid, addslideTopicid, addslideLessonid, prev_slide_id);
          });
        } else {
          console.log(json.status);
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

  $("#preview").click(function(event){
    var respath = $("#respath").val();
    var current_container_slideid = $("#current_container_slideid").val();
    layoutPHPFilepath("", "save_preview", respath, current_container_slideid);
  });

  //get layout .php file path getting
  function layoutPHPFilepath(layoutfilepath, actionType, respath, current_container_slideid) {
    if(actionType == "get_respath") {
      var layoutfilepath = layoutfilepath;
      $.ajax({
        url:"apis/getLayoutFile.php",
        method:'POST',
        async:true,
        data:"layoutfilepath="+layoutfilepath + "&type=getFullLayout",
        success:function(data)
        {
          var res = $.parseJSON(data);
          var respath = res['file_path_name'];
          $("#respath").val(respath);

          setTimeout(function () {
            //Change Images
            $("#iframe_id").contents().find("img").click(function() {
              console.log("came");
              $("#iframe_id").contents().find("img").removeClass("replace_img");
              $(this).addClass("replace_img");
              $("#iframe_id").contents().find('.image').removeClass('replace_img');
              $(this).closest('div').find('.image').addClass('replace_img');
              
              var classid = $(".pagebody_class").val();
              var topicid = $(".pagebody_topic_id").val();
              getImageUploadModal(classid, topicid, "");
            });
          }, 1000);
        },
        beforeSend: function(){
          $(".mLoading").addClass("active");
        },
        complete: function(){
          $(".mLoading").removeClass("active");
        }
      });
    }
    //get preview modal/save file respective folder
    else if(actionType === "save_preview") {
      var respath = respath;
      var current_container_slideid = current_container_slideid;
      var action_type = actionType;
      $.ajax({
        url:respath+'?'+"current_container_slideid="+current_container_slideid+"&action_type="+action_type,
        method:'POST',
        data:new FormData(myframe.document.getElementById("layout_form")),
        contentType:false,
        processData:false,
        async:true,
        success:function(data)
        {
          $("#privew").modal("show");
          $("#pre_iframe").attr("src",data);
        },
        beforeSend: function(){
          $(".mLoading").addClass("active");
        },
        complete: function(){
          $(".mLoading").removeClass("active");
        }
      });
    }
  }

  //responsive Check for priview screen
  $(".desktop-icon").click(function () {
    $(".iframe_wrapper").animate({"width": "100%"}, "fast");
  });
  $(".tablet-icon").click(function () {
    $(".iframe_wrapper").animate({"width": "768px"}, "fast");
  });
  $(".phone-icon").click(function () {
    $(".iframe_wrapper").animate({"width": "320px"}, "fast");
  });

  //get saved slides
  $("body").on('click', ".clickSavedSlides", function(){
    $("button").removeClass("btn_active");
    $(this).addClass("btn_active");
    $(".pagebody_class").val($(this).data("classid"));
    $(".pagebody_topic_id").val($(this).data("topic_id"));
    var slideid = $(this).data("autoid");
    var layoutid = $(this).data("layoutid");
    getClickedSavedSlides(slideid, layoutid);
  });

  function getClickedSavedSlides(slideid, layoutid) {
    $.ajax({
      url:"apis/getChoosedSavedSlides.php",
      method:'POST',
      async:true,
      data:"slideid="+slideid +"&layoutid="+layoutid,
      success:function(data)
      {
        var res = $.parseJSON(data);
        var layoutfilepath = res.slideLayoutHTML;
        $("#respath").val(res.slideLayoutPHP);
        $("#current_container_slideid").val(res.slideid);
        $("#boxTitle").html(" - "+res.slideTitle);
        $("iframe").attr("src",layoutfilepath);
        //console.log(res.slideJSON);
        var slideJSON = $.parseJSON(res.slideJSON);
        setTimeout(function () {
          for (var key in slideJSON) {
            if (slideJSON.hasOwnProperty(key)) {
              myframe.document.getElementsByName(key).value = slideJSON[key];
              if($.isArray(slideJSON[key])) {
                $('#iframe_id').contents().find("[name='" + key + "[]']").map(function(key1){ $(this).val(slideJSON[key][key1]);});
              } else {
                $('#iframe_id').contents().find('input[name="'+key+'"]').val(slideJSON[key]);
                $('#iframe_id').contents().find('#'+key).attr('src', slideJSON[key]);
              }
            }
          }

          //Change Images
          $("#iframe_id").contents().find("img").click(function() {
            console.log("came");
            $("#iframe_id").contents().find("img").removeClass("replace_img");
            $(this).addClass("replace_img");
            $("#iframe_id").contents().find('.image').removeClass('replace_img');
            $(this).closest('div').find('.image').addClass('replace_img');
            var classid = $(".pagebody_class").val();
            var topicid = $(".pagebody_topic_id").val();
            getImageUploadModal(classid, topicid, "");
          });
        }, 1000);
      },
      beforeSend: function(){
        $(".mLoading").addClass("active");
      },
      complete: function(){
        $(".mLoading").removeClass("active");
      }
    });
  }

  //get saved slides
  $("body").on('click', ".clickSavedSlidesReview", function(){
    $(".pagebody_class").val($(this).data("classid"));
    $("#boxTitle").html(" - "+$(this).text());
    $(".pagebody_topic_id").val($(this).data("topic_id"));
    var slideid = $(this).data("autoid");
    var slidepath = $(this).data("slidepath");
    getClickedSavedSlidesForReview(slideid, slidepath);
  });
  function getClickedSavedSlidesForReview(slideid, slidepath) {
    $("iframe").attr("src",slidepath);
  }

  //upload images
  function getImageUploadModal(classid, topicid, layoutid){
    var classid = classid;
    var topicid = topicid;
    var layoutid = layoutid;

    $.ajax({
      url:"apis/getResourceImages.php",
      method:'POST',
      async:true,
      data:"class_id="+classid+"&topic_id="+topicid+"&layoutid="+layoutid,
      success:function(data)
      {
        $("#img_table").html(data);
        $("#resources").modal('show');
        $("input#tags").tagsinput('input');
        imgUploadRes($(".pagebody_class").val(), $(".pagebody_topic_id").val());

        $('.imgpath').change(function(){
          var imgpath = $( 'input[name=imgpath]:checked' ).val();
          console.log(imgpath);
          $("#iframe_id").contents().find(".replace_img").attr('src', imgpath);
          $("#iframe_id").contents().find('.replace_img').val(imgpath);
          $("#resources").modal('hide');
        });
      },
      beforeSend: function(){
        $(".mLoading").addClass("active");
      },
      complete: function(){
        $(".mLoading").removeClass("active");
      }
    });
  }

  function imgUploadRes(classid, topicid) {
    $('#img_upload').on('submit', function(event){
      event.preventDefault();
      $.ajax({
        url:'apis/uploadImages.php?class_id='+classid+'&topics_id='+topicid,
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        async:true,
        success:function(data)
        {
          var json = $.parseJSON(data);
          console.log(json);
          document.getElementById("img_upload").reset(); 
          $('input#tags').tagsinput('removeAll');

          var classid = $(".pagebody_class").val();
          var topicid = $(".pagebody_topic_id").val();
          getImageUploadModal(classid, topicid, "");
        }
      });
    });
  }

  //Send for review to ID
  $("#save").click(function(event){
    event.preventDefault();
    var cw_remarks = $("#cw_remarks").val();
    var status = 17;
    var external_files = "";
    var task_assi_id = $(".task_assign_id").val();
    $.ajax({
      url:"../cw/taskReplyProcessAdd.php",
      method:'POST',
      async:true,
      data:"cw_remarks="+cw_remarks+"&status="+status+"&external_files="+external_files+"&task_assi_id="+task_assi_id+"&action_type=topic_level",
      success:function(data1)
      {
        $("#modaldemo3").modal("hide");
        $("#modalsuccess").modal("show");
        window.setTimeout(function () {
          location.href = "../../taskListOTR.php";
        }, 2000);
      },
      beforeSend: function(){
        $(".mLoading").addClass("active");
      },
      complete: function(){
        $(".mLoading").removeClass("active");
      }
    });
  });

  //Review screen for add slides of topic level
  $(".inst_attch").hide();
  $("#status_cw").change(function(){
    var sts = $(this).val();
    if(sts == 5){
      $(".inst_attch").show(1000);
    } else {
      $(".inst_attch").hide(1000);
    }
  });

  $('#task_reply_ID').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"taskReplyProcessID.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      async:true,
      success:function(data)
      {
        console.log(data);
        var json = $.parseJSON(data);
        if(json.status){
          console.log("if");
          $("#modaldemo3").modal("hide");
          $("#modalsuccess").modal('show');
          setTimeout(function(){window.top.location="../../taskListAddSlides.php"} , 2000);
        } else {
          console.log("else");
          $("#modaldemo3").modal("hide");
          //$("#success_msg").append(json.message)
          $("#modalsuccess").modal('show');
        }
      },
      beforeSend: function(){
        $(".mLoading").addClass("active");
      },
      complete: function(){
        $(".mLoading").removeClass("active");
      }
    });
  });
});