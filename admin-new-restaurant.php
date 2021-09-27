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
<table>
    <div class="reservation-form">
        <h3 class="text-center">New Restaurants</h3>

        <form action="admin-new-restaurant.php" method="post">
            <div class="form-group">
                <label>Enter restaurant's name</label>
                <input class="form-control" type="text" name="restaurantName" placeholder="Restaurant Name"> <br>
            </div>
            <div class="form-group">
                <label>Enter restaurant's address</label>
                <input class="form-control" type="text" name="restaurantAddress" placeholder="Restaurant Address"> <br>
            </div>
            <div class="form-group" style="margin-bottom: 2px">
                <label>Choose the city where is your restaurant located.</label>
                <select class="form-control" name="restaurantLocation">
                    <?php
                    require_once 'dbConnect.php';
                    $result = mysqli_query($conn, "SELECT * From cities");
                    while ($row = mysqli_fetch_array($result)) {
                        echo("<option value='" . $row['cityID'] . "'>" . $row['cityName'] . "</option>");
                    }
                    ?>
                </select> <br/></br>
            </div>
            <div class="form-group">
                <label>Enter the number of slots</label>
                <input class="form-control" type="text" name="freeSlots" placeholder="Number of free slots"> <br>
            </div>
            <div class="form-group" style="text-align: center;">
                <button type="submit" name="restaurantSubmit" class="btn btn-primary btn-lg text-center">Submit</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST["restaurantSubmit"])) {
        $restaurantName = $_POST['restaurantName'];
        $restaurantAddress = $_POST['restaurantAddress'];
        $restaurantLocation = $_POST['restaurantLocation'];
        $freeSlots = $_POST['freeSlots'];
        require_once('dbConnect.php');



        if (emptyRestaurantInput($restaurantName, $restaurantAddress, $freeSlots) !== false) {
            echo '<h5 class="text-danger text-center">Input place cannot be empty.</h5>';
            exit();
        }

        if (restaurantExists($conn, $restaurantName, $restaurantLocation) !== false) {
            echo '<h5 class="text-danger text-center">This restaurant already exists.</h5>';
            exit();
        }


        createRestaurant($conn, $restaurantName, $restaurantAddress, $freeSlots, $restaurantLocation);
    }
    ?>

    <?php

    function emptyRestaurantInput($restaurantName, $restaurantAddress, $freeSlots) {
        if (empty($restaurantName) || empty($freeSlots) || empty($restaurantAddress)) {
            return $result = true;
        } else {
            return $result = false;
        }
    }

    function restaurantExists($conn, $restaurantName, $restaurantLocation) {
        $sql = "SELECT * FROM restaurant WHERE restaurantName = ? AND cityID = ?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "si", $restaurantName, $restaurantLocation);
        if (!mysqli_stmt_execute($stmt)) {
            exit();
        }
        $resultData = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            return $result = false;
        }
        mysqli_stmt_close($stmt);
    }

    function createRestaurant($conn, $restaurantName, $restaurantAddress, $freeSlots, $restaurantLocation) {
        $sql = "INSERT INTO restaurant (restaurantName, restaurantAddress, freeSlots, cityID) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ssii", $restaurantName, $restaurantAddress, $freeSlots, $restaurantLocation);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: admin-content.php");
        exit();
    }
    ?>
</table>

<?php
require "footer.php";
?>
