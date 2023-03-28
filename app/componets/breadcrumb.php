<?php
	$url = $_SERVER['REQUEST_URI'];
 	$keys = parse_url($url); // parse the url
	$path = explode("/", $keys['path']); // splitting the path
	$last = end($path); // get the value of the last element 
  if(strpos($url, "enroll/") !== false) {
    $enrol = true;
  } else {
    $enrol = false;
  }
  if(strpos($url, "launch/") !== false) {
    $launch = true;
  } else {
    $launch = false;
  }
  $fielname = explode(".", $last);
  if($fielname[0] == "accessright"){
    if(isset($_GET['action'])){
      $page = "Teacher Users";
    } else {
      $page = "Admin Users";
    }
  } else if($enrol) {
    $page = "Enroll";
  } else if($launch) {
    $page = "Launch";
  }
  else{
    $page = "Create";
  }
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent px-0 py-2 mb-0 d-flex">
    <li class="breadcrumb-item"><a href="<?php echo $web_root ?>app/home.php" class="txt-blue font-weight-bold"><i class="fa fa-home mr-2"></i>Home</a></li>
    <li class="breadcrumb-item active font-weight-bold" aria-current="page"><?php echo $page; ?></li>
    <?php if($last !== "home.php" && $last !== "create.php"){ ?>
    	<li class="ml-auto breadcrumb-item last_bredcrumb_item"><a href="<?php echo $back_page ?>" class="txt-blue font-weight-bold" id="back_click">Back</a></li>
	<?php } ?>
  </ol>
</nav>