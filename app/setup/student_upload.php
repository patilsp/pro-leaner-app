<?php session_start();
   include_once "../session_token/checksession.php";
   include_once "../configration/config.php";
   //include_once "session_token/checktoken.php";
   require_once "../functions/db_functions.php";
//   if(checkPageAccess(13, 1) !== true) {
//     die;
//   }


//   $back_page = $web_root."app/create.php";
//   if(count($studentsList) > 0){
//     $back_page = $web_root."app/student/student.php";
//   }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  	<title>ILP - PMS</title>

  	<!-- Common Styles -->
    <link rel="stylesheet" href="../../css/cms.css">
  	<link rel="stylesheet" href="../../css/student_upload.css">

  </head>
  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <div class="br-mainpanel">    
      <div class="br-pagebody"> 	

  		<section id="sudent" class="mt-5">

          <div class="row new-row-bg">      
          
          <div class="col-12">

  			<div class="card ">
                <div class=" card-header w-100 mx-auto mb-5 mx-3 d-flex align-items-center">
                    <h5 class="flex-grow-1">Students </h5>
                    <a href="<?php echo $web_root?>app/setup/students.php"><button class="btn btn-secondary shadow">Back</button></a>

                </div>

                <div class="col-12" id="upload_col">
                  <div class="row" id="sudent_modules">
                    <div class="col-12 text-center">
                
                    <h5 class="txt-grey mb-5">There is currently no Student Data</h5>
                    
                    <div class="d-flex align-items-center justify-content-center mb-5">
                        <h4 class="m-0">Download the Template</h4>
                        <a href="../../assets/templates/student/student_data_upload_template.xls"><img src="../../assets/images/student/download.svg" style="width: 40px; height: 40px" class="mx-3"></a>
                        <h4 class="m-0">and fill in the fields before uploading a file</h4>
                        </div>
                            <form id="import_excel_form" method="post" enctype="multipart/form-data">
                                <div class="d-flex justify-content-around align-items-center w-100 mx-auto" id="upload_blk">
                                    <label class="d-flex align-items-center justify-content-center btn btn-md btn-blue font-weight-medium text-white shadow" for="file-upload"> Upload File</label>
                                    <input id="file-upload" name="file" type="file"/>
                                    
                                    <div id="show_attachedfiel" class="show_attachedfiel d-flex align-items-center mx-3 border rounded-lg p-2">
                                    <img src="../../assets/images/student/excel.png" class="mr-3">
                                    <p class="m-0 font-weight-bold txt-grey" id="file-upload-filename">Student Data for Import</p>
                                    </div>
                                    <input type="hidden" value="validateExcel" name="type" >
                                    <button type="submit" class="btn btn-md btn-blue font-weight-medium text-white shadow review" id="review">Review</button>
                                </div>
                            </form>
                        <p class="font-weight-bold my-3">OR</p>
                        <a href="#" data-toggle="modal" data-target="#student_modal" class="txt-blue border-bottom border-primary font-weight-bold">Add manually</a>
                    </div>
                </div>
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
                                        <thead>
                                            <tr class="row">
                                            <th class="col-1 text-center">Row No</th>
                                            <th class="col-1 text-center">Admn.no</th>
                                            <th class="col-2 text-center">First Name</th>
                                            <th class="col-2 text-center">Last Name</th>
                                            <th class="col-1 text-center">Class</th>
                                            <th class="col-1 text-center">Section</th>
                                            <th class="col-4 text-center">Upload Errors</th>
                                            </tr>
                                        </thead>
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
                            <button class="shadow font-weight-bold" id="error_info" data-toggle="tooltip" data-placement="top" title="The data which has errors will be skipped and the remaning data will be uploaded">?</button>
                            </div>
                        </form>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
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
        <p class="text-left" style="max-width: 163px; width: 100%" id="sb_body">You added <span class="font-weight-bold m-0">4 sections under Class 2</span> successfully</p>
      </div>
    </div>



  	<!-- common scripts -->
    <?php include("../setup/common-blocks/js.php"); ?>
    <script src="../../js/student_upload.js"></script>
  </body>
</html>