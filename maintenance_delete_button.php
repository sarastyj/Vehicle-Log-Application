<!-- This is a separate file so it can be reused; similar to a function -->

<div style='float:left'>
<form action="maintenance_delete_confirm.php" method="POST">
<input type="hidden" name="maintenance_id" value="<?php echo $maintenance['maintenance_id']; ?>" />
<input class="btn btn-primary" type="submit" value="Delete" />
</form>
