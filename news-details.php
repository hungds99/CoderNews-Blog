<?php 
    session_start();
    include('includes/config.php');

    //Genrating CSRF Token
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    if(isset($_POST['submit'])){
    
        //Verifying CSRF Token
        if (!empty($_POST['csrftoken'])) {
            if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $comment = $_POST['comment'];
                $postid = intval($_GET['nid']);
                $st1 = '0';
                $query = mysqli_query($con,"insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
                if($query):
                    echo "<script>alert('Gửi bình luận thành công. Vui lòng chờ xác nhận !');</script>";
                    unset($_SESSION['token']);
                else :
                    echo "<script>alert('Có lỗi. Vui lòng thử lại !');</script>";  
                endif;

            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coder News | Bài viết</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">

        <div class="row" style="margin-top: 4%">

            <!-- Blog Entries Column -->
            <div class="col-9">

                <!-- Blog Post -->
                <?php
                    $pid=intval($_GET['nid']);
                    $query=mysqli_query($con,"select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
                    while ($row=mysqli_fetch_array($query)) {
                ?>

                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?=$row['posttitle']?></h2>
                        <p><b><em>Danh mục : </em></b> <a
                                href="category.php?catid=<?=$row['cid']?>"><?=$row['category']?></a>
                            |
                            <b><em>Danh mục con : </em></b><?=$row['subcategory']?> | <b><em> Posted on :</em>
                            </b><?=$row['postingdate']?></p>
                        <hr />
                        <img class="img-fluid rounded"
                            src="admin/postimages/<?=$row['PostImage']?>"
                            alt="<?=$row['posttitle']?>">
                        <p class="card-text"><?php 
                        $pt=$row['postdetails'];
                        echo  (substr($pt,0));?></p>
                    </div>
                </div>
                <?php } ?>

            </div>

            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php');?>
        </div>
        <!-- /.row -->
        <!---Comment Section --->

        <div class="row" style="margin-top: -8%">
            <div class="col-md-8">
                <div class="card my-4">
                    <h5 class="card-header">Bình luận:</h5>
                    <div class="card-body">
                        <form name="Comment" method="post">
                            <input type="hidden" name="csrftoken"
                                value="<?=$_SESSION['token']?>" />
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên đầy đủ..."
                                    required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control"
                                    placeholder="Nhập email..." required>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Nhập bình luận..."
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Bình luận</button>
                        </form>
                    </div>
                </div>

                <!---Comment Display Section --->

                <?php 
                    $sts=1;
                    $query=mysqli_query($con,"select name,comment,postingDate from  tblcomments where postId='$pid' and status='$sts'");
                    while ($row=mysqli_fetch_array($query)) {
                ?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?=$row['name']?> <br />
                            <span style="font-size:11px;"><b>Ngày: </b>
                                <?=$row['postingDate']?></span>
                        </h5>

                        <?=$row['comment']?>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>


    <?php include('includes/footer.php');?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>