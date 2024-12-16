<?php include("../conn.php");


session_start();

if (isset($_SESSION['username'])) {
    $admin_username = $_SESSION['username'];
    $admin_id = $_SESSION['id'];
} else {
    header("Location: login.php");
    exit();
}
?>
<?php include 'get-reservations.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" href="../assets/img/TerrenesLogo.png" />
    <title>Terrones Resort</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet"
        href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">

    <!-- Include only one version of jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
</head>


<body>
    <div class="wrapper">
        <?php include("header.php") ?>
        <?php include("sidebar.php") ?>

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <h4 class="col page-title">Reservations</h4>
                    </div>
           
                    <div class="row">
                        <div class="col-md-6 mb-2 stretch-card rounded transparent">
                            <div class="card card-tale text-white bg-primary rounded">
                                <div class="card-body">
                                    <p class="mb-4">Today’s Reservations</p>
                                    <p class="h2 mb-2">
                                        <?php echo $count ?>
                                    </p>
                                    <p> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 stretch-card transparent">
                            <div class="card text-white bg-warning rounded">
                                <div class="card-body">
                                    <p class="mb-4">Total Bookings</p>
                                    <p class="h2 mb-2">
                                       <?php echo $total_booking_count; ?>
                                    </p>
                                    <p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body bg-secondary text-light rounded">
                                    <p class="mb-4">Today's Guests</p>
                                    <p class="h2 mb-4">
                                        <?php echo $totalPax ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  mb-lg-0 stretch-card transparent">
                            <div class="row">
                                <div class="col-md-4 rounded stretch-card transparent">
                                    <div class="card  rounded">
                                        <div class="card-body">
                                            <p class="mb-4">Pending </p>
                                            <p class="h2 mb-2 mt-2">
                                                <?php echo $pending_counts ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4  stretch-card transparent">
                                    <div class="card bg-danger text-light  rounded">
                                        <div class="card-body">
                                            <p class="mb-4">Not Approved</p>
                                            <p class="h2 mb-2">
                                                <?php echo $cancelled_counts ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4  stretch-card transparent">
                                    <div class="card  bg-success text-light rounded">
                                        <div class="card-body">
                                            <p class="mb-4">Approved</p>
                                            <p class="h2 mb-2">
                                                <?php echo $confirmed_counts ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid bg-white py-3">
                    <h5 class="mt-3">Reservation Today</h5>
                    <table id="myTable" class="display table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-white">Reference No</th>
                                <th class="text-white">Facility ID</th>
                                <th class="text-white">Full Name</th>
                                <th class="text-white">Address</th>
                                <th class="text-white">Email Address</th>
                                <th class="text-white">Phone Number</th>
                                <th class="text-white">Tour Type</th>
                                <th class="text-white">No. of Pax</th>
                                <th class="text-white">Type</th>
                                <th class="text-white">Status</th>
                                <th class="text-white">Reservation Date</th>
                                <th class="text-white">Created Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<!-- <script src="assets/js/demo.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script src="assets/js/custom-script.js"></script>

<script>
    new DataTable('#myTable', {
        ajax: {
            url: 'functions/index/get-reservation-today.php',
            type: 'POST'
        }
    });
</script>

</html>