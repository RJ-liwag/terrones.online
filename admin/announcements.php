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

	#myTable {
		border-collapse: collapse;
	}

	#myTable th,
	#myTable td {
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
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
						<h4 class="col page-title">Announcements</h4>
						<div class="col d-flex justify-content-end">
							<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="la la-plus">&nbsp;
								</i>Add</button>
						</div>
					</div>

				</div>


				<div class="container-fluid bg-white py-3">
					<table id="myTable" class="display table table-bordered" style="width: 100%; table-layout: fixed;">
						<thead class="table-dark">
							<tr>
								<th class="text-white" style="width: 15%;">Announcement No.</th>
								<th class="text-white" style="width: 25%;">Title</th>
								<th class="text-white" style="width: 40%;">Content</th>
								<th class="text-white" style="width: 10%;">Date Posted</th>
								<th class="text-white" style="width: 10%;">Expiry Date</th>
							</tr>
						</thead>
					</table>
				</div>

			</div>

		</div>
	</div>
	</div>


	<!-- Announcement Modal -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Add Announcement</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row mx-3">
						<label class="form-text">Title</label>
						<input type="text" class="form-control" id="announcement_title">
					</div>
					<div class="row mx-3">
						<label class="form-text">Content</label>
						<textarea class="form-control" id="announcement_content"></textarea>
					</div>
					<div class="row mx-3">
						<label class="form-text">Date</label>
						<input type="date" class="form-control" id="announcement_posted_date">
					</div>
					<div class="row mx-3">
						<label class="form-text">Expiry Date</label>
						<input type="date" class="form-control" id="announcement_expiry_date">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="add_announcement">Add</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>



</body>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
			url: 'functions/inquiries/get-announcements.php',
			type: 'POST'
		}
	});
</script>
<script>
	$(document).ready(function() {
		$('#reservationTable').DataTable({
			responsive: true
		});
	});
</script>

</html>

<script>
	// When the "Add" button is clicked
	$('#add_announcement').click(function() {
		const title = $('#announcement_title').val();
		const content = $('#announcement_content').val();
		const expiryDate = $('#announcement_expiry_date').val();
		const datePosted = $('#announcement_posted_date').val();

		// Perform validation
		if (title && content && expiryDate) {
			// Use SweetAlert for confirmation
			Swal.fire({
				title: 'Are you sure?',
				text: "You are about to add a new announcement!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, Add it!',
				cancelButtonText: 'No, cancel!',
			}).then((result) => {
				if (result.isConfirmed) {
					// Make the AJAX request to insert the data
					$.ajax({
						url: 'add-announcement.php', // PHP script to handle the database insertion
						type: 'POST',
						data: {
							title: title,
							content: content,
							expiry_date: expiryDate,
							date_posted: datePosted
						},
						success: function(response) {
							if (response === 'success') {
								// Close the modal
								$('#staticBackdrop').modal('hide');
								// Reload the page to show the new announcement
								location.reload();
							} else {
								Swal.fire('Error', 'There was an issue adding the announcement.', 'error');
							}
						}
					});
				}
			});
		} else {
			Swal.fire('Error', 'Please fill in all fields!', 'error');
		}
	});
</script>