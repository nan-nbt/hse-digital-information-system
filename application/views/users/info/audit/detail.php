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
		<?php $this->load->view("layouts/_header.php") ?>

		<!-- Main content -->
		<section class="content" style="margin-top:10px;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">

						<?php
						$submit_id = [];
						$checkdate = [];
						$area_no = [];
						$build_no = [];

						foreach ($detail_audit as $detail) {
							if ($detail->CHECK_DATE !== null && !in_array($detail->CHECK_DATE, $checkdate)) {
								array_push($submit_id, $detail->SUBMIT_ID);
								array_push($checkdate, $detail->CHECK_DATE);
								array_push($area_no, $detail->AREA_NO);
								array_push($build_no, $detail->BUILD_NO);
							}
						}
						?>

						<input type="hidden" id="submit-id" value="<?php echo $submit_id[0]; ?>" />
						<input type="hidden" id="indate" value="<?php echo $checkdate[0]; ?>" />
						<input type="hidden" id="area_no" value="<?php echo $area_no[0]; ?>" />
						<input type="hidden" id="build_no" value="<?php echo $build_no[0]; ?>" />

						<!-- audit layout -->
						<div class="card card-default">
							<div id="audit-layout-master">
								<div class="card-header">
									<h1 class="text-center"><strong>DAFTAR PERIKSA DAN HASIL SD STANDARD WORK</strong></h1>
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
														<label class="col-form-label">AREA / GEDUNG</label>
													</div>
													<div class="col-md-9 border-bottom">
														: <span class="item" id="data-area"> </span>
													</div>
												</div>
											</div>
											<!-- /.form-group -->
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label class="col-form-label">AUDITEE</label>
													</div>
													<div class="col-md-9 border-bottom">
														: <span class="item" id="data-auditee"> </span>
													</div>
												</div>
											</div>
											<!-- /.form-group -->
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label class="col-form-label">AUDITOR</label>
													</div>
													<div class="col-md-9 border-bottom">
														: <span class="item" id="data-auditor"> </span>
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

								<div class="card-body">
									<table id="score-table" class="table table-bordered table-solid table-head-fixed" style="width: 100%;">
										<thead>
											<tr>
												<th class="align-middle text-center">NILAI</th>
												<th colspan="2" class="align-middle text-center">DESKRIPSI</th>
											</tr>
										</thead>
										<tbody id="data-score">
											<tr>
												<td class="text-center">0</td>
												<td>Memenuhi standar, diimplementasikan</td>
											</tr>
											<tr>
												<td class="text-center">1</td>
												<td>Terimplementasi namun tidak menyeluruh, ada temuan yang bersifat minor</td>
											</tr>
											<tr>
												<td class="text-center">1.5</td>
												<td>NA </td>
											</tr>
											<tr>
												<td class="text-center">2</td>
												<td>Tidak memenuhi standar, tidak ada implementasi, ada temuan yang bersifat sistematis </td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.audit-layout-master -->

							<div id="audit-layout-detail">
								<div class="card-body">
									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title text-bold">AUDIT ASPECT</h3>
											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-card-widget="collapse">
													<i class="fas fa-minus"></i>
												</button>
											</div>
										</div>
										<div class="card-body">
											<table id="aspect-table" class="table table-bordered table-solid" style="width: 100%;">
												<thead>
													<tr>
														<th class="align-middle text-center">NO</th>
														<th colspan="3" class="align-middle text-center">ASPEK</th>
														<th class="align-middle text-center">BOBOT (%)</th>
														<th class="align-middle text-center">NILAI</th>
														<th class="align-middle text-center">TOTAL (%)</th>
														<th class="align-middle text-center">Deskripsi Temuan Masalah</th>
														<th class="align-middle text-center">Remarks</th>
													</tr>
												</thead>
												<tbody id="data-input-audit">
													<!-- Using JQuery for get data audit -->
													<tr>
														<td colspan="8" class="text-center">Tidak ada data audit tersedia</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /.card-body -->

								<div class="card-body">
									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title text-bold">JUMLAH KASUS KECELAKAAN KERJA</h3>
											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-card-widget="collapse">
													<i class="fas fa-minus"></i>
												</button>
											</div>
										</div>
										<div class="card-body">
											<table id="aspect-table" class="table table-bordered table-solid" style="width: 100%;">
												<thead>
													<tr>
														<th class="align-middle text-center">KATEGORI</th>
														<th class="align-middle text-center">JUMLAH</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Kasus Kecelakaan Kerja NLTI (Kasus Tidak Hilang Hari Kerja)</td>
														<td class="text-center"><span class="item" id="data-nlti"> </span></td>
													</tr>
													<tr>
														<td>Kasus Kecelakaan Kerja LTI ≤ 3 (Kasus Hilang Hari Kerja)</td>
														<td class="text-center"><span class="item" id="data-ltil3"> </span></td>
													</tr>
													<tr>
														<td>Kasus Kecelakaan Kerja LTI > 3 (Kasus Hilang Hari Kerja)</td>
														<td class="text-center"><span class="item" id="data-ltim3"> </span></td>
													</tr>
													<tr>
														<td>Total Hilang Hari Kerja</td>
														<td class="text-center"><span class="item" id="data-lostday"> </span></td>
													</tr>
													<tr>
														<td>Kebakaran Menggunakan 1 APAR</td>
														<td class="text-center"><span class="item" id="data-aparo1"> </span></td>
													</tr>
													<tr>
														<td>Kebakaran Menggunakan ≥ 2 APAR</td>
														<td class="text-center"><span class="item" id="data-aparm1"> </span></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /.card-body -->

								<div class="card-body">
									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title text-bold">TOTAL PENILAIAN HASIL AUDIT</h3>
											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-card-widget="collapse">
													<i class="fas fa-minus"></i>
												</button>
											</div>
										</div>
										<div class="card-body">
											<h1 class="text-center"><strong id="overall-audit"> <strong></h1>
										</div>
									</div>
								</div>
								<!-- /.card-body -->

								<div class="card-body">
									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title text-bold">AUDIT CHART DIAGRAM</h3>
											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-card-widget="collapse">
													<i class="fas fa-minus"></i>
												</button>
											</div>
										</div>
										<div class="card-body">
											<div class="chart">
												<canvas id="barChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
											</div>
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
			// call function 
			loadAuditLayout();
			loadAllAspectBySubmitId();
			loadChart();
			sessionValidate();
		});

		// pace-progress when ajax request
		$(document).ajaxStart(function() {
			Pace.restart();
		});

		// function load data on datatable plugin
		function loadAuditLayout() {
			debugger
			var indate = $('#indate').val();
			var area_no = $('#area_no').val();
			var build_no = $('#build_no').val();

			$.ajax({
				url: "<?php echo base_url('users/Audit/dataAuditLayout'); ?>",
				method: "POST",
				data: {
					area_no: area_no,
					indate: indate,
					build_no: build_no
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {
					debugger
					var submit_id = '';

					var htmlDataCheckDate = '';
					var htmlDataArea = '';
					var htmlDataAuditee = '';
					var htmlDataAuditor = '';

					var htmlLayoutMaster = '';
					// var htmllayoutDetail = '';
					var no = 1;
					var i;

					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							submit_id = data[i].SUBMIT_ID;
							var date = data[i].CHECK_DATE;
							var year = date.substr(0, 4);
							var month = date.substr(4, 2);
							var day = date.substr(6, 2);
							var check_date = year + '/' + month + '/' + day;

							htmlDataCheckDate = check_date;
							htmlDataArea = data[i].AREA_NM + ' / ' + data[i].BUILD_NM;
							htmlDataAuditee = data[i].AUDITEE;
							htmlDataAuditor = data[i].AUDITOR;
							htmlNLTI = data[i].NLTI;
							htmlLTIL3 = data[i].LTI_L3;
							htmlLTIM3 = data[i].LTI_M3;
							htmlLD = data[i].LOST_DAY;
							htmlAPARO1 = data[i].APAR_O1;
							htmlAPARM1 = data[i].APAR_M1;

						}

						$('#data-checkdate').text(htmlDataCheckDate);
						$('#data-area').text(htmlDataArea);
						$('#data-auditee').text(htmlDataAuditee);
						$('#data-auditor').text(htmlDataAuditor);
						$('#data-nlti').text(htmlNLTI);
						$('#data-ltil3').text(htmlLTIL3);
						$('#data-ltim3').text(htmlLTIM3);
						$('#data-lostday').text(htmlLD);
						$('#data-aparo1').text(htmlAPARO1);
						$('#data-aparm1').text(htmlAPARM1);

						// loadAllAspectBySubmitId(submit_id);
						// loadChart(submit_id);
					} else {
						$('#data-checkdate').text(htmlDataCheckDate);
						$('#data-area').text(htmlDataArea);
						$('#data-auditee').text(htmlDataAuditee);
						$('#data-auditor').text(htmlDataAuditor);
						$('#data-nlti').text(htmlNLTI);
						$('#data-ltil3').text(htmlLTIL3);
						$('#data-ltim3').text(htmlLTIM3);
						$('#data-lostday').text(htmlLD);
						$('#data-aparo1').text(htmlAPARO1);
						$('#data-aparm1').text(htmlAPARM1);

						// loadAllAspectBySubmitId(submit_id);
						// loadChart(submit_id);
					}
				}
			});
		}

		function loadAllAspectBySubmitId() {
			var submit_id = $('#submit-id').val();

			$.ajax({
				url: "<?php echo base_url('users/Audit/dataAllAspectBySubmitId'); ?>",
				method: "POST",
				data: {
					submit_id: submit_id
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {
					debugger
					var htmlTableLayout = [];
					var htmlCounting = [];
					var n = 1;
					var i;

					var htmlDimention = [];
					var htmlDimentionTemp = '';
					var htmlAspect = [];
					var htmlAspectTemp1 = '';
					var htmlAspectTemp2 = '';

					var dimentionAuditBarChart = [];
					var dimentionAuditBarChartTemp = '';
					var labelAuditBarChart = [];
					var labelAuditBarChartTemp = '';
					var dataAuditBarChart1 = [];
					var dataAuditBarChartTemp1 = '';
					// var dataAuditBarChart2 = [];
					// var dataAuditBarChartTemp2 = ''; 

					var overallAudit = '';

					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							htmlDimentionTemp = data[i].DIM_NO;
							htmlAspectTemp1 = data[i].ASPECT_NO;

							dataIssue = data[i].DESC_ISSUE;
							dataRemark = data[i].REMARK;

							if (dataIssue == null) {
								dataIssue = '';
							}
							if (dataRemark == null) {
								dataRemark = '';
							}

							if (!htmlDimention.includes(htmlDimentionTemp)) {
								htmlDimention.push(data[i].DIM_NO);
								var htmlList = '<tr>' +
									'<td colspan="9">Dimensi ' + data[i].DIM_NO + ': ' + data[i].DIM_NM + '</td>' +
									'</tr>' +
									'<tr>' +
									'<td rowspan="' + data[i].RS_DIM + '" class="align-middle">' + data[i].DIM_NM + '</td>' +
									'<td rowspan="' + data[i].RS_ASPECT + '" class="align-middle">' + data[i].ASPECT_NM + '</td>' +
									'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
									'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
									'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
									'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="score[]" id="score' + data[i].SASPECT_NO + '" min="0" max="2" maxlength="1" oninput="this.value = this.value.replace(/[^0-2.]/g, ``).replace(/(\..*?)\..*/g, `$1`);" value="' + data[i].SCORE + '" readonly>' + data[i].SCORE + '</td>' +
									'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="result[]" id="result' + data[i].SASPECT_NO + '" value="' + data[i].TOTAL + '" readonly>' + parseFloat(data[i].TOTAL).toFixed(2) + '</td>' +
									'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '" readonly>' + dataIssue + '</td>' +
									'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '" readonly>' + dataRemark + '</td>' +
									'</tr>';
								htmlAspectTemp2 = data[i].ASPECT_NO;
								htmlAspect.push(data[i].ASPECT_NO);
								htmlTableLayout.push(htmlList);
							} else if (!htmlAspect.includes(htmlAspectTemp1)) {
								if (data[i].ASPECT_NO !== htmlAspectTemp2) {
									htmlAspect.push(data[i].ASPECT_NO);
									var htmlList = '<tr>' +
										'<td rowspan="' + data[i].RS_ASPECT + '" class="align-middle">' + data[i].ASPECT_NM + '</td>' +
										'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="score[]" id="score' + data[i].SASPECT_NO + '" min="0" max="2" maxlength="1" oninput="this.value = this.value.replace(/[^0-2.]/g, ``).replace(/(\..*?)\..*/g, `$1`);" value="' + data[i].SCORE + '" readonly>' + data[i].SCORE + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="result[]" id="result' + data[i].SASPECT_NO + '" value="' + data[i].TOTAL + '" readonly>' + parseFloat(data[i].TOTAL).toFixed(2) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '" readonly>' + dataIssue + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '" readonly>' + dataRemark + '</td>' +
										'</tr>';
									htmlTableLayout.push(htmlList);
								} else {
									var htmlList = '<tr>' +
										'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="score[]" id="score' + data[i].SASPECT_NO + '" min="0" max="2" maxlength="1" oninput="this.value = this.value.replace(/[^0-2.]/g, ``).replace(/(\..*?)\..*/g, `$1`);" value="' + data[i].SCORE + '" readonly>' + data[i].SCORE + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="result[]" id="result' + data[i].SASPECT_NO + '" value="' + data[i].TOTAL + '" readonly>' + parseFloat(data[i].TOTAL).toFixed(2) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '" readonly>' + dataIssue + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '" readonly>' + dataRemark + '</td>' +
										'</tr>';
									htmlTableLayout.push(htmlList);
								}
							} else {
								if (parseInt(data[i].DIM_SEQ) == parseInt(data[i].RS_DIM)) {
									var htmlList = '<tr>' +
										'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="score[]" id="score' + data[i].SASPECT_NO + '" min="0" max="2" maxlength="1" oninput="this.value = this.value.replace(/[^0-2.]/g, ``).replace(/(\..*?)\..*/g, `$1`);" value="' + data[i].SCORE + '" readonly>' + data[i].SCORE + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="result[]" id="result' + data[i].SASPECT_NO + '" value="' + data[i].TOTAL + '" readonly>' + parseFloat(data[i].TOTAL).toFixed(2) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '" readonly>' + dataIssue + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '" readonly>' + dataRemark + '</td>' +
										'</tr>' +
										'<tr>' +
										'<td colspan="4">Total Dimensi ' + data[i].DIM_NO + ': ' + data[i].DIM_NM + '</td>' +
										'<td colspan="3" class="text-center" id="total"><strong>' + parseFloat(data[i].DIM_SUM).toFixed(2) + '%</strong></td>' +
										'<td colspan="2"></td>' +
										'</tr>';
									htmlTableLayout.push(htmlList);
								} else {
									var htmlList = '<tr>' +
										'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="score[]" id="score' + data[i].SASPECT_NO + '" min="0" max="2" maxlength="1" oninput="this.value = this.value.replace(/[^0-2.]/g, ``).replace(/(\..*?)\..*/g, `$1`);" value="' + data[i].SCORE + '" readonly>' + data[i].SCORE + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="result[]" id="result' + data[i].SASPECT_NO + '" value="' + data[i].TOTAL + '" readonly>' + parseFloat(data[i].TOTAL).toFixed(2) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '" readonly>' + dataIssue + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '" readonly>' + dataRemark + '</td>' +
										'</tr>';
									htmlTableLayout.push(htmlList);
								}
							}

							overallAudit = parseFloat(data[i].OVERALL_SUM / data[i].DIV_DIM) + parseFloat(data[i].PEN_SUM);

							// /** barchart data set by submit id */
							// dimentionAuditBarChartTemp = data[i].DIM_NO;
							// labelAuditBarChartTemp = data[i].DIM_NM;
							// dataAuditBarChartTemp1 = data[i].DIM_SUM;
							// // dataAuditBarChartTemp2 = 100-data[i].DIM_SUM;

							// if(!dimentionAuditBarChart.includes(dimentionAuditBarChartTemp) && dimentionAuditBarChartTemp !== 'E'){
							// 	dimentionAuditBarChart.push(dimentionAuditBarChartTemp);
							// 	labelAuditBarChart.push(labelAuditBarChartTemp);

							// 	dataAuditBarChart1.push(parseFloat(dataAuditBarChartTemp1).toFixed(2));
							// 	// dataAuditBarChart2.push(parseFloat(dataAuditBarChartTemp2).toFixed(2));
							// }

						}

						$('#data-input-audit').html(htmlTableLayout);
						$('#submit-detail').removeAttr('disabled');
						$('#overall-audit').text(overallAudit.toFixed(2) + '%');

						// /** update barcahrt canvas */
						// myBarChart.data.labels = labelAuditBarChart;
						// myBarChart.data.datasets[0].data = dataAuditBarChart1;
						// // myBarChart.data.datasets[1].data = dataAuditBarChart2;
						// myBarChart.update();

					} else {
						htmlTableLayout = '<tr>' +
							'<td colspan="8" class="text-center">Tidak ada data audit tersedia</td>' +
							'</tr>';

						$('#data-input-audit').html(htmlTableLayout);
						$('#submit-detail').attr('disabled', true);

					}
				}
			});
		}

		function loadChart() {
			var submit_id = $('#submit-id').val();

			/** bar chart - dimention aspect */
			var barChartCanvas = $('#barChart').get(0).getContext('2d')
			var barChartData = {
				labels: [],
				datasets: [{
						label: 'Score (%)',
						backgroundColor: 'rgba(60,141,188,0.9)',
						borderColor: 'rgba(60,141,188,0.8)',
						pointRadius: false,
						pointColor: '#3b8bba',
						pointStrokeColor: 'rgba(60,141,188,1)',
						pointHighlightFill: '#fff',
						pointHighlightStroke: 'rgba(60,141,188,1)',
						data: []
					},
					// {
					// label               : 'Loss (%)',
					// backgroundColor     : 'rgba(210, 214, 222, 1)',
					// borderColor         : 'rgba(210, 214, 222, 1)',
					// pointRadius         : false,
					// pointColor          : 'rgba(210, 214, 222, 1)',
					// pointStrokeColor    : '#c1c7d1',
					// pointHighlightFill  : '#fff',
					// pointHighlightStroke: 'rgba(220,220,220,1)',
					// data                : []
					// },
				]
			}

			var barChartOptions = {
				responsive: true,
				maintainAspectRatio: false,
				datasetFill: false,
				scales: {
					yAxes: [{
						display: true,
						ticks: {
							beginAtZero: true,
							min: 0,
							max: 100,
							stepSize: 10
						}
					}]
				}
			}

			var myBarChart = Chart.Bar(barChartCanvas, {
				data: barChartData,
				options: barChartOptions
			});

			$.ajax({
				url: "<?php echo base_url('users/Audit/dataAllAspectBySubmitId'); ?>",
				method: "POST",
				data: {
					submit_id: submit_id
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {

					var dimentionAuditBarChart = [];
					var dimentionAuditBarChartTemp = '';
					var labelAuditBarChart = [];
					var labelAuditBarChartTemp = '';
					var dataAuditBarChart1 = [];
					var dataAuditBarChartTemp1 = '';
					// var dataAuditBarChart2 = [];
					// var dataAuditBarChartTemp2 = ''; 

					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							/** barchart data set by submit id */
							dimentionAuditBarChartTemp = data[i].DIM_NO;
							labelAuditBarChartTemp = data[i].DIM_NM;
							dataAuditBarChartTemp1 = data[i].DIM_SUM;
							// dataAuditBarChartTemp2 = 100-data[i].DIM_SUM;

							if (!dimentionAuditBarChart.includes(dimentionAuditBarChartTemp) && dimentionAuditBarChartTemp !== 'E') {
								dimentionAuditBarChart.push(dimentionAuditBarChartTemp);
								labelAuditBarChart.push(labelAuditBarChartTemp);

								dataAuditBarChart1.push(parseFloat(dataAuditBarChartTemp1).toFixed(2));
								// dataAuditBarChart2.push(parseFloat(dataAuditBarChartTemp2).toFixed(2));
							}
						}

						/** update barcahrt canvas */
						myBarChart.data.labels = labelAuditBarChart;
						myBarChart.data.datasets[0].data = dataAuditBarChart1;
						// myBarChart.data.datasets[1].data = dataAuditBarChart2;
						myBarChart.update();

					} else {

						/** update barcahrt canvas */
						myBarChart.data.labels = labelAuditBarChart;
						myBarChart.data.datasets[0].data = dataAuditBarChart1;
						// myBarChart.data.datasets[1].data = dataAuditBarChart2;
						myBarChart.update();

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

		// set interval function exec. NB: 1 sec = 1000 ms;
		setInterval(loadAuditLayout, 120000);
		setInterval(loadAllAspectBySubmitId, 120000);
		setInterval(loadChart, 120000);
		setInterval(sessionValidate, 1200000);
	</script>

</body>

</html>