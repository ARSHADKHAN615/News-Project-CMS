<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    if (isset($_GET['search'])) {
                        $search_tam = htmlentities($_GET['search']);
                    }

                    ?>
                    <h2 class="page-heading">Search : <?php echo $search_tam ?></h2>
                    <?php
                    $limit = 2;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                    // FETCH DATA FROM DB AND SHOW RECORD 
                    // post show FRONTEND 
                    $sql = "SELECT * FROM post
                        LEFT JOIN category ON post.category=category.category_id
                        LEFT JOIN user ON post.author=user.user_id
                        WHERE post.title LIKE '%$search_tam%' LIMIT $offset,$limit";

                    $result = mysqli_query($connection, $sql) or die("Query Failed:post");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cat_id=<?php echo $row["category_id"] ?>'><?php echo $row['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?au_id=<?php echo $row["user_id"] ?>'><?php echo $row['username']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 100) . "..." ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <ul class='pagination pagination'>
                        <?php
                        if ($page > 1) {
                            echo "<li><a class='btn btn-primary' href='search.php?search=$search_tam&page=" . ($page - 1) . "'>Prev</a></li>";
                        }
                        $sql1 = "SELECT * FROM post WHERE title LIKE '%$search_tam%'";
                        $result1 = mysqli_query($connection, $sql1) or die("Query Failed:pagination");
                        if (mysqli_num_rows($result1) > 0) {

                            $total_record = mysqli_num_rows($result1);
                            $total_page = ceil($total_record / $limit);

                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) {
                                    $cls = 'btn btn-primary active';
                                } else {
                                    $cls = 'btn btn-primary';
                                }
                                echo "<li><a href='search.php?search=$search_tam&page=$i' class='$cls'>" . $i . "</a></li> ";
                            }
                            if ($total_page > $page) {
                                echo "<li><a class='btn btn-primary' href='search.php?search=$search_tam&page=" . ($page + 1) . "'>Next</a></li>";
                            }
                        } else {
                            echo "<p class='lead'>Not Record Found</p>";
                        }
                        ?>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>