<?php
session_start();
require('connection.php');
if (!isset($_SESSION['driver'])) {
  header("location:driverregistration.php");
}
$_SESSION['srides']=1;
            ?>
  <!DOCTYPE html>

  <head>
    <link rel="stylesheet" href="driver.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ride for later</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSrwqEyzE4SQNYxdBrFswBzZ9R515W7iA&libraries=places&callback=initMap">
    </script>
    <script type="text/javascript">
      function myfunction() {
        const options = {
          componentRestrictions: {
            country: "in"
          }
        };
        var input = document.getElementById('placeinput');
        new google.maps.places.Autocomplete(input, options);
        var inputs = document.getElementById('placeinputs');
        new google.maps.places.Autocomplete(inputs, options);
        autocomplete.setComponentRestrictions({
          'country': ["in"]
        });
      }
    </script>
  </head>

  <body class="body" onload="myfunction();">
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
      </div>
      <br>
      <br>
      <form action="creatingride.php" method="POST">
        <div class="selectroute">
          <h3 style="margin-top: 2rem; font-weight:bold; letter-spacing: 0.1rem; color: white;">Enter Ride Detail </h3>
          <input type="text" name="source" class="inputforroute" id="placeinput" placeholder="Enter Your Pickup" required>
          <input type="text" name="destination" class="inputforroute" id="placeinputs" placeholder="Enter Your Destination" required>
          <input type="date" name="sdate" id="" class="inputforroute">
          <input type="time" name="stime" id="" class="inputforroute">
          <button type="submit" class="btn btn-success" name="createride" required>Create Ride</button>
          <br><br>
        </div>
        <?php
        $sql = "SELECT * FROM `driver` WHERE `fname` ='{$_SESSION['driver']}'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <input type="hidden" name="uname" value="<?php echo $row['fname']; ?>">
            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
            <input type="hidden" name="phone" value="<?php echo $row['mobile']; ?>">
            <input type="hidden" name="license" value="<?php echo $row['license-num']; ?>">
            <input type="hidden" name="seat" value="<?php echo $row['seat']; ?>">
            <input type="hidden" name="seat-avail" value="<?php echo $row['seat']; ?>"><?php
                                                                                      }
                                                                                    }
                                                                                        ?>
      </form>
    </div>
    </div>
    <hr class="gg">
    <hr class="hr">
    <div class="fixedroute" style="background-color: black;">
      <h3 class="tagline">FIXED ROUTES</h3>
    </div>
    <div class="card">
      <div class="card-body" style="text-align: center;">
        <a href="">Bharni Naka - Wadala Station</a><br>

      </div>
      <div class="card">
        <div class="card-body" style="text-align: center;">

          <a href="">Sion Station - Antop Hill</a><br>

        </div>
        <div class="card">
          <div class="card-body" style="text-align: center;">
            <a href="">Mumbai(Dadar) - Pune</a>
          </div>
        </div>
      </div>
    </div>
    <hr class="hr">
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