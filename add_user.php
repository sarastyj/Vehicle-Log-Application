<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   $_SESSION['access_granted'] = "True";
   $first_name = ucwords(strtolower(filter_input(INPUT_POST, 'first_name')));
   $last_name = ucwords(strtolower(filter_input(INPUT_POST, 'last_name')));
   $add_username= filter_input(INPUT_POST, 'add_username');
   $add_user_password = filter_input(INPUT_POST, 'add_user_password');
   $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
   $phone_number = filter_input(INPUT_POST, 'phone_number');
   $user_level = "authenticated_user";
   $_SESSION['user_level'] = $user_level;

   if (
     !isset($first_name)||
     !isset($last_name)||
     !isset($add_username)||
     !isset($add_user_password)||
     !isset($email)||
     !isset($phone_number)
   ) {
     ?>
<div class="alert alert-danger alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Access Denied:</strong> User must login to proceed!
</div>
<?php
   include('index.php');
   die();
   }
   // echo "$first_name <br />";
   // echo "$last_name <br />";
   // echo "$add_username <br />";
   // echo "$add_user_password <br />";
   // echo "$email <br />";
   // echo "$phone_number <br />";

   // Validate inputs
   /* if ($driver_id == null || $driver_id == false || $first_name == null || $last_name == null ||
         $driver_password == null || $email == null || $driver_role == null)  {
     $error = "Invalid product data. Check all fields and try again.";

   } else {

   */

     require('config.php');

     try{
     //Add into Database
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $result = $conn->prepare("INSERT INTO users
                  (first_name, last_name, username, password, email, phone_number, user_level)
               VALUES
               ('$first_name', '$last_name', '$add_username', '$add_user_password', '$email', '$phone_number', '$user_level')");
               $result->execute();
   }
   catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
   }
     // Display the Drivers page
     ?>
<div class="alert alert-success alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> User Added.
</div>
<?php
   include('vehicles.php');
   ?>
