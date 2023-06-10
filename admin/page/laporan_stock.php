<?php
include("../conn.php");
?>
<h3><i class="fa fa-angle-right"></i> Laporan</h3>
<!-- tabel -->


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Laporan Stock</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="content-panel">
          <div class="row" style="padding-bottom: 10px;">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <a href="./server_side/new_laporanstock.php " target="_blank">
                &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success" type="submit" name="cetak">Cetak Semua</button>
              </a>
            </div>
          </div>
          <div class="table-responsive" style="padding-left: 10px; padding-right: 10px;">
            <table class="table table-striped table-bordered table-hover" id="datatables" style="width: 100%">
              <thead>
                <tr>
                  <th style="text-align:center">No</th>
                  <th style="text-align:center">Kode Barang</th>
                  <th style="text-align:center">Nama Barang</th>
                  <th style="text-align:center">Jenis</th>
                  <th style="text-align:center">Stok</th>
                  <th style="text-align:center">Harga</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $sql = $conn->query("SELECT barang.kobar as kobar, barang.nama_barang as nama_barang,barang.jenis as jenis, id_masuk, max(harga) as harga, SUM(sisa) as sisa FROM barang LEFT JOIN detail_barang_masuk ON barang.kobar = detail_barang_masuk.kobar GROUP BY nama_barang ASC");

                $no = 1;
                while ($data = $sql->fetch_assoc()) {

                ?>
                  <tr align="center">
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['kobar']; ?></td>
                    <td><?php echo $data['nama_barang']; ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                    <td><?php if ($data['sisa'] == '') {
                          echo "0";
                        } else {
                          echo $data['sisa'];
                        } ?></td>
                    <td>Rp. <?php echo number_format($data['harga']); ?></td>
                  </tr>

                <?php
                  $no++;
                }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir row tabel -->

</div>
</div>