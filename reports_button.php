<!--Collects the Vehicle ID-->
<div>

	<form action="reports.php" method="POST">
		<input type="hidden" name="vehicle_id" value='<?php echo $vehicle['vehicle_id']; ?>' />
		<input class="btn btn-primary" type="submit" value="Reports" />
	</form>
</div>
