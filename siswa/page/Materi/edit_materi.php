<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah


// file edit untuk mengambil data sesuai id
$ambil_perid = $_GET['id'];
$database1 = $koneksi->query("select * from tbl_materi where ID_MATERI = '$ambil_perid' ");
$tampil1 = $database1->fetch_assoc();
//ngambil data file
$File_unlink = $tampil1['FILE'];


$Judul_materi = mysqli_real_escape_string($koneksi, $_POST['judul_materi']);
$Id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
$Id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
$Tgl_posting = date('Y-m-d');
// $Tgl_posting = mysqli_real_escape_string($koneksi, $_POST['tgl_posting']);
// $Nip_pengajar = mysqli_real_escape_string($koneksi, $_POST['nip_pengajar']);


//proses upload
$Nama_file = $_FILES['berkas']['name']; //nama file yang di awal
$Asal_file = $_FILES['berkas']['tmp_name']; //asal penyimpanan di folder tapi tidak masuk database atau penyimpanan sementara sebelum di masukkan ke database
$Titikarray = explode(".", $Nama_file);
$Extensi = $Titikarray[count($Titikarray) - 1];
$Validtype = array('doc', 'docx', 'pdf', 'pptx', 'xls', 'xlsx', 'zip', 'ZIP', 'RAR', 'rar'); //format file yang di ijinkan 
$Type = $_FILES['berkas']['type']; //type file //sudah ketentuan type file harus ada
$Ukuran = $_FILES['berkas']['size']; //ukuran
$Error = $_FILES['berkas']['error']; //menapilkan eror
// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$File_baru = date('dmYHis') .  $Nama_file;



$pelajaran = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$Id_mapel' ");
$tampil = $pelajaran->fetch_assoc();



if (isset($_POST['simpan'])) {
    if (empty($Asal_file)) { //jika foto tidak di upload
        $database = $koneksi->query("update tbl_materi set JUDUL_MATERI='$Judul_materi',ID_KELAS = '$Id_kelas', ID_MAPEL = '$Id_mapel',TGL_POSTING = '$Tgl_posting',ID_PENGAJAR= '$tampil[ID_PENGAJAR]' where ID_MATERI = '$ambil_perid' ");


        if ($database) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Materi",
                        text: "Berhasil DiUbah",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }, function() {
                        window.location.href = "?page=Materi";
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
                    window.location.href = "?page=Materi&aksi=edit&id=<?php echo ($_GET['id']) ?>";
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
                    window.location.href = "?page=Materi&aksi=edit&id=<?php echo ($_GET['id']) ?>";
                });
            }, 100);
        </script>

    <?php } elseif ($Error > 0) { ?>
        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "File Error",
                    text: "Gagal Di Simpan",
                    type: "error"
                }, function() {
                    window.location.href = "?page=Materi&aksi=edit&id=<?php echo ($_GET['id']) ?>";
                });
            }, 100);
        </script>
        <?php } else {
        if (!empty($Asal_file)) {

            if (file_exists("../dokumen/$File_unlink")) {
                unlink("../dokumen/$File_unlink");
            }

            $penyimpanan = move_uploaded_file($Asal_file, "../dokumen/" . $File_baru);


            $database = $koneksi->query("update tbl_materi set JUDUL_MATERI='$Judul_materi',ID_KELAS = '$Id_kelas', ID_MAPEL = '$Id_mapel',FILE='$File_baru',TGL_POSTING = '$Tgl_posting',ID_PENGAJAR= '$tampil[ID_PENGAJAR]' where ID_MATERI = '$ambil_perid' ");


            if ($database) {

        ?>

                <script type="text/javascript">
                    setTimeout(function() {
                        swal({
                            title: "Materi",
                            text: "Berhasil DiUbah",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }, function() {
                            window.location.href = "?page=Materi";
                        });
                    }, 100);
                </script>
<?php

            }
        }
    }
}
?>

<?php
//Untuk Mata Pelajaran
$edit_database1 = $koneksi->query("select * from tbl_materi where ID_MATERI = '$ambil_perid' ");
$edit_tampil1 = $edit_database1->fetch_assoc();

$edit_database_kelas1 = $koneksi->query("select * from tbl_kelas where ID_KELAS = '$edit_tampil1[ID_KELAS]' ");
$edit_tampil_kelas = $edit_database_kelas1->fetch_assoc();

$edit_database_mapel1 = $koneksi->query("select * from tbl_mapel where ID_MAPEL = '$edit_tampil1[ID_MAPEL]' ");
$edit_tampil_mapel = $edit_database_mapel1->fetch_assoc();

?>

<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Materi</h3>
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
                            <input type="text" class="form-control" name="judul_materi" value="<?php echo $tampil1['JUDUL_MATERI']; ?>" required>
                            <input type="hidden" class="form-control" name="id_materi" value="<?php echo $tampil1['ID_MATERI']; ?>">
                        </div>
                        <!-- <div class="form-group">
                            <label>Kelas</label>//ini bisa digunakan//ini bisa digunakan//ini bisa digunakan
                            <select name="id_kelas" id="id_kelas_js" class="form-control" required>
                                <option value="">-- Pilih Kelas --</option>
                                <?php
                                // $kode_kelas = $tampil1['ID_KELAS'];

                                // $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas") or die(mysqli_error($koneksi));

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
                            </select> //ini bisa digunakan//ini bisa digunakan//ini bisa digunakan//ini bisa digunakan
                        </div> -->

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
                                <!-- <option value='".$edit_tampil_mapel[ID_MAPEL]."' selected> ".$edit_tampil_mapel[MAPEL]." </option> -->
                                <?php


                                // echo '<option value="' . $edit_tampil_mapel['ID_MAPEL'] . '">' . $edit_tampil_mapel['MAPEL'] . '</option>';

                                ?>

                                <?php
                                $kode_mapel = $tampil1['ID_MAPEL'];

                                $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel ") or die(mysqli_error($koneksi));

                                // while ($data_mapel = $database_mapel->fetch_assoc()) {

                                //     $kode_data_mapel = $data_mapel['ID_MAPEL'];

                                //     //Data akan terseleksi (selected) jika variabel $kode_kelas sama dengan $kode_data_kelas.

                                //     if ($kode_mapel == $kode_data_mapel) {
                                //         $cek = "selected";
                                //     } else {
                                //         $cek = "";
                                //     }
                                //     echo "<option value='$kode_data_mapel' $cek>" . $data_mapel['MAPEL'] . "</option>";
                                // }
                                $cek = "selected";
                                echo "<option value='$edit_tampil_mapel[ID_MAPEL]' $cek>" . $edit_tampil_mapel['MAPEL'] . "</option>";
                                ?>
                            </select>
                        </div>

                        <label for="">File </label>
                        <div class="form-group">
                            <div class="form-line">
                                <?php
                                if (empty($tampil1['FILE'])) {
                                    echo "FILE KOSONG";
                                } else {
                                    echo $tampil1['FILE'];


                                ?>

                                <?php }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile"> Ubah File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="berkas">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <span style="color:#F44336 ">*Tipe file doc,docx,pdf,xls,xlsx,pptx,rar,zip dan Size maks : 2MB</span>
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