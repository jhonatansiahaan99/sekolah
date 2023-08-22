<?php
$ambil_perid = $_GET['id'];

// proses hapus data
$database = $koneksi->query("DELETE from tbl_topik_quiz where ID_TOPIK_QUIZ = '$ambil_perid' ");


//nampilkan data gambar lalu dihapus
$database2 = $koneksi->query("select * from tbl_quiz_essay where ID_TOPIK_QUIZ = '$ambil_perid' ");
$tampil2 = $database2->fetch_assoc();
$File_unlink2 = $tampil2['GAMBAR'];
unlink("../images_soal_essay/$File_unlink2");
//hapus quiz essay
$hapus_quiz_essay = $koneksi->query("Delete from tbl_quiz_essay where ID_TOPIK_QUIZ = '$ambil_perid' ");


//nampilkan data gambar lalu dihapus
$database3 = $koneksi->query("select * from tbl_quiz_pilganda where ID_TOPIK_QUIZ = '$ambil_perid' ");
$tampil3 = $database3->fetch_assoc();
$File_unlink3 = $tampil3['GAMBAR'];
unlink("../images_soal_pilganda/$File_unlink3");
//hapus quiz pilganda
$hapus_quiz_pilganda = $koneksi->query("Delete from tbl_quiz_pilganda where ID_TOPIK_QUIZ = '$ambil_perid' ");


// *proses hapus data

if ($database) {
?>
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                title: "Topik Quiz",
                text: "Berhasil DiHapus",
                type: "success",
                showConfirmButton: false,
                timer: 1000
            }, function() {
                window.location.href = "?page=Manajemen_quiz";
            });
        }, 100);
    </script>
<?php
}
?>