<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>LOGIN</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <!--         <h2>LOGIN</h2>
                <form action="login.php" method="post">
                    <input type="text" name="username" placeholder="Username"> <br><br>
                    <input type="password" name="pw" placeholder="Password"><br><br>
                    <button type="submit" name="submit">Log In</button><br><br>
                    <p>If you don't have account,you can register<a href="signup.php"> here.</a></p>
                </form>-->
        <div class="row">
            <div class="col-md-6 mx-auto p-0">
                <div class="card">
                    <div class="login-box" style="min-height: 700px;" >
                        <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                            <div class="login-space">
                                <div class="login">
                                    <form action="login.php" method="post">
                                        <div class="group"> <label for="name="username"" class="label">Username</label>
                                            <input id="user" type="text" name="username" class="input" placeholder="Enter your username"> </div>
                                        <div class="group"> <label for="pw" class="label">Password</label> 
                                            <input id="pass" type="password" name="pw" class="input" data-type="password" placeholder="Enter your password"> </div>
                                        <div class="group"> 
                                            <button type="submit" name="submit" class="button">Sign in</button></div>
                                        <div class="hr"></div>
                                        <div class="foot"> <label for="tab-1"><a style="color:#fff" href="signup.php">If you don't have account <br/> register here.</a></label> </div>

                                        <?php
                                        if (isset($_POST["submit"])) {
                                            $userName = $_POST["username"];
                                            $pw = $_POST["pw"];

                                            require_once('dbConnect.php');
                                            require_once('functions.php');

                                            if (emptyInputLogin($userName, $pw) !== false) {
                                                echo '<h5 class="text-danger text-center">Fill all fields, Please try again!</h5>';
                                                exit();
                                            }

                                            loginUser($conn, $userName, $pw);
                                        }
                                        ?>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>