<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   // Get the maintenance data
   $maintenance_id = filter_input(INPUT_POST,'maintenance_id');
   $maintenance_vendor =  ucwords(strtolower(filter_input(INPUT_POST,'maintenance_vendor')));
   $maintenance_description =  ucwords(strtolower(filter_input(INPUT_POST,'maintenance_description')));
   $maintenance_vendor_address =  ucwords(strtolower(filter_input(INPUT_POST,'maintenance_vendor_address')));
   $maintenance_cost = filter_input(INPUT_POST,'maintenance_cost');
   $maintenance_mileage = filter_input(INPUT_POST,'maintenance_mileage');
   $maintenance_vendor_phone_number = filter_input(INPUT_POST,'maintenance_vendor_phone_number');
   $maintenance_date_modified = date("Y-m-d G:i:s");

   // echo $maintenance_vendor ."</br>";
   // echo $maintenance_description."</br>";
   // echo $maintenance_vendor_address."</br>";
   // echo $maintenance_cost."</br>";
   // echo $maintenance_mileage."</br>";
   // echo $maintenance_vendor_phone_number."</br>";
   // echo $maintenance_date_modified;


   if ($maintenance_vendor == null || $maintenance_description == null ||
           $maintenance_vendor_address == null || $maintenance_cost == null || $maintenance_mileage == null || $maintenance_vendor_phone_number == null)  {
             ?>
<div class="alert alert-danger alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Access Denied:</strong> User must login to proceed!
</div>
<?php
   include('index.php');
   die();
   } else {

   require('config.php');
   // Add the maintenance to the database
   try{
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result = $conn->prepare("
   UPDATE maintenance
   SET
   maintenance_vendor = '$maintenance_vendor',
   maintenance_description = '$maintenance_description',
   maintenance_vendor_address = '$maintenance_vendor_address',
   maintenance_cost = '$maintenance_cost',
   maintenance_mileage = '$maintenance_mileage',
   maintenance_vendor_phone_number = '$maintenance_vendor_phone_number',
   maintenance_date_modified = '$maintenance_date_modified'


   WHERE maintenance_id = $maintenance_id " );
   $result->execute();
   //include "orders_confirmation.php";
   }
   catch(PDOException $e)
   {
   echo "Error: " . $e->getMessage();
   }
   // $query = 'UPDATE maintenance
   //         SET maintenance_vendor = :maintenance_vendor, maintenance_description = :maintenance_description, maintenance_vendor_address = :maintenance_vendor_address,maintenance_cost = :maintenance_cost, maintenance_mileage = :maintenance_mileage, maintenance_vendor_phone_number = :maintenance_vendor_phone_number
   //         WHERE maintenance_id = :maintenance_id ' ;
   //
   // $statement = $db->prepare($query);
   // $statement->bindValue(':maintenance_vendor' , $maintenance_vendor);
   // $statement->bindValue(':maintenance_description' , $maintenance_description);
   // $statement->bindValue(':maintenance_vendor_address' , $maintenance_vendor_address);
   // $statement->bindValue(':maintenance_cost' , $maintenance_cost);
   // $statement->bindValue(':maintenance_mileage' , $maintenance_mileage);
   // $statement->bindValue(':maintenance_vendor_phone_number' , $maintenance_vendor_phone_number);
   // $statement->bindValue(':maintenance_id' , $maintenance_id);
   // $statement->execute();
   // $statement->closeCursor();

   //Update Results
   try{
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $result2 = $conn->prepare("SELECT * FROM maintenance WHERE maintenance_id = '$maintenance_id'");
   $result2->execute();
   $maintenance = $result2->fetchAll();
   }
   catch(PDOException $e)
   {
   echo "Error: " . $e->getMessage();
   }




   // $queryEdit = 'SELECT * FROM maintenance WHERE maintenance_id = :maintenance_id';
   //     $statement2 = $db->prepare($queryEdit);
   //     $statement2->bindValue(':maintenance_id', $maintenance_id);
   //     $statement2->execute();
   //     $maintenanceEdit = $statement2->fetch();
   // $maintenance_vendor = $maintenanceEdit['maintenance_vendor'];
   // $maintenance_description = $maintenanceEdit['maintenance_description'];
   // $maintenance_vendor_address = $maintenanceEdit['maintenance_vendor_address'];
   // $maintenance_cost = $maintenanceEdit['maintenance_cost'];
   // $maintenance_mileage = $maintenanceEdit['maintenance_mileage'];
   // $maintenance_vendor_phone_number = $maintenanceEdit['maintenance_vendor_phone_number'];
   //$statement2->closeCursor();
   }
   foreach ($maintenance as $maintenanceEdit) :
   ?>
<div class="alert alert-success alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Maintenance Record Edited.
</div>
<?php include "header_navigation.php";?>
<title>Maintenance Records Results Page</title>
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
            <td align="right"><strong>Vendor:</strong></td>
            <td><?php echo $maintenanceEdit['maintenance_vendor']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Description:</strong></td>
            <td><?php echo $maintenanceEdit['maintenance_description']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Address:</strong></td>
            <td><?php echo $maintenanceEdit['maintenance_vendor_address']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Cost:</strong></td>
            <td><?php echo $maintenanceEdit['maintenance_cost']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Mileage:</strong></td>
            <td><?php echo $maintenanceEdit['maintenance_mileage']; ?></td>
         </tr>
         <tr>
            <td align="right"><strong>Phone Number:</strong></td>
            <td><?php echo $maintenanceEdit['maintenance_vendor_phone_number']; ?></td>
            <?php endforeach;?>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <!-- Edit the record again? -->
            <td>
               <form action="maintenance_edit_form.php" method="POST">
                  <input type="hidden" name="maintenance_id" value="<?php echo $maintenance_id; ?>" />
                  <input class="btn btn-secondary" type="submit" value="Edit Record Again?" />
                  <a class="badge badge-primary" href="maintenance.php" style: text-decoration: none;><b>Done</b></a>
               </form>
            </td>
      </tbody>
   </table>
</div>
<?php include "footer.php"; ?>
