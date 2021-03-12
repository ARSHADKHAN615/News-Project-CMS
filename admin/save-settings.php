<?php
require "config.php";
if (empty($_FILES['logo']['name'])) {
    $file_name = $_POST['old_logo'];
} else {
    $error = array();
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp_name = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    $exp = explode('.', $file_name);
    $file_ext = strtolower(end($exp));
    $extension = ["jpeg", "jpg", "png"];

    if (in_array($file_ext, $extension) === false) {
        $error[] = "this file not allowed ,please choose a jpeg,png,jpg";
    }
    if ($file_size > 2097152) {
        $error[] = "file must be 2mb or lower";
    }
    if (empty($error) == true) {
        move_uploaded_file($file_tmp_name, "images/" . $file_name);
    } else {
        print_r($error);
        die();
    }
}


$sql = "UPDATE settings SET websiteName='{$_POST['website_name']}',logo='{$file_name}',footerDesc='{$_POST['footer_desc']}'";

$result = mysqli_query($connection, $sql) or die("Setting Query Failed.");
if ($result) {
    header("location:{$hostName}/admin/settings.php");
} else {
    echo "Setting Query Failed";
}
