<?php
include 'dbConnection.php';
include 'verifyLogin.php';

function toDestination($acctType){
    switch ($acctType){
        case 'passenger':
            header("location: passenger/");
            break;
        case 'operator':
            header("location: operator/");
            break;
        case 'driver':
            header("location: driver/");
            break;
        case 'admin':
            header("location: admin/");
            break;
    }
    exit;

}
if ($login){
    toDestination($acctType);
}

// Login
$form_username = @ $_POST["form-username"];
$form_password = @ $_POST["form-password"];
// Registration
$form_full_name = @ $_POST["form-first-name"];
$form_username2  = @ $_POST["form-last-name"];
$form_password1 = @ $_POST["form-pass1"];
$form_password2 = @ $_POST["form-pass2"];
$form_age       = @ $_POST["form-age"];
$form_gender    = @ $_POST["form-gender"];
?>

<html>
<head>
    <title>Welcome to TaxiTap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #b5a739 !important;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            color: #888;
            line-height: 30px;
            text-align: center;
        }

        strong { font-weight: 500; }

        a, a:hover, a:focus {
            color: #19b9e7;
            text-decoration: none;
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
        }

        h1, h2 {
            margin-top: 10px;
            font-size: 38px;
            font-weight: 100;
            color: #555;
            line-height: 50px;
        }

        h3 {
            font-size: 22px;
            font-weight: 300;
            color: #555;
            line-height: 30px;
        }

        img { max-width: 100%; }

        ::-moz-selection { background: #19b9e7; color: #fff; text-shadow: none; }
        ::selection { background: #19b9e7; color: #fff; text-shadow: none; }


        .btn-link-1 {
            display: inline-block;
            height: 50px;
            margin: 5px;
            padding: 16px 20px 0 20px;
            background: #19b9e7;
            font-size: 16px;
            font-weight: 300;
            line-height: 16px;
            color: #fff;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
        }
        .btn-link-1:hover, .btn-link-1:focus, .btn-link-1:active { outline: 0; opacity: 0.6; color: #fff; }

        .btn-link-1.btn-link-1-facebook { background: #4862a3; }
        .btn-link-1.btn-link-1-twitter { background: #55acee; }
        .btn-link-1.btn-link-1-google-plus { background: #dd4b39; }

        .btn-link-1 i {
            padding-right: 5px;
            vertical-align: middle;
            font-size: 20px;
            line-height: 20px;
        }

        .btn-link-2 {
            display: inline-block;
            height: 50px;
            margin: 5px;
            padding: 15px 20px 0 20px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid #fff;
            font-size: 16px;
            font-weight: 300;
            line-height: 16px;
            color: #fff;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
        }
        .btn-link-2:hover, .btn-link-2:focus,
        .btn-link-2:active, .btn-link-2:active:focus { outline: 0; opacity: 0.6; background: rgba(0, 0, 0, 0.3); color: #fff; }

        .btn-link-2 i {
            padding-right: 5px;
            vertical-align: middle;
            font-size: 20px;
            line-height: 20px;
        }


        /***** Top content *****/

        .inner-bg {
            padding: 60px 0 80px 0;
        }

        .top-content .text {
            color: #fff;
        }

        .top-content .text h1 { color: #fff; }

        .top-content .description {
            margin: 20px 0 10px 0;
        }

        .top-content .description p { opacity: 0.8; }

        .top-content .description a {
            color: #fff;
        }
        .top-content .description a:hover,
        .top-content .description a:focus { border-bottom: 1px dotted #fff; }

        .form-box {
            margin-top: 70px;
        }

        .form-top {
            overflow: hidden;
            padding: 0 25px 15px 25px;
            background: #444;
            background: rgba(0, 0, 0, 0.35);
            -moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; border-radius: 4px 4px 0 0;
            text-align: left;
        }

        .form-top-left {
            float: left;
            width: 75%;
            padding-top: 25px;
        }

        .form-top-left h3 { margin-top: 0; color: #fff; }
        .form-top-left p { opacity: 0.8; color: #fff; }

        .form-top-right {
            float: left;
            width: 25%;
            padding-top: 5px;
            font-size: 66px;
            color: #fff;
            line-height: 100px;
            text-align: right;
            opacity: 0.3;
        }

        .form-bottom {
            padding: 25px 25px 30px 25px;
            background: #444;
            background: rgba(0, 0, 0, 0.3);
            -moz-border-radius: 0 0 4px 4px; -webkit-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px;
            text-align: left;
        }

        .form-bottom form textarea {
            height: 100px;
        }

        .form-bottom form button.btn {
            width: 100%;
        }

        .form-bottom form .input-error {
            border-color: #19b9e7;
        }

        .social-login {
            margin-top: 35px;
        }

        .social-login h3 {
            color: #fff;
        }

        .social-login-buttons {
            margin-top: 25px;
        }

        .middle-border {
            min-height: 300px;
            margin-top: 170px;
            border-right: 1px solid #fff;
            border-right: 1px solid rgba(255, 255, 255, 0.6);
        }


        /***** Footer *****/

        footer {
            padding-bottom: 70px;
            color: #fff;
        }

        footer .footer-border {
            width: 200px;
            margin: 0 auto;
            padding-bottom: 30px;
            border-top: 1px solid #fff;
            border-top: 1px solid rgba(255, 255, 255, 0.6);
        }

        footer p { opacity: 0.8; }

        footer a {
            color: #fff;
        }
        footer a:hover, footer a:focus { color: #fff; border-bottom: 1px dotted #fff; }


        /***** Media queries *****/

        @media (min-width: 992px) and (max-width: 1199px) {}

        @media (min-width: 768px) and (max-width: 991px) {}

        @media (max-width: 767px) {

            .middle-border { min-height: auto; margin: 65px 30px 0 30px; border-right: 0;
                border-top: 1px solid #fff; border-top: 1px solid rgba(255, 255, 255, 0.6); }

        }

        @media (max-width: 415px) {

            h1, h2 { font-size: 32px; }

        }


    </style>
    <script type="text/javascript">
        function wrongPassword() {
            alert("Opps. Wrong Password");
        }
        function wrongUsername() {
            alert("Opps. Wrong Username");
        }
        function passwordNotMatch() {
            alert("Opps. Password Not Match");
        }
        function accountCreationSuccess(){
            alert("Account Successfully Created");
        }
        function accountCreationError(){
            alert("Username Already Exists");
        }
    </script>
    <?php

    if(isset($form_username) && isset($form_password)){
        $sql = "SELECT * FROM `accounts` WHERE `username`='$form_username' LIMIT 1";
        $query = mysqli_query($dbMedium, $sql);
        if (mysqli_num_rows($query) < 1){
            echo "<script type='text/javascript'> wrongUsername(); </script>";
        }else{
            $result = mysqli_fetch_array($query);
            $db_id = $result["id"];
            $db_username = $result["username"];
            $db_password = $result["password"];
            $db_acctType = $result["account_type"];

            // Success - Login the user when success
            if ($db_password == $form_password){
                // CREATE THEIR AND COOKIES
                $_SESSION['id']    = $db_id;
                $_SESSION['username']    = $db_username;
                $_SESSION['password']    = $db_password;
                $_SESSION['accountType'] = $db_acctType;

                // CREATE THEIR SESSIONS
                @ setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
                @ setcookie("username", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
                @ setcookie("password", $db_password, strtotime( '+30 days' ), "/", "", "", TRUE);
                @ setcookie("accountType", $db_acctType, strtotime( '+30 days' ), "/", "", "", TRUE);

                // Refresh the page
                echo "<script type='text/javascript'> window.location.href = 'index.php'; </script>";
            }

            // Wrong Password
            else{
                echo "<script type='text/javascript'> wrongPassword(); </script>";
            }

        }
    }

    if (isset($form_full_name) && isset($form_username2) && isset($form_password1) && isset($form_password2) && isset($form_age) && isset($form_gender)){
        if ($form_password1 != $form_password2){
            echo "<script type='text/javascript'> passwordNotMatch() </script>";
        }else{
            $sql = "INSERT INTO `accounts`(`username`, `password`, `name`, `age`, `gender`, `account_type`) VALUES ('$form_username2', '$form_password1', '$form_full_name', $form_age, '$form_gender', 'passenger');";
            $query = mysqli_query($dbMedium, $sql);

            if ($query === true){
                echo "<script type='text/javascript'> accountCreationSuccess() </script>";
            }else{
                echo "<script type='text/javascript'> accountCreationError() </script>";
            }
        }
    }

    ?>

</head>
<body>
<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Welcome to TaxiTap</strong></h1>
                    <div class="description">
                        <p>
                            A real-time web-based application designed to help Taxi Driver, Operator, and Passengers; to monitor and transact.
                        </p>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5">

                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Signin to our site</h3>
                                <p>Enter username and password to log on:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="index.php" method="POST" class="login-form">
                                <div class="form-group">
                                    <label class="sr-only" for="form-username">Username</label>
                                    <input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-password">Password</label>
                                    <input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Sign in!</button>
                            </form>
                        </div>
                    </div>

                    <div class="social-login">
                        <h3>...or read about us:</h3>
                        <div class="social-login-buttons">
                            <a class="btn btn-link-2" href="#">
                                <i class="fa fa-about"></i> About us
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-sm-1 middle-border"></div>
                <div class="col-sm-1"></div>

                <div class="col-sm-5">

                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Sign up now</h3>
                                <p>Fill in the form below to get instant access:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="index.php" method="post" class="registration-form">
                                <div class="form-group">
                                    <label class="sr-only" for="form-first-name">Name:</label>
                                    <input type="text" name="form-first-name" placeholder="Full Name..." class="form-first-name form-control" id="form-first-name">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-last-name">Username</label>
                                    <input type="text" name="form-last-name" placeholder="Username..." class="form-last-name form-control" id="form-last-name">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-pass1">Enter Password</label>
                                    <input type="password" name="form-pass1" placeholder="Enter Password..." class="form-pass1 form-control" id="form-pass1">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-pass2">Confirm Password</label>
                                    <input type="password" name="form-pass2" placeholder="Confirm Password..." class="form-pass2 form-control" id="form-pass2">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-age">Age</label>
                                    <input type="number" name="form-age" placeholder="Age..." class="form-age form-control" id="form-age">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-gender">Gender</label>
                                    <select name="form-gender" id="form-gender" class="form-gender form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning">Sign me up!</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">

            <div class="col-sm-8 col-sm-offset-2">
                <div class="footer-border"></div>
                <p>TaxiTap - A realtime application powered by Google Map API and Socket Programming Technology.</p>
            </div>

        </div>
    </div>
</footer>

</body>
</html>