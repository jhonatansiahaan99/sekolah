<?php


$Page = @$_GET['page'];
$Aksi = @$_GET['aksi'];


// if ($Page == "index.php") {
//     if ($Aksi == "") {
//         include "page/Profil_sekolah/dashboard_profil_sekolah.php";
//     }
// }

if ($Page == "") {
    include "Beranda.php";
}


if ($Page == "Profil_sekolah") {
    if ($Aksi == "") {
        include "page/Profil_sekolah/dashboard_profil_sekolah.php";
    }
}


if ($Page == "Fasilitas") {
    if ($Aksi == "") {
        include "page/Fasilitas/dashboard_fasilitas.php";
    }
}


if ($Page == "Contact") {
    if ($Aksi == "") {
        include "page/Contact/dashboard_contact.php";
    }
}
