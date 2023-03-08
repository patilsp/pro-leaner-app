<div class="modal fade" id="student_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mb-4">
        <h5 class="text-center font-weight-bold w-100 mb-3" id="model_title">Add New User</h5>
        <form id="add_student_form" method="post" name="add_student_form">
          <div class="mb-2 mx-2">
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="username" class="col-form-label font-weight-bold mandatory pl-0">Emp Id.</label>                
                  <input type="text" class="form-control" name="username" id="username" required>                
              </div>
              <div class="form-group col-md-6">
                <label for="fname" class="col-form-label font-weight-bold mandatory pl-0">First Name</label>                
                  <input type="text" class="form-control" name="firstname" id="fname" required>                
              </div>
              <div class="form-group col-md-6">
                <label for="lname" class="col-form-label font-weight-bold pl-0">Last Name</label>                
                  <input type="text" class="form-control" name="lastname" id="lname">               
              </div>
              <!-- <div class="form-group col-md-6">
                <label for="class" class="col-form-label font-weight-bold mandatory pl-0">Class</label>
                
                  <select class="form-control" id="class" name="class" required>
                    <option value="">Choose Class</option>
                  </select>
                </div>
              </div> -->
              <input type="hidden" name="class" id="class" value="1">
              <input type="hidden" name="level" id="level" value="">
              <!-- <div class="form-group col-md-6">
                <label for="class" class="col-form-label font-weight-bold mandatory pl-0">Section</label>
                
                  <select class="form-control" id="section" name="section" required>
                    <option value="">-Select Section-</option>
                  </select>
                
              </div> -->
              <input type="hidden" name="section" id="section" value="A">
              <div class="form-group col-md-6">
                <label for="class" class="col-form-label font-weight-bold mandatory pl-0">Role</label>                
                  <select class="form-control" id="rolelist" name="rolelist" required>
                    <option value="">-Select Role-</option>
                  </select>                
              </div>
              <div class="form-group col-md-6">
                <label for="class" class="col-form-label font-weight-bold mandatory pl-0">Department</label>                
                  <select class="form-control" id="department" name="dept" required>
                    <option value="">-Select Department-</option>
                  </select>                
              </div>
              <div class="form-group col-md-6">
                <label for="class" class="col-form-label font-weight-bold mandatory pl-0">Designation</label>                
                  <select class="form-control" id="designation" name="designation" required>
                    <option value="">-Select Designation-</option>
                  </select>                
              </div>
             
              <div class="form-group col-md-6">
                <label for="email" class="col-form-label font-weight-bold mandatory pl-0">Email ID</label>                
                  <input type="text" class="form-control" name="email" id="email">
                </div>
              
              <div class="form-group col-md-6">
                <label for="phone" class="col-form-label font-weight-bold mandatory pl-0">Phone</label>                
                  <input type="text" class="form-control" name="phone" id="phone">               
              </div>
            </div>
          </div>
          
          <div class="position-relative text-center w-100 mb-3 pt-4">
            <input type="hidden" name="autoid" id="autoid" value="0">
            <input type="hidden" name="type" value="updateStudenData" />
            <button type="submit" class="btn btn-md btn-blue shadow px-5" id="update_section_count_form_save">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-83 mb-4">
        <h5 class="text-center font-weight-bold w-100 mb-5" id="model_title">Change Password for <span id="pwd-student-name"></span></h5>
        <form id="reset_password_form" method="post" name="reset_password_form">
          <div class="row justify-content-center text-left mb-4">
            <div class="row">
              <div class="form-group col-md-12">
                <label for="username" class="col-form-label font-weight-bold mandatory pl-0">New Password</label>
                
                  <input class="form-control" type="password" id="password" name="password" placeholder="Enter New Password" value="" />
               
              </div>
              <div class="form-group col-md-12">
                <label for="fname" class="col-form-label font-weight-bold mandatory pl-0">Confirm New Password</label>
                
                  <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="Confirm New Password" value="" />
              
              </div>
            </div>
          </div>
          
          <div class="position-relative text-center w-100 mb-5">
            <input type="hidden" name="rp_autoid" id="rp_autoid" value="0">
            <input type="hidden" name="type" value="resetPassword" />
            <button type="submit" class="btn btn-md btn-blue shadow px-5" id="update_reset_password">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>