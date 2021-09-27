<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>


        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3><?php echo"Hello " . $_SESSION['adminName']; ?></h3>
                </div>
                <ul class="list-unstyled components">

                    <li id="setter">
                        <a href="admin-content.php">Home page</a>
                    </li>
                    <li>
                        <a href="admin-new-city.php">City management</a>
                    </li>
                    <li>
                        <a href="admin-new-restaurant.php">Add new restaurant</a>
                    </li>

                    </li>
                    <li>
                        <a href="admin-reservation-list.php">List of sent reservations</a>
                    </li>
                    <li>
                        <a href="admin-restaurant-list.php">List of registered restaurants</a>
                    </li>
                    <li>
                        <a href="admin-user-list.php">List of registered users</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>


                </ul>
            </nav>


            <div id="content">

