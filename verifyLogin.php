<?php
session_start();
include_once 'dbConnection.php';

// Files that inculde this file at the very top would NOT require
// connection to database or session_start(), be careful.
// Initialize some vars
$login  = false;
$log_id = 0;
$log_username = "";
$log_password = "";
$acctType     = "";

// User Verify function
function evalLoggedUser($connection, $username, $password){
    $sql = "SELECT * FROM `accounts` WHERE username='$username' AND `password`='$password' LIMIT 1";
    $query = mysqli_query($connection, $sql);
    $resultNumber = mysqli_num_rows($query);
    if($resultNumber > 0){
        return true;
    }
    return false;
}

// CHECK IF SESSION IS SET
if(isset($_SESSION["username"]) && isset($_SESSION["password"]) && isset($_SESSION["accountType"]) && isset($_SESSION["id"])) {
    $log_id = $_SESSION["id"];
    $log_username = $_SESSION["username"];
    $log_password = $_SESSION["password"];
    $acctType     = $_SESSION["accountType"];

    // Verify the user
    $login     = evalLoggedUser($dbMedium, $log_username, $log_password);

} else if(isset($_COOKIE["usn"]) && isset($_COOKIE["pass"]) && isset($_COOKIE["accountType"]) && isset($_COOKIE["id"])){

    $_SESSION['id'] = $_COOKIE['id'];
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['password'] = $_COOKIE['password'];
    $_SESSION['accountType'] = $_COOKIE['accountType'];

    $log_id = $_SESSION['id'];
    $log_username = $_SESSION['username'];
    $log_password = $_SESSION['password'];
    $acctType    = $_SESSION["accountType"];

    // Verify the
    $user_ok     = evalLoggedUser($dbMedium, $log_username, $log_password);
}
