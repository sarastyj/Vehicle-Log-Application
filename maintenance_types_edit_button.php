<!--Collects the Maintenance ID-->
<div>
	
	<form action="maintenance_types_edit_form.php" method="POST">
		<input type="hidden" name="maintenance_types_id" value='<?php echo $maintenance['maintenance_types_id']; ?>'>
		<!--<input type="hidden" name="vehicle_id" value='<?php echo $maintenance['vehicle_id']; ?>'>-->
		<input type="hidden" name="redirect" value='<?php echo $redirect; ?>'>
		<input type="submit" value="Edit" />
	</form>
</div>