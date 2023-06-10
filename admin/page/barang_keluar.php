<?php
include("../conn.php");
?>

<!-- tabel -->
<div class="row mt">
  <div class="col-md-12">
    <div class="content-panel">
      <div class="col">
        <h4><i class="fa fa-angle-right"></i> Data Barang Keluar</h4>
      </div>
      <div class="table-responsive" style="padding-left: 10px; padding-right: 10px;">
        <table class="table table-striped table-advance table-hover" id="dataku">
          <div class="row">
            <thead>
              <tr>
                <th style="text-align:center"><i class="fa fa-bullhorn"></i> No</th>
                <th style="text-align:center">ID Keluar</th>
                <th style="text-align:center">Qty</th>
                <th style="text-align:center">Tgl Keluar</th>
                <th style="text-align:center"><i class="fa fa-bookmark"></i> Option</th>
              </tr>
            </thead>
            <tbody style="text-align:center">
              <?php
              $sql = $conn->query("SELECT barang_keluar.id_keluar as id_keluar, tgl_keluar, SUM(qty) as qty FROM barang_keluar INNER JOIN detail_barang_keluar ON barang_keluar.id_keluar=detail_barang_keluar.id_keluar where status='1' GROUP BY barang_keluar.id_keluar ORDER BY tgl_keluar DESC");
              $no = 1;
              while ($data = $sql->fetch_assoc()) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['id_keluar']; ?></td>
                  <td><?php echo $data['qty']; ?></td>
                  <td><?php echo $data['tgl_keluar']; ?></td>
                  <td>
                    <button type="button" class="btn btn-info btn-xs" title="detail barang keluar" data-toggle="modal" data-target="#details<?php echo $data['id_keluar']; ?>">
                      <i class="glyphicon glyphicon-eye-open"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-xs" title="hapus barang keluar" onclick="hapus_barang_keluar('<?= $data['id_keluar']; ?>')">
                      <i class="fa fa-trash-o"></i>
                    </button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
    </div><!-- /content-panel -->
  </div>
</div>


<!-- modal details -->
<?php
$sql = $conn->query("SELECT id_keluar FROM barang_keluar");
$no = 1;
while ($modal = $sql->fetch_assoc()) {
?>
  <div class="modal fade bd-example-modal-lg" id="details<?php echo $modal['id_keluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detail Barang Keluar</h4>
        </div>
        <div class="modal-fade" style="padding-left: 10px; padding-right: 10px;">
          <table class="table table-striped table-advance table-hover">
            <thead>
              <tr>
                <th><i class="fa fa-bullhorn"></i> No</th>
                <th>ID_Keluar</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Nama Karyawan</th>
                <th>Divisi</th>
                <th>ID Masuk</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sqlmodal = $conn->query("SELECT * FROM detail_barang_keluar WHERE id_keluar='" . $modal['id_keluar'] . "'");
              $no = 1;
              while ($data = $sqlmodal->fetch_assoc()) {

              ?>

                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['id_keluar']; ?></td>
                  <td><?php echo $data['kobar']; ?></td>
                  <td><?php $sqlr = $conn->query("SELECT nama_barang FROM barang where kobar='" . $data['kobar'] . "' ");
                      $row_r = $sqlr->fetch_assoc();
                      $rak = $row_r['nama_barang']; { ?>
                      <?= $row_r['nama_barang'] ?>
                    <?php } ?>
                  </td>
                  <td><?php echo $data['qty']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['ruangan']; ?></td>
                  <td><span class="label label-success"><?php echo $data['id_masuk']; ?></span></td>
                  <td>
                </tr>

              <?php } ?>
            </tbody>
            <tr>

          </table>
          <h5 align="center" style="color:#46b8da;"> Silahkan ambil barang dengan id masuk yang tertera<br></h5>
          </tr>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<!-- tutup modal details -->

<script>
  $('#dataku').dataTable();

  function tambah() {
    $('#kontenku').load('page/barang_keluar_tambah.php');
  }


  function hapus_barang_keluar(id) {
    $.confirm({
      icon: 'fa fa-question',
      title: 'Hapus Data Barang Keluar',
      content: 'Yakin akan menghapus data dengan id ' + id + ' ?',
      type: 'dark',
      theme: 'modern',
      typeAnimated: true,
      buttons: {
        tryAgain: {
          text: 'Ok',
          btnClass: 'btn-blue',
          action: function() {
            $.ajax({
              type: 'POST',
              url: 'server_side/hapus_barang_keluar.php',
              data: {
                id_keluar: id
              },
              success: function(data) {
                if (data == "YES") {
                  notif_success('OK Berhasil hapus data');
                  $("#kontenku").load("page/barang_keluar.php");
                } else {
                  notif_oops('terjadi kesalahan');
                  $("#kontenku").load("page/barang_keluar.php");
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert('error');

              }

            });

          }
        },
        close: function() {
          notif_oops('Mungkin kamu salah pencet ya..!!');

        }
      }
    });


  }
</script>