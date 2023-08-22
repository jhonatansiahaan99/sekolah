<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah


// file edit untuk mengambil data sesuai id
$ambil_perid = $_GET['id'];
$database1 = $koneksi->query("select * from tbl_topik_quiz where ID_TOPIK_QUIZ = '$ambil_perid' ");
$tampil1 = $database1->fetch_assoc();


$Judul_quiz = mysqli_real_escape_string($koneksi, $_POST['judul_quiz']);
$Id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
$Id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
$Tgl_buat = date('Y-m-d');
// $Nip_pengajar = mysqli_real_escape_string($koneksi, $_POST['nip_pengajar']);
$Waktu_pengerjaan = mysqli_real_escape_string($koneksi, $_POST['waktu_pengerjaan'] * 60);
$Info = mysqli_real_escape_string($koneksi, $_POST['info']);
$Terbit = mysqli_real_escape_string($koneksi, $_POST['status_terbit']);




$pelajaran = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$Id_mapel' ");
$tampil = $pelajaran->fetch_assoc();


if (isset($_POST['simpan'])) {
    $database = $koneksi->query("update tbl_topik_quiz set JUDUL_QUIZ='$Judul_quiz',ID_KELAS = '$Id_kelas', ID_MAPEL = '$Id_mapel',TGL_BUAT = '$Tgl_buat',ID_PENGAJAR= '$tampil[ID_PENGAJAR]',WAKTU_PENGERJAAN = '$Waktu_pengerjaan',INFO = '$Info',TERBIT = '$Terbit' where ID_TOPIK_QUIZ = '$ambil_perid' ");

    if ($database) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Topik Quiz",
                    text: "Berhasil DiUpdate",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000
                }, function() {
                    window.location.href = "?page=Manajemen_quiz";
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
                    <h3 class="card-title">Form Edit Topik Quiz</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">

                    <div class="card-body">
                        <?php

                        $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel INNER JOIN tbl_kelas ON tbl_mapel.ID_KELAS=tbl_kelas.ID_KELAS INNER JOIN tbl_pengajar ON tbl_mapel.ID_PENGAJAR=tbl_pengajar.ID_PENGAJAR where USERNAME='$_SESSION[PENGAJAR]' ");

                        while ($data_mapel = $database_mapel->fetch_assoc()) {
                        ?>
                            <h5>
                                <p><label>Mata Pelajaran Yang Anda Ajar : </label> <?php echo $data_mapel['MAPEL']; ?></p>
                                <p><label>Kelas Yang Anda Ajar : </label> <?php echo $data_mapel['KELAS']; ?></p>
                            </h5>
                        <?php
                        }
                        ?>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul Materi</label>
                            <input type="text" class="form-control" name="judul_quiz" value="<?php echo $tampil1['JUDUL_QUIZ']; ?>" required>
                            <input type="hidden" class="form-control" name="id_topik_quiz" value="<?php echo $tampil1['ID_TOPIK_QUIZ']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" id="id_kelas_js" class="form-control" required>
                                <option value="">-- Pilih Kelas --</option>
                                <?php
                                $kode_kelas = $tampil1['ID_KELAS'];

                                // $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas ") or die(mysqli_error($koneksi));
                                $pilih_pengajar = $koneksi->query("SELECT DISTINCT ID_KELAS FROM tbl_mapel where ID_PENGAJAR = '$_SESSION[ID_PENGAJAR]' ") or die(mysqli_error($koneksi));

                                while ($data_pilih_pengajar = $pilih_pengajar->fetch_assoc()) {
                                    $cari_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$data_pilih_pengajar[ID_KELAS]' ") or die(mysqli_error($koneksi));

                                    while ($data_cari_kelas = $cari_kelas->fetch_assoc()) {
                                        $kode_data_kelas = $data_cari_kelas['ID_KELAS'];

                                        //Data akan terseleksi (selected) jika variabel $kode_kelas sama dengan $kode_data_kelas.

                                        if ($kode_kelas == $kode_data_kelas) {
                                            $cek = "selected";
                                        } else {
                                            $cek = "";
                                        }
                                        echo "<option value='$kode_data_kelas' $cek>" . $data_cari_kelas['KELAS'] . "</option>";
                                    }
                                }


                                // while ($data_kelas = $database_kelas->fetch_assoc()) {

                                //     $kode_data_kelas = $data_kelas['ID_KELAS'];

                                //     //Data akan terseleksi (selected) jika variabel $kode_kelas sama dengan $kode_data_kelas.

                                //     if ($kode_kelas == $kode_data_kelas) {
                                //         $cek = "selected";
                                //     } else {
                                //         $cek = "";
                                //     }
                                //     echo "<option value='$kode_data_kelas' $cek>" . $data_kelas['KELAS'] . "</option>";
                                // }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="id_mapel" id="id_mapel_js" class="form-control" required>
                                <?php
                                $edit_database_mapel1 = $koneksi->query("select * from tbl_mapel where ID_MAPEL = '$tampil1[ID_MAPEL]' ");
                                $edit_tampil_mapel = $edit_database_mapel1->fetch_assoc();

                                $cek = "selected";
                                echo "<option value='$edit_tampil_mapel[ID_MAPEL]' $cek>" . $edit_tampil_mapel['MAPEL'] . "</option>";
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Waktu Pengerjaan (Dalam Menit)</label>
                            <input type="number" name="waktu_pengerjaan" value="<?php echo $tampil1['WAKTU_PENGERJAAN'] / 60; ?>" required class=" form-control" placeholder="Dalam Menit">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Info Quiz</label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="info" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $tampil1['INFO']; ?> </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Status Terbit</label>
                            <div class="form-check">
                                <input name="status_terbit" class="form-check-input" type="radio" value="Aktif" <?php if ($tampil1['TERBIT'] == 'Aktif') echo 'checked' ?>>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input name="status_terbit" class="form-check-input" type="radio" value="Tidak Aktif" <?php if ($tampil1['TERBIT'] == 'Tidak Aktif') echo 'checked' ?>>
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


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#id_kelas_js').on('change', function() {
            var varkelasjs = $("#id_kelas_js").val();

            if (varkelasjs) {
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: 'kelasajax=' + varkelasjs,
                    dataType: "html",
                    success: function(html) {
                        // alert(html);
                        // console.log(html);
                        $('#id_mapel_js').html(html);

                    },
                });
            } else {
                $('#id_mapel_js').html('<option value="">Pilih Mata Pelajaran</select>');
            }

        });

    });
</script>