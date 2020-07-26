<?php
session_start();

// Kết nối Database
include('includes/config.php');

if (isset($_POST['login'])) {

    // Kiểm tra username/email và password
    $uname = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra username/email và password từ database  
    $sql = mysqli_query($con, "SELECT AdminUserName,AdminEmailId,AdminPassword FROM tbladmin WHERE (AdminUserName='$uname' || AdminEmailId='$uname')");
    $num = mysqli_fetch_array($sql);

    if ($num > 0) {
        $hashpassword = $num['AdminPassword']; // Mật khẩu mã hóa từ DB (Hashed password)

        // Kiểm tra mật khẩu
        if (password_verify($password, $hashpassword)) {
            $_SESSION['login'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    }
    // Nếu mật khẩu không tồn tại ở DB
    else {
        echo "<script>alert('User not registered with us');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Coder News.">
    <meta name="author" content="Dinh Sy Hung">


    <!-- App title -->
    <title>Coder News | Admin Panel</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>

</head>


<body class="bg-green" style="background-color: #dced85;">

    <!-- HOME -->
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        <div class="m-t-40 account-pages">
                            <div class="text-center account-logo-box">
                                <h4 class="text-uppercase font-bold m-b-2 text-white">Trang Quản Trị Viên</h4>
                            </div>
                            <div class="account-content" style="background-color: #ffffff;">
                                <form class="form-horizontal" method="post">

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="username" placeholder="Username or email" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" name="password" required="" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">Đăng Nhập</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                        <!-- end card-box-->

                    </div>
                    <!-- end wrapper -->

                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script> 
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>

</html>