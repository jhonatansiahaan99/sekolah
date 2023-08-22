<?php
session_start();

$database1 = $koneksi->query("SELECT * FROM tbl_admin where USERNAME = '$_SESSION[KEPSEK]' ");


$tampil1 = $database1->fetch_assoc();




$Nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$Username = $_SESSION['KEPSEK'];
$Password = mysqli_real_escape_string($koneksi, $_POST['password']);
$Alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$Email = mysqli_real_escape_string($koneksi, $_POST['email']);
$Telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
$Status = mysqli_real_escape_string($koneksi, $_POST['status']);

if (isset($_POST['simpan'])) {
    $database2 = $koneksi->query("update tbl_admin set USERNAME='$Username',PASSWORD='$Password',NAMA_LENGKAP='$Nama',USER_LEVEL='KEPSEK',ALAMAT='$Alamat',TELP='$Telp',EMAIL='$Email',STATUS_USER='$Status' where USERNAME='$_SESSION[KEPSEK]' ");

    if ($database2) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Data Kepala Sekolah",
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
                                            <input type="password" name="password" class="form-control" id="inputName" value="<?php echo $tampil1['PASSWORD']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama" id="inputName" value="<?php echo $tampil1['NAMA_LENGKAP']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Alamat </label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" class="form-control" rows="3" required><?php echo $tampil1['ALAMAT']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Telp </label>
                                        <div class="col-sm-10">
                                            <input type="number" name="telp" class="form-control" id="inputName" value="<?php echo $tampil1['TELP']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">E-mail </label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" placeholder="Masukkan e-mail" name="email" value="<?php echo $tampil1['EMAIL']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Status Pengguna</label>
                                        <div class="col-sm-10">
                                            <input type="status" class="form-control" name="status" id="inputName" value="<?php echo $tampil1['STATUS_USER']; ?>" style="background-color:#e7e3e9;" readonly>
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