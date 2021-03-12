<?php
require "config.php";
// ONLY ADMIN ACCESS PAGE CODE 
if ($_SESSION['user_role'] == 0) {
    header("location:{$hostName}/admin/post.php");
}

$cat_Id = $_GET['cat_id'];
$sql = "DELETE FROM category WHERE category_id='$cat_Id'";
$result1 = mysqli_query($connection, $sql) or die("Query Failed.");
if ($result1) {
    header("location:{$hostName}/admin/category.php");
} else {
    echo "Record Not Delete";
}

mysqli_close($connection);
