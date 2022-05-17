<?php
session_start();
require('connection.php');
$driver = $_SESSION['email'];
$customer = "SELECT * FROM  `$driver`";
$get = mysqli_query($con, $customer);
if (mysqli_num_rows($get) > 0) {
    while ($row = mysqli_fetch_assoc($get)) {
        $name = $row['uname'];
        $phone = $row['phone'];
        $seat = $row['seatbooked'];
        $fare = $row['amount'];
        $payment = $row['paymode'];
?>
            <tbody>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $phone; ?></td>
                    <td><?php echo $seat; ?></td>
                    <td><?php echo  $fare; ?></td>
                    <td><?php echo  $payment; ?></td>
                </tr>
                <br>
            </tbody>

<?php
    }
} else {
    echo "No Customer Yet ! ";
}
?>