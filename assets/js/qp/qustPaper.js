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

    $('.qpSections').html('');
  })*/

  var qpTypeVal = '';
  var qpCatVal = '';
  var qpClassVal = '';
  var qpSubVal = '';
  $(document).on('change', '.qpType', function() {
    var qpType = qpTypeVal = $(this).val();
 

   v
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
        url: "../apis/common/getSubjects.php",
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
    
    // if(qpTypeVal == ''){
    //   tostMsg('warning', 'Select Question Paper Type');
    //   return false;
    // } else {
    //   if(qpTypeVal == 1) {
    //     if(qpCatVal == '' || qpSubVal == ''){
    //       tostMsg('warning', 'Select Category & Subject');
    //       return false;
    //     }
    //   } else {
    //     if(qpClassVal == '' || qpSubVal == ''){
    //       tostMsg('warning', 'Select Class & Subject');
    //       return false;
    //     }
    //   }
    // }

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
      data: 'qpTypeVal='+qpTypeVal+'&qpCatVal='+qpCatVal+'&qpClassVal='+qpClassVal+'&qpSubVal='+qpSubVal+'&type=getSubjectsForCat',
      success:function(data) {
        $('#qustSelectedClassSubject').html(data);
      }
    });
  });

  $(document).on("click", ".deleteQust", function() {
    var qustId = $(this).attr("data-qustId");
    // $('#'+qustId).remove();
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
      url: "apis/saveQustPaper.php",
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
        //$("#getQuestionsHtml")[0].reset();
        var qustPaperId = data;
        launch_toast();
        $('#title').val("");
        $('#totMarks').val("0");
        $('.qpSections').html("");
        $('#previewQuestionPaper').modal('show');
        $('#bindHTMLPreview').html('<iframe id="eventsIframe" src="previewQP.php?qustPaperId=' + qustPaperId + '" style="width:100%; height: 100vh"></iframe>')
        //location.reload();
      }
    });
  });

  //Get View/Edit Question Paper
  $('#viewEditQpListTable').DataTable({
    "fnCreatedRow": function(nRow, aData, iDataIndex) {
      $(nRow).attr('id', aData[3]);
    },
    'serverSide': 'true',
    'processing': 'true',
    'paging': 'true',
    'order': [],
    'ajax': {
      'url': 'apis/getListofViewEditQP.php',
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

  $(document).on('click','.editBtn',function(){
    var qustPaperId = $(this).attr('data-id');
    var time = new Date().getTime();
    $('#editQuestionPaper').modal('show');
    $('#bindHTMLEdit').html('<iframe id="eventsIframe" src="viewEditQP.php?timestamp='+time+'&qustPaperId=' + qustPaperId + '" style="width:100%; height: 100vh"></iframe>')
  });

  $(document).on('click','.viewBtn',function(){
    var qustPaperId = $(this).attr('data-id');
    $('.qpTitle').text($(this).attr('data-title'));
    $('#previewQuestionPaper').modal('show');
    $('#bindHTMLPreview').html('<iframe id="eventsIframe" src="previewQP.php?qustPaperId=' + qustPaperId + '" style="width:100%; height: 100vh"></iframe>')
  });


  //Get Question Paper
  $('#QpListTable').DataTable({
    "fnCreatedRow": function(nRow, aData, iDataIndex) {
      $(nRow).attr('id', aData[3]);
    },
    'serverSide': 'true',
    'processing': 'true',
    'paging': 'true',
    'order': [],
    'ajax': {
      'url': 'apis/getListofQP.php',
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

  //publlish Qust Paper
  $(document).on('submit', '#publishQP', function(event) {
    event.preventDefault();
    $.ajax({
      url: "apis/publishQP.php",
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
        mytable = $('#QpListTable').DataTable();
        mytable.draw();

        alert('The assessment has been published successfully');
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

  /*$('#save_assessment').click(function () {
    $("#eventsIframe").contents().find("#save_assessment").trigger("click");
  })*/

  /*var closeIFrame = function() {
     $('#eventsIframe').remove();
  }*/

  $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href") // activated tab
    if(target == '#veqp'){
      mytable = $('#viewEditQpListTable').DataTable();
      mytable.draw();
    } else if(target == '#pp') {
      mytable = $('#QpListTable').DataTable();
      mytable.draw();
    } else if(target == '#review') {
      mytable = $('#evalute_review_table').DataTable();
      mytable.draw();
    }
  });

  $('.edit_question_paper_modal_close').click(function () {
      mytable = $('#viewEditQpListTable').DataTable();
      mytable.draw();
  })
});

function launch_toast() {
  //alert("camee");
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
      duration: 5000
  });
}