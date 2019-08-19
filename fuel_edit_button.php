<!--Collects the Fuel ID-->
<div>
	<form action="fuel_edit_form.php" method="POST">
		<input type="hidden" name="fuel_id" value='<?php echo $fuel['fuel_id']; ?>' />
		<input type="hidden" name="vehicle_id" value='<?php echo $fuel['vehicle_id']; ?>' />
		<input type="hidden" name="fuel_mileage" value='<?php echo $fuel['fuel_mileage']; ?>' />
		<input class="btn btn-primary" type="submit" value="Edit" />
	</form>
</div>
