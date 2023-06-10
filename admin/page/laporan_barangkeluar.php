<?php
include("../conn.php");
?>
<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="locales/bootstrap-datepicker.id.min.js"></script>
<script>
  $(function() {
    $("#tanggal_dari").datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      language: 'id'
    });
    $("#tanggal_sampai").datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      language: 'id'
    });
  });
</script>
<h3><i class="fa fa-angle-right"></i> Laporan</h3>
<!-- tabel -->

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Laporan Barang Keluar</h2>
        <div class="clearfix"></div>
      </div>
      <div class="row mt">
        <div class="col-md-12">
          <div class="alert alert-warning alert-dismissable">
            <strong>Perhatian!</strong> Data yang diambil berdasarkan Tanggal Keluar
          </div>

          <div class="content-panel">
            <div class="table-responsive">
              <form action="./server_side/new_laporanbarangkeluar.php" method="POST" name="input" target="_blank">
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;&nbsp;&nbsp;&nbsp;Dari Tanggal</label>
                        <div class="col-sm-7">
                          <input type='text' name='from' class='form-control' id='tanggal_dari' value="<?php echo date('Y-m-d'); ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Sampai Tanggal</label>
                        <div class="col-sm-8">
                          <input type='text' name='to' class='form-control' id='tanggal_sampai' value="<?php echo date('Y-m-d'); ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    &nbsp;&nbsp;&nbsp;<button class="btn btn-success" type="submit" name="cetak">Cetak Semua</button>
                    </a>

                  </div>
                </div>
            </div>
          </div>