<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manajemen Kelas
            </h3>
            <div style=" float: right"><a href="?page=Manajemen_kelas&aksi=tambah" class="btn btn-primary">Tambah Kelas</a></div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br>
            <div class='alert alert-info'>
                1. Jika Kelas Tidak Aktif Maka Admin <b>Menghubungi Kepala Sekolah Untuk Meminta Konfirmasi Aktif Kelas</b>
                <br>
                2. Kelas Dapat Di Gunakan Ketika Status Kelas Aktif

            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Status Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database = $koneksi->query("SELECT * FROM tbl_kelas INNER JOIN tbl_pengajar ON tbl_kelas.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR");

                    while ($data_kelas = $database->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_kelas['KELAS']; ?></td>
                            <td><?php echo $data_kelas['NAMA_PENGAJAR']; ?></td>
                            <td><?php echo $data_kelas['STATUS_KELAS']; ?></td>
                            <td>
                                <a href="index.php?page=Manajemen_kelas&aksi=detail&id=<?php echo $data_kelas['ID_KELAS'] ?>" class="btn btn-warning">Detail Kelas</a>
                                <a href="index.php?page=Manajemen_kelas&aksi=edit&id=<?php echo $data_kelas['ID_KELAS'] ?>" class="btn btn-success">Edit Kelas</a>
                                <a href="index.php?page=Manajemen_kelas&aksi=isi_siswa&id=<?php echo $data_kelas['ID_KELAS'] ?>" class="btn btn-primary">Isi Siswa</a>
                                <a href="index.php?page=Manajemen_kelas&aksi=hapus&id=<?php echo $data_kelas['ID_KELAS'] ?>" class="btn btn-danger tombol-hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>