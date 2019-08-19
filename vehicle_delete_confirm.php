<?php
require_once('config.php');

// NOTE: This is a confirmation page to allow the user to change their mind before deleting a record

// Retrieve information from _POST array
$vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
$vehicle_make = filter_input(INPUT_POST, 'vehicle_make');
$vehicle_model = filter_input(INPUT_POST, 'vehicle_model');
$vehicle_year = filter_input(INPUT_POST, 'vehicle_year');
$vehicle_vin = filter_input(INPUT_POST, 'vehicle_vin');

// echo "Movie ID = $driverid";

// The $pageTitle variable is shown in the browser tab; refer to header.php to see where it is called
$pageTitle = "Delete Confirmation";
include "header_navigation.php";?>
<h3>Are you sure you want to delete <br><br>
    <b><em><?php echo $vehicle_make . " ". $vehicle_model ." ". $vehicle_year ." ";?></em></b>
<br />Vin#: <?php echo $vehicle_vin?>?</h3>

<div>
<form action="vehicle_delete.php" method="POST">
<input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>" />
<input class="btn btn-success" type="submit" value="YES, I am sure." />
</form><br>
</div>

<div>
<form action="vehicles.php" method="POST">
<input type="hidden" name="vehicle_id" value="" />
<input class="btn btn-danger" type="submit" value="CANCEL" />
</form>
</div>
</br>

<?php include 'footer.php'; ?>
