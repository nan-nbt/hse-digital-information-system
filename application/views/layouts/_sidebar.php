<!-- Session login check -->
<?php
if ($this->session->userdata('hse_factory') == null && $this->session->userdata('hse_username') == null) {
	redirect(base_url('users/Log'));
}
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo base_url(); ?>" class="brand-link">
		<img src="<?php echo base_url(); ?>assets/dist/img/hse-logo.png" alt="TLS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">HSE Digital Information</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
				<?php if ($this->session->userdata('hse_level') == 'S' | $this->session->userdata('hse_level') == 'U') : ?>
					<li class="nav-header">HSE BASIC DATA</li>
					<li class="nav-item 
						<?php if (base_url(uri_string()) == base_url('dashboard') || base_url(uri_string()) == base_url('dashboard')) {
							echo 'menu-open';
						} ?>">
						<a href="#" class="nav-link 
							<?php if (base_url(uri_string()) == base_url('dashboard')) {
								echo 'active';
							} ?>">
							<i class="nav-icon fas fa-cog"></i>
							<p>Basic Data</p>
							<i class="fas fa-angle-left right"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?php echo base_url('dashboard/basicDataArea'); ?>" class="nav-link 
									<?php if (base_url(uri_string()) == base_url('dashboard/basicDataArea')) {
										echo 'active';
									} ?>">
									<i class="nav-icon far fa-circle"></i>
									<p>Data Area</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url('dashboard/basicDataBuild'); ?>" class="nav-link 
									<?php if (base_url(uri_string()) == base_url('dashboard/basicDataBuild')) {
										echo 'active';
									} ?>">
									<i class="nav-icon far fa-circle"></i>
									<p>Data Building</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url('dashboard/basicDataDim'); ?>" class="nav-link 
									<?php if (base_url(uri_string()) == base_url('dashboard/basicDataDim')) {
										echo 'active';
									} ?>">
									<i class="nav-icon far fa-circle"></i>
									<p>Data Dimention</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url('dashboard/basicDataAspect'); ?>" class="nav-link 
									<?php if (base_url(uri_string()) == base_url('dashboard/basicDataAspect')) {
										echo 'active';
									} ?>">
									<i class="nav-icon far fa-circle"></i>
									<p>Data Aspect</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url('dashboard/basicDataSubAspect'); ?>" class="nav-link 
									<?php if (base_url(uri_string()) == base_url('dashboard/basicDataSubAspect')) {
										echo 'active';
									} ?>">
									<i class="nav-icon far fa-circle"></i>
									<p>Data Sub Aspect</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-header">HSE DATA PROCESS</li>
					<!-- <li class="nav-item">
						<a href="<?php echo base_url('users/Accident'); ?>" class="nav-link 
							<?php if (base_url(uri_string()) == base_url('users/Accident')) {
								echo 'active';
							} ?>">
							<i class="nav-icon fas fa-book"></i>
							<p>Manage Data HSE</p>
						</a>
					</li> -->
					<li class="nav-item">
						<a href="<?php echo base_url('users/Audit'); ?>" class="nav-link 
							<?php if (base_url(uri_string()) == base_url('users/Audit')) {
								echo 'active';
							} ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>Audit SD Standard Work</p>
						</a>
					</li>
				<?php endif; ?>
				<li class="nav-header">INFORMATION BOARD</li>
				<li class="nav-item">
					<a href="<?php echo base_url('users/Accident/infoAccident'); ?>" class="nav-link 
						<?php if (base_url(uri_string()) == base_url('users/Accident/infoAccident')) {
							echo 'active';
						} ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Info HSE</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('users/Accident/infoAccidentByArea'); ?>" class="nav-link 
						<?php if (base_url(uri_string()) == base_url('users/Accident/infoAccidentByArea')) {
							echo 'active';
						} ?>">
						<i class="nav-icon fas fa-th-large"></i>
						<p>Info HSE By Area</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('users/Audit/infoAudit'); ?>" class="nav-link 
						<?php if (base_url(uri_string()) == base_url('users/Audit/infoAudit')) {
							echo 'active';
						} ?>">
						<i class="nav-icon fas fa-chart-pie"></i>
						<p>Info Audit Standard Work</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('users/Audit/infoAuditByArea'); ?>" class="nav-link 
						<?php if (base_url(uri_string()) == base_url('users/Audit/infoAuditByArea')) {
							echo 'active';
						} ?>">
						<i class="nav-icon fas fa-th"></i>
						<p>Info Audit By Area</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
