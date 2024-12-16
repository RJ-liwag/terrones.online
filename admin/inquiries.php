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

</head>
<style>
	table.dataTable th.dt-type-numeric,
	table.dataTable th.dt-type-date,
	table.dataTable td.dt-type-numeric,
	table.dataTable td.dt-type-date {
		text-align: left;
	}
</style>

<body>
	<div class="wrapper">
		<?php include("header.php") ?>
		<?php include("sidebar.php") ?>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<div class="row mb-2">
						<h4 class="col page-title">Inquiries</h4>
						<!-- <div class="col d-flex justify-content-end">
							<button type="button" class="btn btn-success"><i class="la la-plus">&nbsp;
								</i>Add</button>
						</div> -->
					</div>

				</div>


				<div class="container-fluid bg-white py-3">
					<table id="myTable" class="display table">
						<thead class="table-dark">
							<tr>
								<th class="text-white">Inquiry No.</th>
								<th class="text-white">Full Name</th>
								<th class="text-white">Email Address ID</th>
								<th class="text-white">Mobile Number</th>
								<th class="text-white">Subject</th>
								<th class="text-white">Message</th>
								<!-- <th class="text-white">Status</th> -->
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
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
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
<script src="assets/js/custom-script.js"></script>
<script>
	$(function() {
		$("#slider").slider({
			range: "min",
			max: 100,
			value: 40,
		});
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 500,
			values: [75, 300]
		});
	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

<script>
	new DataTable('#myTable', {
		ajax: {
			url: 'functions/inquiries/get-inquiries.php',
			type: 'POST'
		}
	});
</script>

</html>