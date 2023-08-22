<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah



// file edit untuk mengambil data sesuai id
$ambil_perid = $_GET['id'];

$database1 = $koneksi->query("select * from tbl_kelas where ID_KELAS = '$ambil_perid' ");
$tampil = $database1->fetch_assoc();


$Id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
$Kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);

$Wali_kelas = mysqli_real_escape_string($koneksi, $_POST['wali_kelas']);
$Nis = mysqli_real_escape_string($koneksi, $_POST['status_pengajar']);


if (isset($_POST['simpan'])) {

    $database2 = $koneksi->query("update tbl_kelas set KELAS='$Kelas',NIP_PENGAJAR='$Wali_kelas' where ID_KELAS = '$Id_kelas' ");

    if ($database2) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Data Kelas",
                    text: "Berhasil DiUpdate",
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
                    <h3 class="card-title">Form Edit Kelas</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kelas</label>
                            <input type="hidden" class="form-control" name="id_kelas" value="<?php echo $tampil['ID_KELAS']; ?>" required>
                            <input type="text" class="form-control" name="kelas" value="<?php echo $tampil['KELAS']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select name="wali_kelas" class="form-control" required>

                                <?php
                                $kode_pengajar = $tampil['NIP_PENGAJAR'];

                                $database_wali_kelas = $koneksi->query("SELECT * FROM tbl_pengajar ") or die(mysqli_error($koneksi));

                                while ($data_wali_kelas = $database_wali_kelas->fetch_assoc()) {
                                    $kode_data_pengajar = $data_wali_kelas['NIP_PENGAJAR'];

                                    //Data akan terseleksi (selected) jika variabel $kode_kelas sama dengan $kode_data_kelas.

                                    if ($kode_pengajar == $kode_data_pengajar) {
                                        $cek = "selected";
                                    } else {
                                        $cek = "";
                                    }
                                    // echo "<option value='$kode_data_pengajar' $cek>$kode_data_pengajar</option>";
                                    echo "<option value='$kode_data_pengajar' $cek>" . $data_wali_kelas['NAMA_PENGAJAR'] . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Status Kelas</label>
                            <div class="form-check">
                                <input name="status_kelas" class="form-check-input" type="radio" value="Aktif" <?php if ($tampil['STATUS_KELAS'] == 'Aktif') echo 'checked' ?>>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input name="status_kelas" class="form-check-input" type="radio" value="Tidak Aktif" <?php if ($tampil['STATUS_KELAS'] == 'Tidak Aktif') echo 'checked' ?>>
                                <label class="form-check-label">Tidak Aktif</label>
                            </div>
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