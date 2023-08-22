<?php
if (isset($_POST['simpan'])) {
    $siswa_sudah_mengerjakan = $koneksi->query("UPDATE siswa_sudah_mengerjakan SET DIKOREKSI = 'S'
 WHERE ID_TOPIK_QUIZ ='$_POST[id_tq]' AND ID_SISWA = '$_POST[id_siswa]'");
    $tbl_nilai_soal_essay = $koneksi->query("INSERT INTO tbl_nilai_soal_essay (ID_TOPIK_QUIZ,ID_SISWA,NILAI)
 VALUES ('$_POST[id_tq]','$_POST[id_siswa]','$_POST[nilai]')");

    $Id_topik_quiz = $_POST['id_tq'];

    if ($tbl_nilai_soal_essay) { ?>

        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Nilai Tuga/Quiz",
                    text: "Berhasil Simpan",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000
                }, function() {
                    window.location.href = "?page=Manajemen_quiz";

                });
            }, 100);
        </script>
<?php

    }
}




?>
<?php
echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Koreksi Nilai
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>

        <form method=POST >
         
            ";
$jum_soal = $_POST['jumlah_soal'];

echo "<table class='table table-bordered table-responsive'><thead>
                          <input type=hidden name=id_tq value='$_POST[id_topik]'>
                          <input type=hidden name=id_siswa value='$_POST[id_siswa]'>";
echo "<tr><th>No Soal</th><th>Jawaban</th><th>Nilai</th></tr></thead>";
for ($i = 1; $i <= $jum_soal; $i++) {
    $nilai = $_POST['nilai' . $i];
    $jawaban = $_POST['jawab' . $i];
    if (!empty($jawaban)) {
        echo "<tr><td>$i.</td><td>$jawaban</td><td>$nilai</td></tr>";
    } else {
        echo "<tr><td>$i.</td><td></td><td>$nilai</td></tr>";
    }
}
echo "</table>";

$jumlah = 0;
for ($i = 1; $i <= $jum_soal; $i++) {
    $bil = array($_POST['nilai' . $i]);
    for ($j = 0; $j <= count($bil) - 1; $j++) {
        $jumlah = $jumlah + $bil[$j];
    }
}
$nilai = $jumlah / 100;
$nilai2 = $nilai / $jum_soal;
$nilai3 = $nilai2 * 100;
echo "<p align='right'><button class='btn btn-warning'>Nilai Keseluruhan = $nilai3</button></p><br/>";
echo "<input type=hidden name=nilai value='$nilai3'>";
echo "
                      <input class='btn btn-success' type=submit name=simpan value=Simpan>
                      
                      ";
echo "</form></section>";
