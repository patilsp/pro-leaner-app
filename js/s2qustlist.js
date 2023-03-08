$(function () {
	$('#qust_table').DataTable();

	$(document).on('click', '.viewQustModal', function() {
    var qid = $(this).data('id');
    $.ajax({
	    type: "POST",
	    url: "apis/questions_apis.php",
	    data: "qid=" + qid + "&type=viewQuestion",
	    cache: false,
	    success: function(data){
	      data = JSON.parse(data);
	      $("#displayQuestion").html(data.Result.viewQuestion);
      },
      beforeSend: function(){
        $("body").mLoading();
      },
      complete: function(){
        $("body").mLoading('hide');
      }
    });
  });

  $(document).on('click', '.deleteQuestion', function() {

    var qid = $(this).data('id');
    $("#delete_qid").val(qid);
  });
});

function AlertMessage(message) {
  $("#sb_body").html(message);
  $("#sb_heading").html("Notice!");
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
}

function loadQuestions(classes,subject,courseid,topic,subtopic) {
	$.ajax({
    type: "POST",
    url: "apis/questions_apis.php",
    data: "class=" + classes +"&subject=" + subject +"&course_id=" + courseid +"&topic=" + topic+"&subtopic=" + subtopic + "&type=displayQuestions",
    cache: false,
    success: function(data){
      data = JSON.parse(data);
      questionsList = data.Result;
      var table = $('#qust_table').dataTable({
           "bProcessing": true,
           "responsive": true,
           "bDestroy": true,
           "data": data.Result,
           "aoColumns": [
              { mData: 'Subtopic' } ,
              { mData: 'QuestionPureText' },
              { mData: 'qtype2' } ,
              { mData: 'Action' }
            ],
            "aoColumnDefs": [
            	{ "aTargets" : [3], sClass: '' }
            ]
      });
      // new $.fn.dataTable.FixedHeader( table );
      $('.action_tooltip').tooltip({ boundary: 'window' });
    },
    beforeSend: function(){
      $("body").mLoading();
    },
    complete: function(){
      $("body").mLoading('hide');
    }
  });
}
