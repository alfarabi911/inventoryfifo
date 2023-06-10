<?php
include("../conn.php");
?>
<html>

<head>
  <title>Laporan Barang Keluar</title>
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
        <h2>Laporan Barang Keluar</h2>
        <h4><?php echo $_POST['from'] . ' s.d ' . $_POST['to']; ?></h4>
        <p>PT. INTI KAMPARINDO SEJAHTERA</br>
          <em>Desa Senamanenek, Kec. Tapung Hulu, Kabupaten Kampar. (0761)34609.</em>
        </p>
      </td>
    </tr>
  </table>
  <br>
  <!-- tabel barang masuk -->
  <table align="center" width="62%" border="1" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
    <thead>
      <tr align="center">
        <th width="3%">
          <div class="centered-header">
            <font size="+1"><strong>No</strong></font>
          </div>
        </th>
        <th width="10%">
          <div class="centered-header">
            <font size="+1"><strong>Kode Barang</strong></font>
          </div>
        </th>
        <th width="20%">
          <div class="centered-header">
            <font size="+1"><strong>Nama Barang</strong></font>
          </div>
        </th>
        <th width="20%">
          <div class="centered-header">
            <font size="+1"><strong>Tanggal Masuk</strong></font>
          </div>
        </th>
        <th width="20%">
          <div class="centered-header">
            <font size="+1"><strong>Tanggal Keluar</strong></font>
          </div>
        </th>
        <th width="18%">
          <div class="centered-header">
            <font size="+1"><strong>Jumlah Barang</strong></font>
          </div>
        </th>
      </tr>
      <?php
      $sql = $conn->query("SELECT * FROM barang_keluar INNER JOIN detail_barang_keluar ON barang_keluar.id_keluar=detail_barang_keluar.id_keluar where tgl_keluar between '" . $_POST['from'] . "' AND '" . $_POST['to'] . "' order by tgl_keluar asc");
      $no = 1;
      while ($row = $sql->fetch_assoc()) {
      ?>
    <tbody>
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
    <?php
        $no++;
      }
    ?>
    </tbody>
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
