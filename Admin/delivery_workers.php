<?php
session_start();
if($_SESSION['admin_name'] == '')
{
    header("location: login.php");
}
include "../includes/dbconnect.php";
if(isset($_GET['wid_delete']))
{
    $wid = $_GET['wid_delete'];
    $sql = "DELETE FROM delivery_workers WHERE w_id = '$wid'";
    $result = mysqli_query($con, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="An e-commerce web for Groceries">
    <meta name="author" content="Nashon Okumu">

    <title>Nashon's Grocery</title>


    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/app.css" rel="stylesheet">

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
            <h4>Workers</h4><br>
            <div align="right"><button class="btn btn-success" data-toggle="modal" data-target="#updatefruit">Add Worker</button></div>
            <!-- The Modal -->
            <div class="modal" id="updatefruit">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Worker</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="../includes/action.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Worker Name</label>
                                    <input type="text" class="form-control" name="w_name" required>
                                </div>


                                <div class="form-group">
                                    <label for="name">Worker Mobile</label>
                                    <input type="text" class="form-control" name="w_mobile" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Worker Location</label>
                                    <input type="text" class="form-control" name="w_location" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Worker Password</label>
                                    <input type="password" class="form-control" name="w_password" required>
                                </div>
                                <button type="submit" name="add_workers" class="btn btn-primary mb-2">Submit</button>
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
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Action Edit</th>
                    <th>Action Delete</th>
                    </thead>
                    <tbody>
                    <?php
                    include '../includes/dbconnect.php';
                    $sql = "SELECT * FROM delivery_workers";
                    $result = mysqli_query($con, $sql);

                    ?>

                    <?php
                    while($row = mysqli_fetch_array($result))
                    {

                        ?>
                        <tr>
                            <td><?php echo $row['w_name'] ?></td>
                            <td><?php echo $row['w_mobile'] ?></td>
                            <td><?php echo $row['w_location'] ?></td>
                            <td><?php echo $row['w_date'] ?></td>
                            <td><a style="text-decoration: none; color: white;" href="editWorkers.php?wid_edit=<?php echo $row['w_id']; ?>"><button class="btn btn-primary">Edit</button></a></td>
                            <td><a style="text-decoration: none; color: white;" href="delivery_workers.php?wid_delete=<?php echo $row['w_id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

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
</script>

</body>

</html>