<?php include "header.php";
require "config.php";
// ONLY ADMIN ACCESS PAGE CODE 
if ($_SESSION['user_role'] == 0) {
    header("location:{$hostName}/admin/post.php");
}


// UPDATE CAT_NAME IN DB 
if (isset($_POST['submit'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $sql1 = "UPDATE category SET category_name='$cat_name' WHERE category_id=$cat_id";
    $result1 = mysqli_query($connection, $sql1) or die("Query Failed2");
    if ($result1) {
        header("location:{$hostName}/admin/category.php");
    }
}

// GET CAT_ID AND SHOW IN INPUT VALUE 
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $sql = "SELECT *FROM category where category_id='$category_id'";
    $result = mysqli_query($connection, $sql) or die("Query Failed");
}
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

?>
    <div id="admin-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="adin-heading"> Update Category</h1>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>" placeholder="" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include "footer.php";
} else {
    echo "Not found";
} ?>