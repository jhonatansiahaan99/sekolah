<?php
//untuk nampilkan id_topik_quiz agar bisa ditambahkan
$ambil_perid = $_GET['id'];
$database_pilganda = $koneksi->query("SELECT * FROM tbl_topik_quiz where ID_TOPIK_QUIZ = '$ambil_perid' ");
$tampil_pilganda = $database_pilganda->fetch_assoc();

$database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$tampil_pilganda[ID_KELAS]' ");
$tampil_kelas = $database_kelas->fetch_assoc();

$database_mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$tampil_pilganda[ID_MAPEL]' ");
$tampil_mapel = $database_mapel->fetch_assoc();

// $database_pilganda = $koneksi->query("SELECT * FROM tbl_topik_quiz INNER JOIN tbl_kelas ON tbl_topik_quiz.ID_KELAS = tbl_kelas.ID_KELAS INNER JOIN tbl_quiz_pilganda ON tbl_topik_quiz.ID_TOPIK_QUIZ = tbl_quiz_pilganda.ID_TOPIK_QUIZ INNER JOIN tbl_mapel ON tbl_topik_quiz.ID_MAPEL = tbl_mapel.ID_MAPEL where ID_TOPIK_QUIZ = '$ambil_perid' ");



?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dashboard Quiz Pilihan Ganda
            </h3>
            <div style=" float: right"><a href="?page=Manajemen_quiz&aksi=tambah_quiz_pilganda&id=<?php echo $tampil_pilganda['ID_TOPIK_QUIZ'] ?>" class="btn btn-primary">Tambah Soal Pilihan Ganda</a></div>
            <br><br><br>
            <h5>
                <p><label>Judul Quiz : </label> <?php echo $tampil_pilganda['JUDUL_QUIZ']; ?></p>
            </h5>
            <h5>
                <p><label>Kelas : </label> <?php echo $tampil_kelas['KELAS']; ?></p>
            </h5>
            <h5>
                <p><label>Mata Pelajaran : </label> <?php echo $tampil_mapel['MAPEL']; ?></p>
            </h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Gambar</th>
                        <th>Tanggal Buat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database = $koneksi->query("SELECT * FROM tbl_quiz_pilganda where ID_TOPIK_QUIZ = '$ambil_perid' ");

                    while ($data_topik_quiz = $database->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_topik_quiz['PERTANYAAN']; ?></td>
                            <td><?php echo $data_topik_quiz['GAMBAR']; ?></td>
                            <td><?php echo $data_topik_quiz['TGL_BUAT']; ?></td>

                            <td>
                                <a href="index.php?page=Manajemen_quiz&aksi=edit_quiz_pilganda&id=<?php echo $data_topik_quiz['ID_PILGANDA'] ?>&id_topik=<?php echo $data_topik_quiz['ID_TOPIK_QUIZ'] ?>" class="btn btn-success">Edit</a>
                                <a href="index.php?page=Manajemen_quiz&aksi=hapus_quiz_pilganda&id=<?php echo $data_topik_quiz['ID_PILGANDA'] ?>&id_topik=<?php echo $data_topik_quiz['ID_TOPIK_QUIZ'] ?>" class="btn btn-danger tombol-hapus">Hapus</a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>