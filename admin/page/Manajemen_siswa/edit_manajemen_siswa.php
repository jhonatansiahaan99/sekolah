<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah


// file edit untuk mengambil data sesuai id
$ambil_perid = $_GET['id'];
$database1 = $koneksi->query("select * from tbl_siswa where NIS = '$ambil_perid' ");
$tampil = $database1->fetch_assoc();


//ngambil data foto
$Foto_unlink = $tampil['FOTO'];



$Id_siswa = mysqli_real_escape_string($koneksi, $_POST['id_siswa']);
$Nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
$Nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
$Username = mysqli_real_escape_string($koneksi, $_POST['username_siswa']);
$Password = mysqli_real_escape_string($koneksi, $_POST['password_login']);

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
    if (empty($Asal_foto)) { //jika foto tidak di upload
        $database2 = $koneksi->query("update tbl_siswa set NIS='$Nis',NAMA_SISWA='$Nama_siswa',USERNAME='$Username',PASSWORD='$Password',ALAMAT='$Alamat',TEMPAT_LAHIR='$Tempat_lahir',TGL_LAHIR='$Tgl_lahir',JENKEL='$Jenkel',AGAMA='$Agama',NAMA_AYAH='$Nama_ayah',NAMA_IBU='$Nama_ibu',THN_MASUK='$Thn_masuk',EMAIL='$Email',TELP_ORTU='$Telp_ortu',TELP_SISWA='$Telp_siswa',STATUS_PENGGUNA='$Status_pengguna',USER_LEVEL='$User_level' where ID_SISWA='$Id_siswa' ");

        if ($database2) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Data Siswa",
                        text: "Berhasil DiUbah",
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
                    window.location.href = "?page=Manajemen_siswa&aksi=edit&id=<?php echo ($_GET['id']) ?>";
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
                    window.location.href = "?page=Manajemen_siswa&aksi=edit&id=<?php echo ($_GET['id']) ?>";
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
                    window.location.href = "?page=Manajemen_siswa&aksi=edit&id=<?php echo ($_GET['id']) ?>";
                });
            }, 100);
        </script>
        <?php } else {
        if (!empty($Asal_foto)) {

            if (file_exists("../images/$Foto_unlink")) {
                unlink("../images/$Foto_unlink");
            }

            $penyimpanan = move_uploaded_file($Asal_foto, "../images/" . $Foto_baru);


            $database2 = $koneksi->query("update tbl_siswa set NIS='$Nis',NAMA_SISWA='$Nama_siswa',USERNAME='$Username',PASSWORD='$Password',ALAMAT='$Alamat',TEMPAT_LAHIR='$Tempat_lahir',TGL_LAHIR='$Tgl_lahir',JENKEL='$Jenkel',AGAMA='$Agama',NAMA_AYAH='$Nama_ayah',NAMA_IBU='$Nama_ibu',THN_MASUK='$Thn_masuk',EMAIL='$Email',TELP_ORTU='$Telp_ortu',TELP_SISWA='$Telp_siswa',FOTO='$Foto_baru',STATUS_PENGGUNA='$Status_pengguna',USER_LEVEL='$User_level' where ID_SISWA='$Id_siswa' ");

            if ($database2) { ?>

                <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                            title: "Data Siswa",
                            text: "Berhasil DiUbah",
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
                    <h3 class="card-title">Form Edit Siswa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nis</label>
                            <input type="number" name="nis" value="<?php echo $tampil['NIS']; ?>" required class="form-control">
                            <input type="hidden" name="id_siswa" value="<?php echo $tampil['ID_SISWA']; ?>" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama_siswa" value="<?php echo $tampil['NAMA_SISWA']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username Siswa Login</label>
                            <input type="text" class="form-control" name="username_siswa" value="<?php echo $tampil['USERNAME']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password Login</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password_login" value="<?php echo $tampil['PASSWORD']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required><?php echo $tampil['ALAMAT']; ?> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $tampil['TEMPAT_LAHIR']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $tampil['TGL_LAHIR']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenkel" class="form-control" required>
                                <option value="Laki-Laki" <?php if ($tampil['JENKEL'] == 'Laki-Laki') { ?> selected="selected" <?php } ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if ($tampil['JENKEL'] == 'Perempuan') { ?> selected="selected" <?php } ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control" required>
                                <option value="KRISTEN PROTESTAN" <?php if ($tampil['AGAMA'] == 'KRISTEN PROTESTAN') { ?> selected="selected" <?php } ?>>KRISTEN PROTESTAN</option>
                                <option value="KATOLIK" <?php if ($tampil['AGAMA'] == 'KATOLIK') { ?> selected="selected" <?php } ?>>KATOLIK</option>
                                <option value="ISLAM" <?php if ($tampil['AGAMA'] == 'ISLAM') { ?> selected="selected" <?php } ?>>ISLAM</option>
                                <option value="HINDU" <?php if ($tampil['AGAMA'] == 'HINDU') { ?> selected="selected" <?php } ?>>HINDU</option>
                                <option value="BUDDHA" <?php if ($tampil['AGAMA'] == 'BUDDHA') { ?> selected="selected" <?php } ?>>BUDDHA</option>
                                <option value="TIONGHOA" <?php if ($tampil['AGAMA'] == 'TIONGHOA') { ?> selected="selected" <?php } ?>>TIONGHOA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ayah/Wali</label>
                            <input type="text" class="form-control" name="nama_ayah" value="<?php echo $tampil['NAMA_AYAH']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" value="<?php echo $tampil['NAMA_IBU']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tahun Masuk</label>
                            <input type="number" name="thn_masuk" required value="<?php echo $tampil['THN_MASUK']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" placeholder="Masukkan e-mail" name="email" value="<?php echo $tampil['EMAIL']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Telp Orang Tua</label>
                            <input type="number" class="form-control" name="telp_ortu" value="<?php echo $tampil['TELP_ORTU']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Telp Siswa</label>
                            <input type="number" class="form-control" name="telp_siswa" value="<?php echo $tampil['TELP_SISWA']; ?>" required>
                        </div>
                        <label for="">Foto </label>
                        <div class="form-group">
                            <div class="form-line">
                                <?php
                                if (empty($tampil['FOTO'])) {
                                    echo "FOTO KOSONG";
                                } else {

                                    echo "<td><img width='150px' height='100px'  src='../images/" . $tampil['FOTO'] . "' /></td>";

                                ?>

                                <?php }
                                ?>


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ubah Foto</label>
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
                                <input name="status_pengguna" class="form-check-input" type="radio" name="radio1" value="Aktif" <?php if ($tampil['STATUS_PENGGUNA'] == 'Aktif') echo 'checked' ?>>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input name="status_pengguna" class="form-check-input" type="radio" name="radio1" value="Tidak Aktif" <?php if ($tampil['STATUS_PENGGUNA'] == 'Tidak Aktif') echo 'checked' ?>>
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