<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pengajar
            </h3>
            <div style=" float: right"><a href="?page=Manajemen_pengajar&aksi=tambah" class="btn btn-primary">Tambah Pengajar</a></div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br>
            <div class='alert alert-info'>
                Guru Bisa <b>Di Non Aktifkan</b> Sementara</div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nip</th>
                        <th>Username Pengajar</th>
                        <th>Nama</th>
                        <th>Status Pengajar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database = $koneksi->query("SELECT * FROM tbl_pengajar");

                    while ($data_pengajar = $database->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_pengajar['NIP_PENGAJAR']; ?></td>
                            <td><?php echo $data_pengajar['USERNAME']; ?></td>
                            <td><?php echo $data_pengajar['NAMA_PENGAJAR']; ?></td>
                            <td><?php echo $data_pengajar['STATUS_PENGAJAR']; ?></td>
                            <td> <a href="index.php?page=Manajemen_pengajar&aksi=detail&id=<?php echo $data_pengajar['ID_PENGAJAR'] ?>" class="btn btn-warning">Profile</a>
                                <a href="index.php?page=Manajemen_pengajar&aksi=edit&id=<?php echo $data_pengajar['ID_PENGAJAR'] ?>" class="btn btn-success">Edit</a>
                                <a href="index.php?page=Manajemen_pengajar&aksi=hapus&id=<?php echo $data_pengajar['ID_PENGAJAR'] ?>" class="btn btn-danger tombol-hapus">Hapus</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>