
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
    <p style="text-align: center;">Uncompleted Deliveries</p>
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
                $worker_name = $_SESSION['w_name'];
                $sql = "SELECT  * FROM assigned_deliveries WHERE worker_name = '$name' AND status='uncompleted'";
                $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_array($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row['b_name']; ?></td>
                        <td><?php echo $row['p_name']; ?></td>
                        <td><?php echo $row['q_purchased']; ?></td>
                        <td><?php echo $row['t_amount']; ?></td>
                        <td><?php echo $row['pickup']; ?></td>
                        <td><?php echo $row['p_method']; ?></td>
                        <td><?php echo $row['date_added']; ?></td>





                    </tr>

                    <?php
                    $_SESSION['buyer_name'] = $row['b_name'];

                    $_SESSION['qty'] =  $row['q_purchased'];
                    $_SESSION['pname'] =  $row['p_name'];



                $sql = mysqli_query($con, "SELECT SUM(t_amount) as total FROM assigned_deliveries");
                $row = mysqli_fetch_array($sql);
                $sum = $row['total'];


                ?>


                        <?php
                    $_SESSION['total_amount'] = $sum;
                }
                $sum = $_SESSION['total_amount'];
                        ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Amount</td>
                        <td colspan="7">Ksh. <?php echo $sum;?> </td>
                        <td></td>
                    </tr>
                <?php

                }else {
                ?>
                    <tr>
                        <td colspan="7">You do not have uncompleted <deliveries></deliveries></td>
                    </tr>
                <?php
                }
                $pname = $_SESSION['pname'];
                $qty = $_SESSION['qty'];
                ?>
            </table>
            <form action="completed.php" method="post">
                <input type="hidden" class="form-control" name="hiddenId">
                <input type="hidden" value="<?php echo $pname; ?>" name="pname">
                <input type="hidden" value="<?php echo $qty; ?>" name="qty">
            <button style="margin-left: 400px;" type="submit" name="btnSubmit" class="btn btn-success">Finish</button>
            </form>

        </div>
        <div class="col-md-1">

        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">

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

?>