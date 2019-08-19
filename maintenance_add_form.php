<?php
include "header_navigation.php";
include "table_format.php";
$vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
$states = array("AL","AK","AZ","AR","CA","CO","CT","DE","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME",
    "MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD",
    "TN","TX","UT","VT","VA","WA","WV","WI","WY");
?>
                    <thead>
                <tr>
                    <tr>
                            <td colspan="15"><h3><b>Add Maintenance Record</b></h3></td>
                        </tr>
                    </thead>
                    <form id="form" action="maintenance_add.php" method="post">
                    <tr>
                    <td align="right"><strong>Vendor:</strong></td>
                    <td><input id="maintenance_vendor" required type="text" name="maintenance_vendor" onblur="allLetters(this,'m.maintenance_vendor','e.maintenance_vendor')" placeholder = 'Meineke'><span id="m.maintenance_vendor" style='color:green;'></span></br>
                    <span id="e.maintenance_vendor" class="error" style='color:red;'></span></td>
                    </tr>
                    <tr>
                    <td align="right"><strong>Description:</strong></td>
                    <td><input id="maintenance_description" required type="text" name="maintenance_description" onblur="allLetters(this,'m.maintenance_description','e.maintenance_description')" placeholder = 'Oil Change'><span id="m.maintenance_description" style='color:green;'></span></br>
                    <span id="e.maintenance_description" style='color:red;'></span></td>
                    </tr>
                    <!-- //Address Field
                        Street Address: 255 characters.
                        Address Line 2: 150 characters.
                        City: 255 characters.
                        State/Province/Region: 255 characters.
                        Postal/Zip Code: 15 characters. -->
                    <tr>
                    <td align="right"><strong>Street Address:</strong></td>
                    <td><input id="street_address" required type="text" name="street_address" onblur="validAddress(this,'m.street_address','e.street_address')" placeholder = 'Ex: 212 Wade Hampton Blvd'><span id="m.street_address" style='color:green;'></span></br>
                    <span id="e.street_address" style='color:red;'></span></td> <!-- Fix Input-->
                    </tr>
                    <tr>
                    <td align="right"><strong>Address Line 2:</strong></td>
                    <td><input id="address_line_2" type="text" name="address_line_2" onblur="validAddress(this,'m.address_line_2','e.address_line_2')" placeholder = 'Ex: Apt 2B'><span id="m.address_line_2" style='color:green;'></span></br>
                    <span id="e.address_line_2" style='color:red;'></span></td> <!-- Fix Input-->
                    </tr>
                    <tr>
                    <td align="right"><strong>City:</strong></td>
                    <td><input id="city" required type="text" name="city" onblur="validAddress(this,'m.city','e.city')" placeholder = 'Ex: Los Angeles'><span id="m.city" style='color:green;'></span></br>
                    <span id="e.city" style='color:red;'></span></td> <!-- Fix Input-->
                    </tr>
                    <tr>
                    <td align="right"><strong>State:</strong></td>
                    <td>
                      <select class="custom-select" id="state" name="state" form="form" onblur="validAddress(this,'m.state','e.state')">
                          <option selected="selected">Select State</option>
                          <?php foreach ($states as $state) : ?>
                              <?php echo "<option value='$state'>$state</option>"; ?>
                                  <?php endforeach; ?>
                      </select>
                      <span id="m.state" style='color:green;'></span></br>
                      <span id="e.state" style='color:red;'></span>
                    </td>
                    </tr>
                    <tr>
                    <td align="right"><strong>Postal/Zip Code:</strong></td>
                    <td><input id="zipCode" required type="text" name="zipCode" onblur="validAddress(this,'m.zipCode','e.zipCode')" placeholder = 'Ex: 12354 OR 12345-1234'><span id="m.zipCode" style='color:green;'></span></br>
                    <span id="e.zipCode" style='color:red;'></span></td> <!-- Fix Input-->
                    </tr>
                    <tr>
                    <td align="right"><strong>Cost:</strong></td>
                    <td><input id="maintenance_cost" required type="text" name="maintenance_cost" onblur="currencyFormat(this,'m.maintenance_cost','e.maintenance_cost')" placeholder = '20.00'><span id="m.maintenance_cost" style='color:green;'></span></br>
                    <span id="e.maintenance_cost" style='color:red;'></span></td> <!-- Fix Input-->
                    </tr>
                    <tr>
                    <td align="right"><strong>Mileage:</strong></td>
                    <td><input id="maintenance_mileage" required type="text" name="maintenance_mileage" onblur="validMileageGallon(this,'m.maintenance_mileage','e.maintenance_mileage')" placeholder = '110,890'><span id="m.maintenance_mileage" style='color:green;'></span></br>
                    <span id="e.maintenance_mileage" style='color:red;'></span></td> <!-- Fix Input-->
                    </tr>
                    <tr>
                    <td align="right"><strong>Phone Number:</strong></td>
                    <td><input id="maintenance_vendor_phone_number" required type="text" name="maintenance_vendor_phone_number" onblur="validPhoneNumber(this,'m.maintenance_vendor_phone_number','e.maintenance_vendor_phone_number')" placeholder = '8645551234'><span id="m.maintenance_vendor_phone_number" style='color:green;'></span></br>
                    <span id="e.maintenance_vendor_phone_number" style='color:red;'></span></td>
                    </tr>
                    <input type="hidden" name="vehicle_id" value= '<?php echo $vehicle_id ?>'>
                    <td align="center" colspan="2"><input class="btn btn-primary" type="submit" value="Add Record"><br></td>
                    </form>
            </table>

    <br />
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
