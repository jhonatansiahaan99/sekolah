<?php


$ambil_perid = $_GET['id'];
$database1 = $koneksi->query("select * from tbl_siswa where ID_SISWA = '$ambil_perid' ");
$tampil1 = $database1->fetch_assoc();

$database_kelas = $koneksi->query("select * from tbl_kelas where ID_KELAS = '$tampil1[ID_KELAS]' ");
$tampil_kelas = $database_kelas->fetch_assoc();


//ngambil data foto
$Foto_unlink = $tampil['FOTO'];



$Id_siswa = mysqli_real_escape_string($koneksi, $_POST['id_siswa']);
$Nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
$Nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
$Username = mysqli_real_escape_string($koneksi, $_POST['username_siswa']);


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
        $database2 = $koneksi->query("update tbl_siswa set NIS='$Nis',NAMA_SISWA='$Nama_siswa',USERNAME='$Username',ALAMAT='$Alamat',TEMPAT_LAHIR='$Tempat_lahir',TGL_LAHIR='$Tgl_lahir',JENKEL='$Jenkel',AGAMA='$Agama',NAMA_AYAH='$Nama_ayah',NAMA_IBU='$Nama_ibu',THN_MASUK='$Thn_masuk',EMAIL='$Email',TELP_ORTU='$Telp_ortu',TELP_SISWA='$Telp_siswa',STATUS_PENGGUNA='$Status_pengguna',USER_LEVEL='$User_level' where ID_SISWA='$Id_siswa' ");

        if ($database2) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Data User",
                        text: "Berhasil DiUbah",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }, function() {
                        window.location.href = "?page=Profil_user";
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

                    window.location.href = "?page=Profil_user";
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
                    window.location.href = "?page=Profil_user&aksi=edit&id=<?php echo ($_GET['id']) ?>";
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
                    window.location.href = "?page=Profil_user&aksi=edit&id=<?php echo ($_GET['id']) ?>";
                });
            }, 100);
        </script>
        <?php } else {
        if (!empty($Asal_foto)) {

            if (file_exists("../images/$Foto_unlink")) {
                unlink("../images/$Foto_unlink");
            }

            $penyimpanan = move_uploaded_file($Asal_foto, "../images/" . $Foto_baru);


            $database2 = $koneksi->query("update tbl_siswa set NIS='$Nis',NAMA_SISWA='$Nama_siswa',USERNAME='$Username',PASSWORD='$Password',ID_KELAS='$Kelas',ALAMAT='$Alamat',TEMPAT_LAHIR='$Tempat_lahir',TGL_LAHIR='$Tgl_lahir',JENKEL='$Jenkel',AGAMA='$Agama',NAMA_AYAH='$Nama_ayah',NAMA_IBU='$Nama_ibu',THN_MASUK='$Thn_masuk',EMAIL='$Email',TELP_ORTU='$Telp_ortu',TELP_SISWA='$Telp_siswa',FOTO='$Foto_baru',STATUS_PENGGUNA='$Status_pengguna',USER_LEVEL='$User_level' where ID_SISWA='$Id_siswa' ");

            if ($database2) { ?>

                <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                            title: "Data User",
                            text: "Berhasil DiUbah",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }, function() {
                            window.location.href = "?page=Profil_user";
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
                                        <label for="inputName" class="col-sm-2 col-form-label">NIS</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nis" id="inputName" value="<?php echo $tampil1['NIS']; ?>" style="background-color:#e7e3e9;" readonly>
                                            <input type="hidden" value="SISWA" class="form-control email" name="user_level">
                                            <input type="hidden" value="<?php echo $tampil1['ID_SISWA']; ?>" class="form-control email" name="id_siswa">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="username_siswa" id="inputName" value="<?php echo $tampil1['USERNAME']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" id="inputName" value="<?php echo $tampil1['PASSWORD']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_siswa" id="inputName" value="<?php echo $tampil1['NAMA_SISWA']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Kelas</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="kelas" id="inputName" value="<?php echo $tampil_kelas['KELAS']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Alamat </label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" class="form-control" rows="3" required><?php echo $tampil1['ALAMAT']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Tempat Lahir </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="tempat_lahir" class="form-control" id="inputName" value="<?php echo $tampil1['TEMPAT_LAHIR']; ?>">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="tgl_lahir" class="form-control" id="inputName" value="<?php echo $tampil1['TGL_LAHIR']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="jenkel" class="form-control" id="inputName" value="<?php echo $tampil1['JENKEL']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Agama</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="agama" class="form-control" id="inputName" value="<?php echo $tampil1['AGAMA']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nama Ayah/Wali</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_ayah" value="<?php echo $tampil1['NAMA_AYAH']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nama Ibu</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_ibu" value="<?php echo $tampil1['NAMA_IBU']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Tahun Masuk</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="thn_masuk" required value="<?php echo $tampil1['THN_MASUK']; ?>" class="form-control" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">E-mail </label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" placeholder="Masukkan e-mail" name="email" value="<?php echo $tampil1['EMAIL']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">No. Telp Orang Tua </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="telp_ortu" value="<?php echo $tampil1['TELP_ORTU']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">No. Telp Siswa </label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="telp_siswa" value="<?php echo $tampil1['TELP_SISWA']; ?>" required>
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

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Status Pengguna</label>
                                        <div class="col-sm-10">
                                            <input type="status" class="form-control" name="status_pengguna" id="inputName" value="<?php echo $tampil1['STATUS_PENGGUNA']; ?>" style="background-color:#e7e3e9;" readonly>
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