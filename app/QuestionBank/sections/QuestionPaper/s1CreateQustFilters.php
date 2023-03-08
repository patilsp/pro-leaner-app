<div class="col-12 px-0" id="create_qust_paper_blk">
	<form id="s1filterform" class="w-100 px-4">
		<div class="row">
			<div class="form-group col-12">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" id="title" name="title" placeholder="Type here" required="required">
		  </div>
	  </div>
		
		<div class="row">
			<div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="selectedClass">Class</label>
		    <select class="form-control selectclass" id="selectedClass" name="selectedClass" required>
		      <option value="">-Select Class-</option>
		      <?php
            foreach($Classes as $thisClass) {
          ?>
            <option value="<?php echo $thisClass['id'] ?>"><?php echo $thisClass['code'] ?></option>
          <?php
            }
          ?>
		    </select>
		  </div>

	   	<div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="selectedSubject">Subject</label>
		    <select class="form-control" id="selectedSubject" name="selectedSubject">
      		<option value="">-Select Subject-</option>
		    </select>
		  </div>

		  <div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="course">Chapter</label>
		    <select class="form-control w-100" id="course" name="course[]" multiple="multiple">
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
		    <input type="text" class="form-control" id="time_allowed" name="time_allowed" placeholder="Type Value">
		  </div>

	   	<div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="total_marks">Total Marks</label>
		    <input type="text" class="form-control" id="total_marks" name="total_marks" disabled="disabled" placeholder="0">
		  </div>

		  <div class="form-group col-12 col-sm-6 col-md-3">
		    <label for="qust_paper_code">Question Paper Code</label>
		    <input type="text" class="form-control" id="qust_paper_code" name="qust_paper_code" placeholder="Type Value">
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