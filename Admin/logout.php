<?php
session_start();
include "../includes/dbconnect.php";


unset($_SESSION["admin_id"]);
unset($_SESSION["admin_name"]);
unset($_SESSION["admin_name"]);
header("Location:login.php");
