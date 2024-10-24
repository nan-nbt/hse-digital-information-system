<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
      </li> -->
		<li class="nav-item d-none d-sm-inline-block">
			<a href="#" class="nav-link" onclick="alert('Anan PCaG IT Software | Ext: 120-3053')">Contact</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Notifications Dropdown Menu -->
		<?php if (base_url(uri_string()) == base_url()) : ?>
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="far fa-user"></i> <?php if ($this->session->userdata('hse_username') != null) {
																				echo $this->session->userdata('hse_username');
																			} else {
																				echo 'GUEST';
																			} ?>
					<!-- <span class="badge badge-warning navbar-badge">15</span> -->
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<!-- <span class="dropdown-item dropdown-header"><?php echo $this->session->userdata('hse_username'); ?></span> -->
					<div class="dropdown-divider"></div>
					<a href="<?php echo base_url('users/Log/logout'); ?>" class="dropdown-item">
						<i class="fas fa-sign-out-alt mr-2"></i> Logout
						<!-- <span class="float-right text-muted text-sm">3 mins</span> -->
					</a>
				</div>
			</li>
		<?php endif; ?>
		<!-- ./ Notification Dropdown Menu -->
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
	</ul>
</nav>
<!-- /.navbar -->
