<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Admin
            </h3>
            <div style=" float: right"><a href="?page=Manajemen_admin&aksi=tambah" class="btn btn-primary">Tambah Admin</a></div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telp/Hp</th>
                        <th>STATUS USER</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database = $koneksi->query("SELECT * FROM tbl_admin WHERE USER_LEVEL='ADMIN' ");

                    while ($data_siswa = $database->fetch_assoc()) {

                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_siswa['USERNAME']; ?></td>
                            <td><?php echo $data_siswa['NAMA_LENGKAP']; ?></td>
                            <td><?php echo $data_siswa['ALAMAT']; ?></td>
                            <td><?php echo $data_siswa['EMAIL']; ?></td>
                            <td><?php echo $data_siswa['TELP']; ?></td>
                            <td><?php echo $data_siswa['STATUS_USER']; ?></td>

                            <td>

                                <a href="index.php?page=Manajemen_admin&aksi=edit&id=<?php echo $data_siswa['ID_USER'] ?>" class="btn btn-success">Edit</a>
                                <a href="index.php?page=Manajemen_admin&aksi=hapus&id=<?php echo $data_siswa['ID_USER'] ?>" class="btn btn-danger tombol-hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>