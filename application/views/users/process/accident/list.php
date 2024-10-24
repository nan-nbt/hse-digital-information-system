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
									<h1>Manage Data HSE</h1>
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
									<form class="form-horizontal" id="accident-query">
										<div class="row">
											<div class="col-md-3">
												<!-- Date -->
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
											<div class="col-md-3">
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
													<button type="button" class="form-control btn btn-default" data-toggle="modal" data-target="#modal-input-accident" id="input-col">
														<i class="fas fa-plus-circle"></i> Input Data HSE
													</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="example2" class="table table-bordered table-striped table-head-fixed nowrap text-nowrap" style="width: 100%;">
										<thead>
											<tr>
												<th>NO</th>
												<th>AREA</th>
												<th>AREA SCORE</th>
												<th>TOTAL LTI</th>
												<th>TOTAL NTLI</th>
												<th>TOTAL LOST DAY</th>
												<th>TOTAL ACCIDENT</th>
												<th>SUBMIT ID</th>
												<th>SUBMIT DATE</th>
												<th>SUBMIT USER</th>
											</tr>
										</thead>
										<tbody id="data-accident">

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

				<!-- Modal Form Input Data Accident -->
				<div class="modal fade" id="modal-input-accident">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Input Data HSE</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<!-- form start -->
							<form class="form-horizontal" id="form-input-accident" method="POST">
								<div class="modal-body">
									<!-- <p>One fine body&hellip;</p> -->
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="area_no" class="col-form-label">Area :</label>
													<!-- <input type="hidden" class="form-control" id="line_type" name="line_type" value=""> -->
													<select class="form-control select2bs4" style="width: 100%;" id="area_no" name="area_no" required>
														<option value="" selected disabled>-- Area --</option>
													</select>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<label for="area_score" class="col-form-label">Area Score (%) :</label>
													<input type="text" class="form-control" id="area_score" name="area_score" placeholder="Area Score (%)" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required disabled>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<label for="tot_lti" class="col-form-label">Total LTI :</label>
													<input type="number" class="form-control" id="tot_lti" name="tot_lti" placeholder="Total LTI" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required disabled>
												</div>
												<!-- /.form-group -->
											</div>
											<!-- /.col-md-6 -->
											<div class="col-md-6">
												<div class="form-group">
													<label for="tot_nlti" class="col-form-label">Total NLTI :</label>
													<input type="number" class="form-control" id="tot_nlti" name="tot_nlti" placeholder="Total NLTI" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required disabled>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<label for="tot_last_day" class="col-form-label">Total Lost Day :</label>
													<input type="text" class="form-control" id="tot_lost_day" name="tot_lost_day" placeholder="Total Lost Day" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required disabled>
												</div>
												<!-- /.form-group -->
												<div class="form-group">
													<label for="tot_accident" class="col-form-label">Total Accident :</label>
													<input type="text" class="form-control" id="tot_accident" name="tot_accident" placeholder="Total Accident" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required readonly disabled>
												</div>
												<!-- /.form-group -->
											</div>
											<!-- /.col-md-6 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.card-body -->
								</div>
								<!-- /.modal-body -->
								<div class="modal-footer justify-content-between">
									<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
									<button type="reset" class="btn btn-default" id="reset">Cancel</button>
									<button type="submit" class="btn btn-primary" id="submit-accident">Submit</button>
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
		<?php //require_once('_footer.php'); 
		?>
		<?php $this->load->view("layouts/_footer.php") ?>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- Javascript -->
	<?php //require_once('_js.php'); 
	?>
	<?php $this->load->view("layouts/_js.php") ?>

	<!-- Page specific script -->
	<script>
		// declare global variable
		var g_table;

		// page onload function
		$(document).ready(function() {
			loadDataAccident(); // call function loadDataAccident
			loadDataArea(); // call function loadDataArea
		});

		// pace-progress when ajax request
		$(document).ajaxStart(function() {
			Pace.restart();
		});

		// function onclick button query
		$('#accident-query').on('submit', function() {
			// set icon progress load
			$('#query').html('<i class="fas fa-circle-notch fa-spin"></i>');

			// call function loadListAudit
			loadDataAccident();

			return false;
		});

		// function load data All area
		function loadDataArea() {
			$.ajax({
				url: "<?php echo base_url('users/Accident/dataArea'); ?>",
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

		// function load data on datatable plugin
		function loadDataAccident() {
			var startdate = $('#startdate_query').val();
			var enddate = $('#enddate_query').val();
			var area_no_query = $('#area_no_query').val();
			$.ajax({
				url: "<?php echo base_url('users/Accident/getAccident'); ?>",
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
					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							htmlData += '<tr>' +
								'<td>' + no++ + '</td>' +
								'<td>' + data[i].AREA_NO + ' | ' + data[i].AREA_NM + '</td>' +
								'<td>' + data[i].AREA_SCORE + '</td>' +
								'<td>' + data[i].TOT_LTI + '</td>' +
								'<td>' + data[i].TOT_NLTI + '</td>' +
								'<td>' + data[i].TOT_LOST_DAY + '</td>' +
								'<td>' + data[i].TOT_ACCIDENT + '</td>' +
								'<td>' + data[i].SUBMIT_ID + '</td>' +
								'<td>' + data[i].SUBMIT_DATE + '</td>' +
								'<td>' + data[i].SUBMIT_USER + '</td>' +
								'</tr>';
						}
						$('#example2').DataTable().destroy();
						$('#data-accident').html(htmlData);
						$('#query').text('Query');

						g_table = $('#example2').DataTable({
							"paging": true,
							"lengthChange": true,
							"searching": false,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"responsive": false,
							"scrollY": 300,
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

						g_table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

						// function on row data click get data row
						$('#example2 tbody').off('click').on('click', 'tr', function() {
							// set background color row selected
							if ($(this).hasClass('selected')) {
								$(this).removeClass('selected');
							} else {
								g_table.$('tr.selected').removeClass('selected');
								$(this).addClass('selected');
							}
						});

					} else {
						$('#example2').DataTable().destroy();
						$('#data-accident').html(htmlData);
						$('#query').text('Query');

						g_table = $('#example2').DataTable({
							"paging": true,
							"lengthChange": true,
							"searching": false,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"responsive": false,
							"scrollY": 450,
							"scrollX": true,
							// "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
						});

						g_table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

					}
				}
			});
		}

		/** 
		 * Modal Form script
		 */

		// function set default when select section/line
		$('#area_no').on('change', function() {
			//set default
			$('#area_score').val("");
			$('#tot_lti').val("");
			$('#tot_nlti').val("");
			$('#tot_lost_day').val("");
			$('#tot_accident').val("");
			$('#area_score').removeAttr('disabled');
			$('#tot_lti').removeAttr('disabled');
			$('#tot_nlti').removeAttr('disabled');
			$('#tot_lost_day').removeAttr('disabled');
			$('#tot_accident').removeAttr('disabled');

			return false;
		});

		// count total accident
		$('#tot_lti').on('input', function() {
			debugger
			let tot_lti = $('#tot_lti').val();
			let tot_nlti = $('#tot_nlti').val();
			let tot_accident;

			if (tot_lti != "" && tot_nlti != "") {
				tot_accident = parseInt(tot_lti) + parseInt(tot_nlti);
			} else if (tot_lti != "" && tot_nlti == "") {
				tot_accident = parseInt(tot_lti);
			} else if (tot_lti == "" && tot_nlti != "") {
				tot_accident = parseInt(tot_nlti);
			} else {
				tot_accident = '0';
			}

			$('#tot_accident').val(tot_accident);
		});

		// count total accident
		$('#tot_nlti').on('input', function() {
			let tot_lti = $('#tot_lti').val();
			let tot_nlti = $('#tot_nlti').val();
			let tot_accident;

			if (tot_lti != "" && tot_nlti != "") {
				tot_accident = parseInt(tot_lti) + parseInt(tot_nlti);
			} else if (tot_lti != "" && tot_nlti == "") {
				tot_accident = parseInt(tot_lti);
			} else if (tot_lti == "" && tot_nlti != "") {
				tot_accident = parseInt(tot_nlti);
			} else {
				tot_accident = '0';
			}

			$('#tot_accident').val(tot_accident);
		});

		// function submit accident
		$('#form-input-accident').submit('click', function() {
			debugger
			// master data field input
			var area_no = $('#area_no').val();
			var area_score = $('#area_score').val();
			var tot_lti = $('#tot_lti').val();
			var tot_nlti = $('#tot_nlti').val();
			var tot_lost_day = $('#tot_lost_day').val();
			var tot_accident = $('#tot_accident').val();

			$.ajax({
				url: "<?php echo base_url('users/Accident/add'); ?>",
				type: "POST",
				dataType: "JSON",
				data: {
					area_no: area_no,
					area_score: area_score,
					tot_lti: tot_lti,
					tot_nlti: tot_nlti,
					tot_lost_day: tot_lost_day,
					tot_accident: tot_accident
				},
				success: function(data) {
					debugger
					// master data					
					$('#area_no').val("");
					$('#area_score').val("");
					$('#tot_lti').val("");
					$('#tot_nlti').val("");
					$('#tot_lost_day').val("");
					$('#tot_accident').val("");

					$('#select2-area_no-container').text("-- Area --");
					$('#select2-area_no-container').removeAttr("title", true);

					$('#modal-input-accident').modal('hide');

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
							title: 'Alert! \n save successfull!'
						});

						loadDataAccident();

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
							title: 'Alert! \n save failed!'
						});

					}
				}
			});

			return false;

		});

		// function reset modal
		$('#reset').on('click', function() {
			//set default
			$('#area_score').val("");
			$('#tot_lti').val("");
			$('#tot_nlti').val("");
			$('#tot_lost_day').val("");
			$('#tot_accident').val("");

			$('#select2-area_no-container').text("-- Area --");
			$('#select2-area_no-container').removeAttr("title", true);

			$('#area_score').attr('disabled', true);
			$('#tot_lti').attr('disabled', true);
			$('#tot_nlti').attr('disabled', true);
			$('#tot_lost_day').attr('disabled', true);
			$('#tot_accident').attr('disabled', true);

		});
	</script>

</body>

</html>
