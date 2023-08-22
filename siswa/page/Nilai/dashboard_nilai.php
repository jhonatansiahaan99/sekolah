<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lihat Nilai
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $siswa = $koneksi->query("SELECT * FROM tbl_siswa where ID_SISWA = '$_SESSION[ID_SISWA]' ");
                    $tampil_siswa = $siswa->fetch_assoc();

                    $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_KELAS = '$tampil_siswa[ID_KELAS]' ");

                    while ($data_mapel = $database_mapel->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_mapel['MAPEL']; ?></td>
                            <td>
                                <a href="index.php?page=Nilai&aksi=daftarnilai&id=<?php echo $data_mapel['ID_MAPEL'] ?>&id_kelas=<?php echo $tampil_siswa['ID_KELAS'] ?>" class="btn btn-primary">Lihat Nilai</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>