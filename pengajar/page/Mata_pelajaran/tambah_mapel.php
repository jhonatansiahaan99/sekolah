<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah


$Mapel = mysqli_real_escape_string($koneksi, $_POST['mapel']);
$Pengajar = mysqli_real_escape_string($koneksi, $_POST['pengajar']);
$Kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
$Deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);



if (isset($_POST['simpan'])) {

    $database = $koneksi->query("insert into tbl_mapel (MAPEL,ID_KELAS,NIP_PENGAJAR,DESKRIPSI) values('$Mapel','$Kelas','$Pengajar','$Deskripsi')");

    if ($database) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Mata Pelajaran",
                    text: "Berhasil Ditambahkan",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000
                }, function() {
                    window.location.href = "?page=Mata_pelajaran";
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
                    <h3 class="card-title">Form Tambah Mata Pelajaran</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mapel</label>
                            <input type="text" class="form-control" name="mapel" required>
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
                            <label>Pengajar</label>
                            <select name="pengajar" class="form-control" required>
                                <option value="">-- Pilih Pengajar --</option>
                                <?php
                                $database_pengajar = $koneksi->query("SELECT * FROM tbl_pengajar ORDER BY NAMA_PENGAJAR") or die(mysqli_error($koneksi));

                                while ($data_pengajar = $database_pengajar->fetch_assoc()) {

                                    echo '<option value="' . $data_pengajar['NIP_PENGAJAR'] . '" >' . $data_pengajar['NAMA_PENGAJAR'] . '</option>';
                                } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
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