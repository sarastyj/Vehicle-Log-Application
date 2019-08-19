<?php
   include("header_navigation.php");
    ?>
<!-- </div>
   <div class="container"style = background-color:#0099ff;> -->
<!-- <div class="container-fluid">
   </div> -->
<!-- </div> -->
<!-- </div> -->
<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   require ('config.php');

       $vehicle_id = filter_input(INPUT_POST, "vehicle_id");
       $user_id = $_SESSION['user_id'];
       $redirect = 'reports.php';
           //echo $vehicle_id;

       //Pulling Data from Vehicles Table
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $result = $conn->prepare("SELECT * FROM vehicles WHERE user_id = '$user_id'");
             $result->execute();
             $vehicles = $result->fetchAll();


                   // echo $vehicle['vehicle_id'],'<br>';
                   // echo $vehicle['vehicle_make'],'<br>';
                   // echo $vehicle['vehicle_model'],'<br>';
                   // echo $vehicle['vehicle_year'],'<br>';
                   // echo $vehicle['vehicle_color'],'<br>';
                   // echo $vehicle['vehicle_year_purchased'],'<br>';
                   // echo $vehicle['vehicle_vin'],'<br>';
                   // echo $vehicle['vehicle_license_tag'],'<br>';
                   // echo $vehicle['vehicle_license_state'],'<br>';
                   // echo $vehicle['vehicle_purchase_price'],'<br>';
                   // echo $vehicle['vehicle_purchase_mileage'],'<br>';

       // $query = 'SELECT * FROM vehicles
       // WHERE vehicle_id = :vehicle_id';
       // $statement = $db->prepare($query);
     //   $statement->bindValue(':vehicle_id', $vehicle_id);
     //   $statement->execute();
     //   $vehicle = $statement->fetch();
     //   $statement->closeCursor();

       //Pulling Data from Maintenance Table
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $result2 = $conn->prepare("SELECT * FROM maintenance WHERE user_id = '$user_id'");
                 $result2->execute();
                 $maintenance_array = $result2->fetchAll();


       // $queryM = 'SELECT * FROM maintenance
       // WHERE vehicle_id = :vehicle_id';
       // $statement2 = $db->prepare($queryM);
       // $statement2->bindValue(':vehicle_id', $vehicle_id);
       // $statement2->execute();
       // $maintenance_array = $statement2->fetchAll();
       // $statement2->closeCursor();

       //Getting Sum Total of Repairs
       $totalRepairCost = 0;
           foreach ($maintenance_array as $maintenance) :
           $totalRepairCost += $maintenance['maintenance_cost'];
           endforeach;


       //Pulling Data from Fuel Table
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                       $result3 = $conn->prepare("SELECT * FROM fuel WHERE user_id = '$user_id'");
                       $result3->execute();
                       $fuel_array = $result3->fetchAll();

     //   $queryF = 'SELECT * FROM fuel
       // WHERE vehicle_id = :vehicle_id';
     //   $statement3 = $db->prepare($queryF);
     //   $statement3->bindValue(':vehicle_id', $vehicle_id);
     //   $statement3->execute();
     //   $fuel_array = $statement3->fetchAll();
     //   $statement3->closeCursor();

       //Getting Sum Total of Fuel Costs
       $totalFuelCost = 0;
       $fuelCounter = 0;
       $totalStartingMileage = 0;
       $totalEndingMileage = 0;
       $diffMileage = 0;
       $totalGallons = 0;
       $avgFuelCost = 0;
       $mpg = 0;
           foreach ($fuel_array as $fuel) :
           $totalFuelCost +=$fuel['fuel_cost'];
           $fuelCounter = $fuelCounter+1;
           $totalStartingMileage = $fuel['fuel_mileage'];
           $totalEndingMileage = $fuel['fuel_mileage_end'];
           $diffMileage = $diffMileage+($totalEndingMileage-$totalStartingMileage);
           $totalGallons += $fuel['fuel_gallons'];
           endforeach;
       if(!$totalFuelCost== 0){
           $avgFuelCost = $totalFuelCost/$fuelCounter;

       }

       if(!$totalGallons== 0){
           $mpg = number_format($diffMileage/$totalGallons, 2, '.', '');
       }
   ?>
