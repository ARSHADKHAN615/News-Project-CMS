<?php
require "config.php";
session_start();
if (!isset($_SESSION['user_name']) && !isset($_SESSION['user_id'])) {
    header("location:{$hostName}/admin/");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                                        <div class="col-md-2">
                                            <a href="post.php"><img class="logo" src="images/news.jpg"></a>
                                        </div>
                      <!-- /LOGO -->
                <!-- LOGO-Out -->
                <div class="col-md-offset-6  col-md-4">
                    <a href="javascript:void(0)" class="admin-logout text-center mx-5"> Welcome <?php echo $_SESSION['user_name'] ?></a>
                    <a href="logout.php" class="admin-logout text-center">logout</a>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>

    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php">Post</a>
                        </li>
                        <?php
                        if ($_SESSION['user_role'] == 1) {
                            echo '<li>
                            <a href="category.php">Category</a>
                            </li>
                            <li>
                            <a href="users.php">Users</a>
                            </li>
                             <li>
                                <a href="settings.php">Settings</a>
                            </li>
                            ';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
