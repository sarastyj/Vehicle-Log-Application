<?php
require_once('config.php');
$vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
try {
$query = "DELETE FROM vehicles WHERE vehicle_id = $vehicle_id";
    // use exec() because no results are returned
    $conn->exec($query);
    include 'vehicles.php';
}
catch(PDOException $e) {
    echo $query . "<br>" . $e->getMessage();
    }
?>
