<?php
include("../conn.php");
?>
<!-- modal -->
<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="locales/bootstrap-datepicker.id.min.js"></script>
<script>
  $(function() {
    $("#exp").datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      language: 'id'
    });

  });
</script>
<?php
$today = 'BM' . date("ymd");
// cari id transaksi terakhir yang berawalan tanggal hari ini
$query = $conn->query("SELECT max(id_masuk) AS last FROM barang_masuk WHERE id_masuk LIKE '$today%'");
$data  = $query->fetch_assoc();
$lastNoTransaksi = $data['last'];

// baca nomor urut transaksi dari id transaksi terakhir
// 9 nomor id pertama, 3 nomor id terakhir.
$lastNoUrut = substr($lastNoTransaksi, 8, 3);
$nextNoUrut = $lastNoUrut + 1;

// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today . sprintf('%03s', $nextNoUrut);
?>
<h3><i class="fa fa-angle-right"></i>&nbsp;Tambah Barang Masuk</h3>
<!-- BASIC FORM ELELEMNTS -->
<div class="form-group" style="display: none;">
  <label class="col-sm-2 col-sm-2 control-label">ID Masuk</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" name="id_masuk" id="id_masuk" value="<?php echo $nextNoTransaksi; ?>" readonly>
  </div>
</div>

