<!-- <tr>
    <td>$j[JAWABAN]</td>
</tr> -->
<?php

$cek = $koneksi->query("SELECT * FROM siswa_sudah_mengerjakan WHERE ID_SISWA='$_GET[id_siswa]'");
$c = $cek->fetch_assoc();

if ($c['DIKOREKSI'] == '') {
    $soal_pilganda = $koneksi->query("SELECT * FROM tbl_quiz_pilganda WHERE ID_TOPIK_QUIZ='$_GET[id]'");
    $pilganda = $soal_pilganda->num_rows;

    $soal_esay = $koneksi->query("SELECT * FROM tbl_quiz_essay WHERE ID_TOPIK_QUIZ='$_GET[id]'");
    $esay = $soal_esay->num_rows;

    if (!empty($pilganda) and !empty($esay)) {
        $siswa = $koneksi->query("SELECT * FROM tbl_siswa WHERE ID_SISWA='$_GET[id_siswa]'");
        $s = $siswa->fetch_assoc();

        $jawaban = $koneksi->query("SELECT * FROM tbl_jawaban WHERE ID_TOPIK_QUIZ='$_GET[id]' AND ID_SISWA='$_GET[id_siswa]'");
        $cek = $jawaban->num_rows;
        if (!empty($cek)) {
            echo "
                <div class='box box-warning pb-5'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> ";
            $no = 1;
            while ($j = $jawaban->fetch_assoc()) {
                $soal_esay2 = $koneksi->query("SELECT * FROM tbl_quiz_essay WHERE ID_TOPIK_QUIZ='$j[ID_TOPIK_QUIZ]' AND ID_ESSAY='$j[ID_ESSAY]'");

                $quiz = $soal_esay2->fetch_assoc();
                echo "<table id='table1' class='gtable sortable pb-5'>
                          <form method=POST action='?page=Manajemen_quiz&aksi=hasilkoreksi'>";
                if (!empty($quiz['GAMBAR'])) {
                    echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[PERTANYAAN]</td></tr>
                                  <tr><td><img src='../images_soal_essay/$quiz[GAMBAR]' class='img-fluid'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  
                                  <tr><td><textarea class='form-control ckeditor' cols=95 rows=5>$j[JAWABAN]</textarea></td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai" . $no . "' value='10'>10</input>
                                          <input type=radio name='nilai" . $no . "' value='20'>20</input>
                                          <input type=radio name='nilai" . $no . "' value='30'>30</input>
                                          <input type=radio name='nilai" . $no . "' value='40'>40</input>
                                          <input type=radio name='nilai" . $no . "' value='50'>50</input>
                                          <input type=radio name='nilai" . $no . "' value='60'>60</input>
                                          <input type=radio name='nilai" . $no . "' value='70'>70</input>
                                          <input type=radio name='nilai" . $no . "' value='80'>80</input>
                                          <input type=radio name='nilai" . $no . "' value='90'>90</input>
                                          <input type=radio name='nilai" . $no . "' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab" . $no . "' value='$j[JAWABAN]'>
                                  </table>";
                } else {
                    echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[PERTANYAAN]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td><textarea class='form-control ckeditor' cols=95 rows=5>$j[JAWABAN]</textarea></td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai" . $no . "' value='10'>10</input>
                                          <input type=radio name='nilai" . $no . "' value='20'>20</input>
                                          <input type=radio name='nilai" . $no . "' value='30'>30</input>
                                          <input type=radio name='nilai" . $no . "' value='40'>40</input>
                                          <input type=radio name='nilai" . $no . "' value='50'>50</input>
                                          <input type=radio name='nilai" . $no . "' value='60'>60</input>
                                          <input type=radio name='nilai" . $no . "' value='70'>70</input>
                                          <input type=radio name='nilai" . $no . "' value='80'>80</input>
                                          <input type=radio name='nilai" . $no . "' value='90'>90</input>
                                          <input type=radio name='nilai" . $no . "' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab" . $no . "' value='$j[JAWABAN]'>
                                  </table>";
                }
                $no++;
            }
            $jum = $no - 1;
            echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
            echo "<br>
                          <input class='btn btn-success pb-5' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></div></div>";
        } else {
            echo
                "<script>window.alert('Jawaban siswa kosong.');
                       window.location=(href='?page=Manajemen_quiz')</script>";
        }
    } elseif (empty($pilganda) and !empty($esay)) {
        $siswa = $koneksi->query("SELECT * FROM tbl_siswa WHERE ID_SISWA='$_GET[id_siswa]'");
        $s = $siswa->fetch_assoc();

        $jawaban = $koneksi->query("SELECT * FROM tbl_jawaban WHERE ID_TOPIK_QUIZ='$_GET[id]' AND ID_SISWA='$_GET[id_siswa]'");
        $cek = $jawaban->num_rows;
        if (!empty($cek)) {
            echo "

               <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Jawaban Soal Essay Siswa <b>$s[NAMA_SISWA]
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";
            $no = 1;
            while ($j = $jawaban->fetch_assoc()) {
                $soal_esay2 = $koneksi->query("SELECT * FROM tbl_quiz_essay WHERE ID_TOPIK_QUIZ='$j[ID_TOPIK_QUIZ]' AND ID_ESSAY='$j[ID_ESSAY]'");
                $quiz = $soal_esay2->fetch_assoc();
                echo "<table id='table1' class='gtable sortable'>
                          <form method=POST action='?module=quiz&act=hasilkoreksi'>";
                if (!empty($quiz['GAMBAR'])) {
                    echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[PERTANYAAN]</td></tr>
                                  <tr><td><img src='../images_soal_essay/$quiz[GAMBAR]' class='img-fluid'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td><textarea class='form-control ckeditor' cols=95 rows=5>$j[JAWABAN]</textarea></td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai" . $no . "' value='10'>10</input>
                                          <input type=radio name='nilai" . $no . "' value='20'>20</input>
                                          <input type=radio name='nilai" . $no . "' value='30'>30</input>
                                          <input type=radio name='nilai" . $no . "' value='40'>40</input>
                                          <input type=radio name='nilai" . $no . "' value='50'>50</input>
                                          <input type=radio name='nilai" . $no . "' value='60'>60</input>
                                          <input type=radio name='nilai" . $no . "' value='70'>70</input>
                                          <input type=radio name='nilai" . $no . "' value='80'>80</input>
                                          <input type=radio name='nilai" . $no . "' value='90'>90</input>
                                          <input type=radio name='nilai" . $no . "' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab" . $no . "' value='$j[JAWABAN]'>
                                  </table>";
                } else {
                    echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[PERTANYAAN]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td><textarea class='form-control ckeditor' cols=95 rows=5>$j[JAWABAN]</textarea></td></tr>
                                  
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai" . $no . "' value='10'>10</input>
                                          <input type=radio name='nilai" . $no . "' value='20'>20</input>
                                          <input type=radio name='nilai" . $no . "' value='30'>30</input>
                                          <input type=radio name='nilai" . $no . "' value='40'>40</input>
                                          <input type=radio name='nilai" . $no . "' value='50'>50</input>
                                          <input type=radio name='nilai" . $no . "' value='60'>60</input>
                                          <input type=radio name='nilai" . $no . "' value='70'>70</input>
                                          <input type=radio name='nilai" . $no . "' value='80'>80</input>
                                          <input type=radio name='nilai" . $no . "' value='90'>90</input>
                                          <input type=radio name='nilai" . $no . "' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab" . $no . "' value='$j[JAWABAN]'>
                                  </table>";
                }
                $no++;
            }
            $jum = $no - 1;
            echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
            echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></section>";
        } else {
            echo
                "<script>window.alert('Jawaban siswa kosong.');
                        window.location=(href='?page=Manajemen_quiz')</script>";
        }
    } elseif (!empty($pilganda) and empty($esay)) {
        echo "<script>window.alert('Soal hanya pilihan ganda, sudah di koreksi oleh system.');
            window.location=(href='?page=Manajemen_quiz')</script>";
    } elseif (empty($pilganda) and empty($esay)) {
        echo "<script>window.alert('Tidak ada soal pilihan ganda atau essay.');
            window.location=(href='?page=Manajemen_quiz')</script>";
    }
} 



// elseif ($c['DIKOREKSI'] == 'S') {
//     echo "<script>window.alert('Sudah Di Koreksi');
//          window.location=(href='?module=quiz')</script>";
// }
