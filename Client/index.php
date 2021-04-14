<?php
session_start();
if($_SESSION['username'] == '')
{
    header("location: login.php");
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
                    <li class="nav-item active">
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
    <?php
    include '../includes/dbconnect.php';
    $sql = "SELECT * FROM stock";
    $result = mysqli_query($con, $sql);

    ?>
    <p><br></p>
    <div class="row">
        <?php
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <div class="col-md-3" style="margin-bottom: 30px;">
                <div class="card">
                    <img src="<?php echo $row['product_image'] ?>" style='width:100%;' border="0" style="max-height: 17vw;
    min-height: 17vw; max-width:17vw; min-width: 17vw;" width="300px" height="300px" alt="Fruits" style="padding: 20px;">
                    <h4><?php echo $row['product_name']?></h4>
                    <p><?php echo $row['product_final_amount']?></p>
                    <p><?php echo $row['product_desc']?></p>
                    <button class="btn btn-warning"><a href="fruitdetails.php?pid=<?php echo $row['product_id']; ?>">Purchase</a></button>
                </div>
            </div>

            <?php
        }
        ?>
<p><br></p>
    </div>

</div>
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</html>