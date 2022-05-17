<?php 
session_start();
require('connection.php');
$driver = $_SESSION['email'];
$n=1;
$started=2;
$sql = "SELECT * FROM `rides` WHERE `email`= '$driver' AND (`ridestatus` ='$n' OR `ridestatus` ='$started')";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    while($seat=mysqli_fetch_assoc($result)){
        $seatleft=$seat['seat-avail'];
        $_SESSION['seatleft']=$seatleft;
    }
    echo $seatleft;
}?>