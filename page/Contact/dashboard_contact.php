<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah

$koneksi = mysqli_connect("localhost", "root", "amerika1999", "db_e-learning") or die("KONEKSI GAGAL TERHUBUNG");


$Nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$Telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
$Email = mysqli_real_escape_string($koneksi, $_POST['email']);
$Subject = mysqli_real_escape_string($koneksi, $_POST['subject']);
$Pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

$Tgl_kirim = date('Y-m-d');

if (isset($_POST['kirim_pesan'])) {
    $database = $koneksi->query("insert into tbl_pesan (ID_PESAN,NAMA,TELP,EMAIL,SUBJECT,PESAN,TGL_KIRIM) values('','$Nama','$Telp','$Email','$Subject','$Pesan','$Tgl_kirim')");

    if ($database) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Pesan",
                    text: "Berhasil Kirim",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000
                }, function() {
                    window.location.href = "index.php";
                });
            }, 100);
        </script>
<?php

    }
}
?>
<!-- Sweetalert Css -->
<!-- <link href="plugins/sweetalert2/sweetalert2.css" rel="stylesheet" /> -->
<link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
<!-- SweetAlert Plugin Js -->
<!-- <script src="plugins/sweetalert2/sweetalert2.min.js"></script> -->
<script src="plugins/sweetalert/sweetalert.min.js"></script>


<div class="container">

    <div class="row pt-4 mb-4">
        <div class="col text-center">
            <h1>Contact Us</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card text-white bg-primary mb-3 ">
                <div class="card-body">
                    <h5 class="card-title text-center">Contact </h5>
                    <p class="card-text">+62 813-7516-2345</p>
                </div>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    <h2>Lokasi</h2>
                </li>
                <li class="list-group-item">Alamat Sekolah</li>
                <li class="list-group-item">JL. LETJEND. JAMIN GINTING KM.8 KWALA BEKALA P.BULAN MEDAN</li>
                <li class="list-group-item">Sumatera Utara, Indonesia</li>
                <li class="list-group-item">Kode Pos : 20131</li>
            </ul>
        </div>
        <div class="col-lg-6 pb-5">
            <form method="POST">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="nama" id="nama" class="form-control" id="exampleInputPassword1" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="Telepon">Phone Number</label>
                    <input type="text" name="telp" id="telp" class="form-control" id="exampleInputPassword1" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label for="e-mail">E-Mail</label>
                    <input type="email" name="email" id="email" class="form-control" id="exampleInputPassword1" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <label for="Subject">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control" id="exampleInputPassword1" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="pesan" id="pesan" class="form-control" rows="5"></textarea>
                </div>
                <input type="submit" name="kirim_pesan" value="Kirim Pesan" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>