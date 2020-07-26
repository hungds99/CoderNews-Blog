<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {

        $imgfile = $_FILES["postimage"]["name"];

        // get the image extension
        $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));

        // allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            //rename the image file
            $imgnewfile = md5($imgfile) . $extension;
            // Code for move image into directory
            move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

            $postid = intval($_GET['pid']);
            $query = mysqli_query($con, "update tblposts set PostImage='$imgnewfile' where id='$postid'");
            if ($query) {
                $msg = "Hình thumnail được câp nhật thành công !";
            } else {
                $error = "Có lỗi . Vui lòng thử lại !";
            }
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Coder New | Cập nhật hình ảnh</title>

        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- Select2 -->
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Jquery filer css -->
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
        <script>
            function getSubCat(val) {
                $.ajax({
                    type: "POST",
                    url: "get_subcategory.php",
                    data: 'catid=' + val,
                    success: function(data) {
                        $("#subcategory").html(data);
                    }
                });
            }
        </script>
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title"> Cập nhật hình ảnh </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Bảng điều khiển</a>
                                        </li>
                                        <li>
                                            <a href="#"> Bài viết </a>
                                        </li>
                                        <li>
                                            <a href="#"> Sửa bài viết </a>
                                        </li>
                                        <li class="active">
                                            Cập nhật hình ảnh
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <!---Success Message--->
                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong><?php echo htmlentities($msg); ?></strong> 
                                    </div>
                                <?php } ?>

                                <!---Error Message--->
                                <?php if ($error) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong><?php echo htmlentities($error); ?></strong>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                        <form name="addpost" method="post" enctype="multipart/form-data">
                            <?php
                            $postid = intval($_GET['pid']);
                            $query = mysqli_query($con, "select PostImage,PostTitle from tblposts where id='$postid' and Is_Active=1 ");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="p-6">
                                            <div class="">
                                                <form name="addpost" method="post">
                                                    <div class="form-group m-b-20">
                                                        <label for="exampleInputEmail1">Tiêu đề</label>
                                                        <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['PostTitle']); ?>" name="posttitle" readonly>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="card-box">
                                                                <h4 class="m-b-30 m-t-0 header-title"><b>Ảnh hiện tại</b></h4>
                                                                <img src="postimages/<?php echo htmlentities($row['PostImage']); ?>" width="300" />
                                                                <br />

                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box">
                                                            <h4 class="m-b-30 m-t-0 header-title"><b>Thêm ảnh mới</b></h4>
                                                            <input type="file" class="form-control" id="postimage" name="postimage" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Cập nhật</button>
                                                </form>
                                            </div>
                                        </div> <!-- end p-20 -->
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



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
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>



    </body>

    </html>
<?php } ?>