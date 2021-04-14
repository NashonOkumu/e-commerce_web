<?php
include '../includes/dbconnect.php';
$error = "";
if(isset($_POST['btnLogin']))
{
    $workerName = $_POST['workernameLogin'];
    $password = $_POST['passwordLogin'];
    $pass = md5($password);

    //check if user exists
    $sql = "SELECT * FROM delivery_workers WHERE w_name = '$workerName' AND w_password = '$pass'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) < 1)
    {
        $error = "User does not exist";
    }
    else{
        $sql = "SELECT * FROM delivery_workers WHERE w_name = '$workerName' AND w_password = '$pass'";
        $result = mysqli_query($con, $sql);
        if(!$result){
            $error = "An error occurred while logging in";
        }else {
            session_start();
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['w_id'] = $row['w_id'];
                $_SESSION['w_name'] = $row['w_name'];
                $_SESSION['w_mobile'] = $row['w_mobile'];
                $_SESSION['w_location'] = $row['w_location'];


            }

            header('location: index.php');
        }

    }



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
                        <input type="text" name="workernameLogin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input type="password" name="passwordLogin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" name="btnLogin" type="submit">Login</button>
                        <br>

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