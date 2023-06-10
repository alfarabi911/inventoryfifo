<?php include("../conn.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Keluar</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css" />
    <style>
        .centered-header {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
        }

        @media print {
            table {
                page-break-inside: auto;
            }

            thead {
                display: table-header-group;
            }
        }
    </style>
</head>

<body onLoad="window.print()">
    <div class="container">
        <p>Dicetak Tanggal : <?php echo tgl_indo(date('Y-m-d')); ?></p>

        <div class="text-center">
            <img src="../images/PT INTI.png" />
            <h2>Laporan Stock</h2>
            <p>PT. INTI KAMPARINDO SEJAHTERA</br>
                <em>Desa Senamanenek, Kec. Tapung Hulu, Kabupaten Kampar. (0761)34609.</em>
            </p>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">No.</th>
                    <th style="text-align: center;">Kode Barang</th>
                    <th style="text-align: center;">Nama Barang</th>
                    <th style="text-align: center;">Tanggal Masuk</th>
                    <th style="text-align: center;">Tanggal Keluar</th>
                    <th style="text-align: center;">Jumlah Barang</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conn->query("SELECT * FROM barang_keluar INNER JOIN detail_barang_keluar ON barang_keluar.id_keluar=detail_barang_keluar.id_keluar where tgl_keluar between '" . $_POST['from'] . "' AND '" . $_POST['to'] . "' order by tgl_keluar asc");
                $no = 1;
                while ($row = $sql->fetch_assoc()) {
                ?>
                    <tr align="center">
                        <td><?php echo $no ?></td>
                        <td><?php echo $row['kobar']; ?></td>
                        <td><?php $sqlr = $conn->query("SELECT nama_barang FROM barang where kobar='" . $row['kobar'] . "' ");
                            $row_r = $sqlr->fetch_assoc();
                            $rak = $row_r['nama_barang']; { ?>
                                <?= $row_r['nama_barang'] ?>
                            <?php } ?>
                        <td><?php $sqlr = $conn->query("SELECT tgl_masuk FROM barang_masuk where id_masuk='" . $row['id_masuk'] . "' ");
                            $row_r = $sqlr->fetch_assoc();
                            $rak = $row_r['tgl_masuk']; { ?>
                                <?= $row_r['tgl_masuk'] ?>
                            <?php } ?>
                        </td>
                        <td><?php $sqlr = $conn->query("SELECT tgl_keluar FROM barang_keluar where id_keluar='" . $row['id_keluar'] . "' ");
                            $row_r = $sqlr->fetch_assoc();
                            $rak = $row_r['tgl_keluar']; { ?>
                                <?= $row_r['tgl_keluar'] ?>
                            <?php } ?>
                        </td>
                        <td><?php echo $row['qty']; ?></td>
                    </tr>
            </tbody>
        <?php $no++;
                } ?>
        </table>
        <div style="float:right;">
            <p>Yang Bertanda Tangan dibawah ini:</p>
            <p class="admin">Manager</p><br><br>
            <p class="nama">Agus Eko</p>
        </div>
    </div>
    <?php
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>
</body>

</html>