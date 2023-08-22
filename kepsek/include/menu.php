<?php

$Page = @$_GET['page'];

if ($Page == "") {
    $home_aktif = 'active';
}
if ($Page == "Pesan") {
    $pesan_aktif = 'active';
}

if ($Page == "Manajemen_siswa") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $manajemen_siswa_aktif = 'active';
}
if ($Page == "Manajemen_pengajar") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $manajemen_pengajar_aktif = 'active';
}
if ($Page == "Manajemen_kelas") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $manajemen_kelas_aktif = 'active';
}
if ($Page == "Mata_pelajaran") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $mata_pelajaran_aktif = 'active';
}
if ($Page == "Materi") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $materi_aktif = 'active';
}
if ($Page == "Manajemen_quiz") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $manajemen_quiz_aktif = 'active';
}
if ($Page == "Manajemen_admin") {
    $masteraktif1 = 'menu-open';
    $masteraktif2 = 'active';
    $manajemen_admin_aktif = 'active';
}


?>
<a href="index.php" class="brand-link">
    <img src="../logo/logo_dharma_bakti_2.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SMK Dharma Bakti 2</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <?php
            $database1 = $koneksi->query("SELECT * FROM tbl_admin where USERNAME = '$_SESSION[KEPSEK]' ");


            $tampil1 = $database1->fetch_assoc();
            ?>
            <a href="#" class="d-block"><?php echo $tampil1['NAMA_LENGKAP']; ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="index.php" class="nav-link <?php echo $home_aktif; ?>">
                    <i class="fas fa-home nav-icon"></i>
                    <p>Home</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="?page=Pesan" class="nav-link <?php echo $pesan_aktif; ?>">
                    <i class="far fa-envelope"></i>
                    <p>Pesan</p>
                </a>
            </li>

            <li class="nav-item has-treeview <?php echo $masteraktif1 ?>">
                <a href="#" class="nav-link <?php echo $masteraktif2 ?>">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        Manajemen Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="?page=Manajemen_siswa" class="nav-link <?php echo $manajemen_siswa_aktif ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manajemen Siswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=Manajemen_pengajar" class="nav-link <?php echo $manajemen_pengajar_aktif ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manajemen Pengajar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=Manajemen_kelas" class="nav-link <?php echo $manajemen_kelas_aktif ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manajemen Kelas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=Mata_pelajaran" class="nav-link <?php echo $mata_pelajaran_aktif ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mata Pelajaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=Materi" class="nav-link <?php echo $materi_aktif ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Materi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=Manajemen_quiz" class="nav-link <?php echo $manajemen_quiz_aktif ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manajemen Quiz</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="?page=Manajemen_admin" class="nav-link <?php echo $manajemen_admin_aktif ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manajemen Admin</p>
                        </a>
                    </li>

                </ul>
            </li>



        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>