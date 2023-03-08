var QuestionsList = [];
var moveactivequestion = "";
$(document).ready(function() {
	$('#course').select2({ //apply select2 to my element
    placeholder: "-Select Chapter-",
    closeOnSelect: false
  });

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
            url:"../QuestionBank/apis/questions_apis.php",
            method:'POST',
            data: "subject_id="+ id +"&type=getCourses",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
            		$("#course").html(json.Result);
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
    		//alert("Please select Chapters");
    	}
    });

   loadDefault();
	
	function loadDefault() {
    $.ajax({
      url:"../QuestionBank/apis/questions_apis.php",
      method:'POST',
      data: "type=getQuestionCategoryiesDifficultyAll",
      success:function(data)
      {
          var json = $.parseJSON(data);
          if(json.status){
        		$("#popQCategory").html(json.Result.Category);
        		$("#popDifficulty").html(json.Result.Difficulty);
        		$("#popQtype").html(json.Result.QTypes);
            $("#qpDifficulty").html(json.Result.Difficulty2);
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

  $("#QBCancel").click(function() {
    $("#resetQPModal").modal("show");
  });
});