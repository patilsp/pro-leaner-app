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
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 p-2">
      <?php echo $questionContent; ?>
    </div>
    <div class="col-12">
      <ol class="p-0">
        <?php
          $htmlData = '';
          $qustFillInTheBlanks = GetRecords("qp_fillintheblank", array("qId"=>$qustId));
          foreach ($qustFillInTheBlanks as $qustFillInTheBlank) {
            //echo $qustFillInTheBlank['qustFill']; echo '<br/>';
            $qustParts = explode(' ', $qustFillInTheBlank['qustFill']);

            $htmlData ='';
              echo '<li class="d-flex align-items-center m-2">' ;
              $convFitb = str_replace('[blank]', '<input type="text" data-attr="'.$qustFillInTheBlank['id'].'" class="form-control inputBox" style="width: 100%;margin: 0px 1rem;max-width: 200px;">', $qustFillInTheBlank['qustFill']);
              $htmlData .= $convFitb;
                /*echo "<pre/>";
                print_r($qustParts);
                foreach ($qustParts as $qustPart) {
                  if($qustPart == '[blank]') {
                    echo "---".$qustPart;echo "<br/>";
                    $qustPart = '<input type="text" data-attr="'.$fillInTheBlank['id'].'" class="form-control inputBox" style="width: 100%;margin: 0px 1rem;max-width: 200px;">';
                  }
                  $htmlData .= ' '.$qustPart;
                }*/
              echo $htmlData;
              echo '</li>';
          }
        ?>
      </ol>
    </div>
  </div>
</div>
	
	<?php //include("../../componets/js.php"); ?>
  <script src="../../assets/js/appConfig.js"></script>
</body>
</html>
