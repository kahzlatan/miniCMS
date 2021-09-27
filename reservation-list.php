<?php
session_start();

if (isset($_SESSION['userID']) && $_SESSION['userName'] == true) {
    
} else {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require "header.php";
?>

<h3 class="text-center"> List of all reservations made from this account </h3><br/>
<p class="text-center">In this section you are allowed to delete reservations if you are not satisfied with it.</p>

<table class="table center" style="width: 75%">
    <thead  class="thead-dark">
        <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Restaurant's Name</th>
            <th scope="col">Restaurant's Address</th>
            <th scope="col">Reservation Date</th>
            <th scope="col">Time Zone</th>
            <th scope="col">Comment</th>
            <th scope="col">  </th>
        </tr>
    </thead>
    <?php
    $uid = $_SESSION['userID'];
    include 'dbConnect.php';
    $sql = "SELECT reservation.reservationID, reservation.firstName, reservation.lastName, restaurant.restaurantName, restaurant.restaurantAddress, reservation.date, reservation.timeZone, reservation.comment
                  FROM reservation INNER JOIN restaurant ON reservation.userID = '$uid';
";
    $result = mysqli_query($conn, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['reservationID'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $restaurant_name = $row['restaurantName'];
        $restaurant_address = $row['restaurantAddress'];
        $restaurant_date = $row['date'];
        $timeZone = $row['timeZone'];
        $comment = $row['comment'];
        $i++;
        ?>
        <tr>
            <td><?php echo $firstName; ?></td>
            <td><?php echo $lastName; ?></td>
            <td><?php echo $restaurant_name; ?></td>
            <td><?php echo $restaurant_address; ?></td>
            <td><?php echo $restaurant_date; ?></td>
            <td><?php echo $timeZone; ?></td>                
            <td><?php echo $comment; ?></td>
            <td><a href="reservation-list.php? delete=<?php echo $id; ?>" class="btn btn-primary" role="button">Delete</a></td>

        </tr>
        <?php
    }
    ?>
</table>
<br>

<?php
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete = "DELETE FROM reservation WHERE reservation.reservationID ='$delete_id'";
    $result_delete = mysqli_query($conn, $delete);
}
?>

<?php
require "footer.php";
?>