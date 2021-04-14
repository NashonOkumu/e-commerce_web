
<?php
session_start();
if($_SESSION['username'] == '')
{
    header("location: login.php");
}
$error ="";
include '../includes/dbconnect.php';
if(isset($_POST['btnSubmit'])) {
    if (isset($_POST['location']) and !isset($_POST['method'])) {
        $error = "Please fill in all the fields";
    } else {

        include '../includes/dbconnect.php';

        $bid = $_SESSION['user_id'];
        $total_price = $_SESSION['total_amount'];
        $method = $_POST['method'];
        $location = $_POST['location'];
        $username = $_SESSION['username'];

        $sql = "SELECT product_name, quantity,  total_price FROM shopping_cart t1 INNER JOIN stock t2 ON t1.product_id = t2.product_id AND t1.buyer_id ='$bid'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $error = "Something went wrong while";
        }

        $total = mysqli_num_rows($result);
        $array = mysqli_fetch_all($result);
        $data = array();
        foreach ($array as $row) {
            $name = mysqli_real_escape_string($con, $row[0]);
            $price = mysqli_real_escape_string($con, $row[2]);
            $quantity = mysqli_real_escape_string($con, $row[1]);
            $sql = "INSERT INTO `pending_deliveries`(`delivery_id`, `buyers_id` , `buyers_name`, `product_name`, `quantity_purchased`, `amount`, `location`,`payment_method`, `date_created`) 
                VALUES (NULL ,'$bid','$username','$name','$quantity','$price','$location', '$method',NOW())";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                $error = "Something went wrong";
            }else{
                $sql = "DELETE FROM `shopping_cart` WHERE buyer_id = '$bid'";
                $result = mysqli_query($con, $sql);
                header("location: index.php");
            }


        }





    }
    function convert_multi_array($arrays)
    {
        $imploded = array();
        foreach ($arrays as $array) {
            $imploded[] = implode('~', $array);
        }
        return implode(",", $imploded);
    }
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
                    <li class="nav-item ">
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
    <br><p><br></p><br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="text">
                <p>You now need to choose a payment method once your products are delivered by our agents.
                    You also need to choose the location where you will meet with him. You are expected to
                    pay Ksh. <?php echo $_SESSION['total_amount'];?> on delivery.</p>
            </div>
            <p>Choose a payment method and location below</p>
            <div class="card p-5">
                <p style="color: red;"><?php echo $error; ?></p>
                <form action="checkout.php" method="post">
                    <div class="form-group">
                        <input type="radio" name="method" value="cash">
                        <label for="">Cash Payment on delivery</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="method" value="Mpesa">
                        <label for="">Lipa na Mpesa Payment on delivery</label>
                    </div>
                    <div class="form-group">
                        <label for="select">Select a location:</label>
                        <select name="location" >
                            <option value="Nairobi Archives">Nairobi Archives</option>
                            <option value="Westlands Safaricom">Westlands Safaricom</option>
                            <option value="Westlands oracle building">Westlands oracle building</option>
                            <option value="Wetlands- Sarit Center">Wetlands- Sarit Center</option>
                            <option value="Parklands - Mpisha Hospital">Parklands - Mpisha Hospital</option>
                        </select>

                    </div>
                    <button class="btn btn-primary" name="btnSubmit" type="submit">Submit</button>
                </form>
            </div>

        </div>
        <div class="col-md-2"></div>
    </div>


</div>
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</html>