<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delteQustModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center px-5 py-5">
        <img src="../../img/alert.png" class="mb-2">
        <h4 class="font-weight-bold mb-3">Alert</h4>
        <p class="m-0 font-weight-bold">Are you sure you want to delete the question <span class="action_name"></span>? </p>
        <input type="hidden" id="delete_qid" value="">
        <div class="position-relative d-flex justify-content-center mt-5">
          <button class="btn btn-md btn-blue font-weight-medium yes_bth mr-4" id="delete_qust_yes">Yes</button>
          <button class="btn btn-md btn-blue font-weight-medium no_btn" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>