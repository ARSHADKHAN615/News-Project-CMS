<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 5;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        // FETCH DATA FROM DB AND SHOW RECORD
                        // post show according author

                        if ($_SESSION['user_role'] == 1) {
                            $sql = "SELECT * FROM post
                        LEFT JOIN category ON post.category=category.category_id
                        LEFT JOIN user ON post.author=user.user_id
                        LIMIT $offset,$limit";
                        } elseif ($_SESSION['user_role'] == 0) {
                            $sql = "SELECT * FROM post
                        LEFT JOIN category ON post.category=category.category_id
                        LEFT JOIN user ON post.author=user.user_id
                        WHERE post.author={$_SESSION['user_id']}
                        LIMIT $offset,$limit";
                        }


                        $result = mysqli_query($connection, $sql) or die("Query Failed");
                        $serial = $offset + 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td class='id'><?php echo $serial ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><?php echo $row['post_date']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; ?>&cat_id=<?php echo $row['category']; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>

                        <?php
                                $serial++;
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php
                    if ($page > 1) {
                        echo "<li><a class='btn btn-primary' href='post.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    }
                    $sql1 = "SELECT * FROM post";
                    $result1 = mysqli_query($connection, $sql1) or die("Query Failed.2");
                    if (mysqli_num_rows($result1) > 0) {

                        $total_record = mysqli_num_rows($result1);
                        $total_page = ceil($total_record / $limit);

                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $cls = 'btn btn-primary active';
                            } else {
                                $cls = 'btn btn-primary';
                            }
                            echo "<li><a class='$cls' href='post.php?page=$i'>" . $i . "</a></li> ";
                        }
                        if ($total_page > $page) {
                            echo "<li><a class='btn btn-primary' href='post.php?page=" . ($page + 1) . "'>Next</a></li>";
                        }
                    } else {
                        echo "Not Record Found";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>