<div class="br-header bg-br-primary">
  <div class="br-header-left">
    
  </div><!-- br-header-left -->
  <div class="br-header-right">
    <nav class="nav">
      <?php if($_SESSION['user_role_id'] != 1) { ?>
      <button class="btn btn-md btn-info" id="enableEdit">Enable Edit</button>
      <!-- <button class="btn btn-md btn-success" id="editEnabled">Edit Enabled</button> -->
      <!-- <button class="btn btn-md btn-warning" id="preview">Preview</button> -->
      <?php } ?>
    </nav>
  </div><!-- br-header-right -->
</div><!-- br-header -->