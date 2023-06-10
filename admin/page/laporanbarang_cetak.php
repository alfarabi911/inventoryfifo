<?php
include("../conn.php");
?>
<html>

<head>
  <title>Laporan Barang Masuk</title>
  <link rel="stylesheet" href="mystyle.css" type="text/css" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body onLoad="window.print()">
  <table align="center">
    <tr>
      <td width="900">Dicetak Tanggal : <?php echo tgl_indo(date('Y-m-d')); ?></td>
    </tr>
  </table>
  <table width="100%" cellpadding="5" cellspacing="0">
    <tr>

      <td align="center"><img src="../images/PT INTI.png" /></td>
    </tr>
    <td align="center">
      <br>
      <h2>Laporan Barang Masuk</h2>
      <br>
      <h3><?php echo $_POST['from'] . ' s.d ' . $_POST['to']; ?></h3>

      <p>PT. INTI KAMPARINDO SEJAHTERA</br>
        <em>Desa Senamanenek, Kec. Tapung Hulu, Kabupaten Kampar. (0761)34609.</em>
      </p>

    </td>
    <hr>
    </tr>
    </div>
    <br><br><br><br><br>
    <!-- tabel barang masuk -->
    <table align="center" width="100%" border="1" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
      <thead>
        <tr align="center">
          <td width="5%">
            <font size="+1"><strong>No</strong></font>
          <td width="15%">
            <font size="+1"><strong>Kode Barang</strong></font>
          <td width="20%">
            <font size="+1"><strong>Nama Barang</strong></font>
          <td width="15%">
            <font size="+1"><strong>Jumlah Barang</strong></font>
          <td width="15%">
            <font size="+1"><strong>Rak</strong></font>
          <td width="23%">
            <font size="+1"><strong>Tanggal Masuk</strong></font>

        </tr>
        <?php

        $sql = $conn->query("SELECT * FROM barang_masuk INNER JOIN detail_barang_masuk ON barang_masuk.id_masuk=detail_barang_masuk.id_masuk where tgl_masuk between '" . $_POST['from'] . "' AND '" . $_POST['to'] . "' order by tgl_masuk asc");



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
            </td>
            <td><?php echo $row['qty']; ?></td>
            <td><?php $sqlr = $conn->query("SELECT rak FROM barang where kobar='" . $row['kobar'] . "' ");
                $row_r = $sqlr->fetch_assoc();
                $rak = $row_r['rak']; { ?>
                <?= $row_r['rak'] ?>
              <?php } ?>
            </td>
            <td><?php $sqlr = $conn->query("SELECT tgl_masuk FROM barang_masuk where id_masuk='" . $row['id_masuk'] . "' ");
                $row_r = $sqlr->fetch_assoc();
                $rak = $row_r['tgl_masuk']; { ?>
                <?= $row_r['tgl_masuk'] ?>
              <?php } ?>
            </td>
          </tr>

        <?php
          $no++;
        }
        ?>
    </table>
    <div>
      <div style="width:400px;float:right">
        <br>
        <br>
        <p>Yang bertanda tangan dibawah ini :</p>
        <p class="admin">Manager</br>
        </p>
        <br>
        <br>
        <br>
        <br>
        <p class="nama">Agus Eko</p>

      </div>
    </div>



    </page>
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

      // variabel pecahkan 0 = tanggal
      // variabel pecahkan 1 = bulan
      // variabel pecahkan 2 = tahun

      return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
