<!-- Modal -->
<div class="modal fade" id="viewQustModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mt-4">
        <h4 class="text-center mx-auto">View Question </h4>
        <div class="row justify-content-center" id="displayQuestion">
          <div class="col-12 mt-5 qust_option_max_width">
            <h5 class="text-center mb-3 font-weight-bold">What is the shape shown in the image below?</h5>
            <div class="d-flex flex-wrap justify-content-center qust_img">
              <img src="../../img/responsive_icon/desktop.svg" class="mr-3 mb-3">
              <img src="../../img/responsive_icon/desktop.svg" class="mr-3 mb-3">
            </div>
          </div>
          <div class="col-12 mt-3 options qust_option_max_width" id="mcq_type_options">
            <ol class="font-weight-bold">
              <li class="p-3">Circle</li>
              <li class="right_ans p-3">Triangle</li>
              <li class="p-3">Square</li>
            </ol>
          </div>

          <!-- Shot Descriptive -->
          <div class="col-12 mt-3 px-5" id="view_shot_descp_options">
            <h6 class="font-weight-bold">Answer</h6>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>

            <h6 class="font-weight-bold">Keywords</h6>
            <ol type="a" class="font-weight-bold">
              <li class="p-2">Circle</li>
              <li class="p-2">Triangle</li>
              <li class="p-2">Square</li>
            </ol>
          </div>

          <!-- Match the following -->
          <div class="col-12 mt-3 px-5" id="view_match_the_following">
            <div class="form-group w-100 mx-auto" id="match_qust_ans_section">
              <ol class="row p-0" id="match_header_blk">
                <li class="col-12 d-flex text-center" id="match_heading">
                  <input type="text" name="option" placeholder="Type here" value="Question" class="form-control border-0 text-center col-6 bg-transparent font-weight-bold" disabled="disabled">
                  <input type="text" name="option" placeholder="Type here" value="Answer" class="form-control border-0 text-center col-6 bg-transparent font-weight-bold" disabled="disabled">
                </li>
              </ol>

              <ol class="row">
                <li class="w-100 mb-3">
                  <div class="d-flex">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control mr-3" disabled="disabled">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control" disabled="disabled">
                  </div>
                </li>
                <li class="w-100 mb-3">
                  <div class="d-flex">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control mr-3" disabled="disabled">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control" disabled="disabled">
                  </div>
                </li>
                <li class="w-100 mb-3">
                  <div class="d-flex">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control mr-3" disabled="disabled">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control" disabled="disabled">
                  </div>
                </li>
                <li class="w-100 mb-3">
                  <div class="d-flex">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control mr-3" disabled="disabled">
                    <input type="text" name="option" placeholder="Type here" value="Karnataka" class="form-control" disabled="disabled">
                  </div>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>