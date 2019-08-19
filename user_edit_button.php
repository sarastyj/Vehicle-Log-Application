<!--Collects the Driver ID-->
<div>
	<form action="user_edit_form.php" method="POST">
		<input type="hidden" name="driver_id" value='<?php echo $user['driver_id']; ?>' />
		<input type="hidden" name="first_name" value="<?php echo $driver['first_name']; ?>" />
		<input type="hidden" name="last_name" value="<?php echo $driver['last_name']; ?>" />
		<input class="btn btn-primary" type="submit" value="Edit" />
	</form>
</div>
