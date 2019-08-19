<!--Delete Button that redirects to a confirmation page-->

<div style='float:left'>
<form action="fuel_delete_confirm.php" method="POST">
<input type="hidden" name="fuel_id" value="<?php echo $fuel['fuel_id']; ?>" />
<input class="btn btn-primary" type="submit" value="Delete" />
</form>
