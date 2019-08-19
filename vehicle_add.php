<?php
   // Retrieve data from POST array
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
   $vehicle_make = ucwords(strtolower(filter_input(INPUT_POST, 'vehicle_make')));
   $vehicle_model = ucwords(strtolower(filter_input(INPUT_POST, 'vehicle_model')));
   $vehicle_year = filter_input(INPUT_POST, 'vehicle_year');
   $vehicle_color = ucwords(strtolower(filter_input(INPUT_POST, 'vehicle_color')));
   $vehicle_year_purchased = filter_input(INPUT_POST, 'vehicle_year_purchased');
   $vehicle_vin = filter_input(INPUT_POST, 'vehicle_vin');
   $vehicle_license_tag = filter_input(INPUT_POST, 'vehicle_license_tag');
   $vehicle_license_state =  strtoupper(filter_input(INPUT_POST, 'vehicle_license_state'));
   $vehicle_purchase_price = filter_input(INPUT_POST, 'vehicle_purchase_price');
   $vehicle_purchase_mileage = filter_input(INPUT_POST, 'vehicle_purchase_mileage');
   $user_id = $_SESSION['user_id'];

   // echo "$vehicle_id<br />";
   // echo "$vehicle_make<br />";
   // echo "$vehicle_model<br />";
   // echo "$vehicle_year<br />";
   // echo "$vehicle_color<br />";
   // echo "$vehicle_vin<br />";
   // echo "$vehicle_license_tag<br />";
   // echo "$vehicle_license_state<br />";
   // echo "$vehicle_year_purchased<br />";
   // echo "$vehicle_purchase_price<br />";
   // echo "$vehicle_purchase_mileage<br />";
   // Error Handlers & Variable Formatters

   // Checks to make sure all fields have been filled
   if ($vehicle_make == null ||
       $vehicle_model == null ||
       $vehicle_year == null ||
       $vehicle_color == null ||
       $vehicle_year_purchased == null ||
       $vehicle_vin == null ||
       $vehicle_license_tag == null ||
       $vehicle_license_state == null ||
       $vehicle_purchase_price == null ||
       $vehicle_purchase_mileage == null)  {
         ?>
<div class="alert alert-danger alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Access Denied:</strong> User must login to proceed!
</div>
<?php
   include('index.php');
   die();
   }

   //Checks to make sure that the MAKE and COLOR of the vehicle only contain letters
   if (ctype_alpha(str_replace(' ', '', $vehicle_make)) === false ||
   ctype_alpha(str_replace(' ', '', $vehicle_color)) === false) {

   include('header_navigation.php');
   echo '  <div class="container">
   <div class="alert alert-warning">  <!-- Bootstrap class for warning alert -->
   <strong>Error!</strong> Please check the <b>Make, or Color</b> fields and try again. These fields can only contain letters.<br><br><button type="button" onclick="history.back();">Back</button></a>
   </div>';
   include('footer.php');
   echo "</div>";
   die;
   }

   //Removing all characters from price and mileage except digits
   $checkPriceExp = '[$|,|\.|\s]';
   $checkMileageExp = '[,|\.|\s]';

   $price = preg_replace("$checkPriceExp","", $vehicle_purchase_price);
   $mileage = preg_replace("$checkMileageExp", "", $vehicle_purchase_mileage);


   //Checks to make sure the price and mileage fields only contain digits
   if (ctype_digit($price) === false ||
   ctype_digit($mileage) === false) {

   include('header_navigation.php');
   echo '  <div class="container">
   <div class="alert alert-warning">  <!-- Bootstrap class for warning alert -->
   <strong>Error!</strong> Please check the <b>Purchase Price or Purchase Mileage</b> fields and try again.  These fields can only contain numbers.<br><br><button type="button" onclick="history.back();">Back</button></a>
   </div>';
   include('footer.php');
   echo "</div>";
   die;
   }

   //Removing all characters, except the decimal point
   $pattern = '[$|,|\s]';
   $vehicle_purchase_price = preg_replace("$pattern","", $vehicle_purchase_price);
   $vehicle_purchase_mileage = preg_replace("$pattern", "", $vehicle_purchase_mileage);

   //Formats price and mileage into float value before adding to the database

   //Checking for a valid License Plate and VIN format
   $pattern = '[\-|\s|\.]';
   $vehicle_license_tag = preg_replace("$pattern","", $vehicle_license_tag);
   $vehicle_vin = preg_replace("$pattern","", $vehicle_vin);

   //Checking for alphanumeric value
   if (!ctype_alnum($vehicle_license_tag) === true || !ctype_alnum($vehicle_vin) === true ){

   include('header_navigation.php');
   echo '  <div class="container">
   <div class="alert alert-warning">  <!-- Bootstrap class for warning alert -->
   <strong>Error!</strong> Invalid <b>License Tag or VIN</b> characters. Please follow example format on form.<br><br><button type="button" onclick="history.back();">Back</button></a>
   </div>';
   include('footer.php');
   echo "</div>";
   die;
   }

   //Checking for duplicate VIN Numbers in database
   require('config.php');
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("SELECT * FROM vehicles");
   $result->execute();
   $vehicles = $result->fetchAll();

   foreach ($vehicles as $vehicle) :
     if($vehicle['vehicle_vin'] === $vehicle_vin){
       include('header_navigation.php');
       echo '  <div class="container">
       <div class="alert alert-warning">  <!-- Bootstrap class for warning alert -->
       <strong>ERROR!</strong> <b>Duplicate Entry:</b> '.$vehicle_vin.' is already in the system.<br><br><button type="button" onclick="history.back();">Back</button></a>
       </div>';
       include('footer.php');
       echo "</div>";
       die;
     }
   endforeach;

   //Adding all values into the database
   require('config.php');

     /*echo "$vehicle_id<br />";
     echo "$vehicle_make<br />";
     echo "$vehicle_model<br />";
     echo "$vehicle_year<br />";
     echo "$vehicle_color<br />";
     echo "$vehicle_year_purchased<br />";
     echo "$vehicle_vin<br />";
     echo "$vehicle_license_tag<br />";
     echo "$vehicle_license_state<br />";
     echo "$vehicle_purchase_price<br />";
     echo "$vehicle_purchase_mileage<br />"*/;
   //
   // //Add to Database
   try{
   //Add into Database
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("INSERT INTO vehicles
              (user_id, vehicle_make, vehicle_model,vehicle_year, vehicle_color, vehicle_year_purchased, vehicle_vin, vehicle_license_tag, vehicle_license_state, vehicle_purchase_price, vehicle_purchase_mileage)
   VALUES
              ('$user_id', '$vehicle_make', '$vehicle_model', '$vehicle_year', '$vehicle_color', '$vehicle_year_purchased', '$vehicle_vin', '$vehicle_license_tag', '$vehicle_license_state', '$vehicle_purchase_price', '$vehicle_purchase_mileage')");
              $result->execute();
   }
   catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
   }
   // Display the Drivers page
   ?>
<div class="alert alert-success alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Vehicle Added.
</div>
<?php
   include('vehicles.php');
   ?>
