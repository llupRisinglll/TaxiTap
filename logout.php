<?php
session_start();
// Set Session data to an empty array
$_SESSION = array();

// Expire their cookie files
if(isset($_COOKIE["username"]) && isset($_COOKIE["password"]) && isset($_COOKIE["accountType"])) {
    setcookie("username", '', strtotime( '-30 days' ), '/');
    setcookie("password", '', strtotime( '-30 days' ), '/');
    setcookie("accountType", '', strtotime( '-30 days' ), '/');
}

// Destroy the session variables
session_destroy();

// Double check to see if their sessions exists
if(isset($_SESSION['username'])){
    echo "Error Persist. Please Try Again Later";
    exit;
}
// When the Session does not exit any longer then go to the index page
else {
    header("location: index.php");
    exit;
}
