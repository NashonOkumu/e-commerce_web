<?php
session_start();
if($_SESSION['admin_name'] == '')
{
    header("location: login.php");
}
include "../includes/dbconnect.php";
if(isset($_GET['pid_delete']))
{
    $pid = $_GET['pid_delete'];
    $sql = "DELETE FROM stock WHERE product_id = '$pid'";
    $result = mysqli_query($con, $sql);
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
                <br>
                <div class="col-md-10"><h4>Fruits</h4></div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addfruit">Add Stock</button>
                </div>
            </div>
            <br>
            <!-- The Modal -->
            <div class="modal" id="addfruit">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Stock</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="../includes/action.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Fruit Name</label>
                                    <input type="text" class="form-control" name="fruitName" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Fruit Image</label>
                                    <input type="file" class="form-control" name="fruitImage" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <textarea name="fruitDesc" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Amount</label>
                                    <input type="text" class="form-control" name="fruitAmount" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Initial Price</label>
                                    <input type="currency" class="form-control" name="fruitInitialPrice" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Final Price</label>
                                    <input type="currency" class="form-control" name="fruitFinalPrice" required>
                                </div>
                                <button type="submit" name="add_fruits" class="btn btn-primary mb-2">Submit</button>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
<!--            end modal-->



            <div class="container-fluid">
                <?php
                include '../includes/dbconnect.php';
                $sql = "SELECT * FROM stock";
                $result = mysqli_query($con, $sql);

                ?>
                <div class="row">
                    <?php
                    while($row = mysqli_fetch_array($result))
                    {
                    ?>
                    <div class="col-md-3" style="margin-bottom: 30px;">
                        <div class="card">
                            <img src="<?php echo $row['product_image'] ?>" style='width:100%;' border="0" style="max-height: 17vw;
    min-height: 17vw; max-width:17vw; min-width: 17vw;" width="300px" height="300px" alt="Fruits" style="padding: 20px;">
                            <p><?php echo $row['product_name']?></p>
                            <button type="button" class="btn btn-info"><a style="text-decoration: none; color: white;" href="viewFruit.php?pid_view=<?php echo $row['product_id']; ?>">View</a></button>
                            <button type="button"  class="btn btn-warning"><a style="text-decoration: none; color: white;" href="editFruit.php?pid_edit=<?php echo $row['product_id']; ?>">Edit</a></button>
                            <button type="button"  class="btn btn-danger"><a style="text-decoration: none; color: white;" href="fruits.php?pid_delete=<?php echo $row['product_id']; ?>">Delete</a></button>
                        </div>

                    </div>
                    <?php
                    }
                    ?>

                </div>


            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    <!--            view modal-->
       <div class="modal" id="hu">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo $row['product_name']; ?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <?php
                        include '../includes/dbconnect.php';
                        if(isset($_GET['pid_view']))
                        {
                        $pid = $_GET['pid_view'];

                        $sql = "SELECT * FROM stock WHERE product_id=$pid";
                        $result = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_array($result))
                        {



                        ?>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <?php



                            ?>
                            <p>Name : <?php echo $row['product_name']; ?></p>
                            <p>Quantity : <?php echo $row['product_amount']; ?></p>
                            <p>Initial Price for Each: <?php echo $row['product_innitial_price']; ?></p>
                            <p>Final Price for Each : <?php echo $row['product_final_amount']; ?></p>
                            <p>Total Price : Ksh. <?php $final_price =$row['product_final_amount']*$row['product_amount']; echo $final_price; ?></p>
                            <p>Description : <?php echo $row['product_desc']; ?></p>
                        </div>
                            <?php
                        }
                        }
                        ?>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>


    <!--            end view modal-->
<!--    edit modal-->
    <div class="modal" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Stock</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <?php
                include '../includes/dbconnect.php';
                if(isset($_GET['pid_view']))
                {
                $pid = $_GET['pid_edit'];

                $sql = "SELECT * FROM stock WHERE product_id=$pid";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($result))
                {



                ?>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="../includes/action.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Fruit Name</label>
                            <input type="text" class="form-control" name="fruitName" value="<?php echo $row['product_name'];  ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Fruit Image</label>
                            <input type="file" class="form-control" name="fruitImage" value="<?php echo $row['product_image'];  ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea name="fruitDesc" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Amount</label>
                            <input type="text" class="form-control" name="fruitAmount" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Initial Price</label>
                            <input type="currency" class="form-control" name="fruitInitialPrice" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Final Price</label>
                            <input type="currency" class="form-control" name="fruitFinalPrice" required>
                        </div>
                        <button type="submit" name="add_fruits" class="btn btn-primary mb-2">Submit</button>
                    </form>
                </div>
                    <?php
                }
                }
                ?>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
<!--    End edit modal-->

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