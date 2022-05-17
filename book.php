<?php
session_start();
require('connection.php');
if (!isset($_SESSION['user'])) {
  header("location:login.php");
}
unset($_SESSION['ridebooked']);
$source = $_GET['source'];
$destination = $_GET['destination'];
$time = $_GET['time'];
$km = $_GET['km'];
$seat = $_GET['seat'];
$date = $_GET['date'];
$dates=date_create($date);
$formatteddate=date_format($dates,"F d");
$_SESSION['date']=$date;
$inkm = $km / 1000;
$roundingkm = round($inkm);
$perkm = 5;
$fare = $roundingkm * $perkm;
$finalfare = $fare * $seat;
$_SESSION['rfare'] = $finalfare;
$_SESSION['km'] = $km;
$_SESSION['seat'] = $seat;
$_SESSION['inkm'] = $inkm;
$firstq = explode(' ', trim($source))[0];
$first = explode(',', trim($firstq))[0];
$secondq = explode(' ', trim($source))[1];
$second = explode(',', trim($secondq))[0];

$thirdq = explode(' ', trim($destination))[0];
$third = explode(',', trim($thirdq))[0];
$forthq = explode(' ', trim($destination))[1];
$forth = explode(',', trim($forthq))[0];
$_SESSION['rfare'] = $finalfare;
$_SESSION['km'] = $km;
$_SESSION['seat'] = $seat;
$_SESSION['inkm'] = $inkm;
$_SESSION['source'] = $source;
$_SESSION['dest'] = $destination;
$_SESSION['time'] = $time;
$_SESSION['first'] = $first;
$_SESSION['second'] = $second;
$_SESSION['third'] = $third;
$_SESSION['forth'] = $forth;
?>

<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="book.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>book</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  
  <script type="text/javascript">
    window.onload = function() {
      var button = document.getElementById('submit');
      setTimeout(function() {
        button.click();
      }, 100);
    };
   
    window.addEventListener('load', function() {
      
      setInterval(getDetails, 3500);
      setInterval(getTime, 1500);
      setInterval(clickTime, 1700);
    }, false);
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
  <div class="mapdriver">
    <input type="hidden" id="submit" value="Get Route" onclick="GetRoute()" />
    <!-- <div id="dvDistance">
                </div> -->
    <div id="dvMap" class="mapfordirection">
    </div>
  </div>
  <hr class="hr">
  <h2 class="avldr">AVAILABLE RIDE ON 
 </h2>
  <div id="drivers">

  </div>

  </div>
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
      <h4 style="font-weight: bolder; letter-spacing: 0.1rem; text-align: center; word-spacing: 1rem;  padding-bottom: 2rem;">
        WHY SHARE TAXI </h4>
      <p class="para">To travel with the lowest fares <br>
        For a faster travel experience we have Share Taxis on some fixed routes with zero deviations <br>
        Choose your ride and zoom away <br>
        Now go cashless and travel easy
        <div id="gettingSeconds">
    <p>here it will show </p>
  </div>
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
  <input type="hidden" id="txtSource" name="source" value="<?php echo $_SESSION['source'] ?>">
  <input type="hidden" id="txtDestination" name="source" value="<?php echo $_SESSION['dest'] ?>">
  <form  method="GET" onsubmit="return sendData();" id="formforsec">
  <input type="text" name="distancefrmsource" id="second">
  <button type="submit" id="timefromsrc" style="display: none;">
  </form>
  
</body>

</html>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSrwqEyzE4SQNYxdBrFswBzZ9R515W7iA&libraries=places&callback=initMap"">
</script>
<script type=" text/javascript">
  var myl;
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition);
  } else {}

  function showPosition(position) {
    mylocation = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    };
  }
  var source, destination;
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  google.maps.event.addDomListener(window, 'load', function() {
    new google.maps.places.SearchBox(document.getElementById('txtSource'));
    new google.maps.places.SearchBox(document.getElementById('txtDestination'));
    directionsDisplay = new google.maps.DirectionsRenderer({
      'draggable': false
    });
  });

  function GetRoute() {
    var mumbai = new google.maps.LatLng(18.9750, 72.8258);
    var mapOptions = {
      zoom: 7,
      center: mumbai,
      draggable: false,
      zoomControl: false,
      scrollwheel: false,
      disableDoubleClickZoom: true,
      disableDefaultUI: true
    };
    map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById('dvPanel'));
    directionsDisplay.setOptions({
      polylineOptions: {
        strokeColor: 'black'
      }
    });
    //*********DIRECTIONS AND ROUTE**********************//
    source = document.getElementById("txtSource").value;
    destination = document.getElementById("txtDestination").value;

    var request = {
      origin: source,
      destination: destination,
      travelMode: google.maps.TravelMode.DRIVING

    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });
  }
</script>
  <script type="text/javascript">

  function getTime () {
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
      origins: [mylocation],
      destinations: [source],
      travelMode: google.maps.TravelMode.WALKING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, function(response, status) {
      if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
        var duration = response.rows[0].elements[0].duration.value;
        var time = document.getElementById("second");
        time.setAttribute('value', duration);
      } else {
        alert("Unable to find the distance via road.");
      }
    });
  }
</script>
<script type="text/javascript">
  function clickTime(){
     var button = document.getElementById('timefromsrc');
      button.click();
        }
</script>
<script type="text/javascript">
  function getDetails() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("drivers").innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "file.php", true);
    xhttp.send();

  }
  </script>
<script>
  function sendData()
{
  var name = document.getElementById("second").value;

  $.ajax({
    type: 'get',
    url: 'seconds.php',
    data: {
      name:name,
    },
    success: function (response) {
    }
  });
    
  return false;
}
</script>

<script type="text/javascript">
  function getSeconds() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("gettingSeconds").innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "seconds.php",true);
    xhttp.send();
  }
  </script>