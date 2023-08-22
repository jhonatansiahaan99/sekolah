<?php


$Page = @$_GET['page'];
$Aksi = @$_GET['aksi'];


if ($Page == "") {
    include "Home.php";
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
    if ($Aksi == "detail") {
        include "page/Manajemen_kelas/detail_manajemen_kelas.php";
    }
    if ($Aksi == "hapus") {
        include "page/Manajemen_kelas/delete_manajemen_kelas.php";
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
    if ($Aksi == "infokerjakan") {
        include "page/Manajemen_quiz/info_kerjakan.php";
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
}



if ($Page == "Nilai") {
    if ($Aksi == "") {
        include "page/Nilai/dashboard_nilai.php";
    }
    if ($Aksi == "daftarnilai") {
        include "page/Nilai/daftar_nilai.php";
    }
    if ($Aksi == "nilaisiswa") {
        include "page/Nilai/nilai_siswa.php";
    }
}

if ($Page == "Profil_user") {
    if ($Aksi == "") {
        include "page/Profil_user/profil_user.php";
    }
    if ($Aksi == "edit") {
        include "page/Profil_user/edit_profil.php";
    }
}
