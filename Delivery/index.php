<?php
session_start();
if($_SESSION['w_name'] == '')
{
    header("location: login.php");
}
$name = $_SESSION['w_name'];
?>

<html>
    <head>
        <title>Nashon's Grocery</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="An e-commerce web for Groceries">
        <meta name="author" content="Nashon Okumu">

        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="../assets/css/app.css" rel="stylesheet">
        <style>
            .img {
                width: 300px;
                height: 300px;
                background-position: 50% 50%;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <div style="display: flex;justify-content: center;">

                        <img src="../assets/images/icon.png" class="img-fluid" width="10%" alt="Logo">

                    </div>
                    <p style="text-align: center;">Nashon Groceries</p>
                </div>
                <div class="col-md-4" style="margin-top: 4%;width: 100%; display: flex; flex-direction: row; justify-content: center;">
                    <span><p>Logged in as <b><?php echo $name;?></b></p> </span>
                    <span style="margin-left: 50px;"><button class="btn btn-primary"><a style="text-decoration: none; color: white; " href="logout.php">LOGOUT</a></button></span>
                </div>
            </div>
            <br><p></p><br>
            <div class="row">
                <div class="col-md-4">
                    <a href="orders.php" style="text-decoration: none;">
                    <div class="card">
                        <img src="../assets/images/orders.png" height="300px" width="300px" class="img p-5" alt="">
                        <p style="text-align: center;">Orders</p>
                    </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="pendingDeliveries.php">
                    <div class="card">
                        <img src="../assets/images/truck.png"  height="300px" width="300px"class="img p-5 img-fluid" alt="">
                        <p style="text-align: center;">Pending Deliveries</p>
                    </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="completed.php">
                    <div class="card">
                        <img src="../assets/images/deliveries.png"  height="300px" width="300px" class=" img p-5 img-fluid" alt="">
                        <p style="text-align: center;">My Completed Deliveries</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</html>