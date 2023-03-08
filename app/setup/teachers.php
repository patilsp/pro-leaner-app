<?php 
  include_once "../session_token/checksession.php";
  include_once "../configration/config.php";
  //include_once "session_token/checktoken.php";
  require_once "../functions/db_functions.php";
  include "functions/common_function.php";
  $classList = getCPClasses();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- vendor css -->
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../../lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
   
  </head>

  <style type="text/css">
    
    #enroll_edit_div{
      min-width: 820px
    }
    
    
</style>

  <body class="collapsed-menu ">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="row new-row-bg">
          <div class="col-md-12">
            <div class="card h-100 d-flex flex-column justify-content-between">
              <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
                <h6 class="mg-b-0 tx-14 tx-white">Teachers</h6>
                <div class="card-option tx-24">
                  <!-- <a href="userCreation.php" class="btn btn-md btn-info" >New User</a> -->
                  <button class="btn btn-md btn-info" data-toggle="modal" data-target="#student_modal_new" id="add_student_bth">Add Teacher</button>
                </div><!-- card-option -->
              </div><!-- card-header -->
              <div class="card-body">
                  <div class="table-responsive">
                      <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $i=1; 
                            $query="SELECT * FROM users WHERE roles_id = 9";
                            $result=$db->query($query);
                            while($row = $result->fetch(PDO::FETCH_ASSOC))
                            { 
                                
                            ?>
                        <tr>

                          <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <!-- <td><button type="button" class="btn btn-info" onclick="location.href='updateUser.php?id=<?php //echo $row['id']; ?>';">Edit</button></td> -->
                          <td><button type="button" class="btn btn-md btn-info btn3d editUser" title="Edit Teacher" data-toggle="modal" data-target="#student_edit_modal" data-id="<?php echo $row['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></button></td>
                          
                        </tr>


                        <?php
                      }
                      ?>
                      </tbody>
                      
                    </table>
                  </div>
              </div><!-- card-body -->
            </div>
          </div>
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

