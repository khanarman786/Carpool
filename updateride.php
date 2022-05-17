<?php 
session_start();
require('connection.php');
$did=$_SESSION['email'];
$started=2;
date_default_timezone_set('Asia/Kolkata');
$starttime =  date("h:i a");
$date = date("m, j, Y");
  $n = 1;
  $sql = "SELECT * FROM `rides` WHERE `email`= '$did' AND `ridestatus` ='$n'";
  $process = mysqli_query($con, $sql);
  if (mysqli_num_rows($process) > 0) {
    $sql = "UPDATE `rides` SET `ridestatus` = '$started' WHERE `email` = '$did' AND `ridestatus`='$n'";
    $check = mysqli_query($con, $sql);
    if ($check) {
      $startingride = "UPDATE `rides` SET `start-time` = '$starttime' WHERE `email` = '$did' AND `ridestatus`='$started'";
      $complete = mysqli_query($con, $startingride);
      $date="UPDATE `rides` SET `date` = '$date' WHERE `email` = '$did' AND `ridestatus`='$started'";
      $update=mysqli_query($con,$date);
      $_SESSION['ridestarted'] = "ok";
    }
  }

