<div class="col-12" id="add_section_blk">   
	<div class="row px-4 qust_section mx-2 mb-4 py-3 position-relative">
		<img src="../../img/QB/close.svg" class='close_section position-absolute'>
		<ul class="w-100 mb-0">
			<li class="w-100 mb-3">
				<div class="d-flex align-items-center position-relative">
					<input type="text" class="form-control sect_title mr-5" name="sect_title[]" placeholder="Type Section Heading">
					<input type="hidden" class="form-control section_question_ids" name="section_question_ids[]" value="">
					<div class="d-flex align-items-center ml-5">
						<p class="mb-0 tot_sec_mark_labe1 mr-5" style="width: 55px">Marks</p>
						<p class="mb-0 tot_sec_mark text-center" style="width: 50px">0</p>
					</div>
				</div>
			</li>
		</ul>

		<ol class="w-100 mb-0 saved_selected_qust dragQuestions" id="saved_selected_qust">
		</ol>
		<div class="col-12 text-center">
			<hr>
			<button class="btn btn-md btn-green addQuestions" >Add Question</button>
		</div>
	</div>
	<span id="append_section_blk">
		
	</span>
	<button class="btn btn-md btn-green ml-2 addSection" id="add_section">Add Section</button>
</div>