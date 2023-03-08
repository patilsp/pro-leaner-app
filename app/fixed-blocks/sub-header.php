<!-- <link rel="stylesheet" href="<?php echo $web_root ?>assets/css/navbarstyle.css"> -->
<link rel="stylesheet" href="<?php echo $web_root ?>/css/navbarstyle.css">

 <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
    <!-- <a class="navbar-brand" href="#">
      <img src="https://placeholder.pics/svg/150x50/888888/EEE/Logo" alt="..." height="36">
    </a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link nav_link" href="<?php echo $web_root; ?>app/home.php">Home</a>
        </li>
            <li class="nav-item dropdown">
                <a class="nav-link nav_link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Setup
                </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <!-- <li><a class="dropdown-item" href="#">Roles</a></li>
                <li><a class="dropdown-item" href="#">Permissions</a></li>    -->
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/setup/users.php">Users</a></li>        
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/setup/classes.php">Classes</a></li>
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/setup/subjects.php">Subjects</a></li>
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/setup/teachers.php">Teachers</a></li>
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/setup/students.php">Students</a></li>
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/cp/cpModuleSetup.php">Curriculum</a></li>
                <li><a class="dropdown-item" href="#">Calender</a></li> 
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/transactions/cw/create_popup_words.php">Dictonary</a></li>
                
            </ul>
        </li>
        
        <!-- <li class="nav-item">
            <a class="nav-link nav_link" href="#">Task</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav_link" href="#">Resources</a>
        </li>

        <li class="nav-item">
            <a class="nav-link nav_link" href="#">Dictonary</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav_link" href="#">Slide Types</a>
        </li>

        <li class="nav-item">
            <a class="nav-link nav_link" href="#">Quiz Zone</a>
        </li> -->

        <li class="nav-item dropdown">
        <a class="nav-link nav_link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Content
        </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/transactions/conceptprep/cptask.php">Create</a></li>
                <li><a class="dropdown-item" href="<?php echo $web_root?>app/transactions/conceptprep/cptask.php">Review</a></li>           
                <li><a class="dropdown-item" href="#">Launch</a></li>           
              
            </ul>
        </li>

        <li class="nav-item dropdown">
        <a class="nav-link nav_link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Track
        </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Dashboard Widgets</a></li>
                <!-- <li><a class="dropdown-item" href="#">Review</a></li>           
                <li><a class="dropdown-item" href="#">Launch</a></li>            -->
              
            </ul>
        </li>

        <li class="nav-item dropdown">
        <a class="nav-link nav_link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Reports
        </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Performance</a></li>
                <!-- <li><a class="dropdown-item" href="#">test 2</a></li>            -->
              
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


