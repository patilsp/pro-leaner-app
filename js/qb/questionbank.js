$(document).ready(function() {

    $('.multiselect').select2();
      
	$("#CancelSave").addClass("d-none");

	$("#upload_qust_btn").click(function(){
		$("#addupload_qust_blk").removeClass("d-none").addClass("d-none");
		$(".header_cancel_btn, #upload_qust_blk").removeClass("d-none");
	});
	$(".header_cancel_btn").click(function () {
		$(this).removeClass("d-none").addClass("d-none");
		$("#upload_qust_blk, #import_excel_form").removeClass("d-none").addClass("d-none");
		$("#addupload_qust_blk, #upload_lable").removeClass("d-none");
	});

	$("#add_qust_btn").click(function() {
		$("#addupload_qust_blk").addClass("d-none");
		$("#add_qust_blk").removeClass("d-none");
		$("#CancelSave").removeClass("d-none");
        $("#QBCancel").removeClass("d-none");
	});

	$("#upload_qust_btn").click(function() {
		$("#addupload_qust_blk").addClass("d-none");
		$("#upload_qust_blk").removeClass("d-none");
	});

	$("#QBCancel-new").click(function() {
		// $("#CancelSave").addClass("d-none");
		// $("#add_qust_blk").addClass("d-none");
		// $("#upload_qust_blk").addClass("d-none");
		// $("#addupload_qust_blk").removeClass("d-none");
        location.reload(true);
	});
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

	$("#selectedClass_filter").on("change", function() {

        var id = $(this).val();
        $.ajax({
            url:"../content/apis/getSubject.php",
            method:'POST',
            data: "classcode="+ id +"&type=getSubject",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status){
            		$("#selectedSubject_filter").html(json.subject);
                    // $("#selectedSubject_filter").trigger("change");
                    $("#course_filter").html('<option value="">-Select Chapter Topic-</option>');
                    $("#topic_filter").html('<option value="">-Select  Topic-</option>');
                    $("#subtopic_filter").html('<option value="">-Select Sub Topic-</option>');
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

	$("#selectedSubject_filter").on("change", function() {
        var id = $(this).val();
        $.ajax({
            url:"apis/questions_apis.php",
            method:'POST',
            data: "subject_id="+ id +"&type=getCourses",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
            		$("#course_filter").html(json.Result);
                 
                    $("#topic_filter").html('<option value="">-Select  Topic-</option>');
                    $("#subtopic_filter").html('<option value="">-Select Sub Topic-</option>');
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

    $("#course_filter").on("change", function() {
        var id = $(this).val();
        $.ajax({
            url:"apis/questions_apis.php",
            method:'POST',
            data: "courseid="+ id +"&type=getTopics",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
                    $("#topic_filter").html(json.Result);
                    $("#subtopic_filter").empty();
                    $("#subtopic_filter").html('<option value="">-Select Sub Topic-</option>');
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
    $("#topic_filter").on("change", function() {
        var id = $(this).val();
        $.ajax({
            url:"apis/questions_apis.php",
            method:'POST',
            data: "topicid="+ id +"&type=getSubTopics",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
                    $("#subtopic_filter").html(json.Result);
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
    const el = document.getElementById("multichoice_qustediter");
    el.focus()
    let char = 1, sel; // character at which to place caret

    if (document.selection) {
    sel = document.selection.createRange();
    sel.moveStart('character', char);
    sel.select();
    }
    else {
    sel = window.getSelection();
    sel.collapse(el.lastChild, char);
    }
});