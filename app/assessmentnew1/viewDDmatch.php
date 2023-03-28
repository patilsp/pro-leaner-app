<?php
  session_start();
  include "../configration/config.php";
  require_once "../functions/db_functions.php";
?>
<!DOCTYPE html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />

    <title>PMS - Dashboard</title>
    
  <?php //include("../../componets/style.php"); ?>
</head>

<body>
<?php
  $qustDetailsId = $_GET['qustId'];
  //get Qust Type
  $query = "SELECT * FROM qp_questiondetails WHERE id=?";
  $stmt = $db->prepare($query);
  $stmt->execute(array($qustDetailsId));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $qustType = 1;//$row['qustType'];

  //Get Question Content
  $query = "SELECT * FROM qp_questions WHERE qustDetailsId=?";
  $stmt = $db->prepare($query);
  $stmt->execute(array($qustDetailsId));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $questionContent = $row['question'];
  $qustId = $row['id'];
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 p-2">
      <?php echo $questionContent; ?>
    </div>
  </div>
  <?php
    $ddmatchqusts = GetRecords("qp_ddmatchqust", array("qId"=>$qustId));
    foreach ($ddmatchqusts as $ddmatchqust) {
      $ddmatchan = GetRecord("qp_ddmatchans", array("ddMatchQustId"=>$ddmatchqust['id']));
  ?>
    <div class="row">
      <div class="col-6 p-2" style="border: 1px solid #000000"><?php echo $ddmatchqust['qustCol']; ?></div>
      <div class="col-6 p-2" style="border: 1px solid #000000"><?php echo $ddmatchan['ansCol']; ?></div>
    </div>
  <?php } ?>
</div>
	
	<?php //include("../../componets/js.php"); ?>
  <script src="../../assets/plugins/ckeditor/ckeditor.js"></script>
  <script src="../../assets/plugins/ckeditor/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
  <script src="../../assets/js/appConfig.js"></script>
</body>
</html>
