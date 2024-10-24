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

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Header -->
		<?php $this->load->view("layouts/_header.php") ?>

		<!-- Sidebar -->
		<?php $this->load->view("layouts/_sidebar.php") ?>

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
									<form class="form-horizontal" id="audit-area-query">
										<div class="row">
											<div class="col-md-4">
												<!-- Date -->
												<div class="form-group">
													<label for="indate"><span class="text-danger">*</span>Tanggal Pengecekan :</label>
													<div class="input-group date" data-target-input="nearest">
														<input type="text" class="form-control datetimepicker-input" data-target="#indate" id="indate" name="indate" value="<?php echo date('Ymd'); ?>" onkeydown="return (event.keyCode!=13);" required />
														<div class="input-group-append" data-target="#indate" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="area_no" style="margin-bottom:9px;"><span class="text-danger">*</span>Area :</label>
													<select class="form-control select2bs4" style="width: 100%;" id="area_no" name="area_no" required>
														<option value="" selected>-- Area --</option>
													</select>
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

							<!-- audit layout -->
							<div class="card card-default">
								<div id="audit-layout-master">
									<div class="card-header">
										<h1 class="text-center"><strong>HASIL SD STANDARD WORK BY AREA</strong></h1>
										<h2 class="text-center"><strong><?php echo $this->session->userdata('hse_factory_name'); ?></strong>
											<h2>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="col-form-label">TANGGAL PENGECEKAN</label>
														</div>
														<div class="col-md-9 border-bottom">
															: <span class="item" id="data-checkdate"> </span>
														</div>
													</div>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="col-form-label">AREA</label>
														</div>
														<div class="col-md-9 border-bottom">
															: <span class="item" id="data-area"> </span>
														</div>
													</div>
												</div>
												<!-- /.form-group -->
											</div>
											<!-- /.col-md-6 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.card-body -->
								</div>
								<!-- /.audit-layout-master -->

								<div id="audit-layout-detail">
									<div class="card-body">
										<div class="card">
											<div class="card-header bg-primary">
												<h3 class="card-title text-bold">LAYOUT AREA</h3>
											</div>
											<div class="card-body" id="layout-area">
												<div class="text-center"><span>Data tidak tersedia</span></div>
											</div>
										</div>
									</div>
									<!-- /.card-body -->

									<form action="<?php echo base_url('users/Audit/dataAuditLayoutDetailArea'); ?>" method="POST" target="hse_audit_detail_area">
										<div class="modal-footer justify-content-between">
											<input type="hidden" id="indate-detail" name="indate-detail" />
											<input type="hidden" id="area-detail" name="area-detail" />
											<button type="submit" class="btn btn-primary col-12" id="submit-detail-area" disabled>Buka Layar Penuh <i class="fas fa-arrow-right"></i></button>
										</div>
									</form>
								</div>
								<!-- /.audit-layout-detail -->
							</div>
							<!-- /.card audit-layout -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->

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

	<!-- Page specific script -->
	<script>
		// page onload function
		$(document).ready(function() {
			// call tooltip
			$('[data-toggle="tooltip"]').tooltip();

			// call function 
			loadArea();
		});

		// pace-progress when ajax request
		$(document).ajaxStart(function() {
			Pace.restart();
		});

		// function onclick button query
		$('#audit-area-query').on('submit', function() {
			debugger
			var indate_detail = $('#indate').val();
			var area_detail = $('#area_no').val();

			// set icon progress load
			$('#query').html('<i class="fas fa-circle-notch fa-spin"></i>');

			$('#indate-detail').val(indate_detail);
			$('#area-detail').val(area_detail);

			// call function loadListAudit
			loadAuditLayoutArea();

			return false;
		});

		// function load data on datatable plugin
		function loadAuditLayoutArea() {
			debugger
			var indate = $('#indate').val();
			var area_no = $('#area_no').val();

			$.ajax({
				url: "<?php echo base_url('users/Audit/dataAuditLayoutArea'); ?>",
				method: "POST",
				data: {
					area_no: area_no,
					indate: indate
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {
					debugger
					var submit_id = '';
					var htmlDataCheckDate = '';
					// var htmlDataArea = '';
					var htmlDataArea = [];

					var hmtlLayoutArea = '';

					var i;
					// var dataArea = '';
					var dataArea = [];
					var dataTotal = [];
					var dataPenalty = [];
					var dataDivide = [];
					var dataStatus = [];
					var dataColor = [];

					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							if (data[i].CHECK_DATE !== null) {
								var date = data[i].CHECK_DATE;
								var year = date.substr(0, 4);
								var month = date.substr(4, 2);
								var day = date.substr(6, 2);
								var check_date = year + '/' + month + '/' + day;
							} else {
								var check_date = null;
							}

							if (data[i].TOTAL !== null) {
								var listTotal = data[i].TOTAL;
							} else {
								var listTotal = 0;
							}

							if (data[i].PENALTY !== null) {
								var listPenalty = data[i].PENALTY;
							} else {
								var listPenalty = 0;
							}

							if (data[i].DIVIDE !== null) {
								var listDivide = data[i].DIVIDE;
							} else {
								var listDivide = 0;
							}

							if (check_date !== null) {
								htmlDataCheckDate = check_date;

								if (!htmlDataArea.includes(data[i].AREA_NM)) {
									htmlDataArea.push(data[i].AREA_NM);
								}

								if (!dataArea.includes(data[i].AREA_NO)) {
									dataArea.push(data[i].AREA_NO);
								}
							}

							dataTotal.push(listTotal);
							dataPenalty.push(listPenalty);
							dataDivide.push(listDivide);

							debugger
							var dataSummary = parseFloat(listTotal / listDivide) + parseFloat(listPenalty);

							if (dataSummary > 0 && dataSummary < 80.00) {
								dataStatus.push('HIGH');
								dataColor.push('bg-danger blink-sm-ft');
							} else if (dataSummary >= 80.00 && dataSummary < 90.00) {
								dataStatus.push('MEDIUM');
								dataColor.push('bg-warning');
							} else if (dataSummary >= 90.00) {
								dataStatus.push('LOW');
								dataColor.push('bg-success');
							} else {
								dataStatus.push('-');
								dataColor.push('bg-white');
							}

						}
						debugger
						/** check layout image by area */
						if (dataArea == '01') {
							// declare variable
							var nameBuild1 = data[0].BUILD_NM;
							var nameBuild2 = data[1].BUILD_NM;
							var nameBuild3 = data[2].BUILD_NM;
							var nameBuild4 = data[3].BUILD_NM;
							var nameBuild5 = data[4].BUILD_NM;

							debugger
							var totalBuild1 = parseFloat(dataTotal[0] / dataDivide[0]) + parseFloat(dataPenalty[0]);
							var totalBuild2 = parseFloat(dataTotal[1] / dataDivide[1]) + parseFloat(dataPenalty[1]);
							var totalBuild3 = parseFloat(dataTotal[2] / dataDivide[2]) + parseFloat(dataPenalty[2]);
							var totalBuild4 = parseFloat(dataTotal[3] / dataDivide[3]) + parseFloat(dataPenalty[3]);
							var totalBuild5 = parseFloat(dataTotal[4] / dataDivide[4]) + parseFloat(dataPenalty[4]);

							var statusBuild1 = dataStatus[0];
							var statusBuild2 = dataStatus[1];
							var statusBuild3 = dataStatus[2];
							var statusBuild4 = dataStatus[3];
							var statusBuild5 = dataStatus[4];

							var colorBuild1 = dataColor[0];
							var colorBuild2 = dataColor[1];
							var colorBuild3 = dataColor[2];
							var colorBuild4 = dataColor[3];
							var colorBuild5 = dataColor[4];

							// set layour area A
							hmtlLayoutArea = '<div class="row">' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/A/A3.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 20px; left: 10px;" class="bs-stepper-circle ' + colorBuild3 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild3 + ': ' + statusBuild3 + ' (' + totalBuild3.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/A/A2.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 20px; left: 175px;" class="bs-stepper-circle ' + colorBuild2 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild2 + ': ' + statusBuild2 + ' (' + totalBuild2.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/A/A1C.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 610px; left: 10px;" class="bs-stepper-circle ' + colorBuild1 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild1 + ': ' + statusBuild1 + ' (' + totalBuild1.toFixed(2) + '%)</span>' +
								'</div>' +
								'<div style="position: absolute; top: 20px; left: 10px;" class="bs-stepper-circle ' + colorBuild5 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild5 + ': ' + statusBuild5 + ' (' + totalBuild5.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/A/A1LT2.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 20px; left: 10px;" class="bs-stepper-circle ' + colorBuild4 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild4 + ': ' + statusBuild4 + ' (' + totalBuild4.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'</div>';

						} else if (dataArea == '02') {
							// declare variable
							var nameBuild1 = data[0].BUILD_NM;
							var nameBuild2 = data[1].BUILD_NM;
							var nameBuild3 = data[2].BUILD_NM;
							var nameBuild4 = data[3].BUILD_NM;
							var nameBuild5 = data[4].BUILD_NM;
							var nameBuild6 = data[5].BUILD_NM;

							var totalBuild1 = parseFloat(dataTotal[0] / dataDivide[0]) + parseFloat(dataPenalty[0]);
							var totalBuild2 = parseFloat(dataTotal[1] / dataDivide[1]) + parseFloat(dataPenalty[1]);
							var totalBuild3 = parseFloat(dataTotal[2] / dataDivide[2]) + parseFloat(dataPenalty[2]);
							var totalBuild4 = parseFloat(dataTotal[3] / dataDivide[3]) + parseFloat(dataPenalty[3]);
							var totalBuild5 = parseFloat(dataTotal[4] / dataDivide[4]) + parseFloat(dataPenalty[4]);
							var totalBuild6 = parseFloat(dataTotal[5] / dataDivide[5]) + parseFloat(dataPenalty[5]);

							var statusBuild1 = dataStatus[0];
							var statusBuild2 = dataStatus[1];
							var statusBuild3 = dataStatus[2];
							var statusBuild4 = dataStatus[3];
							var statusBuild5 = dataStatus[4];
							var statusBuild6 = dataStatus[5];

							var colorBuild1 = dataColor[0];
							var colorBuild2 = dataColor[1];
							var colorBuild3 = dataColor[2];
							var colorBuild4 = dataColor[3];
							var colorBuild5 = dataColor[4];
							var colorBuild6 = dataColor[5];

							// set layour area B
							hmtlLayoutArea = '<div class="row">' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/B/B7LT2.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 5px;" class="bs-stepper-circle ' + colorBuild5 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild5 + ': ' + statusBuild5 + ' (' + totalBuild5.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/B/B6.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; bottom: 10px; left: 5px;" class="bs-stepper-circle ' + colorBuild3 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild3 + ': ' + statusBuild3 + ' (' + totalBuild3.toFixed(2) + '%)</span>' +
								'</div>' +
								'<div style="position: absolute; top: 10px; left: 5px;" class="bs-stepper-circle ' + colorBuild6 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild6 + ': ' + statusBuild6 + ' (' + totalBuild6.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/B/B5.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 5px;" class="bs-stepper-circle ' + colorBuild2 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild2 + ': ' + statusBuild2 + ' (' + totalBuild2.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/B/B5LT2.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 5px;" class="bs-stepper-circle ' + colorBuild4 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild4 + ': ' + statusBuild4 + ' (' + totalBuild4.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/B/B4.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 175px;" class="bs-stepper-circle ' + colorBuild1 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild1 + ': ' + statusBuild1 + ' (' + totalBuild1.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'</div>';

						} else if (dataArea == '03') {
							// declare variable
							var nameBuild1 = data[0].BUILD_NM;
							var nameBuild2 = data[1].BUILD_NM;
							var nameBuild3 = data[2].BUILD_NM;
							var nameBuild4 = data[3].BUILD_NM;

							var totalBuild1 = parseFloat(dataTotal[0] / dataDivide[0]) + parseFloat(dataPenalty[0]);
							var totalBuild2 = parseFloat(dataTotal[1] / dataDivide[1]) + parseFloat(dataPenalty[1]);
							var totalBuild3 = parseFloat(dataTotal[2] / dataDivide[2]) + parseFloat(dataPenalty[2]);
							var totalBuild4 = parseFloat(dataTotal[3] / dataDivide[3]) + parseFloat(dataPenalty[3]);

							var statusBuild1 = dataStatus[0];
							var statusBuild2 = dataStatus[1];
							var statusBuild3 = dataStatus[2];
							var statusBuild4 = dataStatus[3];

							var colorBuild1 = dataColor[0];
							var colorBuild2 = dataColor[1];
							var colorBuild3 = dataColor[2];
							var colorBuild4 = dataColor[3];

							// set layour area C
							hmtlLayoutArea = '<div class="row">' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/C/C8.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 175px;" class="bs-stepper-circle ' + colorBuild1 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild1 + ': ' + statusBuild1 + ' (' + totalBuild1.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/C/C9.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 175px;" class="bs-stepper-circle ' + colorBuild2 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild2 + ': ' + statusBuild2 + ' (' + totalBuild2.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/C/C10.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 175px;" class="bs-stepper-circle ' + colorBuild3 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild3 + ': ' + statusBuild3 + ' (' + totalBuild3.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/C/C10A.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 175px;" class="bs-stepper-circle ' + colorBuild4 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild4 + ': ' + statusBuild4 + ' (' + totalBuild4.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'</div>';

						} else if (dataArea == '04' || dataArea == '08' || dataArea.includes('04') || dataArea.includes('08')) {
							// declare variable
							var nameBuild1 = data[0].BUILD_NM;
							var nameBuild2 = data[1].BUILD_NM;
							var nameBuild3 = data[2].BUILD_NM;
							var nameBuild4 = data[3].BUILD_NM;

							var totalBuild1 = parseFloat(dataTotal[0] / dataDivide[0]) + parseFloat(dataPenalty[0]);
							var totalBuild2 = parseFloat(dataTotal[1] / dataDivide[1]) + parseFloat(dataPenalty[1]);
							var totalBuild3 = parseFloat(dataTotal[2] / dataDivide[2]) + parseFloat(dataPenalty[2]);
							var totalBuild4 = parseFloat(dataTotal[3] / dataDivide[3]) + parseFloat(dataPenalty[3]);

							var statusBuild1 = dataStatus[0];
							var statusBuild2 = dataStatus[1];
							var statusBuild3 = dataStatus[2];
							var statusBuild4 = dataStatus[3];

							var colorBuild1 = dataColor[0];
							var colorBuild2 = dataColor[1];
							var colorBuild3 = dataColor[2];
							var colorBuild4 = dataColor[3];

							// set layour area D
							hmtlLayoutArea = '<div class="row">' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/D/D13.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 175px;" class="bs-stepper-circle ' + colorBuild4 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild4 + ': ' + statusBuild4 + ' (' + totalBuild4.toFixed(2) + '%)</span>' +
								'</div>' +
								'<div style="position: absolute; bottom: 10px; left: 175px;" class="bs-stepper-circle ' + colorBuild3 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild3 + ': ' + statusBuild3 + ' (' + totalBuild3.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/D/D12.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 5px;" class="bs-stepper-circle ' + colorBuild2 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild2 + ': ' + statusBuild2 + ' (' + totalBuild2.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/D/D11.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; top: 10px; left: 170px;" class="bs-stepper-circle ' + colorBuild1 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild1 + ': ' + statusBuild1 + ' (' + totalBuild1.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'</div>';

						} else if (dataArea == '09') {
							// declare variable
							var nameBuild1 = data[0].BUILD_NM;

							var totalBuild1 = parseFloat(dataTotal[0] / dataDivide[0]) + parseFloat(dataPenalty[0]);

							var statusBuild1 = dataStatus[0];

							var colorBuild1 = dataColor[0];

							// set layour area R1
							hmtlLayoutArea = '<div class="row">' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/R1/R1.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; bottom: 10px; left: 175px;" class="bs-stepper-circle ' + colorBuild1 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild1 + ': ' + statusBuild1 + ' (' + totalBuild1.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'</div>';

						} else if (dataArea == '10') {
							// declare variable
							var nameBuild1 = data[0].BUILD_NM;

							var totalBuild1 = parseFloat(dataTotal[0] / dataDivide[0]) + parseFloat(dataPenalty[0]);

							var statusBuild1 = dataStatus[0];

							var colorBuild1 = dataColor[0];

							// set layour area R3
							hmtlLayoutArea = '<div class="row">' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/R3/R3.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; bottom: 150px; left: 325px;" class="bs-stepper-circle ' + colorBuild1 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild1 + ': ' + statusBuild1 + ' (' + totalBuild1.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'</div>';

						} else if (dataArea == '05' || dataArea == '06' || dataArea == '07' || dataArea == '12' || dataArea.includes('05') || dataArea.includes('06') || dataArea.includes('07') || dataArea.includes('12')) {
							// declare variable
							var nameBuild1 = data[0].BUILD_NM;
							var nameBuild2 = data[1].BUILD_NM;
							var nameBuild3 = data[2].BUILD_NM;
							var nameBuild4 = data[3].BUILD_NM;

							var totalBuild1 = parseFloat(dataTotal[0] / dataDivide[0]) + parseFloat(dataPenalty[0]);
							var totalBuild2 = parseFloat(dataTotal[1] / dataDivide[1]) + parseFloat(dataPenalty[1]);
							var totalBuild3 = parseFloat(dataTotal[2] / dataDivide[2]) + parseFloat(dataPenalty[2]);
							var totalBuild4 = parseFloat(dataTotal[3] / dataDivide[3]) + parseFloat(dataPenalty[3]);

							var statusBuild1 = dataStatus[0];
							var statusBuild2 = dataStatus[1];
							var statusBuild3 = dataStatus[2];
							var statusBuild4 = dataStatus[3];

							var colorBuild1 = dataColor[0];
							var colorBuild2 = dataColor[1];
							var colorBuild3 = dataColor[2];
							var colorBuild4 = dataColor[3];

							// set layour area Bordir / A1 - A5 
							hmtlLayoutArea = '<div class="row">' +
								'<div class="col form-group">' +
								'<img src="<?php echo base_url(); ?>assets/dist/img/layouts/A1A5/A1A5.png" class="img-fluid" alt="white sample" />' +
								'<div style="position: absolute; bottom: 10px; left: 15px;" class="bs-stepper-circle ' + colorBuild4 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild4 + ': ' + statusBuild4 + ' (' + totalBuild4.toFixed(2) + '%)</span>' +
								'</div>' +
								'<div style="position: absolute; bottom: 10px; left: 255px;" class="bs-stepper-circle ' + colorBuild1 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild1 + ': ' + statusBuild1 + ' (' + totalBuild1.toFixed(2) + '%)</span>' +
								'</div>' +
								'<div style="position: absolute; top: 10px; left: 255px;" class="bs-stepper-circle ' + colorBuild2 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild2 + ': ' + statusBuild2 + ' (' + totalBuild2.toFixed(2) + '%)</span>' +
								'</div>' +
								'<div style="position: absolute; top: 10px; left: 535px;" class="bs-stepper-circle ' + colorBuild3 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild3 + ': ' + statusBuild3 + ' (' + totalBuild3.toFixed(2) + '%)</span>' +
								'</div>' +
								'</div>' +
								'</div>';

						} else {
							// set no layout area
							hmtlLayoutArea = '<div class="text-center"><span>Data tidak tersedia</span></div>';
						}

						// layout master data
						$('#data-checkdate').text(htmlDataCheckDate);
						$('#data-area').text(htmlDataArea.join(", "));
						$('#layout-area').html(hmtlLayoutArea);

						if (dataArea.length > 0) {
							$('#submit-detail-area').removeAttr('disabled');
						} else {
							$('#submit-detail-area').attr('disabled', true);
						}

						$('#query').text('Query');

					} else {
						// set no layout area
						hmtlLayoutArea = '<div class="text-center"><span>Data tidak tersedia</span></div>';

						$('#data-checkdate').text(htmlDataCheckDate);
						$('#data-area').text(htmlDataArea.join(", "));
						$('#layout-area').html(hmtlLayoutArea);

						$('#query').text('Query');

					}
				}
			});
		}

		function loadArea() {
			$.ajax({
				url: "<?php echo base_url('users/Audit/dataArea'); ?>",
				method: "POST",
				async: true,
				dataType: 'JSON',
				success: function(data) {
					debugger
					var htmlArea = '';
					var i;

					htmlArea = '<option value="" selected disabled>-- Area --</option>';

					for (i = 0; i < data.length; i++) {
						// add data dropdown list except non production area
						if (data[i].AREA_NO !== "04" && data[i].AREA_NO !== '05' && data[i].AREA_NO !== '06' && data[i].AREA_NO !== '07' && data[i].AREA_NO !== '08' && data[i].AREA_NO !== '11' && data[i].AREA_NO !== '12') {
							htmlArea += '<option value=' + data[i].AREA_NO + '>' + data[i].AREA_NO + ' | ' + data[i].AREA_NM + '</option>';
						}
					}

					htmlArea += '<option value="04, 08">13 | AREA D & ADCI</option><option value="05, 06, 07, 12">14 | AREA A1 - A5</option>';

					// set dropdown list section/line on field query
					$('#area_no').html(htmlArea);
					$('#area_no').val("");

				}
			});
		}

		// load dropdown data building
		function loadInputBuild() {
			var area_no = $('#area_no').val();

			$.ajax({
				url: "<?php echo base_url('users/Audit/dataBuild'); ?>",
				method: "POST",
				data: {
					area_no: area_no
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {
					debugger
					var htmlBuild = '';
					var i;

					htmlBuild = '<option value="" selected disabled>-- Gedung --</option>'

					for (i = 0; i < data.length; i++) {
						htmlBuild += '<option value=' + data[i].BUILD_NO + '>' + data[i].BUILD_NO + ' | ' + data[i].BUILD_NM + '</option>';
					}

					$('#build_no').html(htmlBuild);
					$('#build_no').val("");

				}
			});
		}

		// load dropdown data building
		function loadEditBuild() {
			var area_no = $('#edit-area_no').val();

			$.ajax({
				url: "<?php echo base_url('users/Audit/dataBuild'); ?>",
				method: "POST",
				data: {
					area_no: area_no
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {
					debugger
					var htmlBuild = '';
					var i;

					htmlBuild = '<option value="" selected disabled>-- Gedung --</option>'

					for (i = 0; i < data.length; i++) {
						htmlBuild += '<option value=' + data[i].BUILD_NO + '>' + data[i].BUILD_NO + ' | ' + data[i].BUILD_NM + '</option>';
					}

					$('#edit-build_no').html(htmlBuild);

					// set value of form edit audit
					// if(area_no !== g_ean){
					//   //set default
					//   $('#edit-build_no').val("");
					//   $('#select2-edit-build_no-container').text("-- Gedung --");
					//   $('#edit-build_no').removeAttr('disabled');
					// }else{
					$('#edit-build_no').val(g_ebn).change();
					// }

				}
			});
		}

		// set interval function exec
		setInterval(loadAuditLayoutArea, 120000); // get new data every 2 minutes
	</script>

</body>

</html>