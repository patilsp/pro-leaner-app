<div class="card mt-4 d-none" id="mcq">
  <div class="card-header">
    <div class="page-breadcrumb d-flex align-items-center justify-content-between w-100">
      <h4 class="breadcrumb-title pe-3 border-0">Add the options and mark the correct answer:</h4>
      <div class="ms-auto">
        <button
          class="btn btn-info add-para"
          data-add-to="#options-card-body"
          type="button">
          Add More Options
        </button> 
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row mt-4" id="options-card-body">
      <div class="col-6 position-relative editor mb-5">
        <div class="page-breadcrumb d-sm-flex align-items-center shadow-lg px-2 py-3">
          <div class="pe-3 border-0">
            <div class="form-floating"><select class="form-select" name="optionStatus[]" id="floatingSelect" aria-label="Floating label select example"><option value="0" selected>Wrong</option><option value="1">Right</option></select><label for="floatingSelect">Option</label></div>
          </div>
          <div class="ms-auto"></div>
        </div>
        <textarea class="ckeditorTxt" id="editor1"></textarea>
      </div>    
    </div>
  </div>
</div>