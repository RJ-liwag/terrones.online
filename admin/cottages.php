<?php include("../conn.php");

include "functions/cottages/get-cottages.php";
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
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
</head>

<body>
	<div class="wrapper">
		<?php include("header.php") ?>
		<?php include("sidebar.php") ?>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<div class="row mb-2">
						<h4 class="col page-title">Cottages</h4>
						<div class="col d-flex justify-content-end">
							<!-- <form class="d-flex mr-3">
								<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
								<button class="btn btn-outline-success" type="submit">Search</button>
							</form> -->
							<button type="button" class="btn btn-success" data-toggle="modal"
								data-target="#roomModal"><i class="la la-plus">&nbsp;
								</i>Add</button>

						</div>
					</div>
					<div class="row">

						<?php do { ?>



							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<dix class="row">
											<div class="col container">
												<div class="row">
													<input type="hidden" value="<?php echo $row['room_id']; ?>" id="room_id"
														name="room_id">
													<div class="col-sm-2">
														<img class="img-thumbnail"
															src="assets/rooms-cottages/<?php echo $row['room_img'] ?>"
															alt="">
													</div>
													<div class="col-sm-10">
														<div class="row">
															<div class="col-12 col-sm-12">
																<h4 class="card-title"><?php echo $row["room_name"] ?></h4>
																<p class="card-category text-break">
																	<?php echo $row["description"] ?>
																</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-4 d-flex align-items-end flex-column">
												<div>
													<button class="btn btn-danger delete_room_btn"
														data-id="<?php echo $row['room_id']; ?>">
														<i class="fa-solid fa-ban"></i>
													</button>

													<button class="btn btn-warning"
														onclick="open_modal_user_view(<?php echo $row['room_id'] ?>)"><i
															class="la la-pencil-square-o"></i></button>
												</div>
											</div>
										</dix>
									</div>
									<div class="card-body">
										<p class="demo mb-0">
											<button class="btn btn-primary">₱
												<span><?php echo $row["price"] ?></span></button>
											<button class="btn btn-secondary">Max Capacity:
												<span><?php echo $row["max_capacity"] ?></span></button>

											<button class="btn btn-success"><?php echo $row["status"] ?></button>
										</p>
									</div>
								</div>
							</div>

						<?php } while ($row = $rooms_query->fetch_array()) ?>

					</div>
				</div>
			</div>
		</div>

	</div>
	</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="exampleModalLabel">Add Cottage</h6>
					<!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> -->
				</div>
				<div class="modal-body">
					<div>
						<div class="mb-2 d-flex justify-content-center">
							<img id="selectedImage" src="https://jjgf.com/images/defaultx2.jpg"
								alt="example placeholder" style="width: 200px;" />
						</div>
						<div class="d-flex justify-content-center">
							<div data-mdb-ripple-init class="btn btn-primary btn-rounded">
								<label class="form-label text-white m-1" for="room_img">Choose file</label>
								<input type="file" class="form-control d-none" id="room_img" name="room_img"
									onchange="displaySelectedImage(event, 'selectedImage')" />
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label class="form-label text-dark m-1">Cottage Name</label>
								<input type="text" class="form-control" id="room_name" name="room_name">
							</div>
							<div class="col">
								<label class="form-label text-dark m-1">Price</label>
								<input type="text" class="form-control" id="price" name="price" placeholder="Enter price">

								<script>
									document.getElementById('price').addEventListener('blur', function() {
										let value = parseFloat(this.value);
										if (!isNaN(value)) {
											this.value = value.toFixed(2); 
										} else {
											this.value = '';
										}
									});
								</script>
							</div>
						</div>
						<div class="row" style="width:53%;">
							<div class="col">
								<label class="form-label text-dark m-1">Capacity</label>
								<input type="text" class="form-control" id="max_capacity" name="max_capacity">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label class="form-label text-dark m-1">Description</label>
								<textarea type="text" class="form-control" id="description"
									name="description"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary btn_room_add">Add</button>
				</div>
			</div>
		</div>
	</div>

	<div id="user-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-white" id="standard-modalLabel">Edit Cottage</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="col-lg-12">
						<div class="card" id="user-edit-body">
							Loading........
							<!-- end card-body-->
						</div>
						<!-- end card-->
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
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

<script>
	function displaySelectedImage(event, elementId) {
		const selectedImage = document.getElementById(elementId);
		const fileInput = event.target;

		if (fileInput.files && fileInput.files[0]) {
			const reader = new FileReader();

			reader.onload = function(e) {
				selectedImage.src = e.target.result;
			};

			reader.readAsDataURL(fileInput.files[0]);
		}
	}
