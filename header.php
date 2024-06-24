<?php session_start();?>

<!doctype html>
<html lang="en">
  <head>
    <title>JobBoard &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="ftco-32x32.png">
    
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/quill.snow.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">    
  </head>
  <body id="top">
<!--
  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
-->  

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid ">
        <div class="row align-items-center">
          <div class="site-logo "><a href="index.php">JobBoard</a></div>
          <nav class="mx-auto site-navigation ">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link active">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact</a></li>
              <li><a href="Workers.php">Workers</a></li>
              <li><a href="Company.php">companies</a></li>
              <?php if( isset($_SESSION['user_type']) AND  $_SESSION['user_type'] == "Company") {?>
              <li class="d-lg-inline"><a href="post-job.php"><span class="mr-2">+</span> Post a Job</a></li>
              <?php } ?>
              <?php if(!isset($_SESSION['user_name'])) {?>
              <li class="d-lg-inline"><a href="login.php">Log In</a></li>
              <li class="d-lg-inline"><a href="registers.php">Register</a></li>
              <?php }else{?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['user_name'] ;?> 
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="Public_Profile.php?id=<?php echo  $_SESSION['user_id'];?>">Public Profile</a>
                      <a class="dropdown-item" href="Update_Profile.php?Upid=<?php echo $_SESSION['user_id'];?>">Update Profile</a>
                      <?php if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Worker"){ ?>
                      <a class="dropdown-item" href="saved_job.php?id=<?php echo $_SESSION['user_id'];?>">Saved Job </a>
                      <?php } ?>
                      <?php if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Company"){ ?>
                      <a class="dropdown-item" href="show_applicants.php?id=<?php echo $_SESSION['user_id'];?>"> Show Applicants  </a>
                        <?php } ?>
                      
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="logout.php">Logout</a>
                      </div>
                      </li>
                      <?php } ?>
                    </ul>
          </nav>
            </div>
         
          </div>

        </div>
      </div>
    </header>