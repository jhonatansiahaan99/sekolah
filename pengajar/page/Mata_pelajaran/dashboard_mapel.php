<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mata Pelajaran Yang Anda Ajar
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Pengajar</th>
                        <th>Deskripsi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    // $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel INNER JOIN tbl_kelas ON tbl_mapel.ID_KELAS=tbl_kelas.ID_KELAS INNER JOIN tbl_pengajar ON tbl_mapel.ID_PENGAJAR=tbl_pengajar.ID_PENGAJAR where USERNAME='$_SESSION[PENGAJAR]' ");

                    $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel,tbl_kelas,tbl_pengajar where tbl_mapel.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR and tbl_mapel.ID_KELAS = tbl_kelas.ID_KELAS and tbl_mapel.STATUS_MAPEL='Aktif' and USERNAME = '$_SESSION[PENGAJAR]' ");

                    while ($data_mapel = $database_mapel->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_mapel['MAPEL']; ?></td>
                            <td><?php echo $data_mapel['KELAS']; ?></td>
                            <td><?php echo $data_mapel['NAMA_PENGAJAR']; ?></td>
                            <td><?php echo $data_mapel['DESKRIPSI']; ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>