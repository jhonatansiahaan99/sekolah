<?php
$ambil_perid = $_GET['id'];

$siswa_yangmengerjakan = $koneksi->query("SELECT ID_SISWA FROM siswa_sudah_mengerjakan WHERE ID_TOPIK_QUIZ = '$_GET[id]'");
$cek_siswa = $siswa_yangmengerjakan->fetch_assoc();


if (!empty($cek_siswa)) {


    $soal_pilganda = $koneksi->query("SELECT * FROM tbl_quiz_pilganda WHERE ID_TOPIK_QUIZ='$_GET[id]'");
    $pilganda = $soal_pilganda->num_rows;



    $soal_esay = $koneksi->query("SELECT * FROM tbl_quiz_essay WHERE ID_TOPIK_QUIZ='$_GET[id]'");
    $esay =  $soal_esay->num_rows;
    if (!empty($pilganda) and !empty($esay)) {
?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Peserta Yang Mengerjakan Soal dan Koreksi Soal
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <br>
                    <div class='alert alert-info'>
                        Pilih Aksi <b>Hapus Siswa</b> jika ingin mereset Siswa yang telah mengikuti ujian.<br>
                        Hanya jawaban soal Essay yang bisa di koreksi.<br>
                        Penilaian Soal Pilihan Ganda Sistem yang mengerjakan.</div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Nilai Pilihan Ganda</th>
                                <th>Nilai Essay</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no = 1;

                            $database = $koneksi->query("SELECT * FROM siswa_sudah_mengerjakan where ID_TOPIK_QUIZ = '$ambil_perid' ");

                            while ($data_koreksi = $database->fetch_assoc()) {

                                $database_siswa = $koneksi->query("SELECT * FROM tbl_siswa where ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                $tampil_siswa = $database_siswa->fetch_assoc();

                                $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$tampil_siswa[ID_KELAS]' ");
                                $tampil_kelas = $database_kelas->fetch_assoc();

                                $database_nilai_essay = $koneksi->query("SELECT * FROM tbl_nilai_soal_essay where ID_TOPIK_QUIZ ='$ambil_perid' AND ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                $tampil_nilai_essay = $database_nilai_essay->fetch_assoc();

                                $database_nilai = $koneksi->query("SELECT * FROM tbl_nilai where ID_TOPIK_QUIZ ='$ambil_perid' AND ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                $tampil_nilai = $database_nilai->fetch_assoc();

                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tampil_siswa['NAMA_SISWA']; ?></td>
                                    <td><?php echo $tampil_kelas['KELAS']; ?></td>
                                    <?php
                                    if ($data_koreksi['DIKOREKSI'] == '') { ?>

                                        <td><?php echo "BELUM" ?></td>
                                        <td><?php echo $tampil_nilai['PERSENTASE']; ?></td>
                                        <td><?php echo "0" ?></td>
                                        <td>
                                            <a href="index.php?page=Manajemen_quiz&aksi=hapussiswayangtelahmengerjakan&id=<?php echo $data_koreksi['ID'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>&id_topik_quiz=<?php echo $_GET['id'] ?>" class="btn btn-danger tombol-hapus">Delete Siswa</a>

                                            <a href="index.php?page=Manajemen_quiz&aksi=koreksi&id=<?php echo $data_koreksi['ID_TOPIK_QUIZ'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>" class="btn btn-warning">Koreksi</a>
                                        </td>
                                    <?php
                                    } else { ?>
                                        <td><b><?php echo "SUDAH DI KOREKSI" ?></b></td>
                                        <td><?php echo $tampil_nilai['PERSENTASE']; ?></td>
                                        <td><?php echo $tampil_nilai_essay['NILAI']; ?></td>
                                        <td>
                                            <a href="index.php?page=Manajemen_quiz&aksi=hapussiswayangtelahmengerjakan&id=<?php echo $data_koreksi['ID'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>&id_topik_quiz=<?php echo $_GET['id'] ?>" class="btn btn-danger tombol-hapus">Delete Siswa</a>

                                            <a href="index.php?page=Manajemen_quiz&aksi=editkoreksi&id=<?php echo $data_koreksi['ID_TOPIK_QUIZ'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>" class="btn btn-warning">Edit Koreksi</a>
                                        </td>



                                    <?php
                                    }
                                    ?>

                                </tr>


                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php


    } elseif (empty($pilganda) and !empty($esay)) { ?>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Peserta Yang Mengerjakan Soal dan Koreksi Soal
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <br>
                    <div class='alert alert-info'>
                        Pilih Aksi <b>Hapus Siswa</b> jika ingin mereset Siswa yang telah mengikuti ujian.<br>
                        Hanya jawaban soal Essay yang bisa di koreksi.<br>
                        Penilaian Soal Pilihan Ganda Sistem yang mengerjakan.</div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Nilai Pilihan Ganda</th>
                                <th>Nilai Essay</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no = 1;

                            $database = $koneksi->query("SELECT * FROM siswa_sudah_mengerjakan where ID_TOPIK_QUIZ = '$ambil_perid' ");
                            while ($data_koreksi = $database->fetch_assoc()) {

                                $database_siswa = $koneksi->query("SELECT * FROM tbl_siswa where ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                $tampil_siswa = $database_siswa->fetch_assoc();

                                $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$tampil_siswa[ID_KELAS]' ");
                                $tampil_kelas = $database_kelas->fetch_assoc();

                                $database_nilai_essay = $koneksi->query("SELECT * FROM tbl_nilai_soal_essay where ID_TOPIK_QUIZ ='$ambil_perid' AND ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                $tampil_nilai_essay = $database_nilai_essay->fetch_assoc();

                                // $database_nilai = $koneksi->query("SELECT * FROM tbl_nilai where ID_TOPIK_QUIZ ='$ambil_perid' AND ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                // $tampil_nilai = $database_nilai->fetch_assoc();

                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tampil_siswa['NAMA_SISWA']; ?></td>
                                    <td><?php echo $tampil_kelas['KELAS']; ?></td>
                                    <?php
                                    if ($data_koreksi['DIKOREKSI'] == '') { ?>

                                        <td><?php echo "0" ?></td>
                                        <td>Jawaban Soal Essay Belum Dikoreksi</td>
                                        <td>
                                            <a href="index.php?page=Manajemen_quiz&aksi=hapussiswayangtelahmengerjakan&id=<?php echo $data_koreksi['ID'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>&id_topik_quiz=<?php echo $_GET['id'] ?>" class="btn btn-danger tombol-hapus">Delete Siswa</a>

                                            <a href="index.php?page=Manajemen_quiz&aksi=koreksi&id=<?php echo $data_koreksi['ID_TOPIK_QUIZ'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>" class="btn btn-warning">Koreksi</a>
                                        </td>
                                    <?php
                                    } else { ?>
                                        <td><b><?php echo "SUDAH DI KOREKSI" ?></b></td>
                                        <td><?php echo $tampil_nilai['PERSENTASE']; ?></td>
                                        <td><?php echo $tampil_nilai_essay['NILAI']; ?></td>
                                        <td>
                                            <a href="index.php?page=Manajemen_quiz&aksi=hapussiswayangtelahmengerjakan&id=<?php echo $data_koreksi['ID'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>&id_topik_quiz=<?php echo $_GET['id'] ?>" class="btn btn-danger tombol-hapus">Delete Siswa</a>

                                            <a href="index.php?page=Manajemen_quiz&aksi=editkoreksi&id=<?php echo $data_koreksi['ID_TOPIK_QUIZ'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>" class="btn btn-warning">Edit Koreksi</a>
                                        </td>



                                    <?php
                                    }
                                    ?>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php
    } elseif (!empty($pilganda) and empty($esay)) {
    ?>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Peserta Yang Mengerjakan Soal dan Koreksi Soal
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <br>
                    <div class='alert alert-info'>
                        Pilih Aksi <b>Hapus Siswa</b> jika ingin mereset Siswa yang telah mengikuti ujian.<br>
                        Hanya jawaban soal Essay yang bisa di koreksi.<br>
                        Penilaian Soal Pilihan Ganda Sistem yang mengerjakan.</div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Nilai Pilihan Ganda</th>
                                <th>Nilai Essay</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no = 1;

                            $database = $koneksi->query("SELECT * FROM siswa_sudah_mengerjakan where ID_TOPIK_QUIZ = '$ambil_perid' ");
                            while ($data_koreksi = $database->fetch_assoc()) {

                                $database_siswa = $koneksi->query("SELECT * FROM tbl_siswa where ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                $tampil_siswa = $database_siswa->fetch_assoc();

                                $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$tampil_siswa[ID_KELAS]' ");
                                $tampil_kelas = $database_kelas->fetch_assoc();

                                $database_nilai_essay = $koneksi->query("SELECT * FROM tbl_nilai_soal_essay where ID_TOPIK_QUIZ ='$ambil_perid' AND ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                $tampil_nilai_essay = $database_nilai_essay->fetch_assoc();

                                $database_nilai = $koneksi->query("SELECT * FROM tbl_nilai where ID_TOPIK_QUIZ ='$ambil_perid' AND ID_SISWA = '$data_koreksi[ID_SISWA]' ");
                                $tampil_nilai = $database_nilai->fetch_assoc();

                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tampil_siswa['NAMA_SISWA']; ?></td>
                                    <td><?php echo $tampil_kelas['KELAS']; ?></td>
                                    <?php
                                    if ($data_koreksi['DIKOREKSI'] == '') { ?>

                                        <td><?php echo $tampil_nilai['PERSENTASE']; ?></td>
                                        <td>
                                            <a href="index.php?page=Manajemen_quiz&aksi=hapussiswayangtelahmengerjakan&id=<?php echo $data_koreksi['ID'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>&id_topik_quiz=<?php echo $_GET['id'] ?>" class="btn btn-danger tombol-hapus">Delete Siswa</a>
                                        </td>
                                    <?php
                                    } else { ?>

                                        <td><?php echo $tampil_nilai['PERSENTASE']; ?></td>
                                        <td><?php echo $tampil_nilai_essay['NILAI']; ?></td>
                                        <td>
                                            <a href="index.php?page=Manajemen_quiz&aksi=hapussiswayangtelahmengerjakan&id=<?php echo $data_koreksi['ID'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>&id_topik_quiz=<?php echo $_GET['id'] ?>" class="btn btn-danger tombol-hapus">Delete Siswa</a>

                                            <a href="index.php?page=Manajemen_quiz&aksi=editkoreksi&id=<?php echo $data_koreksi['ID_TOPIK_QUIZ'] ?>&id_siswa=<?php echo $tampil_siswa['ID_SISWA'] ?>" class="btn btn-warning">Edit Koreksi</a>
                                        </td>

                                    <?php
                                    }
                                    ?>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


<?php
    }
} else {
    echo "<script>window.alert('Belum ada siswa yang mengikuti ujian.');
                    window.location=(href='?page=Manajemen_quiz')</script>";
}

?>

<!-- // elseif (empty($pilganda) and empty($esay)) {
// echo "<script>
    window.alert('Tidak Ada Soal.');
    //                 window.location=(href='?page=Manajemen_quiz')
</script>";
// } -->