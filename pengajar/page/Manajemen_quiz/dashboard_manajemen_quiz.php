<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manajemen Quiz
            </h3>
            <div style=" float: right"><a href="?page=Manajemen_quiz&aksi=tambah" class="btn btn-primary">Tambah Topik Quiz</a></div>
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
                        <th>Status Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database = $koneksi->query("SELECT * FROM tbl_topik_quiz where ID_PENGAJAR = '$_SESSION[ID_PENGAJAR]'");



                    // $database = $koneksi->query("SELECT * FROM tbl_topik_quiz INNER JOIN tbl_pengajar ON tbl_topik_quiz.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR INNER JOIN tbl_kelas ON tbl_topik_quiz.ID_KELAS = tbl_kelas.ID_KELAS INNER JOIN tbl_mapel ON tbl_topik_quiz.ID_MAPEL = tbl_mapel.ID_MAPEL where ID_PENGAJAR = '$_SESSION[ID_PENGAJAR]'");

                    while ($data_topik_quiz = $database->fetch_assoc()) {
                        $waktu_pengerjaan = $data_topik_quiz['WAKTU_PENGERJAAN'] / 60;

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_topik_quiz['JUDUL_QUIZ']; ?></td>
                            <?php
                            $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$data_topik_quiz[ID_KELAS]'");
                            while ($data_kelas = $database_kelas->fetch_assoc()) {

                            ?>
                                <td><?php echo $data_kelas['KELAS']; ?></td>

                            <?php } ?>
                            <?php
                            $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$data_topik_quiz[ID_MAPEL]'");
                            while ($data_mapel = $database_mapel->fetch_assoc()) {
                            ?>
                                <td><?php echo $data_mapel['MAPEL']; ?></td>
                            <?php } ?>


                            <td><?php echo $data_topik_quiz['TGL_BUAT']; ?></td>


                            <?php
                            $database_pengajar = $koneksi->query("SELECT * FROM tbl_pengajar where ID_PENGAJAR = '$data_topik_quiz[ID_PENGAJAR]'");
                            while ($data_pengajar = $database_pengajar->fetch_assoc()) {
                            ?>
                                <td><?php echo $data_pengajar['NAMA_PENGAJAR']; ?></td>
                            <?php } ?>
                            <td><?php echo $waktu_pengerjaan ?> Menit</td>
                            <td><?php echo $data_topik_quiz['INFO']; ?></td>
                            <td><?php echo $data_topik_quiz['TERBIT']; ?></td>

                            <td>
                                <a href="index.php?page=Manajemen_quiz&aksi=edit&id=<?php echo $data_topik_quiz['ID_TOPIK_QUIZ'] ?>" class="btn btn-success">Edit Topik</a>
                                <a href="index.php?page=Manajemen_quiz&aksi=hapus&id=<?php echo $data_topik_quiz['ID_TOPIK_QUIZ'] ?>" class="btn btn-danger tombol-hapus">Hapus</a>

                                <p><a href="index.php?page=Manajemen_quiz&aksi=buat_essay&id=<?php echo $data_topik_quiz['ID_TOPIK_QUIZ'] ?>" class="btn btn-primary">Buat Quiz Essay</a>
                                    <a href="index.php?page=Manajemen_quiz&aksi=buat_pilganda&id=<?php echo $data_topik_quiz['ID_TOPIK_QUIZ'] ?>" class="btn btn-warning">Buat Quiz Pilihan Ganda</a>

                                </p>
                                <a href="index.php?page=Manajemen_quiz&aksi=peserta_koreksi&id=<?php echo $data_topik_quiz['ID_TOPIK_QUIZ'] ?>" class="btn btn-success">Daftar Peserta & Koreksi</a>


                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>