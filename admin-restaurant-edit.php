<?php
session_start();

if (isset($_SESSION['adminID']) && $_SESSION['adminName'] == true) {
    
} else {
    header('Location: admin-login.php');
}

if (isset($_GET['edit'])) {

    include_once 'dbConnect.php';
    $edit_id = $_GET['edit'];

    $sql = "SELECT restaurant.restaurantID, restaurant.restaurantName, restaurant.restaurantAddress, restaurant.freeSlots, cities.cityName FROM restaurant INNER JOIN cities ON restaurant.cityID=cities.cityID WHERE restaurant.restaurantID='$edit_id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
    $name = $row['restaurantName'];
    $address = $row['restaurantAddress'];
    $slot = $row['freeSlots'];
    $location = $row['cityName'];
}
?>


<?php
require "admin-header.php";
?> 

<div class="reservation-form">
    <h3 class="text-center">Update this restaurant</h3> <br/>
    <form action="" method="post">
        <div class="form-group" style="margin-bottom: 2px">
            <label>Restaurant's name</label>
            <input class="form-control" type="text" name="name" placeholder="City name" value="<?php echo $name; ?>"> <br>
        </div>
        <div class="form-group" style="margin-bottom: 2px">
            <label>Restaurant's address</label>
            <input class="form-control" type="text" name="address" placeholder="City address" value="<?php echo $address; ?>"> <br>
        </div>
        <div class="form-group" style="margin-bottom: 2px">
            <label>Slots</label>
            <input class="form-control" type="text" name="slot" placeholder="Free slots" value="<?php echo $slot; ?>"> <br>
        </div>
         <div class="form-group" style="text-align: center;">
            <button type="submit" name="update" class="btn btn-primary btn-lg text-center">Update</button><br/><br/>
        </div>


<?php
include_once 'dbConnect.php';
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $slot = $_POST['slot'];
    $update = "UPDATE restaurant SET restaurantName = '$name',restaurantAddress = '$address', freeSlots = '$slot' WHERE restaurant.restaurantID='$edit_id';";
    $result_update = mysqli_query($conn, $update);
    if ($result_update) {
        echo "This restaurant is updated.";
    } else {
        echo "There is an error, please try again.";
    }
}
?>
<?php
require "footer.php";
?>
