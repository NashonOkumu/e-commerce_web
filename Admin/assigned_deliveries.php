
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
            <h4>Assigned Deliveries</h4><br>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>Buyer's Name</th>
                    <th>Delivery</th>
                    <th>Product Name</th>
                    <th>Quantity Purchased</th>
                    <th>Amount</th>
                    <th>Location</th>
                    <th>Payment method</th>

                    </thead>
                    <tbody>
                    <?php
                    include '../includes/dbconnect.php';
                    $sql = "SELECT * FROM assigned_deliveries WHERE status ='uncompleted'";
                    $result = mysqli_query($con, $sql);

                    ?>

                    <?php
                    if(mysqli_num_rows($result)){
                        while($row = mysqli_fetch_array($result))
                        {

                            ?>
                            <tr>
                                <td><?php echo $row['b_name'] ?></td>
                                <td><?php echo $row['worker_name'] ?></td>
                                <td><?php echo $row['p_name'] ?></td>
                                <td><?php echo $row['q_purchased'] ?></td>
                                <td><?php echo $row['t_amount'] ?></td>
                                <td><?php echo $row['pickup'] ?></td>
                                <td><?php echo $row['p_method'] ?></td>

                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="7">There are no assigned deliveries</td>
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
