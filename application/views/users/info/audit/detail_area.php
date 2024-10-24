<!-- Session login check -->
<?php if ($this->session->userdata('hse_factory') == null && $this->session->userdata('hse_username') == null) {
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

<body class="hold-transition layout-top-nav text-sm">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Header -->
		<?php //require_once('_header.php'); 
		?>
		<?php $this->load->view("layouts/_header.php") ?>

		<!-- Main content -->
		<section class="content" style="margin-top:10px;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">

						<?php
						$checkdate = array();
						$area_no = array();

						foreach ($detail_audit_area as $detail) {
							if ($detail->CHECK_DATE !== null && !in_array($detail->CHECK_DATE, $checkdate)) {
								array_push($checkdate, $detail->CHECK_DATE);
							}

							if ($detail->AREA_NO !== null && !in_array($detail->AREA_NO, $area_no)) {
								array_push($area_no, $detail->AREA_NO);
							}
						}
						?>

						<input type="hidden" id="indate" value="<?php echo $checkdate[0]; ?>" />
						<input type="hidden" id="area_no" value="<?php echo implode(", ", $area_no); ?>" />

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
											<label><strong>LAYOUT AREA</strong></label>
										</div>
										<div class="card-body" id="layout-area">
											<div class="text-center"><span>Data tidak tersedia</span></div>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.audit-layout-detail -->

							<div id="note">
								<div class="card-body">
									<div class="card">
										<div class="card-header bg-primary">
											<label><strong>KETERANGAN</strong></label>
										</div>
										<div class="card-body" id="note-body">
											<!-- <table id="note-table" class="table table-bordered table-solid table-head-fixed" style="width: 100%;"> -->
											<table id="note-table" class="align-middle" style="width: 100%;">
												<tbody id="data-note">
													<tr>
														<td class="text-center"><span class="bs-stepper-circle bg-success border border-dark"></span></td>
														<td class="align-middle">: Level "LOW" dengan score lebih dari 90% s/d 100%</td>
													</tr>
													<tr>
														<td class="text-center"><span class="bs-stepper-circle bg-warning border border-dark"></span></td>
														<td class="align-middle">: Level "MEDIUM" dengan score lebih dari 80% s/d < 90%</td>
													</tr>
													<tr>
														<td class="text-center"><span class="bs-stepper-circle bg-danger border border-dark"></span></td>
														<td class="align-middle">: Kategori gedung dalam level "HIGH" dengan score < 80%, maka harus ada perbaikan dalam jangka waktu 3 bulan.</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
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

			// call function loadListAudit
			loadAuditLayoutArea();

			// call function check session
			sessionValidate();
		});

		// pace-progress when ajax request
		$(document).ajaxStart(function() {
			Pace.restart();
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
								'<div style="position: absolute; bottom: 10px; left: 20px;" class="bs-stepper-circle ' + colorBuild3 + ' border border-dark t-tooltip">' +
								'<span class="t-tooltiptext">' + nameBuild3 + ': ' + statusBuild3 + ' (' + totalBuild3.toFixed(2) + '%)</span>' +
								'</div>' +
								'<div style="position: absolute; top: 10px; left: 20px;" class="bs-stepper-circle ' + colorBuild6 + ' border border-dark t-tooltip">' +
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
								'<div style="position: absolute; top: 10px; left: 170px;" class="bs-stepper-circle ' + colorBuild1 + ' border border-dark t-tooltip">' +
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

						if (dataArea !== '') {
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

		// function to chcek session expired
		function sessionValidate() {
			debugger
			$.ajax({
				url: "<?php echo base_url('users/Log/session_check'); ?>",
				success: function(data) {
					debugger
					if (data == "false") {
						location.reload();
					}
				}
			});
		}

		// set interval function exec
		setInterval(loadAuditLayoutArea, 120000); // get new data every 2 minutes
		setInterval(sessionValidate, 1200000); // interval 1 hour  
	</script>

</body>

</html>