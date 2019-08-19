<?php include "header_navigation.php";
   $user_id = $_SESSION['user_id'];

         if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){
           $result = $conn->prepare("SELECT * FROM fuel ORDER BY fuel_source");
         }
         else {
           $result = $conn->prepare("SELECT * FROM fuel WHERE user_id = '$user_id' ORDER BY fuel_source");
         }
         $result->execute();
         $fuel_array = $result->fetchAll();
         ?>
<div class="container-fluid">
<div class="table-responsive">
   <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
      <thead class="thead-light">
         <tr>
            <td colspan="15">
               <h3><b>Fuel</b></h3>
            </td>
         </tr>
         <?php
            //echo "Count: ".count($vehicles);
            if(count($fuel_array)=== 0){
            ?>
         <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Info!</strong> No fuel records found under this profile. Please select a <b><a href="vehicles.php">vehicle</a></b> to add a fuel record.
         </div>
         <?php
            }
            ?>
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
            <th>Date Created</th>
            <th>Date Modified</th>
            <th colspan="2"></th>
         </tr>
         <!--Populating Table Fields with array-->
         <?php foreach ($fuel_array as $fuel) :?>
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
            <td>
               <?php echo dateCustomFormat($fuel['fuel_date']); ?>
            </td>
            <td>
               <?php echo dateModifiedCustomFormat($fuel['fuel_date_modified']); ?>
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
<?php include "footer.php";?>
