<?php
session_start();
require('connection.php');
$_SESSION = array();
session_destroy();
header("location:login.php");

?>