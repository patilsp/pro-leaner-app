$(document).ready(function() {
  var moveactiveparentsub = "";
  var moveactivel2sub = "";
  var moveactivel3sub = "";

  // get CW Users
  $.ajax({
    type: "POST",
    url: "apis/getUsers.php",
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

  $( "#accordionClass" ).sortable();
  $(".sublevel1").sortable();
  $(".sub_child_subject_ul").sortable();
  $( "#accordionClass" ).disableSelection();

  $('#new_task_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"apis/cpAssignTask.php",
      method:'POST',
      data:new FormData(document.new_task_form),
      contentType:false,
      processData:false,
      success:function(data)
      {
        document.getElementById("new_task_form").reset();
        $('#assignModal').modal('hide');
        var json = $.parseJSON(data);
        if(json.status){
          assigned = true;
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
  $(document).on('click', '.assignbutton', function() {
    var data = $(this).attr("data-id");
    var classSubId = data.split('-');
    $('#classId').val(classSubId[0]);
    $('#subId').val(classSubId[1]);
  });
  //clone functionality
  $(document).on('click', '.add', function() {
      console.log($(this).data("id"));
      $('.classlist').select2("destroy");
      //if($(this).closest('.qust').find('.form-control').val() != ""){
          var clone_data = $(this).closest('.qust').find('.cmt').first().clone(true);
          clone_data.find("input").val("");
          //clone_data.find("select").val("");
          $(this).parent().find('.wrapper').append(clone_data).fadeIn(600);
          //Paste this code after your codes.
          $('.classlist').select2({ //apply select2 to my element
          placeholder: "Search your Class",
          closeOnSelect: false
      });
          
      /*} else{
          alert("should not be empty");
      }*/
  });

  $(document).on('click', '.remove', function() {
      $(this).closest('.cmt').fadeOut(600, function() {
          $(this).remove();
      });
  });

  //clone 2nd level subject
  $(document).on('click', '.level2_add', function() {
      // console.log($(this).data("id"));
      var clone_data = $(this).closest('.add_child_subject_form').find('.level2_field').first().clone(true);
      clone_data.find("input").val("");
      //clone_data.find("select").val("");
      $(this).closest('.level2_field').first().append(clone_data).fadeIn(600);
  });

  $(document).on('click', '.level2_remove', function() {
      $(this).closest('.level2_field').fadeOut(600, function() {
          $(this).remove();
      });
  });

  //clone 3rd level subject
  $(document).on('click', '.sublevel_add', function() {
      console.log($(this).data("id"));
      var clone_data = $(this).closest('.add_sub_child_subject_form').find('.sublevel_field').first().clone(true);
      clone_data.find("input").val("");
      //clone_data.find("select").val("");
      $(this).parent().find('.sublevel_wrap').append(clone_data).fadeIn(600);
  });

  $(document).on('click', '.sublevel_remove', function() {
      $(this).closest('.sublevel_field').fadeOut(600, function() {
          $(this).remove();
      });
  });

  /** start more options tooltip logic **/
var hasToolTip = $(".tooltip_options");

hasToolTip.on("click", function(e) {
  e.preventDefault();
  $(this).tooltip('toggle');
}).tooltip({
  animation: true,
  trigger: "manual",
});

$('body').on('click', function(e) {
  var $parent = $(e.target).closest('.tooltip_options');
  if ($parent.length) {
   hasToolTip.not($parent).tooltip('option', 'hide');
  }
  else{
    hasToolTip.tooltip('option', 'hide');
  }
  
  if (moveactiveparentsub != ""){
    $("#" + moveactiveparentsub).removeClass("enablemovesubject");
    $(".accordionClass").sortable("disable");
  }
  if (moveactivel2sub != ""){
    $("#" + moveactivel2sub).removeClass("enablemovel2subject");
    $(".sublevel1").sortable("disable");
  }
  if (moveactivel3sub != ""){
    $("#" + moveactivel3sub).removeClass("enablemovel3subject");
    $(".sub_child_subject_ul").sortable("disable");
  }
  });


  //child_subject script
  var hasToolTip1 = $(".tooltip_optionschildsubject");

  // $(".tooltip_optionschildsubject").mouseover(function(){
  //   hasToolTip1.tooltip('hide');
  // });
  

hasToolTip1.on("click", function(e) {
  e.preventDefault();
  $(this).tooltip('toggle');
}).tooltip({
  animation: true,
  trigger: "manual",
});

$('body').on('click', function(e) {
  var $parent = $(e.target).closest('.tooltip_optionschildsubject');
  if ($parent.length) {
   hasToolTip1.not($parent).tooltip('hide');
  }
  else{
    hasToolTip1.tooltip('hide');
  }
});
/** end more options tooltip logic **/

//function for show add popup for add sub child subject
$(document).on('click', ".sub_child_subject_modal_option", function () {
  $("#sub_child_subject_modal").modal("show");
});

$(document).on('click', ".editDetails", function () {
  $("#parent_subject_edit_modal").modal("show");
  //Get the Details and put in the form
  var sub_id = $(this).attr("id").replace("ed@", "");
  $.ajax({
        url:"apis/subject_ajaxcalls.php",
        method:'POST',
        data: "sub_id=" + sub_id +"&type=getSubjectDetails",
        success:function(data)
        {
            var json = $.parseJSON(data);
            if(json.status) {
              $("#par_sub_edit_category").val(json.Result.category_id);
              if(json.Result.classes != null)
                var classes = json.Result.classes.split(",");
              else
                var classes = [];
              $("#par_sub_edit_classes").val(classes).trigger('change');
              $("#subject_id").val(sub_id);
            } else {
                $("#sb_heading").html("Notice!");
                var x = document.getElementById("snackbar");
            x.className = "show";
            $("#sb_body").html(json.message);
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
            }
        }
      });
});

/*$('.select2').select2({
  closeOnSelect: false
});*/


$('.classlist').select2({ //apply select2 to my element
    placeholder: "Search your Class",
    closeOnSelect: false
});

$('.classlist').change(function() {
  var arr = $(this).val();
  var string = arr.join(",");
  $(this).closest('.subjectRow').find('.classstring').val(string);
})


$(document).on('submit', '#add_parent_subject_form', function(event){
      event.preventDefault();
      $.ajax({
        url:"apis/subject_ajaxcalls.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
            var json = $.parseJSON(data);
            if(json.status) {
                $("#autoid").val("0");
                $("#sb_heading").html("Successfully Created!");
                $("#parent_subject_modal").modal("hide");
                location.reload();
            } else {
                $("#sb_heading").html("Notice!");
                var x = document.getElementById("snackbar");
            x.className = "show";
            $("#sb_body").html(json.message);
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
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


  $(document).on('submit', '#add_child_subject_form', function(event){
      event.preventDefault();
      $.ajax({
        url:"apis/subject_ajaxcalls.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
            var json = $.parseJSON(data);
            if(json.status) {
                $("#autoid").val("0");
                $("#sb_heading").html("Successfully Created!");
                $("#parent_subject_modal").modal("hide");
                location.reload();
            } else {
                $("#sb_heading").html("Notice!");
                var x = document.getElementById("snackbar");
            x.className = "show";
            $("#sb_body").html(json.message);
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
            }
        }
    });
  });

$(document).on('click', '.addSubSubject1', function(e)
{
  var sub_name = $(this).closest('.card-header').find('.ip_classes').val();
  var sub_id = $(this).closest('.card-header').find('.ip_classes').attr('id').replace("subject", "");
      
  $("#parent_subject_name").html(sub_name);
  $("#child_subject_parent_id").val(sub_id);
  });

  //Rename Subject L1
  $(document).on("click", ".renameSubjectL1", function() {
      var id = $(this).attr("id");
      var temp = id.split("@");
      var catid = temp[1];
      $("#subject"+catid).removeClass("ip_classes");
      $("#subject"+catid).focus();
  });

  $(document).on("focusout", ".inputClass", function() {
      var subjectname = $(this).val();
      var sub_id = $(this).attr('id').replace("subject", "");
      $.ajax({
        url:"apis/subject_ajaxcalls.php",
        method:'POST',
        data: "subjectname="+subjectname + "&sub_id=" + sub_id +"&type=renameSubject",
        success:function(data)
        {
            var json = $.parseJSON(data);
            $("#sb_body").html(json.message);
            if(json.status) {
              $("#sb_heading").html("Successfully Created!");
              $("#subject"+sub_id).addClass("ip_classes");
            } else {
              $("#sb_heading").html("Notice!");
              $("#subject"+sub_id).val(json.oldSubjectName);
            }
            if(json.oldSubjectName != subjectname) {
              var x = document.getElementById("snackbar");
              x.className = "show";
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
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

  //Delete Subject L1
  $(document).on("click", ".deleteSubjectL1", function() {
      var id = $(this).attr("id").replace("deleteSubject", "");
      $(".action_name").text($(this).attr("aria-deletename"));
      $('#class_delete_modal').modal({ backdrop: 'static', keyboard: false })
      .one('click', '#delete_class_yes', function (e) {
        $.ajax({
              url:"apis/subject_ajaxcalls.php",
              method:'POST',
              data: "id="+id+"&type=deleteSubject",
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  $("#sb_body").html(json.message);
                  if(json.status) {
                    $('#class_delete_modal').modal('hide');
                    $("#card"+id).fadeOut(600, function() {
                        $(this).remove();
                    });
                    $("#sb_heading").html("Successfully Deleted!");
                  }
                  else if(! json.status) 
                  {
                    $("#delete_class_yes").show();
                    $("#sb_heading").html("Notice!");
                  }
                  var x = document.getElementById("snackbar");
                  x.className = "show";
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
                  
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

  //Move Subject
  $(".accordionClass").sortable("disable");
  $(document).on("click", ".move_subjectL1_option", function () {
    //console.log("cameeeeee ---", $(this).attr("aria-classcardid"));
    var id = $(this).attr("aria-subjectcardid");
    // alert(id);
    moveactiveparentsub = id;
    $(".accordionClass").sortable("enable");
    $("#"+id).addClass("enablemovesubject");
  });

  var dragging_class = false;
    $( "#accordionClass" ).sortable({
      connectWith: ".accordionClass",
      start: function( event, ui ) {
        dragging_class = true;
        ui.item.startPos = ui.item.index();
      },
      stop: function(event, ui) {
        var start_pos = ui.item.startPos;
        var new_pos = ui.item.index();

        console.log("moveactiveparentsub ---", moveactiveparentsub);
        $("#"+moveactiveparentsub).removeClass("enablemovesubject");
        if(start_pos !== new_pos) {
          $('.accordionClass').each(function() {
              result = "";
              $(this).find(".classAccordon").each(function(){
                  result += $(this).attr('id') + ",";
              });
              console.log(result);
              // $("#user_ans").val(result);
              $.ajax({
                url:"apis/subject_ajaxcalls.php",
                method:'POST',
                data: "sequence="+ result +"&type=reOrderSubjectL1&reload=true",
                success:function(data)
                {
                    var json = $.parseJSON(data);
                    $("#sb_body").html(json.message);
                    if(json.status) {
                      location.reload();
                    } else {
                      $("#sb_heading").html("Notice!");
                      var x = document.getElementById("snackbar");
                      x.className = "show";
                      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
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
        }
        $(".accordionClass").sortable("disable");
      }
    });
    $(".accordionClass").click(function(mouseEvent){
        if (!dragging_class) {
            console.log($(this).attr("id"));
        } else {
            dragging_class = false;
        }
    });

  //Update Subject Details of Level 1
  $(document).on('submit', '#update_parent_subject_form', function(event){
      event.preventDefault();
      $.ajax({
        url:"apis/subject_ajaxcalls.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
            var json = $.parseJSON(data);
            if(json.status) {
                $("#sb_heading").html("Successfully Updated!");
                $("#parent_subject_edit_modal").modal("hide");
                location.reload();
            } else {
                $("#sb_heading").html("Notice!");
            }
            var x = document.getElementById("snackbar");
          x.className = "show";
          $("#sb_body").html(json.message);
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
        }
    });
  }); 
  
      
  // Adding sub level 3 values
  $(document).on('click', '.addsublevel', function(e)
  {
      var subchild_id = $(this).attr('id').replace("subjectdrop", "");
      var type = $(this).attr("data-id");
      var subchild_name = subchild_id.split("-");
      var titlename = subchild_name[1];
      //console.log(subchild_id);
      $("#sub_child_subject_name").html(titlename);
      $("#sub_child_subject_parent_id").val(subchild_id);
      $("#sub_child_subject_type").val(type);
      
  });

  $(document).on('submit', '#add_sub_child_subject_form', function(event){
      event.preventDefault();
      //console.log(new FormData(this));
      $.ajax({
      url:"apis/subject_ajaxcalls.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {
        var json = $.parseJSON(data);
        if(json.status) {
            $("#autoid").val("0");
            $("#sb_heading").html("Successfully Created!");
            $("#parent_subject_modal").modal("hide");
            location.reload();
        } else {
            $("#sb_heading").html("Notice!");
            var x = document.getElementById("snackbar");
            x.className = "show";
            $("#sb_body").html(json.message);
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
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

  // END of adding sub child


  //rename sub level 1 process
  $(document).on("click", ".renameSub1", function() {
      //console.log(1);
      var id = $(this).attr("id");
      var temp = id.split("@");
      var catid = temp[1];
      $("#subjectdrop"+catid).removeClass("ip_classes");
      $("#subjectdrop"+catid).focus();
  });

  $(document).on("focusout", ".subjectL2", function() {
      var childname = $(this).val();
      var sub_id = $(this).attr('id').replace("subjectdrop", "");
      $.ajax({
      url:"apis/subject_ajaxcalls.php",
      method:'POST',
      data: "subjectname="+childname + "&sub_id=" + sub_id +"&type=renameSubject",
      success:function(data)
      {
          var json = $.parseJSON(data);
          $("#sb_body").html(json.message);
          if(json.status) {
              $("#sb_heading").html("Successfully Created!");
              $("#subject"+sub_id).addClass("ip_classes");
          } else {
              $("#sb_heading").html("Notice!");
              $("#subjectdrop"+sub_id).val(json.oldSubjectName);
          }
          if(json.oldSubjectName != childname) {
              var x = document.getElementById("snackbar");
              x.className = "show";
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
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
  // rename sub level 1 end

  // Rename sub level 2 
  $(document).on("click", ".renameSub2", function() {
      //console.log(1);
      var id = $(this).attr("id");
      var temp = id.split("@");
      var catid = temp[1];
      $("#sub_lvl"+catid).removeClass("ip_classes");
      $("#sub_lvl"+catid).focus();
  });

  $(document).on("focusout", ".subjectL3", function() {
      var subchildname = $(this).val();
      var sub_id = $(this).attr('id').replace("sub_lvl", "");
      //console.log(subchildname);
      //console.log(sub_id);
      $.ajax({
      url:"apis/subject_ajaxcalls.php",
      method:'POST',
      data: "subjectname="+subchildname + "&sub_id=" + sub_id +"&type=renameSubject",
      success:function(data)
      {
          var json = $.parseJSON(data);
          $("#sb_body").html(json.message);
          if(json.status) {
              $("#sb_heading").html("Successfully Created!");
              $("#subject"+sub_id).addClass("ip_classes");
          } else {
              $("#sb_heading").html("Notice!");
          }
          if(json.oldSubjectName != subchildname) {
              var x = document.getElementById("snackbar");
              x.className = "show";
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
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
  // End for renaming sub lvl 2

  // Delete sub lvl 1
  $(document).on("click", ".deletechild", function() {
      var id = $(this).attr("id").replace("deleteChild", "");
      $(".action_name").text($(this).attr("aria-deletename"));
      $('#class_delete_modal').modal({ backdrop: 'static', keyboard: false })
      .one('click', '#delete_class_yes', function (e) {
          //console.log(id);
          
      $.ajax({
              url:"apis/subject_ajaxcalls.php",
              method:'POST',
              data: "id="+id+"&type=deleteSubject",
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  $("#sb_body").html(json.message);
                  if(json.status) {
                      $('#class_delete_modal').modal('hide');
                      $("#cardsub"+id).fadeOut(600, function() {
                          $(this).remove();
                      });
                      $("#sb_heading").html("Successfully Deleted!");
                  }
                  else if(! json.status) 
                  {
                  $("#delete_class_yes").show();
                  $('#class_delete_modal').modal('hide');
                  $("#sb_heading").html("Notice!");
                  }
                  var x = document.getElementById("snackbar");
                  x.className = "show";
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
                  
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
  // end of delete sub lvl 2

  //Delete of sub lvl 3
  $(document).on("click", ".deleteSubChild", function() {
      var id = $(this).attr("id").replace("deleteSubChild", "");
      $(".action_name").text($(this).attr("aria-deletename"));
      $('#class_delete_modal').modal({ backdrop: 'static', keyboard: false })
      .one('click', '#delete_class_yes', function (e) {
          //console.log(id);
          $.ajax({
              url:"apis/subject_ajaxcalls.php",
              method:'POST',
              data: "id="+id+"&type=deleteSubject",
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  console.log(json, id);
                  $("#sb_body").html(json.message);
                  if(json.status) {
                      $('#class_delete_modal').modal('hide');
                      $("#cardsub"+id).fadeOut(600, function() {
                          $(this).remove();
                      });
                      $("#sb_heading").html("Successfully Deleted!");
                  }
                  else if(! json.status) 
                  {
                  $("#delete_class_yes").show();
                  $("#sb_heading").html("Notice!");
                  }
                  var x = document.getElementById("snackbar");
                  x.className = "show";
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
                  
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

  // End of sub lvl 3 delete

  // Move sub lvl 2
  //Move Subject
  $(".sublevel1").sortable("disable");
  $(document).on("click", ".move_subjectL2_option", function () {
    // console.log("cameeeeee ---", $(this).attr("aria-subjectl2id"));
    var id = $(this).attr("aria-subjectl2id");
    // console.log("ID is ", id);
    moveactivel2sub = id;
    $(".sublevel1").sortable("enable");
    $("#" + id).addClass("enablemovel2subject");
  });


  var dragging_class = false;
    $( ".sublevel1" ).sortable({
      connectWith: ".sublevel1",
      start: function( event, ui ) {
        dragging_class = true;
        ui.item.startPos = ui.item.index();
      },
      stop: function(event, ui) {
        var start_pos = ui.item.startPos;
        var new_pos = ui.item.index();

        // console.log("moveactivel2sub ---", moveactivel2sub);
        $("#" + moveactivel2sub).removeClass("enablemovel2subject");
        if(start_pos !== new_pos) {
          $(this).closest('.sublevel1').each(function() {
              result = "";
              var str = "";
              $(this).find(".child_subject_li").each(function(){
                  str = $(this).attr('id');
                  result += str.replace("cardsub","") + ",";
              });
              // console.log(result);
              // $("#user_ans").val(result);
              if(result != ""){
                $.ajax({
                  url:"apis/subject_ajaxcalls.php",
                  method:'POST',
                  data: "sequence="+ result +"&type=reOrderSubjectL1",
                  success:function(data)
                  {
                      var json = $.parseJSON(data);
                      $("#sb_body").html(json.message);
                      if(json.status) {
                        $("#sb_heading").html("Successfully Created!");
                      } else {
                        $("#sb_heading").html("Notice!");
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
        }
        $(".sublevel1").sortable("disable");
      }
    });
    $(".sublevel1").click(function(mouseEvent){
        if (!dragging_class) {
            console.log($(this).attr("id"));
        } else {
            dragging_class = false;
        }
    });

    // End of move sublevel 1


  // Move for sublevel 2

  $(".sub_child_subject_ul").sortable("disable");
  $(document).on("click", ".move_subjectL3_option", function () {
      console.log("lvl3---", $(this).attr("aria-subjectl3id"));
      var id = $(this).attr("aria-subjectl3id");
      var pid = $(this).attr("aria-parentsubid");
      // console.log(pid);
      // console.log("ID is ", id);
      moveactivel3sub = id;
      // console.log($(this).closest('ul').parent().html());
      $("#sub_child_subject_ul"+pid).sortable("enable");
      $("#" + id).addClass("enablemovel3subject");
  });

  var dragging_class = false;
    $( ".sub_child_subject_ul" ).sortable({
      connectWith: ".sub_child_subject_ul",
      start: function( event, ui ) {
        dragging_class = true;
        ui.item.startPos = ui.item.index();
      },
      stop: function(event, ui) {
        var start_pos = ui.item.startPos;
        var new_pos = ui.item.index();

        // console.log("moveactivel3sub ---", moveactivel3sub);
        $("#" + moveactivel3sub).removeClass("enablemovel3subject");
        if(start_pos !== new_pos) {
          var str = "";
          $(this).closest('.sub_child_subject_ul').each(function() {
              result = "";
              $(this).find(".sub-child").each(function(){
                  str = $(this).attr('id');
                  result += str.replace("cardsub","") + ",";
              });

              console.log(result);
              // $("#user_ans").val(result);
              if(result != ""){
                $.ajax({
                  url:"apis/subject_ajaxcalls.php",
                  method:'POST',
                  data: "sequence="+ result +"&type=reOrderSubjectL1",
                  success:function(data)
                  {
                      var json = $.parseJSON(data);
                      $("#sb_body").html(json.message);
                      if(json.status) {
                        $("#sb_heading").html("Successfully Created!");
                      } else {
                        $("#sb_heading").html("Notice!");
                      }
                      var x = document.getElementById("snackbar");
                      x.className = "show";
                      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
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
        }
        $(".sub_child_subject_ul").sortable("disable");
      }
    });
    $(".sub_child_subject_ul").click(function(mouseEvent){
        if (!dragging_class) {
            console.log($(this).attr("id"));
        } else {
            dragging_class = false;
        }
    });
    


});

