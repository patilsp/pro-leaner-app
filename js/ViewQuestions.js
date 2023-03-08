$(document).ready(function() {
	$(document).on('click', '.viewQuestion', function() {
		var qid = $(this).data('id');
		$.each(QuestionsList, function(key, question) {
			if(question.QuestionID == qid) {
				$("#displayQuestion").html(question.viewQuestion);
				$("#displayChapterName").html(question.QuestionCourseName);
				$("#displayQuestionType").html(question.qtypeDescription);
				$("#displayQuestionCategory").html(question.QuestionCategory);
				$("#displayDifficulty").html(question.QuestionDifficulty);
			}
		});
	});
});