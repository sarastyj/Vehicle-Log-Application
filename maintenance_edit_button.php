<!--Collects the Maintenance ID-->
<div>
	<form action="maintenance_edit_form.php" method="POST">
		<input type="hidden" name="maintenance_id" value='<?php echo $maintenance['maintenance_id']; ?>' />
		<input class="btn btn-primary" type="submit" value="Edit" />
	</form>
</div>
