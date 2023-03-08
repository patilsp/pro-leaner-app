<div class="br-header bg-br-primary">
  <div class="br-header-left">
  </div><!-- br-header-left -->
  <div class="br-header-right">
    <nav class="nav">
      <div>
      <select class="form-control" name="class_name" id="class_name">
        <option value="">- Select Class -</option>
        <?php
          foreach ($getClasses as $auto_id => $class_name) {
        ?>
            <option value="<?php echo $auto_id; ?>"><?php echo $class_name; ?></option>
        <?php
          }
        ?>
      </select>
    </div>
    <div>
      <select class="form-control" name="topic" id="topic">
        <option value="">-Select Topics-</option>
      </select>
    </div>
    </nav>
  </div><!-- br-header-right -->
</div><!-- br-header -->