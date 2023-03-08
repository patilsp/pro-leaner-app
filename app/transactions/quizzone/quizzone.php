<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
include_once "../../configration/config_schools.php";
include "../../functions/db_functions.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$role_id = $_SESSION['user_role_id'];
try {
  include "../../functions/common_functions.php";
  $getTaskList = getTaskList($role_id, $logged_user_id);
  /*echo "<pre/>";
  print_r($getTaskList);*/
  	$class_val = "";
  	$date_val = "";
  	if(isset($_POST['SubmitButton'])){
  		$class_val = $_POST['choose_class'];
  		$date_val = $_POST['date'];
  	}
  	if($date_val == "")
  		$date_val = "";
  	else
  		$date_val = date("m/d/Y", strtotime($date_val));
  } catch(Exception $exp){
  print_r($exp);
}
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
    <link href="../../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/highlightjs/github.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../lib/jquery_ui/jquery-ui.css">
    <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet"> -->

    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    <style type="text/css">
    	.myaccordion {
			  /*max-width: 500px;*/
			  margin: 50px auto;
			  box-shadow: 0 0 1px rgba(0,0,0,0.1);
			}

			.myaccordion .card,
			.myaccordion .card:last-child .card-header {
			  border: none;
			}

			.myaccordion .card-header {
			  border-bottom-color: #EDEFF0;
			  background: transparent;
			}

			.myaccordion .fa-stack {
			  font-size: 18px;
			}

			.myaccordion .btn {
			  width: 100%;
			  font-weight: bold;
			  color: #004987;
			  padding: 0;
			}

			.myaccordion .btn-link:hover,
			.myaccordion .btn-link:focus {
			  text-decoration: none;
			}

			.myaccordion li + li {
			  margin-top: 10px;
			}
			#accordion .card-header button:after {
			  content: '-';
		    float: right;
		    font-size: 30px;
		    color: #ffffff;
		    background: #004987;
		    width: 30px;
		    height: 30px;
		    display: flex;
		    align-items: center;
		    justify-content: center;
		    border-radius: 50%;
			}

			#accordion .card-header button.collapsed:after {
			  content: '+';
			}
    </style>
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
      	<div class="card h-100 d-flex flex-column justify-content-between">
      		<div class="card-body text-center p-0">
      			<div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
					    <h6 class="mg-b-0 tx-14 tx-white py-2">Quiz Zone</h6>
					    <div class="card-option tx-24">
					    </div><!-- card-option -->
						</div><!-- card-header -->
						<form id="filter_form" action="#" method="post">
							<div class="row text-left">
								<div class="col-md-12 d-flex justify-content-center mt-5">
									<div class="form-group col-md-2">
								    <label for="choose_class">Class</label>
								    <select class="form-control" required="required" name="choose_class" id="choose_class">
								    	<option value="">-Select Class-</option>
								    	<?php
								    		$class_array = array("3-4","5-6","7-8","3-3","4-4", "5-5", "6-6", "7-7", "8-8", "9-9", "10-10");
								    		foreach ($class_array as $key => $value) {
								    			if($value == $class_val)
								    				$Selected = 'Selected="Selected"';
								    			else
								    				$Selected = "";
						    			?>
					    					<option value="<?php echo $value; ?>" <?php echo $Selected; ?>><?php echo $value; ?></option>
						    			<?php
					    					}
								    	?>
								    </select>
								  </div>
								  <div class="form-group col-md-2">
								    <label for="date">Date</label>
								    <input type="text" required="required" class="form-control date" name="date" id="date" placeholder="Choose Date" value="<?php echo $date_val; ?>">
								  </div>
								  <button type="submit" class="btn btn-md btn-info" name="SubmitButton">Submit</button>
								</div>
					    </div>
				  	</form>
				  	<?php
				  		if(isset($_POST['SubmitButton'])){
				  	?>
						<div id="accordion" class="myaccordion px-2">
						  <div class="card">
						    <div class="card-header p-0" id="headingOne">
						      <h2 class="mb-0">
						        <button class="p-3 d-flex align-items-center justify-content-between btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">English</button>
						      </h2>
						    </div>
						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
						      <div class="card-body">
						      	<?php
						      		$i=0;
						      		$date = date("Y-m-d", strtotime($_POST['date']));
							  		$query = "SELECT * FROM quizzone_questions WHERE date = ? AND class_group = ? AND sub_id = ?";
									$stmt = $dbs->prepare($query);
									$stmt->execute(array($date, $_POST['choose_class'], 1));
									$rowcount = $stmt->rowCount();
								?>
					        	<div class="card h-100 d-flex flex-column justify-content-between">
										  <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
										    <h6 class="mg-b-0 tx-14 tx-white">Quiz</h6>
										    <div class="card-option tx-24" id="english_btn">
									    	<?php
									    		if($rowcount == 0){
								    		?>
										      <a href="slideCreate.php?class=<?php echo $class_val; ?>&date=<?php echo $date_val; ?>&subject=1&slide=new" class="add_question btn btn-md btn-info">Add/Create Question</a>
									      	<?php } ?>
										    </div><!-- card-option -->
											</div><!-- card-header -->
										  <div class="card-body">
										    <table id="datatable" class="table table-striped table-bordered sourced-data">
										      <thead>
										        <tr>
										          <th>SNO</th>
										          <th>Date of Question</th>
										          <th>Activity Type</th>
										          <th>Action</th>
										        </tr>
										      </thead>
										      <tbody>
										      	<?php
															if($rowcount) {
																while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
												      		$id = $fetch['id'];
																	$layout_id = $fetch['layout_id'];
																	$slide_title = $fetch['slide_title'];
																	$date = $fetch['date'];

																	$query1 = "SELECT name FROM resources WHERE id = ?";
																	$stmt1 = $db->prepare($query1);
																	$stmt1->execute(array($layout_id));
																	while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC))
																		$act_type = $fetch1['name'];
												    	
										      	?>
									        	<tr>
									        		<td><?php echo ++$i; ?></td>
									        		<td><?php echo $_POST['date']; ?></td>
									        		<td><?php echo $act_type ; ?></td>
									        		<td class="action_english d-flex">
								        			<?php
								        				$today = date("Y-m-d H:i:s");
								        				$datecom = date("Y-m-d H:i:s", strtotime($date));
								        				//if ($datecom >= $today){
								        			?>
									        			<a href="slideCreate.php?class=<?php echo $_POST['choose_class']; ?>&qid=<?php echo $id; ?>&subject=1&date=<?php echo date("d-m-Y", strtotime($_POST['date'])); ?>&slide=existing" class="add_question btn btn-md btn-info mr-3">Edit</a>
									        			<button type="button" data-qid="<?php echo $id; ?>" data-subject="1" data-date="<?php echo date("d-m-Y", strtotime($_POST['date'])); ?>" class="delete_question btn btn-md btn-info">Delete</button>
								        			<?php //} ?>
									        		</td>
									        	</tr>
									        	<?php
									        			}
									        		}
									        	?>
										      </tbody>
										    </table>
										  </div><!-- card-body -->
										</div>
						      </div>
						    </div>
						  </div>
						  <div class="card">
						    <div class="p-0 card-header" id="headingTwo">
						      <h2 class="mb-0">
						        <button class="p-3 d-flex align-items-center justify-content-between btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Math</button>
						      </h2>
						    </div>
						    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
						      <div class="card-body">
						      	<?php
						      		$i=0;
						      		$date = date("Y-m-d", strtotime($_POST['date']));
							  		$query = "SELECT * FROM quizzone_questions WHERE date = ? AND class_group = ? AND sub_id = ?";
									$stmt = $dbs->prepare($query);
									$stmt->execute(array($date, $_POST['choose_class'], 2));
									$rowcount = $stmt->rowCount();
								?>
					        	<div class="card h-100 d-flex flex-column justify-content-between">
										  <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
										    <h6 class="mg-b-0 tx-14 tx-white">Quiz</h6>
										    <div class="card-option tx-24" id="english_btn">
									    	<?php
									    		if($rowcount == 0){
								    		?>
										      <a href="slideCreate.php?class=<?php echo $class_val; ?>&date=<?php echo $date_val; ?>&subject=2&slide=new" class="add_question btn btn-md btn-info">Add/Create Question</a>
									      	<?php } ?>
										    </div><!-- card-option -->
											</div><!-- card-header -->
										  <div class="card-body">
										    <table id="datatable" class="table table-striped table-bordered sourced-data">
										      <thead>
										        <tr>
										          <th>SNO</th>
										          <th>Date of Question</th>
										          <th>Activity Type</th>
										          <th>Action</th>
										        </tr>
										      </thead>
										      <tbody>
										      	<?php
															if($rowcount) {
																while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
												      		$id = $fetch['id'];
																	$layout_id = $fetch['layout_id'];
																	$slide_title = $fetch['slide_title'];
																	$date = $fetch['date'];

																	$query1 = "SELECT name FROM resources WHERE id = ?";
																	$stmt1 = $db->prepare($query1);
																	$stmt1->execute(array($layout_id));
																	while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC))
																		$act_type = $fetch1['name'];
												    	
										      	?>
									        	<tr>
									        		<td><?php echo ++$i; ?></td>
									        		<td><?php echo $_POST['date']; ?></td>
									        		<td><?php echo $act_type ; ?></td>
									        		<td class="action_english d-flex">
								        			<?php
								        				$today = date("Y-m-d H:i:s");
								        				$datecom = date("Y-m-d H:i:s", strtotime($date));
								        				//if ($datecom >= $today){
								        			?>
									        			<a href="slideCreate.php?class=<?php echo $_POST['choose_class']; ?>&qid=<?php echo $id; ?>&subject=2&date=<?php echo date("d-m-Y", strtotime($_POST['date'])); ?>&slide=existing" class="add_question btn btn-md btn-info mr-3">Edit</a>
									        			<button type="button" data-qid="<?php echo $id; ?>" data-subject="2" data-date="<?php echo date("d-m-Y", strtotime($_POST['date'])); ?>" class="delete_question btn btn-md btn-info">Delete</button>
								        			<?php //} ?>
									        		</td>
									        	</tr>
									        	<?php
									        			}
									        		}
									        	?>
										      </tbody>
										    </table>
										  </div><!-- card-body -->
										</div>
						      </div>
						    </div>
						  </div>
						  <div class="card">
						    <div class="p-0 card-header" id="headingThree">
						      <h2 class="mb-0">
						        <button class="p-3 d-flex align-items-center justify-content-between btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">Value Based</button>
						      </h2>
						    </div>
						    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
						      <div class="card-body">
						      	<?php
						      		$i=0;
						      		$date = date("Y-m-d", strtotime($_POST['date']));
							  		$query = "SELECT * FROM quizzone_questions WHERE date = ? AND class_group = ? AND sub_id = ?";
									$stmt = $dbs->prepare($query);
									$stmt->execute(array($date, $_POST['choose_class'], 3));
									$rowcount = $stmt->rowCount();
								?>
					        	<div class="card h-100 d-flex flex-column justify-content-between">
										  <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
										    <h6 class="mg-b-0 tx-14 tx-white">Quiz</h6>
										    <div class="card-option tx-24" id="english_btn">
								    		<?php
									    		if($rowcount == 0){
								    		?>
										      <a href="slideCreate.php?class=<?php echo $class_val; ?>&date=<?php echo $date_val; ?>&subject=3&slide=new" class="add_question btn btn-md btn-info">Add/Create Question</a>
									      	<?php } ?>
										    </div><!-- card-option -->
											</div><!-- card-header -->
										  <div class="card-body">
										    <table id="datatable" class="table table-striped table-bordered sourced-data">
										      <thead>
										        <tr>
										          <th>SNO</th>
										          <th>Date of Question</th>
										          <th>Activity Type</th>
										          <th>Action</th>
										        </tr>
										      </thead>
										      <tbody>
										      	<?php
															if($rowcount) {
																while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
												      		$id = $fetch['id'];
																	$layout_id = $fetch['layout_id'];
																	$slide_title = $fetch['slide_title'];
																	$date = $fetch['date'];


																	$query1 = "SELECT name FROM resources WHERE id = ?";
																	$stmt1 = $db->prepare($query1);
																	$stmt1->execute(array($layout_id));
																	while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC))
																		$act_type = $fetch1['name'];
												    	
										      	?>
									        	<tr>
									        		<td><?php echo ++$i; ?></td>
									        		<td><?php echo $_POST['date']; ?></td>
									        		<td><?php echo $act_type ; ?></td>
									        		<td class="action_english d-flex">
								        			<?php
								        				$today = date("Y-m-d H:i:s");
								        				$datecom = date("Y-m-d H:i:s", strtotime($date));
								        				//if ($datecom >= $today){
								        			?>
									        			<a href="slideCreate.php?class=<?php echo $_POST['choose_class']; ?>&qid=<?php echo $id; ?>&subject=3&date=<?php echo date("d-m-Y", strtotime($_POST['date'])); ?>&slide=existing" class="add_question btn btn-md btn-info mr-3">Edit</a>
									        			<button type="button" data-qid="<?php echo $id; ?>" data-subject="3" data-date="<?php echo date("d-m-Y", strtotime($_POST['date'])); ?>" class="delete_question btn btn-md btn-info">Delete</button>
							        				<?php //} ?>
									        		</td>
									        	</tr>
									        	<?php
									        			}
									        		}
									        	?>
										      </tbody>
										    </table>
										  </div><!-- card-body -->
										</div>
						      </div>
						    </div>
						  </div>
						</div>
						<?php
							}
						?>
    			</div>
    		</div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- SMALL MODAL -->
    <div id="pub_modal" class="modal fade">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Notice</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-20">
            <p class="mg-b-5">This feature is disabled, Please Contact Tech Team </p>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/jquery_ui/jquery-ui.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/highlightjs/highlight.pack.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script> --}}
    
    <script src="../../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        /*$("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
				  $(e.target)
				    .prev()
				    .find("i:last-child")
				    .toggleClass("fa-minus fa-plus");
				});*/


        /*$('#datatable').DataTable({
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
              'excel'
          ]
        });*/
        $(".pub_btn").click(function(e){
          e.preventDefault();
          $("#pub_modal").modal("show");
        });

        $(".date").datepicker({
			    onSelect: function(dateText) {
			      //console.log("Selected date: " + dateText + ", Current Selected Value= " + this.value);
			      //$(this).change();
			      $("#english_btn").html('<a href="slideCreate.php?class='+$("#choose_class").val()+'&subject=1&date='+this.value+'&slide=new" class="add_question btn btn-md btn-info">Add/Create Question</a>')
			    }
			  })/*.on("change", function() {
			    display("Change event");
			  })*/;

		  	//Delete Questions
		  	$(".delete_question").on('click',function(){
			  	var qid = $(this).data("qid");
			  	var subject = $(this).data("subject");
			  	var date = $(this).data("date");

		      $.ajax({
		        url:"apis/deleteSlides.php",
		        method:'POST',
		        data:"qid="+qid+"&subject="+subject+"&date="+date+"&type=DeleteQuestion",
		        async:true,
		        success:function(data)
		        {
		          console.log(data);
		        },
		        beforeSend: function(){
		          $(".mLoading").addClass("active");
		        },
		        complete: function(){
		          $(".mLoading").removeClass("active");
	          }
		      });
		      $(this).closest('tr').remove();
	      });
      });
    </script>
  </body>
</html>