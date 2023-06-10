<?php
include("../conn.php");
?>

<!-- tabel -->
<div class="row mt">
  <div class="col-md-12">
    <div class="content-panel">
      <div class="row">
        <div class="col-sm-3">
          <h4><i class="fa fa-angle-right"></i>&nbsp;Data Permintaan Barang</h4>
        </div>
      </div>
      <div class="table-responsive" style="padding:10px;">
        <table class="table table-striped table-advance table-hover" id="dataku">

          <thead>
            <tr>
              <th style="text-align:center"><i class="fa fa-bullhorn"></i> No</th>
              <th style="text-align:center">Tggl Permintaan </th>
              <th style="text-align:center">Jumlah</th>
              <th style="text-align:center"><i class="fa fa-bookmark"></i> Option</th>

            </tr>
          </thead>
          <tbody style="text-align:center">
            <?php
            $sql = $conn->query("SELECT barang_keluar.id_keluar as id_keluar, tgl_keluar, SUM(qty) as qty FROM barang_keluar INNER JOIN detail_barang_keluar ON barang_keluar.id_keluar=detail_barang_keluar.id_keluar where status='0' GROUP BY barang_keluar.id_keluar ORDER BY tgl_keluar DESC");
            $no = 1;
            while ($data = $sql->fetch_assoc()) {

            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['tgl_keluar']; ?></td>
                <td><?php echo $data['qty']; ?></td>


                <td>

                  <button type="button" class="btn btn-info btn-xs" title="detail barang keluar" data-toggle="modal" data-target="#details<?php echo $data['id_keluar']; ?>">
                    Detail Permintaan
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
$sql = $conn->query("SELECT * FROM barang_keluar");
$no = 1;
while ($modal = $sql->fetch_assoc()) {

?>
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="details<?php echo $modal['id_keluar']; ?>">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Data Permintaan Barang <?php echo $modal['tgl_keluar']; ?></h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped table-advance table-sm" id="dataku">

            <thead>
              <tr>
                <th><i class="fa fa-bullhorn"></i> No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Nama Karyawan</th>
                <th>Ruangan</th>
                <th>Id Masuk</th>
                <th>Status</th>
                <th>Option</th>


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
                  <td><?php
                      if ($data['status'] == 0) {
                        echo "<span class='label label-warning'>" . $data['id_masuk'] . "</span>";
                      } elseif ($data['status'] == 1) {
                        echo "<span class='label label-success'>" . $data['id_masuk'] . "</span>";
                      } else {
                        echo "<span class='label label-danger'>" . $data['id_masuk'] . "</span>";
                      }
                      ?> </td>
                  <td> <?php
                        if ($data['status'] == 0) {
                          echo '<span class=text-warning>Menunggu Persetujuan</span>';
                        } elseif ($data['status'] == 1) {
                          echo '<span class=text-warning>Telah Disetujui</span>';
                        } else {
                          echo '<span class=text-danger>Tidak Disetujui</span>';
                        }
                        ?>
                  </td>
                  <td>


                    <button type="button" class="btn btn-success" data-dismiss="modal" title="setuju" onclick="setuju('<?= $data['id_keluar'] ?>','<?= $data['kobar'] ?>')">Setujui</button></span></a>

                    <button type="button" class="btn btn-danger" data-dismiss="modal" title="tdksetuju" onclick="tdksetuju('<?= $data['id_keluar'] ?>','<?= $data['kobar'] ?>')">Tidak<br> Setuju</button></span></a>



                  </td>

                </tr>

              <?php } ?>
            </tbody>
          </table>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div>

<!-- tutup modal details -->

<script>
  $('#dataku').dataTable();

  function tambah() {
    $('#kontenku').load('page/formpesan.php');
  }


  function hapus_barang_keluar(id) {
    $.confirm({
      icon: 'fa fa-question',
      title: 'Hapus Data Permintaan Barang',
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
              url: 'server_side/hapus_permintaan.php',
              data: {
                id_keluar: id
              },
              success: function(data) {
                if (data == "YES") {
                  notif_success('OK Berhasil hapus data');
                  $("#kontenku").load("page/permintaan_brg.php");
                } else {
                  notif_oops('terjadi kesalahan');
                  $("#kontenku").load("page/permintaan_brg.php");
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

  function setuju(id, kode) {
    $.confirm({
      icon: 'fa fa-question',
      title: 'Setujui Permintaan Barang',
      content: 'Setujui Permintaan barang ' + kode + ' ?',
      type: 'POST',
      theme: 'modern',
      typeAnimated: true,
      buttons: {
        tryAgain: {
          text: 'Ok',
          btnClass: 'btn-blue',
          action: function() {
            $.ajax({
              type: 'POST',
              url: 'server_side/setujui_permintaan.php',
              data: {
                id_keluar: id,
                kobar: kode
              },
              success: function(data) {
                if (data == "YES") {
                  notif_success('Permintaan Barang Berhasil');
                  $("#kontenku").load("page/permintaan_brg.php");
                } else {
                  notif_oops('terjadi kesalahan');
                  $("#kontenku").load("page/permintaan_brg.php");
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

  function tdksetuju(id, kode) {
    $.confirm({
      icon: 'fa fa-question',
      title: 'Apakah anda Yakin?',
      content: 'Tidak Setujui Permintaan barang ' + kode + ' ?',
      type: 'POST',
      theme: 'modern',
      typeAnimated: true,
      buttons: {
        tryAgain: {
          text: 'Ok',
          btnClass: 'btn-blue',
          action: function() {
            $.ajax({
              type: 'POST',
              url: 'server_side/tdk_setujui.php',
              data: {
                id_keluar: id,
                kobar: kode
              },
              success: function(data) {
                if (data == "YES") {
                  notif_success('Permintaan Barang Tidak di Setujui');
                  $("#kontenku").load("page/permintaan_brg.php");
                } else {
                  notif_oops('terjadi kesalahan');
                  $("#kontenku").load("page/permintaan_brg.php");
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