<?php 
session_start();
require('connection.php');
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$mno=$_POST["mno"];
$email=$_POST["email"];
$password=$_POST["password"];
$emailerror = false;
$mnoerror = false;
if($con){
    $echeck="SELECT * FROM user WHERE `email`='$email'";
    $mnocheck="SELECT * FROM user WHERE `mno`='$mno'";
    $esql=mysqli_query($con,$echeck);
    $ecount=mysqli_num_rows($esql);
    if($ecount==1){
        echo "this email is already taken !";
        $emailerror = true;
    }
    $msql=mysqli_query($con,$mnocheck);
    $mcount=mysqli_num_rows($msql);
    if($mcount==1){
        echo "this Number is already taken !";
        $mnoerror = true;
    }

}
if($emailerror==false && $mnoerror==false && $emptyerror==false){
    $sql="INSERT INTO `user` (`fname`, `lname`, `mno`, `email`, `password`) VALUES ('$fname','$lname','$mno','$email','$password')";
    $result=mysqli_query($con,$sql);
}
else{

}
header("location:login.php");
?>