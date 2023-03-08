<div class="col-12" id="add_section_blk">
	<?php foreach($quizInfo['Questions'] as $section_num=>$singleSection) { 
		$labelInfo = $singleSection['label_ref'];
		$label_id = $labelInfo['id'];
		$labelDetail = GetQuestionDetail($label_id);

		$question_ids = $singleSection['questions'];
		$marks = $quizInfo['Marks'];
	?>
		<div class="row px-4 qust_section mx-2 mb-4 py-3 position-relative">
			<img src="../../img/QB/close.svg" class='close_section position-absolute'>
			<ul class="w-100 mb-0">
				<li class="w-100 mb-3">
					<div class="d-flex align-items-center position-relative">
						<input type="text" class="form-control sect_title mr-5" name="sect_title[]" placeholder="Type Section Heading" value="<?php echo $labelDetail['QuestionText']; ?>">
						<input type="hidden" class="form-control sect_title mr-5" name="sect_title_id[]" placeholder="Type Section Heading" value="<?php echo $labelDetail['QuestionID']; ?>">
						<input type="hidden" class="form-control section_question_ids" name="section_question_ids[]" value="">
						<div class="d-flex align-items-center ml-5">
							<p class="mb-0 tot_sec_mark_labe1 mr-5" style="width: 55px">Marks</p>
							<p class="mb-0 tot_sec_mark text-center" style="width: 50px">0</p>
						</div>
					</div>
				</li>
			</ul>

			<ol class="w-100 mb-0 saved_selected_qust dragQuestions" id="saved_selected_qust">
				<?php foreach($question_ids as $key=>$question_id) { 
					$question = GetQuestionDetail($question_id);
					if(isset($marks[$question_id])) {
						$thisMarks = $marks[$question_id];
					} else {
						$thisMarks = "";
					}
					?>
					<li class="w-100 mb-3 move_question_option" id="qli<?php echo $question_id; ?>">
						<div class="d-flex position-relative">
							<div class="section_qust mr-5">
								<?php echo $question['viewQuestionQP']; ?>
							</div>
							<div class="d-flex ml-5">
								<p class="mb-0 tot_sec_mark_labe1 mr-5" style="	width: 55px"></p>
								<div class="position-relative">
									<div class="d-flex align-items-center">
									  <input type="text" name="marks[<?php echo $question_id; ?>]" class="form-control text-center marks" style="max-width: 60px" value="<?php echo $thisMarks; ?>">

									  <img src="../../assets/images/common/icon_more_option.png" class="ml-3 more_option tooltip_options" data-toggle="tooltip" data-html="true" title="<ul class='list-unstyled mb-0 py-2 px-2'>
			                <li class='media align-items-center mb-3 move_qust_option move_option' aria-qustid='qust<?php echo $question_id; ?>' role='button' >
			                  <i class='fa fa-arrows text-success mr-3' aria-hidden='true'></i>
			                  <div class='media-body'>
			                    <p class='mb-0 txt-light-black text-left'>Move</p>
			                  </div>
			                </li>
			                <li class='media align-items-center deleteQust' role='button' id='deleteQust@<?php echo $question_id; ?>'>
			                  <i class='fa fa-trash text-danger mr-3' aria-hidden='true'></i>
			                  <div class='media-body'>
			                    <p class='mb-0 txt-light-black text-left'>Delete</p>
			                  </div>
			                </li>
			              </ul>" data-placement="bottom">
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php } ?>
			</ol>
			<div class="col-12 text-center">
				<hr>
				<button class="btn btn-md btn-green addQuestions" >Add Question</button>
			</div>
		</div>
	<?php } ?>
	<span id="append_section_blk">
		
	</span>
	<button class="btn btn-md btn-green ml-2" id="add_section">Add Section</button>
</div>