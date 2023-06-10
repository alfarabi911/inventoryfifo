<?php
include("../conn.php");
?>
<h3><i class="fa fa-angle-right"></i>&nbsp;Stok Barang</h3>
<!-- tabel -->
<div class="row mt">
    <div class="col-md-12">
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Perhatian!</strong> Data dengan harga Rp.0 dan stok = 0 pertanda belum ada barang yang masuk dengan kode barang tersebut dan anda masih bisa menghapusnya.
        </div>
        <div class="content-panel">
            <div class="row">
                <div class="col-sm-3">
                    <h4><i class="fa fa-angle-right"></i>&nbsp;Data Stok Barang</h4>
                </div>
                <div class="col-sm-9">
                    <?php
                    $initial = 'B';
                    $query = $conn->query("SELECT max(kobar) AS last FROM barang WHERE kobar LIKE '$initial%'");
                    $data  = $query->fetch_assoc();
                    $lastNoTransaksi = $data['last'];
                    $lastNoUrut = substr($lastNoTransaksi, 1, 3);
                    $nextNoUrut = $lastNoUrut + 1;
                    $nextNoTransaksi = $initial . sprintf('%03s', $nextNoUrut);
                    ?>
                    <button class="btn btn-success btn-md" onclick="tambah_barang('<?= $nextNoTransaksi; ?>')" style="float: right; margin-right: 9px;">
                        Tambahkan Data Barang
                    </button>
                </div>
            </div>
            <div class="table-responsive" style="padding:10px;">
                <table class="table table-striped table-advance table-hover" id="dataku">

                    <thead>
                        <tr>
                            <th><i class="fa fa-bullhorn"></i> No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Ruangan</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $conn->query("SELECT barang.kobar as kobar, barang.nama_barang as nama_barang, barang.jenis as jenis, barang.rak as rak, id_masuk, max(harga) as harga, SUM(sisa) as sisa FROM barang LEFT JOIN detail_barang_masuk ON barang.kobar = detail_barang_masuk.kobar GROUP BY nama_barang");
                        $no = 1;
                        while ($data = $sql->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['kobar']; ?></td>
                                <td><?php echo $data['nama_barang']; ?></td>
                                <td><?php echo $data['jenis']; ?></td>
                                <td><?php echo $data['rak']; ?></td>
                                <td><?php if ($data['sisa'] == '') {
                                        echo "0";
                                    } else {
                                        echo $data['sisa'];
                                    } ?></td>
                                <td>Rp. <?php echo number_format($data['harga']); ?></td>
                                <td>
                                    <a class="btn btn-info btn-xs" title="ubah nama barang" onclick="ubah_nama_barang('<?php echo $data['kobar']; ?>','<?php echo $data['nama_barang']; ?>','<?php echo $data['jenis']; ?>','<?php echo $data['rak']; ?>')"> <i class="fa fa-pencil"></i></a>
                                    <?php if ($data['sisa'] == '') { ?>
                                        <a class="btn btn-danger btn-xs" title="hapus data barang" onclick="hapus_barang('<?php echo $data['kobar']; ?>')"> <i class="fa fa-trash-o"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /content-panel -->
        <!-- Bootstrap modal -->
        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Tambah Barang</h3>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="form" class="form-horizontal">
                            <input type="hidden" value="" name="id" />
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Kode Barang</label>
                                    <div class="col-md-9">
                                        <input name="kobar" id="kobar" placeholder="Kode barang" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama Barang</label>
                                    <div class="col-md-9">
                                        <input name="nabar" id="nabar" placeholder="Nama Barang" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Jenis barang</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="jenis" id="jenis">
                                            <option> --- Pilih Jenis ---</option>
                                            <option> PUPUK PADAT</option>
                                            <option> PUPUK CAIR</option>
                                            <option> ATK</option>
                                            <option> NON ATK</option>
                                            <option> PERCETAKAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Ruangan</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="rak" id="rak">
                                            <!-- 1A Hijau
                                        1B Besi
                                        2A Rotan
                                        2B Kayu -->
                                            <option> --- Pilih Ruangan ---</option>
                                            <option> 1A</option>
                                            <option> 1B</option>
                                            <option> 2A</option>
                                            <option> 2B</option>
                                            <option> 3A</option>
                                            <option> 3B</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="saving()" data-dismiss="modal" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" id="cancel-btn" data-dismiss="modal">Cancel</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <script>
            var save_method;
            $('#dataku').dataTable();

            function ubah_nama_barang(id, nama_barang, jenis, rak) {
                // alert(id+' - '+nama_barang);
                save_method = 'update';
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('#kobar').val(id);
                $('#nabar').val(nama_barang);
                $('#jenis').val(jenis);
                $('#rak').val(rak);

            }

            function tambah_barang(no) {
                save_method = 'add';
                $('#modal_form').modal('show');
                $('#form')[0].reset();

            }

            function hapus_barang(kode) {
                $.confirm({
                    icon: 'fa fa-question',
                    title: 'Hapus Data Barang',
                    content: 'Yakin akan menghapus data dengan kode ' + kode + ' ?',
                    type: 'dark',
                    theme: 'modern',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: 'Ok',
                            btnClass: 'btn-blue',
                            action: function() {
                                $.ajax({
                                    url: "server_side/hapus_barang.php",
                                    type: "POST",
                                    data: {
                                        kobar: kode
                                    },
                                    success: function(data) {
                                        notif_success('Berhasil hapus data barang');
                                        $('#kontenku').load('page/stok.php');

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


            function saving() {
                var url;
                if (save_method == 'add') {
                    url = "server_side/tambah_barang.php";
                } else {
                    url = "server_side/ubah_nama_barang.php";
                }


                var formData = new FormData($('#form')[0]);
                if ($('#nabar').val() == '') {
                    notif_oops('isi dulu nama barangnya !!');
                } else {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status) //if success
                            {

                                notif_success('Oke berhasil');
                                // delay 1 detik
                                setTimeout(function() {
                                    $('#kontenku').load('page/stok.php');
                                }, 1000);


                            } else {
                                notif_oops('Gagal');
                                setTimeout(function() {
                                    $('#kontenku').load('page/stok.php');
                                }, 1000);

                            }



                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('error');

                        }

                    });
                }
            }
        </script>