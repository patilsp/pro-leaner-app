<?php
  include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
?>
<!DOCTYPE html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />

    <title>PMS - Dashboard</title>
    
	<?php include("../../componets/style.php"); ?>
  <link rel="stylesheet" type="text/css" href="../../assets/plugins/datatable/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/assessment/assessment.css">
  <link href="../../assets/plugins/ajax_loader/jquery.mloading.css" rel="stylesheet">

  <style type="text/css">
    /*.delete-editor{
      position: absolute;
      top: -1.7rem;
      right: 0px;
      border-radius: 50%;
      width: 35px;
      height: 35px;
    }*/
  </style>
</head>

<body>
	
<div class="wrapper">
	<!--start top header-->
  <?php include("../../componets/header.php"); ?>
  <!--end top header-->

 	<!--start navigation-->
  <?php include("../../componets/navbar.php"); ?>
  <!--end navigation-->

  <!--start content-->
  <main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Assessment</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Assessment</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

    <div class="card ">
      <div class="card-body">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
          <div class="col-12">
            <div class="container-fluid">
              <form id="qust_form">
                <div class="" id="main-container">
                  <div class="card mb-3 custom-card">
                    <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Create Question Paper</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">View/Edit Question Paper</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Preview and Publish</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Evaluate</button>
                        </li>

                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="col-12 px-0 mt-3 " id="assessment">
                          <form id="" class="w-100 px-4 mt-3">
                            <div class="row mb-3 ">
                              <div class="form-group col-12 ">
                                <label for="title">Title</label>
                                  <input type="text" class="form-control" id="title" name="title" value="" placeholder="Type here">
                                </div>
          
                            </div>

                            <div class="row mb-3">
                           
                              <div class="form-group col-12 col-sm-6 col-md-3">
                                <label for="Category">Category</label>
                                <select class="form-select" id="Category" name="Category" aria-label="Floating label select Category">
                                  <option selected>Select Category</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </div>
                              <div class="form-group col-12 col-sm-6 col-md-3">
                                <label for="Subject">Subject</label>
                                <select class="form-select" id="subject" name="subjectId" aria-label="Floating label select subject">
                                  <option selected>Select Subject</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </div>

                              <div class="form-group col-12 col-sm-6 col-md-3">
                                <label for="Chapter">Chapter</label>
                                <select class="form-select" id="Chapter" name="Chapter" aria-label="Floating label select Chapter">
                                  <option selected>Select Chapter</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </div>
                              <div class="form-group col-12 col-sm-6 col-md-3">
                                <label for="Difficulty">Difficulty</label>
                                <select class="form-select" id="Difficulty" name="Difficulty" aria-label="Floating label select Difficulty">
                                  <option selected>Select Difficulty</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </div>

                            
                            </div>
                            <div class="row mb-3">
                              <div class="form-group col-12 col-sm-6 col-md-3">
                                <label for="time_allowed">Time allowed (in hrs)</label>
                                <input type="text" class="form-control" id="time_allowed" name="time_allowed" placeholder="Type Value" value="">
                              </div>

                              <div class="form-group col-12 col-sm-6 col-md-3">
                                <label for="total_marks">Total Marks</label>
                                <input type="text" class="form-control" id="total_marks" name="total_marks" disabled="disabled" placeholder="0">
                              </div>

                              <div class="form-group col-12 col-sm-6 col-md-3">
                                <label for="qust_paper_code">Question Paper Code</label>
                                <input type="text" class="form-control" id="qust_paper_code" name="qust_paper_code"placeholder="Type Value" value="" >
                              </div>

                              <div class="form-group col-12 col-sm-6 col-md-3">
                                <label for="qust_paper_code">No. of Attempts</label>
                                <select class="form-control" id="attempts" name="attempts">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="0">Unlimited</option>
                                </select>
                              </div>
                            </div>
                            </form>
                            <hr/>
                            <div class="row " id="custom-card">
                              <!-- <div class="text-right">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div> -->
                              <div class="form-group col-12 col-sm-6 col-md-5">
                                <label for="time_allowed">Section Heading</label>
                                <input type="text" class="form-control" id="time_allowed" name="time_allowed" placeholder="Type Value" value="">
                              </div>

                              <div class="form-group col-12 col-sm-6 col-md-5">
                                <label for="total_marks">Section Title</label>
                                <input type="text" class="form-control" id="total_marks" name="total_marks"  placeholder="Type Value" value="">
                              </div>
                               
 
                              <div class="form-group col-12 col-sm-6 col-md-2 p-4">
                                <label for="Marks">Marks</label>
                                <spna> 3</span>
                              </div>
                              
                              <div class="col-12 mt-5 Anssection">
                                <h5 class="text-left mb-3 font-weight-bold">1. What is x, if 2x+4 = 6?</h5>
                                <ol type="a" class="font-weight-bold">
                                  <li class="p-2">1</li>
                                  <li class="right_ans p-2">5</li>
                                  <li class="p-2">3</li>
                                  <li class="p-2">6</li>

                                </ol>
                              </div>
                              <hr />
                              <div class="text-center w-100 ms-auto mt-5 mb-3">
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal1"><i class="bi bi-plus"></i>Add Question</button> 
                              </div>
                            </div>
                            <div class="text-left w-100 ms-auto mt-5 mb-3">
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal2"><i class="bi bi-plus"></i>Add Question</button> 
                              </div>

                          
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row mb-3 mt-3">
                           
                           <div class="form-group col-12 col-sm-6 col-md-6">
                             <label for="Category">Category</label>
                             <select class="form-select" id="Category" name="Category" aria-label="Floating label select Category">
                               <option selected>Select Category</option>
                               <option value="1">One</option>
                               <option value="2">Two</option>
                               <option value="3">Three</option>
                             </select>
                           </div>
                           <div class="form-group col-12 col-sm-6 col-md-6">
                             <label for="Subject">Subject</label>
                             <select class="form-select" id="subject" name="subjectId" aria-label="Floating label select subject">
                               <option selected>Select Subject</option>
                               <option value="1">One</option>
                               <option value="2">Two</option>
                               <option value="3">Three</option>
                             </select>
                           </div>
                           
                         
                         </div>
                         <hr />

                         <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
                            <div class="col-12">
                              <div class="container-fluid">
                                <table id="assessment_view_table" class="table dataTable" style="width:100%">
                                <thead>
                                      <tr>
                                          <th>Question Paper Code</th>
                                          <th>Title</th>
                                          <th>Total Marks</h>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>EO2</td>
                                          <td>English Olympiad - 2</td>
                                          <td>30</td>
                                          <td>
                                            <a id="addMore" class="btn-circle "><i class="bi bi-pencil-fill"></i></a>
                                            <a id="removeMore" class="btn-circle"><i class="bi bi-trash-fill"></i></a>
                                        </td>
                                      </tr>
                                  </tbody>
                              </table>
                              </div>
                            </div>
                          </div><!--end row-->

                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                        <div class="row mb-3 mt-3">
                           
                           <div class="form-group col-12 col-sm-6 col-md-6">
                             <label for="Category">Category</label>
                             <select class="form-select" id="Category" name="Category" aria-label="Floating label select Category">
                               <option selected>Select Category</option>
                               <option value="1">One</option>
                               <option value="2">Two</option>
                               <option value="3">Three</option>
                             </select>
                           </div>
                           <div class="form-group col-12 col-sm-6 col-md-6">
                             <label for="Subject">Subject</label>
                             <select class="form-select" id="subject" name="subjectId" aria-label="Floating label select subject">
                               <option selected>Select Subject</option>
                               <option value="1">One</option>
                               <option value="2">Two</option>
                               <option value="3">Three</option>
                             </select>
                           </div>
                           
                         
                         </div>
                         <hr />

                         <div class="row">
                           
                            <div class="text-right mb-3">
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#previewpublishmodal">Add Question</button> 
                              </div>
                                <table id="preview_publish" class="table tabel-borderd dataTable" style="width:100%">
                                  <thead>
                                      <tr>
                                        <th>
                                          <input type="checkbox" name="myTextEditBox" value="checked" /> checkbox
                                        </th>
                                          <th>Question Paper Code</th>
                                          <th>Title</th>
                                          <th>Total Marks</h>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                      <td>
                                          <input type="checkbox" name="myTextEditBox" value="checked" /> checkbox
                                        </td>
                                          <td>EO2</td>
                                          <td>English Olympiad - 1</td>
                                          <td>30</td>
                                          <td>
                                            <a id="addMore" class="btn-circle "><i class="bi bi-eye-fill"></i></a>                                           
                                        </td>
                                      </tr>
                                  </tbody>
                              </table>
               
                          </div><!--end row-->
                        </div>

                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">

                        <div class="row mb-3 mt-3">

                        <?php include "reviewAssessment.php"; ?>


                     
                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div><!--end row-->
      </div>
    </div>
  </main>
	<!--end page main-->


	<!--start overlay-->
	<div class="overlay nav-toggle-icon"></div>
	<!--end overlay-->

	<!--Start Back To Top Button-->
	<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
	<!--End Back To Top Button-->
</div>
<!-- ./wrapper -->

<?php include 'evaluateAnswer.php' ?>
	
	<?php include("../../componets/js.php"); ?>
  <script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script src="../../assets/plugins/ckeditor/ckeditor.js"></script>
  <script src="../../assets/plugins/ckeditor/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
	<script src="../../assets/js/appConfig.js"></script>
  <script src="../../assets/plugins/ajax_loader/jquery.mloading.js"></script>
  <script src="../../assets/js/assessment/assessment.js"></script>


</body>
</html>
