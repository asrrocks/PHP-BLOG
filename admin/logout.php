<?php 
session_start();

session_unset();

$_SESSION['user_id'] = null;
$_SESSION['username'] = null;
$_SESSION['name'] = null;
session_destroy();

header("Location: index.php");
?>