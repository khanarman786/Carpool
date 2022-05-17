<?php
session_start();
require('connection.php');
$driver = $_SESSION['driver'];
$sql ="UPDATE `driver` SET `status` = '0' WHERE `fname` = '$driver'";
$result = mysqli_query($con,$sql);
if($result){
  session_destroy();
  header("location:driverregistration.php");
}
?>