<?php
$database_mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$_GET[id]' ");
$tampil_database_mapel = $database_mapel->fetch_assoc();

?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Tugas/Quiz Mata Pelajaran <?php echo $tampil_database_mapel['MAPEL']; ?>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Quiz</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Tanggal Buat</th>
                        <th>Pembuat</th>
                        <th>Waktu Pengerjaan</th>
                        <th>Info</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    // $database = $koneksi->query("SELECT * FROM tbl_topik_quiz INNER JOIN tbl_pengajar ON tbl_topik_quiz.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR INNER JOIN tbl_kelas ON tbl_topik_quiz.ID_KELAS = tbl_kelas.ID_KELAS INNER JOIN tbl_mapel ON tbl_topik_quiz.ID_MAPEL = tbl_mapel.ID_MAPEL");


                    // $tampil_mapel = $database_mapel->fetch_assoc();

                    $mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$_GET[id]' ");
                    $tampil_mapel = $mapel->fetch_assoc();

                    $database_topik = $koneksi->query("SELECT * FROM tbl_topik_quiz where ID_KELAS = '$_GET[id_kelas]' AND ID_MAPEL = '$_GET[id]' AND TERBIT='Aktif' ");

                    $cek_topik = $database_topik->num_rows;

                    if (!empty($cek_topik)) {
                        $no = 1;
                        while ($data_topik_quiz = $database_topik->fetch_assoc()) {
                            $pengajar = $koneksi->query("SELECT * FROM tbl_pengajar where ID_PENGAJAR = '$data_topik_quiz[ID_PENGAJAR]' ");

                            $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$data_topik_quiz[ID_KELAS]' ");

                            $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$data_topik_quiz[ID_MAPEL]' ");



                            $waktu_pengerjaan = $data_topik_quiz['WAKTU_PENGERJAAN'] / 60;

                    ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data_topik_quiz['JUDUL_QUIZ']; ?></td>
                                <?php while ($data_kelas = $database_kelas->fetch_assoc()) { ?>
                                    <td><?php echo $data_kelas['KELAS']; ?></td>
                                <?php } ?>
                                <?php while ($data_mapel = $database_mapel->fetch_assoc()) { ?>
                                    <td><?php echo $data_mapel['MAPEL']; ?></td>
                                <?php } ?>
                                <td><?php echo $data_topik_quiz['TGL_BUAT']; ?></td>
                                <?php while ($data_pengajar = $pengajar->fetch_assoc()) { ?>
                                    <td><?php echo $data_pengajar['NAMA_PENGAJAR']; ?></td>
                                <?php } ?>
                                <td><?php echo $waktu_pengerjaan ?> Menit</td>
                                <td><?php echo $data_topik_quiz['INFO']; ?></td>


                                <td>
                                    <a href="index.php?page=Nilai&aksi=nilaisiswa&id_topik=<?php echo $data_topik_quiz['ID_TOPIK_QUIZ'] ?>" class="btn btn-success">Lihat Nilai</a>




                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>