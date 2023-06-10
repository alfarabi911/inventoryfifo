<?php
session_start();
include '../cek.php';
include 'conn.php';
include '../helpers/Format.php';

if ($_SESSION['level'] != "admin") {
    echo '<script>alert("Anda tidak memiliki akses sebagai admin. Anda akan dialihkan ke halaman logout."); window.location.href = "logout.php";</script>';
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


    <title>FIFO Inventory PT. INTI KAMPARINDO SEJAHTERA - Admin</title>
    <link rel="icon" type="image/png" href="../PT Inti.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">



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
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-datepicker.min.css">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <style>
        .option_chart{
            width: 26%; margin: auto; height: 100px; text-align:center;
        }
        .option_chart a{
            border: 1px solid gray;
            border-radius: 10px;
            padding: 10px;
            text-decoration:none;
            float:left;
            margin:4px;
            text-align:center;
            display: block;
            color: green;
            }
        </style> -->
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

                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-important">Pesan</span>
                        </a>
                        <ul class="dropdown-menu">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <div class="modal-fade">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Pesan Notification</h4>
                                </div>
                                <div class="modal-dialog" role="document">
                                    <!-- <div class="modal-content"> -->
                                    <div class="modal-body">
                                        <?php
                                        $tgl_now = date("Y-m-d");
                                        $sql_exp = $conn->query("SELECT nama_barang,detail_barang_masuk.exp as exp, detail_barang_masuk.id_masuk as id_masuk FROM detail_barang_masuk RIGHT JOIN barang ON barang.kobar=detail_barang_masuk.kobar WHERE detail_barang_masuk.exp !='0000-00-00'and exp > curdate() -INTERVAL 30 day ");
                                        while ($row_exp = $sql_exp->fetch_assoc()) {
                                            $exp = $row_exp['exp'];
                                            $masa = strtotime($exp) - strtotime($tgl_now); {
                                                if ($masa / (24 * 60 * 60) < 1) {
                                                    echo "<div style='padding:1px' class='alert alert-info'><span class='message'></span><a style='color:blue'>" . $row_exp['nama_barang'] . "</a> Dengan Id Masuk <a style='color:blue'>" . $row_exp['id_masuk'] . "</a> <a style='color:red'>Sudah Expired</a> pada Tanggal " . $exp . " !!</div>";
                                                } elseif ($masa / (24 * 60 * 60) <= 30) {
                                                    echo "<div style='padding:1px' class='alert alert-info'><span class='message'></span><a style='color:blue'>" . $row_exp['nama_barang'] . "</a> dalam <a style='color:red'> " . $masa / (24 * 60 * 60) . "</a> Hari Lagi Akan Expired pada Tanggal <a style='color:red'>" . $exp . "</a><br> Dengan ID Masuk <a style='color:red'>" . $row_exp['id_masuk'] . "  !!</a></div>";
                                                }
                                            }
                                        }
                                        $sql_stok = $conn->query("SELECT nama_barang, COALESCE(SUM(detail_barang_masuk.sisa), 0) as sisa_stok FROM detail_barang_masuk RIGHT JOIN barang ON barang.kobar=detail_barang_masuk.kobar GROUP BY barang.kobar");
                                        while ($row_stok = $sql_stok->fetch_assoc()) {
                                            $sisa_stok = $row_stok['sisa_stok']; {
                                                if ($sisa_stok <= 3) {
                                                    echo "<div style='padding:1px' class='alert alert-danger'><span class='message'></span> Stok  <a style='color:red'>" . $row_stok['nama_barang'] . "</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";
                                                }
                                            }
                                        }
                                        $sql_permintaan = $conn->query("SELECT barang_keluar.id_keluar as id_keluar, tgl_keluar, SUM(qty) as qty FROM barang_keluar INNER JOIN detail_barang_keluar ON barang_keluar.id_keluar=detail_barang_keluar.id_keluar where status='0' GROUP BY barang_keluar.id_keluar ORDER BY tgl_keluar DESC");
                                        while ($row_status = $sql_permintaan->fetch_assoc()) {
                                            $status = $row_status['status']; {
                                                if ($status == 0) {
                                                    echo "<div style='padding:5px' class='alert alert-warning'><span class='message'></span> Permintaan barang pada Tanggal <a style='color:red'>" . $row_status['tgl_keluar'] . "</a> <a style='color:blue'> Belum Setujui</a>. Segera di Periksa!!</div>";
                                                }
                                                // else
                                                // {
                                                //     echo "<div style='padding:5px' class='alert alert-warning'><span class='message'></span> Permintaan barang pada Tanggal <a style='color:red'>". $row_status['tgl_keluar']."</a> <a style='color:blue'> Belum di Setujui </a></div>";
                                                // }
                                            }
                                        }

                                        ?>
                                    </div>
                                    <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        </div> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li id="edit"><a class="logout" href="#edit">Ganti Password</a></li>
                    <li><a id="logout" class="logout" href="#">Logout</a></li>
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
                    <h5 class="centered">Admin </h5>

                    <li class="mt">
                        <a href="index.php" id="home" class="active">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li id="stok">
                        <a href="#stok_barang">
                            <i class="fa fa-building"></i>
                            <span>Data Stok Barang</span>
                        </a>
                    </li>
                    <li id="brg_masuk">
                        <a href="#barang_masuk">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Barang Masuk</span>
                        </a>
                    </li>

                    <li id="brg_keluar">
                        <a href="#barang_keluar">
                            <i class="fa fa-money"></i>
                            <span>Barang Keluar</span>
                        </a>
                    </li>
                    <li id="permintaan">
                        <a href="#permintaan">
                            <i class="fa fa-files-o"></i>
                            <span>Permintaan Barang</span>
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

                    <li id="setting">
                        <a href="#setting_user">
                            <i class="fa fa-cogs"></i>
                            <span>Setting User</span>
                        </a>
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
                    <h3><i class="fa fa-angle-right"></i>&nbsp;Dashboard Admin</h3>
                    <div class="row mt">

                        <div class="col-lg-12">
                            <div class="content-panel">
                                <p align="center"> <img src="assets/img/admin.jpg" /></p>
                                <h1 align="center"> Halloo.. <?php echo $_SESSION['namkar'];  ?> </h1>
                                <h1 align="center"> Anda Log In Sebagai <?php echo $_SESSION['level'];  ?> </h1>
                                <br>
                                <br>
                                <br>
                                <h4 align="center"> Selamat Datang di Sistem Informasi Inventory<br>
                                    PT. INTI KAMPARINDO SEJAHTERA</h4>
                            </div>
                            <br>
                            <!-- <div id="crt"></div> -->
                        </div>
                    </div>
                    <br>
                    <!-- <div class="content-panel">
                <div id="crt_laba"></div>
            </div> -->
                    <br>
                    <!-- <div class="content-panel">
                <div id="crt_stok"></div>
            </div> -->
                </div>
                </div>

                </div>
                </div>
                </div>

            </section>
        </section><!-- /MAIN CONTENT -->
        <footer class="site-footer">
            <div class="text-center">
                &copy;FIFO Inventory <?php echo date('Y'); ?> - All Right Reserved
                <a href="index.php" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>

        <!--main content end-->
        <!--footer start-->
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
        $("#stok").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>page/stok.php");
        });
        $("#brg_masuk").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>page/barang_masuk.php");
        });
        $("#brg_keluar").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>page/barang_keluar.php");
        });
        $("#permintaan").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>page/permintaan_brg.php");
        });
        $("#lap_brgm").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>page/laporan_barangmasuk.php");
        });
        $("#lap_brgk").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>page/laporan_barangkeluar.php");
        });
        $("#lap_stock").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>page/laporan_stock.php");
        });
        $("#setting").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>page/setting.php");
        });
        $("#edit").click(function() {
            $("#kontenku").load("<?php echo base_url(); ?>server_side/edit_set.php");
        });
    </script>


    <script src="<?php echo base_url(); ?>assets/hc/highcharts.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/hc/exporting.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/hc/exporting.js" type="text/javascript"></script>
    <?php

    $query_lates7days = $conn->query("SELECT DAY(MAX(tgl_keluar)) AS latest_post_day, MONTH(MAX(tgl_keluar)) AS latest_post_month, YEAR(MAX(tgl_keluar)) AS latest_post_year FROM barang_keluar");
    $fetch_latest = $query_lates7days->fetch_assoc();
    $latestdays = $fetch_latest['latest_post_day'];
    $latestmonth = $fetch_latest['latest_post_month'];
    $latestyear = $fetch_latest['latest_post_year'];
    $latest_date = strtotime($latestyear . "-" . $latestmonth . "-" . $latestdays);
    $selected_start_date = strtotime("-30 day", $latest_date);
    $full_selected_start_date = date("Y-m-d", $selected_start_date);
    $start_year = date("Y", $selected_start_date);
    $selected_start_date = date('d', $selected_start_date);
    $selected_end_date = $latestdays;
    $full_selected_end_date = date("Y-m-d", $latest_date);
    $year = $latestyear;
    $mon = $latestmonth;
    $mon_name_1 = $fm->getMonthName(substr($full_selected_start_date, 5, 2));
    $mon_name_2 = $fm->getMonthName($latestmonth);
    $start_date = $full_selected_start_date;
    $end_date = date("Y-m-d");
    $text = "Dari " . $selected_start_date . " " . $mon_name_1 . " " . $start_year . " Sampai " . date('d') . " " . $mon_name_2 . " " . $year;
    $sql = $conn->query("SELECT * FROM barang");
    $sql2 = $conn->query("SELECT * FROM barang");
    $sql_stok = $conn->query("SELECT nama_barang, COALESCE(SUM(detail_barang_masuk.sisa), 0) as sisa_stok FROM detail_barang_masuk RIGHT JOIN barang ON barang.kobar=detail_barang_masuk.kobar GROUP BY barang.kobar");


    ?>

    <script>
        $(document).ready(function() {
            var nama_user = '<?= $_SESSION['user'];  ?>';
            var unique_id = $.gritter.add({
                // (string | mandatory) the heading of the notification

                title: 'Hello ' + nama_user + ' Selamat Datang di Aplikasi FIFO Inventory!',
                // (string | mandatory) the text inside the notification
                // (string | optional) the image to display on the left
                image: 'assets/img/admin.jpg',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: true,
                // (int | optional) the time you want it to be alive for before fading out
                time: 3000,

                // (string | optional) the class name you want to apply to that specific message
                class_name: 'my-sticky-class'
            });

            return false;
        });

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