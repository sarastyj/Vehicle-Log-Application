<?php
require_once('config.php');
$user_id = filter_input(INPUT_POST, 'user_id');
  try {
  $query = "DELETE FROM users WHERE user_id = $user_id";
  $conn->exec($query);
  include 'users.php';
    }
  catch(PDOException $e)
  {
  echo $query . "<br>" . $e->getMessage();
  }
?>
