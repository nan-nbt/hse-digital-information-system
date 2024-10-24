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
									<form class="form-horizontal" id="audit-query">
										<div class="row">
											<div class="col-md-3">
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
											<div class="col-md-3">
												<div class="form-group">
													<label for="area_no" style="margin-bottom:9px;"><span class="text-danger">*</span>Area :</label>
													<select class="form-control select2bs4" style="width: 100%;" id="area_no" name="area_no" required>
														<option value="" selected>-- Area --</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="build_no" style="margin-bottom:9px;"><span class="text-danger">*</span>Gedung :</label>
													<select class="form-control select2bs4" style="width: 100%;" id="build_no" name="build_no" required disabled>
														<option value="" selected>-- Gedung --</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
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
										<h1 class="text-center">
											<strong>DAFTAR PERIKSA DAN HASIL SD STANDARD WORK</strong>
										</h1>
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
													<td colspan="9" class="text-center">Tidak ada data audit tersedia</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- /.card-body -->

									<form action="<?php echo base_url('users/Audit/dataAuditLayoutDetail'); ?>" method="POST" target="hse_audit_detail">
										<div class="modal-footer justify-content-between">
											<input type="hidden" id="indate-detail" name="indate-detail" />
											<input type="hidden" id="area-detail" name="area-detail" />
											<input type="hidden" id="build-detail" name="build-detail" />
											<button type="submit" class="btn btn-primary col-12" id="submit-detail" disabled>Buka Halaman Detail <i class="fas fa-arrow-right"></i></button>
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
		// declare global variable
		var g_tablem;
		var g_tabled;

		var g_esi;
		var g_esd;
		var g_esu;
		var g_ecd;
		var g_ean;
		var g_ebn;
		var g_eae;
		var g_ear;

		// page onload function
		$(document).ready(function() {
			// call function 
			loadArea();
		});

		// pace-progress when ajax request
		$(document).ajaxStart(function() {
			Pace.restart();
		});

		// function onclick button query
		$('#audit-query').on('submit', function() {
			debugger
			var indate_detail = $('#indate').val();
			var area_detail = $('#area_no').val();
			var build_detail = $('#build_no').val();

			// set icon progress load
			$('#query').html('<i class="fas fa-circle-notch fa-spin"></i>');

			$('#indate-detail').val(indate_detail);
			$('#area-detail').val(area_detail);
			$('#build-detail').val(build_detail);

			// call function loadListAudit
			loadAuditLayout();

			return false;
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
						}

						$('#data-checkdate').text(htmlDataCheckDate);
						$('#data-area').text(htmlDataArea);
						$('#data-auditee').text(htmlDataAuditee);
						$('#data-auditor').text(htmlDataAuditor);

						$('#query').text('Query');

						loadAllAspectBySubmitId(submit_id);
					} else {
						$('#data-checkdate').text(htmlDataCheckDate);
						$('#data-area').text(htmlDataArea);
						$('#data-auditee').text(htmlDataAuditee);
						$('#data-auditor').text(htmlDataAuditor);

						$('#query').text('Query');

						loadAllAspectBySubmitId(submit_id);
					}
				}
			});
		}
	</script>

	<!-- Modal Form Input JS -->
	<script>
		function loadAllAspectBySubmitId(submit_id) {
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
								debugger
								if (parseInt(data[i].DIM_SEQ) == parseInt(data[i].RS_DIM)) {
									debugger
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
						}

						$('#data-input-audit').html(htmlTableLayout);
						$('#submit-detail').removeAttr('disabled');

					} else {
						htmlTableLayout = '<tr>' +
							'<td colspan="9" class="text-center">Tidak ada data audit tersedia</td>' +
							'</tr>';

						$('#data-input-audit').html(htmlTableLayout);
						$('#submit-detail').attr('disabled', true);

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
					var htmlArea = '';
					var i;

					htmlArea = '<option value="" selected disabled>-- Area --</option>';

					for (i = 0; i < data.length; i++) {
						htmlArea += '<option value=' + data[i].AREA_NO + '>' + data[i].AREA_NO + ' | ' + data[i].AREA_NM + '</option>';
					}

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

		// function set default when select area
		$('#area_no').on('change', function() {
			//set default
			$('#build_no').val("");
			$('#select2-build_no-container').text("-- Gedung --");
			$('#build_no').removeAttr('disabled');

			loadInputBuild();

			return false;
		});
	</script>

</body>

</html>