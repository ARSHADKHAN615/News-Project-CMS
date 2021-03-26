<?php include "header.php";
require "config.php";
// CHECK USER ADMIN OR NOT AND SHOW POST AND UPDATE 
if ($_SESSION['user_role'] == 0) {
    $post_id = $_GET['id'];
    $sql = "SELECT author FROM post WHERE post_id=$post_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['author'] != $_SESSION['user_id']) {
        header("location:{$hostName}/admin/post.php");
    }
}


// GET POST_ID AND SHOW IN INPUT VALUE 
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $sql2 = "SELECT * FROM post
     LEFT JOIN category ON post.category=category.category_id
     LEFT JOIN user ON post.author=user.user_id
     WHERE post.post_id=$post_id";
    $result2 = mysqli_query($connection, $sql2) or die("Query Failed");
}
if (mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_assoc($result2);
?>

    <div id="admin-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="admin-heading">Update Post</h1>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <!-- Form for show edit-->
                    <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <input type="hidden" name="post_id" class="form-control" value="<?php echo $row2['post_id'] ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTile">Title</label>
                            <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row2['title'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> Description</label>
                            <textarea name="post_desc" class="form-control" required rows="5">
                               <?php echo trim($row2['description']) ?>
                </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCategory">Category</label>
                            <select class="form-control" name="category">
                                <option disabled selected> Select Category</option>
                                <?php
                                $sql3 = "SELECT * FROM category";
                                $result3 = mysqli_query($connection, $sql3) or die("Query Failed.");
                                if (mysqli_num_rows($result3) > 0) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        if ($row2['category'] == $row3['category_id']) {
                                            $selected = "selected";
                                        } else {

                                            $selected = "";
                                        }
                                        echo "<option value='" . $row3['category_id'] . "' $selected>" . $row3['category_name'] . "</option>";
                                    }
                                }
                                ?>
                                <input type="hidden" name="old_category" value="<?php echo $row2['category'] ?>">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Post image</label>
                            <input type="file" name="new-image">
                            <img src="upload/<?php echo $row2['post_img'] ?>" height="150px">
                            <input type="hidden" name="old-image" value="<?php echo $row2['post_img'] ?>">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    </form>
                    <!-- Form End -->
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php";
} else {
    echo "Not found";
}
?>