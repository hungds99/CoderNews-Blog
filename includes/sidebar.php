  <div class="col-3">

    <!-- Search Widget -->
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm</h5>
      <div class="card-body">
        <form name="search" action="search.php" method="get">
          <div class="input-group">

            <input type="text" name="searchtitle" class="form-control" placeholder="Nhập tìm kiếm..." required>
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="submit">Tìm</button>
            </span>
        </form>
      </div>
    </div>
  </div>

  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Danh mục</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-unstyled mb-0">
            <?php $query = mysqli_query($con, "select id,CategoryName from tblcategory");
            while ($row = mysqli_fetch_array($query)) {
            ?>

              <li>
                <a href="category.php?catid=<?=$row['id']?>"><?=$row['CategoryName']?></a>
              </li>
            <?php } ?>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header">Bài viết gần nhất</h5>
    <div class="card-body">
      <ul class="mb-0 p-0 pl-2">
        <?php
        $query = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId limit 8");
        while ($row = mysqli_fetch_array($query)) {

        ?>

          <li>
            <a href="news-details.php?nid=<?=$row['pid']?>"><?=$row['posttitle']?></a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>

  </div>