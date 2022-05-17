<?php
session_start();
require('connection.php');
if (!isset($_SESSION['user'])) {
  header("location:login.php");
}
unset($_SESSION['ridebooked']);
unset($_SESSION['schedule']);
echo $_SESSION['schedule'];
echo $_SESSION['ridebooked'];
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
    function mainFunction(){
    GetRoute();
    
}
    function myfunction() {
      const options = {
        componentRestrictions: {
          country: "in"
        }
      };
      var input = document.getElementById('txtSource');
      new google.maps.places.Autocomplete(input, options);
      var inputs = document.getElementById('txtDestination');
      new google.maps.places.Autocomplete(inputs, options);
      autocomplete.setComponentRestrictions({
        'country': ["in"]
      });
    }
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {}

    function showPosition(position) {
      myl = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
    }

    function showError(error) {
      switch (error.code) {
        case error.PERMISSION_DENIED:
          alert("You denied location permission , wihout location permission you can't book cabs on this website : follow instruction to enable 1)press lock on url of this webiste above then enable location from there and refresh webiste");
          break;
        case error.POSITION_UNAVAILABLE:
          x.innerHTML = "Location information is unavailable."
          break;
        case error.TIMEOUT:
          x.innerHTML = "The request to get user location timed out."
          break;
        case error.UNKNOWN_ERROR:
          x.innerHTML = "An unknown error occurred."
          break;
      }
    }
  </script>
</head>

<body class="body" onload="myfunction();">

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
  <div class="maincontainer">
    <div class="subcontainer">
      <br>
      <h1 class="mainheader">BOOK AFFORDABLE RIDE IN YOUR CITY</h1>
    </div>
    <br>
    <br>
      
      <div class="selectroute">
      <form action="book.php" id="ridedetails" method="get">
        <h3 style="margin-top: 2rem; font-weight:bold; letter-spacing: 0.1rem; color: white;">Select Route </h3>
        <input type="text" name="source" class="inputforroute" id="txtSource" placeholder="Enter Your Pickup" required>
        <input type="text" name="destination" class="inputforroute" id="txtDestination" placeholder="Enter Your Destination" required>
        <input type="number" name="seat" class="inputforroute" id="txtDestination" placeholder="No Of Seat " required>
        <input type="hidden" name="time" id="time">
        <input type="hidden" name="km" id="km">
      <input type="submit" value="submit" name="findride" id="findride"  style="display: none;">
      </form>
      <button type="button" class="btn btn-success" id="searchride" name="validate" onclick="mainFunction()">Find Ride</button>
  
    <br><br>
  </div>
  </div>
  <div class="scheduleride" style="text-align: center; position:relative; top:2rem;">
  <a href="srides.php">
  <button type="submit" class="btn btn-primary">Want to book ride for later </button></a>
    
  </div>
  <hr class="gg">
  <hr class="hr">
  <div id="lowerpart" class="mapdriver" style="display: none;">
    <div id="dvMap" class="mapfordirection">
           </div> 
        <div class=" drivers">

    </div>
  </div>
  <hr class="gg">
  <hr class="hr">
  <td colspan="2">
                
            
            </td>
  <div class="fixedroute" style="background-color: black;">
    <h3 class="tagline">FIXED ROUTES</h3>
  </div>
  <div class="card">
    <div class="card-body" style="text-align: center;">
      <a href="
      http://localhost/taxi/book.php?source=Bharani+Naka+%28Antop+Hill%29%2C+Sangam+Nagar%2C+Mumbai%2C+Maharashtra&destination=Wadala%2C+Mumbai%2C+Maharashtra%2C+India&seat=1&time=4+mins&km=1890&findride=submit
      ">Bharni Naka - Wadala Station</a><br>

    </div>
    <div class="card">
      <div class="card-body" style="text-align: center;">

        <a href="
        http://localhost/taxi/book.php?source=Sion+Station+Sky+Walk%2C+Sion+Railway+Colony%2C+Chunabhatti%2C+Sion%2C+Mumbai%2C+Maharashtra%2C+India&destination=Antop+Hill%2C+Mumbai%2C+Maharashtra%2C+India&seat=1&time=&km=3623&findride=submit">Sion Station - Antop Hill</a><br>

      </div>
      <div class="card">
        <div class="card-body" style="text-align: center;">
          <a href="
          http://localhost/taxi/book.php?source=Dadar%2C+Mumbai%2C+Maharashtra%2C+India&destination=Pune+Railway+Station%2C+Agarkar+Nagar%2C+Pune%2C+Maharashtra%2C+India&seat=1&time=15+mins&km=156204&findride=submit">Mumbai(Dadar) - Pune</a>
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
<script>
  $('#ridedetails').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) { 
      e.preventDefault();
      return false;
    }
  });
 </script>
</html>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSrwqEyzE4SQNYxdBrFswBzZ9R515W7iA&libraries=places&callback=initMap""></script>
<script type=" text/javascript">
  var myl;
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {}

  function showPosition(position) {
    myl = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    };
  }
  var source, destination;
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  google.maps.event.addDomListener(window, 'load', function() {
    directionsDisplay = new google.maps.DirectionsRenderer({
      'draggable': true
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

    //*********DISTANCE AND DURATION**********************//
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
      origins: [myl],
      destinations: [source],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, function(response, status) {
      if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
        var duration = response.rows[0].elements[0].duration.text;
        var inputT = document.getElementById("time");       
			  inputT.setAttribute('value',duration);
      } else {
        alert("Unable to find the distance via road.");
      }
    });
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
      origins: [source],
      destinations: [destination],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, function(response, status) {
      if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
        var distance = response.rows[0].elements[0].distance.value;
        var inputK = document.getElementById("km");
        inputK.setAttribute('value',distance);
        $(document).trigger('function_a_complete');
      } else {
        alert("Unable to find the distance via road.");
      }
    });
    
  }


  function b(){
   var button = document.getElementById('findride');
        button.click();
  }
  $(document).bind('function_a_complete', b);

</script>