<?php
$cek = $koneksi->query("SELECT * FROM siswa_sudah_mengerjakan where ID_TOPIK_QUIZ = '$_GET[id]' AND ID_SISWA = '$_SESSION[ID_SISWA]' ");
$tampil_cek = $cek->fetch_assoc();


if ($tampil_cek['HITS'] <= 0) {
    $topik = $koneksi->query("SELECT * FROM tbl_topik_quiz where ID_TOPIK_QUIZ = '$_GET[id]' ");
    $tampil_topik = $topik->fetch_assoc();
?>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary">
                    Informasi
                </div>
                <div class="card-body">
                    <br>
                    <form method="POST" action="soal.php" target="_blank">
                        <input type="hidden" name="waktu_pengerjaan" value="<?php echo $tampil_topik['WAKTU_PENGERJAAN']; ?>">
                        <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
                        <h3>Baca dengan seksama dan teliti sebelum mengerjakan Tugas / Ujian<p class='garisbawah'></p><b>
                                1. Pastikan koneksi anda terjamin dan bagus, misalnya Warnet.<br>
                                2. Jika menggunakan Modem, pastikan menggunakan operator yang handal.<br>
                                3. Pilih browser yang suport dengan Elearning SMK DHARMA BAKTI 2 MEDAN yaitu Mozilla Firefox.<br>
                                4. Jika mati lampu hubungi Pengajar Mata Pelajaran terkait untuk bisa Ujian Kembali.</h3><br>
                        <p class='garisbawah'></p>
                        <input type="submit" class="btn btn-danger" value='Mulai Mengerjakan' onclick="window.location.reload()">
                        <!-- <a type="submit" href="soal.php" value="Mulai Mengerjakan" target="_blank" class="btn btn-danger" onclick="window.location.reload()">Mulai Mengerjakan</a> -->
                        <input type="button" class="btn btn-primary" value='Kembali' onclick=self.history.back()>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php
} elseif ($tampil_cek['HITS'] >= 1) {
?>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary">
                    Informasi
                </div>
                <div class="card-body">
                    <div class='alert alert-warning alert-dismissable'>
                        <h4> <i class='icon fa fa-check'></i> Pengumuman</h4>
                        Anda Sudah mengerjakan tugas / Quiz ini
                    </div>
                    <input type="button" class="btn btn-primary" value='Kembali' onclick=self.history.back()>
                </div>
            </div>

        </div>
    </div>



<?php
}
?>

<script type="text/javascript">
    function reloadpage() {
        location.reload()
    }
</script>