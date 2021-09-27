<?php
    session_start();
    include_once 'dbConnect.php';
    if (isset($_SESSION['adminID']) && $_SESSION['adminName'] == true) {
        
    } else {
    header('Location: admin-login.php');
}
?>
<?php
    require "admin-header.php";
?>
<h1>Welcome to admin's content</h1><br/>
        <p>You have successfully logged in as admin. Now, you have full access to admin content.</p>
        <p>Please select one of our options in our navigation menu.</p><br/><br/>

        
<?php
require "footer.php";
?>
