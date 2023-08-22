<?php

if (isset($_POST['simpan'])) {
    $Kelas = $_GET['id'];
    $Siswa = $_POST['pilih'];
    $Jumlah_dipilih = count($Siswa);

    for ($i = 0; $i < $Jumlah_dipilih; $i++) {
        $pilih_siswa = $koneksi->query("update tbl_siswa set ID_KELAS='$Kelas' where ID_SISWA = '$Siswa[$i]' ");

        $status_kelas = $koneksi->query("update tbl_kelas set STATUS_KELAS='Tidak Aktif' where ID_KELAS = '$Kelas' ");

        if ($pilih_siswa) { ?>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Data Kelas",
                        text: "Berhasil Tambahkan",
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
}
?>



<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Siswa
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br>
            <div class='alert alert-info'>
                <b>Pilih Siswa</b> Yang Ingin Dimasukkan Ke Dalam Kelas Ini</div>
            <form method="post">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama Siswa</th>

                            <th>Jenis Kelamin</th>
                            <th>Status Pengguna</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $database = $koneksi->query("SELECT * FROM tbl_siswa  ");
                        while ($data_siswa = $database->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data_siswa['NIS']; ?></td>
                                <td><?php echo $data_siswa['NAMA_SISWA']; ?></td>
                                <td><?php echo $data_siswa['JENKEL']; ?></td>
                                <td><?php echo $data_siswa['STATUS_PENGGUNA']; ?></td>

                                <td>

                                    <div class="form-check">
                                        <input name="pilih[]" class="form-check-input" type="checkbox" value="<?php echo $data_siswa['ID_SISWA'] ?>">
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                <input type="button" value="Batal" onclick=self.history.back() class="btn btn-primary">

            </form>


        </div>
    </div>
</div>