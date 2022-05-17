<?php

error_reporting(0);
$servername="localhost";
$username="root";
$password="";
$database="taxi";
$con=mysqli_connect($servername,$username,$password,$database);
if(!$con){
    echo "connection failed due to ".mysqli_error($con);
}
$servername="localhost";
$username="root";
$password="";
$database="users";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$con){
    echo "connection failed due to ".mysqli_error($conn);
}
$servername="localhost";
$username="root";
$password="";
$database="drivers";
$dri=mysqli_connect($servername,$username,$password,$database);
if(!$con){
    echo "connection failed due to ".mysqli_error($conn);
}


?>