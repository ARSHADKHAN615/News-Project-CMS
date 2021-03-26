<?php
require "config.php";


if (isset($_FILES['fileToUpload'])) {
    $error = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extension = ["jpeg", "jpg", "png"];

    if (in_array($file_ext, $extension) === false) {
        $error[] = "this file not allowed ,please choose a jpeg,png,jpg";
    }
    if ($file_size > 2097152) {
        $error[] = "file must be 2mb or lower";
    }


    $new_name = time() . "-" . $file_name;
    $target = "upload/" . time() . "-" . $file_name;

    if (empty($error) == true) {
        move_uploaded_file($file_tmp_name, $target);
    } else {
        print_r($error);
        die();
    }
}

session_start();
$title = htmlentities($_POST['post_title']);
$desc = addslashes(htmlentities($_POST['post_desc']));
$cate = htmlentities($_POST['category']);
$date = date('d M, Y');
$author = $_SESSION['user_id'];

$sql = "INSERT INTO `post`(`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('{$title}','{$desc}','{$cate}','{$date}','{$author}','{$new_name}');";
$sql .= "UPDATE category SET post=post+1 WHERE category_id=$cate";
$result = mysqli_multi_query($connection, $sql) or die("Query Failed");
if ($result) {
    header("location:{$hostName}/admin/post.php");
}
