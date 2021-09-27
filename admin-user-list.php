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

<h3 class="text-center"> Registered users </h3> <br/>
<table class="table center" style="width: 75%">
    <thead  class="thead-dark">
        <tr>
            <th>User ID </th>
            <th>Username</th>
            <th>First name</th>
            <th>User Email</th>
            <th>  </th>
        </tr>
    </thead>
    <?php
    include 'dbConnect.php';
    $sql = "SELECT users.userID, users.userNickname,
                    users.userName, users.userEmail FROM users;
";
    $result = mysqli_query($conn, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['userID'];
        $username = $row['userNickname'];
        $firstName = $row['userName'];
        $email = $row['userEmail'];
        $i++;
        ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $firstName; ?></td>
            <td><?php echo $email; ?></td>
            <td><a href="admin-user-list.php? delete=<?php echo $id; ?>" class="btn btn-primary" role="button">Delete</a></td>

        </tr>
        <?php
    }
    ?>
</table>
<br>

<?php
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete = "DELETE FROM users WHERE users.u ='$delete_id'";
    $result_delete = mysqli_query($conn, $delete);
}
?>
<?php
require "footer.php";
?>
