<?php
session_start();
include "../includes/dbconnect.php";
$user_id = $_SESSION['user_id'];
$sql = "DELETE FROM online_users WHERE user_id = '$user_id'";
$result = mysqli_query($con , $sql);
unset($_SESSION["user_id"]);
unset($_SESSION["username"]);
unset($_SESSION["fname"]);
unset($_SESSION["lname"]);
unset($_SESSION["email"]);
header("Location:login.php");
