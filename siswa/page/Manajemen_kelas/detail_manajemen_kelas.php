<?php
//*untuk mengecek data yang error/salah
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//*untuk mengecek data yang error/salah

// file edit untuk mengambil data sesuai id
$ambil_perid = $_GET['id'];

// $database_siswa_kelas = $koneksi->query("select * from tbl_siswa ORDER BY KELAS ");

// $database1 = $koneksi->query("select * from tbl_kelas where ID_KELAS = '$ambil_perid' ");
// $tampil = $database1->fetch_assoc();

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

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>