<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["username"] = "";
$_SESSION["password"] = "";
$_SESSION["user_level"] = "";
$_SESSION["user_id"] = "";
$_SESSION["access_granted"] = "";
header('Location: index.php');
die();
?>
