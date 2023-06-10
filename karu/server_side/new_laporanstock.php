<?php include("../conn.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Stock</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Kode Barang</th>
                    <th style="text-align: center;">Nama Barang</th>
                    <th style="text-align: center;">Jenis</th>
                    <th style="text-align: center;">Stok</th>
                    <th style="text-align: center;">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conn->query("SELECT barang.kobar as kobar, barang.nama_barang as nama_barang,barang.jenis as jenis, id_masuk, max(harga) as harga, SUM(sisa) as sisa FROM barang LEFT JOIN detail_barang_masuk ON barang.kobar = detail_barang_masuk.kobar GROUP BY nama_barang");
                $no = 1;
                while ($data = $sql->fetch_assoc()) {
                ?>
                    <tr align="center">
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['kobar']; ?></td>
                        <td><?php echo $data['nama_barang']; ?></td>
                        <td><?php echo $data['jenis']; ?></td>
                        <td><?php echo ($data['sisa'] == '') ? "0" : $data['sisa']; ?></td>
                        <td>Rp<?php echo number_format($data['harga']); ?></td>
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