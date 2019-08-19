<?php
require_once('config.php');
$fuel_id = filter_input(INPUT_POST, 'fuel_id');
  try {
  $query = "DELETE FROM fuel WHERE fuel_id = $fuel_id";
  $conn->exec($query);
  include 'fuel.php';
    }
  catch(PDOException $e)
  {
  echo $query . "<br>" . $e->getMessage();
  }
?>
