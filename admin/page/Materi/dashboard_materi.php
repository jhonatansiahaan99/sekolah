<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manajemen Materi
            </h3>
            <div style=" float: right"><a href="?page=Materi&aksi=tambah" class="btn btn-primary">Tambah Materi</a></div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Materi</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>File</th>
                        <th>Pengajar</th>
                        <th>Tanggal Posting</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database = $koneksi->query("SELECT * FROM tbl_materi INNER JOIN tbl_pengajar ON tbl_materi.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR INNER JOIN tbl_kelas ON tbl_materi.ID_KELAS = tbl_kelas.ID_KELAS INNER JOIN tbl_mapel ON tbl_materi.ID_MAPEL = tbl_mapel.ID_MAPEL");

                    while ($data_materi = $database->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_materi['JUDUL_MATERI']; ?></td>
                            <td><?php echo $data_materi['KELAS']; ?></td>
                            <td><?php echo $data_materi['MAPEL']; ?></td>
                            <td><?php echo $data_materi['FILE']; ?></td>
                            <td><?php echo $data_materi['NAMA_PENGAJAR']; ?></td>
                            <td><?php echo $data_materi['TGL_POSTING']; ?></td>

                            <td>
                                <a href="index.php?page=Materi&aksi=edit&id=<?php echo $data_materi['ID_MATERI'] ?>" class="btn btn-success">Edit</a>
                                <a href="index.php?page=Materi&aksi=hapus&id=<?php echo $data_materi['ID_MATERI'] ?>" class="btn btn-danger tombol-hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>