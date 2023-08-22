<?php
$ambil_perid = $_GET['id'];

// proses hapus data
$database = $koneksi->query("select * from tbl_kelas where ID_KELAS = '$ambil_perid' ");
$hapus = $koneksi->query("Delete from tbl_kelas where ID_KELAS = '$ambil_perid' ");
// *proses hapus data

if ($database) {
?>
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                title: "KELAS",
                text: "Berhasil DiHapus",
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
?>