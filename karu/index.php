<?php
session_start();
include '../cek.php';
include 'conn.php';
include '../helpers/Format.php';

if ($_SESSION['level'] != "karu") {
  echo '<script>alert("Anda tidak memiliki akses sebagai Kepala Ruangan. Anda akan dialihkan ke halaman logout."); window.location.href = "logout.php";</script>';
}

$fm = new Format();


header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>FIFO Inventory PT. INTI KAMPARINDO SEJAHTERA - Karu</title>
  <link rel="icon" type="image/png" href="../PT Inti.png">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
  <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/gritter/css/jquery.gritter.css" />

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/lineicons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style_pagination.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fileinput/css/fileinput.min.css">
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-confirm/dist/jquery-confirm.min.css">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
    .option_chart {
      width: 26%;
      margin: auto;
      height: 100px;
      text-align: center;
    }

    .option_chart a {
      border: 1px solid gray;
      border-radius: 10px;
      padding: 10px;
      text-decoration: none;
      float: left;
      margin: 4px;
      text-align: center;
      display: block;
      color: green;
    }
  </style>




</head>

<body>

  <section id="container">
    <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.php" class="logo"><b>FIFO Inventory</b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->

          <!-- inbox dropdown end -->
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li id="edit"><a class="logout" href="#edit">Ganti Password</a></li>

          <li><a id="logout" class="logout" href="logout.php">Logout</a></li>
        </ul>

      </div>
    </header>

    <!--header end-->

    <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

          <p class="centered"><a href="?page=Profil"><img src="<?php echo base_url(); ?>assets/img/admin.jpg" class="img-circle" width="60"></a></p>
          <h5 class="centered">Kepala Ruangan</i></h5>

          <li class="mt">
            <a href="index.php" id="home" class="active">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Laporan</span>
            </a>
            <ul class="sub">
              <li id="lap_brgm"><a href="#lap_brgm">Laporan Barang Masuk</a></li>
              <li id="lap_brgk"><a href="#lap_brgk">Laporan Barang Keluar</a></li>
              <li id="lap_stock"><a href="#lap_stock">Laporan Stock</a></li>
            </ul>
          </li>



        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">

        <div id="kontenku">
          <h3><i class="fa fa-angle-right"></i>&nbsp;Dashboard</h3>
          <div class="row mt">


            <div class="col-lg-12">
              <div class="content-panel">
                <p align="center"> <img src="assets/img/admin.jpg" /></p>
                <h1 align="center"> Halloo.. <?php echo $_SESSION['namkar'];  ?> </h1>
                <h1 align="center"> Anda Log In Sebagai <?php echo $_SESSION['level'];  ?> </h1>
                <br>
                <br>
                <br>
                <h4 align="center"> Selamat Datang di Sistem Informasi Pengendalian Inventory<br>
                  PT. INTI KAMPARINDO SEJAHTERA</h4>

              </div>
            </div>
          </div>
        </div>




        <!--main content end-->
        <!--footer start-->
        <footer class="site-footer">
          <div class="text-center">

            &copy;FIFO Inventory <?php echo date('Y'); ?> - All Right Reserved
            <a href="index.php" class="go-top">
              <i class="fa fa-angle-up"></i>
            </a>
          </div>
        </footer>
        <!--footer end-->
      </section>
      <!-- js placed at the end of the document so the pages load faster -->
      <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>

      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
      <script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.js"></script>
      <!--common script for all pages-->
      <script src="<?php echo base_url(); ?>assets/js/common-scripts.js"></script>

      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gritter/js/jquery.gritter.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gritter-conf.js"></script>


      <script src="<?php echo base_url(); ?>assets/fileinput/js/fileinput.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>

      <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

      <script src="<?php echo base_url(); ?>assets/plugins/jquery-confirm/dist/jquery-confirm.min.js"></script>
      <script type="text/javascript">
        $("#lap_brgm").click(function() {
          $("#kontenku").load("<?php echo base_url(); ?>page/laporan_barangmasuk.php");
        });
        $("#lap_brgk").click(function() {
          $("#kontenku").load("<?php echo base_url(); ?>page/laporan_barangkeluar.php");
        });
        $("#lap_stock").click(function() {
          $("#kontenku").load("<?php echo base_url(); ?>page/laporan_stock.php");
        });
        $("#edit").click(function() {
          $("#kontenku").load("<?php echo base_url(); ?>page/edit_set.php");
        });
      </script>




      </script>
      <script>
        function notif(text, url) {
          $.gritter.add({
            title: 'Aplikasi FIFO Inventory!',
            text: text,
            image: 'assets/img/admin.jpg',
            time: 2000,
            class_name: 'my-sticky-class',
            after_close: function(e, manual_close) {
              $('#kontenku').load(url);
            }
          });
        }

        function notif_oops(text) {
          $.alert({
            icon: 'fa fa-exclamation',
            title: 'Ooops... !',
            content: text,
            theme: 'modern',
            type: 'red',
            typeAnimated: true,
          });
        }

        function notif_success(text) {
          $.alert({
            icon: 'fa fa-check',
            title: 'Success!',
            content: text,
            theme: 'modern',
            type: 'blue',
            typeAnimated: true,
          });
        }
      </script>

      <script>
        setTimeout(function() {
          window.location.href = "logout.php";
        }, 3600000); // Waktu timeout dalam milidetik (1 jam = 3600000 ms)
      </script>

      <script>
        // Menangkap klik pada tautan Logout
        $("#logout").on("click", function(e) {
          e.preventDefault(); // Mencegah tindakan default dari tautan

          // Menampilkan kotak dialog konfirmasi menggunakan $.confirm()
          $.confirm({
            title: "Konfirmasi",
            content: "Apakah Anda yakin ingin keluar?",
            type: 'dark',
            theme: 'modern',
            typeAnimated: true,
            buttons: {
              ya: {
                text: "Ya",
                btnClass: 'btn-blue',
                action: function() {
                  window.location.href = "logout.php"; // Logout jika pengguna memilih "Ya"
                }
              },
              tidak: {
                text: "Tidak",
                action: function() {
                  // Tidak melakukan apa pun jika pengguna memilih "Tidak"
                }
              }
            }
          });
        });
      </script>

</body>

</html>