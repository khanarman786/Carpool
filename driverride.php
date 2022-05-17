<?php
session_start();
require('connection.php');
$did =  $_SESSION['email'];
if (!isset($_SESSION['driver'])) {
  header("location:driverregistration.php");
}
$n = 1;
$m = 2;
$o = 3;
$ridestatus = "SELECT * FROM `rides` WHERE `email`= '$did' AND (`ridestatus` ='$n' OR `ridestatus`='$m')";
$checking = mysqli_query($con, $ridestatus);
if (mysqli_num_rows($checking) > 0) {
  while ($ridestate = mysqli_fetch_assoc($checking)) {
    $ride = $ridestate['ridestatus'];
  }
  $did =  $_SESSION['email'];
  $started = 2;
  $completed = 3;
  $sql = "SELECT * FROM `rides` WHERE (`email` = '$did') AND (`ridestatus` ='$n' OR `ridestatus` ='$started')";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($address = mysqli_fetch_assoc($result)) {
      $src = $address['source'];
      $dst = $address['destination'];
      $avlseat = $address['seat-avail'];
    }
  }
  $sql = "SELECT * FROM `rides` WHERE `email`='$did' AND (`ridestatus`='$n' OR `ridestatus`='$started')";
  $checkstatus = mysqli_query($con, $sql);
  if (mysqli_num_rows($checkstatus) > 0) {
    while ($rstatus = mysqli_fetch_assoc($checkstatus)) {
      $startride = $rstatus['ridestatus'];
      if ($startride == $n) {
        $start = "START RIDE";
      }
      if ($startride == $started) {
        $start = "END RIDE";
      }
    }
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
    <script type="text/javascript">
      window.addEventListener('load', function() {
        getRider();
        getSeat();
        setInterval(getRider, 10000);
        setInterval(getSeat, 10000);

      }, false);
    </script>
    <script type="text/javascript">
      function mainFunction() {
        changeButton();
      }
    </script>
  </head>

  <body class="body">

    <nav class="navbar navbar-expand-lg navbar-light bg-light" static-top">
      <a class="navbar-brand" href="driver.php" style="font-size: 1.5rem;">SHARE TAXI </a>
      <img src="imgfile/carlogo.png" class="logo" alt="e">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 100;">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="driver.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Rides</a>
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
    <div class="aboutride">
      <h1 class="mainheader" style="position:relative; top: 2rem;">RIDE DETAILS</h1>
    </div><br>
    <table class="table" style="position:relative; top:2rem;">
      <tbody>
        <tr style=" border: transparent 1px solid; ">
          <td scope="col" style=" border: transparent 1px solid; "> <strong>SOURCE </strong>: <?php echo $src; ?></td>
        </tr>
        <tr>
          <td scope="col"> <strong>DESTINATION </strong>: <?php echo $dst; ?></td>
        </tr>
        <tr>
          <td scope="col"> <strong>SEAT AVAILABLE : </strong><span id="seats"></span></td>
        </tr>
      </tbody>
    </table>

    <br>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">NAME</th>
          <th scope="col">PHONE</th>
          <th scope="col">SEAT</th>
          <th scope="col">FARE</th>
          <th scope="col">PAYMENT</th>
        </tr>
      </thead>
      <tbody id="customers" style="text-align: center;">
      </tbody>
    </table>
    <br>
    <div style="text-align: center;">
      <form action="updateride.php" id="updating" method="post">
        <button type="button" class="btn btn-danger" id="starting" data-toggle="modal" data-target="#exampleModal">
          <?php echo $start; ?>
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                DO YOU WANT TO <?php echo $start; ?> THIS RIDE
              </div>
              <div class="modal-footer">
                <input type="submit" value="submit" name="startingride" id="startingride" style="display: none;">
                <button type="button" id="Button1" class="btn btn-primary" onclick="mainFunction()"><?php echo $start; ?></button>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>
    <div style="text-align: center;">
      <form action="endride.php" id="ending" method="post">
        <input type="hidden" name="src">
        <input type="hidden" name="src">

        <button type="button" class="btn btn-danger" id="Button2" style="display:none ;" data-toggle="modal" data-target="#exampleModal2">
          CLICK AGAIN TO END
        </button>
        <!-- this will end ride  -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comfirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                DO YOU WANT TO END THIS RIDE
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="endride" class="btn btn-primary">End Ride</button>
      </form>
    </div>
    </div>
    </div>
    </div>
    </div>


    <!-- - <hr class="gg"> -->
    <hr class="hr"> 
    <td colspan="2">
<form action="driverhistory.php" method="POST" style="text-align: center;">
  <input type="hidden" name="f">
  <button type="submit" name="ridehistory" class="btn btn-primary">Ride history</button>
</form>
    </td>

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
    <script type="text/javascript">
      $('#updating').submit(function() {
        $.ajax({
          url: 'updateride.php',
          type: 'POST',
          dataType: 'json',
          data: {}
        }).always(function(response) {
          $('#exampleModal').modal('hide')
        });

        return false;
      });
    </script>
    <script type="text/javascript">
      $('#ending').submit(function() {
            $.ajax({
              url: 'endride.php',
              type: 'POST',
              dataType: 'json',
              data: {}
            }).always(function(response) {
              // $('#exampleModal2').modal('hide')});

              return false;
            });
    </script>
  </body>
  <script type="text/javascript">
    function getRider() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("customers").innerHTML = this.responseText;
        }
      };
      xhttp.open("POST", "getcustomer.php", true);
      xhttp.send();
    }
  </script>
  <script type="text/javascript">
    function getSeat() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("seats").innerHTML = this.responseText;
        }
      };
      xhttp.open("POST", "getdriverseat.php", true);
      xhttp.send();
    }
  </script>
  <script type="text/javascript">
    function changeButton() {
      $("#Button2").show();
      $("#starting").hide();
      $(document).trigger('function_a_complete');
    }
    $(document).bind('function_a_complete', b);

    function b() {
      var button = document.getElementById('startingride');
      button.click();
    }
  </script>
<?php
} else { ?>
  <!DOCTYPE html>

  <head>

    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
            <a class="nav-link" href="">Rides</a>
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
    <div class="aboutride">
      <h1 class="mainheader" style="position:relative; top: 2rem;">NO ACTIVE RIDE </h1>

    </div>
    <br><hr>
    <form action="driverhistory.php" method="POST" style="text-align: center;">
  <input type="hidden" name="f">
  <button type="submit" name="ridehistory" class="btn btn-primary">Ride history</button>
</form><?php
}
          ?>
  </html>