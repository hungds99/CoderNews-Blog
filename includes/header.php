<!-- <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top"> -->
<nav class="navbar fixed-top navbar-expand-lg bg-light fixed-top">
  <div class="container">
    <!-- <a class="navbar-brand" href="index.php"><img src="images/logo.png" height="50"></a> -->
    <a href="index.php" class="navbar-brand  logo"><span class="text-dark">CODER<span class="text-primary">NEWS</span></span><i class="mdi mdi-layers"></i></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">

        <?php
          	$query = mysqli_query($con, "Select id,CategoryName from tblcategory where Is_Active=1");

          	while ($row = mysqli_fetch_array($query)) {
        ?>
        	<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="category.php?catid=<?= $row['id'] ?>" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= $row['CategoryName'] ?>
				</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              	<?php
              		$catid = $row["id"];
              		$query_sub = mysqli_query($con, "SELECT * FROM tblsubcategory WHERE CategoryId=$catid and Is_Active=1");
              		while ($sub = mysqli_fetch_array($query_sub)) {
              	?>
                <a class="dropdown-item" href="category.php?subcatid=<?= $sub['SubCategoryId'] ?>"><?= $sub["Subcategory"] ?></a>
              	<?php } ?>
            </div>
          </li>
        <?php
        	}
        ?>
      </ul>
    </div>
  </div>
</nav>