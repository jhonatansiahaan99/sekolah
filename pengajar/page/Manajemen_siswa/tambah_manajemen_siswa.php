<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah


$Nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
$Nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
$Username = mysqli_real_escape_string($koneksi, $_POST['username_siswa']);
$Password = mysqli_real_escape_string($koneksi, $_POST['password_login']);
$Kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
$Alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$Tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
$Tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
$Jenkel = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
$Agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
$Nama_ayah = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
$Nama_ibu = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
$Thn_masuk = mysqli_real_escape_string($koneksi, $_POST['thn_masuk']);
$Email = mysqli_real_escape_string($koneksi, $_POST['email']);
$Telp_ortu = mysqli_real_escape_string($koneksi, $_POST['telp_ortu']);
$Telp_siswa = mysqli_real_escape_string($koneksi, $_POST['telp_siswa']);

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


$Status_pengguna = mysqli_real_escape_string($koneksi, $_POST['status_pengguna']);
$User_level = mysqli_real_escape_string($koneksi, $_POST['user_level']);




if (isset($_POST['simpan'])) {
    $database = $koneksi->query("select * from tbl_siswa where USERNAME = '$Username' ");
    $Cek_user = $database->fetch_assoc();

    if ($Cek_user > 0) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Username Sudah Terdaftar, Coba Lagi!!!",
                    text: "Gagal Di Simpan",
                    type: "error"
                }, function() {
                    window.location.href = "?page=Manajemen_siswa&aksi=tambah";
                });
            }, 100);
        </script>
        <?php

    } elseif (empty($Asal_foto)) {
        $database2 = $koneksi->query("insert into tbl_siswa (NIS,NAMA_SISWA,USERNAME,PASSWORD,ID_KELAS,ALAMAT,TEMPAT_LAHIR,TGL_LAHIR,JENKEL,AGAMA,NAMA_AYAH,NAMA_IBU,THN_MASUK,EMAIL,TELP_ORTU,TELP_SISWA,STATUS_PENGGUNA,USER_LEVEL) values('$Nis','$Nama_siswa','$Username','$Password','$Kelas','$Alamat','$Tempat_lahir','$Tgl_lahir','$Jenkel','$Agama','$Nama_ayah','$Nama_ibu','$Thn_masuk','$Email','$Telp_ortu','$Telp_siswa','$Status_pengguna','$User_level')");

        if ($database2) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Data Siswa",
                        text: "Berhasil Ditambahkan",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }, function() {
                        window.location.href = "?page=Manajemen_siswa";
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
                    window.location.href = "?page=Manajemen_siswa&aksi=tambah";
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
                    window.location.href = "?page=Manajemen_siswa&aksi=tambah";
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
                    window.location.href = "?page=Manajemen_siswa&aksi=tambah";
                });
            }, 100);
        </script>
        <?php } else {
        if (!empty($Asal_foto)) {

            $penyimpanan = move_uploaded_file($Asal_foto, "../images/" . $Foto_baru);


            $database2 = $koneksi->query("insert into tbl_siswa (NIS,NAMA_SISWA,USERNAME,PASSWORD,ID_KELAS,ALAMAT,TEMPAT_LAHIR,TGL_LAHIR,JENKEL,AGAMA,NAMA_AYAH,NAMA_IBU,THN_MASUK,EMAIL,TELP_ORTU,TELP_SISWA,FOTO,STATUS_PENGGUNA,USER_LEVEL) values('$Nis','$Nama_siswa','$Username','$Password','$Kelas','$Alamat','$Tempat_lahir','$Tgl_lahir','$Jenkel','$Agama','$Nama_ayah','$Nama_ibu','$Thn_masuk','$Email','$Telp_ortu','$Telp_siswa','$Foto_baru','$Status_pengguna','$User_level')");

            if ($database2) { ?>

                <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                            title: "Data Siswa",
                            text: "Berhasil Ditambahkan",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }, function() {
                            window.location.href = "?page=Manajemen_siswa";
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
                    <h3 class="card-title">Form Tambah Siswa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nis</label>
                            <input type="number" name="nis" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama_siswa" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username Siswa Login</label>
                            <input type="text" class="form-control" name="username_siswa" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password Login</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password_login" required>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control" required>
                                <option value="">-- Pilih Kelas --</option>
                                <?php
                                $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas ORDER BY ID_KELAS") or die(mysqli_error($koneksi));

                                while ($data_kelas = $database_kelas->fetch_assoc()) {

                                    echo '<option value="' . $data_kelas['ID_KELAS'] . '" >' . $data_kelas['KELAS'] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" required>
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
                            <label for="exampleInputEmail1">Nama Ayah/Wali</label>
                            <input type="text" class="form-control" name="nama_ayah" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tahun Masuk</label>
                            <input type="number" name="thn_masuk" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" placeholder="Masukkan e-mail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Telp Orang Tua</label>
                            <input type="number" class="form-control" name="telp_ortu" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Telp Siswa</label>
                            <input type="number" class="form-control" name="telp_siswa" required>
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
                            <label for="exampleInputFile">Status Pengguna</label>
                            <div class="form-check">
                                <input name="status_pengguna" class="form-check-input" type="radio" name="radio1" value="Aktif" checked>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input name="status_pengguna" class="form-check-input" type="radio" name="radio1" value="Tidak Aktif">
                                <label class="form-check-label">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" value="SISWA" class="form-control email" name="user_level">

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                        <input type="button" value="Batal" onclick=self.history.back() class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>