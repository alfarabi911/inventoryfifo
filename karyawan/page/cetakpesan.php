<?php
include("../conn.php");
?>

<!-- Main content -->
<div class="row mt">
  <div class="col-md-12">
    <div class="content-panel">
      <div class="table-responsive">
        <table class="table table-striped table-advance table-hover" id="dataku">
          <div class="row">
            <div class="box-header with-border">
              <h3 class="text-center">Cetak Form Permintaan Barang</h3>
            </div>
          </div>
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Permintaan</th>
              <th>Jumlah Permintaan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = $conn->query("
              SELECT 
                barang_keluar.id_keluar as id_keluar,
                tgl_keluar, SUM(qty) as qty 
              FROM barang_keluar 
              INNER JOIN detail_barang_keluar 
                ON barang_keluar.id_keluar=detail_barang_keluar.id_keluar where SUBSTR(tgl_keluar,1,10)=DATE(NOW()) AND status='1'
              GROUP BY barang_keluar.id_keluar ORDER BY tgl_keluar DESC 
              ");
            $no = 1;
            while ($data = $sql->fetch_assoc()) {

            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['tgl_keluar']; ?></td>
                <td><?php echo $data['qty']; ?></td>


                <td>
                  <a target="_blank" href="./server_side/cetakpesanan.php?&id=<?= $data['id_keluar']; ?>"><span data-placement='top' data-toggle='tooltip' title='Cetak BPP'><button class="btn btn-success"><i class="fa fa-print"> Cetak FORM</i></button></span></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>



      <script>
        $('#dataku').dataTable();
      </script>