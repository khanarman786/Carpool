<?php
session_start();
require('connection.php');
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
$myphone = $_SESSION['userphone'];

?>
<!DOCTYPE html>

<head>

    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride history</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSrwqEyzE4SQNYxdBrFswBzZ9R515W7iA&libraries=places&callback=initMap">
    </script>
</head>

<body class="body"">
  <nav class=" navbar navbar-expand-lg navbar-light bg-light" static-top">
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
        <h1 class="mainheader" style="position:relative; top: 2rem;">Ride history</h1>
    </div>
    <br>
    <hr>
    <div class="rideinfo" style="position: relative;">
        <?php
        $checkingrides = "SELECT * FROM `$myphone`";
        $result = mysqli_query($conn, $checkingrides);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id=$row['id'];
                $source = $row['source'];
                $destination = $row['destination'];
                $drivername = $row['Drivername'];
                $driverphone = $row['Driverphone'];
                $seat = $row['seatbooked'];
                $fare = $row['amount'];
                $paymode = $row['paymode'];
                $rideid = $row['rideid'];
                $time = $row['time'];
                $day = $row['day']; ?>
                <div class="card">
                    <div class="card-header"style="text-align: center;">
                        <span><?php echo $day; ?></span><span><?php echo " ";?></span><span><?php echo $time;?></span>
                    </div>
                    <div class="card-body" style="text-align:center;">
                    <p class="card-text" id="jagah">From  : <?php echo $source; ?></p>
                    <p class="card-text" id="jagah">To : <?php echo $destination;?></p>
                        <button data-target="#exampleModal-<?php echo $row['id']; ?>" class="btn btn-primary"  id="starting" data-toggle="modal">
                            More Details
                        </button>
                        <div class="modal fade" id="exampleModal-<?php echo $row['id']; ?>"tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel- <?php echo $row['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel <?php echo $row['id']; ?>">Detail</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <p>Driver name : <?php echo $drivername;?></p>
                                        <p>Contact : <?php echo $driverphone;?></p>
                                        <p>Seat booked : <?php echo $seat;?></p>
                                        <p>Fare : <?php echo $fare;?></p>
                                        <p>Paid via : <?php echo $paymode ;?></p>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" id="Button1" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">Close</button>   
                                    </div>
                                </div>
                            </div>
                            </div></div>
       <?php
                                    }
                                }
                                        ?>

                            </div>
                </div>
                            <br>
                            <hr class="gg">

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