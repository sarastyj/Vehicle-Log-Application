<?php
require_once('config.php');
$maintenance_id = filter_input(INPUT_POST, 'maintenance_id');
try {
$query = "DELETE FROM maintenance WHERE maintenance_id = $maintenance_id";
$conn->exec($query);
include 'maintenance.php';
  }
catch(PDOException $e)
{
echo $query . "<br>" . $e->getMessage();  echo $query . "<br>" . $e->getMessage();
}
?>
