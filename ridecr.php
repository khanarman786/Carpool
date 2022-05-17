<?php
session_start();
require('connection.php');
if (!isset($_SESSION['user'])) {
  header("location:login.php");
}

?>
<!DOCTYPE html>

<head>

  <link rel="stylesheet" href="index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSrwqEyzE4SQNYxdBrFswBzZ9R515W7iA&libraries=places&callback=initMap">
  </script>
  
</head>

<body class="body"">

  <nav class="navbar navbar-expand-lg navbar-light bg-light" static-top">
    <a class="navbar-brand" href="index.php" style="font-size: 1.5rem;">SHARE TAXI </a>
    <img src="imgfile/carlogo.png" class="logo" alt="e">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 100;">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ridecr.php">Rides</a>
        </li>
      </ul>
      <ul class="username">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['user']; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Payment</a>
            <a class="dropdown-item" href="driver.php">Become A driver</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="aboutride">
    <h1 class="mainheader" style="position:relative; top: 2rem;">YOUR RIDES</h1>
  </div>
  <br>
  <hr>
  <div class="rideinfo" style="position: relative;">
    <?php
    $sql = "SELECT * FROM `user` WHERE `email` = '{$_SESSION['useremail']}'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $rideid = $row['driver'];
        $phone = $row['mno'];
        $sql = "SELECT * FROM `rides` WHERE `id` = '$rideid'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $src = $row['source'];
            $status = "";
            $dest = $row['destination'];
            $drivername = $row['uname'];
            $driverphone = $row['phone'];
            $driveremail = $row['email'];
            $ridestatus = $row['ridestatus'];
            
            $findingphone = "SELECT * FROM `driver` WHERE `email` = '$driveremail'";
            $process = mysqli_query($con, $findingphone);
            if (mysqli_num_rows($process) > 0) {
              while ($rows = mysqli_fetch_assoc($process)) {
                $vehicle = $rows['vehicle-name'];
                $number = $rows['vehicle-num'];
                $sql = "SELECT * FROM `$driveremail` WHERE `phone` = '$phone'";
                $result = mysqli_query($con, $sql);
                while ($ride = mysqli_fetch_assoc($result)) {
                  $seatbooked = $ride['seatbooked'];
                  $amount = $ride['amount'];
                  $paymode = $ride['paymode'];
                  if ($ridestatus == 2) {
                    $status = "Ongoing";
                  }
                  if ($ridestatus == 1) {
                    $status = "To Start";
                  }
                  if($ridestatus == 3){?>
                    <h1 class="mainheader" style="position:relative; top: 2rem;">No future or ongoing ride</h1>

                 <?php }
                 else{
                  
    ?>
                  <br>
                  <div class="card" id="cardy" style="width: 25rem;">
                    <br>
                    <div class="card-body">
                      <div class="input-group">

                        <input type="text" class="rideinput" value="Name : <?php echo  $drivername;  ?>" readonly />

                        <input type="text" class="rideinput" style="width: 60%;" value="Phone :<?php echo  $driverphone;  ?>" readonly />
                        <br>

                        <input type="text" class="rideinput" value="Car : <?php echo  $vehicle;  ?>" readonly />

                        <input type="text" class="rideinput" style="width:60%;" value="No : <?php echo  $number;  ?>" readonly />
                     
                        <span><strong class="">From : </strong>
                          <?php echo $src; ?>
                        </span>
                        <span><strong class="">To : </strong>
                          <?php echo $dest; ?>
                        </span><br>
                        <input type="text" class="rideinput" value="Seat Booked : <?php echo  $seatbooked;  ?>" readonly />

                        <input type="text" class="rideinput" style="width: 60%;" value="Fare :<?php echo  $amount;  ?>" readonly />

                        <input type="text" class="rideinput" value="Status : <?php echo  $status;  ?>" readonly />

                          <input type="text" class="rideinput" style="width: 60%;" value="Payment :<?php echo  $paymode;  ?>" readonly />    
                        
                      </div>
                      <input type="hidden" name="uname" value="<?php echo $drivername ?>">
                      <input type="hidden" name="email" value="<?php echo $driveremail; ?>">
                      <input type="hidden" name="seat" value="<?php echo $seatwant; ?>">
                      <input type="hidden" name="seat-avail" value="<?php echo $seatavl; ?>">

                      <input type="hidden" name="fare" value="<?php echo $fare; ?>">
                      <input type="hidden" name="rideid" value="<?php echo $id ?>">
                      <input type="hidden" name="userphone" value="<?php echo $_SESSION['userphone']; ?>">
                      <input type="hidden" name="useremail" value="<?php echo $_SESSION['useremail']; ?>">

                    </div>
                  </div>


    <?php
                }
              }
            }
          }
        }
      }
    }
  }

    ?>

  </div>

  <br>
  <hr class="gg">
  <div style="text-align: center;">
  <form action="userridehistory.php" method="post">
  <button type="submit" class="btn btn-primary">Ride history </button>
  </form>
</div>
 <hr>
  <div class="mainfooter">
    <div class="detailingforshare">
      <h4 style="font-weight: bolder; letter-spacing: 0.1rem; text-align: center; word-spacing: 1rem;  padding-bottom: 2rem;">WHY SHARE TAXI </h4>
      <p class="para">To travel with the lowest fares <br>
        For a faster travel experience we have Share Taxis on some fixed routes with zero deviations <br>
        Choose your ride and zoom away <br>
        Now go cashless and travel easy
      </p>
    </div><br>
    <hr style="background-color:white;">
    <h4 style="text-align: center;">Social Network </h4><br>
    <div class="socialdiv">
      <ul class="socialul">
        <li class="socialli"><img src="imgfile/fb.png" alt="" class="socialimg" id="imgfooter"></li>
        <li class="socialli"><img src="imgfile/ig.png" alt="" class="socialimg" id="imgfooter"></li>
        <li class="socialli"><img src="imgfile/link.png" alt="" class="socialimg" id="imgfooter"></li>
        <li class="socialli"><img src="imgfile/Twitter.png" alt="" class="socialimg" id="imgfooter"></li>
        <li class="socialli"><img src="imgfile/yt.png" alt="" class="socialimg" id="imgfooter"></li>

      </ul>
    </div>
    <br>
    <div class="aboutus">
      <img src="imgfile/taxifooter.png" class="logo-footer" alt="e">
      <br>
      <span class="footer-last">Notice</span>
      <span class="footer-last">Terms & Condition</span>
      <span class="footer-last">Privacy Policy</span>
      <br><br>
    </div>
  </div>
</body>
</html>