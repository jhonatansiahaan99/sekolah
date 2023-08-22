<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kelas Yang Anda Ampu
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Wali Kelas</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    // $database = $koneksi->query("SELECT * FROM tbl_kelas INNER JOIN tbl_pengajar ON tbl_kelas.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR where USERNAME = '$_SESSION[PENGAJAR]' ");

                    $database = $koneksi->query("SELECT * FROM tbl_kelas,tbl_pengajar where tbl_kelas.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR and tbl_kelas.STATUS_KELAS='Aktif' and USERNAME = '$_SESSION[PENGAJAR]' ");

                    while ($data_kelas = $database->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_kelas['KELAS']; ?></td>
                            <td><?php echo $data_kelas['NAMA_PENGAJAR']; ?></td>

                            <td>
                                <a href="index.php?page=Manajemen_kelas&aksi=detail&id=<?php echo $data_kelas['ID_KELAS'] ?>" class="btn btn-primary">Lihat Siswa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>