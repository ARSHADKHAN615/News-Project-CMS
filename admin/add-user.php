<?php include "header.php";
// ONLY ADMIN ACCESS PAGE CODE 
if ($_SESSION['user_role'] == 0) {
    header("location:{$hostName}/admin/post.php");
}



// CREATE USER ACCOUNT 
if (isset($_POST['save'])) {
    require "config.php";
    // HTML ENTITIES STORE IN DB  AND CHECK USERNAME AND PASSWORD
    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    // $user = mysqli_real_escape_string($connection, $_POST['user']);
    $user = htmlentities($_POST['user']);
    $password = mysqli_real_escape_string($connection, md5($_POST['password']));
    $cPassword = mysqli_real_escape_string($connection, md5($_POST['cPassword']));
    $role = mysqli_real_escape_string($connection, $_POST['role']);

    $sql = "SELECT username FROM user WHERE username= '{$user}'";
    $result = mysqli_query($connection, $sql) or die("Query Failed.");
    if (mysqli_num_rows($result) > 0) {
        echo "<p>Username Already Exists.</p>";
    } else {
        if ($password == $cPassword) {
            $sql1 = "INSERT INTO `user`(`first_name`, `last_name`, `username`, `password`,`role`) VALUES ('$fname','$lname','$user','$password','$role')";
            $result1 = mysqli_query($connection, $sql1) or die("Query Failed2.");
            if ($result1) {
                header("location:{$hostName}/admin/users.php");
            }
        } else {
            echo "<p>Password Do NOT Match.</p>";
        }
    }
} else {
    # code...
}


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="cPassword" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Subscriber</option>
                            <option value="1">Administrator</option>
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>