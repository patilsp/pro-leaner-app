function createNewEditor(targetElement) {
  var editorDiv = document.createElement("div");
  $(editorDiv).addClass("col-6 mb-5 position-relative editor");
  var textArea = document.createElement("textarea");
  var deleteBtn = document.createElement("span");

  $(textArea)
    .addClass("ckeditorTxt")
    .appendTo(editorDiv);
  //$(textArea).attr('name','editor1[]');

  $(editorDiv).appendTo(targetElement);

  var newEditor = CKEDITOR.replace(textArea, {
    extraPlugins: 'ckeditor_wiris,html5video,html5audio',
    allowedContent: true,
    filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
    filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
    height: ['100px']
  });
  $(textArea).attr("id", newEditor.name);

  var ipType = 0;
  if ($("#TypeofQuestion :selected").val() == 1 || $("#TypeofQuestion :selected").val() == 2) {
    ipType = 1;
  }
  if (ipType) {
    $(deleteBtn)
      .html('<div class="page-breadcrumb d-sm-flex align-items-center shadow-lg p-2"><div class="form-floating"><select class="form-select" name="optionStatus[]" id="floatingSelect" aria-label="Floating label select example"><option value="0" selected>Wrong</option><option value="1">Right</option></select><label for="floatingSelect">Option</label></div><div class="ms-auto"><button type="button" class="btn btn-danger delete-editor"><i class="fa fa-trash m-0"></i></button></div></div>')
      .prependTo(editorDiv);
  }


}

function deleteEditor() {
  $(".editor").each(function(_, editor) {
    var deleteEditor = $(editor).find(".delete-editor");
    var editorName = $(editor)
      .find("textarea")
      .attr("id");
    console.log('editorName1---', editorName);
    console.log('eacheditor1----', editor);
    $(deleteEditor).on("click", function() {
      console.log(editorName, '-----', CKEDITOR.instances);
      if (CKEDITOR.instances.hasOwnProperty(editorName)) {
        CKEDITOR.instances[editorName].destroy();
        console.log(editor);
        $(editor).remove();
      }
    });
  });
}

