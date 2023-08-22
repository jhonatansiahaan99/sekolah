<?php

//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah

//untuk mengambil dan menampilkan id_topik_quiz
$ambil_perid = $_GET['id'];
$ambil_id2 = $_GET['id_topik'];

//menampilkan data yang akan di edit
$database_pilganda = $koneksi->query("select * from tbl_quiz_pilganda where ID_PILGANDA = '$ambil_perid' ");
$tampil_pilganda = $database_pilganda->fetch_assoc();

//ngambil data foto
$Foto_unlink = $tampil_pilganda['GAMBAR'];

$Id_pilganda = mysqli_real_escape_string($koneksi, $_POST['id_pilganda']);
$Pertanyaan = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
$Pil_a = mysqli_real_escape_string($koneksi, $_POST['pil_a']);
$Pil_b = mysqli_real_escape_string($koneksi, $_POST['pil_b']);
$Pil_c = mysqli_real_escape_string($koneksi, $_POST['pil_c']);
$Pil_d = mysqli_real_escape_string($koneksi, $_POST['pil_d']);
$Pil_e = mysqli_real_escape_string($koneksi, $_POST['pil_e']);
$Kunci_jawaban = mysqli_real_escape_string($koneksi, $_POST['kunci_jawaban']);
$Tgl_buat = date('Y-m-d');


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
        $database = $koneksi->query("Update tbl_quiz_pilganda set ID_TOPIK_QUIZ = '$ambil_id2',PERTANYAAN = '$Pertanyaan',PIL_A ='$Pil_a',PIL_B='$Pil_b',PIL_C='$Pil_c',PIL_D='$Pil_d',PIL_E='$Pil_e',KUNCI='$Kunci_jawaban',TGL_BUAT ='$Tgl_buat',JENIS_SOAL='PILGANDA' where ID_PILGANDA='$Id_pilganda' ");

        if ($database) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Soal Pilihan Ganda",
                        text: "Berhasil DiUbah",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }, function() {
                        window.location.href = "?page=Manajemen_quiz&aksi=buat_pilganda&id=<?php echo $ambil_id2 ?>";
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
                    window.location.href = "?page=Manajemen_quiz&aksi=edit_quiz_pilganda&id=<?php echo ($_GET['id']) ?>&id_topik=<?php echo ($_GET['id_topik']) ?>";
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
                    window.location.href = window.location.href = "?page=Manajemen_quiz&aksi=edit_quiz_pilganda&id=<?php echo ($_GET['id']) ?>&id_topik=<?php echo ($_GET['id_topik']) ?>";
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
                    window.location.href = window.location.href = "?page=Manajemen_quiz&aksi=edit_quiz_pilganda&id=<?php echo ($_GET['id']) ?>&id_topik=<?php echo ($_GET['id_topik']) ?>";

                });
            }, 100);
        </script>
        <?php } else {
        if (!empty($Asal_foto)) {

            if (file_exists("../images_soal_pilganda/$Foto_unlink")) {
                unlink("../images_soal_pilganda/$Foto_unlink");
            }

            $penyimpanan = move_uploaded_file($Asal_foto, "../images_soal_pilganda/" . $Foto_baru);

            $database = $koneksi->query("Update tbl_quiz_pilganda set ID_TOPIK_QUIZ = '$ambil_id2',PERTANYAAN = '$Pertanyaan',GAMBAR = '$Foto_baru',PIL_A ='$Pil_a',PIL_B='$Pil_b',PIL_C='$Pil_c',PIL_D='$Pil_d',PIL_E='$Pil_e',KUNCI='$Kunci_jawaban',TGL_BUAT='$Tgl_buat',JENIS_SOAL='PILGANDA' WHERE ID_PILGANDA='$Id_pilganda' ");

            if ($database) { ?>

                <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                            title: "Soal Pilihan Ganda",
                            text: "Berhasil DiUbah",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }, function() {
                            window.location.href = "?page=Manajemen_quiz&aksi=buat_pilganda&id=<?php echo $ambil_id2 ?>";
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
        <!-- left column -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Soal Pilihan Ganda</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pertanyaan</label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="pertanyaan" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $tampil_pilganda['PERTANYAAN']; ?> </textarea>
                                    <input type="hidden" class="form-control" name="id_topik_quiz" value="<?php echo $_GET['id_topik'] ?>">
                                    <input type="hidden" class="form-control" name="id_pilganda" value="<?php echo $tampil_pilganda['ID_PILGANDA'] ?>">
                                </div>
                            </div>
                        </div>

                        <label for="">Gambar Pertanyaan </label>
                        <div class="form-group">
                            <div class="form-line">
                                <?php
                                if (empty($tampil_pilganda['GAMBAR'])) {
                                    echo "FOTO KOSONG";
                                } else {

                                    echo "<td><img width='150px' height='100px'  src='../images_soal_pilganda/" . $tampil_pilganda['GAMBAR'] . "' /></td>";

                                ?>

                                <?php }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Gambar Pertanyaan</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <span style="color:#F44336 ">*Tipe file JPG/JPEG dan Size maks : 2MB</span>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilihan A</label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="pil_a" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $tampil_pilganda['PIL_A'] ?></textarea>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilihan B</label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="pil_b" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $tampil_pilganda['PIL_B'] ?></textarea>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilihan C</label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="pil_c" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $tampil_pilganda['PIL_C'] ?></textarea>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilihan D</label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="pil_d" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $tampil_pilganda['PIL_D'] ?></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilihan E</label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="pil_e" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $tampil_pilganda['PIL_E'] ?></textarea>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Kunci Jawaban</label>
                            <div class="form-check">
                                <input name="kunci_jawaban" class="form-check-input" type="radio" value="A" <?php if ($tampil_pilganda['KUNCI'] == 'A') echo 'checked' ?>>
                                <label class="form-check-label">A</label>
                            </div>
                            <div class="form-check">
                                <input name="kunci_jawaban" class="form-check-input" type="radio" value="B" <?php if ($tampil_pilganda['KUNCI'] == 'B') echo 'checked' ?>>
                                <label class="form-check-label">B</label>
                            </div>
                            <div class="form-check">
                                <input name="kunci_jawaban" class="form-check-input" type="radio" value="C" <?php if ($tampil_pilganda['KUNCI'] == 'C') echo 'checked' ?>>
                                <label class="form-check-label">C</label>
                            </div>
                            <div class="form-check">
                                <input name="kunci_jawaban" class="form-check-input" type="radio" value="D" <?php if ($tampil_pilganda['KUNCI'] == 'D') echo 'checked' ?>>
                                <label class="form-check-label">D</label>
                            </div>
                            <div class="form-check">
                                <input name="kunci_jawaban" class="form-check-input" type="radio" value="E" <?php if ($tampil_pilganda['KUNCI'] == 'E') echo 'checked' ?>>
                                <label class="form-check-label">E</label>
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