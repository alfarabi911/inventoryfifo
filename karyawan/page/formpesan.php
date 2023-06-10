<?php
include("../conn.php");
session_start();
?>
<!-- modal -->
<?php
$today = 'BK' . date("ymd");
// cari id transaksi terakhir yang berawalan tanggal hari ini
$query = $conn->query("SELECT max(id_keluar) AS last FROM barang_keluar WHERE id_keluar LIKE '$today%'");
$data  = $query->fetch_assoc();
$lastNoTransaksi = $data['last'];

// baca nomor urut transaksi dari id transaksi terakhir
// 9 nomor id pertama, 3 nomor id terakhir.
$lastNoUrut = substr($lastNoTransaksi, 8, 3);

$nextNoUrut = $lastNoUrut + 1;

// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today . sprintf('%03s', $nextNoUrut);
?>
<div class="form-group" style="display: none;">
  <label class="col-sm-3 control-label">ID Keluar</label>

  <div class="col-sm-9">
    <input type="text" class="form-control" name="id_keluar" id="id_keluar" value="<?php echo $nextNoTransaksi; ?>" readonly>
  </div>
</div>
<h3><i class="fa fa-angle-right"></i>Tambah Permintaan Barang</h3>
<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel">
      <form class="form-horizontal style-form" id="form_barang_keluar">

        <div class="form-group">
          <label class="col-sm-2 control-label">Kode Barang</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="kobar" id="kobar" placeholder="Input Kode Barang">
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
          <label class="col-sm-2 control-label">Nama Karyawan</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $_SESSION['namkar']; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nama Barang</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="nabar" id="nabar" placeholder="Nama Barang" readonly="">
          </div>
          <label class="col-sm-2 control-label">Divisi</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="ruangan" id="ruangan" onkeyup="this.value=this.value.toUpperCase()" placeholder="Divisi">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Jenis</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" readonly="">
          </div>

        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Stock</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="stock" id="stock" placeholder="Stock" readonly="">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Qty</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="qty" id="qty" placeholder="Input Qty" oninput="this.value = this.value.replace(/[^0-9]/g, '')" autocomplete="off">
            <!-- <input type="number" min="1" pattern="[0-9]+" class="form-control" name="qty" id="qty" placeholder="Input Qty"> -->
          </div>
        </div>
        <div class="form-group">

          <div class="col-sm-3"></div>
          <div class="col-sm-9">
            <button type="button" class="btn btn-primary" onclick="save()">Tambahkan</button>
            <button type="button" class="btn btn-default" id="kembali" onclick="back()">Kembali</button>

          </div>
        </div>


      </form>


      <!-- tabel jual -->
      <div id="table_jual">
        <div class="row">
          <div class="col-sm-6">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Data Barang yang akan keluar</h4>

          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-success pull-right" disabled>Minta Barang</button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-advance table-hover">
            <thead>
              <tr>
                <th><i class="fa fa-bullhorn"></i> No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th><i class="fa fa-bookmark"></i> Option</th>
              </tr>
            </thead>
            <tbody>

              <tr>


              </tr>

            </tbody>
          </table>
        </div>
        <!-- end table -->
      </div>

      <div class="modal fade" id="modal-item">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Select Product Item</h4>
            </div>
            <div class="modal-body table-responsive">
              <table class="table table-striped table-advance table-hover" id="table1">
                <thead>
                  <tr>
                    <td>Kode Barang</td>
                    <td>Nama Barang</td>
                    <td>Jenis</td>
                    <td>Stock</td>
                    <td>Action</td>
                  </tr>
                </thead>

                <?php
                $sql = $conn->query("SELECT barang.kobar as kobar, barang.nama_barang as nama_barang,barang.jenis as jenis, barang.rak as rak, id_masuk, max(harga) as harga, SUM(sisa) as sisa FROM barang LEFT JOIN detail_barang_masuk ON barang.kobar = detail_barang_masuk.kobar GROUP BY nama_barang ");
                while ($data = $sql->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $data['kobar']; ?></td>
                    <td><?php echo $data['nama_barang']; ?></td>
                    <td><?php echo $data['jenis'] ?></td>
                    <td><?php echo $data['sisa'] ?></td>
                    <td>
                      <button class="btn btn-xs btn-info" id="select" data-kobar="<?php echo $data['kobar']; ?>" data-nabar="<?php echo $data['nama_barang']; ?>" data-jenis="<?php echo $data['jenis']; ?>" data-sisa="<?php echo $data['sisa']; ?>">
                        <i class="fa fa-check"></i>Select
                      </button>
                    </td>
                  </tr>

                <?php } ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- col-lg-12-->
