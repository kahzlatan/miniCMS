<?php
session_start();

if (isset($_SESSION['adminID']) && $_SESSION['adminName'] == true) {
    
} else {
    header('Location: admin-login.php');
}
?>
<?php
require "admin-header.php";
?> 

<h3 class="text-center"> List of all reservations </h3> <br/>
<table class="table center" style="width: 75%">
    <thead  class="thead-dark">
        <tr>
            <th>Reservation ID </th>
            <th>User Email</th>
            <th>Restaurant Name</th>
            <th>City</th>
            <th>Date</th>
            <th>Time Zone</th>
            <th>Phone </th>
            <th>Message</th>
            <th>Posting Date</th>
            <th> Delete</th>
        </tr>
    </thead>
    <?php
    include 'dbConnect.php';
    $sql = "SELECT reservation.reservationID, users.userEmail, restaurant.restaurantName, cities.cityName, reservation.date, reservation.timeZone, reservation.phone, reservation.comment, reservation.postingDate FROM (((reservation INNER JOIN users ON reservation.userID=users.userID)
INNER JOIN restaurant ON reservation.restaurantID = restaurant.restaurantID) INNER JOIN cities ON cities.cityID = restaurant.cityID);";
    $result = mysqli_query($conn, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['reservationID'];
        $user_email = $row['userEmail'];
        $restaurant_name = $row['restaurantName'];
        $city = $row['cityName'];
        $date = $row['date'];
        $timeZone = $row['timeZone'];
        $phone = $row['phone'];
        $msg = $row['comment'];
        $posting_date = $row['postingDate'];
        $i++;
        ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $restaurant_name; ?></td>
            <td><?php echo $city; ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $timeZone; ?></td>
            <td><?php echo $phone; ?></td>
            <td><?php echo $msg; ?></td>
            <td><?php echo $posting_date; ?></td>
            <td><a href="admin-reservation-list.php? delete=<?php echo $id; ?>" class="btn btn-primary" role="button">Delete</a></td>

        </tr>
        <?php
    }
    ?>
</table>
<br>
<?php
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete = "DELETE FROM reservations WHERE reservations.reservationID ='$delete_id'";
    $result_delete = mysqli_query($conn, $delete);
}
?>
<?php
require "footer.php";
?>
