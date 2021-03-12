<?php
require "config.php";
$page = basename($_SERVER['PHP_SELF']);

switch ($page) {
    case 'single.php':
        if (isset($_GET['id'])) {
            $sql_title = "SELECT title FROM post WHERE post_id={$_GET['id']}";
            $result_title = mysqli_query($connection, $sql_title) or die('Title Query Failed');
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['title'];
        } else {
            $page_title = "Post Not Found";
        }
        break;
    case 'category.php':
        if (isset($_GET['cat_id'])) {
            $sql_title = "SELECT category_name FROM category WHERE category_id={$_GET['cat_id']}";
            $result_title = mysqli_query($connection, $sql_title) or die('Category Query Failed');
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = "Category : " . $row_title['category_name'] . "News";
        } else {
            $page_title = "Post Not Found";
        }
        break;
    case 'author.php':
        if (isset($_GET['au_id'])) {
            $sql_title = "SELECT * FROM user WHERE user_id={$_GET['au_id']}";
            $result_title = mysqli_query($connection, $sql_title) or die('Username Query Failed');
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = "Writer : " . strtoupper($row_title['first_name'] . " " . $row_title['last_name']);
        } else {
            $page_title = "Post Not Found";
        }
        break;
    case 'search.php':
        if (isset($_GET['search'])) {
            $page_title = "Search : " . $_GET['search'];
        } else {
            $page_title = "Post Not Found";
        }
        break;
    default:
        $page_title = "Home Page";
        break;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <?php
                    $sql = "SELECT * FROM settings";

                    $result = mysqli_query($connection, $sql) or die("Settings Query Failed");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['logo'] == "") {
                                echo '<a href="index"><h1>' . $row['websiteName'] . '</h1></a>';
                            } else {
                                echo '<a href="index" id="logo"><img src="admin/images/' . $row["logo"] . '"></a>
';
                            }
                    ?>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class='menu'>

                        <?php
                        require "config.php";
                        echo "<li><a class='' href='$hostName'>Home</a></li>";
                        if (isset($_GET['cat_id'])) {
                            $cat_id = $_GET['cat_id'];
                        }
                        $sql = "SELECT * FROM category WHERE post > 0";
                        $result = mysqli_query($connection, $sql) or die("Query Failed : Category");
                        $active = "";
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if (isset($_GET['cat_id'])) {
                                    if ($row['category_id'] == $cat_id) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }
                                echo "<li><a class='$active' href='category.php?cat_id={$row["category_id"]}'>{$row["category_name"]}</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->