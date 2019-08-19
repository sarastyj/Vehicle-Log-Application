<?php

//echo $vehicle_id;
$vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
$vehicle_make = filter_input(INPUT_POST, 'vehicle_make');
$vehicle_model = filter_input(INPUT_POST, 'vehicle_model');
$vehicle_year = filter_input(INPUT_POST, 'vehicle_year');
$vehicle_vin = filter_input(INPUT_POST, 'vehicle_vin');
//echo "vehicle ID =" . $vehicle_id;

require_once('config.php');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $conn->prepare("SELECT * FROM vehicles WHERE vehicle_id = '$vehicle_id'");
      $result->execute();

/*$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $conn->prepare("SELECT * FROM vehicles ORDER BY vehicle_id");
      $result->execute();
      $vehicles = $result->fetchAll();    */

      $vehicles = $result->fetchAll();

      //echo "vehicle make =" . $vehicle_array['vehicle_id'];
      $states = array("AL","AK","AZ","AR","CA","CO","CT","DE","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME",
          "MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD",
          "TN","TX","UT","VT","VA","WA","WV","WI","WY");
?>
<?php include "header_navigation.php";
      foreach ($vehicles as $vehicle_array): ?>
                  <div class="container-fluid">
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
                           <thead class="thead-light">
                              <tr>
                                 <th align="center"colspan="15">
                                    <h3><b>Vehicle Report - ID# <?php echo $vehicle_id?></b></h3>
                                 </th>
                              </tr>
                                <tr>
                                    <td colspan="15"><h3>Editing Vehicle:<b><em><?php echo
                                    $vehicle_array['vehicle_make'] . " ". $vehicle_array['vehicle_model'] ." ". $vehicle_array['vehicle_year'] ." ";?>
<br />Vin#: <?php echo $vehicle_array['vehicle_vin']?></em></b></h3></br>

                            <form method="POST" action="maintenance_add_form.php">
                                <input type="hidden" name="vehicle_id" value= '<?php echo $vehicle_array['vehicle_id']?>'>
                                <button class="btn btn-primary" type="SUBMIT">Add Maintenance Record</button>
                            </form>
                            <form method="POST" action="fuel_add_form.php">
                                <input type="hidden" name="vehicle_id" value= '<?php echo $vehicle_array['vehicle_id']?>'>
                                <button class="btn btn-primary" type="SUBMIT">Add Fuel Record</button>
                            </form>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                            <form action="vehicle_edit.php" method="post" id="editVehicleForm" name="form">
                            <input type="hidden" name="vehicle_id" value= '<?php echo $vehicle_array['vehicle_id']?>'>


            <tr>
            <td align="right"><strong>Make:</strong></td>
            <td><input id="vehicle_make" required type="text" name="vehicle_make" onblur="allLetters(this,'m.vehicle_make','e.vehicle_make')" value= '<?php echo $vehicle_array['vehicle_make']?>'><span id="m.vehicle_make" style='color:green;'></span></br>
            <span id="e.vehicle_make" class="error" style='color:red;'></span></td>
            </tr>
            <tr>
            <td align="right"><strong>Model:</strong></td>
            <td><input id="vehicle_model" required type="text" name="vehicle_model" onblur="alphaNumeric(this,'m.vehicle_model','e.vehicle_model')" value= '<?php echo $vehicle_array['vehicle_model']?>'>
            <span id="m.vehicle_model" style='color:green;'></span></br>
            <span id="e.vehicle_model" class="error" style='color:red;'></span></td>
            </tr>
            <tr>
                <td align="right"><strong>Year:</strong></td>
                <td>
                    <select id="vehicle_year" name="vehicle_year" form="editVehicleForm" onblur="optionSelected(this,'m.vehicle_year','e.vehicle_year', 'vehicle_year')">
                        <option value =<?php echo $vehicle_array['vehicle_year']?> selected><?php echo $vehicle_array['vehicle_year']?></option>
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
            <td><input id="vehicle_color" required type="text" name="vehicle_color" value= '<?php echo $vehicle_array['vehicle_color']?>'onblur="allLetters(this,'m.vehicle_color','e.vehicle_color')"><span id="m.vehicle_color" style='color:green;'></span></br>
            <span id="e.vehicle_color" class="error" style='color:red;'></span></td>
            </tr>
            <tr>
            <td align="right"><strong>Vin:</strong></td>
            <td><input id="vehicle_vin" required type="text" name="vehicle_vin" value= '<?php echo $vehicle_array['vehicle_vin']?>'onblur="alphaNumeric(this,'m.vehicle_vin','e.vehicle_vin')"><span id="m.vehicle_vin" style='color:green;'></span></br>
            <span id="e.vehicle_vin" class="error" style='color:red;'></span></td>
            </tr>
            <tr>
            <td align="right"><strong>License Tag:</strong></td>
            <td><input id="vehicle_license_tag" required type="text" name="vehicle_license_tag" value= '<?php echo $vehicle_array['vehicle_license_tag']?>'onblur="alphaNumeric(this,'m.vehicle_license_tag','e.vehicle_license_tag')">
            <span id="m.vehicle_license_tag" style='color:green;'></span></br>
            <span id="e.vehicle_license_tag" class="error" style='color:red;'></span></td>
            </tr>
            <tr>
                <td align="right"><strong>License State:</strong></td>
                <td>
                    <select id="vehicle_license_state" name="vehicle_license_state" form="editVehicleForm" onblur="optionSelected(this,'m.vehicle_license_state','e.vehicle_license_state', 'vehicle_license_state')">
                        <option selected=<?php echo $vehicle_array['vehicle_license_state']?>><?php echo $vehicle_array['vehicle_license_state']?></option>
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
                    <select id="vehicle_year_purchased" name="vehicle_year_purchased" form="editVehicleForm" onblur="optionSelected(this,'m.vehicle_year_purchased','e.vehicle_year_purchased', 'vehicle_year_purchased')">
                        <option value =<?php echo $vehicle_array['vehicle_year_purchased']?> selected><?php echo $vehicle_array['vehicle_year_purchased']?></option>
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
            <td align="right"><strong>Price ($):</strong></td>
            <td><input id ="purchase_price" required type="text" name="vehicle_purchase_price" value= '<?php echo number_format($vehicle_array['vehicle_purchase_price'],2)?>' onblur="currencyFormat(this,'m.purchase_price','e.purchase_price')"><span id="m.purchase_price" style='color:green;'></span></br>
            <span id="e.purchase_price" class="error" style='color:red;'></span></td>
            </tr>
            <tr>
            <td align="right"><strong>Purchase Mileage:</strong></td>
            <td><input id="vehicle_purchase_mileage" required type="text" name="vehicle_purchase_mileage" value= '<?php echo number_format($vehicle_array['vehicle_purchase_mileage'])?>'onblur="mileageFormat(this,'m.purchase_mileage','e.purchase_mileage')"><span id="m.purchase_mileage" style='color:green;'></span></br>
            <span id="e.purchase_mileage" class="error" style='color:red;'></span></td>
            </tr>
            <td align="center"colspan = "2"><input class="btn btn-primary" type="submit" value="Update"></td>
            </form>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
            <?php include "footer.php";?>
