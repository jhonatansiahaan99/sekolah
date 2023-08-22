<?php

$quiz_pilganda = $koneksi->query("SELECT * FROM tbl_quiz_pilganda where ID_TOPIK_QUIZ = '$_GET[id_topik]' ");
$c_pilganda = $quiz_pilganda->num_rows;

$quiz_esay = $koneksi->query("SELECT * FROM tbl_quiz_essay where ID_TOPIK_QUIZ = '$_GET[id_topik]' ");
$c_esay = $quiz_esay->num_rows;




if (!empty($c_pilganda) and !empty($c_esay)) {
    $pilganda = $koneksi->query("SELECT * FROM tbl_nilai WHERE ID_TOPIK_QUIZ = '$_GET[id_topik]' AND ID_SISWA = '$_SESSION[ID_SISWA]'");
    $cek_pilganda = $pilganda->num_rows;

    $esay = $koneksi->query("SELECT * FROM tbl_nilai_soal_essay WHERE ID_TOPIK_QUIZ = '$_GET[id_topik]' AND ID_SISWA = '$_SESSION[ID_SISWA]'");
    $cek_esay = $esay->num_rows;

    if (!empty($cek_pilganda) and !empty($cek_esay)) {
?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">NILAI ANDA</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Deskripsi Tugas/Quiz</th>
                                <th>Nilai</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $n_pilganda = $pilganda->fetch_assoc();
                            $n_esay = $esay->fetch_assoc();

                            ?>
                            <tr>
                                <td>Tugas Pilihan Ganda</td>
                                <td><?php echo $n_pilganda['PERSENTASE']; ?></td>
                            </tr>
                            <tr>
                                <td>Tugas Essay</td>
                                <td><?php echo $n_esay['NILAI']; ?></td>
                            </tr>
                        </tbody>

                    </table>
                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->






        <div class="col-12">
            <div class="card">
                <div class="card-header">

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $no = 1;
                            $tam = $koneksi->query("SELECT PERTANYAAN,KUNCI FROM tbl_quiz_pilganda WHERE ID_TOPIK_QUIZ='$_GET[id_topik]' ");


                            while ($r = $tam->fetch_assoc()) {
                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $r['PERTANYAAN']; ?></td>



                                </tr>
                            <?php
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php
    } elseif (empty($cek_pilganda) and !empty($cek_esay)) {
    ?>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">NILAI ANDA</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Deskripsi Tugas/Quiz</th>
                                <th>Nilai</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $n_pilganda = $pilganda->fetch_assoc();
                            $n_esay = $esay->fetch_assoc();

                            ?>
                            <tr>
                                <td>Tugas Pilihan Ganda</td>
                                <td>Anda Belum Mengerjakan</td>
                            </tr>
                            <tr>
                                <td>Tugas Essay</td>
                                <td><?php echo $n_esay['NILAI']; ?></td>
                            </tr>
                        </tbody>

                    </table>
                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

    <?php
    } elseif (!empty($cek_pilganda) and empty($cek_esay)) { ?>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">NILAI ANDA</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Deskripsi Tugas/Quiz</th>
                                <th>Nilai</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $n_pilganda = $pilganda->fetch_assoc();
                            $n_esay = $esay->fetch_assoc();

                            ?>
                            <tr>
                                <td>Tugas Pilihan Ganda</td>
                                <td><?php echo $n_pilganda['PERSENTASE']; ?></td>
                            </tr>
                            <tr>
                                <td>Tugas Essay</td>
                                <td>Belum Dikoreksi</td>
                            </tr>
                        </tbody>

                    </table>
                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->





        <div class="col-12">
            <div class="card">
                <div class="card-header">

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $no = 1;
                            $tam = $koneksi->query("SELECT PERTANYAAN,KUNCI FROM tbl_quiz_pilganda WHERE ID_TOPIK_QUIZ='$_GET[id_topik]' ");


                            while ($r = $tam->fetch_assoc()) {
                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $r['PERTANYAAN']; ?></td>
                                    <td><?php echo $r['KUNCI']; ?></td>


                                </tr>
                            <?php
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    <?php

    } elseif (empty($cek_pilganda) and empty($cek_esay)) { ?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">NILAI ANDA</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Deskripsi Tugas/Quiz</th>
                                <th>Nilai</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $n_pilganda = $pilganda->fetch_assoc();
                            $n_esay = $esay->fetch_assoc();

                            ?>
                            <tr>
                                <td>Tugas Pilihan Ganda</td>
                                <td>Anda Belum mengerjakan</td>
                            </tr>
                            <tr>
                                <td>Tugas Essay</td>
                                <td>Anda Belum mengerjakan</td>
                            </tr>
                        </tbody>

                    </table>
                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->






    <?php

    }
} elseif (empty($c_pilganda) and !empty($c_esay)) {
    $esay = $koneksi->query("SELECT * FROM tbl_nilai_soal_essay WHERE 	ID_TOPIK_QUIZ = '$_GET[id_topik]' AND ID_SISWA = '$_SESSION[ID_SISWA]'");
    $cek_esay = $esay->num_rows;
    //jika nilai tidak kosong
    if (!empty($cek_esay)) {
    ?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">NILAI ANDA</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Deskripsi Tugas/Quiz</th>
                                <th>Nilai</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $n_esay = $esay->fetch_assoc();

                            ?>

                            <tr>
                                <td>Tugas Essay</td>
                                <td><?php echo $n_esay['NILAI']; ?></td>
                            </tr>
                        </tbody>

                    </table>
                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->


        <?php
    } elseif (empty($cek_esay)) {
        $kerjakan = $koneksi->query("SELECT * FROM siswa_sudah_mengerjakan WHERE ID_TOPIK_QUIZ	='$_GET[id_topik]' AND ID_SISWA = '$_SESSION[ID_SISWA]'");
        $c_kerjakan = $kerjakan->num_rows;
        if (!empty($c_kerjakan)) {
            $cek_kerjakan = $kerjakan->fetch_assoc();
            if ($cek_kerjakan['dikoreksi'] == 'B') {
        ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">NILAI ANDA</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Deskripsi Tugas/Quiz</th>
                                        <th>Nilai</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tugas Essay</td>
                                        <td>Belum Dikoreksi</td>
                                    </tr>
                                </tbody>

                            </table>
                            <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


            <?php
            } elseif (empty($c_kerjakan)) {
            ?>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">NILAI ANDA</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Deskripsi Tugas/Quiz</th>
                                        <th>Nilai</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tugas Essay</td>
                                        <td>Anda Belum Mengerjakan</td>
                                    </tr>
                                </tbody>

                            </table>
                            <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->




        <?php
            }
        }
    }
} elseif (!empty($c_pilganda) and empty($c_esay)) {
    $pilganda = $koneksi->query("SELECT * FROM tbl_nilai WHERE ID_TOPIK_QUIZ = '$_GET[id_topik]' AND ID_SISWA = '$_SESSION[ID_SISWA]'");
    $cek_pilganda = $pilganda->num_rows;

    if (!empty($cek_pilganda)) {
        ?>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">NILAI ANDA</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Deskripsi Tugas/Quiz</th>
                                <th>Nilai</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $n_pilganda = $pilganda->fetch_assoc();
                            ?>
                            <tr>
                                <td>Tugas Pilihan Ganda</td>
                                <td><?php echo $n_pilganda['PERSENTASE']; ?></td>
                            </tr>

                        </tbody>

                    </table>
                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->






        <div class="col-12">
            <div class="card">
                <div class="card-header">

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $no = 1;
                            $tam = $koneksi->query("SELECT PERTANYAAN,KUNCI FROM tbl_quiz_pilganda WHERE ID_TOPIK_QUIZ='$_GET[id_topik]' ");


                            while ($r = $tam->fetch_assoc()) {
                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $r['PERTANYAAN']; ?></td>
                                    <td><?php echo $r['KUNCI']; ?></td>

                                </tr>
                            <?php
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    <?php

    } else {
    ?>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">NILAI ANDA</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Deskripsi Tugas/Quiz</th>
                                <th>Nilai</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Tugas Pilihan Ganda</td>
                                <td>Anda Belum Mengerjakan</td>
                            </tr>

                        </tbody>

                    </table>
                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

<?php

    }
} elseif (!empty($c_pilganda) and !empty($c_esay)) {
    echo "<script>window.alert('Belum ada Nilai di tugas/quiz ini.');
            window.location=(href='?page=Nilai')</script>";
}


?>