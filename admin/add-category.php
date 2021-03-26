<?php include "header.php";
require "config.php";
// ONLY ADMIN ACCESS PAGE CODE 
if ($_SESSION['user_role'] == 0) {
    header("location:{$hostName}/admin/post.php");
}

if (isset($_POST['save'])) {
    $category = $_POST['cat'];
    /* query for check input value exists in category table or not*/
    $sql = "SELECT category_name FROM category where category_name='$category'";
    $result = mysqli_query($connection, $sql) or die("Query Failed");
    if (mysqli_num_rows($result) > 0) {
        // if input value exists
        echo "Category Already Exist";
    } else {
        // if value not exist insert data in db 
        $sql1 = "INSERT INTO `category` (`category_name`) VALUES ('$category')";
        $result1 = mysqli_query($connection, $sql1) or die("Query Failed 2");
        if ($result1) {
            header("location:{$hostName}/admin/category.php");
        }
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php";
mysqli_close($conn);
?>