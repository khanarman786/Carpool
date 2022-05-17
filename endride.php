<?php
session_start();
require('connection.php');
$did = $_SESSION['email'];
date_default_timezone_set('Asia/Kolkata');
$endtime =  date("h:i a");
$endingdate = date("F j, Y");
$complete = 3;
$fare=0;
$ride=0;// for ride update in driver table  
$b = 2;
$sql = "SELECT * FROM `rides` WHERE `email`= '$did' AND `ridestatus` ='$b'";
$process = mysqli_query($con, $sql);
if (mysqli_num_rows($process) > 0) {
  $endingride = "UPDATE `rides` SET `end-time` = '$endtime' WHERE `email` = '$did' AND `ridestatus`='$b'";
  $completed = mysqli_query($con, $endingride);
  if($completed){
    $calculatingseat="SELECT * FROM `rides` WHERE `email` = '$did' AND `ridestatus`='$b'";
    $checking=mysqli_query($con,$calculatingseat);
    if(mysqli_num_rows($checking)>0){
      while($row=mysqli_fetch_assoc($checking)){
        $src=$row['source'];
        $dst=$row['destination'];
        $start=$row['start-time'];
        $end=$row['end-time'];
        $totalseat=$row['seat'];
        $seatavail=$row['seat-avail'];
      }
      }
    }
    if($checking){
    $calculatingearn="SELECT * FROM `$did`";
    $calcu=mysqli_query($con,$calculatingearn);
    if(mysqli_num_rows($calcu)>0){
      while($amount=mysqli_fetch_assoc($calcu)){
        $fare=$amount['amount'];
        $seattaken=$amount['seatbooked'];
        $actualfare=$fare/$seattaken;
      }
    }
    if($calcu){
    $totalseatbooked=$totalseat-$seatavail;
    $totalearning=$totalseatbooked*$actualfare;
    
    $tablecreation = "CREATE TABLE IF NOT EXISTS `{$_SESSION['mobile']}`( " .
    "id INT NOT NULL AUTO_INCREMENT, " .
    "source VARCHAR(100) NOT NULL, " .
    "destination VARCHAR(100) NOT NULL, " .
    "seatbooked VARCHAR(10) NOT NULL, " .
    "earning VARCHAR(10) NOT NULL, " .
    "start VARCHAR(40) NOT NULL, " .
    "end VARCHAR(40) NOT NULL, " .
    "enddate VARCHAR(40) NOT NULL, " .
    "PRIMARY KEY (id)); ";

mysqli_select_db($dri, "drivers");
$retval = mysqli_query($dri, $tablecreation);
    }
    if($retval){
      $creatinghistory="INSERT INTO `{$_SESSION['mobile']}`
       (`source`, `destination`, `seatbooked`, `earning`, `start`, `end`,`enddate`)
      VALUES
       ('$src','$dst','$totalseatbooked','$totalearning','$start','$end','$endingdate')";
       $result=mysqli_query($dri,$creatinghistory);
    }
  if ($result) {
    $sqli = "UPDATE `rides` SET `ridestatus` = '$complete' WHERE `email` = '$did' AND `ridestatus`='$b'";
    $check = mysqli_query($con, $sqli);
  }
    if($check){
    $deletingtable="DELETE FROM `$did` WHERE 1=1";
    $done= mysqli_query($con,$deletingtable);
  }
  if($done){
      $ridecreated="UPDATE `driver` SET `ridecreated` = '$ride' WHERE `email` = '{$_SESSION['email']}'";
      $update=mysqli_query($con,$ridecreated);
      }
  if($update){
    header("location:driver.php");

  }}}