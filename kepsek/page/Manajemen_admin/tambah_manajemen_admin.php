<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah



$Username = mysqli_real_escape_string($koneksi, $_POST['username']);
$Password = mysqli_real_escape_string($koneksi, $_POST['password']);
$Nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
$User_level = mysqli_real_escape_string($koneksi, $_POST['user_level']);
$Alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$Telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
$Email = mysqli_real_escape_string($koneksi, $_POST['email']);
$Status_user = mysqli_real_escape_string($koneksi, $_POST['status_user']);





if (isset($_POST['simpan'])) {
    $database = $koneksi->query("select * from tbl_admin where USERNAME = '$Username' ");
    $Cek_user = $database->fetch_assoc();

    if ($Cek_user > 0) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Username Sudah Terdaftar, Coba Lagi!!!",
                    text: "Gagal Di Simpan",
                    type: "error"
                }, function() {
                    window.location.href = "?page=Manajemen_admin&aksi=tambah";
                });
            }, 100);
        </script>
        <?php

    } else {
        $database2 = $koneksi->query("insert into tbl_admin (USERNAME,PASSWORD,NAMA_LENGKAP,USER_LEVEL,ALAMAT,TELP,EMAIL,STATUS_USER) values('$Username','$Password','$Nama','$User_level','$Alamat','$Telp','$Email','$Status_user')");

        if ($database2) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Data Admin",
                        text: "Berhasil Ditambahkan",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }, function() {
                        window.location.href = "?page=Manajemen_admin";
                    });
                }, 100);
            </script>
<?php

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
                    <h3 class="card-title">Form Tambah Admin</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama </label>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username </label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" placeholder="Masukkan e-mail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Telp </label>
                            <input type="number" class="form-control" name="telp" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Status Pengguna</label>
                            <div class="form-check">
                                <input name="status_user" class="form-check-input" type="radio" name="radio1" value="Aktif" checked>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input name="status_user" class="form-check-input" type="radio" name="radio1" value="Tidak Aktif">
                                <label class="form-check-label">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" value="ADMIN" class="form-control email" name="user_level">

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                        <input type="button" value="Batal" onclick=self.history.back() class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>