<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "include/koneksi.php";
if ($_SESSION['SISWA'] || $_SESSION['ID_SISWA']) {

    $soal = $koneksi->query("SELECT * FROM tbl_quiz_pilganda where ID_TOPIK_QUIZ='$_POST[id_topik]'");
    $pilganda = $soal->num_rows;
    $soal_esay = $koneksi->query("SELECT * FROM tbl_quiz_essay WHERE ID_TOPIK_QUIZ	='$_POST[id_topik]'");
    $esay = $soal_esay->num_rows;
    //jika ada pilihan ganda dan ada esay
    if (!empty($pilganda) and !empty($esay)) {
        //jika ada inputan soal pilganda
        if (!empty($_POST['soal_pilganda'])) {
            $benar = 0;
            $salah = 0;
            foreach ($_POST['soal_pilganda'] as $key => $value) {
                $cek = $koneksi->query("SELECT * FROM tbl_quiz_pilganda WHERE ID_PILGANDA=$key");
                while ($c = $cek->fetch_assoc()) {
                    $jawaban = $c['KUNCI'];
                }
                if ($value == $jawaban) {
                    $benar++;
                } else {
                    $salah++;
                }
            }
            $jumlah = $_POST['jumlahsoalpilganda'];
            $tidakjawab = $jumlah - $benar - $salah;
            $persen = $benar / $jumlah;
            $hasil = $persen * 100;
            $koneksi->query("INSERT INTO tbl_nilai (ID_TOPIK_QUIZ, ID_SISWA, BENAR, SALAH, TIDAK_DIKERJAKAN,PERSENTASE)
                           VALUES ('$_POST[id_topik]','$_SESSION[ID_SISWA]','$benar','$salah','$tidakjawab','$hasil')");
        } elseif (empty($_POST['soal_pilganda'])) {
            $jumlah = $_POST['jumlahsoalpilganda'];
            $koneksi->query("INSERT INTO tbl_nilai (ID_TOPIK_QUIZ, ID_SISWA, BENAR, SALAH, TIDAK_DIKERJAKAN,PERSENTASE)
                           VALUES ('$_POST[id_topik]','$_SESSION[ID_SISWA]','0','0','$jumlah','0')");
        }
        //jika ada inputan soal esay
        if (!empty($_POST['soal_esay'])) {
            foreach ($_POST['soal_esay'] as $key2 => $value) {
                $jawaban = $value;
                $cek = $koneksi->query("SELECT * FROM tbl_quiz_essay WHERE ID_ESSAY=$key2");
                while ($data = $cek->fetch_assoc()) {
                    $koneksi->query("INSERT INTO tbl_jawaban(ID_TOPIK_QUIZ,ID_ESSAY,ID_SISWA,JAWABAN)
                                 VALUES('$_POST[id_topik]','$data[ID_ESSAY]','$_SESSION[ID_SISWA]','$jawaban')");
                }
            }
        } elseif (empty($_POST['soal_esay'])) {
            $koneksi->query("INSERT INTO tbl_jawaban(ID_TOPIK_QUIZ,ID_ESSAY,ID_SISWA,JAWABAN)
                                 VALUES('$_POST[id_topik]','$data[ID_ESSAY]','$_SESSION[ID_SISWA]','')");
        }
        header('location:index.php');
    }
    //jika soal hanya esay
    if (empty($pilganda) and !empty($esay)) {
        //jika ada inputan soal esay
        if (!empty($_POST['soal_esay'])) {
            foreach ($_POST['soal_esay'] as $key2 => $value) {
                $jawaban = $value;
                $cek = $koneksi->query("SELECT * FROM tbl_quiz_essay WHERE ID_ESSAY=$key2");
                while ($data = $cek->fetch_assoc()) {
                    $koneksi->query("INSERT INTO tbl_jawaban(ID_TOPIK_QUIZ,ID_ESSAY,ID_SISWA,JAWABAN)
                                 VALUES('$_POST[id_topik]','$data[ID_ESSAY]','$_SESSION[ID_SISWA]','$jawaban')");
                }
            }
        } elseif (empty($_POST['soal_esay'])) {
            $koneksi->query("INSERT INTO tbl_jawaban(ID_TOPIK_QUIZ,ID_ESSAY,ID_SISWA,JAWABAN)
                                 VALUES('$_POST[id_topik]','$data[ID_ESSAY]','$_SESSION[ID_SISWA]','')");
        }
        header('location:index.php');
    }
    //jika soal hanya pilihan ganda
    if (!empty($pilganda) and empty($esay)) {
        //jika ada inputan soal pilganda
        if (!empty($_POST['soal_pilganda'])) {
            $benar = 0;
            $salah = 0;
            foreach ($_POST['soal_pilganda'] as $key => $value) {
                $cek = $koneksi->query("SELECT * FROM tbl_quiz_pilganda WHERE ID_PILGANDA=$key");
                while ($c = $cek->fetch_assoc()) {
                    $jawaban = $c['KUNCI'];
                }
                if ($value == $jawaban) {
                    $benar++;
                } else {
                    $salah++;
                }
            }
            $jumlah = $_POST['jumlahsoalpilganda'];
            $tidakjawab = $jumlah - $benar - $salah;
            $persen = $benar / $jumlah;
            $hasil = $persen * 100;

            $koneksi->query("INSERT INTO tbl_nilai (ID_TOPIK_QUIZ, ID_SISWA, BENAR, SALAH, TIDAK_DIKERJAKAN,PERSENTASE)
                           VALUES ('$_POST[id_topik]','$_SESSION[ID_SISWA]','$benar','$salah','$tidakjawab','$hasil')");
        } elseif (empty($_POST['soal_pilganda'])) {
            $jumlah = $_POST['jumlahsoalpilganda'];
            $koneksi->query("INSERT INTO tbl_nilai (ID_TOPIK_QUIZ, ID_SISWA, BENAR, SALAH, TIDAK_DIKERJAKAN,PERSENTASE)
                           VALUES ('$_POST[id_topik]','$_SESSION[ID_SISWA]','0','0','$jumlah','0')");
        }
        header('location:index.php');
    }
} else {  ?>
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


<!-- SweetAlert Plugin Js -->
<!-- <script src="plugins/sweetalert2/sweetalert2.min.js"></script> -->
<script src="plugins/sweetalert/sweetalert.min.js"></script>