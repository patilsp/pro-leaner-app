<?php
include_once "session_token/checksession.php";
include_once "configration/config.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
?>
<!DOCTYPE html>
<html lang="en">    
    <head>
        <title>Tech E-Learning School</title>
        <meta charset="utf-8"/>       
        <meta name="viewport" content="width=device-width, initial-scale=1"/>      
        <link rel="shortcut icon" href="../assets/assets/media/logos/favicon.ico"/>
        <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>  
        <link href="../assets/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
      
</head>

<body  id="kt_body"  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-column flex-column-fluid">	
            <!-- Header Start -->
                <?php include("/fixed-blocks/new-header.php"); ?>
            <!-- Header End -->
			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid  container-xxl " id="kt_wrapper">
                <div class="toolbar d-flex flex-stack flex-wrap py-4 gap-2" id="kt_toolbar">
                    <div  class="page-title d-flex w-100 justify-content-between">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-3 m-0">
                            Users
                        </h1>

                        <a href="<?php echo $web_root ?>/index.php" class="btn btn-sm btn-flex btn-primary ms-5">
                           Back
                        </a>
                     <!--end::Title-->
                    </div>                   
                </div>
				<!--begin::Main-->
				<div class="d-flex flex-row flex-column-fluid align-items-stretch">					
					<!--begin::Content-->
					<div class="content flex-row-fluid" id="kt_content">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="card h-100 d-flex flex-column justify-content-between mb-4">
                                    <div class="card-header pt-2">
                                        <div class="card-title">
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span class="path1"></span><span class="path2"></span></i>                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search user">
                                            </div>
                                        </div>
                                        <div class="card-toolbar">
                                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                                <a href="#" class="btn btn-md btn-info"  data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                                                    <i class="fa fa-plus me-2" aria-hidden="true"></i>Add User
                                                </a>  
                                            
                                            </div>
                                        </div>
                                    </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                                        <thead>
                                            <tr>
                                            <th><div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1">
                                                </div>
                                            </th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
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
                                            <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1">
                                                </div>
                                            </td>

                                            <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['mobile']; ?></td>
                                            <td><?php echo $row['gender']; ?></td>
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
                    </div>
					<!--end::Content-->	
                </div>
                <!--end::Main-->

            <!--begin::Footer-->
                <?php include("/fixed-blocks/footer.php"); ?>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<div class="modal fade" id="kt_modal_invite_friends" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!-- <i class="fa fa-close" aria-hidden="true"></i> -->
                    <img alt="Logo" src="../assets/assets/media/close.png" class="h-35px"/>

                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-5">
            <form class="user_form form-horizontal" action="createUser.php" name="form" method="POST">
                <div class="mb-4">
                <div class="row ">
                  
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
                <a href="<?php echo $web_root ?>/app/users.php" class="btn btn-md btn-danger me-2">Cancel</a>
                <button type="submit" class="btn btn-md btn-info" name="submit">Submit</button>
                </div><!-- card-footer -->
            </form>

            </div>
        </div>
    </div>
</div>




                        
   
					


<!--begin::Javascript-->
<script>
    var hostUrl = "../assets/assets/";        
</script>

<script src="../assets/assets/plugins/global/plugins.bundle.js"></script>
<script src="../assets/assets/js/scripts.bundle.js"></script>
<script src="../assets/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="../../lib/select2/js/select2.min.js"></script>
<script src="../js/users.js"></script>
<!--end::Custom Javascript-->
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