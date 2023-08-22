<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">PESAN
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengirim Pesan</th>
                        <th>Telp</th>
                        <th>E-mail</th>
                        <th>Subject</th>
                        <th>Pesan</th>
                        <th>Tanggal Kirim Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;


                    $database = $koneksi->query("SELECT * FROM tbl_pesan");

                    while ($data_pesan = $database->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_pesan['NAMA']; ?></td>
                            <td><?php echo $data_pesan['TELP']; ?></td>
                            <td><?php echo $data_pesan['EMAIL']; ?></td>
                            <td><?php echo $data_pesan['SUBJECT']; ?></td>
                            <td><?php echo $data_pesan['PESAN']; ?></td>
                            <td><?php echo $data_pesan['TGL_KIRIM']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>