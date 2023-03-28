$(document).ready(function() {
  /*$(document).on('change', '.classSelect', function() {
    var class_id = $(this).val();
    if(class_id != ""){
      $.ajax({
        type: "POST",
        url: "../userManagement/apis/getSubject.php",
        data: 'classId='+class_id,
        success: function(data){
          var data = $.parseJSON(data);
          console.log(data);
          var options = '<option value="">-Select Subject-</option>';
          if(data != null) {
            for (var i = 0; i < data.length; i++) {
              {
                options += '<option value="' + data[i].subId + '">' + data[i].sub + '</option>';
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
  })*/

  $('.notChangeable').click(function () {
    tostMsg('system', 'System will not allow to change Question Type, Category and Subject for the existing question papers.');
  })

  var qpTypeVal = '';
  var qpCatVal = '';
  var qpClassVal = '';
  var qpSubVal = '';
  $(document).on('change', '.qpType', function() {
    var qpType = qpTypeVal = $(this).val();

    if(qpType == 1){
      $('.forCandidate').removeClass('d-none');
      $('.forStudent').removeClass('d-none').addClass('d-none');
    } else if(qpType == 2){
      $('.forStudent').removeClass('d-none');
      $('.forCandidate').removeClass('d-none').addClass('d-none');
    } else {
      $('.forStudent').removeClass('d-none').addClass('d-none');
      $('.forCandidate').removeClass('d-none').addClass('d-none');
      $('.forCandidateStudent').removeClass('d-none').addClass('d-none');
    }

    if(qpType == 1 || qpType == 2) {
      $("#classess").val('');
      $(".catSelect").val('');
      $("#subject").html('<option value="" selected>-Select Subject-</option>');
      $('.forCandidateStudent').removeClass('d-none');
    }
  });

  $(document).on('change', '.catSelect', function() {
    var cat_id = qpCatVal = $(this).val();
    if(cat_id != ""){
      $.ajax({
        type: "POST",
        url: "../questionBank/apis/getSubjects.php",
        data: 'catId='+cat_id+'&type=getSubjectsForCat',
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
          var options = '<option value="" selected>Select Subject</option>';
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
      var options = '<option value="">Select Subject</option>';
      $("#subject").html(options);
    }

    $('.qpSections').html('');
  })

  $(document).on('change', '.classSelect', function() {
    var classId = qpClassVal = $(this).val();
    if(classId != ""){
      $.ajax({
        type: "POST",
        url: "../questionBank/apis/getSubjects.php",
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
          var options = '<option value="" selected>Select Subject</option>';
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
      var options = '<option value="">Select Subject</option>';
      $("#subject").html(options);
    }
  })

  $(document).on('change', '#subject', function() {
    qpSubVal = $(this).val();
    $('.qpSections').html('');
  });

  var secCount = 0;
  $(document).on('click', '.addSection', function() {
    secCount +=1;
    $('.qpSections').append('<div class="card qustCard mainIndex subindex mainMarks subMarks"> <div class="card-header py-0 border-0"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0"></div><div class="ms-auto"> <i class="bi bi-x-circle deleteSection"></i> </div></div></div><div class="card-body"> <div class="row g-2 mb-3"> <div class="page-breadcrumb d-sm-flex align-items-center"> <div class="breadcrumb-title pe-3 border-0 w-100"> <div class="row"> <div class="col-md"> <div class="form-floating mb-3"> <textarea class="form-control" required="required" name="sh[]" class="form-control" id="sh" placeholder="Section Heading"></textarea> <label for="sh">Section Heading</label> </div></div><div class="col-md"> <div class="form-floating mb-3"> <textarea class="form-control" name="st[]" class="form-control" id="st" placeholder="Section Ttitle"></textarea> <label for="st">Section Title</label> </div></div></div></div><div class="ms-auto"> <div class="form-floating mb-3"> <input type="text" name="sm[]" value="0" class="form-control" placeholder="Marks"> <label for="sec0">Marks</label> </div></div></div><span class="secQuestions"></span> <hr/> <div class="col-12 d-flex justify-content-end"> <button class="btn btn-info addNewQustForSec" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-plus"></i> Add Question</button> </div></div></div></div>');
    if(secCount > 0){
      $('#qpSubmitFooter').removeClass('d-none');
    }
  });

  $(document).on("click", ".deleteSection", function() {
    $(this).closest(".qustCard").remove();
    secCount -=1;
    if(secCount === 0){
      $('#qpSubmitFooter').removeClass('d-none').addClass('d-none');
    }
  });

  $(document).on("click", ".addNewQustForSec", function() {
    qpTypeVal = $('.qpType').val();
    qpCatVal = $('.catSelect').val();
    qpClassVal = $('.classSelect').val();
    qpSubVal = $('#subject').val();
    var questionType = $("#qType").val();

    //console.log($(this).closest('.card-body').find('.secQuestions').html());
    $('.secQuestions').removeClass('appendQuestionsHere');
    $(this).closest('.card-body').find('.secQuestions').addClass('appendQuestionsHere');

    var selectedClassSubId=[];
    $('#subject :selected').each(function(){
      selectedClassSubId.push($(this).val());
    });
    
    //Get questions for selected class and subject while click on "add question" button
    $.ajax({
      url: "apis/getQustsOfSelectedClassSubject.php",
      type: "post",
      statusCode: {
        302: function(responseObject, textStatus, jqXHR) {
          $('#sessionExp').modal('show');
          let myurl = location.origin;
          $(document).on('click', '.closeSessPopup', function () {
            window.location.href=myurl+"/assessment/index.php";
          });
        }           
      },
      data: 'qpTypeVal='+qpTypeVal+'&qpCatVal='+qpCatVal+'&qpClassVal='+qpClassVal+'&qpSubVal='+qpSubVal+'&questionType='+questionType+'&type=getSubjectsForCat',
      success:function(data) {
        $('#qustSelectedClassSubject').html(data);
      }
    });
  });

  $(document).on("click", ".deleteQust", function() {
    var qustId = $(this).attr("data-qustId");
    //$('.'+qustId).remove();
    $(this).parent().parent().parent().parent().remove();
  });

  //Get Questions HTML
  $(document).on('submit', '#getQuestionsHtml', function(event) {
    $('#offcanvasScrolling').offcanvas('hide');
    event.preventDefault();
    $.ajax({
      url: "apis/getQuestionsHtml.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      statusCode: {
        302: function(responseObject, textStatus, jqXHR) {
          $('#sessionExp').modal('show');
          let myurl = location.origin;
          $(document).on('click', '.closeSessPopup', function () {
            window.location.href=myurl+"/assessment/index.php";
          });
        }           
      },
      success:function(data) {
        $('.appendQuestionsHere').append(data);
        $("#getQuestionsHtml")[0].reset();
      }
    });
  });

  //View Question
  $(document).on('click','.viewQuestionBtn',function(){
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
    }
    $('#previewQuestion').modal('show');
    $('#bindHTMLPreviewQuestion').html('<iframe id="eventsIframe" src="../questionBank/'+srcURL+'?qustId=' + question_details_id + '" style="width:100%; height: 100%"></iframe>')
  });

  //Save Question
  $(document).on('submit', '#qust_paper_form', function(event) {
    console.log('cameee');
    event.preventDefault();

    var questionIds = [ ];
    var arrayIndex = 0;
    var val = -1;
    $(".subindex").each(function(i, e) {

      if($(this).hasClass('mainIndex')){
        val++;
        questionIds[val] = [ ];
        arrayIndex = 0;
      } else {
        questionIds[val][arrayIndex] = $(this).val();
        arrayIndex++;
      }
    });

    var marks = [ ];
    var arrayIndex = 0;
    var val = -1;
    $(".subMarks").each(function(i, e) {

      if($(this).hasClass('mainMarks')){
        val++;
        marks[val] = [ ];
        arrayIndex = 0;
      } else {
        marks[val][arrayIndex] = $(this).val();
        arrayIndex++;
      }
    });

    console.log(questionIds);
    var formData = new FormData(this);
    formData.append('questions', JSON.stringify(questionIds));
    formData.append('marks', JSON.stringify(marks));

    $.ajax({
      url: "apis/updateQustPaper.php",
      method:'POST',
      data:formData,
      contentType:false,
      processData:false,
      statusCode: {
        302: function(responseObject, textStatus, jqXHR) {
          $('#sessionExp').modal('show');
          let myurl = location.origin;
          $(document).on('click', '.closeSessPopup', function () {
            window.location.href=myurl+"/assessment/index.php";
          });
        }           
      },
      success:function(data) {
        launch_toast();
        $("#editQuestionPaper").modal('hide');
      }
    });
  });
});

function launch_toast() {
  var x = document.getElementById("toast")
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}

function tostMsg(type, message) {
  // manual creation from method
  toastsHandler.createToast({
      type: type,
      icon: 'info-circle',
      message: message,
      duration: 10000
  });
}