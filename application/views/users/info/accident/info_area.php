<!-- Session login check -->
<?php if ($this->session->userdata('hse_factory') == null) {
	redirect(base_url('users/Log'));
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- meta tag -->
	<?php $this->load->view("layouts/_meta.php") ?>

	<!-- title tag -->
	<?php $this->load->view("layouts/_title.php") ?>

	<!-- link stylesheet -->
	<?php $this->load->view("layouts/_css.php") ?>

</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed text-sm">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Header -->
		<?php //require_once('_header.php'); 
		?>
		<?php $this->load->view("layouts/_header.php") ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<!-- <div class="container-fluid">
							<div class="row mb-2">
								<div class="col-sm-6">
									<h1>Audit SD Standar Work</h1>
								</div>
								<div class="col-sm-6">
									<ol class="breadcrumb float-sm-right">
										<li class="breadcrumb-item"><a href="#">Home</a></li>
										<li class="breadcrumb-item active">HSE Data Process</li>
									</ol>
								</div>
							</div>
						</div> -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<!-- form start -->
									<form class="form-horizontal" id="accident-query">
										<div class="row">
											<!-- Date -->
											<div class="col-md-4">
												<div class="form-group">
													<label for="startdate"><span class="text-danger">*</span>Date Start :</label>
													<div class="input-group date" id="startdate" data-target-input="nearest">
														<input type="text" class="form-control datetimepicker-input" data-target="#startdate" id="startdate_query" name="startdate" value="<?php echo date('Y/m/d'); ?>" required />
														<div class="input-group-append" data-target="#startdate" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="enddate"><span class="text-danger">*</span>Date End :</label>
													<div class="input-group date" id="enddate" data-target-input="nearest">
														<input type="text" class="form-control datetimepicker-input" data-target="#enddate" id="enddate_query" name="enddate" value="<?php echo date('Y/m/d'); ?>" required />
														<div class="input-group-append" data-target="#enddate" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="query" style="margin-top:13px;"></label>
													<button type="submit" class="form-control btn btn-primary" id="query">Query</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- /.card-header -->
							</div>
							<!-- /.card -->

							<!-- Default box -->
							<div class="card">
								<div class="card-header text-center">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-4">
												<img src="<?php echo base_url(); ?>/assets/dist/img/pouchen.ico" alt="Pouchen Logo" class="brand-image img-circle elevation-0 float-right" style="opacity: 0.8; width: 100px;">
											</div>
											<div class="col-sm-4">
												<h1><strong>INFO HSE</strong></h1>
												<h5><strong>Factory: <?php echo $this->session->userdata('hse_factory_name'); ?> | <span id="date-range"></span></strong></h5>
											</div>
											<div class="col-sm-4">
												<img src="<?php echo base_url(); ?>/assets/dist/img/hse-logo.png" alt="HSE Logo" class="brand-image img-circle elevation-0 float-left" style="opacity: 0.8; width: 100px;">
											</div>
										</div>
									</div>
									<?php
									// foreach($hse_max_date as $max_date){ $current_date = substr($max_date->SUBMIT_DATE,0,8); } 
									// if(substr($current_date,4,2) != substr(date('YmdHis'),4,2)){
									// 	$current_date = date('YmdHis'); 
									// }

									// if(substr($current_date,4,2) == '01'){ $month = 'JANUARI'; }
									// else if(substr($current_date,4,2) == '02'){ $month = 'FEBRUARI'; } 
									// else if(substr($current_date,4,2) == '03'){ $month = 'MARET'; } 
									// else if(substr($current_date,4,2) == '04'){ $month = 'APRIL'; } 
									// else if(substr($current_date,4,2) == '05'){ $month = 'MEI'; } 
									// else if(substr($current_date,4,2) == '06'){ $month = 'JUNI'; } 
									// else if(substr($current_date,4,2) == '07'){ $month = 'JULI'; } 
									// else if(substr($current_date,4,2) == '08'){ $month = 'AGUSTUS'; } 
									// else if(substr($current_date,4,2) == '09'){ $month = 'SEPTEMBER'; } 
									// else if(substr($current_date,4,2) == '10'){ $month = 'OKTOBER'; } 
									// else if(substr($current_date,4,2) == '11'){ $month = 'NOVEMBER'; } 
									// else if(substr($current_date,4,2) == '12'){ $month = 'DESEMBER'; }

									// $year = substr($current_date,0,4);
									// $last_month = $month.'-'.$year; 
									?>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-2">
											<div class="info-box bg-secondary">
												<div class="info-box-content text-center" style="height:100px;">
													<h4><strong>AREA</strong></h4>
												</div>
											</div>
										</div>
										<!-- /.col -->
										<div class="col-sm-2">
											<div class="info-box bg-info">
												<div class="info-box-content text-center" style="height:100px;">
													<h4><strong>Total Kasus</strong></h4>
												</div>
											</div>
										</div>
										<!-- /.col -->
										<div class="col-sm-2">
											<div class="info-box bg-success">
												<div class="info-box-content text-center" style="height:100px;">
													<h4><strong>Kasus Tidak Hilang Hari Kerja</strong></h4>
												</div>
											</div>
										</div>
										<!-- /.col -->
										<div class="col-sm-2">
											<div class="info-box bg-danger">
												<div class="info-box-content text-center" style="height:100px;">
													<h4><strong>Kasus Hilang Hari Kerja</strong></h4>
												</div>
											</div>
										</div>
										<!-- /.col -->
										<div class="col-sm-2">
											<div class="info-box bg-primary">
												<div class="info-box-content text-center" style="height:100px;">
													<h4><strong>Total Hari Kerja Hilang</strong></h4>
												</div>
											</div>
										</div>
										<!-- /.col -->
										<div class="col-sm-2">
											<div class="info-box bg-fuchsia">
												<div class="info-box-content text-center" style="height:100px;">
													<h4><strong>HSE Standard Work Score</strong></h4>
												</div>
											</div>
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->

									<!-- data accident  -->
									<div id="data-accident">
										<!-- get data using JQuery -->
									</div>

								</div>
								<!-- /.card-body -->

								<form action="<?php echo base_url('users/Accident/dataAccidentAreaByDateDetail'); ?>" method="POST" target="hse_accident_area">
									<div class="modal-footer justify-content-between">
										<input type="hidden" id="startdate-detail" name="startdate-detail" value="<?php echo date('Ymd'); ?>" />
										<input type="hidden" id="enddate-detail" name="enddate-detail" value="<?php echo date('Ymd'); ?>" />
										<button type="submit" class="btn btn-primary col-12" id="submit-detail-accident" disabled>Buka Layar Penuh <i class="fas fa-arrow-right"></i></button>
									</div>
								</form>

							</div>
							<!-- /.card -->
						</div>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Footer -->
		<?php $this->load->view("layouts/_footer.php") ?>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- Javascript -->
	<?php $this->load->view("layouts/_js.php") ?>

	<script>
		// page onload function
		$(document).ready(function() {
			loadDataAccident();
		});

		// pace-progress when ajax request
		$(document).ajaxStart(function() {
			Pace.restart();
		});

		// function onclick button query
		$('#accident-query').on('submit', function() {
			var startdate_detail = $('#startdate_query').val();
			var enddate_detail = $('#enddate_query').val();

			// set icon progress load
			$('#query').html('<i class="fas fa-circle-notch fa-spin"></i>');

			$('#startdate-detail').val(startdate_detail);
			$('#enddate-detail').val(enddate_detail);

			// call function loadListAudit
			loadDataAccident();

			return false;
		});

		// function load data on datatable plugin
		function loadDataAccident() {
			debugger
			var startdate = $('#startdate_query').val();
			var enddate = $('#enddate_query').val();

			$.ajax({
				url: "<?php echo base_url('users/Accident/dataAccidentAreaByDate'); ?>",
				method: "POST",
				data: {
					startdate: startdate,
					enddate: enddate
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {
					debugger
					var htmlData = '';
					var no = 1;
					var i;

					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							htmlData += '<div class="row">' +
								'<div class="col-sm-2">' +
								'<div class="card card-default card-outline">' +
								'<div class="card-header text-center" style="background-color: #d4d4d4;">' +
								'<span class="font-weight-bold">' + data[i].AREA_NM + '</span>' +
								'</div>' +
								'</div>' +
								'</div>' +
								'<div class="col-sm-2">' +
								'<div class="card card-default card-outline">' +
								'<div class="card-header text-center" style="background-color: #c8f4fa;">' +
								'<span class="font-weight-bold">' + data[i].ACCIDENT + '</span>' +
								'</div>' +
								'</div>' +
								'</div>' +
								'<div class="col-sm-2">' +
								'<div class="card card-default card-outline">' +
								'<div class="card-header text-center" style="background-color: #c8fac9;">' +
								'<span class="font-weight-bold">' + data[i].NLTI + '</span>' +
								'</div>' +
								'</div>' +
								'</div>' +
								'<div class="col-sm-2">' +
								'<div class="card card-default card-outline">' +
								'<div class="card-header text-center" style="background-color: #fac8c8;">' +
								'<span class="font-weight-bold">' + data[i].LTI + '</span>' +
								'</div>' +
								'</div>' +
								'</div>' +
								'<div class="col-sm-2">' +
								'<div class="card card-default card-outline">' +
								'<div class="card-header text-center" style="background-color: #c8dffa;">' +
								'<span class="font-weight-bold">' + data[i].LOST_DAY + '</span>' +
								'</div>' +
								'</div>' +
								'</div>' +
								'<div class="col-sm-2">' +
								'<div class="card card-default card-outline">' +
								'<div class="card-header text-center" style="background-color: #fac8f7;">' +
								'<span class="font-weight-bold">' + parseFloat(data[i].FINAL_SCORE).toFixed(2) + '</span>' +
								'</div>' +
								'</div>' +
								'</div>' +
								'</div>';
						}

						$('#date-range').text(startdate + ' ~ ' + enddate);
						$('#data-accident').html(htmlData);
						$('#submit-detail-accident').removeAttr('disabled');
						$('#query').text('Query');

					} else {
						htmlData = '<div class="row">' +
							'<div class="col-sm-12">' +
							'<div class="card card-default card-outline">' +
							'<div class="card-header text-center" style="background-color: #d4d4d4;">' +
							'<span class="font-weight-bold">Tidak ada data tersedia.</span>' +
							'</div>' +
							'</div>' +
							'</div>' +
							'</div>';

						$('#date-range').text(startdate + ' ~ ' + enddate);
						$('#data-accident').html(htmlData);
						$('#submit-detail-accident').attr('disabled', true);
						$('#query').text('Query');

					}
				}
			});
		}

		// set interval
		setInterval(loadDataAccident, 120000); // interval set 10 sec
	</script>

</body>

</html>
