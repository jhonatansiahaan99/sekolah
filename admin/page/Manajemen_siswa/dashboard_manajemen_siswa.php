<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Siswa
            </h3>
            <div style=" float: right"><a href="?page=Manajemen_siswa&aksi=tambah" class="btn btn-primary">Tambah Siswa</a></div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br>
            <div class='alert alert-info'>
                Siswa Bisa <b>Di Non Aktifkan</b> Sementara</div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama Siswa</th>

                        <th>Jenis Kelamin</th>
                        <th>Status Pengguna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database = $koneksi->query("SELECT * FROM tbl_siswa  ");

                    while ($data_siswa = $database->fetch_assoc()) {

                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_siswa['NIS']; ?></td>
                            <td><?php echo $data_siswa['NAMA_SISWA']; ?></td>

                            <td><?php echo $data_siswa['JENKEL']; ?></td>
                            <td><?php echo $data_siswa['STATUS_PENGGUNA']; ?></td>

                            <td>
                                <a href="index.php?page=Manajemen_siswa&aksi=detail&id=<?php echo $data_siswa['NIS'] ?>" class="btn btn-warning">Profile</a>
                                <a href="index.php?page=Manajemen_siswa&aksi=edit&id=<?php echo $data_siswa['NIS'] ?>" class="btn btn-success">Edit</a>
                                <a href="index.php?page=Manajemen_siswa&aksi=hapus&id=<?php echo $data_siswa['NIS'] ?>" class="btn btn-danger tombol-hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>