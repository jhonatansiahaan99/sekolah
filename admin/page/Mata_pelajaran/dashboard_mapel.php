<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mata Pelajaran
            </h3>
            <div style=" float: right"><a href="?page=Mata_pelajaran&aksi=tambah" class="btn btn-primary">Tambah Mata Pelajaran</a></div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br>
            <div class='alert alert-info'>
                1. Jika Mata Pelajaran Tidak Aktif Maka Admin <b>Menghubungi Kepala Sekolah Untuk Meminta Konfirmasi Aktif Mata Pelajaran</b>
                <br>
                2. Mata Pelajaran Dapat Di Gunakan Ketika Status Mata Pelajaran Aktif

            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Pengajar</th>
                        <th>Deskripsi</th>
                        <th>Status Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel INNER JOIN tbl_kelas ON tbl_mapel.ID_KELAS=tbl_kelas.ID_KELAS INNER JOIN tbl_pengajar ON tbl_mapel.ID_PENGAJAR=tbl_pengajar.ID_PENGAJAR ");

                    while ($data_mapel = $database_mapel->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_mapel['MAPEL']; ?></td>
                            <td><?php echo $data_mapel['KELAS']; ?></td>
                            <td><?php echo $data_mapel['NAMA_PENGAJAR']; ?></td>
                            <td><?php echo $data_mapel['DESKRIPSI']; ?></td>
                            <td><?php echo $data_mapel['STATUS_MAPEL']; ?></td>
                            <td>
                                <a href="index.php?page=Mata_pelajaran&aksi=edit&id=<?php echo $data_mapel['ID_MAPEL'] ?>" class="btn btn-success">Edit</a>
                                <a href="index.php?page=Mata_pelajaran&aksi=hapus&id=<?php echo $data_mapel['ID_MAPEL'] ?>" class="btn btn-danger tombol-hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>