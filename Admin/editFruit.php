<?php
session_start();
if($_SESSION['admin_name'] == '')
{
    header("location: login.php");
}
include "../includes/dbconnect.php";

if(isset($_POST['update_fruits']))
{
    $pid = $_POST['pid_edit'];
    $fruitName = $_POST['fruitUpdateName'];
    $fruitDesc= $_POST['fruitUpdateDesc'];
    $fruitAmount = $_POST['fruitUpdateAmount'];
    $fruitInitialPrice = $_POST['fruitUpdateInitialPrice'];
    $fruitFinalPrice = $_POST['fruitUpdateFinalPrice'];

    $target_dir = "../assets/products/";
    $target_file = $target_dir . basename($_FILES["fruitUpdateImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fruitUpdateImage"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";

    }

// Check file size
    if ($_FILES["fruitUpdateImage"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fruitUpdateImage"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fruitUpdateImage"]["name"])). " has been uploaded.";

            $sql = "UPDATE `stock` SET `product_name`='$fruitName',`product_image`='$target_file',`product_desc`='$fruitDesc',`product_amount`='$fruitAmount',`product_innitial_price`='$fruitInitialPrice',`product_final_amount`='$fruitFinalPrice' WHERE product_id ='$pid'";
            $result= mysqli_query($con, $sql);
            echo $sql;
            if(!$result)
            {
                echo "An error occurred somewhere";

            }else{

                header("location: ../Admin/fruits.php");
            }
        } else {

            echo "Sorry, there was an error uploading your file.";
        }
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
                        <button class="btn btn-success"><a href="fruits.php" style="text-decoration: none; color: white;">Back to fruits</a></button>
                    </div>
                    <div class="card p-5" style="margin-top: 50px;">
                        <?php
                        if(isset($_GET['pid_edit']))
                        {
                            include "../includes/dbconnect.php";
                            $pid = $_GET['pid_edit'];
                            $sql = "SELECT * FROM stock where product_id ='$pid'";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result))
                            {
                                ?>
                                <form action="editFruit.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Fruit Name</label>
                                        <input type="text" value="<?php echo $row['product_name']; ?>" class="form-control" name="fruitUpdateName" required>
                                    </div>
                                    <input type="hidden" name="pid_edit" value="<?php echo $row['product_id']; ?>">
                                    <div class="form-group">
                                        <label for="name">Fruit Image</label>
                                        <input type="file" class="form-control" name="fruitUpdateImage" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <textarea name="fruitUpdateDesc" value="<?php echo $row['product_desc']; ?>" class="form-control" cols="30" rows="5"><?php echo $row['product_desc']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Amount</label>
                                        <input type="text" value="<?php echo $row['product_amount']; ?>" class="form-control" name="fruitUpdateAmount" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Initial Price</label>
                                        <input type="currency" value="<?php echo $row['product_innitial_price']; ?>" class="form-control" name="fruitUpdateInitialPrice" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Final Price</label>
                                        <input type="currency" value="<?php echo $row['product_final_amount']; ?>" class="form-control" name="fruitUpdateFinalPrice" required>
                                    </div>
                                    <button type="submit" name="update_fruits" class="btn btn-primary mb-2">Update</button>
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