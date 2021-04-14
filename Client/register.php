<?php

include "../includes/dbconnect.php";
$error  = $success = "";
if (isset($_POST['btnRegister'])) {

    $fname = $_POST['fNameRegister'];
    $lname = $_POST['lNameRegister'];
    $username = $_POST['usernameRegister'];
    $email = $_POST['emailRegister'];
    $pass = $_POST['passwordRegister'];
    $passConfirm = $_POST['passwordConfirmRegister'];

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
    }
    else if($fname == ''|| $lname == '' || $username == '' || $email == '' || $pass == '' || $pass == ''|| $passConfirm == '')
    {
        $error = "Fill all fields";
    }
    else{
        $password = md5($pass);
        $sqlInsert = "INSERT INTO `users`(`user_id`, `username`, `first_name`, `last_name`, `password`, `email`, `date_created`)
 VALUES (NULL,'$username','$fname','$lname','$password','$email', NOW())";
        $result = mysqli_query($con, $sqlInsert);
        if(!$result)
        {
            $error = "An error occurred somewhere";
        }else{
            $success = "Registered Successfully";
            header("location: login.php");
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
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" name="fNameRegister" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Lname">Last Name</label>
                        <input type="text" name="lNameRegister" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="usernameRegister" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="emailRegister" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input type="password" name="passwordRegister" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Confirm Password</label>
                        <input type="password" name="passwordConfirmRegister" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" name="btnRegister" type="submit">Register</button>
                        <br>
                        <p><a href="login.php">Already have an Account? Login</a></p>
                    </div>
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