<?php
session_start();
include "../includes/dbconnect.php";
$user_id = $_SESSION['w_id'];

unset($_SESSION["w_id"]);
unset($_SESSION["w_name"]);
unset($_SESSION["w_mobile"]);
unset($_SESSION["w_location"]);
header("Location:login.php");
