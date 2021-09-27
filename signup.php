<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign up</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="row">
            <div class="col-md-6 mx-auto p-0"">
                <div class="card">
                    <div class="login-box" style="min-height: 900px;">
                        <div class="login-snip"><input id="tab-1" type="radio" name="tab" class="sign-in" ><label for="tab-1" class="tab"></label> <input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab" style="margin-left: -20px;">Sign Up</label>
                            <div class="login-space">
                                <div class="sign-up-form">
                                    <form action="signup.php" method="post">
                                        <div class="group"> <label for="user" class="label">Username</label>
                                            <input id="user" name="username" type="text" class="input" placeholder="Username"> </div>
                                        <div class="group"> <label for="name" class="label">First name</label>
                                            <input id="user" name="name" type="text" class="input" placeholder="First name"> </div>
                                        <div class="group"> <label for="pass" class="label">Password</label> 
                                            <input id="pass" type="password" name="pw" class="input" data-type="password" placeholder="Password"> </div>
                                        <div class="group"> <label for="pass" class="label">Repeat Password</label> 
                                            <input id="pass" type="password" name="pwrepeat" class="input" data-type="password" placeholder="Repeat your password"> </div>
                                        <div class="group"> <label for="pass" class="label">Email  Address</label> 
                                            <input id="pass" type="text" name="email" class="input" placeholder="Enter your email address"> </div>
                                        <div class="group"> 
                                            <input type="submit" class="button" name="submit" value="Sign Up"> </div>
                                        <div class="hr"></div>
                                        <div class="foot"> <label for="tab-1"><a style="color:#fff" href="login.php">If you already have account <br/> login here.</a></label> </div>
                                    </form>
                                    <?php
                                    if (isset($_POST["submit"])) {
                                        $userName = $_POST['username'];
                                        $email = $_POST['email'];
                                        $firstName = $_POST['name'];
                                        $pw = $_POST['pw'];
                                        $pwRepeat = $_POST['pwrepeat'];
                                        require_once('dbConnect.php');
                                        require_once('functions.php');

                                        if (emptyInput($userName, $firstName, $email, $pw, $pwRepeat) !== false) {
                                            echo '<h5 class="text-danger text-center">Input place cannot be empty.</h5>';
                                            exit();
                                        }

                                        if (invalidUsername($userName) !== false) {
                                            echo '<h5 class="text-danger text-center">Your username is not valid.</h5>';
                                            exit();
                                        }

                                        if (invalidEmail($email) !== false) {
                                            echo '<h5 class="text-danger text-center">Your email is not valid.</h5>';
                                            exit();
                                        }

                                        if (pwIdentify($pw, $pwRepeat) !== false) {
                                            echo '<h5 class="text-danger text-center">You need to re-entry your password. Please try again.</h5>';
                                            exit();
                                        }

                                        if (userNameExists($conn, $userName, $email) !== false) {
                                            echo '<h5 class="text-danger text-center">Your username already exists.</h5>';
                                            exit();
                                        }

                                        createUser($conn, $userName, $email, $firstName, $pw);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>