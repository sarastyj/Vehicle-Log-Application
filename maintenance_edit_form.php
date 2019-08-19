<?php include "header_navigation.php";

$maintenance_id = filter_input(INPUT_POST, 'maintenance_id');
//echo "Maintenance ID = $maintenance_id";

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $conn->prepare("SELECT * FROM maintenance WHERE maintenance_id = '$maintenance_id'");
      $result->execute();
      $maintenance_array = $result->fetchAll();

// $query = 'SELECT *
//           FROM maintenance
//           WHERE maintenance_id = :maintenance_id';
//     $statement = $db->prepare($query);
//     $statement->bindValue(":maintenance_id", $maintenance_id);
//     $statement->execute();
//     $maintenance_array = $statement->fetch();
//     $statement->closeCursor();
?>
<div class="container-fluid">
   <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
         <thead class="thead-light">
           <tr>
               <td colspan="15"><h3><b>Editing Maintenance Record</b></h3></td>
           </tr>
         </thead>
         <tbody>
<?php foreach ($maintenance_array as $maintenance) :?>

                            <form action="maintenance_edit.php" method="post">
            <input type="hidden" name="maintenance_id" value= <?php echo $maintenance['maintenance_id']?>>

            <tr>
            <td align="right"><strong>Vendor:</strong></td>
            <td><input id="maintenance_vendor" required type="text" name="maintenance_vendor" onblur="allLetters(this,'m.maintenance_vendor','e.maintenance_vendor')" value= "<?php echo $maintenance['maintenance_vendor'] ?>"><span id="m.maintenance_vendor" style='color:green;'></span></br>
            <span id="e.maintenance_vendor" class="error" style='color:red;'></span></td>
          </tr>
            <tr>
            <td align="right"><strong>Description:</strong></td>
            <td><input id="maintenance_description" required type="text" name="maintenance_description" onblur="allLetters(this,'m.maintenance_description','e.maintenance_description')" value= "<?php echo $maintenance['maintenance_description'] ?>"><span id="m.maintenance_description" style='color:green;'></span></br>
            <span id="e.maintenance_description" style='color:red;'></span></td>
            </tr>
            <!-- <tr>
            <td align="right"><strong>Date:</strong></td>
            <td><input id="maintenance_date" type="text" name="maintenance_date" onblur="validDate(this,'m.maintenance_date','e.maintenance_date')" value= <?php echo $maintenance['maintenance_date'] ?>><span id="m.maintenance_date" style='color:green;'></span></br>
            <span id="e.maintenance_date" style='color:red;'></span></td>
            </tr>
            <tr> -->
            <td align="right"><strong>Address:</strong></td>
            <td><input id="maintenance_vendor_address" required type="text" name="maintenance_vendor_address" onblur="validAddress(this,'m.maintenance_vendor_address','e.maintenance_vendor_address')" value= "<?php echo $maintenance['maintenance_vendor_address'] ?>"><span id="m.maintenance_vendor_address" style='color:green;'></span></br>
            <span id="e.maintenance_vendor_address" style='color:red;'></span></td>
            </tr>
            <tr>
            <td align="right"><strong>Cost:</strong></td>
            <td><input id="maintenance_cost" required type="text" name="maintenance_cost" onblur="currencyFormat(this,'m.maintenance_cost','e.maintenance_cost')" value= "<?php echo $maintenance['maintenance_cost'] ?>"><span id="m.maintenance_cost" style='color:green;'></span></br>
            <span id="e.maintenance_cost" style='color:red;'></span></td>
            </tr>
            <tr>
            <td align="right"><strong>Mileage:</strong></td>
            <td><input id="maintenance_mileage" required type="text" name="maintenance_mileage" onblur="mileageFormat(this,'m.maintenance_mileage','e.maintenance_mileage')" value= "<?php echo $maintenance['maintenance_mileage'] ?>"><span id="m.maintenance_mileage" style='color:green;'></span></br>
            <span id="e.maintenance_mileage" style='color:red;'></span></td>
            </tr>
            <tr>
            <td align="right"><strong>Phone Number:</strong></td>
            <td><input id="maintenance_vendor_phone_number" required type="text" name="maintenance_vendor_phone_number" onblur="validPhoneNumber(this,'m.maintenance_vendor_phone_number','e.maintenance_vendor_phone_number')" value= "<?php echo $maintenance['maintenance_vendor_phone_number']?>"><span id="m.maintenance_vendor_phone_number" style='color:green;'></span></br>
            <span id="e.maintenance_vendor_phone_number" style='color:red;'></span></td>
            </tr>
          <?php endforeach;?>

            <td align="center"colspan = "2"><input class="btn btn-primary" type="submit" value="Update"></td>
                    </form>
                  </tbody>
                </table>
              </div>
            <?php include "footer.php";?>