</script>


<!-- /**** DELETE ROOM SCRIPT */ -->
<script>
	$(document).on('click', '.delete_room_btn', function(e) {
		var room_id = $(this).attr('data-id');

		Swal.fire({
			title: 'Are you sure you want to set this cottage inactive?',
			icon: 'question',
			showDenyButton: false,
			showCancelButton: true,
			confirmButtonText: 'Yes',
			confirmButtonColor: '#0b5ed7',
			cancelButtonText: 'No',
			cancelButtonColor: '#bb2d3b',
			customClass: {
				actions: 'my-actions',
				confirmButton: 'order-1',
				cancelButton: 'order-2'
			},
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: 'functions/cottages/delete-cottages.php',
					data: {
						room_id: room_id
					},
					success: function(data) {
						console.log(data);
						$('.loading-ui').hide();
						if (data == "Successful") {
							Swal.fire({
								title: 'Success!',
								text: 'Request has been successfully deleted!',
								icon: 'success',
								confirmButtonText: 'OK'
							}).then(() => {
								window.location.reload();
							});
						} else {
							Swal.fire({
								title: 'Error!',
								text: 'Submission of the request was unsuccessful!',
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}
					}
				});
				// console.log(room_id);
			}
		});
	});
</script>


<!---- ADD COTTAGES SCRIPT --->
<script>
	$(document).on('click', '.btn_room_add', function(e) {
		e.preventDefault(); // Prevent the default form submission behavior

		// Reset previous validation errors
		$(".error-text").remove();
		$(".is-invalid").removeClass("is-invalid");

		var formData = new FormData();
		var isValid = true; // Validation flag

		// Add field to FormData and validate input
		function addField(fieldName, selector, isRequired = false, isNumeric = false) {
			var value = $(selector).val().trim();

			// Validate required fields
			if (isRequired && (value === undefined || value === "")) {
				isValid = false;
				showValidationError(selector, `${fieldName} is required.`);
				return;
			}

			// Validate numeric fields
			if (isNumeric && (isNaN(value) || Number(value) <= 0)) {
				isValid = false;
				showValidationError(selector, `${fieldName} must be a positive number.`);
				return;
			}

			// Append to formData if valid
			if (value !== undefined && value !== "") {
				formData.append(fieldName, value);
				console.log(fieldName + ": " + value); // Log the field name and value
			}
		}

		// Show validation error
		function showValidationError(selector, message) {
			$(selector).addClass("is-invalid");
			$(selector).after(`<small class="text-danger error-text">${message}</small>`);
		}

		// Validate and add fields
		addField("room_name", "#room_name", true); // Required field
		addField("price", "#price", true, true); // Required and numeric
		addField("max_capacity", "#max_capacity", true, true); // Required and numeric
		addField("description", "#description", true); // Required field

		// Validate and add image
		const room_img = document.querySelector("#room_img");
		if (room_img.files.length > 0) {
			formData.append("room_img", room_img.files[0]);
			console.log("room_img: " + room_img.files[0].name);
		} else {
			isValid = false;
			showValidationError("#room_img", "Room image is required.");
		}

		// Stop here if validation fails
		if (!isValid) {
			Swal.fire({
				title: 'Validation Error!',
				text: 'Please fix the highlighted errors and try again.',
				icon: 'warning',
				confirmButtonText: 'OK'
			});
			return;
		}

		// Proceed with AJAX request if validation passes
		$.ajax({
			type: 'POST',
			url: 'functions/cottages/add-cottages.php',
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				console.log(data);
				$('.loading-ui').hide();
				if (data.trim() === "Successful") {
					Swal.fire({
						title: 'Success!',
						text: 'Request has been successfully submitted!',
						icon: 'success',
						confirmButtonText: 'OK'
					}).then(() => {
						window.location.reload();
					});
				} else {
					Swal.fire({
						title: 'Error!',
						text: 'Submission of the request was unsuccessful!',
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText);
				Swal.fire({
					title: 'Error!',
					text: 'There was an error processing your request.',
					icon: 'error',
					confirmButtonText: 'OK'
				});
			}
		});
	});
</script>


<!---- EDIT COTTAGES VIEW SCRIPT --->
<script>
	function open_modal_user_view(room_id) {
		$("#user-update").modal("show");


		$.post(
			"functions/cottages/view-edit-cottages.php", {
				room_id: room_id,
			},
			function(data) {
				$("#user-edit-body").html(data);
				console.log(room_id);
			}
		);

	}
</script>

</html>