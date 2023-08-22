<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Materi
            </h3>

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

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $siswa = $koneksi->query("SELECT * FROM tbl_siswa where ID_SISWA = '$_SESSION[ID_SISWA]' ");
                    $tampil_siswa = $siswa->fetch_assoc();

                    $database_materi = $koneksi->query("SELECT * FROM tbl_materi where ID_KELAS='$tampil_siswa[ID_KELAS]' ");



                    while ($data_materi = $database_materi->fetch_assoc()) {
                        $pengajar = $koneksi->query("SELECT * FROM tbl_pengajar where ID_PENGAJAR = '$data_materi[ID_PENGAJAR]' ");
                        $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$data_materi[ID_KELAS]' ");

                        $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_MAPEL = '$data_materi[ID_MAPEL]' ");
                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_materi['JUDUL_MATERI']; ?></td>
                            <?php while ($data_kelas = $database_kelas->fetch_assoc()) { ?>
                                <td><?php echo $data_kelas['KELAS']; ?></td>
                            <?php } ?>

                            <?php while ($data_mapel = $database_mapel->fetch_assoc()) { ?>
                                <td><?php echo $data_mapel['MAPEL']; ?></td>
                            <?php } ?>

                            <td><?php echo $data_materi['FILE']; ?><a href="../dokumen/<?php echo $data_materi['FILE']; ?>" class="btn btn-success">DOWNLOAD</a></td>

                            <?php while ($data_pengajar = $pengajar->fetch_assoc()) { ?>
                                <td><?php echo $data_pengajar['NAMA_PENGAJAR']; ?></td>
                            <?php } ?>
                            <td><?php echo $data_materi['TGL_POSTING']; ?></td>


                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>