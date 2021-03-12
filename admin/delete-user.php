<?php
require "config.php";
// ONLY ADMIN ACCESS PAGE CODE 
if ($_SESSION['user_role'] == 0) {
    header("location:{$hostName}/admin/post.php");
}
$userId = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id='$userId'";
$result = mysqli_query($connection, $sql) or die("Query Failed.");
if ($result) {
    header("location:{$hostName}/admin/users.php");
} else {
    echo "Record Not Delete";
}

mysqli_close($connection);
