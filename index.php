<?php
session_start();

if (isset($_SESSION['userID']) && $_SESSION['userName'] == true) {
    $welcomeMessage = "Welcome to the member's area, " . $_SESSION['userName'] . "!";
} else {
    header('Location: login.php');
}
?>
<?php
    require "header.php";
?>

<h3 class="text-center"><?php echo "Welcome to the member's area, " . $_SESSION['userName']; ?></h3><br/><br>
<p>You have successfully logged in. Now, you have full access to user content.</p>
<p>Please select one of our options in our navigation menu.</p><br/><br/>

<?php
require "footer.php";
?>
