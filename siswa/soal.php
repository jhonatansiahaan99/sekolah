<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "include/koneksi.php";
if ($_SESSION['SISWA'] || $_SESSION['ID_SISWA']) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>SMK DHARMA BAKTI 2 MEDAN</title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- Sweetalert Css -->
        <!-- <link href="plugins/sweetalert2/sweetalert2.css" rel="stylesheet" /> -->
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <!-- summernote -->
        <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">

    </head>
    <script>
        $.noConflict();
    </script>
    <script>
        var waktunya;
        waktunya = <?php echo "$_POST[waktu_pengerjaan]"; ?>;
        var waktu;
        var jalan = 0;
        var habis = 0;

        function init() {
            checkCookie()
            mulai();
        }

        function keluar() {
            if (habis == 0) {
                setCookie('waktux', waktu, 365);
            } else {
                setCookie('waktux', 0, -1);
            }
        }

        function mulai() {
            jam = Math.floor(waktu / 3600);
            sisa = waktu % 3600;
            menit = Math.floor(sisa / 60);
            sisa2 = sisa % 60
            detik = sisa2 % 60;
            if (detik < 10) {
                detikx = "0" + detik;
            } else {
                detikx = detik;
            }
            if (menit < 10) {
                menitx = "0" + menit;
            } else {
                menitx = menit;
            }
            if (jam < 10) {
                jamx = "0" + jam;
            } else {
                jamx = jam;
            }
            document.getElementById("divwaktu").innerHTML = jamx + " H : " + menitx + " M : " + detikx + " S";
            waktu--;
            if (waktu > 0) {
                t = setTimeout("mulai()", 1000);
                jalan = 1;
            } else {
                if (jalan == 1) {
                    clearTimeout(t);
                }
                habis = 1;
                document.getElementById("formulir").submit();
            }
        }

        function selesai() {
            if (jalan == 1) {
                clearTimeout(t);
            }
            habis = 1;
            document.getElementById("formulir").submit();
        }

        function getCookie(c_name) {
            if (document.cookie.length > 0) {
                c_start = document.cookie.indexOf(c_name + "=");
                if (c_start != -1) {
                    c_start = c_start + c_name.length + 1;
                    c_end = document.cookie.indexOf(";", c_start);
                    if (c_end == -1) c_end = document.cookie.length;
                    return unescape(document.cookie.substring(c_start, c_end));
                }
            }
            return "";
        }

        function setCookie(c_name, value, expiredays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + expiredays);
            document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString());
        }

        function checkCookie() {
            waktuy = getCookie('waktux');
            if (waktuy != null && waktuy != "") {
                waktu = waktuy;
            } else {
                waktu = waktunya;
                setCookie('waktux', waktunya, 7);
            }
        }
    </script>
    <script type="text/javascript">
        window.history.forward();

        function noBack() {
            window.history.forward();
        }
    </script>
    <script type="text/javascript">
        function tombol() {
            document.getElementById("tombol").innerHTML = "<input type=button class='btn btn-success' value=Simpan onclick=selesai()>";
        }
    </script>


    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed " onload="init(),noBack();" onpageshow="if (event.persisted) noBack();" onunload="keluar()">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>

                </ul>



                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <a href="logout.php" class="btn btn-warning btn-md" role="button" aria-pressed="true">Logout</a>
                </ul>
            </nav>
            <!-- /.navbar -->




            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- sidebar -->
                <?php include "include/menu.php"  ?>
                <!-- /.sidebar -->

            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">

                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">

                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">

                            <?php

                            // include "include/isi.php" 

                            ?>

                        </div>
                    </div>
                    <!--/. container-fluid -->
                </section>
                <!-- /.content-wrapper -->


                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->







                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            Sisa Waktu
                            <small><button class='btn btn-info'>
                                    <div id='divwaktu'></div>
                                </button></small>
                        </h1>
                    </section>

                    <!-- Main content -->
                    <section class="content">



                        <div class='box box-primary'>
                            <div class='box-header with-border'>
                                <div class='col-md-12 col-xs-12'>
                                    <form action="nilai.php" method="post" id="formulir">
                                        <?php


                                        $cek_siswa = $koneksi->query("SELECT * FROM siswa_sudah_mengerjakan where ID_TOPIK_QUIZ = '$_POST[id]' AND ID_SISWA = '$_SESSION[ID_SISWA]' ");
                                        $info_siswa = $cek_siswa->fetch_assoc();

                                        if ($info_siswa['HITS'] <= 0) {
                                            $siswa_sudah_mengerjakan = $koneksi->query("INSERT INTO siswa_sudah_mengerjakan (ID_TOPIK_QUIZ,ID_SISWA,HITS)
                                        VALUES ('$_POST[id]','$_SESSION[ID_SISWA]',HITS+1)");
                                        } elseif ($info_siswa['HITS'] > 0) {
                                        }
                                        $soal = $koneksi->query("SELECT * FROM tbl_quiz_pilganda where ID_TOPIK_QUIZ='$_POST[id]' ORDER BY rand()");
                                        $pilganda = $soal->num_rows;
                                        $soal_esay = $koneksi->query("SELECT * FROM tbl_quiz_essay WHERE ID_TOPIK_QUIZ='$_POST[id]'");
                                        $esay = $soal_esay->num_rows;
                                        if (!empty($pilganda) and !empty($esay)) {
                                            echo "<br><b class='judul'>Daftar Soal Pilihan Ganda</b><br><p class='garisbawah'></p>
      <table class='table table-form' style='font-size: 16px'>
        <tbody>
            <input type=hidden name=id_topik value='$_POST[id]'>";
                                            $no = 1;

                                            while ($s = $soal->fetch_assoc()) {
                                                if (!empty($s['GAMBAR'])) {




                                                    echo "<tr><td style='v-align: top' colspan='2'>$no." . $s['PERTANYAAN'] . "</td></tr>";
                                                    echo "<tr><td><img width='500px' height='500px'  src='../images_soal_pilganda/$s[GAMBAR]' class='img-fluid'></td></tr>";
                                                    echo "<tr><td><p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='A'>A. " . $s['PIL_A'] . "</p>";
                                                    echo "<p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='B'>B. " . $s['PIL_B'] . "</p>";
                                                    echo "<p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='C'>C. " . $s['PIL_C'] . "</p>";
                                                    echo "<p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='D'>D. " . $s['PIL_D'] . "</p>";
                                                    echo "<p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='E'>E. " . $s['PIL_E'] . "</p></td></tr>";
                                                } else {
                                                    echo "<tr><td><h3>$no.</h3></td><td><h3>" . $s['PERTANYAAN'] . "</h3></td>";
                                                    echo "<p><td><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='A'>A. " . $s['PIL_A'] . "</p>";
                                                    echo "<p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='B'>B. " . $s['PIL_B'] . "</p>";
                                                    echo "<p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='C'>C. " . $s['PIL_C'] . "</p>";
                                                    echo "<p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='D'>D. " . $s['PIL_D'] . "</p>";
                                                    echo "<p><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='E'>E. " . $s['PIL_E'] . "</p></td></tr>";
                                                }
                                                $no++;
                                            }
                                            echo "</table>";
                                            echo "<br><b class='judul'>Daftar Soal Essay</b><br><p class='garisbawah'></p>
    <table>";
                                            $no2 = 1;

                                            while ($e = $soal_esay->fetch_assoc()) {
                                                if (!empty($e['GAMBAR'])) {
                                                    echo "<tr><td rowspan=4><h3>$no2.</h3></td><td><h3>" . $e['PERTANYAAN'] . "</h3></td></tr>";
                                                    echo "<tr><td><img width='500px' height='500px' src='../images_soal_essay/$e[GAMBAR]' class='img-fluid'></td></tr>";
                                                    echo "<tr><td>Jawaban : </td></tr>";
                                                    echo "<tr><td><textarea name=soal_esay[" . $e['ID_ESSAY'] . "]  class='form-control ckeditor' cols=95 rows=5></textarea></td></tr>";
                                                } else {
                                                    echo "<tr><td rowspan=3><h3>$no2.</h3></td><td><h3>" . $e['PERTANYAAN'] . "</h3></td></tr>";
                                                    echo "<tr><td>Jawaban : </td></tr>";
                                                    echo "<tr><td><textarea name=soal_esay[" . $e['ID_ESSAY'] . "] cols=95 rows=5></textarea></td></tr>";
                                                }
                                                $no2++;
                                            }
                                            echo "</table>";
                                            $jumlahsoal = $no - 1;
                                            echo "<input type=hidden name=jumlahsoalpilganda value=$jumlahsoal>";
                                        } elseif (!empty($pilganda) and empty($esay)) {
                                            echo "<br><b class='judul'>Daftar Soal Pilihan Ganda</b><br><p class='garisbawah'></p>
      <table class='table table-form' style='font-size: 16px'>
        <tbody>
        <input type=hidden name=id_topik value='$_POST[id]'>";
                                            $no = 1;

                                            while ($s = $soal->fetch_assoc()) {
                                                if ($s['GAMBAR'] != '') {
                                                    echo "<tr><td style='v-align: top'>$no.</td><td colspan='2'>" . $s['PERTANYAAN'] . "</td></tr>";
                                                    echo "<tr><td width='1%'></td> <td></td><td><img width='500px' height='500px' src='../images_soal_pilganda/$s[GAMBAR]' class='img-fluid'></td></tr>";
                                                    echo "<tr><td width='1%'>A</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='A'></td><td> " . $s['PIL_A'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>B</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='B'></td><td> " . $s['PIL_B'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>C</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='C'></td><td> " . $s['PIL_C'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>D</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='D'></td><td> " . $s['PIL_D'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>E</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='E'></td><td> " . $s['PIL_E'] . "</td></tr>";
                                                } else {
                                                    echo "<tr><td style='v-align: top'>$no.</td><td colspan='2'>" . $s['PERTANYAAN'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>A</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='A'></td><td> " . $s['PIL_A'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>B</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='B'></td><td> " . $s['PIL_B'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>C</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='C'></td><td> " . $s['PIL_C'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>D</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='D'></td><td> " . $s['PIL_D'] . "</td></tr>";
                                                    echo "<tr><td width='1%'>E</td><td width='1%'><input type=radio name=soal_pilganda[" . $s['ID_PILGANDA'] . "] value='E'></td><td> " . $s['PIL_E'] . "</td></tr>";
                                                }
                                                $no++;
                                            }
                                            echo "</table>";
                                            $jumlahsoal = $no - 1;
                                            echo "<input type=hidden name=jumlahsoalpilganda value=$jumlahsoal>";
                                        } elseif (empty($pilganda) and !empty($esay)) {
                                            echo "<br><b class='judul'>Daftar Soal Essay</b><br><p class='garisbawah'></p>
    <table><input type=hidden name=id_topik value='$_POST[id]'>";
                                            $no2 = 1;

                                            while ($e = $soal_esay->fetch_assoc()) {
                                                if (!empty($e['GAMBAR'])) {
                                                    echo "<tr><td rowspan=4><h3>$no2.</h3></td><td><h3>" . $e['PERTANYAAN'] . "</h3></td></tr>";
                                                    echo "<tr><td><img width='500px' height='500px' src='../images_soal_essay/$e[GAMBAR]' class='img-fluid'></td></tr>";
                                                    echo "<tr><td>Jawaban : </td></tr>";
                                                    echo "<tr><td><textarea name=soal_esay[" . $e['ID_ESSAY'] . "]  class='form-control ckeditor' cols=95 rows=10></textarea></td></tr>";
                                                } else {
                                                    echo "<tr><td rowspan=3><h3>$no2.</h3></td><td><h3>" . $e['PERTANYAAN'] . "</h3></td></tr>";
                                                    echo "<tr><td>Jawaban : </td></tr>";
                                                    echo "<tr><td><textarea name=soal_esay[" . $e['ID_ESSAY'] . "]   class='form-control ckeditor'cols=95 rows=10></textarea></td></tr>";
                                                }
                                                $no2++;
                                            }
                                            echo "</table>";
                                        } elseif (empty($pilganda) and empty($esay)) {
                                            echo "<script>window.alert('Maaf belum ada soal di Topik Ini.');
            window.location=(href='index.php')</script>";
                                        }
                                        ?>
                                        <br />
                                        <br />
                                        <p>
                                            <h3>Apakah anda sudah yakin dengan jawaban anda dan ingin menyimpannya? <button type=button class='btn btn-warning' onclick="tombol()">Ya</button></h3>
                                            <h3 id="tombol"></h3>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>




                    </section><!-- /.content -->
                </div><!-- /.content-wrapper -->


































                <!-- Main Footer -->
                <footer class="main-footer">
                    <strong>Copyright &copy; 2020 <a href="#">SMK DHARMA BAKTI 2 MEDAN</a>.</strong>
                    All rights reserved.
                    <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 3.0.5
                    </div>
                </footer>
            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->
            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- overlayScrollbars -->
            <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.js"></script>

            <!-- OPTIONAL SCRIPTS -->
            <script src="dist/js/demo.js"></script>

            <!-- PAGE PLUGINS -->

            <!-- Myscript JS untuk tombol hapus -->
            <script src="plugins/js/myscript.js"></script>

            <!-- jQuery Mapael -->
            <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
            <script src="plugins/raphael/raphael.min.js"></script>
            <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
            <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>

            <!-- DataTables -->
            <script src="plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

            <!-- SweetAlert Plugin Js -->
            <!-- <script src="plugins/sweetalert2/sweetalert2.min.js"></script> -->
            <script src="plugins/sweetalert/sweetalert.min.js"></script>


            <!-- ChartJS -->
            <script src="plugins/chart.js/Chart.min.js"></script>

            <!-- PAGE SCRIPTS -->
            <!-- <script src="dist/js/pages/dashboard2.js"></script> -->

            <!-- Summernote -->
            <script src="plugins/summernote/summernote-bs4.min.js"></script>
            <script>
                $(function() {
                    // Summernote
                    $('.textarea').summernote()
                })
            </script>

            <!-- Data Table -->
            <script>
                $(function() {
                    $("#example1").DataTable({
                        "responsive": true,
                        "autoWidth": false,
                    });
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                });
            </script>
            <!-- /Data Table -->


    </body>

    </html>
<?php } else {
?>
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                title: "Silahkan Login Terlebih Dahulu",
                text: "Oops... Gagal Login!",
                type: "error",
                showConfirmButton: false,
                timer: 2000
            }, function() {
                window.location.href = "../index.php";

            });
        }, 100);
    </script>
<?php
}
?>

<!-- Sweetalert Css -->
<!-- <link href="plugins/sweetalert2/sweetalert2.css" rel="stylesheet" /> -->
<link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
<!-- SweetAlert Plugin Js -->
<!-- <script src="plugins/sweetalert2/sweetalert2.min.js"></script> -->
<script src="plugins/sweetalert/sweetalert.min.js"></script>