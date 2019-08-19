<?php
require('config.php');

// This is a confirmation page to allow the user to change their mind before deleting a record

// Retrieve information from _POST array
$fuel_id = filter_input(INPUT_POST, 'fuel_id');


// The $pageTitle variable is shown in the browser tab; refer to header.php to see where it is called
$pageTitle = "Delete Confirmation";
include "header_navigation.php";?>
<h3>Are you sure you want to delete Fuel Id:  <b><em><?php echo $fuel_id; ?></em></b> ?</h3>
<br />

<div class="container">
<form action="fuel_delete.php" method="POST">
<input type="hidden" name="fuel_id" value="<?php echo $fuel_id; ?>" />
<input class="btn btn-success" type="submit" value="YES, I am sure." />
</form>
</div></br>

<div class="container">
<form action="fuel.php" method="POST">
<input type="hidden" name="fuel_id" value="" />
<input class="btn btn-danger" type="submit" value="CANCEL" />
</form>
</div>
<br />
<?php include 'footer.php'; ?>
