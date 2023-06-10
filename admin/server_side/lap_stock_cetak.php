<?php
include("../conn.php");
?>
<html>

<head>
  <title>Laporan Stock</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
  <table align="center">
    <tr>
      <td width="900" style="padding-top: 10px;">Dicetak Tanggal : <?php echo tgl_indo(date('Y-m-d')); ?></td>
    </tr>
    <tr>
      <td align="center" style="padding-top: 30px;"><img src="../images/PT INTI.png" /></td>
    </tr>
    <tr>
      <td align="center">
        <h2>Laporan Stock</h2>
        <p>PT. INTI KAMPARINDO SEJAHTERA</br>
          <em>Desa Senamanenek, Kec. Tapung Hulu, Kabupaten Kampar. (0761)34609.</em>
        </p>
      </td>
    </tr>
  </table>
  <!-- tabel barang masuk -->
  <br>
  <table align="center" width="62%" border="1" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
    <thead>
      <tr align="center">
        <th width="3%">
          <div class="centered-header">
            <font size="+1"><strong>No</strong></font>
          </div>
        </th>
        <th width="12%">
          <div class="centered-header">
            <font size="+1"><strong>Kode Barang</strong></font>
          </div>
        </th>
        <th width="32%">
          <div class="centered-header">
            <font size="+1"><strong>Nama Barang</strong></font>
          </div>
        </th>
        <th width="25%">
          <div class="centered-header">
            <font size="+1"><strong>Jenis</strong></font>
          </div>
        </th>
        <th width="5%">
          <div class="centered-header">
            <font size="+1"><strong>Stok</strong></font>
          </div>
        </th>
        <th width="16%">
          <div class="centered-header">
            <font size="+1"><strong>Harga</strong></font>
          </div>
        </th>
      </tr>
    </thead>
    <?php
    $sql = $conn->query("SELECT barang.kobar as kobar, barang.nama_barang as nama_barang,barang.jenis as jenis, id_masuk, max(harga) as harga, SUM(sisa) as sisa FROM barang LEFT JOIN detail_barang_masuk ON barang.kobar = detail_barang_masuk.kobar GROUP BY nama_barang");
    $no = 1;
    while ($data = $sql->fetch_assoc()) {
    ?>
      <tbody>
        <tr align="center">
          <td><?php echo $no ?></td>
          <td><?php echo $data['kobar']; ?></td>
          <td><?php echo $data['nama_barang']; ?></td>
          <td><?php echo $data['jenis']; ?></td>
          <td><?php if ($data['sisa'] == '') {
                echo "0";
              } else {
                echo $data['sisa'];
              } ?></td>
          <td>Rp<?php echo number_format($data['harga']); ?></td>
        </tr>
      </tbody>
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
