<?php
  include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
  include "../../functions/db_functions.php";
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
  <style type="text/css">
    .bi-x-circle {
      font-size: 30px;
      cursor: pointer;
    }
    .qustCard .input-group-text {
      position: absolute;
      top: 0px;
      right: 0px;
      z-index: 8;
    }
    #cqp .card {
      border: 1px solid rgba(0,0,0,.125);
    }
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
      <div class="breadcrumb-title pe-3">Question Bank</div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="tab" href="#cqp" role="tab" aria-selected="true">
              <div class="d-flex align-items-center">
                <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                </div>
                <div class="tab-title">Create Question Paper</div>
              </div>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#veqp" role="tab" aria-selected="false">
              <div class="d-flex align-items-center">
                <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                </div>
                <div class="tab-title">View/Edit Question Paper</div>
              </div>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#pp" role="tab" aria-selected="false">
              <div class="d-flex align-items-center">
                <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                </div>
                <div class="tab-title">Preview and Publish</div>
              </div>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#review" role="tab" aria-selected="false">
              <div class="d-flex align-items-center">
                <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                </div>
                <div class="tab-title">Review</div>
              </div>
            </a>
          </li>
        </ul>
        <div class="tab-content py-3">
          <div class="tab-pane fade show active" id="cqp" role="tabpanel">
            <form id="qust_form">
              <div class="" id="main-container">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row g-2 mb-3">
                      <div class="col-md">
                        <div class="form-floating">
                          <select class="form-select classSelect" id="class" name="classId" aria-label="Floating label select class">
                            <option selected>Select Class</option>
                            <?php 
                              $cat = GetRecords("modulesetup", array("deleted"=>0, "type"=>"class"));
                              foreach ($cat as $list) {
                            ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['module']; ?></option>
                            <?php } ?>
                          </select>
                          <label for="class">Class</label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating">
                          <select class="form-select" id="subject" name="subjectId" aria-label="Floating label select subject">
                            <option selected>Select Subject</option>
                          </select>
                          <label for="subject">Subject</label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <input type="text" name="ta" class="form-control" id="floatingInput" placeholder="Time allowed (in hrs)">
                          <label for="floatingInput">Time allowed (in hrs)</label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating mb-3">
                          <input type="text" name="tm" value="0" class="form-control" id="floatingInput" placeholder="Total Marks" disabled readonly>
                          <label for="floatingInput">Total Marks</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-12">
                    <button class="btn btn-info float-end" type="button" class="addSection"><i class="bi bi-plus"></i> Add Section</button>
                  </div>
                </div>

                <!-- Section start Append Here... -->
                <span class="qpSections">
                  <div class="card qustCard">
                    <div class="card-header py-0 border-0">
                      <div class="page-breadcrumb d-sm-flex align-items-center">
                        <div class="breadcrumb-title pe-3 border-0"></div>
                        <div class="ms-auto">
                          <i class="bi bi-x-circle deleteSection"></i>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row g-2 mb-3">
                        <div class="page-breadcrumb d-sm-flex align-items-center">
                          <div class="breadcrumb-title pe-3 border-0 w-100">
                            <div class="row">
                              <div class="col-md">
                                <div class="form-floating mb-3">
                                  <textarea class="form-control" name="sh[]" class="form-control" id="sh" placeholder="Section Heading"></textarea>
                                  <label for="sh">Section Heading</label>
                                </div>
                              </div>
                              <div class="col-md">
                                <div class="form-floating mb-3">
                                  <textarea class="form-control" name="st[]" class="form-control" id="st" placeholder="Section Ttitle"></textarea>
                                  <label for="st">Section Title</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <div class="form-floating mb-3">
                              <input type="text" name="tm" value="0" class="form-control" id="sec[0]" placeholder="Marks">
                              <label for="sec0">Marks</label>
                            </div>
                          </div>
                        </div>
                        <div class="d-sm-flex">
                          <div class="pe-3 border-0 w-100">
                            <div class="row">
                              <div class="col-md">
                                <ol>
                                  <li>
                                    What is x, if 2x+4 = 6?
                                    <ol type="a">
                                      <li>1</li>
                                      <li>2</li>
                                      <li>3</li>
                                    </ol>
                                  </li>
                                </ol>
                              </div>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" aria-describedby="secQust1Mark">
                              <span class="input-group-text" id="basic-secQust1Mark"><i class="bi bi-trash-fill"></i></span>
                            </div>
                          </div>
                        </div>
                        <hr/>
                        <div class="col-12 d-flex justify-content-end">
                          <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="bi bi-plus"></i> Add Question</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </span>
                <!-- Section End -->
              </div>
              <div class="card-footer text-center">
                <button type="submit" name="submit" class="btn btn-info">Save &amp; Preview</button>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="veqp" role="tabpanel">
            
          </div>
          <div class="tab-pane fade" id="pp" role="tabpanel">
            
          </div>
          <div class="tab-pane fade" id="review" role="tabpanel">
            
          </div>
        </div>
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

<!-- Modal -->
<div class="modal fade" id="previewQuestion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">View Question </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bindHTML"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addNewQust">Add New Question</button>
      </div>
    </div>
  </div>
</div>
	
	<?php include("../../componets/js.php"); ?>
  <script src="../../assets/plugins/ckeditor/ckeditor.js"></script>
  <script src="../../assets/plugins/ckeditor/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
	<script src="../../assets/js/appConfig.js"></script>
  <script src="../../assets/js/qp/qustPaper.js"></script>
</body>
</html>
