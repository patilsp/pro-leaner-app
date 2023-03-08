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
    $("#selectedClass").trigger("change");
	/** ------------------Start Descriptive------------------------- */
	$("form#descriptive-qust-img-upload-form").change(function (event) {
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
					$("#shotQustImg").append("<div class='form-check d-flex mr-3 mb-3'><img src='"+src+"' style='max-width: 150px; width: 100%'><span class='close_ip'></span></div>");
				}
			}
		}); 
		return false;
	});

	$(".Keyword_input_box").bind('keydown', function () {
    $(this).attr("size", Math.max(10,$(this).val().length) );
	});
	$("#add_keyword").click(function(){
		$("#id_keyword").append("<div class='mr-3 mb-4 position-relative keyword_ip'> <input type='text' name='sa_keyword[]' size='10' placeholder='Type here' value='' class='form-control Keyword_input_box'> <span class='close_ip'></span> </div>");
		window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });

		$(".Keyword_input_box").bind('keydown', function () {
	    $(this).attr("size", Math.max(10,$(this).val().length) );
		});
	});
	/** ------------------End Descriptive------------------------- */

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
		if($("#category").val() == "") {
			AlertMessage("Please select Category");
			return;
		}
		if($("#difficulty").val() == "") {
			AlertMessage("Please select difficulty");
			return;
		}
		if($("#qtype").val() == "") {
			AlertMessage("Please select Type of Question");
			return;
		}
		var qtype = $("#qtype").val();
		if(qtype == "multichoice") {
			var question = $("#multichoice_qustediter").val();
			if($($.parseHTML(question)).text().trim() == "") {
				AlertMessage("Please enter Question Text");
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
	    	AlertMessage("Please select/enter Options");
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
	    	AlertMessage("Please select Correct Answer");
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
				AlertMessage("Please enter Question Text");
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
	    	AlertMessage("Please select/enter Options");
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
	    	AlertMessage("Please select Correct Answer");
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
				AlertMessage("Please enter Question Text");
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
				$(".option_id").each(function() {
		    	formData.append("oid[]", $(this).val());
		    });
	    });
	    if(no_of_options == 0) {
	    	AlertMessage("Please select/enter Options");
	    	return;
	    }
	    formData.append("qid", $("#qid").val());
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
	    formData.append("qid", $("#qid").val());
	    $(".option_id").each(function() {
	    	formData.append("oid[]", $(this).val());
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