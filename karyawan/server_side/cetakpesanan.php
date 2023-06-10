<?php
include("../conn.php");
$id = $_GET['id'];

?>
<html>

<head>
  <title>Permintaan Barang</title>
  <link rel="stylesheet" href="mystyle.css" type="text/css" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body onLoad="window.print()">
  <table align="center">
    <tr>
      <th rowspan="3" align="center"><img src="../images/PT INTI.png" style="width:200px;height:100px" /></th>
      <td align="center" style="width: 520px;">
        <font style="font-size: 18px"><b>PT. INTI KAMPARINDO SEJAHTERA<br></b></font>
        <br><br>Desa Senamanenek, Kec. Tapung Hulu, Kabupaten Kampar. (0761)34609.
      </td>

    </tr>
  </table>

  <hr>
  <table align="center" width="40%" border="0" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
    <td width="3%">
      <?php
      $sql1 = $conn->query("SELECT nama, ruangan FROM detail_barang_keluar where id_keluar='$id' AND status='1' GROUP BY nama AND ruangan ");
      while ($row1 = $sql1->fetch_assoc()) {

      ?>
        <p align="left" style="font-weight: bold; font-size: 18px;">Nama yang Mengajukan </p>
        <p align="left" style="font-weight: bold; font-size: 18px;">Ruangan </p>
    </td>
    <td width="10%">
      <p align="left" style="font-weight: bold; font-size: 18px;">: <?php echo $row1['nama']; ?> </p>
      <p align="left" style="font-weight: bold; font-size: 18px;">: <?php echo $row1['ruangan']; ?></p>
    <?php
      }
    ?>
  </table>
  <br>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>FORM PERMINTAAN BARANG</u></p>


  <div class="isi" style="margin: 0 auto;">
    <!-- tabel barang masuk -->
    <table align="center" width="40%" border="1" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
      <thead>
        <?php
        $sql = $conn->query("SELECT * FROM detail_barang_keluar where id_keluar='$id' AND status='1'");
        ?>
        <tr align="center">
          <td width="3%">
            <font size="+1"><strong>No</strong></font>
          <td width="10%">
            <font size="+1"><strong>Kode Barang</strong></font>
          <td width="20%">
            <font size="+1"><strong>Nama Barang</strong></font>
          <td width="18%">
            <font size="+1"><strong>Jumlah Barang</strong></font>
          <td width="18%">
            <font size="+1"><strong>Rak</strong></font>
          <td width="20%">
            <font size="+1"><strong>ID Masuk Barang</strong></font>

        </tr>
        <?php
        $no = 1;
        while ($row = $sql->fetch_assoc()) {

        ?>
          <tr align="center">
            <td><?php echo $no; ?></td>
            <td><?php echo $row['kobar']; ?></td>
            <td><?php $sqlr = $conn->query("SELECT nama_barang FROM barang where kobar='" . $row['kobar'] . "' ");
                $row_r = $sqlr->fetch_assoc();
                $rak = $row_r['nama_barang']; { ?>
                <?= $row_r['nama_barang'] ?>
              <?php } ?>

            <td><?php echo $row['qty']; ?></td>
            <td><?php $sqlr = $conn->query("SELECT rak FROM barang where kobar='" . $row['kobar'] . "' ");
                $row_r = $sqlr->fetch_assoc();
                $rak = $row_r['rak']; { ?>
                <?= $row_r['rak'] ?>
              <?php } ?>

            <td>
              <font color="green"><?php echo $row['id_masuk']; ?></span>
            </td>
          </tr>

        <?php
          $no++;
        }
        ?>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table align="center" width="40%" border="0" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
      <td width="3%">
        <p align="left" style="font-weight: bold; font-size: 18px;">KET :
          <br>
        <p align="left" style="font-weight: bold; font-size: 18px;">- Barang keluar berdasarkan ID Masuk Barang </p>
      </td>


    </table>
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
