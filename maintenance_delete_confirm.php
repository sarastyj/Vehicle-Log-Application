<?php
require('config.php');

// NOTE: This is a confirmation page to allow the user to change their mind before deleting a record

// Retrieve information from _POST array
$maintenance_id = filter_input(INPUT_POST, 'maintenance_id');

// echo "Movie ID = $driverid";

// The $pageTitle variable is shown in the browser tab; refer to header.php to see where it is called
$pageTitle = "Delete Confirmation";
include "header_navigation.php";?>
<h3>Are you sure you want to delete<br><br>
    Maintenance ID: <b><em><?php echo $maintenance_id;?></em> ?</b></h3><br>

<div>
<form action="maintenance_delete.php" method="POST">
<input type="hidden" name="maintenance_id" value="<?php echo $maintenance_id; ?>" />
<input class="btn btn-success" type="submit" value="YES, I am sure." />
</form><br>
</div>

<div>
<form action="maintenance.php" method="POST">
<input type="hidden" name="maintenance_id" value="" />
<input class="btn btn-danger" type="submit" value="CANCEL" />
</form>
</div>
<br />

<?php include 'footer.php'; ?>
