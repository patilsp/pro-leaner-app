$(document).ready(function() {
	$('#AddviewQustModal').on('hidden.bs.modal', function (e) {
  	$('#addQustToSection').modal("show");
	});
	$('#AddviewQustModal').on('show.bs.modal', function (e) {
  	$('#addQustToSection').modal("hide");
	});
	//Add section
  $("#add_section").click(function(){
		$("#append_section_blk").append("<div class='row px-4 qust_section mx-2 mb-4 py-3 position-relative'><img src='../../img/QB/close.svg' class='close_section position-absolute'><ul class='w-100 mb-0'><li class='w-100 mb-3'><div class='d-flex align-items-center position-relative'><input type='text' class='form-control sect_title mr-5' name='sect_title[]' placeholder='Type Section Heading'><input type='hidden' class='form-control section_question_ids' name='section_question_ids[]' value=''><div class='d-flex align-items-center ml-5'><p class='mb-0 tot_sec_mark_labe1 mr-5'>Marks</p><p class='mb-0 tot_sec_mark'>0</p></div></div></li></ul><ol class='w-100 mb-0 saved_selected_qust dragQuestions'></ol><div class='col-12 text-center'><hr><button class='btn btn-md btn-green addQuestions'>Add Question</button></div></div>");
		$(".dragQuestions" ).sortable({
	    connectWith: ".dragQuestions",
	    start: function( event, ui ) {
	      dragging_section = true;
	      ui.item.startPos = ui.item.index();
	    },
	    stop: function(event, ui) {
	      var start_pos = ui.item.startPos;
	      var new_pos = ui.item.index();
	      if(start_pos !== new_pos) {
	        $("#"+moveactivequestion).removeClass("enablemoveQuestion");
	        $(this).closest('.dragQuestions').each(function() {
	            var sequence_qids = []
	            $(this).find(".move_question_option").each(function(){
	                sequence_qids.push($(this).attr('id').replace("qli"));
	            });
	            $(".marks").trigger("change");
	        });
	      }
	      $(".dragQuestions").sortable("disable");
	    }
	  });
		window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
	});

	//Remove Element from DOM
	$(document).on("click", ".close_section", function(event) {
		event.preventDefault();
	  var $target_qust_sec = $(this).parents('.qust_section');

	  $target_qust_sec.fadeTo(500, 0.01, function(){ 
	    $(this).slideUp(150, function() {
	        $(this).remove();
	        $(".marks").trigger("change");
	    }); 
		});
	});

	$(document).on('click', '.addQuestions', function() {
  	var courses = $("#course").val();
  	$(this).closest('.qust_section').addClass("currentAddQuestions");
  	if(courses.length > 0) {
  		$("#addQustToSection").modal("show");
  		var options = "";
  		// options += '<option value="'+courses.join(",")+'">All</option>';
  		options += '<option value="">-Select Chapter-</option>';
  		$("#course :selected").each(function(key, value) {
  			options += '<option value="'+$(this).val()+'">'+$(this).text()+'</option>';
  		});
  		$("#popChapter").html(options);
  		$("#copy_selected_list").html("");
  		$("#filter_questions").html("");
			$("#empty_selected_list").removeClass("d-none");
			$("#no_qust_display_list_blk").removeClass("d-none");
			$("#qust_display_list_blk").addClass("d-none");
  	} else {
  		$("#addQustToSection").modal("hide");
  		AlertMessage("Please select Chapters");
  	}
  });

  $(".loadQuestions").change(function() {
		$("#no_qust_display_list_blk").addClass("d-none");
		$("#qust_display_list_blk").removeClass("d-none");
		var course = $("#popChapter").val();
		var qtype = $("#popQtype").val();
		var qcategory = $("#popQCategory").val();
		var difficulty = $("#popDifficulty").val();
		$.ajax({
      url:"../QuestionBank/apis/questions_apis.php",
      method:'POST',
      data: "type=filterQuestions&course_id="+course+"&category="+qcategory+"&difficulty="+difficulty + "&qtype="+qtype,
      success:function(data)
      {
          var json = $.parseJSON(data);
          if(json.status){
        		$("#filter_questions").html(json.LOQ);
        		// QuestionsList = json.Result;
        		$.each(json.Result, function(key, value) {
        			QuestionsList.push(value);
        		});
        		//$("#selected_questions").html("");
          } else {
          	AlertMessage(json.message);
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

	$(document).on('change', '.qust_list', function() {
		
		if($(this).prop("checked")) {
			var divHTML = $(this).parent().parent().parent().html();
			$(this).parent().parent().parent().fadeOut().remove();
			divHTML = '<div class="card bg-transparent mb-3">' + divHTML + '</div>';
			//If no data
			$("#empty_selected_list").addClass("d-none");
			$("#copy_selected_list").append(divHTML);
			/*if($("#copy_selected_list").html().trim().length == 0) {
				$("#copy_selected_list").html(divHTML);
				$(this).prop("checked", true);
			} else {
				$("#copy_selected_list").append(divHTML);
			}*/
			$('span#copy_selected_list input[type=checkbox]').each(function() {
				$(this).prop("checked", true);
			});
		} else {
			var divHTML = $(this).parent().parent().parent().html();
			$(this).parent().parent().parent().fadeOut().remove();
			divHTML = '<div class="card bg-transparent mb-3">' + divHTML + '</div>';
			//If no data
			if($("#filter_questions").children().hasClass("empty")) {
				$("#filter_questions").html(divHTML);
			} else {
				$("#filter_questions").append(divHTML);
			}
			if($("#copy_selected_list").html().trim().length == 0) {
				$("#empty_selected_list").removeClass("d-none");
			}
			$('div#filter_questions input[type=checkbox]').each(function() {
				$(this).prop("checked", false);
			});
		}
	});

	$("#addQuestionsSave").click(function() {
		var selectedQuestions = [];
		$('input[name="questions[]"]:checked').each(function() {
		   selectedQuestions.push(this.value);
		});
		$("#addQustToSection").modal("hide");
		//Display in QP Screen
		var html = "";
		var questions_string = selectedQuestions.join(",");

		$.each(selectedQuestions, function(key, value){
			var qid = value;
			html += `<li class="w-100 mb-3 move_question_option" id="qli`+qid+`">
				<div class="d-flex position-relative">
					<div class="section_qust mr-5">`;
			var completeQuestion;
			$.each(QuestionsList, function(key, question) {
				if(question.QuestionID == qid) {
					completeQuestion = question;
				}
			});
			html += completeQuestion.viewQuestionQP;
			html += "</div>";
			html += `<div class="d-flex ml-5">
						<p class="mb-0 tot_sec_mark_labe1 mr-5" style="	width: 55px"></p>
						<div class="position-relative">
							<div class="d-flex align-items-center">
							  <input type="text" name="marks[`+qid+`]" class="form-control text-center marks" style="max-width: 60px" value="1">

							  <img src="../../assets/images/common/icon_more_option.png" class="ml-3 more_option tooltip_options" data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>
	                <li class='media align-items-center mb-3 move_qust_option move_option' aria-qustid='qust`+qid+`' role='button' >
	                  <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
	                  <div class='media-body'>
	                    <p class='mb-0 txt-light-black text-left'>Move</p>
	                  </div>
	                </li>
	                <li class='media align-items-center deleteQust' role='button' id='deleteQust@`+qid+`'>
	                  <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
	                  <div class='media-body'>
	                    <p class='mb-0 txt-light-black text-left'>Delete</p>
	                  </div>
	                </li>
	              </ul>" data-placement="bottom">
							</div>
						</div>
					</div>`;
				html += "</div></li>";
		});
		$(".currentAddQuestions").find(".saved_selected_qust").append(html);
		var cquestions = $(".currentAddQuestions").find(".section_question_ids").val();
		if(cquestions.length > 0) {
			cquestions += "," + questions_string;
		} else {
			cquestions = questions_string;
		}
		$(".currentAddQuestions").find(".section_question_ids").val(cquestions);
		$(".qust_section").removeClass("currentAddQuestions");
		$(".marks").trigger("change");

		/** start more options tooltip logic **/
		var hasToolTip = $(".tooltip_options");

		hasToolTip.on("click", function(e) {
			console.log("cameeeee");
		  e.preventDefault();
		  if(hasToolTip.tooltip('hide'))
		  	$(this).tooltip('show');
		  else
		  	$(this).tooltip('hide');
		}).tooltip({
		  animation: true,
		  trigger: "manual",
		});

		$('body').on('click', function(e) {
		  var $parent = $(e.target).closest('.tooltip_options');
		  if ($parent.length) {
		   hasToolTip.not($parent).tooltip('hide');
		  }
		  else{
		    hasToolTip.tooltip('hide');
		  }

		  var disabled = $(".accordionClass").sortable( "option", "disabled" );
		  ////console.log("disabled status - ", disabled);
		  if (!disabled) {
		  	////console.log("cameeeeeeeee");
		  	$(".accordionClass").sortable("disable");
	  	}
	  	if(moveactivequestion != "")
	  		$("#"+moveactivequestion).removeClass("enablemoveQuestion");
			

		});
		/** end more options tooltip logic **/
	});

	var dragging_question = false;
  $(".dragQuestions" ).sortable({
    connectWith: ".dragQuestions",
    start: function( event, ui ) {
      dragging_section = true;
      ui.item.startPos = ui.item.index();
    },
    stop: function(event, ui) {
      var start_pos = ui.item.startPos;
      var new_pos = ui.item.index();
      if(start_pos !== new_pos) {

        $("#"+moveactivequestion).removeClass("enablemoveQuestion");
        $(this).closest('.dragQuestions').each(function() {
            var sequence_qids = []
            $(this).find(".move_question_option").each(function(){
                sequence_qids.push($(this).attr('id').replace("qli"));
            });
            $(".marks").trigger("change");
        });
      }
      $(".dragQuestions").sortable("disable");
    }
  });
  $(".dragQuestions").click(function(mouseEvent){
      if (!dragging_question) {
          console.log($(this).attr("id"));
      } else {
          dragging_question = false;
      }
  });

  $(".dragQuestions").sortable("disable");
	$(document).on("click", ".move_qust_option", function () {
		//console.log("cameeeeee ---", $(this).attr("aria-sectioncardid"));
		var id = $(this).attr("aria-qustid").replace("qust", "");
		moveactivequestion = "qli" + id;
		$(".dragQuestions").sortable("enable");

		$("#qli"+id).addClass("enablemoveQuestion");
	});

	$(document).on("change", ".marks", function() {
		var qp_marks = 0;
		console.log("CAME");
		$(".tot_sec_mark").each(function() {
			var section_marks = 0;
			var section_qids = [];
			$(this).parent().parent().parent().parent().parent().find(".marks").each(function() {
				var attrName = this.name;
				var thisQID = attrName.replace("marks[","").replace("]","");
				section_qids.push(thisQID);
				section_marks += Number($(this).val());
			});
			qp_marks += section_marks;
			$(this).html(section_marks);
			$(this).parent().parent().find(".section_question_ids").val(section_qids.join(","));
		});
		$("#total_marks").val(qp_marks);
	});

	$(document).on("click", ".deleteQust", function() {
		var delID = $(this).attr("id");
		var temp = delID.split("@");
		var qid = temp[1];
		$("#qli"+qid).fadeOut().remove();
		$(".marks").trigger("change");
	});

  function AlertMessage(message) {
  	$("#sb_body").html(message);
  	$("#sb_heading").html("Notice!");
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
  }

  $("#QBSave").click(function() {
		var formData = new FormData();
		
		if($("#title").val() == "") {
			AlertMessage("Please enter Title");
			return;
		}		
		if($("#selectedClass").val() == "") {
			AlertMessage("Please select Class");
			return;
		}
		if($("#selectedSubject").val() == "") {
			AlertMessage("Please select Subject");
			return;
		}
		if($("#course").val() == "") {
			AlertMessage("Please select Chapter");
			return;
		}

		if($("#time_allowed").val() == "") {
			AlertMessage("Please enter Time Allowed");
			return;
		}
		if($("#total_marks").val() == "" || $("#total_marks").val() == "0") {
			AlertMessage("Total Marks cannot be 0. Please enter marks for individual questions");
			return;
		}

		$("#create_qust_paper_blk input").each(function() {
			console.log(this.name, this.value);
			formData.append(this.name, this.value);
		});

		$("#create_qust_paper_blk select").each(function() {
			console.log(this.name, this.value);
			if(this.name != "course[]")
				formData.append(this.name, this.value);
		});

		console.log($("#course").val());
		formData.append("course[]", $("#course").val());

		$("#add_section_blk input").each(function() {
			console.log(this.name, this.value);
			formData.append(this.name, this.value);
		});
		formData.append('type', "saveQuestionPaper");
    $.ajax({
        url:"../QuestionBank/apis/questions_apis.php",
        method:'POST',
        data:formData,
				contentType:false,
				processData:false,
        success:function(data)
        {
          var json = $.parseJSON(data);
          if(json.status) {
          	if(document.getElementsByName("courseName").length>0) {
          		var classE = $("#classCodeEnc").val();
          		var subE = $("#selectedSubjectEnc").val();
          		document.location="AWsheet.php?classCode="+classE+"&subjectID="+subE;
          	}
          	else if(document.getElementsByName("quiz_id").length<=0) {
						  document.location="QuestionPaper.php";
						} else {
							document.location="ViewQuestionPaper.php";
						}
          } else {
          	AlertMessage(json.message);
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