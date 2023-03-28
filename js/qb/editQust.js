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
    filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
    filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
    height: ['100px']
  });
  $(textArea).attr("id", newEditor.name);

  var ipType = 0;
  if ($("#TypeofQuestion :selected").val() == 1 || $("#TypeofQuestion :selected").val() == 2) {
    ipType = 1;
  }
  if (ipType) {
    $(deleteBtn)
      .html('<div class="page-breadcrumb d-sm-flex align-items-center shadow-lg p-2"><div class="form-floating"><select class="form-select" name="optionStatus[]" id="floatingSelect" aria-label="Floating label select example"><option value="0" selected>Wrong</option><option value="1">Right</option></select><label for="floatingSelect">Option ' + newEditor.name.match(/\d+/) + '</label></div><div class="ms-auto"><button type="button" class="btn btn-danger delete-editor"><i class="fa fa-trash m-0"></i></button></div></div>')
      .prependTo(editorDiv);
  }

  console.log(newEditor);
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
  $(document).on("click", '.delete-editor-update', function() {
    var qustInstanceName = $(this).attr('data-editorInstance');
    CKEDITOR.instances[qustInstanceName].destroy();

    $(this).parent().parent().parent().parent().remove();
  });

  $('.delete-editor-updateSATB').on("click", function() {
    var qustInstanceName = 'editorTbQust'+$(this).attr('data-editorInstance');
    var ansInstanceName = 'editorAns'+$(this).attr('data-editorInstance');
    console.log("came");
    CKEDITOR.instances[qustInstanceName].destroy();
    CKEDITOR.instances[ansInstanceName].destroy();

    $('#'+qustInstanceName).remove();
    $('#'+ansInstanceName).remove();
    $(this).parent().parent().parent().remove();
    $(this).remove();
  });

  $('.delete-editor-updateFITB').on("click", function() {
    var qustInstanceName = 'editorFillInTheBlankQust'+$(this).attr('data-editorInstance');
    console.log("wqdqwdqwdqwqwdqwd---",qustInstanceName);
    CKEDITOR.instances[qustInstanceName].destroy();

    $('#'+qustInstanceName).remove();
    $(this).parent().parent().parent().remove();
    $(this).remove();
  });

  //Start nested SA and MCQ delete logic
  $('.delete-editor-updateNSAMCQ').on("click", function() {
    var qustInstanceName = 'editorNSAQust'+$(this).attr('data-editorInstance');
    console.log("wqdqwdqwdqwqwdqwd---",qustInstanceName);
    CKEDITOR.instances[qustInstanceName].destroy();

    $('#'+qustInstanceName).remove();
    $(this).parent().parent().parent().remove();
    $(this).remove();
  });

  $('.delete-nested-mcq-editor-qustOptions-updateNSAMCQ').on("click", function() {
    var clickedId = $(this).attr('data-cardblk');
    var htmlCode = $('#'+clickedId).html();
    //console.log(htmlCode);
    $(htmlCode).find('textarea').each(function(index, value) {
      var destroyEditor = $(this).attr('id');
      CKEDITOR.instances[destroyEditor].destroy();
    });

    console.log(clickedId);

    $('#'+clickedId).remove();
  });

  $('.delete-nested-mcq-editor-option-updateNSAMCQ').on("click", function() {
    var qustInstanceName = 'nestedMcqOptEditor'+$(this).attr('data-editorInstance');
    console.log("wqdqwdqwdqwqwdqwd---",qustInstanceName);
    CKEDITOR.instances[qustInstanceName].destroy();

    $('#'+qustInstanceName).remove();
    $(this).parent().parent().parent().remove();
  });
  //End nested SA and MCQ delete logic

  $('.delete-editor-updateDDMatch').on("click", function() {
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
          $("#subject").trigger("change");
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
                    $("#topic").trigger("change");
                    $("#subtopic").empty();
                    $("#subtopic").html('<option value="">-Select Sub Topic-</option>');
                }
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
            }
        });
    });
  $(".ckeditorQustBlk").each(function(_, ckeditorqust) {
    CKEDITOR.replace(ckeditorqust, {
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
    });
  });

  $(".ckeditorTxt, .editor1, .ckeditorOptTxt").each(function(_, ckeditor) {
    CKEDITOR.replace(ckeditor, {
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
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
    $('#tags').tagsinput('removeAll');
    
    choosedQustType = $(this).val();

    if ($(this).val() == 1 || $(this).val() == 2) {
      $('#shortAnsTable').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-block').addClass('d-none');
      $('#mcq').removeClass('d-none');
    } else if ($(this).val() == 4) {
      $('#mcq').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-block').addClass('d-none');
      $('#shortAnsTable').removeClass('d-none');
    } else if ($(this).val() == 5) {
      $('#mcq').removeClass('d-block').addClass('d-none');
      $('#shortAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-none');
    }
     else if ($(this).val() == 3) {
      $('#mcq').removeClass('d-block').addClass('d-none');
      $('#shortAnsTable').removeClass('d-block').addClass('d-none');
      $('#DDAnsTable').removeClass('d-block').addClass('d-none');
      $('#saType').removeClass('d-none');
    }
  });

  //Descp type question
  var editorQustName = 0;
  var editorAnsName = 0;
  $('.shortAnsTable').click(function(){
    var arr = $('.editor1');
    arr.each(function(Index, Value) {
      console.log(Index,'==',arr.length - 1);
      var element_id = $(this).attr('id');
      var number = element_id.match(/\d+/);
      if(Index == (arr.length - 1)) {
        editorQustName = editorAnsName = parseInt(number)+1;
      }
    });
    
    $('#descTbType').append('<div class="card-header"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Column '+editorQustName+'</div><div class="ms-auto"> <button type="button" data-editorInstance="'+editorQustName+'" class="btn btn-danger delete-editor float-end"><i class="fa fa-trash m-0"></i></button> </div></div></div><textarea name="editorTbQust['+editorQustName+']" class="editor1" id="editorTbQust'+editorQustName+'" rows="10" cols="80"></textarea><textarea class="editor1" name="editorAns['+editorAnsName+']" id="editorAns'+editorAnsName+'" rows="10" cols="80"></textarea>');
    //var ckEditorName = "editor"+editorName;

    CKEDITOR.replace( 'editorTbQust'+editorQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
      height: ['100px'],
    });

    CKEDITOR.replace( 'editorAns'+editorAnsName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
      height: ['100px']
    });
    
    editorQustName += 1;
    editorAnsName += 1;

    $('.delete-editor').on("click", function() {
      var qustInstanceName = 'editorTbQust'+$(this).attr('data-editorInstance');
      var ansInstanceName = 'editorAns'+$(this).attr('data-editorInstance');
      console.log("came");
      CKEDITOR.instances[qustInstanceName].destroy();
      CKEDITOR.instances[ansInstanceName].destroy();

      $('#'+qustInstanceName).remove();
      $('#'+ansInstanceName).remove();
      $(this).remove();
    });
  });

  //DD Match
  var editorDDQustName = 0;
  var editorDDAnsName = 0;
  $('.DDAnsTable').click(function(){
    var arr = $('.editor1');
    arr.each(function(Index, Value) {
      console.log(Index,'==',arr.length - 1);
      var element_id = $(this).attr('id');
      var number = element_id.match(/\d+/);
      if(Index == (arr.length - 1)) {
        editorDDQustName = editorDDAnsName = parseInt(number)+1;
      }
    });

    $('#ddType').append('<div class="card-header cloneCardHeader"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Row '+editorDDQustName+'</div><div class="ms-auto"> <button type="button" data-editorInstance="'+editorDDQustName+'" class="btn btn-danger delete-editor float-end"><i class="fa fa-trash m-0"></i></button> </div></div></div><textarea name="editorDDTbQust['+editorDDQustName+']" class="editor1" id="editorDDTbQust'+editorDDQustName+'" rows="10" cols="80"></textarea><textarea class="editor1" name="editorDDAns['+editorDDQustName+']" id="editorDDAns'+editorDDQustName+'" rows="10" cols="80"></textarea>');
    //var ckEditorName = "editor"+editorName;

    CKEDITOR.replace( 'editorDDTbQust'+editorDDQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
      height: ['100px'],
    });

    CKEDITOR.replace( 'editorDDAns'+editorDDAnsName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
      height: ['100px']
    });
    
    editorDDQustName += 1;
    editorDDAnsName += 1;

    $('.delete-editor').on("click", function() {
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
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
    });
  });

  $('#addNewQust').click(function(){
    $("#qust_form")[0].reset();
    $('#mcq').removeClass('d-block').addClass('d-none');
    $('#shortAnsTable').removeClass('d-block').addClass('d-none');
    $('#DDAnsTable').removeClass('d-block').addClass('d-none');
    $('#saType').removeClass('d-block').addClass('d-none');
    $('#previewQuestion').modal('hide');

    for(name in CKEDITOR.instances)
    {
      //CKEDITOR.instances[name].destroy(true);
      CKEDITOR.instances[name].setData('');
    }
  });

  //Fill in the blank type question
  var editorFITBQustName = 0;
  $('.fillInTheBlank').click(function(){
    var arr = $('.editor1');
    arr.each(function(Index, Value) {
      console.log(Index,'==',arr.length - 1);
      var element_id = $(this).attr('id');
      var number = element_id.match(/\d+/);
      if(Index == (arr.length - 1)) {
        editorFITBQustName = parseInt(number)+1;
      }
    });

    $('#descFillInTheBlankType').append('<div class="card-header"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Question</div><div class="ms-auto"> <button type="button" data-editorInstance="'+editorFITBQustName+'" class="btn btn-danger delete-editor float-end"><i class="fa fa-trash m-0"></i></button> </div></div></div><textarea name="editorFillInTheBlankQust['+editorFITBQustName+']" class="editor1" id="editorFillInTheBlankQust'+editorFITBQustName+'" rows="10" cols="80"></textarea>');

    CKEDITOR.replace( 'editorFillInTheBlankQust'+editorFITBQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
      height: ['100px'],
    });
    
    editorFITBQustName += 1;

    $('.delete-editor').on("click", function() {
      var qustInstanceName = 'editorFillInTheBlankQust'+$(this).attr('data-editorInstance');
      console.log("came");
      CKEDITOR.instances[qustInstanceName].destroy();

      $('#'+qustInstanceName).remove();
      $(this).remove();
    });
  });

  //Nested Question with SA
  var editorNestedSAQustName = 0;
  $('.nestedSA').click(function(){
    var arr = $('.editor1');
    arr.each(function(Index, Value) {
      console.log(Index,'==',arr.length - 1);
      var element_id = $(this).attr('id');
      var number = element_id.match(/\d+/);
      if(Index == (arr.length - 1)) {
        editorNestedSAQustName = parseInt(number)+1;
      }
    });

    $('#nestedSAType').append('<div class="card-header cloneCardHeader"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Question</div><div class="ms-auto"> <button type="button" data-editorInstance="'+editorNestedSAQustName+'" class="btn btn-danger delete-editor float-end"><i class="fa fa-trash m-0"></i></button> </div></div></div><textarea class="editor1" id="editorNSAQust'+editorNestedSAQustName+'" rows="10" cols="80"></textarea>');
    //var ckEditorName = "editor"+editorName;

    CKEDITOR.replace( 'editorNSAQust'+editorNestedSAQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
      height: ['100px'],
    });
    
    editorNestedSAQustName += 1;

    $('.delete-editor').on("click", function() {
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
    var arr = $('.ckeditorTxt');
    arr.each(function(Index, Value) {
      console.log(Index,'==',arr.length - 1);
      var element_id = $(this).attr('id');
      var number = element_id.match(/\d+/);
      if(Index == (arr.length - 1)) {
        editorNestedMCQQustName = parseInt(number)+1;
      }
    });

    $('#nestedMCQType').append('<div class="card nestedMCQCard" id="nestedMcqCardBlk'+editorNestedMCQQustName+'"> <div class="card-header"> <div class="page-breadcrumb d-sm-flex align-items-center px-2"> <div class="pe-3 border-0">MCQ Question</div><div class="ms-auto"> <button type="button" data-cardBlk="nestedMcqCardBlk'+editorNestedMCQQustName+'" data-editorInstance="'+editorNestedMCQQustName+'" class="btn btn-danger delete-nested-mcq-editor-qustOptions"><i class="fa fa-trash m-0"></i></button> </div></div> </div><div class="card-body"> <textarea class="ckeditorTxt" id="nestedMcqQustEditor'+editorNestedMCQQustName+'"></textarea> <div class="card mt-4"> <div class="card-header"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0">Add the options and mark the correct answer:</div><div class="ms-auto"> <button class="btn btn-info add-nested-options" data-id="nestedMCQOptCardBody'+editorNestedMCQQustName+'" type="button" > Add Options </button> </div></div></div><div class="card-body"> <div class="row mt-4 options-card-body" id="nestedMCQOptCardBody'+editorNestedMCQQustName+'"></div></div></div></div></div>')

    CKEDITOR.replace( 'nestedMcqQustEditor'+editorNestedMCQQustName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
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
    var arr = $('.ckeditorOptTxt');
    arr.each(function(Index, Value) {
      console.log(Index,'==',arr.length - 1);
      var element_id = $(this).attr('id');
      var number = element_id.match(/\d+/);
      if(Index == (arr.length - 1)) {
        editorNestedMCQOptName = parseInt(number)+1;
      }
    });


    var optCardBodyId = $(this).attr('data-id');
    $('#'+optCardBodyId).append('<div class="col-6 position-relative editor mb-5"> <div class="page-breadcrumb d-sm-flex align-items-center shadow-lg px-2 py-3"> <div class="pe-3 border-0"> <div class="form-floating"><select class="form-select" name="optionStatus[]" id="floatingSelect" aria-label="Floating label select example"><option value="0" selected>Wrong</option><option value="1">Right</option></select><label for="floatingSelect">Option 1</label></div></div><div class="ms-auto"><button type="button" data-editorInstance="'+editorNestedMCQOptName+'" class="btn btn-danger delete-nested-mcq-editor-option"><i class="fa fa-trash m-0"></i></button></div></div><textarea class="ckeditorOptTxt" id="nestedMcqOptEditor'+editorNestedMCQOptName+'"></textarea> </div>');

    CKEDITOR.replace( 'nestedMcqOptEditor'+editorNestedMCQOptName,{
      extraPlugins: 'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "../../lib/ckeditor/upload.php?type=file",
      filebrowserImageUploadUrl: "../../lib/ckeditor/upload.php?type=image",
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

  //Save Question
  $(document).on('submit', '#qust_form', function(event) {
    console.log('cameee');
    event.preventDefault();
    choosedQustType = $('#TypeofQuestion').find("option:selected").val();
    var options = [];
    for (var instanceName in CKEDITOR.instances) {
      console.log(CKEDITOR.instances[instanceName].name);
      if (CKEDITOR.instances[instanceName].name !== 'qustIp') {
        if(choosedQustType != 4 && CKEDITOR.instances[instanceName].name !== 'saAnsIp') {
          console.log('instanceName---------------', instanceName);
          var data = CKEDITOR.instances[instanceName].getData();
          options.push(data);
          console.log(data);
        }
      }
    }

    console.log('options----', options);

    var formData = new FormData(this);
    if (choosedQustType == 1 || choosedQustType == 2) {
      formData.append('options', options);

      var optionEmpty = 0;
      $.each(options, function(key, val) {
        if (val === "") {
          optionEmpty += 1;
        }
      });

      if (optionEmpty > 0) {
        alert('options should not be empty');
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

    $.ajax({
      type: 'POST',
      url: "apis/updateQuestion.php",
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
        $('#bindHTML').html('');
        var json = $.parseJSON(data);
        console.log(json);
        $('#viewQuestion').modal('show');
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
        $('#bindHTMLView').html('<iframe id="eventsIframe" src="'+srcURL+'?qustId=' + json + '" style="width:100%; height: 100%"></iframe>')
      }
    });
  });

});