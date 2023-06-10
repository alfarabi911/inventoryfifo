<?php
include("../conn.php");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css" />
    <title>Laporan Barang Masuk</title>
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
            <h2>Laporan Barang Masuk</h2>
            <h3>Periode: <?php echo $_POST['from'] . ' s.d ' . $_POST['to']; ?></h3>
            <p>PT. INTI KAMPARINDO SEJAHTERA</br>
                <em>Desa Senamanenek, Kec. Tapung Hulu, Kabupaten Kampar. (0761)34609.</em>
            </p>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Kode Barang</th>
                    <th style="text-align: center;">Nama Barang</th>
                    <th style="text-align: center;">Jumlah Barang</th>
                    <th style="text-align: center;">Ruangan</th>
                    <th style="text-align: center;">Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conn->query("SELECT * FROM barang_masuk INNER JOIN detail_barang_masuk ON barang_masuk.id_masuk=detail_barang_masuk.id_masuk where tgl_masuk between '" . $_POST['from'] . "' AND '" . $_POST['to'] . "' order by tgl_masuk asc");
                $no = 1;
                while ($row = $sql->fetch_assoc()) {
                    $sqlr = $conn->query("SELECT nama_barang, rak FROM barang where kobar='" . $row['kobar'] . "' ");
                    $row_r = $sqlr->fetch_assoc();
                    $nama_barang = $row_r['nama_barang'];
                    $rak = $row_r['rak'];
                    $tgl_masuk = $row['tgl_masuk'];
                ?>
                    <tr align="center">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['kobar']; ?></td>
                        <td><?php echo $nama_barang; ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td><?php echo $rak; ?></td>
                        <td><?php echo $tgl_masuk; ?></td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
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