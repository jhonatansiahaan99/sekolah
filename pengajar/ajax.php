<?php
$koneksi = mysqli_connect("localhost", "root", "amerika1999", "db_e-learning") or die("KONEKSI GAGAL TERHUBUNG");

// $Ajax_kelas = $_POST["ajax_kelas"];
$Ajax_kelas = $_POST['kelasajax'];
$Ajax_mapel = $_POST['mapelajax'];
// print_r($_POST);



if (isset($_POST['kelasajax']) && !empty($_POST['kelasajax'])) {
    $database_mapel = $koneksi->query("SELECT * FROM tbl_mapel where ID_KELAS ='$Ajax_kelas'") or die(mysqli_error($koneksi));

    $jumlah = $database_mapel->num_rows;

    if ($jumlah > 0) {
        // var_dump($jumlah); //cara melihat kesalahan 


        while ($tampil_data_mapel = $database_mapel->fetch_assoc()) {
            echo '<option value="' . $tampil_data_mapel['ID_MAPEL'] . '" >' . $tampil_data_mapel['MAPEL'] . '</option>';
        }
    } else {
        echo 'Guru Tidak Tersedia';
    }
}



// if (isset($_POST['mapelajax']) && !empty($_POST['mapelajax'])) {
//     $database_pengajar = $koneksi->query("SELECT * FROM tbl_mapel INNER JOIN tbl_pengajar ON tbl_mapel.NIP_PENGAJAR=tbl_pengajar.NIP_PENGAJAR where ID_KELAS ='$Ajax_mapel'") or die(mysqli_error($koneksi));

//     $jumlah = $database_pengajar->num_rows;

//     if ($jumlah > 0) {
//         // var_dump($jumlah); //cara melihat kesalahan 


//         while ($tampil_data_pengajar = $database_pengajar->fetch_assoc()) {
//             echo '<label value="' . $tampil_data_pengajar['NIP_PENGAJAR'] . '">' . $tampil_data_pengajar['NAMA_PENGAJAR'] . '</label>';
//         }
//     } else {
//         echo '<option value="">- Mata Pelajaran Belum Tersedia -</option>';
//     }
// }
