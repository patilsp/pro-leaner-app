<?php 
  include_once "../session_token/checksession.php";
  include_once "../configration/config.php";
  //include_once "session_token/checktoken.php";
  require_once "../functions/db_functions.php";
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

    <title>Virtual School</title>
    <link rel="icon" type="image/png" href="../../img/favicon.png" />

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
    
    
    
    
</style>

  <body class="collapsed-menu">

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
                <h6 class="mg-b-0 tx-14 tx-white">Students</h6>
                <div class="card-option tx-24">
                  <!-- <a href="userCreation.php" class="btn btn-md btn-info" >New User</a> -->
                  <a href="<?php echo $web_root?>app/setup/enroll_student.php"><button class="btn btn-primary shadow">Enroll Students</button></a>
                  <button class="btn btn-primary shadow" data-toggle="modal" data-target="#student_modal" id="add_student_bth">Add Student</button>  
                 
                  <a href="student_upload.php" class="btn btn-primary shadow">Upload file</a>
                
                </div><!-- card-option -->
              </div><!-- card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered">
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
                      <td><button type="button" class="btn btn-md btn-info btn3d editUser" title="Edit Student" data-toggle="modal" data-target="#student_edit_modal" data-id="<?php echo $row['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></button></td>
                      
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
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

<div class="modal fade" id="student_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="text-center font-weight-bold w-100" id="model_title">Add New Student</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
        <form class="user_form form-horizontal" action="createStudent.php" name="form" method="POST">
            <div class="card-body bd rounded-bottom">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Admission/Reg No.:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control admission" name="admission" id="admission" placeholder="Enter Admission" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">First Name:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Last Name:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name" required>
                  </div>
                </div>

                <!-- <div class="col-md-4">
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
                </div> -->

                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Phone:</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                  </div>
                </div> -->


                <div class="col-md-6">
                  <div class="form-group mult">
                      <label for="Class">Class<span class="required_icon" style="color:red;">*</span></label>
                      <select class="form-control select" name="class" id="selectclass" required>
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
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group mult">
                      <label for="Section">Section<span class="required_icon" style="color:red;">*</span></label>
                      <select class="form-control section" name="section" id="section" required>
                          <option value="" selected="selected">Select</option>
                         
                      </select>
                  </div>
                </div>
                 
              </div>
              

            </div><!-- card-body -->
           
            <div class="card-footer">
              <a href="<?php echo $web_root ?>app/setup/students.php" class="btn btn-md btn-danger">Cancel</a>
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
