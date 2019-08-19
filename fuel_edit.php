<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   // Get the driver data
   $fuel_id = filter_input(INPUT_POST, 'fuel_id', FILTER_VALIDATE_INT);
   $fuel_source =  ucwords(strtolower(filter_input(INPUT_POST, 'fuel_source')));
   $fuel_gallons = filter_input(INPUT_POST, 'fuel_gallons');
   $fuel_cost = filter_input(INPUT_POST, 'fuel_cost');
   $fuel_mileage = filter_input(INPUT_POST, 'fuel_mileage');
   $fuel_mileage_end = filter_input(INPUT_POST, 'fuel_mileage_end');
   $fuel_date_modified = date('Y-m-d G:i:s');
   $user_id = $_SESSION['user_id'];

   // echo "$fuel_id </br>";
   // echo "$fuel_source </br>";
   // echo "$fuel_gallons </br>";
   // echo "$fuel_cost </br>";
   // echo "$fuel_mileage </br>";
   // echo "$fuel_mileage_end </br>";
   // echo "$fuel_date_modified </br>";

   // Validate inputs
   if ($fuel_source == null || $fuel_gallons == null ||
           $fuel_cost == null || $fuel_mileage == null || $fuel_mileage_end == null)  {
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
   <strong>Error!</strong> Please check the <b>Source</b> field and try again. This field can only contain letters.<br><br><button type="button" onclick="history.back();">Back</button></a>
   </div>';
   include('footer.php');
   echo "</div>";
   die;
   }

   //Removing all characters from price and mileage except digits
   $checkPriceExp = '[\$|,|\.|\s]';
   $checkMileageExp = '[,|\.|\s]';

   $price = preg_replace("$checkPriceExp","", $fuel_cost);
   $mileage1 = preg_replace("$checkMileageExp", "", $fuel_mileage);
   $mileage2 = preg_replace("$checkMileageExp", "", $fuel_mileage_end);
   $fuel_gallons = preg_replace("$checkMileageExp", "", $fuel_gallons);


   //Checks to make sure the cost, gallons and  mileage fields only contain digits
   if (ctype_digit($price) === false ||
   ctype_digit($mileage1) === false ||
   ctype_digit($mileage2) === false ||
   ctype_digit($fuel_gallons) === false) {

   include('header_navigation.php');
   echo '  <div class="container">
   <div class="alert alert-warning">  <!-- Bootstrap class for warning alert -->
   <strong>Errorstrong> Please check the <b>Fuel Gallons, Cost and Mileage</b> fields and try again.  These fields can only contain numbers.<br><br><button type="button" onclick="history.back();">Back</button></a>
   div>';
   include('footer.php');
   echo "</div>";
   die;
   }

   //Removing all characters, except the decimal point
   $pattern = '[\$|,|\s]';
   $fuel_cost = preg_replace("$pattern","", $fuel_cost);
   $fuel_mileage = preg_replace("$pattern", "", $fuel_mileage);
   $fuel_mileage_end = preg_replace("$pattern", "", $fuel_mileage_end);

   require('config.php');
   //Edit Orders

   try {
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("UPDATE fuel
     SET fuel_source = '$fuel_source', fuel_gallons = '$fuel_gallons', fuel_cost = '$fuel_cost', fuel_mileage = '$fuel_mileage', fuel_mileage_end = '$fuel_mileage_end', fuel_date_modified = '$fuel_date_modified'

     WHERE fuel_id = '$fuel_id' ") ;
     $result->execute();

   }
   catch(PDOException $e)
   {
   echo "Error: " . $e->getMessage();
   }
   /*
   require('config.php');

   // Edit Record in Database
   $query = 'UPDATE fuel
     SET fuel_source = :fuel_source, fuel_gallons = :fuel_gallons, fuel_cost = :fuel_cost, fuel_mileage = :fuel_mileage, fuel_mileage_end = :fuel_mileage_end, fuel_date_modified = :fuel_date_modified

     WHERE fuel_id = :fuel_id ' ;

   $statement = $db->prepare($query);
   $statement->bindValue(':fuel_source', $fuel_source);
   $statement->bindValue(':fuel_gallons', $fuel_gallons);
   $statement->bindValue(':fuel_cost', $fuel_cost);
   $statement->bindValue(':fuel_mileage', $fuel_mileage);
   $statement->bindValue(':fuel_mileage_end', $fuel_mileage_end);
   $statement->bindValue(':fuel_date_modified', $fuel_date_modified);
   $statement->bindValue(':fuel_id', $fuel_id);
   $statement->execute();
   $statement->closeCursor();

   */

   //Update Results
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("SELECT * FROM fuel WHERE fuel_id = '$fuel_id';");
   $result->execute();
   $fuel_array = $result->fetchAll();
   foreach ($fuel_array as $fuel):
   /*
   //Update Results
   $queryEdit = 'SELECT * FROM fuel WHERE fuel_id = :fuel_id';
   $statement2 = $db->prepare($queryEdit);
   $statement2->bindValue(':fuel_id', $fuel_id);
   $statement2->execute();
   $fuelEdit = $statement2->fetch();
   $fuel_source = $fuelEdit['fuel_source'];
   $fuel_gallons = $fuelEdit['fuel_gallons'];
   $fuel_cost = $fuelEdit['fuel_cost'];
   $fuel_mileage = $fuelEdit['fuel_mileage'];
   $fuel_mileage_end = $fuelEdit['fuel_mileage_end'];
   $statement2->closeCursor();
   */

   ?>
<div class="alert alert-success alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Fuel Record Edited.
</div>
<?php include "header_navigation.php";?>
<title>Fuel Record Edit Page</title>
<div class="container-fluid">
<div class="table-responsive">
   <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
      <thead class="thead-light">
         <tr>
            <th align="center"colspan="15">
               <h3><b>Update Results</b></h3>
            </th>
         </tr>
      </thead>
      <tbody>
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
            <td align="right"><strong>Previous Mileage:</strong></td>
            <td><?php echo number_format($fuel['fuel_mileage']); ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Current Mileage:</strong></td>
            <td><?php echo number_format($fuel['fuel_mileage_end']); ?></td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <?php endforeach;?>
            <!-- Edit the record again? -->
            <td>
               <form action="fuel_edit_form.php" method="POST">
                  <input type="hidden" name="fuel_id" value="<?php echo $fuel_id; ?>" />
                  <input class="btn btn-secondary" type="submit" value="Edit Record Again?" />
                  <a class="btn btn-primary" href="fuel.php" style: text-decoration: none;><b>Done</b></a>
               </form>
            </td>
         </tr>
      </tbody>
   </table>
</div>
<?php include "footer.php"; ?>
