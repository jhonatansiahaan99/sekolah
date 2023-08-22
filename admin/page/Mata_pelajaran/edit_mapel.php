<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah


// file edit untuk mengambil data sesuai id
$ambil_perid = $_GET['id'];

$database1 = $koneksi->query("select * from tbl_mapel where ID_MAPEL = '$ambil_perid' ");
$tampil = $database1->fetch_assoc();

$Id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
$Kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
$Pengajar = mysqli_real_escape_string($koneksi, $_POST['pengajar']);
$Mapel = mysqli_real_escape_string($koneksi, $_POST['mapel']);
$Deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);


if (isset($_POST['simpan'])) {

    $database2 = $koneksi->query("update tbl_mapel set MAPEL='$Mapel',ID_KELAS='$Kelas',ID_PENGAJAR='$Pengajar',DESKRIPSI='$Deskripsi',STATUS_MAPEL='Tidak Aktif' where ID_MAPEL = '$Id_mapel' ");

    if ($database2) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Mata Pelajaran",
                    text: "Berhasil DiUpdate",
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
                    <h3 class="card-title">Form Edit Mata Pelajaran</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mapel</label>
                            <input type="hidden" class="form-control" name="id_mapel" value="<?php echo $tampil['ID_MAPEL']; ?>" required>
                            <input type="text" class="form-control" name="mapel" value="<?php echo $tampil['MAPEL']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control" required>
                                <?php
                                $kode_kelas = $tampil['ID_KELAS'];

                                $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas ") or die(mysqli_error($koneksi));

                                while ($data_kelas = $database_kelas->fetch_assoc()) {
                                    $kode_data_kelas = $data_kelas['ID_KELAS'];

                                    //Data akan terseleksi (selected) jika variabel $kode_kelas sama dengan $kode_data_kelas.

                                    if ($kode_kelas == $kode_data_kelas) {
                                        $cek = "selected";
                                    } else {
                                        $cek = "";
                                    }
                                    // echo "<option value='$kode_data_pengajar' $cek>$kode_data_pengajar</option>";
                                    echo "<option value='$kode_data_kelas' $cek>" . $data_kelas['KELAS'] . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pengajar</label>
                            <select name="pengajar" class="form-control" required>
                                <?php
                                $kode_pengajar = $tampil['ID_PENGAJAR'];

                                $database_pengajar = $koneksi->query("SELECT * FROM tbl_pengajar ") or die(mysqli_error($koneksi));

                                while ($data_pengajar = $database_pengajar->fetch_assoc()) {
                                    $kode_data_pengajar = $data_pengajar['ID_PENGAJAR'];

                                    //Data akan terseleksi (selected) jika variabel $kode_kelas sama dengan $kode_data_kelas.

                                    if ($kode_pengajar == $kode_data_pengajar) {
                                        $cek = "selected";
                                    } else {
                                        $cek = "";
                                    }
                                    // echo "<option value='$kode_data_pengajar' $cek>$kode_data_pengajar</option>";
                                    echo "<option value='$kode_data_pengajar' $cek>" . $data_pengajar['NAMA_PENGAJAR'] . "</option>";
                                } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required><?php echo $tampil['DESKRIPSI']; ?></textarea>
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