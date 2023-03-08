$(function() {
  'use strict';

  $("#success_slide, #fail_slide").hide();

  $('#topicStatus').change(function(){
    console.log($(this).val());
      var data = $(this).val();
      if(data == 20)
        $('#users_list').removeClass('users_list');
      else
        $('#users_list').addClass('users_list');
  });

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
  $(document).on('click','.topbarCollapse',function(){
  //$('.topbarCollapse').on('click', function () {
    topbarFunction(1);
    var addslideClassid = $(this).data("classid");
    var addslideTopicid = $(this).data("topicid");
    var addslideLessonid = $(this).data("lessonid");
    $(".class").val(addslideClassid);
    $(".topic_id").val(addslideTopicid);
    $(".lesson_id").val(addslideLessonid);
    $(".pagebody_class").val(addslideClassid);
    $(".pagebody_topic_id").val(addslideTopicid);
  });

  $(".layoutChoosed").click(function(){
    var layoutfilepath = $(this).data("layoutpath");
    var layoutid = $(this).data("resourcesid");
    var layoutname = $(this).data("layoutname");
    var classes = $(".class").val();
    var topic_id = $(".topic_id").val();
    var lesson_id = $(".lesson_id").val();
    var task_assign_id = $(".task_assign_id").val();
    $('#choosedLayoutId').val(layoutid);
    topbarFunction(0);
    if(layoutname == "Layout8.4"){
      console.log(classes,topic_id,lesson_id);
      generateslides(classes, topic_id, lesson_id, layoutid, task_assign_id);
    } else {
      $(".layout_id").val(layoutid);
      $("iframe").attr("src",layoutfilepath);
      $("#slideTitleModal").modal("show");
      layoutPHPFilepath(layoutfilepath, "get_respath", "", "");
    }
  });

  function generateslides(classes, topic_id, lesson_id, layoutid, task_assign_id){
    $.ajax({
      url:"apis/generateSlides.php",
      method:'POST',
      data:"classes="+classes+"&topic_id="+topic_id+"&lesson_id="+lesson_id+"&layoutid="+layoutid+"&task_assign_id="+task_assign_id,        
      async:true,
      success:function(data)
      {
        var json = $.parseJSON(data);
        if(!json.status){
          setTimeout(function () {
            alert(json.message);
          }, 1000)
        } else {
          setTimeout(function() {
            $("#boxTitle").html(" - Add Slides");
            $(".br-sideleft").html(json.slides);
            window.top.$('#iframe_id').attr('src', '');
          }, 1000);
        }
      },
      beforeSend: function(){
        $(".mLoading").addClass("active");
      },
      complete: function(){
        $(".mLoading").removeClass("active");
      }
    });
  }

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
  function topbarCollapse(addslideClassid, addslideTopicid, addslideLessonid) {
    topbarFunction(1);
    $(".class").val(addslideClassid);
    $(".topic_id").val(addslideTopicid);
    $(".lesson_id").val(addslideLessonid);
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

          $("#addChangeAudio").attr("data-resourceId",'');
          
          //topbar layouts
          $('.topbarCollapse').on('click', function () {
            console.log($(this).data("classid"));
            var addslideClassid = $(this).data("classid");
            var addslideTopicid = $(this).data("topicid");
            var addslideLessonid = $(this).data("lessonid");
            topbarCollapse(addslideClassid, addslideTopicid, addslideLessonid);
          });

          audioFeature();
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
    var errors = false;
    var elements = $('textarea, input', myframe.document.getElementById("layout_form"));
    var slideContainsArray = [];
    var skipLayoutIds = [0, 5263];
    $.each(elements, function(i, element) {
      var value = $(this).val();
      var hasMoreThanAscii = /^[\u0000-\u007f]*$/.test(value);
      /*if(! hasMoreThanAscii) {
        alert("Text " + value + " contains invalid characters");
        $(this).focus();
        return false;
      }*/
      if(value !== '' && value !== 'undefined' && value !== null) {
        slideContainsArray.push(value);
      }
      if(i == elements.length-1) {
        console.log('length----',slideContainsArray.length);
        if(slideContainsArray.length === 0 && !skipLayoutIds.includes($("#choosedLayoutId").val())) {
          alert('empty slide. Please enter content (or) delete.');
          return false;
        }

        layoutPHPFilepath("", "save_preview", respath, current_container_slideid);
      }
    });
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

            //Change iframe url
            $("#iframe_id").contents().find("span").click(function() {
              console.log("iframe");
              $("#iframe_id").contents().find("iframe").removeClass("replace_img").addClass("replace_img");
              $("#iframe_id").contents().find('.image').removeClass('replace_img');
              $(this).closest('div').find('.image').addClass('replace_img');
              
              var classid = $(".pagebody_class").val();
              var topicid = $(".pagebody_topic_id").val();
              getMsUploadModal(classid, topicid, "");
            });
          }, 1000);
        },
        beforeSend: function(){
          $("body").mLoading('show');
        },
        complete: function(){
          $("body").mLoading('hide');
        }
      });
    }
    //get preview modal/save file respective folder
    else if(actionType === "save_preview") {
      var choosedLayoutId = $('#choosedLayoutId').val();
      //alert(choosedLayoutId);
      if(choosedLayoutId == 0) {
        respath = respath+'app/contents/layouts/static_layouts/topic_2019/uploadAudioActLayout.php'
      }
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
          if(data == 'actAudioUploadSuccess') {
            alert('Successfully audio saved for the activity');
          } else {
            $("#privew").modal("show");
            $("#pre_iframe").attr("src",data);
          }
        },
        beforeSend: function(){
          $("body").mLoading('show');
        },
        complete: function(){
          $("body").mLoading('hide');
        }
      });
      $.ajax({
        url:"apis/unsyncpopups.php",
        method:'POST',
        data:"current_container_slideid="+current_container_slideid,        
        async:true,
        success:function(data)
        {
          //No Action required
        },
        beforeSend: function(){
          //$(".mLoading").addClass("active");
        },
        complete: function(){
          //$(".mLoading").removeClass("active");
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
    $(".iframe_wrapper").animate({"width": "640px"}, "fast");
    $("#pre_iframe").css({"height": "360px !important"});
  });

  //get saved slides
  $("body").on('click', ".clickSavedSlides", function(){
    $(".pagebody_class").val($(this).data("classid"));
    $(".pagebody_topic_id").val($(this).data("topic_id"));
    var slideid = $(this).data("autoid");
    var layoutid = $(this).data("layoutid");
    var slidepath = $(this).data("slidepath");
    var layoutname = $(this).data("layoutname");
    $('#choosedLayoutId').val(layoutid);
    $('#clicked_slidepath').text(slidepath);
    getClickedSavedSlides(slideid, layoutid, layoutname);
    audioFeature();
  });

  function audioFeature() {
    //show audio option
    $('#audioOption').removeClass('d-none');
  }

  function getClickedSavedSlides(slideid, layoutid, layoutname) {
    $.ajax({
      url:"apis/getChoosedSavedSlides.php",
      method:'POST',
      async:true,
      data:"slideid="+slideid +"&layoutid="+layoutid,
      success:function(data)
      {
        var res = $.parseJSON(data);
        //console.log(res);
        var layoutfilepath = res.slideLayoutHTML;
        var generated_slidepath = res.generated_slide;
        $("#respath").val(res.slideLayoutPHP);
        $("#current_container_slideid").val(res.slideid);
        $("#boxTitle").html(" - "+res.slideTitle);
        $("#addChangeAudio").attr("data-resourceId",res.resId);
        if(layoutname == "Layout8.4")
          $("iframe").attr("src",generated_slidepath);
        else
          $("iframe").attr("src",layoutfilepath);
        //console.log(res.slideJSON);
        if(layoutid != 0){
          var slideJSON = $.parseJSON(res.slideJSON);
        }
        setTimeout(function () {
          
          if(layoutid != 0){
            for (var key in slideJSON) {
              if (slideJSON.hasOwnProperty(key)) {
                //console.log("key---",key);

                if(key === 'audio') {
                  $("#iframe_id").contents().find("form").append('<div id="playerContainer" class="position-absolute" style="top: 0rem; right: 1rem"><input type="hidden" name="audio" value="'+slideJSON[key]+'" /><audio controls style="position: absolute;z-index: 2;opacity: 0.01;"><source src="'+slideJSON[key]+'" type="audio/mpeg"></audio><img src="../../../images/play-button.svg" style="width: 50px;"></div>');
                }
                myframe.document.getElementsByName(key).value = slideJSON[key];
                if($.isArray(slideJSON[key])) {
                  $('#iframe_id').contents().find("[name='" + key + "[]']").map(function(key1){ $(this).val(slideJSON[key][key1]);});
                } else {
                  $('#iframe_id').contents().find('textarea[name="'+key+'"]').text(slideJSON[key]);
                  //$('#iframe_id').contents().find('#'+key).attr('src', slideJSON[key]);
                  var local = 5109;
                  var server = 5157;
                  var local_link = 5113;
                  var server_link = 5158;
                  if(layoutid !== server || layoutid !== local_link)
                    $('#iframe_id').contents().find('#'+key).attr('src', slideJSON[key]);
                  if(layoutid === server){
                    //officeapps
                    $('#iframe_id').contents().find('iframe').attr('src','https://view.officeapps.live.com/op/embed.aspx?src='+slideJSON[key]);

                    //googledrive services
                    //$('#iframe_id').contents().find('#iframe_data').html('<iframe src="https://docs.google.com/gview?url='+slideJSON[key]+'&embedded=true" frameborder="no" style="width:100%;height:97vh"></iframe>');
                    $('#iframe_id').contents().find('input[name="'+key+'"]').val(slideJSON[key]);
                  }
                  if(layoutid === server_link){
                    console.log("slideJSON[key] - ",slideJSON[key]);
                    //officeapps
                    //$('#iframe_id').contents().find('#iframe_data').html('<iframe src="https://view.officeapps.live.com/op/embed.aspx?src='+slideJSON[key]+'" frameborder="no" style="width:100%;height:97vh"></iframe>');

                    //googledrive services
                    $('#iframe_id').contents().find('iframe').attr('src', slideJSON[key]);
                    $('#iframe_id').contents().find('input[name="'+key+'"]').val(slideJSON[key]);
                  }
                  $('#iframe_id').contents().find('input[name="'+key+'"]').val(slideJSON[key]);
                }
              }
            }
          } else {
            if(res.slideJSON != '' || res.slideJSON != null || res.slideJSON != 'undefined'){
              var slideJSON1 = $.parseJSON(res.slideJSON);
              for (var key in slideJSON1) {
                if (slideJSON1.hasOwnProperty(key)) {
                  //console.log("key---",key);

                  if(key === 'audio') {
                    $("#iframe_id").contents().find("form").append('<div id="playerContainer" class="position-absolute" style="top: 0rem; right: 1rem"><input type="hidden" name="audio" value="'+slideJSON1[key]+'" /><audio controls style="position: absolute;z-index: 2;opacity: 0.01;"><source src="'+slideJSON1[key]+'" type="audio/mpeg"></audio><img src="../../../images/play-button.svg" style="width: 50px;"></div>');
                  }
                }
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

          //Change iframe url
          $("#iframe_id").contents().find("span").click(function() {
            console.log("iframe");
            $("#iframe_id").contents().find("iframe").removeClass("replace_img").addClass("replace_img");
            $("#iframe_id").contents().find('.image').removeClass('replace_img');
            $(this).closest('div').find('.image').addClass('replace_img');
            
            var classid = $(".pagebody_class").val();
            var topicid = $(".pagebody_topic_id").val();
            getMsUploadModal(classid, topicid, "");
          });
        }, 1000);
      },
      beforeSend: function(){
        $("body").mLoading('show');
      },
      complete: function(){
        setTimeout(function () {
          $("body").mLoading('hide');
        }, 1500);
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
    console.log(slidepath);
    $('#clicked_slidepath').text(slidepath);
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

  //upload PPT/WORD/PDF
  function getMsUploadModal(classid, topicid, layoutid){
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
          //officeapps
          $("#iframe_id").contents().find(".replace_img").attr('src', 'https://view.officeapps.live.com/op/embed.aspx?src='+imgpath);
          
          //googledrive services
          //$("#iframe_id").contents().find(".replace_img").attr('src', 'https://docs.google.com/gview?url='+imgpath+'&embedded=true');

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

  //upload(Add/Replace) audio
  $('#audio_upload').on('submit', function(event){
    event.preventDefault();
    var classid = $('#class_id').val();
    var topicid = $('#topic_id').val();
    var resourceId = $("#addChangeAudio").attr("data-resourceId");
    console.log("resourceId---", resourceId);
    if (resourceId === undefined || resourceId === null) {
     resourceId = "";
    }
    $.ajax({
      url:'apis/uploadAudio.php?class_id='+classid+'&topics_id='+topicid+'&resourceId='+resourceId,
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      async:true,
      success:function(data)
      {
        var json = $.parseJSON(data);
        //console.log(json);
        if(json.status) {
          document.getElementById("audio_upload").reset(); 
          $("#audioModal").modal("hide");

          $("#addChangeAudio").attr("data-resourceId",json.resId);

          $("#iframe_id").contents().find("#playerContainer").remove();

          $("#iframe_id").contents().find("form").append('<div id="playerContainer" class="position-absolute" style="top: 0rem; right: 1rem"><input type="hidden" name="audio" value="'+json.audioSrc+'" /><audio controls style="position: absolute;z-index: 2;opacity: 0.01;"><source src="'+json.audioSrc+'" type="audio/mpeg"></audio><img src="../../../images/play-button.svg" style="width: 50px;"></div>');

          setTimeout(function () {
            alert(json.message);
          }, 500)
        }
      }
    });
  });

  //Remove Audio File
  $("#removeAudio").click(function(){
    var remove = $("#iframe_id").contents().find("#playerContainer").remove();
    setTimeout(function () {
      if(remove.length > 0) {
        var classid = $('#class_id').val();
        var topicid = $('#topic_id').val();
        var resourceId = $("#addChangeAudio").attr("data-resourceId");
        if (resourceId === undefined || resourceId === null) {
         resourceId = "";
        }
        $.ajax({
          url:'apis/removeAudio.php?class_id='+classid+'&topics_id='+topicid+'&resourceId='+resourceId,
          method:'POST',
          contentType:false,
          processData:false,
          async:true,
          success:function(data)
          {
            var json = $.parseJSON(data);
            $("#addChangeAudio").attr("data-resourceId",json.resId);
            alert(json.message);
          }
        });
      } else {
        alert("No audio files availlable in the slide for remove");
      }
    }, 500);
  });


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
    var status = $("#topicStatus").val();
    var external_files = "";
    var task_assi_id = $(".task_assign_id").val();
    var gd_user_id = $("#gd_users").val();
    $.ajax({
      url:"../cw/taskReplyProcessAdd.php",
      method:'POST',
      async:true,
      data:"cw_remarks="+cw_remarks+"&status="+status+"&external_files="+external_files+"&task_assi_id="+task_assi_id+"&gd_users="+gd_user_id+"&action_type=topic_level",
      success:function(data1)
      {
        $("#modaldemo3").modal("hide");
        $("#modalsuccess").modal("show");
        window.setTimeout(function () {
          location.href = "../../taskListOTR.php";
        }, 2000);
      },
      beforeSend: function(){
        $("body").mLoading('show');
      },
      complete: function(){
        $("body").mLoading('hide');
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
    //opening Review & Publish Model only on if no slides are empty.
    if(parseInt($(this).val()) === 13 || parseInt($(this).val()) === 23 ) {
      var class_id = $("#reviewPublishClassId").val();
      var topic_id = $("#reviewPublishTopicId").val();
      var task_assi_id = $("#reviewPublishTaskAssiId").val();
      $.ajax({
        url:"apis/checkEmptySlides.php",
        method:'POST',
        async:true,
        data:"class="+class_id+"&topic_id="+topic_id+"&task_assi_id="+task_assi_id+"&type=checmptySlide",
        success:function(data)
        {
          var json = $.parseJSON(data);
          if(json.status){
            $("#status_cw option").prop("selected", false);
            $('#add_topic_level_modal_review').modal('hide');
            setTimeout(function () {
              alert(json.message+' slide - '+json.slides.join(' , '));
            }, 1000)
          }
        },
        beforeSend: function(){
          $("body").mLoading('show');
        },
        complete: function(){
          $("body").mLoading('hide');
        }
      });
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
          setTimeout(function(){window.top.location="../../taskListProductionReady.php"} , 2000);
        } else {
          console.log("else");
          $("#modaldemo3").modal("hide");
          //$("#success_msg").append(json.message)
          $("#modalsuccess").modal('show');
        }
      },
      beforeSend: function(){
        $("body").mLoading('show');
      },
      complete: function(){
        $("body").mLoading('hide');
      }
    });
  });

  //delete slide
  $(document).on('click','.delete_slide',function(){
    var slide_id = $(this).data("slide_id");
    $("#for_delete_slide_id").val(slide_id); 
    $("#delete_slide_modal_title").text($(this).data("slide_title"));
    console.log(slide_id);
    if(slide_id > 0){
      $("#delete_slide_modal").modal("show");
    }
  });
  $("#delete_slide_yes").click(function(){
    var class_id = $("#class_id").val();
    var topic_id = $("#topic_id").val();
    var slide_id = $("#for_delete_slide_id").val();
    $.ajax({
      url:"apis/deleteSlides.php",
      method:'POST',
      async:true,
      data:"class="+class_id+"&topic_id="+topic_id+"&slide_id="+slide_id+"&type=deletSlide",
      success:function(data)
      {
        var json = $.parseJSON(data);
        if(json.status){
          $("#for_delete_slide_id").val("");
          $("#delete_slide_modal").modal("hide");
          setTimeout(function() {
            $("#boxTitle").html(" - Add Slides");
            $(".br-sideleft").html(json.slides);
            window.top.$('#iframe_id').attr('src', '');
          }, 1000);
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

    //delete slide
  $(document).on('click','.move_slide',function(){
    var slide_id = $(this).data("slide_id");
    var class_id = $("#class_id").val();
    var topic_id = $("#topic_id").val();
    $("#for_move_slide_id").val(slide_id); 
    $("#move_slide_modal_title").text($(this).data("slide_title"));
      if(slide_id > 0){
        $.ajax({
        url:"apis/moveAPIs.php",
        method:'POST',
        async:true,
        data:"class="+class_id+"&topic_id="+topic_id+"&slide_id="+slide_id+"&type=getMoveSlideRef",
        success:function(data)
        {
          $("#move_to_slide_ref").html(data);
        },
        beforeSend: function(){
          $(".mLoading").addClass("active");
        },
        complete: function(){
          $(".mLoading").removeClass("active");
        }
      });
      $("#move_slide_modal").modal("show");
    }
  });

  $(document).on('click','#move_slide_yes',function(){
    var for_move_slide_id = $("#for_move_slide_id").val();
    var dest_ref = $("#move_to_slide_ref").val();
    var class_id = $("#class_id").val();
    var topic_id = $("#topic_id").val();
    if(for_move_slide_id > 0){
      $.ajax({
        url:"apis/moveAPIs.php",
        method:'POST',
        async:true,
        data:"class="+class_id+"&topic_id="+topic_id+"&for_move_slide_id="+for_move_slide_id+"&dest_ref="+dest_ref+"&type=MoveSlide",
        success:function(data)
        {
          $("#move_confirm_msg").html("Slide moved Successfully");
          setTimeout(function() {
            $("#move_slide_modal").modal("hide");
            location.reload();
          }, 2000);
        },
        beforeSend: function(){
          $(".mLoading").addClass("active");
        },
        complete: function(){
          $(".mLoading").removeClass("active");
        }
      });
    }
  });
});