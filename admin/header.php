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
    <link rel="stylesheet" href="../css/4bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />

    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row justify-content-between align-items-center">
                <!-- LOGO -->
                <div class="col-md-2">
                    <a href="post.php"><img class="header_logo" src="images/asa.jpg"></a>
                </div>
                <!-- /LOGO -->
                <!-- LOGO-Out -->
                <div class="col-offset-6 col-md-2">
                    <div class="dropdown">
                        <button href="javascript:void(0)" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome , <?php echo $_SESSION['user_name'] ?></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="logout.php" class="dropdown-item">logout</a>
                        </div>
                    </div>
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