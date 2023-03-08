$(document).ready(function(){
	loadDefault();
	
	function loadDefault() {
        $.ajax({
            url:"apis/questions_apis.php",
            method:'POST',
            data: "type=getQuestionCategoryiesDifficulty",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status){
            		$("#category").html(json.Result.Category);
            		$("#difficulty").html(json.Result.Difficulty);
            		$("#category").val(pms_qcategory_id);
            		$("#difficulty").val(pms_difficulty_id);
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

	$("#selectedClass").on("change", function() {
        var id = $(this).val();
        $.ajax({
            url:"../content/apis/getSubject.php",
            method:'POST',
            data: "classcode="+ id +"&type=getSubject",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status){
            		$("#selectedSubject").html(json.subject);
            		$("#selectedSubject").val(subject_id);
            		$("#selectedSubject").trigger("change");
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

	$("#selectedSubject").on("change", function() {
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
            		$("#course").val(course_id);
            		$("#course").trigger("change");
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
    $("#course").on("change", function() {
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
                    $("#topic").val(topic);
                    $("#topic").trigger("change");
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
    $("#topic").on("change", function() {
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
                    $("#subtopic").val(subtopic);
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
	/** ------------------Start MCQ with Multiple Answer------------------------- */
	$("form#qust-checkbox-img-upload-form").change(function (event) {
		event.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url : "apis/uploadImage.php",
			type: 'POST',
			datatype : "JSON",
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				var json = $.parseJSON(data);
				if(json.status) {
					var src = "../"+json.Result;
					$("#macqCheckboxQustImg").append("<div class='form-check d-flex mr-3 mb-3'><img src='"+src+"' style='max-width: 150px; width: 100%'><span class='close_ip'></span></div>");
				}
			},
      beforeSend: function(){
        $("body").mLoading()
      },
      complete: function(){
        $("body").mLoading('hide')
      }
		}); 
		return false;
	});

	$("#add_macqCheckbox_text").click(function(){
		$("#mcq_checkbox_options").append("<div class='col-12 col-sm-6 col-md-6 mb-4 text_opt'> <div class='form-check d-flex align-items-center'> <input class='form-check-input' type='checkbox' name='mcCheckBox' value='option2'> <label class='form-check-label w-100 pl-1'> <input type='text' name='answerm[]' placeholder='Type here' value='' class='form-control border-0 mcmanswer'> </label> <span class='close_ip'></span></div></div>");
		window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
	});
	$("form#mcmopt-img-upload-form").change(function (event) {
		event.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url : "apis/uploadImage.php",
			type: 'POST',
			datatype : "JSON",
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				var json = $.parseJSON(data);
				if(json.status) {
					var src = "../"+json.Result;
					$("#mcq_checkbox_options").append("<div class='col-12 col-sm-6 col-md-6 mb-4 img_opt'> <div class='form-check d-flex'> <input class='form-check-input' type='checkbox' name='mcCheckBox' value='option2'> <label class='form-check-label w-100 pl-1 d-flex justify-content-center'> <input type='hidden' name='answerm[]' placeholder='Type here' class='mcmanswer' value=\"<img src='"+src+"' style='max-width: 150px; width: 100%'>\"> <img src='"+src+"' style='max-width: 150px; width: 100%'> </label> <span class='close_ip'></span></div></div>");
					window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
				}
			}
		}); 
		return false;
	});
	/** ------------------End MCQ with Multiple Answer------------------------- */


	//Remove Element from DOM
	$(document).on("click", ".close_ip", function(event) {
		event.preventDefault();
	  var $target = $(this).parents('.img_opt');
	  var $target_text_opt = $(this).parents('.text_opt');
	  var $target_qust_img = $(this).parents('.form-check');
	  var $target_keyword_ip = $(this).parents('.keyword_ip');
	  var $target_math_following_ip = $(this).parents('.li_qust_ans');

	  $target_qust_img.fadeTo(500, 0.01, function(){ 
	    $(this).slideUp(150, function() {
	        $(this).remove(); 
	    }); 
		});

	  $target.fadeTo(500, 0.01, function(){ 
	    $(this).slideUp(150, function() {
	        $(this).remove(); 
	    }); 
		});

		$target_text_opt.fadeTo(500, 0.01, function(){ 
	    $(this).slideUp(150, function() {
	        $(this).remove(); 
	    }); 
		});

		$target_keyword_ip.fadeTo(500, 0.01, function(){ 
	    $(this).slideUp(150, function() {
	        $(this).remove(); 
	    }); 
		});

		$target_math_following_ip.fadeTo(500, 0.01, function(){ 
	    $(this).slideUp(150, function() {
	        $(this).remove(); 
	    }); 
		});
	});
	$("#selectedClass").trigger("change");

	//Save Question
	function AlertMessage(message) {
  	$("#sb_body").html(message);
  	$("#sb_heading").html("Notice!");
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
  }
	$("#QBSave").click(function() {
		var formData = new FormData();
		if($("#selectedClass").val() == "") {
			alert("Please select Class");
			return;
		}
		if($("#selectedSubject").val() == "") {
			alert("Please select Subject");
			return;
		}
		if($("#course").val() == "") {
			alert("Please select Chapter");
			return;
		}
		if($("#category").val() == "") {
			alert("Please select Category");
			return;
		}
		if($("#difficulty").val() == "") {
			alert("Please select difficulty");
			return;
		}
		if($("#qtype").val() == "") {
			alert("Please select Type of Question");
			return;
		}
		var qtype = $("#qtype").val();
		if(qtype == "multichoice") {
			var question = $("#multichoice_qustediter").val();
			if($($.parseHTML(question)).text().trim() == "") {
				alert("Please enter Question Text");
				return;
			}
			no_of_options = 0;
			formData.append("questiontext", question);
			$(".multichoice :input[name='answer[]']").each(function() {
				if(this.value.trim().length > 0) {
					no_of_options++;
	      	formData.append(this.name, this.value.trim());
				}
	    });
	    if(no_of_options == 0) {
	    	alert("Please select/enter Options");
	    	return;
	    }
	    var correctAnswerSelected = 0;
	    $(".multichoice :input[type='radio'][name='mcRadios']").each(function() {
	    	var radio_text = $(this).parent().find('.mcanswer').val();
	    	if(radio_text.trim().length > 0) {
		    	if($(this).is(":checked")) {
		    		correctAnswerSelected = 1;
		    		formData.append("fraction[]", 1);
		    	} else {
		    		formData.append("fraction[]", 0);
		    	}
	    	}
	    });
	    if(correctAnswerSelected == 0) {
	    	alert("Please select Correct Answer");
	    	return;
	    }
	    //Add Existing Option Ids
	    $(".option_id").each(function() {
	    	formData.append("oid[]", $(this).val());
	    });
	    formData.append("qid", $("#qid").val());
		} else if(qtype == "multichoicem") {
			var question = $("#multichoicem_qustediter").val();
			if($($.parseHTML(question)).text().trim() == "") {
				alert("Please enter Question Text");
				return;
			}
			no_of_options = 0;
			formData.append("questiontext", question);
			$(".multichoicem :input[name='answerm[]']").each(function() {
				if(this.value.trim().length > 0) {
					no_of_options++;
	      	formData.append("answer[]", this.value.trim());
				}
	    });
	    if(no_of_options == 0) {
	    	alert("Please select/enter Options");
	    	return;
	    }
	    var correctAnswerSelected = 0;
	    $(".multichoicem :input[type='checkbox'][name='mcCheckBox']").each(function() {
	    	var radio_text = $(this).parent().find('.mcmanswer').val();
	    	if(radio_text.trim().length > 0) {
		    	if($(this).is(":checked")) {
		    		correctAnswerSelected = 1;
		    		formData.append("fraction[]", 1);
		    	} else {
		    		formData.append("fraction[]", 0);
		    	}
	    	}
	    });
	    if(correctAnswerSelected == 0) {
	    	alert("Please select Correct Answer");
	    	return;
	    }
	    //Add Existing Option Ids
	    $(".option_id").each(function() {
	    	formData.append("oid[]", $(this).val());
	    });
	    formData.append("qid", $("#qid").val());
		} else if(qtype == "ddmatch") {
			var question = $("#ddmatch_qustediter").val();
			if($($.parseHTML(question)).text().trim() == "") {
				alert("Please enter Question Text");
				return;
			}
			formData.append("questiontext", question);
			no_of_options = 0;
			$(".subquestiontext").each(function() {
				console.log("CAME Inside");
				//Get nearest option value
				var ans_text = $(this).parent().find('.answertext').val().trim();
				if(this.value.trim().length > 0 && ans_text.length == 0) {
					AlertMessage("Please enter Answer");
					$(this).focus();
					return;
				}
				if(this.value.trim().length > 0 || ans_text.length > 0) {
					no_of_options++;
	      	formData.append("subquestiontext[]", this.value.trim());
	      	formData.append("answer[]", ans_text);
				}
	    });
	    if(no_of_options == 0) {
	    	alert("Please select/enter Options");
	    	return;
	    }
		} else if(qtype == "shortanswer") {
			var question = $("#shortanswer_qustediter").val();
			if($($.parseHTML(question)).text().trim() == "") {
				AlertMessage("Please enter Question Text");
				return;
			}
			formData.append("questiontext", question);
			no_of_options = 0;
			var canswer = $("#shortanswer_answer").val().trim();
			if(canswer.length == 0) {
				AlertMessage("Please enter Correct Answer");
				return;
			} else {
				formData.append("answer[]", canswer);
				formData.append("fraction[]", 1);
			}

			//Add Keywords
			$(".Keyword_input_box").each(function() {
				if(this.value.trim().length > 0) {
					no_of_options++;
	      	formData.append("answer[]", this.value.trim());
	      	formData.append("fraction[]", 1);
				}
	    });
		}
		$(".card-body select").each(function() {
			formData.append(this.name, this.value);
		});
    formData.append('type', "saveQuestion");
    formData.append('buttontype', "editQuestion");
    $.ajax({
        url:"apis/questions_apis.php",
        method:'POST',
        data:formData,
				contentType:false,
				processData:false,
        success:function(data)
        {
          var json = $.parseJSON(data);
          if(json.status) {
          	//Redirect to Home Page
        		document.location = "ViewQuestions.php";
          } else {
          	AlertMessage(json.message);
          }
        },
        beforeSend: function() {
          $("body").mLoading()
        },
        complete: function(){
          $("body").mLoading('hide')
        }
    });
	});
});