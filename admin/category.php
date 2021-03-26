<?php include "header.php";
require "config.php";
// ONLY ADMIN ACCESS PAGE CODE 
if ($_SESSION['user_role'] == 0) {
    header("location:{$hostName}/admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 2;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        // FETCH DATA FROM DB AND SHOW RECORD 
                        $sql = "SELECT * FROM category LIMIT $offset,$limit";
                        $result = mysqli_query($connection, $sql) or die("Query Failed");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                            <td class='id'>" . $row['category_id'] . "</td>
                            <td>" . $row['category_name'] . "</td>
                            <td>" . $row['post'] . "</td>
                            <td class='edit'><a href='update-category.php?id={$row['category_id']}'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?cat_id={$row['category_id']}''><i class='fa fa-trash-o'></i></a></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <ul class='pagination admin-pagination'>
                    <?php
                    if ($page > 1) {
                        echo "<li><a class='btn btn-primary' href='category.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    }
                    $sql1 = "SELECT * FROM category";
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
                            echo "<li><a href='category.php?page=$i' class='$cls'>" . $i . "</a></li> ";
                        }
                        if ($total_page > $page) {
                            echo "<li><a class='btn btn-primary' href='category.php?page=" . ($page + 1) . "'>Next</a></li>";
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