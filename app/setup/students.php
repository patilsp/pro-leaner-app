<?php 
  include_once "../session_token/checksession.php";
  include_once "../configration/config.php";
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
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tech E-Learning App</title>
    <link rel="icon" type="image/png" href="../../links/media/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../links/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="../../links/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="../../links/css/main.css" rel="stylesheet" type="text/css"/>

  </head>
  <body  id="kt_body"  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <?php include("../fixed-blocks/header.php"); ?>

    <!-- start you own content here -->
    <div class="row">
      <div class="col-md-12">
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5">
            <h6 class="mg-b-0 tx-14 tx-white">Students</h6>
            <div class="card-option tx-24">
              <!-- <a href="<?php echo $web_root?>app/setup/enroll_student.php"><button class="btn btn-sm btn-flex btn-primary ms-2">Enroll Students</button></a> -->
              <button class="btn btn-sm btn-flex btn-primary ms-2" data-toggle="modal" data-target="#student_modal" id="add_student_bth">Add Student</button>  
              <!-- <a href="student_upload.php" class="btn btn-sm btn-flex btn-primary ms-2">Upload file</a>                 -->
            </div>
          </div>
          <div class="card-body">
            <table id="datatable" class="table align-middle table-row-dashed fs-6 dataTable no-footer">
              <thead>

                  
                <tr>
                  <th>Name </th>
                  <th>Admission No.</th>
                  <th>Class</th>
                  <th>Section</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                    $i=1; 
                    $query="SELECT users.id,users.first_name,users.last_name,users.admission,cpmodules.module,masters_sections.section FROM users LEFT JOIN cpmodules ON users.class = cpmodules.id LEFT JOIN masters_sections ON users.section = masters_sections.id WHERE roles_id = 10";
                    $result=$db->query($query);
                    while($row = $result->fetch(PDO::FETCH_ASSOC))
                    { 
                        
                    ?>
                <tr>

                  <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                  <td><?php echo $row['admission']; ?></td>
                  <td><?php echo $row['module']; ?></td>
                  <td><?php echo $row['section']; ?></td>
                  <!-- <td><button type="button" class="btn btn-info" onclick="location.href='updateUser.php?id=<?php //echo $row['id']; ?>';">Edit</button></td> -->
                  <td>
                    <a type="button" class="editUser" title="Edit Student" data-toggle="modal" data-target="#student_edit_modal" data-id="<?php echo $row['id']; ?>"><img src="../../links/media/icons/edit.svg" class="" alt="edit"></a>
                    <a type="button" class="deleteStudent" title="Delete Student" id='<?php echo $row['id']; ?>' ><img src="../../links/media/icons/delete.svg" class="" alt="edit"></a>
                  </td>
                  
                </tr>


                <?php
              }
              ?>
              </tbody>
              
            </table>
          </div><!-- card-body -->
        </div>
      </div>
    </div>
    
<div class="modal fade" id="student_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="font-weight-bold w-100" id="model_title">Add New Student</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body scroll-y mx-5 my-5">
    
        <form class="user_form form-horizontal" action="createStudent.php" name="form" method="POST">
            <div class="card-body bd rounded-bottom">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control admission" name="admission" id="admission" placeholder="Enter Admission Number" aria-describedby="floatingInputHelp" required>
                    <label for="floatingInput" class="required">Admission/Reg No.:</label>
                  </div>                 
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name" aria-describedby="floatingInputHelp" required>
                    <label for="floatingInput" class="required">First Name:</label>
                  </div>                    
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter First Lame" aria-describedby="floatingInputHelp" required>
                    <label for="floatingInput" class="required">Last Name:</label>
                  </div>  
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="password" id="password" placeholder="password*" aria-describedby="floatingInputHelp" required>
                    <label for="floatingInput" class="required">Password:</label>
                  </div> 
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm password*" aria-describedby="floatingInputHelp" required>
                    <label for="floatingInput" class="required">Confirm Password:</label>
                  </div> 
                </div>

                <div class="col-md-6">
                 <div class="form-floating">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email ID" aria-describedby="floatingInputHelp" required>
                    <label for="floatingInput" class="required">Email:</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone" aria-describedby="floatingInputHelp" required>
                    <label for="floatingInput" class="required">Phone:</label>
                  </div> 
                </div>


                <div class="col-md-6">
                  <div class="form-floating mult">
                    <select class="form-select select"  name="class" id="selectclass" aria-label="Floating label select example">
                    <option value="" selected="selected">Select</option>
                    <?php
                        $query = "SELECT * FROM cpmodules WHERE level = 1 AND type = 'class' AND visibility = 1";
                        $stmt = $db->query($query);
                        while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                        ?>
                              <option value="<?php echo $rows['id']; ?>"><?php echo $rows['module']; ?></option>
                      <?php
                          }
                        ?>
                    </select>
                    <label for="floatingSelect" class="required">Class</label>
                  </div>
                
                </div>

                <div class="col-md-6">
                <div class="form-floating mult">
                    <select class="form-select section"  name="section" id="section" aria-label="Floating label select example">
                    <option value="" selected="selected">Select</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <label for="floatingSelect" class="required">Section</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer mt-5">
              <a href="<?php echo $web_root ?>app/setup/students.php" class="btn btn-md btn-danger me-2">Cancel</a>
              <button type="submit" class="btn btn-md btn-info" name="submit">Submit</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="student_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="text-center font-weight-bold w-100" id="model_title">Edit Student</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <form class="user_form form-horizontal" action="update_student_validation.php" name="form" method="POST">
            <input type="hidden" class="form-control" name="user_auto_id" id="user_auto_id" value="">
            <div class="card-body bd rounded-bottom">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Admission/Reg No.:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control admission" name="admission" id="admissionEdit" value="" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">First Name:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="fname" id="fnameEdit" value="" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Last Name:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="lname" id="lnameEdit"  value="" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Password:</label>
                    <input type="password" name="password" id="passwordEdit" class="form-control" placeholder="Password"> 
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Confirm Password:</label>
                    <input type="password" name="cpassword" id="cpasswordEdit" class="form-control" placeholder="Confirm Password"> 
                  </div>
                </div>

                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" name="email" id="emailEdit" value="" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Phone:</label>
                    <input type="text" class="form-control" name="phone" id="phoneEdit" value="" required>
                  </div>
                </div> -->

                <div class="col-md-6">
                    <div class="form-group mult">
                        <label class="col-md-12">Class<span class="required_icon" style="color:red;">*</span></label>
                        <select class="form-control select" name="class" id="classEdit" required>
                            <option value="" selected="selected">Select</option>

                              <?php
                                  $query = "SELECT * FROM cpmodules WHERE level = 1 AND type = 'class' AND visibility = 1";
                                  $stmt = $db->query($query);
                                  while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
                                  {
                                  ?>
                                      <option value="<?php echo $rows['id']; ?>"><?php echo $rows['module']?></option>               
                                  <?php
                                      }
                                   ?>
                           
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mult">
                        <label for="Section">Section<span class="required_icon" style="color:red;">*</span></label>
                        <select class="form-control section" name="section" id="sectionEdit" required>
                            <option value="" selected="selected">Select</option>
                        </select>
                    </div>
                </div>

                
                 
              </div>


            </div><!-- card-body -->
           
            <div class="card-footer">
              <a href="<?php echo $web_root ?>app/setup/students.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="submit" class="btn btn-md btn-info" name="update" id="update">Update</button>
            </div><!-- card-footer -->
          </form> 
      </div>
    </div>
  </div>
