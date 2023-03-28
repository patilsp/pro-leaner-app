$(document).ready(function() {

    $('.from_to_date').datetimepicker({
        format: 'DD-MM-YYYY',
        icons: {
          previous: "fas fa-chevron-left",
          next: "fas fa-chevron-right",
        },
      });
      
        $('.publishdate').click(function(){
            $('#publishdate').trigger('focus');
        });
    
        $('#dueby').datetimepicker({
        format: 'LT',
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            previous: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            today: 'fa fa-dot-circle-o',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
        }).on('change', function() {
    
        });


    
    $("#cardTwo").hide();
    $("#back_btn").hide();
    $(".candidate_title").html('');
    $("#assessment_id").val('');
    $(document).on("click", ".btn_evaluate", function() {
        $("#assessment_id").val('');
        $("#cardOne").hide();
        $("#cardTwo").show();
        $("#back_btn").show();
        var title = $(this).attr('data-title');
        var assessment_id = $(this).attr('data-attr');
        $("#assessment_id").val(assessment_id);
        $(".candidate_title").html(title);
        reviewDataTable(assessment_id);

    });

    function reviewDataTable(assessment_id) {
        $('.landing_page').hide(); 
        $('.review_page').show(); 
        $('#review_table').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[3]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../assessmentnew1/apis/evaluateAssessment.php',
                'type': 'post',
                'data': {
                    type: 'evalauate_candidate',
                    assessment_id: assessment_id
                },
            },
            "columnDefs": [{
                'target': [2, 3, 4, 5, 6],
                'orderable': false,
            }],
            "bDestroy": true
        });

    }

    function getQuestion() {

        $.ajax({
            url: "../assessmentnew1/apis/evaluateAssessment.php",
            type: "post",
            data: {
                type: 'getQuestion',
                assessment_id: $("#assessment_id").val()
            },
            jsonType: "json",
            success: function(data) {
                var Content = "";
                var json = JSON.parse(data);
                var i = 0;

                

                $(json).each(function(index, value2) {


                    $.each(value2, function(index2, value3) {
                        if (value3[0].question != null) {
                            Content += `<div class="d-flex w-100 mb-1 prev_section_heading">
                    <div class="p-2 flex-grow-1">
                      <h5 class="font-weight-bold"><u id="section_heading">` + value3[0].secHeading + ` ` + value3[0].secTitle + `</u></h5>
                    </div>
                    <div class="p-2 flex-shrink-1">
                      <h6 class="font-weight-bold">` + value3[0].secMarks + `</h6>
                    </div>
                  </div>`;

                            $.each(value3, function(index3, value) {
                                i++;

                                var optionIds = [];
                                var optionContents = [];
                                var optionAnswer = [];
                                if (value.mcqoptionId != null) {

                                    optionIds = value.mcqoptionId.split(',');
                                    optionContents = value.optionContents.split(',');
                                    optionAnswer = value.optionAns.split(',');
                                }
                                // console.log(data);

                                Content += `<div class="col-12 mb-4">
                                <div class="card bg-white border-1">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-8">

                                      <div class="d-flex w-100 p-15 mb-1">
                                        <div class="text-left mr-10">
                                          <h5 class="card-title">` + i + `.  </h5>
                                        </div>
                                        <div class="flex-grow-1">
                                          <h5 class="card-title">` + value.question + `</h5>
                                        </div>
                
                                    </div>
                
                            
                            <div class="position-relative w-100">
                               `;
                                var j = 0;
                                var questMarksContnet = `<h4 id="question_mark_` + value.questionsId + `" class="preview_qust_mark d-flex align-items-center justify-content-center">` + value.qustMark + `</h4>`;
                                if (value.qustType == 3) {
                                    questMarksContnet = `<input type="text" id="question_mark_` + value.questionsId + `" class="descriptive_marks preview_qust_mark d-flex align-items-center justify-content-center" value="` + value.qustMark + `">`;
                                }

                                $(optionIds).each(function(index, option) {
                                    var correct_class = "";
                                    var cAnswer = 0;

                                    if (optionAnswer[j] == 1) {
                                        correct_class = " right_ans_label";
                                        cAnswer = 1;
                                    }

                                    Content += ` <div class="form-check d-flex align-items-center">
                                        <div class="choosed_status d-flex">
                                        <i class="bi " data-score="` + value.qustMark + `" data-attr="` + cAnswer + `" id="` + value.qId + `-` + option + `"></i>
                                        </div>
                                            <label class="form-check-label ` + correct_class + `" data-attr=""  for="exampleRadios1">
                                              ` + optionContents[j] + ` 
                                            </label>
                                          </div>`;
                                    j++;

                                });
                                if (value.qustType == 3) {
                                    Content += `<div class="form-check d-flex align-items-center">
                                     <label id="answerText_` + value.questionsId + `"></label>
                                     </div>`
                                }
                                Content += `
                           </div>
                          </div>
                        <div class="col-4">
                            ` + questMarksContnet + `
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>`;


                                i++;
                            });
                        }
                    });
                });
                $("#evaluate_answer_list").html(Content);


            },
            complete: function() {
                getCandidateAnswer()
            }
        });



    }
    $(document).on("keyup", ".descriptive_marks", function() {

        var max_marks = +$("#max_marks").html();
        var score = 0;
        $(".preview_qust_mark").each(function(index, value) {
            if ($(this).html() == "") {
                score += +$(this).val();
            } else {
                score += +$(this).html();
            }

        });


        if (max_marks >= score) {
            $("#marks_earned").html(score);
            $("#mark_obtain").val(score);
        } else {
            $("#desc").html('maximum score exceeds');
            launch_toast();
            var curr_val = $(this).val();
            $(this).val(curr_val.substr(0, curr_val.length - 1));
        }


    });

    function getCandidateAnswer() {
        $("#mark_obtain").val('');
        $.ajax({
            url: "../assessmentnew1/apis/evaluateAssessment.php",
            type: "post",
            data: {
                type: 'getAnswer',
                assessment_id: $("#assessment_id").val(),
                user_id: user_id
            },
            jsonType: "json",
            success: function(data) {
                var json = JSON.parse(data);

                var res2 = JSON.parse(json[0].userResJson);
                var res = [];
                $(res2).each(function(index, value3) {
                  $(value3.section).each(function(index2,value2){
                    $(value2.questions).each(function(index4,value4){
                      res.push((value4));
                    })
                  });
                  
                });
                var totalScore = [];
                
                $(res).each(function(index, value) {
                  
                  if(value.qTypeId==1 ||value.qTypeId==2 || value.qTypeId==5 ){
                    $(value.aId).each(function(index,valueAns){
                      
                      var ans = $("#" + value.qId + "-" + valueAns).attr("data-attr");
                    console.log(value.qId +" - "+ valueAns);
                      if (ans == 1) {
                          $("#" + value.qId + "-" + valueAns).addClass("bi-check-circle-fill");
                          var score = $("#" + value.qId + "-" + valueAns).attr("data-score");
                          totalScore[value.qId] = score;
                      } else if (ans == 0) {
                          $("#" + value.qId + "-" + valueAns).addClass("bi-x-circle-fill");
                          $("#question_mark_" + value.qId).html(0);
                      }

                    })

                  }
                    if (value.aText != undefined && (value.qTypeId==4 ||value.qTypeId==3)  ) {
                        $("#answerText_" + value.qId).html(value.aText);
                    }

                });
                var totScore = 0;
                $(totalScore).each(function(index, dScore) {
                    if (dScore != undefined) {
                        totScore += +dScore;
                    }


                });
                $("#marks_earned").html(totScore);
                $("#mark_obtain").val(totScore);

            }
        });
    }
    var user_id = "";
    $(document).on("click", "#save_assessment", function() {
        var mark_obtain = $("#mark_obtain").val();
        var resultStatus = $("#resultStatus").val();
        var remarks = $("#overall_remarks").val();
        var assessId = $("#assessment_id").val()
        if (resultStatus == '') {
            alert("Please fill the Status");
            return false;
        }
        var descriptive = [];
        $(".descriptive_marks").each(function(index, value) {
            var decriptive = $(this).attr("id");
            var qId = decriptive.split("_");
            descriptive.push({
                qId: qId[2],
                mark: $(this).val()
            });
        });
        if (resultStatus != '') {
            $.ajax({
                url: "../assessmentnew1/apis/evaluateAssessment.php",
                type: "post",
                data: {
                    type: 'evaluateAssessment',
                    marksObtained: mark_obtain,
                    resultStatus: resultStatus,
                    remarks: remarks,
                    assessId: assessId,
                    userId: user_id,
                    descriptive: descriptive
                },
                jsonType: "json",
                success: function(data) {
                    $("#evaluate_answer_paper_modal").modal("hide");
                    reviewDataTable(assessId);
                },
                beforeSend: function() {
                    $("body").mLoading('show');
                },
                complete: function() {
                    $("body").mLoading('hide');
                }
            });
            resetForm()
        }
    });

    function resetForm() {
        $("#mark_obtain").val('');
        $("#resultStatus").val('');
        $("#overall_remarks").val('');
    }

    $(document).on("click", ".evalauate_user_answer", function() {
        var user_name = $(this).attr('data-name');
        user_id = $(this).attr('data-attr');
        var totMarks = $(this).attr('data-totmarks');
        $("#evaluate_answer_paper_modal").modal("show");
        //getQuestion();

        // type: 'getQuestion',
        // assessment_id: $("#assessment_id").val()
        var assessment_id = $("#assessment_id").val();
        var time = new Date().getTime();
        $('#evaluate_answer_iframe').html('<iframe id="eventsIframe" src="evaluateAnswer_v2.php?timestamp='+time+'&assessment_id='+assessment_id+'&user_id='+user_id+'" style="width:100%; height: 100%"></iframe>');
        
        $("#max_marks").html(totMarks);
        $("#student_name").html(user_name);

    });

    $(document).on("click", "#back_btn", function() {
        // $("#cardOne").show();
        // $("#cardTwo").hide();
        // $("#back_btn").hide();
        // $(".candidate_title").html('');
        // evalauteTitleTable()

        $('.landing_page').show(); 
        $('.review_page').hide(); 
    });



    $('#assessment_view_table').DataTable();
    $('#preview_publish').DataTable();

    $('#review_table').DataTable();

    // var init = evalauteTitleTable();

    // function evalauteTitleTable() {
    //     $('#evalute_review_table').DataTable({
    //         "fnCreatedRow": function(nRow, aData, iDataIndex) {
    //             $(nRow).attr('id', aData[3]);
    //         },
    //         'serverSide': 'true',
    //         'processing': 'true',
    //         'paging': 'true',
    //         'order': [],
    //         'ajax': {
    //             'url': '../assessmentnew1/apis/evaluateAssessment.php',
    //             'type': 'post',
    //             'data': {
    //                 type: 'list'
    //             },
    //         },
    //         "columnDefs": [{
    //             'target': [2, 3, 4, 5, 6],
    //             'orderable': false,
    //         }],
    //         "bDestroy": true
    //     });
    // }



    function launch_toast() {
        var x = document.getElementById("toast")
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 5000);
    }

    $('.evaluate_answer_paper_modal_close').click(function () {
        mytable = $('#review_table').DataTable();
        mytable.draw();
    })
});