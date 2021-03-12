<?php
require "config.php";
if (empty($_FILES['new-image']['name'])) {

    $new_name = $_POST['old-image'];
} else {
    $error = array();
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp_name = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
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


$sql = "UPDATE post SET title='{$_POST['post_title']}',description='{$_POST['post_desc']}',category={$_POST['category']},post_img='$new_name' WHERE post_id={$_POST['post_id']};";
if ($_POST['old_category'] != $_POST['category']) {
    $sql .= "UPDATE category SET post=post-1 WHERE category_id={$_POST['old_category']};";
    $sql .= "UPDATE category SET post=post+1 WHERE category_id={$_POST['category']}";
}

$result = mysqli_multi_query($connection, $sql) or die("Query Failed.");
if ($result) {
    header("location:{$hostName}/admin/post.php");
}
