<div class="col-12 px-0" id="create_qust_paper_blk">
	<form id="s1filterform" class="w-100 px-4">
		<div class="row">
			<div class="form-group col-6">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" id="title" name="title" value="<?php echo $quizInfo['title']; ?>" placeholder="Type here">
		    <input type="hidden" name="quiz_id" id="quiz_id" value="<?php echo $quizInfo['id']; ?>">
		    <input type="hidden" name="selectedSubject" id="selectedSubject" value="<?php echo $quizInfo['subject_id']; ?>">
		  </div>
		  <div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="course">Chapter</label>
		    <select class="form-control w-100" id="course" name="course" multiple="multiple">
      		<option value="">-Select Chapter-</option>
		    </select>
		  </div>
		  <div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="qpDifficulty">Difficulty</label>
		    <select class="form-control" id="qpDifficulty" name="qpDifficulty">
      		<option value="">-Select Question Paper Difficulty-</option>
		    </select>
		  </div>
	  </div>

		<div class="row">
			<div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="time_allowed">Time allowed (in hrs)</label>
		    <input type="text" class="form-control" id="time_allowed" name="time_allowed" placeholder="Type Value" value="<?php echo $quizInfo['time_allowed']; ?>">
		  </div>

	   	<div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="total_marks">Total Marks</label>
		    <input type="text" class="form-control" id="total_marks" name="total_marks" disabled="disabled" placeholder="0">
		  </div>

		  <div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="qust_paper_code">Question Paper Code</label>
		    <input type="text" class="form-control" id="qust_paper_code" name="qust_paper_code"placeholder="Type Value" value="<?php echo $quizInfo['intro']; ?>" >
		  </div>

		  <div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="qust_paper_code">No. of Attempts</label>
		    <select class="form-control" id="attempts" name="attempts">
		    	<option value="1">1</option>
		    	<option value="2">2</option>
		    	<option value="3">3</option>
		    	<option value="4">4</option>
		    	<option value="5">5</option>
		    	<option value="0">Unlimited</option>
		    </select>
		  </div>
		</div>

	  <hr/>
	</form>    
</div>