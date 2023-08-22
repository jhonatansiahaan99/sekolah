<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah



$Judul_quiz = mysqli_real_escape_string($koneksi, $_POST['judul_quiz']);
$Id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
$Id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
$Tgl_buat = date('Y-m-d');
// $Nip_pengajar = mysqli_real_escape_string($koneksi, $_POST['nip_pengajar']);
$Info = mysqli_real_escape_string($koneksi, $_POST['info']);
$Terbit = mysqli_real_escape_string($koneksi, $_POST['status_terbit']);

$Waktu_pengerjaan = mysqli_real_escape_string($koneksi, $_POST['waktu_pengerjaan'] * 60);



$pelajaran = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$Id_mapel' ");
$tampil = $pelajaran->fetch_assoc();




if (isset($_POST['simpan'])) {
    $database = $koneksi->query("insert into tbl_topik_quiz (JUDUL_QUIZ,ID_KELAS,ID_MAPEL,TGL_BUAT,ID_PENGAJAR,WAKTU_PENGERJAAN,INFO,TERBIT) values('$Judul_quiz','$Id_kelas','$Id_mapel','$Tgl_buat','$tampil[ID_PENGAJAR]','$Waktu_pengerjaan','$Info','$Terbit')");

    if ($database) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Topik Quiz",
                    text: "Berhasil Ditambahkan",
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
                    <h3 class="card-title">Form Tambah Topik Quiz</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul Quiz</label>
                            <input type="text" class="form-control" name="judul_quiz" required>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" id="id_kelas_js" class="form-control" required>
                                <option value="">-- Pilih Kelas --</option>
                                <?php
                                $database_kelas = $koneksi->query("SELECT  * FROM tbl_kelas ORDER BY ID_KELAS") or die(mysqli_error($koneksi));

                                while ($data_kelas = $database_kelas->fetch_assoc()) {

                                    echo '<option value="' . $data_kelas['ID_KELAS'] . '" >' . $data_kelas['KELAS'] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="id_mapel" id="id_mapel_js" class="form-control" required>
                                <option value="">-- Pilih Kelas --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Waktu Pengerjaan (Dalam Menit)</label>
                            <input type="number" name="waktu_pengerjaan" required class="form-control" placeholder="Dalam Menit">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Info Quiz</label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="info" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Status Terbit</label>
                            <div class="form-check">
                                <input name="status_terbit" class="form-check-input" type="radio" name="radio1" value="Aktif" checked>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input name="status_terbit" class="form-check-input" type="radio" name="radio1" value="Tidak Aktif">
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