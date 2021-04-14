<?php
session_start();
if($_SESSION['admin_name'] == '')
{
    header("location: login.php");
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

    </head>

        <body>


            <div class="d-flex" id="wrapper">

<!--my sidebar-->
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
                <!-- end of my sidebar -->

                <!-- code for the Top navigation bar-->
                <div id="page-content-wrapper">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                        <button class="btn btn-outline-primary" id="menu-toggle">Toggle Menu</button>

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
<!--End of top navigation bar-->

<!-- start content-->
                    <div class="container-fluid">
                        <h4>Dashboard</h4><br>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card bg-primary text-white" style="padding: 50px; text-align: center;">
                                        <p>Number of Users</p>
                                        <?php
                                        include "../includes/dbconnect.php";
                                        $sql = "SELECT * FROM users";
                                        $result = mysqli_query($con, $sql);
                                        $total= mysqli_num_rows($result);


                                        ?>
                                        <h1><?php echo $total;  ?> </h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-success text-white" style="padding: 50px; text-align: center;">
                                        <p>Users currently online</p>
                                        <?php
                                        include "../includes/dbconnect.php";
                                        $sql = "SELECT * FROM online_users";
                                        $result = mysqli_query($con, $sql);
                                        $total= mysqli_num_rows($result);


                                        ?>
                                        <h1><?php echo $total;  ?> </h1>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-info text-white" style="padding: 50px; text-align: center;">
                                        <p>Number of Workers</p>
                                        <?php
                                        $result = mysqli_query($con, 'SELECT * FROM delivery_workers');
                                        $total = mysqli_num_rows($result);


                                        ?>
                                        <h1><?php echo $total; ?></h1>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card bg-warning text-white" style="padding: 50px; text-align: center;">
                                        <p>Current Stock price</p>
                                        <?php
                                        $result = mysqli_query($con, 'SELECT SUM(product_innitial_price*product_amount) AS value_sum FROM stock');
                                        $row = mysqli_fetch_assoc($result);
                                        $sum = $row['value_sum'];

                                        ?>
                                        <h1>Ksh. <?php echo $sum; ?></h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-danger text-white" style="padding: 50px; text-align: center;">
                                        <p>After sale Amount</p>
                                        <?php
                                        $result = mysqli_query($con, 'SELECT SUM(product_final_amount*product_amount) AS value_sum FROM stock');
                                        $row = mysqli_fetch_assoc($result);
                                        $sum = $row['value_sum'];

                                        ?>
                                        <h1>Ksh. <?php echo $sum; ?></h1>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-dark text-white" style="padding: 50px; text-align: center;">
                                        <p>Total profit</p>
                                        <?php
                                        $result = mysqli_query($con, 'SELECT SUM(product_innitial_price*product_amount) AS value_sum FROM stock');
                                        $row = mysqli_fetch_assoc($result);
                                        $initial = $row['value_sum'];

                                        $result = mysqli_query($con, 'SELECT SUM(product_final_amount*product_amount) AS value_sum FROM stock');
                                        $row = mysqli_fetch_assoc($result);
                                        $final = $row['value_sum'];

                                        $total = $final -$initial;
                                        ?>
                                        <h1>Ksh. <?php echo $total; ?> </h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /#page-content-wrapper -->

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
        </script>

        </body>

</html>