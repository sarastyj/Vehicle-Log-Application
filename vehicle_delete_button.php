<!-- This is a separate file so it can be reused; similar to a function -->

<div>
<form action="vehicle_delete_confirm.php" method="POST">
<input type="hidden" name="vehicle_id" value="<?php echo $vehicle['vehicle_id']; ?>" />
<input type="hidden" name="vehicle_make" value="<?php echo $vehicle['vehicle_make']; ?>" />
<input type="hidden" name="vehicle_model" value="<?php echo $vehicle['vehicle_model']; ?>" />
<input type="hidden" name="vehicle_year" value="<?php echo $vehicle['vehicle_year']; ?>" />
<input type="hidden" name="vehicle_vin" value="<?php echo $vehicle['vehicle_vin']; ?>" />
<input class="btn btn-primary" type="submit" value="Delete" />
</form>
</div>
