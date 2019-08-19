<?php include "header_navigation.php";
   $user_id = $_SESSION['user_id'];
         if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){
         $result = $conn->prepare("SELECT * FROM maintenance ORDER BY maintenance_id");
       }
       else{
         $result = $conn->prepare("SELECT * FROM maintenance WHERE user_id = '$user_id' ORDER BY maintenance_id");
       }
         $result->execute();
         $maintenance_array = $result->fetchAll();
         ?>
<div class="container-fluid">
<div class="table-responsive">
   <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
      <thead class="thead-light">
         <tr>
            <td colspan="15">
               <h3><b>Maintenance Records</b></h3>
            </td>
         </tr>
         <?php
            //echo "Count: ".count($vehicles);
            if(count($maintenance_array)=== 0){
            ?>
         <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Info!</strong> No maintenance records found under this profile. Please select a <b><a href="vehicles.php">vehicle</a></b> to add a maintenace record.
         </div>
         <?php
            }
            ?>
      </thead>
      <tbody>
         <tr>
            <th>Maintenance_ID</th>
            <th>Vendor</th>
            <th>Description</th>
            <th>Vendor Address</th>
            <th>Cost</th>
            <!-- <th>Mileage</th> -->
            <th>Date</th>
            <th>Date Modified</th>
            <th>Phone Number</th>
            <?php if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){ ?>

              <th colspan="2"></th>
            <?php } ?>
         </tr>
         <?php foreach ($maintenance_array as $maintenance) :
            ?>
         <tr>
            <!--
               <td>
                   <?php echo $maintenance['maintenance_type_id']; ?>
               </td>-->
            <td>
               <?php echo $maintenance['maintenance_id']; ?>
            </td>
            <td>
               <?php echo $maintenance['maintenance_vendor']; ?>
            </td>
            <td>
               <?php echo $maintenance['maintenance_description']; ?>
            </td>
            <td>
               <?php echo $maintenance['maintenance_vendor_address']; ?>
            </td>
            <td>
               <?php echo "$".$maintenance['maintenance_cost']; ?>
            </td>
            <!-- <td>
               <?php echo $maintenance['maintenance_mileage']; ?>
               </td> -->
            <td>
               <?php echo dateCustomFormat($maintenance['maintenance_date']); ?>
            </td>
            <td>
               <?php echo dateModifiedCustomFormat($maintenance['maintenance_date_modified']); ?>
            </td>
            <td>
               <?php echo phoneNumberFormat($maintenance['maintenance_vendor_phone_number']); ?>
            </td>
            <td>
               <?php include "maintenance_edit_button.php"; ?>
            </td>
            <?php if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){ ?>

              <td><?php include "maintenance_delete_button.php";?>

              </td>
            <?php } ?>
         </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>
<?php include "footer.php";?>
