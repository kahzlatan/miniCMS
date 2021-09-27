<?php
require_once('dbConnect.php');
function emptyInput($userName, $firstName, $email, $pw, $pwdRepeat) {
    if(empty($userName) || empty($firstName) || empty($email) || empty($pw) || empty($pwdRepeat)) {
        return $result = true;
    } else {
        return $result = false;
    }
}

function emptyInputLogin($userName, $pw) {
    if(empty($userName) || empty($pw)) {
        return $result = true;
    } else {
        return $result = false;
    }
}

function loginUser($conn, $userName, $pw) {
    $userExists = userNameExists($conn, $userName, $pw);
    if ($userExists === false) {
        echo '<h5 class="text-danger text-center">This user is not registered.</h5>';
        exit();
    }
    
    $protectedPw = $userExists["userPw"];
    $checkPw = password_verify($pw, $protectedPw);
    
    if($checkPw === false) {
        echo '<h5 class="text-danger text-center">Wrong password.</h5>';
        exit();
    } else if($checkPw === true) {
        session_start();
        $_SESSION["userID"] = $userExists["userID"];
        $_SESSION["userName"] = $userExists["userNickname"];
        header("location: index.php");
        exit();
    }
}
 
function loginAdmin($conn, $userName, $pw) {
    $adminExists = adminNameExists($conn, $userName, $pw);
    if ($adminExists === false) {
        echo '<h5 class="text-danger text-center">This admin is not registered.</h5>';
        exit();
    }
    
    $protectedPw = $adminExists["password"];
    $checkPw = password_verify($pw, $protectedPw);
    
    if($checkPw === false) {
        echo '<h5>Wrong password.</h5>';
        exit();
    } else if($checkPw === true) {
        session_start();
        $_SESSION["adminID"] = $adminExists["adminID"];
        $_SESSION["adminName"] = $adminExists["adminName"];
        header("location: admin-content.php");
        exit();
    }
}

function adminNameExists($conn, $userName) {
    $sql = "SELECT * FROM admins WHERE adminName = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userName);
    if(!mysqli_stmt_execute($stmt)) {
        exit();
    }
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return $result = false;
    }
    mysqli_stmt_close($stmt);
} 


function invalidUsername($userName) {
    if(preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
        return $result = false;
    } else {
        return $result = true;
    }
}
function invalidEmail($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $result = false;
    } else {
        return $result = true;
    }
}
function pwIdentify($pw, $pwRepeat) {
    if($pw == $pwRepeat) {
        return $result = false;
    } else {
        return $result = true;
    }
}

function userNameExists($conn, $userName, $email) {
    $sql = "SELECT * FROM users WHERE userNickname = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
    if(!mysqli_stmt_execute($stmt)) {
        exit();
    }
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return $result = false;
    }
    mysqli_stmt_close($stmt);
} 

function createUser($conn, $userName, $email, $firstName, $pw) {
    $sql = "INSERT INTO users (userNickname,userEmail,userName,userPw) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    $protectedPw = password_hash($pw, PASSWORD_DEFAULT); 
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $userName, $email, $firstName, $protectedPw);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: index.php");
    exit();
}

