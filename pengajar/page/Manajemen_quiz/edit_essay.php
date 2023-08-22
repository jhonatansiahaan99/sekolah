<?php

//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah


$ambil_perid = $_GET['id'];
$ambil_id2 = $_GET['id_topik'];

//menampilkan data yang akan di edit
$database_essay = $koneksi->query("select * from tbl_quiz_essay where ID_ESSAY = '$ambil_perid' ");
$tampil_essay = $database_essay->fetch_assoc();

//ngambil data foto
$Foto_unlink = $tampil_essay['GAMBAR'];

//variabel
$Pertanyaan = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
$Id_essay = mysqli_real_escape_string($koneksi, $_POST['id_essay']);
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
        $database = $koneksi->query("Update tbl_quiz_essay set ID_TOPIK_QUIZ = '$ambil_id2',PERTANYAAN = '$Pertanyaan',TGL_BUAT ='$Tgl_buat',JENIS_SOAL='ESSAY' where ID_ESSAY='$Id_essay' ");

        if ($database) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Soal Essay",
                        text: "Berhasil DiUbah",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }, function() {
                        window.location.href = "?page=Manajemen_quiz&aksi=buat_essay&id=<?php echo $ambil_id2 ?>";
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
                    window.location.href = "?page=Manajemen_quiz&aksi=edit_quiz_essay&id=<?php echo ($_GET['id']) ?>&id_topik=<?php echo ($_GET['id_topik']) ?>";
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
                    window.location.href = "?page=Manajemen_quiz&aksi=edit_quiz_essay&id=<?php echo ($_GET['id']) ?>&id_topik=<?php echo ($_GET['id_topik']) ?>";
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
                    window.location.href = "?page=Manajemen_quiz&aksi=edit_quiz_essay&id=<?php echo ($_GET['id']) ?>&id_topik=<?php echo ($_GET['id_topik']) ?>";

                });
            }, 100);
        </script>
        <?php } else {
        if (!empty($Asal_foto)) {
            if (file_exists("../images_soal_essay/$Foto_unlink")) {
                unlink("../images_soal_essay/$Foto_unlink");
            }

            $penyimpanan = move_uploaded_file($Asal_foto, "../images_soal_essay/" . $Foto_baru);

            $database = $koneksi->query("Update tbl_quiz_essay set ID_TOPIK_QUIZ = '$ambil_id2',PERTANYAAN = '$Pertanyaan',GAMBAR = '$Foto_baru' ,TGL_BUAT ='$Tgl_buat',JENIS_SOAL='ESSAY' where ID_ESSAY='$Id_essay' ");


            if ($database) { ?>

                <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                            title: "Soal Essay",
                            text: "Berhasil DiUbah",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }, function() {
                            window.location.href = "?page=Manajemen_quiz&aksi=buat_essay&id=<?php echo $ambil_id2 ?>";
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
                    <h3 class="card-title">Form Edit Soal Essay</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pertanyaan </label>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="pertanyaan" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $tampil_essay['PERTANYAAN']; ?> </textarea>
                                    <input type="hidden" class="form-control" name="id_topik_quiz" value="<?php echo $_GET['id_topik'] ?>">
                                    <input type="hidden" class="form-control" name="id_essay" value="<?php echo $tampil_essay['ID_ESSAY'] ?>">
                                </div>
                            </div>
                        </div>

                        <label for="">Gambar </label>
                        <div class="form-group">
                            <div class="form-line">
                                <?php
                                if (empty($tampil_essay['GAMBAR'])) {
                                    echo "FOTO KOSONG";
                                } else {

                                    echo "<td><img width='150px' height='100px'  src='../images_soal_essay/" . $tampil_essay['GAMBAR'] . "' /></td>";

                                ?>

                                <?php }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
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