<?php
   // Get the vehicle data
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
   $vehicle_make =  ucwords(strtolower(filter_input(INPUT_POST, 'vehicle_make')));
   $vehicle_model =  ucwords(strtolower(filter_input(INPUT_POST, 'vehicle_model')));
   $vehicle_year = filter_input(INPUT_POST, 'vehicle_year');
   $vehicle_color = filter_input(INPUT_POST, 'vehicle_color');
   $vehicle_year_purchased = filter_input(INPUT_POST, 'vehicle_year_purchased');
   $vehicle_vin = filter_input(INPUT_POST, 'vehicle_vin');
   $vehicle_license_tag = filter_input(INPUT_POST, 'vehicle_license_tag');
   $vehicle_license_state =  strtoupper(filter_input(INPUT_POST, 'vehicle_license_state'));
   $vehicle_purchase_price = filter_input(INPUT_POST, 'vehicle_purchase_price');
   $vehicle_purchase_mileage = filter_input(INPUT_POST, 'vehicle_purchase_mileage');
   $user_id = $_SESSION['user_id'];
   $date_modified = date("Y-m-d G:i:s");

          /* echo "$vehicle_id<br />";
           echo "$vehicle_make<br />";
           echo "$vehicle_model<br />";
           echo "$vehicle_year<br />";
           echo "$vehicle_color<br />";
           echo "$vehicle_year_purchased<br />";
           echo "$vehicle_vin<br />";
           echo "$vehicle_license_tag<br />";
           echo "$vehicle_license_state<br />";
           echo "$vehicle_purchase_price<br />";
           echo "$vehicle_purchase_mileage<br />";*/

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
   $checkPriceExp = '[\$|,|\.|\s]';
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
   $pattern = '[\$|,|\s]';
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
   <strong>Error!</strong> Invalid <b>License Tag or VIN</b> characters. </br> Valid License Tag Ex:(ABC123 or ABC 123).<br><br><button type="button" onclick="history.back();">Back</button></a>
   </div>';
   include('footer.php');
   echo "</div>";
   die;
   }

   require('config.php');
   //Edit Orders

   try {
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("
   UPDATE vehicles
         SET
         vehicle_make = '$vehicle_make',
         vehicle_model = '$vehicle_model',
         vehicle_year = '$vehicle_year',
         vehicle_color = '$vehicle_color',
         vehicle_year_purchased = '$vehicle_year_purchased',
         vehicle_vin = '$vehicle_vin',
         vehicle_license_tag = '$vehicle_license_tag',
         vehicle_license_state = '$vehicle_license_state',
         vehicle_purchase_price = '$vehicle_purchase_price',
         vehicle_purchase_mileage = '$vehicle_purchase_mileage',


         WHERE vehicle_id = $vehicle_id " );
         $result->execute();

   //include "orders_confirmation.php";
   }
   catch(PDOException $e)
   {
   echo "Error: " . $e->getMessage();
   }

   //Update Results
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("SELECT * FROM vehicles WHERE vehicle_id = '$vehicle_id'");
   $result->execute();
   $vehicles = $result->fetchAll();

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
     echo "$vehicle_purchase_mileage<br />";*/
   ?>
<div class="alert alert-success alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Vehicle Record Edited.
</div>
<?php include "header_navigation.php";?>
<?php
   //$vehicle_purchase_price = preg_replace("$pattern","", $vehicle_purchase_price);
   //$vehicle_purchase_mileage = preg_replace("$pattern", "", $vehicle_purchase_mileage);
   ?>
<title>Edit Vehicle Results Page</title>
<?php
   foreach ($vehicles as $vehicle_array):
   ?>
<div class="table-responsive">
   <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
      <!--Maintenance Table Records-->
      <thead class="thead-light">
         <tr>
            <th align="left"colspan="15">
               <h3><b>Update Results</b></h3>
            </th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td align="right"><strong>Make:</strong></td>
            <td><?php echo $vehicle_array['vehicle_make']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Model:</strong></td>
            <td><?php echo $vehicle_array['vehicle_model']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Year:</strong></td>
            <td><?php echo $vehicle_array['vehicle_year']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Color:</strong></td>
            <td><?php echo $vehicle_array['vehicle_color']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Year Purchased:</strong></td>
            <td><?php echo $vehicle_array['vehicle_year_purchased']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>VIN:</strong></td>
            <td><?php echo $vehicle_array['vehicle_vin']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>License Tag:</strong></td>
            <td><?php echo $vehicle_array['vehicle_license_tag']; ?></td>
         </tr>
         <tr>
         <tr>
            <td align="right"><strong>License State:</strong></td>
            <td><?php echo $vehicle_array['vehicle_license_state']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Purchase Price ($):</strong></td>
            <td><?php echo number_format($vehicle_array['vehicle_purchase_price'],2); ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Purchase Mileage:</strong></td>
            <td><?php echo number_format($vehicle_array['vehicle_purchase_mileage']); ?></td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <!-- Edit the record again? -->
            <td>
               <form action="vehicle_edit_form.php" method="POST">
                  <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>" />
                  <input class="btn btn-secondary" type="submit" value="Edit Record Again" />
               </form>
               <!-- <form method="POST" action="maintenance_add_form.php">
                  <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>"/>
                  <button type="SUBMIT">Add Maintenance Record</button>
               </form> -->
               <form method="POST" action="vehicles.php">
                  <button class="btn btn-primary" type="SUBMIT">Done</button>
               </form>
            </td>
      </tbody>
   </table>
</div>
<?php endforeach;
   include "footer.php"; ?>
