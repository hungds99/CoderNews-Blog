<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coder News | Kết quả tìm kiếm</title>

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
        <div class="col-md-8">

        <!-- Blog Post -->
        <?php 
            if($_GET['searchtitle']!='') {
                $st = $_SESSION['searchtitle'] = $_GET['searchtitle'];
            }
            $st;
            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 8;
            $offset = ($pageno-1) * $no_of_records_per_page;


            $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
            $result = mysqli_query($con,$total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);

            $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.PostTitle like '%$st%' and tblposts.Is_Active=1 LIMIT $offset, $no_of_records_per_page");

            $rowcount=mysqli_num_rows($query);
            if($rowcount==0) {
                echo "Không tìm thấy kết quả.";
            } else {
                while ($row=mysqli_fetch_array($query)) {
            ?>

<div class="row">
                    <div class="col-3">
                        <img src="admin/postimages/<?=$row['PostImage']?>" alt="<?=$row['posttitle']?>" width=200
                            heigh=200>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <h2 class="card-title"><?=$row['posttitle']?></h2>
                            <p style="font-size: 12px;"><em>Danh mục : </em> <a
                                    href="category.php?catid=<?=$row['cid']?>"><?=$row['category']?></a> || <em>Ngày
                                    đăng :</em> <?=$row['postingdate']?> </p>

                            <p><?php
                  $string = $row['postdetails'];

                  $string = strip_tags($string);
                  if (strlen($string) > 500) {

                    // truncate string
                    $stringCut = substr($string, 0, 500);
                    $endPoint = strrpos($stringCut, ' ');

                    //if the string doesn't contain any space then it will cut without word basis.
                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $string .= "... <a href='news-details.php?nid=" . $row['pid'] . "'>Đọc tiếp</a>";
                  }
                  echo $string;

                  ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <ul class="pagination justify-content-center mb-4">
                <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
                </li>
                <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
            </ul>
            <?php } ?>
          <!-- Pagination -->

        </div>

        <!-- Sidebar Widgets Column -->
        <?php include('includes/sidebar.php');?>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include('includes/footer.php');?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 
</head>
</body>
</html>
