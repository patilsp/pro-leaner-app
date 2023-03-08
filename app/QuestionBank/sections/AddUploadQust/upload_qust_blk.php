<div class="row align-items-center justify-content-center h-100 d-none" id="upload_qust_blk">
	<div class="col-12 text-center" id="upload_col">
		<div class="d-flex align-items-center justify-content-center mt-4 mb-5">
      <h4 class="m-0">Download the Template</h4>
      <a href="../../assets/templates/qb/QB_Template.xlsx"><img src="../../assets/images/student/download.svg" style="width: 40px; height: 40px" class="mx-3"></a>
      <h4 class="m-0">and fill in the fields before uploading a file</h4>
    </div>

    <div class="d-flex align-items-center justify-content-center" id="upload_lable">
  		<label class="btn btn-md btn-blue active_btn_shadow border-0 mr-5" for="file-upload"> Upload File</label>

  		<button class="expl_tooltip bg-grey border-0" id="expl_tooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Uploading is possible only for Multiple Choice Questions">
  			<i class="fa fa-question"></i>
  		</button>
  	</div>

  	<form id="import_excel_form" class="d-none mb-5" method="post" enctype="multipart/form-data">
  		<input id="file-upload" name="file" type="file"/>
  		<div class="d-flex justify-content-around align-items-center w-100 mx-auto" id="upload_blk">
        <div id="show_attachedfiel" class="show_attachedfiel d-flex align-items-center mx-3 border rounded-lg p-2 mb-4">
          <img src="../../assets/images/student/excel.png" class="mr-3">
          <p class="m-0 font-weight-bold txt-grey" id="file-upload-filename">Question Data for Import</p>
        </div>
      </div>

      <input type="hidden" value="validateExcel" name="type" >
      <button type="submit" class="btn btn-md btn-blue font-weight-medium text-white shadow review px-4 mb-4" id="review">Review</button><br/>
    	
    	<label role="button" class="txt-blue border-bottom border-primary font-weight-bold" for="file-upload"> Upload a different file</label>
    </form>
	</div>

  <div class="col-12 review_col" id="review_col">
    <div class="card bg-transparent">
      <form id="import_excel_form_validate" method="post" enctype="multipart/form-data">
        <div class="card-header border-0 bg-transparent h5">
          Review Uploaded Data
        </div>
        <div class="card-body border-0">
          <div class="table-responsive" style="height: 300px; margin-bottom: 10px;">
            <table class="table table-bordered">
              <tbody id="UploadData">
                
              </tbody>
            </table>
          </div>

          <span class="pull-right text-danger font-weight-bold" id="no_of_errors">2 Errors(s) found</span>
        </div>
        <div class="card-footer text-muted text-center border-0 bg-transparent d-flex justify-content-center">
          <input type="hidden" value="uploadvalidateExcel" name="type" >
          <a href="#" id="review_back" class="btn btn-md btn-blue font-weight-medium text-white shadow">Back</a>
          <button class="btn btn-md btn-blue font-weight-medium text-white shadow mx-4" id="uploadExcelSaveBtn" type="submit">Ignore errors and upload</button>
          <button class="shadow font-weight-bold expl_tooltip" id="error_info" data-toggle="tooltip" data-placement="top" title="The data which has errors will be skipped and the remaning data will be uploaded">?</button>
        </div>
      </form>
    </div>
  </div>
</div>