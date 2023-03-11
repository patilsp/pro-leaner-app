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
            
            <div class="card h-100 d-flex flex-column justify-content-between mb-4">
              <div class="card-header">
                <h6 class="mg-b-0 tx-14 mt-4">Users</h6>
                <div class="card-option tx-24">
                  <!-- <a href="userCreation.php" class="btn btn-md btn-info" >New User</a> -->
                  <button class="btn btn-primary shadow" data-toggle="modal" data-target="#student_modal" id="add_student_bth">Add User</button>
                </div><!-- card-option -->
              </div><!-- card-header -->
              <div class="card-body">
                  <div class="table-responsive">
                      <table id="datatable" class="table table-striped table-bordered ">
                      <thead>

                        
                        <tr>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $i=1; 
                            $query="SELECT * FROM users where deleted=0";
                            $result=$db->query($query);
                            while($row = $result->fetch(PDO::FETCH_ASSOC))
                            { 
                                
                            ?>
                        <tr>

                          <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <!-- <td><button type="button" class="btn btn-info" onclick="location.href='updateUser.php?id=<?php //echo $row['id']; ?>';">Edit</button></td> -->
                          <td><button type="button" class="btn btn-sm btn-info mr-1 editUser" title="Edit User" data-toggle="modal" data-target="#student_edit_modal" data-id="<?php echo $row['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></button>
                        
                          <button type="button" class="btn btn-sm btn-danger deleteUser" title="Delete User" id='<?php echo $row['id']; ?>' >
                          <i class='fa fa-trash' aria-hidden='true'></i>
                        </button>
                        </td>
                          
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

<div class="modal fade" id="student_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="text-center font-weight-bold w-100 " id="model_title">Add New User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form class="user_form form-horizontal" action="createUser.php" name="form" method="POST">
            <div class="card-body table_responsive">
              <div class="row ">
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Emp Id:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Emp Id" required>
                  </div>
                </div> -->
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

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Password:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password*" required> 
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Confirm Password:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password*" required> 
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Email:<span class="required_icon" style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Phone:</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group mult">
                      <label for="Role">Role<span class="required_icon" style="color:red;">*</span></label>
                      <select class="form-control" name="role" id="role" required>
                          <option value="" selected="selected">Select</option>

                            <?php
                                $query = "SELECT * FROM roles WHERE id NOT IN('9','10')";
                                $stmt = $db->query($query);
                                while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                ?>
                                     <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>
                                <?php
                                    }
                                 ?>
                         
                      </select>
                  </div>
                </div>
  
              </div>
              

            </div><!-- card-body -->
           
            <div class="card-footer">
              <a href="<?php echo $web_root ?>app/setup/users.php" class="btn btn-md btn-danger">Cancel</a>
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
        <h4 class="text-center font-weight-bold w-100" id="model_title">Edit User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <form class="user_form form-horizontal" action="updateUser_validation.php" name="form" method="POST">
            <input type="hidden" class="form-control" name="user_auto_id" id="user_auto_id" value="">
            <div class="card">
              <div class="row card-body bd rounded-bottom">
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
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"> 
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Confirm Password:</label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password"> 
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
                    <label for="title">Phone:</label>
                    <input type="text" class="form-control" name="phone" id="phoneEdit" value="">
                  </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group mult">
                        <label class="col-md-12">Role<span class="required_icon" style="color:red;">*</span></label>
                        <select class="form-control" name="role" id="roleEdit" required>
                            <option value="" selected="selected">Select</option>

                              <?php
                                  $query = "SELECT * FROM roles WHERE id NOT IN('9','10')";
                                  $stmt = $db->query($query);
                                  while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
                                  {
                                  ?>
                                      <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']?></option>               
                                  <?php
                                      }
                                   ?>
                           
                        </select>
                    </div>
                </div>

                
                 
              </div>


            </div><!-- card-body -->
           
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="<?php echo $web_root ?>app/setup/users.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="submit" class="btn btn-md btn-info" name="update" id="update">Update</button>
            </div><!-- card-footer -->
          </form> 
      </div>
    </div>
  </div>
</div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="class_delete_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center p-10">
            <img src="../../assets/images/common/delete.svg" class="mb-2">
            <h4 class="font-weight-bold mb-3">Alert</h4>
            <p class="m-0 font-weight-bold">Are you sure you want to delete <span class="action_name"></span>? </p>

            <div class="position-relative d-flex justify-content-center mt-5">
              <button class="btn btn-md btn-blue font-weight-medium yes_bth mr-4" id="delete_class_yes">Yes</button>
              <button class="btn btn-md btn-blue font-weight-medium no_btn" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
    </div>

 <!-- Snackbar  -->
    <div id="snackbar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0" id="sb_heading"></h6>
        <button type="button" class="close close_snackbar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body"><span class="font-weight-bold m-0">Successfully Deleted</p>
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
        $(document).on('click', '.editUser', function() {
          var user_id = $(this).data('id');
          $.ajax({
            url:"updateUser.php",
            method:'GET',
            data: "user_id=" + user_id,
            dataType:"json",
            success:function(data)
            {
              $("#usernameEdit").val(data.username);
              $("#fnameEdit").val(data.first_name);
              $("#lnameEdit").val(data.last_name);
              $("#emailEdit").val(data.email);
              $("#phoneEdit").val(data.phone);
              $("#roleEdit").val(data.roles_id);
              $("#deptEdit").val(data.dept);
              $("#designationEdit").val(data.designation);
              $("#user_auto_id").val(data.user_auto_id);
            },
            beforeSend: function(){
                //$("body").mLoading()
            },
            complete: function(){
                //$("body").mLoading('hide')
            }
          });
        });


        $(document).on('click', '.deleteUser', function() {
            var stuID = $(this).attr('id');
            var username = $(this).data("username");
            $(".action_name").text(username);
            $('#class_delete_modal').modal({ backdrop: 'static', keyboard: false })
                .one('click', '#delete_class_yes', function (e) {
              $.ajax({
                    url:"apis/user_ajaxcalls.php",
                    method:'POST',
                    data: "stuID="+stuID+"&type=DeleteUser",
                    success:function(data)
                    {

                        $("#class_delete_modal").modal("hide");
                       
                        var json = $.parseJSON(data);
                        $("#sb_body").html(json.message);
                
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        $("#sb_body").html(json.message);
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1000);
                        // location.reload();
                        
                    },
                    beforeSend: function(){
                        //$("body").mLoading()
                    },
                    complete: function(){
                        //$("body").mLoading('hide')
                    }
              });  
            });
          });





      }) 
    </script>
  </body>
</html>
