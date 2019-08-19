<?php
   //Collecting Variables From POST_ARRAY
   $vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
   include "header_navigation.php";
   ?>
<div class="container-fluid">
<div class="table-responsive">
   <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
      <thead class="thead-light">
         <tr>
            <td colspan="15">
               <h3><b>Add Fuel Record</b></h3>
            </td>
         </tr>
      </thead>
      <tbody>
         <form action="fuel_add.php" method="post">
            <input type='hidden' name='vehicle_id' value=<?php echo $vehicle_id?>>
            <tr>
               <td align="right"><strong>Source:</strong></td>
               <td><input id="fuel_source" required type="text"
                  onblur="allLetters(this,'m.fuel_source','e.fuel_source')"  name="fuel_source" placeholder = 'Spinx'><span id="m.fuel_source" style='color:green;'></span></br>
                  <span id="e.fuel_source" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Gallons:</strong></td>
               <td><input id="fuel_gallons" required type="text" name="fuel_gallons" onblur="validMileageGallon(this,'m.fuel_gallons','e.fuel_gallons')" placeholder='50'><span id="m.fuel_gallons" style='color:green;'></span></br>
                  <span id="e.fuel_gallons" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Cost:</strong></td>
               <td><input id="fuel_cost" required type="text" name="fuel_cost" onblur="currencyFormat(this,'m.fuel_cost','e.fuel_cost')" placeholder='25.00'><span id="m.fuel_cost" style='color:green;'></span></br>
                  <span id="e.fuel_cost" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Mileage:</strong></td>
               <td><input id="fuel_mileage_end" type="text" name="fuel_mileage_end" onblur="validMileageGallon(this,'m.fuel_mileage','e.fuel_mileage')" placeholder='123890'><span id="m.fuel_mileage" style='color:green;'></span></br>
                  <span id="e.fuel_mileage" class="error" style='color:red;'></span>
               </td>
            </tr>
            <td align="center"colspan = "2"><input class="btn btn-primary" type="submit" value="Add"></td>
         </form>
      </tbody>
   </table>
</div>
<?php include "footer.php";?>
