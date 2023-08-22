<?php
$ambil_perid = $_GET['id'];

// proses hapus data
$database = $koneksi->query("select * from tbl_materi where ID_MATERI = '$ambil_perid' ");
$tampil = $database->fetch_assoc();
$File_unlink = $tampil['FILE'];
unlink("../dokumen/$File_unlink");

$hapus = $koneksi->query("Delete from tbl_materi where ID_MATERI = '$ambil_perid' ");
// *proses hapus data

if ($database) {
?>
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                title: "Materi",
                text: "Berhasil DiHapus",
                type: "success",
                showConfirmButton: false,
                timer: 1000
            }, function() {
                window.location.href = "?page=Materi";
            });
        }, 100);
    </script>
<?php
}
?>