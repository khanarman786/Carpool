<?php
session_start();
require('connection.php');
if (!isset($_SESSION['driver'])) {
    header("location:driverregistration.php");
}
//for creating scheduled ride
if(isset($_SESSION['srides'])){
  $ridechecker=1;
  $email=$_SESSION['email'];
      $checkingride = "SELECT * FROM `driver` WHERE `email` ='{$_SESSION['email']}'";
      "SELECT * FROM `driver` WHERE `fname` ='{$_SESSION['driver']}'";
      $checking = mysqli_query($con, $checkingride);
      if(mysqli_num_rows($checking)>0){
        while($sta=mysqli_fetch_assoc($checking)){
          $ridestatus=$sta['ridecreated'];
       
        }
      }
      if($ridestatus==$ridechecker){?>
        <!DOCTYPE html>
  
  <head>
    <link rel="stylesheet" href="driver.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSrwqEyzE4SQNYxdBrFswBzZ9R515W7iA&libraries=places&callback=initMap">
    </script>
    <script type="text/javascript">
    window.addEventListener('load', function() {
        setTimeout(clickbutton, 10);
      }, false);
      </script>
  </head>
  
  <body class="body">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" static-top">
      <a class="navbar-brand" href="index.html" style="font-size: 1.5rem;">SHARE TAXI </a>
      <img src="imgfile/carlogo.png" class="logo" alt="e">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 100;">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="driverride.php">Rides</a>
          </li>
        </ul>
        <ul class="username">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['driver']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Payment</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logoutd.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="maincontainer" id="main">
      <div class="subcontainer">
        <br>
        <h1 class="mainheader" id="">EARN MONEY ON YOUR SCHEDULE </h1>
  
        <div style="text-align: center;">
        <button data-target="#exampleModal" id="starting" data-toggle="modal" data-backdrop="static" data-keyboard="false">
    sorry you cannot create ride
   </button>
      
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  You already have a ride which is active please end ongoing ride to create new one 
                </div>
                <div class="modal-footer">
                  <form action="driverride.php" method="post">
                    <input type="hidden" name="f">
                  <button type="submit" id="Button1" class="btn btn-primary">End Ride</button></form>
                  <form action="driver.php" method="post">
                    <input type="hidden" name="v">
                  <button type="submit" id="Button1" class="btn btn-primary">No </button></form>
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
    </div>
    <script type="text/javascript">
   $(document).ready(function() {
      $("#popup").modal({
          show: false,
          backdrop: 'static'
      });
      
      $("#click-me").click(function() {
         $("#popup").modal("show");             
      });
  });
  </script>
    <script type="text/javascript">
    function clickbutton(){
       var button = document.getElementById('starting');
        button.click();
          }
  </script>
  </body></html>
  
  <?php
      }
      else{
        $sql = "SELECT * FROM `driver` WHERE `email` ='{$_SESSION['email']}'";
      $result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              if ($result) {
                  $ride = 1;
                  $ridetype=5;//this is for scheduled  ride
                  $source = $_POST["source"];
                  $dest = $_POST["destination"];
                  $uname = $_POST["uname"];
                  $email = $_POST["email"];
                  $phone = $_POST["phone"];
                  $seat = $_POST["seat"];
                  $seatA = $_POST["seat"];
                  $sdate=$_POST['sdate'];
                  $stime=$_POST['stime'];
                  $status = 1;
                  $sql = "INSERT INTO `rides` (`uname`, `email`, `phone`, `seat`, `seat-avail`, `source`, `destination`,`ridestatus`,`ridetype`,`sdate`,`stime`) 
                  VALUES ('$uname','$email','$phone','$seat','$seatA','$source','$dest','$status','$ridetype','$sdate','$stime')";
                  $postride = mysqli_query($con, $sql);
                  if ($postride) {
                      $tablecreation = "CREATE TABLE IF NOT EXISTS `{$_SESSION['email']}`( " .
                          "id INT NOT NULL AUTO_INCREMENT, " .
                          "uname VARCHAR(100) NOT NULL, " .
                          "phone VARCHAR(40) NOT NULL, " .
                          "seatbooked VARCHAR(40) NOT NULL, " .
                          "amount VARCHAR(40) NOT NULL, " .
                          "paymode VARCHAR(40) NOT NULL, " .
                          "PRIMARY KEY (id)); ";
  
                      mysqli_select_db($con, "taxi");
                      $retval = mysqli_query($con, $tablecreation);
                      if ($retval) {
                          $ridecreated = "UPDATE `driver` SET `ridecreated` = '$ride' WHERE `email` = '{$_SESSION['email']}'";
                          $update = mysqli_query($con, $ridecreated);
                          if ($update) {
                            header("location:driverride.php");
                          }
                      } else {
                          echo "already exits";
                      }
                  }
              } else {
                  echo "g";
              }
          }
      }
  }
}
// for instant ride
else{
$ridechecker=1;
$email=$_SESSION['email'];
    $checkingride = "SELECT * FROM `driver` WHERE `email` ='{$_SESSION['email']}'";
    "SELECT * FROM `driver` WHERE `fname` ='{$_SESSION['driver']}'";
    $checking = mysqli_query($con, $checkingride);
    if(mysqli_num_rows($checking)>0){
      while($sta=mysqli_fetch_assoc($checking)){
        $ridestatus=$sta['ridecreated'];
     
      }
    }
    if($ridestatus==$ridechecker){
    ?>
      <!DOCTYPE html>

<head>
  <link rel="stylesheet" href="driver.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSrwqEyzE4SQNYxdBrFswBzZ9R515W7iA&libraries=places&callback=initMap">
  </script>
  <script type="text/javascript">
  window.addEventListener('load', function() {
      setTimeout(clickbutton, 10);
    }, false);
    </script>
</head>

<body class="body">
  <nav class="navbar navbar-expand-lg navbar-light bg-light" static-top">
    <a class="navbar-brand" href="index.html" style="font-size: 1.5rem;">SHARE TAXI </a>
    <img src="imgfile/carlogo.png" class="logo" alt="e">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 100;">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="driverride.php">Rides</a>
        </li>
      </ul>
      <ul class="username">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['driver']; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Payment</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logoutd.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="maincontainer" id="main">
    <div class="subcontainer">
      <br>
      <h1 class="mainheader" id="">EARN MONEY ON YOUR SCHEDULE </h1>

      <div style="text-align: center;">
      <button data-target="#exampleModal" id="starting" data-toggle="modal" data-backdrop="static" data-keyboard="false">
  sorry you cannot create ride
 </button>
    
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                You already have a ride which is active please end ongoing ride to create new one 
              </div>
              <div class="modal-footer">
                <form action="driverride.php" method="post">
                  <input type="hidden" name="f">
                <button type="submit" id="Button1" class="btn btn-primary">End Ride</button></form>
                <form action="driver.php" method="post">
                  <input type="hidden" name="v">
                <button type="submit" id="Button1" class="btn btn-primary">No </button></form>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
  <script type="text/javascript">
 $(document).ready(function() {
    $("#popup").modal({
        show: false,
        backdrop: 'static'
    });
    
    $("#click-me").click(function() {
       $("#popup").modal("show");             
    });
});
</script>
  <script type="text/javascript">
  function clickbutton(){
     var button = document.getElementById('starting');
      button.click();
        }
</script>
</body></html>

<?php
    }
    else{
     
      $sql = "SELECT * FROM `driver` WHERE `email` ='{$_SESSION['email']}'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($result) {
                $ride = 1;
                $ridetype=6;//this is for instant ride
                $source = $_POST["source"];
                $dest = $_POST["destination"];
                $uname = $_POST["uname"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $license = $_POST["license"];
                $seat = $_POST["seat"];
                $seatA = $_POST["seat"];
                $status = 1;
                $sql = "INSERT INTO `rides` (`uname`, `email`, `phone`, `seat`, `seat-avail`, `source`, `destination`,`ridestatus`,`ridetype`) 
                VALUES ('$uname','$email','$phone','$seat','$seatA','$source','$dest','$status','$ridetype')";
                $postride = mysqli_query($con, $sql);
                if ($postride) {
                    $tablecreation = "CREATE TABLE IF NOT EXISTS `{$_SESSION['email']}`( " .
                        "id INT NOT NULL AUTO_INCREMENT, " .
                        "uname VARCHAR(100) NOT NULL, " .
                        "phone VARCHAR(40) NOT NULL, " .
                        "seatbooked VARCHAR(40) NOT NULL, " .
                        "amount VARCHAR(40) NOT NULL, " .
                        "paymode VARCHAR(40) NOT NULL, " .
                        "PRIMARY KEY (id)); ";

                    mysqli_select_db($con, "taxi");
                    $retval = mysqli_query($con, $tablecreation);
                    if ($retval) {
                        $ridecreated = "UPDATE `driver` SET `ridecreated` = '$ride' WHERE `email` = '{$_SESSION['email']}'";
                        $update = mysqli_query($con, $ridecreated);
                        if ($update) {
                          header("location:driverride.php");
                        }
                    } else {
                        echo "already exits";
                    }
                }
            } else {
                echo "g";
            }
        }
    }
}
}