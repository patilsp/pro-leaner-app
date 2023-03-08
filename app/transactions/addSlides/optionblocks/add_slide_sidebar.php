<div class="br-logo bg-br-primary">
	<?php
		if($user_type == "Tech Team"){
			$nav = $web_root."app/taskList.php";
		} else if($user_type != "Instructional Designer"){ 
			$nav = $web_root."app/taskListOTR.php";
		} else {
			$nav = $web_root."app/taskListAddSlides.php";
		}
	?>
	<a href="<?php echo $nav ?>"><span>[</span><i class="menu-item-icon ion-ios-undo-outline tx-16">Return to TaskList</i><span>]</span></a>
</div>
<div class="br-sideleft overflow-y-auto">
  <?php
  	if($_GET['prev_slide'] != "ExistingTopic") {
	    $class_id = $_GET['class'];
	    $topic_id = $_GET['topic'];
	    //$date = date("Y-m-d", strtotime($_GET['date']));
	    $sideleft = getSlides($class_id, $topic_id);
    } else {
    	$class_id = $_GET['class'];
	    $topic_id = $_GET['topic'];
	    $task_assi_id = $_GET['task_assi_id'];
	    $getAddSlideExistingTopic = getRecord("tasks", array("id"=>$task_assi_id));
	    $json_prev_lessonid_slideid = $getAddSlideExistingTopic['slide_id'];

	    $sideleft = getSlidesExistingTopic($web_root, $class_id, $topic_id, $json_prev_lessonid_slideid, $task_assi_id);
	}
    echo $sideleft;
  ?>
  <br>
</div><!-- br-sideleft -->