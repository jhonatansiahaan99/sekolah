<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mata Pelajaran Di Kelas Anda
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
                    $database_mapel = $koneksi->query("SELECT * FROM tbl_siswa,tbl_kelas,tbl_pengajar,tbl_mapel where tbl_siswa.ID_KELAS = tbl_kelas.ID_KELAS and tbl_kelas.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR and tbl_mapel.ID_KELAS = tbl_kelas.ID_KELAS and tbl_mapel.STATUS_MAPEL='Aktif' and ID_SISWA = '$_SESSION[ID_SISWA]' ");


                    // $siswa = $koneksi->query("SELECT * FROM tbl_siswa where ID_SISWA = '$_SESSION[ID_SISWA]' ");
                    // $tampil_siswa = $siswa->fetch_assoc();

                    // $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_KELAS='$tampil_siswa[ID_KELAS]' ");


                    while ($data_mapel = $database_mapel->fetch_assoc()) {
                        // $pengajar = $koneksi->query("SELECT * FROM tbl_pengajar where ID_PENGAJAR = '$data_mapel[ID_PENGAJAR]' ");
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