<div class="container-fluid">
   <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
         <thead class="thead-light">
            <tr>
               <th align="center"colspan="15">
                  <h3><b>Vehicle Report - ID# <?php echo $vehicle_id?></b></h3>
               </th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <th>Make</th>
               <th>Model</th>
               <th>Year</th>
               <th>Color</th>
               <th colspan="4">VIN</th>
               <th>License Tag</th>
               <th>License State</th>
               <th>Year Purchased</th>
               <th>Purchase Price</th>
               <th>Purchase Mileage</th>
            </tr>
            <?php foreach ($vehicles as $vehicle) : ?>
            <tr>
               <td>
                  <?php echo $vehicle['vehicle_make']; ?>
               </td>
               <td>
                  <?php echo $vehicle['vehicle_model']; ?>
               </td>
               <td>
                  <?php echo $vehicle['vehicle_year']; ?>
               </td>
               <td>
                  <?php echo $vehicle['vehicle_color']; ?>
               </td>
               <td colspan="4">
                  <?php echo $vehicle['vehicle_vin']; ?>
               </td>
               <td>
                  <?php echo $vehicle['vehicle_license_tag']; ?>
               </td>
               <td>
                  <?php echo $vehicle['vehicle_license_state']; ?>
               </td>
               <td>
                  <?php echo $vehicle['vehicle_year_purchased']; ?>
               </td>
               <td>
                  $<?php echo number_format($vehicle['vehicle_purchase_price'],2); ?>
               </td>
               <td>
                  <?php echo number_format($vehicle['vehicle_purchase_mileage']); ?>
               </td>
            </tr>
            <?php endforeach;?>
         </tbody>
      </table>
   </div>
   <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
         <!--Maintenance Table Records-->
         <thead class="thead-light">
            <tr>
               <th align="left"colspan="15">
                  <h3><b>Maintenance Records</b></h3>
               </th>
            </tr>
            <tr>
               <td align="left"colspan="15">
                  <h4><b>Total Repair Costs: $<?php echo number_format($totalRepairCost,2)?></b></h4>
               </td>
            </tr>
         </thead>
         <tbody>
            <tr>
               <th>Vehicle ID</th>
               <th>Vendor</th>
               <th colspan='4'>Vendor Address</th>
               <th>Vendor Phone Number</th>
               <th>Maintenance Description</th>
               <th>Cost</th>
               <th>Mileage</th>
               <th>Date Created</th>
               <th>Date Modified</th>
               <th colspan="2">
                  <form method="POST" action="maintenance_add_form.php">
                     <input type="hidden" name="vehicle_id" value= '<?php echo $vehicle['vehicle_id']?>'>
                     <input type="hidden" name="redirect" value='<?php echo $redirect; ?>'>
                     <button class="btn btn-primary" type="SUBMIT">Add Maintenance Record</button>
                  </form>
               </th>
            </tr>
            <?php foreach ($maintenance_array as $maintenance) :
               //Formatting phone number from database to display in table
               $number = $maintenance['maintenance_vendor_phone_number'];
               $maintenance['maintenance_vendor_phone_number'] = "($number[0]$number[1]$number[2])-$number[3]$number[4]$number[5]-$number[6]$number[7]$number[8]$number[9]";
               $maintenance_id = $maintenance['maintenance_id'];

               // Formatting dates from database
                       $empty_date = '0000-00-00 00:00:00';

                       if ($maintenance['maintenance_date'] === $empty_date){
                           $maintenance['maintenance_date'] = "";
                       }
                       else {
                           $maintenance_date = $maintenance['maintenance_date'];
                           $maintenance['maintenance_date'] = date_create("$maintenance_date");
                           $maintenance['maintenance_date'] = date_format($maintenance['maintenance_date'],"D, M j, Y");
                       }

                       if ($maintenance['maintenance_date_modified'] === $empty_date){
                           $maintenance['maintenance_date_modified'] = "";
                       }
                       else {
                           $maintenance_date_modified = $maintenance['maintenance_date_modified'];
                           $maintenance['maintenance_date_modified'] = date_create("$maintenance_date_modified");
                           $maintenance['maintenance_date_modified'] = date_format($maintenance['maintenance_date_modified'],"D, M j, Y");
                       }
               ?>
            <tr>
               <!--
                  <td>
                      <?php echo $maintenance['maintenance_type_id']; ?>-->
               </td>
               <td>
                  <?php echo $maintenance['vehicle_id']; ?>
               </td>
               <td>
                  <?php echo $maintenance['maintenance_vendor']; ?>
               </td>
               <td colspan='4'>
                  <?php echo $maintenance['maintenance_vendor_address']; ?>
               </td>
               <td>
                  <?php echo $maintenance['maintenance_vendor_phone_number']; ?>
               </td>
               <td>
                  <?php echo $maintenance['maintenance_description']; ?>
               </td>
               <td>
                  $<?php echo number_format($maintenance['maintenance_cost'],2); ?>
               </td>
               <td>
                  <?php echo number_format($maintenance['maintenance_mileage']); ?>
               </td>
               <td>
                  <?php echo $maintenance['maintenance_date']; ?>
               </td>
               <td>
                  <?php echo $maintenance['maintenance_date_modified']; ?>
               </td>
               <td>
                  <?php include "maintenance_edit_button.php"; ?>
               </td>
               <?php if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){ ?>

                 <td><?php include "fuel_delete_button.php";?>

                 </td>
               <?php } ?>
            </tr>
            <?php endforeach;?>
         </tbody>
      </table>
   </div>
   <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
         <thead class="thead-light">
            <tr>
               <th align="Left"colspan="15">
                  <h3><b>Fuel</b></h3>
               </th>
            <tr>
               <td align="Left"colspan="15">
                  <h4><b>Total Fuel Cost: $<?php echo number_format($totalFuelCost,2)?></b></h4>
               </td>
            </tr>
            <tr>
               <td align="Left"colspan="15">
                  <h4><b>Average Fuel Cost: $<?php echo number_format($avgFuelCost,2)?></b></h4>
               </td>
            </tr>
            <tr>
               <td align="Left"colspan="15">
                  <h4><b>Average Miles Per Gallon: <?php echo $mpg?> gal.</b></h4>
               </td>
            </tr>
         </thead>
         <tbody>
            <tr>
               <th>Vehicle ID</th>
               <th>Fuel ID</th>
               <th colspan="2">Source</th>
               <th>Gallons</th>
               <th>Cost</th>
               <th>Starting Mileage</th>
               <th>Ending Mileage</th>
               <th colspan = '2'>Date Created</th>
               <th colspan = '2'>Date Modified</th>
               <th colspan="2">
                  <form method="POST" action="fuel_add_form.php">
                     <input type="hidden" name="vehicle_id" value= "<?php echo $vehicle_id ?>">
                     <button class="btn btn-primary" type="SUBMIT">Add Fuel Record</button>
                  </form>
               </th>
            </tr>
            <?php foreach ($fuel_array as $fuel) :
               // Formatting phone number from database to displaying in table-->

               // Formatting dates from database-->
               $empty_date = '0000-00-00 00:00:00';

               if ($fuel['fuel_date_modified'] === $empty_date){
                   $fuel['fuel_date_modified'] = "";
               }
               else {
                   $date_modified = $fuel['fuel_date_modified'];
                   $fuel['fuel_date_modified'] = date_create($date_modified);
                   $fuel['fuel_date_modified'] = date_format($fuel['fuel_date_modified'],"D, M j, Y");
               }

               $date = $fuel['fuel_date'];
               $fuel['fuel_date'] = date_create($date);
               $fuel['fuel_date'] = date_format($fuel['fuel_date'],"D, M j, Y");
               ?>
            <tr>
               <td>
                  <?php echo $fuel['vehicle_id']; ?>
               </td>
               <td>
                  <?php echo $fuel['fuel_id']; ?>
               </td>
               <td colspan="2">
                  <?php echo $fuel['fuel_source']; ?>
               </td>
               <td>
                  <?php echo $fuel['fuel_gallons']; ?>
               </td>
               <td>
                  $<?php echo number_format($fuel['fuel_cost'],2); ?>
               </td>
               <td>
                  <?php echo number_format($fuel['fuel_mileage']); ?>
               </td>
               <td>
                  <?php echo number_format($fuel['fuel_mileage_end']); ?>
               </td>
               <td colspan="2">
                  <?php echo $fuel['fuel_date']; ?>
               </td>
               <td colspan='2'>
                  <?php echo $fuel['fuel_date_modified']; ?>
               </td>
               <td>
                  <?php include "fuel_edit_button.php"; ?>
               </td>
               <?php if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){ ?>

                 <td><?php include "fuel_delete_button.php";?>

                 </td>
               <?php } ?>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
</div>
<?php
   include("footer.php");
   ?>
