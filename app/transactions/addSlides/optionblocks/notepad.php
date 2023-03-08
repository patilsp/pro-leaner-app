<!-- Topbar  -->
<nav id="topbar_notepad">
  <div id="dismiss_notepad">
    <i class="fas icon ion-close"></i>
  </div>
  <ul class="list-unstyled components">
    <form method="post" id="notepad_form" enctype="multipart/form-data">
      <div class="row" style="margin: 10px;">
        <div class="col-md-10" style="margin: 0px auto">
          <div class="card">
            <div class="card-header" style="color: #00BCD4;font-size: 18px;font-weight: bold;">Notepad</div>
            <div class="card-body">
              <?php
                $data = "";
                $query = "SELECT * FROM add_slide_notepad WHERE task_assign_id = ?";
                $stmt = $db->prepare($query);
                $stmt->execute(array($_GET['task_assi_id']));
                while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $data = $fetch['notepad'];
                }
              ?>
              <!-- <div id="summernote"><p>Hello PMS</p></div> -->
              <textarea class="input-block-level" id="summernote" name="notepad" rows="18">
                <?php echo $data; ?>
              </textarea>
            </div>
            <div class="card-footer">
              <center>
                <button type="submit" class="btn btn-md btn-info">Save</button>
              </center>
            </div>
          </div>
        </div>
      </div>
    </form>
  </ul>
</nav>