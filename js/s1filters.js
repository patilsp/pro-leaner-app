var courseid;
$(document).ready(function() {
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
                    $("#selectedSubject").trigger("change");
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
    $(document).on('submit', '#s1filterform', function(event){
      event.preventDefault();
      var vh = "Class " + $("#selectedClass option:selected" ).text();
      vh += " - " + $("#selectedSubject option:selected" ).text();
      vh += " - " + $("#course option:selected" ).text();
      var classes = $("#selectedClass").val();
      var subject = $("#selectedSubject").val();
      var courseid = $("#course").val();
      var topic = $("#topic").val();
      var subtopic = $("#subtopic").val();
      $("#filter_heading").html(vh);
    //   $("#viewedit_qust_blk").addClass("d-none");
    //   $("#viewedit_qust_list").removeClass("d-none");
    //   $(".header_cancel_btn").removeClass("d-none");
      loadQuestions(classes,subject,courseid,topic,subtopic);
  	});

    $(".header_cancel_btn").click(function() {
        $(".header_cancel_btn").addClass("d-none");
        $("#viewedit_qust_list").addClass("d-none");
        $("#viewedit_qust_blk").removeClass("d-none");
        $("#selectedClass").val("");
        $("#selectedSubject").val("");
        $("#course").val("");
    });
});