<?php
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
    <h1>List of Drivers:</h1>
    <table class="table table-bordered">
        <tr>
            <td><b>ID</b></td>
            <td><b>Username</b></td>
            <td><b>Name</b></td>
            <td><b>Age</b></td>
            <td><b>Gender</b></td>
            <td><b>Professional Driver License</b></td>
            <td><b>Vehicle OR</b></td>
            <td><b>Taxi Plate Number</b></td>
            <td colspan="2"><b>Action</b></td>
        </tr>

        <?php
        $sql = "SELECT accounts.id, accounts.username, accounts.name, accounts.age,accounts.gender, driver.prof_driver_license, driver.vehicle_or, driver.taxi_plate_num FROM `accounts`, `driver` WHERE driver.operator_id=$log_id AND `account_type`='driver' AND accounts.id=driver.account_id";
        $query = mysqli_query($dbMedium, $sql);

        if (mysqli_num_rows($query) > 0){
            while ($row = mysqli_fetch_array($query)){
                echo "<tr>";
                echo "<td>" .$row["id"]. "</td>";
                echo "<td>" .$row["username"]. "</td>";
                echo "<td>" .$row["name"]. "</td>";
                echo "<td>" .$row["age"]. "</td>";
                echo "<td>" .$row["gender"]. "</td>";
                echo "<td>" .$row["prof_driver_license"]. "</td>";
                echo "<td>" .$row["vehicle_or"]. "</td>";
                echo "<td>" .$row["taxi_plate_num"]. "</td>";
                echo "<td><a href='add_driver.php?edit="  .$row["id"].  "' class='btn btn-primary'>Edit</a></td>";
                echo "<td><a href='add_driver.php?delete="  .$row["id"].  "' class='btn btn-danger'>Delete</a></td>";
                echo "</tr>";
            }
        }else{
            echo "<tr><td colspan='8' align='center'>You have no drivers.</td></tr>";
        }
        ?>

    </table>
    <a class="btn btn-primary" href="add_driver.php">Add another Driver</a>
</div>
</body>
</html>