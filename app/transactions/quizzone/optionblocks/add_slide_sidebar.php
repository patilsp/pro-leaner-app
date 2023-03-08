<div class="br-logo bg-br-primary">
	<a href="<?php echo $web_root.'app/transactions/quizzone/quizzone.php'; ?>"><span>[</span><i class="menu-item-icon ion-ios-undo-outline tx-16">Return to TaskList</i><span>]</span></a>
</div>
<div class="br-sideleft overflow-y-auto">
	<?php
  	$date = date("Y-m-d", strtotime($_GET['date']));
  	$slides_arr = "";
  	if($_GET['slide'] == "new") {
  
  			$slides_arr ='
						<div class="row">
						  <div class="col-md-12">
						    <div class="card bd-0 shadow-base">
						    <div class="pd-y-20 pd-x-30 tx-center">
						      <h5 class="tx-inverse tx-roboto tx-normal mg-b-15">Click Here.. To</h5>
						      <a href="#" class="btn btn-info btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 topbarCollapse" data-classid ="'.$_GET['class'].'" data-topicid ="'.$_GET['subject'].'" data-date="'.$_GET['date'].'" data-lessonid ="" data-prev_slide_id ="">Add New Slide</a>
						    </div>
						  </div>
						  </div>
						</div>
						';
  	} else {
  		$date = date("Y-m-d", strtotime($_GET['date']));
  		$query = "SELECT * FROM quizzone_questions WHERE date = ? AND class_group = ? AND sub_id = ? AND id = ?";
		$stmt = $dbs->prepare($query);
		$stmt->execute(array($date, $_GET['class'], $_GET['subject'], $_GET['qid']));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
      		$id = $fetch['id'];
			$layout_id = $fetch['layout_id'];
			$slide_title = $fetch['slide_title'];
			$date = $fetch['date'];
			$qzone_slide_path = $fetch['slide_file_path'];
    	}
    	$slides_arr ='
          	<div class="row savedSlides">
              <div class="col-md-12">
                <div class="card bd-0 shadow-base">
                  <div class="pd-y-20 pd-x-30 tx-center">
                    <button type="button" data-taskid="" data-autoid="'.$id.'" data-topic_id="'.$_GET['subject'].'" data-classid="'.$_GET['class'].'" data-layoutid="'.$layout_id.'" data-date="'.$_GET['date'].'" data-qzone_slide_path="'.$qzone_slide_path.'" class="btn btn-danger btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickSavedSlides">'.$slide_title.'</button>
                  </div>
                </div>
              </div>
            </div>
          ';
	  }
	  echo $slides_arr;
  ?>
</div><!-- br-sideleft -->