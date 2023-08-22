<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah

// file edit untuk mengambil data sesuai id
$ambil_perid = $_GET['id'];

$database1 = $koneksi->query("select * from tbl_kelas where ID_KELAS = '$ambil_perid' ");
$tampil = $database1->fetch_assoc();
// $database_siswa_kelas = $koneksi->query("select * from tbl_siswa ORDER BY KELAS ");

// $database1 = $koneksi->query("select * from tbl_kelas where ID_KELAS = '$ambil_perid' ");
// $tampil = $database1->fetch_assoc();

$Id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);

$Status_kelas = mysqli_real_escape_string($koneksi, $_POST['status_kelas']);

if (isset($_POST['simpan'])) {

    $database2 = $koneksi->query("update tbl_kelas set STATUS_KELAS='$Status_kelas' where ID_KELAS = '$Id_kelas' ");

    if ($database2) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Kelas",
                    text: "Berhasil DiUpdate",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000
                }, function() {
                    window.location.href = "?page=Manajemen_kelas";
                });
            }, 100);
        </script>
<?php

    }
}
?>




<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Kelas
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Status Siswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $database_siswa = $koneksi->query("SELECT * FROM tbl_siswa where ID_KELAS = '$ambil_perid' ORDER BY NAMA_SISWA ");
                    // $tampil_siswa = $database_siswa->fetch_assoc();

                    while ($data_siswa = $database_siswa->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_siswa['NIS']; ?></td>
                            <td><?php echo $data_siswa['NAMA_SISWA']; ?></td>
                            <?php
                            $database_kelas = $koneksi->query("SELECT * FROM tbl_kelas where ID_KELAS = '$data_siswa[ID_KELAS]' ");

                            while ($data_kelas = $database_kelas->fetch_assoc()) { ?>
                                <td><?php echo $data_kelas['KELAS']; ?></td>
                            <?php
                            }

                            ?>

                            <td><?php echo $data_siswa['JENKEL']; ?></td>
                            <td><?php echo $data_siswa['STATUS_PENGGUNA']; ?></td>
                            <td>
                                <a href="index.php?page=Manajemen_siswa&aksi=detail&id=<?php echo $data_siswa['NIS'] ?>" class="btn btn-warning">Profile</a>
                                <a href="index.php?page=Manajemen_siswa&aksi=edit&id=<?php echo $data_siswa['NIS'] ?>" class="btn btn-success">Edit</a>
                                <a href="index.php?page=Manajemen_kelas&aksi=hapus&id=<?php echo $data_siswa['ID_KELAS'] ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <form method="POST">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_kelas" value="<?php echo $tampil['ID_KELAS']; ?>" required>
                    <label for="exampleInputFile">Status Kelas</label>
                    <div class="form-check">
                        <input name="status_kelas" type="radio" id="radio_1" value="Aktif" <?php if ($tampil['STATUS_KELAS'] == 'Aktif') echo 'checked' ?> />
                        <label class="form-check-label">Aktif</label>

                    </div>
                    <div class="form-check">
                        <input name="status_kelas" type="radio" id="radio_2" value="Tidak Aktif" <?php if ($tampil['STATUS_KELAS'] == 'Tidak Aktif') echo 'checked' ?> />
                        <label class="form-check-label">Tidak Aktif</label>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success">

                </div>
            </form>
        </div>
    </div>
</div>