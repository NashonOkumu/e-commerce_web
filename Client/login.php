<?php
include '../includes/dbconnect.php';
$error = "";
if(isset($_POST['btnLogin']))
{
    $username = $_POST['usernameLogin'];
    $password = $_POST['passwordLogin'];
    $pass = md5($password);
    //check if user exists
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$pass'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) < 1)
    {
        $error = "User does not exist";
    }
    else{
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$pass'";
        $result = mysqli_query($con, $sql);
        if(!$result){
           $error = "An error occurred while logging in";
        }else {
            session_start();
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['fname'] = $row['first_name'];
                $_SESSION['lname'] = $row['last_name'];
                $_SESSION['email'] = $row['email'];

            }
            $user_id = $_SESSION['user_id'];
            $fname =  $_SESSION['fname'];
            $lname =  $_SESSION['lname'];
            $username = $_SESSION['username'];
            $email = $_SESSION['email'];

            $sqlOnline = "INSERT INTO `online_users`(`user_id`, `first_name`, `last_name`, `username`,  `email`, `date_online`)
 VALUES ('$user_id','$fname','$lname','$username','$email',NOW())";
            $result = mysqli_query($con, $sqlOnline);
            if(!$result){
                $error = "AN error occurred";
            }
            header('location: index.php');
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
    <p><br></p>
    <div style="display: flex;justify-content: center;">

        <img src="../assets/images/icon.png" class="img-fluid" width="10%" alt="Logo">

    </div>
    <p style="text-align: center;">Nashon Groceries</p>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <p style="color: red;"><?php echo $error; ?></p>
            <div class="card p-5">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="usernameLogin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input type="password" name="passwordLogin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" name="btnLogin" type="submit">Login</button>
                        <br>
                        <p><a href="emailconfirm.php">Forgot Password?</a></p>
                        <p><a href="register.php">Create a new Account</a></p>
                        <p><a href="../home.html">Home</a></p>
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