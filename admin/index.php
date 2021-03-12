<?php
require "config.php";
// session_start();
// if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])) {
//     header("location:{$hostName}/admin/post.php");
// }
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <?php
            require "config.php";
            $showError = false;
            $loginAlert = false;
            if (isset($_POST['login'])) {
                $username = htmlentities($_POST['username']);
                $password = md5($_POST['password']);

                $sql = "SELECT * FROM user WHERE username='$username'";
                $result = mysqli_query($connection, $sql) or die("Query Failed");
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($password == $row['password']) {
                        $loginAlert = true;
                        session_start();
                        $_SESSION['user_name'] = $row['username'];
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_role'] = $row['role'];

                        header("location:{$hostName}/admin/post.php");
                    } else {
                        $showError = true;
                        $Error = "PASSWORD NOT MATCH";
                    }
                } else {
                    $showError = true;
                    $Error = "USERNAME NOT EXIST";
                }
                if ($showError) {
                    echo "<div class='alert alert-danger'>" . $Error . "</div>";
                }
                if ($loginAlert) {
                    echo
                        "<div class='alert alert-success'>Your Login</div>";
                }
            }
            ?>

            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <h3 class="heading">Admin</h3>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="login" />
                    </form>
                    <!-- /Form  End -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>