<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "include/koneksi.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMK DHARMA BAKTI 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="plugins/ionicons-2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="logo/logo_dharma_bakti_2.jpg" alt="SMK DHARMA BAKTI Logo" class="brand-image img-circle elevation-3 " width="13%" style="opacity: .8"> <a href="#"><b>SMK DHARMA BAKTI 2 (TI) MEDAN</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in </p>

                <form method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <input type="submit" name="login" class="btn btn-primary btn-block" value="Login">

                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>

<?php
$Username = mysqli_real_escape_string($koneksi, $_POST['username']);
$Password = mysqli_real_escape_string($koneksi, $_POST['password']);

$Login = mysqli_real_escape_string($koneksi, $_POST['login']);

if ($Login) {
    // $database = $koneksi->query("SELECT * FROM tbl_admin INNER JOIN tbl_siswa ON tbl_admin.USER_LEVEL = tbl_siswa.USER_LEVEL INNER JOIN tbl_pengajar ON tbl_admin.USER_LEVEL = tbl_pengajar.USER_LEVEL where USERNAME = '$Username' && PASSWORD='$Password' ");

    $database = $koneksi->query("select * from tbl_admin where  USERNAME = '$Username' AND PASSWORD='$Password' ");

    $ketemu = $database->num_rows;

    $data = $database->fetch_assoc();


    if ($ketemu >= 1) {
        session_start();
        if ($data['USER_LEVEL'] == "KEPSEK") {
            $_SESSION['KEPSEK'] = $data['USERNAME'];
            $_SESSION['ID_USER'] = $data['ID_USER'];
            // header("location: kepsek/index.php");
?>
            <!-- Sweetalert Css -->
            <!-- <link href="plugins/sweetalert2/sweetalert2.css" rel="stylesheet" /> -->
            <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
            <!-- SweetAlert Plugin Js -->
            <!-- <script src="plugins/sweetalert2/sweetalert2.min.js"></script> -->
            <script src="plugins/sweetalert/sweetalert.min.js"></script>

            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "SELAMAT DATANG KEPALA SEKOLAH",
                        text: "Anda Berhasil Login",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }, function() {
                        window.location.href = "kepsek/index.php";
                    });
                }, 100);
            </script>
        <?php
        }
    } else {
        ?>
        <!-- Sweetalert Css -->
        <!-- <link href="plugins/sweetalert2/sweetalert2.css" rel="stylesheet" /> -->
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <!-- SweetAlert Plugin Js -->
        <!-- <script src="plugins/sweetalert2/sweetalert2.min.js"></script> -->
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Oops... Gagal Login!",
                    text: "Periksa Kembali Username dan Password Anda",
                    type: "error",
                    showConfirmButton: false,
                    timer: 2000
                }, function() {
                    window.location.href = "login_kepsek.php";

                });
            }, 100);
        </script>
<?php
    }
}

?>