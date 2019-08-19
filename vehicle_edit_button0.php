<!--Collects the Vehicle ID-->
<div>
	
	<form action="vehicle_edit_form.php" method="POST">
		<input type="hidden" name="vehicle_id" value='<?php echo $vehicle['vehicle_id']; ?>' />
		<input type="submit" value="Edit" />
	</form>
</div>