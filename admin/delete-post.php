<?php
require "config.php";
$post_id = $_GET['id'];
$cat_id = $_GET['cat_id'];


echo $sql1 = "SELECT * FROM post WHERE post_id=$post_id";
$result1 = mysqli_query($connection, $sql1) or die("Query Failed.");
$row = mysqli_fetch_assoc($result1);
unlink("upload/" . $row['post_img']);


$sql = "DELETE FROM post WHERE post_id=$post_id;";
$sql .= "UPDATE category SET post=post-1 WHERE category_id=$cat_id";

$result = mysqli_multi_query($connection, $sql) or die("Query Failed");
if ($result) {
    header("location:{$hostName}/admin/post.php");
}
