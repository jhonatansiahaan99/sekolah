<?php


$Page = @$_GET['page'];
$Aksi = @$_GET['aksi'];


if ($Page == "") {
    include "Home.php";
}

if ($Page == "Pesan") {
    if ($Aksi == "") {
        include "page/Pesan/dashboard_pesan.php";
    }
}

if ($Page == "Manajemen_siswa") {
    if ($Aksi == "") {
        include "page/Manajemen_siswa/dashboard_manajemen_siswa.php";
    }
    if ($Aksi == "tambah") {
        include "page/Manajemen_siswa/tambah_manajemen_siswa.php";
    }
    if ($Aksi == "edit") {
        include "page/Manajemen_siswa/edit_manajemen_siswa.php";
    }
    if ($Aksi == "detail") {
        include "page/Manajemen_siswa/detail_manajemen_siswa.php";
    }
    if ($Aksi == "hapus") {
        include "page/Manajemen_siswa/delete_manajemen_siswa.php";
    }
}

if ($Page == "Manajemen_pengajar") {
    if ($Aksi == "") {
        include "page/Manajemen_pengajar/dashboard_manajemen_pengajar.php";
    }
    if ($Aksi == "tambah") {
        include "page/Manajemen_pengajar/tambah_manajemen_pengajar.php";
    }
    if ($Aksi == "edit") {
        include "page/Manajemen_pengajar/edit_manajemen_pengajar.php";
    }
    if ($Aksi == "detail") {
        include "page/Manajemen_pengajar/detail_manajemen_pengajar.php";
    }
    if ($Aksi == "hapus") {
        include "page/Manajemen_pengajar/delete_manajemen_pengajar.php";
    }
}

if ($Page == "Manajemen_kelas") {
    if ($Aksi == "") {
        include "page/Manajemen_kelas/dashboard_manajemen_kelas.php";
    }
    if ($Aksi == "tambah") {
        include "page/Manajemen_kelas/tambah_manajemen_kelas.php";
    }
    if ($Aksi == "edit") {
        include "page/Manajemen_kelas/edit_manajemen_kelas.php";
    }
    if ($Aksi == "isi_siswa") {
        include "page/Manajemen_kelas/isi_siswa.php";
    }
    if ($Aksi == "detail") {
        include "page/Manajemen_kelas/detail_manajemen_kelas.php";
    }
    if ($Aksi == "hapus") {
        include "page/Manajemen_kelas/delete_manajemen_kelas.php";
    }
}

if ($Page == "Mata_pelajaran") {
    if ($Aksi == "") {
        include "page/Mata_pelajaran/dashboard_mapel.php";
    }
    if ($Aksi == "tambah") {
        include "page/Mata_pelajaran/tambah_mapel.php";
    }
    if ($Aksi == "edit") {
        include "page/Mata_pelajaran/edit_mapel.php";
    }
    if ($Aksi == "detail") {
        include "page/Mata_pelajaran/detail_mapel.php";
    }
    if ($Aksi == "hapus") {
        include "page/Mata_pelajaran/delete_mapel.php";
    }
}


if ($Page == "Materi") {
    if ($Aksi == "") {
        include "page/Materi/dashboard_materi.php";
    }
    if ($Aksi == "tambah") {
        include "page/Materi/tambah_materi.php";
    }
    if ($Aksi == "edit") {
        include "page/Materi/edit_materi.php";
    }
    if ($Aksi == "detail") {
        include "page/Materi/detail_materi.php";
    }
    if ($Aksi == "hapus") {
        include "page/Materi/delete_materi.php";
    }
}


if ($Page == "Manajemen_admin") {
    if ($Aksi == "") {
        include "page/Manajemen_admin/dashboard_manajemen_admin.php";
    }
    if ($Aksi == "tambah") {
        include "page/Manajemen_admin/tambah_manajemen_admin.php";
    }
    if ($Aksi == "edit") {
        include "page/Manajemen_admin/edit_manajemen_admin.php";
    }
    if ($Aksi == "detail") {
        include "page/Manajemen_admin/detail_manajemen_admin.php";
    }
    if ($Aksi == "hapus") {
        include "page/Manajemen_admin/delete_manajemen_admin.php";
    }
}


if ($Page == "Manajemen_quiz") {
    if ($Aksi == "") {
        include "page/Manajemen_quiz/dashboard_manajemen_quiz.php";
    }
    if ($Aksi == "tambah") {
        include "page/Manajemen_quiz/tambah_manajemen_quiz.php";
    }
    if ($Aksi == "edit") {
        include "page/Manajemen_quiz/edit_manajemen_quiz.php";
    }
    if ($Aksi == "detail") {
        include "page/Manajemen_quiz/detail_manajemen_quiz.php";
    }
    if ($Aksi == "hapus") {
        include "page/Manajemen_quiz/delete_manajemen_quiz.php";
    }
    if ($Aksi == "buat_essay") {
        include "page/Manajemen_quiz/dashboard_essay.php";
    }
    if ($Aksi == "buat_pilganda") {
        include "page/Manajemen_quiz/dashboard_pilganda.php";
    }
    if ($Aksi == "tambah_quiz_essay") {
        include "page/Manajemen_quiz/tambah_essay.php";
    }
    if ($Aksi == "edit_quiz_essay") {
        include "page/Manajemen_quiz/edit_essay.php";
    }
    if ($Aksi == "hapus_quiz_essay") {
        include "page/Manajemen_quiz/delete_essay.php";
    }
    if ($Aksi == "tambah_quiz_pilganda") {
        include "page/Manajemen_quiz/tambah_pilganda.php";
    }
    if ($Aksi == "edit_quiz_pilganda") {
        include "page/Manajemen_quiz/edit_pilganda.php";
    }
    if ($Aksi == "hapus_quiz_pilganda") {
        include "page/Manajemen_quiz/delete_pilganda.php";
    }
    if ($Aksi == "peserta_koreksi") {
        include "page/Manajemen_quiz/dashboard_peserta&koreksi.php";
    }
    if ($Aksi == "koreksi") {
        include "page/Manajemen_quiz/koreksi.php";
    }
    if ($Aksi == "editkoreksi") {
        include "page/Manajemen_quiz/edit_koreksi.php";
    }
    if ($Aksi == "hapussiswayangtelahmengerjakan") {
        include "page/Manajemen_quiz/delete_siswa_yang_telah_mengerjakan.php";
    }
    if ($Aksi == "hasileditkoreksi") {
        include "page/Manajemen_quiz/hasileditkoreksi.php";
    }
    if ($Aksi == "hasilkoreksi") {
        include "page/Manajemen_quiz/hasilkoreksi.php";
    }
}
