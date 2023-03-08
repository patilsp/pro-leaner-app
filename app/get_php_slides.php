<?php
	include_once "session_token/checksession.php";
	include_once "configration/config.php";
	include "functions/db_functions.php";
	try{
		$topics = array();
		
		for ($x = 1; $x <= 10; $x++) {
			$classsearch = "CLASS ".$x;
	  		$query = "SELECT id FROM $master_db.mdl_course_categories WHERE name = ? AND depth = 1 AND visible = 1";
			$stmt = $db->prepare($query);
			$stmt->execute(array($classsearch));
			$rowcount = $stmt->rowCount();
			if($rowcount > 0){
				while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
					$query1 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 2 AND visible = 1 ORDER BY sortorder";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($fetch['id']));
			  		$rowcount1 = $stmt1->rowCount();
			  		if($rowcount1 > 0){
			  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
			  				$query2 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 3 AND visible = 1 ORDER BY sortorder";
					  		$stmt2 = $db->prepare($query2);
					  		$stmt2->execute(array($fetch1['id']));
					  		$rowcount2 = $stmt2->rowCount();
					  		if($rowcount2 > 0){
					  			while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					  				$query3 = "SELECT id, fullname FROM $master_db.mdl_course WHERE category = ? AND visible = 1 ORDER BY sortorder";
							  		$stmt3 = $db->prepare($query3);
							  		$stmt3->execute(array($fetch2['id']));
							  		$rowcount3 = $stmt3->rowCount();
							  		if($rowcount3 > 0){
							  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							  				$topic_id_arr = array();
						  					$topic_id_arr['id'] = $fetch3['id'];
						  					$topic_id_arr['description'] = $fetch3['fullname'];
						  					array_push($topics, $topic_id_arr);
							  			}
						  			}
					  			}
				  			}
			  			}
		  			}
				}
				//return $topics;
			}
		}
		/*echo "<pre/>";
		print_r($topics);*/
		$slides_arr = array();
		foreach($topics as $topic){
			$si = 0;
			$topic_id = $topic['id'];
			$lessons = GetRecords("$master_db.mdl_lesson", array("course"=>$topic_id));
		 	foreach($lessons as $lesson)
		 	{
				$lessonid = $lesson['id'];
			 	$slide_sequences = array();
				$contents = array();
				$slideIDs = array();
				$nedpgids = array();
				$pvedpgids = array();
				$status = array();
				$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lessonid, "prevpageid"=>0));
				$nextpageid = $page['nextpageid'];
				array_push($contents, DecryptContent($page['contents']));
				array_push($slideIDs, $page['id']);
				array_push($nedpgids, $page['nextpageid']);
				array_push($pvedpgids, $page['prevpageid']);
				array_push($status, $page['status']);

				while($nextpageid != 0)
				{
					//echo "<br />$lessonid--$nextpageid--CAME";
					$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lessonid, "id"=>$nextpageid));				
					array_push($slide_sequences, $page['id']);
					$nextpageid = $page['nextpageid'];
					array_push($contents, DecryptContent($page['contents']));
					array_push($slideIDs, $page['id']);
					array_push($nedpgids, $page['nextpageid']);
					array_push($pvedpgids, $page['prevpageid']);
					array_push($status, $page['status']);
				}
				
				foreach($contents as $key=>$content)
				{
					$si++;
					$slide_name = "G".$class_id."_".$topic_code."-".$slideIDs[$key]."_S".$si;
					$slides_arr[] = $web_root."app/".$content;
				}
			}
		}
		/*echo "<pre/>";
		print_r($slides_arr);*/
		//return $slides_arr;
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
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../lib/highlightjs/github.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- CMS CSS -->
    <link rel="stylesheet" href="../css/cms.css">
  </head>
  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
            <h6 class="mg-b-0 tx-14 tx-white">PHP Slide List</h6>
            <?php
              if($role_id == "1") {
            ?>
            <div class="card-option tx-24">
              <a href="transactions/id/assignWork.php" class="btn btn-md btn-info">New Task</a>
            </div><!-- card-option -->
            <!-- <div class="card-option tx-24">
              <a href="transactions/id/bulk_publish.php" class="btn btn-md btn-info">Bulk Publish</a>
            </div> --><!-- card-option -->
            <?php
              }
            ?>
          </div><!-- card-header -->
          <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered sourced-data">
              <thead>
                <tr>
                  	<th>Slide Path</th>
					<th>Count</th>
                </tr>
              </thead>
              <tbody>
            	<?php
					foreach ($slides_arr as $slides) {
						$data = pathinfo($slides); 
						$file_name = $data[filename];
						$filename_ext = explode("_", $file_name);
						$fn_ext = end($filename_ext);

						$filepath_ext = explode(".", $slides);
						$ext = end($filepath_ext);
						if($ext == "php" || $fn_ext == "php"){	
					?>
						
						<tr>
							<td><?php echo $slides; ?></td>
							<td></td>
						</tr>
				<?php 
						}
					}
				?>
              </tbody>
         	</table>
          </div><!-- card-body -->
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->


    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../lib/jquery/jquery.js"></script>
    <script src="../lib/popper.js/popper.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../lib/moment/moment.js"></script>
    <script src="../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../lib/peity/jquery.peity.js"></script>
    <script src="../lib/highlightjs/highlight.pack.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    
    <script src="../lib/select2/js/select2.min.js"></script>

    <script src="../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable').DataTable({
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
              'excel'
          ]
        });
        $(".pub_btn").click(function(e){
          e.preventDefault();
          $("#pub_modal").modal("show");
        })
      });
    </script>
  </body>
</html>

		
<?php
}catch(Exception $exp){
	echo "<pre/>";
	print_r($exp);
	return "false";
}

function DecryptContent($contents)
{
	global $db, $master_db;
	$desc = $contents;
	$filepath = "";
	if(($objstart = strpos($desc, "<object "))){
		$objend = strpos($desc, "</object>", $objstart);
		$datastart = strpos($desc, "data=", $objstart) ;
		$dataend = strpos($desc, "\"", $datastart + strlen("data=")+2) ;
		$pathstart = strpos($desc, '"', $datastart) + 1;
		$pathend = strpos($desc, '"', $pathstart) - 1;
		$filepath = substr($desc, $pathstart, $pathend - $pathstart + 1 );
		$filepath = str_replace("../../","",$filepath);
	}
	return $filepath;
}
?>