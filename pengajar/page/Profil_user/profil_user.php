<?php
session_start();

$database1 = $koneksi->query("SELECT * FROM tbl_pengajar where USERNAME = '$_SESSION[PENGAJAR]' ");


$tampil1 = $database1->fetch_assoc();



$Nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
$Nama_pengajar = mysqli_real_escape_string($koneksi, $_POST['nama_pengajar']);
$Username = $_SESSION['PENGAJAR'];
$Password_pengajar = mysqli_real_escape_string($koneksi, $_POST['password_pengajar']);
$Alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$Tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
$Tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
$Jenkel = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
$Agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
$Telp_pengajar = mysqli_real_escape_string($koneksi, $_POST['telp_pengajar']);
$Email = mysqli_real_escape_string($koneksi, $_POST['email']);
$Pembawa_mapel = mysqli_real_escape_string($koneksi, $_POST['pembawa_mapel']);
$Status_pengajar = mysqli_real_escape_string($koneksi, $_POST['status_pengajar']);


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


if (isset($_POST['simpan'])) {
    if (empty($Asal_foto)) { //jika foto tidak di upload
        $database2 = $koneksi->query("update tbl_pengajar set NIP_PENGAJAR='$Nip',USERNAME='$Username',NAMA_PENGAJAR='$Nama_pengajar',PASSWORD='$Password_pengajar',ALAMAT='$Alamat',TEMPAT_LAHIR='$Tempat_lahir',TGL_LAHIR='$Tgl_lahir',JENKEL='$Jenkel',AGAMA='$Agama',TELP_PENGAJAR='$Telp_pengajar',EMAIL='$Email',USER_LEVEL='PENGAJAR',STATUS_PENGAJAR='$Status_pengajar' where USERNAME = '$_SESSION[PENGAJAR]' ");

        if ($database2) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Data Pengajar",
                        text: "Berhasil DiUbah",
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
                    window.location.href = "index.php";
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
                    window.location.href = "index.php";
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
                    window.location.href = "index.php";
                });
            }, 100);
        </script>
        <?php } else {
        if (!empty($Asal_foto)) {

            if (file_exists("../images/$Foto_unlink")) {
                unlink("../images/$Foto_unlink");
            }

            $penyimpanan = move_uploaded_file($Asal_foto, "../images/" . $Foto_baru);

            $database2 = $koneksi->query("update tbl_pengajar set NIP_PENGAJAR='$Nip',USERNAME='$Username',NAMA_PENGAJAR='$Nama_pengajar',PASSWORD='$Password_pengajar',ALAMAT='$Alamat',TEMPAT_LAHIR='$Tempat_lahir',TGL_LAHIR='$Tgl_lahir',JENKEL='$Jenkel',AGAMA='$Agama',TELP_PENGAJAR='$Telp_pengajar',EMAIL='$Email',FOTO='$Foto_baru',USER_LEVEL='PENGAJAR',STATUS_PENGAJAR='$Status_pengajar' where USERNAME = '$_SESSION[PENGAJAR]' ");

            if ($database2) { ?>

                <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                            title: "Data Pengajar",
                            text: "Berhasil DiUbah",
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
    }
}
?>

<div class="container-fluid">
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail Profil</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <form method="POST" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="username" id="inputName" value="<?php echo $tampil1['USERNAME']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password_pengajar" class="form-control" id="inputName" value="<?php echo $tampil1['PASSWORD']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nip </label>
                                        <div class="col-sm-10">
                                            <input type="number" name="nip" class="form-control" id="inputName" value="<?php echo $tampil1['NIP_PENGAJAR']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nama Pengajar</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_pengajar" id="inputName" value="<?php echo $tampil1['NAMA_PENGAJAR']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Alamat </label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" class="form-control" rows="3" required><?php echo $tampil1['ALAMAT']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tempat_lahir" id="inputName" value="<?php echo $tampil1['TEMPAT_LAHIR']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="tgl_lahir" id="inputName" value="<?php echo $tampil1['TGL_LAHIR']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <select name="jenkel" class="form-control" required>
                                                <option value="Laki-Laki" <?php if ($tampil1['JENKEL'] == 'Laki-Laki') { ?> selected="selected" <?php } ?>>Laki-Laki</option>
                                                <option value="Perempuan" <?php if ($tampil1['JENKEL'] == 'Perempuan') { ?> selected="selected" <?php } ?>>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Agama</label>
                                        <div class="col-sm-10">
                                            <select name="agama" class="form-control" required>
                                                <option value="KRISTEN PROTESTAN" <?php if ($tampil1['AGAMA'] == 'KRISTEN PROTESTAN') { ?> selected="selected" <?php } ?>>KRISTEN PROTESTAN</option>
                                                <option value="KATOLIK" <?php if ($tampil1['AGAMA'] == 'KATOLIK') { ?> selected="selected" <?php } ?>>KATOLIK</option>
                                                <option value="ISLAM" <?php if ($tampil1['AGAMA'] == 'ISLAM') { ?> selected="selected" <?php } ?>>ISLAM</option>
                                                <option value="HINDU" <?php if ($tampil1['AGAMA'] == 'HINDU') { ?> selected="selected" <?php } ?>>HINDU</option>
                                                <option value="BUDDHA" <?php if ($tampil1['AGAMA'] == 'BUDDHA') { ?> selected="selected" <?php } ?>>BUDDHA</option>
                                                <option value="TIONGHOA" <?php if ($tampil1['AGAMA'] == 'TIONGHOA') { ?> selected="selected" <?php } ?>>TIONGHOA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">No. Hp </label>
                                        <div class="col-sm-10">
                                            <input type="number" name="telp_pengajar" class="form-control" id="inputName" value="<?php echo $tampil1['TELP_PENGAJAR']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">E-mail </label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" placeholder="Masukkan e-mail" name="email" value="<?php echo $tampil1['EMAIL']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-sm-10">
                                            <?php
                                            if (empty($tampil1['FOTO'])) {
                                                echo "FOTO KOSONG";
                                            } else {

                                                echo "<td><img width='150px' height='100px'  src='../images/" . $tampil1['FOTO'] . "' /></td>";

                                            ?>

                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Ubah Foto</label>
                                        <div class="col-sm-10">
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
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Status Pengajar</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="status_pengajar" id="inputName" value="<?php echo $tampil1['STATUS_PENGAJAR']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <td>
                                        <input type="submit" name="simpan" value="Ubah" class="btn btn-success">
                                    </td>

                                </form>
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->