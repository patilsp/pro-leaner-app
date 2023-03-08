<div class="br-header bg-br-primary">
	<?php if($user_type != "Instructional Designer"){ ?>
	  	<div class="br-header-left">
			<button class="btn btn-md btn-info topbarNotepadCollapse" style="margin: 0px 5px;">Notepad</button>
	  	</div><!-- br-header-left -->
	  	<div class="br-header-right">
		    <nav class="nav">
		      <button class="btn btn-md btn-info" id="preview">Save &amp; Preview</button>
		      <button class="btn btn-md btn-success" data-toggle="modal" data-target="#modaldemo3">Instruction &amp; Send</button>
		    </nav>
	  	</div><!-- br-header-right -->
  	<?php } else{ ?>
  		<div class="br-header-left">
			
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