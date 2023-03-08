<!-- Modal Fullscreen xl -->
<div class="modal modal-fullscreen-xl" id="preview_question_paper" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
       <div class="d-flex align-items-center">
          <img src="../../assets/images/qb/student.svg" class=" mx-4">
          <h5 class="modal-title font-weight-bold" id="staticBackdropLabel"></h5>
        </div>
        
        <button type="button" class="close p-0 mt-2 mr-2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body px-5 bg-transparent">
        <span id="displayPreview"></span>
        <div class="d-flex w-100 mb-4 prev_section_heading d-none">
          <div class="p-2 flex-grow-1">
            <h4 class="font-weight-bold"><u>Answer the following correctly</u></h4>
          </div>
          <div class="p-2 flex-shrink-1">
            <h4 class="font-weight-bold">Marks: <span id="preview_section_marks">10</span></h4>
          </div>
        </div>

        <div class="row d-none" id="preview_question_list">

          <!-- qust text with image and mcq with only option text -->
          <div class="col-12 mb-4">
            <div class="card bg-transparent">
              <span id="displayPreview"></span>
              <div class="card-header text-center">
                <h3 class="font-weight-bold text-center mb-0 w-100">Question 1</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h3 class="card-title">Which is the animal shown in the image?</h3>
                    <img src="../../assets/images/student/excel.png" class="qust_img my-3">
                    
                    <div class="position-relative w-100">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                          Default radio
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                          Second default radio
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
                        <label class="form-check-label" for="exampleRadios3">
                          Disabled radio
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-4">
                    <h4 class="font-weight-bold text-right preview_qust_mark">5</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- qust only text and mcq with only option text -->
          <div class="col-12 mb-4">
            <div class="card bg-transparent">
              <div class="card-header text-center">
                <h3 class="font-weight-bold text-center mb-0 w-100">Question 2</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h3 class="card-title">Which is the animal shown in the image?</h3>
                    
                    <div class="position-relative w-100">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          Default checkbox
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                        <label class="form-check-label" for="defaultCheck2">
                          Disabled checkbox
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-4">
                    <h4 class="font-weight-bold text-right preview_qust_mark">5</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- qust only text and mcq option text and image -->
          <div class="col-12 mb-4">
            <div class="card bg-transparent">
              <div class="card-header text-center">
                <h3 class="font-weight-bold text-center mb-0 w-100">Question 3</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h3 class="card-title">Which is the animal shown in the image?</h3>
                    
                    <div class="position-relative w-100">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          <img src="../../assets/images/student/excel.png" class="opt_img">
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                        <label class="form-check-label" for="defaultCheck2">
                          Disabled checkbox
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          Default checkbox
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-4">
                    <h4 class="font-weight-bold text-right preview_qust_mark">5</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- qust only text and drag and drop options only the text -->
          <div class="col-12 mb-4">
            <div class="card bg-transparent">
              <div class="card-header text-center">
                <h3 class="font-weight-bold text-center mb-0 w-100">Question 4</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h3 class="card-title">Match the following baby animals to their parents.</h3>
                    
                    <div class="position-relative w-100">
                      <div class="d-flex mb-3">
                        <div class="w-50 drag_drop_qust_option mr-5 py-3">
                          <h4 class="text-center">Dog</h4>
                        </div>
                        <div class="w-50 drag_drop_qust_option mr-5 py-3">
                          <h4 class="text-center">Dog</h4>
                        </div>
                      </div>

                      <div class="d-flex mb-3">
                        <div class="w-50 drag_drop_qust_option mr-5 py-3">
                          <h4 class="text-center">Dog</h4>
                        </div>
                        <div class="w-50 drag_drop_qust_option mr-5 py-3">
                          <h4 class="text-center">Dog</h4>
                        </div>
                      </div>

                      <div class="d-flex mb-3">
                        <div class="w-50 drag_drop_qust_option mr-5 py-3">
                          <h4 class="text-center">Dog</h4>
                        </div>
                        <div class="w-50 drag_drop_qust_option mr-5 py-3">
                          <h4 class="text-center">Dog</h4>
                        </div>
                      </div>

                      <div class="d-flex mb-3">
                        <div class="w-50 drag_drop_qust_option mr-5 py-3">
                          <h4 class="text-center">Dog</h4>
                        </div>
                        <div class="w-50 drag_drop_qust_option mr-5 py-3">
                          <h4 class="text-center">Dog</h4>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-4">
                    <h4 class="font-weight-bold text-right preview_qust_mark">5</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- section 2 question block -->
        <div class="d-flex w-100 mb-4 prev_section_heading d-none">
          <div class="p-2 flex-grow-1">
            <h4 class="font-weight-bold"><u>Answer the questions briefly</u></h4>
          </div>
          <div class="p-2 flex-shrink-1">
            <h4 class="font-weight-bold">Marks: <span id="preview_section_marks">10</span></h4>
          </div>
        </div>

        <div class="row d-none" id="preview_question_list">
          <!-- qust text with image and mcq with only option text -->
          <div class="col-12 mb-4">
            <div class="card bg-transparent">
              <div class="card-header text-center">
                <h3 class="font-weight-bold text-center mb-0 w-100">Question 5</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h3 class="card-title">Which is the animal shown in the image?</h3>
                    <textarea class="form-control bg-transparent" placeholder="Type your answer here" rows="15"></textarea>
                  </div>

                  <div class="col-4">
                    <h4 class="font-weight-bold text-right preview_qust_mark">5</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>