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
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <!-- FETCH USER DATA FROM DB  -->
                        <?php
                        $limit = 2;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT $offset,$limit";
                        $result = mysqli_query($connection, $sql) or die("Query Failed.");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td class='id'><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php
                                        if ($row['role'] == 1) {
                                            echo "administrator";
                                        } else {
                                            echo "subscriber";
                                        }
                                        ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"] ?>'><i class='fa fa-trash-o'></i></a></td>

                                </tr>
                        <?php
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <?php
                $sql1 = "SELECT * FROM user";
                $result1 = mysqli_query($connection, $sql1) or die("Query Failed.2");
                if (mysqli_num_rows($result1) > 0) {
                    $total_record = mysqli_num_rows($result1);
                    $limit = 2;
                    $total_page = ceil($total_record / $limit);

                    echo  "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo "<li><a class='btn btn-primary' href='users.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    }
                    for ($i = 1; $i <= $total_page; $i++) {

                        if ($i == $page) {
                            $active = "btn btn-primary active";
                        } else {
                            $active = "btn btn-primary";
                        }
                        echo "<li><a class='$active' href='users.php?page=$i'>$i</a></li>";
                    }
                    if ($total_page > $page) {
                        echo "<li><a class='btn btn-primary' href='users.php?page=" . ($page + 1) . "'>Next</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='text-center'>Not Record Found</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>