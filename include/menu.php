<?php

$Page = @$_GET['page'];

if ($Page == "") {
    $home_aktif = 'active';
}

if ($Page == "Contact") {
    $contact_aktif = 'active';
}
if ($Page == "Profil_sekolah") {
    $profil_sekolah_aktif = 'active';
}
if ($Page == "Fasilitas") {
    $fasilitas_aktif = 'active';
}
if ($Page == "Teknik_kendaraan_ringan") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $teknik_kendaraan_ringan = 'active';
}
if ($Page == "Teknik_sepeda_motor") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $teknik_sepeda_motor = 'active';
}


?>
<a href="#" class="brand-link">
    <img src="logo/logo_dharma_bakti_2.jpg" alt="SMK DHARMA BAKTI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SMK Dharma Bakti 2</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="index.php" class="nav-link <?php echo $home_aktif; ?>">
                    <i class="fas fa-home nav-icon"></i>
                    <p>BERANDA</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="?page=Profil_sekolah" class="nav-link <?php echo $profil_sekolah_aktif; ?>">
                    <i class="far fa-user nav-icon"></i>
                    <p>PROFIL SEKOLAH</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="?page=Fasilitas" class="nav-link <?php echo $fasilitas_aktif; ?>">
                    <i class="fas fa-th-large"></i>
                    <p>FASILITAS</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="?page=Contact" class="nav-link <?php echo $contact_aktif; ?>">
                    <i class="far fa-address-book"> </i>
                    <p>CONTACT</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>