</div>
  <!-- Snackbar  -->
  <div id="snackbar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0" id="sb_heading">Notice!</h6>
        <button type="button" class="close close_snackbar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body"></p>
      </div>
    </div>


    <!-- ########## END: MAIN PANEL ########## -->
    <?php include("../fixed-blocks/footer.php"); ?>
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

    <script src="../../links/plugins/global/plugins.bundle.js"></script>
    <script src="../../links/js/scripts.bundle.js"></script>
    <script src="../../links/plugins/custom/datatables/datatables.bundle.js"></script>


    <script src="../../js/cms.js"></script>
    <script>
      // function checkSpace() {
   
      //     preg_replace(array('/[^\w\s]+/', '/[^a-zA-Z0-9]+/'), array('', '_'), $str);
      // }
      $('.admission').keyup(function() {
          var $th = $(this);
          $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) {             
            alert('You typed " ' + str + ' ".\n\nPlease use only letters and numbers.'); 
            return ''; 
          }));
      });


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
          var id = $(this).val();
          var  _this = this;
          var class1 = $(this).closest('.d-flex').find('.class').prop('value');
          console.log(class1);
          $.ajax({
              url:"apis/enroll.php",
              method:'POST',
              data: "id="+ id +"&type=getSelectData",
              success:function(data)
              {
                  var json = $.parseJSON(data);
                  var result = json.Result;
                  var section = result.Section1;
                  // var subject = result.Subject;
                  // $(_this).closest('.d-flex').find('.section').html(section);
                  $(".section").html(section);
                  // $(_this).closest('.d-flex').find('.subject').html(subject);
                  
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
            url:"updateStudent.php",
            method:'GET',
            data: "user_id=" + user_id,
            dataType:"json",
            success:function(data)
            {
              $("#admissionEdit").val(data.admission);
              $("#fnameEdit").val(data.first_name);
              $("#lnameEdit").val(data.last_name);
              $("#emailEdit").val(data.email);
              $("#phoneEdit").val(data.phone);
              $("#classEdit").val(data.class);
              // $("#sectionEdit").val(data.designation);
              $("#user_auto_id").val(data.user_auto_id);
              var html = "";
              html += "<option value = ''>Choose Section</option>";
              $.each(data.sectionlist, function (key, val) {
                  if (data.section == key) {
                    html += "<option value = "+key+" selected>"+val+"</option>";
                  } else {
                    html += "<option value = "+key+">"+val+"</option>";
                  }
              });
              $("#sectionEdit").empty();
              $("#sectionEdit").append(html);
            },
            beforeSend: function(){
                //$("body").mLoading()
            },
            complete: function(){
                //$("body").mLoading('hide')
            }
          });
        });
      }) 

      <?php if(isset($_SESSION['sb_heading'])) { ?>
        $("#sb_heading").html("<?php echo $_SESSION['sb_heading']; ?>");
        $("#sb_body").html('<?php echo $_SESSION['sb_message']; ?>');
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, <?php echo $_SESSION['sb_time']; ?>);
      <?php unset($_SESSION['sb_heading']); } ?>
    </script>
  </body>
</html>
