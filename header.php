<!DOCTYPE html>
<html>
    <head>
        <title>Restaurant's reservations</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>


        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3><?php echo"Hello " . $_SESSION['userName']; ?></h3>
                </div>
                <ul class="list-unstyled components">

                    <li>
                        <a href="index.php">Home page</a>
                    </li>
                    <li>
                        <a href="restaurant.php">List of all restaurants</a>
                    </li>

                    </li>
                    <li>
                        <a href="reservation-list.php">List of all reservations</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>


                </ul>
            </nav>


            <div id="content">

