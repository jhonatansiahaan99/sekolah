<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kelas Kamu
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

                    $database_kelas = $koneksi->query("SELECT * FROM tbl_siswa,tbl_kelas,tbl_pengajar where tbl_siswa.ID_KELAS = tbl_kelas.ID_KELAS and tbl_kelas.ID_PENGAJAR = tbl_pengajar.ID_PENGAJAR and tbl_kelas.STATUS_KELAS='Aktif' and ID_SISWA = '$_SESSION[ID_SISWA]' ");

                    // $siswa = $koneksi->query("SELECT * FROM tbl_siswa where ID_SISWA = '$_SESSION[ID_SISWA]' ");
                    // $tampil_siswa = $siswa->fetch_assoc();

                    // $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$tampil_siswa[ID_KELAS]' ");


                    while ($data_kelas = $database_kelas->fetch_assoc()) {
                        // $pengajar = $koneksi->query("SELECT * FROM tbl_pengajar where ID_PENGAJAR = '$data_kelas[ID_PENGAJAR]' ");

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_kelas['KELAS']; ?></td>
                            <?php

                            // while ($data_pengajar = $pengajar->fetch_assoc()) { 

                            ?>
                            <td><?php echo $data_kelas['NAMA_PENGAJAR']; ?></td>
                            <?php

                            // } 

                            ?>
                            <td>
                                <a href="index.php?page=Manajemen_kelas&aksi=detail&id=<?php echo $data_kelas['ID_KELAS'] ?>" class="btn btn-primary">Lihat Teman</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>