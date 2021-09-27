<?php
    session_start();
    
    if (isset($_SESSION['userID']) && $_SESSION['userName'] == true) {
} else {
    header('Location: login.php');
}

if(isset($_GET['select'])){
    
    include_once 'dbConnect.php';
    $select_id=$_GET['select'];

    $sql = "SELECT restaurant.restaurantID, restaurant.restaurantName, restaurant.restaurantAddress, restaurant.freeSlots, cities.cityName FROM restaurant INNER JOIN cities ON restaurant.cityID=cities.cityID WHERE restaurant.restaurantID='$select_id'";
    $result=mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_array($result)) {
        $restaurant_id = $row['restaurantID'];

  }
  
?>

<?php
require "header.php";
?>
<h3 class="text-center"><br>New Reservation<br/><br/></h3> 
    
<div class="reservation-form">
        <form method="post">
            <div class="form-group">
                <label>First Name</label>
                <input class="form-control" type="text" name="firstName" placeholder="First Name" required> <br>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input class="form-control" type="text" name="lastName" placeholder="Last Name" required><br>
            </div>
            <div class="form-group">
                <label>Enter Date</label>
                <input class="form-control" type="date" name="date" placeholder="Date" required><br>
                    <label>Enter Time Zone</label>
                    <select class="form-control" name="timeZone">
                    <option>12:00 - 16:00</option>
                    <option>16:00 - 20:00</option>
                    <option>20:00 - 00:00</option>
                    </select><br>
            </div>
            <div class="form-group">
                <label>Enter number of guests</label>
                <input class="form-control" type="number" min="1" name="guestNumber" placeholder="Number of guests" required><br>
            </div>
            <div class="form-group">
                <label for="phone">Enter your Telephone Number</label>
                <input class="form-control" type="telephone" name="phone" placeholder="Telephone Number" required><br>
            </div>
            <div class="form-group">
                <label>Your comments</label><br>
                <textarea class="form-control" name="comment" placeholder="Comments" rows="3"></textarea><br>
            </div>
             <div class="form-group" style="text-align: center;">
                <button type="submit" name="submit" class="btn btn-primary btn-lg text-center">Submit Reservation</button>
            </div>
        </div>
        </form>


<?php
            
        require_once 'dbConnect.php';
            if(isset($_POST['submit'])) {
            $userID = $_SESSION['userID'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $date = $_POST['date'];
            $timeZone = $_POST['timeZone'];
            $guestNumber = $_POST['guestNumber'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];
        
       
        
        $sql = "INSERT INTO reservation (restaurantID, userID, firstName, lastName, guestNumber, date, timeZone, phone, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "iississis", $select_id, $userID, $firstName, $lastName, $guestNumber, $date, $timeZone, $phone, $comment);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                header("location: restaurant.php");
                exit();

    }
    
    
?>
<?php
                }
?>

<?php
require "footer.php";
?>

