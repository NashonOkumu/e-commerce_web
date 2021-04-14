
<?php
session_start();
include "../includes/dbconnect.php";
if($_SESSION['w_name'] == '')
{
    header("location: login.php");
}
$name = $_SESSION['w_name'];
if(isset($_POST["clientName"]))
{
    $user_id = $_POST['clientName'];
    $_SESSION['user_id'] = $user_id;
    header("location: orderslist.php");

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
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div style="display: flex;justify-content: center;">

                <img src="../assets/images/icon.png" class="img-fluid" width="10%" alt="Logo">

            </div>
            <p style="text-align: center;">Nashon Groceries</p>
        </div>
        <div class="col-md-4" style="margin-top: 4%;width: 100%; display: flex; flex-direction: row; justify-content: center;">
            <span><p>Logged in as <b><?php echo $name;?></b></p> </span>
            <span style="margin-left: 50px;"><button class="btn btn-primary"><a style="color: white; text-decoration: none;" href="index.php">Home</a></button></span>
            <span style="margin-left: 50px;"><button class="btn btn-success"><a style="color: white; text-decoration: none;" href="logout.php">Log out</a></button></span>
        </div>
    </div>
    <br><p></p><br>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
            <?php
                $sql = "SELECT user_id, username FROM users t1 INNER JOIN pending_deliveries t2 ON t1.user_id = t2.buyers_id LIMIT 1 ";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result))
                {
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    ?>
                    <form action="orders.php" method="post">
                        <div class="form-group">
                            <label for="">Select Client</label>
                            <select class="form-control" name="clientName">
                                <option value="<?php echo $user_id;?>"><?php echo $username;?></option>
                            </select>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Next</button>
                            </div>

                        </div>
                    </form>
            <?php
                }
            ?>
        </div>
        <div class="col-md-4">

        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</html>