<!--Collects the Maintenance ID-->
<div>
	
	<form action="maintenance_edit_form.php" method="POST">
		<input type="hidden" name="vehicle_id" value= <?php echo $vehicle_array['vehicle_id']?>>
		<input type="submit" value="Edit Maintenance Record" />
	</form>
</div>