<div class="modal fade" id="addQustToSection" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content bg-white">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Section 1 - Add Questions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mt-4">
        <h4 class="text-center mx-auto mb-4 txt-grey">Filter Questions by</h4>
        <div class="row mx-auto" id="popup_qust_filter">
          <div class="form-group col-12 col-sm-6 col-md-6">
            <label for="popChapter">Chapter</label>
            <select class="form-control loadQuestions" id="popChapter">
              <option value="">-Select Chapter-</option>
            </select>
          </div>
          <div class="form-group col-12 col-sm-6 col-md-6">
            <label for="popQtype">Type of Question</label>
            <select class="form-control loadQuestions" id="popQtype">
              <option value="">-Select Type of Question-</option>
            </select>
          </div>
          <div class="form-group col-12 col-sm-6 col-md-6">
            <label for="popQCategory">Question Category</label>
            <select class="form-control loadQuestions" id="popQCategory">
              <option value="">-Select Question Category-</option>
            </select>
          </div>
          <div class="form-group col-12 col-sm-6 col-md-6">
            <label for="popDifficulty">Difficulty</label>
            <select class="form-control loadQuestions" id="popDifficulty">
              <option value="">-Select Difficulty-</option>
            </select>
          </div>
        </div>

        <div class="row mx-auto bg-transparent py-4 my-4" id="popup_qust">
          <div class="col-12 text-center d-none" id="no_qust_display_list_blk">
            <p class="txt-grey my-5">Apply filters to view the list of questions</p>
          </div>
          <div class="col-12 d-flex w-100" id="qust_display_list_blk">
            <div class="col-6" style="border-right: 2px solid #e2e2e2;">
              <p class="text-center">List of Questions</p>
              <div class="position-relative list_qust" id="filter_questions">
              </div>
            </div>
            <div class="col-6">
              <p class="text-center">Selected Questions</p>

              <div class="position-relative list_qust" id="selected_questions">
                <div class="empty w-100 h-100 text-center d-flex align-items-center justify-content-center" id="empty_selected_list">
                  <div>
                    <img src="../../assets/images/qb/qp/no_qustion.svg">
                    <p class="txt-grey">No questions are selected</p>
                  </div>
                </div>
                <span class="copy_selected_list" id="copy_selected_list"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center mx-auto text-center mt-5 mb-4">
          <button type="button" class="btn btn-md btn-blue px-5" id="addQuestionsSave">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>