$(document).ready(function() {
  $(document).on('change', '.classSelect', function() {
    var classId = $(this).val();
    if(classId != ""){
      $.ajax({
        type: "POST",
        url: "apis/getSubjects.php",
        data: 'classId='+classId,
        statusCode: {
          302: function(responseObject, textStatus, jqXHR) {
            $('#sessionExp').modal('show');
            let myurl = location.origin;
            $(document).on('click', '.closeSessPopup', function () {
              window.location.href=myurl+"/assessment/index.php";
            });
          }           
        },
        success: function(data){
          var data = $.parseJSON(data);
          console.log(data);
          var options = '<option value="">-Select Subject-</option>';
          if(data != null) {
            for (var i = 0; i < data.length; i++) {
              {
                options += '<option value="' + data[i].subId + '">' + data[i].name + '</option>';
              }
            }
          } else {
            options += '<option value="" disabled>No Subject Availlable</option>';
          }
          $("#subject").html(options);
        }
      });
    } else {
      var options = '<option value="">-Select Subject-</option>';
      $("#subject").html(options);
    }
  })
  $(document).on('change', '#subject', function() {
        var id = $(this).val();
        $.ajax({
            url:"apis/questions_apis.php",
            method:'POST',
            data: "subject_id="+ id +"&type=getCourses",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
                    $("#course").html(json.Result);
                    $("#course").trigger("change");
                    $("#subtopic").empty();
                    $("#subtopic").html('<option value="">-Select Sub Topic-</option>');
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
  $(document).on('change', '#course', function() {
        var id = $(this).val();
        $.ajax({
            url:"apis/questions_apis.php",
            method:'POST',
            data: "courseid="+ id +"&type=getTopics",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
                    $("#topic").html(json.Result);
                    $("#subtopic").empty();
                    $("#subtopic").html('<option value="">-Select Sub Topic-</option>');
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
  $(document).on('change', '#topic', function() {
        var id = $(this).val();
        $.ajax({
            url:"apis/questions_apis.php",
            method:'POST',
            data: "topicid="+ id +"&type=getSubTopics",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
                    $("#subtopic").html(json.Result);
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
  $(".ckeditorQustBlk").each(function(_, ckeditorqust) {
    CKEDITOR.replace(ckeditorqust, {
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
    });
  });

  $(".ckeditorTxt").each(function(_, ckeditor) {
    CKEDITOR.replace(ckeditor, {
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px']
    });
  });

  $(".add-para").each(function(_, addParaBtn) {
    var addTo = $(addParaBtn).data("add-to");
    $(addParaBtn).on("click", function() {
      createNewEditor(addTo);
      deleteEditor();
    });
  });

  var choosedQustType = '';
  $('#TypeofQuestion').on('change', function() {
    // $('#tags').tagsinput('removeAll');

    for(name in CKEDITOR.instances)
    {
      //CKEDITOR.instances[name].destroy(true);
      CKEDITOR.instances[name].setData('');
      if (CKEDITOR.instances[name].name !== 'qustIp' && CKEDITOR.instances[name].name !== 'editor1') {
        if ($(this).val() == 1 || $(this).val() == 2) {
          if (CKEDITOR.instances[name].name !== 'editor1') {
            CKEDITOR.instances[name].destroy();
            $('#'+name).parent().closest('.editor').remove();
          }
        }
      }
    }
    
    choosedQustType = $(this).val();

    if ($(this).val() == 1 || $(this).val() == 2) {
      $('#shortAnsTable').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-block').addClass('d-none');
      $('#fillInTheBlank').removeClass('d-block').addClass('d-none');
      $('#nestedSAMCQ').removeClass('d-block').addClass('d-none');
      $('#mcq').removeClass('d-none');
    } else if ($(this).val() == 4) {
      $('#mcq').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-block').addClass('d-none');
      $('#fillInTheBlank').removeClass('d-block').addClass('d-none');
      $('#nestedSAMCQ').removeClass('d-block').addClass('d-none');
      $('#shortAnsTable').removeClass('d-none');
    } else if ($(this).val() == 5) {
      $('#mcq').removeClass('d-block').addClass('d-none');
      $('#shortAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-block').addClass('d-none');
      $('#fillInTheBlank').removeClass('d-block').addClass('d-none');
      $('#nestedSAMCQ').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-none');
    }
     else if ($(this).val() == 3) {
      $('#mcq').removeClass('d-block').addClass('d-none');
      $('#shortAnsTable').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-block').addClass('d-none');
      $('#fillInTheBlank').removeClass('d-block').addClass('d-none');
      $('#nestedSAMCQ').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-none');
    } else if ($(this).val() == 6) {
      $('#mcq').removeClass('d-block').addClass('d-none');
      $('#shortAnsTable').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-block').addClass('d-none');
      $('#nestedSAMCQ').removeClass('d-block').addClass('d-none');
      $('#fillInTheBlank').removeClass('d-none');
    } else if ($(this).val() == 7) {
      $('#mcq').removeClass('d-block').addClass('d-none');
      $('#shortAnsTable').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-block').addClass('d-none');
      $('#fillInTheBlank').removeClass('d-block').addClass('d-none');
      $('#nestedSAMCQ').removeClass('d-none');
    }
  });

  //Descp type question
  var editorQustName = 0;
  var editorAnsName = 0;
  $('.shortAnsTable').click(function(){
    $('#descTbType').append('<div class="card-header"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Question</div><div class="ms-auto"> <button type="button" data-editorInstance="'+editorQustName+'" class="btn btn-danger delete-editor float-end"><i class="fa fa-trash m-0"></i></button> </div></div></div><textarea name="editorTbQust['+editorQustName+']" class="editor1" id="editorTbQust'+editorQustName+'" rows="10" cols="80"></textarea><textarea class="editor1" name="editorAns['+editorAnsName+']" id="editorAns'+editorAnsName+'" rows="10" cols="80"></textarea>');
    //var ckEditorName = "editor"+editorName;

    CKEDITOR.replace( 'editorTbQust'+editorQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px'],
    });

    CKEDITOR.replace( 'editorAns'+editorAnsName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px']
    });
    
    editorQustName += 1;
    editorAnsName += 1;

    $('.delete-editor').unbind().on("click", function() {
      var qustInstanceName = 'editorTbQust'+$(this).attr('data-editorInstance');
      var ansInstanceName = 'editorAns'+$(this).attr('data-editorInstance');
      CKEDITOR.instances[qustInstanceName].destroy();
      CKEDITOR.instances[ansInstanceName].destroy();

      $('#'+qustInstanceName).remove();
      $('#'+ansInstanceName).remove();
      $(this).parent().parent().parent().remove();
    });
  });

  //DD Match
  var editorDDQustName = 0;
  var editorDDAnsName = 0;
  $('.DDAnsTable').click(function(){
    $('#ddType').append('<div class="card-header cloneCardHeader"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Question</div><div class="ms-auto"> <button type="button" data-editorInstance="'+editorDDQustName+'" class="btn btn-danger delete-editor float-end"><i class="fa fa-trash m-0"></i></button> </div></div></div><textarea name="editorDDTbQust['+editorDDQustName+']" class="editor1" id="editorDDTbQust'+editorDDQustName+'" rows="10" cols="80"></textarea><textarea class="editor1" name="editorDDAns['+editorDDQustName+']" id="editorDDAns'+editorDDQustName+'" rows="10" cols="80"></textarea>');
    //var ckEditorName = "editor"+editorName;

    CKEDITOR.replace( 'editorDDTbQust'+editorDDQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px'],
    });

    CKEDITOR.replace( 'editorDDAns'+editorDDAnsName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px']
    });
    
    editorDDQustName += 1;
    editorDDAnsName += 1;

    $('.delete-editor').unbind().on("click", function() {
      var qustInstanceName = 'editorDDTbQust'+$(this).attr('data-editorInstance');
      var ansInstanceName = 'editorDDAns'+$(this).attr('data-editorInstance');
      console.log("came");
      CKEDITOR.instances[qustInstanceName].destroy();
      CKEDITOR.instances[ansInstanceName].destroy();

      $('#'+qustInstanceName).remove();
      $('#'+ansInstanceName).remove();
      //$(this).remove();
      $(this).parent().closest('.cloneCardHeader').remove();
    });
  });

  //Short Answer
  $(".saAnsIp").each(function(_, saAnsIpEditor) {
    CKEDITOR.replace(saAnsIpEditor, {
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
    });
  });

  //Fill in the blank type question
  var editorQustName = 0;
  $('.fillInTheBlank').click(function(){
    $('#descFillInTheBlankType').append('<div class="card-header"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Question</div><div class="ms-auto"> <button type="button" data-editorInstance="'+editorQustName+'" class="btn btn-danger delete-editor float-end"><i class="fa fa-trash m-0"></i></button> </div></div></div><textarea name="editorFillInTheBlankQust['+editorQustName+']" class="editor1" id="editorFillInTheBlankQust'+editorQustName+'" rows="10" cols="80"></textarea>');

    CKEDITOR.replace( 'editorFillInTheBlankQust'+editorQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px'],
    });
    
    editorQustName += 1;

    $('.delete-editor').unbind().on("click", function() {
      var qustInstanceName = 'editorFillInTheBlankQust'+$(this).attr('data-editorInstance');
      console.log("came");
      CKEDITOR.instances[qustInstanceName].destroy();

      $('#'+qustInstanceName).remove();
      $(this).parent().parent().parent().remove();
    });
  });

  //Nested Question with SA
  var editorNestedSAQustName = 0;
  $('.nestedSA').click(function(){
    $('#nestedSAType').append('<div class="card-header cloneCardHeader"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Question</div><div class="ms-auto"> <button type="button" data-editorInstance="'+editorNestedSAQustName+'" class="btn btn-danger delete-editor float-end"><i class="fa fa-trash m-0"></i></button> </div></div></div><textarea class="editor1" id="editorNSAQust'+editorNestedSAQustName+'" rows="10" cols="80"></textarea>');
    //var ckEditorName = "editor"+editorName;

    CKEDITOR.replace( 'editorNSAQust'+editorNestedSAQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px'],
    });
    
    editorNestedSAQustName += 1;

    $('.delete-editor').unbind().on("click", function() {
      var qustInstanceName = 'editorNSAQust'+$(this).attr('data-editorInstance');

      for (var instanceName in CKEDITOR.instances) {
        //console.log(CKEDITOR.instances[instanceName].name);
        if (CKEDITOR.instances[instanceName].name == qustInstanceName) {
          /*console.log(CKEDITOR.instances[instanceName].name,'-----',qustInstanceName);
          alert(instanceName);
          console.log("came-----",qustInstanceName);*/
          CKEDITOR.instances[qustInstanceName].destroy();
        }
      }

      $('#'+qustInstanceName).remove();
      $(this).parent().closest('.cloneCardHeader').remove();
    });
  });

  //Nested Question with MCQ
  var editorNestedMCQQustName = 0;
  var editorNestedMCQOptName = 0;
  $('.nestedMCQ').click(function(){
    $('#nestedMCQType').append('<div class="card nestedMCQCard" id="nestedMcqCardBlk'+editorNestedMCQQustName+'"> <div class="card-header"> <div class="page-breadcrumb d-sm-flex align-items-center px-2"> <div class="pe-3 border-0">MCQ Question</div><div class="ms-auto"> <button type="button" data-cardBlk="nestedMcqCardBlk'+editorNestedMCQQustName+'" data-editorInstance="'+editorNestedMCQQustName+'" class="btn btn-danger delete-nested-mcq-editor-qustOptions"><i class="fa fa-trash m-0"></i></button> </div></div> </div><div class="card-body"> <textarea class="ckeditorTxt" id="nestedMcqQustEditor'+editorNestedMCQQustName+'"></textarea> <div class="card mt-4"> <div class="card-header"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Add the options and mark the correct answer:</div><div class="ms-auto"> <button class="btn btn-info add-nested-options" data-id="nestedMCQOptCardBody'+editorNestedMCQQustName+'" type="button" > Add Options </button> </div></div></div><div class="card-body"> <div class="row mt-4 options-card-body" id="nestedMCQOptCardBody'+editorNestedMCQQustName+'"></div></div></div></div></div>')

    CKEDITOR.replace( 'nestedMcqQustEditor'+editorNestedMCQQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px'],
    });

    editorNestedMCQQustName += 1;
    
    $('.delete-nested-mcq-editor-qustOptions').on("click", function() {
      var qustInstanceName = 'nestedMcqQustEditor'+$(this).attr('data-editorInstance');
      var mcqCardBlk = $(this).attr('data-cardBlk');

      for (var instanceName in CKEDITOR.instances) {
        if (CKEDITOR.instances[instanceName].name == qustInstanceName) {
          CKEDITOR.instances[qustInstanceName].destroy();
        }
      }

      $('#'+qustInstanceName).remove();
      $('#'+mcqCardBlk).remove();
    });
  });
  $(document).on('click','.add-nested-options', function(){
    // console.log($(this).parents().eq(3).html());
    var optCardBodyId = $(this).attr('data-id');
    $('#'+optCardBodyId).append('<div class="col-6 position-relative editor mb-5"> <div class="page-breadcrumb d-sm-flex align-items-center shadow-lg px-2 py-3"> <div class="pe-3 border-0"> <div class="form-floating"><select class="form-select" name="optionStatus[]" id="floatingSelect" aria-label="Floating label select example"><option value="0" selected>Wrong</option><option value="1">Right</option></select><label for="floatingSelect">Option 1</label></div></div><div class="ms-auto"><button type="button" data-editorInstance="'+editorNestedMCQOptName+'" class="btn btn-danger delete-nested-mcq-editor-option"><i class="fa fa-trash m-0"></i></button></div></div><textarea class="ckeditorOptTxt" id="nestedMcqOptEditor'+editorNestedMCQOptName+'"></textarea> </div>');

    CKEDITOR.replace( 'nestedMcqOptEditor'+editorNestedMCQOptName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../assets/plugins/ckeditor/upload.php?type=image",
      height: ['100px'],
    });

    editorNestedMCQOptName += 1;


    $('.delete-nested-mcq-editor-option').on("click", function() {
      var optInstanceName = 'nestedMcqOptEditor'+$(this).attr('data-editorInstance');
      var mcqCardBlk = $(this).attr('data-cardBlk');

      for (var instanceName in CKEDITOR.instances) {
        if (CKEDITOR.instances[instanceName].name == optInstanceName) {
          CKEDITOR.instances[optInstanceName].destroy();
        }
      }

      $('#'+optInstanceName).parent('.editor').remove();
    });
  });
  //End Nested Question with MCQ

  //Add new question from save&preview popup
  $('.addNewQust').click(function(){
    //$("#qust_form")[0].reset();
    $('#TypeofQuestion').val('');
    $('#mcq').removeClass('d-block').addClass('d-none');
    $('#shortAnsTable').removeClass('d-block').addClass('d-none');
    $('#DDAnsTable').removeClass('d-block').addClass('d-none');
    $('#saType').removeClass('d-block').addClass('d-none');
    $('#nestedSAMCQ').removeClass('d-block').addClass('d-none');
    $('#fillInTheBlank').removeClass('d-block').addClass('d-none');

    $('#previewQuestion').modal('hide');

    $('#cke_qustIp').removeAttr('style');
    
    for(name in CKEDITOR.instances)
    {
      //CKEDITOR.instances[name].destroy(true);
      CKEDITOR.instances[name].setData('');
    }
  });

  //Save Question
  $(document).on('submit', '#qust_form', function(event) {
    console.log('cameee');
    event.preventDefault();

    if (CKEDITOR.instances['qustIp'].getData() === "") {
      $('#cke_qustIp').css('border-color','red');
      alert('Please provide the question');
      return false;
    } else {
      $('#cke_qustIp').removeAttr('style');
    }

    var options = [];
    for (var instanceName in CKEDITOR.instances) {
      console.log(CKEDITOR.instances[instanceName].name);
      if (CKEDITOR.instances[instanceName].name !== 'qustIp') {
        var ediName = instanceName.replace(/\d+/g,'');

        if((choosedQustType == 1 || choosedQustType == 2) && ediName == 'editor') {
          console.log('instanceName---------------', instanceName);
          var data = CKEDITOR.instances[instanceName].getData();
          options.push(data);
          if(data == ""){
            $('#cke_'+instanceName).css('border-color','red');
            alert('Please enter the options for the question');
            return false;
          } else {
            $('#cke_qustIp').removeAttr('style');
          }
        } else if(choosedQustType == 4 && ediName == 'editorTbQust') {
          console.log('choosedQustType-----', choosedQustType);
          var ckEdiVal = CKEDITOR.instances[instanceName].getData();
          if(ckEdiVal == ""){
            $('#cke_'+instanceName).css('border-color','red');
            alert('Please provide the question');
            return false;
          } else {
            $('#cke_qustIp').removeAttr('style');
          }
        } else if(choosedQustType == 5 && (ediName == 'editorDDTbQust' || ediName == 'editorDDAns')) {
          console.log('choosedQustType-----', choosedQustType);
          var ckEdiVal = CKEDITOR.instances[instanceName].getData();
          if(ckEdiVal == ""){
            $('#cke_'+instanceName).css('border-color','red');
            alert('Please provide responses to the question');
            return false;
          } else {
            $('#cke_qustIp').removeAttr('style');
          }
        } else if(choosedQustType == 6 && ediName == 'editorFillInTheBlankQust') {
          console.log('choosedQustType-----', choosedQustType);
          var ckEdiVal = CKEDITOR.instances[instanceName].getData();
          if(ckEdiVal == ""){
            $('#cke_'+instanceName).css('border-color','red');
            alert('Please provide the question');
            return false;
          } else {
            $('#cke_qustIp').removeAttr('style');
          }
        } 
      }
    }

    var formData = new FormData(this);
    if (choosedQustType == 1 || choosedQustType == 2) {
      formData.append('options', options);

      var optionEmpty = 0;
      console.log(options);
      //return false;
      $.each(options, function(key, val) {
        if (val === "") {
          optionEmpty += 1;
        }
      });

      if (optionEmpty > 0) {
        alert('Please enter the options for the question');
        return false;
      }
    }

    if (choosedQustType == 7) {
      var results = [];
      var questions = [];
      $('.nestedSAMCQ').each(function(index, value) {
        // SA
        $(value).find('.editor1').each(function(saIndex, saValue) {
          var id = $(this).attr('id');
          var data = CKEDITOR.instances[id].getData();

          questions.push({
            qText: data,
            qTypeId: 7,
            qTypeText: 'SA'
          });
        });

        // multichoice
        var mcqQustText = [];
        var mcqOptionStatus = [];
        var mcqOptionText = [];
        $(value).find('.nestedMCQCard').each(function(mcqIndex, mcqValue) {
          //$(mcqValue).find('.card').each(function(macqCardIndex, macqCardValue) {
            //alert('card');
            var mcqQustTxt = '';
            $(mcqValue).find('.ckeditorTxt').each(function(macqQustIndex, macqQustValue) {
              var qustText = $(this).attr('id');
              var data = CKEDITOR.instances[qustText].getData();
              mcqQustTxt = data;
            });

            var optionsStatus = [];
            $(mcqValue).find('.options-card-body').each(function(macqOptIndex, macqOptValue) {
              $(macqOptValue).find('select').each(function(macqOptIndexStatus, macqOptValueStatus) {
                var optionStatus = $(this).find(":selected").val();
                optionsStatus.push(optionStatus);
              });
            });

            var optionsTxt = [];
            $(mcqValue).find('.ckeditorOptTxt').each(function(macqOptIndexText, macqOptValueText) {
              var optText = $(this).attr('id');
              var optData = CKEDITOR.instances[optText].getData();
              optionsTxt.push(optData);
            });

            questions.push({
              qText: mcqQustTxt,
              qOptionStatus: optionsStatus,
              qOptionText: optionsTxt,
              qTypeId: 7,
              qTypeText: 'MCQ'
            });
            optionsStatus = [];
            optionsTxt = [];

            console.log(questions);
          //});
        });
      });
      console.log(questions);

      formData.append('questions', JSON.stringify(questions));
    }

    console.log(questions);

    $.ajax({
      type: 'POST',
      url: "apis/save_qust_ajaxcalls.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      statusCode: {
        302: function(responseObject, textStatus, jqXHR) {
          $('#sessionExp').modal('show');
          let myurl = location.origin;
          $(document).on('click', '.closeSessPopup', function () {
            window.location.href=myurl+"/assessment/index.php";
          });
        }           
      },
      success: function(data) {
        $('#bindHTMLCreate').html('');
        var json = $.parseJSON(data);
        console.log(json);
        // $('#createQuestion').modal('hide');
        // $('#previewQuestion').modal('show');
        var srcURL = '';
        
        if (choosedQustType == 1 || choosedQustType == 2) {
          srcURL = 'viewMcq.php';
        } else if(choosedQustType == 3) {
          srcURL = 'viewSA.php';
        } else if(choosedQustType == 4) {
          srcURL = 'viewSATable.php';
        } else if(choosedQustType == 5) {
          srcURL = 'viewDDmatch.php';
        } else if(choosedQustType == 5) {
          srcURL = 'viewFillInTheBlank.php';
        } else if(choosedQustType == 6) {
          srcURL = 'viewFillInTheBlank.php';
        } else if(choosedQustType == 7) {
          srcURL = 'viewNestedSAMCQ.php';
        }
        $('#bindHTMLCreate').html('<iframe id="eventsIframe" src="'+srcURL+'?qustId=' + json + '" style="width:100%; height: 100%"></iframe>')
      }
    });
  });

  $('#createQuestion .btn-close').click(function () {
    mytable = $('#QuestionListTable').DataTable();
    mytable.draw();
  });

  $('#editQuestion .btn-close').click(function () {
    mytable = $('#QuestionListTable').DataTable();
    mytable.draw();
  });


  $(document).on('click','.viewbtn',function(){
    var question_details_id = $(this).attr('data-id');
    var choosedQustType = $(this).attr('data-qustType');
    var srcURL = '';

    if (choosedQustType == 1 || choosedQustType == 2) {
      srcURL = 'viewMcq.php';
    } else if(choosedQustType == 3) {
      srcURL = 'viewSA.php';
    } else if(choosedQustType == 4) {
      srcURL = 'viewSATable.php';
    } else if(choosedQustType == 5) {
      srcURL = 'viewDDmatch.php';
    } else if(choosedQustType == 6) {
      srcURL = 'viewFillInTheBlank.php';
    } else if(choosedQustType == 7) {
      srcURL = 'viewNestedSAMCQ.php';
    }
    $('#viewQuestion').modal('show');
    $('#bindHTMLView').html('<iframe id="eventsIframe" src="'+srcURL+'?qustId=' + question_details_id + '" style="width:100%; height: 100%"></iframe>')
  
  });

  $(document).on('click','.editbtn',function(){
    var question_details_id = $(this).attr('data-id');
    var choosedQustType = $(this).attr('data-qustType');
    var srcURL = '';

    if (choosedQustType == 1 || choosedQustType == 2) {
      srcURL = 'editMcq.php';
    } else if(choosedQustType == 3) {
      srcURL = 'editSA.php';
    } else if(choosedQustType == 4) {
      srcURL = 'editSATable.php';
    } else if(choosedQustType == 5) {
      srcURL = 'editDDmatch.php';
    } else if(choosedQustType == 6) {
      srcURL = 'editFillInTheBlank.php';
    } else if(choosedQustType == 7) {
      srcURL = 'editNestedSAMCQ.php';
    }
    $('#editQuestion').modal('show');
    var time = new Date().getTime();
    $('#bindHTMLEdit').html('<iframe id="eventsIframe" src="'+srcURL+'?timestamp='+time+'&qustId=' + question_details_id + '&updateView=" style="width:100%; height: 100vh"></iframe>')
    
  });

  $(document).on('click','.deletebutton',function(){
    var question_details_id = $(this).attr('data-id');

    if (confirm("Are you sure want to delete this Question ? ")) {
      $.ajax({
        url: "apis/updateQuestion.php",
        type:"post",
        data:{question_details_id:question_details_id,type:"deleteQuestion"},
        dataType:'json',
        statusCode: {
          302: function(responseObject, textStatus, jqXHR) {
            $('#sessionExp').modal('show');
            let myurl = location.origin;
            $(document).on('click', '.closeSessPopup', function () {
              window.location.href=myurl+"/assessment/index.php";
            });
          }           
        },
        success: function(data){
          data = JSON.parse(data);
          mytable = $('#QuestionListTable').DataTable();
          mytable.draw();
        }
      });
    } else {
      return null;
    }
  });
  $(document).on('click', '.questionfilters', function() {

    mytable = $('#QuestionListTable').DataTable();
    mytable.draw();
  });
  
  $('#QuestionListTable').DataTable({
    "fnCreatedRow": function(nRow, aData, iDataIndex) {
      $(nRow).attr('id', aData[3]);
    },
    'serverSide': 'true',
    'processing': 'true',
    'paging': 'true',
    'order': [],
    'ajax': {
      'url': 'apis/fetch_data.php',
      'type': 'post',
      "data": function ( d ) {
        return $.extend( {}, d, {
          "fclass": $("#selectedClass_filter").val(),
          "fsubect": $("#selectedSubject_filter").val(),
          "fchapter": $("#course_filter").val(),
          "ftopic": $("#topic_filter").val(),
          "fsbubtopic": $("#subtopic_filter").val()
           
        } );
      },
      'error': function(error) {
        if (error && error.status == 302) {
          $('#sessionExp').modal('show');
          let myurl = location.origin;
          $(document).on('click', '.closeSessPopup', function () {
            window.location.href=myurl+"/assessment/index.php?sessionExp='yes'";
          });
        }
      }
    },
    "aoColumnDefs": [
        { 'bSortable': false, 'aTargets': [ 2 ] }
    ],
    "bDestroy": true
  });

  $('#mapQustListTable').DataTable({
    "fnCreatedRow": function(nRow, aData, iDataIndex) {
      $(nRow).attr('id', aData[3]);
    },
    'serverSide': 'true',
    'processing': 'true',
    'paging': 'true',
    'order': [],
    'ajax': {
      'url': 'apis/getMapQustList.php',
      'type': 'post',
      'error': function(error) {
        if (error && error.status == 302) {
          $('#sessionExp').modal('show');
          let myurl = location.origin;
          $(document).on('click', '.closeSessPopup', function () {
            window.location.href=myurl+"/assessment/index.php?sessionExp='yes'";
          });
        }
      }
    },
    "columnDefs": [{
      'target': [5],
      'orderable': false,
    }]
  });

  var mapCatId = '';
  var mapQustDetId = '';
  $(document).on('change', '.mapClassSelect', function() {
    $(this).closest('td').addClass('replace');
    var classId = $(this).val();
    if(classId != ""){
      $.ajax({
        type: "POST",
        url: "apis/getSubjects.php",
        data: 'classId='+classId,
        statusCode: {
          302: function(responseObject, textStatus, jqXHR) {
            $('#sessionExp').modal('show');
            let myurl = location.origin;
            $(document).on('click', '.closeSessPopup', function () {
              window.location.href=myurl+"/assessment/index.php";
            });
          }           
        },
        success: function(data){
          var data = $.parseJSON(data);
          console.log(data);
          var options = '<option value="">-Select Subject-</option>';
          if(data != null) {
            for (var i = 0; i < data.length; i++) {
              {
                options += '<option value="' + data[i].subId + '">' + data[i].name + '</option>';
              }
            }
          } else {
            options += '<option value="" disabled>No Subject Availlable</option>';
          }
          $("td.replace .mapSubject").html(options);
        }
      });
    } else {
      var options = '<option value="">-Select Subject-</option>';
      $("td.replace .mapSubject").html(options);
    }
  });

  $(document).on('change', '.mapSubject', function() {
    mapClassId = $(this).closest('td').find('.mapClassSelect :selected').val();
    var mapClassSubId = $(this).val();
    mapQustDetId = $(this).closest('td').find('.mapQuestDetId').val();

    console.log(mapClassId,'---',mapClassSubId,'---',mapQustDetId);

    if(mapClassId != "" && mapClassSubId != "" && mapQustDetId != ""){
      $.ajax({
        url: "apis/updateCatClassSubjectForQust.php",
        type: "post",
        data: {
          mapQustDetId: mapQustDetId,
          mapClassId: mapClassId,
          mapClassSubId: mapClassSubId
        },
        statusCode: {
          302: function(responseObject, textStatus, jqXHR) {
            $('#sessionExp').modal('show');
            let myurl = location.origin;
            $(document).on('click', '.closeSessPopup', function () {
              window.location.href=myurl+"/assessment/index.php";
            });
          }           
        },
        success: function(data){
          var json = JSON.parse(data);
          var status = json.status;
          if (status) {
            $('#desc').text(json.message);
            launch_toast();
          } else {
            alert('failed');
          }
        }
      });
    } else {
      alert('Getting Issue');
    }
  });

  $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href") // activated tab
    if(target == '#veq'){
      mytable = $('#QuestionListTable').DataTable();
      mytable.draw();
    } else if(target == '#tq') {
      mytable = $('#mapQustListTable').DataTable();
      mytable.draw();
    }
  });
});

function launch_toast() {
  var x = document.getElementById("toast")
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}