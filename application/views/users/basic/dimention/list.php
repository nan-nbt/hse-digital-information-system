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
		<?php //require_once('_header.php'); 
		?>
		<?php $this->load->view("layouts/_header.php") ?>

		<!-- Sidebar -->
		<?php //require_once('_sidebar.php'); 
		?>
		<?php $this->load->view("layouts/_sidebar.php") ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<!-- <div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Area Data List</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Basic Data</li>
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
								<div class="card-body">
									<table id="table-dim" class="table table-bordered table-striped table-head-fixed nowrap text-nowrap" style="width: 100%;">
										<thead>
											<tr>
												<th>NO</th>
												<th>DIMENTION NO</th>
												<th>DIMENTION NAME</th>
												<th>STOP MARK</th>
											</tr>
										</thead>
										<tbody id="list-dim">
											<!-- using JQuery ajax for get data list defect -->
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
		var g_table;

		$(document).ready(function() {
			listDataDim();
		});

		// pace-progress when ajax request
		$(document).ajaxStart(function() {
			Pace.restart();
		});

		// function load list section data
		function listDataDim() {
			$.ajax({
				url: "<?php echo base_url('dashboard/dataDimention'); ?>",
				async: true,
				dataType: 'JSON',
				success: function(data) {
					var htmlDataDim = '';
					var no = 1;
					var i;

					if (data.length > 0) {
						for (i = 0; i < data.length; i++) {
							htmlDataDim += '<tr>' +
								'<td>' + no++ + '</td>' +
								'<td>' + data[i].DIM_NO + '</td>' +
								'<td>' + data[i].DIM_NM + '</td>' +
								'<td>' + data[i].STOP_MK + '</td>' +
								'</tr>';
						}

						$('#table-dim').DataTable().destroy();
						$('#list-dim').html(htmlDataDim);

						// set value object of datatables
						g_table = $('#table-dim').DataTable({
							"pagging": true,
							"lengthChange": true,
							"searching": true,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"responsive": false,
							"scrollY": 400,
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

						g_table.buttons().container().appendTo('#table-dim_wrapper .col-md-6:eq(0)');

						// function on row data click get data row
						$('#table-dim tbody').off('click').on('click', 'tr', function() {
							/* note: add .off('click') to set no multiple selected */
							// set background color row selected
							// if($(this).hasClass('selected')){
							//   $(this).removeClass('selected');
							// }else{
							g_table.$('tr.selected').removeClass('selected');
							$(this).addClass('selected');
							// }
						});

					} else {
						$('#table-dim').DataTable().destroy();
						$('#list-dim').html(htmlDataDim);

						// set value object of datatables
						g_tablem = $('#table-dim').DataTable({
							"paging": true,
							"lengthChange": true,
							"searching": false,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"responsive": false,
							// "scrollY": 150,
							"scrollX": true,
							// "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
						});

						// add button wrapper in datatable
						g_tablem.buttons().container().appendTo('#table-dim_wrapper .col-md-6:eq(0)');

					}
				}
			});
		}

		// set interval
		setInterval(loadDataDim, 120000);
	</script>

</body>

</html>