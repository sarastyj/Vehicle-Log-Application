<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   $first_name = ucwords(strtolower(filter_input(INPUT_POST, 'first_name')));
   $last_name = ucwords(strtolower(filter_input(INPUT_POST, 'last_name')));
   $password = filter_input(INPUT_POST, 'new_user_password');
   $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
   $phone_number = filter_input(INPUT_POST, 'phone_number');
   $user_id = $_SESSION['user_id'];
   $date_modified = date("Y-m-d G:i:s");
   if(!empty($password)){
     $_SESSION['password'] = $password;
   }
   else{
     $password = $_SESSION['password'];
   }

   if (
     !isset($first_name)||
     !isset($last_name)||
     !isset($email)||
     !isset($phone_number)||
     !isset($user_id))
      {
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
   // echo "$new_user_password <br />";
   // echo "$email <br />";
   // echo "$phone_number <br />";
   // echo "User ID: ".$_SESSION['user_id'];
   // Error Handlers & Variable Formatters

   require('config.php');
   //Edit Orders

   try {
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $result = $conn->prepare("
       UPDATE users
             SET
             first_name = '$first_name',
             last_name = '$last_name',
             password = '$password',
             email = '$email',
             phone_number = '$phone_number',
             date_modified = '$date_modified'

             WHERE user_id = $user_id " );
             $result->execute();

             ?>
<div class="alert alert-success alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Used Record Edited.
</div>
<?php
   include('users.php');

   //include "orders_confirmation.php";
   }
   catch(PDOException $e)
   {
   echo "Error: " . $e->getMessage();
   }
   ?>
