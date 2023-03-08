<div class="br-logo bg-br-primary">
	<?php
		$nav = $web_root."app/transactions/conceptprep/cptask.php";
	?>
	<a href="<?php echo $nav ?>"><span>[</span><i class="menu-item-icon ion-ios-undo-outline tx-16">Return to TaskList</i><span>]</span></a>
</div>
<div class="br-sideleft overflow-y-auto">
  <?php
  	$class_id = $_GET['class'];
    $subject_id = $_GET['subject'];
    $sideleft = getSlides($class_id, $subject_id);
    echo $sideleft['data'];
  ?>
  <br>
</div><!-- br-sideleft -->