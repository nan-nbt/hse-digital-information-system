<!-- Session login check -->
<?php if($this->session->userdata('hse_factory') == null){ redirect(base_url('users/Log')); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- meta tag -->
  <?php // require_once('_meta.php'); ?>
	<?php $this->load->view("layouts/_meta.php") ?>

  <!-- title tag -->
  <?php // require_once('_title.php'); ?>
	<?php $this->load->view("layouts/_title.php") ?>

  <!-- link stylesheet -->
  <?php // require_once('_css.php'); ?>
	<?php $this->load->view("layouts/_css.php") ?>
  
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed text-sm">
<!-- Site wrapper -->
<div class="wrapper"> 
    <!-- Header -->
    <?php //require_once('_header.php'); ?>
    <?php $this->load->view("layouts/_header.php") ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12" style="margin-top:10px;">
            <!-- Default box -->
            <div class="card">
              <div class="card-header text-center">
                <h1>
                    <img src="<?php echo base_url(); ?>/assets/dist/img/pouchen.ico" alt="Pouchen Logo" class="brand-image img-circle elevation-0" style="opacity: 0.8; width: 4%;">
                    <strong style="padding-left: 10px; padding-right: 10px;">INFORMASI KECELAKAAN KERJA</strong>
                    <img src="<?php echo base_url(); ?>/assets/dist/img/hse-logo.png" alt="HSE Logo" class="brand-image img-circle elevation-0" style="opacity: 0.8; width: 4%;">
                </h1>
                <?php foreach($hse_max_date as $max_date){ $current_date = substr($max_date->SUBMIT_DATE,0,8); } ?>
                <?php if(substr($current_date,4,2) != substr(date('YmdHis'),4,2)){
                        $current_date = date('YmdHis'); 
                      }

                      if(substr($current_date,4,2) == '01'){ $month = 'JANUARI'; }
                      else if(substr($current_date,4,2) == '02'){ $month = 'FEBRUARI'; } 
                      else if(substr($current_date,4,2) == '03'){ $month = 'MARET'; } 
                      else if(substr($current_date,4,2) == '04'){ $month = 'APRIL'; } 
                      else if(substr($current_date,4,2) == '05'){ $month = 'MEI'; } 
                      else if(substr($current_date,4,2) == '06'){ $month = 'JUNI'; } 
                      else if(substr($current_date,4,2) == '07'){ $month = 'JULI'; } 
                      else if(substr($current_date,4,2) == '08'){ $month = 'AGUSTUS'; } 
                      else if(substr($current_date,4,2) == '09'){ $month = 'SEPTEMBER'; } 
                      else if(substr($current_date,4,2) == '10'){ $month = 'OKTOBER'; } 
                      else if(substr($current_date,4,2) == '11'){ $month = 'NOVEMBER'; } 
                      else if(substr($current_date,4,2) == '12'){ $month = 'DESEMBER'; }

                      $year = substr($current_date,0,4);
                      $last_month = $month.'-'.$year; 
                ?>
                <span class="info-box-text"><strong style="font-size: 20px;">FACTORY: <?php echo $this->session->userdata('hse_factory_name'); ?> | BULAN: <?php echo $last_month; ?></strong></span>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box bg-secondary">
                        <div class="info-box-content text-center" style="height:100px;">
                                <h2><strong>AREA</strong></h2>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-12">
                        <div class="info-box bg-info">
                        <div class="info-box-content text-center" style="height:100px;">
                                <h2><strong>Total Kasus</strong></h2>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-12">
                        <div class="info-box bg-success">
                        <div class="info-box-content text-center" style="height:100px;">
                                <h2><strong>Kasus Tidak Hilang Hari Kerja</strong></h2>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-12">
                        <div class="info-box bg-danger">
                            <div class="info-box-content text-center" style="height:100px;">
                                <h2><strong>Kasus Hilang Hari Kerja</strong></h2>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-12">
                        <div class="info-box bg-primary">
                            <div class="info-box-content text-center" style="height:100px;">
                                <h2><strong>Total Hari KERJA Hilang</strong></h2>
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
  <?php //require_once('_footer.php'); ?>
	<?php $this->load->view("layouts/_footer.php") ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php //require_once('_js.php'); ?>
<?php $this->load->view("layouts/_js.php") ?>

<script>
  // page onload function
  $(function(){
    loadData();
    setInterval(loadData, 10000); // interval set 10 sec
  });

  // function load data on datatable plugin
  function loadData(){
    $.ajax({
      url : "<?php echo base_url('users/Accident/realtimeAccident');?>",
      async : true,
      dataType : 'JSON',
      success: function(data){
        var htmlData = '';
        var no = 1;
        var i;

        if(data.length > 0){
          for(i=0; i<data.length; i++){
            htmlData += '<div class="row">'+ 
                            '<div class="col-md-4 col-sm-6 col-12">'+
                                '<div class="card card-default card-outline">'+
                                    '<div class="card-header text-center" style="background-color: #d4d4d4;">'+
                                        '<span class="info-box-text in-board" style="color: black;">'+data[i].AREA_NM+'</span>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 col-sm-6 col-12">'+
                                '<div class="card card-default card-outline">'+
                                    '<div class="card-header text-center" style="background-color: #c8f4fa;">'+
                                        '<span class="info-box-text in-board">'+data[i].TOT_ACCIDENT+'</span>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 col-sm-6 col-12">'+
                                '<div class="card card-default card-outline">'+
                                    '<div class="card-header text-center" style="background-color: #c8fac9;">'+
                                        '<span class="info-box-text in-board">'+data[i].TOT_NLTI+'</span>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 col-sm-6 col-12">'+
                                '<div class="card card-default card-outline">'+
                                    '<div class="card-header text-center" style="background-color: #fac8c8;">'+
                                        '<span class="info-box-text in-board">'+data[i].TOT_LTI+'</span>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 col-sm-6 col-12">'+
                                '<div class="card card-default card-outline">'+
                                    '<div class="card-header text-center" style="background-color: #c8dffa;">'+
                                        '<span class="info-box-text in-board">'+data[i].TOT_LOST_DAY+'</span>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                        ;
          }
          $('#data-accident').html(htmlData);
        }else{
          $('#data-accident').html(htmlData);
        }
      }
    });
  }

</script>

</body>
</html>
