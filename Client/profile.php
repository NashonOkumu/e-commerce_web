
<?php
session_start();
if($_SESSION['username'] == '')
{
    header("location: login.php");
}

include "../includes/dbconnect.php";
$error = $success = "";
if (isset($_POST['btnUpdate'])) {

    $fname = $_POST['fNameUpdate'];
    $lname = $_POST['lNameUpdate'];
    $username = $_POST['usernameUpdate'];
    $email = $_POST['emailUpdate'];
    $pass = $_POST['passwordUpdate'];
    $passConfirm = $_POST['passwordConfirmUpdate'];

    //check if user exists using email and username
    $sql1 = "SELECT * FROM users WHERE email = '$email'";
    $sql2 = "SELECT * FROM users WHERE username = '$username'";

    $result1 = mysqli_query($con, $sql1);
    $result2 = mysqli_query($con, $sql2);

    if(mysqli_num_rows($result1) > 0){
        $error = "Sorry Email is already taken";

    }else if(mysqli_num_rows($result2))
    {
        $error = "Sorry the username is already taken";
    }else if (strcmp($pass, $passConfirm) !== 0) {
        $error ="The two passwords do not match";
    }else if($fname == ''|| $lname == '' || $username == '' || $email == '' || $pass == ''|| $passConfirm == '')
    {
        $error = "Fill all fields";
    }
    else{
        $password =md5($pass);
        $uid = $_SESSION['user_id'];
        $sql = "UPDATE `users` SET `username`='$username',`first_name`='$fname',`last_name`='$lname',`password`='$password',`email`='$email' WHERE user_id = '$uid'";
        $result = mysqli_query($con, $sql);

         if(!$result)
        {
            $error = "An error occurred somewhere";
        }else{
            $success = "Updated Successfully";
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
                    <li class="nav-item active">
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
    <div style="display: flex;justify-content: center;">

        <img src="../assets/images/icon.png" class="img-fluid" width="10%" alt="Logo">

    </div>
    <p style="text-align: center;">Nashon Groceries</p>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <p style="color: red;"><?php echo $error; ?></p>
            <p style="color: #0f6674;"><?php echo $success; ?></p>

            <div class="card p-5">
                <form action="register.php" method="post">
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_array($result))
                    {

                    ?>
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" value="<?php echo $row['first_name'] ?>" name="fNameUpdate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Lname">Last Name</label>
                        <input type="text" name="lNameUpdate" value="<?php echo $row['last_name'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="usernameUpdate"  value="<?php echo $row['username'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="emailUpdate" value="<?php echo $row['email'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input type="password" name="passwordUpdate"  value="<?php echo $row['password'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Confirm Password</label>
                        <input type="password" name="passwordConfirmUpdate"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" name="btnUpdate" type="submit">Update</button>
                        <br>

                    </div>
                    <?php

                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

</div>
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</html>