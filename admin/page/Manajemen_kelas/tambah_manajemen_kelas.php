<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah



$Kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
$Wali_kelas = mysqli_real_escape_string($koneksi, $_POST['wali_kelas']);



if (isset($_POST['simpan'])) {
    $database = $koneksi->query("insert into tbl_kelas (KELAS,ID_PENGAJAR,STATUS_KELAS) values('$Kelas','$Wali_kelas','Tidak Aktif')");

    if ($database) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Data Kelas",
                    text: "Berhasil Ditambahkan",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000
                }, function() {
                    window.location.href = "?page=Manajemen_kelas";
                });
            }, 100);
        </script>
<?php

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
                    <h3 class="card-title">Form Tambah Kelas</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kelas</label>
                            <input type="text" class="form-control" name="kelas" required>
                        </div>
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select name="wali_kelas" class="form-control" required>
                                <option value="">-- Pilih Wali Kelas --</option>
                                <?php
                                $database_wali_kelas = $koneksi->query("SELECT * FROM tbl_pengajar ORDER BY NAMA_PENGAJAR") or die(mysqli_error($koneksi));

                                while ($data_wali_kelas = $database_wali_kelas->fetch_assoc()) {

                                    echo '<option value="' . $data_wali_kelas['ID_PENGAJAR'] . '" >' . $data_wali_kelas['NAMA_PENGAJAR'] . '</option>';
                                } ?>
                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                        <input type="button" value="Batal" onclick=self.history.back() class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>