<div class="modal fade" id="student_modal_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="text-center font-weight-bold w-100" id="model_title">Add New Teacher</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <form class="user_form form-horizontal" action="createTeacher.php" name="form" method="POST">
            <div class="card mb-4">
              <div class=" row card-body bd bd-t-0 rounded-bottom">
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Emp Id:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Emp Id" required>
                  </div>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">First Name:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Last Name:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Password:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password*" required> 
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Confirm Password:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password*" required> 
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Email:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Phone:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" required>
                  </div>
                </div>

                 
              </div>
            <div class="col-12 qust mx-auto" id="card_blk">
            <div class="d-flex align-items-center position-relativemb-3">
              <div class="col-4">
                <div class="form-group">
                  <label>Class</label>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Section</label>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Subject</label>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center position-relative cmt mb-3">
                <div class="col-4">
                  <div class="form-group">
                    <select class="form-control class select" id="selectclass" name="class[]" >
                      <option value="">-Choose Class-</option>
                      <?php foreach ($classList["classes"] as $key=>$classValue){ ?>
                        <option value="<?php echo $classValue['id']; ?>"><?php echo $classValue['module'];?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <select class="form-control section" id="sectionOptionSection" name="section[]">
                     <option value="">-Choose Section-</option>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <select class="form-control subject select_remove_space" id="sectionOptionSubject" name="subject[]">
                      <option value="">-Choose Subject-</option>
                      <!-- Note: Akash if 2 spaces for child subject and 3 spaces for sub-child subject options -->
                    </select>
                  </div>
                </div>
          
                <button type="button" class="remove d-none"><i class="fa fa-times"></i></button>
              </div>
            <div class="position-relative wrapper" id="qust1_wrap"></div>
            <button class="add" data-id="qust1_add" type="button"><i class="fa fa-plus"></i>&nbsp;Add</button>
            <input type="hidden" class="teacherId" id ="teacherId" value="">
          </div>

            </div><!-- card-body -->
           
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="<?php echo $web_root ?>app/setup/teachers.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="submit" class="btn btn-md btn-info" name="submit">Submit</button>
            </div><!-- card-footer -->
          </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="student_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="text-center font-weight-bold w-100" id="model_title">Edit Teacher</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form class="user_form form-horizontal" action="update_teacher_validation.php" name="form" method="POST">
            <input type="hidden" class="form-control" name="user_auto_id" id="user_auto_id" value="">
            <div class="card mb-4">
              <div class="row card-body bd bd-t-0 rounded-bottom">
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Emp Id:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="username" id="usernameEdit" value="" required>
                  </div>
                </div> -->

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">First Name:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="fname" id="fnameEdit" value="" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Last Name:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="lname" id="lnameEdit"  value="" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Password:</label>
                    <input type="password" name="password" id="passwordEdit" class="form-control" placeholder="Password*"> 
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Confirm Password:</label>
                    <input type="password" name="cpassword" id="cpasswordEdit" class="form-control" placeholder="Confirm Password*"> 
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Email:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="email" id="emailEdit" value="" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Phone:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="phone" id="phoneEdit" value="" required>
                  </div>
                </div>

                

              <div class="col-12 qust mx-auto" id="card_blk">
            <div class="d-flex align-items-center position-relativemb-3">
              <div class="col-4">
                <div class="form-group">
                  <label>Class</label>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Section</label>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Subject</label>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center position-relative cmt mb-3">
                <div id="enroll_edit_div">
                </div>
                <button type="button" class="remove d-none"><i class="fa fa-times"></i></button>
              </div>
            <div class="position-relative wrapper" id="qust1_wrap"></div>
            <button class="add" data-id="qust1_add" type="button"><i class="fa fa-plus"></i>&nbsp;Add</button>
            <input type="hidden" class="teacherId" id="teacherId" value="">
          </div> 
                 
              </div>


            </div><!-- card-body -->
           
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="<?php echo $web_root ?>app/setup/teachers.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="submit" class="btn btn-md btn-info" name="update" id="update">Update</button>
            </div><!-- card-footer -->
          </form> 
      </div>
    </div>
  </div>
</div>


    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../lib/jquery/jquery.js"></script>
    <script src="../../lib/popper.js/popper.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../lib/datatables/jquery.dataTables.js"></script>
    <script src="../../lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../../lib/select2/js/select2.min.js"></script>

    <script src="../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable').DataTable({
          responsive: false
        });
        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
      $(document).ready(function(){
        $(document).on('change', '.select', function() {
          var id = $('#selectclass').val();
          var  _this = this;
          var class1 = $(this).closest('.d-flex').find('.class').prop('value');
          console.log(class1);
          $.ajax({
              url:"apis/enroll.php",
              method:'POST',
              data: "id="+ class1 +"&type=getSelectData",
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  var result = json.Result;
                  var section = result.Section;
                  var subject = result.Subject;
                  $(_this).closest('.d-flex').find('.section').html(section);
                  $(_this).closest('.d-flex').find('.subject').html(subject);
                  
              },
              beforeSend: function(){
                  //$("body").mLoading()
              },
              complete: function(){
                  //$("body").mLoading('hide')
              }
          });
      });
        $(document).on('click', '.editUser', function() {
          var user_id = $(this).data('id');
          $.ajax({
            url:"updateTeacher.php",
            method:'GET',
            data: "user_id=" + user_id,
            dataType:"json",
            success:function(data)
            {
              // $("#usernameEdit").val(data.username);
              $("#fnameEdit").val(data.first_name);
              $("#lnameEdit").val(data.last_name);
              $("#emailEdit").val(data.email);
              $("#phoneEdit").val(data.phone);
              $("#roleEdit").val(data.roles_id);
              // $("#deptEdit").val(data.dept);
              // $("#designationEdit").val(data.designation);
              $("#user_auto_id").val(data.user_auto_id);
            },
            beforeSend: function(){
                //$("body").mLoading()
            },
            complete: function(){
                //$("body").mLoading('hide')
            }
          });
          $.ajax({
            url:"enrollTeacher.php",
            method:'GET',
            data: "user_id=" + user_id,
            dataType:"html",
            success:function(data)
            {
              $("#enroll_edit_div").html(data);
            },
            beforeSend: function(){
                //$("body").mLoading()
            },
            complete: function(){
                //$("body").mLoading('hide')
            }
          });
        });
        
      $(document).on('click', '.add', function() {
        var clone_data = $(this).closest('.qust').find('.cmt').first().clone(true);
        clone_data.find("input").val("");
        clone_data.find("select").val("");
        $(this).parent().find('.wrapper').append(clone_data).fadeIn(600);
      });
    }) 
    </script>
  </body>
</html>
