<?php
session_start();
if($_SESSION['admin_name'] == '')
{
    header("location: login.php");
}
include "../includes/dbconnect.php";

if(isset($_POST['update_workers']))
{
    $wid = $_POST['wid'];
    $name = $_POST['w_nameUpdate'];
    $mobile = $_POST['w_mobileUpdate'];
    $location = $_POST['w_locationUpdate'];
    $password = $_POST['w_passwordUpdate'];
    $pass = md5($password);
    $sql = "UPDATE `delivery_workers` SET `w_name`='$name',`w_mobile`='$mobile',
                            `w_location`='$location',`w_password`='$pass' WHERE w_id ='$wid'";
    $result = mysqli_query($con, $sql);
    if(!$result){

    }else{

        header("location: ../Admin/delivery_workers.php");
    }

}





?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nashon's Grocery</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/app.css" rel="stylesheet">
    <style>
        .img {
            width: 200px;
            height: 200px;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">
            <img src="../assets/images/icon.png" class="img-fluid" width="20%" style="margin-right: -400px;" alt="Logo"><br>
            <h4><b>Nashon's Grocery</b></h4></div>
        <div class="list-group list-group-flush">
            <a href="index.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-dashboard"></i> Dashboard</a>
            <a href="users.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-user"></i> Users</a>
            <a href="fruits.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-houzz"></i> Fruits</a>
            <a href="delivery_workers.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-truck"></i> Delivery Workers</a>
            <a href="pending_deliveries.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-credit-card"></i> Pending Deliveries</a>
            <a href="assigned_deliveries.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-credit-card"></i> Assigned Deliveries</a>
            <a href="completed_deliveries.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-list-alt"></i> Completed Deliveries</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Welcome Admin <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">

                    <div align="right" style="margin-top: 50px;">
                        <button class="btn btn-success"><a href="delivery_workers.php" style="text-decoration: none; color: white;">Back to Workers</a></button>
                    </div>
                    <div class="card p-5" style="margin-top: 50px;">
                        <?php
                        if(isset($_GET['wid_edit']))
                        {
                            include "../includes/dbconnect.php";
                            $wid = $_GET['wid_edit'];
                            $sql = "SELECT * FROM delivery_workers where w_id ='$wid'";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result))
                            {
                                ?>
                                <form action="editWorkers.php" method="post">
                                    <div class="form-group">
                                        <label for="name">Worker Name</label>
                                        <input type="text" value="<?php echo $row['w_name']; ?>" class="form-control" name="w_nameUpdate" required>
                                    </div>

                                    <input type="hidden" name="wid" value="<?php echo $row['w_id']; ?>">
                                    <div class="form-group">
                                        <label for="name">Worker Mobile</label>
                                        <input type="text" value="<?php echo $row['w_mobile']; ?>" class="form-control" name="w_mobileUpdate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Worker Location</label>
                                        <input type="text" value="<?php echo $row['w_location']; ?>" class="form-control" name="w_locationUpdate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Worker Password</label>
                                        <input type="password"  class="form-control" name="w_passwordUpdate" required>
                                    </div>
                                    <button type="submit" name="update_workers" class="btn btn-primary mb-2">Submit</button>
                                </form>
                                <?php
                            }
                        }




                        ?>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>


    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        function destroyModal()
        {
            $("#addfruit").remove();
        }
    </script>

</body>

</html>