</div><!-- /row -->



<script>
  var id_keluar = $('#id_keluar').val();
  $('#table1').dataTable();

  $(document).ready(function() {
    $(document).on('click', '#select', function() {
      var kobar = $(this).data('kobar');
      var nabar = $(this).data('nabar');
      var jenis = $(this).data('jenis');
      var sisa = $(this).data('sisa');
      $('#kobar').val(kobar);
      $('#nabar').val(nabar);
      $('#jenis').val(jenis);
      $('#stock').val(sisa);
      $('#modal-item').modal('hide');

    })
  })

  function save() {
    if ($('#kobar').val() == '' || $('#nabar').val() == '' || $('#qty').val() == '' || $('#nama').val() == '' || $('#ruangan').val() == '') {
      notif_oops('isi dulu semuanya');
    } else if (parseInt($('#qty').val()) < 0) {
      notif_oops('Jumlah tidak boleh kecil dari 0!');
    } else {
      // alert(id_keluar);
      var kobar = $('#kobar').val();
      var qty = $('#qty').val();
      var nama = $('#nama').val();
      var ruangan = $('#ruangan').val();
      $.ajax({
        url: "server_side/tambah_barang_keluar.php",
        type: "POST",
        data: {
          id_keluar: id_keluar,
          kobar: kobar,
          qty: qty,
          nama: nama,
          ruangan: ruangan
        },
        success: function(data) {

          var dataku = JSON.parse(data);
          if (dataku.status) {
            load_data_jual(id_keluar);
            bersih_form();
          } else {
            notif_oops('stok kurang bro.. hanya ada ' + dataku.stok + ' !');
          }


        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('error');
        }
      });
    }

  }

  function bersih_form() {
    $('#kobar').val('');
    $('#nabar').val('');
    $('#jenis').val('');
    $('#stock').val('');
    $('#qty').val('');

  }

  function load_data_jual(id_keluar) {
    $('#table_jual').load('server_side/table_jual.php?id_keluar=' + id_keluar);
    $('#kembali').attr('disabled', true);

  }


  function back() {
    $('#kontenku').load('page/permintaan_brg.php');
  }

  function hapus_item_keluar(id, kode) {
    $.confirm({
      icon: 'fa fa-question',
      title: 'Hapus Data Item Barang Yg akan Diminta',
      content: 'Yakin akan menghapus data dengan kode barang ' + kode + ' ?',
      type: 'dark',
      theme: 'modern',
      typeAnimated: true,
      buttons: {
        tryAgain: {
          text: 'Ok',
          btnClass: 'btn-blue',
          action: function() {
            $.ajax({
              url: "server_side/hapus_barang_keluar_item.php",
              type: "POST",
              data: {
                id_keluar: id,
                kobar: kode
              },
              success: function(data) {
                load_data_jual(id_keluar);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert('error');
              }
            });

          }
        },
        close: function() {
          notif_oops('oke.. mungkin kamu hanya salah pencet !!');

        }
      }
    });
  }

  function jual_selesai() {
    // alert(id_masuk);
    $.ajax({
      url: "server_side/tambah_barang_keluar_pk.php",
      type: "POST",
      data: {
        id_keluar: id_keluar
      },
      success: function(data) {
        notif_success('berhasil Meminta Barang');
        $("#kontenku").load("page/permintaan_brg.php");

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('error');
      }
    });
  }
</script>