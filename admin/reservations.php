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
	<link rel="stylesheet" href="assets/css/custom-css.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
</head>
<style>
	#loading-overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(255, 255, 255, 0.7);
		z-index: 9999;
	}
</style>
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
						<h4 class="col page-title">Reservations</h4>
						<span class="form-text col-md-1">Filter by Status</span>
						<select id="status-filter" class="form-control col-md-1">
							<option value="">All</option>
							<option value="Approved">Approved</option>
							<option value="Not Approved">Not Approved</option>
							<option value="Pending">Pending</option>
						</select>
					</div>
				</div>
				<div class="container-fluid bg-white py-3">
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
								<th class="text-white">Type</th>
								<th class="text-white">Status</th>
								<th class="text-white">Reservation Date</th>
								<th class="text-white">Created Date</th>
								<th class="text-white">Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>

<div id="loading-overlay" style="display: none;">
	<div class="spinner-border text-primary"
		style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" role="status">
		<span class="visually-hidden">Loading...</span>
	</div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
	$(function () {
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
	$(document).ready(function () {
		var table = new DataTable('#myTable', {
			ajax: {
				url: 'functions/index/get-all-reservation.php',
				type: 'POST',
				data: function (d) {
					d.statusFilter = $('#status-filter').val();
				}
			}
		});

		$('#status-filter').on('change', function () {
			$('#loading-overlay').show();
			table.ajax.reload(function () {
				$('#loading-overlay').hide();
			});
		});

		$(document).on('click', '.btn_confirm', function () {
			var data_id = $(this).attr("data-id");
			var data_email = $(this).attr("data-email");

			Swal.fire({
				title: 'Confirm Reservation',
				text: 'Are you sure you want to confirm this booking?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Confirm',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					// Show loading alert
					Swal.fire({
						title: 'Processing...',
						text: 'Please wait while we confirm the reservation.',
						allowOutsideClick: false,
						allowEscapeKey: false,
						didOpen: () => {
							Swal.showLoading();
						}
					});

					$.ajax({
						url: 'confirm-reservation.php',
						data: {
							data_id: data_id,
							data_email: data_email
						},
						type: 'POST',
						success: function (response) {
							// Close the loading alert
							Swal.close();

							if (response.trim() === 'success') {
								Swal.fire({
									icon: 'success',
									title: 'Reservation Successful',
									text: 'Booking confirmed successfully.',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.reload();
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Reservation Failed',
									text: 'Error confirming booking. Please try again.',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.reload();
								});
							}
						},
						error: function (xhr, status, error) {
							// Close the loading alert
							Swal.close();

							Swal.fire({
								icon: 'error',
								title: 'Reservation Failed',
								text: 'Error confirming booking. Please try again.',
								confirmButtonText: 'OK'
							}).then(() => {
								window.location.reload();
							});
						}
					});
				}
			});
		});
		$(document).on('click', '.btn_cancel', function () {
			var data_id = $(this).attr("data-id");
			var data_email = $(this).attr("data-email");

			Swal.fire({
				title: 'Cancel Reservation',
				text: 'Are you sure you want to cancel this booking?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Confirm',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					// Show loading alert
					Swal.fire({
						title: 'Processing...',
						text: 'Please wait while we process the cancellation.',
						allowOutsideClick: false,
						allowEscapeKey: false,
						didOpen: () => {
							Swal.showLoading();
						}
					});

					$.ajax({
						url: 'cancel-reservation.php',
						data: {
							data_id: data_id,
							data_email: data_email
						},
						type: 'POST',
						success: function (response) {
							// Close the loading alert
							Swal.close();

							if (response.trim() === 'success') {
								Swal.fire({
									icon: 'success',
									title: 'Cancellation Successful',
									text: 'Booking has been canceled successfully.',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.reload();
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Cancellation Failed',
									text: 'Error canceling the booking. Please try again.',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.reload();
								});
							}
						},
						error: function (xhr, status, error) {
							// Close the loading alert
							Swal.close();

							Swal.fire({
								icon: 'error',
								title: 'Cancellation Failed',
								text: 'Error canceling the booking. Please try again.',
								confirmButtonText: 'OK'
							}).then(() => {
								window.location.reload();
							});
						}
					});
				}
			});
		});



	});
</script>

</html>