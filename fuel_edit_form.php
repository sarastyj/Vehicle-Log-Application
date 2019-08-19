<?php include "header_navigation.php";
   $fuel_id = filter_input(INPUT_POST, 'fuel_id');
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $result = $conn->prepare("SELECT * FROM fuel WHERE fuel_id = $fuel_id ORDER BY fuel_source");
         $result->execute();
         $fuel_array = $result->fetchAll();
         foreach ($fuel_array as $fuel) :
   /*
   //Selecting Data to Populate Table
   $query = 'SELECT *
             FROM fuel
             WHERE fuel_id = :fuel_id';
       $statement = $db->prepare($query);
       $statement->bindValue(":fuel_id", $fuel_id);
       $statement->execute();
       $fuel_array = $statement->fetch();
       $statement->closeCursor();
   */
   ?>
<div class="container-fluid">
<div class="table-responsive">
   <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
      <thead class="thead-light">
         <tr>
            <td colspan="15">
               <h3><b>Editing Fuel Record</b></h3>
            </td>
         </tr>
      </thead>
      <tbody>
         <form action="fuel_edit.php" method="post">
            <input type="hidden" name="fuel_id" value= '<?php echo $fuel['fuel_id']?>'>
            <tr>
               <td align="right"><strong>Source:</strong></td>
               <td><input id="fuel_source" required type="text" name="fuel_source" onblur="allLetters(this,'m.fuel_source','e.fuel_source')" value= '<?php echo $fuel['fuel_source']?>'><span id="m.fuel_source" style='color:green;'></span></br>
                  <span id="e.fuel_source" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Gallons:</strong></td>
               <td><input id="fuel_gallons" required type="text" name="fuel_gallons" onblur="validMileageGallon(this,'m.fuel_gallons','e.fuel_gallons')" value= '<?php echo $fuel['fuel_gallons']?>'><span id="m.fuel_gallons" style='color:green;'></span></br>
                  <span id="e.fuel_gallons" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Cost:</strong></td>
               <td><input id="fuel_cost" required type="text" name="fuel_cost" onblur="currencyFormat(this,'m.fuel_cost','e.fuel_cost')" value= '<?php echo $fuel['fuel_cost']?>'><span id="m.fuel_cost" style='color:green;'></span></br>
                  <span id="e.fuel_cost" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Previous Mileage:</strong></td>
               <td><input id="fuel_mileage" required type="text" name="fuel_mileage" onblur="validMileageGallon(this,'m.fuel_mileage','e.fuel_mileage')" value= '<?php echo $fuel['fuel_mileage']?>'><span id="m.fuel_mileage" style='color:green;'></span></br>
                  <span id="e.fuel_mileage" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Current Mileage:</strong></td>
               <td><input id="fuel_mileage_end" required type="text" name="fuel_mileage_end" onblur="validMileageGallon(this,'m.fuel_mileage_end','e.fuel_mileage_end')" value= '<?php echo $fuel['fuel_mileage_end']?>'><span id="m.fuel_mileage_end" style='color:green;'></span></br>
                  <span id="e.fuel_mileage_end" class="error" style='color:red;'></span>
               </td>
            </tr>
            <td align="center"colspan = "2"><input class="btn btn-primary" type="submit" value="Update"></td>
         </form>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>
<?php include "footer.php";?>
