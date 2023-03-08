<div class="br-header bg-br-primary">
	<?php if($user_type != "Instructional Designer" && $user_type != "Content Reviewer" && $user_type != "Conceptprep Reviewer"){ ?>
	  	<div class="br-header-left">
			<button class="btn btn-md btn-info topbarNotepadCollapse" style="margin: 0px 5px;">Notepad</button>
			<button class="btn btn-md btn-warning privewAllSlidesTarget" style="margin: 0px 5px; cursor: pointer;" data-toggle="modal" data-target="#privewAllSlides">Preview ALL Slides</button>
	  	</div><!-- br-header-left -->
	  	<div class="br-header-right">
		    <nav class="nav">
		      <button class="btn btn-md btn-info" id="preview">Save &amp; Preview</button>
		      <?php if($_SESSION['user_role_id'] != 8){ ?>
		      <button class="btn btn-md btn-success" data-toggle="modal" data-target="#modaldemo3">Instruction &amp; Send</button>
		      <?php } ?>
		    </nav>
	  	</div><!-- br-header-right -->
		
  	<?php } else{ ?>
  		<div class="br-header-left">
			<button class="btn btn-md btn-warning privewAllSlidesTarget" style="margin: 0px 5px; cursor: pointer;" data-toggle="modal" data-target="#privewAllSlides">Preview ALL Slides</button>
	  	</div><!-- br-header-left -->
	  	<div class="br-header-right">
		    <nav class="nav">
		    	<button class="btn btn-md btn-info" id="preview">Save &amp; Preview</button>
		      	<button class="btn btn-md btn-success" data-toggle="modal" data-target="#add_topic_level_modal_review">Review &amp; Publish</button>
		    </nav>
	  	</div><!-- br-header-right -->
  	<?php
  	}
  	?>	
</div><!-- br-header -->