<?php
include 'dbconnect.php';
if(isset($_POST['add_fruits']))
{
    $fruitName = $_POST['fruitName'];
    $fruitDesc= $_POST['fruitDesc'];
    $fruitAmount = $_POST['fruitAmount'];
    $fruitInitialPrice = $_POST['fruitInitialPrice'];
    $fruitFinalPrice = $_POST['fruitFinalPrice'];

    $target_dir = "../assets/products/";
    $target_file = $target_dir . basename($_FILES["fruitImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fruitImage"]["tmp_name"]);
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
    if ($_FILES["fruitImage"]["size"] > 5000000) {
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
        if (move_uploaded_file($_FILES["fruitImage"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fruitImage"]["name"])). " has been uploaded.";

            $sql = "INSERT INTO `stock`(`product_id`, `product_name`, `product_image`, `product_desc`, `product_amount`, `product_innitial_price`, `product_final_amount`, `date_added`) 
                    VALUES (NULL,'$fruitName','$target_file','$fruitDesc','$fruitAmount','$fruitInitialPrice','$fruitFinalPrice',NOW())";
            $result= mysqli_query($con, $sql);
            if(!$result)
            {
                echo "An error occurred somewhere";
                echo $sql;
            }else{
                header("location: ../Admin/fruits.php");
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


}
if(isset($_POST['add_workers']))
{
    $name = $_POST['w_name'];
    $mobile = $_POST['w_mobile'];
    $location = $_POST['w_location'];
    $password = $_POST['w_password'];
    $pass =  md5($password);
    $sql = "INSERT INTO `delivery_workers`(`w_id`, `w_name`, `w_mobile`, `w_location`, `w_password`, `w_date`) 
VALUES (NULL,'$name','$mobile','$location','$pass',NOW())";
    $result = mysqli_query($con, $sql);
    header("location: ../Admin/delivery_workers.php");
}

