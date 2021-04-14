<?php
session_start();
if($_SESSION['username'] == '')
{
    header("location: login.php");
}
$error ="";
include "../includes/dbconnect.php";
$pid = $_GET['pid'];
$sqlFruit = "SELECT * FROM stock WHERE product_id = '$pid'";
$result = mysqli_query($con, $sqlFruit);
if(isset($_POST["product_id"]))
{

    if($_POST["sp_quantity"] =="" AND $_POST['sp_price'] ==""){
        $error = "You have not entered the quantity needed";
    }else{
        $buyer_id = $_POST['buyer_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['sp_quantity'];
        $price = $_POST['sp_price'];

        $sql = "INSERT INTO `shopping_cart`(`sc_id`, `buyer_id`, `product_id`, `quantity`, `total_price`)
                VALUES (NULL,'$buyer_id','$product_id','$quantity','$price')";
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            $error = "Something went wrong";
        }else{
            header("location: index.php");
        }
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
                    <li class="nav-item">
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
    <p><br></p>
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <img src="<?php echo $row['product_image'] ?>"  width="300px" height="300px" alt="Fruits" style="padding: 20px;">


                </div>
            </div>
            <div class="col-md-6">
                <div class="details">
                    <h4><?php echo $row['product_name']?></h4>
                    <p>Ksh. <?php echo $row['product_final_amount']?></p>
                    <p><?php echo $row['product_desc']?></p><br>
                    <input type="hidden" id="finalPrice" value="<?php echo $row['product_final_amount']?>">
                    <input type="hidden" id="stockRemainHidden" value="<?php echo $row['product_amount']?>">
                    <p>Stock Remaining: <input type="number" id="stockRemain" value="<?php echo $row['product_amount'];?>" disabled></p>

                    <?php
                    }
                    ?>
                    <div>
                        <form action="#" class="form">
                            <input type="number" id="amount" placeholder="Enter the amount you need">
                        </form>
                    </div>

                    <p>Total Amount :   Ksh. <input style="width: 100px;" type="number" id="totalAmount" disabled></p>
                    <form action="fruitdetails.php" method="post">
                        <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="buyer_id">
                        <input type="hidden" value="<?php echo $pid; ?>" name="product_id">
                        <input type="hidden" id="quantity" name="sp_quantity">
                        <input type="hidden" id="sp_price" name="sp_price">
                        <button class="btn btn-primary" type="submit">Add to cart</button>
                    </form>
                    <p><?php echo $error;?></p>
                </div>

            </div>
        </div>
    </div>

</div>
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script>

    $("#amount").bind("change paste keyup", function() {

        var stockRemain = $("#stockRemain").val();
        var amount = $("#amount").val();
        var price = $("#finalPrice").val();

        var stockRemainHidden = $("#stockRemainHidden").val();
        $("#stockRemain").val(stockRemainHidden - $(this).val());
        var totalPrice = amount*price;
        $("#totalAmount").val(totalPrice);
        if(parseInt(amount) > parseInt(stockRemain))
        {
            alert("Your requested amount is greater than available amount");
            $("#amount").val(0);
            $("#totalAmount").val(0);
            $("#stockRemain").val(stockRemainHidden);
        }else if(parseInt(amount) < 0){
            alert("You entered an invalid amount");
            $("#amount").val(0);
            $("#totalAmount").val(0);
            $("#stockRemain").val(stockRemainHidden);
        }
        $("#quantity").val(amount);
        $("#sp_price").val(totalPrice);
        
    });
</script>
</html>