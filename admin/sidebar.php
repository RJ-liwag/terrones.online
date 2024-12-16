<div class="sidebar">
	<div class="scrollbar-inner sidebar-wrapper">
		<div class="user">
			<div class="info">
				<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
					<span>
						Terrones Admin
					</span>
				</a>
				<div class="clearfix"></div>


			</div>
		</div>
		<ul class="nav">
			<li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
				<a href="./">
					<i class="la la-delicious"></i>
					<p>Dashboard</p>
				</a>
			</li>
			<li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'rooms.php' ? 'active' : ''; ?>">
				<a href="./rooms">
					<i class="la la-home"></i>
					<p>Rooms</p>
				</a>
			</li>
			<li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'cottages.php' ? 'active' : ''; ?>">
				<a href="./cottages">
					<i class="la la-home"></i>
					<p>Cottages</p>
				</a>
			</li>


			<li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'reservations.php' ? 'active' : ''; ?>">
				<a href="./reservations">
					<i class="la la-users"></i>
					<p>Reservations</p>
					<!-- <span class="badge badge-count">14</span> -->
				</a>
			</li>
			<li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'announcements.php' ? 'active' : ''; ?>">
				<a href="./announcements">
					<i class="la la-bullhorn"></i>
					<p>Announcements</p>
					<!-- <span class="badge badge-count">14</span> -->
				</a>
			</li>
			<li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'feedback.php' ? 'active' : ''; ?>">
				<a href="./feedback">
					<i class="la la-comments"></i>
					<p>Feedback</p>
					<!-- <span class="badge badge-count">14</span> -->
				</a>
			</li>
			<li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'inquiries.php' ? 'active' : ''; ?>">
				<a href="./inquiries">
					<i class="la la-comments"></i>
					<p>Inquiries</p>
					<!-- <span class="badge badge-count">14</span> -->
				</a>
			</li>
		</ul>
	</div>
</div>