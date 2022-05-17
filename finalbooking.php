<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}

$distancetosrc = $_POST['timing'];
if ($distancetosrc > 1200) { ?>
    <script type="text/javascript">
        alert("You Are More Than 20 Minute Away From Source By Walk Please Get In 20 Min Range From Source To Book");
        history.go(-1);
    </script><?php
            } 
            else {
                $today = date("F j, Y");
                $drivername = $_POST['uname'];
                $driveremail = $_POST['email'];
                $driverphone = $_POST['phone'];
                $seatwant = $_POST['seatwant'];
                $seatavl = $_POST['seat-avl'];
                $source = $_POST['source'];
                $destination = $_POST['destination'];
                $fare = $_POST['fareofride'];
                $id = $_POST['rideid'];
                $_SESSION['rideid'] = $id;
                if ($seatwant > $seatavl) { ?>
        <script type="text/javascript">
            alert("You Want To Book <?php echo $seatwant; ?> Seats But Only <?php echo $seatavl; ?> Seats Available In This Ride  ");
            history.go(-1);
        </script>
<?php
                } else {
                  
                }
            }
?>
<?php
require('connection.php');
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

<body class="body">

    <nav class="navbar navbar-expand-lg navbar-light bg-light" static-top">
        <a class="navbar-brand" href="index.php" style="font-size: 1.5rem;">SHARE TAXI </a>
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
    <div class="bookingDetail">
        <hr class="gg">
        <div class="panel-body">
            <div class="card" id="cardy" style="width: 18rem;">
                <div class="card-body">
                    <form action="booked.php" id="form1" method="post">
                        <span><strong class="navbar-brand">Driver Name - <?php echo  $drivername; ?> </strong>
                        </span>
                        </span><br>
                        <span><strong class="navbar-brand">Booking Seat : </strong>
                            <?php echo $_SESSION['seat']; ?>
                        </span><br>
                        <span><strong class="navbar-brand">Fare : </strong>
                            <?php echo $fare; ?>/-Rs
                        </span><br>
                        <span><strong class="navbar-brand">Payment : </strong>
                            <input type="radio" id="payment" name="payment" value="Cash" required>
                            <label for="payment">Cash</label>
                        </span><br>
                        <input type="hidden" name="uname" value="<?php echo $drivername ?>">
                        <input type="hidden" name="email" value="<?php echo $driveremail; ?>">
                        <input type="hidden" name="dphone" value="<?php echo $driverphone; ?>">
                        <input type="hidden" name="seat" value="<?php echo $seatwant; ?>">
                        <input type="hidden" name="seat-avail" value="<?php echo $seatavl; ?>">
                        <input type="hidden" name="source" value="<?php echo $source; ?>">
                        <input type="hidden" name="destination" value="<?php echo $destination; ?>">
                        <input type="hidden" name="fare" value="<?php echo $fare; ?>">
                        <input type="hidden" name="rideid" value="<?php echo $id ?>">
                        <input type="hidden" name="userphone" value="<?php echo $_SESSION['userphone']; ?>">
                        <input type="hidden" name="useremail" value="<?php echo $_SESSION['useremail']; ?>">
                        <button type="submit" name="confirmbook" class="btn btn-primary" id="subbtn"">CONFIRM BOOKING</button></form>
      </div>
    </div>
  </div>
 </div>
 <br><br><br><br>
  <hr class=" gg">
                            <hr class="hr">
                            <td colspan="2">
                            </td>
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
<script type="text/javascript">
    function getsetails() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var time = this.responseText;
                var seats = document.getElementById("drivers");
                seats.setAttribute('value', time);
            }
        };
        xhttp.open("POST", "gettingSeat.php", true);
        xhttp.send();
    }
    setInterval(getsetails, 1000);
</script>

</html>