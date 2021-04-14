
<?php
session_start();
include "../includes/dbconnect.php";
if($_SESSION['w_name'] == '')
{
    header("location: login.php");
}
$name = $_SESSION['w_name'];
$userid = $_SESSION['user_id'];

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
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <div style="display: flex;justify-content: center;">

                <img src="../assets/images/icon.png" class="img-fluid" width="10%" alt="Logo">

            </div>
            <p style="text-align: center;">Nashon Groceries</p>
        </div>
        <div class="col-md-5" style="margin-top: 4%;width: 100%; display: flex; flex-direction: row; justify-content: center;">
            <span><p>Logged in as <b><?php echo $name;?></b></p> </span>
            <span style="margin-left: 50px;"><button class="btn btn-primary"><a style="color: white; text-decoration: none;" href="index.php">Home</a></button></span>
            <span style="margin-left: 50px;"><button class="btn btn-success"><a style="color: white; text-decoration: none;" href="logout.php">Log out</a></button></span>
        </div>
    </div>
    <br><p></p><br>
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <table class="table">
                <tr>
                    <th>Buyer's Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Location</th>
                    <th>Payment Method</th>
                    <th>Date order placed</th>
                </tr>
                <?php
                $sql = "SELECT  * FROM pending_deliveries WHERE buyers_id = '$userid' ";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result))
                {
                ?>
                <tr>
                    <td><?php echo $row['buyers_name']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['quantity_purchased']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['payment_method']; ?></td>
                    <td><?php echo $row['date_created']; ?></td>



                </tr>

                <?php

                    $_SESSION['buyers_name'] = $row['buyers_name'];
                    $_SESSION['product_name'] = $row['product_name'];
                    $_SESSION['quantity_purchased'] = $row['quantity_purchased'];
                    $_SESSION['amount'] = $row['amount'];
                    $_SESSION['location'] = $row['location'];
                    $_SESSION['payment_method'] = $row['payment_method'];

                }


                $sql = mysqli_query($con, "SELECT SUM(amount) as total FROM pending_deliveries");
                $row = mysqli_fetch_array($sql);
                $sum = $row['total'];

                $_SESSION['total_amount'] = $sum;

                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total Amount</td>
                    <td colspan="4">Ksh. <?php echo $sum; ?> </td>
                    <td></td>
                </tr>
            </table>

        </div>
        <div class="col-md-1">

        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="orderslist.php" method="post">
                <input type="hidden" class="form-control" value="1" name="hiddenId">
                <button type="submit" name="btnSubmit" class="btn btn-success">Deliver</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</html>
<?php
if(isset($_POST['hiddenId']))
{
    $wid = $_SESSION['w_id'];
    $bname = $_SESSION['buyers_name'];
    $pname =$_SESSION['product_name'];
    $q_purchased = $_SESSION['quantity_purchased'];
    $t_amount= $_SESSION['amount'];
    $pickup =$_SESSION['location'];
    $p_method = $_SESSION['payment_method'];


    $sql1= "INSERT INTO `assigned_deliveries`(`ad_id`, `worker_id`, `worker_name`, `b_name`, `p_name`, `q_purchased`, `t_amount`, `pickup`, `p_method`,`status`, `date_added`) 
                    VALUES (NULL,'$wid','$name','$bname','$pname','$q_purchased','$t_amount','$pickup','$p_method','uncompleted', NOW())";
    $result= mysqli_query($con, $sql1);

    if($result) {
        $sql = "DELETE FROM pending_deliveries WHERE buyers_name = '$bname'";
        mysqli_query($con, $sql);
        header("location: pendingDeliveries.php",  true,  301 );  exit;
    }else {
        echo $sql1;
    }
}
?>