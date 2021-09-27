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

<h3 class="text-center">List of all restaurants registered</h3><br/>
<p class="text-center">Here you can see the list of all registered restaurants, and send a reservation to your favorite restaurant</p>
<table class="table center" style="width: 75%">
    <thead  class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Slots</th>
            <th scope="col">Location</th>
            <th scope="col">To reserve </th>
        </tr>
    </thead>

    <?php
    include_once 'dbConnect.php';
    $sql = "SELECT restaurant.restaurantID, restaurant.restaurantName, restaurant.restaurantAddress, restaurant.freeSlots, cities.cityName FROM restaurant INNER JOIN cities ON restaurant.cityID=cities.cityID";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $i = 0;
        $id = $row['restaurantID'];
        $name = $row['restaurantName'];
        $address = $row['restaurantAddress'];
        $slot = $row['freeSlots'];
        $location = $row['cityName'];
        $i++;
        ?>

        <tr>
            <td><?php echo $name; ?></td>
            <td><?php echo $address; ?></td>
            <td><?php echo $slot; ?></td>
            <td><?php echo $location; ?></td>
            <td><a href="restaurant-reservation.php? select=<?php echo $id; ?>" class="btn btn-primary" role="button">Select</a</td>            
        </tr>
        <?php
    }
    ?>

    <?php
    require "footer.php";
    ?>