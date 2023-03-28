<!-- Modal -->
<div class="modal fade" id="evaluate_answer_paper_modal" tabindex="-1" aria-hidden="true">
<div id="toast"><div id="img"><i class="bi bi-info-circle-fill"></i></div><div id="desc">A notification message..</div></div>
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header text-center">
        <h5 class="modal-title w-100">Evaluate Answer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <div class="row align-items-center justify-content-center" id="evaluate_answer_paper">
        <form id="formEA" method="post" name="formEA">
          <div class="col-12 p-0 h-100">
            <div class="new-custom-card">
             
              <div class="d-flex align-items-center position-relative mb-1 ml-0">
                <div class="d-flex align-items-center ml-5">
                  <p class="mb-0 assmnt_label_name mr-4" style="width: 95px">Name</p>
                  <p class="mb-0 assmnt_label_value text-left" style="width: 300px"><span id="student_name"></span></p>
                </div>
              </div>
              <div class="d-flex align-items-center position-relative mb-4 ml-0">
                <div class="d-flex align-items-center ml-5">
                  <!-- <p class="mb-0 assmnt_label_name mr-4" style="width: 95px">Admn No.</p>
                  <p class="mb-0 assmnt_label_value text-left" style="width: 300px"><span id="student_admission_no"></span>716846</p> -->
                </div>
              </div>
              <div class="d-flex align-items-center position-relative col-sm-11 mt-2 mb-2 w-100">
                <div class="d-flex align-items-center div_border w-100 mr-4 ml-4">
                  <p class="mb-0 assmnt_label_name w-100 ">Marks Obtain</p>
                  <input type="hidden" id="mark_obtain">
                  <p class="mb-0 assmnt_label_value text-right"><span id="marks_earned"></span></p>
                </div>
              </div>
              <div class="d-flex align-items-center position-relative col-sm-11 mt-2 mb-2 w-100">
                <div class="d-flex align-items-center div_border w-100 mr-4 ml-4">
                  <p class="mb-0 assmnt_label_name w-100">Total Marks</p>
                  <p class="mb-0 assmnt_label_value text-right"><span id="max_marks"></span></p>
                </div>
              </div>


              <div class="position-relative bg-transparent mx-3 mt-4" id="evaluate_answer_paper">
                <!-- <h6 class="text-center mb-4"><u>Evaluate Answer</u></h6> -->
                <h5 class="text-center mb-4 w-100">Evaluate Answer</h5>
                <span id="Answers"></span>
                <div id="evaluate_answer_list">
                </div>                
                <?php /*
                <div class="d-flex w-100 mb-1 prev_section_heading">
                  <div class="p-2 flex-grow-1">
                    <h5 class="font-weight-bold"><u id="section_heading">Tick the pair of words that would best complete the following sentences</u></h5>
                  </div>
                  <div class="p-2 flex-shrink-1">
                    <h6 class="font-weight-bold">Marks</h6>
                  </div>
                </div>
                
                <div class="row">

                  <!-- qust text with image and mcq with only option text -->
                  <div class="col-12 mb-4">
                    <div class="card bg-white border-1">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-8">
                            <h5 class="card-title">Tick the word that is correctly spelled</h5>
                           
                            <div class="position-relative w-100">
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex"></div>
                                <label class="form-check-label" for="exampleRadios1">
                                  Benefit 
                                </label>
                              </div>
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex">
                                  <i class="bi bi-check-circle-fill" id="answer_icon"></i>
                                </div>
                                <label class="form-check-label" for="exampleRadios2">
                                  Benefits
                                </label>
                              </div>
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex"></div>
                                <label class="form-check-label" for="exampleRadios3">
                                  Benefitits
                                </label>
                              </div>
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex"></div>
                                <label class="form-check-label" for="exampleRadios3">
                                  Cows
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="col-4">
                            <h4 class="preview_qust_mark d-flex align-items-center justify-content-center">1</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- qust only text and mcq with only option text -->
                  <div class="col-12 mb-4">
                    <div class="card bg-white border-1">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-8">
                            <h5 class="card-title">Tick the word that is correctly spelled ?</h5>
                            
                            <div class="position-relative w-100">
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex"></div>
                                <label class="form-check-label" for="exampleRadios1">
                                emmigrat
                                </label>
                              </div>
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex">
                               
                                </div>
                                <label class="form-check-label" for="exampleRadios2">
                                emmigrats
                                </label>
                              </div>
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex">
                                  
                                </div>
                                <label class="form-check-label" for="exampleRadios3">
                                emmigrat
                                </label>
                              </div>
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex"></div>
                                <label class="form-check-label right_ans_label" for="exampleRadios3">
                                emigrate
                                </label>
                              </div>
                              <div class="form-check d-flex align-items-center">
                                <div class="choosed_status d-flex">
                                <i class="bi bi-x-circle-fill" id="answer_icon"></i>
                                </div>
                                <label class="form-check-label" for="exampleRadios3">
                                emmigrate
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="col-4">
                            <h4 class="preview_qust_mark d-flex align-items-center justify-content-center">0</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                
                  <!-- qust only text and drag and drop options only the text -->
                  <!-- <div class="col-12 mb-4">
                    <div class="card bg-white border-1">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-8">
                            <h5 class="card-title">Match the following baby animals to their parents.</h5>
                            
                            <div class="position-relative w-100">
                              <div class="d-flex align-items-center mb-3">
                                <div class="choosed_status d-flex">
                                  <i class="bi bi-x-circle-fill" id="answer_icon"></i>
                                </div>
                                <div class="w-50 drag_drop_qust_option mr-5 py-3 drag_qust">
                                  <h4 class="text-center">Dog</h4>
                                </div>
                                <div class="w-50 drag_drop_qust_option mr-5 py-3">
                                  <h4 class="text-center">Dog</h4>
                                </div>
                              </div>

                              <div class="d-flex align-items-center mb-3">
                                <div class="choosed_status d-flex">
                                  <i class="bi bi-x-circle-fill" id="answer_icon"></i>
                                </div>
                                <div class="w-50 drag_drop_qust_option mr-5 py-3 drag_qust">
                                  <h4 class="text-center">Dog</h4>
                                </div>
                                <div class="w-50 drag_drop_qust_option mr-5 py-3">
                                  <h4 class="text-center">Dog</h4>
                                </div>
                              </div>

                              <div class="d-flex align-items-center mb-3">
                                <div class="choosed_status d-flex">
                                  <i class="bi bi-check-circle-fill" id="answer_icon"></i>
                                </div>
                                <div class="w-50 drag_drop_qust_option mr-5 py-3 drag_qust">
                                  <h4 class="text-center">Dog</h4>
                                </div>
                                <div class="w-50 drag_drop_qust_option mr-5 py-3">
                                  <h4 class="text-center">Dog</h4>
                                </div>
                              </div>

                              <div class="d-flex align-items-center mb-3">
                                <div class="choosed_status d-flex">
                                  <i class="bi bi-check-circle-fill" id="answer_icon"></i>
                                </div>
                                <div class="w-50 drag_drop_qust_option mr-5 py-3 drag_qust">
                                  <h4 class="text-center">Dog</h4>
                                </div>
                                <div class="w-50 drag_drop_qust_option mr-5 py-3">
                                  <h4 class="text-center">Dog</h4>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-4">
                            <h4 class="preview_qust_mark d-flex align-items-center justify-content-center">5</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->

                <div class="row" id="evaluate_answer_list">
                 
                  <div class="col-12 mb-4">
                    <div class="card bg-white">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-8">
                            <h5 class="card-title">Which is the animal shown in the image?</h5>
                            <textarea disabled="disabled" class="form-control bg-transparent" placeholder="Type your answer here" rows="15"></textarea>
                          </div>

                          <div class="col-4">
                            <h4 class="preview_qust_mark d-flex align-items-center justify-content-center">5</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                */ ?>
              </div>
                <div class="d-flex text-left mt-2 mb-2">
                  <label class="form-label select-label m-15">Status</label>
                    <select id="resultStatus" class="form-select select w-250" >
                      <option value="Pass">Pass</option>
                      <option value="Fail">Fail</option>
                  
                    </select>
                 
                </div>


              <div class="form-group mx-3">
                <label for="overall_remarks">Remarks</label>
                <textarea class="form-control" rows="4" id="overall_remarks" rows="3"></textarea>
              </div>
            </div>
          </div>
          <input type="hidden" id="type" name="type" value="saveEvaluation">
          <input type="hidden" id="attempt_id" name="attempt_id" value="">
          
        </form>
      </div>
        

      </div>
      <div class="modal-footer mx-auto w-100 justify-content-center">
        <button type="button" id="save_assessment" class="btn btn-sueccss">Save</button>
        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
      </div>
 
    </div>
  </div>
</div>