<?php 
session_start();
require('connection.php');
error_reporting(0);
// $ridecreated=0;
// $fname=$_POST["fname"];
// $lname=$_POST["lname"];
// $mno=$_POST["mno"];
// $email=$_POST["email"];
// $password=$_POST["password"];
// $vname=$_POST["vname"]; 
// $vnum=$_POST["vnum"];
// $license=$_POST["license"];
// $seat=$_POST["seat"];
$emailerror = false;
$mnoerror = false;
$emptyerror = false;
$logdone=false;
$logcredential=false;
if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['mno']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['vname']) || empty($_POST['vnum']) || empty($_POST['license']) || empty($_POST['seat'])){
  $emptyerror = true;
  $logdone = false;
}

if(isset($_POST['regbtn'])){
  $ridecreated=0;
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$mno=$_POST["mno"];
$email=$_POST["email"];
$password=$_POST["password"];
$vname=$_POST["vname"]; 
$vnum=$_POST["vnum"];
$license=$_POST["license"];
$seat=$_POST["seat"];
    $echeck="SELECT * FROM driver WHERE `email`='$email'";
    $mnocheck="SELECT * FROM driver WHERE `mno`='$mno'";
    $esql=mysqli_query($con,$echeck);
    $ecount=mysqli_num_rows($esql);
    if($ecount==1){
        
        $emailerror = true;
    }
    $msql=mysqli_query($con,$mnocheck);
    $mcount=mysqli_num_rows($msql);
    if($mcount==1){
        $mnoerror = true;
    }

}
if($emailerror==false && $mnoerror==false && $emptyerror==false){
    $sql="INSERT INTO `driver` (`fname`, `lname`, `mobile`, `email`, `password`, `vehicle-name`, `vehicle-num`, `license-num`, `seat`,`ridecreated`)
     VALUES
      ('$fname','$lname','$mno','$email','$password','$vname','$vnum','$license','$seat','$ridecreated')";
    $result=mysqli_query($con,$sql);
    $logdone=true;
}
if(isset($_POST['logbtn'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $login="SELECT * FROM `driver` WHERE `email`='$username' AND `password`='$password'";
  $result=mysqli_query($con,$login);
  $Userfname=mysqli_fetch_assoc($result);
  $userfnamefor=$Userfname['fname'];
  $useremail=$Userfname['email'];
  $driverphone=$Userfname['mobile'];
  $_SESSION['driver']=$userfnamefor;
  $_SESSION['email']=$useremail;
  $_SESSION['mobile']=$driverphone;
  $lcount=mysqli_num_rows($result);
  if($lcount==1){
    $sql ="UPDATE `driver` SET `status` = '1' WHERE `fname` = '$userfnamefor'";
    $result = mysqli_query($con,$sql);
    if($result){
      header("location:driver.php");
    }
  }
  else{
    $logcredential=true;
  }

  
}

?>

<html>
    <head>
        <title>Driver login</title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
       
    </head>
    <body class="body">
 <div class="fcontainer">
  <div class="logo">
      <img src="imgfile/carlogo.png" alt="">
  </div>

<div class="cardo">
   
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Driver Login </h5>
      <?php 
      if($ecount==1){
        echo "<div class='alert alert-dark' role='alert' >
        E-mail is already taken !
      </div>" ;
      }
      if($mcount==1){
        echo "<div class='alert alert-dark' role='alert' >
        Mobile No. is already taken !
      </div>" ;
      }
      if($logdone==true){
        echo "<div class='alert alert-dark' role='alert' >
        Registerd Succesfully , Login Now
      </div>" ;
      }
      if($logempty==true){
        echo "<div class='alert alert-dark' role='alert' >
      Please enter email and password
      </div>" ;
      }
     if($logcredential==true){
       echo "<div class='alert alert-dark' role='alert' >
       Invalid Email and password ! 
       </div>";
     }
      ?>

<form action="#" method="post">
      
      <input type="text" name="username"  placeholder="Enter your email" class="input" required autocomplete=""><br>
      <input type="password" name="password" id="textsend"  onkeyup="success()" placeholder="Enter your password" class="input" required autocomplete="off"><br>
      <button type="submit" class="btn btn-primary" name="logbtn"  id="login" style="width:100%; position:relative">Login</button></form>
        <hr class="hr">
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="create">
    Create Account
  </button> 
  <br><br>
 
  <!-- Modal -->
  <form action="#" method="post" class="text-center">
  <div class="modal fade text-center" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog text-center" role="document">
      <div class="modal-content text-center">
        <div class="modal-header text-center">
          <h5 class="modal-title" id="exampleModalLabel" style="position: relative; left: 9rem;">Create Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
        <input type="text" name="fname" placeholder="Enter your first name" id="signup" class="input1" required autocomplete="off">
                <input type="text" name="lname" placeholder="Enter your last name" id="signup" class="input1" required autocomplete="off">
                <input type="text" maxlength="10" pattern="\d{10}" onkeypress="return onlyNumber(event)" title="Please enter your 10 digits phone number" name="mno" placeholder="Enter your mobile no" id="signup" class="input1" required autocomplete="off">
                <input type="email" name="email" placeholder="Enter your email" id="signup" class="input1" required autocomplete="off">
                <input type="password" name="password" placeholder="Enter your password" id="signup"class="input1" required autocomplete="off">
                <input type="text" name="vname" placeholder="Enter Vehicle name "id="signup" class="input1"" required autocomplete="off">
                <input type="text" name="vnum" placeholder="Enter vehicle number "id="signup" style="text-transform: uppercase" class="input1"" required autocomplete="off">
                <input type="text" name="license" placeholder="Enter License Number "id="signup"style="text-transform: uppercase" class="input1"" required autocomplete="off">
                <input type="text" name="seat" placeholder="Enter seat in Vehicle" min="1" max="7"  id="signup" class="input1"" required autocomplete="off">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="regbtn" style="position: relative; left:0rem">Sign up</button>
        </div>
      </div>
    </div>
  </div></form>
    </div>
  </div></div>
  <script>
  function success(){
	 if(document.getElementById("textsend").value==="") { 
            document.getElementById('login').disabled = true; 
        } else { 
            document.getElementById('login').disabled = false;
        }
    }</script>
</body>
</html>