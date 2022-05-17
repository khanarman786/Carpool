<?php 
session_start();
require('connection.php');
$rideid=$_SESSION['rideid'];
$sql = "SELECT * FROM `rides` where `id`= $rideid";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['currentseat']=$row['seat-avail'];
    }
}
echo $_SESSION['currentseat'];
?>