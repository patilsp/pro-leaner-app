<div class="row align-items-center justify-content-center h-100 py-4" id="viewedit_qust_blk">
	<h4 class="text-center mb-5 text-secondary">Select the class and subject under which you want to View/Edit a Question Paper</h4>
  <form id="s1filterform" class="col-12">
	  <div class="form-group row">
	    <label for="s1Class" class="col-sm-2 col-form-label text-right">Class</label>
	    <div class="col-sm-10">
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
	  </div>
	  <div class="form-group row">
	    <label for="s1Class" class="col-sm-2 col-form-label text-right">Subject</label>
	    <div class="col-sm-10">
      	<select class="form-control" id="selectedSubject" name="selectedSubject">
      		<option value="">-Select Subject-</option>
		    </select>
	    </div>
	  </div>

	  <div class="form-group text-center">
  		<button type="submit" class="btn btn-md btn-blue px-5 shadow mt-4">Go</button>
  	</div>
	</form>    
</div>