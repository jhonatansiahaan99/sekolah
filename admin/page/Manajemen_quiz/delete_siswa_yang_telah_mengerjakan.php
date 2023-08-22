<?php
$ambil_perid = $_GET['id'];
$ambil_id_siswa = $_GET['id_siswa'];

$ambil_id_topik_quiz = $_GET['id_topik_quiz'];

$hapus_nilai_soal_essay = $koneksi->query("Delete from tbl_nilai_soal_essay where ID_TOPIK_QUIZ = '$ambil_id_topik_quiz' AND ID_SISWA = '$ambil_id_siswa' ");

$hapus_nilai = $koneksi->query("Delete from tbl_nilai where ID_TOPIK_QUIZ = '$ambil_id_topik_quiz' AND ID_SISWA = '$ambil_id_siswa' ");

$hapus_jawaban = $koneksi->query("Delete from tbl_jawaban where ID_TOPIK_QUIZ = '$ambil_id_topik_quiz' AND ID_SISWA = '$ambil_id_siswa' ");


$hapus_siswa_sudah_mengerjakan = $koneksi->query("Delete from siswa_sudah_mengerjakan where ID_SISWA = '$ambil_id_siswa' AND ID = '$ambil_perid' ");

if ($hapus_siswa_sudah_mengerjakan) {
?>
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                title: "Data Siswa Yang Mengerjakan",
                text: "Berhasil DiHapus",
                type: "success",
                showConfirmButton: false,
                timer: 1000
            }, function() {
                window.location.href = "?page=Manajemen_quiz&aksi=peserta_koreksi&id=<?php echo $ambil_id_topik_quiz ?>";
            });
        }, 100);
    </script>
<?php
}
?>