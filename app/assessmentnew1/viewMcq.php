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
  <style type="text/css">
    .options .right_ans {
        border-radius: 5px;
        box-shadow: 0 1px 4px 0 rgb(0 0 0 / 20%);
        border: solid 2px #26e552;
        background-color: #ebfdef;
    }
  </style>
</head>

<body>
	
<!-- <div class="container">
  <?php
    echo "<pre/>";
    print_r($_GET);
  ?>
  <p>testing<math xmlns="http://www.w3.org/1998/Math/MathML"><mroot><mn>2</mn><mn>1</mn></mroot></math></p>
</div> -->
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

  if($qustType == 1) {

  }
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 p-2">
      <?php echo $questionContent; ?>
    </div>
    <div class="col-12 p-2 mt-3 options">
      <ol type="a">
        <?php
          $query = "SELECT * FROM qp_mcqoptions WHERE qId=?";
          $stmt = $db->prepare($query);
          $stmt->execute(array($qustId));
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <li class="p-3 <?php if($row['correctAns']) { echo "right_ans"; } ?>"><?php echo $row['optionContent']; ?></li>
        <?php
          }
        ?>
      </ol>
    </div>
  </div>
</div>
	
	<?php //include("../../componets/js.php"); ?>
  <script src="../../assets/plugins/ckeditor/ckeditor.js"></script>
  <script src="../../assets/plugins/ckeditor/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
  <script src="../../assets/js/appConfig.js"></script>
</body>
</html>
