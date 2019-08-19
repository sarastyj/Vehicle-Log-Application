<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   require_once('config.php');
   include 'functions.php';
   // echo $_SESSION['user_id'];
   // echo $_SESSION['username'];
   // echo $_SESSION['password'];
   // echo $_SESSION['user_level'];
   // echo $_SESSION['access_granted'];

   if($_SESSION['access_granted'] !== "True"){
   header('Location: index.php');

   }
    ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script src="js/script.js"></script>
      <link rel="stylesheet" type="text/css" href="css/style.css">
   </head>
   <body id="body">
      <!-- <div class="container"> -->
      <div class="container">
      <div class="container-fluid, sticky" style="margin-bottom: 10px;">
         <div class="page-header">
            <h1>Vehicle Log Application</h1>
         </div>
         <header>
            <nav class="navbar navbar-dark bg-dark">
               <ul class="nav nav-pills nav-fill">
                 <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                 </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Vehicles</a>
                     <div class="dropdown-menu">
                        <a class = "dropdown-item" href="vehicles.php">Vehicle List</a>
                        <a class = "dropdown-item" href="vehicle_add_form.php">Add Vehicle</a>
                     </div>
                     <!--<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Maintenance <span class="caret"></span></a>-->
                     <!--<ul class="dropdown-menu">-->
                  <li class="nav-item">
                     <a class="nav-link" href="maintenance.php">Maintenance Records</a>
                  </li>
                  <!--<li><a href="maintenance_types.php">Maintenance Types</a></li>-->
                  <!--</ul>-->
                  <li><a class="nav-link" href="fuel.php">Fuel Records</a></li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Profile</a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="user_edit_form.php">Edit Profile</a>
                        <?php  if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){?>
                        <a class="dropdown-item" href="users.php">Users</a>
                      <?php ;} ?>
                     </div>
                  <li class="nav-item">
                     <a class="nav-link" href="about.php">About</a>
                  </li>
                  <?php if($_SESSION['access_granted']==="True") {
                     echo '<li class="nav-item"><a class="nav-link" href="logout.php">Log Out As: <b>'.$_SESSION['username'].'</b> User Level: <b>'.$_SESSION['user_level'].'</b></a></li>';
                     }?>
               </ul>
            </nav>
         </header>
      </div>
