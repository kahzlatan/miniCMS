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
<div class="reservation-form">
    <form action="admin-new-city.php" method="post">
        <h3 class="text-center">Add a new city</h3>
        <div class="form-group" style="margin-bottom: 2px">
            <label>City name</label>
            <input class="form-control" type="text" name="cityName" placeholder="City name"> <br>
        </div>
        <div class="form-group" style="text-align: center;">
            <button type="submit" name="citySubmit" class="btn btn-primary btn-lg text-center">Submit</button><br/><br/>
        </div>
    </form>
</div>
<?php
if (isset($_POST["citySubmit"])) {
    $cityName = $_POST['cityName'];
    require_once('dbConnect.php');

    if (emptyCityInput($cityName) !== false) {
        echo '<h5 class="text-danger text-center">Input place cannot be empty.</h5>';
        exit();
    }

    if (cityExists($conn, $cityName) !== false) {
        echo '<h5 class="text-danger text-center">This city already exists.</h5>';
        exit();
    }

    createCity($conn, $cityName);
}
?>
<?php

function cityExists($conn, $cityName) {
    $sql = "SELECT * FROM cities WHERE cityName = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $cityName);
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

function createCity($conn, $cityName) {
    $sql = "INSERT INTO cities (cityName) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $cityName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: admin-content.php");
    exit();
}

function emptyCityInput($cityName) {
    if (empty($cityName)) {
        return $result = true;
    } else {
        return $result = false;
    }
}
?>

<!--Delete city-->

<div class="hr" style="background-color: #000; width: 100%;"></div>

<div class="reservation-form">
    <form action="admin-new-city.php" method="get">
        <h3 class="text-center">Delete the city location</h3><br/>
        <div class="form-group" style="margin-bottom: 2px">
            <label>Select the city you want to delete</label>
            <select class="form-control" name="deleteCity">
                <?php
                require_once 'dbConnect.php';
                $result = mysqli_query($conn, "SELECT * From cities");
                while ($row = mysqli_fetch_array($result)) {
                    echo("<option value='" . $row['cityID'] . "'>" . $row['cityName'] . "</option>");
                }
                ?>
            </select>
        </div> <br/>
        <div class="form-group" style="text-align: center;"> 
            <button type="submit" name="delete" class="btn btn-primary btn-lg text-center">Delete</button><br/><br/>
        </div>
    </form>
</div>

<?php
if (isset($_GET['delete'])) {
    $delete_id = $_GET['deleteCity'];
    $delete = "DELETE FROM cities WHERE cityID ='$delete_id'";
    $result_delete = mysqli_query($conn, $delete);
    header("location: admin-content.php");
    exit();
}
?>
</table>


<?php
require "footer.php";
?>
