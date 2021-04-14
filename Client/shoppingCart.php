<?php
session_start();
if($_SESSION['username'] == '')
{
    header("location: login.php");
}
include '../includes/dbconnect.php';
if(isset($_GET['sp_id']))
{
    $sp_id = $_GET['sp_id'];
    $sql = "DELETE FROM `shopping_cart` WHERE sc_id = '$sp_id'";
    mysqli_query($con, $sql);
}
?>
<html>
<head>
    <title>Login To Nashon's Grocery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="An e-commerce web for Groceries">
    <meta name="author" content="Nashon Okumu">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/app.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="../assets/images/icon.png" class="d-inline-block align-top" width="50px" alt="Logo"><br>
        <a class="navbar-brand" href="#">Nashon's Grocery</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php"><i class="fa fa-home"></i>Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><i class="fa fa-user"></i>My Profile</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="shoppingCart.php"><i class="fa fa-shopping-cart"></i>Shopping Cart</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-user"></i>Welcome <?php echo $_SESSION['username'] ?>></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i>log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    include '../includes/dbconnect.php';
    $bid = $_SESSION['user_id'];
    $sql = "SELECT sc_id, product_name, quantity, product_final_amount, total_price FROM shopping_cart t1 INNER JOIN stock t2 ON t1.product_id = t2.product_id AND t1.buyer_id  ='$bid'";
    $result = mysqli_query($con, $sql);

    ?>
    <p><br></p>
    <table class="table table-striped">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total Price</th>
            <th>Action</th>
            <th>Action</th>

        </tr>

            <?php
            if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result))
            {

            ?>
        <tr>
            <td><?php echo $row['product_name'] ?></td>
            <td><?php echo $row['quantity'] ?></td>
            <td><?php echo $row['product_final_amount'] ?></td>
            <td><?php echo $row['total_price'] ?></td>
            <td><button class="btn btn-primary"><a style="color: white; text-decoration: none;" href="editShoppingCart.php?sp_id=<?php echo $row['sc_id']; ?>">Edit</a></button></td>
                <td><button class="btn btn-danger"><a style="color: white; text-decoration: none;" href="shoppingCart.php?sp_id=<?php echo $row['sc_id']; ?>">Delete</a></button></td>
        </tr>

                <?php
            }
            $sql = mysqli_query($con,"SELECT SUM(total_price) as total FROM shopping_cart");
            $row = mysqli_fetch_array($sql);
            $sum = $row['total'];

            $_SESSION['total_amount'] = $sum;
            ?>



        <tr>
            <td></td>
            <td></td>
            <td>Total Amount</td>
            <td colspan="4">Ksh. <?php echo $sum;?> <button class="btn btn-success"><a style="color: white; text-decoration: none;" href="checkout.php">Checkout</a></button></td>
            <?php
            $sql= "SELECT product_name FROM shopping_cart t1 INNER JOIN stock t2 ON t1.product_id = t2.product_id AND t1.buyer_id ='$bid'  ";
            $results = mysqli_query($con, $sql);




            ?>
            <td></td>
            <?php

            }
            else{
                ?>

            <td colspan="6">Your shopping cart is empty</td>

            <?php
            }
            ?>
        </tr>

    </table>


</div>
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</html>