<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel">
      <form class="form-horizontal style-form" id="form_tambah_barang_masuk">
        <div class="form-group">
          <label class="col-sm-2 control-label">Kode Barang</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="kobar" id="kobar" placeholder="Kode Barang">
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>

          <label class="col-sm-2 control-label">Nama Barang</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="nabar" id="nabar" placeholder="Nama Barang">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Harga</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Input Harga" oninput="this.value = this.value.replace(/[^0-9]/g, '')" autocomplete="off">
            <!-- <input type="number" min="1" pattern="[0-9]+" class="form-control" name="harga" id="harga" placeholder="Input Harga"> -->
          </div>
          <label class="col-sm-2 control-label">Ruang</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="rak" id="rak" placeholder="Ruangan" readonly="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Qty</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="qty" id="qty" placeholder="Input Qty" oninput="this.value = this.value.replace(/[^0-9]/g, '')" autocomplete="off">
            <!-- <input type="text" inputmode="numeric" min="1" pattern="[0-9]*" class="form-control" name="qty" id="qty" placeholder="Input Qty"> -->
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Expired</label>
          <div class="col-sm-4">
            <input type='text' class='form-control' name='exp' id='exp' placeholder="Input Expired">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2"></div>
          <div class="col-sm-10">
            <button type="button" class="btn btn-primary" onclick="save()">Tambahkan</button>
            <button type="button" class="btn btn-default" onclick="back()">Kembali</button>
          </div>
        </div>


      </form>
      <!-- tabel beli -->
      <div id="table_beli">
        <div class="row">
          <div class="col-sm-6">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Data Barang yang akan masuk</h4>

          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-success pull-right" disabled>Transaksi Selesai</button>
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
                <th>Rak</th>
                <th>Harga</th>
                <th>Expired</th>

                <th><i class="fa fa-bookmark"></i> Option</th>
              </tr>
            </thead>
            <tbody>

              <tr>


              </tr>

            </tbody>
          </table>
        </div>


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
                  <td>Rak</td>

                  <td>Action</td>
                </tr>
              </thead>

              <?php
              $sql = $conn->query("SELECT barang.kobar as kobar, barang.nama_barang as nama_barang,barang.rak as rak FROM barang GROUP BY nama_barang");


              while ($data = $sql->fetch_assoc()) {

              ?>
                <tr>

                  <td><?php echo $data['kobar']; ?></td>
                  <td><?php echo $data['nama_barang']; ?></td>
                  <td><?php echo $data['rak']; ?></td>

                  <td>
                    <button class="btn btn-xs btn-info" id="select" data-kobar="<?php echo $data['kobar']; ?>" data-nabar="<?php echo $data['nama_barang']; ?>" data-rak="<?php echo $data['rak']; ?>">
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
  var id_masuk = $('#id_masuk').val();
  $('#table1').dataTable();
  $(document).ready(function() {
    $(document).on('click', '#select', function() {
      var kobar = $(this).data('kobar');
      var nabar = $(this).data('nabar');
      var rak = $(this).data('rak');

      $('#kobar').val(kobar);
      $('#nabar').val(nabar);
      $('#rak').val(rak);


      $('#modal-item').modal('hide');

    })
  })
  $("#kobar").keydown(function(event) {
    if (event.keyCode == '13') {
      var kode = $('#kobar').val();
      $.ajax({
        url: "server_side/check_barang.php",
        type: "post",
        data: {
          kode: kode
        },
        success: function(data) {

          var dataku = JSON.parse(data);
          if (dataku == null) {
            notif_oops('pencarian dengan kode barang = ' + kode + ' tidak ditemukan.. coba cek lagi bro di data barangnya !!!');
            bersih_form();
          } else {
            $('#nabar').val(dataku.nama_barang);
            $('#rak').val(dataku.rak);
            if (dataku.harga == null) {
              $('#harga').val('0');
            } else {
              $('#harga').val(dataku.harga);
            }

          }



        }
      });
    }
  });

  function beli_selesai() {
    $.ajax({
      url: "server_side/tambah_barang_masuk_pk.php",
      type: "POST",
      data: {
        id_masuk: id_masuk
      },
      success: function(data) {
        notif_success('OK berhasil transaksi pembelian');
        $("#kontenku").load("page/barang_masuk.php");

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('error');
      }
    });
  }


  function bersih_form() {
    $('#kobar').val('');
    $('#nabar').val('');
    $('#qty').val('');
    $('#rak').val('');
    $('#harga').val('');
    $('#exp').val('');

  }

  function save() {

    // alert(id_masuk);


    if ($('#kobar').val() == '' || $('#nabar').val() == '' || $('#qty').val() == '' || $('#rak').val() == '' || $('#harga').val() == '') {
      notif_oops('isi dulu semuanya !!');
    } else if (parseInt($('#harga').val()) < 0) {
      notif_oops('Harga tidak boleh kecil dari Rp0 !!');
    } else if (parseInt($('#qty').val()) < 0) {
      notif_oops('Jumlah tidak boleh kecil dari 0 !!');
    } else {
      var kobar = $('#kobar').val();
      var nabar = $('#nabar').val();
      var qty = $('#qty').val();
      var rak = $('#rak').val();
      var harga = $('#harga').val();
      var exp = $('#exp').val();


      $.ajax({
        url: "server_side/tambah_barang_masuk.php",
        type: "POST",
        data: {
          id_masuk: id_masuk,
          kobar: kobar,
          nabar: nabar,
          qty: qty,
          rak: rak,
          harga: harga,
          exp: exp
        },
        success: function(data) {
          load_data_beli(id_masuk);
          bersih_form();

        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('error');
        }
      });

    }

  }

  function hapus_item(id_masuk, kobar) {
    $.confirm({
      icon: 'fa fa-question',
      title: 'Hapus Data Item Barang Yg akan Masuk',
      content: 'Yakin akan menghapus data dengan kode barang ' + kobar + ' ?',
      type: 'dark',
      theme: 'modern',
      typeAnimated: true,
      buttons: {
        tryAgain: {
          text: 'Ok',
          btnClass: 'btn-blue',
          action: function() {
            $.ajax({
              url: "server_side/hapus_barang_masuk_item.php",
              type: "POST",
              data: {
                id_masuk: id_masuk,
                kobar: kobar
              },
              success: function(data) {
                load_data_beli(id_masuk);
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

  function load_data_beli(id_masuk) {
    $('#table_beli').load('server_side/table_beli.php?id_masuk=' + id_masuk);
    $('#kembali').attr('disabled', true);

  }

  function back() {
    $('#kontenku').load('page/barang_masuk.php');
  }
</script>