<head>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="main-header">
	<div class="logo-header">
		<a href="index.php" class="logo">
			<img src="assets/img/images/textLogo.png" height="50" width="200" alt="">
		</a>
		<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
			data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
	</div>
	<nav class="navbar navbar-header navbar-expand-lg">
		<div class="container-fluid">

			<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
				<!-- <li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-envelope"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li> -->
				<li class="nav-item dropdown hidden-caret">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" hidden
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="la la-bell"></i>
						<span class="notification">3</span>
					</a>
					<ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
						<li>
							<div class="dropdown-title">You have 4 new notification</div>
						</li>
						<li>
							<div class="notif-center">
								<a href="#">
									<div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
									<div class="notif-content">
										<span class="block">
											New user registered
										</span>
										<span class="time">5 minutes ago</span>
									</div>
								</a>
								<a href="#">
									<div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
									<div class="notif-content">
										<span class="block">
											Rahmad commented on Admin
										</span>
										<span class="time">12 minutes ago</span>
									</div>
								</a>
								<a href="#">
									<div class="notif-img">
										<img src="assets/img/profile2.jpg" alt="Img Profile">
									</div>
									<div class="notif-content">
										<span class="block">
											Reza send messages to you
										</span>
										<span class="time">12 minutes ago</span>
									</div>
								</a>
								<a href="#">
									<div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
									<div class="notif-content">
										<span class="block">
											Farrah liked Admin
										</span>
										<span class="time">17 minutes ago</span>
									</div>
								</a>
							</div>
						</li>
						<li>
							<a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i
									class="la la-angle-right"></i> </a>
						</li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
						aria-expanded="false"><span><?php echo $admin_username ?></span></span> </a>
					<ul class="dropdown-menu dropdown-user">
						<a class="dropdown-item" data-target="#changePassModal" data-toggle="modal"
							href="#changePassModal"><i class="ti-user"></i> Change Username / Password</a>
						<div class="dropdown-divider"></div>
						<form action="functions/admin-logout.php" method="post">
							<button class="dropdown-item" type="submit" id="logoutBtn"><i class="fa fa-power-off"></i>
								Logout</button>
						</form>
					</ul>
					<!-- /.dropdown-user -->
				</li>
			</ul>
		</div>
	</nav>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<!-- Modal -->
<div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">Change Username / Password</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form class="needs-validation" id="validationChangePass" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="newUsername">Username</label>
						<input type="text" class="form-control d-none" id="admin_id" aria-describedby="emailHelp"
							value="<?php echo $admin_id ?>" required>
						<input type="text" class="form-control" id="newUsername" aria-describedby="emailHelp"
							value="<?php echo $admin_username ?>" required>
						<div class="invalid-feedback">
							Please enter username.
						</div>
					</div>
					<div class="form-group">
						<label for="newPassword">Current Password</label>
						<div class="input-group">
							<input type="password" class="form-control" id="currentPass" placeholder="Password" required>
							<span class="input-group-text">
								<i class="fa-regular fa-eye" id="togglePassword"></i>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="newPassword">New Password</label>
						<div class="input-group">
							<input type="password" class="form-control" id="newPass" placeholder="Password" required>
							<span class="input-group-text">
								<i class="fa-regular fa-eye" id="toggleNewPass"></i>
							</span>
						</div>
						<div class="invalid-feedback">
							Please enter new password.
						</div>
					</div>

					<div class="form-group">
						<label for="confirmPassword">Confirm Password</label>
						<div class="input-group">
							<input type="password" class="form-control" id="confirmPass" placeholder="Password" required>
							<span class="input-group-text">
								<i class="fa-regular fa-eye" id="toggleConfirmPass"></i>
							</span>
						</div>
						<div class="invalid-feedback">
							Passwords do not match.
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" id="changePassBtn" class="btn btn-success">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	const passwordInput = document.getElementById('currentPass');
	const togglePasswordIcon = document.getElementById('togglePassword');

	togglePasswordIcon.addEventListener('click', () => {
		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			togglePasswordIcon.classList.replace('fa-eye', 'fa-eye-slash');
		} else {
			passwordInput.type = 'password';
			togglePasswordIcon.classList.replace('fa-eye-slash', 'fa-eye');
		}
	});
</script>

<script>
	const passwordInput1 = document.getElementById('newPass');
	const togglePasswordIcon1 = document.getElementById('toggleNewPass');

	togglePasswordIcon1.addEventListener('click', () => {
		if (passwordInput1.type === 'password') {
			passwordInput1.type = 'text';
			togglePasswordIcon1.classList.replace('fa-eye', 'fa-eye-slash');
		} else {
			passwordInput1.type = 'password';
			togglePasswordIcon1.classList.replace('fa-eye-slash', 'fa-eye');
		}
	});
</script>

<script>
	const passwordInput2 = document.getElementById('confirmPass');
	const togglePasswordIcon2 = document.getElementById('toggleConfirmPass');

	togglePasswordIcon2.addEventListener('click', () => {
		if (passwordInput2.type === 'password') {
			passwordInput2.type = 'text';
			togglePasswordIcon2.classList.replace('fa-eye', 'fa-eye-slash');
		} else {
			passwordInput2.type = 'password';
			togglePasswordIcon2.classList.replace('fa-eye-slash', 'fa-eye');
		}
	});
</script>