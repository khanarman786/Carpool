<?php
session_start();
require('connection.php');
$firsta = $_SESSION['first'];
$seconda = $_SESSION['second'];
$thirda = $_SESSION['third'];
$fortha = $_SESSION['forth'];
$km = $_SESSION['inkm'];
$fareforride = $_SESSION['rfare'];
$minimum = 1;
$date = $_SESSION['date'];
$dates=date_create($date);
$formatteddate=date_format($dates,"F d");

if (isset($_SESSION['schedule'])) { ?>
    <div class="panel-body">
        <?php
        $n = 1;
        $sql = "SELECT * FROM `rides` where ( `source` like '%$firsta%' AND `source` like '%$seconda%' ) AND 
    (`destination` like '%$thirda%' AND `destination` like '%$fortha%') AND (`ridestatus` ='$n') AND (`seat-avail` >= '$minimum') AND(`ridetype` = 5) AND (`sdate`like '%$date%')";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $driveremail = $row['email'];
                $sql = "SELECT * FROM  `driver` where `email`= '$driveremail'";
                $process = mysqli_query($con, $sql);
                if (mysqli_num_rows($process) > 0) {
                    while ($driver = mysqli_fetch_assoc($process)) {
                        $status = $driver['status'];
                        if ($status == 1) {
        ?>
                            <div class="card" id="cardy" style="width: 18rem;">
                                <div class="card-body">
                                    <form action="finalbookingforsr.php" id="form1" method="post">
                                        <h5 class="card-title"><strong> <?php echo $row['uname']; ?> </strong>
                                            </span>
                                        </h5>
                                        <p class="card-text"><span><strong>From - </strong> :
                                                <?php echo $row['source']; ?>
                                            </span><br>
                                            <span> <strong>To - </strong>
                                                <?php echo  $row['destination']; ?>
                                            </span><br>
                                            <span><strong>Available Seat : </strong>
                                                <?php echo  $row['seat-avail']; ?>
                                            </span><br>
                                            <span><strong>Fare : </strong>
                                                <?php echo $fareforride; ?>/-Rs
                                            </span><br>
                                            <span><strong>Date : </strong>
                                                <?php echo $formatteddate ?>
                                            </span><br>
                                            <span><strong>Date : </strong>
                                                <?php echo $row['stime']; ?>
                                            </span><br>
                                            <input type="hidden" name="uname" value="<?php echo $row['uname'] ?>">
                                            <input type="hidden" name="source" value="<?php echo $row['source']; ?>">
                                            <input type="hidden" name="destination" value="<?php echo $row['destination']; ?>">
                                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                            <input type="hidden" name="phone" value="<?php echo $row['phone']; ?>">
                                            <input type="hidden" name="seat" value="<?php echo $row['seat']; ?>">
                                            <input type="hidden" name="seat-avl" value="<?php echo $row['seat-avail']; ?>">
                                            <input type="hidden" name="timing" value="<?php echo $_SESSION['time']; ?>">
                                            <input type="hidden" name="seatwant" value="<?php echo $_SESSION['seat']; ?>">
                                            <input type="hidden" name="rideid" value="<?php echo $row['id'];?>">

                                            <input type="hidden" name="fareofride" value="<?php echo $fareforride; ?>">
                        <button type=" submit" value="book" name="selectdriver" class="btn btn-primary" id="subbtn"">BOOK
          NOW</button></form>
      </div>
    </div>
  </div>
  <br> 

  <?php
                        }
                    }
                }
            }
        } 
        else { ?>
  <div class=" noride"><strong> Sorry ! No rides at a moment</strong>
                                </div>
                            <?php
                        }
                    } else {

                            ?>
                            <div class="panel-body">
                                <?php
                                $n = 1;
                                $sql = "SELECT * FROM `rides` where ( `source` like '%$firsta%' AND `source` like '%$seconda%' ) AND 
    (`destination` like '%$thirda%' AND `destination` like '%$fortha%') AND (`ridestatus` ='$n') AND (`seat-avail` >= '$minimum') AND(`ridetype` = 6)";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $driveremail = $row['email'];
                                        $sql = "SELECT * FROM  `driver` where `email`= '$driveremail'";
                                        $process = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($process) > 0) {
                                            while ($driver = mysqli_fetch_assoc($process)) {
                                                $status = $driver['status'];
                                                if ($status == 1) {
                                ?>
                                                    <div class="card" id="cardy" style="width: 18rem;">
                                                        <div class="card-body">
                                                            <form action="finalbooking.php" id="form1" method="post">
                                                                <h5 class="card-title"><strong> <?php echo $row['uname']; ?> </strong>
                                                                    </span>
                                                                </h5>
                                                                <p class="card-text"><span><strong>From - </strong> :
                                                                        <?php echo $row['source']; ?>
                                                                    </span><br>
                                                                    <span> <strong>To - </strong>
                                                                        <?php echo  $row['destination']; ?>
                                                                    </span><br>
                                                                    <span><strong>Available Seat : </strong>
                                                                        <?php echo  $row['seat-avail']; ?>
                                                                    </span><br>
                                                                    <span><strong>Fare : </strong>
                                                                        <?php echo $fareforride; ?>/-Rs
                                                                    </span><br>
                                                                    <input type="hidden" name="uname" value="<?php echo $row['uname'] ?>">
                                                                    <input type="hidden" name="source" value="<?php echo $row['source']; ?>">
                                                                    <input type="hidden" name="destination" value="<?php echo $row['destination']; ?>">
                                                                    <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                                                    <input type="hidden" name="phone" value="<?php echo $row['phone']; ?>">
                                                                    <input type="hidden" name="seat" value="<?php echo $row['seat']; ?>">
                                                                    <input type="hidden" name="seat-avl" value="<?php echo $row['seat-avail']; ?>">
                                                                    <input type="hidden" name="timing" value="<?php echo $_SESSION['time']; ?>">
                                                                    <input type="hidden" name="seatwant" value="<?php echo $_SESSION['seat']; ?>">
                        <input type="hidden" name="fareofride" value="<?php echo $fareforride; ?>">
                        <input type="hidden" name="rideid" value="<?php echo $row['id']; ?>">
                        <button type=" submit" value="book" name="selectdriver" class="btn btn-primary" id="subbtn"">BOOK
          NOW</button></form>
      </div>
    </div>
  </div>
  <br> 

  <?php
                                                }
                                            }
                                        }
                                    }
                                } else { ?>
  <div class=" noride"><strong> Sorry ! No rides at a moment</strong>
                                                        </div>
                                                <?php
                                            }
                                        }
                                                ?>