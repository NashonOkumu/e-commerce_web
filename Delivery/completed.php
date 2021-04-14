
<?php
session_start();
include "../includes/dbconnect.php";
if($_SESSION['w_name'] == '')
{
    header("location: login.php");
}
$name = $_SESSION['w_name'];
$userid = $_SESSION['user_id'];
if(isset($_POST['hiddenId']))
{
    $wid = $_SESSION['w_id'];
    $bname = $_SESSION['buyer_name'];
    $pname = $_POST['pname'];
    $qty = $_POST['qty'];



    $sql = "UPDATE `assigned_deliveries` SET `status`='Completed' WHERE worker_id = '$wid' and b_name = '$bname'";
    $result= mysqli_query($con, $sql);
    $sql ="DELETE FROM pending_deliveries WHERE buyers_name = '$bname'";
    $sql = "SELECT product_amount FROM stock WHERE product_name = 'pname'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)){
        $quantity_one = $row['product_amount'] ;
        echo $quantity_one;
        echo $qty;
        echo "heuif ewho";
        $total = $quantity_one - $qty;
        $_SESSION['total'] = $total;
    }
    $qty = 2;
    $sql = "UPDATE stock SET 'product_name' = '$qty'";
    $result = mysqli_query($con, $sql);

    mysqli_query($con, $sql);

}
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
    <p style="text-align: center;">completed Deliveries</p>
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <table class="table">
                <tr>
                    <th>Worker Name</th>
                    <th>Buyer's Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Location</th>
                    <th>Payment Method</th>

                </tr>
                <?php
                $wid = $_SESSION['w_id'];
                $sql = "SELECT * FROM `assigned_deliveries` WHERE worker_id = '$wid' AND status = 'completed'";
                $result = mysqli_query($con, $sql) or die( mysqli_error($con));;
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($con));
                    exit();
                }
                if(mysqli_num_rows($result)){
                while ($row = mysqli_fetch_array($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row['worker_name']; ?></td>
                        <td><?php echo $row['b_name']; ?></td>
                        <td><?php echo $row['p_name']; ?></td>
                        <td><?php echo $row['q_purchased']; ?></td>
                        <td><?php echo $row['t_amount']; ?></td>
                        <td><?php echo $row['pickup']; ?></td>
                        <td><?php echo $row['p_method']; ?></td>





                    </tr>

                 <?php
                }
                $sql = mysqli_query($con, "SELECT SUM(t_amount) as total FROM assigned_deliveries");
                $row = mysqli_fetch_array($sql);
                $sum = $row['total'];

                $_SESSION['total_amount'] = $sum;

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
                    <td colspan="7">No Completed Deliveries</td>
                </tr>
                <?php
                }
                ?>
            </table>

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