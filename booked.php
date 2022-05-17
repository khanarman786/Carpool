<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
  }
require('connection.php');
if(isset($_POST['confirmbook']) && (!isset($_SESSION['ridebooked']))){
    date_default_timezone_set('Asia/Kolkata');
    $timing =  date("h:i a"); 
    $date = date("F j, Y");
    $source=$_POST['source'];
    $destination=$_POST['destination'];
    $drivername=$_POST['uname'];
    $driveremail=$_POST['email'];
    $driverphone=$_POST['dphone'];
    $customeruname=$_SESSION['user'];
    $customeremail = $_POST['useremail'];
    $customerphone=$_SESSION['userphone'];
    $seat= $_POST['seat'];
    $fare=$_POST['fare'];
    $rideid=$_POST['rideid'];
    $pay=$_POST['payment'];
    $seatavl=$_POST['seat-avail'];
    $seatupdate=$seatavl-$seat;
    $sql="INSERT INTO `$driveremail` (`uname`, `phone`, `seatbooked`, `amount`, `paymode`) VALUES ('$customeruname','$customerphone','$seat','$fare','$pay')";
    $puttinginride=mysqli_query($con,$sql);
    if($puttinginride){
        $seatupdation="UPDATE `rides` SET `seat-avail` = '$seatupdate' WHERE `id` = '$rideid'";
        $result=mysqli_query($con,$seatupdation);
        $sql="UPDATE `user` SET `driver` = '$rideid' WHERE `mno` = '$customerphone'";
        $add=mysqli_query($con,$sql);
        if($add){
            $_SESSION['ridebooked']="yes";
                $tablecreation = "CREATE TABLE IF NOT EXISTS `{$_SESSION['userphone']}`( " .
                  "id INT NOT NULL AUTO_INCREMENT, " .
                  "source VARCHAR(100) NOT NULL, " .
                  "destination VARCHAR(100) NOT NULL, " .
                  "Drivername VARCHAR(20) NOT NULL, " .
                  "Driverphone VARCHAR(20) NOT NULL, " .
                  "seatbooked VARCHAR(40) NOT NULL, " .
                  "amount VARCHAR(40) NOT NULL, " .
                  "paymode VARCHAR(40) NOT NULL, " .
                  "rideid VARCHAR(40) NOT NULL, " .
                  "time VARCHAR(40) NOT NULL, " .
                  "day VARCHAR(40) NOT NULL, " .
                  "PRIMARY KEY (id)); ";
                mysqli_select_db($conn, "users");
                $created = mysqli_query($conn, $tablecreation);
                if($created){
                $sql="INSERT INTO `$customerphone` (`source`, `destination`, `Drivername`, `Driverphone`, `seatbooked`,`amount`,`paymode`,`rideid`,`time`,`day`)
                VALUES
                ('$source','$destination','$drivername','$driverphone','$seat','$fare','$pay','$rideid','$timing','$date')";
                $booked=mysqli_query($conn,$sql);
                if ($booked) {
                    header("location:ridecr.php");
                }
            }
            
        }
    }
    else{
        echo "something";
    }
}
else{
    echo "you have already booked";
}

?>