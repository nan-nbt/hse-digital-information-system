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
				<!-- /.container-fluid -->
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
													<label for="startdate"><span class="text-danger">*</span>Check Date Start :</label>
													<div class="input-group date" id="startdate" data-target-input="nearest">
														<input type="text" class="form-control datetimepicker-input" data-target="#startdate" id="startdate_query" name="startdate" value="<?php echo date('Y/m/d'); ?>" required />
														<div class="input-group-append" data-target="#startdate" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="enddate"><span class="text-danger">*</span>Check Date End :</label>
													<div class="input-group date" id="enddate" data-target-input="nearest">
														<input type="text" class="form-control datetimepicker-input" data-target="#enddate" id="enddate_query" name="enddate" value="<?php echo date('Y/m/d'); ?>" required />
														<div class="input-group-append" data-target="#enddate" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="area_no_query" style="margin-bottom:9px;">Area :</label>
													<select class="form-control select2bs4" style="width: 100%;" id="area_no_query" name="area_no_query">
														<option value="" selected>-- Area --</option>
													</select>
												</div>
											</div>
											<div class="col-md-1">
												<div class="form-group">
													<label for="query" style="margin-top:13px;"></label>
													<button type="submit" class="form-control btn btn-primary" id="query">Query</button>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label for="input-col" style="margin-top:13px;"></label>
													<button type="button" class="form-control btn btn-default" data-toggle="modal" data-target="#modal-input-audit" id="input-col">
														<i class="fas fa-plus-circle"></i> Input Data Audit
													</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="audit-table-master" class="table table-bordered table-striped table-head-fixed nowrap text-nowrap" style="width: 100%;">
										<thead class="text-center">
											<tr>
												<th>NO</th>
												<th>ACTION</th>
												<th>CHECK DATE</th>
												<th>AREA</th>
												<th>BUILDING</th>
												<th>AUDITEE</th>
												<th>AUDITOR</th>
												<th>LTI ≤ 3</th>
												<th>LTI > 3</th>
												<th>TOTAL LTI</th>
												<th>TOTAL NLTI</th>
												<th>TOTAL LOST DAY</th>
												<th>USE 1 APAR</th>
												<th>USE ≥ 2 APAR</th>
												<th>SUBMIT ID</th>
												<th>SUBMIT DATE</th>
												<th>SUBMIT USER</th>
											</tr>
										</thead>
										<tbody id="list-audit-master">
											<!-- Using JQuery for get data audit -->
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->

								<div class="card-body">
									<table id="audit-table-detail" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
										<thead class="text-center">
											<tr>
												<th class="align-middle">NO</th>
												<th class="align-middle">DIMENSI</th>
												<th class="align-middle">ASPECT</th>
												<th class="align-middle">SUB ASPECT</th>
												<th class="align-middle">BOBOT (%)</th>
												<th class="align-middle">NILAI</th>
												<th class="align-middle">TOTAL (%)</th>
												<th class="align-middle">ISSUE</th>
												<th class="align-middle">REMARK</th>
											</tr>
										</thead>
										<tbody id="list-audit-detail">
											<!-- Using JQuery for get data audit -->
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->

				<!-- Modal Form Input Data Audit -->
				<div class="modal fade" id="modal-input-audit">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Input Data Audit SD Standard Work</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<!-- form start -->
							<form class="form-horizontal" id="form-input-audit" method="POST">
								<div class="modal-body">
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="checkdate" class="col-form-label"><span class="text-danger">*</span>Tanggal Pengecekan :</label>
													<div class="input-group date" id="checkdate-group" data-target-input="nearest">
														<input type="text" class="form-control datetimepicker-input" data-target="#checkdate" id="checkdate" name="checkdate" value="<?php echo date('Y/m/d'); ?>" required />
														<div class="input-group-append" data-target="#checkdate" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<label class="col-form-label"><span class="text-danger">*</span>Area / Gedung :</label>
													<div class="row">
														<div class="col-md-6">
															<select class="form-control select2bs4" style="width: 100%;" id="area_no" name="area_no" required>
																<option value="" selected disabled>-- Area --</option>
															</select>
														</div>
														<div class="col-md-6">
															<select class="form-control select2bs4" style="width: 100%;" id="build_no" name="build_no" required disabled>
																<option value="" selected disabled>-- Gedung --</option>
															</select>
														</div>
													</div>
												</div>
												<!-- /.form-group -->
											</div>
											<!-- /.col-md-6 -->
											<div class="col-md-6">
												<div class="form-group">
													<label for="auditee" class="col-form-label"><span class="text-danger">*</span>Auditee :</label>
													<input type="text" class="form-control" id="auditee" name="auditee" placeholder="Auditee" required>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<label for="auditor" class="col-form-label"><span class="text-danger">*</span>Auditor :</label>
													<input type="text" class="form-control" id="auditor" name="auditor" placeholder="Auditor" required>
												</div>
												<!-- /.form-group -->
											</div>
											<!-- /.col-md-6 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.card-body -->

									<div class="card-body">
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kasus Kecelakaan Kerja NLTI :</label>
													<input type="number" class="form-control" name="nlti" id="nlti" oninput="penaltyInputScore()" placeholder="Total Kecelakaan Kerja NLTI" value="0" min="0" required>
												</div>
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kasus Kecelakaan Kerja LTI ≤ 3 :</label>
													<input type="number" class="form-control" name="ltil3" id="ltil3" oninput="penaltyInputScore();" placeholder="Kasus Kecelakaan Kerja LTI ≤ 3" value="0" min="0" required>
												</div>
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kasus Kecelakaan Kerja LTI > 3 :</label>
													<input type="number" class="form-control" name="ltim3" id="ltim3" oninput="penaltyInputScore()" placeholder="Kasus Kecelakaan Kerja LTI > 3" value="0" min="0" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Total Hilang Hari Kerja :</label>
													<input type="number" class="form-control" name="lostday" id="lostday" oninput="penaltyInputScore()" placeholder="Total Hilang Hari Kerja" value="0" min="0" required>
												</div>
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kebakaran Menggunakan 1 APAR :</label>
													<input type="number" class="form-control" name="aparo1" id="aparo1" oninput="penaltyInputScore();" placeholder="Kebakaran Menggunakan 1 APAR" value="0" min="0" required>
												</div>
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kebakaran Menggunakan ≥ 2 APAR :</label>
													<input type="number" class="form-control" name="aparm1" id="aparm1" oninput="penaltyInputScore()" placeholder="Kebakaran Menggunakan ≥ 2 APAR" value="0" min="0" required>
												</div>
											</div>
										</div>
									</div>
									<!-- /.card-body -->

									<div class="card-body">
										<label class="col-form-label">Kriteria Nilai</label>
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

									<div class="card-body">
										<label class="col-form-label"><span class="text-danger">*</span>Aspek Penilaian</label>
										<table id="aspect-table" class="table table-bordered table-solid table-head-fixed" style="width: 100%;">
											<thead>
												<tr>
													<th class="align-middle text-center">NO</th>
													<th colspan="3" class="align-middle text-center">ASPEK</th>
													<th class="align-middle text-center">BOBOT (%)</th>
													<th class="align-middle text-center">NILAI</th>
													<th class="align-middle text-center">Deskripsi Temuan Masalah</th>
													<th class="align-middle text-center">Remarks</th>
												</tr>
											</thead>
											<tbody id="data-input-audit">
												<!-- Using JQuery for get data audit -->
											</tbody>
										</table>
									</div>
									<!-- /.card-body -->
								</div>
								<!-- /.modal-body -->
								<div class="modal-footer justify-content-between">
									<button type="reset" class="btn btn-default" id="reset">Cancel</button>
									<button type="submit" class="btn btn-primary" id="submit-audit">Submit</button>
								</div>
							</form>
							<!-- /.form -->

						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<!-- Modal Form Edit Data Audit -->
				<div class="modal fade" id="modal-edit-audit">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Edit Data Audit SD Standard Work</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<!-- form start -->
							<form class="form-horizontal" id="form-edit-audit" method="POST">
								<div class="modal-body">
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="edit-checkdate" class="col-form-label"><span class="text-danger">*</span>Tanggal Pengecekan :</label>
													<div class="input-group date" id="edit-checkdate-group" data-target-input="nearest">
														<input type="hidden" class="form-control" id="submit_id" name="submit_id" />
														<input type="text" class="form-control datetimepicker-input" data-target="#edit-checkdate" id="edit-checkdate" name="edit-checkdate" required disabled />
														<div class="input-group-append" data-target="#edit-checkdate" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<label class="col-form-label"><span class="text-danger">*</span>Area / Gedung :</label>
													<div class="row">
														<div class="col-md-6">
															<select class="form-control select2bs4" style="width: 100%;" id="edit-area_no" name="edit-area_no" required disabled>
																<option value="" selected disabled>-- Area --</option>
															</select>
														</div>
														<div class="col-md-6">
															<select class="form-control select2bs4" style="width: 100%;" id="edit-build_no" name="edit-build_no" required disabled>
																<option value="" selected disabled>-- Gedung --</option>
															</select>
														</div>
													</div>
												</div>
												<!-- /.form-group -->
											</div>
											<!-- /.col-md-6 -->
											<div class="col-md-6">
												<div class="form-group">
													<label for="edit-auditee" class="col-form-label"><span class="text-danger">*</span>Auditee :</label>
													<input type="text" class="form-control" id="edit-auditee" name="edit-auditee" placeholder="Auditee" required disabled>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<label for="edit-auditor" class="col-form-label"><span class="text-danger">*</span>Auditor :</label>
													<input type="text" class="form-control" id="edit-auditor" name="edit-auditor" placeholder="Auditor" required disabled>
												</div>
												<!-- /.form-group -->
											</div>
											<!-- /.col-md-6 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.card-body -->

									<div class="card-body">
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kasus Kecelakaan Kerja NLTI :</label>
													<input type="number" class="form-control" name="edit-nlti" id="edit-nlti" oninput="penaltyEditScore()" placeholder="Total Kecelakaan Kerja NLTI" value="0" min="0" required>
												</div>
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kasus Kecelakaan Kerja LTI ≤ 3 :</label>
													<input type="number" class="form-control" name="edit-ltil3" id="edit-ltil3" oninput="penaltyEditScore();" placeholder="Kasus Kecelakaan Kerja LTI ≤ 3" value="0" min="0" required>
												</div>
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kasus Kecelakaan Kerja LTI > 3 :</label>
													<input type="number" class="form-control" name="edit-ltim3" id="edit-ltim3" oninput="penaltyEditScore()" placeholder="Kasus Kecelakaan Kerja LTI > 3" value="0" min="0" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Total Hilang Hari Kerja :</label>
													<input type="number" class="form-control" name="edit-lostday" id="edit-lostday" oninput="penaltyEditScore()" placeholder="Total Hilang Hari Kerja" value="0" min="0" required>
												</div>
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kebakaran Menggunakan 1 APAR :</label>
													<input type="number" class="form-control" name="edit-aparo1" id="edit-aparo1" oninput="penaltyEditScore();" placeholder="Kebakaran Menggunakan 1 APAR" value="0" min="0" required>
												</div>
												<div class="col-md-4">
													<label class="col-form-label"><span class="text-danger">*</span>Kebakaran Menggunakan ≥ 2 APAR :</label>
													<input type="number" class="form-control" name="edit-aparm1" id="edit-aparm1" oninput="penaltyEditScore()" placeholder="Kebakaran Menggunakan ≥ 2 APAR" value="0" min="0" required>
												</div>
											</div>
										</div>
									</div>
									<!-- /.card-body -->

									<div class="card-body">
										<label class="col-form-label">Kriteria Nilai</label>
										<table id="edit-score-table" class="table table-bordered table-solid table-head-fixed" style="width: 100%;">
											<thead>
												<tr>
													<th class="align-middle text-center">NILAI</th>
													<th colspan="2" class="align-middle text-center">DESKRIPSI</th>
												</tr>
											</thead>
											<tbody id="edit-data-score">
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

									<div class="card-body">
										<label class="col-form-label"><span class="text-danger">*</span>Aspek Penilaian</label>
										<table id="edit-aspect-table" class="table table-bordered table-solid table-head-fixed" style="width: 100%;">
											<thead>
												<tr>
													<th class="align-middle text-center">NO</th>
													<th colspan="3" class="align-middle text-center">ASPEK</th>
													<th class="align-middle text-center">BOBOT (%)</th>
													<th class="align-middle text-center">NILAI</th>
													<th class="align-middle text-center">Deskripsi Temuan Masalah</th>
													<th class="align-middle text-center">Remarks</th>
												</tr>
											</thead>
											<tbody id="edit-data-input-audit">
												<!-- Using JQuery for get data audit -->
											</tbody>
										</table>
									</div>
									<!-- /.card-body -->
								</div>
								<!-- /.modal-body -->
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-default" id="edit-reset">Cancel</button>
									<button type="submit" class="btn btn-primary" id="update-audit">Update</button>
								</div>
							</form>
							<!-- /.form -->

						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<!-- Modal Form Delete Data Process -->
				<div class="modal fade" id="modal-delete-audit">
					<div class="modal-dialog modal-default">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Delete Audit Data</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<!-- form start -->
							<form class="form-horizontal" id="form-delete-audit" method="POST">
								<div class="modal-body">
									<input type="hidden" class="form-control" id="id-audit" name="id-audit">
									<span>Are sure to delete this Audit data?</span>
								</div>
								<!-- /.modal-body -->
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">No</button>
									<button type="submit" class="btn btn-primary">Yes</button>
								</div>
							</form>
							<!-- /.form -->
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

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
		var g_enlti;
		var g_eltil3;
		var g_eltim3;
		var g_eld;
		var g_eao1;
		var g_eam1;

		// page onload function
		$(document).ready(function() {
			// call function 
			loadListAudit();
			loadListAuditDetail();
			loadArea();
			loadInputAllAspect();

		});

		// pace-progress when ajax request
		$(document).ajaxStart(function() {
			Pace.restart();
		});

		// function onclick button query
		$('#audit-query').on('submit', function() {
			// set icon progress load
			$('#query').html('<i class="fas fa-circle-notch fa-spin"></i>');

			// call function loadListAudit
			loadListAudit();
			loadListAuditDetail();

			return false;
		});

		// function edit list data audit
		$('#list-audit-master').on('click', '.edit-row', function() {
			debugger
			$('#modal-edit-audit').modal('show');
			$('#submit_id').val($(this).data('submit_id')).change();
			$('#edit-checkdate').val($(this).data('check_date')).change();
			$('#edit-area_no').val($(this).data('area_no')).change();
			// $('#edit-build_no').val($(this).data('build_no')).change();
			$('#edit-auditee').val($(this).data('auditee')).change();
			$('#edit-auditor').val($(this).data('auditor')).change();
			$('#edit-nlti').val($(this).data('nlti')).change();
			$('#edit-ltil3').val($(this).data('ltil3')).change();
			$('#edit-ltim3').val($(this).data('ltim3')).change();
			$('#edit-lostday').val($(this).data('lostday')).change();
			$('#edit-aparo1').val($(this).data('aparo1')).change();
			$('#edit-aparm1').val($(this).data('aparm1')).change();

			// set default value for reset form edit (global variable)
			g_esi = $(this).data('submit_id');
			g_esd = $(this).data('submit_date');
			g_esu = $(this).data('submit_user');
			g_ecd = $(this).data('check_date');
			g_ean = $(this).data('area_no');
			g_ebn = $(this).data('build_no');
			g_eae = $(this).data('auditee');
			g_ear = $(this).data('auditor');
			g_enlti = $(this).data('nlti');
			g_eltil3 = $(this).data('ltil3');
			g_eltim3 = $(this).data('ltim3');
			g_eld = $(this).data('lostday');
			g_eao1 = $(this).data('aparo1');
			g_eam1 = $(this).data('aparm1');

			loadEditBuild();
			loadEditAllAspect();
		});

		// function delete list audit
		$('#list-audit-master').on('click', '.delete-row', function() {
			debugger
			// set default value submit_id for delete data audit (global variable)
			var submit_id = $(this).data('submit_id');
			$('#modal-delete-audit').modal('show');
			$('#id-audit').val(submit_id);
		});

		// delete emp record
		$('#form-delete-audit').on('submit', function() {
			debugger
			// declare local variable
			var submit_id = $('#id-audit').val();

			$.ajax({
				url: "<?php echo base_url('users/Audit/delete/'); ?>" + submit_id,
				type: "POST",
				dataType: 'JSON',
				data: {
					submit_id: submit_id
				},
				success: function(data) {
					debugger
					// reset id-audit filed value
					$("#" + submit_id).remove();
					$('#id-audit').val("");

					$('#modal-delete-audit').modal('hide');

					if (data == true) {
						// load alert message success
						var Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000
						});
						Toast.fire({
							icon: 'success',
							title: 'Alert! \n delete successfull!'
						});

						loadListAudit();
						loadListAuditDetail();
					} else {
						// load alert message error
						var Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000
						});
						Toast.fire({
							icon: 'error',
							title: 'Alert! \n delete failed!'
						});
					}
				}
			});

			return false;

		});

		// function load data on datatable plugin
		function loadListAudit() {
			debugger
			var startdate = $('#startdate_query').val();
			var enddate = $('#enddate_query').val();
			var area_no_query = $('#area_no_query').val();

			$.ajax({
				url: "<?php echo base_url('users/Audit/dataRecAudit'); ?>",
				method: "POST",
				data: {
					area_no_query: area_no_query,
					startdate: startdate,
					enddate: enddate
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {
					var htmlData = '';
					var no = 1;
					var i;
					debugger
					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							htmlData += '<tr>' +
								'<td>' + no++ + '</td>' +
								'<td>' +
								'<a href="javascript:void(0);" class="btn btn-sm p-0 edit-row"' +
								'data-submit_id="' + data[i].SUBMIT_ID + '"' +
								'data-submit_date="' + data[i].SUBMIT_DATE + '"' +
								'data-submit_user="' + data[i].SUBMIT_USER + '"' +
								'data-check_date="' + data[i].CHECK_DATE + '"' +
								'data-area_no="' + data[i].AREA_NO + '"' +
								'data-build_no="' + data[i].BUILD_NO + '"' +
								'data-auditee="' + data[i].AUDITEE + '"' +
								'data-auditor="' + data[i].AUDITOR + '"' +
								'data-lti="' + data[i].LTI + '"' +
								'data-nlti="' + data[i].NLTI + '"' +
								'data-lostday="' + data[i].LOST_DAY + '"' +
								'data-ltil3="' + data[i].LTI_L3 + '"' +
								'data-ltim3="' + data[i].LTI_M3 + '"' +
								'data-aparo1="' + data[i].APAR_O1 + '"' +
								'data-aparm1="' + data[i].APAR_M1 + '">' +
								'<i class="fas fa-edit"></i></a>' +
								' | <a href="javascript:void(0);" class="btn btn-sm p-0 delete-row" data-submit_id="' + data[i].SUBMIT_ID + '"><i class="fas fa-trash"></i></a>' +
								'</td>' +
								'<td>' + data[i].CHECK_DATE + '</td>' +
								'<td>' + data[i].AREA_NO + ' | ' + data[i].AREA_NM + '</td>' +
								'<td>' + data[i].BUILD_NO + ' | ' + data[i].BUILD_NM + '</td>' +
								'<td>' + data[i].AUDITEE + '</td>' +
								'<td>' + data[i].AUDITOR + '</td>' +
								'<td>' + data[i].LTI_L3 + '</td>' +
								'<td>' + data[i].LTI_M3 + '</td>' +
								'<td>' + data[i].LTI + '</td>' +
								'<td>' + data[i].NLTI + '</td>' +
								'<td>' + data[i].LOST_DAY + '</td>' +
								'<td>' + data[i].APAR_O1 + '</td>' +
								'<td>' + data[i].APAR_M1 + '</td>' +
								'<td>' + data[i].SUBMIT_ID + '</td>' +
								'<td>' + data[i].SUBMIT_DATE + '</td>' +
								'<td>' + data[i].SUBMIT_USER + '</td>' +
								'</tr>';
						}

						$('#audit-table-master').DataTable().destroy();
						$('#list-audit-master').html(htmlData);
						$('#query').text('Query');

						g_tablem = $('#audit-table-master').DataTable({
							"paging": true,
							"lengthChange": true,
							"searching": false,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"responsive": false,
							"scrollY": 150,
							"scrollX": true,
							// "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

							/************************************************************
							  set load data in current page: datatable pagination load   
							************************************************************/
							"bStateSave": true,
							"fnStateSave": function(oSettings, oData) {
								localStorage.setItem('offersDataTables', JSON.stringify(oData));
							},
							"fnStateLoad": function(oSettings) {
								return JSON.parse(localStorage.getItem('offersDataTables'));
							}
							/****************************************************************
							  .end set load data in current page: datatable pagination load   
							****************************************************************/
						});

						g_tablem.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

						// function on row data click get data row
						$('#audit-table-master tbody').on('click', 'tr', function() {
							// get row data on the table
							var data = g_tablem.row(this).data();
							loadListAuditDetail(data[14]);

							// set background color row selected
							// if ($(this).hasClass('selected')) {
							//   $(this).removeClass('selected');
							// } else {
							g_tablem.$('tr.selected').removeClass('selected');
							$(this).addClass('selected');
							// }
						});

					} else {
						$('#audit-table-master').DataTable().destroy();
						$('#list-audit-master').html(htmlData);
						$('#query').text('Query');

						g_tablem = $('#audit-table-master').DataTable({
							"paging": true,
							"lengthChange": true,
							"searching": false,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"responsive": false,
							"scrollY": 150,
							"scrollX": true,
							// "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
						});

						g_tablem.buttons().container().appendTo('#audit-table-master_wrapper .col-md-6:eq(0)');

					}
				}
			});
		}

		// function load data on datatable plugin
		function loadListAuditDetail(submit_id) {
			$.ajax({
				url: "<?php echo base_url('users/Audit/dataRecAuditDetail'); ?>",
				method: "POST",
				data: {
					submit_id: submit_id
				},
				async: true,
				dataType: 'JSON',
				success: function(data) {
					var htmlData = '';
					var no = 1;
					var i;

					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							var dataIssue = data[i].DESC_ISSUE;
							var dataRemark = data[i].REMARK;

							if (dataIssue == null) {
								dataIssue = '';
							}

							if (dataRemark == null) {
								dataRemark = '';
							}

							htmlData += '<tr>' +
								'<td>' + no++ + '</td>' +
								'<td>' + data[i].DIM_NM + '</td>' +
								'<td>' + data[i].ASPECT_NM + '</td>' +
								'<td>' + data[i].SASPECT_NM + '</td>' +
								'<td>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
								'<td>' + data[i].SCORE + '</td>' +
								'<td>' + parseFloat(data[i].TOTAL).toFixed(2) + '</td>' +
								'<td>' + dataIssue + '</td>' +
								'<td>' + dataRemark + '</td>' +
								'</tr>';
						}

						$('#audit-table-detail').DataTable().destroy();
						$('#list-audit-detail').html(htmlData);

						g_tabled = $('#audit-table-detail').DataTable({
							"paging": true,
							"lengthChange": true,
							"searching": false,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"responsive": false,
							"scrollY": 150,
							"scrollX": true,
							// "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

							/************************************************************
							  set load data in current page: datatable pagination load   
							************************************************************/
							"bStateSave": true,
							"fnStateSave": function(oSettings, oData) {
								localStorage.setItem('offersDataTables', JSON.stringify(oData));
							},
							"fnStateLoad": function(oSettings) {
								return JSON.parse(localStorage.getItem('offersDataTables'));
							}
							/****************************************************************
							  .end set load data in current page: datatable pagination load   
							****************************************************************/
						});

						g_tabled.buttons().container().appendTo('#audit-table-detail_wrapper .col-md-6:eq(0)');

					} else {
						$('#audit-table-detail').DataTable().destroy();
						$('#list-audit-detail').html(htmlData);

						g_tabled = $('#audit-table-detail').DataTable({
							"paging": true,
							"lengthChange": true,
							"searching": false,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"responsive": false,
							"scrollY": 150,
							"scrollX": true,
							// "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
						});

						g_tabled.buttons().container().appendTo('#audit-table-detail_wrapper .col-md-6:eq(0)');

					}
				}
			});
		}
	</script>

	<!-- Modal Form Input JS -->
	<script>
		function loadInputAllAspect() {
			$.ajax({
				url: "<?php echo base_url('users/Audit/dataAllAspect'); ?>",
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

							if (htmlDimentionTemp == 'E') {
								var htmlInputScore = '<input type="hidden" class="form-control" name="score[]" id="score' + data[i].SASPECT_NO + '" value="0" required><span id="label-score' + data[i].SASPECT_NO + '">0</span>';
							} else {
								var htmlInputScore = '<input type="number" class="form-control border-0 p-0" name="score[]" id="score' + data[i].SASPECT_NO + '" step="any" min="0" max="2" value="2" required>';
							}

							if (!htmlDimention.includes(htmlDimentionTemp)) {
								htmlDimention.push(data[i].DIM_NO);
								var htmlList = '<tr>' +
									'<td colspan="8">Dimensi ' + data[i].DIM_NO + ': ' + data[i].DIM_NM + '</td>' +
									'</tr>' +
									'<tr>' +
									'<td rowspan="' + data[i].RS_DIM + '" class="align-middle">' + data[i].DIM_NM + '</td>' +
									'<td rowspan="' + data[i].RS_ASPECT + '" class="align-middle">' + data[i].ASPECT_NM + '</td>' +
									'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
									'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
									'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
									'<td class="align-middle">' + htmlInputScore + '</td>' +
									'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '"></td>' +
									'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '"></td>' +
									'</tr>';
								htmlAspectTemp2 = data[i].ASPECT_NO;
								htmlTableLayout.push(htmlList);
							} else if (!htmlAspect.includes(htmlAspectTemp1)) {
								if (data[i].ASPECT_NO !== htmlAspectTemp2) {
									htmlAspect.push(data[i].ASPECT_NO);
									var htmlList = '<tr>' +
										'<td rowspan="' + data[i].RS_ASPECT + '" class="align-middle">' + data[i].ASPECT_NM + '</td>' +
										'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
										'<td class="align-middle">' + htmlInputScore + '</td>' +
										'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '"></td>' +
										'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '"></td>' +
										'</tr>';
									htmlTableLayout.push(htmlList);
								} else {
									var htmlList = '<tr>' +
										'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
										'<td class="align-middle">' + htmlInputScore + '</td>' +
										'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '"></td>' +
										'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '"></td>' +
										'</tr>';
									htmlTableLayout.push(htmlList);
								}
							} else {
								var htmlList = '<tr>' +
									'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
									'<td class="align-middle"><input type="hidden" class="form-control" id="submit_seq' + data[i].SASPECT_NO + '" name="submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="saspect[]" id="saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
									'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="weight[]" id="weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
									'<td class="align-middle">' + htmlInputScore + '</td>' +
									'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="issue[]" id="issue' + data[i].SASPECT_NO + '"></td>' +
									'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="remark[]" id="remark' + data[i].SASPECT_NO + '"></td>' +
									'</tr>';
								htmlTableLayout.push(htmlList);
							}
						}

						$('#data-input-audit').html(htmlTableLayout);

					}
				}
			});
		}

		function loadEditAllAspect() {
			var submit_id = $('#submit_id').val();

			$.ajax({
				url: "<?php echo base_url('users/Audit/dataAllAspectBySubmitId'); ?>",
				async: true,
				method: "POST",
				data: {
					submit_id: submit_id
				},
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

							dataScore = data[i].SCORE;
							dataIssue = data[i].DESC_ISSUE;
							dataRemark = data[i].REMARK;

							if (htmlDimentionTemp == 'E') {
								var htmlEditScore = '<input type="hidden" class="form-control" name="edit-score[]" id="edit-score' + data[i].SASPECT_NO + '" value="' + dataScore + '" required><span id="edit-label-score' + data[i].SASPECT_NO + '">' + dataScore + '</span>';
							} else {
								var htmlEditScore = '<input type="number" class="form-control border-0 p-0" name="edit-score[]" id="edit-score' + data[i].SASPECT_NO + '" step="any" min="0" max="2" value="' + dataScore + '" required>';
							}

							if (dataIssue == null) {
								dataIssue = '';
							}

							if (dataRemark == null) {
								dataRemark = '';
							}

							if (!htmlDimention.includes(htmlDimentionTemp)) {
								htmlDimention.push(data[i].DIM_NO);
								var htmlList = '<tr>' +
									'<td colspan="8">Dimensi ' + data[i].DIM_NO + ': ' + data[i].DIM_NM + '</td>' +
									'</tr>' +
									'<tr>' +
									'<td rowspan="' + data[i].RS_DIM + '" class="align-middle">' + data[i].DIM_NM + '</td>' +
									'<td rowspan="' + data[i].RS_ASPECT + '" class="align-middle">' + data[i].ASPECT_NM + '</td>' +
									'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
									'<td class="align-middle"><input type="hidden" class="form-control" id="edit-submit_seq' + data[i].SASPECT_NO + '" name="edit-submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="edit-saspect[]" id="edit-saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
									'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="edit-weight[]" id="edit-weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
									'<td class="align-middle">' + htmlEditScore + '</td>' +
									'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="edit-issue[]" id="edit-issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '"></td>' +
									'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="edit-remark[]" id="edit-remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '"></td>' +
									'</tr>';
								htmlAspectTemp2 = data[i].ASPECT_NO;
								htmlTableLayout.push(htmlList);
							} else if (!htmlAspect.includes(htmlAspectTemp1)) {
								if (data[i].ASPECT_NO !== htmlAspectTemp2) {
									htmlAspect.push(data[i].ASPECT_NO);
									var htmlList = '<tr>' +
										'<td rowspan="' + data[i].RS_ASPECT + '" class="align-middle">' + data[i].ASPECT_NM + '</td>' +
										'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control" id="edit-submit_seq' + data[i].SASPECT_NO + '" name="edit-submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="edit-saspect[]" id="edit-saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="edit-weight[]" id="edit-weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
										'<td class="align-middle">' + htmlEditScore + '</td>' +
										'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="edit-issue[]" id="edit-issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '"></td>' +
										'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="edit-remark[]" id="edit-remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '"></td>' +
										'</tr>';
									htmlTableLayout.push(htmlList);
								} else {
									var htmlList = '<tr>' +
										'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
										'<td class="align-middle"><input type="hidden" class="form-control" id="edit-submit_seq' + data[i].SASPECT_NO + '" name="edit-submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="edit-saspect[]" id="edit-saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
										'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="edit-weight[]" id="edit-weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
										'<td class="align-middle">' + htmlEditScore + '</td>' +
										'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="edit-issue[]" id="edit-issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '"></td>' +
										'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="edit-remark[]" id="edit-remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '"></td>' +
										'</tr>';
									htmlTableLayout.push(htmlList);
								}
							} else {
								var htmlList = '<tr>' +
									'<td class="align-middle">' + parseInt(data[i].SASPECT_NO.substring(data[i].SASPECT_NO.length - 2)) + '</td>' +
									'<td class="align-middle"><input type="hidden" class="form-control" id="edit-submit_seq' + data[i].SASPECT_NO + '" name="edit-submit_seq[]" value="' + n++ + '" readonly required><input type="hidden" class="form-control border-0 p-0" name="edit-saspect[]" id="edit-saspect' + data[i].SASPECT_NO + '" value="' + data[i].SASPECT_NO + '" readonly>' + data[i].SASPECT_NM + '</td>' +
									'<td class="align-middle text-center"><input type="hidden" class="form-control border-0 p-0" name="edit-weight[]" id="edit-weight' + data[i].SASPECT_NO + '" value="' + data[i].VAL_WEIGHT + '" readonly>' + parseFloat(data[i].VAL_WEIGHT).toFixed(2) + '</td>' +
									'<td class="align-middle">' + htmlEditScore + '</td>' +
									'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="edit-issue[]" id="edit-issue' + data[i].SASPECT_NO + '" value="' + dataIssue + '"></td>' +
									'<td class="align-middle"><input type="text" class="form-control border-0 p-0" name="edit-remark[]" id="edit-remark' + data[i].SASPECT_NO + '" value="' + dataRemark + '"></td>' +
									'</tr>';
								htmlTableLayout.push(htmlList);
							}
						}

						$('#edit-data-input-audit').html(htmlTableLayout);

					}
				}
			});
		}

		// function load data all area
		function loadArea() {
			$.ajax({
				url: "<?php echo base_url('users/Audit/dataArea'); ?>",
				method: "POST",
				async: true,
				dataType: 'JSON',
				success: function(data) {
					var htmlArea = '';
					var i;

					htmlArea = '<option value="" selected>-- Area --</option>';

					for (i = 0; i < data.length; i++) {
						htmlArea += '<option value=' + data[i].AREA_NO + '>' + data[i].AREA_NO + ' | ' + data[i].AREA_NM + '</option>';
					}

					// set dropdown list section/line on field query
					$('#area_no_query').html(htmlArea);
					$('#area_no_query').val("");

					// set dropdown list section/line on form input collection
					$('#area_no').html(htmlArea);
					$('#area_no').val("");

					// set dropdown list section/line on form edit collection
					$('#edit-area_no').html(htmlArea);
					$('#edit-area_no').val("");

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

		// function input score penalty
		function penaltyInputScore() {
			nlti = $('#nlti').val();
			ltil3 = $('#ltil3').val();
			ltim3 = $('#ltim3').val();
			lostday = $('#lostday').val();
			aparo1 = $('#aparo1').val();
			aparm1 = $('#aparm1').val();

			$('#scoreE101').val(parseInt(nlti) + parseInt(ltil3) + parseInt(aparo1));
			$('#scoreE102').val(parseInt(ltim3) + parseInt(aparm1));
			$('#scoreE103').val(parseInt(nlti) + parseInt(ltil3) + parseInt(ltim3) + parseInt(aparo1) + parseInt(aparm1));

			$('#label-scoreE101').text(parseInt(nlti) + parseInt(ltil3) + parseInt(aparo1));
			$('#label-scoreE102').text(parseInt(ltim3) + parseInt(aparm1));
			$('#label-scoreE103').text(parseInt(nlti) + parseInt(ltil3) + parseInt(ltim3) + parseInt(aparo1) + parseInt(aparm1));
		}

		// function edit score penalty
		function penaltyEditScore() {
			nlti = $('#edit-nlti').val();
			ltil3 = $('#edit-ltil3').val();
			ltim3 = $('#edit-ltim3').val();
			lostday = $('#edit-lostday').val();
			aparo1 = $('#edit-aparo1').val();
			aparm1 = $('#edit-aparm1').val();

			$('#edit-scoreE101').val(parseInt(nlti) + parseInt(ltil3) + parseInt(aparo1));
			$('#edit-scoreE102').val(parseInt(ltim3) + parseInt(aparm1));
			$('#edit-scoreE103').val(parseInt(nlti) + parseInt(ltil3) + parseInt(ltim3) + parseInt(aparo1) + parseInt(aparm1));

			$('#edit-label-scoreE101').text(parseInt(nlti) + parseInt(ltil3) + parseInt(aparo1));
			$('#edit-label-scoreE102').text(parseInt(ltim3) + parseInt(aparm1));
			$('#edit-label-scoreE103').text(parseInt(nlti) + parseInt(ltil3) + parseInt(ltim3) + parseInt(aparo1) + parseInt(aparm1));
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

		// function set default when select edit-area
		$('#edit-area_no').on('change', function() {
			loadEditBuild();

			return false;
		});

		// function add new audit list
		$('#form-input-audit').submit('click', function() {
			debugger
			// master data field input
			var checkdate = $('#checkdate').val();
			var area_no = $('#area_no').val();
			var build_no = $('#build_no').val();
			var auditee = $('#auditee').val();
			var auditor = $('#auditor').val();
			var nlti = $('#nlti').val();
			var ltil3 = $('#ltil3').val();
			var ltim3 = $('#ltim3').val();
			var lostday = $('#lostday').val();
			var aparo1 = $('#aparo1').val();
			var aparm1 = $('#aparm1').val();
			var lti = parseInt(ltil3) + parseInt(ltim3);

			// detail data field input -- note: using .map() to get data array from input field		
			var submit_seq = $('input[name="submit_seq[]"]').map(function() {
				return $(this).val();
			}).get();
			var saspect = $('input[name="saspect[]"]').map(function() {
				return $(this).val();
			}).get();
			var weight = $('input[name="weight[]"]').map(function() {
				return $(this).val();
			}).get();
			var score = $('input[name="score[]"]').map(function() {
				return $(this).val();
			}).get();
			var issue = $('input[name="issue[]"]').map(function() {
				return $(this).val();
			}).get();
			var remark = $('input[name="remark[]"]').map(function() {
				return $(this).val();
			}).get();

			$.ajax({
				url: "<?php echo base_url('users/Audit/add'); ?>",
				type: "POST",
				dataType: "JSON",
				data: {
					checkdate: checkdate,
					area_no: area_no,
					build_no: build_no,
					auditee: auditee,
					auditor,
					auditor,
					nlti: nlti,
					ltil3: ltil3,
					ltim3: ltim3,
					lostday: lostday,
					aparo1: aparo1,
					aparm1: aparm1,
					lti: lti,
					submit_seq: submit_seq,
					saspect: saspect,
					weight: weight,
					score: score,
					issue: issue,
					remark: remark
				},
				success: function(data) {
					debugger
					var date = (<?php echo date('Ymd'); ?>).toString();
					var current_date = date.substr(0, 4) + '/' + date.substr(4, 2) + '/' + date.substr(6, 2);
					var i;

					// setup alert success input data
					if (data == true || data > 0) {
						// form query data
						$('#area_no_query').val("");
						$('#select2-area_no_query-container').text("-- Area --");

						// master data					
						$('#checkdate').val(current_date);
						$('#area_no').val("");
						$('#build_no').val("");
						$('#auditee').val("");
						$('#auditor').val("");
						$('#nlti').val("0");
						$('#ltil3').val("0");
						$('#ltim3').val("0");
						$('#lostday').val("0");
						$('#aparo1').val("0");
						$('#aparm1').val("0");

						$('#select2-area_no-container').text("-- Area --");
						$('#select2-build_no-container').text("-- Gedung --");

						$('#select2-area_no-container').removeAttr("title", true);
						$('#select2-build_no-container').removeAttr("title", true);

						$('#build_no').attr('disabled', true);

						for (i = 0; i < data; i++) {
							if (saspect[i].substring(0, 1) == 'E') {
								$('#score' + saspect[i]).val("0");
								$('#label-score' + saspect[i]).text("0");
							} else {
								$('#score' + saspect[i]).val("2");
							}
						}

						$('input[name="issue[]"]').val("");
						$('input[name="remark[]"]').val("");

						$('#modal-input-audit').modal('hide');

						// load alert message
						var Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000
						});
						Toast.fire({
							icon: 'success',
							title: 'Alert! \n save successfull!'
						});

						loadListAudit();
						loadListAuditDetail();

					} else {
						// load alert message
						var Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000
						});
						Toast.fire({
							icon: 'error',
							title: 'Alert! \n save failed! audit data of [check_date: ' + checkdate + ', area_no: ' + area_no + ', build_no: ' + build_no + '] is already exist!'
						});

					}
				}
			});

			return false;

		});

		// function edit audit list
		$('#form-edit-audit').submit('click', function() {
			debugger
			// master data field input
			var submit_id = g_esi;
			var checkdate = $('#edit-checkdate').val();
			var area_no = $('#edit-area_no').val();
			var build_no = $('#edit-build_no').val();
			var auditee = $('#edit-auditee').val();
			var auditor = $('#edit-auditor').val();
			var nlti = $('#edit-nlti').val();
			var ltil3 = $('#edit-ltil3').val();
			var ltim3 = $('#edit-ltim3').val();
			var lostday = $('#edit-lostday').val();
			var aparo1 = $('#edit-aparo1').val();
			var aparm1 = $('#edit-aparm1').val();
			var lti = parseInt(ltil3) + parseInt(ltim3);

			// detail data field input -- note: using .map() to get data array from input field		
			var submit_seq = $('input[name="edit-submit_seq[]"]').map(function() {
				return $(this).val();
			}).get();
			var saspect = $('input[name="edit-saspect[]"]').map(function() {
				return $(this).val();
			}).get();
			var weight = $('input[name="edit-weight[]"]').map(function() {
				return $(this).val();
			}).get();
			var score = $('input[name="edit-score[]"]').map(function() {
				return $(this).val();
			}).get();
			var issue = $('input[name="edit-issue[]"]').map(function() {
				return $(this).val();
			}).get();
			var remark = $('input[name="edit-remark[]"]').map(function() {
				return $(this).val();
			}).get();

			$.ajax({
				url: "<?php echo base_url('users/Audit/edit'); ?>",
				type: "POST",
				dataType: "JSON",
				data: {
					submit_id: submit_id,
					checkdate: checkdate,
					area_no: area_no,
					build_no: build_no,
					auditee: auditee,
					auditor,
					auditor,
					nlti: nlti,
					ltil3: ltil3,
					ltim3: ltim3,
					lostday: lostday,
					aparo1: aparo1,
					aparm1: aparm1,
					lti: lti,
					submit_seq: submit_seq,
					saspect: saspect,
					weight: weight,
					score: score,
					issue: issue,
					remark: remark
				},
				success: function(data) {
					debugger
					// master data
					$('#edit-area_no').val("");
					$('#edit-build_no').val("");
					$('#edit-auditee').val("");
					$('#edit-auditor').val("");
					$('#edit-nlti').val("");
					$('#edit-ltil3').val("");
					$('#edit-ltim3').val("");
					$('#edit-lostday').val("");
					$('#edit-aparo1').val("");
					$('#edit-aparm1').val("");

					$('#select2-edit-area_no-container').text("-- Area --");
					$('#select2-edit-build_no-container').text("-- Gedung --");

					$('#select2-edit-area_no-container').removeAttr("title", true);
					$('#select2-edit-build_no-container').removeAttr("title", true);

					$('#build_no').attr('disabled', true);

					// detail data
					$('input[name="edit-score[]"]').val("");
					$('input[name="edit-issue[]"]').val("");
					$('input[name="edit-remark[]"]').val("");

					$('#modal-edit-audit').modal('hide');

					// setup alert success input data
					if (data == true || data > 0) {
						// load alert message
						var Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000
						});
						Toast.fire({
							icon: 'success',
							title: 'Alert! \n update successfull!'
						});

						loadListAudit();
						loadListAuditDetail();

					}
				}
			});

			return false;

		});

		// function reset modal
		$('#reset').on('click', function() {
			debugger
			var date = (<?php echo date('Ymd'); ?>).toString();
			var current_date = date.substr(0, 4) + '/' + date.substr(4, 2) + '/' + date.substr(6, 2);

			//set default
			$('#check_date').val(current_date);
			$('#area_no').val("");
			$('#build_no').val("");
			$('#auditee').val("");
			$('#auditor').val("");
			$('#nlti').val("");
			$('#ltil3').val("");
			$('#ltim3').val("");
			$('#lostday').val("");
			$('#aparo1').val("");
			$('#aparm1').val("");

			$('input[name="score[]"]').val("");
			$('input[name="issue[]"]').val("");
			$('input[name="remark[]"]').val("");

			$('#label-scoreE101').text('0');
			$('#label-scoreE102').text('0');
			$('#label-scoreE103').text('0');

			$('#select2-area_no-container').text("-- Area --");
			$('#select2-area_no-container').removeAttr("title", true);
			$('#select2-build_no-container').text("-- Gedung --");
			$('#select2-build_no-container').removeAttr("title", true);

			$('#build_no').attr('disabled', true);

		});

		// function edit reset modal
		$('#edit-reset').on('click', function() {
			// set default
			$('#edit-nlti').val(g_enlti);
			$('#edit-ltil3').val(g_eltil3);
			$('#edit-ltim3').val(g_eltim3);
			$('#edit-lostday').val(g_eld);
			$('#edit-aparo1').val(g_eao1);
			$('#edit-aparm1').val(g_eam1);

			loadEditAllAspect();
		});
	</script>

</body>

</html>
