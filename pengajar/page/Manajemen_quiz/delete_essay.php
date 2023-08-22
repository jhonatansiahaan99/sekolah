<?php
$ambil_perid = $_GET['id'];
$ambil_id2 = $_GET['id_topik'];

// proses hapus data
$database_essay = $koneksi->query("select * from tbl_quiz_essay where ID_ESSAY = '$ambil_perid' ");
$tampil_essay = $database_essay->fetch_assoc();


$Foto_unlink = $tampil_essay['GAMBAR'];
unlink("../images_soal_essay/$Foto_unlink");
$hapus = $koneksi->query("Delete from tbl_quiz_essay where ID_ESSAY = '$ambil_perid' ");
// *proses hapus data
?>



<script type="text/javascript">
    setTimeout(function() {
        swal({
            title: "Soal Pilihan Ganda",
            text: "Berhasil DiHapus",
            type: "success",
            showConfirmButton: false,
            timer: 1000
        }, function() {
            window.location.href = "?page=Manajemen_quiz&aksi=buat_essay&id=<?php echo $ambil_id2 ?>";
        });
    }, 100);
</script>