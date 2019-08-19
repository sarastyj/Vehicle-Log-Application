<?php include "header_navigation.php";
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $result = $conn->prepare("SELECT * FROM vehicles ORDER BY vehicle_id");
         $result->execute();
         $vehicles = $result->fetchAll();

       $states = array("AL","AK","AZ","AR","CA","CO","CT","DE","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME",
           "MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD",
           "TN","TX","UT","VT","VA","WA","WV","WI","WY");
   ?>
<div class="container-fluid">
<div class="table-responsive">
   <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
      <thead class="thead-light">
         <tr>
            <th align="center"colspan="15">
               <h3><b>Add Vehicle</b></h3>
            </th>
         </tr>
      </thead>
      <tbody>
         <form action="vehicle_add.php"method="post" id="addVehicleForm" name="form">
            <tr>
               <td align="right"><strong>Make:</strong></td>
               <td>
                  <input id="vehicle_make" type="text" name="vehicle_make" required placeholder="Honda" onblur="allLetters(this,'m.vehicle_make','e.vehicle_make')">
                  <span id="m.vehicle_make" style='color:green;'></span></br>
                  <span id="e.vehicle_make" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Model:</strong></td>
               <td>
                  <input required id="input_field" type="text" name="vehicle_model" placeholder="Civic" onblur="alphaNumeric(this,'m.vehicle_model','e.vehicle_model')">
                  <span id="m.vehicle_model" style='color:green;'></span></br>
                  <span id="e.vehicle_model" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Year:</strong></td>
               <td>
                  <select class="custom-select" id="vehicle_year" name="vehicle_year" form="addVehicleForm" onblur="optionSelected(this,'m.vehicle_year','e.vehicle_year', 'vehicle_year')">
                     <option value ="Select Year" selected>Select Year</option>
                     <?php
                        for ($year = (date(Y)-50); $year <= date(Y); $year++) {
                        echo "<option value='$year'>$year</option>";
                        }
                        ?>
                  </select>
                  <span id="m.vehicle_year" style='color:green;'></span></br>
                  <span id="e.vehicle_year" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Color:</strong></td>
               <td>
                  <input required id="input_field" type="text" name="vehicle_color" placeholder="Black" onblur="allLetters(this,'m.vehicle_color','e.vehicle_color')">
                  <span id="m.vehicle_color" style='color:green;'></span></br>
                  <span id="e.vehicle_color" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>VIN:</strong></td>
               <td>
                  <input required type="text" name="vehicle_vin" placeholder='GHTG12345HD57890' onblur="alphaNumeric(this,'m.vehicle_vin','e.vehicle_vin')">
                  <span id="m.vehicle_vin" style='color:green;'></span></br>
                  <span id="e.vehicle_vin" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>License Tag:</strong></td>
               <td>
                  <input required type="text" name="vehicle_license_tag" placeholder='TKG289' onblur="alphaNumeric(this,'m.vehicle_license_tag','e.vehicle_license_tag')">
                  <span id="m.vehicle_license_tag" style='color:green;'></span></br>
                  <span id="e.vehicle_license_tag" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>License State:</strong></td>
               <td>
                  <select class="custom-select" id="vehicle_license_state" name="vehicle_license_state" form="addVehicleForm" onblur="optionSelected(this,'m.vehicle_license_state','e.vehicle_license_state', 'vehicle_license_state')">
                     <option selected="selected">Select State</option>
                     <?php foreach ($states as $state) : ?>
                     <?php echo "<option value='$state'>$state</option>"; ?>
                     <?php endforeach; ?>
                  </select>
                  <span id="m.vehicle_license_state" style='color:green;'></span></br>
                  <span id="e.vehicle_license_state" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Year Purchased:</strong></td>
               <td>
                  <select class="custom-select" id="vehicle_year_purchased" name="vehicle_year_purchased" form="addVehicleForm" onblur="optionSelected(this,'m.vehicle_year_purchased','e.vehicle_year_purchased', 'vehicle_year_purchased')">
                     <option selected="selected">Select Year</option>
                     <?php
                        for ($year = (date(Y)-50); $year <= date(Y); $year++) {
                        echo "<option value='$year'>$year</option>";
                        }
                        ?>
                  </select>
                  <span id="m.vehicle_year_purchased" style='color:green;'></span></br>
                  <span id="e.vehicle_year_purchased" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Price:</strong></td>
               <td>
                  <input id="id_purchase_price" required type="text" name="vehicle_purchase_price" placeholder='35,000.00' onblur="currencyFormat(this,'m.purchase_price','e.purchase_price')">
                  <span id="m.purchase_price" style='color:green;'></span></br>
                  <span id="e.purchase_price" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Mileage:</td>
               <td><input id="id_vehicle_purchase_mileage" required type="text" name="vehicle_purchase_mileage" placeholder = '123,989' onblur="validMileageGallon(this,'m.purchase_mileage','e.purchase_mileage')" >
                  <span id="m.purchase_mileage" style='color:green;'></span></br>
                  <span id="e.purchase_mileage" class="error" style='color:red;'></span>
               </td>
            </tr>
            <td align="center" colspan="2"><input class="btn btn-primary" id="submitButton" type="submit" value="Submit" onclick="checkAddVehicleForm()"><br><span id="submitError" style='color:red;'></span></td>
         </form>
      </tbody>
   </table>
</div>
<?php include "footer.php"; ?>
