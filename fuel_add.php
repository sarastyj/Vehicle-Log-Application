<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   // Collecting Variables from POST_ARRAY
   $fuel_source =  ucwords(strtolower(filter_input(INPUT_POST, 'fuel_source')));
   $fuel_gallons = filter_input(INPUT_POST, 'fuel_gallons');
   $fuel_cost = filter_input(INPUT_POST, 'fuel_cost');
   $fuel_mileage_end = filter_input(INPUT_POST, 'fuel_mileage_end');
   $vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
   $user_id = $_SESSION['user_id'];



   // Validate inputs

   //Checking for empty fields
   if ($fuel_source == null || $fuel_gallons == null ||
           $fuel_cost == null || $fuel_mileage_end == null)  {
             ?>
<div class="alert alert-danger alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Access Denied:</strong> User must login to proceed!
</div>
<?php
   include('index.php');
   die();
   }

   //Checks to make sure fuel source field only contain letters
   if (ctype_alpha(str_replace(' ', '', $fuel_source)) === false) {

   include('header_navigation.php');
   echo '  <div class="container">
   <div class="alert alert-warning">  <!-- Bootstrap class for warning alert -->
   <strong>Error!</strong> Please check the <b>Make, or Color</b> fields and try again. These fields can only contain letters.<br><br><button type="button" onclick="history.back();">Back</button></a>
   </div>';
   include('../footer.php');
   echo "</div>";
   die;
   }

   //Removing all characters from price and mileage except digits
   $checkPriceExp = '[\$|,|\.|\s]';
   $checkMileageExp = '[,|\.|\s]';

   $price = preg_replace("$checkPriceExp","", $fuel_cost);
   $mileage = preg_replace("$checkMileageExp", "", $fuel_mileage_end);
   $fuel_gallons = preg_replace("$checkMileageExp", "", $fuel_gallons);


   //Checks to make sure the cost, gallons and  mileage fields only contain digits
   if (ctype_digit($price) === false ||
   ctype_digit($mileage) === false ||
   ctype_digit($fuel_gallons) === false) {

   include('header_navigation.php');
   echo '  <div class="container">
   <div class="alert alert-warning">  <!-- Bootstrap class for warning alert -->
   <strong>Error!</strong> Please check the <b>Fuel Gallons, Cost and Mileage</b> fields and try again.  These fields can only contain numbers.<br><br><button type="button" onclick="history.back();">Back</button></a>
   </div>';
   include('../footer.php');
   echo "</div>";
   die;
   }

   //Removing all characters, except the decimal point
   $pattern = '[\$|,|\s]';
   $fuel_cost = preg_replace("$pattern","", $fuel_cost);
   $fuel_mileage_end = preg_replace("$pattern", "", $fuel_mileage_end);

   /*echo "$fuel_id <br />";
   echo "$fuel_source <br />";
   echo "$fuel_gallons <br />";
   echo "$fuel_cost <br />";
   echo "$fuel_mileage_end <br />";*/

   require ('config.php');
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("SELECT fuel_mileage FROM fuel  WHERE vehicle_id = '$vehicle_id' ORDER BY fuel_id DESC LIMIT 1");
   $result->execute();
   $fuel_mileage = $result->fetchAll();
   foreach ($fuel_mileage as $fuel_mileage_array) :
   /*
   require('config.php');
   //Collecting Previous Mileage for MPG Calculation
   $queryMileage = 'SELECT fuel_mileage FROM fuel WHERE vehicle_id = :vehicle_id ORDER BY fuel_id DESC LIMIT 1';
   $statementM = $db->prepare($queryMileage);
   $statementM->bindValue(':vehicle_id', $vehicle_id);
   $statementM->execute();
   $fuel_mileage_array = $statementM->fetch();
   $statementM->closeCursor();
   */
   $fuel_mileage = $fuel_mileage_array['fuel_mileage'];
   endforeach;


   //Add to Database
   try{
   //Add into Database
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("INSERT INTO fuel
          (user_id, fuel_source, fuel_gallons, fuel_cost, fuel_mileage, fuel_mileage_end, vehicle_id)
       VALUES
          ('$user_id', '$fuel_source', '$fuel_gallons', '$fuel_cost', '$fuel_mileage', '$fuel_mileage_end', '$vehicle_id')");
          $result->execute();
   }
   catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
   }
   // Display the Drivers page
   //include('fuel.php');
   /*
   // Adding Fuel Record to the database
   $query = 'INSERT INTO fuel
          (fuel_source, fuel_gallons, fuel_cost, fuel_mileage, fuel_mileage_end, vehicle_id)
       VALUES
          (:fuel_source, :fuel_gallons, :fuel_cost, :fuel_mileage, :fuel_mileage_end, :vehicle_id)';
   $statement = $db->prepare($query);
   $statement->bindValue(':fuel_source', $fuel_source);
   $statement->bindValue(':fuel_gallons', $fuel_gallons);
   $statement->bindValue(':fuel_cost', $fuel_cost);
   $statement->bindValue(':fuel_mileage', $fuel_mileage);
   $statement->bindValue(':fuel_mileage_end', $fuel_mileage_end);
   $statement->bindValue(':vehicle_id', $vehicle_id);
   $statement->execute();
   $statement->closeCursor();
   */
   /*echo "$fuel_id <br />";
   echo "$fuel_source <br />";
   echo "$fuel_gallons <br />";
   echo "$fuel_cost <br />";
   echo "$fuel_mileage_end <br />";*/

   //Record Add Success Message
   // require ('config.php');
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("SELECT * FROM fuel WHERE vehicle_id = '$vehicle_id' ORDER BY fuel_id DESC");
   $result->execute();
   $fuel_array = $result->fetchAll();


   ?>
<div class="alert alert-success alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Fuel Record Added.
</div>
<?php include "header_navigation.php";?>
<title>Fuel Record Add Confirmation</title>
<div class="container-fluid">
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
   <thead class="thead-light">
      <tr>
         <th align="center"colspan="15">
            <h3>Record Successfully Added for Vehicle ID#: <?php echo "$vehicle_id"?></h3>
         </th>
      </tr>
   </thead>
   <tbody>
      <?php foreach ($fuel_array as $fuel) :
         endforeach;?>
      <tr>
         <td align="right"><strong>Source:</strong></td>
         <td><?php echo $fuel['fuel_source']; ?></td>
      </tr>
      <tr>
         <td align="right"><strong>Gallons:</strong></td>
         <td><?php echo $fuel['fuel_gallons']; ?></td>
      </tr>
      <tr>
         <td align="right"><strong>Cost:</strong></td>
         <td>$<?php echo number_format($fuel['fuel_cost'],2); ?></td>
      </tr>
      <tr>
         <td align="right"><strong>Mileage:</strong></td>
         <td><?php echo number_format($fuel['fuel_mileage_end']); ?></td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <?php //endforeach; ?>
         <!-- Edit Record Again -->
         <td>
            <form action="fuel_edit_form.php" method="POST">
               <input type="hidden" name="fuel_id" value="<?php echo $fuel['fuel_id']; ?>" />
               <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>" />
               <input type="submit" value="Edit Record" />
            </form>
            <form action="vehicles.php" method="POST">
               <input type="submit" value="Done" />
            </form>
         </td>
      </tr>
   </tbody>
</table>
</div
<?php include "footer.php"; ?>
