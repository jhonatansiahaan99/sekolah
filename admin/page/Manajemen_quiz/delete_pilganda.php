<?php
$ambil_perid = $_GET['id'];
$ambil_id2 = $_GET['id_topik'];

// proses hapus data
$database_pilganda = $koneksi->query("select * from tbl_quiz_pilganda where ID_PILGANDA = '$ambil_perid' ");
$tampil_pilganda = $database_pilganda->fetch_assoc();


$Foto_unlink = $tampil_pilganda['GAMBAR'];
unlink("../images_soal_pilganda/$Foto_unlink");
$hapus = $koneksi->query("Delete from tbl_quiz_pilganda where ID_PILGANDA = '$ambil_perid' ");
// *proses hapus data

if ($database_pilganda) {
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
                window.location.href = "?page=Manajemen_quiz&aksi=buat_pilganda&id=<?php echo $ambil_id2 ?>";
            });
        }, 100);
    </script>
<?php
}
?>