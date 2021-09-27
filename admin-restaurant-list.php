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

<h3 class="text-center"> List of all restaurants</h3> <br/>
<table class="table center" style="width: 75%">
    <thead  class="thead-dark">
        <tr>
            <th>Restaurant ID </th>
            <th>Name</th>
            <th>Address</th>
            <th>Slots</th>
            <th>Location</th>
            <th>  </th>
            <th>  </th>
        </tr>
    </thead>
    <?php
    include 'dbConnect.php';
    $sql = "SELECT restaurant.restaurantID, restaurant.restaurantName,
                    restaurant.restaurantAddress, restaurant.freeSlots,cities.cityName FROM restaurant INNER JOIN cities ON restaurant.cityID=cities.cityID
";
    $result = mysqli_query($conn, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['restaurantID'];
        $name = $row['restaurantName'];
        $address = $row['restaurantAddress'];
        $slot = $row['freeSlots'];
        $location = $row['cityName'];
        $i++;
        ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $address; ?></td>
            <td><?php echo $slot; ?></td>
            <td><?php echo $location; ?></td>
            <td><a href="admin-restaurant-edit.php? edit=<?php echo $id; ?>" class="btn btn-secondary" role="button">Edit</a</td>
            <td><a href="admin-restaurant-list.php? delete=<?php echo $id; ?>" class="btn btn-primary" role="button">Delete</a></td>

        </tr>
        <?php
    }
    ?>
</table>
<br>

<?php
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete = "DELETE FROM restaurant WHERE restaurant.restaurantID ='$delete_id'";
    $result_delete = mysqli_query($conn, $delete);
}
?>
<?php
require "footer.php";
?>
