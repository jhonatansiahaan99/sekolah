<?php
$ambil_perid = $_GET['id'];

$database = $koneksi->query("Delete from tbl_admin where ID_USER = '$ambil_perid' ");
// *proses hapus data

if ($database) {
?>
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                title: "Data Admin",
                text: "Berhasil DiHapus",
                type: "success",
                showConfirmButton: false,
                timer: 1000
            }, function() {
                window.location.href = "?page=Manajemen_admin";
            });
        }, 100);
    </script>
<?php
}
?>