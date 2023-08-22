<?php
$ambil_perid = $_GET['id'];

// proses hapus data
$database = $koneksi->query("select * from tbl_siswa where NIS = '$ambil_perid' ");
$tampil = $database->fetch_assoc();
$Foto_unlink = $tampil['FOTO'];
unlink("../images/$Foto_unlink");
$hapus = $koneksi->query("Delete from tbl_siswa where NIS = '$ambil_perid' ");
// *proses hapus data

if ($database) {
?>
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                title: "Data Siswa",
                text: "Berhasil DiHapus",
                type: "success",
                showConfirmButton: false,
                timer: 1000
            }, function() {
                window.location.href = "?page=Manajemen_siswa";
            });
        }, 100);
    </script>
<?php
}
?>