<!-- This is a separate file so it can be reused; similar to a function -->
<div>
  <form action="user_delete_confirm.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>" />
    <input type="hidden" name="first_name" value="<?php echo $user['first_name']; ?>" />
    <input type="hidden" name="last_name" value="<?php echo $user['last_name']; ?>" />
    <input class="btn btn-primary" type="submit" value="Delete" />
  </form>
</div>
