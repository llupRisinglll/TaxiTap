<?php
include '../dbConnection.php';
include '../verifyLogin.php';
if ($login){
    switch ($acctType){
        case 'passenger':
            header("location: passenger/");
            exit;
            break;
        case 'driver':
            header("location: driver/");
            exit;
            break;
        case 'admin':
            header("location: admin/");
            exit;
            break;
    }
}else{
    header("location: ../index.php");
    exit;
}

@ $name = $_POST["name"];
@ $username = $_POST["username"];
@ $pass1 = $_POST["pass1"];
@ $pass2 = $_POST["pass2"];
@ $age = $_POST["age"];
@ $gender = $_POST["gender"];
@ $prof_license = $_POST["prof_license"];
@ $vehicle_or = $_POST["vehicle_or"];
@ $taxiplate = $_POST["taxiplate"];
@ $update = $_GET["edit"];

@ $delete = $_GET["delete"];

if (isset($delete)){
    $sql1 = "DELETE FROM `accounts` WHERE `account_type`='driver' AND id='" .$_GET["delete"]."'";
    $sql2 = "DELETE FROM `driver` WHERE account_id='" .$_GET["delete"]."'";

    $query1 = mysqli_query($dbMedium, $sql1);
    $query2 = mysqli_query($dbMedium, $sql2);

    if ($query2 === true) {
        header("location: index.php");
        exit;
    }
}


if (isset($name) && isset($username) && isset($pass1) && isset($pass2) && isset($age) && isset($prof_license) && isset($gender) && isset($vehicle_or) && isset($update)){
    $sql = "UPDATE `accounts`, `driver` SET accounts.username='$username', accounts.name='$name', accounts.age='$age',accounts.gender='$gender', accounts.password='$pass1', driver.prof_driver_license='$prof_license', driver.vehicle_or='$vehicle_or', driver.taxi_plate_num='$taxiplate' WHERE driver.operator_id=$log_id AND `account_type`='driver' AND accounts.id='$update'";
    $query = mysqli_query($dbMedium, $sql);
    if ($query === true){
        echo "<script>alert('Successfully updated')</script>";
    }
}
else if (isset($name) && isset($username) && isset($pass1) && isset($pass2) && isset($age) && isset($prof_license) && isset($gender) && isset($vehicle_or)){
    if ($pass1 != $pass2){
        echo "<script> alert('Password not match'); </script>";
    }else {
        $sql = "INSERT INTO `accounts`(`username`, `password`, `name`, `age`, `gender`, `account_type`) VALUES ('$username','$pass1','$name','$age','$gender','driver')";
        $query = mysqli_query($dbMedium, $sql);
        $sqlD = "INSERT INTO `driver`(`account_id`, `prof_driver_license`, `vehicle_or`, `taxi_plate_num`, `operator_id`) VALUES (LAST_INSERT_ID(),'$prof_license','$vehicle_or','$taxiplate','$log_id')";
        $queryD = mysqli_query($dbMedium, $sqlD);

        // If the two query was success full
        if ($query === true && $queryD === true){
            echo "<script>alert('Successfully added')</script>";
        }else{
            echo "<script>alert('A server error occured. Please Try again later.')</script>";
        }
    }
}
?>

<html>
<head>
    <title>Driver - MAP</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <style>
        .nav>li>a:hover, .nav>li>a:focus{
            text-decoration: none;
            background-color: #E7CE26;
        }
        a, a:hover{
            color: #8c7a00;
        }
    </style>
</head>
<body style="height: 100%">
<nav class="navbar navbar-default" style="margin-bottom:0; background-color: #eff85b;border-color: #e7ce26; border-radius: 0">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">TaxiTap</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><b>Operator</b></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <h1>Add another Accounts:</h1>
    <?php
    $e = @ $_GET["edit"];
    if (isset($e)){
        $sql = "SELECT accounts.id, accounts.username, accounts.name, accounts.age,accounts.gender, accounts.password, driver.prof_driver_license, driver.vehicle_or, driver.taxi_plate_num FROM `accounts`, `driver` WHERE driver.operator_id=$log_id AND `account_type`='driver' AND accounts.id='" .$_GET["edit"]."' LIMIT 1";
        $query = mysqli_query($dbMedium, $sql);
        $result = mysqli_fetch_array($query);
    }

    ?>
    <form <?php if (@isset($e)) echo "action='add_driver.php?edit=$e'"; else echo "action='add_driver.php'"; ?> method="post">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" placeholder="Enter Full Name" class="form-control" id="name" name="name" <?php if (@isset($e)) echo "value='". $result["name"]. "'"; ?> required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" placeholder="Enter Username" class="form-control" id="username" name="username" <?php if (@isset($e)) echo "value='". $result["username"]. "'"; ?> required>
        </div>
        <div class="form-group">
            <label for="pass1">Enter Password:</label>
            <input type="password" placeholder="Enter Password" class="form-control" id="pass1" name="pass1" <?php if (@isset($e)) echo "value='". $result["password"]. "'"; ?> required>
        </div>
        <div class="form-group">
            <label for="pass2">Confirm Password:</label>
            <input type="password" placeholder="Confirm Password" class="form-control" id="pass2" name="pass2" <?php if (@isset($e)) echo "value='". $result["password"]. "'"; ?> required>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" placeholder="Enter Age" class="form-control" id="age" name="age" <?php if (@isset($e)) echo "value='". $result["age"]. "'"; ?> required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="male" <?php if (@isset($e)){ if($result["gender"] == 'male'){ echo "selected"; }}; ?>>Male</option>
                <option value="female" <?php if (@isset($e)){ if($result["gender"] == 'female'){ echo "selected"; }}; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="prof_license">Enter Professional Driver License:</label>
            <input type="text" placeholder="Enter Professional Driver License" class="form-control" id="prof_license" name="prof_license" <?php if (@isset($e)) echo "value='". $result["prof_driver_license"]. "'"; ?> required>
        </div>
        <div class="form-group">
            <label for="vehicle_or">Enter Vehicle OR:</label>
            <input type="text" placeholder="Enter Vehicle OR" class="form-control" id="vehicle_or" name="vehicle_or" <?php if (@isset($e)) echo "value='". $result["vehicle_or"]. "'"; ?> required>
        </div>
        <div class="form-group">
            <label for="taxiplate">Enter Taxi Plate Number:</label>
            <input type="text" placeholder="Enter Taxi Plate Number" class="form-control" id="taxiplate" name="taxiplate" <?php if (@isset($e)) echo "value='". $result["taxi_plate_num"]. "'"; ?> required>
        </div>
        <div class="form-group">
            <input type="submit" value="Add Accounts" class="btn btn-success"  <?php if (@isset($e)) echo "value='Update Account'"; else echo "value='Add Account'"; ?>>
            <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>