<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah

$Nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
$Nama_pengajar = mysqli_real_escape_string($koneksi, $_POST['nama_pengajar']);
$Username_pengajar = mysqli_real_escape_string($koneksi, $_POST['username_pengajar']);
$Password_pengajar = mysqli_real_escape_string($koneksi, $_POST['password_pengajar']);
$Alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$Tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
$Tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
$Jenkel = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
$Agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
$Telp_pengajar = mysqli_real_escape_string($koneksi, $_POST['telp_pengajar']);
$Email = mysqli_real_escape_string($koneksi, $_POST['email']);

//proses upload
$Nama_foto = $_FILES['foto']['name']; //nama file yang di awal
$Asal_foto = $_FILES['foto']['tmp_name']; //asal penyimpanan di folder tapi tidak masuk database atau penyimpanan sementara sebelum di masukkan ke database
$Titikarray = explode(".", $Nama_foto);
$Extensi = $Titikarray[count($Titikarray) - 1];
$Validtype = array('JPG', 'jpg', "jpeg", "JPEG", "PNG", "png"); //format file yang di ijinkan 
$Type = $_FILES['foto']['type']; //type file //sudah ketentuan type file harus ada
$Ukuran = $_FILES['foto']['size']; //ukuran
$Error = $_FILES['foto']['error']; //menapilkan eror
// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$Foto_baru = date('dmYHis') .  $Nama_foto;


$Status_pengajar = mysqli_real_escape_string($koneksi, $_POST['status_pengajar']);
$User_level = mysqli_real_escape_string($koneksi, $_POST['user_level']);


if (isset($_POST['simpan'])) {
    $database = $koneksi->query("select * from tbl_pengajar where USERNAME = '$Username_pengajar' ");
    $Cek_user = $database->fetch_assoc();

    if ($Cek_user > 0) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Username Sudah Terdaftar, Coba Lagi!!!",
                    text: "Gagal Di Simpan",
                    type: "error"
                }, function() {
                    window.location.href = "?page=Manajemen_pengajar&aksi=tambah";
                });
            }, 100);
        </script>
        <?php

    } elseif (empty($Asal_foto)) { //jika foto tidak di upload
        $database = $koneksi->query("insert into tbl_pengajar (ID_PENGAJAR,NIP_PENGAJAR,USERNAME,NAMA_PENGAJAR,PASSWORD,ALAMAT,TEMPAT_LAHIR,TGL_LAHIR,JENKEL,AGAMA,TELP_PENGAJAR,EMAIL,USER_LEVEL,STATUS_PENGAJAR) values('','$Nip','$Username_pengajar','$Nama_pengajar','$Password_pengajar','$Alamat','$Tempat_lahir','$Tgl_lahir','$Jenkel','$Agama','$Telp_pengajar','$Email','$User_level','$Status_pengajar')");

        if ($database) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Data Pengajar",
                        text: "Berhasil Ditambahkan",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }, function() {
                        window.location.href = "?page=Manajemen_pengajar";
                    });
                }, 100);
            </script>
        <?php

        }
    } elseif (!in_array($Extensi, $Validtype)) {
        //validasi type file dan ukuran
        ?>
        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Type file yang anda upload tidak sesuai",
                    text: "Gagal Di Simpan",
                    type: "error"
                }, function() {
                    window.location.href = "?page=Manajemen_pengajar&aksi=tambah";
                });
            }, 100);
        </script>
    <?php } elseif ($Ukuran > 2000000) { ?>
        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Ukuran Terlalu Besar Dari 2MB",
                    text: "Gagal Di Simpan",
                    type: "error"
                }, function() {
                    window.location.href = "?page=Manajemen_pengajar&aksi=tambah";
                });
            }, 100);
        </script>

    <?php } elseif ($Error > 0) { ?>
        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Foto Error",
                    text: "Gagal Di Simpan",
                    type: "error"
                }, function() {
                    window.location.href = "?page=Manajemen_pengajar&aksi=tambah";
                });
            }, 100);
        </script>
        <?php } else {
        if (!empty($Asal_foto)) {

            $penyimpanan = move_uploaded_file($Asal_foto, "../images/" . $Foto_baru);

            $database = $koneksi->query("insert into tbl_pengajar (ID_PENGAJAR,NIP_PENGAJAR,USERNAME,NAMA_PENGAJAR,PASSWORD,ALAMAT,TEMPAT_LAHIR,TGL_LAHIR,JENKEL,AGAMA,TELP_PENGAJAR,EMAIL,FOTO,USER_LEVEL,STATUS_PENGAJAR) values('','$Nip','$Username_pengajar','$Nama_pengajar','$Password_pengajar','$Alamat','$Tempat_lahir','$Tgl_lahir','$Jenkel','$Agama','$Telp_pengajar','$Email','$Foto_baru','$User_level','$Status_pengajar')");

            if ($database) { ?>

                <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                            title: "Data Pengajar",
                            text: "Berhasil Ditambahkan",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }, function() {
                            window.location.href = "?page=Manajemen_pengajar";
                        });
                    }, 100);
                </script>
<?php

            }
        }
    }
}
?>


<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Pengajar</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nip</label>
                            <input type="number" name="nip" required class="form-control" placeholder="Angka nip pengajar">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Pengajar</label>
                            <input type="text" class="form-control" name="nama_pengajar" required placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username Pengajar Login</label>
                            <input type="text" class="form-control" placeholder="Username" name="username_pengajar" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password Login</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password_pengajar" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <input type="text" class="form-control" placeholder="Tempat lahir" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" placeholder="Tanggal lahir" name="tgl_lahir" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenkel" class="form-control" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control" required>
                                <option value="">-- Pilih Agama --</option>
                                <option value="KRISTEN PROTESTAN">KRISTEN PROTESTAN</option>
                                <option value="KATOLIK">KATOLIK</option>
                                <option value="ISLAM">ISLAM</option>
                                <option value="HINDU">HINDU</option>
                                <option value="BUDDHA">BUDDHA</option>
                                <option value="TIONGHOA">TIONGHOA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Hp</label>
                            <input type="number" class="form-control" placeholder="No. Hp" name="telp_pengajar" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" placeholder="Masukkan e-mail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <span style="color:#F44336 ">*Tipe file JPG/JPEG dan Size maks : 2MB</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Status Pengajar</label>
                            <div class="form-check">
                                <input name="status_pengajar" class="form-check-input" type="radio" name="radio1" value="Aktif" checked>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input name="status_pengajar" class="form-check-input" type="radio" name="radio1" value="Tidak Aktif">
                                <label class="form-check-label">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" value="PENGAJAR" class="form-control email" name="user_level">

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                        <input type="button" value="Batal" onclick=self.history.back() class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>