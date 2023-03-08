<?php 

  include "functions/common_function.php";
  $classList = getCPClasses();

?>

<div class="row align-items-center justify-content-center h-100 d-none" id="add_qust_blk">
	
	<div class="col-12 p-0 h-100">
		<div class="card border-0">
		  <div class="card-header bg-white">
		    <h5 class="font-weight-bold m-0">Add a Question</h5>
		  </div>
		  
		  <div class="card-body">
		    <div class="row">
		    	<div class="form-group col-12 col-sm-6 col-md-4 mb-4">
				    <label for="selectedClass" class="font-weight-bold required">Class</label>
				    <select class="form-control selectclass" id="selectedClass" name="selectedClass" required>
				      <option value="">-Select Class-</option>
					  <?php foreach ($classList["classes"] as $key=>$classValue){ ?>
                        <option value="<?php echo $classValue['id']; ?>"><?php echo $classValue['module'];?></option>
                        <?php } ?>
				    </select>
				  </div>

				  <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
				    <label for="selectedSubject" class="font-weight-bold">Subject</label>
				    <select class="form-control" id="selectedSubject" name="selectedSubject">
				      <option value="">-Select Subject-</option>
				    </select>
				  </div>

				  <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
				    <label for="course" class="font-weight-bold">Chapter</label>
				    <select class="form-control" id="course" name="course">
				      <option value="">-Select Chapter-</option>
				    </select>
				  </div>

				  <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
				    <label for="category" class="font-weight-bold">Question Category</label>
				    <select class="form-control" id="category" name="category">
				      <option value="">-Select Category-</option>
				    </select>
				  </div>

				  <div class="form-group col-12 col-sm-6 col-md-4 mb-4">
				    <label for="difficulty" class="font-weight-bold">Difficulty of Question</label>
				    <select class="form-control" id="difficulty" name="difficulty">
				      <option value="">-Select Difficulty-</option>
				    </select>
				  </div>
		    </div>
		    <hr/>
		    <div class="row">
		    	<div class="col-12">
			    	<div class="form-group mt-3" style="max-width: 400px">
					    <label for="qtype_opt" class="font-weight-bold">Type of Question</label>
					    <select class="form-control qtype" id="qtype" name="qtype">
					      <option value="">-Select type-</option>
					      <option value="multichoice">MCQ with Single Answer </option>
					      <option value="multichoicem">MCQ with Multiple Answers</option>
					      <!-- <option value="3">Fill in the Blanks</option> -->
					      <option value="shortanswer">Descriptive</option>
					      <option value="ddmatch">Match the Following</option>
					    </select>
					  </div>
				  </div>

				  <!-- ***************** Start fill_blank_section ******************-->
				  <div class="col-12 d-none fillblank questionDetail" id="fill_blank_section">
			    	<div class="form-group">
					    <label for="qust_txt" class="font-weight-bold">Question</label>
					    <div class="container p-0" id="QustEditer_blk">
			    			<h6 class="p-2" contenteditable="true" placeholder="enter text here..." id="QustEditer">qwdwqedwqe
		    				<span style="padding: 0px 50px; border-bottom: 1px solid; position: relative; margin: 0px 1rem"><span class="close_ip"></span></span>
		    				edewdwe</h6>
			    			
			    			<button class="btn btn-md border-0 bg-grey position-absolute ml-2 mb-2" contenteditable="false" id="ins_blank_btn">Insert Blank</button>
				    	</div>

				    	<div id="caretposition">0</div>
					  </div>
				  </div>
				  <!-- ***************** End fill_blank_section ******************-->

				  <!-- ***************** Start MCQ with Single Answer ******************-->
				  <div class="col-12 d-none multichoice questionDetail" id="mcq_radio_section">
			    	<div class="form-group">
					    <label for="qust_txt" class="font-weight-bold">Question</label>
					    <div class="container p-2 QustEditer_blk">
			    			<!-- <div class="QustEditer" id="multichoice_qustediter" name="questiontext" contenteditable="true" placeholder="enter text here...">
			    				<br />
			    				<div class="row mt-4 mx-2 QustImg" id="macqRadioQustImg" contenteditable="false"></div>
			    			</div> -->
		    				
		    				<form id="qust-img-upload-form" contenteditable="false">
		    					<input id="qust-img-upload" name="file" type="file" accept="image/*"/>
		    				</form>

			    			<label class="btn btn-md border-0 bg-grey mt-3 ml-2 mb-2" contenteditable="false" for="qust-img-upload"> Upload Image</label>

			    			<hr/>
								<label > Question:</label>
								<textarea class="form-control textarea_custom" id="multichoice_qustediter" name="questiontext" rows="4" cols="50" required="required"></textarea>                      
			    			<hr/>

			    			<header class="w-100 mb-4 d-flex align-items-center">
			            <h5 class="flex-grow-1">Add the choices and mark the correct answer </h5>

			            <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium mr-4" id="add_macqRadio_text">Add Text Choice</button>
			            <form id="mcopt-img-upload-form" contenteditable="false">
			    					<input id="mcopt-img-upload" name="file" type="file" accept="image/*"/>
			    				</form>
		              <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium" id="add_macqRadio_img"><label class="mb-0" for="mcopt-img-upload">Add Image Choice</label></button>
			          </header>
			          <div class="row" contenteditable="false" id="mcq_radio_options">
		    					
		    				</div>
				    	</div>
					  </div>
				  </div>
				  <!-- ***************** End MCQ with Single Answer ******************-->

				  <!-- ***************** Start MCQ with Multiple Answer ******************-->
				  <div class="col-12 d-none multichoicem questionDetail" id="mcq_Checkbox_section">
			    	<div class="form-group">
					    <label for="qust_txt" class="font-weight-bold">Question</label>
					    <div class="container p-2 QustEditer_blk">
			    			<!-- <div class="QustEditer" id="multichoicem_qustediter" contenteditable="true" placeholder="enter text here...">
			    				<br/>
			    				<div class="row mt-4 mx-2 QustImg" id="macqCheckboxQustImg" contenteditable="false"></div>
			    			</div> -->
		    				
		    				<form id="qust-checkbox-img-upload-form" contenteditable="false">
		    					<input id="qust-checkbox-img-upload" name="file" type="file" accept="image/*"/>
		    				</form>

			    			<label class="btn btn-md border-0 bg-grey mt-3 ml-2 mb-2" contenteditable="false" for="qust-checkbox-img-upload"> Upload Image</label>

			    			<hr/>
								<label > Question:</label>
								<textarea class="form-control textarea_custom" id="multichoice_qustediter" name="questiontext" rows="4" cols="50" required="required"></textarea>                      
			    			<hr/>

			    			<header class="w-100 mb-4 d-flex align-items-center">
			            <h5 class="flex-grow-1">Add the choices and mark the correct answer </h5>

			            <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium mr-4" id="add_macqCheckbox_text">Add Text Choice</button>
			            <form id="mcmopt-img-upload-form" contenteditable="false">
			    					<input id="mcmopt-img-upload" name="file" type="file" accept="image/*"/>
			    				</form>
		              <button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium" id="add_macqCheckbox_img"><label for="mcmopt-img-upload">Add Image Choice</label></button>
			          </header>
			          <div class="row" contenteditable="false" id="mcq_checkbox_options">
		    					
		    				</div>
				    	</div>
					  </div>
				  </div>
				  <!-- ***************** End MCQ with Multiple Answer ******************-->

				  <!-- ***************** Start Descriptive ******************-->
				  <div class="col-12 d-none shortanswer questionDetail" id="descriptive_section">
			    	<div class="form-group">
					    <label for="qust_txt" class="font-weight-bold">Question</label>
					    <div class="container p-2 QustEditer_blk">
			    			<!-- <div class="QustEditer" id="shortanswer_qustediter" contenteditable="true" placeholder="enter text here...">
			    				<br/>
			    				<div class="row mt-4 mx-2 QustImg" id="shotQustImg" contenteditable="false"></div>
			    			</div> -->
		    				
		    				<form id="descriptive-qust-img-upload-form" contenteditable="false">
		    					<input id="descriptive-qust-img-upload" name="file" type="file" accept="image/*"/>
		    				</form>

			    			<label class="btn btn-md border-0 bg-grey mt-3 ml-2 mb-2" contenteditable="false" for="descriptive-qust-img-upload"> Upload Image</label>
			    			<hr/>
								<label > Question:</label>
								<textarea class="form-control textarea_custom" id="shortanswer_qustediter" name="questiontext" rows="4" cols="50" required="required"></textarea>                      
			    			<hr/>
		    			</div>
					  </div>

					  <div class="form-group">
					    <label for="qust_txt" class="font-weight-bold my-2">Answer Key</label>
					    <div class="position-relative p-2 answer_key">
			    			<textarea class="form-control" placeholder="Please type the correct answer" id="shortanswer_answer" name="shortanswer_answer" rows="3"></textarea>

			    			<label class="font-weight-bold mt-4 mb-4">Keywords</label>
			    			<div class="d-flex flex-wrap" id="id_keyword">
			    				<div class="mr-3 mb-4 position-relative keyword_ip">
								    <input type="text" size='10' name="sa_keyword[]" placeholder="Type here" value="" class="form-control Keyword_input_box">
								  </div>
							  </div>
							  <div class="d-flex">
							  	<button type="button" class="btn btn-md btn-success px-3 border-0 font-weight-medium mr-4" id="add_keyword">Add</button>
						  	</div>
		    			</div>
					  </div>
				  </div>
				  <!-- ***************** End Descriptive ******************-->

				  <!-- ***************** Start Match the Following ******************-->
				  <div class="col-12 d-none ddmatch questionDetail" id="match_section">
			    	<div class="form-group">
					    <label class="font-weight-bold">Question Title</label>
					    <textarea class="form-control" id="ddmatch_qustediter" name="ddmatch_qustediter" placeholder="Type here" rows="1"></textarea>
				    </div>

				    <div class="form-group w-100 mx-auto" id="match_qust_ans_section">
							<ol class="row p-0" id="match_header_blk">
					  		<li class="col-12 d-flex text-center" id="match_heading">
					  			<input type="text" placeholder="Type here" value="Question" class="form-control border-0 text-center col-6" disabled="disabled">
					  			<input type="text" placeholder="Type here" value="Answer" class="form-control border-0 text-center col-6" disabled="disabled">
					  		</li>
					  	</ol>

					  	<ol class="row" id="ol_qust_ans">
					  		<li class="w-100 mb-3 li_qust_ans">
					  			<div class="d-flex position-relative">
						  			<input type="text" name="subquestiontext[]" placeholder="Type here" value="" class="form-control mr-3 subquestiontext">
						  			<input type="text" name="answertext[]" placeholder="Type here" value="" class="form-control answertext">
					  			</div>
					  		</li>
					  	</ol>

					  	<div class="row justify-content-end">
					  		<button type="button" id="add_match_qust_ans" class="btn btn-md btn-green px-3 font-weight-medium">Add Question</button>
					  	</div>
						</div>

						<div class="form-group">
			  			<label class="font-weight-bold">Note:</label>
			  			<p>Please type the corresponding answer to each question. The questions will be automatically jumbled when in a question paper.</p>
		  			</div>
				  </div>
				  <!-- ***************** End Match the Following ******************-->
		    </div>
		  </div>
			
		</div>
	</div>	
</div>

