<?php
require_once('config.php');

// NOTE: This is a confirmation page to allow the user to change their mind before deleting a record

// Retrieve information from _POST array
$user_id = filter_input(INPUT_POST, 'user_id');
$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');

// The $pageTitle variable is shown in the browser tab; refer to header.php to see where it is called
$pageTitle = "Delete Confirmation";
include "header_navigation.php";?>
<h3>Are you sure you want to delete <b><em><?php echo $first_name . " ". $last_name ." "; ?></em></b>?</h3>
<br />

<div class="container">
<form action="user_delete.php" method="POST">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
<input class="btn btn-success" type="submit" value="YES, I am sure." />
</form><br>
</div>

<div class="container">
<form action="users.php" method="POST">
<input type="hidden" name="user_id" value="" />
<input class="btn btn-danger" type="submit" value="CANCEL" />
</form>
</div>
<br />
<?php include 'footer.php'; ?>
