<?php
$ambil_perid = $_GET['id'];



$database1 = $koneksi->query("select * from tbl_pengajar where ID_PENGAJAR = '$ambil_perid' ");
$tampil1 = $database1->fetch_assoc();

$mapel = $koneksi->query("select * from tbl_mapel where ID_PENGAJAR = '$ambil_perid' ");
$mapel1 = $mapel->fetch_assoc();



?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../images/<?php echo $tampil1['FOTO']; ?>" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center"><?php echo $tampil1['NAMA_PENGAJAR']; ?></h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Tempat Lahir</b> <a class="float-right"> <?php echo $tampil1['TEMPAT_LAHIR']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl Lahir</b> <a class="float-right"> <?php echo $tampil1['TGL_LAHIR']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Agama</b> <a class="float-right"> <?php echo $tampil1['AGAMA']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>E-mail</b> <a class="float-right"> <?php echo $tampil1['EMAIL']; ?></a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">


                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                    <p class="text-muted"><?php echo $tampil1['ALAMAT']; ?></p>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail Profil</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nip Pengajar</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" value="<?php echo $tampil1['NIP_PENGAJAR']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" value="<?php echo $tampil1['USERNAME']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" value="<?php echo $tampil1['PASSWORD']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">No. Telp</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" value="<?php echo $tampil1['TELP_PENGAJAR']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" value="<?php echo $tampil1['JENKEL']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Status Pengguna</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" value="<?php echo $tampil1['STATUS_PENGAJAR']; ?>" style="background-color:#e7e3e9;" readonly>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->