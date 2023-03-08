$(function(){
	$(document).on('click', '#delete_qust_yes', function() {
      var qid = $("#delete_qid").val();
      $.ajax({
        url:"apis/questions_apis.php",
        method:'POST',
        data: "qid="+qid+"&type=deleteQuestion",
        success:function(data)
        {
            $("#delteQustModal").modal("hide");
            var json = JSON.parse(data);
            AlertMessage(json.message);
            if(json.status) {
                loadQuestions(courseid);
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