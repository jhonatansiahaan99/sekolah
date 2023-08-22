<?php
$ambil_perid = $_GET['id'];

// proses hapus data
$database = $koneksi->query("select * from tbl_mapel where ID_MAPEL = '$ambil_perid' ");
$hapus = $koneksi->query("Delete from tbl_mapel where ID_MAPEL = '$ambil_perid' ");
// *proses hapus data

if ($database) {
?>
    <script type="text/javascript">
        setTimeout(function() {
            swal({
                title: "Mata Pelajaran",
                text: "Berhasil DiHapus",
                type: "success",
                showConfirmButton: false,
                timer: 1000
            }, function() {
                window.location.href = "?page=Mata_pelajaran";
            });
        }, 100);
    </script>
<?php
}
?>